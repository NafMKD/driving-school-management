<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Car List";
$car_cl = "active";
$car_li = "active";
include 'autoloader.php';
$obj_fetch = new Fetch;
$obj_converter = new converter;
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/css.inc.php';?>
  <style type="text/css">
    input{
      text-transform: capitalize;
    }
  </style>
</head>
<body class="hold-transition skin-blue ">
	<?php include 'includes/main.inc.php';?>


  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Car List
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-newspaper-o"></i> Car List</a></li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">
        <?php if(isset($_GET['edit'])){ 
          $array_ric_id = $obj_fetch->fetchCarId($_GET['edit']);
          ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Car:</h3>
              <div class="pull-right">
                <a href="carlist.php" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel</a>
              </div>
            </div>
            <div class="box-body" id="recieveddata">
              <form name="Reg_form">
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Name </label>
                        <input type="text" value="<?php echo $array_ric_id['name'] ?>" class="form-control" name="name">
                      </div>

                      <div class="form-group">
                        <label>Beand Name </label>
                        <input type="text" value="<?php echo $array_ric_id['brand'] ?>" class="form-control" name="bname">
                      </div>

                      <div class="form-group">
                        <label>Model </label>
                        <input type="text" value="<?php echo strtoupper($array_ric_id['model']) ?>" class="form-control" name="model">
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="text-info">Car Type</label>
                        <select class="form-control select2" name="car_type" id="car_type">
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
                        <input type="text" class="form-control" value="<?php echo strtoupper($array_ric_id['plate']) ?>" name="plate" >
                      </div>

                      <div class="form-group">
                        <label class="text-info">Date of Registration</label>
                        <input type="text" class="form-control" value="<?php echo $obj_converter->toEth($array_ric_id['dor']) ?>" name="dor" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <button type="button" class="btn btn-primary" id="btncarRegister" onclick="return carUpdate()">
                          Submit
                        </button> 
                        <button type="button" id="buttonUpload" onclick="return carUploadFile()" class="btn btn-info">
                            UploadFile 
                        </button>
                      </div>

                    </div>

                    <div class="col-md-4">
                        
                        <div class="form-group">
                        <label class="text-success">Parchased Date</label>
                        <input type="text" name="per_date" class="form-control" value="<?php echo $obj_converter->toEth($array_ric_id['per_date']) ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Production Date</label>
                        <input type="text" name="pro_date" class="form-control" value="<?php echo $obj_converter->toEth($array_ric_id['pro_date']) ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Cat Status</label>
                        <select  class="form-control select2" name="stat" id="stat">
                          <option></option>
                          <option value="0">on Road</option>
                          <option value="1">off Road</option>
                        </select>
                      </div>

                    </div>

                  </div>
                </form>
            </div>
          </div>
        </div>
        <?php }?>
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List of Employee:</h3>
              </div>
              <div class="box-body">
                <table id="table_stud" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10">No.</th>
                    <th>Name</th>
                    <th>Brand Name</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $array_ric = $obj_fetch->fetchCar("All");
                      $cnt = 1;
                      foreach ($array_ric as $key ) {
                        if ($key['stat'] == 0) {
                          $stat_ou = "on Road";
                          $stat_cl = "text-success";
                        }elseif ($key['stat'] == 1) {
                          $stat_ou = "off Road";
                          $stat_cl = "text-danger";
                        }
                       ?>
                       <tr>
                         <td><?php echo $cnt; ?></td>
                         <td><?php echo htmlspecialchars(ucfirst($key['name'])); ?></td>
                         <td><?php echo htmlspecialchars(ucfirst($key['brand'])); ?></td>
                         <td><?php echo htmlspecialchars(strtoupper($key['model'])); ?></td>
                         <td class="<?php echo $stat_cl; ?>"><?php echo $stat_ou; ?></td>
                         <td>
                           <a href="carlist.php?edit=<?php echo $key['id']; ?>">
                             <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
                           </a>
                           <a href="carlist.php?view=<?php echo $key['id']; ?>">
                             <button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                           </a>
                         </td>
                       </tr>
                     <?php $cnt=$cnt+1;}?>
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
    $(function () {
      $('#table_stud').DataTable()
      $('[data-mask]').inputmask()
      $('.select2').select2()
    })
    <?php if(isset($_GET['edit'])){ ?>
    function selector(car,st){
      document.getElementById("car_type").selectedIndex = car;
      document.getElementById("stat").selectedIndex = st;
    }
    selector(<?php if(isset($_GET['edit'])){echo $array_ric_id['car_type'];}else{echo "0";}?>,<?php  if(isset($_GET['edit'])){echo $array_ric_id['stat']+1;}else{echo "0";}?>);
    <?php }?>
    function carUploadFile() {
      document.getElementById("buttonUpload").innerHTML="Updloading <i class='fa fa-refresh fa-spin'></i>";
      var data = <?php if(isset($_GET['edit'])){ echo $_GET['edit'];}else{echo "0";} ?>;
      window.open('uploadcarfile.php?id='+data, '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
    }
    function carUpdate(){
      $(document).ready(function(){
        document.getElementById('btncarRegister').innerHTML = "Submiting  <i class='fa fa-refresh fa-spin'></i>"
        $.post("../oop/register.oop.php",
          {
            type:'carUpdate',
            id : <?php if(isset($_GET['edit'])){echo $_GET['edit'];}else{echo "null";} ?>,
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