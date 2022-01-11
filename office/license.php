<?php
session_start();
$title = "License";
$cors = "active";
include 'autoloader.php';
$obj_fetch = new Fetch;
$obj_converter = new converter;
$obj_register = new register;
$select_cons_up = 1;
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
        License Types
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> License Types</a></li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12" style="margin-top: 10px;">
          <div class="box box-primary" >
            <div class="box-header" style="margin-top: 5px;">
              <h3 class="box-title">List Of License Types</h3>
            </div>
            <hr>
            <div class="box-body">
              <?php if(!isset($_GET['id']) && !isset($_GET['delete']) && !isset($_GET['view'])){?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Reg_form">
                  <div class="row" id="recieveddata">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>License Name</label>
                        <input type="text" class="form-control" style="text-transform: capitalize;" name="ls_name">
                      </div>

                      <div class="form-group">
                        <label>Code of License</label>
                        <input type="text" class="form-control" name="cod">
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="stat">
                          <option></option>
                          <option value="1">Active </option>
                          <option value="0">Deactive</option>
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amo">
                      </div>

                      <div class="form-group">
                        <label>License Catagory</label>
                        <select class="form-control select2" name="lice_cat">
                          <option></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="11">11</option>
                        </select>
                      </div>

                      <div style="margin-top: 18%; margin-left: 30%;">
                        <input type="button" value="Add" id="addBtn" onclick="return registerLice()" class="btn btn-primary">
                      </div>
                    </div>
                  </div>                 
                </form>
              <?php }elseif(isset($_GET['id']) && !isset($_GET['delete']) && !isset($_GET['view'])){
                $array_of_nam = $obj_fetch->fetchLicenseId($_GET['id']);

                if ($array_of_nam['stat'] == 1) {
                  $indexstat = 1;
                }elseif ($array_of_nam['stat'] == 0) {
                  $indexstat = 2;
                }

                if ($array_of_nam['cat'] == 1) {
                   $select_edu_lev = 1;
                }elseif ($array_of_nam['cat'] == 2) {
                   $select_edu_lev = 2;
                }elseif ($array_of_nam['cat'] == 3) {
                   $select_edu_lev = 3;
                }elseif ($array_of_nam['cat'] == 5) {
                   $select_edu_lev = 4;
                }elseif ($array_of_nam['cat'] == 6) {
                   $select_edu_lev = 5;
                }elseif ($array_of_nam['cat'] == 7) {
                   $select_edu_lev = 6;
                }elseif ($array_of_nam['cat'] == 8) {
                   $select_edu_lev = 7;
                }elseif ($array_of_nam['cat'] == 9) {
                   $select_edu_lev = 8;
                }elseif ($array_of_nam['cat'] == 11) {
                   $select_edu_lev = 9;
                }

                ?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Upd_form">
                  <div class="row" id="recieveddataUp">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <input type="text" name="hiden_id" value="<?php echo $_GET['id']; ?>" hidden>
                      <div class="form-group">
                        <label>License Name:</label>
                        <input style="text-transform: capitalize;" type="text" class="form-control" name="lice_name_edit" value="<?php echo htmlspecialchars($array_of_nam['name']);?>">
                      </div>

                      <div class="form-group">
                        <label>Code of License</label>
                        <input type="text" style="text-transform: capitalize;" value="<?php echo htmlspecialchars($array_of_nam['code']) ?>" class="form-control" name="cod_edit">
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control select2" name="stat_edit" id="stat_edit">
                          <option></option>
                          <option value="1">Active </option>
                          <option value="0">Deactive</option>
                        </select>
                      </div>

                    </div>
                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" value="<?php echo htmlspecialchars($array_of_nam['amount']) ?>" class="form-control" name="amo_edit">
                      </div>

                      <div class="form-group">
                        <label>License Catagory</label>
                        <select class="form-control select2" name="lice_cat_edit" id="lice_cat_edit">
                          <option></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="11">11</option>
                        </select>
                      </div>

                      <div style="margin-top: 10%; margin-left: 25%;">
                        <input type="button" id="updateBtn" value="Update" onclick="return updateLice()" class="btn btn-primary">
                      </div>

                    </div>
                  </div>                 
                </form>
              <?php }elseif(!isset($_GET['id']) && isset($_GET['delete']) && !isset($_GET['view'])){
                  $obj_register->deleteLice($_GET['delete']);
                ?>
                <div class="row">
                  <div class='col-md-2'></div>
                  <div class='col-md-8'>
                    <div class='alert alert-success'>
                      <center>
                              <h4><i class='icon fa fa-check'></i> Alert!</h4>
                              Seccussfuly Deleted, Please Reload!
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
                </div>
              <?php }elseif(!isset($_GET['id']) && !isset($_GET['delete']) && isset($_GET['view'])){
                  $arr_view = $obj_fetch->fetchLicenseId($_GET['view']);

                  if($arr_view['stat'] == 0){
                    $stat_view_out = "Deactivated";
                  }elseif($arr_view['stat'] == 1){
                    $stat_view_out = "Activated";
                  }
                ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-4">
                        <label>License ID :</label>
                        <?php echo htmlspecialchars($arr_view['id']); ?>
                      </div>
                      <div class="col-md-4">
                        <label> License Name :</label>
                        <?php echo htmlspecialchars(ucfirst($arr_view['name'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label>Status :</label>
                        <?php echo htmlspecialchars($stat_view_out); ?>
                      </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                      <div class="col-md-4">
                        <label>License Code :</label>
                        <?php echo htmlspecialchars(strtoupper($arr_view['code'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label>License Amount :</label>
                        <?php echo htmlspecialchars($arr_view['amount'])." <em class='text-danger'>Br.</em>"; ?>
                      </div>
                      <div class="col-md-4">
                        <label>License Catagory :</label>
                        <?php echo htmlspecialchars($arr_view['cat']); ?>
                      </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                      <div class="col-md-4">
                        <label>Ragistration Date :</label>
                        <?php echo htmlspecialchars($obj_converter->toEth($arr_view['date'])); ?>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-2"></div>
                </div>
              <?php }?>
              <hr>
              <table id="table_stud" class="table table-bordered table-striped" style="margin-top: 10px;" >
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Licence Name</th>
                  <th>Licence code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $array = $obj_fetch->fetchLicense("All");
                    $cnt = 1;
                    foreach ($array as $key ) {
                      if ($key['stat'] == 0) {
                        $class_d = "text-danger";
                        $stat = "Canceled";
                      }elseif ($key['stat'] == 1) {
                        $class_d = "text-success";
                        $stat = "Active";
                      }
                       
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td style="text-transform: capitalize;"><?php echo $key['name']; ?></td>
                    <td style="text-transform: uppercase;"><?php echo $key['code']; ?></td>
                    <td class="<?php echo $class_d; ?>"><?php echo $stat; ?></td>
                    <td>
                      <a href="license.php?id=<?php echo $key['id']?>">
                        <button class="btn btn-primary btn-xs modal_edit">
                          <i class="fa fa-edit"></i> 
                        </button>
                      </a>
                      <a href="license.php?delete=<?php echo $key['id']?>">
                        <button class="btn btn-danger btn-xs modal_edit" onclick="return confirm('Are You Sure You Went To Delete <?php echo ucfirst($key['name']); ?>');">
                          <i class="fa fa-trash"></i> 
                        </button>
                      </a>
                      <a href="license.php?view=<?php echo $key['id']?>">
                        <button class="btn btn-info btn-xs modal_edit">
                          <i class="fa fa-eye"></i> 
                        </button>
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
    <!-- page script -->
  <script>
    $(function () {
      $('#table_stud').DataTable()
      $('.select2').select2()
    })
    function registerLice(){
      document.getElementById("addBtn").value="Adding ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'license',
            ls_name:  document.forms["Reg_form"]["ls_name"].value,
            cod:  document.forms["Reg_form"]["cod"].value,
            stat:  document.forms["Reg_form"]["stat"].value,
            amo:  document.forms["Reg_form"]["amo"].value,
            lice_cat:  document.forms["Reg_form"]["lice_cat"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddata').html(data);
          });

    })

    }

    function updateLice(){
      document.getElementById("updateBtn").value="Updating ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'liceUpd',
            id : document.forms["Upd_form"]["hiden_id"].value,
            lic_name:  document.forms["Upd_form"]["lice_name_edit"].value,
            stat:  document.forms["Upd_form"]["stat_edit"].value,
            code:  document.forms["Upd_form"]["cod_edit"].value,
            amo:  document.forms["Upd_form"]["amo_edit"].value,
            lt_cat:  document.forms["Upd_form"]["lice_cat_edit"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddataUp').html(data);
          });

    })

    }
  </script>

  <script>
    function selectorUp(stat,lice){
      document.getElementById("stat_edit").selectedIndex = stat;
      document.getElementById("lice_cat_edit").selectedIndex = lice;
    } 

    if (<?php echo  $select_cons_up;?> === 1) {
      selectorUp(<?php if(isset($indexstat)){echo $indexstat;}else{echo "0";} ?>,<?php if(isset($select_edu_lev)){echo $select_edu_lev;}else{echo "0";} ?>)
    }
  </script>
</body>
</html>