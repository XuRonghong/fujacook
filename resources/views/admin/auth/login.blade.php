@extends('admin.layouts.app')

@section('style')
    <style>
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Backend Admin</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="account" class="col-sm-4 col-form-label text-md-right">{{ __('Account') }}</label>

                            <div class="col-md-6">
                                <input id="account" type="text"
                                       class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}"
                                       name="account"
                                       value="{{ old('account')?
                                       old('account'): (isset($_COOKIE['admin_us'])?$_COOKIE['admin_us']:'') }}"
                                       required autofocus>

                                @if ($errors->has('account'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required
                                       value="{{isset($_COOKIE['admin_pw'])?$_COOKIE['admin_pw']:''}}">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="remember" id="remember" {{ (isset($_COOKIE['admin_us'])) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input type="hidden" name="active" value="1">
                                <input type="hidden" name="nextUrl" value="{{session('nextUrl')}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
