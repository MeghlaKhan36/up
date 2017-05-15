@extends('layouts.app')

@section('content')
    <form action="{{ ../sendmail }}" method="post">
      {{ csrf_field() }}
      <input type="email" name="mail" placeholder="email address">
      <input type="text" name="title" placeholder="title">
      <button type="submit">Send me an Email</button>
    </form>
@endsection

@section('scripts')
    <script src="/js/sorting.js"></script>
@endsection
