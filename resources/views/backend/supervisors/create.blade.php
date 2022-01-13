@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Create Supervisor
            </h5>
            <div class="ml-auto">
                <a href="{{route('admin.supervisors.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Supervisors</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.supervisors.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control">
                            @error('first_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control">
                            @error('last_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="{{old('username')}}" class="form-control">
                            @error('username')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control">
                            @error('mobile')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control">
                            @error('password')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="parent_id">Status</label>
                        <select name="status" class="form-control">
                            <option value="">---</option>
                            <option value="1" {{old('status') == '1' ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status') == '0' ? 'selected' : null}}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="col-12 col-md-3">

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <select name="permissions[]" class="form-control select2" multiple="multiple">
                                @forelse($permissions as $permission)
                                    <option value="{{$permission->id}}" {{in_array($permission->id,old('permissions',[]))?"selected":""}}>{{$permission->display_name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="user_image">Profile Picture</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="user_image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 300px x 300px</span>
                            @error('user_image')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add supervisor</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function (){
            // function matchCustom(params, data) {
            //     // If there are no search terms, return all of the data
            //     if ($.trim(params.term) === '') {
            //         return data;
            //     }
            //
            //     // Do not display the item if there is no 'text' property
            //     if (typeof data.text === 'undefined') {
            //         return null;
            //     }
            //
            //     // `params.term` should be the term that is used for searching
            //     // `data.text` is the text that is displayed for the data object
            //     if (data.text.indexOf(params.term) > -1) {
            //         var modifiedData = $.extend({}, data, true);
            //         modifiedData.text += ' (matched)';
            //
            //         // You can return modified objects from here
            //         // This includes matching the `children` how you want in nested data sets
            //         return modifiedData;
            //     }
            //
            //     // Return `null` if the term should not be displayed
            //     return null;
            // };

            $(".select2").select2({
                tags: true,
                closeOnSelect:false,
                minimumResultsForSearch:Infinity,
                // matcher: matchCustom
            });

            $("#user_image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes:['image'],
                showCancel:true,
                showRemove:false,
                showUpload:false,
                overwriteInitial:false,
            });
        });
    </script>
@endsection
