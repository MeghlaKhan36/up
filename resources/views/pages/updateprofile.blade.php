@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="../images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            <div class="user-display">
                <a class="username" href="../user/{{ Auth::user()->id }}">
                    @if (Auth::user()->profile_picture_path === null)
                        <img class="profile-picture" src="../{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                        <h1>{{ Auth::user()->name }}</h1>
                    @else
                        <img class="profile-picture" src="../{{ Auth::user()->profile_picture_path }}" alt="Profile picture" />
                    @endif
                </a>
            </div>
            <div id="mobile-nav">
                <div class="mobile-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <span>Menu</span>
                </div>
                <nav class="navigation">
                  <ul>
                      <h1 class="nav-section">Main</h1>
                      <li>
                        <a href="/">
                          <i class="fa fa-home" aria-hidden="true"></i>
                          Home
                        </a>
                      </li>
                      <li>
                        <a href="/user/{{ Auth::user()->id }}">
                          <i class="fa fa-user" aria-hidden="true"></i>
                          My profile
                        </a>
                      </li>
                      <li>
                        <a href="/upload">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                          Add file
                        </a>
                      </li>
                      <li>
                        <a href="/files">
                          <i class="fa fa-file-o" aria-hidden="true"></i>
                          Files
                        </a>
                      </li>
                      <li>
                        <a href="/messages/{{ Auth::user()->id }}">
                          <i class="fa fa-envelope" aria-hidden="true"></i>
                          Messages
                        </a>
                      </li>
                      <h1 class="nav-section">Admin</h1>
                      <li>
                        <a class="active" href="/settings/{{ Auth::user()->id }}">
                          <i class="fa fa-cog" aria-hidden="true"></i>
                          Settings
                        </a>
                      </li>
                      <li>
                        <a class="active" href="/settings/files/{{ Auth::user()->id }}">
                          <i class="fa fa-cog" aria-hidden="true"></i>
                          Edit files
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('logout') }}">
                          <i class="fa fa-sign-out" aria-hidden="true"></i>
                          Logout
                        </a>
                      </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        @if ( Session::has('status') )
            <script>swal("Success!", '{!! session('status') !!}', "success")</script>
        @endif
        <div class="form-container">
            <form class="auth-form edit-profile-form" role="form" method="POST" action="../profile/update/{{ Auth::user()->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h1 class="form-heading">Edit profile</h1>

                <input name="_method" type="hidden" value="PUT">

                <div id="profile-pic" class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                    <img class="current-picture" src="../{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                    <input id="file" type="file" class="form-control-alt file-input edit-picture" name="profile_picture" placeholder="Select image">
                    <label for="file">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <h4 id="filename">Select image</h4>
                    </label>
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <label class="input-label" for="first_name">First name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="First Name">
                    </p>
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <label class="input-label" for="last_name">Last name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Last Name">
                    </p>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <label class="input-label" for="info">About me</label>
                        <input id="info" type="text" class="form-control" name="info" value="{{ Auth::user()->info }}" placeholder="About me">
                    </p>
                    @if ($errors->has('info'))
                        <span class="help-block">
                            <strong>{{ $errors->first('info') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <button type="submit" class="form-btn">Update profile</button>
                </div>
            </form>

            <form class="auth-form edit-profile-form" role="form" method="POST" action="../account/update/{{ Auth::user()->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h1 class="form-heading">Account settings</h1>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <label class="input-label">Username</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Username">
                    </p>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <label class="input-label">Email address</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email address">
                    </p>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input id="deactivate" type="checkbox" name="deactivate" value="0"> Deactivate Account
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Save changes</button>
                </div>
            </form>
        </div>

    </div>
@endsection
