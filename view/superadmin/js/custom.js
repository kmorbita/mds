$(document).on('change', '.jobcode', function(e) {
  var job_code = this.options[e.target.selectedIndex].text;
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {job_code : job_code},
    cache : false,
    success : function (res) {
      $("#joblocation").val(res);
    }
  });
});
function del_job(id) {
  var id = "DICT-"+id;
  $.ajax({
    url : "passer.php",
    type : "POST",
    data : {del_job : id},
    cache : false,
    success : function (res) {
      // alert(res);
      if (res == "deleted") {
        var notice = new PNotify({
          title: 'Success',
          text: 'Deleted successfully!.',
          type: 'success',
          shadow: true
        });
        $(".job_"+id).css("background","red");
        $(".job_"+id).fadeOut(1000);
      }
    }
  });
}











































//start commodity adding by javascript array
var comm = [];
var comm_temp = [];

function insertcomm() {
  var shipper, commodity, qty,unit,destination;
  shipper = document.getElementById("shipper").value;
  commodity = document.getElementById("commodity").value;
  qty = document.getElementById("qty").value;
  unit = document.getElementById("unit").value;
  box = document.getElementById("box").value;
  weight = document.getElementById("weight").value;
  destination = document.getElementById("destination").value;
  if (shipper != "" || commodity != "" || qty != "" || unit != "" || destination != "" || box != "" || weight != "") {
    if (shipper != null || shipper != "") {
      var msg = document.getElementById('shipper_error');
      msg.innerHTML = "";
    }
    if (commodity != null || commodity != "") {
      var msg = document.getElementById('commodity_error');
      msg.innerHTML = "";
    }
    if (qty != null || qty != "") {
      var msg = document.getElementById('qty_error');
      msg.innerHTML = "";
    }
    if (unit != null || unit != "") {
      var msg = document.getElementById('unit_error');
      msg.innerHTML = "";
    }
    if (destination != null || destination != "") {
      var msg = document.getElementById('destination_error');
      msg.innerHTML = "";
    }
    if (box != null || box != "") {
      var msg = document.getElementById('box_error');
      msg.innerHTML = "";
    }
    if (weight != null || weight != "") {
      var msg = document.getElementById('weight_error');
      msg.innerHTML = "";
    }
  }if (shipper != "" && commodity != "" && qty != "" && unit != "" && destination != "" && box != "" && weight != "") {
    var sh = unit.split("=");
    var sh_id = sh[0];
    var sh_name = sh[1];

    var box = box.split("=");
    var b_id = box[0];
    var b_name = box[1];

    var weight = weight.split("=");
    var w_id = weight[0];
    var w_name = weight[1];

    comm.push({
      shipper:shipper,
      commodity:commodity,
      qty:qty,
      unit:sh_id,
      box:b_id,
      weight:w_id,
      destination:destination
    });
    comm_temp.push({
      shipper:shipper,
      commodity:commodity,
      qty:qty,
      unit:sh_name,
      box:b_name,
      weight:w_name,
      destination:destination
    });
    clearAndShowcomm();
  }else{
    if (shipper == null || shipper == "" || commodity == null || commodity == "" || qty == null || qty == "" ||
      unit == null || unit == "" || destination == null || destination == "" || box == null || box == "" 
      || weight == null || weight == "") {
      if (shipper == null || shipper == "") {
        var msg = document.getElementById('shipper_error');
        msg.innerHTML = "*Input shipper!";
      }
      if (commodity == null || commodity == "") {
        var msg = document.getElementById('commodity_error');
        msg.innerHTML = "*Input commodity!";
      }
      if (qty == null || qty == "") {
        var msg = document.getElementById('qty_error');
        msg.innerHTML = "*Input quantity!";
      }
      if (unit == null || unit == "") {
        var msg = document.getElementById('unit_error');
        msg.innerHTML = "*Input unit!";
      }
      if (destination == null || destination == "") {
        var msg = document.getElementById('destination_error');
        msg.innerHTML = "*Input destination!";
      }
      if (box == null || box == "") {
        var msg = document.getElementById('box_error');
        msg.innerHTML = "*Select Box Type!";
      }
      if (weight == null || weight == "") {
        var msg = document.getElementById('weight_error');
        msg.innerHTML = "*Select Weight Per Box!";
      }
    }
  }
  
}

function clearAndShowcomm() {
  // Clear our fields
  document.getElementById("shipper").value="";
  document.getElementById("commodity").value="";
  document.getElementById("qty").value="";
  document.getElementById("unit").value="";
  document.getElementById("destination").value="";
  var commodityMsg = document.getElementById("display_comm");
  commodityMsg.innerHTML = commodity();
}

function commodity(){
  // var html = "";
  var html = "<table class='table table-bordered table-striped' id='comm'";
  // console.log(comm) 
  var i = 1;
  var i2 = 0;
  html += "<thead>";
  html += "<tr>";
  html += "<th>No#</th>";
  html += "<th>SHIPPER</th>";
  html += "<th>COMMODITY</th>";
  html += "<th>QTY</th>";
  html += "<th>UNIT</th>";
  html += "<th>DESTINATION</th>";
  html += "<th>BOX TYPE</th>";
  html += "<th>WEIGHT PER BOX</th>";
  html += "<th>ACTION</th>";
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  comm_temp.forEach(function(item){
    html += "<tr>";
    html += "<td>" + i + "</td>"
    html += "<td>" + item.shipper + "</td>"
    html += "<td>" + item.commodity + "</td>"
    html += "<td>" + item.qty + "</td>"
    html += "<td>" + item.unit + "</td>"
    html += "<td>" + item.destination + "</td>"
    html += "<td>" + item.box + "</td>"
    html += "<td>" + item.weight + "</td>"
    html += "<td><button type='button' class='btn btn-outline-info btn-sm' onclick='javascript:deletecomm("+i2+")'>Remove</button></td>"
    html += "</tr>";
    i++;
    i2++;
  });
  html += "</tbody>";
  html += "</table>";
  return html;
}

function deletecomm(id) {
  // alert(id);
  comm.splice(id,1);
  comm_temp.splice(id,1);
  var commodityMsg = document.getElementById("display_comm");
  commodityMsg.innerHTML = commodity();
}
//end commodity adding by javascript array
// *************************************************************************************************************************
// *************************************************************************************************************************
// *************************************************************************************************************************


//start equipments adding by javascript array
var eqpt = [];
var eqpt_temp = [];
var temp_eqpt = [];

function inserteqpt() {
  // alert("got")
  var eq_code, no_of_eqpt, w_optr;
  // shipper =shipperInput.value;
  eq_code = document.getElementById("eq_code").value;
  no_of_eqpt = document.getElementById("no_of_eqpt").value;
  w_optr = document.getElementById("w_optr").value;
  if (eq_code != "" || no_of_eqpt != "" || w_optr != "") {
    if (eq_code != null || eq_code != "") {
      var msg = document.getElementById('eq_code_error');
      msg.innerHTML = "";
    }
    if (no_of_eqpt != null || no_of_eqpt != "") {
      var msg = document.getElementById('no_of_eqpt_error');
      msg.innerHTML = "";
    }
    if (w_optr != null || w_optr != "") {
      var msg = document.getElementById('w_optr_error');
      msg.innerHTML = "";
    }
  }if (eq_code != "" && no_of_eqpt != "" && w_optr != "") {
    var eq = eq_code.split("=");
    var eq_id = eq[0];
    var eq_name = eq[1];

      eqpt.push({
        eq_id:eq_id,
        no_of_eqpt:no_of_eqpt,
        w_optr:w_optr
      });
      // console.log(eqpt)
      
      eqpt_temp.push({
        eq_name:eq_name,
        no_of_eqpt:no_of_eqpt,
        w_optr:w_optr
      });
    
    clearAndShowceqpt();
  }else{
    if (eq_code == null || eq_code == "" || no_of_eqpt == null || no_of_eqpt == "" || w_optr == null || w_optr == "") {
      if (eq_code == null || eq_code == "") {
        var msg = document.getElementById('eq_code_error');
        msg.innerHTML = "*Select equipment code!";
      }
      if (no_of_eqpt == null || no_of_eqpt == "") {
        var msg = document.getElementById('no_of_eqpt_error');
        msg.innerHTML = "*Input number of equipment!";
      }
      if (w_optr == null || w_optr == "") {
        var msg = document.getElementById('w_optr_error');
        msg.innerHTML = "*Select operator if needed or not!";
      }
    }
  }
}

function clearAndShowceqpt() {
  // Clear our fields
  document.getElementById("eq_code").value="";
  document.getElementById("no_of_eqpt").value="";
  document.getElementById("w_optr").value="";
  var equipmentmsg = document.getElementById("display_eqpt");
  equipmentmsg.innerHTML = equipment();
}

function equipment(){
  var html = "<table class='table table-bordered table-striped' id='equipments'";
  // console.log(eqpt) 
  var i = 1;
  var i2 = 0;
  html += "<thead>";
  html += "<tr>";
  html += "<th>No#</th>";
  html += "<th>EQPT. CODE</th>";
  html += "<th>NO#. OF EQPT</th>";
  html += "<th>W/ Operator</th>";
  html += "<th>ACTION</th>";
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  var woptr='';
  eqpt_temp.forEach(function(item){
    if (item.w_optr == '1') {
      woptr='Yes';
    }else{
      woptr='No';
    }
    html += "<tr>";
    html += "<td>" + i + "</td>"
    html += "<td>" + item.eq_name + "</td>"
    html += "<td>" + item.no_of_eqpt + "</td>"
    html += "<td>" + woptr + "</td>"
    html += "<td><button type='button' class='btn btn-outline-info btn-sm' onclick='javascript:deleteeqpt("+i2+")'>Remove</button></td>"
    html += "</tr>";
    i++;
    i2++;
  });
  html += "</tbody>";
  html += "</table>";
  return html;
}

function deleteeqpt(id) {
  // alert(id);
  eqpt.splice(id,1);
  eqpt_temp.splice(id,1);
  var equipmentmsg = document.getElementById("display_eqpt");
  equipmentmsg.innerHTML = equipment();
}

//end equipments adding by javascript array
// *************************************************************************************************************************
// *************************************************************************************************************************
// *************************************************************************************************************************

//start equipments adding by javascript array
var mp = [];
var mp_temp = [];

function insertmp() {
  // alert("got")
  var mp_code,nos;
  // shipper =shipperInput.value;
  mp_code = document.getElementById("mp_code").value;
  nos = document.getElementById("nos").value;
  if (mp_code != "" || nos != "") {
    if (mp_code != null || mp_code != "") {
      var msg = document.getElementById('mp_code_error');
      msg.innerHTML = "";
    }
    if (nos != null || nos != "") {
      var msg = document.getElementById('nos_error');
      msg.innerHTML = "";
    }
  }if (mp_code != "" && nos != "") {
    var mp2 = mp_code.split("=");
    var mp_id = mp2[0];
    var mp_name = mp2[1];
    mp.push({
      mp_id:mp_id,
      nos:nos
    });
    mp_temp.push({
      mp_name:mp_name,
      nos:nos
    });
    clearAndShowmp();
  }else{
    if (mp_code == null || mp_code == "" || nos == null || nos == "") {
      if (mp_code == null || mp_code == "") {
        var msg = document.getElementById('mp_code_error');
        msg.innerHTML = "*Select manpower code!";
      }
      if (nos == null || nos == "") {
        var msg = document.getElementById('nos_error');
        msg.innerHTML = "*Input number of manpower!";
      }
    }
  }
}

function clearAndShowmp() {
  // Clear our fields
  document.getElementById("mp_code").value="";
  document.getElementById("nos").value="";
  var manpowermsg = document.getElementById("display_mp");
  manpowermsg.innerHTML = manpower();
}

function manpower(){
  var html = "<table class='table table-bordered table-striped' id='manpower'";
  // console.log(mp) 
  var i = 1;
  var i2 = 0;
  html += "<thead>";
  html += "<tr>";
  html += "<th>No#</th>";
  html += "<th>MANPOWER CODE</th>";
  html += "<th>NOS</th>";
  html += "<th>ACTION</th>";
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  mp_temp.forEach(function(item){
    html += "<tr>";
    html += "<td>" + i + "</td>"
    html += "<td>" + item.mp_name + "</td>"
    html += "<td>" + item.nos + "</td>"
    html += "<td><button type='button' class='btn btn-outline-info btn-sm' onclick='javascript:deletemp("+i2+")'>Remove</button></td>"
    html += "</tr>";
    i++;
    i2++;
  });
  html += "</tbody>";
  html += "</table>";
  return html;
}

function deletemp(id) {
  // alert(id);
  mp.splice(id,1);
  mp_temp.splice(id,1);
  var manpowermsg = document.getElementById("display_mp");
  manpowermsg.innerHTML = manpower();
}
$(document).ready(function(){
  // $("#samp").click(function(){
  //   //   var notice = new PNotify({
  //   //   title: 'Notification',
  //   //   text: 'Some notification text.',
  //   //   type: 'success',
  //   //   width: "100%"
  //   // });
  //   $('#destinationError').val("*Input Destination!");
  //   alert("kinard");
  // });

  $("#submit_all").click(function(){

   // var data = [];
   var requestor = $('#requestor').val();
   var requestno = $('#requestno').val();
   var trk_type = $('#trk_type').val();
  // alert(requestno);
  var address = $('#address').val();
  var requestdate = $('#requestdate').val();
  var jobcode = $('#jobcode').val();
  var description = $('#description').val();
  var jobdate = $('#jobdate').val();
  var joblocation = $('#joblocation').val();
  var est = $('#est').val();
  var vessel = $('#vessel').val();
  var voyage = $('#voyage').val();
  var vanno = $('#vanno').val();
  var truckno = $('#truckno').val();
  var hatchno = $('#hatchno').val();
  var deckno = $('#deckno').val();
  var encoder = $('#encoder').val();
  var commjsonstring = JSON.stringify(comm);
  var eqptjsonstring = JSON.stringify(eqpt);
  var mpjsonstring = JSON.stringify(mp);
  var submit_jobform = "true";
  if (requestor != "" || requestno != "" || address != "" || requestdate != "" ||
    jobcode != "" || description != "" || jobdate != "" || 
    joblocation != "" || est != "") {
    if (requestor != null || requestor != "") {
      var msg = document.getElementById('requestor_error');
      msg.innerHTML = "";
    }
    if (requestno != null || requestno != "") {
      var msg = document.getElementById('requestno_error');
      msg.innerHTML = "";
    }
    if (address != null || address != "") {
      var msg = document.getElementById('address_error');
      msg.innerHTML = "";
    }
    if (requestdate != null || requestdate != "") {
      var msg = document.getElementById('requestdate_error');
      msg.innerHTML = "";
    }
    if (jobcode != null || jobcode != "") {
      var msg = document.getElementById('jobcode_error');
      msg.innerHTML = "";
    }
    if (description != null || description != "") {
      var msg = document.getElementById('description_error');
      msg.innerHTML = "";
    }
    if (jobdate != null || jobdate != "") {
      var msg = document.getElementById('jobdate_error');
      msg.innerHTML = "";
    }
    if (joblocation != null || joblocation != "") {
      var msg = document.getElementById('joblocation_error');
      msg.innerHTML = "";
    }
    if (est != null || est != "") {
      var msg = document.getElementById('est_error');
      msg.innerHTML = "";
    }
  }if (requestor == null || requestor == "" || requestno == null || requestno == "" || address == null || address == "" ||
    requestdate == null || requestdate == "" || jobcode== null || jobcode == "" || description == null || description == "" || 
    jobdate == null || jobdate == "" || joblocation == null || joblocation == "" || est == null || est == "") {
    if (requestor == null || requestor == "") {
      var msg = document.getElementById('requestor_error');
      msg.innerHTML = "*Input Requestor!";
    }
    if (requestno == null || requestno == "") {
      var msg = document.getElementById('requestno_error');
      msg.innerHTML = "*No Request number!, Cancel this form and create new";
    }
    if (address == null || address == "") {
      var msg = document.getElementById('address_error');
      msg.innerHTML = "*Input Address!";
    }
    if (requestdate == null || requestdate == "") {
      var msg = document.getElementById('requestdate_error');
      msg.innerHTML = "*Input Request Date!";
    }
    if (jobcode== null || jobcode == "") {
      var msg = document.getElementById('jobcode_error');
      msg.innerHTML = "*Input Job Code!";
    }
    if (description == null || description == "") {
      var msg = document.getElementById('description_error');
      msg.innerHTML = "*Input Job description!";
    }
    if (jobdate == null || jobdate == "") {
      var msg = document.getElementById('jobdate_error');
      msg.innerHTML = "*Input Job Date!";
    }
    if (joblocation == null || joblocation == "") {
      var msg = document.getElementById('joblocation_error');
      msg.innerHTML = "*Input Job Location!";
    }
    if (est == null || est == "") {
      var msg = document.getElementById('est_error');
      msg.innerHTML = "*Input Estimated time to complete!";
    }
  }else{
    var form_data = {
      requestor : requestor,
      requestno : requestno,
      address : address,
      requestdate : requestdate,
      jobcode : jobcode,
      description : description,
      jobdate : jobdate,
      joblocation : joblocation,
      est : est,
      vessel : vessel,
      voyage : voyage,
      vanno : vanno,
      truckno : truckno,
      hatchno : hatchno,
      deckno : deckno,
      encoder : encoder,
      trk_type : trk_type,
      commjsonstring : commjsonstring,
      eqptjsonstring : eqptjsonstring,
      mpjsonstring : mpjsonstring,
      submit : submit_jobform
    }

    $.ajax({
      url : "passer.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {

        if (res == "true") {
          var notice = new PNotify({
            title: 'Success',
            text: 'Successfully created job order request!.',
            type: 'success',
            shadow: true
          });

          

    // clear all inputs in job request form ->start
    $(".input").val("");
    // clear all inputs in job request form ->end
    
    // clear all array in commodities,equipments and manpower requests ->start
    var comm_length = comm.length-1;
    for (var i = 0; i <= comm_length; i++) {
     comm.splice(comm[i],1);
     var commodityMsg = document.getElementById("display_comm");
     commodityMsg.innerHTML = commodity();

   }

   var eqpt_length = eqpt.length-1;
   for (var i = 0; i <= eqpt_length; i++) {
     eqpt.splice(eqpt[i],1);
     eqpt_temp.splice(eqpt[i],1);
     var equipmentmsg = document.getElementById("display_eqpt");
     equipmentmsg.innerHTML = equipment();
   }

   var mp_length = mp.length-1;
   for (var i = 0; i <= mp_length; i++) {
     mp.splice(mp[i],1);
     mp_temp.splice(mp[i],1);
     var manpowermsg = document.getElementById("display_mp");
     manpowermsg.innerHTML = manpower();
   }
     // clear all array in commodities,equipments and manpower requests -> end 
     setTimeout(function(){
      window.location.replace("index.php");
    },2000);
     
   }if(res == "false"){
     var notice = new PNotify({
      title: 'Error',
      text: 'Request number not available!, Cancel this form and create new',
      type: 'error',
      shadow: true
    });
   }
   if(res == "error"){
     var notice = new PNotify({
      title: 'Error',
      text: 'Error occured, try again!',
      type: 'error',
      shadow: true
    });
   }
   if(res == "duplicate"){
     var notice = new PNotify({
      title: 'Error',
      text: 'Equipment can only be requested once, try again!',
      type: 'error',
      shadow: true
    });
   }
 }
});
  }
});
});
//end equipments adding by javascript array
// *************************************************************************************************************************
// *************************************************************************************************************************
// *************************************************************************************************************************
$(document).ready(function(){
// $('#datetimepicker1').datepicker();
// $('#timepicker1').timepicker();
// alert(datetimepicker({format: 'yyyy-mm-dd hh:ii'}));
});
function sample_shit() {
  // $('#dp').datetimepicker('show');
  // var date = $().datetimepicker('show');
  prompt("Enter your name",);
}