function edit_eqpt(id) {
  // alert(id);
  var eqpt_edit = "true";
  var form_data = {
    id : id,
    eqpt_edit : eqpt_edit
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      var arr = JSON.parse(res);
      $("#modalFulledit").modal('show');
      $("#id_edit").val(arr.id);
      $("#eqpt_code_edit").val(arr.eqpt_code);
      $("#eqpt_name_edit").val(arr.eqpt_name);
    }
  });
}
// delete equipment
function del_eqpt2(id) {
  // alert(id);
  var eqpt_del = "true";
  var form_data = {
    id : id,
    eqpt_del : eqpt_del
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
        $(".eqpt_"+id).css("background","red");
        $(".eqpt_"+id).fadeOut(1000);
      }
    }
  });
}
$(document).ready(function(){
  $("#submit_eqpt").click(function(){
   var eqpt_code = $("#eqpt_code").val();
   var eqpt_name = $("#eqpt_name").val();
   var eqpt_deg = $("#eqpt_deg").val();
   var eqpt_type = $("#eqpt_type").val();
   var reason = $("#reason").val();
   var status = $("#status").val();
   var user = $("#username").val();
   if (eqpt_code != "" || eqpt_name != "") {
    if (eqpt_code != null || eqpt_code != "") {
      var msg = document.getElementById('eqpt_code_error');
      msg.innerHTML = "";
    }
    if (eqpt_name != null || eqpt_name != "") {
      var msg = document.getElementById('eqpt_name_error');
      msg.innerHTML = "";
    }
    if (eqpt_deg != null || eqpt_deg != "") {
      var msg = document.getElementById('eqpt_deg_error');
      msg.innerHTML = "";
    }
    if (status != null || status != "") {
      var msg = document.getElementById('status_error');
      msg.innerHTML = "";
    }if (eqpt_type != null || eqpt_type != "") {
      var msg = document.getElementById('eqpt_type_error');
      msg.innerHTML = "";
    }
  }if (eqpt_code != "" && eqpt_name != "" && eqpt_deg != "" && status != "" && eqpt_type != "") {
    var eqpt_submit = "true";
    var form_data = {
      eqpt_code : eqpt_code,
      eqpt_deg : eqpt_deg,
      eqpt_name : eqpt_name,
      eqpt_type : eqpt_type,
      user : user,
      reason : reason,
      status : status,
      eqpt_type : eqpt_type,
      eqpt_submit : eqpt_submit
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
            text: 'Equipment inserted!.',
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
            text: 'Equipment not inserted!.',
            type: 'error',
            shadow: true
          });
        }
      }
    });
  }else{
    if (eqpt_code == null || eqpt_code == "" || eqpt_type == null || eqpt_type == "" || eqpt_name == null || eqpt_name == "" || eqpt_deg == null || eqpt_deg == "" || status == null || status == "") {
      if (eqpt_code == null || eqpt_code == "") {
        var msg = document.getElementById('eqpt_code_error');
        msg.innerHTML = "*Input equipment code!.";
      }
      if (eqpt_name == null || eqpt_name == "") {
        var msg = document.getElementById('eqpt_name_error');
        msg.innerHTML = "*Input equipment name!.";
      }
      if (eqpt_deg == null || eqpt_deg == "") {
        var msg = document.getElementById('eqpt_deg_error');
        msg.innerHTML = "*Select manpower code!.";
      }
      if (status == null || status == "") {
        var msg = document.getElementById('status_error');
        msg.innerHTML = "*Select status!.";
      }
      if (status == null || status == "") {
        var msg = document.getElementById('eqpt_type_error');
        msg.innerHTML = "*Select Equipment Type!.";
      }
    }
  } 
});

   // update equipment
   $("#update_eqpt").click(function(){
    var eqpt_code_edit = $("#eqpt_code_edit").val();
    var eqpt_name_edit = $("#eqpt_name_edit").val();
    var eqpt_deg_edit = $("#eqpt_deg_edit").val();
    var eqpt_type_edit = $("#eqpt_type_edit").val();
    var status = $("#status_edit").val();
    var reason = $("#reason").val();
    var user = $("#username").val();
    var id_edit = $("#id_edit").val();
    if (eqpt_code_edit != "" || eqpt_name_edit != "" || status != "") {
      if (eqpt_code_edit != null || eqpt_code_edit != "") {
        var msg = document.getElementById('eqpt_code_edit_error');
        msg.innerHTML = "";
      }
      if (eqpt_name_edit != null || eqpt_name_edit != "") {
        var msg = document.getElementById('eqpt_name_edit_error');
        msg.innerHTML = "";
      }
      if (eqpt_deg_edit != null || eqpt_deg_edit != "") {
        var msg = document.getElementById('eqpt_deg_edit_error');
        msg.innerHTML = "";
      }
      if (status != null || status != "") {
        var msg = document.getElementById('status_edit_error');
        msg.innerHTML = "";
      }
    }if (eqpt_code_edit != "" && eqpt_name_edit != "" && eqpt_deg_edit != "" && status != "") {
      var eqpt_update = "true";
      var form_data = {
        eqpt_code_edit : eqpt_code_edit,
        eqpt_name_edit : eqpt_name_edit,
        eqpt_deg_edit : eqpt_deg_edit,
        eqpt_type_edit : eqpt_type_edit,
        id_edit : id_edit,
        user : user,
        status : status,
        reason : reason,
        eqpt_update : eqpt_update
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          // alert(res);
          if (res == "updated") {
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
          if (res == "error") {
            var notice = new PNotify({
              title: 'Error',
              text: 'Error on updating!.',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }else{
      if (eqpt_code_edit == null || eqpt_code_edit == "" || eqpt_name_edit == null || eqpt_name_edit == "" || eqpt_deg_edit == null || eqpt_deg_edit == "" || status == null || status == "") {
        if (eqpt_code_edit == null || eqpt_code_edit == "") {
          var msg = document.getElementById('eqpt_code_edit_error');
          msg.innerHTML = "*Input Equipment code!.";
        }
        if (eqpt_name_edit == null || eqpt_name_edit == "") {
          var msg = document.getElementById('eqpt_name_edit_error');
          msg.innerHTML = "*Input Equipment name!.";
        }
        if (eqpt_deg_edit == null || eqpt_deg_edit == "") {
          var msg = document.getElementById('eqpt_deg_edit_error');
          msg.innerHTML = "*Select manpower code!.";
        }
        if (status == null || status == "") {
          var msg = document.getElementById('status_edit_error');
          msg.innerHTML = "*Select status!.";
        }
      }
    } 
  });
 });