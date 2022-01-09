@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Products
            </h5>
            <div class="ml-auto">
                @ability(['admin'],['create_product_categories'])
                <a href="{{route('admin.products.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add New Product</span>
                </a>
                @endability
            </div>
        </div>
        @include('backend.products.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover table-bordered" >
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Feature</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th class="text-center" style="width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><img src="{{asset('assets/products/'. $product->media()->first()->file_name)}}" width="60px" height="60px" alt="{{$product->name}}"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->feature()}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->tags->pluck('name')->join(', ')}}</td>
                        <td>{{$product->status()}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.products.edit' , $product->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if( confirm('Are you sure to delete this record ?')){document.getElementById('delete-product-{{ $product->id }}').submit();} else{return false}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.products.destroy', $product->id)}}" method="post" id="delete-product-{{ $product->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Products Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="float-right">
                            {!! $products->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
