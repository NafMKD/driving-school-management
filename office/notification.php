<?php
/*
from Term.php

dont forget Scripts
*/
session_start();
$title = "Notification";
$notif = "active";
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
        Notification
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-bell"></i> Notification</a></li>
      </ol>
    </section>

    
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom" style="margin-top: 10px;">
            <ul class="nav nav-tabs">
              <li class="<?php if(isset($_GET['term'])){echo "active";} ?>"><a href="notification.php?term=yes" >Term</a></li>
              <li class="<?php if(isset($_GET['lice'])){echo "active";} ?>"><a href="notification.php?lice=yes" >License Type</a></li>
              <li class="<?php if(isset($_GET['ind'])){echo "active";} ?>"><a href="notification.php?ind=yes&gen=0/0&trm=0/0&lt=0/0" >Individual</a></li>
              <li class="<?php if(isset($_GET['man'])){echo "active";} ?>"><a href="notification.php?man=yes" >Manual</a></li>
              <li class="<?php if(isset($_GET['appr'])){echo "active";} ?>"><a href="notification.php?appr=yes" >Approve</a></li>
              <li class="<?php if(isset($_GET['hist'])){echo "active";} ?>"><a href="notification.php?hist=yes" >History</a></li>
            </ul>
            <div class="tab-content">
            <?php if (isset($_GET['term'])) { ?>
              <!-- Tab Term -->
              <div >
                <section id="notification">
                  <h4 class="page-header">Send Exam Notification By Term</h4>

                  <div id="termTabDiv">
                    <?php
                      if (isset($_GET['trm'])) {
                        $term_get = $_GET['trm'];
                        $no_get = $_GET['no_of'];
                        $recived_arry = $obj_fetch->notificationByTerm($term_get,$no_get);
                        if(empty($recived_arry)){
                          $errmsgterm = "There Is no Result";
                        }
                        
                      }
                     ?>
                     <?php if (!isset($_GET['filter'])) {?>
                      <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                        <div class="row" >                          
                          <div class="col-md-2"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="term" value="yes" hidden> 
                              <label>Term</label>
                              <select class="form-control select2" name="trm" id="selectTrm" required>
                                <option value="0">-- All Terms --</option>
                                <?php 
                                $fetcher_active = $obj_fetch->fetchTerm("Closed");
                                foreach ($fetcher_active as $key_1 ) {
                                  ?>
                                <option value="<?php echo htmlspecialchars($key_1['id']);?>" ><?php echo htmlspecialchars($key_1['name']);?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Number Of Students</label>
                              <input type="text" class="form-control" name="no_of" required>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <center>
                              <div style="margin-top: 1%; ">
                                <input type="submit" class="btn btn-primary" id="filter_for_term" onclick="return filterForTerm()" name="filter" value="Filter">
                              </div>
                            </center>
                          </div>
                        </div>                 
                      </form>
                      <hr>
                    <?php }?>
                    <?php if(isset($errmsgterm)){?>
                      <div class="row">
                        <div class='col-md-2'></div>
                        <div class='col-md-8'>
                          <div class='alert alert-danger'>
                            <center>
                                    <h4><i class='icon fa fa-times-circle'></i> Alert!</h4>
                                    <?php
                                    $name_of_term = $obj_fetch->fetchTermId($_GET['trm']);
                                     ?>
                                    There is No Student Who Full Fill The Requirment In <b><?php echo htmlspecialchars($name_of_term['name']) ?> </b> , Please Go To Manual Filter Tab For More Filtering Option!
                                    <br>
                                  </center>
                              </div>
                              <div>
                                <center>
                                  <a href='notification.php?term=yes'>
                                          <button type='button' class='btn btn-danger' >Reload</button>
                                    </a>
                                  </center>   
                              </div>
                        </div>
                        <div class='col-md-2'></div>
                      </div>
                    <?php } ?>
                    <?php if(!isset($errmsgterm) && isset($_GET['filter'])){?>
                      <form style="margin-bottom:  40px;margin-top:  0px;" name="Term_msg_form">
                        <div class="row" id="reciveFromTerm">                          
                          <div class="col-md-1"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="term" value="yes" hidden> 
                              <label >Id:</label>
                              <input type="text" class="form-control" name="stud_id_send" value="<?php foreach($recived_arry as $key => $value){echo "/".$value;} ?>" readonly>  
                            </div>

                            <div class="form-group">
                              <input type="text" name="term" value="yes" hidden> 
                              <label >Phone Numbers:</label>
                              <input type="text" class="form-control" name="stud_phone_send" value="<?php foreach($recived_arry as $key => $value){
                                $fetchster = $obj_fetch->fetchStudentAddId($value);
                                echo "/".$fetchster[0]['phone'];
                              } ?>" readonly>  
                            </div>

                            <div class="form-group">
                              <label >Message:</label>
                              <textarea class="form-control" name="stud_mess_send"></textarea>  
                            </div>

                            <center>
                              <div style="margin-top: 1%; "> 
                                <input type="button" id="send_for_term" value="Send" class="btn btn-primary" onclick="return messgTerm()">
                              </div>
                            </center>
                          </div>
                          <div class="col-md-4">
                          </div>

                          <div class="col-md-12">
                            
                          </div>
                        </div>                 
                      </form>
                      <hr>
                    <?php }?>
                    <table id="table_filter" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Full Name</th>
                          <th>Term</th>
                          <th>License Type</th>
                          <th>Phone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if(isset($recived_arry)){
                          $r = array();
                          $cnt = 1;
                          for ($i=0; $i <count($recived_arry) ; $i++) { 
                            $r[] = $obj_fetch->fetchStudentId($recived_arry[$i]);
                          }
                          foreach ($r as $key => $value) {
                            $trm_show = $obj_fetch->fetchTermId($value[0]['term_lic']);
                            $lt_show = $obj_fetch->fetchLicenseId($value[0]['lt']);
                            $mb_show = $obj_fetch->fetchStudentAddId($value[0]['id']);
                          
                        ?>
                        <tr>
                          <td><?php echo $cnt; ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($value[0]['name']); ?> <?php echo htmlspecialchars($value[0]['fname']); ?> <?php echo htmlspecialchars($value[0]['gname']); ?></td>
                          <td><?php echo htmlspecialchars($trm_show['name']); ?></td>
                          <td><?php echo htmlspecialchars($lt_show['name']); ?></td>
                          <td><?php echo htmlspecialchars($mb_show[0]['phone']); ?></td>
                        </tr>
                        <?php $cnt = $cnt+1;}}?>
                      </tbody>
                    </table>
                  </div>
                </section>

              </div>
              <!-- ./Tab Term -->
            <?php } elseif(isset($_GET['lice'])){?>
              <!-- Tab License -->
              <div>
                <section id="license">
                  <h4 class="page-header">Send Exam Notification By License Type</h4>

                  <div id="liceTabDiv">
                    <?php
                      if (isset($_GET['lice_ty'])) {
                        $lice_get = $_GET['lice_ty'];
                        $no_get = $_GET['no_of'];
                        $recived_arry = $obj_fetch->notificationByLice($lice_get,$no_get);
                        if(empty($recived_arry)){
                          $errmsglice = "There Is no Result";
                        }
                      }
                     ?>
                     <?php if (!isset($_GET['filter_lice'])) {?>
                      <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                        <div class="row" >                          
                          <div class="col-md-2"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="lice" value="yes" hidden> 
                              <label>License Type</label>
                              <select class="form-control select2" name="lice_ty" id="selectlice" required>
                                <option value="0">-- All License Types --</option>
                                <?php 
                                $fetcher_active = $obj_fetch->fetchLicense("Active");
                                foreach ($fetcher_active as $key_1 ) {
                                  ?>
                                <option value="<?php echo htmlspecialchars($key_1['id']);?>" ><?php echo htmlspecialchars($key_1['name']);?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Number Of Students</label>
                              <input type="text" class="form-control" name="no_of" required>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <center>
                              <div style="margin-top: 1%; ">
                                <input type="submit" class="btn btn-primary" id="filter_for_lice" onclick="return filterForLice()" name="filter_lice" value="Filter">
                              </div>
                            </center>
                          </div>
                        </div>                 
                      </form>
                      <hr>
                    <?php }?>
                    <?php if(isset($errmsglice)){?>
                      <div class="row">
                        <div class='col-md-2'></div>
                        <div class='col-md-8'>
                          <div class='alert alert-danger'>
                            <center>
                                    <h4><i class='icon fa fa-times-circle'></i> Alert!</h4>
                                    <?php
                                    $name_of_term = $obj_fetch->fetchLicenseId($_GET['lice_ty']);
                                     ?>
                                    There is No Student Who Full Fill The Requirment In <b><?php echo htmlspecialchars($name_of_term['name']) ?> </b> , Please Go To Manual Filter Tab For More Filtering Option!
                                    <br>
                                  </center>
                              </div>
                              <div>
                                <center>
                                  <a href='notification.php?lice=yes'>
                                          <button type='button' class='btn btn-danger' >Reload</button>
                                    </a>
                                  </center>   
                              </div>
                        </div>
                        <div class='col-md-2'></div>
                      </div>
                    <?php } ?>
                    <?php if(!isset($errmsglice) && isset($_GET['filter_lice'])){?>
                      <form style="margin-bottom:  40px;margin-top:  0px;" name="Lice_msg_form">
                        <div class="row" id="reciveFromLice">                          
                          <div class="col-md-1"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="term" value="yes" hidden> 
                              <label >Id:</label>
                              <input type="text" class="form-control" name="stud_id_send_lice" value="<?php foreach($recived_arry as $key => $value){echo "/".$value;} ?>" readonly>  
                            </div>

                            <div class="form-group">
                              <input type="text" name="term" value="yes" hidden> 
                              <label >Phone Numbers:</label>
                              <input type="text" class="form-control" name="stud_phone_send_lice" value="<?php foreach($recived_arry as $key => $value){
                                $fetchster = $obj_fetch->fetchStudentAddId($value);
                                echo "/".$fetchster[0]['phone'];
                              } ?>" readonly>  
                            </div>

                            <div class="form-group">
                              <label >Message:</label>
                              <textarea class="form-control" name="stud_mess_send_lice"></textarea>  
                            </div>

                            <center>
                              <div style="margin-top: 1%; ">
                                <input type="button" id="send_for_lice" value="Send" class="btn btn-primary" onclick="return messgLice()">
                              </div>
                            </center>
                          </div>
                          <div class="col-md-4">
                          </div>

                          <div class="col-md-12">
                            
                          </div>
                        </div>                 
                      </form>
                      <hr>
                    <?php }?>
                    <table id="table_filter" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Full Name</th>
                          <th>Term</th>
                          <th>License Type</th>
                          <th>Phone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if(isset($recived_arry)){
                          $r = array();
                          $cnt = 1;
                          for ($i=0; $i <count($recived_arry) ; $i++) { 
                            $r[] = $obj_fetch->fetchStudentId($recived_arry[$i]);
                          }
                          foreach ($r as $key => $value) {
                            $trm_show = $obj_fetch->fetchTermId($value[0]['term_lic']);
                            $lt_show = $obj_fetch->fetchLicenseId($value[0]['lt']);
                            $mb_show = $obj_fetch->fetchStudentAddId($value[0]['id']);
                          
                        ?>
                        <tr>
                          <td><?php echo $cnt; ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($value[0]['name']); ?> <?php echo htmlspecialchars($value[0]['fname']); ?> <?php echo htmlspecialchars($value[0]['gname']); ?></td>
                          <td><?php echo htmlspecialchars($trm_show['name']); ?></td>
                          <td><?php echo htmlspecialchars($lt_show['name']); ?></td>
                          <td><?php echo htmlspecialchars($mb_show[0]['phone']); ?></td>
                        </tr>
                        <?php $cnt = $cnt+1;}}?>
                      </tbody>
                    </table>
                  </div>
                </section>
              </div>
              <!-- ./Tab License -->
            <?php } elseif(isset($_GET['ind'])){?>
              <!-- Tab Individual -->
              <div >
                <section id="ind">
                  <h4 class="page-header">Send Notification Individualy</h4>

                  <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                    <input type="text" name="ind" value="Filter" hidden>
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
                            <input type="submit" class="btn btn-primary" id="filter_for_ind" onclick="return filterForInd()"  name="ind_filter" value="Filter">
                          </div>
                        </center>
                      </div>
                    </div>                 
                  </form>
                  <hr>
                  <table id="table_filter" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>ID No.</th>
                      <th>Full Name</th>
                      <th>Gender</th>
                      <th>Term</th>
                      <th>License Type</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(isset($_GET['gen'])&& isset($_GET['trm'])  && isset($_GET['lt'])){
                        if ($_GET['gen'] == '0/0' && $_GET['trm'] == '0/0' && $_GET['lt'] == '0/0' ) {
                        $array = $obj_fetch->fetchStudent("Now");
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
                           
                      ?>
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo htmlspecialchars($key['id']); ?></td>
                        <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                        <td><?php echo htmlspecialchars($gen_show); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                        <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                        <td ><?php echo htmlspecialchars($phone); ?></td>
                        <td ><button class="btn btn-primary btn-xs send_mes">Send</button></td>
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
                            $query .= "AND gender = '$gender[0]'";
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
                            $phone = $obj_fetch->fetchStudentAddId($key['id'])[0]['phone'];

                        ?>
                        <tr>
                          <td><?php echo $cnt; ?></td>
                          <td><?php echo htmlspecialchars($key['id']); ?></td>
                          <td style="text-transform: capitalize;"><?php echo $key['name']; ?> <?php echo $key['fname']; ?> <?php echo $key['gname']; ?></td>
                          <td><?php echo htmlspecialchars($gen_show); ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($trm_show['name']); ?></td>
                          <td style="text-transform: capitalize;"><?php echo htmlspecialchars($lt_show['name']); ?></td>
                          <td ><?php echo htmlspecialchars($phone); ?></td>
                          <td ><button class="btn btn-primary btn-xs send_mes" >Send</button></td>
                        </tr>  
                        <?php $cnt=$cnt+1;}}
                      }?>
                    </tbody>
                  </table>
                  
                </section>
              </div>
              <!-- ./Tab Individual -->
            <?php } elseif(isset($_GET['man'])){?>
              <!-- Tab Manual -->
              <div>
                <section id="Manual">
                  <h4 class="page-header">Send Notification Manually</h4>

                  <div id="manTabDiv">
                      <form style="margin-bottom:  40px;margin-top:  0px;" name="Filter_form">
                        <div class="row" >                          
                          <div class="col-md-2"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="man" value="yes" hidden> 
                              <label>Term</label>
                              <select class="form-control select2" name="trm_ty_man" id="selectmatrm" required>
                                <option value="0">-- All Terms --</option>
                                <?php
                                $term_all = $obj_fetch->fetchTerm("All");
                                foreach ($term_all as $key) {?>
                                  <option value="<?php echo ucfirst($key['id']); ?>"><?php echo ucfirst($key['name']); ?></option>
                                 <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Number Of Students</label>
                              <select  class="form-control select2" name="opt_ty_man" id="selectmanopt" required>
                                <option>-- none selected</option>
                                <option value="1">All Stud.</option>
                                <option value="2">Not Paid Stud.</option>
                                <option value="3">Half paid Stud.</option>
                                <option value="4">Noting paid Stud.</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <center>
                              <div style="margin-top: 1%; ">
                                <input type="submit" class="btn btn-primary" id="filter_for_lice" onclick="return filterForLice()" name="filter_man" value="Filter">
                              </div>
                            </center>
                          </div>
                        </div>                 
                      </form>
                    <hr>
                    <table id="table_filter" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Full Name</th>
                          <th>Term</th>
                          <th>License Type</th>
                          <th>Phone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </section>
              </div>
              <!-- ./Tab Manual -->
            <?php } elseif(isset($_GET['appr'])){?>
              <!-- Tab approve -->
              <div >
                <section id="new">
                  <h4 class="page-header">Approve And Send Message</h4>
                  <?php if (isset($_GET['t_id'])) {
                    $obj_fetch->messageSender($_GET['t_id'],$_SESSION['id']);
                  ?>
                    <div class="row" id="reciveFromApp">
                      <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="alert alert-success">
                            <center>
                                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                    Message Seccussfuly Sented, Please Reload!
                                    <br>
                                  </center>
                              </div>
                              <div>
                                <center>
                                  <a href="notification.php?appr=yes">
                                          <button type="button" class="btn btn-success" >Relode</button>
                                    </a>
                                  </center>   
                              </div>
                        </div>
                        <div class='col-md-2'></div>
                    </div>
                  <?php } ?>
                  <?php if (isset($_GET['delete'])) {
                    $obj_fetch->messageDelete($_GET['delete']);
                  ?>
                    <div class="row" id="reciveFromApp">
                      <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="alert alert-success">
                            <center>
                                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                    Message Seccussfuly Deleted, Please Reload!
                                    <br>
                                  </center>
                              </div>
                              <div>
                                <center>
                                  <a href="notification.php?appr=yes">
                                          <button type="button" class="btn btn-success" >Relode</button>
                                    </a>
                                  </center>   
                              </div>
                        </div>
                        <div class='col-md-2'></div>
                    </div>
                  <?php } ?>
                  <table id="table_filter" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>T. ID</th>
                      <th>ID No.S</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Date(Time) Inserted</th>
                      <th>Employe Name </th>
                      <th style="width: 70px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $message_ricieved_array = $obj_fetch->messageFetch("NotSended");
                      $cnt = 1;

                      foreach ($message_ricieved_array as $key ) {
                        

                        $date_time_out =$obj_converter->toEth($key['date'])."(".$key['time'].")";
                        $empname = $obj_fetch->employeFetchId($key['editor'])[0]['username'];
                     
                      ?>
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo htmlspecialchars($key['t_id']); ?></td>
                        <td><?php echo htmlspecialchars($key['id']); ?></td>
                        <td><?php echo htmlspecialchars($key['phone']); ?></td>
                        <td><?php echo $key['mess']; ?> </td>
                        <td ><?php echo htmlspecialchars($date_time_out); ?></td>
                        <td ><?php echo htmlspecialchars($empname); ?></td>
                        <td >
                          <button class="btn btn-primary btn-xs edit_app_mes"><i class="fa fa-edit"></i></button>
                          <a href="notification.php?appr=yes&t_id=<?php echo htmlspecialchars($key['t_id']); ?>" onclick="return confirm('Are you sure you want to Send this Message?');">
                            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                          </a> 
                          <a href="notification.php?appr=yes&delete=<?php echo $key['t_id']?>">
                            <button class="btn btn-danger btn-xs modal_edit" onclick="return confirm('Are You Sure You Went To Delete ?');">
                              <i class="fa fa-trash"></i> 
                            </button>
                          </a>                         
                        </td>
                      </tr>
                      <?php $cnt = $cnt+1;} ?>
                    </tbody>
                  </table>                  
                </section>
              </div>
              <!-- ./Tab approve -->
            <?php } elseif(isset($_GET['hist'])){?>
              <!-- Tab approve -->
              <div >
                <section id="new">
                  <h4 class="page-header">Approve And Send Message</h4>
                  <?php if(isset($_GET['t_id_hist'])){ 
                    $array_of_message = $obj_fetch->messageById($_GET['t_id_hist']);
                    if ($array_of_message[0]['type'] == 1) {
                      $type_out = "Filtered From Term";
                    }elseif ($array_of_message[0]['type'] == 2) {
                      $type_out = "Filtered From License Type";
                    }elseif ($array_of_message[0]['type'] == 3) {
                      $type_out = "Individually";
                    }
                    $date_out =$obj_converter->toEth($array_of_message[0]['date']);
                    $time_out = $array_of_message[0]['time'];
                    $date_out_send =$obj_converter->toEth($array_of_message[0]['send_date']);
                    $time_out_send = $array_of_message[0]['send_time'];
                    $empname = $obj_fetch->employeFetchId($array_of_message[0]['editor'])[0]['username'];
                    ?>
                    <div class="row">
                      <div class="col-md-6">

                        <label class="col-sm-4 control-label">Full Massage :</label>
                          <textarea style="width: 312px;" class="form-control" readonly><?php echo htmlspecialchars($array_of_message[0]['mess']); ?></textarea>

                        <label class="col-sm-3 control-label">Type :</label>
                          <p style="text-transform: capitalize;"><?php echo htmlspecialchars($type_out); ?></p>

                        <label class="col-sm-4 control-label">Date Inserted :</label>
                          <p ><?php echo htmlspecialchars($date_out); ?></p>

                        <label class="col-sm-4 control-label">Time Inserted :</label>
                          <p ><?php echo htmlspecialchars($time_out); ?></p>

                      </div>

                      <div class="col-md-6">

                        <label class="col-sm-3 control-label">Send Date :</label>
                          <p style="text-transform: capitalize;"><?php echo htmlspecialchars($date_out_send); ?></p>

                        <label class="col-sm-3 control-label">Send Time :</label>
                          <p style="text-transform: capitalize;"><?php echo htmlspecialchars($time_out_send); ?></p>

                        <label class="col-sm-3 control-label">Sender :</label>
                          <p style="text-transform: capitalize;"><?php echo htmlspecialchars($empname); ?></p>

                        <a href='notification.php?hist=yes' style="margin-left: 15%;">
                          <button type='button' class='btn btn-info btn-sm' >Reload</button>
                        </a>

                      </div>
                    </div>
                    <hr>
                  <?php }?>
                  <table id="table_filter" class="table table-bordered table-striped">
                    <?php if(!isset($_GET['t_id_hist'])){?>
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>T. ID</th>
                      <th>ID No.S</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Type</th>
                      <th>Date(Time) Inserted</th>
                      <th>Employe Name </th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $message_ricieved_array = $obj_fetch->messageFetch("Sended");
                      $cnt = 1;

                      foreach ($message_ricieved_array as $key ) {
                        if ($key['type'] == 1) {
                          $type_out = "Filtered From Term";
                        }elseif ($key['type'] == 2) {
                          $type_out = "Filtered From License Type";
                        }elseif ($key['type'] == 3) {
                          $type_out = "Individually";
                        }

                        $date_time_out =$obj_converter->toEth($key['date'])."(".$key['time'].")";
                        $empname = $obj_fetch->employeFetchId($key['editor'])[0]['username'];
                     
                      ?>
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo htmlspecialchars($key['t_id']); ?></td>
                        <td><?php echo htmlspecialchars($key['id']); ?></td>
                        <td><?php echo htmlspecialchars($key['phone']); ?></td>
                        <td><?php echo $key['mess']; ?> </td>
                        <td ><?php echo htmlspecialchars($type_out); ?></td>
                        <td ><?php echo htmlspecialchars($date_time_out); ?></td>
                        <td ><?php echo htmlspecialchars($empname); ?></td>
                        <td >
                          <a href="notification.php?hist=yes&t_id_hist=<?php echo htmlspecialchars($key['t_id']); ?>" >
                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Detail</button>
                          </a>                          
                        </td>
                      </tr>
                      <?php $cnt = $cnt+1;}}else{ ?>
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if ($array_of_message[0]['type'] != 3) {
                              $idas = explode("/",$array_of_message[0]['id']);
                              $cnt = 1;
                              $names_of= array();
                              $phones_of = array();
                              for ($i=1; $i <count($idas) ; $i++) { 
                                $names_of[$idas[$i]] = $obj_fetch->fetchStudentId($idas[$i])[0]['name']." ".$obj_fetch->fetchStudentId($idas[$i])[0]['fname']." ".$obj_fetch->fetchStudentId($idas[$i])[0]['gname'];
                                $phones_of[$idas[$i]] = $obj_fetch->fetchStudentAddId($idas[$i])[0]['phone'];

                              }
                              foreach ($names_of as $key => $value) {?>
                          <tr>
                            <td><?php echo $cnt; ?></td>
                            <td style="text-transform: capitalize;"><?php echo htmlspecialchars($value); ?></td>
                            <td><?php echo htmlspecialchars($phones_of[$key]); ?></td>
                          </tr>
                          <?php $cnt = $cnt + 1;}}else{
                            $names_of_lit = $obj_fetch->fetchStudentId($array_of_message[0]['id'])[0]['name']." ".$obj_fetch->fetchStudentId($array_of_message[0]['id'])[0]['fname']." ".$obj_fetch->fetchStudentId($array_of_message[0]['id'])[0]['gname'];
                            ?>
                            <tr>
                            <td>1</td>
                            <td style="text-transform: capitalize;"><?php echo htmlspecialchars($names_of_lit); ?></td>
                            <td><?php echo htmlspecialchars($array_of_message[0]['phone']); ?></td>
                          </tr>
                          <?php }?>
                        </tbody>
                      <?php }?>
                    </tbody>
                  </table>                  
                </section>
              </div>
              <!-- ./Tab approve -->
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
                     <label>Phone:</label>
                     <input type="text" class="form-control" id="phone_ind" readonly>
                   </div>

                   <div class="form-group">
                     <label>Message:</label>
                     <textarea class="form-control" name="text_ind"></textarea>
                   </div>
                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <input type="button" id="send_for_ind" value="Send" class="btn btn-primary" onclick="return messgIndv()">
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- ./modal Send-->

    <!-- modal Edit -->
    <div class="modal fade" id="modal-Edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Send Message</h4>
          </div>
          <div class="modal-body">
            <form name="App_edit_form">
               <div class="row" id="reciveFromEditModal">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                  <input type="text" name="t_id_app" id="t_id_app" hidden>
                   <div class="form-group">
                     <label>Id:</label>
                     <input type="text" class="form-control" id="id_app" readonly>
                   </div>

                   <div class="form-group">
                     <label>Phone:</label>
                     <input type="text" class="form-control" id="phone_app" readonly>
                   </div>

                   <div class="form-group">
                     <label>Message:</label>
                     <textarea class="form-control" id="text_app" name="text_app"></textarea>
                   </div>
                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <input type="button" id="upd_for_app" value="Update" class="btn btn-primary" onclick="return messgAppUpdate()">
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- ./modal Edit-->
  </div>


  <?php include 'includes/js.inc.php';?>
    <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- page script -->
  <script>
    $(function () {
      $('#table_filter').DataTable()
      $('.select2').select2()
    })
    function messgTerm(){
      document.getElementById("send_for_term").value="Sending ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'messageSend',
            ids:  document.forms["Term_msg_form"]["stud_id_send"].value,
            phone:  document.forms["Term_msg_form"]["stud_phone_send"].value,
            msg:  document.forms["Term_msg_form"]["stud_mess_send"].value,
            typeof:  "1",
            editor:  <?php echo htmlspecialchars($_SESSION['id']) ?>     
          },
          function(data){
            $('#reciveFromTerm').html(data);
          });

    })

    }

    function messgLice(){
      document.getElementById("send_for_lice").value="Sending ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'messageSend',
            ids:  document.forms["Lice_msg_form"]["stud_id_send_lice"].value,
            phone:  document.forms["Lice_msg_form"]["stud_phone_send_lice"].value,
            msg:  document.forms["Lice_msg_form"]["stud_mess_send_lice"].value,
            typeof:  "2",
            editor:  <?php echo htmlspecialchars($_SESSION['id']) ?>     
          },
          function(data){
            $('#reciveFromLice').html(data);
          });

    })

    }

    function messgIndv(){
      document.getElementById("send_for_ind").value="Sending ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'messageSend',
            ids:  document.forms["Ind_form"]["id_ind"].value,
            phone:  document.forms["Ind_form"]["phone_ind"].value,
            msg:  document.forms["Ind_form"]["text_ind"].value,
            typeof:  "3",
            editor:  <?php echo htmlspecialchars($_SESSION['id']) ?>     
          },
          function(data){
            $('#reciveFromIndModal').html(data);
            document.getElementById('send_for_ind').parentNode.removeChild(document.getElementById('send_for_ind'));
          });

    })

    }

    function messgAppUpdate(){
      document.getElementById("upd_for_app").value="Updating ..... ";
      $(document).ready(function(){

        $.post("../oop/register.oop.php",
          {
            type:'messageUpdate',
            t_id:  document.forms["App_edit_form"]["t_id_app"].value,
            msg:  document.forms["App_edit_form"]["text_app"].value,
            editor:  <?php echo htmlspecialchars($_SESSION['id']) ?>     
          },
          function(data){
            $('#reciveFromEditModal').html(data);
            document.getElementById('upd_for_app').parentNode.removeChild(document.getElementById('upd_for_app'));
          });

    })

    }

    function selecter(gen,term,lise){
      document.getElementById("selectGen").selectedIndex = gen;
      document.getElementById("selectTrm").selectedIndex = term;
      document.getElementById("selectLt").selectedIndex = lise;
    }

    if (<?php echo  $select_cons;?> === 0) {
      selecter(<?php if(isset($selection_ind_gen)) {echo $selection_ind_gen;}else{echo '0';};?>,<?php if(isset($selection_ind_trm)) {echo $selection_ind_trm;}else{echo '0';};?>,<?php if(isset($selection_ind_lt)) {echo $selection_ind_lt;}else{echo '0';};?>)
    }
    document.getElementById("selectmanopt").selectedIndex = <?php if(isset($_GET['opt_ty_man'])) {echo $_GET['opt_ty_man'];}else{echo '0';};?>;
  </script>
  <script>
    $(document).ready(function(){
      $("body").on('click','.send_mes',function(){
        $('#modal-send').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        console.log(data);

        $('#id_ind').val(data[1]);
        $('#name_ind').val(data[2]);
        $('#phone_ind').val(data[6]);
      });
    });

    $(document).ready(function(){
      $("body").on('click','.edit_app_mes',function(){
        $('#modal-Edit').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        console.log(data);

        $('#t_id_app').val(data[1]);
        $('#id_app').val(data[2]);
        $('#phone_app').val(data[3]);
        $('#text_app').val(data[4]);
      });
    });
  </script>
  <script>
    function filterForLice() {
      document.getElementById("filter_for_lice").value="Filtering ..... ";
    }
    function filterForTerm() {
     document.getElementById("filter_for_term").value="Filtering ..... ";
    }
    function filterForInd() {
     document.getElementById("filter_for_ind").value="Filtering ..... ";
    }
  </script>
</body>
</html>