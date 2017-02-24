@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="images/logo.svg" alt="Up!">
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

    <h1 class="main-heading">Welcome!</h1>

    @if ( Session::has('status') )
        <script>swal("Oops!", '{!! session('status') !!}', "error")</script>
    @endif

    <div class="form-container">
        <form class="auth-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <h1 class="form-heading">Log in</h1>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <p class="wrapper">
                    <input id="user" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="&#61447; Username" required autofocus>
                </p>
                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
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
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="form-btn">Login</button>
            </div>
        </form>
        <a class="reset-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
        <h2>Not a member?<a class="alt-text" href="{{ route('register') }}"> Sign up</a></h2>
    </div>

</div>
@endsection
