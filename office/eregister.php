<?php
session_start();
$title = "Employee Registrar";
$emp = "active";
$ereg = "active";
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
        Registrar
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Registrar</a></li>
      </ol>
    </section>

    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form name="Detail">
            <div class="box box-primary">

              <div class="box-header">
                <h3 class="box-title">Employee Detail:</h3>
              </div>

              <div class="box-body" id="recieveddatadetail">

                <div class="row" style="margin-top: 15px;">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name </label>
                      <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                      <label>Father Name </label>
                      <input type="text" class="form-control" name="fname">
                    </div>

                    <div class="form-group">
                      <label>Grand Father Name </label>
                      <input type="text" class="form-control" name="gname">
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label class="text-info">Gender</label>
                      <select class="form-control select2" name="gender">
                        <option></option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-info">Phone </label>
                      <input type="text" class="form-control" name="phone" data-inputmask='"mask": "99 9999 9999"' data-mask>
                    </div>

                    <div class="form-group">
                      <label class="text-info">Date of Registration</label>
                      <input type="text" class="form-control" value="<?php echo $obj_converter->Now(); ?>" name="dor" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>

                    <div style="margin-top: 13%; margin-left: 30%;">
                      <input type="button" id="buttonDetail" onclick="return employeeRegister()" value="Submit" class="btn btn-primary">
                    </div>

                  </div>

                  <div class="col-md-4">
                      
                      <div class="form-group">
                      <label class="text-success">Educational Level</label>
                      <select class="form-control select2" name="edu_lev">
                        <option></option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="10+1">10+1</option>                      
                        <option value="10+2">10+2</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Advanced Diploma">Advanced Diploma</option>
                        <option value="Degree">Degree</option>
                        <option value="Masters">Masters</option>
                        <option value="Phd">Phd</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Employee Type</label>
                      <select class="form-control select2" name="e_type">
                        <option></option>
                        <option value="1">Teacher</option>
                        <option value="2">Office</option>
                        <option value="3">Director</option>
                        <option value="4">Security</option>
                        <option value="5">Cleaning</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-success">Employee State</label>
                      <select id="selectBox" onchange="return changeFunc()" class="form-control select2" name="e_state">
                        <option></option>
                        <option value="1">Constant</option>
                        <option value="2">Contrat</option>
                      </select>
                    </div>

                  </div>

                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <!-- modal second -->
    <div class="modal fade" id="modal-send">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Date Interval</h4>
          </div>
            <form name="second_form">
              <div class="modal-body">
               <div class="row" id="reciveFromIndModal">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label>From :</label>
                     <input type="text" class="form-control" id="fr_date" name="fr_date"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                   </div>

                   <div class="form-group">
                     <label>To :</label>
                     <input type="text" class="form-control" name="to_date" id="to_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                   </div>

                 </div>
                 <div class="col-md-3"></div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- ./modal second-->

  <?php include 'includes/js.inc.php';?>
  <!-- InputMask -->
  <script src="../assets/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script>
    $(function () {
      $('[data-mask]').inputmask()
      $('.select2').select2()
    })
    function changeFunc() {
      var selectBox = document.getElementById("selectBox");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue === '2'){
        $('#modal-send').modal('show');
        }
     }

     function capturePhoto() {
      var data = document.getElementById('regEmpRetId').innerHTML
      window.open('capturePicture.php?emp=yes&id='+data, '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
    }
  </script>
  <script>
    function employeeRegister() {
      $(document).ready(function(){
        document.getElementById("buttonDetail").value="Submiting .....";
        $.post("../oop/register.oop.php",
        {
          type:"employeeRegister",
          name : document.forms["Detail"]["name"].value,
          fname : document.forms["Detail"]["fname"].value,
          gname : document.forms["Detail"]["gname"].value,
          gender : document.forms["Detail"]["gender"].value,
          phone : document.forms["Detail"]["phone"].value,
          dor : document.forms["Detail"]["dor"].value,
          edu_lev : document.forms["Detail"]["edu_lev"].value,
          e_type : document.forms["Detail"]["e_type"].value,
          e_state : document.forms["Detail"]["e_state"].value,
          fr_date : document.forms["second_form"]["fr_date"].value,
          to_date : document.forms["second_form"]["to_date"].value,
          editor:  <?php echo $_SESSION['id'];?> 
        },
        function(data){
          $('#recieveddatadetail').html(data);
          $("#uploadDiv").remove();
        });
      });
    }
  </script>
</body>
</html>