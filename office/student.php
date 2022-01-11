<?php
session_start();
$title = "Student List";
$stud = "active";
$stud_list = "active";
include 'autoloader.php';
$obj_converter = new converter;
$obj_fetch = new Fetch;
$obj = new register;
$select_cons = 1;
$select_cons_up = 0;

if(isset($_POST['upload_file'])){
  $updaterid = $_POST['updaterid'];
  if (!empty($_FILES['pasport']['name'])) {
   $obj->uploadUpdate($updaterid,'pasport', 'pasport', $_SESSION['id']);
  }

  if (!empty($_FILES['med_file']['name'])) {
   $obj->uploadUpdate($updaterid,'med_file', 'medical', $_SESSION['id']);
  }

  if (!empty($_FILES['edu']['name'])) {
   $obj->uploadUpdate($updaterid,'edu', 'education', $_SESSION['id']);
  }

  if (!empty($_FILES['trans']['name'])) {
   $obj->uploadUpdate($updaterid,'trans', 'transcript', $_SESSION['id']);
  }

  if (!empty($_FILES['photo']['name'])) {
   $obj->uploadUpdate($updaterid,'photo', 'photo', $_SESSION['id']);
  }
  
  $final_msg = "";

  
  $row_stud = $obj_fetch->fechReciptDetail()['0'];
  $row_add = $obj_fetch->fetchReciptAddress()['0'];

  $id_show = $row_stud['id'];
  $term_id = $row_stud['term_lic'];
  if($row_stud['lang'] == 2){
    $lang_show = "Amharic";
  }elseif($row_stud['lang'] == 1){
    $lang_show = "A/Oromo";
  }

  if($row_stud['gender'] == 1){
  $gen_show = "Male";
  }elseif($row_stud['gender'] == 2){
  $gen_show = "Female";
  }

  if($row_add['region'] == 1){
  $reg_show = "Orormia";
  }elseif($row_add['region'] == 2){
  $reg_show = "Addis Ababa";
  }elseif($row_add['region'] == 3){
  $reg_show = "Afar";
  }elseif($row_add['region'] == 4){
  $reg_show = "Amhara";
  }elseif($row_add['region'] == 5){
  $reg_show = "Benishagul";
  }elseif($row_add['region'] == 6){
  $reg_show = "Dere Dawa";
  }elseif($row_add['region'] == 7){
  $reg_show = "Gambela";
  }elseif($row_add['region'] == 8){
  $reg_show = "Harari";
  }elseif($row_add['region'] == 9){
  $reg_show = "SNNP";
  }elseif($row_add['region'] == 10){
  $reg_show = "Somali";
  }elseif($row_add['region'] == 11){
  $reg_show = "Tigrai";
  }

  $zon_show = $row_add['zone'];

  $row_term = $obj_fetch->fetchReciptTerm($term_id)['0'];
  $term_show = $row_term['name'];
  $tsd_show =  $row_term['tsd'];
  $ted_show =  $row_term['ted'];
  $lt_show = $row_term['license_t'];



}

?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'includes/css.inc.php';?>
    <!-- local -->
  <link rel="stylesheet" href="../assets/photo.css">
</head>
<body class="hold-transition skin-blue ">
	<?php include 'includes/main.inc.php';?>

	<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Students
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Students</a></li>
      </ol>
    </section>

    <section class="content">
      <?php if(!isset($final_msg)){ ?>
      <?php if(isset($_GET['gen']) && isset($_GET['trm']) && isset($_GET['lt'])){ ?>
        <div class="row">
          <div class="col-xs-12" style="margin-top: 10px;">
            <div class="box">
              <div class="box-header" style="margin-top: 5px;">
                <h3 class="box-title">All Students:</h3>
              </div>
              <hr>
              <div class="box-body">
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                  <div class="row" >
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control select2" name="gen" id="selectGen" >
                          <option value="0/0">-- All Gender --</option>
                          <option value="1/1">Male</option>
                          <option value="2/2">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Term</label>
                        <select class="form-control select2" name="trm" id="selectTrm">
                          <option value="0/0">-- All Terms --</option>
                          <?php 
                          $fetcher_active = $obj_fetch->fetchTerm("All");
                          $indexcnt = 1;
                          foreach ($fetcher_active as $key_1 ) {
                            ?>
                          <option value="<?php echo htmlspecialchars($key_1['id']);?>/<?php echo htmlspecialchars($indexcnt);?>" ><?php echo htmlspecialchars($key_1['name']);?></option>
                          <?php $indexcnt = $indexcnt +1;} ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>License Type</label>
                        <select class="form-control select2" name="lt" id="selectLt">
                          <option value="0/0">-- All License Types --</option>
                          <?php 
                          $fetcher_active = $obj_fetch->fetchLicense("All");
                          $indexcnt = 1;
                          foreach ($fetcher_active as $key_1 ) {
                            ?>
                          <option value="<?php echo htmlspecialchars($key_1['id']);?>/<?php echo htmlspecialchars($indexcnt);?>" ><?php echo htmlspecialchars($key_1['name']);?></option>
                          <?php $indexcnt = $indexcnt +1;} ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <center>
                        <div style="margin-top: 1%; ">
                          <input type="submit" id="filteBtn" onclick="return filterChangeFun()" class="btn btn-primary" value="Filter" >
                        </div>
                      </center>
                    </div>
                  </div>                 
                </form>
                <hr>
                <table id="table_stud" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Term</th>
                    <th>License Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      if ($_GET['gen'] == '0/0' && $_GET['trm'] == '0/0' && $_GET['lt'] == '0/0' ) {
                      $array = $obj_fetch->fetchStudent("All");
                      $cnt = 1;
                      foreach ($array as $key ) {
                      if($key['gender'] == 1){
                        $gen_show = "Male";
                      }elseif($key['gender'] == 2){
                        $gen_show = "Female";
                      }
                      if($key['comp'] == 0){
                        $stat_rep = "On Campus";
                        $stat_cl = "text-success";
                      }elseif($key['comp'] == 1){
                        $stat_rep = "Off Campus";
                        $stat_cl = "text-danger";
                      }

                      $trm_show = $obj_fetch->fetchTermId($key['term_lic']);
                      $lt_show = $obj_fetch->fetchLicenseId($key['lt']);
                         
                    ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                      <td><?php echo htmlspecialchars($gen_show); ?></td>
                      <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                      <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                      <td class="<?php echo htmlspecialchars($stat_cl); ?>"><?php echo htmlspecialchars($stat_rep); ?></td>
                      <td >
                        <a href="student.php?view=<?php echo htmlspecialchars($key['id']) ?>">Detail</a>
                          ||
                        <a href="student.php?update=<?php echo htmlspecialchars($key['id']) ?>">Edit</a>
                      </td>
                    </tr>
                    <?php $cnt=$cnt+1;} }else{
                        $select_cons = 0;
                        $gender = explode("/", $_GET['gen']);
                        $term = explode("/",$_GET['trm']);
                        $lt = explode("/",$_GET['lt']);

                        $query = "SELECT * FROM student WHERE";
                        $val = 0;
                        if ($gender[0] != 0) {
                          $val = 1;
                          $query .= " gender = '$gender[0]'";
                          $selection_ind_gen = $gender[1];
                        }
                        if ($term[0] != 0) {
                          if ($val == 1) {
                            $query .= "AND term_lic = '$term[0]'";
                            $selection_ind_trm = $term[1];
                          }else{
                            $val = 1;
                            $query .= " term_lic = '$term[0]'";
                            $selection_ind_trm = $term[1];
                          }
                        }
                        if($lt[0] != 0){
                          if ($val == 1) {
                            $query .= "AND lt = '$lt[0]'";
                            $selection_ind_lt = $lt[1];
                          }else{
                            $val = 1;
                            $query .= " lt = '$lt[0]'";
                            $selection_ind_lt = $lt[1];
                          }
                        }

                        $out = $obj_fetch->fetcFilter($query);
                        $cnt = 1;
                        foreach ($out as $key ) {
                        if($key['gender'] == 1){
                              $gen_show = "Male";
                          }elseif($key['gender'] == 2){
                              $gen_show = "Female";
                          }
                          $trm_show = $obj_fetch->fetchTermId($key['term_lic']);
                          $lt_show = $obj_fetch->fetchLicenseId($key['lt']);

                          if($key['comp'] == 0){
                            $stat_rep = "On Campus";
                            $stat_cl = "text-success";
                          }elseif($key['comp'] == 1){
                            $stat_rep = "Off Campus";
                            $stat_cl = "text-danger";
                          }

                      ?>
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                        <td><?php echo htmlspecialchars($gen_show); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                        <td class="<?php echo htmlspecialchars($stat_cl); ?>"><?php echo htmlspecialchars($stat_rep); ?></td>
                        <td >
                          <a href="student.php?view=<?php echo htmlspecialchars($key['id']) ?>">Detail</a>
                          ||
                          <a href="student.php?update=<?php echo htmlspecialchars($key['id']) ?>">Edit</a>
                        </td>
                      </tr>  
                      <?php $cnt=$cnt+1;}}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php }?>
      <?php if(isset($_GET['update'])){
        $select_cons_up = 1;
        $id_stud_up = $_GET['update'];
        $stud_fetch_id = $obj_fetch->fetchStudentId($id_stud_up)[0];
        $stud_fetch_id_add = $obj_fetch->fetchStudentAddId($id_stud_up)[0];

        $ethiopic_dob = $obj_converter->toEth($stud_fetch_id['dob']);
        $ethiopic_dor = $obj_converter->toEth($stud_fetch_id['dor']);

        $lice_out = $obj_fetch->fetchLicenseId($stud_fetch_id['lt']);
        $term_out = $obj_fetch->fetchTermId($stud_fetch_id['term_lic']);

        if ($stud_fetch_id['blood'] == "A+") {
           $select_bl_type = 1;
        }elseif ($stud_fetch_id['blood'] == "A-") {
           $select_bl_type = 2;
        }elseif ($stud_fetch_id['blood'] == "B+") {
           $select_bl_type = 3;
        }elseif ($stud_fetch_id['blood'] == "AB+") {
           $select_bl_type = 4;
        }elseif ($stud_fetch_id['blood'] == "AB-") {
           $select_bl_type = 5;
        }elseif ($stud_fetch_id['blood'] == "O+") {
           $select_bl_type = 6;
        }elseif ($stud_fetch_id['blood'] == "O-") {
           $select_bl_type = 7;
        }

        if ($stud_fetch_id['edu_lev'] == 16) {
           $select_edu_lev = 1;
        }elseif ($stud_fetch_id['edu_lev'] == 1) {
           $select_edu_lev = 2;
        }elseif ($stud_fetch_id['edu_lev'] == 2) {
           $select_edu_lev = 3;
        }elseif ($stud_fetch_id['edu_lev'] == 4) {
           $select_edu_lev = 4;
        }elseif ($stud_fetch_id['edu_lev'] == 5) {
           $select_edu_lev = 5;
        }elseif ($stud_fetch_id['edu_lev'] == 6) {
           $select_edu_lev = 6;
        }elseif ($stud_fetch_id['edu_lev'] == 7) {
           $select_edu_lev = 7;
        }elseif ($stud_fetch_id['edu_lev'] == 8) {
           $select_edu_lev = 8;
        }elseif ($stud_fetch_id['edu_lev'] == 10) {
           $select_edu_lev = 9;
        }elseif ($stud_fetch_id['edu_lev'] == 11) {
           $select_edu_lev = 10;
        }elseif ($stud_fetch_id['edu_lev'] == 12) {
           $select_edu_lev = 11;
        }elseif ($stud_fetch_id['edu_lev'] == 13) {
           $select_edu_lev = 12;
        }elseif ($stud_fetch_id['edu_lev'] == 15) {
           $select_edu_lev = 13;
        }
       ?>
        <div class="row">
          <div class="col-md-12">

            <!-- First Box -->
            <form name="Detail">
              <div class="box box-primary">
                <div class="box-header">
                  <div class="row">
                    <div class="col-md-4">
                      <h3 class="box-title">Student Detail: <a id="stud_id"> <?php echo $_GET['update']; ?></a></h3>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-2">
                      <a href="student.php?gen=0/0&trm=0/0&lt=0/0">
                        <button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  </div>
                  

                </div>
                <div class="box-body" id="recieveddatadetail">
                  <div class="row" style="margin-top: 15px;">
                    <div class="col-md-4">
                        <!-- English-->
                      <div class="form-group">
                        <label>Name | English |</label>
                        <input type="text" class="form-control" name="name_eng" value="<?php echo htmlspecialchars($stud_fetch_id['name']);?>">
                      </div>

                      <div class="form-group">
                        <label>Father Name | English |</label>
                        <input type="text" class="form-control" name="fname_eng" value="<?php echo htmlspecialchars($stud_fetch_id['fname']);?>">
                      </div>

                      <div class="form-group">
                        <label>Grand Father Name | English |</label>
                        <input type="text" class="form-control" name="gname_eng" value="<?php echo htmlspecialchars($stud_fetch_id['gname']);?>">
                      </div>

                    </div>

                    <div class="col-md-4">
                        <!-- A/Oromo-->
                      <div class="form-group">
                        <label class="text-info">Name | A/Oromo |</label>
                        <input type="text" class="form-control" name="name_or" value="<?php echo htmlspecialchars($stud_fetch_id['name_or']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-info">Father Name | A/Oromo |</label>
                        <input type="text" class="form-control" name="fname_or" value="<?php echo htmlspecialchars($stud_fetch_id['fname_or']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-info">Grand Father Name | A/Oromo |</label>
                        <input type="text" class="form-control" name="gname_or" value="<?php echo htmlspecialchars($stud_fetch_id['gname_or']);?>">
                      </div>

                    </div>

                    <div class="col-md-4">
                        <!-- Amharic-->
                      <div class="form-group">
                        <label class="text-success">Name | Amharic |</label>
                        <input type="text" class="form-control" name="name_amh" value="<?php echo htmlspecialchars($stud_fetch_id['name_amh']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-success">Father Name | Amharic |</label>
                        <input type="text" class="form-control" name="fname_amh" value="<?php echo htmlspecialchars($stud_fetch_id['fname_amh']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-success">Grand Father Name | Amharic |</label>
                        <input type="text" class="form-control" name="gname_amh" value="<?php echo htmlspecialchars($stud_fetch_id['gname_amh']);?>">
                      </div>

                    </div>

                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label >Gender</label>
                        <select class="form-control select2" name="gender" id="selectGenUp">
                          <option></option>
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Date of Birth</label>
                        <input type="text" class="form-control" name="dob" value="<?php echo $ethiopic_dob; ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
                      </div>

                      <div class="form-group">
                        <label >Date of Registration</label>
                        <input type="text" class="form-control" name="dor" value="<?php echo $ethiopic_dor; ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask disabled>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Educational Level</label>
                        <select class="form-control select2" name="edu_lev" id="edu_lev">
                          <option></option>
                          <option value="16">4</option>
                          <option value="1">5</option>
                          <option value="2">6</option>
                          <option value="4">8</option>
                          <option value="5">9</option>
                          <option value="6">10</option>
                          <option value="7">11</option>
                          <option value="8">12</option>
                          <option value="10">10+2</option>
                          <option value="11">Diploma</option>
                          <option value="12">Advanced Diploma</option>
                          <option value="13">Degree</option>
                          <option value="15">Phd</option>
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label class="text-info">Language</label>
                        <select class="form-control select2" name="lang" id="selectLang">
                          <option></option>
                          <option value="1">A/Oromo</option>
                          <option value="2">Amharic</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="text-info">Medical</label>
                        <input type="text" class="form-control" name="med" value="<?php echo htmlspecialchars($stud_fetch_id['med']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-info">Responsible Person</label>
                        <input type="text" class="form-control" name="rp" value="<?php echo htmlspecialchars($stud_fetch_id['res_pers']);?>">
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <input type="button" onclick="return studentDetail()" id="studDetailBtn" class="btn btn-primary" value="Update">
                      </div>

                    </div>

                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label class="text-success">Physician Name</label>
                        <input type="text" class="form-control" name="pn" value="<?php echo htmlspecialchars($stud_fetch_id['phy_name']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-success">Term and License Type</label>
                        <select class="form-control select2" name="term" style="text-transform: capitalize;" >
                          <option value="<?php echo $stud_fetch_id['term_lic'] ?>/<?php echo $stud_fetch_id['lt'] ?>"><?php echo $term_out['name'] ?> -- <?php echo $lice_out['name'] ?></option>
                          <?php 
                          $fetcher_active = $obj_fetch->fetchTerm("Open");
                          foreach ($fetcher_active as $key_1 ) {
                            ?>
                          <option  value="<?php echo htmlspecialchars($key_1['id']);?>/<?php echo htmlspecialchars($obj_fetch->fetchLicenseId($key_1['license_t'])['id']);?>" ><?php echo htmlspecialchars($key_1['name']." -- ".$obj_fetch->fetchLicenseId($key_1['license_t'])['name']);?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Blood Type</label>
                        <select class="form-control select2" name="bl_type" id="bl_type">
                          <option></option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                        </select>
                      </div>                  

                    </div>

                  </div>

                </div>
              </div>
            </form>
            <!-- Second Box -->
            <form name="Address">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Student Address:</h3>
                </div>
                <div class="box-body" id="recieveddataddress">
                  <div class="row" style="margin-top: 15px;">
                    <div class="col-md-4"> 
                      <div class="form-group">
                        <label>Nationality </label>
                        <input type="text" class="form-control" name="nat" value="<?php echo htmlspecialchars($stud_fetch_id_add['nationality']);?>" >
                      </div>

                      <div class="form-group">
                        <label>Region </label>
                        <select class="form-control select2" name="reg" id="selectReg">
                          <option></option>
                          <option value="1">Orormia</option>
                          <option value="2">Addis Ababa</option>
                          <option value="3">Afar</option>
                          <option value="4">Amhara</option>
                          <option value="5">Benishagul</option>
                          <option value="6">Dere Dawa</option>
                          <option value="7">Gambela</option>
                          <option value="8">Harari</option>
                          <option value="9">SNNP</option>
                          <option value="10">Somali</option>
                          <option value="11">Tigrai</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Zone</label>
                        <input type="text" class="form-control" name="zon" value="<?php echo htmlspecialchars($stud_fetch_id_add['zone']);?>">
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="text-info">Wereda</label>
                        <input type="text" class="form-control" name="wer" value="<?php echo htmlspecialchars($stud_fetch_id_add['woreda']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-info">Kebele</label>
                        <input type="text" class="form-control" name="keb" value="<?php echo htmlspecialchars($stud_fetch_id_add['kebele']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-info">House Number</label>
                        <input type="text" class="form-control" name="hn"value="<?php echo htmlspecialchars($stud_fetch_id_add['house_no']);?>">
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="text-success">Home Phone</label>
                        <input type="text" class="form-control" name="hp" data-inputmask='"mask": "999 999 9999"' data-mask value="<?php echo htmlspecialchars($stud_fetch_id_add['home_phone']);?>">
                      </div>

                      <div class="form-group">
                        <label class="text-success">Office Phone</label>
                        <input type="text" class="form-control" name="op" data-inputmask='"mask": "999 999 9999"'  value="<?php echo htmlspecialchars($stud_fetch_id_add['office_phone']);?>" data-mask>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Mobile Phone</label>
                        <input type="text" class="form-control" name="mp" data-inputmask='"mask": "99 9999 9999"' data-mask value="<?php echo htmlspecialchars($stud_fetch_id_add['phone']);?>">
                      </div>

                    </div>

                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label >Fax</label>
                        <input type="text" class="form-control" name="fax" data-inputmask='"mask": "999 999 9999"' data-mask value="<?php echo htmlspecialchars($stud_fetch_id_add['fax']);?>">
                      </div>

                      <div class="form-group">
                        <label >P.O. Box</label>
                        <input type="text" class="form-control" name="box" value="<?php echo htmlspecialchars($stud_fetch_id_add['pobox']);?>">
                      </div>

                      <div class="form-group">
                        <label >Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($stud_fetch_id_add['email']);?>">
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div style="margin-top: 35%; margin-left: 35%;">
                        <input type="button" onclick="return studentAddress()" id="studAddressBtn" class="btn btn-primary" value="Update">
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </form>

            <!-- Third Box-->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data" >
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Student Files:</h3>
                </div>
                <div class="box-body">
                  <div class="row" style="margin-top: 15px;">
                    <input type="text" name="updaterid" value="<?php echo $_GET['update']; ?>" hidden>
                    
                    <div class="col-md-4">

                      <div class="form-group">
                        <label >Id | Pasport </label>
                        <input type="file" name="pasport">
                      </div>

                      <div class="form-group">
                        <label >Medical </label>
                        <input type="file" name="med_file">
                      </div>

                    </div>

                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label >Education </label>
                        <input type="file" name="edu">
                      </div>

                      <div class="form-group">
                        <label >Transcript </label>
                        <input type="file" name="trans">
                      </div>

                    </div>

                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label >Photo </label>
                        <input type="file" name="photo">
                      </div>

                    </div>

                  </div>           

                  <div style="margin-top: 2%; margin-left: 15%;">
                    <input type="submit" name="upload_file" id="uploadChengerBtn" onclick="return uploadChenger()" class="btn btn-primary" value="Upload">
                  </div>
                </div>
              </div>
            </form>

          </div>     
        </div>
      <?php }?>
      <?php if(isset($_GET['view'])){
        $id_stud_up = $_GET['view'];
        $stud_fetch_id = $obj_fetch->fetchStudentId($id_stud_up)[0];
        $stud_fetch_id_add = $obj_fetch->fetchStudentAddId($id_stud_up)[0];

        $lice_out = $obj_fetch->fetchLicenseId($stud_fetch_id['lt']);
        $term_out = $obj_fetch->fetchTermId($stud_fetch_id['term_lic']);

        if ($stud_fetch_id['edu_lev'] == 16) {
           $edu_lev_out = 4;
        }elseif ($stud_fetch_id['edu_lev'] == 1) {
           $edu_lev_out = 5;
        }elseif ($stud_fetch_id['edu_lev'] == 2) {
           $edu_lev_out = 6;
        }elseif ($stud_fetch_id['edu_lev'] == 4) {
           $edu_lev_out = 8;
        }elseif ($stud_fetch_id['edu_lev'] == 5) {
           $edu_lev_out = 9;
        }elseif ($stud_fetch_id['edu_lev'] == 6) {
           $edu_lev_out = 10;
        }elseif ($stud_fetch_id['edu_lev'] == 7) {
           $edu_lev_out = 11;
        }elseif ($stud_fetch_id['edu_lev'] == 8) {
           $edu_lev_out = 12;
        }elseif ($stud_fetch_id['edu_lev'] == 10) {
           $edu_lev_out = '10+2';
        }elseif ($stud_fetch_id['edu_lev'] == 11) {
           $edu_lev_out = "Diploma";
        }elseif ($stud_fetch_id['edu_lev'] == 12) {
           $edu_lev_out = 'Advanced Diploma';
        }elseif ($stud_fetch_id['edu_lev'] == 13) {
           $edu_lev_out = 'Degree';
        }elseif ($stud_fetch_id['edu_lev'] == 15) {
           $edu_lev_out = 'Phd';
        }

        if($stud_fetch_id['gender'] == 1) {
          $gender_out = "Male";
        }elseif($stud_fetch_id['gender'] == 2) {
          $gender_out = "Female";
        }

        if($stud_fetch_id['lang'] == 1) {
          $lang_out = "A/Oromo";
        }elseif($stud_fetch_id['lang'] == 2) {
          $lang_out = "Amharic";
        }

        if ($stud_fetch_id_add['region'] == 1) {
          $region_out = "Orormia";
        }elseif ($stud_fetch_id_add['region'] == 2) {
          $region_out = "Addis Ababa";
        }elseif ($stud_fetch_id_add['region'] == 3) {
          $region_out = "Afar";
        }elseif ($stud_fetch_id_add['region'] == 4) {
          $region_out = "Amhara";
        }elseif ($stud_fetch_id_add['region'] == 5) {
          $region_out = "Benishagul";
        }elseif ($stud_fetch_id_add['region'] == 6) {
          $region_out = "Dere Dawa";
        }elseif ($stud_fetch_id_add['region'] == 7) {
          $region_out = "Gambela";
        }elseif ($stud_fetch_id_add['region'] == 8) {
          $region_out = "Harari";
        }elseif ($stud_fetch_id_add['region'] == 9) {
          $region_out = "SNNP";
        }elseif ($stud_fetch_id_add['region'] == 10) {
          $region_out = "Somali";
        }elseif ($stud_fetch_id_add['region'] == 11) {
          $region_out = "Tigrai";
        }
        ?>
        <div class="row">

          <div class="col-md-12">
            <div class="box box-info collapsed-box">
              <div class="box-header with-border">
                <h3 class="box-title">Student Detail:</h3>

                <div class="box-tools pull-right">
                  <a href="student.php?gen=0/0&trm=0/0&lt=0/0"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Back</button></a>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="col-md-4">
                      <label>Full Name [ English ]:</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['name'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['fname'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['gname'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Full Name [ Amharic ]:</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['name_amh'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['fname_amh'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['gname_amh'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Full Name [ A/Oromo ]:</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['name_or'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['fname_or'])); ?>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id['gname_or'])); ?>
                    </div>
                  </div>

                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-4">
                      <label>Gender:</label>
                      <?php echo $gender_out; ?>
                    </div>

                    <div class="col-md-4">
                      <label>Language:</label>
                      <?php echo $lang_out; ?>
                    </div>

                    <div class="col-md-4">
                      <label>Date of Birth:</label>
                      <?php echo $obj_converter->toEth($stud_fetch_id['dob']); ?>
                    </div>
                  </div>

                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-4">
                      <label>Date of Registration:</label>
                      <?php echo $obj_converter->toEth($stud_fetch_id['dor']); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Term :</label>
                      <?php echo htmlspecialchars(ucfirst($term_out['name']));  ?>
                    </div>

                    <div class="col-md-4">
                      <label>License Type:</label>
                      <?php echo htmlspecialchars(ucfirst($lice_out['name']));  ?>
                    </div>
                  </div>

                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-4">
                      <label>Blood Type:</label>
                      <?php echo htmlspecialchars(strtoupper($stud_fetch_id['blood'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Educational Level:</label>
                      <?php echo htmlspecialchars(ucfirst($edu_lev_out));  ?>
                    </div>

                    <div class="col-md-4">
                      <label>Student Id:</label>
                      <?php echo htmlspecialchars($stud_fetch_id['id']); ?>
                    </div>
                  </div>                  

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="box box-primary collapsed-box">
              <div class="box-header with-border">
                <h3 class="box-title">Student Adderss:</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="col-md-4">
                      <label>Nationality :</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id_add['nationality'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Region :</label>
                      <?php echo htmlspecialchars(ucfirst($region_out)); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Zone :</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id_add['zone'])); ?>
                    </div>
                  </div>

                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-4">
                      <label>Wereda :</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id_add['woreda'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Kebele :</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id_add['kebele'])); ?>
                    </div>

                    <div class="col-md-4">
                      <label>Mobile Phone:</label>
                      <?php echo htmlspecialchars(ucfirst($stud_fetch_id_add['phone'])); ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="box box-success collapsed-box">
              <div class="box-header with-border">
                <h3 class="box-title">Student File:</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                <?php
                $main_file_arr = $obj_fetch->fetchStudentFileId($_GET['view']); 
                ?>

                <div class="row">

                  <div class="col-md-4">
                    <div class="box box-info box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Photo :</h3>
                        <div class="pull-right">
                          <a href="download.php?type=Student&src=../files/photo/<?php echo $main_file_arr[0]['photo'] ; ?>&name=<?php echo "Photo_".htmlspecialchars(ucfirst($stud_fetch_id['name'])).".".explode(".", $main_file_arr[0]['photo'])[1];?>" target="_blank" >
                            <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                          </a>
                        </div>
                      </div>
                      <div class="box-body" id="photoBody">
                        <?php 
                          $photo_view = $main_file_arr[0]['photo'];
                          if($photo_view == ""){
                        ?>
                        <p class="text-danger">No Photo Available!</p>
                        <?php }else{ ?>
                          <center>
                           <img id="myImg_photo" class="myImg" src="../files/photo/<?php echo $photo_view ; ?>" alt="Photo" style="width:100%;max-width:300px ; height: 214px;">
                          </center>

                          <div id="myModal_photo" class="modal">
                            <span class="close">&times;</span>
                            <img  src="../files/photo/<?php echo $photo_view ; ?>"  class="modal-content" id="img01_photo">
                            <div id="caption_photo" class="caption"></div>
                          </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="box box-primary box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">ID / Pasport :</h3>
                        <div class="pull-right">
                          <a href="download.php?type=Student&src=../files/pasport/<?php echo $main_file_arr[0]['pasport'] ; ?>&name=<?php echo "ID_".htmlspecialchars(ucfirst($stud_fetch_id['name'])).".".explode(".", $main_file_arr[0]['pasport'])[1];?>" target="_blank" >
                            <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                          </a>
                        </div>
                      </div>
                      <div class="box-body">
                        <?php 
                          $pasport_view = $main_file_arr[0]['pasport'];
                          if($pasport_view == ""){
                        ?>
                        <p class="text-danger">No ID / Pasport Available!</p>
                        <?php }else{ ?>
                          <center>
                           <img id="myImg_id" class="myImg" src="../files/pasport/<?php echo $pasport_view ; ?>" alt="Id / Pasport" style="width:100%;max-width:300px; height: 214px;">
                          </center>

                          <div id="myModal_id" class="modal">
                            <span class="close">&times;</span>
                            <img  src="../files/pasport/<?php echo $pasport_view ; ?>"  class="modal-content" id="img01_id">
                            <div id="caption_id" class="caption"></div>
                          </div>
                        <?php }?>
                        
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="box box-success box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Medical File :</h3>
                        <div class="pull-right">
                          <a href="download.php?type=Student&src=../files/medical/<?php echo $main_file_arr[0]['med_file'] ; ?>&name=<?php echo "Med_".htmlspecialchars(ucfirst($stud_fetch_id['name'])).".".explode(".", $main_file_arr[0]['med_file'])[1];?>" target="_blank" >
                            <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                          </a>
                        </div>
                      </div>
                      <div class="box-body">
                        <?php 
                          $med_view = $main_file_arr[0]['med_file'];
                          if($med_view == ""){
                        ?>
                        <p class="text-danger">No Medical File Available!</p>
                        <?php }else{ ?>
                          <center>
                           <img id="myImg_med" class="myImg" src="../files/medical/<?php echo $med_view ; ?>" alt="Medical File" style="width:100%;max-width:300px; height: 214px;">
                          </center>

                          <div id="myModal_med" class="modal">
                            <span class="close">&times;</span>
                            <img  src="../files/medical/<?php echo $med_view ; ?>"  class="modal-content" id="img01_med">
                            <div id="caption_med" class="caption"></div>
                          </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-4">
                    <div class="box box-info box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Education File :</h3>
                        <div class="pull-right">
                          <a href="download.php?type=Student&src=../files/education/<?php echo $main_file_arr[0]['edu'] ; ?>&name=<?php echo "Edu_".htmlspecialchars(ucfirst($stud_fetch_id['name'])).".".explode(".", $main_file_arr[0]['edu'])[1];?>" target="_blank" >
                            <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                          </a>
                        </div>
                      </div>
                      <div class="box-body">
                        <?php 
                          $edu_view = $main_file_arr[0]['edu'];
                          if($edu_view == ""){
                        ?>
                        <p class="text-danger">No Education File Available!</p>
                        <?php }else{ ?>
                          <center>
                           <img id="myImg_edu" class="myImg" src="../files/education/<?php echo $edu_view ; ?>" alt="Education File" style="width:100%;max-width:300px; height: 214px;">
                          </center>

                          <div id="myModal_edu" class="modal">
                            <span class="close">&times;</span>
                            <img  src="../files/education/<?php echo $edu_view ; ?>"  class="modal-content" id="img01_edu">
                            <div id="caption_edu" class="caption"></div>
                          </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="box box-primary box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Transcript :</h3>
                        <div class="pull-right">
                          <a href="download.php?type=Student&src=../files/transcript/<?php echo $main_file_arr[0]['trans'] ; ?>&name=<?php echo "Trans_".htmlspecialchars(ucfirst($stud_fetch_id['name'])).".".explode(".", $main_file_arr[0]['trans'])[1];?>" target="_blank" >
                            <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                          </a>
                        </div>
                      </div>
                      <div class="box-body">
                        <?php 
                          $trans_view = $main_file_arr[0]['trans'];
                          if($trans_view == ""){
                        ?>
                        <p class="text-danger">No Transcript Available!</p>
                        <?php }else{ ?>
                          <center>
                           <img id="myImg_trans" class="myImg" src="../files/transcript/<?php echo $trans_view ; ?>" alt="Transcript" style="width:100%;max-width:300px; height: 214px;">
                          </center>

                          <div id="myModal_trans" class="modal">
                            <span class="close">&times;</span>
                            <img  src="../files/transcript/<?php echo $trans_view ; ?>"  class="modal-content" id="img01_trans">
                            <div id="caption_trans" class="caption"></div>
                          </div>
                        <?php }?>
                        
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php }?>
      <?php }else{ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Updated Student Detail:</h3>
              </div>
              <div class="box-body">
                <div class="row" style="margin-top: 25px;">

                  <div class="col-md-12">
                    <div class="alert alert-success">
                      <center>
                        <span class="fa fa-check-circle"></span>
                        Seccessfuly Updated!
                      </center>
                    </div>
                    <hr>
                  </div>

                  <div class="col-md-6">

                    <label class="col-sm-3 control-label">Full Name :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($row_stud['name']); ?>    <?php echo htmlspecialchars($row_stud['fname']); ?>   <?php echo htmlspecialchars($row_stud['gname']); ?></p>

                    <label class="col-sm-3 control-label">ID Number :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($id_show); ?></p>

                    <label class="col-sm-3 control-label">License Type :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show); ?></p>

                    <label class="col-sm-3 control-label">Term :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($term_show); ?></p>

                    <label class="col-sm-4 control-label">Traning Start Date :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($obj_converter->toEth($tsd_show)); ?></p>

                  </div>

                  <div class="col-md-6">

                    <label class="col-sm-3 control-label">Gender :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($gen_show); ?></p>

                    <label class="col-sm-3 control-label">Region :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($reg_show); ?></p>

                    <label class="col-sm-3 control-label">Zone :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($zon_show); ?></p>

                    <label class="col-sm-3 control-label">Language :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($lang_show); ?></p>

                    <label class="col-sm-4 control-label">Traning End Date :</label>
                      <p style="text-transform: capitalize;"><?php echo htmlspecialchars($obj_converter->toEth($ted_show)); ?></p>

                  </div>

                  <div class="col-md-12">
                    <hr>
                    <center>
                      <a href="student.php?gen=0/0&trm=0/0&lt=0/0">
                       <button type="button" class="btn btn-success" >Ok</button>
                     </a>
                    </center>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </section>
  </div>

  <?php include 'includes/js.inc.php';?>
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- local -->
  <script src="../assets/photo.js"></script>
  		<!-- page script -->
	<script>
	  $(function () {
	    $('#table_stud').DataTable()
      $('.select2').select2()
      $('[data-mask]').inputmask()
	  })
  </script>
  <script>
    function selecter(gen,term,lise){
      document.getElementById("selectGen").selectedIndex = gen;
      document.getElementById("selectTrm").selectedIndex = term;
      document.getElementById("selectLt").selectedIndex = lise;
    }

    if (<?php echo  $select_cons;?> === 0) {
      selecter(<?php if(isset($selection_ind_gen)) {echo $selection_ind_gen;}else{echo '0';};?>,<?php if(isset($selection_ind_trm)) {echo $selection_ind_trm;}else{echo '0';};?>,<?php if(isset($selection_ind_lt)) {echo $selection_ind_lt;}else{echo '0';};?>)
    }

    function selectorUp(upgen,lang,reg,bl,edu){
      document.getElementById("selectGenUp").selectedIndex = upgen;
      document.getElementById("selectLang").selectedIndex = lang;
      document.getElementById("selectReg").selectedIndex = reg;
      document.getElementById("bl_type").selectedIndex = bl;
      document.getElementById("edu_lev").selectedIndex = edu;
    } 

    if (<?php echo  $select_cons_up;?> === 1) {
      selectorUp(<?php if(isset($stud_fetch_id['gender'])){echo $stud_fetch_id['gender'];}else{echo '0';}?>,<?php if(isset($stud_fetch_id['lang'])){echo $stud_fetch_id['lang'];}else{echo '0';}?>,<?php if(isset($stud_fetch_id_add['region'])){echo $stud_fetch_id_add['region'];}else{echo '0';}?>,<?php if(isset($select_bl_type)){echo $select_bl_type;}else{echo '0';}?>,<?php if(isset($select_edu_lev)){echo $select_edu_lev;}else{echo '0';}?>)
    }
  </script>
  <script>
    function filterChangeFun() {
      document.getElementById("filteBtn").value="Filtering ..... ";
    }

    function studentDetail(){
      $(document).ready(function(){
        document.getElementById("studDetailBtn").value="Updating ..... ";
        $.post("../oop/updater.oop.php",
          {
            type:'sdeatil',
            stud_id:  document.getElementById("stud_id").textContent,
            name_eng:  document.forms["Detail"]["name_eng"].value,
            fname_eng:  document.forms["Detail"]["fname_eng"].value,
            gname_eng:  document.forms["Detail"]["gname_eng"].value,
            name_or:  document.forms["Detail"]["name_or"].value,
            fname_or:  document.forms["Detail"]["fname_or"].value,
            gname_or:  document.forms["Detail"]["gname_or"].value,
            name_amh:  document.forms["Detail"]["name_amh"].value,
            fname_amh:  document.forms["Detail"]["fname_amh"].value,
            gname_amh:  document.forms["Detail"]["gname_amh"].value,
            gender:  document.forms["Detail"]["gender"].value,
            dob:  document.forms["Detail"]["dob"].value,
            dor:  document.forms["Detail"]["dor"].value,
            lang:  document.forms["Detail"]["lang"].value,
            med:  document.forms["Detail"]["med"].value,
            rp:  document.forms["Detail"]["rp"].value,
            pn:  document.forms["Detail"]["pn"].value,
            trm:  document.forms["Detail"]["term"].value,
            bl_type:  document.forms["Detail"]["bl_type"].value,
            edu_lev:  document.forms["Detail"]["edu_lev"].value     
          },
          function(data){
            $('#recieveddatadetail').html(data);
          });

    })

    }
    function uploadChenger() {
      document.getElementById("uploadChengerBtn").value="Uploading ..... ";
    }

    function funOfPhoto(){
        $.post("download.php",
          {
            type:'Student',
            file: "../files/photo/<?php if(isset($photo_view)){echo $photo_view ; }?>" 
          });
    }

    function studentAddress(){
      $(document).ready(function(){
        document.getElementById("studAddressBtn").value="Updating ..... ";
        $.post("../oop/updater.oop.php",
          {
            type:'saddress',
            stud_id:  document.getElementById("stud_id").textContent,
            nat:  document.forms["Address"]["nat"].value,
            reg:  document.forms["Address"]["reg"].value,
            zon:  document.forms["Address"]["zon"].value,
            wer:  document.forms["Address"]["wer"].value,
            keb:  document.forms["Address"]["keb"].value,
            hn:  document.forms["Address"]["hn"].value,
            hp:  document.forms["Address"]["hp"].value,
            op:  document.forms["Address"]["op"].value,
            mp:  document.forms["Address"]["mp"].value,
            fax:  document.forms["Address"]["fax"].value,
            box:  document.forms["Address"]["box"].value,
            email:  document.forms["Address"]["email"].value      
          },
          function(data){
            $('#recieveddataddress').html(data);
          });

    })

    }
	</script>
</body>
</html>