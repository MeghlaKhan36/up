@extends('layouts.app')

@section('sidebar')
    <div class="user-info-wrap">
        <h1 id="page-logo">
            <a href="/">
                <img src="/images/logo.svg" alt="Up!">
            </a>
        </h1>
        <div class="sidebar-content">
            <div class="user-display">
                <a class="username" href="/user/{{ Auth::user()->id }}">
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
    @if ( Session::has('status') )
        <script>swal("Success!", '{!! session('status') !!}', "success")</script>
    @endif
    <div class="container">
        <div class="inbox-container">
            <h1 class="msg-heading">Sent messages</h1>
        @if ( $sentMessages )
            <table class="files-table messages-table">
                <tr class="table-heading">
                    <th class="table-title">Subject</th>
                    <th class="table-receiver">Sent to</th>
                    <th class="table-date">Time</th>
                    <th class="table-time">Date</th>
                    <th class="no-sort table-admin">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
                </tr>
            @foreach( $sentMessages as $message )
                @php
                    $user = $allUsers->where('id', '=', $message->receiver_id)->first();
                    $username = $user->name;
                @endphp
                <tr class="info-row">
                    <td class="table-subject">
                        <a href="../messages/{{ Auth::user()->id }}/{{ $message->id }}" class="table-icon read">{{ $message->subject }}</a>
                    </td>
                    <td class="table-username">{{ $username }}</td>
                    <td class="table-time">{{ $message->created_at->format('H:m:s') }}</td>
                    <td class="table-time">{{ $message->created_at->format('d-M-Y') }}</td>
                    <td class="table-admin">
                        <a href="../messages/{{ Auth::user()->id }}/{{ $message->id }}" class="table-icon read">
                            <span class="icon-read">Read</span>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </a>
                        <a class="table-icon delete" data-url="../delete/message/{{ $message->id }}">
                            <span class="icon-delete">Delete</span>
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </table>
        @else
            <h2 class="msg-heading">We couldn't find any messages.</h2>
        @endif
            <h1 class="msg-heading">Received messages</h1>
        @if ( $receivedMessages )
            <table class="files-table messages-table">
                <tr class="table-heading">
                    <th class="table-title">Subject</th>
                    <th class="table-receiver">Sender</th>
                    <th class="table-date">Time</th>
                    <th class="table-time">Date</th>
                    <th class="no-sort table-admin">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
                </tr>
            @foreach( $receivedMessages as $message )
                <tr class="info-row">
                    <td class="table-subject">
                        <a href="../messages/{{ Auth::user()->id }}/{{ $message->id }}" class="table-icon read">{{ $message->subject }}</a>
                    </td>
                    <td class="table-username">{{ $message->user->name }}</td>
                    <td class="table-time">{{ $message->created_at->format('H:m:s') }}</td>
                    <td class="table-time">{{ $message->created_at->format('d-M-Y') }}</td>
                    <td class="table-admin">
                        <a href="../messages/{{ Auth::user()->id }}/{{ $message->id }}" class="table-icon read">
                            <span class="icon-open">Read</span>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </a>
                        <a class="table-icon delete" data-url="../delete/message/{{ $message->id }}">
                            <span class="icon-delete">Delete</span>
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </table>
        @else
            <h2 class="msg-heading">We couldn't find any messages.</h2>
        @endif
        </div>

    </div>
@endsection
