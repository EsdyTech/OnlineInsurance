<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

    
 $querys = mysqli_query($con,"select * from tblusers where Id='$userId'");
 $rowss = mysqli_fetch_array($querys);

if(isset($_POST['update'])){

    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $otherName=$_POST['otherName'];
    $emailAddress=$_POST['emailAddress'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $state=$_POST['state'];

    $query=mysqli_query($con,"update tblusers set firstName='$firstName', lastName='$lastName',
    otherName='$otherName', emailAddress='$emailAddress', dob='$dob', gender='$gender',
    phone='$phone', address='$address', state='$state' where Id='$userId'");

    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Profile Updated Successfully!";
    }
    else
    {
        $alertStyle ="red";
        $statusMsg="An error Occurred!";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<?php include_once('./includes/header.php');?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('./includes/sidebar.php');?>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once('./includes/topNavBar.php');?>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profile</h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                </div>
                <div class="card-body">
                  <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  <!-- Circle Buttons (Default) -->
                    <form method="Post" action="">
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">FirstName</label>
                                    <input id="" name="firstName" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['firstName'])){echo $rowss['firstName'];}?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">LastName</label>
                                    <input id="" name="lastName" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['lastName'])){echo $rowss['lastName'];}?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">OtherName</label>
                                    <input id="" name="otherName" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['otherName'])){echo $rowss['otherName'];}?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Email Address</label>
                                    <input id="" name="emailAddress" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['emailAddress'])){echo $rowss['emailAddress'];}?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Date Of Birth</label>
                                    <input id="" name="dob" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['dob'])){echo $rowss['dob'];}?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Gender</label>
                                    <input id="" name="gender" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['gender'])){echo $rowss['gender'];}?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Phone Number</label>
                                    <input id="" name="phone" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['phone'])){echo $rowss['phone'];}?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Address</label>
                                    <input id="" name="address" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['address'])){echo $rowss['address'];}?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">State</label>
                                    <input id="" name="state" type="text" class="form-control cc-exp" value="<?php if(isset($rowss['state'])){echo $rowss['state'];}?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>

              <!-- Brand Buttons -->
        </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once('./includes/footer.php');?>

</body>

</html>
