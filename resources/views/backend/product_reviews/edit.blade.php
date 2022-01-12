@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Edit Review On Product {{$productReview->product->name}}
            </h5>
            <div class="ml-auto">
                <a href="{{route('admin.product_reviews.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Reviews</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.product_reviews.update' ,$productReview->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name', $productReview->name)}}" class="form-control">
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{old('email', $productReview->email)}}" class="form-control">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" class="form-control">
                                <option value="1" {{old('rating' , $productReview->rating) == '1' ? 'selected' : null}}>1</option>
                                <option value="2" {{old('rating' , $productReview->rating) == '2' ? 'selected' : null}}>2</option>
                                <option value="3" {{old('rating' , $productReview->rating) == '3' ? 'selected' : null}}>3</option>
                                <option value="4" {{old('rating' , $productReview->rating) == '4' ? 'selected' : null}}>4</option>
                                <option value="5" {{old('rating' , $productReview->rating) == '5' ? 'selected' : null}}>5</option>
                            </select>
                            @error('rating')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="product_id">Product name</label>
                            <input type="text" readonly value="{{ $productReview->product->name}}" class="form-control">
                            <input type="hidden" name="product_id" value="{{ $productReview->product_id}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="user_id">Customer name</label>
                            <input type="text" readonly value="{{ $productReview->user_id != null ?$productReview->user->getFullNameAttribute():'-' }}" class="form-control">
                            <input type="hidden" name="user_id" value="{{ $productReview->user_id ?? ''}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="parent_id">Status</label>
                        <select name="status" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{old('status' , $productReview->status) == '1' ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status' , $productReview->status) == '0' ? 'selected' : null}}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{old('title', $productReview->title)}}" class="form-control">
                            @error('title')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" rows="3" class="form-control summernote"> {!! old('message', $productReview->message) !!} </textarea>
                            @error('message')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Review</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function (){
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
            });
        });
    </script>
@endsection
