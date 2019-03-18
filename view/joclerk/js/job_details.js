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
  function remove(id) {
    var id = "DICT-"+id;
    var user = $("#username").val();
    var form_data = {
      remove_id : id,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
      // alert(res);
      if (res == "removed") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Job removed!',
          type: 'success',
          shadow: true
        });
      }
    }
  });
  }
  function cancel_req(id) {
    var user = $("#username").val();
    var id = "DICT-"+id;

    var form_data = {
      cancel_req : id,
      user : user
    }
    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        if (res == "cancelled") {
          var notice = new PNotify({
            title: 'Success',
            text: 'Cancelled!.',
            type: 'success',
            shadow: true
          });
        }
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
        if (item.status == "pending") {
          status = "<button type='button' class='btn btn-primary btn-xs'>pending</button>";
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
        html+="<tr class='gradeX job_"+item.request_no+"'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        html+="<td><a href='?page=editform&req_no="+item.request_no+"><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-ban'></button>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
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
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var status;
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "queued") {
          status = "<button type='button' class='btn btn-primary btn-xs'>queued</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-success btn-xs'>working</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs'>cancelled</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs'>activated</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs'>completed</button>";
        }else if(item.status == "closed"){
          status = "<button type='button' class='btn btn-danger btn-xs'>closed</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-danger btn-xs'>stopped</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        html+="<tr class='gradeX job_"+item.request_no+"'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        if (item.status == "closed" || item.status == "cancelled" || item.status == "completed") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<a href='excel_expo.php?req_no="+item.request_no+"'><button class='btn btn-default btn-xs'><i class='fa fa-print'></i> excel</button></a>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a>|<button class='btn btn-default btn-xs fa fa-trash-o' title='Remove' onclick='return confirm('Are you sure?')?remove("+req+"):'';></button></td>";
        }else if(item.status == "queued") {
          html+="<td><a href='?page=editform&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<button class='btn btn-default btn-xs fa fa-ban' onclick='cancel_req("+req+")'></button>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a></td>";
        }else if(item.status == "activated") {
          html+="<td><a href='?page=editform&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<button class='btn btn-default btn-xs fa fa-ban' onclick='cancel_req("+req+")'></button>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a></td>";
        }else {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<a href='?page=view_activity&view_activity_id="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-file-text-o'></button></a></td>";
        }
        html+="</tr>";
        i++;
      });
      $("#append_job").html(html);
    }
  });
    }
    setInterval(list,500);
    $("#submit_status").click(function(){
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
  var req = $("#job_req").val();
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
      $("#optr_task").val(arr.task);
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
  var req = $("#job_req").val();
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
      $("#per_task").val(arr.task);
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
  var req = $("#job_req").val();
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