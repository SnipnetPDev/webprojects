<?php
  include_once('../../../db/index.php');
    if(isset($_POST['action']) && $_POST['action'] == 'availability')
    {
        $r_acc_no       = mysqli_real_escape_string($con,$_POST['r_acc_no']); // Get the username values
            $query  = "select account_no from accounts where account_no='".$r_acc_no."'";
            $res    = mysqli_query($con,$query);
            $count  = mysqli_num_rows($res);
            echo $count;
    }
?>