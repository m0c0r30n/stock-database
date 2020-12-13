$(function(){
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
    //   var canpas_name_selected = $('.canpas_name_selected').text();
    //   var circle_category_selected = $('.circle_category_selected').text();
    //   var free_word = $('.free_word_content input').val();

    //   var all_on_canpas_checked = $('#all_on_canpas:checked').val();
    //   var incare_checked = $('#incare:checked').val();
    //   var ex_activity = $('#ex_activity:checked').val();

    //   $.ajax({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }, 
    //     url:'/list',
    //     type:'POST',
    //     data:{
    //       "canpas_name_selected":canpas_name_selected,
    //       "circle_category_selected":circle_category_selected,
    //       "free_word": free_word,
    //       "all_on_canpas_checked":all_on_canpas_checked,
    //       "incare_checked": incare_checked,
    //       "ex_activity": ex_activity,
    //     }
    //   }).done(function(data){
    //     console.log(data);
    //   });
        
    // });

    var circle_name_count = $('.circle_info_name').length;
    for (var i=0;i<circle_name_count;i++) {
      if ($('.circle_info_name').eq(i).text().length > 20) {
        $('.circle_info_name').eq(i).css('font-size', '18px');
      }
    }

});