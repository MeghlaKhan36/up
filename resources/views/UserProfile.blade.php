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
                            <img class="profile-picture" src="../{{ Auth::user()->profile_picture }}" alt="Profile picture" />
                            <h1>{{ Auth::user()->name }}</h1>
                        @else
                            <img class="profile-picture" src="../{{ Auth::user()->profile_picture_path }}" alt="Profile picture" />
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
    @if ( Session::has('status') )
        <script>swal("Success!", '{!! session('status') !!}', "success")</script>
    @endif
    <div class="container">
        <h1 class="main-heading">{{ $user->name }}'s profile</h1>
        <img class="user-picture" src="../{{ $user->profile_picture }}" alt="Profile picture">
        <h2 class="user-credentials">{{ $user->first_name }} {{ $user->last_name }}</h2>
        <h2 class="user-credentials">{{ $user->email }}</h2>
        <p class="user-info">{{ $user->info }}</p>
        <table class="files-table recent-files">
            <thead>
                <tr class="table-heading">
                    <th class="sortable table-title">Title</th>
                    <th class="sortable table-desc">Description</th>
                    <th class="sortable table-size">Size (kb)</th>
                    <th class="sortable table-date">
                        Date uploaded
                        <i class='fa fa-caret-down' aria-hidden='true'></i>
                    </th>
                    <th class="no-sort table-action">Action</th>
                    @if ( Auth::user() && Auth::user()->id === $user->id )
                        <th class="no-sort table-admin">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr id="{{ $file->id }}">
                    <td class="table-title">{{ $file->title }}</td>
                    <td class="table-desc">{{ $file->description }}</td>
                    <td class="table-size">{{ calcSize($file->filesize) }}</td>
                    <td class="table-date">{{ $file->created_at->format('d-M-Y') }}</td>
                    <td class="table-action">
                        <a class="table-icon download" href="../download/{{ $file->id }}">
                            <span class="icon-download">Download</span>
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                        @if ( Auth::user() && Auth::user()->id === $user->id )
                            <a class="table-icon share" href="../share/file/{{ $file->id }}">
                                <span class="icon-share">Share</span>
                                <i class="fa fa-share" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                    <td class="table-admin">
                    @if ( Auth::user() && Auth::user()->id === $user->id )
                        <a class="table-icon edit" href="../edit/file/{{ $file->id }}">
                            <span class="icon-edit">Edit</span>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <a class="table-icon delete" data-url="../delete/file/{{ $file->id }}">
                            <span class="icon-delete">Delete</span>
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('pagination.paginate', ['pagination' => $files])
    </div>
@endsection

@section('scripts')
    <script src="/js/sorting.js"></script>
@endsection
