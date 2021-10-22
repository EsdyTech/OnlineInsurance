<?php include_once('../includes/dbconnection.php');?>


<?php

 $alertStyle ="";
 $statusMsg="";

if(isset($_POST['submit'])){

    $email=$_POST['email'];
    $querys = mysqli_query($con,"select * from tbladmin where email='$email'");
    
    if ($querys) {
      $rowss = mysqli_fetch_array($querys);
      $password = $rowss['password'];
    
        $alertStyle ="green";
        $statusMsg="This is your Password $password";
    }
    else
    {
        $alertStyle ="red";
        $statusMsg="Invalid User!";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<?php include_once('./includes/header.php');?>


<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
          <h1 class="h1 mb-4 text-gray-800"style="margin-left:100px;">Online Insurance Management System</h1>
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"><img class="align-content" src="../img/insurance2.jpg" alt="" width="500px" height="390px"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below!</p>
                    <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                  </form>
                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
                  <div class="text-center">
                    <a class="small" href="index.php">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
