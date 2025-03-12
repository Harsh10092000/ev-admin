<?php 
include "../includes/connection.php";
$id = $_GET['id'];
$success = false;
$stmt = $conn->prepare("DELETE from product where p_id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    $success = true;  
    $stmt->close();
    $conn->close();
    header("Location: ../viewproducts.php?success=1"); // Changed from viewLehenga.php
    exit();
}