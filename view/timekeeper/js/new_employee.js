// check present employee
function present(id) {
  var user = $("#username").val();
  var form_data = {
    user : user,
    present : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "present") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Done!.',
          type: 'success',
          shadow: true
        });
        $(".emp_"+id).css("background","red");
        $(".emp_"+id).fadeOut(1000);
      }
      if (res == "error") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Error!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
// check present employee
function no_present(id) {
  var user = $("#username").val();
  var form_data = {
    user : user,
    no_present : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "no_present") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Done!.',
          type: 'success',
          shadow: true
        });
        $(".emp_"+id).css("background","red");
        $(".emp_"+id).fadeOut(1000);
      }
      if (res == "error") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Error!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}

function not_present(id) {
  alert(id);
}

function unassign(id) {
  // alert(id);
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {assign : id},
    cache : false,
    success : function (res) {
      if (res == "true") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Done!.',
          type: 'success',
          shadow: true
        });
        $(".ass_"+id).css("background","red");
        $(".ass_"+id).fadeOut(1000);
      }
      if (res == "error") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Error!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}

function del_emp(id) {
	// alert(id);
	var emp_del = "true";
 var form_data = {
  id : id,
  emp_del : emp_del
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
        text: 'Deleted successfully!.',
        type: 'success',
        shadow: true
      });
      $(".emp_"+id).css("background","red");
      $(".emp_"+id).fadeOut(1000);
    }
  }
});
}
$(document).ready(function(){
  // submit new employee
  $("#submit_tk").click(function(){
    var mp_id = $("#mp_id").val();
    var mp_fname = $("#mp_fname").val();
    var mp_mname = $("#mp_mname").val();
    var mp_lname = $("#mp_lname").val();
    var mp_code = $("#mp_code").val();
    var mp_stat = $("#mp_stat").val();
    var emp_stat = $("#emp_stat").val();
    var username = $("#username").val();
    if (mp_id != "" || mp_fname != "" || mp_lname != "" || mp_code != "" || mp_stat != "" || emp_stat != "") {
      if (mp_id != null || mp_id != "") {
        var msg = document.getElementById('mp_id_error');
        msg.innerHTML = "";
      }
      if (mp_fname != null || mp_fname != "") {
        var msg = document.getElementById('mp_fname_error');
        msg.innerHTML = "";
      }
      if (mp_lname != null || mp_lname != "") {
        var msg = document.getElementById('mp_lname_error');
        msg.innerHTML = "";
      }
      if (mp_code != null || mp_code != "") {
        var msg = document.getElementById('mp_code_error');
        msg.innerHTML = "";
      }
      if (mp_stat != null || mp_stat != "") {
        var msg = document.getElementById('mp_stat_error');
        msg.innerHTML = "";
      }
      if (emp_stat != null || emp_stat != "") {
        var msg = document.getElementById('emp_stat_error');
        msg.innerHTML = "";
      }
    }if (mp_id != "" && mp_fname != "" && mp_lname != "" && mp_code != "" && mp_stat != "" && emp_stat != "") {
      var emp_submit = "true";
      var form_data = {
        mp_id : mp_id,
        mp_fname : mp_fname,
        mp_mname : mp_mname,
        mp_lname : mp_lname,
        mp_code : mp_code,
        mp_stat : mp_stat,
        emp_stat : emp_stat,
        username : username,
        emp_submit : emp_submit
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
      // alert(res);
      if (res == "true") {
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
      if (res == "emp_id") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Employee ID already taken!.',
          type: 'error',
          shadow: true
        });
      }if (res == "name") {
        var notice = new PNotify({
          title: 'Error',
          text: 'Employee name already taken!.',
          type: 'error',
          shadow: true
        });
      }
    }
  });
    }else{
      if (mp_id == null || mp_id == "" || mp_fname == null || mp_fname == "" ||
       mp_lname == null || mp_lname == "" || mp_code == null || mp_code == "" || mp_stat == null || mp_stat == "" || emp_stat == null || emp_stat == "") {
        if (mp_id == null || mp_id == "") {
          var msg = document.getElementById('mp_id_error');
          msg.innerHTML = "*Input employee ID!.";
        }
        if (mp_fname == null || mp_fname == "") {
          var msg = document.getElementById('mp_fname_error');
          msg.innerHTML = "*Input firstname!.";
        }
        if (mp_lname == null || mp_lname == "") {
          var msg = document.getElementById('mp_lname_error');
          msg.innerHTML = "*Input lastname!.";
        }
        if (mp_code == null || mp_code == "") {
          var msg = document.getElementById('mp_code_error');
          msg.innerHTML = "*Input manpower code!.";
        }
        if (mp_stat == null || mp_stat == "") {
          var msg = document.getElementById('mp_stat_error');
          msg.innerHTML = "*Input status!.";
        }
        if (emp_stat == null || emp_stat == "") {
          var msg = document.getElementById('emp_stat_error');
          msg.innerHTML = "*Select employment status!.";
        }
      }
    } 
  });


  // update employee
  $("#update_emp").click(function(){
    var mp_id_edit = $("#mp_id_edit").val();
    var mp_fname_edit = $("#mp_fname_edit").val();
    var mp_mname_edit = $("#mp_mname_edit").val();
    var mp_lname_edit = $("#mp_lname_edit").val();
    var mp_code_edit = $("#mp_code_edit").val();
    var mp_stat_edit = $("#mp_stat_edit").val();
    var emp_stat_edit = $("#emp_stat_edit").val();
    var mp_isassigned_edit = $("#mp_isassigned_edit").val();
    var mp_jobstat_edit = $("#mp_jobstat_edit").val();
    var mp_reques_no_edit = $("#mp_reques_no_edit").val();
    var username = $("#username").val();
    if (mp_id_edit != "" || mp_fname_edit != "" || mp_lname_edit != "" || mp_code_edit != "" || mp_stat_edit != "" || emp_stat_edit != "") {
      if (mp_id_edit != null || mp_id_edit != "") {
        var msg = document.getElementById('mp_id_edit_error');
        msg.innerHTML = "";
      }
      if (mp_fname_edit != null || mp_fname_edit != "") {
        var msg = document.getElementById('mp_fname_edit_error');
        msg.innerHTML = "";
      }
      if (mp_lname_edit != null || mp_lname_edit != "") {
        var msg = document.getElementById('mp_lname_edit_error');
        msg.innerHTML = "";
      }
      if (mp_code_edit != null || mp_code_edit != "") {
        var msg = document.getElementById('mp_code_edit_error');
        msg.innerHTML = "";
      }
      if (mp_stat_edit != null || mp_stat_edit != "") {
        var msg = document.getElementById('mp_stat_edit_error');
        msg.innerHTML = "";
      }
      if (emp_stat_edit != null || emp_stat_edit != "") {
        var msg = document.getElementById('emp_stat_edit_error');
        msg.innerHTML = "";
      }
    }if (mp_id_edit != "" && mp_fname_edit != ""
      && mp_lname_edit != "" && mp_code_edit != "" && mp_stat_edit != "" && emp_stat_edit != "") {
      var emp_update = "true";
      var form_data = {
        mp_id_edit : mp_id_edit,
        mp_fname_edit : mp_fname_edit,
        mp_mname_edit : mp_mname_edit,
        mp_lname_edit : mp_lname_edit,
        mp_code_edit : mp_code_edit,
        mp_stat_edit : mp_stat_edit,
        emp_stat_edit : emp_stat_edit,
        mp_isassigned_edit : mp_isassigned_edit,
        mp_jobstat_edit : mp_jobstat_edit,
        mp_reques_no_edit : mp_reques_no_edit,
        username : username,
        emp_update : emp_update
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
      if (mp_id_edit == null || mp_id_edit == "" || mp_fname_edit == null || mp_fname_edit == "" || mp_lname_edit == null || mp_lname_edit == ""
       || mp_code_edit == null || mp_code_edit == "" || mp_stat_edit == null || mp_stat_edit == "" || emp_stat_edit == null || emp_stat_edit == "") {
        if (mp_id_edit == null || mp_id_edit == "") {
          var msg = document.getElementById('mp_id_edit_error');
          msg.innerHTML = "*Input employee ID!.";
        }
        if (mp_fname_edit == null || mp_fname_edit == "") {
          var msg = document.getElementById('mp_fname_edit_error');
          msg.innerHTML = "*Input firstname!.";
        }
        if (mp_lname_edit == null || mp_lname_edit == "") {
          var msg = document.getElementById('mp_lname_edit_error');
          msg.innerHTML = "*Input lastname!.";
        }
        if (mp_code_edit == null || mp_code_edit == "") {
          var msg = document.getElementById('mp_code_edit_error');
          msg.innerHTML = "*Input manpower position!.";
        }
        if (mp_stat_edit == null || mp_stat_edit == "") {
          var msg = document.getElementById('mp_stat_edit_error');
          msg.innerHTML = "*Input status!.";
        }
        if (emp_stat_edit == null || emp_stat_edit == "") {
          var msg = document.getElementById('emp_stat_edit_error');
          msg.innerHTML = "*Select employment status!.";
        }
      }
    } 
  });
});