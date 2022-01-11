<?php
include 'autoloader.php';
    $obj = new register;

    if($_POST['stud'] == "yes"){
        $img = $_POST['image'];
        $id = $_POST['id_stud'];
        $id_2 = $_POST['id_emp'];

        $folderPath = "../files/photo/";

        date_default_timezone_set("Africa/Addis_Ababa");
        $dateforfile = date("mdY");
        $rand = uniqid();

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

      

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = "Photo_".$dateforfile."_".$rand. '.jpg';  

        $file = $folderPath . $fileName;

        file_put_contents($file, $image_base64);
        $obj->uploadPhoto($id,$fileName, $id_2);
        $finstud = '';
    }
    if ($_POST['emp'] == "yes") {
        $img = $_POST['image'];
        $id = $_POST['id_emp'];
        

        $folderPath = "../files/employee/";

        date_default_timezone_set("Africa/Addis_Ababa");
        $dateforfile = date("mdY");
        $rand = uniqid();

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

      

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = "Photo_".$dateforfile."_".$rand. '.jpg';  

        $file = $folderPath . $fileName;

        file_put_contents($file, $image_base64);
        $obj->uploadEmployePhoto($id, "Photo", $fileName);
        $finemp = '';
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 10%; ">
        <center>
            <div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Alert!</h4>
                <?php if (isset($finstud)) {
                    echo "Photo Seccussfuly Uploaded, Please Close This Window and go to next step!";
                } ?>
                <?php if (isset($finemp)) {
                    echo "Photo Seccussfuly Uploaded!";
                } ?>
            </div>
        </center>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="https://saba-aps.com">Linos Studio</a>.</strong> All rights
        reserved.
    </footer>
</body>
</html>