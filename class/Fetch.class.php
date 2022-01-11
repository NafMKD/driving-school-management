<?php

/**
 * Fetch Class
 */
class Fetch extends Db
{	
	private function roof(){
		$arry = array();
		$query =mysqli_query($this->conn(), "SELECT * FROM student");
		while ( $row=mysqli_fetch_assoc($query)) {
			$arry[] = $row['id'];
		}
	 	$array = end($arry);
	 	return $array;
	}

//######################################################################################################################
	// For Recipt 

	public function fechReciptDetail(){

		//From Student
		$coco = $this->roof();
		$arry_1 = array();
		$query_1 = mysqli_query($this->conn(), "SELECT * FROM student WHERE id = '$coco' ");
		while ($row_1 = mysqli_fetch_assoc($query_1)) {
			$arry_1[] = $row_1; 
		}
		return $arry_1;
	}

	public function fetchReciptAddress(){

		//From Student Address 
		$cocoo = $this->roof();
		$arry_2 = array();
		$query_2 = mysqli_query($this->conn(), "SELECT * FROM student_address WHERE id = '$cocoo' ");
		while ($row_2 = mysqli_fetch_assoc($query_2)) {
			$arry_2[] = $row_2; 
		}
		return $arry_2;

	}

	public function fetchReciptTerm($id){

		//From Term 
		$arry_3 = array();
		$query_3 = mysqli_query($this->conn(), "SELECT * FROM term WHERE id = '$id' ");
		while ($row_3 = mysqli_fetch_assoc($query_3)) {
			$arry_3[] = $row_3; 
		}
		return $arry_3;

	}
//########################################################################################################################

//########################################################################################################################
	//For Term

	public function fetchTerm($data){
		if ($data == "All") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM term ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Open") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM term  WHERE stat = 1 AND comp = 0 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Closed") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM term WHERE stat = 0 AND comp = 0 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Canceled") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM term WHERE comp = 1 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}
		

	}

	public function fetchTermId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM term WHERE id = '$id' "));
		return $querytermid;

	}

//##########################################################################################################################

//##########################################################################################################################
	//For License
	public function fetchLicense($data){
		if($data == "All"){
			$array_lice = array();
			$querylice = mysqli_query($this->conn(), "SELECT * FROM license ORDER BY t_id DESC");
			while($rowlice = mysqli_fetch_assoc($querylice)){
				$array_lice[] = $rowlice;
			}
			return $array_lice;
		}

		if($data == "Active"){
			$array_lice = array();
			$querylice = mysqli_query($this->conn(), "SELECT * FROM license WHERE stat = 1  ORDER BY t_id DESC");
			while($rowlice = mysqli_fetch_assoc($querylice)){
				$array_lice[] = $rowlice;
			}
			return $array_lice;
		}

		if($data == "Canceled"){
			$array_lice = array();
			$querylice = mysqli_query($this->conn(), "SELECT * FROM license WHERE stat = 0  ORDER BY t_id DESC");
			while($rowlice = mysqli_fetch_assoc($querylice)){
				$array_lice[] = $rowlice;
			}
			return $array_lice;
		}
	}

	public function fetchLicenseId($id){
		$output = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM license WHERE id = $id"));
		return $output;
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Student
	public function fetchStudent($data){
		if($data == "Now"){
			$array_lice_2 = array();
			$querylice_2 = mysqli_query($this->conn(), "SELECT * FROM student WHERE comp = 0 ORDER BY t_id DESC");
			while($rowlice_2 = mysqli_fetch_assoc($querylice_2)){
				$array_lice_2[] = $rowlice_2;
			}
			return $array_lice_2;
		}elseif ($data == "All") {
			$array_lice_2 = array();
			$querylice_2 = mysqli_query($this->conn(), "SELECT * FROM student ORDER BY t_id DESC");
			while($rowlice_2 = mysqli_fetch_assoc($querylice_2)){
				$array_lice_2[] = $rowlice_2;
			}
			return $array_lice_2;
		}elseif ($data == "Finished") {
			$array_lice_2 = array();
			$querylice_2 = mysqli_query($this->conn(), "SELECT * FROM student WHERE comp = 1 ORDER BY t_id DESC");
			while($rowlice_2 = mysqli_fetch_assoc($querylice_2)){ 
				$array_lice_2[] = $rowlice_2;
			}
			return $array_lice_2;
		}
		
	}

	public function fetchStudentId($id){
		$array_lice_4 = array();
		$querylice_4 = mysqli_query($this->conn(), "SELECT * FROM student WHERE id = '$id'");
		while($rowlice_4 = mysqli_fetch_assoc($querylice_4)){
			$array_lice_4[] = $rowlice_4;
		}
		return $array_lice_4;
	}

	public function fetchStudentAddId($id){
		$array_lice_5 = array();
		$querylice_5 = mysqli_query($this->conn(), "SELECT * FROM student_address WHERE id = '$id'");
		while($rowlice_5 = mysqli_fetch_assoc($querylice_5)){
			$array_lice_5[] = $rowlice_5;
		}
		return $array_lice_5;
	}

	public function fetchStudentTermId($id){
		$array_lice_6 = array();
		$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student WHERE term_lic = '$id'");
		while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
			$array_lice_6[] = $rowlice_6;
		}
		return $array_lice_6;
	}

	public function fetchStudentLiceId($data,$id){
		if ($data == "oncampus") {
			$array_lice_6 = array();
			$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student WHERE lt = '$id' AND comp = 0 ORDER BY t_id DESC");
			while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
				$array_lice_6[] = $rowlice_6;
			}
			return $array_lice_6;		
		}elseif ($data == "offcampus") {
			$array_lice_6 = array();
			$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student WHERE lt = '$id' AND comp = 1 ORDER BY t_id DESC");
			while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
				$array_lice_6[] = $rowlice_6;
			}
			return $array_lice_6;		
		}elseif ($data == "All") {
			$array_lice_6 = array();
			$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student WHERE lt = '$id' ORDER BY t_id DESC");
			while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
				$array_lice_6[] = $rowlice_6;
			}
			return $array_lice_6;		
		}
		
	}

	public function fetchstudentExel(){
		$array_lice_6 = array();
		$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student ORDER BY t_id DESC");
		$querylice_67 = mysqli_query($this->conn(), "SELECT * FROM student_address ORDER BY t_id DESC");
		while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
			$array_lice_6[$rowlice_6['id']] = $rowlice_6;
		}
		while($rowlice_6w = mysqli_fetch_assoc($querylice_67)){
			$array_lice_6[$rowlice_6w['id']][1] = $rowlice_6w;
		}
		return $array_lice_6;
	}

	public function fetchStudentFileId($id){
		$array_lice_6 = array();
		$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student_file WHERE id = '$id'");
		while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
			$array_lice_6[] = $rowlice_6;
		}
		return $array_lice_6;
	}
	

//##########################################################################################################################

//##########################################################################################################################
	// Filtering
	public function fetcFilter($data){
		$array_lice_3 = array();
		$querylice_3 = mysqli_query($this->conn(), $data);
		while($rowlice_3 = mysqli_fetch_assoc($querylice_3)){
			$array_lice_3[] = $rowlice_3;
		}
		return $array_lice_3;
	}

//##########################################################################################################################

//##########################################################################################################################
	// From Student Fee
	public function fetchStudentFeeId($id){
		$array_lice_6 = array();
		$querylice_6 = mysqli_query($this->conn(), "SELECT SUM(amount),recipt_no,bank_name,date_paid,dr FROM student_fee WHERE id = '$id'");
		while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
			$array_lice_6[] = $rowlice_6;
		}
		return $array_lice_6;
	}

	public function fetchStudentFeeDetailId($id){
		$array_lice_6 = array();
		$querylice_6 = mysqli_query($this->conn(), "SELECT * FROM student_fee WHERE id = '$id'");
		while($rowlice_6 = mysqli_fetch_assoc($querylice_6)){
			$array_lice_6[] = $rowlice_6;
		}
		return $array_lice_6;
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Notification 
	public function notificationByTerm($trm,$num){
		$array_term_7 = array();
		$queryterm_7 = mysqli_query($this->conn(), "SELECT * FROM student WHERE term_lic = '$trm' AND comp = 0 AND stat = 1");
		while($rowterm_7 = mysqli_fetch_assoc($queryterm_7)){
			$array_term_7[] = $rowterm_7['id'];
		}
		
		$array_term_8 = array();
		foreach ($array_term_7 as $key ) {
			$testing = $this->fetchStudentFeeId($key)[0]['SUM(amount)'];
			$lice_typ = $this->fetchStudentId($key)[0]['lt'];
			$lice_amo = $this->fetchLicenseId($lice_typ)['amount'];

			if ($testing == $lice_amo) {
				$array_term_8[] = $key;
			}
		}
		

		$array_term_9 = array();
		foreach ($array_term_8 as $key => $value) {
			$queryterm_8 = mysqli_query($this->conn(), "SELECT id,dor FROM student WHERE id = '$value'");
			while ($rowterm_8 = mysqli_fetch_assoc($queryterm_8)) {
				$array_term_9[$rowterm_8['id']] = date_create($rowterm_8['dor']);
			}
		}

		asort($array_term_9);
		$nw_arr = array();
		foreach ($array_term_9 as $key => $value) {
			$nw_arr[]= $key;
		}
		return array_slice($nw_arr, 0, $num);
			
	}

	public function notificationByLice($trm,$num){
		$array_term_7 = array();
		$queryterm_7 = mysqli_query($this->conn(), "SELECT * FROM student WHERE lt = '$trm' AND comp = 0 AND stat = 1");
		while($rowterm_7 = mysqli_fetch_assoc($queryterm_7)){
			$array_term_7[] = $rowterm_7['id'];
		}
		
		$array_term_8 = array();
		foreach ($array_term_7 as $key ) {
			$testing = $this->fetchStudentFeeId($key)[0]['SUM(amount)'];
			$lice_typ = $this->fetchStudentId($key)[0]['lt'];
			$lice_amo = $this->fetchLicenseId($lice_typ)['amount'];

			if ($testing == $lice_amo) {
				$array_term_8[] = $key;
			}
		}
		

		$array_term_9 = array();
		foreach ($array_term_8 as $key => $value) {
			$queryterm_8 = mysqli_query($this->conn(), "SELECT id,dor FROM student WHERE id = '$value'");
			while ($rowterm_8 = mysqli_fetch_assoc($queryterm_8)) {
				$array_term_9[$rowterm_8['id']] = date_create($rowterm_8['dor']);
			}
		}

		asort($array_term_9);
		$nw_arr = array();
		foreach ($array_term_9 as $key => $value) {
			$nw_arr[]= $key;
		}
		return array_slice($nw_arr, 0, $num);
			
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Message
	public function messageFetch($data){
		if ($data == "All") {
			$array_lice_10 = array();
			$querylice_10 = mysqli_query($this->conn(), "SELECT * FROM message ORDER BY t_id DESC");
			while($rowlice_10 = mysqli_fetch_assoc($querylice_10)){
				$array_lice_10[] = $rowlice_10;
			}
			return $array_lice_10;
		}elseif ($data == "Sended") {
			$array_lice_10 = array();
			$querylice_10 = mysqli_query($this->conn(), "SELECT * FROM message WHERE stat = 1 ORDER BY t_id DESC");
			while($rowlice_10 = mysqli_fetch_assoc($querylice_10)){
				$array_lice_10[] = $rowlice_10;
			}
			return $array_lice_10;
		}elseif ($data == "NotSended") {
			$array_lice_10 = array();
			$querylice_10 = mysqli_query($this->conn(), "SELECT * FROM message  WHERE stat = 0 ORDER BY t_id DESC");
			while($rowlice_10 = mysqli_fetch_assoc($querylice_10)){
				$array_lice_10[] = $rowlice_10;
			}
			return $array_lice_10;
		}
	}

	public function messageById($id){
		$array_lice_12 = array();
		$querylice_12 = mysqli_query($this->conn(), "SELECT * FROM message  WHERE t_id = '$id' ");
		while($rowlice_12 = mysqli_fetch_assoc($querylice_12)){
			$array_lice_12[] = $rowlice_12;
		}
		return $array_lice_12;
	}

	public function messageSender($tid,$editor){
		$array_mesage_id = $this->messageById($tid);
		if ($array_mesage_id[0]['type'] == 3) {
			$phones = $array_mesage_id[0]['phone'];
		}else{
			$phones = explode("/",$array_mesage_id[0]['phone']);
		}

		$mess = $array_mesage_id[0]['mess'];

		// Sendign Code Goes Here

		date_default_timezone_set("Africa/Addis_Ababa");
		$datefroinsert = date("m/d/Y");
		$timefroinsert = date('h:i:s');

		mysqli_query($this->conn(), "UPDATE message SET editor = '$editor', send_time = '$timefroinsert', send_date = '$datefroinsert', stat = 1 WHERE  t_id = '$tid' ");
	}

	public function messageDelete($tid){
		mysqli_query($this->conn(), "DELETE FROM message WHERE  t_id = '$tid' ");
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Employe
	public function employeFetchId($id){
		$array_lice_11 = array();
		$querylice_11 = mysqli_query($this->conn(), "SELECT * FROM employe_action WHERE id = '$id'");
		while($rowlice_11 = mysqli_fetch_assoc($querylice_11)){
			$array_lice_11[] = $rowlice_11;
		}
		return $array_lice_11;
	}

//##########################################################################################################################

//########################################################################################################################
	//For Classs

	public function fetchClass($data){
		if ($data == "All") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM class_type ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Active") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM class_type  WHERE stat = 0 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Deactive") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM class_type WHERE stat = 1 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}
		

	}

	public function fetchClassId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM class_type WHERE id = '$id' "));
		return $querytermid;

	}

	public function fetchstudentClassAndTerm($trm,$clid){
		$out_arr = array();
		$querytermid = mysqli_query($this->conn(), "SELECT * FROM Student WHERE term_lic = '$trm' AND c_type = '$clid' ");
		while($rowterm = mysqli_fetch_assoc($querytermid)){
				$out_arr[] = $rowterm;
			}
		return $out_arr;

	}

//##########################################################################################################################

//########################################################################################################################
	//For Employee
	public function fetchEmployee($data){
		if ($data == "All") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM employee ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Active") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM employee  WHERE stat = 0 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Deactive") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM employee WHERE stat = 1 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Constant") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM employee WHERE e_state = 1 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "Contrat") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM employee WHERE e_state = 2 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}
		

	}

	public function fetchEmployeeId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM employee WHERE id = '$id' "));
		return $querytermid;

	}

//##########################################################################################################################

//##########################################################################################################################
	//For Student Status
	public function studentStatusId($id){
		$querystatid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM student_stat WHERE id = '$id' "));
		return $querystatid;
	}

//##########################################################################################################################
	//For Calculation
	public function statusCalculator($id){
		$arr_id = $this->fetchStudentId($id)[0];
		$trm_id = $arr_id['term_lic'];
		$n_class = $this->studentStatusId($id);
		$trm_fetch = $this->fetchTermId($trm_id);

		$date_one_stat = date_create($trm_fetch['tsd']);
        $date_two_stat = date_create(date("m/d/Y"));
        $ntd = date_diff($date_one_stat,$date_two_stat)->format("%a");
        if (isset($n_class) > 0) {
        	$nad = $n_class['n_class'];
	        $cal1 = $nad * 100;
	        $cal2 = $cal1 / $ntd;

	        return $cal2;
        }else{
        	return 0;
        }	
	}

	public function calculatorForHomeDays($data){
		$main_arry = $this->fetchTerm($data);
		$second_arry = array();
		foreach ($main_arry as $key) {
			$fetchingtrm_byid = $this->fetchTermId($key['id']);
			$tsd = $fetchingtrm_byid['tsd'];
			$ted = $fetchingtrm_byid['ted'];

			$date_one_main = date_create($fetchingtrm_byid['tsd']);
	        $date_two_main = date_create($fetchingtrm_byid['ted']);
	        $ntd = date_diff($date_one_main,$date_two_main)->format("%a");

	        $date_one_now = date_create($fetchingtrm_byid['tsd']);
	        $date_two_now = date_create(date_create("m/d/Y"));
	        $nad = date_diff($date_one_now,$date_two_now)->format("%a");

	        $cal1 = $nad * 100;
	        $cal2 = $cal1 / $ntd;

			$second_arry[$key['id']]=$cal2;
		}
		return $second_arry;
	}

	public function calculatorAnnounceDays(){
		$main_arry = $this->fetchTerm("Closed");
		$second_arry = array();
		foreach ($main_arry as $key) {
			$fetchingtrm_byid = $this->fetchTermId($key['id']);
			$tsd = $fetchingtrm_byid['tsd'];
			$ted = $fetchingtrm_byid['ted'];

			$date_one_main = date_create($fetchingtrm_byid['tsd']);
	        $date_two_main = date_create($fetchingtrm_byid['ted']);
	        $ntd = date_diff($date_one_main,$date_two_main)->format("%a");

	        $date_one_now = date_create($fetchingtrm_byid['tsd']);
	        $date_two_now = date_create(date_create("m/d/Y"));
	        $nad = date_diff($date_one_now,$date_two_now)->format("%a");

	        if($nad >= $ntd ){

	        	$second_arry[$key['id']]= $nad - $ntd ;
	        }else{
	        	$second_arry[$key['id']] ="goodToGo";

	        }
			
		}
		return $second_arry;
	}

	public function calculatorForHomeStud($data){
		$main_arry = $this->fetchTerm($data);
		$second_arry = array();
		foreach ($main_arry as $key) {
			$fetchingtrm_byid = $this->fetchStudentTermId($key['id']);
			$cal2 = count($fetchingtrm_byid);
			$second_arry[$key['name']]=$cal2;
		}
		return $second_arry;
	}

	public function calculatorForHomeLice($data){
		$main_arry = $this->fetchLicense($data);
		$second_arry = array();
		foreach ($main_arry as $key) {
			$fetchingtrm_byid = $this->fetchStudentLiceId("All", $key['id']);
			$cal2 = count($fetchingtrm_byid);
			$second_arry[$key['id']]=$cal2;
		}
		return $second_arry;
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Car
	public function fetchCar($data){
		if ($data == "All") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM car ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "onroad") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM car  WHERE stat = 0 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}elseif ($data == "offroad") {
			$array_term = array();
			$queryterm = mysqli_query($this->conn(), "SELECT * FROM car  WHERE stat = 1 ORDER BY t_id DESC ");
			while($rowterm = mysqli_fetch_assoc($queryterm)){
				$array_term[] = $rowterm;
			}
			return $array_term;
		}
	}

	public function fetchCarId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM car WHERE id = '$id' "));
		return $querytermid;
	}

	public function fetchPetrol(){
		$array_term = array();
		$queryterm = mysqli_query($this->conn(), "SELECT * FROM car_petrol ORDER BY t_id DESC ");
		while($rowterm = mysqli_fetch_assoc($queryterm)){
			$array_term[] = $rowterm;
		}
		return $array_term;
	}

	public function fetchPetrolId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM car_petrol WHERE t_id = '$id' "));
		return $querytermid;
	}

	public function fetchMaintain(){
		$array_term = array();
		$queryterm = mysqli_query($this->conn(), "SELECT * FROM car_maint ORDER BY t_id DESC ");
		while($rowterm = mysqli_fetch_assoc($queryterm)){
			$array_term[] = $rowterm;
		}
		return $array_term;
	}

	public function fetchMaintainId($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM car_maint WHERE t_id = '$id' "));
		return $querytermid;
	}

//##########################################################################################################################

//##########################################################################################################################
	//For Invoice
	public function fetchFeeTID($id){
		$querytermid = mysqli_fetch_assoc(mysqli_query($this->conn(), "SELECT * FROM student_fee WHERE t_id = '$id' "));
		return $querytermid;
	}

	public function invoiceNoGen(){
		date_default_timezone_set("Africa/Addis_Ababa");
		$arr_ff = array();
		$que_gen = mysqli_query($this->conn(), "SELECT * FROM invoice");
		while ($row_ge = mysqli_fetch_assoc($que_gen)) {
			$arr_ff[] = $row_ge['inv_no'];
		}
		if (count($arr_ff) == 0) {
			$id_outm = '1000/'.date("Y");
		}else{
			$id_outs = explode("/", end($arr_ff));
			$id_outm = ($id_outs[0]+1)."/".date("Y");
		}	

		return $id_outm;	
		
	}

}

