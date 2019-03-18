function pass_but() {
  var x = document.getElementById('curr_password');
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function newpass_but() {
  var x = document.getElementById('new_password');
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function repass_but() {
  var x = document.getElementById('renew_password');
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
$(document).ready(function(){
  $("#changepass").click(function(){
    var curr_password = $("#curr_password").val();
    var new_password = $("#new_password").val();
    var renew_password = $("#renew_password").val();
    var user_id = $("#user_id").val();
    var user = $("#username").val();
    var changepass = "true";
    var form_data = {
      curr_password : curr_password,
      new_password : new_password,
      renew_password : renew_password,
      user_id : user_id,
      user : user,
      changepass : changepass
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
      // alert(res);
      if (res == "updated") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Updated password!.',
          type: 'success',
          shadow: true
        });
        $(".input").val("");
      }
      if (res == "blank") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Input all fields!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "min_new_pass_len") {
        var notice = new PNotify({
          title: 'Error',
          text: 'New Password must not be less than 5 characters!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "max_new_pass_len") {
        var notice = new PNotify({
          title: 'Error',
          text: 'New Password must not be greater than 15 characters!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "no_match") {
        var notice = new PNotify({
          title: 'Error',
          text: 'New Password did not match!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "new_pass") {
        var notice = new PNotify({
          title: 'Error',
          text: 'No special characters allowed in New Password!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "retype") {
        var notice = new PNotify({
          title: 'Error',
          text: 'No special characters allowed in Retype Password!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "invalid") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Invalid current password!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "error") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Error occured!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  });
});