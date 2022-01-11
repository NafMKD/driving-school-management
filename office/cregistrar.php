<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Car Registrar";
$car_cl = "active";
$car_reg = "active";
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
  <style type="text/css">
    input{
      text-transform: capitalize;
    }
  </style>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Registarar
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-newspaper-o"></i> Registarar</a></li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">
        <div class="col-md-12">
          <form name="Reg_form">
            <div class="box box-primary">

              <div class="box-header">
                <h3 class="box-title">Car Detail:</h3>
              </div>

              <div class="box-body" id="recieveddata">

                <div class="row" style="margin-top: 15px;">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name </label>
                      <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                      <label>Beand Name </label>
                      <input type="text" class="form-control" name="bname">
                    </div>

                    <div class="form-group">
                      <label>Model </label>
                      <input type="text" class="form-control" name="model">
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label class="text-info">Car Type</label>
                      <select class="form-control select2" name="car_type">
                        <option></option>
                        <option value="1">Automobile</option>
                        <option value="2">Pickup</option>
                        <option value="3">SUV</option>
                        <option value="4">Minibus</option>
                        <option value="5">BUS</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-info">Plate No. </label>
                      <input type="text" class="form-control" name="plate" >
                    </div>

                    <div class="form-group">
                      <label class="text-info">Date of Registration</label>
                      <input type="text" class="form-control" value="<?php echo $obj_converter->Now(); ?>" name="dor" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div style="margin-top: 13%; margin-left: 30%;">
                      <button type="button" class="btn btn-primary" id="btncarRegister" onclick="return carRegister()">Submit</button> 
                    </div>

                  </div>

                  <div class="col-md-4">
                      
                      <div class="form-group">
                      <label class="text-success">Parchased Date</label>
                      <input type="text" name="per_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Production Date</label>
                      <input type="text" name="pro_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Cat Status</label>
                      <select  class="form-control select2" name="stat">
                        <option></option>
                        <option value="0">on Road</option>
                        <option value="1">off Road</option>
                      </select>
                    </div>

                  </div>

                </div>

              </div>
            </div>
          </form>
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
    $(function () {
      $('.select2').select2()
      $('[data-mask]').inputmask()
    })
    $(function () {
    
    })
    function carRegister(){
      $(document).ready(function(){
        document.getElementById('btncarRegister').innerHTML = "Submiting  <i class='fa fa-refresh fa-spin'></i>"
        $.post("../oop/register.oop.php",
          {
            type:'carRegister',
            name:  document.forms["Reg_form"]["name"].value,
            bname:  document.forms["Reg_form"]["bname"].value,
            model:  document.forms["Reg_form"]["model"].value,
            car_type:  document.forms["Reg_form"]["car_type"].value,
            plate:  document.forms["Reg_form"]["plate"].value,
            dor:  document.forms["Reg_form"]["dor"].value,
            per_date:  document.forms["Reg_form"]["per_date"].value,
            pro_date:  document.forms["Reg_form"]["pro_date"].value,
            stat:  document.forms["Reg_form"]["stat"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddata').html(data);
          });

    })

    }
  </script>
</body>
</html>