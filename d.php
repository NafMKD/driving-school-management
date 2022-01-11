
<?php 

include_once 'spreadsheet/vendor/autoload.php';
include 'autoloader.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;

$obj_fetch = new Fetch;

if (isset($_POST['export'])) {
  $studDetail = $obj_fetch->fetchStudent("All");
print_r($studDetail);
  $stud = array();
  foreach ($studDetail as $key ) {
    $stud[$key['id']][0] = $obj_fetch->fetchStudentId($key['id']);
  }
  foreach ($studDetail as $key ) {
    $d = count($studDetail);
    for ($i=0; $i < $d; $i++) { 
      $a = count($key) + 1;
      $stud[$key['id']][1] = $obj_fetch->fetchStudentAddId($key['id']);
      $a += 1;
    }
  }

  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'No');
  $active_sheet->setCellValue('B1', 'First Name');
  $active_sheet->setCellValue('C1', 'Middle Name');
  $active_sheet->setCellValue('D1', 'Last Name');
  $active_sheet->setCellValue('E1', 'First Name (Amh)');
  $active_sheet->setCellValue('F1', 'Middle Name (Amh)');
  $active_sheet->setCellValue('G1', 'Last Name (Amh)');
  $active_sheet->setCellValue('H1', 'Gender');
  $active_sheet->setCellValue('I1', 'Date of Birth');
  $active_sheet->setCellValue('J1', 'Blood Type');
  $active_sheet->setCellValue('K1', 'Nationality');
  $active_sheet->setCellValue('L1', 'License Category');
  $active_sheet->setCellValue('M1', 'Training Language');
  $active_sheet->setCellValue('N1', 'EducationLevel');
  $active_sheet->setCellValue('O1', 'Region');
  $active_sheet->setCellValue('P1', 'Zone/Sub-City');
  $active_sheet->setCellValue('Q1', 'Woreda');
  $active_sheet->setCellValue('R1', 'Kebele');
  $active_sheet->setCellValue('S1', 'House Number');
  $active_sheet->setCellValue('T1', 'Home Phone');
  $active_sheet->setCellValue('U1', 'Office Phone');
  $active_sheet->setCellValue('V1', 'Mobile Phone');
  $active_sheet->setCellValue('W1', 'Fax');
  $active_sheet->setCellValue('X1', 'POBox');
  $active_sheet->setCellValue('Y1', 'Email');
  $active_sheet->setCellValue('Z1', 'Registration Date');
  $active_sheet->setCellValue('AA1', 'Training Start Date');
  $active_sheet->setCellValue('AB1', 'Training End Date');
  $active_sheet->setCellValue('AC1', 'Medical Examination Date');
  $active_sheet->setCellValue('AD1', 'Responsible Person');
  $active_sheet->setCellValue('AE1', 'Physician Name');
  $active_sheet->setCellValue('AF1', 'Photo Location');


  $mm = array();
  


  foreach ($stud as $key => $value) {
    $mm[] = $key;
  }

 $dd = count($mm);
  for ($i=0; $i <$dd ; $i++) { 
    $count = 2;
    foreach ($stud[$mm[$i]] as $key ) {

      if(isset($key[0]['id'])){
       $active_sheet->setCellValue('A'.$count, $count-1);
      }
      
      if(isset($key[0]['name'])){
        $active_sheet->setCellValue('B'.$count, $key[0]['name']);
      }
      if(isset($key[0]['fname'])){
        $active_sheet->setCellValue('C'.$count, $key[0]['fname']);
      }
      if(isset($key[0]['gname'])){
        $active_sheet->setCellValue('D'.$count, $key[0]['gname']);
      }
      if(isset($key[0]['name_amh'])){
        $active_sheet->setCellValue('E'.$count, $key[0]['name_amh']);
      }
      if(isset($key[0]['fname_amh'])){
        $active_sheet->setCellValue('F'.$count, $key[0]['fname_amh']);
      }
      if(isset($key[0]['gname_amh'])){
        $active_sheet->setCellValue('G'.$count, $key[0]['gname_amh']);
      }
      if(isset($key[0]['gender'])){
        if($key[0]['gender'] == 1){
          $gen_out = "Male";
        }else{
          $gen_out = "Female";
        }
        $active_sheet->setCellValue('H'.$count, $gen_out);
      }
      if(isset($key[0]['dob'])){
        $dob_out = $key[0]['dob'];
        $active_sheet->setCellValue('I'.$count, $dob_out);
      }
      if(isset($key[0]['blood'])){
        $active_sheet->setCellValue('J'.$count, $key[0]['blood']);
      }
      if(isset($key[0]['nationality'])){
        $active_sheet->setCellValue('K'.$count, $key[0]['nationality']);
      }
      if (isset($key[0]['id'])) {
        $active_sheet->setCellValue('L'.$count, "lt");
      }
      if (isset($key[0]['id'])) {
        $active_sheet->setCellValue('M'.$count, "tr");
      }
      if(isset($key[0]['edu_lev'])){
        $active_sheet->setCellValue('N'.$count, $key[0]['edu_lev']);
      }

      if(isset($key[0]['region'])){
        $active_sheet->setCellValue('O'.$count, $key[0]['region']);
      }
      if(isset($key[0]['zone'])){
        $active_sheet->setCellValue('P'.$count, $key[0]['zone']);
      }
      if(isset($key[0]['woreda'])){
        $active_sheet->setCellValue('Q'.$count, $key[0]['woreda']);
      }
      if(isset($key[0]['kebele'])){
        $active_sheet->setCellValue('R'.$count, $key[0]['kebele']);
      }
      if(isset($key[0]['house_no'])){
        $active_sheet->setCellValue('S'.$count, $key[0]['house_no']);
      }
      if(isset($key[0]['home_phone'])){
        $active_sheet->setCellValue('T'.$count, $key[0]['home_phone']);
      }
      if(isset($key[0]['office_phone'])){
        $active_sheet->setCellValue('U'.$count, $key[0]['office_phone']);
      }
      if(isset($key[0]['phone'])){
        $active_sheet->setCellValue('V'.$count, $key[0]['phone']);
      }
      if(isset($key[0]['fax'])){
        $active_sheet->setCellValue('W'.$count, $key[0]['house_no']);
      }
      if(isset($key[0]['pobox'])){
        $active_sheet->setCellValue('X'.$count, $key[0]['pobox']);
      }
      if(isset($key[0]['email'])){
        $active_sheet->setCellValue('Y'.$count, $key[0]['email']);
      }
      if(isset($key[0]['dor'])){
        $dor_out = $key[0]['dor'];
        $active_sheet->setCellValue('Z'.$count, $dor_out);
      }

        $active_sheet->setCellValue('AA'.$count, "Training Start Date");
      
        $active_sheet->setCellValue('AB'.$count, "Training End Date");
      
      if(isset($key[0]['med'])){
        $active_sheet->setCellValue('AC'.$count, $key[0]['med']);
      }
      if(isset($key[0]['res_pers'])){
        $active_sheet->setCellValue('AD'.$count, $key[0]['res_pers']);
      }
      if(isset($key[0]['phy_name'])){
        $active_sheet->setCellValue('AE'.$count, $key[0]['phy_name']);
      }
      if(isset($key[0]['name'])){
        $active_sheet->setCellValue('AF'.$count, $key[0]['name'].$key[0]['fname'].$key[0]['gname']);
      }


      
     $count = $count+1; 
    }

  }
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file,"Xlsx");

  $file_name = 'astdhas.xlsx';

  $writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".$file_name."\"");

  readfile($file_name);

  unlink($file_name);
  

}





?>
<?php  

?>  
<!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>hey</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  		<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
 	 	<!-- Font Awesome -->
  	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  		<!-- Ionicons -->
  	<link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  		<!-- Theme style -->
  	<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  		<!-- AdminLTE Skins. -->
  	<link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  		<!-- Morris chart -->
 	  <link rel="stylesheet" href="assets/morris.js/morris.css">
 	 	<!-- jvectormap -->
  	<link rel="stylesheet" href="assets/jvectormap/jquery-jvectormap.css">
  		<!-- Date Picker -->
  	<link rel="stylesheet" href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  		<!-- Daterange picker -->
  	<link rel="stylesheet" href="assets/bootstrap-daterangepicker/daterangepicker.css">
  		<!-- bootstrap wysihtml5 - text editor -->
  	<link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  		<!-- Google Font -->
 	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <!-- DataTables -->
    <link rel="stylesheet" href="assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
</head>
<body>
<div class="container" style="margin-top: 10%;margin-left: 10%;">
<form method="POST">
  <input type="submit" name="export" class="btn btn-info" value="export">

</form>
  


</div>



		<!-- jQuery 3 -->
	<script src="assets/jquery/dist/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
	<script src="assets/jquery-ui/jquery-ui.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
	<script>
  		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Morris.js charts -->
	<script src="assets/raphael/raphael.min.js"></script>
	<script src="assets/morris.js/morris.min.js"></script>
		<!-- Sparkline -->
	<script src="assets/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
	<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
	<script src="assets/jquery-knob/dist/jquery.knob.min.js"></script>
		<!-- daterangepicker -->
	<script src="assets/moment/min/moment.min.js"></script>
	<script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- datepicker -->
	<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
	<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
	<script src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
	<script src="assets/fastclick/lib/fastclick.js"></script>
		<!-- AdminLTE App -->
	<script src="assets/dist/js/adminlte.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="assets/dist/js/pages/dashboard.js"></script>
		<!-- AdminLTE for demo purposes -->
	<script src="assets/dist/js/demo.js"></script>
		<!-- DataTables -->
	<script src="assets/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="assets/plugins/iCheck/icheck.min.js"></script>

</body>
</html>
  
  

