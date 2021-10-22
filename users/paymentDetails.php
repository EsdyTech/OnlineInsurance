<?php include_once('../includes/dbconnection.php');?>
<?php include_once('../includes/session.php');?>

<?php

if(isset($_GET['policyRegId']) && isset($_GET['policyId'])){

    $policyRegId = $_GET['policyRegId'];
    $policyId = $_GET['policyId'];

    $querys = mysqli_query($con,"select * from tblpolicy where Id='$policyId'");
    $rowss = mysqli_fetch_array($querys);

    $policyNumber = $rowss['policyNumber'];
    $policyName = $rowss['policyName'];
}

else{

    echo "<script type='text/javascript'>
    document.location = 'viewAppliedPolicy.php'; 
    </script>";
}


$alertStyle ="";
$statusMsg="";

if(isset($_POST['save'])){

    $bankName=$_POST['bankName'];
    $accountName=$_POST['accountName'];
    $accountNumber = $_POST['accountNumber'];
    $depositorsName = $_POST['depositorsName'];
    $datePaid=$_POST['datePaid'];
    $amountPaid=$_POST['amountPaid'];
    $paymentDetails=$_POST['paymentDetails'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($con,"select * from tblpolicyregpayments where userId ='$userId' and policyRegId='$policyRegId'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ //Check the coure Title

        $alertStyle ="red";
        $statusMsg="Payments Details Already Exits for this Policy Registration!";
    }
    else{

    $query=mysqli_query($con,"insert into tblpolicyregpayments(policyRegId,userId,amountPaid,bankName,accountName,accountNumber,depositorsName,datePaid,paymentDetails,isApproved,dateApproved,dateCreated) 
    value('$policyRegId','$userId','$amountPaid','$bankName','$accountName','$accountNumber','$depositorsName','$datePaid','$paymentDetails','0','','$dateCreated')");
    if ($query) {
    
        $querys=mysqli_query($con,"update tblpolicyreg set isPaid='1' where policyId='$policyId' and userId='$userId'");

        if ($querys) {
        
            $alertStyle ="green";
            $statusMsg="Payment Details Addedd Successfully!";
        }
        else
        {
            $alertStyle ="red";
            $statusMsg="An error Occurred!";
        }
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
    $query = mysqli_query($con,"DELETE FROM tblpolicyregpayments WHERE Id='$delid'");
    if ($query == TRUE) {

        $querys=mysqli_query($con,"update tblpolicyreg set isPaid='0' where policyId='$policyId' and userId='$userId'");

        if ($querys) {
            $alertStyle ="green";
            $statusMsg="Payment Details Deleted Successfully!";
        }
        else
        {
            $alertStyle ="red";
            $statusMsg="An error Occurred!";
        }
       
    }
    else{

        $alertStyle ="red";
        $statusMsg="An error Occurred!";
    }
}


//EDIT


if(isset($_GET['editId'])){

    $_SESSION['editId'] = $_GET['editId'];
    
    $query = mysqli_query($con,"select * from tblpolicyregpayments where Id='$_SESSION[editId]'");
    $rowi = mysqli_fetch_array($query);
    
    }


if(isset($_POST['update'])){

    $bankName=$_POST['bankName'];
    $accountName=$_POST['accountName'];
    $accountNumber = $_POST['accountNumber'];
    $depositorsName = $_POST['depositorsName'];
    $paymentDetails = $_POST['paymentDetails'];
    $datePaid=$_POST['datePaid'];
    $amountPaid=$_POST['amountPaid'];

    $query=mysqli_query($con,"update tblpolicyregpayments set userId='$userId', policyRegId='$policyRegId',
    bankName='$bankName',accountName='$accountName', accountNumber='$accountNumber',depositorsName='$depositorsName', datePaid='$datePaid', 
    amountPaid='$amountPaid',paymentDetails='$paymentDetails' where Id='$_SESSION[editId]'");

    if ($query) {
    
        $alertStyle ="green";
        $statusMsg="Payment Details Updated Successfully!";

        echo "<script type = \"text/javascript\">
        window.location = (\"paymentDetails.php?policyRegId=".$policyRegId."&policyId=".$policyId."\")
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
          <h1 class="h3 mb-4 text-gray-800">Payments for Policy: <b><?php echo $policyName;?></b> Policy Number: <b><?php echo $policyNumber;?></b></h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Payment Details</h6>
                </div>
                <div class="card-body">
                  <p><b style="color:<?php if(isset($alertStyle)){echo $alertStyle;}?>"><?php if(isset($statusMsg)){echo $statusMsg;}?></b></p>
                  <!-- Circle Buttons (Default) -->
                    <form method="Post" action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Bank Name</label>
                                    <input id="" name="bankName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['bankName'])){echo $rowi['bankName'];}?>" Required placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Account Name</label>
                                    <input id="" name="accountName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['accountName'])){echo $rowi['accountName'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Account Number</label>
                                    <input id="" name="accountNumber" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['accountNumber'])){echo $rowi['accountNumber'];}?>" Required placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Depositors Name</label>
                                    <input id="" name="depositorsName" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['depositorsName'])){echo $rowi['depositorsName'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Amount Paid</label>
                                    <input id="" name="amountPaid" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['amountPaid'])){echo $rowi['amountPaid'];}?>" Required placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Date Paid</label>
                                    <input id="" name="datePaid" type="date" class="form-control cc-exp" value="<?php if(isset($rowi['datePaid'])){echo $rowi['datePaid'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Payment Details</label>
                                    <input id="" name="paymentDetails" type="text" class="form-control cc-exp" value="<?php if(isset($rowi['paymentDetails'])){echo $rowi['paymentDetails'];}?>" Required placeholder="">
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET['editId'])){?>
                            <button type="submit" name="update" class="btn btn-primary">Update Payment Details</button>
                        <?php } else{?>
                            <button type="submit" name="save" class="btn btn-primary">Add Payment Details</button>
                        <?php } ?>
                    </form>
                </div>
            </div>

              <!-- Brand Buttons -->
        </div>

                <div class="col-lg-12">

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Added Payment Details</h6>
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
                <th>Edit</th>
                <th>Delete</th>
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
                <th>Edit</th>
                <th>Delete</th>
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
        <td><a href="?policyRegId=<?php echo $policyRegId;?>&policyId=<?php echo $policyId;?>&editId=<?php echo $row['policyRegPaymentId'];?>" title="Edit Payment Details"><i class="fa fa-edit fa-1x"></i></a></td>
        <td><a onclick="return confirm('Are you sure you want to delete?')" href="?policyRegId=<?php echo $policyRegId;?>&policyId=<?php echo $policyId;?>&delid=<?php echo $row['policyRegPaymentId'];?>" title="Delete Payment Details"><i class="fa fa-trash fa-1x"></i></a></td>
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
