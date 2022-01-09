<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         //for role and permission
        if (!auth()->user()->ability(['admin'],['manage_product_categories','show_product_categories'])){
            return redirect('admin/index');
        }

        // search by this query
        //1-keyword
        //2-status
        //3-sort_by
        //4-order_by
        //5-limit_by

        $categories = ProductCategory::withCount('products')
            ->when(\request()->keyword !=null, function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'asc')
            ->paginate(\request()->limit_by ?? 10 );

        return view('backend.product_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_product_categories'])){
            return redirect('admin/index');
        }

        $main_categories = ProductCategory::whereNull('parent_id')->get(['id','name']);

        return view('backend.product_categories.create',compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_product_categories'])){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;

        //Upload image
        if ($image = $request->file('cover')){
            $file_name  = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            $path       = public_path('assets/product_categories/'.$file_name);
            Image::make($image->getRealPath())->resize(500,null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            $input['cover'] = $file_name;
        }
        ProductCategory::create($input);
        return redirect()->route('admin.product_categories.index')->with([
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
        if (!auth()->user()->ability(['admin'],['display_product_categories'])){
            return redirect('admin/index');
        }

        return view('backend.product_categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_product_categories'])){
            return redirect('admin/index');
        }

        $main_categories = ProductCategory::whereNull('parent_id')->get(['id','name']);

        return view('backend.product_categories.edit' ,compact('main_categories' , 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_product_categories'])){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        // for use the new slug
        $input['slug'] = null;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;

        //Upload image
        if ($image = $request->file('cover')){
            if($productCategory->cover != null && File::exists('assets/product_categories/'.$productCategory->cover)){
                unlink('assets/product_categories/'.$productCategory->cover);

            }
            $file_name  = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            $path       = public_path('assets/product_categories/'.$file_name);
            Image::make($image->getRealPath())->resize(500,null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            $input['cover'] = $file_name;
        }
        $productCategory->update($input);

        return redirect()->route('admin.product_categories.index')->with([
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
    public function destroy(ProductCategory $productCategory)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_product_categories'])){
            return redirect('admin/index');
        }

        if(File::exists('assets/product_categories/'.$productCategory->cover)){
            unlink('assets/product_categories/'.$productCategory->cover);
        }
        $productCategory->delete();

        return redirect()->route('admin.product_categories.index')->with([
            'message'   =>'Deleted Successfully',
            'alert-type'=>'success'
        ]);
    }

    public function remove_image(Request $request)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_product_categories'])){
            return redirect('admin/index');
        }

        $category =ProductCategory::findOrFail($request->product_categories_id);
        if(File::exists('assets/product_categories/'.$category->cover)){
            unlink('assets/product_categories/'.$category->cover);
            $category->cover = null;
            $category->save();
        }
        return true;
    }
}
