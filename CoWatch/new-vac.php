<?php 
session_start();
error_reporting(0);
//DB conncetion
include_once('includes/config.php');

$replace = "";

if(isset($_POST['submit'])){
//getting post values
$fname=$_POST['fullname'];
$mnumber=$_POST['mobilenumber'];
$dob=$_POST['dob'];
$govtid=$_POST['govtissuedid'];
$govtidnumber=$_POST['govtidnumber'];
$address=$_POST['address'];
$state=$_POST['state'];
$snuid=$_POST['snuid'];
$hostel=$_POST['hostel'];
$vtype=$_POST['vtype'];
$vnum=$_POST['vnum'];
$btime=$_POST['birthdaytime'];
$timeslot=str_replace("T"," ",$btime);
$orderno= mt_rand(100000000, 999999999);
$query="insert into tblpatients(FullName,MobileNumber,DateOfBirth,GovtIssuedId,GovtIssuedIdNo,FullAddress,State,snuid,hostel,OrderNumber,vac) values('$fname','$mnumber','$dob','$govtid','$govtidnumber','$address','$state','$snuid','$hostel','$orderno','$vnum');";
$query.="insert into tblvac(OrderNumber,FullName,PatientMobileNumber,VacType,vnum,TestTimeSlot) values('$orderno','$fname','$mnumber','$vtype','$vnum','$timeslot');";
$result = mysqli_multi_query($con, $query);
if ($result) {
echo '<script>alert("Your test request submitted successfully. Order number is "+"'.$orderno.'")</script>';
  echo "<script>window.location.href='new-user-testing.php'</script>";
} 
else {
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
echo "<script>window.location.href='new-user-testing.php'</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CoWatch | Vaccine slot booking</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style type="text/css">
label{
    font-size:16px;
    font-weight:bold;
    color:#000;
}

</style>
  <script>
function mobileAvailability() {
// $("#loaderIcon").show();
// jQuery.ajax({
// url: "check_availability.php",
// data:'mobnumber='+$("#mobilenumber").val(),
// type: "POST",
// success:function(data){
// $("#mobile-availability-status").html(data);
// $("#loaderIcon").hide();
// },
// error:function (){}
// });
}
</script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include_once('includes/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
          <?php include_once('includes/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Covid19 Vaccination- Book a Slot</h1>
<form name="newtesting" method="post">
  <div class="row">

                        <div class="col-lg-6">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Personal Information</h6>
                                </div>
                                <div class="card-body">
                        <div class="form-group">
                            <label>Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname"  placeholder="Enter your full name..." pattern="[A-Za-z ]+" title="letters only" required="true">
                                        </div>
                                        <div class="form-group">
                                             <label>Mobile Number</label>
                                  <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Please enter your mobile number" pattern="[0-9]{10}" title="10 numeric characters only" required="true">
                                                <span id="mobile-availability-status" style="font-size:12px;"></span>
                                        </div>
                                        <div class="form-group">
                                             <label>DOB</label>
                                            <input type="date" class="form-control" id="dob" max="<?php echo date("Y-m-d"); ?>" name="dob" required="true">
                                        </div>
                                        <div class="form-group">
                                               <label>Any Govt Issued ID</label>
                                            <input type="text" class="form-control" id="govtissuedid" name="govtissuedid" placeholder="Pancard / Driving License / Voter id / any other" required="true">
                                        </div>
                                        <div class="form-group">
                                              <label>Govt Issued ID Number</label>
                                            <input type="text" class="form-control" id="govtidnumber" name="govtidnumber" placeholder="Enter Government Issued ID Number" required="true">
                                        </div>
                          

                               <div class="form-group">
                                              <label>Address</label>
                                            <textarea class="form-control" id="address" name="address" required="true" placeholder="Enter your full addres here"></textarea>
                                        </div>

                                <div class="form-group">
                                        <label>State</label>
                                            <input type="text" class="form-control" id="state" name="state"  placeholder="Enter your State Here" pattern="[A-Za-z ]+" title="letters only" required="true">
                                        </div>

                                <div class="form-group">
                                             <label>Snu ID Number</label>
                                  <input type="text" class="form-control" id="snuid" name="snuid" placeholder="Enter your SNU ID Here" pattern="[0-9]{10}" title="10 numeric characters only" required="true" onBlur="mobileAvailability()">
                                        </div>

                                <div class="form-group">
                                              <label>Hostel</label>
                                      <input type="text" class="form-control" id="hostel" name="hostel" placeholder="Enter your Hostel Here" required="true">
                                </div>

                            </div>
                        </div>

                    </div>

                        <div class="col-lg-6">

                           <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Vaccine Information</h6>
                                </div>
                                <div class="card-body">
                             <div class="form-group">
                                              <label>Vaccine</label>
                                              <select class="form-control" id="vtype" name="vtype" required="true">
                                            <option value="">Select</option> 
                                            <option value="Covishield">Covishield</option>  
                                            <option value="Covaxin">Covaxin</option>    
                                              </select>
                                        </div>

                                <div class="form-group">
                                              <label>Dose</label>
                                              <select class="form-control" id="vnum" name="vnum" required="false">
                                            <option value="">Select</option> 
                                            <option value="1">First</option>  
                                            <option value="2">Second</option>
                                            <option value="3">Booster Dose</option>
                                              </select>
                                        </div>


                                <div class="form-group">
                                    <label>Time Slot for Test</label>
                                    <input type="datetime-local" class="form-control" id="birthdaytime" min="<?php echo date("Y-m-d")."T".date("h:i");?>" name="birthdaytime" class="form-control">                                        
                                </div>
                       <div class="form-group">
                                 <input type="submit" class="btn btn-success btn-user btn-block" name="submit" id="submit">                           
                             </div>

                                </div>
                            </div>
                       

                        </div>

                    </div>
</form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php include_once('includes/footer.php');?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>