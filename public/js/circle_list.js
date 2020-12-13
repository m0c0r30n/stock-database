$(function(){

  var query = location.search.substring(1).split('&');
  for (var i = 0; i < query.length; i++) {
    var key = query[i].split('=');
    if (key[0] === 'canpas_name') {
      var query_canpas_name = $(`#canpas_name li[value="${key[1]}"]`).text()
      $(".canpas_name_selected").text(query_canpas_name);
      $('input[name="canpas_name"]').val(key[1]);
    } else if (key[0] === 'circle_category') {
      var query_category = $(`#circle_category li[value="${key[1]}"]`).text()
      $(".circle_category_selected").text(query_category);
      $('input[name="circle_category"]').val(key[1]);
    } else if (key[0] === 'free_word') {
      $('input[name="free_word"]').val(decodeURI(key[1]));
    } else if (key[0] === 'group_type%5B%5D') {
      $(`input[value="${key[1]}"]`).prop('checked', true);
    }
  }

    $(".canpas_name_content").hover(function() {
      $(".canpas_name_content .select_list").show();
    }, function() {
      $(".canpas_name_content .select_list").hide();
    });

    $(".circle_category_content").hover(function() {
      $(".circle_category_content .select_list").show();
    }, function() {
      $(".circle_category_content .select_list").hide();
    });

    $(".select_list li").hover(function() {
      $(this).addClass("select_list_on_hover");
    }, function() {
      $(this).removeClass("select_list_on_hover");
    });

    $("#canpas_name li").on('click',function(){
      var canpas_name = $(this).text();
      $(".canpas_name_selected").text(canpas_name);
      $('input[name="canpas_name"]').val($(this).attr("value"));
    });

    $("#circle_category li").on('click',function(){
      var circle_category = $(this).text();
      $(".circle_category_selected").text(circle_category);
      $('input[name="circle_category"]').val($(this).attr("value"));
    });


    $(".execute_search").on('click', function() {
      if ($('input[name="canpas_name"]').val() === '' || $('input[name="canpas_name"]').val() === 'canpas_name_unselected') {
        $('input[name="canpas_name"]').prop('disabled', true);
      }
      if ($('input[name="circle_category"]').val() === '' || $('input[name="circle_category"]').val() === 'circle_category_selected') {
        $('input[name="circle_category"]').prop('disabled', true);
      }
      if ($('input[name="free_word"]').val() === '') {
        $('input[name="free_word"]').prop('disabled', true);
      }
    });

    var circle_name_count = $('.circle_info_name').length;
    for (var i=0;i<circle_name_count;i++) {
      if ($('.circle_info_name').eq(i).text().length > 20) {
        $('.circle_info_name').eq(i).css('font-size', '18px');
      }
    }

});
