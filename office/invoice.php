<?php 
session_start();
include 'autoloader.php';
$obj_fetch = new Fetch;
$obj_converter = new converter;
$obj_register = new register;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

</head>
<body onload="window.print()">
  <?php if (!isset($_GET['id']) || !isset($_GET['e_id'])) { ?>
  <div class="wrapper">
    <div class="row" style="margin-top: 30%">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <p>You Are In The Wrong Directory!  <a href="../"> G0 Back</a></p>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
  <?php }else{

  $arr_tid = $obj_fetch->fetchStudentFeeDetailId($_GET['id']);
  $total_paid = 0;
  for ($i=0; $i <count($arr_tid); $i++) { 
    $total_paid = $total_paid + $arr_tid[$i]['amount']; 
  }
  $percentage = ($total_paid * 15) / 100;

  $stud_arr_detail = $obj_fetch->fetchStudentId($_GET['id'])[0];
  $stud_arr_addr = $obj_fetch->fetchStudentAddId($_GET['id'])[0];


  

  if ($stud_arr_addr['region'] == 1) {
    $region_out = "Orormia";
  }elseif ($stud_arr_addr['region'] == 2) {
    $region_out = "Addis Ababa";
  }elseif ($stud_arr_addr['region'] == 3) {
    $region_out = "Afar";
  }elseif ($stud_arr_addr['region'] == 4) {
    $region_out = "Amhara";
  }elseif ($stud_arr_addr['region'] == 5) {
    $region_out = "Benishagul";
  }elseif ($stud_arr_addr['region'] == 6) {
    $region_out = "Dere Dawa";
  }elseif ($stud_arr_addr['region'] == 7) {
    $region_out = "Gambela";
  }elseif ($stud_arr_addr['region'] == 8) {
    $region_out = "Harari";
  }elseif ($stud_arr_addr['region'] == 9) {
    $region_out = "SNNP";
  }elseif ($stud_arr_addr['region'] == 10) {
    $region_out = "Somali";
  }elseif ($stud_arr_addr['region'] == 11) {
    $region_out = "Tigrai";
  }
  ?>
  <div class="wrapper">

    <section class="invoice">
      
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> A & F, Driving School.
            <small class="pull-right">Date: <?php echo $obj_converter->Now(); ?></small>
          </h2>
        </div>
      </div>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From:
          <address>
            <strong>A & F, Driving School.</strong><br>
            Ajip, Jimma<br>
            Oromia, Ethiopia<br>
            Phone: (251) 123-5432<br>
            Email: a&f@drivingschool.com
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          To:
          <address>
            <strong><?php echo htmlspecialchars(ucfirst($stud_arr_detail['name'])); ?> <?php echo htmlspecialchars(ucfirst($stud_arr_detail['fname'])); ?> <?php echo htmlspecialchars(ucfirst($stud_arr_detail['gname'])); ?></strong><br>
            <?php echo htmlspecialchars(ucfirst($stud_arr_addr['woreda'])); ?>, <?php echo htmlspecialchars(ucfirst($stud_arr_addr['zone'])); ?><br>
            <?php echo htmlspecialchars($region_out); ?>, Ethiopia<br>
            Phone: (251) <?php echo substr(htmlspecialchars(ucfirst($stud_arr_addr['phone'])), 1); ?><br>
            Email: <?php echo htmlspecialchars(ucfirst($stud_arr_addr['email'])); ?>
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <b>Invoice No. :- </b> <?php print_r($obj_fetch->invoiceNoGen()); ?><br>
        </div>
      </div>

      
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Bank Name</th>
              <th>Transaction No.</th>
              <th>Date </th>
              <th>Amount <em class="text-success">(Br.)</em></th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $cnt = 1;
                foreach ($arr_tid as $key) {
                  if($key['bank_name'] == 1){
                    $bank_name_out = "CBE";
                  }elseif($key['bank_name'] == 2){
                    $bank_name_out = "Wgagen";
                  }
              ?>
              <tr>
                <td><?php echo htmlspecialchars($cnt); ?></td>
                <td><?php echo htmlspecialchars($bank_name_out); ?></td>
                <td><?php echo htmlspecialchars($key['recipt_no']); ?></td>
                <td><?php echo htmlspecialchars($obj_converter->toEth($key['date_paid'])); ?></td>
                <td><?php echo htmlspecialchars($key['amount']); ?></td>
              </tr>
              <?php $cnt = $cnt+1;}?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <?php 
            $bank_arr = array();
            for ($i=0; $i < count($arr_tid); $i++) { 
              $bank_arr[] = $arr_tid[$i]['bank_name'];
            }

            if(count(array_unique($bank_arr)) === 1 && end($bank_arr) === '1'){
              ?>
            <img src="../assets/dist/img/cbe.jpg" alt="Bank Logo">
          <?php }elseif(count(array_unique($bank_arr)) === 1 && end($bank_arr) === '2'){?>
            <img src="../assets/dist/img/wega.jpg" alt="Bank Logo">
          <?php }else{?>
            <img src="../assets/dist/img/cbe.jpg" alt="Bank Logo">
            <img src="../assets/dist/img/wega.jpg" alt="Bank Logo">
          <?php  }?>
          
        </div>
        <div class="col-xs-6">
          <p class="lead">Amount Due <?php echo $obj_converter->Now(); ?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo htmlspecialchars($total_paid - $percentage); ?> <em>Br.</em></td>
              </tr>
              <tr>
                <th>Tax (15%):</th>
                <td><?php echo htmlspecialchars($percentage); ?> <em>Br.</em></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo htmlspecialchars($total_paid); ?> <em>Br.</em></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p id="demo"></p>
    </section>
  </div>
  <?php //$obj_register->invoiceReg($obj_fetch->invoiceNoGen(),$_GET['id'],$_GET['e_id']); 
}?>
</body>
</html>
