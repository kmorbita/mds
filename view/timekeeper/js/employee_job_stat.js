function eqpt_dispatch(id) {
	var user = $("#username").val();
	var req = $("#req_no").val();
	var eqpt_dispatch = id;
	var form_data = {
		user : user,
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
function eqpt_relieve(id) {
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var req = $("#req_no").val();
		var eqpt_relieve = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
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
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var req = $("#req_no").val();
		var eqpt_reject = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
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
	var user = $("#username").val();
	var req = $("#req_no").val();
	var per_dispatch = id;
	var form_data = {
		user : user,
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
function per_relieve(id) {
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var req = $("#req_no").val();
		var per_relieve = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
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
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var req = $("#req_no").val();
		var per_reject = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
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
function list_relieve(id,req) {
	var req = "DICT-"+req;
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var list_relieve = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
			list_relieve : list_relieve
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


function list_reject(id,req) {
	var req = "DICT-"+req;
	var reason = prompt("Please enter your reason:", "");
	if (reason == null || reason == "") {
		alert("Enter a reason to proceed");
	} else {
		var notes = reason;
		var user = $("#username").val();
		var list_reject = id;
		var form_data = {
			user : user,
			req : req,
			notes : notes,
			list_reject : list_reject
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
function reject(id,req) {
    var reason = prompt("Please enter your reason:", "");
	var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", "0000-00-00 00:00:00");
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
	var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", "0000-00-00 00:00:00");
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