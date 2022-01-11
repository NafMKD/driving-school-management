<?php 
if(!$_SESSION['id'] || $_SESSION['id'] == ""){
  header("location: ../");
}
?>

<header class="main-header">
    <a href="" class="logo">
      <span class="logo-lg">OFFICE</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu" style="margin-right: 5%;">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <?php 
               $recived_not = $obj_fetch->calculatorAnnounceDays();
               $for_count = array();
               foreach($recived_not as $key => $value){
                if($value != "goodToGo"){
                  $for_count[$key] = $value;
                }
               }
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php if(count($for_count)>0){ ?><span class="label label-warning"><?php echo count($for_count); ?></span><?php } ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">System Notification (<em class="text-danger"><?php echo count($for_count); ?></em>)</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  foreach ($for_count as $key => $value) {
                    $id_for_stud = $obj_fetch->fetchTermId($key);
                  ?>
                  <li>
                    <a href="term.php?id=<?php echo $key; ?>">
                      <i class="fa fa-times text-red"></i> <?php echo "<b>".ucfirst($id_for_stud['name'])."</b>"; ?> is Complited
                    </a>
                  </li>
                  <?php }?>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <li class="dropdown messages-menu">
            <a href="../logout.php">
              <i class="fa fa-sign-out text-danger"></i> Logout
            </a>
          </li>
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              En
            </a>
            <ul class="dropdown-menu" style="max-width: 15px;" >
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      Amh
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      Oro
                    </a>
                  </li> 

                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <h4 class="text-center" style="color: white;"><?php echo $_SESSION['id']; ?></h4>
        <pre >Today : - <?php echo $obj_converter->Now(); ?></pre>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="<?php if(isset($home)){echo $home;}?>">
          <a href="home.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>

        <li class="<?php if(isset($stud)){echo $stud;}?> treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($sreg)){echo $sreg;}?>"><a href="sregister.php"><i class="fa fa-pencil-square-o"></i> <span> Student Registrar</span></a></li>
            <li class="<?php if(isset($stud_list)){echo $stud_list;}?>"><a href="student.php?gen=0/0&trm=0/0&lt=0/0"><i class="fa fa-list"></i> <span> Student List</span></a></li>
            <li class="<?php if(isset($fee_cl)){echo $fee_cl;}?>"><a href="fee.php"><i class="fa fa-dollar"></i> <span> Student Fee</span></a></li>
            <li class="<?php if(isset($stat_cl)){echo $stat_cl;}?>"><a href="studstat.php?term=yes"><i class="fa fa-folder-open"></i> <span> Student Status</span></a></li>
          </ul>
        </li>

        <li class="<?php if(isset($term)){echo $term;}?>">
          <a href="term.php">
            <i class="fa fa-newspaper-o"></i> <span>Terms</span>
          </a>
        </li>

        <li class="<?php if(isset($cors)){echo $cors;}?>">
          <a href="license.php">
            <i class="fa fa-credit-card"></i> <span>License</span>
          </a>
        </li>

        <li class="<?php if(isset($cl_cl)){echo $cl_cl;}?>">
          <a href="class.php">
            <i class="fa fa-building"></i> <span>Classes</span>
          </a>
        </li>

        <li class="<?php if(isset($notif)){echo $notif;}?>">
          <a href="notification.php?term=yes">
            <i class="fa fa-bell-o"></i> <span>Notification</span>
          </a>
        </li>

        <li class="<?php if(isset($emp)){echo $emp;}?> treeview">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($ereg)){echo $ereg;}?>"><a href="eregister.php"><i class="fa fa-pencil-square-o"></i> <span> Employee Registrar</span></a></li>
            <li class="<?php if(isset($emp_li)){echo $emp_li;}?>"><a href="employee.php?all"><i class="fa fa-list"></i> <span> Employee List</span></a></li>
            <li class="<?php if(isset($payrol_cl)){echo $payrol_cl;}?>"><a href="payrole.php"><i class="fa fa-dollar"></i> <span> PayRol</span></a></li>
          </ul>
        </li>

        <li class=" <?php if(isset($car_cl)){echo $car_cl;} ?> treeview">
          <a href="#">
            <i class="fa fa-car"></i> <span>Cars</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($car_reg)){echo $car_reg;} ?>"><a href="cregistrar.php"><i class="fa fa-pencil-square-o"></i> Car Registrar</a></li>
            <li class="<?php if(isset($car_li)){echo $car_li;} ?>"><a href="carlist.php"><i class="fa fa-list"></i> Car List</a></li>
            <li class="<?php if(isset($car_cost)){echo $car_cost;} ?> treeview">
              <a href="#"><i class="fa fa-dollar"></i> Car Costs
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($car_pet)){echo $car_pet;} ?>"><a href="carpetrol.php"><i class="fa fa-google-wallet"></i> Petrol Cost</a></li>
                <li class="<?php if(isset($car_main)){echo $car_main;} ?>"><a href="carmain.php"><i class="fa fa-wrench"></i> Maintenance Cost</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="<?php if(isset($prof)){echo $prof;}?> treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($info)){echo $info;}?>"><a href="info.php"><i class="fa fa-reorder"></i> <span> Full Info.</span></a></li>
            <li class="<?php if(isset($acc)){echo $acc;}?>"><a href="acc.php"><i class="fa fa-wrench"></i> <span> Account Managment</span></a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
