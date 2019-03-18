	var get_msg = function () {
		var username_session = $("#username_session").val();
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : {username_session : username_session},
			cache : false,
			success : function (res) {
	    	// alert(res);
	    	var arr = JSON.parse(res);
	    	// alert(arr);
	    	var html = "";
	    	arr.forEach(function(item){
	    		html+="<li class='msg_"+item.id+"'>";
	    		html+="<figure class='image rounded'>";
	    		html+="<img class='image_msg' src='../../assets/images/user.png' alt='Joseph Doe Junior' class='img-circle'>";
	    		html+="</figure>"
	    		html+="<span class='title' style='font-size:15px;'><b>"+item.from_name+"</b></span>";
	    		html+="<span class='message truncate'><b>"+item.message_content+"</b></span>";
	    		html+="<span class='message'>Date sent: "+item.date_sent+"</span>";
	    		if (item.is_response_seen == "0" && item.is_replied == "1") {
	    			html+="<button type='button' class='btn btn-primary btn-xs' onclick='view("+item.id+")'>View Response</button>";
	    		}else if(item.is_response_seen == "1" && item.is_replied == "1") {
	    			html+="<span class='message truncate'> Replied: <b>"+item.response+"</b></span>";
	    			html+="<span class='message truncate'>Date Replied: "+item.date_response+"</span>";
	    		}else {
	    			html+="<button type='button' class='btn btn-danger btn-xs'>No reply</button>";
	    		}
	    		html+="<div align='right'>";
	    		if (item.is_response_seen == "0" && item.is_replied == "1") {
	    			html+="<button type='button' class='btn btn-info btn-xs'>New</button>";
	    		}
	    		if (item.job_stat == "completed") {
	    			html+="<button class='btn btn-danger btn-xs'><i class='fa fa-trash-o' onclick='del_msg("+item.id+")'></i></button>";
	    		}
	    		html+="</div></li>";
	    	});
	    	$("#append_msg").html(html);
	    }
	});
	}
	setInterval(get_msg, 500);

	var messages = function() {
		var username = $("#username_session").val();
		var new_message = "true";
		var form_data = {
			username : username,
			new_message : new_message
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
	    	// alert(res);
	    	if (res == "0") {
	    		var html = "<span class='badge'></span>";
	    		$("#append_badge").append(html);
	    	}else {
	    		var html = "<span class='badge'>"+res+"</span>";
	    		$("#append_badge").append(html);
	    	}
	    }
	});
	}
	setInterval(messages, 500);


	function view(id) {
	// alert(id);
	$(document).ready(function(){

		$.ajax({
			url : "passer.php",
			type : "POST",
			data : {view_id : id},
			cache : false,
			success : function (res) {
	    	// var html=res;
	    	// $("#message_display").append(html);
	    	// $("#message").modal('show');
	    }
	});
	});
	return id;
}
$(document).ready(function(){
	// close modal for viewing message
	$("#close_modal_view").click(function(){
		$("#message").modal('hide');
		// window.location.reload(true);
	});
	$("#close_modal_view2").click(function(){
		$("#message").modal('hide');
		// window.location.reload(true);
	});
	// send reply


});