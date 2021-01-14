<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('/css/review_pdf.css') }}">  -->
    <title>PDF作成</title>
  </head>
<body>
  <div class="page">
    <img class="cover" src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $top_fifteen->cover }}">
  </div>
  <div class="page">
    <h1 id="pickup_stock_title">注目銘柄TOP15</h2>
    <ul>
      <?php $stock_count = count($stock_info); ?>
      @for ($i = 0; $i < $stock_count; $i++)
      <li>{{ $i+1 }}. {{ $stock_info[$i]['stock_name'] }} ({{ $stock_info[$i]['stock_number'] }})</li>
      @endfor
    </ul>
  </div>
  @for ($n = 0; $n < $stock_count; $n++)
  <div class="page">
    <h2 class="stock_name">
      第{{ $stock_info[$n]->stock_ranking }}位 {{ $stock_info[$n]->stock_name }}
      <span class="dekidaka">出来高→{{ $stock_info[$n]->dekidaka }}</span>
      <span class="overunder">O/U→{{ $stock_info[$n]->overunder }}</spanx>
    </h2>
    <img src="https://stock-database.s3.ap-northeast-1.amazonaws.com/{{ $stock_info[$n]->chart_picture }}">
    <p class="stock_description">{!! nl2br(e($stock_info[$n]->description)) !!}</p>
  </div>
  @endfor
</body>
</html>
