<?php

    include('../includes/dbconnection.php');

    $cid = intval($_GET['cid']);//gradeId

        $queryss=mysqli_query($con,"select * from tblsubcategory where categoryId=".$cid."");                        
        $countt = mysqli_num_rows($queryss);

        if($countt > 0){                       
        echo '<label for="select" class=" form-control-label">SubCategory</label>
        <select required name="subCategoryId" class="custom-select form-control">';
        echo'<option value="">--Select SubCategory--</option>';
        while ($row = mysqli_fetch_array($queryss)) {
        echo'<option value="'.$row['Id'].'" >'.$row['subCategoryName'].'</option>';
        }
        echo '</select>';
        }

?>

