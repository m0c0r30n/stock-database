<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('/css/review_pdf.css') }}">  -->
    <title>抵抗線接近銘柄検証ノート</title>
  </head>
<body>
  <?php $stock_count = count($irekae_stock); ?>
  @for ($n = 0; $n < $stock_count; $n++)
  <div class="page">
    <h1 id="irekae_stock_title">{{ $irekae_kensho->date->format('m月d日') }} ({{ $youbi }}) {{ $stock_name[$n] }} ({{ $irekae_stock[$n]->stock_number }})</h1>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_before }}">
    <p class="subject">【会社情報】</p>
    <p class="stock_info">{!! nl2br(e($irekae_stock[$n]->info)) !!}</p>
  </div>
  <div class="page">
    <p class="subject">【当日の地合い状況】</p>
    <table>
      <tr>
        <th>日経平均株価(前日値=>始値=>終値)</th>
        <th>マザーズ指数(前日値=>始値=>終値)</th>
      </tr>
      <tr>
        <td>{{ $nikkei_datas[$n]["pastprice"] }}=>{{ $nikkei_datas[$n]["openprice"] }}=>{{ $nikkei_datas[$n]["endprice"] }}</td>
        <td>{{ $mothers_datas[$n]["pastprice"] }}=>{{ $mothers_datas[$n]["openprice"] }}=>{{ $mothers_datas[$n]["endprice"] }}</td>
      </tr>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_after }}">
    <p class="subject">【結果とまとめ】</p>
    <p class="stock_result">{!! nl2br(e($irekae_stock[$n]->result)) !!}</p>
  </div>
  @endfor
</body>
</html>
