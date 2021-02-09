<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>株データベース | トップページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/top_page.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('/js/top_page.js') }}"></script>
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
      <div class="topfifteen_content">
        <h1>先週のらいおんまる注目銘柄6+9</h1>
        <ul>
        @for ($i = 1; $i < 20; $i++)
          @if (isset($topfifteen_datas[0]["stockname".$i]))
            <?php preg_match('/\d{4}/', $topfifteen_datas[0]["stockname".$i], $stock_number); ?>
            <a href="{{ action('StockDatabaseController@detail', $stock_number[0]) }}"><li>{{ $topfifteen_datas[0]["stockname".$i] }}</li></a>
          @endif
        @endfor
        </ul>
      </div>
      <div class="wadai_content">
        <h1>直近の話題株ピックアップ銘柄</h1>
        <ul>
        @for ($i = 1; $i < 20; $i++)
            <a href="{{ action('StockDatabaseController@detail', $wadai_datas[$i]['stock_number']) }}"><li>{{ $wadai_datas[$i]['stock_name'] }} ({{ $wadai_datas[$i]['stock_number'] }})</li></a>
        @endfor
        </ul>
      </div>
      <div class="stockchange_content">
        <h1>前日の入れ替え銘柄一覧</h1>
        <ul>
        @for ($i = 1; $i < 20; $i++)
          @if (isset($stockchange_datas[0]["stock".$i]))
            <?php preg_match('/\d{4}/', $stockchange_datas[0]["stock".$i], $stock_number); ?>
            <a href="{{ action('StockDatabaseController@detail', $stock_number[0]) }}"><li>{{ $stockchange_datas[0]["stock".$i] }}</li></a>
          @endif
        @endfor
        </ul>
      </div>
    </div>
  </main>
</body>
</html>
