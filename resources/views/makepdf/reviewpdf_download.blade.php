<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/pdf_download.css') }}"> 
    <title>ReviewPDF作成</title>
  </head>
<body>
  <h1>作成したPDFをダウンロード</h1>
  <a href="https://stock-database.s3-ap-northeast-1.amazonaws.com/pdf/{{  $created_at }}_review_note.pdf">PDFのリンクへアクセス</a>
</body>
</html>
