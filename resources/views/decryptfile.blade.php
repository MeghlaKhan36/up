@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="../../images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            @if ( Auth::user() )
                <div class="user-display">
                    <a class="username" href="../../user/{{ Auth::user()->id }}">
                        @if (Auth::user()->profile_picture_path === null)
                            <img class="profile-picture" src="../../{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                            <h1>{{ Auth::user()->name }}</h1>
                        @else
                            <img class="profile-picture" src="../../{{ Auth::user()->profile_picture_path }}" alt="Profile picture" />
                        @endif
                    </a>
                </div>
            @endif
            <div id="mobile-nav">
                <div class="mobile-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <span>Menu</span>
                </div>
                <nav class="navigation">
                    <ul>
                        @if ( Auth::user() )
                            <li><a href="/upload">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Add file
                                </a>
                            </li>
                            <li><a href="/user/{{ Auth::user()->id }}">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    My Profile
                                </a>
                            </li>
                            <li><a href="/messages/{{ Auth::user()->id }}">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    Messages
                                </a>
                            </li>
                            <li><a href="/settings/{{ Auth::user()->id }}">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    Settings
                                </a>
                            </li>
                            <li><a href="{{ route('logout') }}">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </li>
                        @else
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
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <h1 class="main-heading">The file you tried to download is encrypted, please provide password to download the file</h1>
        <div class="form-container">
            <form class="auth-form edit-profile-form" role="form" method="POST" action="../../decrypt/file/{{ $file->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h1 class="form-heading">File decryption</h1>

                <div class="form-group{{ $errors->has('enc_pass') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="enc_pass" type="text" class="form-control" name="enc_pass" value="{{ old('enc_pass') }}" placeholder="&#xf13e Decrypt password">
                    </p>
                    @if ($errors->has('enc_pass'))
                        <span class="help-block">
                            <strong>{{ $errors->first('enc_pass') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Download file</button>
                </div>
            </form>

        </div>

    </div>
@endsection
