@extends('layouts.home-layout')

@section('content')
  <div class="auth-view">
    <div class="container">
        <div class="form-container">
            <form class="auth-form" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <h1 class="form-heading">Sign up</h1>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="&#61447; Username" required autofocus>
                    </p>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="&#xf0e0; Email Address" required autofocus>
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
                    @if ($errors->has('password-confirm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <button type="submit" class="form-btn">Login</button>
                </div>
            </form>
            <h2>Already a member?<a class="alt-text" href="{{ route('login') }}"> Log in</a></h2>
        </div>

    </div>
  </div>
@endsection
