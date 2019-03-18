$(document).ready(function(){
	$("#attendance_save").click(function(){
		var attendance_date = $("#attendance_date").val();
		var attendance_type = $("#attendance_type").val();
		var user = $("#username").val();
		var attendance_save = "true";
		var form_data = {
			attendance_date : attendance_date,
			attendance_type : attendance_type,
			user : user,
			attendance_save : attendance_save
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
						text: 'Successfully Saved!.',
						type: 'success',
						shadow: true
					});
				}
				if (res == "error") {
					var notice = new PNotify({
						title: 'Error',
						text: 'Error occured, Try again!.',
						type: 'error',
						shadow: true
					});
				}
				if (res == "exist") {
					var notice = new PNotify({
						title: 'Error',
						text: 'Date and Attendance Type Already Exist!.',
						type: 'error',
						shadow: true
					});
				}
			}
		});
	});




	$("#update_attendance").click(function(){
		var attendance_id = $("#attendance_id").val();
		var attendance_date = $("#attendance_date").val();
		var attendance_type = $("#attendance_type").val();
		var user = $("#username").val();
		var update_attendance = "true";
		var form_data = {
			attendance_date : attendance_date,
			attendance_type : attendance_type,
			attendance_id : attendance_id,
			user : user,
			update_attendance : update_attendance
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
						text: 'Successfully Updated!.',
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
						text: 'Error occured, Try again!.',
						type: 'error',
						shadow: true
					});
				}
				if (res == "exist") {
					var notice = new PNotify({
						title: 'Error',
						text: 'No changes made, click "Finish" button to go back!.',
						type: 'error',
						shadow: true
					});
				}
				if (res == "exist2") {
					var notice = new PNotify({
						title: 'Error',
						text: 'Attendance Date and Type Already Exists!.',
						type: 'error',
						shadow: true
					});
				}
			}
		});
	});







	$("#close_attendance2").click(function(){
		$("#modalFull").modal("hide");
		window.location.reload(true);
	});
	$("#close_attendance").click(function(){
		$("#modalFull").modal("hide");
		window.location.reload(true);
	});
});

function is_available(id) {
	var date_id = $("#date_to_save").val();
	var user = $("#username").val();
	var is_available = "true";
	var form_data = {
		date_id : date_id,
		is_available : is_available,
		user : user,
		emp_id : id
	}
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
			// alert(res);
			if (res == "added") {
				$(".emp_"+id).css("background","green");
				$(".emp_"+id).fadeOut(500);
			}
			if (res == "error") {
				var notice = new PNotify({
					title: 'Error',
					text: 'Error occured, Try again!.',
					type: 'error',
					shadow: true
				});
			}
			if (res == "exist") {
				var notice = new PNotify({
					title: 'Error',
					text: 'Employee Already Checked!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}
function del_attendance(id) {
	var date_id = $("#date_to_save").val();
	var user = $("#username").val();
	var del_attendance = "true";
	var form_data = {
		date_id : date_id,
		del_attendance : del_attendance,
		user : user,
		emp_id : id
	}
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
			// alert(res);
			if (res == "deleted") {
				$(".del_attendance_"+id).css("background","red");
				$(".del_attendance_"+id).fadeOut(200);
			}
			if (res == "error") {
				var notice = new PNotify({
					title: 'Error',
					text: 'Error occured, Try again!.',
					type: 'error',
					shadow: true
				});
			}
			if (res == "exist") {
				var notice = new PNotify({
					title: 'Error',
					text: 'Employee Already Checked!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}
function del_all_attendance(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {del_all_attendance : id},
		cache : false,
		success : function (res) {
			// alert(res);
			if (res == "deleted") {
				$(".att_"+id).css("background","red");
				$(".att_"+id).fadeOut(200);
			}
			if (res == "error") {
				var notice = new PNotify({
					title: 'Error',
					text: 'Error occured, Try again!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}
function close_attendance(id) {
	// alert(id);
	var user = $("#username").val();
	var form_data = {
		close_attendance : id,
		user : user
	}
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
			alert(res);
			if (res == "closed") {
				var notice = new PNotify({
					title: 'Success',
					text: 'Attendance Closed!.',
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
					text: 'Error occured, Try again!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}