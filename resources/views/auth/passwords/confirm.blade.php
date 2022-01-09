@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('Confirm Password') }}</h1>
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
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf


                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="password" class="text-small text-uppercase">{{ __('Password') }}</label>
                                <input type="password" class="form-control form-control-lg" name="password" value="{{ old('password') }}" placeholder="Enter Your Password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="col-12 ">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>>
@endsection
