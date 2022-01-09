@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Tags
            </h5>
            <div class="ml-auto">
                @ability(['admin'],['create_tags'])
                <a href="{{route('admin.tags.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add New Tag</span>
                </a>
                @endability
            </div>
        </div>
        @include('backend.tags.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover table-bordered" >
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Product count</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th class="text-center" style="width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->products->count()}}</td>
                        <td>{{$tag->status()}}</td>
                        <td>{{$tag->created_at}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.tags.edit' , $tag->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if( confirm('Are you sure to delete this record ?')){document.getElementById('delete-tag-{{ $tag->id }}').submit();} else{return false}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.tags.destroy', $tag->id)}}" method="post" id="delete-tag-{{ $tag->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Tag Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="float-right">
                            {!! $tags->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
