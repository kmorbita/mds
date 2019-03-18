<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/gif/png" href="asset/img/icon.PNG">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Davao International Container Terminal</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal"> -->
  <link rel="stylesheet" type="text/css" href="asset/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="asset/Datatables/css/dataTables.bootstrap4.min.css">
  <script type="text/javascript" src="asset/custom.js"></script>
  <style>
  hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0; 
    border-color: #000000;
  }
</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner" class="banner">
    <div class="bg-color">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img src="asset/img/mds.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class=""><a href="login.php">Login</a></li>
                <li class=""><a href="jobform.php">Job Request</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="panel-heading">
          </div><br><br><br><br>
          <div class="panel-body bgcolor" style="background-color: rgba(253,253,253,0.9);">
            <div class="card p-30">

              <div class="col-md-12" align="left">
                <div style="background-color: white">
                  <div class="col-md-2">
                    <img src="asset/img/DICT.jpg">
                  </div>
                  <div class="col-md-10">
                    DAVAO INTERNATIONAL CONTAINER TERMINAL<br>
                    BRGY. SAN PEDRO, PANABO CITY
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <form method="post">
                  <div class="col-md-12"><br>
                    <center><b>JOB ORDER REQUEST</b></center><br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>REQUESTOR</label>
                          <input type="text" class="form-control input" id="requestor" name="requestor">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>REQUEST NO</label>
                          <input type="text" class="form-control input" id="requestno" name="requestno">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>ADDRESS</label>
                          <input type="text" class="form-control input" id="address" name="address">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>REQUEST DATE</label>
                          <input type="date" class="form-control input" id="requestdate" name="requestdate">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>JOB CODE</label>
                          <input type="text" class="form-control input" id="jobcode" name="jobcode">
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>DESCRIPTION</label>
                          <input type="text" class="form-control input" id="description" name="description">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>JOB DATE</label>
                          <input type="date" class="form-control input" id="jobdate" name="jobdate">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>JOB LOCATION</label>
                          <input type="text" class="form-control input" id="joblocation" name="joblocation">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>EST</label>
                          <input type="text" class="form-control input" id="est" name="est">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                    <center><b>CARGO DETAILS</b></center>
                    <div class="col-md-5">
                      <center>CARRIER</center>
                      <div class="form-group">
                        <label>VESSEL</label>
                        <input type="text" class="form-control input" id="vessel" name="vessel">
                      </div>
                      <div class="form-group">
                        <label>VOYAGE</label>
                        <input type="text" class="form-control input" id="voyage" name="voyage">
                      </div>
                      <div class="form-group">
                        <label>VAN#</label>
                        <input type="text" class="form-control input" id="vanno" name="vanno">
                      </div>
                      <div class="form-group">
                        <label>TRUCK#</label>
                        <input type="text" class="form-control input" id="truckno" name="truckno">
                      </div>
                      <div class="form-group">
                        <label>HATCH#</label>
                        <input type="text" class="form-control input" id="hatchno" name="hatchno">
                      </div>
                      <div class="form-group">
                        <label>DECK#</label>
                        <input type="text" class="form-control input" id="deckno" name="deckno">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <center>COMMODITIES</center>
                      <div class="form-group">
                        <label>SHIPPER</label>
                        <input type="text" class="form-control input" id="shipper" name="shipper">
                        <span style="color: red;" id="shipperError"></span>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>COMMODITY</label>
                            <input type="text" class="form-control input" id="commodity" name="commodity">
                            <span style="color: red;" id="commodityError"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>QTY</label>
                            <input type="text" class="form-control input" id="qty" name="qty">
                            <span style="color: red;" id="qtyError"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>UNIT</label>
                            <input type="text" class="form-control input" id="unit" name="unit">
                            <span style="color: red;" id="unitError"></span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label>DESTINATION</label>
                            <input type="text" class="form-control input" id="destination" name="destination">
                            <span style="color: red;" id="destinationError"></span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <!-- <div class="form-group"> --><br>
                            <button class="btn btn-info btn-sm" type="button" onclick="insertcomm()">ADD</button>
                            <!-- </div> -->
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <!-- <table class="table table-bordered table-striped" id="comm" style="width: 100%"> -->
                                <!-- <thead>
                                  <tr>
                                    <th>SHIPPER</th>
                                    <th>COMMODITY</th>
                                    <th>QTY</th>
                                    <th>UNIT</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td><button class="btn btn-danger btn-sm" type="button">REMOVE</button></td>
                                  </tr>
                                </tbody>
                              </table> -->
                              <div id="display_comm"></div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <hr>
                          </div>
                          <div class="col-md-12">
                            <center><b>REQUESTING FOR</b></center>
                            <h5>EQUIPMENTS</h5>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>EQ CODE</label>
                                  <select class="form-control input" id="eq_code">
                                    <option>Forklift</option>
                                    <option>Truck</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>NO. OF EQPT.</label>
                                  <input type="text" class="form-control input" id="no_of_eqpt" name="no_of_eqpt">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>W/ OPTR</label>
                                  <input type="text" class="form-control input" id="w_optr" name="w_optr">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <!-- <div class="form-group"> --><br>
                                  <button class="btn btn-info btn-sm" type="button" onclick="inserteqpt()">ADD</button>
                                  <!-- </div> -->
                                </div>
                              </div>
                              <div class="form-group">
                              <!-- <table class="table table-bordered table-striped" id="equipments" style="width: 100%">
                                <thead>
                                  <tr>
                                    <th>EQPT. CODE</th>
                                    <th>NO# OF EQPT.</th>
                                    <th>NO# OF OPTR.</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td><button class="btn btn-danger btn-sm" type="button">REMOVE</button></td>
                                  </tr>
                                </tbody>
                              </table> -->
                              <div id="display_eqpt"></div>
                            </div>
                            <h5>MANPOWERS</h5>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>MP CODE</label>
                                  <select class="form-control input" id="mp_code">
                                    <option>casual</option>
                                    <option>operator</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>NOS</label>
                                  <select class="form-control input" id="nos">
                                    <option>nos1</option>
                                    <option>nos2</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <!-- <div class="form-group"> --><br>
                                  <button class="btn btn-info btn-sm" type="button" onclick="insertmp()">ADD</button>
                                  <!-- </div> -->
                                </div>
                              </div>
                      <!-- <div class="form-group">
                              <label>MP CODE</label>
                              <select class="form-control input"></select>
                      </div>
                      <div class="form-group">
                              <label>NOS</label>
                              <select class="form-control input"></select>
                      </div>
                      <div class="form-group">
                              <button class="btn btn-info btn-sm">ADD</button>
                            </div> -->
                            <div class="form-group">
                            <!--   <table class="table table-bordered table-striped" id="manpower" style="width: 100%">
                                <thead>
                                  <tr>
                                    <th>MP. CODE</th>
                                    <th>NOS</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>sample</td>
                                    <td>sample</td>
                                    <td><button class="btn btn-danger btn-sm" type="button">REMOVE</button></td>
                                  </tr>
                                </tbody>
                              </table> -->
                              <div id="display_mp"></div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group" align="center">
                              <button class="btn btn-info bnt-sm" type="submit">SUBMIT</button>
                              <button class="btn btn-info bnt-sm" id="clear_all" type="button">CLEAR ALL</button>
                              <!-- <a href="index.php"><button class="btn btn-info bnt-sm">HOME</button></a> -->
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- </div> -->
            </div>
          </div>
        </section>

        <!--/ banner-->
        <!--service-->
        
        <!--/ contact-->
        <!--footer-->
        <footer id="footer">
          <br>
          <div class="footer-line">
            <div class="container">
              <div class="row">
                <div class="col-md-12 text-center">
                  © Copyright. All Rights Reserved
            <!-- <div class="credits">
              
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medilab
              
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade.com</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  <script src="asset/js/jquery.min.js"></script>
  <script src="asset/js/jquery.easing.min.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/custom.js"></script>
  <script src="asset/contactform/contactform.js"></script>
  <script src="asset/Datatables/js/jquery.dataTables.min.js"></script>
  <script src="asset/Datatables/js/dataTables.bootstrap4.min.js"></script>

</body>
<script type="text/javascript">
  $(document).ready( function () {
    $("#clear_all").click(function(){
      $(".input").val(""); 
    });
  //Datatable for Job Form request
  $('#equipments').DataTable({
    "searching" : false,
    "info":     false,
    "bLengthChange": false,
    "pageLength": 3
  });
  $('#manpower').DataTable({
    "searching" : false,
    "info":     false,
    "bLengthChange": false,
    "pageLength": 3
  });
  $('.comm').DataTable({
    "searching" : false,
    "info":     false,
    "bLengthChange": false,
    "pageLength": 3
  });
});
</script>
</html>
