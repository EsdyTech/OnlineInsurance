<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

if(isset($_POST['save'])){

    $categoryName=$_POST['categoryName'];
    $description = $_POST['description'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($con,"select * from tblcategory where categoryName ='$categoryName'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ //Check the coure Title

        $alertStyle ="red";
        $statusMsg="Insurance Catgory already exist!";

    }
    else{

    $query=mysqli_query($con,"insert into tblcategory(categoryName,description,dateCreated) value('$categoryName','$description','$dateCreated')");
    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance Category Added Successfully!";
    }
    else
    {
        $alertStyle ="red";
        $statusMsg="An error Occurred!";
    }
    }
}

//DELETE

if(isset($_GET['delid'])){

$delid = $_GET['delid'];
$query = mysqli_query($con,"DELETE FROM tblcategory WHERE Id='$delid'");
    if ($query == TRUE) {

        $alertStyle ="green";
        $statusMsg="Insurance Category Deleted Successfully!";
    }
    else{

        $alertStyle ="red";
        $statusMsg="An error Occurred!";

    }
}


//EDIT


if(isset($_GET['editId'])){

    $_SESSION['editId'] = $_GET['editId'];
    
    $query = mysqli_query($con,"select * from tblcategory where Id='$_SESSION[editId]'");
    $rowi = mysqli_fetch_array($query);
    
    }


if(isset($_POST['update'])){

    $categoryName=$_POST['categoryName'];
    $description = $_POST['description'];

    $query=mysqli_query($con,"update tblcategory set categoryName='$categoryName',description='$description' where Id='$_SESSION[editId]'");

    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance Category Updated Successfully!";

        echo "<script type = \"text/javascript\">
        window.location = (\"addCategory.php\")
        </script>"; 
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
          <h1 class="h3 mb-4 text-gray-800">Insurance Category</h1>

          <div class="row">

            <div class="col-lg-6">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card-body">
                  <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  <!-- Circle Buttons (Default) -->
                    <form method="Post" action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Category Name</label>
                                    <input id="" name="categoryName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['categoryName'])){echo $rowi['categoryName'];}?>" Required placeholder="Category Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Category Description</label>
                                    <input id="" name="description" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['description'])){echo $rowi['description'];}?>" Required placeholder="Category Description">
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET['editId'])){?>
                            <button type="submit" name="update" class="btn btn-primary">Update Category</button>
                        <?php } else{?>
                            <button type="submit" name="save" class="btn btn-primary">Add Category</button>
                        <?php } ?>
                    </form>
                </div>
            </div>

              <!-- Brand Buttons -->
              

    </div>

            <div class="col-lg-6">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">All Added Categories</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Date Created</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S/N</th>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Date Created</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
        $ret=mysqli_query($con,"SELECT * from tblcategory");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['categoryName'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['dateCreated'];?></td>
                <td><a href="?editId=<?php echo $row['Id'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="?delid=<?php echo $row['Id'];?>" title="Delete Category"><i class="fa fa-trash fa-1x"></i></a></td>
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
