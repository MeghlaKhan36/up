@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            <div class="user-display">
                <a class="username" href="user/{{ Auth::user()->id }}">
                    @if (Auth::user()->profile_picture_path === null)
                        <img class="profile-picture" src="{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                        <h1>{{ Auth::user()->name }}</h1>
                    @else
                        <img class="profile-picture" src="{{ Auth::user()->profile_picture_path }}" alt="Profile picture" />
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
                        <a class="active" href="/upload">
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
                        <a href="/settings/{{ Auth::user()->id }}">
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
            <form class="auth-form" role="form" method="POST" action="file/create" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h1 class="form-heading">Upload a new file</h1>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="File name" style="font-family: Lato">
                    </p>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="File Description">
                    </p>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                    <input id="file" type="file" class="form-control-alt file-input" name="file" placeholder="File" required autofocus>
                    <label for="file">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <h4 id="filename">Choose a file</h4>
                    </label>
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-checkbox">
                    <label class="input-label">File visibility</label>
                    <div class="checkbox">
                        <label>
                            <input id="file_status" type="radio" name="file_status" value="public" checked="checked"> Public
                        </label>
                        <label>
                            <input id="file_status" type="radio" name="file_status" value="private"> Private
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="input-label">File encryption</label>
                    <div class="checkbox">
                        <label for="enc_status">
                            <input id="enc_status" type="radio" name="enc_status" value="encrypt"> Encrypt with OpenSSL
                        </label>
                        <label for="enc_pass">
                            <input id="enc_pass" type="text" class="form-control" name="enc_pass" value="" placeholder="Encryption password">
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection
