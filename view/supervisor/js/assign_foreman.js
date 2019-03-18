function foreman(id) {
	$(document).ready(function(){
		// alert(id);
		$("#foreman").modal("show");
		$("#req_no").val(id);
	});
	
}
function assign(id) {
	$(document).ready(function(){
		var req_no = $("#req_no").val();
		var user = $("#username").val();
		var name = $("#foreman_name_"+id).val();
		var assign_foreman = "true";
		// alert(req_no);
		var form_data = {
			id : id,
			req_no : req_no,
			name : name,
			user : user,
			assign_foreman : assign_foreman
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
    	// alert(res);
    	if (res == "assigned") {
    		var notice = new PNotify({
    			title: 'Success',
    			text: 'Foreman assigned!',
    			type: 'success',
    			shadow: true
    		});
    		$(".foreman_"+id).css("background","green");
    		$(".foreman_"+id).fadeIn(1000);
    		setTimeout(function(){
    			window.location.reload(true);
    		},1000);
    	}
    	if (res == "error") {
    		var notice = new PNotify({
    			title: 'Error',
    			text: 'error occured, try again!',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
});
	});
}