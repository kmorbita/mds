function eqpt_dispatch(id) {
	var job_status = $("#job_status").val();
	if (job_status == "activated") {
		var timestamp = "none";
		var user = $("#username").val();
		var req = $("#job_req").val();
		var eqpt_dispatch = id;
		var form_data = {
			timestamp : timestamp,
			user : user,
			job_status : job_status,
			req : req,
			eqpt_dispatch : eqpt_dispatch
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		    	// alert(res);
		    	if (res == "dispatched") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Operator dispatched!',
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
	}else{
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
    	var req = $("#job_req").val();
    	var eqpt_dispatch = id;
    	var form_data = {
    		timestamp : timestamp,
    		user : user,
    		job_status : job_status,
    		req : req,
    		eqpt_dispatch : eqpt_dispatch
    	}
    	$.ajax({
    		url : "passer.php",
    		type : "POST",
    		data : form_data,
    		cache : false,
    		success : function (res) {
		    	// alert(res);
		    	if (res == "dispatched") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Operator dispatched!',
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
}
function eqpt_relieve(id) {
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
    if (reason == null || reason == "" || timestamp == null || timestamp == "") {
    	if (reason == null || reason == "") {
    		alert("Enter a reason to proceed");
    	}
    	if ( timestamp == null || timestamp == "") {
    		alert("Enter date and time to proceed");
    	}
    } else {
    	var notes = reason;
    	var user = $("#username").val();
    	var req = $("#job_req").val();
    	var eqpt_relieve = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		eqpt_relieve : eqpt_relieve
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
function eqpt_reject(id) {
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
    if (reason == null || reason == "" || timestamp == null || timestamp == "") {
    	if (reason == null || reason == "") {
    		alert("Enter a reason to proceed");
    	}
    	if ( timestamp == null || timestamp == "") {
    		alert("Enter date and time to proceed");
    	}
    } else {
    	var notes = reason;
    	var user = $("#username").val();
    	var req = $("#job_req").val();
    	var eqpt_reject = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		eqpt_reject : eqpt_reject
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

function per_dispatch(id) {
	var job_status = $("#job_status").val();
	if (job_status == "activated") {
		var timestamp = "none";
		var user = $("#username").val();
		var req = $("#job_req").val();
		var per_dispatch = id;
		var form_data = {
			timestamp : timestamp,
			user : user,
			job_status : job_status,
			req : req,
			per_dispatch : per_dispatch
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		    	// alert(res);
		    	if (res == "dispatched") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Personnel dispatched!',
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
	}else{
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
    	var req = $("#job_req").val();
    	var per_dispatch = id;
    	var form_data = {
    		timestamp : timestamp,
    		user : user,
    		job_status : job_status,
    		req : req,
    		per_dispatch : per_dispatch
    	}
    	$.ajax({
    		url : "passer.php",
    		type : "POST",
    		data : form_data,
    		cache : false,
    		success : function (res) {
		    	// alert(res);
		    	if (res == "dispatched") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Personnel dispatched!',
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
}
function per_relieve(id) {
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
    if (reason == null || reason == "" || timestamp == null || timestamp == "") {
    	if (reason == null || reason == "") {
    		alert("Enter a reason to proceed");
    	}
    	if ( timestamp == null || timestamp == "") {
    		alert("Enter date and time to proceed");
    	}
    } else {
    	var notes = reason;
    	var user = $("#username").val();
    	var req = $("#job_req").val();
    	var per_relieve = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		per_relieve : per_relieve
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
		    			text: 'Personnel relieved!',
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
function per_reject(id) {
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
    if (reason == null || reason == "" || timestamp == null || timestamp == "") {
    	if (reason == null || reason == "") {
    		alert("Enter a reason to proceed");
    	}
    	if ( timestamp == null || timestamp == "") {
    		alert("Enter date and time to proceed");
    	}
    } else {
    	var notes = reason;
    	var user = $("#username").val();
    	var req = $("#job_req").val();
    	var per_reject = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		per_reject : per_reject
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
		    			text: 'Personnel rejected!',
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

// cleart job status of employee
function clear_stat(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {clear_stat : id},
		cache : false,
		success : function (res) {
		    	// alert(res);
		    	if (res == "cleared") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Status Cleared!',
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


$(document).ready(function(){
 $("#update_emp").click(function(){
    var mp_id_edit = $("#mp_id_edit").val();
    var mp_jobstat_edit = $("#mp_jobstat_edit").val();
    var username = $("#username").val();
      var emp_update = "true";
      var form_data = {
        mp_id_edit : mp_id_edit,
        mp_jobstat_edit : mp_jobstat_edit,
        username : username,
        emp_update : emp_update
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
  });
});