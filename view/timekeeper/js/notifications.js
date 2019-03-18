function del_msg(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {del_msg : id},
		cache : false,
		success : function (res) {
			if (res == "deleted") {
				new PNotify({
					title: 'Success',
					text: 'Deleted!',
					type: 'success',
					shadow: true
				});
				$(".msg_"+id).css("background","red");
				$(".msg_"+id).fadeOut(500);
			}
			if (res == "error") {
				new PNotify({
					title: 'Error',
          // text: 'Error!',
          type: 'error',
          shadow: true
      });
			}
		}
	});
}
// get number of messages
$(document).ready(function(){
	var get_msg = function () {
		var role_msg = $("#role_msg").val();
// alert(role_msg);
$.ajax({
	url : "passer.php",
	type : "POST",
	data : {role_msg : role_msg},
	cache : false,
	success : function (res) {
		var arr = JSON.parse(res);
	    	// console.log(arr)
	    	var html = "";
	    	arr.forEach(function(item){
	    		html+="<li class='msg_"+item.id+"'>";
	    		html+="<figure class='image rounded'>";
	    		html+="<img class='image_msg' src='../../assets/images/user.png' alt='Joseph Doe Junior' class='img-circle'>";
	    		html+="</figure>";
	    		html+="<span class='title'>"+item.from_name+"</span>";
	    		if (item.status == "not seen") {
	    			html+="<button type='button' class='btn btn-info btn-xs' onclick='view("+item.id+")'>View</button>";
	    		}else {
	    			html+="<span class='message truncate'><b>"+item.message_content+"</b></span>";
	    		}
	    		html+="<span class='message'>Date sent: "+item.date_sent+"</span>";
	    		if (item.is_replied =="0") {
	    			html+="<button type='button' class='btn btn-primary btn-xs' onclick='reply("+item.id+")'>Reply</button>";
	    		}else{
	    			html+="<span class='message'>Replied: <b>"+item.response+"</b></span>";
	    			html+="<span class='message'>Date Replied: "+item.date_response+"</span>";
	    		}
	    		html+="<div align='right'>";
	    		if (item.status == "not seen") {
	    			html+="<button type='button' class='btn btn-info btn-xs'>New</button>&nbsp;";
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


});



var messages = function() {
	var role = $("#role_msg").val();
	var new_message = "true";
	var form_data = {
		role : role,
		new_message : new_message
	}
	

	$.ajax({
		url : "passer.php",
		type : "POST",
		data : form_data,
		cache : false,
		success : function (res) {
	    	// alert("res");
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
setInterval(messages,500);

function view(id) {
	$(document).ready(function(){

		$.ajax({
			url : "passer.php",
			type : "POST",
			data : {view_id : id},
			cache : false,
			success : function (res) {
	    	// var html=res;
	    	// $("#message_display").html(html);
	    	// $("#message").modal('show');
	    }
	});
	});
}
function reply(id) {
	$(document).ready(function(){

		$.ajax({
			url : "passer.php",
			type : "POST",
			data : {view_id : id},
			cache : false,
			success : function (res) {
				$("#msg_id").val(id);
				$("#reply_msg").modal('show');
			}
		});
	});
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
	$("#close_modalr_reply").click(function(){
		$("#reply_msg").modal('hide');
		// window.location.reload(true);
	});
	$("#close_modalr_reply2").click(function(){
		$("#reply_msg").modal('hide');
		// window.location.reload(true);
	});
	// send reply
	$("#sent_reply").click(function(){
		var msg_id = $("#msg_id").val();
		var msg_content = $("#msg_content").val();
		var reply_msg = "true";
		var form_data = {
			msg_id : msg_id,
			msg_content : msg_content,
			reply_msg : reply_msg
		}
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
				if (res == "sent") {
					new PNotify({
						title: 'Success',
						text: 'Sent!',
						type: 'success',
						shadow: true
					});
        //         setTimeout(function(){
			     //  window.location.reload(true);
			     // },1000);
			 }
			 if (res == "error") {
			 	new PNotify({
			 		title: 'Error',
			 		text: 'Error sending notification to foreman!',
			 		type: 'error',
			 		shadow: true
			 	});
			 }
			}
		});
	});
	// $("#del_msg").click(function(){
	// 	var delmsg = [];
 //            $.each($("input[name='notify_id']:checked"), function(){
 //            	var id = $(this).val();
 //                delmsg.push({id:id});
 //            });
 //        var arr = JSON.stringify(delmsg);
 //        var delete_msg = "true";
 //        var form_data = {
 //        	arr : arr,
 //        	delete_msg : delete_msg
 //        }
 //        $.ajax({
	//     url : "passer.php",
	//     type : "POST",
	//     data : form_data,
	//     cache : false,
	//     success : function (res) {
	//     	// alert(res);
	//     	if (res == "deleted") {
 //                new PNotify({
 //                title: 'Message',
 //                text: 'Deleted!',
 //                type: 'success',
 //                shadow: true
 //              });
 //                setTimeout(function(){
	// 		      window.location.reload(true);
	// 		     },1000);
 //              }
 //              if (res == "error") {
 //                new PNotify({
 //                title: 'Message',
 //                text: 'Error!',
 //                type: 'error',
 //                shadow: true
 //              });
 //              }
	//   	}
	// });
	// });


});