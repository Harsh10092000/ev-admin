<?php 
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../dashboard/pages-login.php");  
}
?>