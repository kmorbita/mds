function per_work_start(id) {
	// alert(id);
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter a reason to proceed");
    } else {
     var task_id = $("#task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var form_data = {
      per_work_start : id,
      task_id : task_id,
      timestamp : timestamp,
      user : user,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "started") {
    		new PNotify({
    			title: 'Success',
    			text: 'Working!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "not_started") {
    		new PNotify({
    			title: 'Error',
    			text: 'Task not started!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function per_work_pause(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter a reason to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var form_data = {
      per_work_pause : id,
      timestamp : timestamp,
      req : req,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "paused") {
    		new PNotify({
    			title: 'Success',
    			text: 'Paused!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function per_work_stop(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (reason == null || reason == "" && timestamp == null || timestamp == "") {
      if (reason == null || reason == "") {
        alert("Enter a reason to proceed");
      }
      if (timestamp == null || timestamp == "") {
        alert("Enter date and time to proceed");
      }
    } else {
      var user = $("#username").val();
      var req = $("#req_no").val();
      var form_data = {
       per_work_stop : id,
       reason : reason,
       timestamp : timestamp,
       req : req,
       user : user
     }
     $.ajax({
       url : "passer.php",
       type : "POST",
       data : form_data,
       cache : false,
       success : function (res) {
    	// alert(res);
    	if (res == "stopped") {
    		new PNotify({
    			title: 'Success',
    			text: 'Stopped!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
   }
 }

 function per_work_continue(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var task_id = $("#task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var form_data = {
      per_work_continue : id,
      task_id : task_id,
      timestamp : timestamp,
      user : user,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
			// alert(res);
			if (res == "continued") {
				new PNotify({
					title: 'Success',
					text: 'Continued!',
					type: 'success',
					shadow: true
				});
				setTimeout(function(){
					window.location.reload(true);
				},1000);
			}
			if (res == "error") {
				new PNotify({
					title: 'Error',
					text: 'error occured!',
					type: 'error',
					shadow: true
				});
			}
			if (res == "closed") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently closed!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "cancelled") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently cancelled!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "completed") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently completed!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "not_started") {
        new PNotify({
          title: 'Error',
          text: 'Task not started!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}
function per_work_complete(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var form_data = {
      per_work_complete : id,
      timestamp : timestamp,
      req : req,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "complete") {
    		new PNotify({
    			title: 'Success',
    			text: 'Completed!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}


function per_delete(id) {
  var req = $("#req_no").val();
  var form_data = {
    per_delete : id,
    req : req
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
    	// alert(res);
    	if (res == "deleted") {
    		new PNotify({
    			title: 'Success',
    			text: 'Deleted!',
    			type: 'success',
    			shadow: true
    		});
    		$(".per_"+id).css("background","red");
    		$(".per_"+id).fadeOut(1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
  });
}










function optr_work_start(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var task_id = $("#optr_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var form_data = {
      optr_work_start : id,
      task_id : task_id,
      timestamp : timestamp,
      user : user,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "started") {
    		new PNotify({
    			title: 'Success',
    			text: 'Working!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "not_started") {
    		new PNotify({
    			title: 'Error',
    			text: 'Task not started!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function optr_work_pause(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var form_data = {
      optr_work_pause : id,
      req : req,
      timestamp : timestamp,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "paused") {
    		new PNotify({
    			title: 'Success',
    			text: 'Paused!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function optr_work_stop(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (reason == null || reason == "" && timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
      var user = $("#username").val();
      var req = $("#req_no").val();
      var form_data = {
       optr_work_stop : id,
       reason : reason,
       timestamp : timestamp,
       req : req,
       user : user
     }
     $.ajax({
       url : "passer.php",
       type : "POST",
       data : form_data,
       cache : false,
       success : function (res) {
    	// alert(res);
    	if (res == "stopped") {
    		new PNotify({
    			title: 'Success',
    			text: 'Stopped!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
   }
 }

 function optr_work_continue(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var task_id = $("#optr_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var form_data = {
      optr_work_continue : id,
      task_id : task_id,
      timestamp : timestamp,
      user : user,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
			// alert(res);
			if (res == "continued") {
				new PNotify({
					title: 'Success',
					text: 'Continued!',
					type: 'success',
					shadow: true
				});
				setTimeout(function(){
					window.location.reload(true);
				},1000);
			}
			if (res == "error") {
				new PNotify({
					title: 'Error',
					text: 'error occured!',
					type: 'error',
					shadow: true
				});
			}
			if (res == "closed") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently closed!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "cancelled") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently cancelled!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "completed") {
        new PNotify({
         title: 'Error',
         text: 'Job is currently completed!',
         type: 'error',
         shadow: true
       });
      }
      if (res == "not_started") {
        new PNotify({
          title: 'Error',
          text: 'Task not started!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function optr_work_complete(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var form_data = {
      optr_work_complete : id,
      req : req,
      timestamp : timestamp,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
    	// alert(res);
    	if (res == "complete") {
    		new PNotify({
    			title: 'Success',
    			text: 'Completed!',
    			type: 'success',
    			shadow: true
    		});
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}


function optr_delete(id) {
  var req = $("#req_no").val();
  var form_data = {
    optr_delete : id,
    req : req
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
    	// alert(res);
    	if (res == "deleted") {
    		new PNotify({
    			title: 'Success',
    			text: 'Deleted!',
    			type: 'success',
    			shadow: true
    		});
    		$(".optr_"+id).css("background","red");
    		$(".optr_"+id).fadeOut(1000);
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
    			text: 'error occured!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
  });
}














function add_personnel_task(id) {
	$(document).ready(function(){
		// alert(id);
		var temp_des = $("#per_"+id+"_temp_des").val();
		var user = $("#username_session").val();
		var req_no = $("#req_no").val();
		var add_personnel_task = "true";
		var form_data = {
			temp_des : temp_des,
			id : id,
			user : user,
			req_no : req_no,
			add_personnel_task : add_personnel_task
		}
   $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
	    	// alert(res);
	    	if (res == "added") {
	    		new PNotify({
	    			title: 'Success',
	    			text: 'Personnel added!',
	    			type: 'success',
	    			shadow: true
	    		});
	    	}
	    	if (res == "pending") {
	    		new PNotify({
	    			title: 'Error',
	    			text: 'Operator has task pending!',
	    			type: 'error',
	    			shadow: true
	    		});
	    	}
	    	if (res == "error") {
	    		new PNotify({
	    			title: 'Error',
		      // text: '!',
		      type: 'error',
		      shadow: true
        });
	    	}
	    	if (res == "closed") {
          new PNotify({
           title: 'Error',
           text: 'Job is currently closed!',
           type: 'error',
           shadow: true
         });
        }
        if (res == "cancelled") {
          new PNotify({
           title: 'Error',
           text: 'Job is currently cancelled!',
           type: 'error',
           shadow: true
         });
        }
        if (res == "completed") {
          new PNotify({
           title: 'Error',
           text: 'Job is currently completed!',
           type: 'error',
           shadow: true
         });
        }
      }
    });
 });
}

function add_operator_task(id) {
	$(document).ready(function(){
		// alert(id);
		var temp_des = $("#eqpt_"+id+"_temp_des2").val();
		var user = $("#username_session").val();
		var req_no = $("#req_no").val();
		var add_operator_task = "true";
		var form_data = {
			temp_des : temp_des,
			id : id,
			user : user,
			req_no : req_no,
			add_operator_task : add_operator_task
		}
   $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
    	// alert(res);
    	if (res == "added") {
    		new PNotify({
    			title: 'Success',
    			text: 'Operator added!',
    			type: 'success',
    			shadow: true
    		});
    	}
    	if (res == "pending") {
    		new PNotify({
    			title: 'Error',
    			text: 'Operator has task pending!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "error") {
    		new PNotify({
    			title: 'Error',
	      // text: '!',
	      type: 'error',
	      shadow: true
     });
    	}
    	if (res == "closed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently closed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "cancelled") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently cancelled!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "completed") {
    		new PNotify({
    			title: 'Error',
    			text: 'Job is currently completed!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
  });
 });
}
$(document).ready(function(){
	$("#personnel_activity_close").click(function(){
		$("#personnel_activity").modal("hide");
		window.location.reload(true);
	});
	$("#personnel_activity_close2").click(function(){
		$("#personnel_activity").modal("hide");
		window.location.reload(true);
	});
	$("#operator_activity_close").click(function(){
		$("#operator_activity").modal("hide");
		window.location.reload(true);
	});
	$("#operator_activity_close2").click(function(){
		$("#operator_activity").modal("hide");
		window.location.reload(true);
	});
  $("#equipment_activity_close").click(function(){
    $("#equipment_activity").modal("hide");
    window.location.reload(true);
  });
  $("#equipment_activity_close2").click(function(){
    $("#equipment_activity").modal("hide");
    window.location.reload(true);
  });
});

function optr_relieve(id) {
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var req = $("#job_req").val();
		var user = $("#username").val();
		var optr_relieve = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
			optr_relieve : optr_relieve
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		    	// alert(res);
		    	if (res == "relieved") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Operator relieved!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
		    }
      });
	}
}
function optr_reject(id) {
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var req = $("#job_req").val();
		var user = $("#username").val();
		var optr_reject = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
			optr_reject : optr_reject
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		    	// alert(res);
		    	if (res == "rejected") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Operator rejected!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
		    }
      });
	}
}

// function per_relieve(id) {
// 	var reason = prompt("Please enter your reason:", "");
// 	if (reason == null || reason == "") {
// 		alert("Enter a reason to proceed");
// 	} else {
// 		var notes = reason;
// 		var req = $("#job_req").val();
// 		var user = $("#username").val();
// 		var per_relieve = id;
// 		var form_data = {
// 			user : user,
// 			req : req,
// 			notes : notes,
// 			per_relieve : per_relieve
// 		}
// 		$.ajax({
// 			url : "passer.php",
// 			type : "POST",
// 			data : form_data,
// 			cache : false,
// 			success : function (res) {
// 		    	// alert(res);
// 		    	if (res == "relieved") {
// 		    		var notice = new PNotify({
// 		    			title: 'Success',
// 		    			text: 'Personnel relieved!',
// 		    			type: 'success',
// 		    			shadow: true
// 		    		});
// 		    		setTimeout(function(){
// 		    			window.location.reload(true);
// 		    		},1000);
// 		    	}
// 		    	if (res == "error") {
// 		    		var notice = new PNotify({
// 		    			title: 'Error',
// 		    			text: 'Error occured!',
// 		    			type: 'error',
// 		    			shadow: true
// 		    		});
// 		    	}
// 		    }
// 		});
// 	}
// }
// function per_reject(id) {
// 	var reason = prompt("Please enter your reason:", "");
// 	if (reason == null || reason == "") {
// 		alert("Enter a reason to proceed");
// 	} else {
// 		var notes = reason;
// 		var req = $("#job_req").val();
// 		var user = $("#username").val();
// 		var per_reject = id;
// 		var form_data = {
// 			user : user,
// 			notes : notes,
// 			req : req,
// 			per_reject : per_reject
// 		}
// 		$.ajax({
// 			url : "passer.php",
// 			type : "POST",
// 			data : form_data,
// 			cache : false,
// 			success : function (res) {
// 		    	// alert(res);
// 		    	if (res == "rejected") {
// 		    		var notice = new PNotify({
// 		    			title: 'Success',
// 		    			text: 'Personnel rejected!',
// 		    			type: 'success',
// 		    			shadow: true
// 		    		});
// 		    		setTimeout(function(){
// 		    			window.location.reload(true);
// 		    		},1000);
// 		    	}
// 		    	if (res == "error") {
// 		    		var notice = new PNotify({
// 		    			title: 'Error',
// 		    			text: 'Error occured!',
// 		    			type: 'error',
// 		    			shadow: true
// 		    		});
// 		    	}
// 		    }
// 		});
// 	}
// }



















// task stopped,working,completed in personnel activity
function per_task_work(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var req = $("#req_no").val();
     var user = $("#username").val();
     var per_task_work = "true";
     var form_data = {
      req : req,
      per_task_work : per_task_work,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "working") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Started Working!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}
function per_task_stop(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (reason == null || reason == "" && timestamp == null || timestamp == "") {
      if (reason == null || reason == "") {
        alert("Enter a reason to proceed");
      }
      if (timestamp == null || timestamp == "") {
        alert("Enter date and time to proceed");
      }
    } else {
      var per_task_id = $("#per_task_id_"+id).val();
      var req = $("#req_no").val();
      var user = $("#username").val();
      var per_task_stop = "true";
      var form_data = {
       req : req,
       reason : reason,
       per_task_id : per_task_id,
       per_task_stop : per_task_stop,
       timestamp : timestamp,
       user : user,
       id : id
     }
     $.ajax({
       url : "passer.php",
       type : "POST",
       data : form_data,
       cache : false,
       success : function (res) {
		    	// alert(res);
		    	if (res == "stopped") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Stopped!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
   }
 }
 function per_task_complete(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var per_task_id = $("#per_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var per_task_complete = "true";
     var form_data = {
      req : req,
      per_task_id : per_task_id,
      per_task_complete : per_task_complete,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "completed") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Completed!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}
function per_task_resume(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var req = $("#req_no").val();
     var user = $("#username").val();
     var per_task_resume = "true";
     var form_data = {
      req : req,
      per_task_resume : per_task_resume,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "resumed") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Resumed!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
		    	if (res == "not_started") {
		    		new PNotify({
		    			title: 'Error',
		    			text: 'Task paused!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}


function per_task_pause(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var per_task_id = $("#per_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var per_task_pause = "true";
     var form_data = {
      req : req,
      per_task_id : per_task_id,
      per_task_pause : per_task_pause,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
			// alert(res);
			if (res == "paused") {
				var notice = new PNotify({
					title: 'Success',
					text: 'Task Paused!',
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
					text: 'Error occured!',
					type: 'error',
					shadow: true
				});
			}
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}




function optr_task_work(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var req = $("#req_no").val();
     var user = $("#username").val();
     var optr_task_work = "true";
     var form_data = {
      req : req,
      optr_task_work : optr_task_work,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "working") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Started Working!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}

function optr_task_pause(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var eqpt_task_id = $("#eqpt_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var optr_task_pause = "true";
     var form_data = {
      req : req,
      eqpt_task_id : eqpt_task_id,
      optr_task_pause : optr_task_pause,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "paused") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Paused!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}


function optr_task_stop(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \n Datetime format (YYYY-MM-DD hr:min:sec) time is 24 hr. format::", datetime);
    if (reason == null || reason == "" && timestamp == null || timestamp == "") {
      if (reason == null || reason == "") {
        alert("Enter a reason to proceed");
      }
      if (timestamp == null || timestamp == "") {
        alert("Enter date and time to proceed");
      }
    } else {
      var eqpt_task_id = $("#eqpt_task_id_"+id).val();
      var req = $("#req_no").val();
      var user = $("#username").val();
      var optr_task_stop = "true";
      var form_data = {
       req : req,
       reason : reason,
       eqpt_task_id : eqpt_task_id,
       optr_task_stop : optr_task_stop,
       user : user,
       id : id
     }
     $.ajax({
       url : "passer.php",
       type : "POST",
       data : form_data,
       cache : false,
       success : function (res) {
		    	// alert(res);
		    	if (res == "stopped") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Stopped!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
   }
 }
 function optr_task_complete(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter a reason to proceed");
    } else {
     var eqpt_task_id = $("#eqpt_task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var optr_task_complete = "true";
     var form_data = {
      req : req,
      eqpt_task_id : eqpt_task_id,
      optr_task_complete : optr_task_complete,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "completed") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Started Completed!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}
function optr_task_resume(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter a reason to proceed");
    } else {
     var req = $("#req_no").val();
     var user = $("#username").val();
     var optr_task_resume = "true";
     var form_data = {
      req : req,
      optr_task_resume : optr_task_resume,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
		    	// alert(res);
		    	if (res == "resumed") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Task Resumed!',
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
		    			text: 'Error occured!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
		    	if (res == "not_started") {
		    		new PNotify({
		    			title: 'Error',
		    			text: 'Task paused!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}


function per_task_del(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {per_task_del : id},
		cache : false,
		success : function (res) {
			// alert(res);
			if (res == "deleted") {
				new PNotify({
					title: 'Success',
					text: 'Task Deleted!',
					type: 'success',
					shadow: true
				});
				setTimeout(function(){
					window.location.reload(true);
				},1000);
			}
			if (res == "error") {
				new PNotify({
					title: 'Error',
					text: 'Error occured!',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}
function eqpt_task_del(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {eqpt_task_del : id},
		cache : false,
		success : function (res) {
			// alert(res);
			if (res == "deleted") {
				new PNotify({
					title: 'Success',
					text: 'Task Deleted!',
					type: 'success',
					shadow: true
				});
				setTimeout(function(){
					window.location.reload(true);
				},1000);
			}
			if (res == "error") {
				new PNotify({
					title: 'Error',
					text: 'Error occured!',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}
function operator_act(id) {
  var req = $("#job_req").val();
  var operator_act = "true";
  var form_data = {
    req : req,
    operator_act : operator_act,
    emp_id : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
      // console.log(arr)
      $("#optr_id").val(arr.emp_id);
      $("#optr_task").val(arr.task);
      $("#optr_name").val(arr.fname+" "+arr.mname+" "+arr.lname);
      var html = "";
      var i=1;
      arr.optr_act.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="<td>"+item.reason+"</td>";
        html+="</tr>";
        i++;
      });
      $("#optr_modal").html(html);
      $("#operator_modal").modal("show");
    }
  });
}

function personnel_act(id) {
  var req = $("#job_req").val();
  var personnel_act = "true";
  var form_data = {
    req : req,
    personnel_act : personnel_act,
    emp_id : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
      // console.log(arr)
      $("#per_id").val(arr.emp_id);
      $("#per_task").val(arr.task);
      // alert(arr.task);
      $("#per_name").val(arr.fname+" "+arr.mname+" "+arr.lname);
      var html = "";
      var i=1;
      arr.per_act.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="<td>"+item.reason+"</td>";
        html+="</tr>";
        i++;
      });
      $("#per_modal").html(html);
      $("#personnel_modal").modal("show");
    }
  });
}
function per_task_act(req,task) {
  var per_task_act = "true";
  var form_data = {
    req : req,
    per_task_act : per_task_act,
    task : task
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
            var html = "";
            $("#per_task_status").val(arr.status);
            $("#per_task_name").val(arr.task);
            var i=1;
            arr.per_arr.forEach(function(item){
              html+="<tr class='gradeX'>";
              html+="<td>"+item.status+"</td>";
              html+="<td>"+item.work_started+"</td>";
              html+="<td>"+item.work_stopped+"</td>";
              html+="<td>"+item.work_resumed+"</td>";
              html+="<td>"+item.work_completed+"</td>";

              html+="</tr>";
              i++;
            });
            $("#per_task_modal").html(html);
            $("#per_task_acts").modal("show");
          }
        });
}

function optr_task_act(req,task) {
    // alert(task);
    var optr_task_act = "true";
    var form_data = {
      req : req,
      optr_task_act : optr_task_act,
      task : task
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
            var html = "";
            $("#optr_task_status").val(arr.status);
            $("#optr_task_name").val(arr.task);
            var i=1;
            arr.optr_arr.forEach(function(item){
              html+="<tr class='gradeX'>";
              html+="<td>"+item.status+"</td>";
              html+="<td>"+item.work_started+"</td>";
              html+="<td>"+item.work_stopped+"</td>";
              html+="<td>"+item.work_resumed+"</td>";
              html+="<td>"+item.work_completed+"</td>";
              html+="</tr>";
              i++;
            });
            $("#optr_task_modal").html(html);
            $("#optr_task_acts").modal("show");
          }
        });
  }
  function personnel_table_task(id) {
    $("#to_per_task").val(id);
    $("#per_task_list").modal('show');
  }




  function eq_work(id) {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var req = $("#req_no").val();
     var user = $("#username").val();
     var eq_work = "true";
     var form_data = {
      req : req,
      eq_work : eq_work,
      timestamp : timestamp,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
          // alert(res);
          if (res == "working") {
            var notice = new PNotify({
              title: 'Success',
              text: 'Equipment Started Working!',
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
              text: 'Error occured!',
              type: 'error',
              shadow: true
            });
          }
          if (res == "date") {
            new PNotify({
              title: 'Error',
              text: 'Invalid Date, Try again!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
  }
}




function eq_pause(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter a reason to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var eq_pause = "true";
     var form_data = {
      eq_pause : eq_pause,
      timestamp : timestamp,
      user : user,
      req : req,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
      // alert(res);
      if (res == "paused") {
        new PNotify({
          title: 'Success',
          text: 'Paused!',
          type: 'success',
          shadow: true
        });
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'error occured!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}

function eq_stop(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "" || reason == null || reason == "") {
      if (timestamp == null || timestamp == "") {
        alert("Enter date and time to proceed");
      }
      if (reason == null || reason == "") {
        alert("Enter a reason to proceed");
      }
    } else {
      var user = $("#username").val();
      var req = $("#req_no").val();
      var eq_stop = "true";
      var form_data = {
       id : id,
       reason : reason,
       timestamp : timestamp,
       eq_stop : eq_stop,
       req : req,
       user : user
     }
     $.ajax({
       url : "passer.php",
       type : "POST",
       data : form_data,
       cache : false,
       success : function (res) {
      // alert(res);
      if (res == "stopped") {
        new PNotify({
          title: 'Success',
          text: 'Stopped!',
          type: 'success',
          shadow: true
        });
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'error occured!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
   }
 }

 function eq_complete(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enter date and time to proceed");
    } else {
     var task_id = $("#task_id_"+id).val();
     var req = $("#req_no").val();
     var user = $("#username").val();
     var eq_complete = "true";
     var form_data = {
      id : id,
      task_id : task_id,
      eq_complete : eq_complete,
      timestamp : timestamp,
      user : user,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
     // alert(res);
     if (res == "completed") {
      new PNotify({
       title: 'Success',
       text: 'Completed!',
       type: 'success',
       shadow: true
     });
      setTimeout(function(){
       window.location.reload(true);
     },1000);
    }
    if (res == "error") {
      new PNotify({
       title: 'Error',
       text: 'error occured!',
       type: 'error',
       shadow: true
     });
    }
    if (res == "date") {
      new PNotify({
        title: 'Error',
        text: 'Invalid Date, Try again!',
        type: 'error',
        shadow: true
      });
    }
  }
});
  }
}
function eq_resume(id) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (timestamp == null || timestamp == "") {
      alert("Enterdate and time to proceed");
    } else {
     var user = $("#username").val();
     var req = $("#req_no").val();
     var eq_resume = "true";
     var form_data = {
      id : id,
      timestamp : timestamp,
      user : user,
      eq_resume : eq_resume,
      req : req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
      // alert(res);
      if (res == "resumed") {
        new PNotify({
          title: 'Success',
          text: 'Continued!',
          type: 'success',
          shadow: true
        });
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'error occured!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
  }
}
function equipment_act(id) {
  var req = $("#job_req").val();
  var form_data = {
    req : req,
    equipment_act : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
        // alert(res);
        var i = 1;
        var arr = JSON.parse(res);
        var html = "";
        $("#equipment").val(arr.eqpt_name);
        var i=1;
        arr.eqpt_act.forEach(function(item){
          html+="<tr class='gradeX'>";
          html+="<td>"+item.status+"</td>";
          html+="<td>"+item.work_started+"</td>";
          html+="<td>"+item.work_stopped+"</td>";
          html+="<td>"+item.work_resumed+"</td>";
          html+="<td>"+item.work_completed+"</td>";
          html+="<td>"+item.reason+"</td>";
          html+="</tr>";
          i++;
        });
        $("#equipment_modal_data").html(html);
        $("#equipment_modal").modal("show");
      }
    });
}



function eq_relieve(eq) {
  var today = new Date();
  var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    if (reason == null || reason == "" && timestamp == null || timestamp == "") {
      if (reason == null || reason == "") {
       alert("Enter a reason to proceed");
     }
     if (timestamp == null || timestamp == "") {
       alert("Enter date and time to proceed");
     }
   } else {
    var req = $("#req_no").val();
    var user = $("#username").val();
    var eq_relieve = "true";
    var form_data = {
      req : req,
      reason : reason,
      timestamp : timestamp,
      eq_code : eq,
      user : user,
      eq_relieve : eq_relieve
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        // alert(res);
        if (res == "relieved") {
          new PNotify({
            title: 'Success',
            text: 'Equipment Relieved!',
            type: 'success',
            shadow: true
          });
          setTimeout(function(){
            window.location.reload(true);
          },1000);
        }
        if (res == "error") {
          new PNotify({
            title: 'Error',
            text: 'Error occured, Try again!',
            type: 'error',
            shadow: true
          });
        }
      }
    });
  }
}


function eq_delete(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {eq_delete : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        new PNotify({
          title: 'Success',
          text: 'Equipment deleted!',
          type: 'success',
          shadow: true
        });
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'error occured!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}


function add_equipment(id) {
  var reason = prompt("Please enter your reason:", "");
  if (reason == null || reason == "") {
   alert("Enter a reason to proceed");
 }else {
  var req = $("#req_no").val();
  var user = $("#username").val();
  var no_eqpt = $("#no_eqpt_"+id).val();
  var no_optr = $("#no_optr_"+id).val();
  if (no_eqpt == null || no_eqpt == "" || no_optr == null || no_optr == "") {
    if (no_eqpt == null || no_eqpt == "") {
      new PNotify({
        title: 'Error',
        text: 'Input number of equipment needed!',
        type: 'error',
        shadow: true
      });
    }
    if (no_optr == null || no_optr == "") {
      new PNotify({
        title: 'Error',
        text: 'Select if operator is needed or not!',
        type: 'error',
        shadow: true
      });
    }
  }else{
    var add_equipment = "true";
    var form_data = {
      req : req,
      reason : reason,
      add_equipment : add_equipment,
      no_eqpt : no_eqpt,
      no_optr : no_optr,
      user : user,
      id : id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        if (res == "added") {
          new PNotify({
            title: 'Success',
            text: 'Equipment Added!',
            type: 'success',
            shadow: true
          });
        }
        if (res == "error") {
          new PNotify({
            title: 'Error',
            text: 'error occured!',
            type: 'error',
            shadow: true
          });
        }
        if (res == "exist") {
          new PNotify({
            title: 'Error',
            text: 'Equipment Already Added!',
            type: 'error',
            shadow: true
          });
        }
      }
    });
  }
}
}























function fill_eqpt_needed(eq_type,no_eqpt,no_optr) {
  var req = $("#job_req").val();
  var user = $("#username").val();
  var fill_eqpt_needed = "true";
  var form_data = {
    req : req,
    user : user,
    eq_type : eq_type,
    no_eqpt : no_eqpt,
    no_optr : no_optr,
    fill_eqpt_needed : fill_eqpt_needed
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
        // alert(res);
        var i = 1;
        var arr = JSON.parse(res);
        var html = "";
        $("#no_optr").val(no_optr);
        $("#no_eqpt").val(no_eqpt);
        $("#eqpt_type_id").val(eq_type);
        var i=1;
        arr.forEach(function(item){
          html+="<tr class='gradeX'>";
          html+="<td><button type='button' class='btn btn-info btn-xs fa fa-plus' onclick='add_equipment_needed("+item.id+")'></button></td>";
          html+="<td>"+item.eqpt_name+"</td>";
          html+="</tr>";
          i++;
        });
        $("#equipment_data").html(html);
        $("#equipment_data_modal").modal("show");
      }
    });
}
function add_equipment_needed(id) {
  var reason = prompt("Please enter your reason:", "");
  if (reason == null || reason == "") {
   alert("Enter a reason to proceed");
 }else {
  var no_optr = $("#no_optr").val();
  var no_eqpt = $("#no_eqpt").val();
  var user = $("#username").val();
  var req = $("#req_no").val();
  var eqpt_type = $("#eqpt_type_id").val();
  var add_equipment_needed = "true";
  var form_data = {
    eq_code : id,
    no_optr : no_optr,
    reason : reason,
    eqpt_type : eqpt_type,
    user : user,
    req : req,
    add_equipment_needed : add_equipment_needed,
    no_eqpt : no_eqpt
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "added") {
        new PNotify({
          title: 'Success',
          text: 'Equipment Added!',
          type: 'success',
          shadow: true
        });
        // setTimeout(function(){
        //   window.location.reload(true);
        // },1000);
      }
      if (res == "exist") {
        new PNotify({
          title: 'Error',
          text: 'Equipment Already Exist!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'Error occured, try again!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "exceeded") {
        new PNotify({
          title: 'Error',
          text: 'Number of Equipment needed already maxed out!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
}