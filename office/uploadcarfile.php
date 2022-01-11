<?php 
session_start();
include 'autoloader.php';
$obj_converter = new converter;
$obj = new register;

if (isset($_POST['upload'])) {
	$id = $_POST['emp_id'];
	$dic = $_POST['file_name'];

	$obj->uploadCarFile($id, $dic, 'file_up');
	$final = "";
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Employe File</title>
	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
</head>
<body>

<div  class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
	          <form name="File" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
	            <div class="box box-primary">
	              
	              <div class="box-header">
	                <h3 class="box-title">Car File:</h3>
	              </div>

	              <div class="box-body" >
	              	<?php if(!isset($final)) {?>
	                <div class="row" style="margin-top: 15px;">
	                	<input type="text" name="emp_id" value="<?php echo $_GET['id']; ?>" hidden>

	                  <div class="col-md-12">
	                    <div class="form-group">
	                      <label>File Name </label>
	                      <input type="text" class="form-control" name="file_name">
	                    </div>

	                    <div class="form-group">
	                      <label>File </label>
	                      <input type="file"  name="file_up">
	                    </div>

	                    <div style="margin-top: 13%; margin-left: 30%;">
	                      <input type="submit" name="upload" value="Upload" class="btn btn-primary">
	                    </div>

	                  </div>

	                </div>
		            <?php }else{?>
		            	<div class="row">
		            		<div class="col-md-4"></div>
		            		<div class="col-md-4">
		            			<center>
						            <div class='alert alert-success alert-dismissible'>
						                <h4><i class='icon fa fa-check'></i> Alert!</h4>
						                File Seccussfuly Uploaded, To Upload Another File Please Click The Button!
						                <br>
						                <br>
						                <a href="uploadempfile.php?id=<?php echo $id; ?>" class = "btn btn-info btn-sm">
						                	More Files
						                </a>
						            </div>
						        </center>
		            		</div class="col-md-4">
		            	</div>
		            <?php } ?>
	              </div>
	            </div>
	          </form>
	        </div>
			<div class="col-md-4"></div>
		</div>
	</section>
</div>

	
	<footer class="main-footer">
	    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="https://saba-aps.com">Linos Studio</a>.</strong> All rights
	    reserved.
	</footer>
	<!-- jQuery 3 -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>