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
  function cancel(id) {
    var reason = prompt("Please enter your reason:", "");
    if (reason == null || reason == "") {
      alert("Enter a reason to proceed");
    }else {
      var id = "DICT-"+id;
      var user = $("#username").val();
      var form_data = {
        cancel_req : id,
        req : id,
        user : user,
        reason : reason
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
              text: 'Cancelled Successfully!.',
              type: 'success',
              shadow: true
            });
          }
          if (res == "error") {
            var notice = new PNotify({
              title: 'Error',
              text: 'Error occured, Try again!.',
              type: 'error',
              shadow: true
            });
          }
        }
      });
    }
  }


  $(document).ready(function(){
    var list = function(){
      var joblist = "true";
      var user = $("#username").val();
      var form_data = {
        user : user,
        joblist : joblist
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
        }else {
          status = "<button type='button' class='btn btn-default btn-xs'>No status</button>";
        }
        html+="<tr class='gradeX job_"+item.request_no+"'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.request_no+"<input type='hidden' id='req_no_"+item.id+"'></td>";
        html+="<td>"+item.jobcode+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.jobdate+"</td>";
        html+="<td>"+status+"</td>";
        if (item.status == "working" || item.status == "stopped") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
        }else{
          html+="<td><a href='?page=editform&req_no="+item.request_no+"'><button class='btn btn-default btn-xs fa fa-pencil'></button></a>|<button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button>|<button class='btn btn-default btn-xs fa fa-ban' onclick='cancel("+req+")'></button></td>";
        }
        html+="</tr>";
        i++;
      });
      $("#append_job").html(html);
    }
  });
    }
    setInterval(list,500);
  });