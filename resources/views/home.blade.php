@extends('layouts.home-layout')

@section('content')
    <header id="home" class="container">
      <div class="page-info">
        <div class="home-navigation">
          <div class="wrapper">
            <div class="logo">
              <img src="images/logo.svg" alt="Up">
            </div>
            <nav id="home-nav">
              <ul>
                <li><a href="/">Home</a></li>
                @if (!Auth::user())
                <li><a href="login">Login</a></li>
                @else
                <li><a href="files">Files</a></li>
                <li><a href="user/{{ Auth::user()->id }}">My profile</a></li>
                <li><a href="logout">Logout</a><li>
                @endif
              </ul>
            </nav>
          </div>
        </div>
        <div class="content-wrap">
          <h1 class="header-desc">A simple way to upload and<br />share your files.</h1>
        </div>
      </div>
    </header>
    <section id="about" class="info-section">
      <div class="wrapper">
        <div class="section-info">
          <h1 class="section-heading">File uploading and sharing in just a few clicks!</h1>
          <div class="icons-wrap">
            <div class="icon-wrap register">
              <a href="register">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <h2>Register</h2>
              </a>
            </div>
            <div class="icon-wrap arrow">
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </div>
            <div class="icon-wrap">
              <i class="fa fa-files-o" aria-hidden="true"></i>
              <h2>Select file</h2>
            </div>
            <div class="icon-wrap arrow">
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </div>
            <div class="icon-wrap">
              <i class="fa fa-cloud-upload" aria-hidden="true"></i>
              <h2>Upload</h2>
            </div>
            <div class="icon-wrap arrow">
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </div>
            <div class="icon-wrap">
              <i class="fa fa-share-alt" aria-hidden="true"></i>
              <h2>Share</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="about" class="security-info">
      <div class="wrapper">
        <div class="encryption-icon">
          <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <div class="text-wrap">
          <h1 class="section-heading">File security.</h1>
          <h2>Your files are kept safe using OpenSSL encryption</h2>
        </div>
      </div>
    </section>
    <section id="login" class="preview-section">
      <div class="wrapper">
        <div class="preview-image-wrap">
          <img src="images/device-webapp.png" alt="Application">
        </div>
        <div class="user-links">
          <div class="user-links-wrap">
            <h1>To begin please create an account</h1>
            <a class="register-btn" href="register">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              Sign up
            </a>
            <h1>Already have an account?</h1>
            <a class="login-btn" href="login">
              <i class="fa fa-sign-in" aria-hidden="true"></i>
              Login
            </a>
          </div>
          <a class="forgot-password" href="password/reset">Forgot your password?</a>
        </div>
      </div>
    </section>
    <footer id="home-footer">
      <h1>Copyright 2017 - ncerovski</h1>
    </footer>
@endsection
