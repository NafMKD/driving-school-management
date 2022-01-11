<?php 

/**
 * Student Detail
 */
class Register extends Db
{
	private $id_gen;
	private $id_gen_add;
	private $id_gen_upp;
	private $id_term;
	private $id_lice;
	private $id_employee;
	private $id_car;
//#############################################################################################################################
	//For Student Detail
	public function detail($name_eng,$fname_eng,$gname_eng,$name_or,$fname_or,$gname_or,$name_amh,$fname_amh,$gname_amh,$gender,$dob,$dor,$lang,$med,$rp,$pn,$trm,$lt,$editor,$bl_type,$edu_lev){

		$name_eng = mysqli_real_escape_string($this->conn(),$name_eng);
		$fname_eng = mysqli_real_escape_string($this->conn(),$fname_eng);
		$gname_eng = mysqli_real_escape_string($this->conn(),$gname_eng);
		$name_or = mysqli_real_escape_string($this->conn(),$name_or);
		$fname_or = mysqli_real_escape_string($this->conn(),$fname_or);
		$gname_or = mysqli_real_escape_string($this->conn(),$gname_or);
		$name_amh = mysqli_real_escape_string($this->conn(),$name_amh);
		$fname_amh = mysqli_real_escape_string($this->conn(),$fname_amh);
		$gname_amh = mysqli_real_escape_string($this->conn(),$gname_amh);
		$gender = mysqli_real_escape_string($this->conn(),$gender);
		$dob = mysqli_real_escape_string($this->conn(),$dob);
		$dor = mysqli_real_escape_string($this->conn(),$dor);
		$lang = mysqli_real_escape_string($this->conn(),$lang);
		$med = mysqli_real_escape_string($this->conn(),$med);
		$rp = mysqli_real_escape_string($this->conn(),$rp);
		$pn = mysqli_real_escape_string($this->conn(),$pn);
		$trm = mysqli_real_escape_string($this->conn(),$trm);
		$lt = mysqli_real_escape_string($this->conn(),$lt);
		$bl_type = mysqli_real_escape_string($this->conn(),$bl_type);
		$edu_lev = mysqli_real_escape_string($this->conn(),$edu_lev);
		$editor = mysqli_real_escape_string($this->conn(),$editor);

		if($lang == 1){
			$c_type = 1001;
		}elseif($lang == 2){
			$c_type = 1000;
		}

		$id_array = array();
		$query = mysqli_query($this->conn(), "SELECT * FROM student");
        while($row = mysqli_fetch_assoc($query)){
            $id_array[] = $row["id"];
        }
        if (count($id_array) == 0) {
        	$this->id_gen = 1000;
        }else{
        	$this->id_gen = end($id_array) + 1;
        }
		mysqli_query($this->conn(), "INSERT INTO student(id, name, fname, gname, name_amh, fname_amh, gname_amh, name_or, fname_or, gname_or, gender, dob, dor, lang, med, res_pers, phy_name, term_lic, lt, editor, blood, edu_lev, c_type) VALUES('$this->id_gen', '$name_eng', '$fname_eng', '$gname_eng', '$name_or', '$fname_or', '$gname_or', '$name_amh', '$fname_amh', '$gname_amh', '$gender', '$dob', '$dor', '$lang', '$med', '$rp', '$pn', '$trm', '$lt','$editor', '$bl_type', '$edu_lev', '$c_type')");
		mysqli_query($this->conn(), "INSERT INTO student_address(id) VALUES('$this->id_gen')");
		mysqli_query($this->conn(), "INSERT INTO student_file(id) VALUES('$this->id_gen')");
		return $this->id_gen;
	}
//#############################################################################################################################

//#############################################################################################################################
	//For Student Address
	public function address($nat,$reg,$zon,$wer,$keb,$hn,$hp,$op,$mp,$fax,$box,$email,$editor){

		$id_array_1 = array();
		$query_1 = mysqli_query($this->conn(), "SELECT * FROM student_address");
        while($row_1 = mysqli_fetch_assoc($query_1)){
            $id_array_1[] = $row_1["id"];
        }
        $this->id_gen_add = end($id_array_1);

		mysqli_query($this->conn(),"UPDATE student_address SET nationality ='$nat' , region ='$reg' , zone ='$zon' , woreda ='$wer' , kebele ='$keb' , house_no ='$hn' , home_phone ='$hp' , office_phone ='$op' , phone ='$mp' , fax ='$fax' , pobox ='$box' , email ='$email', editor='$editor' WHERE id = '$this->id_gen_add'");

	}
//#############################################################################################################################

//#############################################################################################################################
	// For Uploading
	public function upload($file, $folder,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
  		$dateforfile = date("mdY");
  		$rand = uniqid();

		$main = $_FILES[$file] ['name'];
	    $name = $file."_".$dateforfile."_".$rand."_".$main."";
	    $loc = $_FILES[$file] ['tmp_name'];
	    $folder ='../files/'.$folder.'/';
	    move_uploaded_file($loc, $folder.$name);

	    $datefroinsert = date("m/d/Y");

	    $id_array_2 = array();
		$query_2 = mysqli_query($this->conn(), "SELECT * FROM student_file");
        while($row_2 = mysqli_fetch_assoc($query_2)){
            $id_array_2[] = $row_2["id"];
        }
        $this->id_gen_upp = end($id_array_2);
        mysqli_query($this->conn(), "UPDATE student_file SET $file ='$name', f_data ='$datefroinsert', editor ='$editor' WHERE id = '$this->id_gen_upp'");	    
	}
	public function uploadPhoto($id,$filepath,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert = date("m/d/Y");
		mysqli_query($this->conn(), "UPDATE student_file SET photo ='$filepath', f_data ='$datefroinsert', editor ='$editor' WHERE id = '$id'");
	}

	public function uploadEmployePhoto($id, $discr, $file){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO employee_file(id, file_discr, path, date) VALUES('$id', '$discr', '$file', '$datefroinsert')");	    
	}

	public function uploadEmployeFile($id, $discr, $file){
		date_default_timezone_set("Africa/Addis_Ababa");
  		$dateforfile = date("mdY");
  		$rand = mt_rand(100000,999999);

		$main = $_FILES[$file] ['name'];
	    $name = "File_".$dateforfile."_".$rand."_".$main."";
	    $loc = $_FILES[$file] ['tmp_name'];
	    $folder ='../files/employee/';
	    move_uploaded_file($loc, $folder.$name);

		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO employee_file(id, file_discr, path, date) VALUES('$id', '$discr', '$name', '$datefroinsert')");	    
	}

	public function uploadCarFile($id, $discr, $file){
		date_default_timezone_set("Africa/Addis_Ababa");
  		$dateforfile = date("mdY");
  		$rand = mt_rand(100000,999999);

		$main = $_FILES[$file] ['name'];
	    $name = "File_".$dateforfile."_".$rand."_".$main."";
	    $loc = $_FILES[$file] ['tmp_name'];
	    $folder ='../files/car/';
	    move_uploaded_file($loc, $folder.$name);

		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO car_file(id, file_discr, path, date) VALUES('$id', '$discr', '$name', '$datefroinsert')");	    
	}

//#############################################################################################################################

//#############################################################################################################################
	//For Term
	public function termReg($name,$tsd,$ted,$lt,$stat,$comp_reg,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert_1 = date("m/d/Y");

		$id_array_3 = array();
		$query_3 = mysqli_query($this->conn(), "SELECT * FROM term");
        while($row_3 = mysqli_fetch_assoc($query_3)){
            $id_array_3[] = $row_3["id"];
        }
        if (count($id_array_3) == 0) {
        	$this->id_term = 1000;
        }else{
        	$this->id_term = end($id_array_3) + 1;
        }
		mysqli_query($this->conn(), "INSERT INTO term (id, name, tsd, ted, license_t, stat, date, comp, editor) VALUES('$this->id_term', '$name', '$tsd', '$ted', '$lt', '$stat', '$datefroinsert_1', '$comp_reg', '$editor')");
	}

//#############################################################################################################################

//#############################################################################################################################
	//For License
	public function licenseReg($ls_name,$cod,$stat,$amount,$lice_cat){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert_2 = date("m/d/Y");

		$id_array_4 = array();
		$query_4 = mysqli_query($this->conn(), "SELECT * FROM license");
        while($row_4 = mysqli_fetch_assoc($query_4)){
            $id_array_4[] = $row_4["id"];
        }
        if (count($id_array_4) == 0) {
        	$this->id_lice = 1000;
        }else{
        	$this->id_lice = end($id_array_4) + 1;
        }
        mysqli_query($this->conn(), "INSERT INTO license (id, name, code, stat, amount, date, cat) VALUES('$this->id_lice', '$ls_name', '$cod', '$stat', '$amount', '$datefroinsert_2', '$lice_cat')");
	}

//#############################################################################################################################

//#############################################################################################################################
	// Updating Database
	public function updateStudentDetail($id,$array){
		$arr_key = array();
		$arr_val = array();
		foreach ($array as $key => $value) {
			$arr_key[] = $key;
			$arr_val[] = $value;
		}
		for ($i=0; $i<count($arr_key) ; $i++) { 
			mysqli_query($this->conn(), "UPDATE student SET $arr_key[$i] = '$arr_val[$i]' WHERE id = '$id'");
		}
		
	}

	public function updateStudentAddress($id,$array){
		$arr_key_1 = array();
		$arr_val_1 = array();
		foreach ($array as $key => $value) {
			$arr_key_1[] = $key;
			$arr_val_1[] = $value;
		}
		for ($i=0; $i<count($arr_key_1) ; $i++) { 
			mysqli_query($this->conn(), "UPDATE student_address SET $arr_key_1[$i] = '$arr_val_1[$i]' WHERE id = '$id'");
		}
		
	}

	public function updateMess($id,$mess,$editor){
		mysqli_query($this->conn(), "UPDATE message SET mess = '$mess', editor = '$editor' WHERE t_id = '$id' ");
	}

	public function updateTerm($id,$name,$stat,$comp,$tsd_edit,$ted_edit,$lt_edit,$editor){
		mysqli_query($this->conn(), "UPDATE term SET name = '$name', tsd = '$tsd_edit', ted = '$ted_edit', license_t = '$lt_edit' , stat = '$stat', comp = '$comp', editor = '$editor'  WHERE id = '$id' ");
	}

	public function updateLice($id,$name,$stat,$code,$amo,$lt_cat){
		mysqli_query($this->conn(), "UPDATE license SET name = '$name', code= '$code', stat = '$stat', amount = '$amo', cat = '$lt_cat' WHERE id = '$id' ");
	}

	public function uploadUpdate($id,$file, $folder,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
  		$dateforfile = date("mdY");
  		$rand = mt_rand(100000,999999);

		$main = $_FILES[$file] ['name'];
	    $name = "File_".$dateforfile."_".$rand."_".$main."";
	    $loc = $_FILES[$file] ['tmp_name'];
	    $folder ='../files/'.$folder.'/';
	    move_uploaded_file($loc, $folder.$name);

        mysqli_query($this->conn(), "UPDATE student_file SET $file ='$name', editor ='$editor' WHERE id = '$id'");	    
	}

	public function updateClass($id,$name,$stat,$editor){
		mysqli_query($this->conn(), "UPDATE class_type SET name ='$name', stat ='$stat', editor ='$editor' WHERE id = '$id'");
	}

	public function employeeUpdate($id,$name,$fname,$gname,$gender,$dor,$phone,$edu_lev,$e_type,$e_state,$fr_date,$to_date){

		mysqli_query($this->conn(), "UPDATE employee SET  name = '$name', fname = '$fname', gname = '$gname', gender = '$gender', dor = '$dor', phone = '$phone', edu_lev = '$edu_lev', e_type = '$e_type', e_state = '$e_state', fr_date = '$fr_date', to_date = '$to_date' WHERE id = '$id'");
	}

	public function updateCar($id,$name,$brand,$model,$plate,$dor,$car_type,$per_date,$pro_date,$stat,$editor){
		mysqli_query($this->conn(), "UPDATE car SET name = '$name', brand = '$brand', model = '$model', plate = '$plate', dor = '$dor', car_type = '$car_type', per_date = '$per_date', pro_date = '$pro_date', stat = '$stat', editor = '$editor' WHERE id = '$id'");
	}


//#############################################################################################################################

//#############################################################################################################################
	// For Student Fee
	public function studentFeeReg($id,$amount,$rn,$bn,$dp,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert3 = date("m/d/Y");
		mysqli_query($this->conn(),"INSERT INTO student_fee(id, amount, recipt_no, bank_name, date_paid, dr, editor) VALUES('$id', '$amount', '$rn', '$bn', '$dp', '$datefroinsert3', '$editor') ");
		$rowa_arr = array();
		$rowa = mysqli_query($this->conn(), "SELECT * FROM student_fee");
		while ($rawo = mysqli_fetch_assoc($rowa)) {
			$rowa_arr[] = $rawo['t_id'];
		}
		return end($rowa_arr);
	}

//#############################################################################################################################
	//For Message
	public function messageSend($ids,$phone,$mess,$type,$editor){
		$ids = mysqli_real_escape_string($this->conn(),$ids);
		$phone = mysqli_real_escape_string($this->conn(),$phone);
		$mess = mysqli_real_escape_string($this->conn(),$mess);
		$type = mysqli_real_escape_string($this->conn(),$type);
		$editor = mysqli_real_escape_string($this->conn(),$editor);

		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert4 = date("m/d/Y");
		$timeinsert = date('h:i:s');

		mysqli_query($this->conn(), "INSERT INTO message(id,  phone, mess, type, date, time, editor) VALUES('$ids', '$phone', '$mess', '$type', '$datefroinsert4', '$timeinsert', $editor)");
	}

//#############################################################################################################################

//#############################################################################################################################
	//For Class
	public function classReg($name,$stat,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert5 = date("m/d/Y");

		$id_array = array();
		$query = mysqli_query($this->conn(), "SELECT * FROM class_type");
        while($row = mysqli_fetch_assoc($query)){
            $id_array[] = $row["id"];
        }
        if(count($id_array) == 0){
        	$id_insert = 1000;
        }else{
        	$id_insert = end($id_array) + 1;
        }
		mysqli_query($this->conn(), "INSERT INTO class_type(id, name, date, stat, editor) VALUES('$id_insert', '$name', '$datefroinsert5', '$stat', '$editor')");
	}
//#############################################################################################################################

//#############################################################################################################################
	//For Deleting
	public function deleteTerm($id){
		mysqli_query($this->conn(), "DELETE FROM term WHERE id = '$id' ");
	}
	public function deleteLice($id){
		mysqli_query($this->conn(), "DELETE FROM license WHERE id = '$id' ");
	}
	public function deleteClass($id){
		mysqli_query($this->conn(), "DELETE FROM class_type WHERE id = '$id' ");
	}

//#############################################################################################################################

//#############################################################################################################################
	//For Employee
	public function employeeRegister($name,$fname,$gname,$gender,$dor,$phone,$edu_lev,$e_type,$e_state,$fr_date,$to_date){

		$id_array_3 = array();
		$query_3 = mysqli_query($this->conn(), "SELECT * FROM employee");
        while($row_3 = mysqli_fetch_assoc($query_3)){
            $id_array_3[] = $row_3["id"];
        }
        if (count($id_array_3) == 0) {
        	$this->id_employee = 1000;
        }else{
        	$this->id_employee = end($id_array_3) + 1;
        }
		mysqli_query($this->conn(), "INSERT INTO employee (id, name, fname, gname, gender, dor, phone, edu_lev, e_type, e_state, fr_date, to_date) VALUES('$this->id_employee', '$name', '$fname', '$gname', '$gender', '$dor', '$phone', '$edu_lev', '$e_type', '$e_state', '$fr_date', '$to_date')");
		return $this->id_employee;
	}

//#############################################################################################################################

//#############################################################################################################################
	//For Car
	public function carRegister($name,$brand,$model,$plate,$dor,$car_type,$per_date,$pro_date,$stat,$editor){
		$id_array_3 = array();
		$query_3 = mysqli_query($this->conn(), "SELECT * FROM car");
        while($row_3 = mysqli_fetch_assoc($query_3)){
            $id_array_3[] = $row_3["id"];
        }
        if (count($id_array_3) == 0) {
        	$this->id_car = 1000;
        }else{
        	$this->id_car = end($id_array_3) + 1;
        }
		mysqli_query($this->conn(), "INSERT INTO car (id, name, brand, model, plate, dor, car_type, per_date, pro_date, stat, editor) VALUES('$this->id_car', '$name', '$brand', '$model', '$plate', '$dor', '$car_type', '$per_date', '$pro_date', '$stat', '$editor')");
		return $this->id_car;
	}

	public function catPetrolReg($id,$birr,$petrol,$taker,$giver,$date_in,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$date = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO car_petrol(id, birr, petrol, taker, giver, date_input_db, date_insert, editor) VALUES('$id', '$birr', '$petrol', '$taker', '$giver', '$date', '$date_in', '$editor')");
	}

	public function carMaintainCost($id,$giver,$taker,$discr,$price,$date_ins,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$date = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO car_maint(id, giver, taker, discr, price, date_ins, date_db, editor) VALUES('$id', '$giver', '$taker', '$discr', '$price', '$date_ins', '$date', '$editor')");
	}

//#############################################################################################################################

//#############################################################################################################################
	//For Invoice
	public function invoiceReg($inv_no,$id,$editor){
		date_default_timezone_set("Africa/Addis_Ababa");
		$date = date("m/d/Y");
		mysqli_query($this->conn(), "INSERT INTO invoice(inv_no, id, date, editor) VALUES('$inv_no', '$id', '$date', '$editor')");
	}
}
