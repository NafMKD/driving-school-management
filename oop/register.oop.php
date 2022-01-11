<?php 
session_start();
include 'autoloader.php';

$obj_detail = new register;
$obj_fetch = new Fetch;
$obj_convert = new converter;
$editor = $_POST['editor'];

if ($_POST['type'] == 'sdeatil') {
	
	$name_eng = $_POST['name_eng'];
	$fname_eng = $_POST['fname_eng'];
	$gname_eng = $_POST['gname_eng'];
	$name_or = $_POST['name_or'];
	$fname_or = $_POST['fname_or'];
	$gname_or = $_POST['gname_or'];
	$name_amh = $_POST['name_amh'];
	$fname_amh = $_POST['fname_amh'];
	$gname_amh = $_POST['gname_amh'];
	$gender = $_POST['gender'];
	$dob = $obj_convert->toGrig($_POST['dob']);
	$dor = $obj_convert->toGrig($_POST['dor']);
	$lang = $_POST['lang'];
	$med = $_POST['med'];
	$rp = $_POST['rp'];
	$pn = $_POST['pn'];
	$bl_type = $_POST['bl_type'];
	$edu_lev = $_POST['edu_lev'];
	$trm = explode("/",$_POST['trm']);


	$insert = $obj_detail->detail($name_eng,$fname_eng,$gname_eng,$name_or,$fname_or,$gname_or,$name_amh,$fname_amh,$gname_amh,$gender,$dob,$dor,$lang,$med,$rp,$pn,$trm[0],$trm[1],$editor,$bl_type,$edu_lev);

		echo "
		<div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Alert!</h4>
            Seccussfuly Registered, Please go to next step! <em style='text-success' id='regStudRetId'>".$insert."</em>
        </div>";
	
}

if ($_POST['type'] == 'saddress') {
	
	$nat = $_POST["nat"];
    $reg = $_POST["reg"];
    $zon = $_POST["zon"];
    $wer = $_POST["wer"];
    $keb = $_POST["keb"];
    $hn = $_POST["hn"];
    $hp = $_POST["hp"];
    $op = $_POST["op"];
    $mp = $_POST["mp"];
    $fax = $_POST["fax"];
    $box = $_POST["box"];
    $email = $_POST["email"];

    $insert_1 = $obj_detail->address($nat,$reg,$zon,$wer,$keb,$hn,$hp,$op,$mp,$fax,$box,$email,$editor);

	echo "
		<div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Alert!</h4>
            Seccussfuly Registered, Please go to next step!
        </div>";

}

if ($_POST['type'] == 'term') {
	$trm_name = $_POST['trm_name'];
	$tsd = $obj_convert->toGrig($_POST['tsd']);
	$ted = $obj_convert->toGrig($_POST['ted']);
	$lt = $_POST['lt'];
	$stat = $_POST['stat'];
	$comp_reg = $_POST['comp_reg'];

	$insert_2 = $obj_detail->termReg($trm_name,$tsd,$ted,$lt,$stat,$comp_reg,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Seccussfuly Registered, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='term.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'license') {
	$ls_name = $_POST['ls_name'];
	$cod = $_POST['cod'];
	$stat = $_POST['stat'];
	$amo = $_POST['amo'];
	$lice_cat = $_POST['lice_cat'];

	$insert_3 = $obj_detail->licenseReg($ls_name,$cod,$stat,$amo,$lice_cat);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Seccussfuly Registered, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='license.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'Student_fee') {
	$amo = $_POST['amo'];
	$rn = $_POST['rn'];
	$bn = $_POST['bn'];
	$date =$obj_convert->toGrig($_POST['date']);
	$id = $_POST['id'];
	$editor = $_POST['editor'];

	$studcheck = $obj_fetch->fetchStudentId($id)[0]['lt'];
	$licecheck = $obj_fetch->fetchLicenseId($studcheck)['amount'];
	$fetching_stud = $obj_fetch->fetchStudentFeeId($id)[0]['SUM(amount)'];
	$total_onser = $fetching_stud + $amo;
	if ($total_onser > $licecheck ) {
		$out_of_this = $licecheck - $fetching_stud;
		echo "
			<div class='col-md-2'></div>
			<div class='col-md-8'>
				<div class='alert alert-danger'>
					<center>
			            <h4><i class='icon fa fa-times-circle'></i> Alert!</h4>
			            Amount Inserted is Above Expected, Expected Amount is ".$out_of_this." Br.
			            <br>
		            </center>
		        </div>
		        <div>
		        	<center>
		        		<a href='fee.php'>
		                    <button type='button' class='btn btn-danger' >Reload</button>
		             	</a>
		            </center> 	
		        </div>
			</div>
			<div class='col-md-2'></div>
				
		        ";

	}else{
	$insert_4 = $obj_detail->studentFeeReg($id,$amo,$rn,$bn,$date,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Seccussfuly Inserted, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='fee.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
             	<a href='fee.php?view=".$insert_4."'>
                    <button type='button' class='btn btn-default' >Print Invoice</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";}

}

if ($_POST['type'] == 'messageSend') {
	$ids = $_POST['ids'];
	$phone = $_POST['phone'];
	$msg = $_POST['msg'];
	$typeof = $_POST['typeof'];
	$editor = $_POST['editor'];

	$insert_5 =$obj_detail->messageSend($ids,$phone,$msg,$typeof,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Seccussfuly Message Inserted, Please Approve To Send The Message To Students!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='notification.php?appr=yes'>
                    <button type='button' class='btn btn-success' >Approve</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'messageUpdate') {
	$t_id = $_POST['t_id'];
	$msg = $_POST['msg'];
	$editor = $_POST['editor'];


	$insert_6 =$obj_detail->updateMess($t_id,$msg,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Message Seccussfuly Inserted, Please Approve To Send The Message To Students!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='notification.php?appr=yes'>
                    <button type='button' class='btn btn-success' >Approve</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'termUpd') {
	$name = $_POST['trm_name'];
	$id = $_POST['id'];
	$stat = $_POST['stat'];
	$comp = $_POST['comp'];
	$tsd_edit = $obj_convert->toGrig($_POST['tsd_edit']);
	$ted_edit = $obj_convert->toGrig($_POST['ted_edit']);
	$lt_edit = $_POST['lt_edit'];

	$insert_7 =$obj_detail->updateTerm($id,$name,$stat,$comp,$tsd_edit,$ted_edit,$lt_edit,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Term Seccussfuly Updated, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='term.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'liceUpd') {
	$name = $_POST['lic_name'];
	$id = $_POST['id'];
	$stat = $_POST['stat'];
	$code = $_POST['code'];
	$amo = $_POST['amo'];
	$lt_cat = $_POST['lt_cat'];

	$insert_8 =$obj_detail->updateLice($id,$name,$stat,$code,$amo,$lt_cat);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Term Seccussfuly Updated, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='license.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'classReg') {
	$name = $_POST['cl_name'];
	$stat = $_POST['stat'];

	$insert_9 =$obj_detail->classReg($name,$stat,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Class Seccussfuly Created, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='class.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'classUpd') {
	$id = $_POST['id'];
	$name = $_POST['cl_name'];
	$stat = $_POST['stat'];

	$insert_10 =$obj_detail->updateClass($id,$name,$stat,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Class Seccussfuly Updated, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='class.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'updateIndividual') {
	$id = $_POST['ids'];
	$stat_up = $_POST['stat_up'];
	$comp_up = $_POST['comp_up'];
	$arry = array('stat'=> $stat_up, 'comp' => $comp_up);

	$insert_11 =$obj_detail->updateStudentDetail($id,$arry);

	echo "Status Seccussfuly Updated, Please Reload!";
}

if ($_POST['type'] == 'employeeRegister') {
	$name = $_POST['name'];
	$fname = $_POST['fname'];
	$gname = $_POST['gname'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$dor = $obj_convert->toGrig($_POST['dor']);
	$edu_lev = $_POST['edu_lev'];
	$e_type = $_POST['e_type'];
	$e_state = $_POST['e_state'];
	if($_POST['fr_date'] == ''){
		$fr_date = 0;
	}else{
		$fr_date = $obj_convert->toGrig($_POST['fr_date']);
	}
	if($_POST['to_date'] == ''){
		$to_date = 0;
	}else{
		$to_date = $obj_convert->toGrig($_POST['to_date']);
	}
	
	
	
	$insert_12 =$obj_detail->employeeRegister($name,$fname,$gname,$gender,$obj_convert->toGrig($dor),$phone,$edu_lev,$e_type,$e_state,$fr_date,$to_date);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Employee Seccussfuly Registered, go to next step!<em style='text-success' id='regEmpRetId'>".$insert_12."</em>
	            <br>
            </center>
            <center class='text-warning'>
	            Its Recomended to take picture here!
	            <br>
	            To upload Files Please goto Employee List Tab!
            </center>
            <center>
            	<button type='button' class='btn btn-info' onclick='return capturePhoto()' value='Photo' name='photo'>
                    <i class='fa fa-file-image-o'></i> Pohoto
                </button>
            </center>
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == 'employeeUpdate') {
	$id = $_POST['emp_id'];
	$name = $_POST['name'];
	$fname = $_POST['fname'];
	$gname = $_POST['gname'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$dor = $obj_convert->toGrig($_POST['dor']);
	$edu_lev = $_POST['edu_lev'];
	$e_type = $_POST['e_type'];
	$e_state = $_POST['e_state'];
	if($_POST['fr_date'] == ''){
		$fr_date = 0;
	}else{
		$fr_date = $obj_convert->toGrig($_POST['fr_date']);
	}
	if($_POST['to_date'] == ''){
		$to_date = 0;
	}else{
		$to_date = $obj_convert->toGrig($_POST['to_date']);
	}
	
	
	
	$insert_13 =$obj_detail->employeeUpdate($id,$name,$fname,$gname,$gender,$dor,$phone,$edu_lev,$e_type,$e_state,$fr_date,$to_date);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Employee Seccussfuly Updated!
	            <br>
            </center>
            <center>
            	<a href='employee.php?all'>
	            	<button type='button' class='btn btn-info'>
	                    <i class='fa fa-left-arrow'></i> Back
	                </button>
                </a>
            </center>
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == "carRegister") {
	$name = $_POST['name'];
	$bname = $_POST['bname'];
	$model = $_POST['model'];
	$car_type = $_POST['car_type'];
	$plate = $_POST['plate'];
	$dor = $obj_convert->toGrig($_POST['dor']);
	$per_date = $obj_convert->toGrig($_POST['per_date']);
	$pro_date = $obj_convert->toGrig($_POST['pro_date']);
	$stat = $_POST['stat'];
	$insert_14 = $obj_detail->carRegister($name,$bname,$model,$plate,$dor,$car_type,$per_date,$pro_date,$stat,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Car Seccussfuly Registered, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='cregistrar.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == "carUpdate") {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$bname = $_POST['bname'];
	$model = $_POST['model'];
	$car_type = $_POST['car_type'];
	$plate = $_POST['plate'];
	$dor = $obj_convert->toGrig($_POST['dor']);
	$per_date = $obj_convert->toGrig($_POST['per_date']);
	$pro_date = $obj_convert->toGrig($_POST['pro_date']);
	$stat = $_POST['stat'];

	$insert_15 = $obj_detail->updateCar($id,$name,$bname,$model,$plate,$dor,$car_type,$per_date,$pro_date,$stat,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Car Seccussfuly Updated, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='carlist.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == "registerPetrol") {
	$car_id = $_POST['car_id'];
	$taker = $_POST['taker'];
	$giver = $_POST['giver'];
	$pet_cost = $_POST['pet_cost'];
	$pet_amo = $_POST['pet_amo'];
	$dat_in = $obj_convert->toGrig($_POST['dat_in']);

	$insert_16 = $obj_detail->catPetrolReg($car_id,$pet_cost,$pet_amo,$taker,$giver,$dat_in,$editor);

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Data Seccussfuly Inserted, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='carpetrol.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}

if ($_POST['type'] == "registerMaintain") {
	$car_id = $_POST['car_id'];
	$taker = $_POST['taker'];
	$giver = $_POST['giver'];
	$cost = $_POST['cost'];
	$discr = $_POST['discr'];
	$dat_in = $obj_convert->toGrig($_POST['dat_in']);

	$insert_17 = $obj_detail->carMaintainCost($car_id,$giver,$taker,$discr,$cost,$dat_in,$editor);
	

	echo "
	<div class='col-md-2'></div>
	<div class='col-md-8'>
		<div class='alert alert-success'>
			<center>
	            <h4><i class='icon fa fa-check'></i> Alert!</h4>
	            Data Seccussfuly Inserted, Please Reload!
	            <br>
            </center>
        </div>
        <div>
        	<center>
        		<a href='carmain.php'>
                    <button type='button' class='btn btn-success' >Reload</button>
             	</a>
            </center> 	
        </div>
	</div>
	<div class='col-md-2'></div>
		
        ";
}