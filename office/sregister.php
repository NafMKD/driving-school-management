<?php
session_start();
include 'autoloader.php';
$title = "Student Registrar";
$stud = "active";
$sreg = "active";
$ids=$_SESSION['id'];
$obj = new register;
$obj_fetch = new Fetch;
$obj_converter = new converter;
if(isset($_POST['upload_file'])){
  
  if (!empty($_FILES['pasport']['name'])) {
   $obj->upload('pasport', 'pasport', $_SESSION['id']);
  }

  if (!empty($_FILES['med_file']['name'])) {
   $obj->upload('med_file', 'medical', $_SESSION['id']);
  }

  if (!empty($_FILES['edu']['name'])) {
   $obj->upload('edu', 'education', $_SESSION['id']);
  }

  if (!empty($_FILES['trans']['name'])) {
   $obj->upload('trans', 'transcript', $_SESSION['id']);
  }

  if (!empty($_FILES['photo']['name'])) {
   $obj->upload('photo', 'photo', $_SESSION['id']);
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
</head>
<body class="hold-transition skin-blue ">
	<?php include 'includes/main.inc.php';?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Registrar
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-pencil-square"></i> Registrar</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
<?php if(!isset($final_msg)){ ?>
        <div class="col-md-12">

          <!-- First Box -->
          <form name="Detail">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Student Detail:</h3>
              </div>
              <div class="box-body" id="recieveddatadetail">
                <div class="row" style="margin-top: 15px;">
                  <div class="col-md-4">
                      <!-- English-->
                    <div class="form-group">
                      <label>Name | English |</label>
                      <input type="text" class="form-control" name="name_eng">
                    </div>

                    <div class="form-group">
                      <label>Father Name | English |</label>
                      <input type="text" class="form-control" name="fname_eng">
                    </div>

                    <div class="form-group">
                      <label>Grand Father Name | English |</label>
                      <input type="text" class="form-control" name="gname_eng">
                    </div>

                  </div>

                  <div class="col-md-4">
                      <!-- A/Oromo-->
                    <div class="form-group">
                      <label class="text-info">Name | A/Oromo |</label>
                      <input type="text" class="form-control" name="name_or">
                    </div>

                    <div class="form-group">
                      <label class="text-info">Father Name | A/Oromo |</label>
                      <input type="text" class="form-control" name="fname_or">
                    </div>

                    <div class="form-group">
                      <label class="text-info">Grand Father Name | A/Oromo |</label>
                      <input type="text" class="form-control" name="gname_or">
                    </div>

                  </div>

                  <div class="col-md-4">
                      <!-- Amharic-->
                    <div class="form-group">
                      <label class="text-success">Name | Amharic |</label>
                      <input type="text" class="form-control" name="name_amh">
                    </div>

                    <div class="form-group">
                      <label class="text-success">Father Name | Amharic |</label>
                      <input type="text" class="form-control" name="fname_amh">
                    </div>

                    <div class="form-group">
                      <label class="text-success">Grand Father Name | Amharic |</label>
                      <input type="text" class="form-control" name="gname_amh">
                    </div>

                  </div>

                </div>
                  <hr>
                <div class="row">
                  <div class="col-md-4">
                    
                    <div class="form-group">
                      <label >Gender</label>
                      <select class="form-control select2" name="gender">
                        <option></option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label >Date of Birth</label>
                      <input type="text" class="form-control" name="dob" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div class="form-group">
                      <label >Date of Registration</label>
                      <input type="text" class="form-control" value="<?php echo $obj_converter->Now(); ?>" name="dor" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Educational Level</label>
                      <select class="form-control select2" name="edu_lev">
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
                      <select class="form-control select2" name="lang">
                        <option></option>
                        <option value="2">Amharic</option>
                        <option value="1">A/Oromo</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-info">Medical</label>
                      <input type="text" class="form-control" name="med">
                    </div>

                    <div class="form-group">
                      <label class="text-info">Responsible Person</label>
                      <input type="text" class="form-control" name="rp">
                    </div>

                    <div style="margin-top: 13%; margin-left: 30%;">
                      <input type="button" id="buttonDetail" onclick="return studentDetail()" value="Submit" class="btn btn-primary">
                    </div>

                  </div>

                  <div class="col-md-4">
                    
                    <div class="form-group">
                      <label class="text-success">Physician Name</label>
                      <input type="text" class="form-control" name="pn">
                    </div>

                    <div class="form-group">
                      <label class="text-success">Term and License Type</label>
                      <select class="form-control select2" name="term" style="text-transform: capitalize;">
                        <option></option>
                        <?php 
                        $fetcher_active = $obj_fetch->fetchTerm("Open");
                        foreach ($fetcher_active as $key_1 ) {
                          ?>
                        <option value="<?php echo htmlspecialchars($key_1['id']);?>/<?php echo htmlspecialchars($obj_fetch->fetchLicenseId($key_1['license_t'])['id']);?>" ><?php echo htmlspecialchars($key_1['name']." -- ".$obj_fetch->fetchLicenseId($key_1['license_t'])['name']);?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Blood Type</label>
                      <select class="form-control select2" name="bl_type">
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
                      <input type="text" class="form-control" value="Ethiopian" name="nat">
                    </div>

                    <div class="form-group">
                      <label>Region </label>
                      <select class="form-control select2" name="reg">
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
                      <input type="text" class="form-control" name="zon">
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label class="text-info">Wereda</label>
                      <input type="text" class="form-control" name="wer">
                    </div>

                    <div class="form-group">
                      <label class="text-info">Kebele</label>
                      <input type="text" class="form-control" name="keb">
                    </div>

                    <div class="form-group">
                      <label class="text-info">House Number</label>
                      <input type="text" class="form-control" name="hn">
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label class="text-success">Home Phone</label>
                      <input type="text" class="form-control" name="hp" data-inputmask='"mask": "999 999 9999"' data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Office Phone</label>
                      <input type="text" class="form-control" name="op" data-inputmask='"mask": "999 999 9999"' data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Mobile Phone</label>
                      <input type="text" class="form-control" name="mp" data-inputmask='"mask": "99 9999 9999"' data-mask>
                    </div>

                  </div>

                </div>
                  <hr>
                <div class="row">
                  <div class="col-md-4">
                    
                    <div class="form-group">
                      <label >Fax</label>
                      <input type="text" class="form-control" name="fax" data-inputmask='"mask": "999 999 9999"' data-mask>
                    </div>

                    <div class="form-group">
                      <label >P.O. Box</label>
                      <input type="text" class="form-control" name="box" >
                    </div>

                    <div class="form-group">
                      <label >Email</label>
                      <input type="email" class="form-control" name="email" >
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div style="margin-top: 35%; margin-left: 35%;">
                      <input type="button" id="buttonAddress" onclick="return studentAddress()" value="Submit" class="btn btn-primary">
                    </div>

                  </div>

                </div>
              </div>
              <div class="overlay" id="addressDiv">
                <i class="fa fa-refresh fa-spin"></i>
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
                      <label>Take Photo:</label><br>
                      <button type="button" class="btn btn-info" onclick="return capturePhoto()" value="Photo" name="photo">
                        <i class="fa fa-file-image-o"></i> Pohoto
                      </button>
                    </div>

                  </div>

                </div>           

                <div style="margin-top: 2%; margin-left: 15%;">
                  <input type="submit" id="uplodBtn" onclick="return changeUploadBtn()" name="upload_file" class="btn btn-primary" value="Upload">
                </div>
              </div>
              <div class="overlay" id="uploadDiv">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
          </form>

        </div>
<?php }else{ ?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Registerd Student Detail:</h3>
            </div>
            <div class="box-body">
              <div class="row" style="margin-top: 25px;">

                <div class="col-md-12">
                  <div class="alert alert-success">
                    <center>
                      <span class="fa fa-check-circle"></span>
                      Seccessfuly Registerd, Please Reload To Continue!.
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
                    <a href="sregister.php">
                     <button type="button" class="btn btn-success" >Reload</button>
                   </a>
                  </center>

                </div>

              </div>
            </div>
          </div>
        </div>
<?php } ?>

      </div>
    </section>
  </div>


  <?php include 'includes/js.inc.php';?>
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script> 
    $(function () {
      $('[data-mask]').inputmask()
      $('.select2').select2()
    })
    function studentDetail(){
      document.getElementById("buttonDetail").value="Submiting ..... ";
        $(document).ready(function(){
          $.post("../oop/register.oop.php",
            {
              type:'sdeatil',
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
              edu_lev:  document.forms["Detail"]["edu_lev"].value,
              editor:  <?php echo $_SESSION['id'];?>      
            },
            function(data){
              $('#recieveddatadetail').html(data);
              $("#addressDiv").remove();
            });

      })

    }

    function studentAddress(){
        document.getElementById("buttonAddress").value="Submiting .....";
        $(document).ready(function(){

          $.post("../oop/register.oop.php",
            {
              type:'saddress',
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
              email:  document.forms["Address"]["email"].value,
              editor:  <?php echo $_SESSION['id'];?>        
            },
            function(data){
              $('#recieveddataddress').html(data);
              $("#uploadDiv").remove();
            });

      })

    }

    function changeUploadBtn(){
      document.getElementById("uplodBtn").value="Uploading ..... ";
    }

    function capturePhoto() {
      var data = document.getElementById('regStudRetId').innerHTML
      window.open('capturePicture.php?stud=yes&id='+data+'&id_2=<?php echo $_SESSION['id']; ?>', '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
    }
  </script>
</body>
</html>