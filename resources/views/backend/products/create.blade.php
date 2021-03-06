@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Create Product
            </h5>
            <div class="ml-auto">
                <a href="{{route('admin.products.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Products</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="product_category_id">Category</label>
                            <select name="product_category_id" class="form-control">
                                <option value="">---</option>
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}" {{old('product_category_id') == $category->id ? 'selected' : null}}>{{$category->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('product_category_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{old('status') == '1' ? 'selected' : null}}>Active</option>
                                <option value="0" {{old('status') == '0' ? 'selected' : null}}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="3" class="form-control summernote"> {!! old('description') !!} </textarea>
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control">
                                @error('quantity')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" value="{{old('price')}}" class="form-control">
                                @error('price')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="featured">Featured</label>
                            <select name="featured" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{old('featured') == '1' ? 'selected' : null}}>Yes</option>
                                <option value="0" {{old('featured') == '0' ? 'selected' : null}}>No</option>
                            </select>
                            @error('featured')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="form-control select2" multiple="multiple">
                                    @forelse($tags as $tag)
                                        <option value="{{$tag->id}}" {{in_array($tag->id,old('tags',[]))?"selected":""}}>{{$tag->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="images">Images</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="images[]" id="product_images" class="file-input-overview" multiple="multiple">
                            @error('images')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function (){

            function matchCustom(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') {
                    return null;
                }

                // `params.term` should be the term that is used for searching
                // `data.text` is the text that is displayed for the data object
                if (data.text.indexOf(params.term) > -1) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.text += ' (matched)';

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            };

            $(".select2").select2({
                tags: true,
                closeOnSelect:false,
                minimumResultsForSearch:Infinity,
                matcher: matchCustom
            });

            $("#product_images").fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes:['image'],
                showCancel:true,
                showRemove:false,
                showUpload:false,
                overwriteInitial:false,
            });

            $(".summernote").summernote({
                tabSize: 2,
                height:200,
                toolbar:[
                    ['style',   ['style']],
                    ['font',    ['bold', 'underline', 'clear']],
                    ['color',   ['color']],
                    ['para',    ['ul', 'ol', 'paragraph']],
                    ['table',   ['table']],
                    ['insert',  ['link']],
                    ['view',    ['fullscreen', 'codeview', 'help']]
                ]
            })
        });


    </script>

@endsection
