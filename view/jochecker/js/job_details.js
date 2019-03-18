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
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
        }else if(item.status == "queued") {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
        }else {
          html+="<td><button class='btn btn-default btn-xs fa fa-eye' onclick='job_id("+req+")'></button></td>";
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
