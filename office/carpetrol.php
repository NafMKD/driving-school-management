<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Petrol Cost";
$car_cl = "active";
$car_cost = "active";
$car_pet = "active";
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
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List of Costs:</h3>
                <div class="pull-right">
                  <button class="btn btn-info btn-sm" id="btnAdd" onclick="return addPetrolCost()"><i class="fa fa-plus"></i> Add Cost</button>
                </div>
              </div>
              <div class="box-body">
                <table id="table_stud" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10">No.</th>
                    <th>Car Name</th>
                    <th>Date of Payment</th>
                    <th>Cost <em>(Br.)</em></th>
                    <th>Amount <em>(Lt.)</em></th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $arr_of_all = $obj_fetch->fetchPetrol();
                    $cnt = 1;
                    foreach ($arr_of_all as $key) {
                      $name_of_car= $obj_fetch->fetchCarId($key['id']);
                    ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo htmlspecialchars(ucfirst($name_of_car['name']))." -- ". $name_of_car['plate']; ?></td>
                      <td><?php echo $obj_converter->toEth($key['date_insert']); ?></td>
                      <td><?php echo $key['birr']; ?></td>
                      <td><?php echo $key['petrol']; ?></td>
                      <td>
                        <a href="carpetrol.php?view=<?php echo $key['t_id']; ?>">
                          <button class="btn btn-info btn-xs">
                            <i class="fa fa-eye"></i>
                          </button>
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

  <!-- modal second -->
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Cost</h4>
          </div>
            <form name="Reg_form">
              <div class="modal-body">
               <div class="row" id="recieveddata">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label>car Name :</label><br>
                     <select class="form-control select2" style="width: 100%;" id="car_id">
                       <option></option>
                       <?php
                       $arr_of_id_car = $obj_fetch->fetchCar("All");
                       foreach ($arr_of_id_car as $key) {?>
                        <option value="<?php echo $key['id']; ?>"><?php echo htmlspecialchars(ucfirst($key['name'])); ?> -- <small><?php echo htmlspecialchars(ucfirst($key['plate'])); ?></small></option>
                       <?php } ?>
                     </select>
                   </div>

                   <div class="form-group">
                     <label>Taker:</label>
                     <input type="text" class="form-control" name="taker" >
                   </div>

                   <div class="form-group">
                     <label>Giver:</label>
                     <input type="text" class="form-control" name="giver" value="<?php echo $obj_fetch->employeFetchId($_SESSION['id'])[0]['username']; ?>" >
                   </div>

                   <div class="form-group">
                     <label>Petrol Cost:</label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="pet_cost">
                        <span class="input-group-addon"><em class="text-success">Birr</em></span>
                     </div>
                     
                   </div>

                   <div class="form-group">
                     <label>Petrol Ammount:</label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="pet_amo" >
                        <span class="input-group-addon"><em class="text-success">Litter</em></span>
                     </div>
                     
                   </div>

                   <div class="form-group">
                     <label>Date:</label>
                     <input type="text" class="form-control" name="dat_in" value="<?php echo $obj_converter->Now(); ?>" >
                   </div>


                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnPetReg" class="btn btn-info" onclick="return registerPetrol()" >Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  <!-- ./modal second-->


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
    function pro(){
      document.getElementById('btnAdd').innerHTML = "<i class='fa fa-plus'></i> Add Cost";
    }

    function addPetrolCost(){
      document.getElementById('btnAdd').innerHTML = "Forwarding <i class='fa fa-refresh fa-spin'></i>";
      setTimeout(pro, 2000)
      $('#modal-add').modal('show');

    }
    function registerPetrol(){
      document.getElementById('btnPetReg').innerHTML="submiting <i class='fa fa-refresh fa-spin'></i>";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'registerPetrol',
            car_id:  document.forms["Reg_form"]["car_id"].value,
            taker:  document.forms["Reg_form"]["taker"].value,
            giver:  document.forms["Reg_form"]["giver"].value,
            pet_cost:  document.forms["Reg_form"]["pet_cost"].value,
            pet_amo:  document.forms["Reg_form"]["pet_amo"].value,
            dat_in:  document.forms["Reg_form"]["dat_in"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddata').html(data);
            document.getElementById('btnPetReg').parentNode.removeChild(document.getElementById('btnPetReg'));
          });

    })

    }
  </script>
</body>
</html>