<?php
error_reporting(0);
ini_set('display_errors', 0);
  $d_host="localhost";
  $d_user="root";
  $d_pass="";
  $d_dbname="fmcs";
  try {
$dbcon = new PDO("mysql:host={$d_host};dbname={$d_dbname}",$d_user,$d_pass);
// set the PDO error mode to exception
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Error. Database connection failed
                    </div>";
    }
//connect to mysql database
$con = mysqli_connect("$d_host", "$d_user", "$d_pass", "$d_dbname");

?>