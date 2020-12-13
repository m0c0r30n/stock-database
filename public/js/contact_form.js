$(function(){
  $("#openSidebarMenu").on('click', function() {
    var r = $('input:checked').prop('checked');
    if (r) {
      $('#sidebarMenu').css("transform", "translateX(-250px)");
    } else {
      $('#sidebarMenu').css("transform", "translateX(0)");
    }
  });
  
  if ($("#InputTwitterid").val() === '') {
    $("#InputTwitterid").val('@');
  }

  $("#link").click(function() {
      window.location.href = '/contact';
  });
  
});