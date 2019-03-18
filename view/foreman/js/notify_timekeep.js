function del_msg(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_msg : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        new PNotify({
          title: 'Success',
          text: 'Deleted!',
          type: 'success',
          shadow: true
        });
        $(".msg_"+id).css("background","red");
        $(".msg_"+id).fadeOut(500);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          // text: 'Error!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
$(document).ready(function(){
  $("#sub_eq_given").click(function(){
    var req = $("#eq_given").val();
    var job_req = $("#job_req").val();
    var job_desc = $("#job_desc").val();
    var username = $("#username").val();
    var name = $("#name").val();
    var msg_content = "";
    var msg_title = "";
    var notify_eq_given = "true";
    if (req == "Lack Equipment") {
      msg_title = req;
      msg_content= "Lacking equipment in Job request number "+job_req+" and Job description "+job_desc+".";
      var form_data = {
        job_req : job_req,
        msg_title : msg_title,
        msg_content : msg_content,
        username : username,
        name : name,
        notify_eq_given : notify_eq_given
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "sent") {
            new PNotify({
              title: 'Success',
              text: 'Sent!',
              type: 'success',
              shadow: true
            });
          }
          if (res == "error") {
            new PNotify({
              title: 'Error',
              text: 'Error sending notification to timekeeper!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }else if(req == "Lack Operator") {
      msg_title = req;
      msg_content= "Lacking operator in Job request number "+job_req+" and Job description "+job_desc+".";
      var form_data = {
        job_req : job_req,
        msg_title : msg_title,
        msg_content : msg_content,
        username : username,
        name : name,
        notify_eq_given : notify_eq_given
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "sent") {
            new PNotify({
              title: 'Success',
              text: 'Sent!',
              type: 'success',
              shadow: true
            });
          }
          if (res == "error") {
            new PNotify({
              title: 'Error',
              text: 'Error sending notification to timekeeper!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }else {
      if (req != null && req !="") {
        var favorite = [];
        $.each($("input[name='equipment']:checked"), function(){            
          favorite.push($(this).val());
        });
        msg_title = req;
        msg_content = req+" "+ favorite.join(", ")+ " from job request number "+job_req+" and job description "+job_desc ;
        var form_data = {
          job_req : job_req,
          msg_title : msg_title,
          msg_content : msg_content,
          username : username,
          name : name,
          notify_eq_given : notify_eq_given
        }
        if (favorite.length <= 0) {
          new PNotify({
            title: 'Error',
            text: 'Select an operator!',
            type: 'error',
            shadow: true
          });
        }else {
          $.ajax({
            url : "passer.php",
            type : "POST",
            data : form_data,
            cache : false,
            success : function (res) {
              if (res == "sent") {
                new PNotify({
                  title: 'Success',
                  text: 'Sent!',
                  type: 'success',
                  shadow: true
                });
              }
              if (res == "error") {
                new PNotify({
                  title: 'Error',
                  text: 'Error sending notification to timekeeper!',
                  type: 'error',
                  shadow: true
                });
              }
            }
          });
        }
      }else {
        new PNotify({
          title: 'Error',
          text: 'Select a request!',
          type: 'error',
          shadow: true
        });
      }
    }  
  });



  $("#sub_person_given").click(function(){
    var req = $("#person_given").val();
    var job_req = $("#job_req").val();
    var job_desc = $("#job_desc").val();
    var username = $("#username").val();
    var name = $("#name").val();
    var msg_content = "";
    var msg_title = "";
    var notify_eq_given = "true";
    if (req == "Lack Personnel") {
      msg_title = req;
      msg_content= "Lacking Personnel in Job request number "+job_req+" and Job description "+job_desc+".";
      var form_data = {
        job_req : job_req,
        msg_title : msg_title,
        msg_content : msg_content,
        username : username,
        name : name,
        notify_eq_given : notify_eq_given
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "sent") {
            new PNotify({
              title: 'Success',
              text: 'Sent!',
              type: 'success',
              shadow: true
            });
          }
          if (res == "error") {
            new PNotify({
              title: 'Error',
              text: 'Error sending notification to timekeeper!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }else {
      if (req != null && req !="") {
        var favorite = [];
        $.each($("input[name='personnel']:checked"), function(){            
          favorite.push($(this).val());
        });
        msg_title = req;
        msg_content = req +" "+ favorite.join(", ")+ " from job request number "+job_req+" and job description "+job_desc ;
        var form_data = {
          job_req : job_req,
          msg_title : msg_title,
          msg_content : msg_content,
          username : username,
          name : name,
          notify_eq_given : notify_eq_given
        }
        if (favorite.length <= 0) {
          new PNotify({
            title: 'Error',
            text: 'Select a personnel!',
            type: 'error',
            shadow: true
          });
        }else{
          $.ajax({
            url : "passer.php",
            type : "POST",
            data : form_data,
            cache : false,
            success : function (res) {
              if (res == "sent") {
                new PNotify({
                  title: 'Success',
                  text: 'Sent!',
                  type: 'success',
                  shadow: true
                });
              }
              if (res == "error") {
                new PNotify({
                  title: 'Error',
                  text: 'Error sending notification to timekeeper!',
                  type: 'error',
                  shadow: true
                });
              }
            }
          });
        }
      }else {
        new PNotify({
          title: 'Error',
          text: 'Select a request!',
          type: 'error',
          shadow: true
        });
      }
    }  
  });
});