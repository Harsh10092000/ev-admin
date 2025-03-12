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
$error = '';

$stmt = $conn->prepare("SELECT * FROM product WHERE p_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$getData = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['p_name'];
    $brand = $_POST['p_brand'];
    $price = $_POST['p_price'];
    $s_desc = $_POST['p_short_description'];
    $l_desc = $_POST['p_long_description'];
    $main_category = $_POST['p_main_category'];
    $category_type = $_POST['p_category_type'];
    $subcategory = $_POST['p_subcategory'];

    $query = "UPDATE product SET p_name = ?, p_brand = ?, p_price = ?, p_shortdes = ?, p_longdes = ?, p_main_category = ?, p_category_type = ?, p_subcategory = ? WHERE p_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssi", $productName, $brand, $price, $s_desc, $l_desc, $main_category, $category_type, $subcategory, $id);
    
    if ($stmt->execute()) {
        $success = true;
        if ($stmt->affected_rows > 0) {
            header("Location: ./viewproducts.php?success=1");
            exit();
        } else {
            $error = "No changes made or error updating product: " . $conn->error;
        }
    } else {
        $error = "Error updating product: " . $conn->error;
    }
    $stmt->close();
}
?>

<main id="main" class="main" >
    <?php if ($error) : ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="border-radius: 12px; padding: 1rem 1.5rem; background: #fef2f2; border: 1px solid #f87171; 
                    box-shadow: 0 3px 12px rgba(100,0,0,0.06);">
            <i class="bi bi-exclamation-triangle" style="color: #ef4444;"></i>
            <span style="color: #991b1b; font-weight: 500;"><?php echo $error; ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="pagetitle mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 1.75rem; font-weight: 600; color: #374151; letter-spacing: -0.025rem;">Edit Product</h1>
                <nav>
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" 
                             style="color: #60a5fa; text-decoration: none; transition: color 0.3s ease;"
                             onmouseover="this.style.color='#3b82f6'" 
                             onmouseout="this.style.color='#60a5fa'">Administration</a></li>
                        <li class="breadcrumb-item active" style="color: #9ca3af; font-weight: 500;">Edit Product</li>
                    </ol>
                </nav>
            </div>
            <a href="viewproducts.php" class="btn" 
               style="background: #e5e7eb; color: #374151; border-radius: 8px; padding: 0.6rem 1.2rem; font-weight: 500; 
                      transition: all 0.3s ease;"
               onmouseover="this.style.background='#d1d5db'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)'"
               onmouseout="this.style.background='#e5e7eb'; this.style.boxShadow='none'">
                <i class="bi bi-arrow-left me-1"></i> Back to Products
            </a>
        </div>
    </div>
    
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); 
                                       background: #ffffff;">
                    <div class="card-body" style="padding: 2rem;">
                        <form method="post" class="mt-2" id="editProductForm">
                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Name <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= htmlspecialchars($getData['p_name']) ?>" name="p_name" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Brand Name <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= htmlspecialchars($getData['p_brand']) ?>" name="p_brand" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Price <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="number" name="p_price" value="<?= htmlspecialchars($getData['p_price']) ?>" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Short Description</label>
                                <div class="col-sm-8">
                                    <input type="text" name="p_short_description" value="<?= htmlspecialchars($getData['p_shortdes']) ?>" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Long Description</label>
                                <div class="col-sm-8">
                                    <input type="text" name="p_long_description" value="<?= htmlspecialchars($getData['p_longdes']) ?>" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Category Selection -->
                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Main Category <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="p_main_category" id="mainCategory" 
                                            style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                   transition: all 0.3s ease;" required>
                                        <option value="Men" <?= $getData['p_main_category'] == 'Men' ? 'selected' : '' ?>>Men</option>
                                        <option value="Women" <?= $getData['p_main_category'] == 'Women' ? 'selected' : '' ?>>Women</option>
                                        <option value="Kids" <?= $getData['p_main_category'] == 'Kids' ? 'selected' : '' ?>>Kids</option>
                                        <option value="Other" <?= $getData['p_main_category'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Category Type <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="p_category_type" id="categoryType" 
                                            style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                   transition: all 0.3s ease;" required>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Subcategory <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="p_subcategory" id="subCategory" 
                                            style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                   transition: all 0.3s ease;" required>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                                </div>

                            <div class="row">
                                <div class="col-sm-12 text-end">
                                    <button type="submit" name="saveuser" class="btn" 
                                            style="background: #60a5fa; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; 
                                                   font-weight: 500; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(96,165,250,0.2);"
                                            onmouseover="this.style.background='#3b82f6'; this.style.boxShadow='0 4px 12px rgba(96,165,250,0.3)'"
                                            onmouseout="this.style.background='#60a5fa'; this.style.boxShadow='0 2px 8px rgba(96,165,250,0.2)'">
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96,165,250,0.2);
        outline: none;
    }

    .form-control:hover, .form-select:hover {
        border-color: #93c5fd;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        .col-sm-4 {
            margin-bottom: 0.5rem;
        }
        .btn {
            width: 100%;
        }
    }
</style>

<script>
const categories = {
    Men: {
        'Bottom Wear': ['Lower', 'Shorts', 'Jeans', 'Track Pants'],
        'Top Wear': ['Shirt', 'T-Shirt', 'Jacket', 'Sweatshirt'],
        'Footwear': ['Casual Shoes', 'Sports Shoes', 'Formal Shoes', 'Sandals']
    },
    Women: {
        'Bottom Wear': ['Leggings', 'Skirts', 'Jeans', 'Palazzo'],
        'Top Wear': ['Tops', 'Kurtas', 'Blouses', 'Sweaters'],
        'Footwear': ['Heels', 'Flats', 'Sneakers', 'Boots']
    },
    Kids: {
        'Bottom Wear': ['Pants', 'Shorts', 'Skirts', 'Leggings'],
        'Top Wear': ['T-Shirts', 'Shirts', 'Dresses', 'Jackets'],
        'Footwear': ['Sneakers', 'Sandals', 'School Shoes', 'Boots']
    },
    Other: {
        'Accessories': ['Bags', 'Belts', 'Watches', 'Sunglasses']
    }
};

const currentMainCat = "<?= $getData['p_main_category'] ?>";
const currentCatType = "<?= $getData['p_category_type'] ?>";
const currentSubCat = "<?= $getData['p_subcategory'] ?>";

document.addEventListener('DOMContentLoaded', function() {
    const mainCatSelect = document.getElementById('mainCategory');
    const catTypeSelect = document.getElementById('categoryType');
    const subCatSelect = document.getElementById('subCategory');

    function updateCategoryTypes() {
        const mainCat = mainCatSelect.value;
        catTypeSelect.innerHTML = '<option value="">Select Category Type</option>';
        subCatSelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (categories[mainCat]) {
            Object.keys(categories[mainCat]).forEach(categoryType => {
                const option = document.createElement('option');
                option.value = categoryType;
                option.text = categoryType;
                if (categoryType === currentCatType && mainCat === currentMainCat) {
                    option.selected = true;
                }
                catTypeSelect.appendChild(option);
            });
            updateSubCategories();
        }
    }

    function updateSubCategories() {
        const mainCat = mainCatSelect.value;
        const catType = catTypeSelect.value;
        subCatSelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (categories[mainCat] && categories[mainCat][catType]) {
            categories[mainCat][catType].forEach(subcat => {
                const option = document.createElement('option');
                option.value = subcat;
                option.text = subcat;
                if (subcat === currentSubCat && catType === currentCatType && mainCat === currentMainCat) {
                    option.selected = true;
                }
                subCatSelect.appendChild(option);
            });
        }
    }

    mainCatSelect.addEventListener('change', updateCategoryTypes);
    catTypeSelect.addEventListener('change', updateSubCategories);
    updateCategoryTypes();
});
</script>

<?php include "includes/footer.php" ?>