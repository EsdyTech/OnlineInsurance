<?php session_start();?>
<?php include_once('includes/dbconnection.php');?>

<?php
if(isset($_GET['status']) && $_GET['status'] == "success")
{
  $alertStyle ="green";
  $statusMsg="User Registration Successful!";
}

?>
<?php

if(isset($_POST['submit']))
{
    $emailAddress=$_POST['emailAddress'];
    $password=$_POST['password'];
    // $password=md5($_POST['password']);

    $query=mysqli_query($con,"select * from tblusers where emailAddress='$emailAddress' and password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret > 0){

        $_SESSION['userId']=$ret['Id'];
        $_SESSION['firstName']=$ret['firstName'];
        $_SESSION['lastName']=$ret['lastName'];
        $_SESSION['emailAddress']=$ret['emailAddress'];

        echo "<script type='text/javascript'>document.location = 'users/dashboard.php'; </script>";
    } else{

        echo "<script>alert('Invalid login Credentials');</script>";
        $alertStyle ="";
        $statusMsg="";

    }
}

?>



<!DOCTYPE html>
<html lang="en">

<?php include_once('includes/header.php');?>

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
              <div class="col-lg-6 d-none d-lg-block bg-login-image"><img class="align-content" src="img/insurance3.jpg" alt="" width="500px" height="410px"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="email" name="emailAddress" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    <!-- <button class="btn btn-primary btn-user btn-block">
                      Login
                    </button> -->
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include_once('includes/footer.php');?>


</body>

</html>
