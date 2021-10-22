<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

if(isset($_GET['policyRegPaymentId']) && isset($_GET['type']) && $_GET['type'] == "approve"){

    $policyRegPaymentId=$_GET['policyRegPaymentId'];
    $dateApproved = date("Y-m-d");

    $query=mysqli_query($con,"update tblpolicyregpayments set isApproved='1',dateApproved='$dateApproved' where Id='$policyRegPaymentId'");

    if ($query) {

        $alertStyle ="green";
        $statusMsg="Payment Approved Successfully!";
    }
    else
    {
        $alertStyle ="red";
        $statusMsg="An error Occurred!";
    }
    
}

if(isset($_GET['policyRegPaymentId']) && isset($_GET['type']) && $_GET['type'] == "decline"){

    $policyRegPaymentId=$_GET['policyRegPaymentId'];
    $dateApproved = date("Y-m-d");

    $query=mysqli_query($con,"update tblpolicyregpayments set isApproved='2',dateApproved='$dateApproved' where Id='$policyRegPaymentId'");

    if ($query) {

        $alertStyle ="green";
        $statusMsg="Payment Declined Successfully!";
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
          <h1 class="h3 mb-4 text-gray-800">All Payments</h1>
          <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>

          <div class="row">

    <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Payment Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Click on the check icon to Approve or Decline Insurance Policy Registration Payments!!!</i></h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>S/N</th>
                <th>FirstName</th>
                <th>LastName</th>
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
                <th>Approve</th>
                <th>Decline</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>S/N</th>
                <th>FirstName</th>
                <th>LastName</th>
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
                <th>Approve</th>
                <th>Decline</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
        $ret=mysqli_query($con,"SELECT tblpolicyregpayments.policyRegId,tblpolicyregpayments.Id AS policyRegPaymentId,tblpolicyregpayments.userId,tblpolicyregpayments.amountPaid,
        tblpolicyregpayments.bankName,tblpolicyregpayments.accountName,tblpolicyregpayments.accountNumber,tblpolicyregpayments.depositorsName,
        tblpolicyregpayments.datePaid,tblpolicyregpayments.paymentDetails,tblpolicyregpayments.isApproved,tblpolicyregpayments.dateApproved,tblpolicyregpayments.dateCreated,
        tblpolicy.policyName,tblpolicy.sumAssured,tblpolicy.policyNumber,tblpolicy.premiumAmount,
        tblpolicyReg.Id,tblpolicyReg.policyId,tblpolicyReg.userId,tblusers.firstName,tblusers.lastName
         from tblpolicyregpayments
         INNER JOIN tblusers ON tblusers.Id = tblpolicyregpayments.userId
         INNER JOIN tblpolicyreg ON tblpolicyreg.Id = tblpolicyregpayments.policyRegId
         INNER JOIN tblpolicy ON tblpolicy.Id = tblpolicyreg.policyId
         ");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
                    ?>
        <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['firstName'];?></td>
        <td><?php  echo $row['lastName'];?></td>
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
        <td><a onclick="return confirm('Are you sure you want to Approve?')" href="?policyRegPaymentId=<?php echo $row['policyRegPaymentId'];?>&type=approve" title="Decline Policy Registration Payment"><i class="fa fa-check fa-1x"></i></a></td>
        <td><a onclick="return confirm('Are you sure you want to Decline?')" href="?policyRegPaymentId=<?php echo $row['policyRegPaymentId'];?>&type=decline" title="Decline Policy Registration Payment"><i class="fa fa-check fa-1x"></i></a></td>
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
