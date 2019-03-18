$(document).ready(function(){
	
	$("#edit_comm").click(function(){
		var shipper = $("#shipper").val();
		var user = $("#username").val();
		var commodity = $("#commodity").val();
		var qty = $("#qty").val();
		var unit = $("#unit").val();
		var box = $("#box").val();
		var weight = $("#weight").val();
		var destination = $("#destination").val();
		var requestno = $("#requestno").val();
		var edit_comm = "true";
		if (shipper != "" || commodity != "" || qty != "" || unit != "" || destination != "" || box != "" || weight != "" && box != "" && weight != "") {
			if (shipper != null || shipper != "") {
				var msg = document.getElementById('shipper_error');
				msg.innerHTML = "";
			}
			if (commodity != null || commodity != "") {
				var msg = document.getElementById('commodity_error');
				msg.innerHTML = "";
			}
			if (qty != null || qty != "") {
				var msg = document.getElementById('qty_error');
				msg.innerHTML = "";
			}
			if (unit != null || unit != "") {
				var msg = document.getElementById('unit_error');
				msg.innerHTML = "";
			}
			if (destination != null || destination != "") {
				var msg = document.getElementById('destination_error');
				msg.innerHTML = "";
			}
			if (box != null || box != "") {
				var msg = document.getElementById('box_error');
				msg.innerHTML = "";
			}
			if (weight != null || weight != "") {
				var msg = document.getElementById('weight_error');
				msg.innerHTML = "";
			}
		}if (shipper != "" && commodity != "" && qty != "" && unit != "" && destination != "") {
			var form_data = {
				shipper : shipper,
				commodity : commodity,
				qty : qty,
				unit : unit,
				destination : destination,
				requestno : requestno,
				box : box,
				weight : weight,
				user : user,
				edit_comm : edit_comm
			}

			$.ajax({
				url : "passer.php",
				type : "POST",
				data : form_data,
				cache : false,
				success : function (res) {
					if (res == true) {
						var notice = new PNotify({
							title: 'Success',
							text: 'Commodity added successfully!.',
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
							text: 'Error occured in adding Commodity, Try again!.',
							type: 'error',
							shadow: true
						});
					}
				}
			});
		}else{
			if (shipper == null || shipper == "" || commodity == null || commodity == "" || qty == null || qty == "" ||
				unit == null || unit == "" || destination == null || destination == "" || box == null || box == "" 
				|| weight == null || weight == "") {
				if (shipper == null || shipper == "") {
					var msg = document.getElementById('shipper_error');
					msg.innerHTML = "*Input shipper!";
				}
				if (commodity == null || commodity == "") {
					var msg = document.getElementById('commodity_error');
					msg.innerHTML = "*Input commodity!";
				}
				if (qty == null || qty == "") {
					var msg = document.getElementById('qty_error');
					msg.innerHTML = "*Input quantity!";
				}
				if (unit == null || unit == "") {
					var msg = document.getElementById('unit_error');
					msg.innerHTML = "*Input unit!";
				}
				if (destination == null || destination == "") {
					var msg = document.getElementById('destination_error');
					msg.innerHTML = "*Input destination!";
				}
				if (box == null || box == "") {
					var msg = document.getElementById('box_error');
					msg.innerHTML = "*Select Box Type!";
				}
				if (weight == null || weight == "") {
					var msg = document.getElementById('weight_error');
					msg.innerHTML = "*Select Weight Per Box!";
				}
			}
		}
	});


	$("#edit_eqpt").click(function(){
		var eq_code = $("#eq_code").val();
		var no_of_eqpt = $("#no_of_eqpt").val();
		var w_optr = $("#w_optr").val();
		var requestno = $("#requestno").val();
		var user = $("#username").val();
		var edit_eqpt = "true";
		if (eq_code != "" || no_of_eqpt != "" || w_optr != "") {
			if (eq_code != null || eq_code != "") {
				var msg = document.getElementById('eq_code_error');
				msg.innerHTML = "";
			}
			if (no_of_eqpt != null || no_of_eqpt != "") {
				var msg = document.getElementById('no_of_eqpt_error');
				msg.innerHTML = "";
			}
			if (w_optr != null || w_optr != "") {
				var msg = document.getElementById('w_optr_error');
				msg.innerHTML = "";
			}
		}if (eq_code != "" && no_of_eqpt != "" && w_optr != "") {
			var form_data = {
				eq_code : eq_code,
				no_of_eqpt : no_of_eqpt,
				w_optr : w_optr,
				requestno : requestno,
				user : user,
				edit_eqpt : edit_eqpt
			}

			$.ajax({
				url : "passer.php",
				type : "POST",
				data : form_data,
				cache : false,
				success : function (res) {
					if (res == "true") {
						var notice = new PNotify({
							title: 'Success',
							text: 'Equipment added successfully!.',
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
							text: 'Error occured in adding Equipment, Try again!.',
							type: 'error',
							shadow: true
						});
					}
					if(res == "duplicate"){
					     var notice = new PNotify({
					      title: 'Error',
					      text: 'Equipment can only be requested once, try again!',
					      type: 'error',
					      shadow: true
					    });
					   }
				}
			});
		}else{
			if (eq_code == null || eq_code == "" || no_of_eqpt == null || no_of_eqpt == "" || w_optr == null || w_optr == "") {
				if (eq_code == null || eq_code == "") {
					var msg = document.getElementById('eq_code_error');
					msg.innerHTML = "*Select equipment code!";
				}
				if (no_of_eqpt == null || no_of_eqpt == "") {
					var msg = document.getElementById('no_of_eqpt_error');
					msg.innerHTML = "*Input number of equipment!";
				}
				if (w_optr == null || w_optr == "") {
					var msg = document.getElementById('w_optr_error');
					msg.innerHTML = "*Select operator if needed or not!";
				}
			}
		}
	});



// manpower edit
$("#edit_mp").click(function(){
	var mp_code = $("#mp_code").val();
	var nos = $("#nos").val();
	var requestno = $("#requestno").val();
	var user = $("#username").val();
	var edit_mp = "true";
	if (mp_code != "" || nos != "") {
		if (mp_code != null || mp_code != "") {
			var msg = document.getElementById('mp_code_error');
			msg.innerHTML = "";
		}
		if (nos != null || nos != "") {
			var msg = document.getElementById('nos_error');
			msg.innerHTML = "";
		}
	}if (mp_code != "" && nos != "") {
		var form_data = {
			mp_code : mp_code,
			nos : nos,
			requestno : requestno,
			user : user,
			edit_mp : edit_mp
		}

		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
				if (res == true) {
					var notice = new PNotify({
						title: 'Success',
						text: 'Manpower added successfully!.',
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
						text: 'Error occured in adding Manpower, Try again!.',
						type: 'error',
						shadow: true
					});
				}
			}
		});
	}else{
		if (mp_code == null || mp_code == "" || nos == null || nos == "") {
			if (mp_code == null || mp_code == "") {
				var msg = document.getElementById('mp_code_error');
				msg.innerHTML = "*Select manpower code!";
			}
			if (nos == null || nos == "") {
				var msg = document.getElementById('nos_error');
				msg.innerHTML = "*Input number of manpower!";
			}
		}
	}
});





// requestor & cargo details
$("#edit_req_cargo").click(function(){
	var requestor = $("#requestor").val();
	var address = $("#address").val();
	var requestdate = $("#requestdate").val();
	var jobcode = $("#jobcode").val();
	var description = $("#description").val();
	var jobdate = $("#jobdate").val();
	var joblocation = $("#joblocation").val();
	var est = $("#est").val();
	var vessel = $("#vessel").val();
	var voyage = $("#voyage").val();
	var vanno = $("#vanno").val();
	var truckno = $("#truckno").val();
	var hatchno = $("#hatchno").val();
	var deckno = $("#deckno").val();
	var encoder = $("#encoder").val();
	var trk_type = $("#trk_type").val();

	var requestno = $("#requestno").val();
	var edit_req_cargo = "true";
	if (requestor != "" || requestno != "" || address != "" || requestdate != "" ||
		jobcode != "" || description != "" || jobdate != "" || 
		joblocation != "" || est != "") {
		if (requestor != null || requestor != "") {
			var msg = document.getElementById('requestor_error');
			msg.innerHTML = "";
		}
		if (requestno != null || requestno != "") {
			var msg = document.getElementById('requestno_error');
			msg.innerHTML = "";
		}
		if (address != null || address != "") {
			var msg = document.getElementById('address_error');
			msg.innerHTML = "";
		}
		if (requestdate != null || requestdate != "") {
			var msg = document.getElementById('requestdate_error');
			msg.innerHTML = "";
		}
		if (jobcode != null || jobcode != "") {
			var msg = document.getElementById('jobcode_error');
			msg.innerHTML = "";
		}
		if (description != null || description != "") {
			var msg = document.getElementById('description_error');
			msg.innerHTML = "";
		}
		if (jobdate != null || jobdate != "") {
			var msg = document.getElementById('jobdate_error');
			msg.innerHTML = "";
		}
		if (joblocation != null || joblocation != "") {
			var msg = document.getElementById('joblocation_error');
			msg.innerHTML = "";
		}
		if (est != null || est != "") {
			var msg = document.getElementById('est_error');
			msg.innerHTML = "";
		}
	}if (requestor == null || requestor == "" || requestno == null || requestno == "" || address == null || address == "" ||
		requestdate == null || requestdate == "" || jobcode== null || jobcode == "" || description == null || description == "" || 
		jobdate == null || jobdate == "" || joblocation == null || joblocation == "" || est == null || est == "") {
		if (requestor == null || requestor == "") {
			var msg = document.getElementById('requestor_error');
			msg.innerHTML = "*Input Requestor!";
		}
		if (requestno == null || requestno == "") {
			var msg = document.getElementById('requestno_error');
			msg.innerHTML = "*No Request number!, Cancel this form and create new";
		}
		if (address == null || address == "") {
			var msg = document.getElementById('address_error');
			msg.innerHTML = "*Input Address!";
		}
		if (requestdate == null || requestdate == "") {
			var msg = document.getElementById('requestdate_error');
			msg.innerHTML = "*Input Request Date!";
		}
		if (jobcode== null || jobcode == "") {
			var msg = document.getElementById('jobcode_error');
			msg.innerHTML = "*Input Job Code!";
		}
		if (description == null || description == "") {
			var msg = document.getElementById('description_error');
			msg.innerHTML = "*Input Job description!";
		}
		if (jobdate == null || jobdate == "") {
			var msg = document.getElementById('jobdate_error');
			msg.innerHTML = "*Input Job Date!";
		}
		if (joblocation == null || joblocation == "") {
			var msg = document.getElementById('joblocation_error');
			msg.innerHTML = "*Input Job Location!";
		}
		if (est == null || est == "") {
			var msg = document.getElementById('est_error');
			msg.innerHTML = "*Input Estimated time to complete!";
		}
	}else{
		var form_data = {
			requestor : requestor,
			address : address,
			requestdate : requestdate,
			jobcode : jobcode,
			description : description,
			jobdate : jobdate,
			joblocation : joblocation,
			est : est,
			vessel : vessel,
			voyage : voyage,
			vanno : vanno,
			truckno : truckno,
			hatchno : hatchno,
			deckno : deckno,
			encoder : encoder,
			trk_type : trk_type,
			requestno : requestno,
			edit_req_cargo : edit_req_cargo
		}

		$.ajax({
			url : "passer.php",
			type : "POST",
			data : form_data,
			cache : false,
			success : function (res) {
				if (res == true) {
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
				if (res == false) {
					var notice = new PNotify({
						title: 'Error',
						text: 'Error occured in updating records, Try again!.',
						type: 'error',
						shadow: true
					});
				}
			}
		});
	}
});
});