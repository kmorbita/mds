// delete manpower
function del_mp(id) {
  // alert(id);
  var mp_del = "true";
  var form_data = {
    id : id,
    mp_del : mp_del
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == true) {
        var notice = new PNotify({
          title: 'Success',
          text: 'Deleted successfully!.',
          type: 'success',
          shadow: true
        });
        $(".mp_"+id).css("background","red");
        $(".mp_"+id).fadeOut(1000);
      }
    }
  });
}
// edit manpower
function edit_mp(id) {
  // alert(id);
  var mp_edit = "true";
  var form_data = {
    id : id,
    mp_edit : mp_edit
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
      $("#mp_name_edit").val(arr.mp_name);
      $("#mp_code_edit").val(arr.mp_code);
      $("#mp_code_edit2").val(arr.code);
    }
  });
}
$(document).ready(function(){
  // submit manpower
  $("#submit_mp").click(function(){
    var mp_name = $("#mp_name").val();
    var mp_code = $("#mp_code").val();
    var mp_code2 = $("#mp_code2").val();
    if (mp_name != "" || mp_code != "" || mp_code2 != "") {
      if (mp_name != null || mp_name != "") {
        var msg = document.getElementById('mp_name_error');
        msg.innerHTML = "";
      }
      if (mp_code != null || mp_code != "") {
        var msg = document.getElementById('mp_code_error');
        msg.innerHTML = "";
      }
      if (mp_code2 != null || mp_code2 != "") {
        var msg = document.getElementById('mp_code_error2');
        msg.innerHTML = "";
      }
    }if (mp_name != "" && mp_code != "") {
      var mp_submit = "true";
      var form_data = {
        mp_name : mp_name,
        mp_code : mp_code,
        mp_code2 : mp_code2,
        mp_submit : mp_submit
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
              text: 'connected!.',
              type: 'success',
              shadow: true
            });
            $("#modalFull").modal('hide');
            setTimeout(function(){
              window.location.reload(true);
            },1000);
          }
        }
      });
    }else{
      if (mp_name == null || mp_name == "" || mp_code == null || mp_code == "" || mp_code2 == null || mp_code2 == "") {
        if (mp_name == null || mp_name == "") {
          var msg = document.getElementById('mp_name_error');
          msg.innerHTML = "*Input manpower name!.";
        }
        if (mp_code == null || mp_code == "") {
          var msg = document.getElementById('mp_code_error');
          msg.innerHTML = "*Input manpower type!.";
        }
        if (mp_code2 == null || mp_code2 == "") {
          var msg = document.getElementById('mp_code_error2');
          msg.innerHTML = "*Input manpower code!.";
        }
      }
    } 
  });
  // update manpower
  $("#edit_mp").click(function(){
    var mp_name_edit = $("#mp_name_edit").val();
    var mp_code_edit = $("#mp_code_edit").val();
    var mp_code_edit2 = $("#mp_code_edit2").val();
    var id_edit = $("#id_edit").val();
    if (mp_name_edit != "" || mp_code_edit != "" || mp_code_edit2 != "") {
      if (mp_name_edit != null || mp_name_edit != "") {
        var msg = document.getElementById('mp_name_edit_error');
        msg.innerHTML = "";
      }
      if (mp_code_edit != null || mp_code_edit != "") {
        var msg = document.getElementById('mp_code_edit_error');
        msg.innerHTML = "";
      }
      if (mp_code_edit2 != null || mp_code_edit2 != "") {
        var msg = document.getElementById('mp_code_edit_error2');
        msg.innerHTML = "";
      }
    }if (mp_name_edit != "" && mp_code_edit != "") {
      var mp_update = "true";
      var form_data = {
        mp_name_edit : mp_name_edit,
        mp_code_edit : mp_code_edit,
        mp_code_edit2 : mp_code_edit2,
        id_edit : id_edit,
        mp_update : mp_update
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
            $("#modalFulledit").modal('hide');
            setTimeout(function(){
              window.location.reload(true);
            },1000);
          }
          if (res == false) {
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
      if (mp_name_edit == null || mp_name_edit == "" || mp_code_edit == null || mp_code_edit == "" || mp_code_edit2 == null || mp_code_edit2 == "") {
        if (mp_name_edit == null || mp_name_edit == "") {
          var msg = document.getElementById('mp_name_edit_error');
          msg.innerHTML = "*Input manpower name!.";
        }
        if (mp_code_edit == null || mp_code_edit == "") {
          var msg = document.getElementById('mp_code_edit_error');
          msg.innerHTML = "*Input manpower type!.";
        }
        if (mp_code_edit2 == null || mp_code_edit2 == "") {
          var msg = document.getElementById('mp_code_edit_error2');
          msg.innerHTML = "*Input manpower code!.";
        }
      }
    } 
  });

});