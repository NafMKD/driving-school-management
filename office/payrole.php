<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Employee Payrole";
$emp = "active"; 
$payrol_cl = "active";
include 'autoloader.php';
$obj_fetch = new Fetch;
$obj_converter = new converter;
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/css.inc.php';?>
</head>
<body class="hold-transition skin-blue ">
	<?php include 'includes/main.inc.php';?>


  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Terms
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-newspaper-o"></i> Terms</a></li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12" style="margin-top: 10px;">
          <div class="box box-primary" >
            <div class="box-header" style="margin-top: 5px;">
              <h3 class="box-title">List Of Terms</h3>
            </div>
            <hr>
            <div class="box-body">
              <form style="margin-bottom:  40px;margin-top:  0px;" name="Reg_form">
                <div class="row" id="recieveddata">
                  <div class="col-md-2"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Term Name</label>
                      <input type="text" class="form-control" name="trm_name">
                    </div>

                    <div class="form-group">
                      <label>Traning Start Date</label>
                      <input type="text" class="form-control" name="tsd" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div class="form-group">
                      <label>Traning End Date</label>
                      <input type="text" class="form-control" name="ted" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>License Type</label>
                      <select class="form-control" name="lt" style="text-transform: capitalize;">
                        <option></option>
                        
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="stat">
                        <option></option>
                        <option value="1">Active </option>
                        <option value="0">Deactive</option>
                      </select>
                    </div>

                    <div style="margin-top: 13%; margin-left: 30%;">
                      <button type="button" onclick="return registerTerm()" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                </div>                 
              </form>
              <hr>
              <table id="table_stud" class="table table-bordered table-striped" style="margin-top: 10px;" >
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Traning Start Date</th>
                  <th>Traning Start Date</th>
                  <th>Licence Type</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>


  <?php include 'includes/js.inc.php';?>
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- page script -->
  <script>
   
  </script>
</body>
</html>