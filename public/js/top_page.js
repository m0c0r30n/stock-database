$(function(){
  $("#search_stock_number").keypress(function(e){
    if(e.which == 13) {
      if ($("#search_stock_number").val() !=  "") {
        $(".search_stock .fa-search").click();
      }
    }
  });

  $(".search_stock .fa-search").on('click', function(){
    var stock_number = $("#search_stock_number").val();
    location.href = './stockdata/'+stock_number;
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const CustomViewConfig = {
    classNames: ['custom-view'],
    duration: {days: 31},
  };
  
  var calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
      views: {
        custom: CustomViewConfig
      },
      width: 300,
      navLinks: false, 
      locale: 'ja',
  });
  // var calendarEl = document.getElementById('calendar');
  // var calendar = new FullCalendar.Calendar(calendarEl, {
  //   initialView: 'dayGridMonth',
  //   duration: { weeks: 5 },
  //   locale: 'ja'
  // });
  calendar.render();
});