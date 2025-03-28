<?php
ob_start();
include "includes/header.php";
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location:login.php");
}
include "includes/connection.php";
$stmt = $conn->prepare("SELECT * from vehicles;");
$stmt->execute();
$result = $stmt->get_result(); ?>



<?php include "product-table.php" ?>
<?php include "includes/footer.php" ?>