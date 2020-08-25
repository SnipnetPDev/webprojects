<?php
  $d_host="localhost";
  $d_user="root";
  $d_pass="";
  $d_dbname="stockbank";
  
//connect to mysql database
$con = mysqli_connect("$d_host", "$d_user", "$d_pass", "$d_dbname") or die("Error " . mysqli_error($con));
  
  $dbcon = new PDO("mysql:host={$d_host};dbname={$d_dbname}",$d_user,$d_pass);
?>