<?php
session_start();
$title = "Terms";
$term = "active";
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
        Terms
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-newspaper-o"></i> Terms</a></li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12" style="margin-top: 10px;">
          <div class="box box-primary" >
            <div class="box-header" style="margin-top: 5px;">
              <h3 class="box-title">List Of Terms</h3>
            </div>
            <hr>
            <div class="box-body">
              <?php if(!isset($_GET['id']) && !isset($_GET['delete']) && !isset($_GET['view'])){?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Reg_form">
                  <div class="row" id="recieveddata">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Term Name</label>
                        <input type="text" class="form-control" name="trm_name" style="text-transform: capitalize;">
                      </div>

                      <div class="form-group">
                        <label>Traning Start Date</label>
                        <input type="text" class="form-control" name="tsd" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div class="form-group">
                        <label>Traning End Date</label>
                        <input type="text" class="form-control" name="ted" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>License Type</label>
                        <select class="form-control select2" name="lt" style="text-transform: capitalize;">
                          <option></option>
                          <?php
                            $array_acct = $obj_fetch->fetchLicense("Active");
                            foreach ($array_acct as $key_1) {
                          ?>
                          <option value="<?php echo htmlspecialchars($key_1['id']); ?>"><?php echo htmlspecialchars($key_1['name']); ?></option>
                          <?php }?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="stat">
                          <option></option>
                          <option value="1">Active </option>
                          <option value="0">Deactive</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Complition Status</label>
                        <select class="form-control select2" name="comp_reg">
                          <option></option>
                          <option value="0">Not completed </option>
                          <option value="1">Completed</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                      <div style="margin-top: 13%; margin-left: 30%;">
                        <input type="button" onclick="return registerTerm()" id="addBtn" value="Add" class="btn btn-primary">
                      </div>
                    </div>
                    <div class="col-md-5"></div>
                  </div>                 
                </form>
              <?php }elseif(isset($_GET['id']) && !isset($_GET['delete']) && !isset($_GET['view'])){
                $array_of_nam = $obj_fetch->fetchTermId($_GET['id']);

                if ($array_of_nam['stat'] == 0) {
                  $indexstat = 2;
                }elseif ($array_of_nam['stat'] == 1) {
                  $indexstat = 1;
                }

                if ($array_of_nam['comp'] == 0) {
                  $indexcomp = 1;
                }elseif ($array_of_nam['comp'] == 1) {
                  $indexcomp = 2;
                }

                ?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Upd_form">
                  <div class="row" id="recieveddataUp">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <input type="text" name="hiden_id" value="<?php echo $_GET['id']; ?>" hidden>
                      <div class="form-group">
                        <label>Term Name:</label>
                        <input style="text-transform: capitalize;" type="text" class="form-control" name="trm_name_edit" value="<?php echo htmlspecialchars($array_of_nam['name']);?>">
                      </div>

                      <div class="form-group">
                        <label>Traning Start Date</label>
                        <input type="text" class="form-control" name="tsd_edit" value="<?php echo htmlspecialchars($obj_converter->toEth($array_of_nam['tsd']));?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>

                      <div class="form-group">
                        <label>Traning End Date</label>
                        <input type="text" class="form-control" name="ted_edit" value="<?php echo htmlspecialchars($obj_converter->toEth($array_of_nam['ted']));?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>
                    </div>
                    <div class="col-md-4">

                      <div class="form-group">
                        <label>License Type:</label>
                        <select class="form-control select2" name="lt_edit">
                          <?php
                           $lice_name = $obj_fetch->fetchLicenseId($array_of_nam['license_t']);
                          ?>
                          <option class="text-success" value="<?php echo $lice_name['id'] ?>"><?php echo $lice_name['name'] ?></option>
                         <?php 
                          $fetcher_active = $obj_fetch->fetchLicense("Active");
                          foreach ($fetcher_active as $key_1 ) {
                            ?>
                          <option class="text-danger" value="<?php echo htmlspecialchars($key_1['id']);?>" ><?php echo htmlspecialchars($key_1['name']);?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control select2" name="stat_edit" id="stat_edit">
                          <option></option>
                          <option value="1">Open </option>
                          <option value="0">Closed</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Complition:</label>
                        <select class="form-control select2" name="comp_edit" id="comp_edit">
                          <option></option>
                          <option value="0">Not Completed </option>
                          <option value="1">Completed</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                      <div style="margin-top: 13%; margin-left: 28%;">
                        <input type="button" id="updateBtn" value="Update" onclick="return updateTerm()" class="btn btn-primary">
                      </div>
                    </div>
                    <div class="col-md-5"></div>
                  </div>                 
                </form>
              <?php }elseif(!isset($_GET['id']) && isset($_GET['delete']) && !isset($_GET['view'])){
                $obj_register->deleteTerm($_GET['delete']);
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
                            <a href='term.php'>
                                    <button type='button' class='btn btn-success' >Reload</button>
                              </a>
                            </center>   
                        </div>
                  </div>
                  <div class='col-md-2'></div>
                </div>
              <?php }elseif(!isset($_GET['id']) && !isset($_GET['delete']) && isset($_GET['view'])){
                  $view_id_arr = $obj_fetch->fetchTermId($_GET['view']);
                  $stud_view_arr = $obj_fetch->employeFetchId($view_id_arr['editor']);
                  $lice_view_arr = $obj_fetch->fetchLicenseId($view_id_arr['license_t']);
                  if($view_id_arr['stat'] == 0){
                    $stat_view_out = "Closed for Registration";
                  }elseif($view_id_arr['stat'] == 1){
                    $stat_view_out = "Open for Registration";
                  }

                  if($view_id_arr['stat'] == 0){
                    $comp_view_out = "Not Completed";
                  }elseif($view_id_arr['stat'] == 1){
                    $comp_view_out = "Completed";
                  }

                ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Term ID :</label>
                        <?php echo htmlspecialchars($view_id_arr['id']); ?>
                      </div>
                      <div class="col-md-4">
                        <label> Term Name :</label>
                        <?php echo htmlspecialchars(ucfirst($view_id_arr['name'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label>Status :</label>
                        <?php echo htmlspecialchars($stat_view_out); ?>
                      </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                      <div class="col-md-4">
                        <label>Trening Start Date :</label>
                        <?php echo htmlspecialchars($obj_converter->toEth($view_id_arr['tsd'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label> Trening End Date :</label>
                        <?php echo htmlspecialchars($obj_converter->toEth($view_id_arr['ted'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label>License Type :</label>
                        <?php echo htmlspecialchars(ucfirst($lice_view_arr['name'])); ?>
                      </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                      <div class="col-md-4">
                        <label>Registration Date :</label>
                        <?php echo htmlspecialchars($obj_converter->toEth($view_id_arr['date'])); ?>
                      </div>
                      <div class="col-md-4">
                        <label>Complition :</label>
                        <?php echo htmlspecialchars($comp_view_out); ?>
                      </div>
                      <div class="col-md-4">
                        <label>Resposible  :</label>
                        <?php echo htmlspecialchars(ucfirst($stud_view_arr[0]['username'])); ?>
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
                  <th>Name</th>
                  <th>Traning Start Date</th>
                  <th>Traning Start Date</th>
                  <th>Licence Type</th>
                  <th>Status</th>
                  <th>Comp. Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $array = $obj_fetch->fetchTerm("All");
                    $cnt = 1;
                    foreach ($array as $key ) {
                      if ($key['stat'] == 0) {
                        $class_d = "text-danger";
                        $stat = "Closed";
                      }elseif ($key['stat'] == 1) {
                        $class_d = "text-success";
                        $stat = "Open";
                      }

                      if ($key['comp'] == 0) {
                        $class_ds = "text-danger";
                        $comp_ou = "Not Completed";
                      }elseif ($key['comp'] == 1) {
                        $class_ds = "text-success";
                        $comp_ou = "Completed";
                      }
                       
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td style="text-transform: capitalize;"><?php echo $key['name']; ?></td>
                    <td><?php echo $obj_converter->toEth($key['tsd']); ?></td>
                    <td><?php echo $obj_converter->toEth($key['ted']); ?></td>
                    <td style="text-transform: capitalize;"><?php echo $obj_fetch->fetchLicenseId($key['license_t'])['name']; ?></td>
                    <td class="<?php echo $class_d; ?>"><?php echo $stat; ?></td>
                    <td class="<?php echo $class_ds; ?>"><?php echo $comp_ou; ?></td>
                    <td>
                      <a href="term.php?id=<?php echo $key['id']?>">
                        <button class="btn btn-primary btn-xs ">
                          <i class="fa fa-edit"></i> 
                        </button>
                      </a>
                      <a href="term.php?delete=<?php echo $key['id']?>">
                        <button class="btn btn-danger btn-xs " onclick="return confirm('Are You Sure You Went To Delete <?php echo ucfirst($key['name']); ?>');">
                          <i class="fa fa-trash"></i> 
                        </button>
                      </a>
                      <a href="term.php?view=<?php echo $key['id']?>">
                        <button class="btn btn-info btn-xs ">
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
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- page script -->
  <script>
    $(function () {
      $('#table_stud').DataTable()
      $('.select2').select2()
    })
    $(function () {
    $('[data-mask]').inputmask()
    })
    function registerTerm(){
      document.getElementById("addBtn").value="Adding ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'term',
            trm_name:  document.forms["Reg_form"]["trm_name"].value,
            tsd:  document.forms["Reg_form"]["tsd"].value,
            ted:  document.forms["Reg_form"]["ted"].value,
            lt:  document.forms["Reg_form"]["lt"].value,
            stat:  document.forms["Reg_form"]["stat"].value,
            comp_reg:  document.forms["Reg_form"]["comp_reg"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddata').html(data);
          });

    })

    }

    function updateTerm(){
      document.getElementById("updateBtn").value="Updating ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'termUpd',
            id : document.forms["Upd_form"]["hiden_id"].value,
            trm_name:  document.forms["Upd_form"]["trm_name_edit"].value,
            comp:  document.forms["Upd_form"]["comp_edit"].value,
            stat:  document.forms["Upd_form"]["stat_edit"].value,
            tsd_edit:  document.forms["Upd_form"]["tsd_edit"].value,
            ted_edit:  document.forms["Upd_form"]["ted_edit"].value,
            lt_edit:  document.forms["Upd_form"]["lt_edit"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddataUp').html(data);
          });

    })

    }
  </script>
  <script>
    function selectorUp(stat,comp){
      document.getElementById("stat_edit").selectedIndex = stat;
      document.getElementById("comp_edit").selectedIndex = comp;
    } 

    if (<?php echo  $select_cons_up;?> === 1) {
      selectorUp(<?php if(isset($indexstat)){echo $indexstat;}else{echo "0";} ?>,<?php if(isset($indexcomp)){echo $indexcomp;}else{echo "0";} ?>)
    }
  </script>
</body>
</html>