<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pdf_download.css') }}"> 
    <title>S3アップロード</title>
  </head>
<body>
  <h1>アップロードしたいファイルを選択してください</h1>
  <form method="POST" action="{{ url('admin/s3fileup') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input id="upFile" type="file" name="upFile">
  <button style="margin-left: 20px;" type="submit">アップロード</button>

  @if (isset($fullURL))
  <p style="margin-top: 20px;">アップロードされたURL : {{ $fullURL ?? '' }}</p>
  @endif
</body>
</html>
