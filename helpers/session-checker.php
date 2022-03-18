<?php  
session_start(); 
if(isset($_SESSION['userid']) OR isset($_SESSION['businessid']) OR isset($_SESSION['adminid']) OR isset($_SESSION['driverid']))
{
  //echo "Login";
}
else{
  header("location:../../index.php");
}


?>