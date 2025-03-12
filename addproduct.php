<?php
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location:login.php");
}
include "includes/connection.php";
include "includes/header.php";
$success = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Pname = $_POST['P_name'];
    $brand = $_POST['P_brand'];
    $price = $_POST['P_Price'];
    $s_desc = $_POST['P_short_description'];
    $l_desc = $_POST['P_long_description'];
    $main_category = $_POST['P_main_category'];
    $category_type = $_POST['P_category_type'];
    $subcategory = $_POST['P_subcategory'];
    
    // Image validation
    $data = $_FILES["P_image"];
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $max_file_size = 5 * 1024 * 1024; // 2MB in bytes
    
    if ($data['error'] === UPLOAD_ERR_OK) {
        $file_extension = strtolower(pathinfo($data["name"], PATHINFO_EXTENSION));
        $file_size = $data["size"];
        
        if (!in_array($file_extension, $allowed_extensions)) {
            $error = "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
        } elseif ($file_size > $max_file_size) {
            $error = "Image file size exceeds 2MB limit.";
        } else {
            $src = $data["tmp_name"];
            $dest = __DIR__ . "/assets/products/" . $data["name"];
            if (move_uploaded_file($src, $dest)) {
                $fname = $data["name"];
                $stmt = $conn->prepare("INSERT INTO product(p_name, p_brand, p_price, p_shortdes, p_longdes, p_image, p_main_category, p_category_type, p_subcategory) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssssss", $Pname, $brand, $price, $s_desc, $l_desc, $fname, $main_category, $category_type, $subcategory);
                if ($stmt->execute()) {
                    $success = true;
                }
                $stmt->close();
            } else {
                $error = "Failed to upload image.";
            }
        }
    } else {
        $error = "Error uploading file: " . $data['error'];
    }
}
?>

<main id="main" class="main" >
    <?php if ($success) : ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="border-radius: 12px; padding: 1rem 1.5rem; background: #f0fdf4; border: 1px solid #86efac; 
                    box-shadow: 0 3px 12px rgba(0,100,0,0.06);">
            <i class="bi bi-check-circle" style="color: #22c55e;"></i>
            <span style="color: #166534; font-weight: 500;">Product Added Successfully!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($error) : ?>
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
                <h1 style="font-size: 1.75rem; font-weight: 600; color: #374151; letter-spacing: -0.025rem;">Add Product</h1>
                <nav>
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" 
                             style="color: #60a5fa; text-decoration: none; transition: color 0.3s ease;"
                             onmouseover="this.style.color='#3b82f6'" 
                             onmouseout="this.style.color='#60a5fa'">Administration</a></li>
                        <li class="breadcrumb-item active" style="color: #9ca3af; font-weight: 500;">Add Product</li>
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
                        <form method="post" class="mt-2" enctype="multipart/form-data" id="productForm">
                            <div class="row mb-4">
                                <label for="P_name" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Name <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="P_name" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="P_brand" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Brand Name <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="P_brand" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="P_Price" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Price <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="number" name="P_Price" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="P_short_description" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Short Description</label>
                                <div class="col-sm-8">
                                    <input type="text" name="P_short_description" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="P_long_description" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Long Description</label>
                                <div class="col-sm-8">
                                    <input type="text" name="P_long_description" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Category Selection -->
                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Main Category <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="P_main_category" id="mainCategory" 
                                            style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                   transition: all 0.3s ease;" required>
                                        <option value="Men">Men</option>
                                        <option value="Women">Women</option>
                                        <option value="Kids">Kids</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Category Type <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="P_category_type" id="categoryType" 
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
                                    <select class="form-select" name="P_subcategory" id="subCategory" 
                                            style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                   transition: all 0.3s ease;" required>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="P_image" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Image <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="file" name="P_image" id="P_image" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required accept="image/jpeg,image/png">
                                    <small class="form-text text-muted" style="font-size: 0.85rem; color: #6b7280;">
                                        Only JPG, JPEG, PNG allowed. Max size: 2MB
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-end">
                                    <button type="submit" name="saveuser" class="btn" 
                                            style="background: #60a5fa; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; 
                                                   font-weight: 500; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(96,165,250,0.2);"
                                            onmouseover="this.style.background='#3b82f6'; this.style.boxShadow='0 4px 12px rgba(96,165,250,0.3)'"
                                            onmouseout="this.style.background='#60a5fa'; this.style.boxShadow='0 2px 8px rgba(96,165,250,0.2)'">
                                        Add Product
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

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .form-text {
        margin-top: 0.25rem;
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

document.addEventListener('DOMContentLoaded', function() {
    const mainCatSelect = document.getElementById('mainCategory');
    const catTypeSelect = document.getElementById('categoryType');
    const subCatSelect = document.getElementById('subCategory');
    const form = document.getElementById('productForm');
    const imageInput = document.getElementById('P_image');

    function updateCategoryTypes() {
        const mainCat = mainCatSelect.value;
        catTypeSelect.innerHTML = '<option value="">Select Category Type</option>';
        subCatSelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (categories[mainCat]) {
            Object.keys(categories[mainCat]).forEach(categoryType => {
                const option = document.createElement('option');
                option.value = categoryType;
                option.text = categoryType;
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
                subCatSelect.appendChild(option);
            });
        }
    }

    mainCatSelect.addEventListener('change', updateCategoryTypes);
    catTypeSelect.addEventListener('change', updateSubCategories);
    updateCategoryTypes();

    // Client-side image validation
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Only JPG, JPEG, and PNG are allowed.');
                this.value = '';
                this.classList.add('is-invalid');
            } else if (file.size > maxSize) {
                alert('File size exceeds 2MB limit.');
                this.value = '';
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        }
    });

    form.addEventListener('submit', function(e) {
        const file = imageInput.files[0];
        if (!file) {
            e.preventDefault();
            alert('Please select an image.');
            imageInput.classList.add('is-invalid');
        }
    });
});
</script>

<?php include "includes/footer.php" ?>