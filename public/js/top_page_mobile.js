$(function(){
  $("#openSidebarMenu").on('click', function() {
    var r = $('input:checked').prop('checked');
    if (r) {
      $('#sidebarMenu').css("transform", "translateX(-250px)");
    } else {
      $('#sidebarMenu').css("transform", "translateX(0)");
    }
  });

  $(".canpas_name_selected").on('click', function(){
    var margin = $(".canpas_name_content p").width()+20;
    var width = $(this).width()+2;
    $("#canpas_name").css({"margin-left": margin, "width": width});
    if ($('#canpas_name li').is(':hidden')) {
      $("#canpas_name").css("border-top", "1px solid #c5c5c5");
      $("#canpas_name").show();
      $(".canpas_name_content .fa-angle-down").css({"transform": "rotateX(180deg)", "transition": "transform 500ms"});
      $("#canpas_name li").slideDown("slow");
    } else {
      $(".fa-angle-down").css({"transform": "rotateX(0)", "transition": "transform 500ms"});
      $("#canpas_name li").slideUp("slow");
      $("#canpas_name").css("border-top", "");
    }
  });

  $(".circle_category_selected").on('click', function(){
    var margin = $(".circle_category_content p").width()+20;
    var width = $(this).width()+2;
    $("#circle_category").css({"margin-left": margin, "width": width});
    if ($('#circle_category li').is(':hidden')) {
      $("#circle_category").css("border-top", "1px solid #c5c5c5");
      $("#circle_category").show();
      $(".circle_category_content .fa-angle-down").css({"transform": "rotateX(180deg)", "transition": "transform 500ms"});
      $("#circle_category li").slideDown("slow");
    } else {
      $(".fa-angle-down").css({"transform": "rotateX(0)", "transition": "transform 500ms"});
      $("#circle_category li").slideUp("slow");
      $("#circle_category").css("border-top", "");
    }
  });

    $("#canpas_name li").on('click',function(){
      var canpas_name = $(this).text();
      $(".canpas_name_selected span").text(canpas_name);
      $('input[name="canpas_name"]').val($(this).attr("value"));
      $(".fa-angle-down").css({"transform": "rotateX(0)", "transition": "transform 500ms"});
      $("#canpas_name li").slideUp("slow");
      $("#canpas_name").css("border-top", "");
    });

    $("#circle_category li").on('click',function(){
      var circle_category = $(this).text();
      $(".circle_category_selected span").text(circle_category);
      $('input[name="circle_category"]').val($(this).attr("value"));
      $(".fa-angle-down").css({"transform": "rotateX(0)", "transition": "transform 500ms"});
      $("#circle_category li").slideUp("slow");
      $("#circle_category").css("border-top", "");
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