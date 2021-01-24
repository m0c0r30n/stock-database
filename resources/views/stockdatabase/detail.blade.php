<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>株データベース | 詳細ページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
      <h1>{{ $stock_database[0]["stock_name"] }} ({{ $stock_database[0]["stock_number"] }})　</h1>
      <div class="sikiho_content">
        <h2>四季報タイトル : {{ $sikiho_datas[0]["sikiho_title"]}}</h2>
        <div class="sikiho_sentence">
          <p class="stock_chara">銘柄特性　 : </p><p>{{ $sikiho_datas[0]["characteristic"]}}</p>
        </div>
        <div class="sikiho_sentence">
          <p class="stock_perspect">株価見通し : </p><p>{{ $sikiho_datas[0]["perspective"]}}</p>
        </div>
      </div>
      <div class="second_floor">
        <div class="ifis_content">
          <img src="https://ifis-image.s3-ap-northeast-1.amazonaws.com/ifis_{{ $stock_database[0]['stock_number'] }}.png" alt="{{ $stock_database[0]['stock_name']}}のIfis画像">
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
        
      </div>
    </div>
  </main>
</body>
</html>