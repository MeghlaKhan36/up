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
        <div class="inbox-container">
            <div class="message-info">
                <h1>Subject: {{ $message->subject }}</h1>
                <h2>Sent by: {{ $message->user->name }}</h2>
                <h2>Recipient: {{ $user->name }}</h2>
                <h2>Date sent: {{ $message->created_at }}</h2>
                <h1 class="message-heading">Message: </h1>
            </div>

            <table class="files-table">
                <tr class="table-heading">
                    <th class="table-title">File</th>
                    <th class="table-desc">Description</th>
                    <th class="table-size">Size</th>
                    <th class="table-action">Action</th>
                </tr>
                <tr>
                    <td class="table-title">{{ $file->title }}</td>
                    <td class="table-desc">{{ $file->description }}</td>
                    <td class="table-size">{{ $file->filesize }}</td>
                    <td class="table-action">
                        <a class="table-icon download" href="../../download/{{ $file->id }}">
                            <span class="icon-download">Download</span>
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            </table>
            <p class="content">{{ $message->message }}</p>
        </div>
    </div>
@endsection