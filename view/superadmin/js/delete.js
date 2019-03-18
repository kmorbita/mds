// delete commodity
function del_comm(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {del_comm : id},
		cache : false,
		success : function (res) {
			if (res == true) {
				var notice = new PNotify({
					title: 'Success',
					text: 'Commodity deleted successfully!.',
					type: 'success',
					shadow: true
				});
				setTimeout(function(){
					window.location.reload(true);
				},1000);
			}
			if (res == false) {
				var notice = new PNotify({
					title: 'Error',
					text: 'Error occured in deleting Commodity, Try again!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}

// delete equipment
function del_eqpt(id) {
	// alert(id);
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {del_eqpt : id},
		cache : false,
		success : function (res) {
    	// alert(res);	  
    	if (res == "deleted") {
    		var notice = new PNotify({
    			title: 'Success',
    			text: 'Equipment deleted successfully!.',
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
    			text: 'Error occured in deleting equipment, Try again!.',
    			type: 'error',
    			shadow: true
    		});
    	}
    }
});
}

// delete manpower
function del_mp2(id) {
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {del_mp2 : id},
		cache : false,
		success : function (res) {
			if (res == "deleted") {
				var notice = new PNotify({
					title: 'Success',
					text: 'Manpower deleted successfully!.',
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
					text: 'Error occured in deleting manpower, Try again!.',
					type: 'error',
					shadow: true
				});
			}
		}
	});
}