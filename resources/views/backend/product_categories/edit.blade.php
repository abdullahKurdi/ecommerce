@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Edit {{$productCategory->name}} Category
            </h5>
            <div class="ml-auto">
                <a href="{{route('admin.product_categories.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Categories</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.product_categories.update' ,$productCategory->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name', $productCategory->name)}}" class="form-control">
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="parent_id">Parent</label>
                        <select name="parent_id" class="form-control">
                            <option value="">---</option>
                            @forelse($main_categories as $parent)
                                <option value="{{$parent->id}}" {{old('parent_id', $productCategory->parent_id) == $parent->id ? 'selected' : null}}>{{$parent->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('parent_id')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="parent_id">Status</label>
                        <select name="status" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{old('status' , $productCategory->status) == 1 ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status' , $productCategory->status) == 0 ? 'selected' : null}}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="cover">Cover</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="cover" id="category_image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('cover')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function (){
            $("#category_image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes:['image'],
                showCancel:true,
                showRemove:false,
                showUpload:false,
                overwriteInitial:false,
                initialPreview:[
                    "{{asset('assets/product_categories/'.$productCategory->cover)}}",
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig:[
                    {
                        caption: "{{$productCategory->cover}}" ,
                        size:"1111",
                        width: "120px",
                        url:"{{route('admin.product_categories.remove_image' , ['product_categories_id' => $productCategory->id, '_token' => csrf_token()])}}",
                        key:{{$productCategory->id}}
                    }
                ]
            });
        });
    </script>
@endsection
