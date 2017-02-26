@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="/images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            @if ( Auth::user() )
                <div class="user-display">
                    <a class="username" href="../user/{{ Auth::user()->id }}">
                        @if (Auth::user()->profile_picture_path === null)
                            <img class="profile-picture" src="/{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                            <h1>{{ Auth::user()->name }}</h1>
                        @else
                            <img class="profile-picture" src="/{{ Auth::user()->profile_picture_path }}" alt="Profile picture" />
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
    <div class="container">

        <form class="search" method="GET" action="../search/user">
            {{ csrf_field() }}
            <input id="search" type="text" name="search" value="" placeholder="&#xf002; Search for file or user">
        </form>

        <h1 class="main-heading">Search results for: {{ $search }}</h1>
        @if ( $users->count() > 0 )
            @if ( $users->count() < 2 )
                <h1 class="found-user">Found one user matching your search criteria</h1>
            @else
                <h1 class="found-user">Found {{ $user->count() }} users matching your search criteria</h1>
            @endif
            @foreach ( $users as $user )
                <a href="../user/{{ $user->id }}" class="user-result">{{ $user->name }}</a>
            @endforeach
        @else
            <h1 class="found-user">We could not find any users matching your search criteria</h1>
        @endif
        @if ( $files->count() > 0 )
            @if ( $files->count() < 2 )
                <h1 class="found-file">Found 1 file matching your search criteria</h1>
            @else
                <h1 class="found-file">Found {{ $files->count() }} files matching your search criteria</h1>
            @endif
            <table class="files-table recent-files">
                <tr class="table-heading">
                    <th class="table-title">Title</th>
                    <th class="table-desc">Description</th>
                    <th class="table-author">Author</th>
                    <th class="table-size">Size</th>
                    <th class="table-date">Date uploaded</th>
                    <th class="table-action">Action</th>
                </tr>
                @foreach($files as $file)
                    <tr>
                        <td class="table-title">{{ $file->title }}</td>
                        <td class="table-desc">{{ $file->description }}</td>
                        <td class="table-author"><a class="table-username" href="user/{{ $file->user->id }}">{{ $file->user->name }}</a></td>
                        <td class="table-size">{{ $file->filesize }}</td>
                        <td class="table-date">{{ $file->created_at->format('d-M-Y') }}</td>
                        <td class="table-action">
                            <a class="table-icon download" href="../download/{{ $file->id }}">
                                <span class="icon-download">Download</span>
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h1 class="found-file">We could not find any files matching your search criteria</h1>
        @endif
    </div>
@endsection
