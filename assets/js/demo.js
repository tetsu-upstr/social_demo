$(document).ready(function() {

  //プロフィールの投稿ボタン
  $('#submit_profile_post').click(function() {

    $.ajax({
      type: "POST",
      url: "includes/handlers/ajax_submit_profile.php",
      data: $('form.profile_post').serialize(),
      success: function(msg) {
        $("#post_form").modal('hide');
        location.reload();
      },
      error: function() {
        alert('失敗');
      }
    });

  });

});

function getUser(value, user) {
  $.post("includes/handlers/ajax_friend_seach.php", {query:value, userLoggedIn:user}, function(data) {
    // messages.phpの<div class='results'></div>
    $(".results").html(data);
  })
}