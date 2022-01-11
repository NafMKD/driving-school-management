<?php 

session_start();
include 'autoloader.php';

$obj_register = new register;
$obj_convert = new converter;

if ($_POST['type'] == 'sdeatil') {
	$term = explode("/",$_POST['trm']);
	$stud_id = $_POST['stud_id'];
	$array_up_stu = array(
		'name' => $_POST['name_eng'],
		'fname' => $_POST['fname_eng'],
		'gname' => $_POST['gname_eng'],
		'name_amh' => $_POST['name_amh'],
		'fname_amh' => $_POST['fname_amh'],
		'gname_amh' => $_POST['gname_amh'],
		'name_or' => $_POST['name_or'],
		'fname_or' => $_POST['fname_or'],
		'gname_or' => $_POST['gname_or'],
		'gender' => $_POST['gender'],
		'dob' => $obj_convert->toGrig($_POST['dob']),
		'dor' => $obj_convert->toGrig($_POST['dor']),
		'lang' => $_POST['lang'],
		'med' => $_POST['med'],
		'res_pers' => $_POST['rp'],
		'phy_name' => $_POST['pn'],
		'term_lic' => $term[0],
		'lt' => $term[1],
		'blood' => $_POST['bl_type'],
		'edu_lev' => $_POST['edu_lev']
	);

	$obj_register->updateStudentDetail($stud_id,$array_up_stu);
	echo "
		<div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Alert!</h4>
            Seccussfuly Updated!
        </div>";
}

if ($_POST['type'] == 'saddress') {
	$stud_id_1 = $_POST['stud_id'];
	$array_up_stu_1 = array(
		'nationality'=> $_POST["nat"],
		'region'=> $_POST["reg"],
		'zone'=> $_POST["zon"],
		'woreda'=> $_POST["wer"],
		'kebele'=> $_POST["keb"],
		'house_no'=> $_POST["hn"],
		'home_phone'=> $_POST["hp"],
		'office_phone'=> $_POST["op"],
		'phone'=> $_POST["mp"],
		'fax'=> $_POST["fax"],
		'pobox'=> $_POST["box"],
		'email'=> $_POST["email"]
	);

	$obj_register->updateStudentAddress($stud_id_1,$array_up_stu_1);
	echo "
		<div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Alert!</h4>
            Seccussfuly Updated!
        </div>";
}
