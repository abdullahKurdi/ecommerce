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
            <div class="col-6 offset-3">
                {{--                <h2 class="h5 text-uppercase mb-4">{{__('Login')}}</h2>--}}
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="col-12  mb-3">
                            <div class="form-group">
                                <label for="email" class="text-small text-uppercase">{{ __('E-Mail Address') }}</label>
                                <input type="email" class="form-control form-control-lg" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email Address">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-12  mb-3">
                            <div class="form-group">
                                <label for="password" class="text-small text-uppercase">Password</label>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter New Password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-12  mb-3">
                            <div class="form-group">
                                <label for="password_confirmation" class="text-small text-uppercase">{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control form-control-lg" name="password_confirmation"  placeholder="Re Type Your Password">
{{--                                @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror--}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



{{--    <form method="POST" action="{{ route('password.update') }}">--}}
{{--        @csrf--}}

{{--        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--        <div class="row mb-3">--}}
{{--            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--            <div class="col-md-6">--}}
{{--                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

{{--                @error('email')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row mb-3">--}}
{{--            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--            <div class="col-md-6">--}}
{{--                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                @error('password')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row mb-3">--}}
{{--            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--            <div class="col-md-6">--}}
{{--                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row mb-0">--}}
{{--            <div class="col-md-6 offset-md-4">--}}
{{--                <button type="submit" class="btn btn-primary">--}}
{{--                    {{ __('Reset Password') }}--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
@endsection
