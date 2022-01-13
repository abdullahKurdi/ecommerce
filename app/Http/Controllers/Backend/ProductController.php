<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['manage_products','show_products'])){
            return redirect('admin/index');
        }

        // search by this query
        //1-keyword
        //2-status
        //3-sort_by
        //4-order_by
        //5-limit_by

        $products = Product::with('category' , 'tags' , 'firstMedia')
            ->when(\request()->keyword !=null, function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10 );

        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_products'])){
            return redirect('admin/index');
        }


        $categories = ProductCategory::whereStatus(1)->get(['id','name']);
        $tags       = Tag::whereStatus(1)->get(['id','name']);
        return view('backend.products.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_products'])){
            return redirect('admin/index');
        }

        $input['name']                  =   $request->name;
        $input['description']           =   $request->description;
        $input['price']                 =   $request->price;
        $input['quantity']              =   $request->quantity;
        $input['product_category_id']   =   $request->product_category_id;
        $input['featured']              =   $request->featured;
        $input['status']                =   $request->status;

        $product = Product::create($input);
        $product->tags()->attach($request->tags);

        if ($request->images && count($request->images) > 0){
            $i = 1 ;
            foreach ($request->images as $image){
                $file_name = $product->slug . '_'. time() . '_' . $i . '.' .$image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path      = public_path('assets/products/'.$file_name);

                Image::make($image->getRealPath())->resize(500 , null ,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $product->media()->create([
                    'file_name'     =>  $file_name,
                    'file_size'     =>  $file_size,
                    'file_type'     =>  $file_type,
                    'file_status'   =>  true,
                    'file_sort'     =>  $i,
                ]);

                $i++;
            }
        }
        return redirect()->route('admin.products.index')->with([
            'message'   =>'Created Successfully',
            'alert-type'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['display_products'])){
            return redirect('admin/index');
        }

        return view('backend.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_products'])){
            return redirect('admin/index');
        }


        $categories = ProductCategory::whereStatus(1)->get(['id','name']);
        $tags       = Tag::whereStatus(1)->get(['id','name']);
        return view('backend.products.edit',compact('categories','tags','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_products'])){
            return redirect('admin/index');
        }

        $input['name']                  =   $request->name;
        $input['description']           =   $request->description;
        $input['price']                 =   $request->price;
        $input['quantity']              =   $request->quantity;
        $input['product_category_id']   =   $request->product_category_id;
        $input['featured']              =   $request->featured;
        $input['status']                =   $request->status;

        $product->update($input);
        $product->tags()->sync($request->tags);

        if ($request->images && count($request->images) > 0){
            $i = $product->media()->count() + 1;
            foreach ($request->images as $image){
                $file_name = $product->slug . '_'. time() . '_' . $i . '.' .$image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path      = public_path('assets/products/'.$file_name);

                Image::make($image->getRealPath())->resize(500 , null ,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $product->media()->create([
                    'file_name'     =>  $file_name,
                    'file_size'     =>  $file_size,
                    'file_type'     =>  $file_type,
                    'file_status'   =>  true,
                    'file_sort'     =>  $i,
                ]);

                $i++;
            }
        }
        return redirect()->route('admin.products.index')->with([
            'message'   =>'Updated Successfully',
            'alert-type'=>'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_products'])){
            return redirect('admin/index');
        }

        if ($product->media()->count()  > 0){
            foreach ($product->media as $media){
                if(File::exists('assets/products/'.$media->file_name)){
                    unlink('assets/products/'.$media->file_name);
                }
                $media->delete();
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with([
            'message'   =>'Deleted Successfully',
            'alert-type'=>'success'
        ]);


    }

    public function remove_image(Request $request)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_products'])){
            return redirect('admin/index');
        }

        $product = Product::findOrFail($request->product_id);
        $image   = $product->media()->whereId($request->image_id)->first();

        if(File::exists('assets/products/'.$image->file_name)){
            unlink('assets/products/'.$image->file_name);
        }
        $image->delete();
        return true;
    }
}
