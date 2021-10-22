
<?php session_start();?>
<?php include_once('includes/dbconnection.php');?>


<?php

if(isset($_POST['submit']))
{
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $otherName=$_POST['otherName'];
    $emailAddress=$_POST['emailAddress'];
    $phoneNo=$_POST['phoneNo'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $state=$_POST['state'];
    $dob=$_POST['dob'];
    $password=$_POST['password'];
    $conPassword=$_POST['conPassword'];
    // $password=md5($_POST['password']);
    $dateCreated = date("Y-m-d");

    if($password != $conPassword){

      $alertStyle ="red";
      $statusMsg="Password Mismatch!";
    }
    else{

        $query=mysqli_query($con,"select * from tblusers where emailAddress='$emailAddress'");
        $ret=mysqli_fetch_array($query);
        if($ret > 0){

          $alertStyle ="red";
          $statusMsg="User already exist!";
          
        } else{

        $query=mysqli_query($con,"insert into tblusers(firstName,lastName,otherName,emailAddress,password,dob,gender,phone,address,state,dateCreated) 
        value('$firstName','$lastName','$otherName','$emailAddress','$password','$dob','$gender','$phoneNo','$address','$state','$dateCreated')");
        if ($query) {
        
          echo "<script type = \"text/javascript\">
          window.location = (\"index.php?status=success\")
          </script>"; 
         
        }
        else
        {
            $alertStyle ="red";
            $statusMsg="An error Occurred!";
        }
      }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/header.php');?>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
      <h1 class="h1 mb-4 text-gray-800"style="margin-left:170px;">Online Insurance Management System</h1>
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"> <img class="align-content" src="img/insurance4.jpg" alt="" width="500px" height="675px"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstName" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastName" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="otherName" id="exampleFirstName" placeholder="Other Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="dob" id="exampleLastName" placeholder="Date of Birth">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="gender" id="exampleFirstName" placeholder="Gender">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="phoneNo" id="exampleLastName" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="state" id="exampleFirstName" placeholder="State">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="address" id="exampleLastName" placeholder="Home Address">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="emailAddress" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="conPassword" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                  Register Account
                </a> -->
                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register</button>
                <!-- <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="">Already have an account? Login!</a>
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
