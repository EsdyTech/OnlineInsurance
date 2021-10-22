<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

if(isset($_POST['save'])){

    $categoryId=$_POST['categoryId'];
    $subCategoryName=$_POST['subCategoryName'];
    $description = $_POST['description'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($con,"select * from tblsubcategory where subCategoryName ='$subCategoryName' and categoryId='$categoryId'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ //Check the coure Title

        $alertStyle ="red";
        $statusMsg="Insurance SubCatgory already exist!";

    }
    else{

    $query=mysqli_query($con,"insert into tblsubcategory(categoryId,subCategoryName,description,dateCreated) value('$categoryId','$subCategoryName','$description','$dateCreated')");
    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance SubCatgory Addedd Successfully!";
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
$query = mysqli_query($con,"DELETE FROM tblsubcategory WHERE Id='$delid'");
    if ($query == TRUE) {

        $alertStyle ="green";
        $statusMsg="Insurance SubCategory Deleted Successfully!";
    }
    else{

        $alertStyle ="red";
        $statusMsg="An error Occurred!";

    }
}


//EDIT


if(isset($_GET['editId'])){

    $_SESSION['editId'] = $_GET['editId'];
    
    $query = mysqli_query($con,"select * from tblsubcategory where Id='$_SESSION[editId]'");
    $rowi = mysqli_fetch_array($query);
    
    }


if(isset($_POST['update'])){

    $categoryId=$_POST['categoryId'];
    $subCategoryName=$_POST['subCategoryName'];
    $description = $_POST['description'];

    $query=mysqli_query($con,"update tblsubcategory set categoryId='$categoryId', subCategoryName='$subCategoryName',description='$description' where Id='$_SESSION[editId]'");

    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance SubCategory Updated Successfully!";

        echo "<script type = \"text/javascript\">
        window.location = (\"addSubCategory.php\")
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
          <h1 class="h3 mb-4 text-gray-800">Insurance SubCategory</h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add SubCategory</h6>
                </div>
                <div class="card-body">
                  <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  <!-- Circle Buttons (Default) -->
                    <form method="Post" action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Category</label>
                                    <?php 
                                        $query=mysqli_query($con,"select * from tblcategory ORDER BY categoryName ASC");                        
                                        $count = mysqli_num_rows($query);
                                        if($count > 0){                       
                                            echo ' <select required name="categoryId" class="custom-select form-control">';
                                            echo'<option value="">--Select Category--</option>';
                                            while ($row = mysqli_fetch_array($query)) {
                                            echo'<option value="'.$row['Id'].'" >'.$row['categoryName'].'</option>';
                                                }
                                            echo '</select>';
                                        }
                                        ?>        
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">SubCategory Name</label>
                                    <input id="" name="subCategoryName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['subCategoryName'])){echo $rowi['subCategoryName'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Description</label>
                                    <input id="" name="description" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['description'])){echo $rowi['description'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET['editId'])){?>
                            <button type="submit" name="update" class="btn btn-primary">Update SubCategory</button>
                        <?php } else{?>
                            <button type="submit" name="save" class="btn btn-primary">Add SubCategory</button>
                        <?php } ?>
                    </form>
                </div>
            </div>

              <!-- Brand Buttons -->
        </div>

                <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Added SubCategories</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>S/N</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT tblcategory.categoryName,tblsubcategory.Id,tblsubcategory.description,tblsubcategory.subCategoryName,tblsubcategory.dateCreated
         from tblsubcategory
         INNER JOIN tblcategory ON tblcategory.Id = tblsubcategory.categoryId");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                    ?>
        <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['categoryName'];?></td>
        <td><?php  echo $row['subCategoryName'];?></td>
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
