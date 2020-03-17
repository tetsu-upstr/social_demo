$(document).ready(function() {

  // クリックでログインフォームを隠して、登録フォームを表示
  $("#signup").click(function() {
    $("#first").slideUp("slow", function() {
      $("#second").slideDown("slow");
    });
  });

  // クリックで登録フォームを隠して、ログインフォームを表示
  $("#signin").click(function() {
     $("#second").slideUp("slow", function() {
       $("#first").slideDown("slow");
     });
  });

});