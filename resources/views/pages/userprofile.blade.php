@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="../images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            @if ( Auth::user() )
                <div class="user-display">
                    <a class="username" href="../user/{{ Auth::user()->id }}">
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
    @if ( Session::has('status') )
        <script>swal("Success!", '{!! session('status') !!}', "success")</script>
    @endif
    <div class="wrapper">
        @if ( Auth::user()->id === $user->id )
          <h1 class="main-heading">My profile</h1>
        @else
          <h1 class="main-heading">{{ $user->name }}'s profile</h1>
        @endif
        <h2 class="file-count">{{ $files->count() }} files: </h2>
        <div class="files-display">
        @foreach($files as $file)
          <div class="file-wrap" data-src="..download/{{ $file->id }}" data-type="{{ $file->file_type }}">
            <h1 class="file-name">{{ $file->org_name }}</h1>
            <p>On: {{ $file->created_at->format('d-M-Y') }}</p>
            <div class="options">
              @if ( Auth::user() && Auth::user()->id === $user->id )
              <a class="table-icon share" href="../share/file/{{ $file->id }}">
                  <i class="fa fa-share" aria-hidden="true"></i>
              </a>
              @endif
              <a class="table-icon download" href="../download/{{ $file->id }}">
                  <i class="fa fa-download" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        @endforeach
        </div>
        @include('pagination.paginate', ['pagination' => $files])
    </div>
@endsection

@section('scripts')
    <script src="/js/sorting.js"></script>
@endsection
