//start commodity adding by javascript array
var comm = [];

function insertcomm() {
  var shipper, commodity, qty,unit,destination;
  shipper = document.getElementById("shipper").value;
  commodity = document.getElementById("commodity").value;
  qty = document.getElementById("qty").value;
  unit = document.getElementById("unit").value;
  destination = document.getElementById("destination").value;
  if (shipper != "" || commodity != "" || qty != "" || unit != "" || destination != "") {
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
  }if (shipper != "" && commodity != "" && qty != "" && unit != "" && destination != "") {
    comm.push({
      shipper:shipper,
      commodity:commodity,
      qty:qty,
      unit:unit,
      destination:destination
    });
    clearAndShowcomm();
  }else{
   if (shipper == null || shipper == "" || commodity == null || commodity == "" || qty == null || qty == "" ||
    unit == null || unit == "" || destination == null || destination == "") {
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
  html += "<th>ACTION</th>";
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  comm.forEach(function(item){
    html += "<tr>";
    html += "<td>" + i + "</td>"
    html += "<td>" + item.shipper + "</td>"
    html += "<td>" + item.commodity + "</td>"
    html += "<td>" + item.qty + "</td>"
    html += "<td>" + item.unit + "</td>"
    html += "<td>" + item.destination + "</td>"
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
  html += "<th>NO#. OF OPTR</th>";
  html += "<th>ACTION</th>";
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";
  eqpt_temp.forEach(function(item){
   var optr_dbl='';
   if (item.w_optr == '1') {
    optr_dbl = 'YES';
  }else {
    optr_dbl = 'NO';
  }
  html += "<tr>";
  html += "<td>" + i + "</td>"
  html += "<td>" + item.eq_name + "</td>"
  html += "<td>" + item.no_of_eqpt + "</td>"
  html += "<td>" + optr_dbl + "</td>"
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

  var mp_code,nos;
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

  mp.splice(id,1);
  mp_temp.splice(id,1);
  var manpowermsg = document.getElementById("display_mp");
  manpowermsg.innerHTML = manpower();
}
$(document).ready(function(){

  $("#submit_all").click(function(){

    var requestor = $('#requestor').val();
    var requestno = $('#requestno').val();
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
    var commjsonstring = JSON.stringify(comm);
    var eqptjsonstring = JSON.stringify(eqpt);
    var mpjsonstring = JSON.stringify(mp);
    var submit_jobform = "true";
    if (requestor != "" || requestno != "" || address != "" || requestdate != "" ||
      jobcode != "" || description != "" || jobdate != "" || 
      joblocation != "" || est != "" || vessel != "" || 
      voyage != "" || vanno != "" || truckno != "") {
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
      if (vessel != null || vessel != "") {
        var msg = document.getElementById('vessel_error');
        msg.innerHTML = "";
      }
      if (voyage != null || voyage != "") {
        var msg = document.getElementById('voyage_error');
        msg.innerHTML = "";
      }
      if (vanno != null || vanno != "") {
        var msg = document.getElementById('vanno_error');
        msg.innerHTML = "";
      }
      if (truckno != null || truckno != "") {
        var msg = document.getElementById('truckno_error');
        msg.innerHTML = "";
      }
    }if (requestor == null || requestor == "" || requestno == null || requestno == "" || address == null || address == "" ||
      requestdate == null || requestdate == "" || jobcode== null || jobcode == "" || description == null || description == "" || 
      jobdate == null || jobdate == "" || joblocation == null || joblocation == "" || est == null || est == "" || 
      vessel == null || vessel == "" || voyage == null || voyage == "" || vanno == null || vanno == "" ||
      truckno == null || truckno == "") {
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
      if (vessel == null || vessel == "") {
        var msg = document.getElementById('vessel_error');
        msg.innerHTML = "*Input vessel!";
      }
      if (voyage == null || voyage == "") {
        var msg = document.getElementById('voyage_error');
        msg.innerHTML = "*Input voyage!";
      }
      if (vanno == null || vanno == "") {
        var msg = document.getElementById('vanno_error');
        msg.innerHTML = "*Input van number!";
      }
      if (truckno == null || truckno == "") {
        var msg = document.getElementById('truckno_error');
        msg.innerHTML = "*Input truck number!";
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
        commjsonstring : commjsonstring,
        eqptjsonstring : eqptjsonstring,
        mpjsonstring : mpjsonstring,
        submit : submit_jobform
      }
    // console.log(eqptjsonstring)
    // console.log(mpjsonstring)
    $.ajax({
      url : "insert.php",
      type : "POST",
      data : form_data,
      cache : false,
      success : function (res) {
        if (res ==true) {
          var notice = new PNotify({
            title: 'Notification',
            text: 'Successfully created job order request!.',
            type: 'success',
            width: "100%"
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
      window.location.replace("../index.php");
    },2000);
     
   }if(res == false){
     var notice = new PNotify({
      title: 'Notification',
      text: 'Request number not available!, Cancel this form and create new',
      type: 'error',
      width: "100%"
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