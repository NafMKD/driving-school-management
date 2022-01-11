<?php
session_start();
$title = "Home";
$home = "active";
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


  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      </ol>
    </section>

    
    <section class="content">

      <div class="row" style="margin-top: 2%;">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>
            <?php 
              $student_now = count($obj_fetch->fetchStudent("Now"));
              $student_comp = count($obj_fetch->fetchStudent("Finished"));

              $term_now = count($obj_fetch->fetchTerm("Closed")) + count($obj_fetch->fetchTerm("Open"));
              $term_comp = count($obj_fetch->fetchTerm("Canceled"));

              $lice_now = count($obj_fetch->fetchLicense("Active"));
              $lice_comp = count($obj_fetch->fetchLicense("Canceled"));

              $class_now = count($obj_fetch->fetchClass("Active"));
              $class_comp = count($obj_fetch->fetchClass("Deactive"));
            ?>
            <div class="info-box-content">
              <span class="info-box-text">Studentes (NOW)</span>
              <span class="info-box-number"><?php echo htmlspecialchars($student_now); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-sign-out"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Students (Complited)</span>
              <span class="info-box-number"><?php echo htmlspecialchars($student_comp); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-info"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Terms </span>
              <span class="info-box-number"><?php echo htmlspecialchars($term_now); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-info-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Complited Terms</span>
              <span class="info-box-number"><?php echo htmlspecialchars($term_comp); ?></span>
            </div>
          </div>
        </div>




        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active License</span>
              <span class="info-box-number"><?php echo htmlspecialchars($lice_now); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Paused License</span>
              <span class="info-box-number"><?php echo htmlspecialchars($lice_comp); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Classes </span>
              <span class="info-box-number"><?php echo htmlspecialchars($class_now); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Paused Classes</span>
              <span class="info-box-number"><?php echo htmlspecialchars($class_comp); ?></span>
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">Closed Term Status</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              

              <div class="row">
                <div class="col-md-12">

                  <div class="chart">
                    <canvas id="closedTrmStat" height="280"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">Open Term Registerd Students</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              

              <div class="row">
                <div class="col-md-12">

                  <div class="chart">
                    <canvas id="openTrmRS" height="280"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">Closed Term Registerd Students</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              

              <div class="row">
                <div class="col-md-12">

                  <div class="chart">
                    <canvas id="closeTrmRS" height="280"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">License Catagorized </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              

              <div class="row">
                <div class="col-md-12">

                  <div class="chart">
                    <canvas id="liceCatRS" height="280"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>

      </div>

    </section>
  </div>

  <?php include 'includes/js.inc.php';?>

<?php 
  $arr = $obj_fetch->calculatorForHomeDays("Closed");
  $main_arr = array();
  $class_arr = array();
  $class_arr_br = array();
  foreach ($arr as $key => $value) {
    $naem = $obj_fetch->fetchTermId($key)['name'];
    $main_arr[$naem] = $value;
  }
  foreach ($main_arr as $key => $value) {
    if ($value < 20) {
      $color_dis = "rgba(245, 105, 84, 0.3)";
    }elseif ($value > 20 && $value < 40) {
      $color_dis = "rgba(243, 156, 18, 0.3)";
    }elseif ($value > 40 && $value < 60) {
      $color_dis = "rgba(60, 141, 188, 0.3)";
    }elseif ($value > 60 && $value < 80) {
      $color_dis = "rgba(0, 192, 239, 0.3)";
    }elseif ($value > 80 && $value < 100) {
      $color_dis = "rgba(0, 166, 90, 0.3)";
    }elseif ($value > 100) {
      $color_dis = "rgba(204, 51, 0, 1)";
    }
    $class_arr[$key] = $color_dis; 
  }

  foreach ($main_arr as $key => $value) {
    if ($value < 20) {
      $color_dis = "rgba(245, 105, 84, 1)";
    }elseif ($value > 20 && $value < 40) {
      $color_dis = "rgba(243, 156, 18, 1)";
    }elseif ($value > 40 && $value < 60) {
      $color_dis = "rgba(60, 141, 188, 1)";
    }elseif ($value > 60 && $value < 80) {
      $color_dis = "rgba(0, 192, 239, 1)";
    }elseif ($value > 80 && $value < 100) {
      $color_dis = "rgba(0, 166, 90, 1)";
    }elseif ($value > 100) {
      $color_dis = "rgba(204, 51, 0, 0.3)";
    }
    $class_arr_br[$key] = $color_dis; 
  }
  
?>
<script>
  var ctx = document.getElementById('closedTrmStat');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [<?php foreach($main_arr as $key => $value){echo "'".ucfirst($key)."',";} ?>],
          datasets: [{
              label: 'Learned Days %',
              data: [<?php foreach($main_arr as $key ){echo "'".round($key)."',";} ?>],
              backgroundColor: [
                  <?php foreach ($class_arr as $key) {
                    echo "'".$key."',";
                  }?>
              ],
              borderColor: [
                  <?php foreach ($class_arr_br as $key) {
                    echo "'".$key."',";
                  }?>
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                      stepSize: 10,
                      max: 100,
                  }
              }]
          }
      }
  });
</script>

<?php 
  $arr_stud_no = $obj_fetch->calculatorForHomeStud("Open");
?>
<script>
  var ctx = document.getElementById('openTrmRS');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [<?php foreach($arr_stud_no as $key => $value){echo "'".ucfirst($key)."',";} ?>],
          datasets: [{
              label: 'Number of Students',
              data: [<?php foreach($arr_stud_no as $key ){echo "'".$key."',";} ?>],
              backgroundColor: 'rgba(60, 141, 188, 0.5)',
              borderColor:'rgba(60, 141, 188, 1)',
              borderWidth: 1,
              pointRadius: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                     min: 0,
                     stepSize: 1,
                  }
              }]
          }
      }
  });
</script>

<?php 
  $arr_stud_no_close = $obj_fetch->calculatorForHomeStud("Closed");
?>
<script>
  var ctx = document.getElementById('closeTrmRS');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [<?php foreach($arr_stud_no_close as $key => $value){echo "'".ucfirst($key)."',";} ?>],
          datasets: [{
              label: 'Number of Students',
              data: [<?php foreach($arr_stud_no_close as $key ){echo "'".$key."',";} ?>],
              backgroundColor: 'rgba(147, 42, 182, 0.5)',
              borderColor:'rgba(147, 42, 182, 1)',
              borderWidth: 1,
              pointRadius: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                     min: 0,
                     stepSize: 1,
                  }
              }]
          }
      }
  });
</script>

<?php 
  $arr_stud_no_lice = $obj_fetch->calculatorForHomeLice("All");
  $main_arr_lice = array();
  foreach ($arr_stud_no_lice as $key => $value) {
    $naem_h = $obj_fetch->fetchLicenseId($key)['name'];
    $main_arr_lice[$naem_h] = $value;  
  }
?>
<script>
  var ctx = document.getElementById('liceCatRS');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [<?php foreach($main_arr_lice as $key => $value){echo "'".ucfirst($key)."',";} ?>],
          datasets: [{
              label: 'Number of Students',
              data: [<?php foreach($main_arr_lice as $key ){echo "'".$key."',";} ?>],
              backgroundColor: 'rgba(0, 192, 239, 0.5)',
              borderColor:'rgba(0, 192, 239, 1)',
              borderWidth: 1,
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                     min: 0,
                  }
              }]
          }
      }
  });
</script>
</body>
</html>