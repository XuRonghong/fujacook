@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Reset Password') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.password.reset') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token or csrf_token() }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ session()->get('verification.email') ?? old('email') }}" required >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ htmlspecialchars( $errors->first('email')) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verification" class="col-md-4 col-form-label text-md-right">Verification</label>

                            <div class="col-md-6">
                                <input id="verification" type="text"
                                       class="form-control{{ $errors->has('verification') ? ' is-invalid' : '' }}"
                                       name="verification"
                                       placeholder="{{trans('web.forgotpassword.verification')}}"
                                       value="{{ $verification ?? old('verification') }}" required autofocus>

                                @if ($errors->has('verification'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('verification') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <a href="{{route('admin.password.request')}}" style="font-size:10px;padding-top: 15px;">沒收到信</a>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="{{trans('web.forgotpassword.new_password')}}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                       class="form-control"
                                       placeholder="{{trans('web.forgotpassword.confirm_password')}}"
                                       name="password_confirmation" required
                                       oninput="check(this)">

                                <span class="" role="alert" style="color: red;">
                                    <strong class="password_confirmation_err">&nbsp;</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                                <a href="{{route('admin.login.index')}}">
                                    <button type="button" class="btn btn-orange">
                                        {{ __('Login') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('inline-js')
    <script type='text/javascript'>
        function check(input) {
            if (input.value !== document.getElementById('password').value) {
                // input.setCustomValidity('Password Must be Matching.');
                document.querySelector('.password_confirmation_err').innerHTML = 'Password Must be Matching.'
                document.querySelector('.btn').disabled = 'disabled'
                return false
            } else {
                // input is valid -- reset the error message
                document.querySelector('.password_confirmation_err').innerHTML = '&nbsp;'
                document.querySelector('.btn').disabled = ''
                // input.setCustomValidity('');
                return true
            }
        }
    </script>
@endsection
