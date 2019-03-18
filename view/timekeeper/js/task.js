// delete manpower
function del_task(id) {
  // alert(id);
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_task : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Deleted successfully!.',
          type: 'success',
          shadow: true
        });
        $(".task_"+id).css("background","red");
        $(".task_"+id).fadeOut(1000);
      }
    }
  });
}


$(document).ready(function(){
	$("#submit_task").click(function(){
		var task = $("#task").val();
   var task_for = $("#task_for").val();
   var task_id = $("#task_id").val();
   var username = $("#username").val();
   if (task != "" || task_for != "" || task_id != "") {
    if (task != null || task != "") {
      var msg = document.getElementById('task_error');
      msg.innerHTML = "";
    }
    if (task_for != null || task_for != "") {
      var msg = document.getElementById('task_for_error');
      msg.innerHTML = "";
    }
  }if (task != "" && task_for != "" && task_id != "") {
    var submit_task = "true";
    var form_data = {
      task : task,
      task_for : task_for,
      task_id : task_id,
      username : username,
      submit_task : submit_task
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
       if (res == "true") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Added Successfully!.',
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
          text: 'Error occured!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }else{
    if (task == null || task == "" || task_for == null || task_for == "" || task_id == null || task_id == "") {
      if (task == null || task == "") {
        var msg = document.getElementById('task_error');
        msg.innerHTML = "*Input task!.";
      }
      if (task_for == null || task_for == "") {
        var msg = document.getElementById('task_for_error');
        msg.innerHTML = "*Select task for!.";
      }
      if (task_id == null || task_id == "") {
        new PNotify({
         title: 'Error',
         text: 'Select a job request!.',
         type: 'error',
         shadow: true
       });
      }
    }
  } 
});

	$("#update_task").click(function(){
		var task = $("#task").val();
   var task_for = $("#task_for").val();
   var task_id = $("#task_id").val();
   var username = $("#username").val();
   if (task != "" || task_for != "" || task_id != "") {
    if (task != null || task != "") {
      var msg = document.getElementById('task_error');
      msg.innerHTML = "";
    }
    if (task_for != null || task_for != "") {
      var msg = document.getElementById('task_for_error');
      msg.innerHTML = "";
    }
  }if (task != "" && task_for != "" && task_id != "") {
    var update_task = "true";
    var form_data = {
      task : task,
      task_for : task_for,
      task_id : task_id,
      username : username,
      update_task : update_task
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
       if (res == "updated") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Updated Successfully!.',
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
          text: 'Error occured!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }else{
    if (task == null || task == "" || task_for == null || task_for == "" || task_id == null || task_id == "") {
      if (task == null || task == "") {
        var msg = document.getElementById('task_error');
        msg.innerHTML = "*Input task!.";
      }
      if (task_for == null || task_for == "") {
        var msg = document.getElementById('task_for_error');
        msg.innerHTML = "*Select task for!.";
      }
    }
  } 
});
});