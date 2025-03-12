<?php
ob_start();
include "includes/header.php";
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location:login.php");
}
include "includes/connection.php";
$id = $_GET['id'];
$success = false;
$stmt = $conn->prepare("SELECT * from product where p_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$getData = $result->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['p_name'];
    $price = $_POST['p_price'];
    $s_desc = $_POST['p_short_description'];
    $l_desc = $_POST['p_long_description'];
    $productType = $_POST['product_category'];
    $query = "UPDATE product SET p_name = ?, p_price = ?, p_shortdes = ?, p_longdes = ?, p_type = ? WHERE p_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $productName, $price, $s_desc, $l_desc, $productType, $id);
    if ($stmt->execute()) {
        $success = true;
        if ($stmt->affected_rows > 0) {
            header("Location: ./viewproducts.php?success=1"); // Changed from viewLehenga.php to viewProducts.php
        } else {
            echo "Error updating Product: " . $conn->error;
        }
    };

    $stmt->close();
};
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Product</h1> <!-- Changed from Edit Lehenga to Edit Product -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Administration</a></li>
                <li class="breadcrumb-item active">Edit Product</li> <!-- Changed from Edit Lehenga to Edit Product -->
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="cardx">
                    <div class="card-bodyx">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" class="mt-4" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Name <span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?= $getData['p_name']; ?>" name="p_name" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Price <span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="p_price" value="<?= $getData['p_price']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Short Description <span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="p_short_description" value="<?= $getData['p_shortdes']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Long Description <span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="p_long_description" value="<?= $getData['p_longdes']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                 
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Product Type<span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <select class="form-select" name="product_category" aria-label="Default select example">
                                                        <option value="Men" <?= $getData['p_type'] == 'Men' ? 'selected' : ''; ?>>Men</option>
                                                        <option value="Women" <?= $getData['p_type'] == 'Women' ? 'selected' : ''; ?>>Women</option>
                                                        <option value="Kids" <?= $getData['p_type'] == 'Kids' ? 'selected' : ''; ?>>Kids</option>
                                                        <option value="Other" <?= $getData['p_type'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <button type="submit" name="saveuser" class="btn btn-success">Edit Product</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.php" ?>