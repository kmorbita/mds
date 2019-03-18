

function edit_optr_activity(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {edit_optr_activity : id},
    cache : false,
    success : function (res) {
      var arr = JSON.parse(res);
      $("#optr_job_id").val(arr.id);
      $("#optr_work_started").val(arr.work_started);
      $("#optr_work_stopped").val(arr.work_stopped);
      $("#optr_work_resumed").val(arr.work_resumed);
      $("#optr_work_completed").val(arr.work_completed);
      $("#optr_status").val(arr.status);
      $("#optr_remarks").val(arr.remarks);
      $("#optr_reason").val(arr.reason);
      $("#optr_notes").val(arr.notes);
      $("#edit_optr_activity").modal('show');
    }
  });
}
function edit_per_activity(id) {
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {edit_per_activity : id},
    cache : false,
    success : function (res) {
      var arr = JSON.parse(res);
      $("#per_job_id").val(arr.id);
      $("#per_work_started").val(arr.work_started);
      $("#per_work_stopped").val(arr.work_stopped);
      $("#per_work_resumed").val(arr.work_resumed);
      $("#per_work_completed").val(arr.work_completed);
      $("#per_status").val(arr.status);
      $("#per_remarks").val(arr.remarks);
      $("#per_reason").val(arr.reason);
      $("#per_notes").val(arr.notes);
      $("#edit_per_activity").modal('show');
    }
  });
}

$(document).ready(function(){
  $("#update_optr_activity").click(function(){
    var job_id = $("#optr_job_id").val();
    var status = $("#optr_status").val();
    var remarks = $("#optr_remarks").val();
    var notes = $("#optr_notes").val();
    var work_started = $("#optr_work_started").val();
    var work_stopped = $("#optr_work_stopped").val();
    var work_resumed = $("#optr_work_resumed").val();
    var work_completed = $("#optr_work_completed").val();
    var reason = $("#optr_reason").val();
    if (status == null || remarks == null || notes == null || work_started == null || work_stopped == null || work_resumed == null || work_completed == null || reason == null) {
      var notice = new PNotify({
        title: 'Error',
        text: 'Input all fields!',
        type: 'error',
        shadow: true
      });
    }else{
      var update_optr_activity = "true";
      var form_data = {
        job_id :job_id,
        status :status,
        remarks :remarks,
        notes :notes,
        work_started :work_started,
        work_stopped :work_stopped,
        work_resumed :work_resumed,
        work_completed :work_completed,
        reason :reason,
        update_optr_activity :update_optr_activity
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "updated") {
            var notice = new PNotify({
              title: 'Success',
              text: 'Operator Job Activity Updated!',
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
              text: 'Error occured!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }
  });
  $("#update_per_activity").click(function(){
    var job_id = $("#per_job_id").val();
    var status = $("#per_status").val();
    var remarks = $("#per_remarks").val();
    var notes = $("#per_notes").val();
    var work_started = $("#per_work_started").val();
    var work_stopped = $("#per_work_stopped").val();
    var work_resumed = $("#per_work_resumed").val();
    var work_completed = $("#per_work_completed").val();
    var reason = $("#per_reason").val();
    if (status == null || remarks == null || notes == null || work_started == null || work_stopped == null || work_resumed == null || work_completed == null || reason == null) {
      var notice = new PNotify({
        title: 'Error',
        text: 'Input all fields!',
        type: 'error',
        shadow: true
      });
    }else{
      var update_per_activity = "true";
      var form_data = {
        job_id :job_id,
        status :status,
        remarks :remarks,
        notes :notes,
        work_started :work_started,
        work_stopped :work_stopped,
        work_resumed :work_resumed,
        work_completed :work_completed,
        reason :reason,
        update_per_activity :update_per_activity
      }
      $.ajax({
        url : "passer.php",
        type : "POST",
        data : form_data,
        cache : false,
        success : function (res) {
          if (res == "updated") {
            var notice = new PNotify({
              title: 'Success',
              text: 'Personnel Job Activity Updated!',
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
              text: 'Error occured!',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }
  });
});