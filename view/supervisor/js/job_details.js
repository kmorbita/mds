function status(id) {
  // alert(id);
  var id = "DICT-"+id;
  $("#request_no").val(id);
  $("#status").modal('show');
}
function job_id(id) {
  var id = "DICT-"+id;
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {joblistid : id},
    cache : false,
    success : function (res) {
      var msg = document.getElementById("job_display");
      msg.innerHTML = res;
      $("#modalFull").modal();
    }
  });
}
var jobs = function() {
  $(document).ready(function(){
    $("#search").click(function(){
      var search_data = $("#search_data").val();
      if (search_data != null && search_data != "") {
       $.ajax({
        url : "passer.php",
        type : "POST",
        data : {search_data : search_data},
        cache : false,
        success : function (res) {
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      var html = "";
      var status;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "closed") {
          status = "<button type='button' class='btn btn-warning btn-xs'>closed</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-success btn-xs'>working</button>";
        }else if(item.status == "queued"){
          status = "<button type='button' class='btn btn-warning btn-xs'>queued</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs'>activated</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        if (item.foreman_name == "" && item.foreman_id == "0") {
          foreman = "<button type='button' class='btn btn-default btn-xs' onclick='foreman("+item.id+")'> Assign</button>";
        }else {
          foreman = item.foreman_name;
        }
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        if (item.status == "working") {
          html+="<td><button class='btn btn-default btn-xs fa fa-ban' onclick='cancel("+req+")' title='Cancel'></button>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")' title='Close'></button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil' title='Job Activity'></button></a></td>";
        }else if (item.status == "cancelled") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")' title='View Details'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil' title='Job Activity'></button></a></td>";
        }else if (item.status == "closed") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")' title='View Details'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil' title='Job Activity'></button></a></td>";
        }else if (item.status == "completed") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")' title='View Details'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil' title='Job Activity'></button></a></td>";
        }else {
          html+="<td><button type='button' class='btn btn-default btn-xs fa fa-play' onclick='activate("+item.id+")' title='Activate'></button>|<button class='btn btn-default btn-xs fa fa-ban' onclick='cancel("+req+")' title='Cancel'></button>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")' title='Close'></button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")' title='View Details'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil' title='Job Activity'></button></a></td>";          
        }
        html+="</tr>";
        i++;
      });
      $("#append_job").html(html);
    }
  });
     }else {
    // new PNotify({
    //   title: 'Error',
    //   text: 'Input Request Number to search!',
    //   type: 'error',
    //   shadow: true
    // });
  }
});
$("#view_all").click(function(){
  window.location.reload(true);
});
});
}
setInterval(jobs,500);

$(document).ready(function(){
  var list = function(){
    var joblist = "true";
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : {joblist : joblist},
      cache : false,
      success : function (res) {
      // alert(res);
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var status;
      var foreman;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "closed") {
          status = "<button type='button' class='btn btn-danger btn-xs'>closed</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-primary btn-xs'>working</button>";
        }else if(item.status == "queued"){
          status = "<button type='button' class='btn btn-warning btn-xs' onclick='status("+req+")'>queued</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs' onclick='status("+req+")'>activated</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-info btn-xs' onclick='status("+req+")'>stopped</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs'>completed</button>";
        }
        // if (item.foreman_name == "" && item.foreman_id == "0" && item.status == "activated") {
        //   foreman = "<button type='button' class='btn btn-default btn-xs' onclick='foreman("+item.id+")'> Assign</button>";
        // }else {
        //   foreman = item.foreman_name;
        // }
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")' title='View Details'></button>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o' title='Job Activity'></button></a>|<button type='button' class='btn btn-default btn-xs' onclick='foreman("+item.id+")'> Assign</button></td>";
        html+="</tr>";
        i++;
      });
      $("#append_job").html(html);
    }
  });
  }
  setInterval(list,500);
  $("#submit_status").click(function(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
    var reason = prompt("Enter a reason", "");
    var submit_status = "true";
    var id = $("#request_no").val();
    var user = $("#username").val();
    var status = $("#status_code").val();
    var form_data = {
      submit_status : submit_status,
      timestamp : timestamp,
      reason : reason,
      user : user,
      status : status,
      req : id,
    }
    if (status != null && status !="") {
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
              text: 'Job status updated!',
              type: 'success',
              shadow: true
            });
          }
          if (res == "error") {
            var notice = new PNotify({
              title: 'Error',
              text: 'Error occured, try again!',
              type: 'error',
              shadow: true
            });
          }
          if (res == "no_foreman") {
            var notice = new PNotify({
              title: 'Error',
              text: 'No foreman assigned!',
              type: 'error',
              shadow: true
            });
          }
          if (res == "no_personnel") {
            var notice = new PNotify({
              title: 'Error',
              text: 'No personnel dispatched!, notify timekeeper',
              type: 'error',
              shadow: true
            });
          }
          if (res == "no_records") {
            var notice = new PNotify({
              title: 'Error',
              text: 'No personnel dispatched!, notify timekeeper',
              type: 'error',
              shadow: true
            });
          }

        }
      });
    }else {
      new PNotify({
        title: 'Error',
        text: 'No status selected!',
        type: 'error',
        shadow: true
      });
    }
  });
});






function operator_act(id) {
  var req = $("#req").val();
  var operator_act = "true";
  var form_data = {
    req : req,
    operator_act : operator_act,
    emp_id : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
      // console.log(arr)
      $("#optr_id").val(arr.emp_id);
      $("#optr_name").val(arr.fname+" "+arr.mname+" "+arr.lname);
      var html = "";
      var i=1;
      arr.optr_act.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="<td>"+item.reason+"</td>";
        html+="</tr>";
        i++;
      });
      $("#optr_modal").html(html);
      $("#operator_modal").modal("show");
    }
  });
}

function personnel_act(id) {
  var req = $("#req").val();
  var personnel_act = "true";
  var form_data = {
    req : req,
    personnel_act : personnel_act,
    emp_id : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
            // alert(res);
            var i = 1;
            var arr = JSON.parse(res);
      // console.log(arr)
      $("#per_id").val(arr.emp_id);
      // alert(arr.task);
      $("#per_name").val(arr.fname+" "+arr.mname+" "+arr.lname);
      var html = "";
      var i=1;
      arr.per_act.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="<td>"+item.reason+"</td>";
        html+="</tr>";
        i++;
      });
      $("#per_modal").html(html);
      $("#personnel_modal").modal("show");
    }
  });
}
function equipment_act(id) {
  var req = $("#req").val();
  var form_data = {
    req : req,
    equipment_act : id
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
        // alert(res);
        var i = 1;
        var arr = JSON.parse(res);
        var html = "";
        $("#equipment").val(arr.eqpt_name);
        var i=1;
        arr.eqpt_act.forEach(function(item){
          html+="<tr class='gradeX'>";
          html+="<td>"+item.status+"</td>";
          html+="<td>"+item.work_started+"</td>";
          html+="<td>"+item.work_stopped+"</td>";
          html+="<td>"+item.work_resumed+"</td>";
          html+="<td>"+item.work_completed+"</td>";
          html+="<td>"+item.reason+"</td>";
          html+="</tr>";
          i++;
        });
        $("#equipment_modal_data").html(html);
        $("#equipment_modal").modal("show");
      }
    });
}