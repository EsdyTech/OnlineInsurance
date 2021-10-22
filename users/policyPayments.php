<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php


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
          <h1 class="h3 mb-4 text-gray-800">All Policy Payments</h1>

          <div class="row">

           

                <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Payment Details</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Policy Number</th>
                <th>Policy Name</th>
                <th>Premium Amount</th>
                <th>Amount Paid</th>
                <th>Bank Name</th>
                <th>Account Name</th>
                <th>Account Number</th>
                <th>Depositors Name</th>
                <th>Date Paid</th>
                <th>Payment Details</th>
                <th>Approval Status</th>
                <th>Date Created</th>
                <th>Date Approved</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>S/N</th>
                <th>Policy Number</th>
                <th>Policy Name</th>
                <th>Premium Amount</th>
                <th>Amount Paid</th>
                <th>Bank Name</th>
                <th>Account Name</th>
                <th>Account Number</th>
                <th>Depositors Name</th>
                <th>Date Paid</th>
                <th>Payment Details</th>
                <th>Approval Status</th>
                <th>Date Created</th>
                <th>Date Approved</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT tblpolicyregpayments.policyRegId,tblpolicyregpayments.Id AS policyRegPaymentId,tblpolicyregpayments.userId,tblpolicyregpayments.amountPaid,
        tblpolicyregpayments.bankName,tblpolicyregpayments.accountName,tblpolicyregpayments.accountNumber,tblpolicyregpayments.depositorsName,
        tblpolicyregpayments.datePaid,tblpolicyregpayments.paymentDetails,tblpolicyregpayments.isApproved,tblpolicyregpayments.dateApproved,tblpolicyregpayments.dateCreated,
        tblpolicy.policyName,tblpolicy.sumAssured,tblpolicy.policyNumber,tblpolicy.premiumAmount,
        tblpolicyReg.Id,tblpolicyReg.policyId,tblpolicyReg.userId
         from tblpolicyregpayments
         INNER JOIN tblpolicyreg ON tblpolicyreg.Id = tblpolicyregpayments.policyRegId
         INNER JOIN tblpolicy ON tblpolicy.Id = tblpolicyreg.policyId
         where tblpolicyregpayments.userId='$userId'");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                    ?>
        <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['policyNumber'];?></td>
        <td><?php  echo $row['policyName'];?></td>
        <td><?php  echo $row['premiumAmount'];?></td>
        <td><?php  echo $row['amountPaid'];?></td>
        <td><?php  echo $row['bankName'];?></td>
        <td><?php  echo $row['accountName'];?></td>
        <td><?php  echo $row['accountNumber'];?></td>
        <td><?php  echo $row['depositorsName'];?></td>
        <td><?php  echo $row['datePaid'];?></td>
        <td><?php  echo $row['paymentDetails'];?></td>
        <td><?php if($row['isApproved'] == "1"){echo "Approved";} else if($row['isApproved'] == "2"){echo "Declined";} else{ echo "Pending";}?></td>
        <td><?php  echo $row['dateCreated'];?></td>
        <td><?php  echo $row['dateApproved'];?></td>
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
