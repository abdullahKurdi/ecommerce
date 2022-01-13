@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h5 class="m-0 font-weight-bold text-primary">
                Customers
            </h5>
            <div class="ml-auto">
                @ability(['admin'],['create_customers'])
                <a href="{{route('admin.customers.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add New Customer</span>
                </a>
                @endability
            </div>
        </div>
        @include('backend.customers.filter.filter')
        <div class="table-responsive">
            <table class="table table-hover table-bordered" >
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name & Username</th>
                    <th>Email & Mobile</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th class="text-center" style="width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>
                            @if($customer->user_image != '')
                                <img src="{{asset('assets/users/'.$customer->user_image)}}" alt="{{$customer->name}}" width="60px" height="60px">
                            @else
                                <img src="{{asset('assets/users/avatar.svg')}}" alt="{{$customer->name}}" width="60px" height="60px">
                            @endif
                        </td>
                        <td>{{$customer->getFullNameAttribute()}}
                            <br>
                            <strong>{{$customer->username}}</strong>
                        </td>
                        <td>{{$customer->email}} <br> {{$customer->mobile}}</td>
                        <td>{{$customer->status()}}</td>
                        <td>{{$customer->created_at->format('Y:m:d')}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.customers.edit' , $customer->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if( confirm('Are you sure to delete this record ?')){document.getElementById('delete-customer-{{ $customer->id }}').submit();} else{return false}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.customers.destroy', $customer->id)}}" method="post" id="delete-customer-{{ $customer->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Customer Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $customers->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
