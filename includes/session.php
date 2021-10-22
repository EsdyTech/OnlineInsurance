
<?php
include('dbconnection.php');
session_start(); 

if (isset($_SESSION['adminId']) )
{
    $adminId = $_SESSION['adminId'];

    $query = mysqli_query($con,"select * from tbladmin where Id='$adminId'");
    $count = mysqli_num_rows($query);
    $rows = mysqli_fetch_array($query);

    $firstName = $rows['firstName'];
    $lastName = $rows['lastName'];
}

else if (isset($_SESSION['userId']) )
{
    $userId = $_SESSION['userId'];

    $query = mysqli_query($con,"select * from tblusers where Id='$userId'");
    $count = mysqli_num_rows($query);
    $rows = mysqli_fetch_array($query);

    $firstName = $rows['firstName'];
    $lastName = $rows['lastName'];
}

else{
  echo "<script type = \"text/javascript\">
  window.location = (\"index.php\");
  </script>";

}


// $expiry = 1800 ;//session expiry required after 30 mins
// if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {

//     session_unset();
//     session_destroy();
//     echo "<script type = \"text/javascript\">
//           window.location = (\"../index.php\");
//           </script>";

// }
// $_SESSION['LAST'] = time();
    
?>