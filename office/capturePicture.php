<?php
session_start();
 ?>

<!DOCTYPE html>

<html>

<head>

    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>

    <!-- jQuery 3 -->
    <script src="../assets/jquery/dist/jquery.min.js"></script>

    <script src="../assets/webcam.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">

    <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>

<body>

  

<div class="container" style="margin-top: 10%; ">
    <center>

        <form method="POST" action="../oop/photouploader.oop.php">

            <div class="row">

                <div class="col-md-6">

                    <div id="my_camera"></div>

                    <br>

                    <input  class="btn btn-info" type=button value="Take Photo" onClick="take_snapshot()">

                    <input type="hidden" name="image" class="image-tag">
                    <?php if(isset($_GET['stud'])){?>
                    <input type="text" name="stud" value="yes" hidden>
                    <input type="text" name="emp" value="no" hidden>
                    <input type="text" name="id_stud" value="<?php echo $_GET['id']; ?>" hidden>
                    <input type="text" name="id_emp" value="<?php echo $_GET['id_2']; ?>" hidden>
                    <?php }elseif(isset($_GET['emp'])){?>
                    <input type="text" name="id_emp" value="<?php echo $_GET['id']; ?>" hidden>
                    <input type="text" name="emp" value="yes" hidden>
                    <input type="text" name="stud" value="no" hidden>
                    <?php } ?>

                </div>
                <hr>
                <div class="col-md-6">

                    <div id="results"></div>

                </div>

                <div class="col-md-12 text-center">

                    <br>

                    <button class="btn btn-success">Upload</button>

                </div>

            </div>

        </form>    

    </center>
</div>

    <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="https://saba-aps.com">Linos Studio</a>.</strong> All rights
        reserved.
    </footer>

<!-- Configure a few settings and attach camera -->

<script language="JavaScript">

    Webcam.set({

        width: 400,

        height: 300,

        image_format: 'jpeg',

        jpeg_quality: 90

    });

  

    Webcam.attach( '#my_camera' );

  

    function take_snapshot() {

        Webcam.snap( function(data_uri) {

            $(".image-tag").val(data_uri);

            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';

        } );

    }

</script>

 

</body>

</html>