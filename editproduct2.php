<?php
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location: login.php");
}
include "includes/connection.php";
include "includes/header.php";

$success = false;
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch existing vehicle data
$stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$getData = $result->fetch_assoc();
$stmt->close();

if (!$getData) {
    $error = "Vehicle not found.";
}

// Fetch existing images
$existing_images = [];
if (!$error) {
    $stmt_images = $conn->prepare("SELECT id, img_link FROM product_images WHERE prod_id = ?");
    $stmt_images->bind_param("i", $id);
    $stmt_images->execute();
    $result_images = $stmt_images->get_result();
    while ($row = $result_images->fetch_assoc()) {
        $existing_images[] = $row;
    }
    $stmt_images->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $model_name = $_POST['model_name'] ?? '';
    $url = $_POST['url'] ?? '';
    $category = $_POST['category'] ?? '';
    $motor_type = $_POST['motor_type'] ?? '';
    $controller = $_POST['controller'] ?? '';
    $shocker_size = $_POST['shocker_size'] ?? '';
    $transmission = $_POST['transmission'] ?? '';
    $max_speed = $_POST['max_speed'] ?? '';
    $tyre_size = $_POST['tyre_size'] ?? '';
    $brake_type = $_POST['brake_type'] ?? '';
    $wheel_base = $_POST['wheel_base'] ?? '';
    $load_capacity = $_POST['load_capacity'] ?? '';
    $no_of_passengers = $_POST['no_of_passengers'] ?? '';
    $mileage = $_POST['mileage'] ?? '';
    $chassis_weight = $_POST['chassis_weight'] ?? '';
    $vehicle_weight = $_POST['vehicle_weight'] ?? '';
    $charger_input_voltage = $_POST['charger_input_voltage'] ?? '';
    $charger_output_voltage = $_POST['charger_output_voltage'] ?? '';
    $battery_set = $_POST['battery_set'] ?? '';
    $single_battery = $_POST['single_battery'] ?? '';
    $charging_time = $_POST['charging_time'] ?? '';
    $battery_quantity = $_POST['battery_quantity'] ?? '';
    $rear_rest_frame_slide = $_POST['rear_rest_frame_slide'] ?? '';
    $middle_rest_frame_slide = $_POST['middle_rest_frame_slide'] ?? '';
    $fog_light = $_POST['fog_light'] ?? '';
    $decorative_pipe_light = $_POST['decorative_pipe_light'] ?? '';
    $water_guard_front = $_POST['water_guard_front'] ?? '';
    $water_guard_back = $_POST['water_guard_back'] ?? '';
    $coin_mobile_tray = $_POST['coin_mobile_tray'] ?? '';
    $dala_size = $_POST['dala_size'] ?? '';
    $foot_mat = $_POST['foot_mat'] ?? '';
    $music_system = $_POST['music_system'] ?? '';
    $stepney = $_POST['stepney'] ?? '';
    $other_features = $_POST['other_features'] ?? '';
    $length_mm = $_POST['length_mm'] ?? '';
    $width_mm = $_POST['width_mm'] ?? '';
    $height_mm = $_POST['height_mm'] ?? '';
    $gap_middle_rear_seat = $_POST['gap_middle_rear_seat'] ?? '';
    $tools = $_POST['tools'] ?? '';
    $screw_driver = $_POST['screw_driver'] ?? '';
    $jack_handle = $_POST['jack_handle'] ?? '';
    $wheel_wrench = $_POST['wheel_wrench'] ?? '';
    $spanner = $_POST['spanner'] ?? '';
    $hydraulic_jack = $_POST['hydraulic_jack'] ?? '';

    // Handle image deletions
    $images_to_delete = isset($_POST['delete_images']) ? $_POST['delete_images'] : [];
    foreach ($images_to_delete as $image_id) {
        $stmt_delete = $conn->prepare("SELECT img_link FROM product_images WHERE id = ? AND prod_id = ?");
        $stmt_delete->bind_param("ii", $image_id, $id);
        $stmt_delete->execute();
        $result_delete = $stmt_delete->get_result();
        if ($row = $result_delete->fetch_assoc()) {
            $file_path = __DIR__ . "/assets/products/" . $row['img_link'];
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file from the server
            }
            $stmt_delete_image = $conn->prepare("DELETE FROM product_images WHERE id = ? AND prod_id = ?");
            $stmt_delete_image->bind_param("ii", $image_id, $id);
            $stmt_delete_image->execute();
            $stmt_delete_image->close();
        }
        $stmt_delete->close();
    }

    // Handle new image uploads
    $images = $_FILES['images'] ?? [];
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $max_file_size = 5 * 1024 * 1024; // 5MB in bytes
    $uploaded_images = [];

    if (!empty($images['name'][0])) {
        foreach ($images['name'] as $key => $image_name) {
            if ($images['error'][$key] === UPLOAD_ERR_OK) {
                $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $file_size = $images['size'][$key];

                if (!in_array($file_extension, $allowed_extensions)) {
                    $error = "Invalid image format for file '$image_name'. Only JPG, JPEG, and PNG are allowed.";
                    break;
                } elseif ($file_size > $max_file_size) {
                    $error = "Image file '$image_name' exceeds 5MB limit.";
                    break;
                } else {
                    $src = $images['tmp_name'][$key];
                    $dest = __DIR__ . "/assets/products/" . $image_name;
                    if (move_uploaded_file($src, $dest)) {
                        $uploaded_images[] = $image_name;
                    } else {
                        $error = "Failed to upload image '$image_name'.";
                        break;
                    }
                }
            } else {
                $error = "Error uploading file '$image_name': " . $images['error'][$key];
                break;
            }
        }
    }

    if (empty($error)) {
        // Update vehicle data
        $stmt = $conn->prepare("UPDATE vehicles SET model_name = ?, url = ?, category = ?, motor_type = ?, controller = ?, shocker_size = ?, transmission = ?, max_speed = ?, tyre_size = ?, brake_type = ?, wheel_base = ?, load_capacity = ?, no_of_passengers = ?, mileage = ?, chassis_weight = ?, vehicle_weight = ?, charger_input_voltage = ?, charger_output_voltage = ?, battery_set = ?, single_battery = ?, charging_time = ?, battery_quantity = ?, rear_rest_frame_slide = ?, middle_rest_frame_slide = ?, fog_light = ?, decorative_pipe_light = ?, water_guard_front = ?, water_guard_back = ?, coin_mobile_tray = ?, dala_size = ?, foot_mat = ?, music_system = ?, stepney = ?, other_features = ?, length_mm = ?, width_mm = ?, height_mm = ?, gap_middle_rear_seat = ?, tools = ?, screw_driver = ?, jack_handle = ?, wheel_wrench = ?, spanner = ?, hydraulic_jack = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssi", $model_name, $url, $category, $motor_type, $controller, $shocker_size, $transmission, $max_speed, $tyre_size, $brake_type, $wheel_base, $load_capacity, $no_of_passengers, $mileage, $chassis_weight, $vehicle_weight, $charger_input_voltage, $charger_output_voltage, $battery_set, $single_battery, $charging_time, $battery_quantity, $rear_rest_frame_slide, $middle_rest_frame_slide, $fog_light, $decorative_pipe_light, $water_guard_front, $water_guard_back, $coin_mobile_tray, $dala_size, $foot_mat, $music_system, $stepney, $other_features, $length_mm, $width_mm, $height_mm, $gap_middle_rear_seat, $tools, $screw_driver, $jack_handle, $wheel_wrench, $spanner, $hydraulic_jack, $id);

        if ($stmt->execute()) {
            // Insert new images into product_images table
            if (!empty($uploaded_images)) {
                $stmt_images = $conn->prepare("INSERT INTO product_images (prod_id, img_link) VALUES (?, ?)");
                foreach ($uploaded_images as $image_name) {
                    $stmt_images->bind_param("is", $id, $image_name);
                    $stmt_images->execute();
                }
                $stmt_images->close();
            }

            $success = true;
            // Redirect to singleorder2.php with success message
            header("Location: singleorder2.php?id=$id&success=1");
            exit;
        } else {
            $error = "Failed to update vehicle: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<main id="main" class="main">
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
                <h1 style="font-size: 1.75rem; font-weight: 600; color: #374151; letter-spacing: -0.025rem;">Edit Vehicle</h1>
                <nav>
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" 
                             style="color: #60a5fa; text-decoration: none; transition: color 0.3s ease;"
                             onmouseover="this.style.color='#3b82f6'" 
                             onmouseout="this.style.color='#60a5fa'">Administration</a></li>
                        <li class="breadcrumb-item active" style="color: #9ca3af; font-weight: 500;">Edit Vehicle</li>
                    </ol>
                </nav>
            </div>
            <a href="singleorder2.php?id=<?= htmlspecialchars($id) ?>" class="btn" 
               style="background: #e5e7eb; color: #374151; border-radius: 8px; padding: 0.6rem 1.2rem; font-weight: 500; 
                      transition: all 0.3s ease;"
               onmouseover="this.style.background='#d1d5db'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)'"
               onmouseout="this.style.background='#e5e7eb'; this.style.boxShadow='none'">
                <i class="bi bi-arrow-left me-1"></i> Back to Vehicle Details
            </a>
        </div>
    </div>
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); 
                                       background: #ffffff;">
                    <div class="card-body" style="padding: 2rem;">
                        <form method="post" class="mt-2" enctype="multipart/form-data" id="vehicleForm">
                            <!-- Basic Information -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Basic Information</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="model_name" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Model Name <span class="red" style="color: #ef4444;">*</span></label>
                                    <input type="text" name="model_name" class="form-control" 
                                           value="<?= htmlspecialchars($getData['model_name'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="url" class="form-label" 
                                           style="color: #374151; font-weight: 500;">URL</label>
                                    <input type="text" name="url" class="form-control" 
                                           value="<?= htmlspecialchars($getData['url'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Category <span class="red" style="color: #ef4444;">*</span></label>
                                    <input type="text" name="category" class="form-control" 
                                           value="<?= htmlspecialchars($getData['category'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="motor_type" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Motor Type</label>
                                    <input type="text" name="motor_type" class="form-control" 
                                           value="<?= htmlspecialchars($getData['motor_type'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="controller" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Controller</label>
                                    <input type="text" name="controller" class="form-control" 
                                           value="<?= htmlspecialchars($getData['controller'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" 
                                           style="color: #374151; font-weight: 500;">Existing Images</label>
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        <?php if (!empty($existing_images)): ?>
                                            <?php foreach ($existing_images as $image): ?>
                                                <div class="position-relative">
                                                    <img src="../dashboard/assets/products/<?= htmlspecialchars($image['img_link']) ?>" 
                                                         style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;" 
                                                         alt="Vehicle Image">
                                                    <input type="checkbox" name="delete_images[]" value="<?= $image['id'] ?>" 
                                                           class="position-absolute" style="top: 5px; right: 5px;">
                                                    <small class="form-text text-muted" style="font-size: 0.75rem;">Delete</small>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-muted">No images available.</p>
                                        <?php endif; ?>
                                    </div>
                                    <label for="images" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Add New Images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;" multiple accept="image/jpeg,image/png">
                                    <small class="form-text text-muted" style="font-size: 0.85rem; color: #6b7280;">
                                        Only JPG, JPEG, PNG allowed. Max size: 5MB per image.
                                    </small>
                                </div>
                            </div>

                            <!-- Mechanical Specifications -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Mechanical Specifications</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="shocker_size" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Shocker Size</label>
                                    <input type="text" name="shocker_size" class="form-control" 
                                           value="<?= htmlspecialchars($getData['shocker_size'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="transmission" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Transmission</label>
                                    <input type="text" name="transmission" class="form-control" 
                                           value="<?= htmlspecialchars($getData['transmission'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="max_speed" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Max Speed</label>
                                    <input type="text" name="max_speed" class="form-control" 
                                           value="<?= htmlspecialchars($getData['max_speed'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="tyre_size" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Tyre Size</label>
                                    <input type="text" name="tyre_size" class="form-control" 
                                           value="<?= htmlspecialchars($getData['tyre_size'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="brake_type" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Brake Type</label>
                                    <input type="text" name="brake_type" class="form-control" 
                                           value="<?= htmlspecialchars($getData['brake_type'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="wheel_base" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Wheel Base</label>
                                    <input type="text" name="wheel_base" class="form-control" 
                                           value="<?= htmlspecialchars($getData['wheel_base'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Capacity & Performance -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Capacity & Performance</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="load_capacity" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Load Capacity</label>
                                    <input type="text" name="load_capacity" class="form-control" 
                                           value="<?= htmlspecialchars($getData['load_capacity'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="no_of_passengers" class="form-label" 
                                           style="color: #374151; font-weight: 500;">No. of Passengers</label>
                                    <input type="number" name="no_of_passengers" class="form-control" 
                                           value="<?= htmlspecialchars($getData['no_of_passengers'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="mileage" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Mileage</label>
                                    <input type="text" name="mileage" class="form-control" 
                                           value="<?= htmlspecialchars($getData['mileage'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="chassis_weight" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Chassis Weight</label>
                                    <input type="text" name="chassis_weight" class="form-control" 
                                           value="<?= htmlspecialchars($getData['chassis_weight'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="vehicle_weight" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Vehicle Weight</label>
                                    <input type="text" name="vehicle_weight" class="form-control" 
                                           value="<?= htmlspecialchars($getData['vehicle_weight'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Battery & Charging -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Battery & Charging</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="charger_input_voltage" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Charger Input Voltage</label>
                                    <input type="text" name="charger_input_voltage" class="form-control" 
                                           value="<?= htmlspecialchars($getData['charger_input_voltage'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="charger_output_voltage" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Charger Output Voltage</label>
                                    <input type="text" name="charger_output_voltage" class="form-control" 
                                           value="<?= htmlspecialchars($getData['charger_output_voltage'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="battery_set" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Battery Set</label>
                                    <input type="text" name="battery_set" class="form-control" 
                                           value="<?= htmlspecialchars($getData['battery_set'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="single_battery" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Single Battery</label>
                                    <input type="text" name="single_battery" class="form-control" 
                                           value="<?= htmlspecialchars($getData['single_battery'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="charging_time" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Charging Time</label>
                                    <input type="text" name="charging_time" class="form-control" 
                                           value="<?= htmlspecialchars($getData['charging_time'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="battery_quantity" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Battery Quantity</label>
                                    <input type="number" name="battery_quantity" class="form-control" 
                                           value="<?= htmlspecialchars($getData['battery_quantity'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Additional Features -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Additional Features</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="rear_rest_frame_slide" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Rear Rest Frame Slide</label>
                                    <input type="text" name="rear_rest_frame_slide" class="form-control" 
                                           value="<?= htmlspecialchars($getData['rear_rest_frame_slide'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="middle_rest_frame_slide" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Middle Rest Frame Slide</label>
                                    <input type="text" name="middle_rest_frame_slide" class="form-control" 
                                           value="<?= htmlspecialchars($getData['middle_rest_frame_slide'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="fog_light" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Fog Light</label>
                                    <input type="text" name="fog_light" class="form-control" 
                                           value="<?= htmlspecialchars($getData['fog_light'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="decorative_pipe_light" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Decorative Pipe Light</label>
                                    <input type="text" name="decorative_pipe_light" class="form-control" 
                                           value="<?= htmlspecialchars($getData['decorative_pipe_light'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="water_guard_front" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Water Guard Front</label>
                                    <input type="text" name="water_guard_front" class="form-control" 
                                           value="<?= htmlspecialchars($getData['water_guard_front'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="water_guard_back" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Water Guard Back</label>
                                    <input type="text" name="water_guard_back" class="form-control" 
                                           value="<?= htmlspecialchars($getData['water_guard_back'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="coin_mobile_tray" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Coin Mobile Tray</label>
                                    <input type="text" name="coin_mobile_tray" class="form-control" 
                                           value="<?= htmlspecialchars($getData['coin_mobile_tray'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="dala_size" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Dala Size</label>
                                    <input type="text" name="dala_size" class="form-control" 
                                           value="<?= htmlspecialchars($getData['dala_size'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="foot_mat" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Foot Mat</label>
                                    <input type="text" name="foot_mat" class="form-control" 
                                           value="<?= htmlspecialchars($getData['foot_mat'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="music_system" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Music System</label>
                                    <input type="text" name="music_system" class="form-control" 
                                           value="<?= htmlspecialchars($getData['music_system'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="stepney" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Stepney</label>
                                    <input type="text" name="stepney" class="form-control" 
                                           value="<?= htmlspecialchars($getData['stepney'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Other Features -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Other Features</h2>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="other_features" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Other Features</label>
                                    <textarea name="other_features" class="form-control" 
                                              style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                     transition: all 0.3s ease;" rows="3"><?= htmlspecialchars($getData['other_features'] ?? '') ?></textarea>
                                    <small class="form-text text-muted" style="font-size: 0.85rem; color: #6b7280;">
                                        Enter features as a comma-separated list (e.g., "Feature1, Feature2, Feature3").
                                    </small>
                                </div>
                            </div>

                            <!-- Dimensions & Tools -->
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Dimensions & Tools</h2>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="length_mm" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Length (mm)</label>
                                    <input type="text" name="length_mm" class="form-control" 
                                           value="<?= htmlspecialchars($getData['length_mm'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="width_mm" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Width (mm)</label>
                                    <input type="text" name="width_mm" class="form-control" 
                                           value="<?= htmlspecialchars($getData['width_mm'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="height_mm" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Height (mm)</label>
                                    <input type="text" name="height_mm" class="form-control" 
                                           value="<?= htmlspecialchars($getData['height_mm'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="gap_middle_rear_seat" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Gap Middle Rear Seat</label>
                                    <input type="text" name="gap_middle_rear_seat" class="form-control" 
                                           value="<?= htmlspecialchars($getData['gap_middle_rear_seat'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="tools" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Tools</label>
                                    <input type="text" name="tools" class="form-control" 
                                           value="<?= htmlspecialchars($getData['tools'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="screw_driver" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Screw Driver</label>
                                    <input type="text" name="screw_driver" class="form-control" 
                                           value="<?= htmlspecialchars($getData['screw_driver'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jack_handle" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Jack Handle</label>
                                    <input type="text" name="jack_handle" class="form-control" 
                                           value="<?= htmlspecialchars($getData['jack_handle'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="wheel_wrench" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Wheel Wrench</label>
                                    <input type="text" name="wheel_wrench" class="form-control" 
                                           value="<?= htmlspecialchars($getData['wheel_wrench'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                                <div class="col-md-4">
                                    <label for="spanner" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Spanner</label>
                                    <input type="text" name="spanner" class="form-control" 
                                           value="<?= htmlspecialchars($getData['spanner'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="hydraulic_jack" class="form-label" 
                                           style="color: #374151; font-weight: 500;">Hydraulic Jack</label>
                                    <input type="text" name="hydraulic_jack" class="form-control" 
                                           value="<?= htmlspecialchars($getData['hydraulic_jack'] ?? '') ?>" 
                                           style="border-radius: 8px; border: 1px solid #d1d5db; padding: 0.6rem 1rem; 
                                                  transition: all 0.3s ease;">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-sm-12 text-end">
                                    <button type="submit" name="updatevehicle" class="btn" 
                                            style="background: #60a5fa; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; 
                                                   font-weight: 500; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(96,165,250,0.2);"
                                            onmouseover="this.style.background='#3b82f6'; this.style.boxShadow='0 4px 12px rgba(96,165,250,0.3)'"
                                            onmouseout="this.style.background='#60a5fa'; this.style.boxShadow='0 2px 8px rgba(96,165,250,0.2)'">
                                        Update Vehicle
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
    .form-control:focus, .form-select:focus, .form-check-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96,165,250,0.2);
        outline: none;
    }

    .form-control:hover, .form-select:hover, .form-check-input:hover {
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
        .row.mb-3 {
            margin-bottom: 1rem !important;
        }
        .col-md-4 {
            margin-bottom: 1rem;
        }
        .btn {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vehicleForm');
    const imageInput = document.getElementById('images');

    // Client-side image validation
    imageInput.addEventListener('change', function() {
        const files = this.files;
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!allowedTypes.includes(file.type)) {
                alert(`Invalid file type for ${file.name}. Only JPG, JPEG, and PNG are allowed.`);
                this.value = '';
                this.classList.add('is-invalid');
                return;
            } else if (file.size > maxSize) {
                alert(`File size for ${file.name} exceeds 5MB limit.`);
                this.value = '';
                this.classList.add('is-invalid');
                return;
            } else {
                this.classList.remove('is-invalid');
            }
        }
    });
});
</script>

<?php include "includes/footer.php" ?>