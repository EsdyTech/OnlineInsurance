<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

    
 if(isset($_POST['submit'])){
    
    $currentPassword=$_POST['currentPassword'];
    $newPassword=$_POST['newPassword'];
    $conNewPassword=$_POST['conNewPassword'];

    if($newPassword != $conNewPassword){

        $alertStyle ="red";
        $statusMsg="Password Mismatch!";
    }
    else{

        $query=mysqli_query($con,"select * from tblusers where Id='$userId' and password='$currentPassword'");
        $row=mysqli_fetch_array($query);
        if($row > 0){
        $ret=mysqli_query($con,"update tblusers set password='$newPassword' where Id='$userId'");

            $alertStyle ="green";
            $statusMsg="Password changed successfully!";

        } else {

            $alertStyle ="red";
            $statusMsg="Your current password is wrong!";
        }
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
          <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <div class="card-body">
                  <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  <!-- Circle Buttons (Default) -->
                    <form method="Post" action="">
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Current Password</label>
                                    <input id="" name="currentPassword" type="password" class="form-control cc-exp" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">New Password</label>
                                    <input id="" name="newPassword" type="password" class="form-control cc-exp" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Confirm New Password</label>
                                    <input id="" name="conNewPassword" type="password" class="form-control cc-exp" placeholder="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
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
