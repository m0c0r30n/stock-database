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
    <h1 id="irekae_stock_title">{{ $irekae_kensho->hizuke->format('Y年m月d日') }} ({{ $youbi }}) {{ $stock_name[$n] }} ({{ $irekae_stock[$n]->stock_number }})</h1>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_before }}">
    <p class="subject">【会社情報】</p>
    <p class="stock_info">{!! nl2br(e($irekae_stock[$n]->info)) !!}</p>
  </div>
  <div class="page">
    <div class="indexes">
      <div class="nikkei_content">
        <h2>日経平均株価</h2>
        <div class="nikkei_img">
          <img src="https://seacret-holder.s3.ap-northeast-1.amazonaws.com/nikkei/nikkei_{{ $irekae_kensho->hizuke->format('Y_m_d') }}.png">
        </div>
        <div class="nikkei_info">
          <div><p>前日値</p><span class="price">{{ $nikkei_pastprice }}円</span></div>
          <div style="margin-left:10px;"><p>始値</p><span class="price">{{ $nikkei_datas["openprice"] }}円</span></div>
          <div style="margin-left:10px;"><p>終値</p><span class="price">{{ $nikkei_datas["endprice"] }}円</span></div>
        </div>
      </div>
      <div class="mothers_content">
        <h2>マザーズ指数</h2>
        <div class="mothers_img">
          <img src="https://seacret-holder.s3.ap-northeast-1.amazonaws.com/mothers/mothers_{{ $irekae_kensho->hizuke->format('Y_m_d') }}.png">
        </div>
        <div class="mothers_info">
          <div><p>前日値</p><p class="price">{{ $mothers_pastprice }}円</p></div>
          <div style="margin-left:10px;"><p>始値</p><p class="price">{{ $mothers_datas["openprice"] }}円</p></div>
          <div style="margin-left:10px;"><p>終値</p><p class="price">{{ $mothers_datas["endprice"] }}円</p></div>
        </div>
      </div>
    </div>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $irekae_stock[$n]->irekae_after }}">
    <p class="subject">【結果とまとめ】</p>
    <p class="stock_result">{!! nl2br(e($irekae_stock[$n]->result)) !!}</p>
  </div>
  @endfor
</body>
</html>
