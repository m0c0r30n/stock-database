<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('/css/review_pdf.css') }}">  -->
    <title>PDF作成</title>
  </head>
<body>
  <div class="page">
    <h1 style="font-weight: bold" class="h1">ヒートマップ入れ替え前 【{{ $review_note->date->format('Y/m/d') }} {{ $week_day }}】</h1>
    <img class="heatmap" src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->heatmap_before }}">
    <h1 class="h1">ヒートマップ入れ替え後 【{{ $review_note->date->format('Y/m/d') }} {{ $week_day }}】</h1>
    <img class="heatmap" src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->heatmap_after1 }}">
  </div>
  <div class="page">
    <h2 id="change_and_reason_title">入れ替え銘柄＆理由</h2>
    <table>
      @for ($i = 1; $i < $null_num; $i++)
      <tr style="border-bottom: 2px solid black;">
        <td style="border-right: 2px solid black; width: 30%; font-size: 18px; padding: 10px;" class="tb_stock_name">{{ $stock_change["stock".$i] }}</td>
        <td style="width: 70%; font-size: 24px; padding: 10px;" class="tb_stock_desc">{{ $stock_change["stock".$i."_description"] }}</td>
      </tr>
      @endfor
    </table>
  </div>
  <div class="page">
    <p  class="date">{{ $review_note->date->format('m/d') }} ({{ $week_day }})</p>
    <h3 class="stock_name">{{ $review_note->stock1_name}}</h3>
    <img src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->stock1_daylychart }}">
    <p class="daily_chart">日足チャート</p>
    <h3 class="stock_reason_title">銘柄選定理由</h3>
    <p class="stock_extension">{!! nl2br(e($review_note->stock1_extension)) !!}</p>
  </div>
  <div class="page">
    @if ($week_day === "金")
    <p class="date">{{ $review_note->date->modify('+3 day')->format('m/d') }} ({{ $week_day2 }})</p>
    @else
    <p class="date">{{ $review_note->date->modify('+1 day')->format('m/d') }} ({{ $week_day2 }})</p>
    @endif
      <h3 class="trade_review_title">トレード振り返り</h3>
      <img src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->stock1_daychart }}">
      <p class="day_chart">日中足チャート</p>
      <h3 class="trade_how_title">トレード方法</h3>
      <p class="stock_review">{!! nl2br(e($review_note->stock1_review)) !!}</p>
    </div>
  </div>
  <div class="page">
    <p  class="date">{{ $review_note->date->format('m/d') }} ({{ $week_day }})</p>
    <h3 class="stock_name">{{ $review_note->stock2_name}}</h3>
    <img src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->stock2_daylychart }}">
    <p class="daily_chart">日足チャート</p>
    <h3 class="stock_reason_title">銘柄選定理由</h3>
    <p class="stock_extension">{!! nl2br(e($review_note->stock2_extension)) !!}</p>
  </div>
  <div class="page">
    @if ($week_day === "金")
    <p class="date">{{ $review_note->date->modify('+3 day')->format('m/d') }} ({{ $week_day2 }})</p>
    @else
    <p class="date">{{ $review_note->date->modify('+1 day')->format('m/d') }} ({{ $week_day2 }})</p>
    @endif
      <h3 class="trade_review_title">トレード振り返り</h3>
      <img src="https://circle-thumbnail.s3.ap-northeast-1.amazonaws.com/{{ $review_note->stock2_daychart }}">
      <p class="day_chart">日中足チャート</p>
      <h3 class="trade_how_title">トレード方法</h3>
      <p class="stock_review">{!! nl2br(e($review_note->stock2_review)) !!}</p>
    </div>
  </div>
</body>
</html>
