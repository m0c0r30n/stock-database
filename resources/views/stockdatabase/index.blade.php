<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>株データベース | トップページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fullcalendar/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.jqplot.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/top_page.css') }}">
    <script src="{{ asset('/js/fullcalendar/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/data.js"></script>
    <!-- <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/export-data.js"></script> -->
    <script src="{{ asset('/js/top_page.js') }}"></script>
    <script src="https://kit.fontawesome.com/8f2f53141d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </head>
<body>
  <header>
      <div class="header">
          <a class="logo" href="/">
            <!-- <img src="https://kabutube.s3-ap-northeast-1.amazonaws.com/kabutube_logo2.png"> -->
            KABU DATABASE
          </a>
          <ul class="header_nav">
            <li class="header_nav_list"><a href="{{action('StockDatabaseController@lionnote')}}">市場ニュース</a></li>
            <li class="header_nav_list"><a href="{{action('StockDatabaseController@lionnote')}}">ランキング</a></li>
            <li class="header_nav_list"><a href="{{action('StockDatabaseController@lionnote')}}">ログイン</a></li>
            <li class="header_nav_list"><a href="{{action('StockDatabaseController@lionnote')}}">新規登録</a></li>
          </ul>
      </div>
  </header>
  <main>
    <div class="search_area_wrap">
      <div class="search_area">
        <div class="search_area_left">
          <div class="search_stock"><input type="text" id="search_stock_number" placeholder="銘柄(証券コード)を検索"><i class="fas fa-search"></i></div>
          <a style="display:block;margin:12px 0px 0px 14px;" href="#">ジャンルから探す</a>
        </div>
        <div class="search_area_right">
          <p>急上昇ワード</p>
          <div class="soaring_word">
            <a href="#">バルミューダ</a><a href="#">AIINSIDE</a><a href="#">レーザーテック</a><a href="#">FFJ</a>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div class="market_top_upper">
        <div class="indexes_area">
          <h3 style="text-align:center;">日経平均<span style="font-size:12px;font-weight:100;">(15:00)　</span>28.044.45<span style="font-size:12px;font-weight:100;">　前日比 </span><span style="font-size:12px;font-weight:100;color:rgb(0,61,212);">-362.39(-1.28%)</span></h3>
          <div id="index_chart"></div>
          <div class="indexes_list_upper">
            <a href="#">日経平均 </a><p>|<p>
            <a href="#">日経先物</a><p>|<p>
            <a href="#">ダウ平均</a><p>|<p>
            <a href="#">ダウ先物</a><p>|<p>
            <a href="#">マザーズ</a><p>|<p>
            <a href="#">マザーズ先物</a>
          </div>
          <div class="indexes_list_lower">
            <a href="#">ナスダック</a><p>|<p>
            <a href="#">半導体指数</a><p>|<p>
            <a href="#">ドル円</a><p>|<p>
            <a href="#">原油</a><p>|<p>
            <a href="#">金</a>
          </div>
        </div>
        <div class="ranking_area">
          <div class="heading">
            <h3 style="text-align:center;margin:0;">株式ランキング</h3>
            <div class="ranking_kind">
              <button type="button">値上がり率</button>
              <button type="button">値下がり率</button>
              <button type="button">約定回数</button>
              <button type="button">出来高</button>
            </div>
          </div>
          <table class="stock_table">
            <tr>
              <th></th>
              <th>銘柄名</th>
              <th>現在値</th>
              <th>前日比</th>
              <th>値上がり率</th>
            </tr>
            <tr>
              <td style="width:30px;">1</td>
              <td>エンビプロ <span>(5698)</span></td>
              <td>1,105</td>
              <td>+105</td>
              <td>+10.50%</td>
            </tr>
            <tr>
              <td style="width:30px;">2</td>
              <td>テモナ <span>(3985)</span></td>
              <td>1,016</td>
              <td>+76</td>
              <td>+8.09%</td>
            </tr>
            <tr>
              <td style="width:30px;">3</td>
              <td>中発条 <span>(5992)</span></td>
              <td>1,139</td>
              <td>+80</td>
              <td>+7.55%</td>
            </tr>
            <tr>
              <td style="width:30px;">4</td>
              <td>ハークスレイ <span>(7561)</span></td>
              <td>963</td>
              <td>+63</td>
              <td>+7.00%</td>
            </tr>
            <tr>
              <td style="width:30px;">5</td>
              <td>ティラド <span>(7236)</span></td>
              <td>2,494</td>
              <td>+154</td>
              <td>+6.58%</td>
            </tr>
          </table>
          <a href="" class="btn btn-flat"><span>もっと見る</span></a>
        </div>
      </div>
      <div class="market_top_lower">
        <div class="news_area">
          <div class="heading">
            <h3 style="margin:0;">注目ニュース <span>【06/26 15:00 更新】</span></h3>
          </div>
          <ul>
            <div class="news_list"><li>06/26 15:00</li><a href="">東証業種別ランキング: パルプ・紙が下落率トップ</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href="">ソフトバンクGが反落、米ナスダック安で上値の重さ・・・</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href="">今が狙い目の「最高益＆バリュー株」3銘柄厳選!</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href=""><span>決算</span>グロバワン、今期計上は1%減益へ</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href=""><span>決算</span>LIEH、今期経常を7%下方修正</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href=""><span>決算</span>東北新社、前期経常を2.2倍上方修正</a></div>
            <div class="news_list"><li>06/26 15:00</li><a href="">本日の決算一覧</a></div>
          </ul>
          <a href="" class="btn btn-flat"><span>もっと見る</span></a>
        </div>
        <div class="kessan_area">
          <div class="heading">
            <h3 style="text-align:center;margin:0;">決算カレンダー</h3>
            <div class="kessan_kind">
              <button type="button">決算</button>
              <button type="button">月次</button>
            </div>
          </div>
          <div id='calendar'></div>
          <a href="" class="btn btn-flat"><span>もっと見る</span></a>
        </div>
      </div>
      <script language="javascript" type="text/javascript">
        const nikkei_heikins = @json($nikkei_heikins);
        const indexes_volume = @json($indexes_volume);

        function utc2dateString(utc_msec) {
          d=new Date();
          d.setTime(utc_msec);
          return d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate();
        }
        window.addEventListener('load', () => {
        Highcharts.setOptions({
          global: {  // グローバルオプション
            useUTC: false   // GMTではなくJSTを使う
          },
          lang: {  // 言語設定
            months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            weekdays: ['日', '月', '火', '水', '木', '金', '土'],
            numericSymbols: null   // 1000を1kと表示しない
          }
        });
      
        Highcharts.stockChart('index_chart', {
          chart: {
            width: 510,
            height: 240,
          },
          xAxis : {
            width: '90%',
            labels: {
              formatter: function(){ return utc2dateString(this.value); }
            }
          },
          yAxis: [{
            labels: {
              align: 'right',
              x: -3
            },
            height: '70%',
            lineWidth: 2,
            resize: {
              enabled: true
            }
          }, {
            labels: {
              align: 'right',
              x: -3
            },
            top: '75%',
            height: '25%',
            offset: 0,
            lineWidth: 2
          }],
          exporting: {
            enabled: false,
          },
          scrollbar: {
            enabled: false,
          },
          rangeSelector: {
            enabled: true,
            selected : 0,
            inputDateFormat: '%Y/%m/%d',
            inputEditDateFormat: '%Y/%m/%d',
            buttons : [{
              type : 'day', // 分単位 (0)
              count : 90,     // 約 240 分のデータを表示
              text : '3ヶ月'       // ボタンの表示名
            }, {
              type: 'month',
              count: 6,
              text: '6ヶ月',
            }, {
              type : 'year',    // 日単位 (1)
              count : 1,      // 約 90 日のデータを表示
              text : '1年'
            }, {
              type : 'all',    // 全データ (2)
              count : 1,
              text : 'All'
            }]
          },
          navigator: {
            enabled: false,
          },
          plotOptions: {
            candlestick: {
              lineColor: 'rgb(45,96,205)',
              Color: 'rgb(45,96,205)',
              upLineColor: 'rgb(252,131,134)', // docs
              upColor: '#fff'
            }
          },
          series: [
            {
              data: nikkei_heikins,
              id: 'aapl-ohlc',
              name: '日経平均株価',
              type: 'candlestick',
            }, {
              type: 'column',
              id: 'aapl-volume',
              name: 'Volume',
              data: indexes_volume,
              yAxis: 1,
              
            }],
          time: {
            timezoneOffset: (new Date).getTimezoneOffset()
          },
        });
      });
      </script>
    </div>
  </main>
</body>
</html>
