<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>トップページ</title>
  </head>
<body>
<main class="wrapper">
  <div class="sikiho_list_content">
    @for ($i = 0; $i < 12; $i++)
    <h1>{{ $sikiho_datas[$i]['sikiho_title'] }}</h1>
    @endfor
  </div>
</main>
</body>
</html>
