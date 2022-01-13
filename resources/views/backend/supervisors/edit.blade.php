@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Edit {{$supervisor->getFullNameAttribute()}} Supervisor
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
            <form action="{{route('admin.supervisors.update',$supervisor->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{old('first_name',$supervisor->first_name)}}" class="form-control">
                            @error('first_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{old('last_name',$supervisor->last_name)}}" class="form-control">
                            @error('last_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="{{old('username',$supervisor->username)}}" class="form-control">
                            @error('username')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{old('email',$supervisor->email)}}" class="form-control">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{old('mobile',$supervisor->mobile)}}" class="form-control">
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
                            <option value="1" {{old('status',$supervisor->status) == '1' ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status',$supervisor->status) == '0' ? 'selected' : null}}>Inactive</option>
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
                                    <option value="{{$permission->id}}" {{in_array($permission->id,old('permissions',$userPermission))?"selected":""}}>{{$permission->display_name}}</option>
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
                    <button type="submit" name="submit" class="btn btn-primary">Update supervisor</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function (){
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
                @if($supervisor->user_image != null)
                initialPreview:[
                    "{{asset('assets/users/'.$supervisor->user_image)}}",
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig:[
                    {
                        caption: "{{$supervisor->user_image}}" ,
                        size:"1111",
                        width: "120px",
                        url:"{{route('admin.supervisors.remove_image' , ['supervisor_id' => $supervisor->id, '_token' => csrf_token()])}}",
                        key:{{$supervisor->id}}
                    }
                ]
                @endif
            });
        });
    </script>
@endsection
