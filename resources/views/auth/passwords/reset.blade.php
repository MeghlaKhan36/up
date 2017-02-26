@extends('layouts.app')

@section('content')
  <div id="auth-view">
    <div class="container">
        <div class="form-container">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="auth-form" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <h1 class="form-heading">Reset Password</h1>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="&#xf0e0; Email address" required autofocus>
                    </p>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="password" type="password" class="form-control" name="password" placeholder="&#xf13e; Password" required autofocus>
                    </p>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <p class="wrapper">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="&#xf13e; Confirm Password" required>
                    </p>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Reset Password</button>
                </div>
            </form>
            <a class="reset-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
            <h2>Not a member?<a class="alt-text" href="{{ route('register') }}"> Sign up</a></h2>
        </div>

    </div>
  </div>
@endsection
