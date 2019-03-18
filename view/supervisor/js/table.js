var job_activity_list = function () {
	var req = $("#req").val();
	$.ajax({
    url : "passer.php",
    type : "POST",
    data : {job_activity : req},
    cache : false,
    success : function (res) {
    	var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.jobdescription+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.remarks+"</td>";
        html+="</tr>";
        i++;
      });
      $("#job_activity").html(html);
    }
  });
}
setInterval(job_activity_list,1000)


var all_operator = function () {
	var req = $("#req").val();
	$.ajax({
    url : "passer.php",
    type : "POST",
    data : {all_operator : req},
    cache : false,
    success : function (res) {
    	var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
        html+="<td>"+item.mp_name+"</td>";
        html+="</tr>";
        i++;
      });
      $("#all_operator").html(html);
    }
  });
}
setInterval(all_operator,1000)


var all_gang = function () {
	var req = $("#req").val();
	$.ajax({
    url : "passer.php",
    type : "POST",
    data : {all_gang : req},
    cache : false,
    success : function (res) {
    	var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
        html+="<td>"+item.mp_name+"</td>";
        html+="</tr>";
        i++;
      });
      $("#all_gang").html(html);
    }
  });
}
setInterval(all_gang,1000)





var personnel_activity = function () {
	var req = $("#req").val();
	$.ajax({
    url : "passer.php",
    type : "POST",
    data : {personnel_activity : req},
    cache : false,
    success : function (res) {
    	var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
        html+="<td>"+item.mp_name+"</td>";
        html+="<td>"+item.task+"</td>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.remarks+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_paused+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="</tr>";
        i++;
      });
      $("#personnel_activity").html(html);
    }
  });
}
setInterval(personnel_activity,1000)


var operator_activity = function () {
	var req = $("#req").val();
	$.ajax({
    url : "passer.php",
    type : "POST",
    data : {operator_activity : req},
    cache : false,
    success : function (res) {
    	var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
        html+="<tr class='gradeX'>";
        html+="<td>"+i+"</td>";
        html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
        html+="<td>"+item.task+"</td>";
        html+="<td>"+item.status+"</td>";
        html+="<td>"+item.remarks+"</td>";
        html+="<td>"+item.work_started+"</td>";
        html+="<td>"+item.work_paused+"</td>";
        html+="<td>"+item.work_stopped+"</td>";
        html+="<td>"+item.work_resumed+"</td>";
        html+="<td>"+item.work_completed+"</td>";
        html+="</tr>";
        i++;
      });
      $("#operator_activity").html(html);
    }
  });
}
setInterval(operator_activity,1000)