<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/pdf_download.css') }}"> 
    <title>PDF作成</title>
  </head>
<body>
  <h1>作成したPDFをダウンロード</h1>
  <a href="https://circle-thumbnail.s3-ap-northeast-1.amazonaws.com/pdf/{{  $created_at }}_top_note.pdf">PDFのリンクへアクセス</a>
</body>
</html>
