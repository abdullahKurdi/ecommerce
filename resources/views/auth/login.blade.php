@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Login</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
{{--                    <img class="img-fluid" src="{{asset('backend/img/logo.png')}}" alt=""/>--}}
                </div>
            </div>
        </div>
    </section>

    <!--Custom design -->
    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
{{--                <h2 class="h5 text-uppercase mb-4">{{__('Login')}}</h2>--}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="username" class="text-small text-uppercase">Username</label>
                                <input type="text" class="form-control form-control-lg" name="username" value="{{ old('username') }}" placeholder="Enter Your Username">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="password" class="text-small text-uppercase">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password"  placeholder="Enter Your Password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-6 form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="custom-control-label text-small">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('Have\'t an account?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
