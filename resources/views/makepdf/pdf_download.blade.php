<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/pdf_download.css') }}"> 
    <title>注目ノートPDF作成</title>
  </head>
<body>
  <h1>作成したPDFをダウンロード</h1>
  @if (isset($date))
  <p>成功！！</p>
  @else
  <a href="https://stock-database.s3-ap-northeast-1.amazonaws.com/pdf/{{  $created_at }}_top_note.pdf">PDFのリンクへアクセス</a><a href="https://stock-database.s3-ap-northeast-1.amazonaws.com/pdf/{{  $created_at }}_top_note.pdf">PDFのリンクへアクセス</a>
  @endif
</body>
</html>
