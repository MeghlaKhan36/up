@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="../../images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
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
            <div id="mobile-nav">
                <div class="mobile-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <span>Menu</span>
                </div>
                <nav class="navigation">
                    <ul>
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
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <h1 class="main-heading2">To share a file, please select user from the list</h1>
        <p class="site-desc">Don't forget to include password if your file is encrypted</p>
        <div class="form-container">
            <form class="auth-form edit-profile-form" role="form" method="POST" action="../../send/file/{{ $file->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h1 class="form-heading">Share</h1>

                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                    <label class="input-label">Subject</label>
                    <p class="wrapper">
                        <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Subject">
                    </p>
                    @if ($errors->has('subject'))
                        <span class="help-block">
                            <strong>{{ $errors->first('users') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('users') ? ' has-error' : '' }}">
                    <label class="input-label">User</label>
                    <p class="wrapper">
                        <select id="users" class="form-control" name="users">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </p>
                    @if ($errors->has('users'))
                        <span class="help-block">
                            <strong>{{ $errors->first('users') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="input-label share-label">File</label>
                    <table class="files-table recent-files share-file">
                        <tr class="table-heading">
                            <th class="table-title">Title</th>
                            <th class="table-desc">Description</th>
                            <th class="table-size">Size</th>
                        </tr>
                        <tr>
                            <td class="table-title">{{ $file->title }}</td>
                            <td class="table-desc">{{ $file->description }}</td>
                            <td class="table-size">{{ $file->filesize }}</td>
                        </tr>
                    </table>
                </div>

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <p class="wrapper">
                        <textarea id="message" class="form-control textarea" name="message" placeholder="Message"></textarea>
                    </p>
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="form-btn">Share file</button>
                </div>
            </form>

        </div>

    </div>
@endsection