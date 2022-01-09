@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('Reset Password') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <img class="img-fluid" src="{{asset('backend/img/logo.png')}}" alt=""/>
                </div>
            </div>
        </div>
    </section>

    <!--Custom design -->
    <section class="py-5">
        <div class="row">
            <div class="col-12 offset-3">
                {{--                <h2 class="h5 text-uppercase mb-4">{{__('Login')}}</h2>--}}
                    @if (session('status'))
                        <div class="alert alert-success col-6" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="email" class="text-small text-uppercase">{{ __('E-Mail Address') }}</label>
                                <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email Address">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>>
@endsection
