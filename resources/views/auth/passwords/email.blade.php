@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="../images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            <nav>
                <ul>
                    <li><a href="{{ route('login') }}">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            Login
                        </a>
                    </li>
                    <li><a href="{{ route('register') }}">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            Register
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('content')
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
@endsection
