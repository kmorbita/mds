$(document).ready(function(){
	$("#signup").click(function(){
		var fname = $("#fname").val();
		var mname = $("#mname").val();
		var lname = $("#lname").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var password_confirm = $("#password_confirm").val();
		var signup = "true"
		var form_data = {
			fname : fname,
			mname : mname,
			lname : lname,
			username : username,
			password : password,
			password_confirm : password_confirm,
			signup : signup
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
		      // alert(res);
		      if (res == "inserted") {
		      	var notice = new PNotify({
		      		title: 'Success',
		      		text: 'Successfully Signed up!',
		      		type: 'success',
		      		shadow: true
		      	});
		      	$(".input").val(""); 
		      }
		      if (res == "blank") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Input all fields!',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "user_characters") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Username must not include special characters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "pass_characters") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Password must not include special characters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "min_user_len") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Username length must not be less than 5 characters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "max_user_len") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Username length must not be greater than 15 characters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "min_pass_len") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Password length must not be less than 5 letters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "max_pass_len") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Password length must not be more than 15 letters',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "no_match") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'password did not match!',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		      if (res == "exist") {
		      	var notice = new PNotify({
		      		title: 'Error',
		      		text: 'Username already exist!',
		      		type: 'error',
		      		shadow: true
		      	});
		      }
		  }
		});
	});
});