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
        html+="<td><button class='btn btn-default btn-sm fa fa-eye' onclick='job_id("+req+")'></button>|<button class='btn btn-danger btn-sm fa fa-trash-o' onclick='del_job("+req+")'></button></td>";
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
      var foreman = "";
      var removed = "";
      arr.forEach(function(item){
        var req = item.request_no.replace("DICT-","");
        if (item.status == "queued") {
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>queued</button>";
        }else if(item.status == "working"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>working</button>";
        }else if(item.status == "resumed"){
          status = "<button type='button' class='btn btn-primary btn-xs' onclick='status("+req+")'>resumed</button>";
        }else if(item.status == "closed"){
          status = "<button type='button' class='btn btn-danger btn-xs' onclick='status("+req+")'>closed</button>";
        }else if(item.status == "cancelled"){
          status = "<button type='button' class='btn btn-danger btn-xs' onclick='status("+req+")'>cancelled</button>";
        }else if(item.status == "activated"){
          status = "<button type='button' class='btn btn-info btn-xs' onclick='status("+req+")'>activated</button>";
        }else if(item.status == "completed"){
          status = "<button type='button' class='btn btn-success btn-xs' onclick='status("+req+")'>completed</button>";
        }else if(item.status == "stopped"){
          status = "<button type='button' class='btn btn-danger btn-xs' onclick='status("+req+")'>stopped</button>";
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        // if (item.foreman_name == "" && item.foreman_id == "0") {
        //   foreman = "<button type='button' class='btn btn-default btn-xs' onclick='foreman("+item.id+")'> Assign</button>";
        // }else {
        //   foreman = item.foreman_name;
        // }
        if (item.is_removed == "0") {
          removed = "NO";
        }else {
          removed = "YES";
        }
        html+="<tr class='gradeX job_"+item.request_no+"'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+item.foreman_name+"</td>";
        html+="<td>"+status+"</td>";
        html+="<td>"+removed+"</td>";
        html+="<td>"+item.removed_by+"</td>";
        html+="<td>"+item.encoded_by+"</td>";
        html+="<td><a href='?page=fillin&id="+item.request_no+"'><button class='btn btn-default btn-sm fa fa-users'></button></a>|<a href='?page=activity&activity_id="+item.request_no+"'><button class='btn btn-default btn-sm fa fa-wrench'></button></a>|<button class='btn btn-default btn-sm fa fa-eye' onclick='job_id("+req+")'></button>|<a href='?page=personnel_activity&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-cogs'></button></a>|<a href='?page=editform&req_no="+item.request_no+"'><button class='btn btn-default btn-sm fa fa-pencil'></button></a>|<button class='btn btn-default btn-sm fa fa-trash-o' onclick='del_job("+req+")'></button>|<a href='excel_expo.php?req_no="+item.request_no+"'><button class='btn btn-default btn-xs'><i class='fa fa-print'></i> excel</button></a>|<button type='button' class='btn btn-default btn-xs' onclick='foreman("+item.id+")'> Assign</button></td>";
        html+="</tr>";
        i++;
      });
      $("#append_job").html(html);
    }
  });
    }
    setInterval(list,500);



    $("#submit_status").click(function(){
      var reason = prompt("Please enter your reason:", "");
      var accom = prompt("Please enter Job Accomplishment:", "");
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
      if (reason == null || reason == "" && timestamp == null || timestamp == "" && accom == null || accom == "") {
        alert("Enter a reason to proceed");
      } else {
        var submit_status = "true";
        var id = $("#request_no").val();
        var user = $("#username").val();
        var status = $("#status_code").val();
        var form_data = {
          reason : reason,
          timestamp : timestamp,
          accom : accom,
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
        if (res == "no_foreman") {
          var notice = new PNotify({
            title: 'Error',
            text: 'No foreman assigned!',
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