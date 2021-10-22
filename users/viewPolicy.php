<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php
if(isset($_GET['policyId'])){

    $policyId = $_GET['policyId'];
    $dateCreated = date("Y-m-d");
   
    $query=mysqli_query($con,"insert into tblpolicyreg(policyId,userId,isApproved,isCompleted,isPaid,dateCreated,dateApproved) 
    value('$policyId','$userId','0','0','0','$dateCreated','')");
    if ($query) {

        echo "<script>alert('Insurance Policy Application Successful!');</script>";
        echo "<script type='text/javascript'>document.location = 'viewPolicy.php'; </script>";
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
          <h1 class="h3 mb-4 text-gray-800">Insurance Policies</h1>

          <div class="row">
                
    <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Available Policies &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Click on the check icon to apply for insurance policy!!!</i></h6>
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
                <th>Apply</th>
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
                <th>Apply</th>
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
        <td><a onclick="return confirm('Are you sure you want to Apply for this Policy?')" href="?policyId=<?php echo $row['Id'];?>" title="Apply for Policy"><i class="fa fa-check fa-1x"></i></a></td>
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
