function activate(id) {
	var activate_req = "true";
	var form_data = {
		id : id,
		activate_req : activate_req
	}
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
    	// alert(res);
    	if (res == "activated") {
    		var notice = new PNotify({
    			title: 'Success',
    			text: 'Job request activated!',
    			type: 'success',
    			shadow: true
    		});
    	}
    	if (res == "error") {
    		var notice = new PNotify({
    			title: 'Error',
    			text: 'Error occured, try again!',
    			type: 'error',
    			shadow: true
    		});
    	}
    	if (res == "noforeman") {
    		var notice = new PNotify({
    			title: 'Error',
    			text: 'No foreman assigned!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
});
}

function cancel(id) {
	var id = "DICT-"+id;
	var cancel_req = "true";
	var user = $("#username").val();
	var form_data = {
		user : user,
		id : id,
		cancel_req : cancel_req
	}
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
    	// alert(res);
    	if (res == "cancelled") {
    		var notice = new PNotify({
    			title: 'Success',
    			text: 'Job request cancelled!',
    			type: 'success',
    			shadow: true
    		});
    	}
    	if (res == "error") {
    		var notice = new PNotify({
    			title: 'Error',
    			text: 'Error occured, try again!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
});
}


function stop(id) {
	var id = "DICT-"+id;
	var stop_req = "true";
	var user = $("#username").val();
	var form_data = {
		user : user,
		id : id,
		stop_req : stop_req
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
    			text: 'Job request stopped!',
    			type: 'success',
    			shadow: true
    		});
    	}
    	if (res == "error") {
    		var notice = new PNotify({
    			title: 'Error',
    			text: 'Error occured, try again!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
});
}