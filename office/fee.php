<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Student Fee";
$stud = "active";
$fee_cl = "active";
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
              <h3 class="box-title">List Of Terms: <?php if(isset($_GET['id'])){ echo "<a id='stud_id'>".$_GET['id']."</a>"; } ?></h3>
            </div>
            <hr>
            <div class="box-body">
              <?php if(isset($_GET['id'])) {
                  $fetching = $obj_fetch->fetchStudentId($_GET['id'])[0];
                  $lt_registerd = $fetching['lt'];
                  $fetching_lt = $obj_fetch->fetchLicenseId($lt_registerd)['amount'];
                  $fetching_stud = $obj_fetch->fetchStudentFeeId($_GET['id'])[0]['SUM(amount)'];

                  if ($fetching_stud == $fetching_lt) {
                    $name_shw4 =$obj_fetch->fetchStudentId($_GET['id'])[0]['name']; 
                    $name_shw5 =$obj_fetch->fetchStudentId($_GET['id'])[0]['fname'];
                    $name_shw6 =$obj_fetch->fetchStudentId($_GET['id'])[0]['gname'];
                    ?>
                    <div class='col-md-2'></div>
                    <div class='col-md-8'>
                      <div class='alert alert-success'>
                        <center>
                                <h4><i class='icon fa fa-check'></i> Alert!</h4>
                                Student Name : <?php echo $name_shw4; ?> <?php echo $name_shw5; ?> <?php echo $name_shw6; ?>,<br> Has Successfuly Coverd All His/Her Payments, Please Reload!
                                <br>
                              </center>
                          </div>
                          <div>
                            <center>
                              <a href='fee.php'>
                                      <button type='button' class='btn btn-success' >Reload</button>
                                </a>
                              </center>   
                          </div>
                    </div>
                    <div class='col-md-2'></div>

                    <?php
                  }else{
                ?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Reg_form">
                  <div class="row" id="recieveddata">
                    <div class="col-md-12">
                      <div class="col-md-2"></div>
                      <label class="col-md-2">Full Name : -</label>
                      <?php
                      $name_shw =$obj_fetch->fetchStudentId($_GET['id'])[0]['name']; 
                      $name_shw2 =$obj_fetch->fetchStudentId($_GET['id'])[0]['fname'];
                      $name_shw3 =$obj_fetch->fetchStudentId($_GET['id'])[0]['gname'];
                      ?>
                      <div class="col-md-2">
                        <p style="margin-left: -55%; text-transform: capitalize;"><?php echo $name_shw; ?> <?php echo $name_shw2; ?> <?php echo $name_shw3; ?></p>
                      </div>
                      
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Amount</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="amo">
                          <span class="input-group-addon"><em class="text-success">Birr</em></span>
                       </div>
                      </div>

                      <div class="form-group">
                        <label>Recipt Number</label>
                        <input type="text" class="form-control" name="rn" >
                      </div>

                      <div class="form-group">
                        <label>Bank Name</label>
                        <select class="form-control select2" name="bn" >
                          <option></option>
                          <option value="1">CBE</option>
                          <option value="2">Wgagen</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" name="date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <input type="button" onclick="return registerTerm()" id="addBtn" value="Add" class="btn btn-primary">
                        <a href="fee.php">
                          <input type="button" onclick="document.getElementById('canBtn').value='Cancling'" id="canBtn" value="Cancel" class="btn btn-danger">
                        </a>
                      </div>
                    </div>
                  </div>                 
                </form>
                <hr>
              <?php }}elseif(isset($_GET['view'])){
                  $arr_view = $obj_fetch->fetchStudentFeeDetailId($_GET['view']);
                  if(count($arr_view)>0){
                  $cnt_view = 1;
                  $total_Amm = 0;
                  for ($i=0; $i < count($arr_view); $i++) { 
                    $total_Amm = $total_Amm + $arr_view[$i]['amount'];
                  }
                  foreach ($arr_view as $key) {
                    $arr_stud_view = $obj_fetch->fetchStudentId($key['id'])[0];
                    $res_pers_view = $obj_fetch->employeFetchId($key['editor'])[0];
                    
                    $required = $obj_fetch->fetchLicenseId($arr_stud_view['lt'])['amount'];
                    if($key['bank_name'] == 1){
                      $bank_name_out = "CBE";
                    }elseif($key['bank_name'] == 2){
                      $bank_name_out = "Wgagen";
                    }
                ?>

                  <div class="row">
                    <div class="col-md-2">
                      <center><h1 class="text-danger"><?php echo $cnt_view; ?></h1></center>
                    </div>
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-md-4 text-info">
                          <label>Student Name:</label>
                          <?php echo htmlspecialchars(ucfirst($arr_stud_view['name'])) ?>
                          <?php echo htmlspecialchars(ucfirst($arr_stud_view['fname'])) ?>
                        </div>
                        <div class="col-md-4 text-info">
                          <label>Amount Paid:</label>
                          <?php echo htmlspecialchars($key['amount']) ?>
                        </div>
                        <div class="col-md-4 text-info">
                          <label>Registration Date:</label>
                          <?php echo htmlspecialchars($obj_converter->toEth($key['dr'])) ?>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4 text-success">
                          <label>Transaction No.:</label>
                          <?php echo htmlspecialchars($key['recipt_no']) ?>
                        </div>
                        <div class="col-md-4 text-success">
                          <label>Bank Name:</label>
                          <?php echo htmlspecialchars($bank_name_out) ?>
                        </div>
                        <div class="col-md-4 text-success">
                          <label>Date:</label>
                          <?php echo htmlspecialchars($obj_converter->toEth($key['date_paid'])) ?>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4 text-warning">
                          <label>Resposible:</label>
                          <?php echo htmlspecialchars(ucfirst($res_pers_view['username'])) ?>
                        </div>
                        <div class="col-md-4 text-warning">
                          <label>Student ID:</label>
                          <?php echo htmlspecialchars($arr_stud_view['id']) ?>
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr>
              <?php $cnt_view = $cnt_view+1;}?>
                  <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                      <?php 
                        if ($total_Amm < $required) {
                          echo "To Print Invoice The Student Must Complete His/Her Full Fee!";
                        }elseif($total_Amm >= $required){
                      ?>
                      <center>
                      <button onclick="window.open('invoice.php?id=<?php echo $_GET['view']; ?>&e_id=<?php echo $_SESSION['id']; ?>', '_blank', 'location=yes,height=700,width=1200,scrollbars=yes,status=yes')" class="btn btn-info"><i class="fa fa-print"></i> Print Invoice</button>  
                      </center>
                      <?php }?>
                    </div>
                  </div>
              <?php }else{?>
                  <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                      <p class="text-danger">No Recored of Payment!</p>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
              <?php }} ?>
              <table id="table_stud" class="table table-bordered table-striped" style="margin-top: 10px;" >
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Full Name</th>
                  <th>Amount Paid</th>
                  <th>Status</th>
                  <th>Term</th>
                  <th>License Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $array = $obj_fetch->fetchStudent("Now");
                    $cnt = 1;
                    foreach ($array as $key ) {
                    
                    $trm_show = $obj_fetch->fetchTermId($key['term_lic']);
                    $lt_show = $obj_fetch->fetchLicenseId($key['lt']);

                    $amo_paid = $obj_fetch->fetchStudentFeeId($key['id']);
                    
                    $lt_amount = $lt_show['amount'];

                    if (!empty($amo_paid[0]['SUM(amount)']) ) {
                      $amm_paid = $amo_paid[0]['SUM(amount)']; 
                      if($lt_amount == $amo_paid[0]['SUM(amount)'] || $lt_amount < $amo_paid[0]['SUM(amount)']) {
                        $stat_rep = "Fully Coverd";
                        $stat_cl = "text-success";
                        $static = 1;
                      } else{
                        $stat_rep = "Not Fully Coverd";
                        $stat_cl = "text-warning";
                      }                   
                    }else{
                      $amm_paid = "00.00";
                      $stat_rep = "Nothing Paid";
                      $stat_cl = "text-danger";
                    }

                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                    <td><?php print_r($amm_paid); ?> Birr</td>
                    <td class="<?php echo $stat_cl;?>"><?php echo htmlspecialchars($stat_rep);?></td>
                    <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                    <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                    <td >
                      <a href="fee.php?id=<?php echo htmlspecialchars($key['id']) ?>">
                        <button class="btn btn-primary btn-xs">Add Fee</button>
                      </a>
                      <a href="fee.php?view=<?php echo htmlspecialchars($key['id']) ?>">
                        <button class="btn btn-info btn-xs">Detail</button>
                      </a>
                    </td>
                  </tr>
                  <?php $cnt=$cnt+1;} ?>
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
      $('.select2').select2()
    })
    $(function () {
    $('[data-mask]').inputmask()
    })
    function registerTerm(){
      document.getElementById("addBtn").value="Adding ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'Student_fee',
            amo:  document.forms["Reg_form"]["amo"].value,
            rn:  document.forms["Reg_form"]["rn"].value,
            bn:  document.forms["Reg_form"]["bn"].value,
            date:  document.forms["Reg_form"]["date"].value,
            id:  document.getElementById("stud_id").textContent,
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