
function add_emp(id) {
  var req_no = $("#mp_req_no").val();
  var username = $("#username").val();
  var nos = $("#nos_"+id).val();
  var mp_code = $("#mp_"+id).val();
  // alert(mp_code);
  var add_emp = "true";
  var form_data = {
    id : id,
    req_no : req_no,
    nos : nos,
    mp_code : mp_code,
    username : username,
    add_emp : add_emp
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data :form_data,
    cache : false,
    success : function (res) {
      if (res == "inserted") {
        new PNotify({
          title: 'Success',
          text: 'Added successfully',
          type: 'success',
          shadow: true
        });
        $(".mpadd_"+id).css("background","green");
        $(".mpadd_"+id).fadeOut(1000);
      }
      if (res == "existed") {
        new PNotify({
          title: 'Error',
          text: 'Employee already assigned!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'Error occured,try again!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "exceeded") {
        new PNotify({
          title: 'Error',
          text: 'Manpower personel already maxed out!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}


function add_emp_optr(id) {
  var req_no = $("#req_no").val();
  var username = $("#username").val();
  var eqpt_id = $("#eqpt_id").val();
  var no_eq = $("#no_eq").val();
  var add_emp_optr = "true";
  // alert(eqpt_id);
  var form_data = {
    id : id,
    req_no : req_no,
    username : username,
    eqpt_id : eqpt_id,
    no_eq : no_eq,
    add_emp_optr : add_emp_optr
  }
  $.ajax({
    url : "passer.php",
    type : "POST",
    data :form_data,
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "inserted") {
        new PNotify({
          title: 'Success',
          text: 'Added successfully',
          type: 'success',
          shadow: true
        });
        $(".eqptadd_"+id).css("background","green");
        $(".eqptadd_"+id).fadeOut(1000);
      }
      if (res == "existed") {
        new PNotify({
          title: 'Error',
          text: 'Operator already assigned!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "error") {
        new PNotify({
          title: 'Error',
          text: 'Error occured,try again!',
          type: 'error',
          shadow: true
        });
      }
      if (res == "exceeded") {
        new PNotify({
          title: 'Error',
          text: 'Operator already maxed out!',
          type: 'error',
          shadow: true
        });
      }
    }
  });
}


function manpower_req(id) {
// alert(id);
$.ajax({
  url : "passer.php",
  type : "POST",
  data : {manpower_id : id},
  cache : false,
  success : function (res) {
    
    var i = 1;
    var arr = JSON.parse(res);
    var html = "";
    arr.forEach(function(item){
      html += "<tr class='mpadd_"+item.id+"'>";
      html += "<td>" + i + "<input type='hidden' id='nos_"+item.id+"' value='"+item.nos+"'></td>"
      html += "<td>" + item.fname + " " + item.mname + " " + item.lname + "</td>"
      html += "<td>" + item.status + "<input type='hidden' id='mp_"+item.id+"' value='"+item.mp_code+"'></td>"
      html += "<td><button type='button' class='btn btn-outline-info btn-sm' onclick='add_emp("+item.id+")'>Assign</button></td>"
      html += "</tr>";
      i++;
    });
    $("#append_data").append(html);
    $("#modal_mp").modal('show');
  }
});
}

function equipment_req(id) {
// alert(id);
$("#eqpt_id").val(id);
var eq_code = $("#no_eqpt_"+id).val();
$("#no_eq").val(eq_code);
$.ajax({
  url : "passer.php",
  type : "POST",
  data : {equipment_id : id},
  cache : false,
  success : function (res) {
      // alert(res); 
      var i = 1;
      var arr = JSON.parse(res);
      var html = "";
      arr.forEach(function(item){
        html += "<tr class='eqptadd_"+item.id+"'>";
        html += "<td>" + i + "</td>";
        html += "<td>" + item.emp_id + "</td>";
        html += "<td>" + item.fname + " " + item.mname + " " + item.lname + "</td>";
        html += "<td><button type='button' class='btn btn-outline-info btn-sm' onclick='add_emp_optr("+item.id+")'>Assign</button></td>"
        html += "</tr>";
        i++;
      });
      $("#append_data2").append(html);
      $("#modal_eqpt").modal('show');
    }
  });
}


$(document).ready(function(){
  $("#close_mp").click(function(){
    $("#modal_mp").modal('show');
    window.location.reload(true);
  });
  $("#close_eqpt").click(function(){
    $("#modal_eqpt").modal('show');
    window.location.reload(true);
  });
});