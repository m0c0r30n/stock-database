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
    location.href = './'+stock_number;
  });

});