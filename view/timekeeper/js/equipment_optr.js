// delete operator
function del_eo(id) {
	var eo_del = "true";
 var form_data = {
  id : id,
  eo_del : eo_del
}
$.ajax({
  url : "passer.php",
  type : "POST",
  data : form_data,
  cache : false,
  success : function (res) {
    if (res == "deleted") {
      var notice = new PNotify({
        title: 'Success',
        text: 'Deleted successfully!.',
        type: 'success',
        shadow: true
      });
      $(".eo_"+id).css("background","red");
      $(".eo_"+id).fadeOut(1000);
    }
  }
});
}
$(document).ready(function(){
  $("#submit_eo").click(function(){
    var eqpt_id = $("#eqpt_id").val();
    var optr_id = $("#optr_id").val();

    if (eqpt_id != "" || optr_id != "") {
      if (eqpt_id != null || eqpt_id != "") {
        var msg = document.getElementById('eqpt_error');
        msg.innerHTML = "";
      }
      if (optr_id != null || optr_id != "") {
        var msg = document.getElementById('optr_error');
        msg.innerHTML = "";
      }
      
    }if (eqpt_id != "" && optr_id != "") {
      var eo_submit = "true";
      var form_data = {
        eqpt_id : eqpt_id,
        optr_id : optr_id,
        eo_submit : eo_submit
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "inserted") {
            var notice = new PNotify({
              title: 'Success',
              text: 'Added successfully!.',
              type: 'success',
              shadow: true
            });
            $("#modalFull").modal('hide');
            setTimeout(function(){
              window.location.reload(true);
            },1000);
          }
          if (res == "error") {
            var notice = new PNotify({
              title: 'Error',
              text: 'Error Occured, try again!.',
              type: 'error',
              shadow: true
            });
          }
          if (res == "existed") {
            var notice = new PNotify({
              title: 'Error',
              text: 'Operator already assigned to this equipment!.',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }else{
      if (eqpt_id == null || eqpt_id == "" || optr_id == null || optr_id == "") {
        if (eqpt_id == null || eqpt_id == "") {
          var msg = document.getElementById('eqpt_error');
          msg.innerHTML = "*Select equipment!.";
        }
        if (optr_id == null || optr_id == "") {
          var msg = document.getElementById('optr_error');
          msg.innerHTML = "*Select operator!.";
        }
      }
    } 
  });

  // edit optr
  $("#update_eo").click(function(){
    var edit_eqpt_id = $("#edit_eqpt_id").val();
    var edit_optr_id = $("#edit_optr_id").val();
    var id_edit_eo = $("#id_edit_eo").val();

    if (edit_eqpt_id != "" || edit_optr_id != "") {
      if (edit_eqpt_id != null || edit_eqpt_id != "") {
        var msg = document.getElementById('eqpt_edit_error');
        msg.innerHTML = "";
      }
      if (edit_optr_id != null || edit_optr_id != "") {
        var msg = document.getElementById('optr_edit_error');
        msg.innerHTML = "";
      }
      
    }if (edit_eqpt_id != "" && edit_optr_id != "") {
      var eo_update = "true";
      var form_data = {
        edit_eqpt_id : edit_eqpt_id,
        edit_optr_id : edit_optr_id,
        id_edit_eo : id_edit_eo,
        eo_update : eo_update
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
    	// alert(edit_eqpt_id);
    	// alert(edit_optr_id);
    	// alert(id_edit_eo);
    	// alert(res);
      if (res == "updated") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Updated successfully!.',
          type: 'success',
          shadow: true
        });
        $("#modalFull").modal('hide');
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Error Occured, try again!.',
          type: 'error',
          shadow: true
        });
      }
      if (res == "existed") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Operator already assigned to this equipment!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
    }else{
      if (edit_eqpt_id == null || eqpt_id == "" || edit_optr_id == null || optr_id == "") {
        if (edit_eqpt_id == null || edit_eqpt_id == "") {
          var msg = document.getElementById('eqpt_edit_error');
          msg.innerHTML = "*Select equipment!.";
        }
        if (edit_optr_id == null || edit_optr_id == "") {
          var msg = document.getElementById('optr_edit_error');
          msg.innerHTML = "*Select operator!.";
        }
      }
    } 
  });
});