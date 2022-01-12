<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['manage_product_coupon','show_product_reviews'])){
            return redirect('admin/index');
        }

        // search by this query
        //1-keyword
        //2-status
        //3-sort_by
        //4-order_by
        //5-limit_by

        $reviews = ProductReview::query()
            ->when(\request()->keyword !=null, function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'asc')
            ->paginate(\request()->limit_by ?? 10 );

        return view('backend.product_reviews.index', compact('reviews'));
    }

    public function create()
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_product_reviews'])){
            return redirect('admin/index');
        }

        return view('backend.product_reviews.create');
    }

    public function store(Request $request)
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_product_reviews'])){
            return redirect('admin/index');
        }

    }

    public function show(ProductReview $productReview)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['display_product_reviews'])){
            return redirect('admin/index');
        }

        return view('backend.product_reviews.show',compact('productReview'));
    }

    public function edit(ProductReview $productReview)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_product_reviews'])){
            return redirect('admin/index');
        }

        return view('backend.product_reviews.edit' ,compact('productReview'));
    }

    public function update(ProductReviewRequest $request, ProductReview $productReview)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_product_reviews'])){
            return redirect('admin/index');
        }

        $productReview->update($request->validated());

        return redirect()->route('admin.product_reviews.index')->with([
            'message'   =>'Updated Successfully',
            'alert-type'=>'success'
        ]);
    }

    public function destroy(ProductReview $productReview)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_product_reviews'])){
            return redirect('admin/index');
        }

        $productReview->delete();

        return redirect()->route('admin.product_reviews.index')->with([
            'message'   =>'Deleted Successfully',
            'alert-type'=>'success'
        ]);
    }
}
