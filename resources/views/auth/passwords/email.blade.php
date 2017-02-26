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

                <h1 class="form-heading">Reset Password</h1>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="&#xf0e0; Email address" required autofocus>
                    </p>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Send password reset link</button>
                </div>
            </form>
        </div>

    </div>
  </div>
@endsection
