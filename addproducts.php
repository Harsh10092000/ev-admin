<?php
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location:login.php");
}
include "includes/connection.php";
include "includes/header.php";
$success = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Pname = $_POST['P_name'];
    $price = $_POST['P_Price'];
    $s_desc = $_POST['P_short_description'];
    $l_desc = $_POST['P_long_description'];
    $Ptype = $_POST['P_category'];
    $data = $_FILES["P_image"];
    $src = $data["tmp_name"];
    $dest = __DIR__ . "/assets/products/" . $data["name"];
    move_uploaded_file($src, $dest);
    $fname = $data["name"];
    $stmt = $conn->prepare("INSERT INTO product(p_name, p_price, p_shortdes, p_longdes, p_image, p_type) Values (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $Pname, $price, $s_desc, $l_desc, $fname, $Ptype);
    if ($stmt->execute()) {
        $success = true;
    };
    $stmt->close();
}
?>
<main id="main" class="main">
    <?php if ($success) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Add Product Successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="pagetitle">
        <h1>Add Product </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Adminstration</a></li>
                <li class="breadcrumb-item active">Add Product</li>
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
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Name <span class="red">*</span></label>
                                                <div class="col-sm-8"> <input type="text" name="P_name" class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Price <span class="red">*</span></label>
                                                <div class="col-sm-8"> <input type="number" name="P_Price" class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label">Short Description <span class="red">*</span></label>
                                                <div class="col-sm-8"> <input type="text" name="P_short_description" class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3"> <label for="inputNumber" class="col-sm-4 col-form-label"> Long Description <span class="red">*</span></label>
                                                <div class="col-sm-8"> <input type="text" name="P_long_description" class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Category Type<span class="red">*</span></label>
                                                <div class="col-sm-8">
                                                    <select class="form-select" name="P_category" aria-label="Default select example">                                                     
                                                        <option value="Men" selected>Men</option>
                                                        <option value="Women">Women</option>
                                                        <option value="Kids">Kids</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mb-3"> <label for="inputText" class="col-sm-4 col-form-label">Image<span class="red">*</span></label>
                                                <div class="col-sm-8"> <input type="file" name="P_image" class="form-control" required></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div>
                                            <button type="submit" name="saveuser" class="btn btn-success">Add Product
                                            </button>
                                        </div>
                                    </div>
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