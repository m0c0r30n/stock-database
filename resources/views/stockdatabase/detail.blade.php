<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>株データベース | 詳細ページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('/js/detail_page.js') }}"></script>
    <script src="https://kit.fontawesome.com/8f2f53141d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </head>
<body>
  <header>
      <div class="header">
          <a class="logo" href="/">
            <img src="https://kabutube.s3-ap-northeast-1.amazonaws.com/kabutube_logo2.png">
          </a>
          <ul class="header_nav">
            <li class="header_nav_list"><a href="{{action('StockDatabaseController@lionnote')}}">注目ノート一覧</a></li>
            <div class="search_stock"><input type="text" id="search_stock_number" placeholder="銘柄コード"><i class="fas fa-search"></i></div>
          </ul>
      </div>
  </header>
  <main>
    <div class="wrapper">
      <div class="flex">
        <h1>{{ $stocks[0]["name"] }} ({{ $stocks[0]["code"] }})　</h1><h2 style="margin-left: 50px;">{{ $stocks[0]["market"] }} / {{ $stocks[0]["category"] }}</h2>
      </div>
      <div style="margin-top:50px;margin-bottom:50px;" class="once_floor">
        <img src="https://seacret-holder.s3.ap-northeast-1.amazonaws.com/private/seacret_hike/2021_06_11/ita_2021_06_11_{{ $stocks[0]['code'] }}.png">
        <img src="https://seacret-holder.s3.ap-northeast-1.amazonaws.com/private/seacret_ku/2021_06_11/ku_2021_06_11_{{ $stocks[0]['code'] }}.png">
      </div>
      @if (isset($sikiho_datas[0]))
      <div class="sikiho_content">
        <h2>四季報タイトル : {{ $sikiho_datas[0]["sikiho_title"]}}</h2>
        <div class="sikiho_sentence">
          <p class="stock_chara">銘柄特性　 : </p><p>{{ $sikiho_datas[0]["characteristic"]}}</p>
        </div>
        <div class="sikiho_sentence">
          <p class="stock_perspect">株価見通し : </p><p>{{ $sikiho_datas[0]["perspective"]}}</p>
        </div>
      </div>
      @else
      <h2>四季報データなし<h2>
      @endif
      <div class="second_floor">
        <div class="ifis_content">
          <img src="https://ifis-image.s3-ap-northeast-1.amazonaws.com/ifis_{{ $stocks[0]['code'] }}.png" alt="{{ $stocks[0]['name']}}のIfis画像">
        </div>
        <div class="wadai_content">
          <h3>＜直近の話題株ピックアップ＞</h3>
          @foreach ($wadai_datas as $v)
            <div class="wadai_youso">
              <h4>{{ $v->date->format('Y/m/d')}}</h4><p>{{ $v->stock_description }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <div class="third_floor">
        <h1>注目銘柄登場履歴</h1>
        <ul>
        @foreach ($indivilions as $indivilion)
          <li><a href="https://stock-database.s3-ap-northeast-1.amazonaws.com/indivilionpdf/{{ $indivilion->created_at->format('Ymd')}}_{{ $stocks[0]['code'] }}.pdf" target="_blank" rel="noopener noreferrer">{{ $indivilion->created_at->format('Y年m月d日') }}</a></li>
        @endforeach
        </ul>
      </div>
    </div>
  </main>
</body>
</html>
