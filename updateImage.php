<?php
include "includes/connection.php";
include "includes/header.php";

$id = $_GET['p_id'];
$success = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_FILES["fur_image"];
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
            $fname = $data["name"];
            
            if (move_uploaded_file($src, $dest)) {
                $query = "UPDATE product SET p_image = ? WHERE p_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $fname, $id);
                
                if ($stmt->execute()) {
                    $success = true;
                    header("Location: ./viewproducts.php?success=1");
                    exit();
                } else {
                    $error = "Error updating image: " . $conn->error;
                }
                $stmt->close();
            } else {
                $error = "Failed to upload image.";
            }
        }
    } else {
        $error = "Error uploading file: " . $data['error'];
    }
    mysqli_close($conn);
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
                <h1 style="font-size: 1.75rem; font-weight: 600; color: #374151; letter-spacing: -0.025rem;">Edit Product Image</h1>
                <nav>
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" 
                             style="color: #60a5fa; text-decoration: none; transition: color 0.3s ease;"
                             onmouseover="this.style.color='#3b82f6'" 
                             onmouseout="this.style.color='#60a5fa'">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #9ca3af; font-weight: 500;">Edit Product Image</li>
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
                        <form method="post" class="mt-2" enctype="multipart/form-data" id="updateImageForm">
                            <div class="row mb-4">
                                <label for="fur_image" class="col-sm-4 col-form-label" 
                                       style="color: #374151; font-weight: 500;">Product Image <span class="red" style="color: #ef4444;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="file" name="fur_image" id="fur_image" class="form-control" 
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
                                        Update Product Image
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
    .form-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96,165,250,0.2);
        outline: none;
    }

    .form-control:hover {
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('updateImageForm');
    const imageInput = document.getElementById('fur_image');

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