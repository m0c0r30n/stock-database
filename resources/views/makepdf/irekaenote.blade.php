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
    <h1 id="irekae_stock_title">{{ $irekae_kensho->date->format('m月d日') }} ({{ $youbi }}) {{ $stock_name[$n] }} ({{ $irekae_stock[$n]->stock_number }})</h2>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_before }}">
    <p class="stock_info">{!! nl2br(e($irekae_stock[$n]->info)) !!}</p>
  </div>
  <div class="page">
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_after }}">
    <p class="stock_result">{!! nl2br(e($irekae_stock[$n]->result)) !!}</p>
  </div>
  @endfor
</body>
</html>
