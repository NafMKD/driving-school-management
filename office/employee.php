<?php
session_start();
$title = "Employee";
$emp = "active";
$emp_li = "active";
include 'autoloader.php';
$obj_converter = new converter;
$obj_fetch = new Fetch;
?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/css.inc.php';?>
</head>
<body class="hold-transition skin-blue ">
	<?php include 'includes/main.inc.php';?>

<style type="text/css">
  input {
    text-transform: capitalize;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employee
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Employee</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>All Employee's</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="employee.php?all" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>150</h3>

              <p>Constant Employee's</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="employee.php?cons" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>150</h3>

              <p>Contrat Employee's</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="employee.php?cont" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <?php if(isset($_GET['all']) || isset($_GET['cons']) || isset($_GET['cont'])){ ?>
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List of Employee:</h3>
              </div>
              <div class="box-body">
                <table id="table_stud" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10">No</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>State</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(isset($_GET['all'])){
                      $arr_rec = $obj_fetch->fetchEmployee("All");
                      $cnt = 1;
                      foreach ($arr_rec as $key ) { 
                        if($key['gender'] == 1){
                          $gen_out = "Male";
                        }elseif($key['gender'] == 2){
                          $gen_out = "Female";
                        }

                        if($key['e_type'] == 1){
                          $e_type_out = "Teacher"; 
                        }elseif($key['e_type'] == 2){
                          $e_type_out = "Office"; 
                        }elseif($key['e_type'] == 3){
                          $e_type_out = "Director"; 
                        }elseif($key['e_type'] == 4){
                          $e_type_out = "Security"; 
                        }elseif($key['e_type'] == 5){
                          $e_type_out = "Cleaning"; 
                        }

                        if($key['e_state'] == 1){
                          $e_state_out = "Constant";
                        }elseif($key['e_state'] == 2){
                          $e_state_out = "Contrat";
                        }
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($cnt); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($key['name'])); ?> <?php echo htmlspecialchars(ucfirst($key['fname'])); ?> <?php echo htmlspecialchars(ucfirst($key['gname'])); ?></td>
                        <td><?php echo htmlspecialchars($gen_out); ?></td>
                        <td><?php echo htmlspecialchars($e_type_out); ?></td>
                        <td><?php echo htmlspecialchars($e_state_out); ?></td>
                        <td>
                          <a href="employee.php?edit=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
                          </a>
                          <a href="employee.php?view=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                          </a>
                        </td>
                      </tr>
                    <?php $cnt = $cnt +1;}}?>

                    <?php 
                      if(isset($_GET['cons'])){
                      $arr_rec = $obj_fetch->fetchEmployee("Constant");
                      $cnt = 1;
                      foreach ($arr_rec as $key ) { 
                        if($key['gender'] == 1){
                          $gen_out = "Male";
                        }elseif($key['gender'] == 2){
                          $gen_out = "Female";
                        }

                        if($key['e_type'] == 1){
                          $e_type_out = "Teacher"; 
                        }elseif($key['e_type'] == 2){
                          $e_type_out = "Office"; 
                        }elseif($key['e_type'] == 3){
                          $e_type_out = "Director"; 
                        }elseif($key['e_type'] == 4){
                          $e_type_out = "Security"; 
                        }elseif($key['e_type'] == 5){
                          $e_type_out = "Cleaning"; 
                        }

                        if($key['e_state'] == 1){
                          $e_state_out = "Constant";
                        }elseif($key['e_state'] == 2){
                          $e_state_out = "Contrat";
                        }
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($cnt); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($key['name'])); ?> <?php echo htmlspecialchars(ucfirst($key['fname'])); ?> <?php echo htmlspecialchars(ucfirst($key['gname'])); ?></td>
                        <td><?php echo htmlspecialchars($gen_out); ?></td>
                        <td><?php echo htmlspecialchars($e_type_out); ?></td>
                        <td><?php echo htmlspecialchars($e_state_out); ?></td>
                        <td>
                          <a href="employee.php?edit=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
                          </a>
                          <a href="employee.php?view=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                          </a>
                        </td>
                      </tr>
                    <?php $cnt = $cnt +1;}}?>

                    <?php 
                      if(isset($_GET['cont'])){
                      $arr_rec = $obj_fetch->fetchEmployee("Contrat");
                      $cnt = 1;
                      foreach ($arr_rec as $key ) { 
                        if($key['gender'] == 1){
                          $gen_out = "Male";
                        }elseif($key['gender'] == 2){
                          $gen_out = "Female";
                        }

                        if($key['e_type'] == 1){
                          $e_type_out = "Teacher"; 
                        }elseif($key['e_type'] == 2){
                          $e_type_out = "Office"; 
                        }elseif($key['e_type'] == 3){
                          $e_type_out = "Director"; 
                        }elseif($key['e_type'] == 4){
                          $e_type_out = "Security"; 
                        }elseif($key['e_type'] == 5){
                          $e_type_out = "Cleaning"; 
                        }

                        if($key['e_state'] == 1){
                          $e_state_out = "Constant";
                        }elseif($key['e_state'] == 2){
                          $e_state_out = "Contrat";
                        }
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($cnt); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($key['name'])); ?> <?php echo htmlspecialchars(ucfirst($key['fname'])); ?> <?php echo htmlspecialchars(ucfirst($key['gname'])); ?></td>
                        <td><?php echo htmlspecialchars($gen_out); ?></td>
                        <td><?php echo htmlspecialchars($e_type_out); ?></td>
                        <td><?php echo htmlspecialchars($e_state_out); ?></td>
                        <td>
                          <a href="employee.php?edit=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
                          </a>
                          <a href="employee.php?view=<?php echo htmlspecialchars($key['id']); ?>">
                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                          </a>
                        </td>
                      </tr>
                    <?php $cnt = $cnt +1;}}?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php }?>

        <?php if(isset($_GET['edit'])){
          $arr_rec_ind = $obj_fetch->fetchEmployeeId($_GET['edit']);

          if($arr_rec_ind['edu_lev'] == '10'){
            $e_lev = 1; 
          }elseif($arr_rec_ind['edu_lev'] == '11'){
            $e_lev = 2; 
          }elseif($arr_rec_ind['edu_lev'] == '12'){
            $e_lev = 3; 
          }elseif($arr_rec_ind['edu_lev'] == '10+1'){
            $e_lev = 4; 
          }elseif($arr_rec_ind['edu_lev'] == '10+2'){
            $e_lev = 5; 
          }elseif($arr_rec_ind['edu_lev'] == 'Diploma'){
            $e_lev = 6; 
          }
          elseif($arr_rec_ind['edu_lev'] == 'Advanced Diploma'){
            $e_lev = 7; 
          }
          elseif($arr_rec_ind['edu_lev'] == 'Degree'){
            $e_lev = 8; 
          }
          elseif($arr_rec_ind['edu_lev'] == 'Masters'){
            $e_lev = 9; 
          }
          elseif($arr_rec_ind['edu_lev'] == 'Phd'){
            $e_lev = 10; 
          }

        ?>
          <div class="col-md-12">
            <form name="Detail">
              <div class="box box-primary">

                <div class="box-header">
                  <h3 class="box-title">Employee Detail:</h3>
                  <div class="pull-right">
                    <a href="employee.php?all" class="btn btn-info btn-sm">
                      <i class="fa fa-arrow-left"></i> Back
                    </a>
                  </div>
                </div>

                <div class="box-body" id="recieveddatadetail">

                  <div class="row" style="margin-top: 15px;">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Name </label>
                        <input type="text" value="<?php echo $arr_rec_ind['name']; ?>" class="form-control" name="name">
                      </div>

                      <div class="form-group">
                        <label>Father Name </label>
                        <input type="text" value="<?php echo $arr_rec_ind['fname']; ?>" class="form-control" name="fname">
                      </div>

                      <div class="form-group">
                        <label>Grand Father Name </label>
                        <input type="text" value="<?php echo $arr_rec_ind['gname']; ?>" class="form-control" name="gname">
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="text-info">Gender</label>
                        <select class="form-control select2" name="gender" id="gender">
                          <option></option>
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="text-info">Phone </label>
                        <input type="text" class="form-control" value="<?php echo $arr_rec_ind['phone']; ?>" name="phone" data-inputmask='"mask": "99 9999 9999"' data-mask>
                      </div>

                      <div class="form-group">
                        <label class="text-info">Date of Registration</label>
                        <input type="text" class="form-control" value="<?php echo $obj_converter->toEth($arr_rec_ind['dor']); ?>" name="dor" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask readonly>
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <button type="button" id="buttonDetail" onclick="return employeeUpdate()" class="btn btn-primary">
                          Update 
                        </button>
                        <button type="button" id="buttonUpload" onclick="return employeeUploadFile()" class="btn btn-info">
                          UploadFile 
                        </button>
                      </div>

                    </div>

                    <div class="col-md-4">
                        
                        <div class="form-group">
                        <label class="text-success">Educational Level</label>
                        <select class="form-control select2" name="edu_lev" id="edu_lev">
                          <option></option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="10+1">10+1</option>                      
                          <option value="10+2">10+2</option>
                          <option value="Diploma">Diploma</option>
                          <option value="Advanced Diploma">Advanced Diploma</option>
                          <option value="Degree">Degree</option>
                          <option value="Masters">Masters</option>
                          <option value="Phd">Phd</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Employee Type</label>
                        <select class="form-control select2" name="e_type" id="e_type">
                          <option></option>
                          <option value="1">Teacher</option>
                          <option value="2">Office</option>
                          <option value="3">Director</option>
                          <option value="4">Security</option>
                          <option value="5">Cleaning</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="text-success">Employee State</label>
                        <select id="selectBox" onchange="return changeFunc()" class="form-control select2" name="e_state" >
                          <option></option>
                          <option value="1">Constant</option>
                          <option value="2">Contrat</option>
                        </select>
                      </div>

                    </div>

                  </div>

                </div>
              </div>
            </form>
          </div>
        <?php }?>
      </div>
    </section>
  </div>

  <!-- modal second -->
    <div class="modal fade" id="modal-send">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Date Interval</h4>
          </div>
            <form name="second_form">
              <div class="modal-body">
               <div class="row" id="reciveFromIndModal">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label>From :</label>
                     <input type="text" class="form-control"  <?php if(isset($arr_rec_ind)){if($arr_rec_ind['fr_date']!="0"){echo "value = '".$obj_converter->toEth($arr_rec_ind['fr_date'])."'";}} ?> id="fr_date" name="fr_date"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                   </div>

                   <div class="form-group">
                     <label>To :</label>
                     <input type="text" class="form-control" <?php if(isset($arr_rec_ind)){if($arr_rec_ind['to_date']!="0"){echo "value = '".$obj_converter->toEth($arr_rec_ind['to_date'])."'";}} ?> name="to_date" id="to_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                   </div>

                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
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
  <script>
    $(function () {
      $('#table_stud').DataTable()
      $('[data-mask]').inputmask()
      $('.select2').select2()
    })
    function changeFunc() {
      var selectBox = document.getElementById("selectBox");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue === '2'){
        $('#modal-send').modal('show');
        }
    }
    function employeeUploadFile() {
      document.getElementById("buttonUpload").innerHTML="Updloading <i class='fa fa-refresh fa-spin'></i>";
      var data = <?php if(isset($_GET['edit'])){ echo $_GET['edit'];}else{echo "0";} ?>;
      window.open('uploadempfile.php?id='+data, '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
    }
  </script>
  <?php if(isset($_GET['edit'])){?>
  <script>
    function selecter(gen,ed,et,es){
      document.getElementById("gender").selectedIndex = gen;
      document.getElementById("edu_lev").selectedIndex = ed;
      document.getElementById("e_type").selectedIndex = et;
      document.getElementById("selectBox").selectedIndex = es;
    }
    selecter(<?php if(isset($arr_rec_ind['gender'])) {echo $arr_rec_ind['gender'];}else{echo '0';};?>,<?php if(isset($e_lev)) {echo $e_lev;}else{echo '0';};?>,<?php if(isset($arr_rec_ind['e_type'])) {echo $arr_rec_ind['e_type'];}else{echo '0';};?>,<?php if(isset($arr_rec_ind['e_state'])) {echo $arr_rec_ind['e_state'];}else{echo '0';};?>)
  </script>
<?php }?>
  <script>
    function employeeUpdate() {
      $(document).ready(function(){
        document.getElementById("buttonDetail").innerHTML="Updating <i class='fa fa-refresh fa-spin'></i>";
        $.post("../oop/register.oop.php",
        {
          type:"employeeUpdate",
          emp_id: <?php if(isset($_GET['edit'])){ echo $_GET['edit'];}else{echo "0";} ?>,
          name : document.forms["Detail"]["name"].value,
          fname : document.forms["Detail"]["fname"].value,
          gname : document.forms["Detail"]["gname"].value,
          gender : document.forms["Detail"]["gender"].value,
          phone : document.forms["Detail"]["phone"].value,
          dor : document.forms["Detail"]["dor"].value,
          edu_lev : document.forms["Detail"]["edu_lev"].value,
          e_type : document.forms["Detail"]["e_type"].value,
          e_state : document.forms["Detail"]["e_state"].value,
          fr_date : document.forms["second_form"]["fr_date"].value,
          to_date : document.forms["second_form"]["to_date"].value,
          editor:  <?php echo $_SESSION['id'];?> 
        },
        function(data){
          $('#recieveddatadetail').html(data);
        });
      });
    }
  </script>
</body>
</html>