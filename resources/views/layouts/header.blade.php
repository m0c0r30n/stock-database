<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | くる探</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="@yield('main_css')">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="@yield('main_js')"></script>
    <script src="https://kit.fontawesome.com/8f2f53141d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="header">
        <a class="logo" href="/">
            <img src="https://clelib.s3.ap-northeast-1.amazonaws.com/img/header_logo.png">
        </a>
        <ul class="header_nav">
            <a href="{{action('ApplyController@index')}}" li class="header_nav_list" id ="permission_to_use">サークル掲載申請</li></a>
            <a href="/"><li class="header_nav_list" id ="q&a">よくある質問</li></a>
            <a href="{{action('ContactController@index')}}"><li class="header_nav_list" id ="calling">お問い合わせ</li></a>
        </ul>
    </div>
</header>