<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

 $alertStyle ="";
 $statusMsg="";

if(isset($_POST['save'])){

    $categoryId=$_POST['categoryId'];
    $subCategoryId=$_POST['subCategoryId'];
    $policyName = $_POST['policyName'];
    $policyNumber = $_POST['policyNumber'];
    $sumAssured=$_POST['sumAssured'];
    $premiumTermId=$_POST['premiumTermId'];
    $premiumAmount = $_POST['premiumAmount'];
    $interest = $_POST['interest'];
    $description = $_POST['description'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($con,"select * from tblpolicy where categoryId ='$categoryId' and subCategoryId='$subCategoryId' and policyName='$policyName' and policyNumber='$policyNumber'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ //Check the coure Title

        $alertStyle ="red";
        $statusMsg="Insurance Policy already exist!";

    }
    else{

    $query=mysqli_query($con,"insert into tblpolicy(categoryId,subCategoryId,policyNumber,policyName,sumAssured,premiumTermId,premiumAmount,interest,description,dateCreated) 
    value('$categoryId','$subCategoryId','$policyNumber','$policyName','$sumAssured','$premiumTermId','$premiumAmount','$interest','$description','$dateCreated')");
    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance Policy Addedd Successfully!";
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
$query = mysqli_query($con,"DELETE FROM tblpolicy WHERE Id='$delid'");
    if ($query == TRUE) {

        $alertStyle ="green";
        $statusMsg="Insurance Policy Deleted Successfully!";
    }
    else{

        $alertStyle ="red";
        $statusMsg="An error Occurred!";

    }
}


//EDIT


if(isset($_GET['editId'])){

    $_SESSION['editId'] = $_GET['editId'];
    
    $query = mysqli_query($con,"select * from tblpolicy where Id='$_SESSION[editId]'");
    $rowi = mysqli_fetch_array($query);
    
    }


if(isset($_POST['update'])){

    $categoryId=$_POST['categoryId'];
    $subCategoryId=$_POST['subCategoryId'];
    $policyName = $_POST['policyName'];
    $policyNumber = $_POST['policyNumber'];
    $sumAssured=$_POST['sumAssured'];
    $premiumTermId=$_POST['premiumTermId'];
    $premiumAmount = $_POST['premiumAmount'];
    $interest = $_POST['interest'];
    $description = $_POST['description'];

    $query=mysqli_query($con,"update tblpolicy set categoryId='$categoryId', subCategoryId='$subCategoryId',
    policyNumber='$policyNumber',policyName='$policyName', sumAssured='$sumAssured',premiumTermId='$premiumTermId', premiumAmount='$premiumAmount', 
    interest='$interest', description='$description' where Id='$_SESSION[editId]'");

    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Insurance Policy Updated Successfully!";

        echo "<script type = \"text/javascript\">
        window.location = (\"addPolicy.php\")
        </script>"; 
    }
    else
    {
        $alertStyle ="red";
        $statusMsg="An error Occurred!";
    }
}



?>


<script>
    function showValues(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCall.php?cid="+str,true);
        xmlhttp.send();
    }
}
    </script>

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
          <h1 class="h3 mb-4 text-gray-800">Insurance Policy</h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Insurance Policy</h6>
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
                                            echo ' <select required name="categoryId" onchange="showValues(this.value)" class="custom-select form-control">';
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
                                <?php
                                    echo"<div id='txtHint'></div>";
                                ?>         
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Policy Name</label>
                                    <input id="" name="policyName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['policyName'])){echo $rowi['policyName'];}?>" Required placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Policy Number</label>
                                    <input id="" name="policyNumber" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['policyNumber'])){echo $rowi['policyNumber'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Premium Term</label>
                                    <?php 
                                        $query=mysqli_query($con,"select * from tblpremiumterm ORDER BY premiumTermName ASC");                        
                                        $count = mysqli_num_rows($query);
                                        if($count > 0){                       
                                            echo ' <select required name="premiumTermId" class="custom-select form-control">';
                                            echo'<option value="">--Select Premium Term--</option>';
                                            while ($row = mysqli_fetch_array($query)) {
                                            echo'<option value="'.$row['Id'].'" >'.$row['premiumTermName'].'</option>';
                                                }
                                            echo '</select>';
                                        }
                                        ?>       
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Premiuim Amount</label>
                                    <input id="" name="premiumAmount" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['premiumAmount'])){echo $rowi['premiumAmount'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Interest</label>
                                    <input id="" name="interest" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['interest'])){echo $rowi['interest'];}?>" Required placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Sum Assured</label>
                                    <input id="" name="sumAssured" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['sumAssured'])){echo $rowi['sumAssured'];}?>" Required placeholder="">
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
                            <button type="submit" name="update" class="btn btn-primary">Update Policy</button>
                        <?php } else{?>
                            <button type="submit" name="save" class="btn btn-primary">Add Policy</button>
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
                <th>Policy Number</th>
                <th>Policy Name</th>
                <th>Sum Assured</th>
                <th>Premium Term</th>
                <th>Premium Amount</th>
                <th>Interest</th>
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
                <th>Policy Number</th>
                <th>Policy Name</th>
                <th>Sum Assured</th>
                <th>Premium Term</th>
                <th>Premium Amount</th>
                <th>Interest</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT tblcategory.categoryName,tblsubcategory.subCategoryName,tblpolicy.Id,tblpolicy.policyName,tblpolicy.sumAssured,
        tblpolicy.policyNumber,tblpremiumterm.premiumTermName,tblpolicy.premiumAmount,tblpolicy.interest,tblpolicy.description,tblpolicy.dateCreated
         from tblpolicy
         INNER JOIN tblcategory ON tblcategory.Id = tblpolicy.categoryId
         INNER JOIN tblsubcategory ON tblsubcategory.Id = tblpolicy.subCategoryId
         INNER JOIN tblpremiumterm ON tblpremiumterm.Id = tblpolicy.premiumTermId");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                    ?>
        <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['categoryName'];?></td>
        <td><?php  echo $row['subCategoryName'];?></td>
        <td><?php  echo $row['policyNumber'];?></td>
        <td><?php  echo $row['policyName'];?></td>
        <td><?php  echo $row['sumAssured'];?></td>
        <td><?php  echo $row['premiumTermName'];?></td>
        <td><?php  echo $row['premiumAmount'];?></td>
        <td><?php  echo $row['interest'];?></td>
        <td><?php  echo $row['description'];?></td>
        <td><?php  echo $row['dateCreated'];?></td>
        <td><a href="?editId=<?php echo $row['Id'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a></td>
        <td><a onclick="return confirm('Are you sure you want to delete?')" href="?delid=<?php echo $row['Id'];?>" title="Delete Policy"><i class="fa fa-trash fa-1x"></i></a></td>
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
