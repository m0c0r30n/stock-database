<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>株データベース | 詳細ページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/top_page.css') }}">
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
      <p>銘柄コード : {{ $stock_database[0]["stock_number"] }}</p>
      <p>銘柄名 : {{ $stock_database[0]["stock_name"] }}</p>
    </div>
  </main>
</body>
</html>
