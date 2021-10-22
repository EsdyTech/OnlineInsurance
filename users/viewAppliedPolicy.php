<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php
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
            <h6 class="m-0 font-weight-bold text-primary">All Available Policies &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Click on the check icon to add payments details for insurance policy applied for!!!</i></h6></h6>
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
                <th>Approval Status</th>
                <th>Payment Status</th>
                <th>Date Applied</th>
                <th>Make Payment</th>
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
                <th>Approval Status</th>
                <th>Payment Status</th>
                <th>Date Applied</th>
                <th>Make Payment</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT  tblpolicyreg.Id AS policyRegId,tblpolicy.Id AS policyId, tblcategory.categoryName,tblsubcategory.subCategoryName,tblpolicy.policyName,tblpolicy.sumAssured,
        tblpolicy.policyNumber,tblpremiumterm.premiumTermName,tblpolicy.premiumAmount,tblpolicy.interest,tblpolicy.description,
        tblpolicy.categoryId,tblpolicy.subCategoryId,tblpolicy.premiumTermId,tblpolicyreg.isApproved,tblpolicyreg.isPaid,tblpolicyreg.isCompleted,
        tblpolicyreg.dateCreated AS dateApplied
         from tblpolicyreg
         INNER JOIN tblpolicy ON tblpolicy.Id = tblpolicyreg.policyId
         INNER JOIN tblcategory ON tblcategory.Id = tblpolicy.categoryId
         INNER JOIN tblsubcategory ON tblsubcategory.Id = tblpolicy.subCategoryId
         INNER JOIN tblpremiumterm ON tblpremiumterm.Id = tblpolicy.premiumTermId
         where tblpolicyreg.userId='$userId'");
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
        <td><?php if($row['isApproved'] == "1"){echo "Approved";} else if($row['isApproved'] == "2"){echo "Declined";} else{ echo "Pending";}?></td>
        <td><?php if($row['isPaid'] == "1"){echo "Paid";} else{ echo "Pending";}?></td>
        <td><?php  echo $row['dateApplied'];?></td>
        <td><a href="paymentDetails.php?policyRegId=<?php echo $row['policyRegId'];?>&policyId=<?php echo $row['policyId'];?>" title="Upload Paymnent Details"><i class="fa fa-check fa-1x"></i></a></td>
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
