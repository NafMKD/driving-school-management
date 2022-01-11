<?php
//error_reporting(0);
session_start();
include 'autoloader.php';


if(isset($_POST['submit'])){
  $obj_con = new Db;
  $pass =  $_POST['pass'];
  $user =  $_POST['user'];

  $obj_login = new Login;
  $log_met = $obj_login->signin($user, $pass);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Admin</b>LTE</a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <?php if(isset($log_met)){ ?>
          <div class='alert alert-danger'>
            <center>
              <i class='icon fa fa-times-circle'></i>
              <?php echo $log_met; ?>
              <br>
            </center>
          </div>
          <?php }?>
          <div class="form-group has-feedback">
            <input type="text" name="user" class="form-control" placeholder="User Nme">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-7">
            </div>
            <div class="col-xs-5">
              <button type="submit" name="submit" id="sign_in" onclick="return signinfun()" class="btn btn-primary">
                Sign In
              </button> 
            </div>
          </div>
        </form>
        <a href="#">I forgot my password</a><br>
      </div>
    </form>
</div>

<!-- jQuery 3 -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  function signinfun(){
    document.getElementById('sign_in').innerHTML = "Signing You In <i class='fa fa-refresh fa-spin'></i>"
  }
</script>
</body>
</html>
