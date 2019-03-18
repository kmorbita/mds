// $(document).ready(function(){

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
  function select_job(id) {
    var user_id = $("#foreman_id").val();
    var name = $("#name").val();
    var username = $("#username").val();
    var select_job = "true";
    var form_data = {
      select_job : select_job,
      name : name,
      username : username,
      id:id,
      user_id : user_id
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        if (res == "selected") {
        new PNotify({
          title: 'Success',
          text: 'Job Selected!',
          type: 'success',
          shadow: true
        });
      }
      }
    });
  }
  function working(id) {
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

    var id = "DICT-"+id;
    var user = $("#username_session").val();
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
      if (timestamp == null || timestamp == "") {
        alert("Enter timestamp to proceed");
      }else {
    var form_data = {
      working_id : id,
      timestamp : timestamp,
      user : user
    }
  // alert(id);
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "working") {
        new PNotify({
          title: 'Success',
          text: 'Working!',
          type: 'success',
          shadow: true
        });
        setTimeout(function(){
          window.location.reload(true);
        },1000);
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'Error occcured, try again',
          type: 'error',
          shadow: true
        });
      }
      if (res == "no_records") {
        new PNotify({
          title: 'Error',
          text: 'No Personnel dispatched, notify timekeeper',
          type: 'error',
          shadow: true
        });
      }
      if (res == "no_personnel") {
        new PNotify({
          title: 'Error',
          text: 'No Personnel dispatched, notify timekeeper',
          type: 'error',
          shadow: true
        });
      }
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
}

function stop(id) {
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
  var id = "DICT-"+id;
  var reason = prompt("Please enter your reason:", "");
  var accom = prompt("Please enter Job Accomplishment:", "");
  var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
  if (reason == null || reason == "" && timestamp == null || timestamp == "" && accom == null || accom == "") {
    alert("Enter a reason to proceed");
  } else {
    var notes = reason;
    var stop_req = "true";
    var user = $("#username").val();
    var form_data = {
      user : user,
      timestamp : timestamp,
      id : id,
      accom : accom,
      notes : notes,
      stop_req : stop_req
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        // alert(res);
        if (res == "stopped") {
          new PNotify({
            title: 'Success',
            text: 'Job request stopped!',
            type: 'success',
            shadow: true
          });
        }
        if (res == "error") {
          new PNotify({
            title: 'Error',
            text: 'Error occcured, try again',
            type: 'error',
            shadow: true
          });
        }
        if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
      }
    });
  }
}

function pause(id) {
  var id = "DICT-"+id;
  var pause_req = "true";
  var user = $("#username").val();
  var form_data = {
    user : user,
    id : id,
    pause_req : pause_req
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "paused") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Job request paused!',
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
    }
  });
}

function resume(id) {
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
  if (timestamp == null || timestamp == "") {
    alert("Enter timestamp to proceed");
  }else {
  var id = "DICT-"+id;
  var resume_req = "true";
  var user = $("#username").val();
  var form_data = {
    user : user,
    timestamp : timestamp,
    id : id,
    resume_req : resume_req
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "resumed") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Job request resumed!',
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
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
}

function complete(id) {
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
  var accom = prompt("Please enter Job Accomplishment:", "");
  var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
  if (timestamp == null || timestamp == "" && accom == null || accom == "") {
    alert("Enter timestamp to proceed");
  }else {
  var id = "DICT-"+id;
  var complete_req = "true";
  var user = $("#username").val();
  var form_data = {
    user : user,
    accom : accom,
    timestamp : timestamp,
    id : id,
    complete_req : complete_req
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "completed") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Job request completed!',
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
      if (res == "date") {
        new PNotify({
          title: 'Error',
          text: 'Invalid Date, Try again!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}
}



var jobs = function() {
  $(document).ready(function(){
    $("#working_jobs").click(function(){
      var user_id = $("#user_id").val();
      var working_jobs = "true";
        var form_data = {
          working_jobs : working_jobs,
          user_id : user_id
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
      var status;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "queued") {
          status = "<button type='button' class='btn btn-warning btn-xs'>queued</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>working</button>";
        }else if(item.status == "resumed"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>resumed</button>";
        }else if(item.status == "paused"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>paused</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-danger btn-xs'>stopped</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs'>activated</button>";
        }else if(item.status == "closed"){
          status = "<button type='button' class='btn btn-danger btn-xs'>closed</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs'>completed</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        if (item.status == "closed") {
         html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a></td>";
         }else if (item.status == "cancelled") {
           html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a></td>";
         }else if (item.status == "completed") {
           html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a></td>";
         }else if (item.status == "activated") {
           html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='working("+req+")'></button></td>";
         }else if (item.status == "stopped") {
           html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='resume("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button></td>";
         }else if (item.status == "resumed") {
           html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button></td>";
         }else {
          html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button></td>";
        }
       html+="</tr>";
       i++;
     });
      $("#append_job").html(html);
    }
  });

});
    $("#view_all").click(function(){
      window.location.reload(true);
    });
  });
}
setInterval(jobs,500);

$(document).ready(function(){
  var list = function(){
    var joblist = $("#user_id").val();
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : {joblist : joblist},
      cache : false,
      success : function (res) {
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)

      var html = "";
      var status;
      var foreman;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "queued") {
          status = "<button type='button' class='btn btn-warning btn-xs'>queued</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>working</button>";
        }else if(item.status == "resumed"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>resumed</button>";
        }else if(item.status == "paused"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>paused</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-danger btn-xs'>stopped</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs'>activated</button>";
        }else if(item.status == "closed"){
          status = "<button type='button' class='btn btn-danger btn-xs'>closed</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs'>completed</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        if (item.foreman_name == "" && item.foreman_id == "0" && item.status == "activated") {
          foreman = "<button type='button' class='btn btn-default btn-xs' onclick='select_job("+item.id+")'> Select</button>";
        }else {
          foreman = item.foreman_name;
        }
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+foreman+"</td>";
        html+="<td>"+status+"</td>";
      //   if (item.status == "closed") {
      //    html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else if (item.status == "cancelled") {
      //    html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else if (item.status == "completed") {
      //    html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else if (item.status == "activated") {
      //    html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='working("+req+")'></button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else if (item.status == "stopped") {
      //    html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='resume("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else if (item.status == "resumed") {
      //    html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      //  }else {
      //   html+="<td><a href='?page=task&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-tasks'></button></a>|<a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      // }
        html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      
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
    var reason = prompt("Please enter your reason:", "");
    var timestamp = prompt("Enter date and time \nDatetime format ( YYYY-MM-DD hr:min:sec ) time is 24 hr. format:", datetime);
  if (reason == null || reason == "" && timestamp == null || timestamp == "") {
        if (reason == null || reason == "") {
            alert("Enter a reason to proceed");
        }
        if (timestamp == null || timestamp == "") {
            alert("Enter date and time to proceed");
        }
  } else {
    var submit_status = "true";
    var id = $("#request_no").val();
    var user = $("#username").val();
    var status = $("#status_code").val();
    var form_data = {
      reason : reason,
      timestamp : timestamp,
      submit_status : submit_status,
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
        if (res == "date") {
          var notice = new PNotify({
            title: 'Error',
            text: 'Invalid Date, try again!',
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
  }
});
});


function status(id) {
  // alert(id);
  var id = "DICT-"+id;
  $("#request_no").val(id);
  $("#status").modal('show');
}

$(document).ready(function(){
  var list2 = function(){
    var user_id = $("#foreman_id").val();
    var working_jobs2 = "true";
        var form_data = {
          working_jobs2 : working_jobs2,
          user_id : user_id
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

      var html = "";
      var status;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "queued") {
          status = "<button type='button' class='btn btn-warning btn-xs'>queued</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>working</button>";
        }else if(item.status == "resumed"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>resumed</button>";
        }else if(item.status == "paused"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>paused</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-danger btn-xs'>stopped</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs' onclick='status("+req+")'>activated</button>";
        }else if(item.status == "closed"){
          status = "<button type='button' class='btn btn-danger btn-xs'>closed</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs'>completed</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        if (item.status == "closed") {
         html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "cancelled") {
         html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "completed") {
         html+="<td><a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "activated") {
         html+="<td><a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='working("+req+")' id='sampledate'></button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "stopped") {
         html+="<td><a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-play' onclick='resume("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "resumed") {
         html+="<td><a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else if (item.status == "queued") {
         html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
       }else {
        html+="<td><a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<button class='btn btn-default btn-xs fa fa-stop' onclick='stop("+req+")'></button>|<button class='btn btn-default btn-xs' onclick='complete("+req+")'>complete</button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
      }
      html+="</tr>";
      i++;
    });
$("#append_job2").html(html);
}
});
}
setInterval(list2,500);
});