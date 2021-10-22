<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

 //DELETE

if(isset($_GET['delid'])){

  $delid = $_GET['delid'];
  $query = mysqli_query($con,"DELETE FROM tblusers WHERE Id='$delid'");
      if ($query == TRUE) {
  
          $alertStyle ="green";
          $statusMsg="User Deleted Successfully!";
      }
      else{
  
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
          <h1 class="h3 mb-4 text-gray-800">All Registered Users</h1>
          <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
          

                <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Registered Users</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>S/N</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>OtherName</th>
                <th>Email Address</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>State</th>
                <th>Date Created</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>S/N</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>OtherName</th>
                <th>Email Address</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>State</th>
                <th>Date Created</th>
                <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT * from tblusers");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                    ?>
        <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['firstName'];?></td>
        <td><?php  echo $row['lastName'];?></td>
        <td><?php  echo $row['otherName'];?></td>
        <td><?php  echo $row['emailAddress'];?></td>
        <td><?php  echo $row['dob'];?></td>
        <td><?php  echo $row['gender'];?></td>
        <td><?php  echo $row['phone'];?></td>
        <td><?php  echo $row['address'];?></td>
        <td><?php  echo $row['state'];?></td>
        <td><?php  echo $row['dateCreated'];?></td>
        <td><a onclick="return confirm('Are you sure you want to delete this user?')" href="?delid=<?php echo $row['Id'];?>" title="Delete User"><i class="fa fa-trash fa-1x"></i></a></td>
        </tr>
        <?php 
        $cnt=$cnt+1;
        }?>
            </tbody>
        </table>
        </div>

        </div>
        </div>

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
