<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>New Message</title>
</head>
<body>
  <h3>Hello {{ $receiver_user}}!</h3>
  <p>User {{ $user_name }} shared a file with you!</p>
  <h3>File name: {{ $file_name }}</h3>
  <h3>Message:</h3>
  <p>{{ $message_text }}</p>
  <a href="{{ $download_url }}">{{ $download_url }}</a>
</body>
</html>
