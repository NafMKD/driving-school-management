<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Student Status";
$stud = "active";
$stat_cl = "active";
include 'autoloader.php';
$obj_fetch = new Fetch;
$obj_converter = new converter;
$select_cons = 1;
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
        Student Status
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-folder-open"></i> Student Status</a></li>
      </ol>
    </section>

    
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom" style="margin-top: 10px;">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($_GET['term'])){echo "active";} ?>"><a href="studstat.php?term=yes" >Term</a></li>
              <li class="<?php if(isset($_GET['lice'])){echo "active";} ?>"><a href="studstat.php?lice=yes" >License Type</a></li>
              <li class="<?php if(isset($_GET['ind'])){echo "active";} ?>"><a href="studstat.php?ind=yes&gen=9/0&stat=9/0" >Individual</a></li>
              <li class="<?php if(isset($_GET['att'])){echo "active";} ?>"><a href="studstat.php?att=yes" >Attendace</a></li>
            </ul>
            <div class="tab-content">
            <?php if (isset($_GET['term'])) { ?>
              <!-- Tab Term -->
              <div >
                <section id="notification">
                  <h4 class="page-header">Student Status Term</h4>
                </section>

                <div class="row">

                  <div class="col-md-3">

                    <div class="box box-info box-solid" id="openTrmDiv">
                      <div class="box-header with-border">
                        <h3 class="box-title">Open Terms</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="openTrmicon" class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <?php
                          $array_act_trm = $obj_fetch->fetchTerm("Open");
                          foreach ($array_act_trm as $key) {
                            
                           ?>
                            <li class="<?php if(isset($_GET['trm_open_id'])){if($_GET['trm_open_id'] == $key['id']){echo "active";}} ?>"><a style="text-transform: capitalize;" href="studstat.php?term=yes&trm_open_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder-open"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    <div class="box box-success box-solid" id="closeTrmDiv">
                      <div class="box-header with-border">
                        <h3 class="box-title">Closed Terms</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="closeTrmicon" class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <?php
                          $array_act_trm = $obj_fetch->fetchTerm("Closed");
                          foreach ($array_act_trm as $key) {
                            
                           ?>
                            <li class="<?php if(isset($_GET['trm_close_id'])){if($_GET['trm_close_id'] == $key['id']){echo "active";}} ?>"><a style="text-transform: capitalize;" href="studstat.php?term=yes&trm_close_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder-o"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    <div class="box box-danger box-solid" id="cancelTrmDiv">
                      <div class="box-header with-border">
                        <h3 class="box-title">Canceled Terms</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="cancleTrmicon" class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <?php
                          $array_act_trm = $obj_fetch->fetchTerm("Canceled");
                          foreach ($array_act_trm as $key) {
                            
                           ?>
                            <li class="<?php if(isset($_GET['trm_cancel_id'])){if($_GET['trm_cancel_id'] == $key['id']){echo "active";}} ?>" ><a style="text-transform: capitalize;" href="studstat.php?term=yes&trm_cancel_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                  </div>
                  <!-- /.col -->
                  <?php if(isset($_GET['term']) && isset($_GET['trm_close_id'])){ 
                    $array_byid_trm = $obj_fetch->fetchTermId($_GET['trm_close_id']); ?>
                    <div class="col-md-9">
                      <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="text-transform: capitalize;">Selected Term - <b class="text-success"><?php echo htmlspecialchars($array_byid_trm['name']); ?></b></h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php 
                            $date_one_stat = date_create($array_byid_trm['tsd']);
                            $date_two_stat = date_create($array_byid_trm['ted']);
                            $date_interval_stat = date_diff($date_one_stat,$date_two_stat)->format("%a days");

                            $date_one_dyn = date_create($array_byid_trm['tsd']);
                            $date_two_dyn = date_create(date("m/d/Y"));
                            $date_interval_dyn = date_diff($date_one_dyn,$date_two_dyn)->format("%a days");

                            $lce_type_name = $obj_fetch->fetchLicenseId($array_byid_trm['license_t'])['name'];

                            $student_id_close = $obj_fetch->fetchStudentTermId($array_byid_trm['id']);

                            //print_r($array_byid_trm);
                          ?>
                          <form style="margin-top: 2%;">
                            <div class="row">

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning Start Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['tsd'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning End Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['ted'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of training days :</label>
                                <p><?php echo htmlspecialchars($date_interval_stat); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of trained days :</label>
                                <p><?php echo htmlspecialchars($date_interval_dyn); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">License Name :</label>
                                <p style="text-transform: capitalize;"><?php echo htmlspecialchars($lce_type_name); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_close)); ?></p>
                              </div>

                            </div>
                          </form>
                          <hr>
                          <table id="table_term" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px"><input type="checkbox" class="checkbox-toggle"></th>
                                <th style="width: 60px">Id</th>
                                <th>Full Name</th>
                                <th>Progress</th>
                                <th style="width: 40px">Label</th>
                              </tr>
                            </thead>
                            <tbody class="all-checkbox">
                              <?php
                              foreach ($student_id_close as $key) { 
                              ?>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo htmlspecialchars($key['id']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($key['name']); ?> <?php echo htmlspecialchars($key['fname']); ?> <?php echo htmlspecialchars($key['gname']); ?></td>
                                <td>
                                  <?php
                                  $arr_rec = $obj_fetch->statusCalculator($key['id']);
                                  if ($arr_rec < 25) {
                                    $calss_task = "progress-bar-danger";
                                    $calss_task2 = "red";
                                  }elseif($arr_rec > 25 && $arr_rec < 50){
                                    $calss_task = "progress-bar-yellow";
                                    $calss_task2 = "yellow";
                                  }elseif($arr_rec > 50 && $arr_rec < 75){
                                    $calss_task = "progress-bar-primary";
                                    $calss_task2 = "light-blue";
                                  }elseif($arr_rec > 75 && $arr_rec < 101){
                                    $calss_task = "progress-bar-success";
                                    $calss_task2 = "green";
                                  }
                                   ?>
                                    <div class="progress progress-xs progress-striped active">
                                      <div class="progress-bar <?php echo $calss_task; ?>" style="width: <?php echo $arr_rec; ?>%"></div>
                                    </div>
                                  <?php ?>
                                </td>
                                <td><span class="badge bg-<?php echo $calss_task2; ?>"><?php echo round($arr_rec); ?> %</span></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }elseif(isset($_GET['term']) && isset($_GET['trm_open_id'])){ 
                    $array_byid_trm = $obj_fetch->fetchTermId($_GET['trm_open_id']); ?>
                    <div class="col-md-9">
                      <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="text-transform: capitalize;">Selected Term - <b class="text-success"><?php echo htmlspecialchars($array_byid_trm['name']); ?></b></h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php 
                            $date_one_stat = date_create($array_byid_trm['tsd']);
                            $date_two_stat = date_create($array_byid_trm['ted']);
                            $date_interval_stat = date_diff($date_one_stat,$date_two_stat)->format("%a days");

                            $lce_type_name = $obj_fetch->fetchLicenseId($array_byid_trm['license_t'])['name'];

                            $student_id_close = $obj_fetch->fetchStudentTermId($array_byid_trm['id']);

                            //print_r($array_byid_trm);
                          ?>
                          <form style="margin-top: 2%;">
                            <div class="row">

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning Start Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['tsd'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning End Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['ted'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of training days :</label>
                                <p><?php echo htmlspecialchars($date_interval_stat); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of trained days :</label>
                                <p>NON</p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">License Name :</label>
                                <p style="text-transform: capitalize;"><?php echo htmlspecialchars($lce_type_name); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_close)); ?></p>
                              </div>

                            </div>
                          </form>
                          <hr>
                          <table id="table_term" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px"><input type="checkbox" class="checkbox-toggle"></th>
                                <th style="width: 60px">Id</th>
                                <th>Full Name</th>
                                <th>Progress</th>
                                <th style="width: 40px">Label</th>
                              </tr>
                            </thead>
                            <tbody class="all-checkbox">
                              <?php
                              foreach ($student_id_close as $key) { 
                              ?>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo htmlspecialchars($key['id']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($key['name']); ?> <?php echo htmlspecialchars($key['fname']); ?> <?php echo htmlspecialchars($key['gname']); ?></td>
                                <td>
                                  <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                                  </div>
                                </td>
                                <td><span class="badge bg-red">0%</span></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }elseif(isset($_GET['term']) && isset($_GET['trm_cancel_id'])){ 
                    $array_byid_trm = $obj_fetch->fetchTermId($_GET['trm_cancel_id']); ?>
                    <div class="col-md-9">
                      <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="text-transform: capitalize;">Selected Term - <b class="text-success"><?php echo htmlspecialchars($array_byid_trm['name']); ?></b></h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php 
                            $date_one_stat = date_create($array_byid_trm['tsd']);
                            $date_two_stat = date_create($array_byid_trm['ted']);
                            $date_interval_stat = date_diff($date_one_stat,$date_two_stat)->format("%a days");

                            $lce_type_name = $obj_fetch->fetchLicenseId($array_byid_trm['license_t'])['name'];

                            $student_id_close = $obj_fetch->fetchStudentTermId($array_byid_trm['id']);

                            //print_r($array_byid_trm);
                          ?>
                          <form style="margin-top: 2%;">
                            <div class="row">

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning Start Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['tsd'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">Traning End Date :</label>
                                <p><?php echo htmlspecialchars($obj_converter->toEth($array_byid_trm['ted'])); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of training days :</label>
                                <p><?php echo htmlspecialchars($date_interval_stat); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of trained days :</label>
                                <p><?php echo htmlspecialchars($date_interval_stat); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">License Name :</label>
                                <p style="text-transform: capitalize;"><?php echo htmlspecialchars($lce_type_name); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-6 control-label">No. of Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_close)); ?></p>
                              </div>

                            </div>
                          </form>
                          <hr>
                          <table id="table_term" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px"><input type="checkbox" class="checkbox-toggle"></th>
                                <th style="width: 60px">Id</th>
                                <th>Full Name</th>
                                <th>Progress</th>
                                <th style="width: 40px">Label</th>
                              </tr>
                            </thead>
                            <tbody class="all-checkbox">
                              <?php
                              foreach ($student_id_close as $key) { 
                              ?>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo htmlspecialchars($key['id']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($key['name']); ?> <?php echo htmlspecialchars($key['fname']); ?> <?php echo htmlspecialchars($key['gname']); ?></td>
                                <td>
                                <?php
                                  $arr_rec = $obj_fetch->statusCalculator($key['id']);
                                  if ($arr_rec < 25) {
                                    $calss_task = "progress-bar-danger";
                                    $calss_task2 = "red";
                                  }elseif($arr_rec > 25 && $arr_rec < 50){
                                    $calss_task = "progress-bar-yellow";
                                    $calss_task2 = "yellow";
                                  }elseif($arr_rec > 50 && $arr_rec < 75){
                                    $calss_task = "progress-bar-primary";
                                    $calss_task2 = "light-blue";
                                  }elseif($arr_rec > 75 && $arr_rec < 100){
                                    $calss_task = "progress-bar-success";
                                    $calss_task2 = "green";
                                  }
                                   ?>
                                    <div class="progress progress-xs progress-striped active">
                                      <div class="progress-bar <?php echo $calss_task; ?>" style="width: <?php echo $arr_rec; ?>%"></div>
                                    </div>
                                  
                                </td>
                                <td><span class="badge bg-<?php echo $calss_task2; ?>"><?php echo round($arr_rec); ?> %</span></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }else{?>
                    <div class="col-md-9">
                      <div class="box box-info collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Selected Term</h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }?>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./Tab Term -->
            <?php } elseif(isset($_GET['lice'])){?>
              <!-- Tab License -->
              <div >
                <section id="notification">
                  <h4 class="page-header">Student Status Licence</h4>
                </section>

                <div class="row">

                  <div class="col-md-3">

                    <div class="box box-success box-solid" id="activeLicDiv">
                      <div class="box-header with-border">
                        <h3 class="box-title">Active License</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="activeLicicon" class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <?php
                          $array_act_trm = $obj_fetch->fetchLicense("Active");
                          foreach ($array_act_trm as $key) {
                            
                           ?>
                            <li class="<?php if(isset($_GET['lic_active_id'])){if($_GET['lic_active_id'] == $key['id']){echo "active";}} ?>"><a style="text-transform: capitalize;" href="studstat.php?lice=yes&lic_active_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder-open"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    <div class="box box-danger box-solid" id="cancleLiceDiv">
                      <div class="box-header with-border">
                        <h3 class="box-title">Deactive License</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="cancleLiceicon" class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <?php
                          $array_act_trm = $obj_fetch->fetchLicense("Canceled");
                          foreach ($array_act_trm as $key) {
                            
                           ?>
                            <li class="<?php if(isset($_GET['lic_cancel_id'])){if($_GET['lic_cancel_id'] == $key['id']){echo "active";}} ?>"><a style="text-transform: capitalize;" href="studstat.php?lice=yes&lic_cancel_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder-o"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                  </div>
                  <!-- /.col -->
                  <?php if(isset($_GET['lice']) && isset($_GET['lic_active_id'])){ 
                    $array_byid_lic = $obj_fetch->fetchLicenseId($_GET['lic_active_id']); ?>
                    <div class="col-md-9">
                      <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="text-transform: capitalize;">Selected Term - <b class="text-success"><?php echo htmlspecialchars($array_byid_lic['name']); ?></b></h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php 
                            $student_id_oncmp = $obj_fetch->fetchStudentLiceId("oncampus",$_GET['lic_active_id']);
                            $student_id_offcmp = $obj_fetch->fetchStudentLiceId("offcampus",$_GET['lic_active_id']);
                            $student_id_all = $obj_fetch->fetchStudentLiceId("All",$_GET['lic_active_id']);
                          ?>
                          <form style="margin-top: 2%;">
                            <div class="row">

                              <div class="col-md-6">
                                <label class="col-sm-5 control-label">License Code :</label>
                                <p style="text-transform: capitalize;"><?php echo htmlspecialchars($array_byid_lic['code']); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-4 control-label">Amount :</label>
                                <p><?php echo htmlspecialchars($array_byid_lic['amount'])."<em class='text-danger'> Br.</em>"; ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-7 control-label">on Cumpus Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_oncmp)); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-7 control-label">off Cumpus Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_offcmp)); ?></p>
                              </div>

                            </div>
                          </form>
                          <hr>
                          <table id="table_lice" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px"><input type="checkbox" class="checkbox-toggle"></th>
                                <th style="width: 60px">Id</th>
                                <th>Full Name</th>
                                <th>Term</th>
                                <th>Class</th>
                              </tr>
                            </thead>
                            <tbody class="all-checkbox">
                              <?php
                              foreach ($student_id_all as $key) { 
                                $trm_name = $obj_fetch->fetchTermId($key['term_lic'])['name'];
                              ?>
                              <tr>
                                <td><input type="checkbox" id="checkboxtbl<?php echo htmlspecialchars($key['id']); ?>"></td>
                                <td><?php echo htmlspecialchars($key['id']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($key['name']); ?> <?php echo htmlspecialchars($key['fname']); ?> <?php echo htmlspecialchars($key['gname']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_name); ?></td>
                                <td></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }elseif(isset($_GET['lice']) && isset($_GET['lic_cancel_id'])){ 
                    $array_byid_lic = $obj_fetch->fetchLicenseId($_GET['lic_cancel_id']); ?>
                    <div class="col-md-9">
                      <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="text-transform: capitalize;">Selected Term - <b class="text-success"><?php echo htmlspecialchars($array_byid_lic['name']); ?></b></h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php 
                            $student_id_offcmp = $obj_fetch->fetchStudentLiceId("offcampus",$_GET['lic_cancel_id']);
                            $student_id_all = $obj_fetch->fetchStudentLiceId("All",$_GET['lic_cancel_id']);
                          ?>
                          <form style="margin-top: 2%;">
                            <div class="row">

                              <div class="col-md-6">
                                <label class="col-sm-5 control-label">License Code :</label>
                                <p style="text-transform: capitalize;"><?php echo htmlspecialchars($array_byid_lic['code']); ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-4 control-label">Amount :</label>
                                <p><?php echo htmlspecialchars($array_byid_lic['amount'])."<em class='text-danger'> Br.</em>"; ?></p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-7 control-label">on Cumpus Students :</label>
                                <p>NON</p>
                              </div>

                              <div class="col-md-6">
                                <label class="col-sm-7 control-label">off Cumpus Students :</label>
                                <p><?php echo htmlspecialchars(count($student_id_offcmp)); ?></p>
                              </div>

                            </div>
                          </form>
                          <hr>
                          <table id="table_lice" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px"><input type="checkbox" class="checkbox-toggle"></th>
                                <th style="width: 60px">Id</th>
                                <th>Full Name</th>
                                <th>Term</th>
                                <th>Class</th>
                              </tr>
                            </thead>
                            <tbody class="all-checkbox">
                              <?php
                              foreach ($student_id_all as $key) { 
                                $trm_name = $obj_fetch->fetchTermId($key['term_lic'])['name'];
                              ?>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo htmlspecialchars($key['id']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($key['name']); ?> <?php echo htmlspecialchars($key['fname']); ?> <?php echo htmlspecialchars($key['gname']); ?></td>
                                <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_name); ?></td>
                                <td></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }else{?>
                    <div class="col-md-9">
                      <div class="box box-info collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Selected Term</h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          
                        </div>
                        <!-- /.box-body -->
                        
                      </div>
                      <!-- /. box -->
                    </div>
                  <?php }?>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./Tab License -->
            <?php } elseif(isset($_GET['ind'])){?>
              <!-- Tab Individual -->
              <div >
                <section id="ind">
                  <h4 class="page-header">Student Status Individualy</h4>

                  <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                    <div class="row" >
                      <div class="col-md-2"></div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="ind" value="yes" hidden>
                          <label>Gender</label>
                          <select class="form-control select2" name="gen" id="selectGen" >
                            <option value="9/0">-- All Gender --</option>
                            <option value="1/1">Male</option>
                            <option value="2/2">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control select2" name="stat" id="selectStat">
                            <option value="9/0">-- All--</option>
                            <option value="0/1">on Campus</option>
                            <option value="1/2">off Cumpus</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="col-md-12">
                        <center>
                          <div style="margin-top: 1%; ">
                            <input type="submit" onclick="document.getElementById('ind_filter_btn').value='Filtering ...'" class="btn btn-primary" value="Filter" id="ind_filter_btn">
                          </div>
                        </center>
                      </div>
                    </div>                 
                  </form>
                  <hr>
                  <table id="table_filter" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th></th>
                      <th>ID No.</th>
                      <th>Full Name</th>
                      <th>Gender</th>
                      <th>Term</th>
                      <th>License Type</th>
                      <th>Status</th>
                      <th>Complition</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(isset($_GET['gen'])&& isset($_GET['stat'])){
                        if ($_GET['gen'] == '9/0' && $_GET['stat'] == '9/0') {
                        $array = $obj_fetch->fetchStudent("All");
                        $cnt = 1;
                        foreach ($array as $key ) {
                        if($key['gender'] == 1){
                          $gen_show = "Male";
                        }elseif($key['gender'] == 2){
                          $gen_show = "Female";
                        }
                        $phone = $obj_fetch->fetchStudentAddId($key['id'])[0]['phone'];
                        $trm_show = $obj_fetch->fetchTermId($key['term_lic']);
                        $lt_show = $obj_fetch->fetchLicenseId($key['lt']);
                        if ($key['stat'] == 0) {
                          $stat_out = "Learning";
                          $stat_cl = "text-success";
                        }elseif ($key['stat'] == 1) {
                          $stat_out = "Finished";
                          $stat_cl = "text-danger";
                        }
                        if ($key['comp'] == 0) {
                          $comp_out = "On Campus";
                          $comp_cl = "text-success";
                        }elseif ($key['comp'] == 1) {
                          $comp_out = "Off Campus";
                          $comp_cl = "text-danger";
                        }
                           
                      ?>
                      <tr>
                        <td><input type="checkbox"  class="checkTab" id="<?php  echo $key['id']?>"></td>
                        <td><?php echo htmlspecialchars($key['id']); ?></td>
                        <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                        <td><?php echo htmlspecialchars($gen_show); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                        <td class="statTab <?php echo htmlspecialchars($stat_cl); ?>" id="<?php  echo $key['id']?>"><?php echo htmlspecialchars($stat_out); ?></td>
                        <td class="compTab <?php echo htmlspecialchars($comp_cl); ?>" id="<?php  echo $key['id']?>"><?php echo htmlspecialchars($comp_out); ?></td>
                        <td ><button class="btn btn-primary btn-xs send_mes" id="<?php  echo $key['id']?>" disabled>Update</button></td>
                      </tr>
                      <?php $cnt=$cnt+1;} }else{
                          $select_cons = 0;
                          $gender = explode("/", $_GET['gen']);
                          $term = explode("/",$_GET['stat']);

                          $query = "SELECT * FROM student WHERE";
                          $val = 0;
                          if ($gender[0] != 9) {
                            $val = 1;
                            $query .= " gender = '$gender[0]'";
                            $selection_ind_gen = $gender[1];
                          }
                          if ($term[0] != 9) {
                            if ($val == 1) {
                              $query .= "AND comp = '$term[0]'";
                              $selection_ind_trm = $term[1];
                            }else{
                              $val = 1;
                              $query .= " comp = '$term[0]'";
                              $selection_ind_trm = $term[1];
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
                            $phone = $obj_fetch->fetchStudentAddId($key['id'])[0]['phone'];
                          if ($key['stat'] == 0) {
                            $stat_out = "Learning";
                            $stat_cl = "text-success";
                          }elseif ($key['stat'] == 1) {
                            $stat_out = "Finished";
                            $stat_cl = "text-danger";
                          }
                          if ($key['comp'] == 0) {
                            $comp_out = "On Campus";
                            $comp_cl = "text-success";
                          }elseif ($key['comp'] == 1) {
                            $comp_out = "Off Campus";
                            $comp_cl = "text-danger";
                          }

                        ?>
                        <tr>
                          <td><input type="checkbox"  class="checkTab" id="<?php  echo $key['id']?>"></td>
                          <td><?php echo htmlspecialchars($key['id']); ?></td>
                          <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                          <td><?php echo htmlspecialchars($gen_show); ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                          <td class="statTab <?php echo htmlspecialchars($stat_cl); ?>"id="<?php  echo $key['id']?>"><?php echo htmlspecialchars($stat_out); ?></td>
                          <td class="compTab <?php echo htmlspecialchars($comp_cl); ?>"id="<?php  echo $key['id']?>"><?php echo htmlspecialchars($comp_out); ?></td>
                          <td ><button class="btn btn-primary btn-xs send_mes" id="<?php  echo $key['id']?>" disabled>Update</button></td>
                        </tr>  
                        <?php $cnt=$cnt+1;}}
                      }?>
                    </tbody>
                  </table>
                  
                </section>
              </div>
              <!-- ./Tab Individual -->
            <?php } elseif(isset($_GET['att'])){?>
              <div>
                <section id="atrDiv">
                  <div class="row" style="margin-top: 3%;">

                    <div class="col-md-3">

                      <div class="box box-info box-solid" id="amhAttDiv">
                        <div class="box-header with-border">
                          <h3 class="box-title">Active Classes</h3>

                          <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="amhAtticon" class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="box-body no-padding">
                          <ul class="nav nav-pills nav-stacked">
                            <?php
                            $array_att_clss = $obj_fetch->fetchClass("Active");
                            foreach ($array_att_clss as $key) {
                              
                             ?>
                              <li class="<?php if(isset($_GET['cll_att_id'])){if($_GET['cll_att_id'] == $key['id']){echo "active";}} ?>">
                                <a style="text-transform: capitalize;" href="studstat.php?att=yes&cll_att_id=<?php echo htmlspecialchars($key['id']); ?>">
                                  <i class="fa fa-folder-open"></i> <?php echo htmlspecialchars($key['name']); ?>
                                </a>
                              </li>
                            <?php }?>
                          </ul>
                        </div>
                      </div>

                    </div>

                    <?php if(isset($_GET['cll_att_id'])) {?>

                      <div class="col-md-9">

                        <div class="nav-tabs-custom" >

                          <ul class="nav nav-tabs">

                            <?php
                            $array_act_trm = $obj_fetch->fetchTerm("Closed");
                            foreach ($array_act_trm as $key) {
                              
                             ?>
                              <li class="<?php if(isset($_GET['trm_att_id'])){if($_GET['trm_att_id'] == $key['id']){echo "active";}} ?>"><a style="text-transform: capitalize;" href="studstat.php?att=yes&cll_att_id=<?php echo $_GET['cll_att_id'];?>&trm_att_id=<?php echo htmlspecialchars($key['id']); ?>"><i class="fa fa-folder-o"></i> <?php echo htmlspecialchars($key['name']); ?></a></li>
                            <?php }?>

                          </ul>
                          <div class="tab-content">
                            <?php if(isset($_GET['cll_att_id']) && isset($_GET['trm_att_id'])){ 
                                $arr_name_tr = $obj_fetch->fetchTermId($_GET['trm_att_id']);
                                $arr_trm_cl_stud = $obj_fetch->fetchstudentClassAndTerm($_GET['trm_att_id'],$_GET['cll_att_id']);
                                $arr_name_class = $obj_fetch->fetchClassId($_GET['cll_att_id']);

                                $date_one_dyn = date_create($arr_name_tr['tsd']);
                                $date_two_dyn = date_create(date("m/d/Y"));
                                $date_interval_dyn = date_diff($date_one_dyn,$date_two_dyn)->format("%a days");
                              ?>
                              <form style="margin-top: 2%;">
                                <div class="row">

                                  <div class="col-md-6">
                                    <label class="col-sm-5 control-label">Term Name :</label>
                                    <p style="text-transform: capitalize;"><?php echo htmlspecialchars($arr_name_tr['name']); ?></p>
                                  </div>

                                  <div class="col-md-6">
                                    <label class="col-sm-6 control-label">Active Students :</label>
                                    <p><?php echo htmlspecialchars(count($arr_trm_cl_stud)); ?></p>
                                  </div>

                                  <div class="col-md-6">
                                    <label class="col-sm-4 control-label">Class :</label>
                                    <p><?php echo htmlspecialchars($arr_name_class['name']); ?></p>
                                  </div>

                                  <div class="col-md-6">
                                    <label class="col-sm-7 control-label">No. of Trained Days :</label>
                                    <p><?php echo htmlspecialchars($date_interval_dyn); ?></p>
                                  </div>

                                </div>
                              </form>
                              <hr>
                              <form >
                                <div class="row">
                                  <div class="col-md-2">
                                    <input type="text" name="cll_att_id" value="<?php echo $_GET['cll_att_id']; ?>" hidden>
                                    <input type="text" name="trm_att_id" value="<?php echo $_GET['trm_att_id']; ?>" hidden>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <input type="text" placeholder="Date of Attendace" name="" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                    <div class="form-group">
                                      <input type="file" name="" >
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <input type="button" value="Upload" class="btn btn-info">
                                    </div>
                                  </div>
                                  <div class="col-md-2"></div>
                                </div>
                              </form>
                              <hr>
                              <table id="table_att" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th style="width: 12px;"><input type="checkbox" class="checkbox-toggle"></th>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th>Status</th>
                                    <th style="width: 40px">Label</th>
                                  </tr>
                                </thead>
                                <tbody class="all-checkbox">
                                  <?php 
                                    foreach ($arr_trm_cl_stud as $key ) {  

                                      
                                  ?>
                                    <tr>
                                      <td><input type="checkbox"></td>
                                      <td><?php echo $key['id']; ?></td>
                                      <td><?php echo ucfirst($key['name']); ?> <?php echo ucfirst($key['fname']); ?> <?php echo ucfirst($key['gname']); ?></td>
                                      <td>
                                        <?php 
                                        $arr_rec = $obj_fetch->statusCalculator($key['id']);
                                        if ($arr_rec < 25) {
                                          $calss_task = "progress-bar-danger";
                                          $calss_task2 = "red";
                                        }elseif($arr_rec > 25 && $arr_rec < 50){
                                          $calss_task = "progress-bar-yellow";
                                          $calss_task2 = "yellow";
                                        }elseif($arr_rec > 50 && $arr_rec < 75){
                                          $calss_task = "progress-bar-primary";
                                          $calss_task2 = "light-blue";
                                        }elseif($arr_rec > 75 && $arr_rec < 100){
                                          $calss_task = "progress-bar-success";
                                          $calss_task2 = "green";
                                        }
                                        ?>
                                        <div class="progress progress-xs progress-striped active">
                                          <div class="progress-bar <?php echo $calss_task; ?>" style="width: <?php echo $arr_rec; ?>%"></div>
                                        </div>
                                      </td>
                                      <td><span class="badge bg-<?php echo $calss_task2; ?>"><?php echo round($arr_rec); ?> %</span>
                                    </tr>
                                  <?php }?>
                                </tbody>
                              </table>
                            <?php }?>
                          </div>
                        </div>
                        
                      </div>
                    <?php }?>

                  </div>
                </section>
              </div>
            <?php }?>
            </div>
          </div>
        </div>
      </div>

    </section>

    <!-- modal Send -->
    <div class="modal fade" id="modal-send">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Send Message</h4>
          </div>
          <div class="modal-body">
            <form name="Ind_form">
               <div class="row" id="reciveFromIndModal">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label>Id:</label>
                     <input type="text" class="form-control" id="id_ind" name="id_ind"  readonly>
                   </div>

                   <div class="form-group">
                     <label>Name:</label>
                     <input type="text" class="form-control" id="name_ind" readonly>
                   </div>

                   <div class="form-group">
                     <label>Status:</label>
                     <select class="form-control select2" id="stat_up" name="stat_up">
                       <option value="0">Learning</option>
                       <option value="1">Finished</option>
                     </select>
                   </div>

                   <div class="form-group">
                     <label>Complition:</label>
                     <select class="form-control select2" id="comp_up" name="comp_up">
                       <option value="0">On Campus</option>
                       <option value="1">Off Campus</option>
                     </select>
                   </div>

                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <input type="button" class="btn btn-primary" id="btn_update" value="Update" onclick="return updateInd()">
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- ./modal Send-->


  </div>


  <?php include 'includes/js.inc.php';?>
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- page script -->
  <?php if (isset($_GET['trm_open_id'])) {?>
    <script>
      $(document).ready(function(){
        $("#closeTrmDiv").addClass("collapsed-box");
        $("#cancelTrmDiv").addClass("collapsed-box");

        $("#closeTrmicon").removeClass("fa-minus");
        $("#closeTrmicon").addClass("fa-plus");

        $("#cancleTrmicon").removeClass("fa-minus");
        $("#cancleTrmicon").addClass("fa-plus");

      });
    </script>   
  <?php } ?>
  <?php if (isset($_GET['trm_cancel_id'])) {?>
    <script>
      $(document).ready(function(){
        $("#openTrmDiv").addClass("collapsed-box");
        $("#closeTrmDiv").addClass("collapsed-box");

        $("#openTrmicon").removeClass("fa-minus");
        $("#openTrmicon").addClass("fa-plus");

        $("#closeTrmicon").removeClass("fa-minus");
        $("#closeTrmicon").addClass("fa-plus");
      });
    </script>   
  <?php } ?>
  <?php if (isset($_GET['trm_close_id'])) {?>
    <script>
      $(document).ready(function(){
        $("#openTrmDiv").addClass("collapsed-box");
        $("#cancelTrmDiv").addClass("collapsed-box");

        $("#openTrmicon").removeClass("fa-minus");
        $("#openTrmicon").addClass("fa-plus");

        $("#cancleTrmicon").removeClass("fa-minus");
        $("#cancleTrmicon").addClass("fa-plus");
      });
    </script>   
  <?php } ?>

  <?php if (isset($_GET['lic_active_id'])) {?>
    <script>
      $(document).ready(function(){
        $("#cancleLiceDiv").addClass("collapsed-box");

        $("#cancleLiceicon").removeClass("fa-minus");
        $("#cancleLiceicon").addClass("fa-plus");

      });
    </script>   
  <?php } ?>
  <?php if (isset($_GET['lic_cancel_id'])) {?>
    <script>
      $(document).ready(function(){
        $("#activeLicDiv").addClass("collapsed-box");

        $("#activeLicicon").removeClass("fa-minus");
        $("#activeLicicon").addClass("fa-plus");
      });
    </script>   
  <?php } ?>
  <script>
    $(function () {
      $('[data-mask]').inputmask()
      $('.select2').select2()
      $('#table_filter').DataTable({
        'drawCallback': function(settings){
          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"]').iCheck({
             checkboxClass: 'icheckbox_flat-blue'
          });
        }
      })   

    })

    function updateInd(){
      document.getElementById("btn_update").value = "Updating ...";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'updateIndividual',
            ids:  document.forms["Ind_form"]["id_ind"].value,
            stat_up:  document.forms["Ind_form"]["stat_up"].value,
            comp_up:  document.forms["Ind_form"]["comp_up"].value,
            editor:  <?php echo htmlspecialchars($_SESSION['id']) ?>     
          },
          function(data){
            $('#reciveFromIndModal').html(data);
            document.getElementById("btn_update").value = "Updated";
          });

    })

    }

    function selecter(gen,term,lise){
      document.getElementById("selectGen").selectedIndex = gen;
      document.getElementById("selectStat").selectedIndex = term;
    }

    if (<?php echo  $select_cons;?> === 0) {
      selecter(<?php if(isset($selection_ind_gen)) {echo $selection_ind_gen;}else{echo '0';};?>,<?php if(isset($selection_ind_trm)) {echo $selection_ind_trm;}else{echo '0';};?>)
    }
  </script>
  <script>
    $(document).ready(function(){
      $("body").on('click','.send_mes',function(){
        var idchek = $(this).attr('id');
        var stattabval = $('#' + idchek + '.statTab select option:selected').val();
        var comptabval = $('#' + idchek + '.compTab select option:selected').val();

        $.post("../oop/register.oop.php",{
          type: "updateIndividual",
          ids : idchek,
          stat_up: stattabval,
          comp_up: comptabval,
          editor: <?php echo $_SESSION['id']; ?>
        },function(data){
          alert(data)
        });
        
      });
    });
  </script>
  <script>
    $('body').on('ifChecked','.checkTab', function(event){

      var idchek = $(this).attr('id');
      $('#' + idchek + '.send_mes'). attr("disabled", false);
      var ff = $('#' + idchek + '.statTab').html();
      var ffs = $('#' + idchek + '.compTab').html();
      if (ff == "Learning"){
        var ffq = "Finished";
        var ffqvq = "0";
        var ffqv = "1";
      }else{
        var ffq = "Learning";
        var ffqvq = "1";
        var ffqv = "0";
      }
      if (ffs == "On Campus"){
        var ffm = "Off Campus";
        var ffmvm = "0";
        var ffmv = "1";
      }else{
        var ffm = "On Campus";
        var ffmv = "0";
        var ffmvm = "1";
      }
      if (this.checked) {

        var html = '<select class="form-control select2"><option value='+ffqvq+'>'+ff+'</option><option value='+ffqv+'>'+ffq+'</option></select>';
        var html1 = '<select class="form-control select2"><option value='+ffmvm+'>'+ffs+'</option><option value='+ffmv+'>'+ffm+'</option></select>';

        $('#' + idchek + '.statTab').html(html);
        $('#' + idchek + '.compTab').html(html1);
      }
     });
    $('body').on('ifUnchecked', '.checkTab',function(event){

        
        $('.checkTab').iCheck('uncheck');
        var idchek = $(this).attr('id');
        $('#' + idchek + '.send_mes'). attr("disabled", true);
        var html = $('#' + idchek + '.statTab select option:selected').html();
        var html1 = $('#' + idchek + '.compTab select option:selected').html();

        $('#' + idchek + '.statTab').html(html);
        $('#' + idchek + '.compTab').html(html1);
      
    });
  </script>
  <script>
    $(function () {

      $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });

      $('body').on('ifChecked', '.checkbox-toggle', function () {
          $(".all-checkbox input[type='checkbox']").iCheck("check");
      });

      $('body').on('ifUnchecked', '.checkbox-toggle', function () {
          $(".all-checkbox input[type='checkbox']").iCheck("uncheck");
      });

      if($('#checkboxtbl1023').parent('.icheckbox_flat-blue').hasClass("checked")){
        alert('heyy');
      }
    });
  </script>
</body>
</html>