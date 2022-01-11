<?php
session_start();
$title = "Classes";
$cl_cl = "active";
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
        Class
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-building"></i> Class</a></li>
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
                        <label>Class Name</label>
                        <input type="text" class="form-control" name="cl_name" style="text-transform: capitalize;">
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="stat">
                          <option></option>
                          <option value="0">Active </option>
                          <option value="1">Deactive</option>
                        </select>
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <input type="button" onclick="return registerTerm()" id="addBtn" value="Add" class="btn btn-primary">
                      </div>

                    </div>
                    <div class="col-md-4"></div>
                  </div>                 
                </form>
              <?php }elseif(isset($_GET['id']) && !isset($_GET['delete']) && !isset($_GET['view'])){
                $array_of_nam = $obj_fetch->fetchClassId($_GET['id']);

                if ($array_of_nam['stat'] == 0) {
                  $indexstat = 1;
                }elseif ($array_of_nam['stat'] == 1) {
                  $indexstat = 2;
                }

                ?>
                <form style="margin-bottom:  40px;margin-top:  0px;" name="Upd_form">
                  <div class="row" id="recieveddataUp">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">

                      <div class="form-group">
                        <label>Class Name</label>
                        <input type="text" class="form-control" value="<?php echo $array_of_nam['name']; ?>" name="cl_name_up" style="text-transform: capitalize;">
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="stat_up" id="stat_edit">
                          <option></option>
                          <option value="0">Active </option>
                          <option value="1">Deactive</option>
                        </select>
                      </div>

                      <div style="margin-top: 13%; margin-left: 30%;">
                        <input type="button" id="updateBtn" value="Update" onclick="return updateClass()" class="btn btn-primary">
                      </div>

                    </div>
                    <div class="col-md-4"></div>
                  </div>                 
                </form>
              <?php }elseif(!isset($_GET['id']) && isset($_GET['delete']) && !isset($_GET['view'])){
                $obj_register->deleteClass($_GET['delete']);
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
                            <a href='class.php'>
                                    <button type='button' class='btn btn-success' >Reload</button>
                              </a>
                            </center>   
                        </div>
                  </div>
                  <div class='col-md-2'></div>
                </div>
              <?php }elseif(!isset($_GET['id']) && !isset($_GET['delete']) && isset($_GET['view'])){
                  $arr_view_cl = $obj_fetch->fetchClassId($_GET['view']);
                  $arr_res_pers = $obj_fetch->employeFetchId($arr_view_cl['editor'])[0];
                  if ($arr_view_cl['stat'] == 0) {
                    $stat_view_out = "Active";
                  }elseif ($arr_view_cl['stat'] == 1) {
                    $stat_view_out = "Dective";
                  }
                ?>

                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-md-4 text-info">
                          <label>Class ID:</label>
                          <?php echo htmlspecialchars($arr_view_cl['id']); ?>
                        </div>
                        <div class="col-md-4 text-info">
                          <label>Class Name:</label>
                          <?php echo htmlspecialchars(ucfirst($arr_view_cl['name'])); ?>
                        </div>
                        <div class="col-md-4 text-info">
                          <label>Registration Date:</label>
                          <?php echo htmlspecialchars($obj_converter->toEth($arr_view_cl['date'])); ?>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4 text-success">
                          <label>Status:</label>
                          <?php echo htmlspecialchars($stat_view_out); ?>
                        </div>
                        <div class="col-md-4 text-success">
                          <label>Resposible:</label>
                          <?php echo htmlspecialchars(ucfirst($arr_res_pers['username'])); ?>
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
                  <th style="width: 10px;">No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $array = $obj_fetch->fetchClass("All");
                    $cnt = 1;
                    foreach ($array as $key ) {
                      if ($key['stat'] == 0) {
                        $class_d = "text-success";
                        $stat = "Active";
                      }elseif ($key['stat'] == 1) {
                        $class_d = "text-danger";
                        $stat = "Deactive";
                      }
                       
                  ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td style="text-transform: capitalize;"><?php echo $key['name']; ?></td>
                    <td><?php echo $obj_converter->toEth($key['date']); ?></td>
                    <td class="<?php echo $class_d; ?>"><?php echo $stat; ?></td>
                    <td>
                      <a href="class.php?id=<?php echo $key['id']?>">
                        <button class="btn btn-primary btn-xs modal_edit">
                          <i class="fa fa-edit"></i> 
                        </button>
                      </a>
                      <a href="class.php?delete=<?php echo $key['id']?>">
                        <button class="btn btn-danger btn-xs modal_edit" onclick="return confirm('Are You Sure You Went To Delete <?php echo ucfirst($key['name']); ?>');">
                          <i class="fa fa-trash"></i> 
                        </button>
                      </a>
                      <a href="class.php?view=<?php echo $key['id']?>">
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
            type:'classReg',
            cl_name:  document.forms["Reg_form"]["cl_name"].value,
            stat:  document.forms["Reg_form"]["stat"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddata').html(data);
          });

    })

    }

    function updateClass(){
      document.getElementById("updateBtn").value="Updating ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'classUpd',
            id:  <?php if(isset($_GET['id'])){echo $_GET['id'];}else{echo "0";} ?>,
            cl_name:  document.forms["Upd_form"]["cl_name_up"].value,
            stat:  document.forms["Upd_form"]["stat_up"].value,
            editor:  <?php echo $_SESSION['id'];?>      
          },
          function(data){
            $('#recieveddataUp').html(data);
          });

    })

    }
  </script>
  <script>
    function selectorUp(stat){
      document.getElementById("stat_edit").selectedIndex = stat;
    } 

    if (<?php echo  $select_cons_up;?> === 1) {
      selectorUp(<?php if(isset($indexstat)){echo $indexstat;}else{echo "0";} ?>)
    }
  </script>
</body>
</html>