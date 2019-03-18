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
    }else {
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
    }else {
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
    }else {
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


function reject(id,req) {
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
    	var user = $("#username").val();;
    	var reject = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		reject : reject
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
		    			text: 'Rejected!',
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
function relieve(id,req) {
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
    	var relieve = id;
    	var form_data = {
    		user : user,
    		req : req,
    		notes : notes,
    		timestamp : timestamp,
    		relieve : relieve
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
		    			text: 'Relieved!',
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
function edit_box(id) {
    $.ajax({
        url : "passer.php",
        type : "POST",
        data : {edit_box : id},
        cache : false,
        success : function (res) {
            var arr = JSON.parse(res);
            $("#box_id").val(arr.id);
            $("#box_type").val(arr.type);
            $("#edit_box").modal('show');
        }
    });
}
function edit_weight(id) {
    $.ajax({
        url : "passer.php",
        type : "POST",
        data : {edit_weight : id},
        cache : false,
        success : function (res) {
            var arr = JSON.parse(res);
            $("#weight_id").val(arr.id);
            $("#weight").val(arr.weight);
            $("#edit_weight").modal('show');
        }
    });
}
$(document).ready(function(){
	$("#update_box").click(function(){
		var box_id = $("#box_id").val();
		var user = $("#username").val();
		var box_type = $("#box_type").val();
		var update_box = "true";
		var form_data = {
			box_id : box_id,
			user : user,
			update_box : update_box,
			box_type : box_type
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
		    			text: 'Box Type Updated!',
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
	});

	$("#submit_box").click(function(){
		var box_type = $("#new_box_type").val();
		var user = $("#username").val();
		var submit_box = "true";
		var form_data = {
			box_type : box_type,
			user : user,
			submit_box : submit_box
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		    	// alert(res);
		    	if (res == "added") {
		    		var notice = new PNotify({
		    			title: 'Success',
		    			text: 'Box Type Added!',
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
		    	if (res == "exist") {
		    		var notice = new PNotify({
		    			title: 'Error',
		    			text: 'Box Type Already Exist!',
		    			type: 'error',
		    			shadow: true
		    		});
		    	}
		    }
		});
	});

$("#update_weight").click(function(){
        var weight_id = $("#weight_id").val();
        var user = $("#username").val();
        var weight = $("#weight").val();
        var update_weight = "true";
        var form_data = {
            weight_id : weight_id,
            user : user,
            update_weight : update_weight,
            weight : weight
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
                        text: 'Weight Updated!',
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
    });

    $("#submit_weight").click(function(){
        var new_weight = $("#new_weight").val();
        var user = $("#username").val();
        var submit_weight = "true";
        var form_data = {
            new_weight : new_weight,
            user : user,
            submit_weight : submit_weight
        }
        $.ajax({
            url : "passer.php",
            type : "POST",
            data : form_data,
            cache : false,
            success : function (res) {
                // alert(res);
                if (res == "added") {
                    var notice = new PNotify({
                        title: 'Success',
                        text: 'Weight Added!',
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
                if (res == "exist") {
                    var notice = new PNotify({
                        title: 'Error',
                        text: 'Weight Already Exist!',
                        type: 'error',
                        shadow: true
                    });
                }
            }
        });
    });


});


function del_box(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_box : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        // var notice = new PNotify({
        //   title: 'Success',
        //   text: 'Deleted successfully!.',
        //   type: 'success',
        //   shadow: true
        // });
        $(".box_"+id).css("background","red");
        $(".box_"+id).fadeOut(500);
      }
    }
  });
}
function del_weight(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_weight : id},
    cache : false,
    success : function (res) {
      if (res == "deleted") {
        // var notice = new PNotify({
        //   title: 'Success',
        //   text: 'Deleted successfully!.',
        //   type: 'success',
        //   shadow: true
        // });
        $(".weight_"+id).css("background","red");
        $(".weight_"+id).fadeOut(500);
      }
    }
  });
}