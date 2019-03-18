// delete manpower
function del_user(id) {
  // alert(id);
  var user_del = "true";
  var form_data = {
    id : id,
    user_del : user_del
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      if (res == true) {
        var notice = new PNotify({
          title: 'Success',
          text: 'Deleted successfully!.',
          type: 'success',
          shadow: true
        });
        $(".user_"+id).css("background","red");
        $(".user_"+id).fadeOut(1000);
      }
    }
  });
}
function del_log(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_log : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        // var notice = new PNotify({
        //   title: 'Success',
        //   text: 'Deleted successfully!.',
        //   type: 'success',
        //   shadow: true
        // });
        $(".userlog_"+id).css("background","red");
        $(".userlog_"+id).fadeOut(500);
      }
    }
  });
}

$(document).ready(function(){
  // submit manpower
  $("#submit_user").click(function(){
    var ufname = $("#ufname").val();
    var umname = $("#umname").val();
    var ulname = $("#ulname").val();
    var username = $("#usernames").val();
    var pass = $("#pass").val();
    var r_type = $("#r_type").val();
    var role = $("#role").val();
    var uID = $("#uID").val();
    var user = $("#username").val();
    if (ufname != "" || ulname != "" || username != "" ||
     pass != "" || r_type != "" || role != "") {
      if (ufname != null || ufname != "") {
        var msg = document.getElementById('fname_error');
        msg.innerHTML = "";
      }if (ulname != null || ulname != "") {
        var msg = document.getElementById('lname_error');
        msg.innerHTML = "";
      }if (username != null || username != "") {
        var msg = document.getElementById('user_error');
        msg.innerHTML = "";
      }if (pass != null || pass != "") {
        var msg = document.getElementById('pass_error');
        msg.innerHTML = "";
      }if (r_type != null || r_type != "") {
        var msg = document.getElementById('rtype_error');
        msg.innerHTML = "";
      }if (role != null || role != "") {
        var msg = document.getElementById('role_error');
        msg.innerHTML = "";
      }
    }if (ufname != "" && ulname != "" && username != ""
     && pass != "" && r_type != "" && role != "") {
      if (pass != r_type) {
        var notice = new PNotify({
          title: 'Error',
          text: 'Password did not match!.',
          type: 'error',
          shadow: true
        });
      }else{
        var user_submit = "true";
        var form_data = {
          ufname : ufname,
          umname : umname,
          ulname : ulname,
          username : username,
          pass : pass,
          r_type : r_type,
          uID : uID,
          role : role,
          user : user,
          uID : uID,
          user_submit : user_submit
        }
        $.ajax({
          url : "passer.php",
          type : "POST",
          data : form_data,
          cache : false,
          success : function (res) {
            if (res == "added") {
              var notice = new PNotify({
                title: 'Success',
                text: 'User saved!.',
                type: 'success',
                shadow: true
              });
              $("#modalFull").modal('hide');
              setTimeout(function(){
                window.location.reload(true);
              },1000);
            }
            if (res == "error") {
              var notice = new PNotify({
                title: 'Error',
                text: 'Error, Try again!.',
                type: 'error',
                shadow: true
              });
            }
            if (res == "user_exists") {
              var notice = new PNotify({
                title: 'Error',
                text: 'Username already taken, Try again!.',
                type: 'error',
                shadow: true
              });
            }
            if (res == "user_id_exists") {
              var notice = new PNotify({
                title: 'Error',
                text: 'User ID already taken, Try again!.',
                type: 'error',
                shadow: true
              });
            }
          }
        });
      }
    }else{
      if (ufname == null || ufname == "" || ulname == null || ulname == "" ||
       username == null || username == "" || pass == null || pass == "" || r_type == null ||
       r_type == "" || role == null || role == "") {
        if (ufname == null || ufname == "") {
          var msg = document.getElementById('fname_error');
          msg.innerHTML = "*Input firstname!.";
        }if (ulname == null || ulname == "") {
          var msg = document.getElementById('lname_error');
          msg.innerHTML = "*Input lastname!.";
        }if (username == null || username == "") {
          var msg = document.getElementById('user_error');
          msg.innerHTML = "*Input username!.";
        }if (pass == null || pass == "") {
          var msg = document.getElementById('pass_error');
          msg.innerHTML = "*Input password!.";
        }if (r_type == null || r_type == "") {
          var msg = document.getElementById('rtype_error');
          msg.innerHTML = "*Re-type password!.";
        }if (role == null || role == "") {
          var msg = document.getElementById('role_error');
          msg.innerHTML = "*Select role!.";
        }
      }
    } 
  });
  // update users
  $("#user_update").click(function(){
    var ufname = $("#ufname").val();
    var umname = $("#umname").val();
    var ulname = $("#ulname").val();
    var username = $("#usernames").val();
    var pass = $("#pass").val();
    var r_type = $("#r_type").val();
    var role = $("#role").val();
    var uID = $("#uID").val();
    var acc_stat = $("#acc_stat").val();
    var user_id = $("#user_id").val();
    var user = $("#username").val();
    if (ufname != "" || ulname != "" || username != "" ||
     pass != "" || r_type != "" || role != "" || user_id != "") {
      if (ufname != null || ufname != "") {
        var msg = document.getElementById('fname_error');
        msg.innerHTML = "";
      }if (umname != null || umname != "") {
        var msg = document.getElementById('mname_error');
        msg.innerHTML = "";
      }if (ulname != null || ulname != "") {
        var msg = document.getElementById('lname_error');
        msg.innerHTML = "";
      }if (username != null || username != "") {
        var msg = document.getElementById('user_error');
        msg.innerHTML = "";
      }if (pass != null || pass != "") {
        var msg = document.getElementById('pass_error');
        msg.innerHTML = "";
      }if (r_type != null || r_type != "") {
        var msg = document.getElementById('rtype_error');
        msg.innerHTML = "";
      }if (role != null || role != "") {
        var msg = document.getElementById('role_error');
        msg.innerHTML = "";
      }
    }if (ufname != "" && ulname != "" && username != ""
     && pass != "" && r_type != "" && role != "" && user_id != "") {
      if (pass != r_type) {
        var notice = new PNotify({
          title: 'Error',
          text: 'Password did not match!.',
          type: 'error',
          shadow: true
        });
      }else{
        var user_update = "true";
        var form_data = {
          ufname : ufname,
          umname : umname,
          ulname : ulname,
          username : username,
          pass : pass,
          role : role,
          acc_stat : acc_stat,
          user_id : user_id,
          uID : uID,
          user : user,
          user_update : user_update
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
                text: 'Updated successfully!.',
                type: 'success',
                shadow: true
              });
              setTimeout(function(){
                window.location.reload(true);
              },1000);
            }
            if (res == "error") {
              var notice = new PNotify({
                title: 'Error',
                text: 'Error on updating!.',
                type: 'error',
                shadow: true
              });
            }
          }
        });
      }
    }else{
      if (ufname == null || ufname == "" || ulname == null || ulname == "" || username == null || username == ""
        || pass == null || pass == "" || r_type == null || r_type == "" 
        || role == null || role == "") {
        if (ufname == null || ufname == "") {
          var msg = document.getElementById('fname_error');
          msg.innerHTML = "*Input firstname!.";
        }
        if (ulname == null || ulname == "") {
          var msg = document.getElementById('lname_error');
          msg.innerHTML = "*Input lastname!.";
        }if (username == null || username == "") {
          var msg = document.getElementById('user_error');
          msg.innerHTML = "*Input username!.";
        }if (pass == null || pass == "") {
          var msg = document.getElementById('pass_error');
          msg.innerHTML = "*Input password!.";
        }if (r_type == null || r_type == "") {
          var msg = document.getElementById('rtype_error');
          msg.innerHTML = "*Re-type password!.";
        }if (role == null || role == "") {
          var msg = document.getElementById('role_error');
          msg.innerHTML = "*Select role!.";
        }
      }
    } 
  });

});
