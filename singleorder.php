<?php 
ob_start();
include "includes/header.php"; 
include "includes/session.php";
if ($_SESSION['username'] === '') {
    header("Location: pages-login.php");
    exit;
}
include "includes/connection.php";

// Check if connection is valid
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$success = false;

$stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$getData = $result->fetch_assoc();

$stmt1 = $conn->prepare("SELECT * from product_images WHERE prod_id = ?;");
$stmt1->bind_param("i", $id);
$stmt1->execute();
$result1 = $stmt1->get_result();



if (!$getData) {
    die("No vehicle found with ID: " . htmlspecialchars($id));
}

// Helper function to display values with "-" for null/empty
function displayValue($value) {
    return htmlspecialchars(empty($value) ? '-' : $value);
}

// Helper function to format "other_features" (assuming it's a comma-separated string)
function formatOtherFeatures($features) {
    if (empty($features)) {
        return '-';
    }
    // Split by comma, trim whitespace, and filter out empty items
    $featureList = array_filter(array_map('trim', explode(',', $features)));
    if (empty($featureList)) {
        return '-';
    }
    // Return as an unordered list
    return '<ul style="margin: 0; padding-left: 1rem;">' . 
           implode('', array_map(fn($item) => "<li>" . htmlspecialchars($item) . "</li>", $featureList)) . 
           '</ul>';
}
?>

<main id="main" class="main" style="padding: 2rem; min-height: 100vh; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; border-radius: 16px;">
    
    <!-- Success Alert (Optional) -->
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="position: relative; border-radius: 12px; padding: 1rem 1.25rem; background: #ecfdf5; border: none; 
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 450px; margin: 0 auto 2rem; font-size: 0.875rem;">
            <i class="bi bi-check-circle" style="color: #10b981; font-size: 1.25rem; margin-right: 0.5rem;"></i>
            <span style="color: #1f2937; font-weight: 600;">Vehicle Updated Successfully!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="opacity: 0.5;"></button>
        </div>
    <?php endif; ?>

    <!-- Page Title -->
    <div class="pagetitle" style="margin-bottom: 2rem; padding: 1rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
        <nav aria-label="breadcrumb" style="font-size: 0.75rem; color: #6b7280;">
            <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="index.php" style="color: #4b5563; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: #4b5563; text-decoration: none;">Vehicles</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #374151;">Vehicle Details</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <h5 style="font-weight: 700; color: #1f2937; letter-spacing: -0.025em;">
                Vehicle <span style="background: #3b82f6; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; font-size: 1.1rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><?= displayValue($getData['model_name']) ?></span>
            </h5>
            <div class="d-flex gap-2">
                <!-- <button class="btn btn-export" style="background: #ffffff; color: #4b5563; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                    Export PDF
                </button> -->
                <a href="editvehicle.php?id=<?= htmlspecialchars($id) ?>" class="btn btn-add" style="background: #3b82f6; color: #fff; border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease; text-decoration: none;">
                    Edit Vehicle
                </a>
            </div>
        </div>
        <p style="font-size: 1rem; color: #6b7280; margin-top: 0.5rem;">Detailed view of vehicle information.</p>
    </div>




    <!-- Vehicle Details Section -->
    <section class="section">
        <div class="card" style="border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.06); background: #ffffff; border: none; overflow: hidden; transition: all 0.3s ease;">
            <div class="card-body" style="padding: 2rem;">
                <!-- Grid Layout for Vehicle Details -->
                <div class="row g-4">
                <div class="col-lg-12">
                        <!-- Basic Vehicle Info -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Vehicle Images</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                 <div class="img-dime-wrapper">
                            <?php $count = 1; while ($getImages = $result1->fetch_assoc()) { ?>
      <a target="_blank" href="https://indowagen-v1-mq8p.vercel.app/products/<?= $getImages['img_link'] ?>">

      
            <img class="img-dime" src="https://indowagen-v1-mq8p.vercel.app/products/<?= $getImages['img_link'] ?>" />
            </a>
    <?php } ?>
                            </div>
                        </div>

                    </div>
                    </div>
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Basic Vehicle Info -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Basic Information</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                               
                                <p><strong>Model Name:</strong> <?= displayValue($getData['model_name']) ?></p>
                                <p><strong>URL:</strong> <?= displayValue($getData['url']) ?></p>
                                <p><strong>Category:</strong> <?= displayValue($getData['category']) ?></p>
                                <p><strong>Motor Type:</strong> <?= displayValue($getData['motor_type']) ?></p>
                                <p><strong>Controller:</strong> <?= displayValue($getData['controller']) ?></p>
                            </div>
                        </div>

                        <!-- Mechanical Specs -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Mechanical Specifications</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Shocker Size:</strong> <?= displayValue($getData['shocker_size']) ?></p>
                                <p><strong>Transmission:</strong> <?= displayValue($getData['transmission']) ?></p>
                                <p><strong>Max Speed:</strong> <?= displayValue($getData['max_speed']) ?></p>
                                <p><strong>Tyre Size:</strong> <?= displayValue($getData['tyre_size']) ?></p>
                                <p><strong>Brake Type:</strong> <?= displayValue($getData['brake_type']) ?></p>
                                <p><strong>Wheel Base:</strong> <?= displayValue($getData['wheel_base']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <!-- Capacity & Performance -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Capacity & Performance</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Load Capacity:</strong> <?= displayValue($getData['load_capacity']) ?></p>
                                <p><strong>No. of Passengers:</strong> <?= displayValue($getData['no_of_passengers']) ?></p>
                                <p><strong>Mileage:</strong> <?= displayValue($getData['mileage']) ?></p>
                                <p><strong>Chassis Weight:</strong> <?= displayValue($getData['chassis_weight']) ?></p>
                                <p><strong>Vehicle Weight:</strong> <?= displayValue($getData['vehicle_weight']) ?></p>
                            </div>
                        </div>

                        <!-- Battery & Charging -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Battery & Charging</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Charger Input Voltage:</strong> <?= displayValue($getData['charger_input_voltage']) ?></p>
                                <p><strong>Charger Output Voltage:</strong> <?= displayValue($getData['charger_output_voltage']) ?></p>
                                <p><strong>Battery Set:</strong> <?= displayValue($getData['battery_set']) ?></p>
                                <p><strong>Single Battery:</strong> <?= displayValue($getData['single_battery']) ?></p>
                                <p><strong>Charging Time:</strong> <?= displayValue($getData['charging_time']) ?></p>
                                <p><strong>Battery Quantity:</strong> <?= displayValue($getData['battery_quantity']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Section: Additional Features -->
                    <div class="col-12">
                        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Additional Features</h2>
                        <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Rear Rest Frame Slide:</strong> <?= displayValue($getData['rear_rest_frame_slide']) ?></p>
                                    <p><strong>Middle Rest Frame Slide:</strong> <?= displayValue($getData['middle_rest_frame_slide']) ?></p>
                                    <p><strong>Fog Light:</strong> <?= displayValue($getData['fog_light']) ?></p>
                                    <p><strong>Decorative Pipe Light:</strong> <?= displayValue($getData['decorative_pipe_light']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Water Guard Front:</strong> <?= displayValue($getData['water_guard_front']) ?></p>
                                    <p><strong>Water Guard Back:</strong> <?= displayValue($getData['water_guard_back']) ?></p>
                                    <p><strong>Coin Mobile Tray:</strong> <?= displayValue($getData['coin_mobile_tray']) ?></p>
                                    <p><strong>Dala Size:</strong> <?= displayValue($getData['dala_size']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Foot Mat:</strong> <?= displayValue($getData['foot_mat']) ?></p>
                                    <p><strong>Music System:</strong> <?= displayValue($getData['music_system']) ?></p>
                                    <p><strong>Stepney:</strong> <?= displayValue($getData['stepney']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Full-width Section: Other Features -->
                    <div class="col-12">
                        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Other Features</h2>
                        <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                            <p><?= formatOtherFeatures($getData['other_features']) ?></p>
                        </div>
                    </div>

                    <!-- Full-width Section: Dimensions & Tools -->
                    <div class="col-12">
                        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Dimensions & Tools</h2>
                        <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Length (mm):</strong> <?= displayValue($getData['length_mm']) ?></p>
                                    <p><strong>Width (mm):</strong> <?= displayValue($getData['width_mm']) ?></p>
                                    <p><strong>Height (mm):</strong> <?= displayValue($getData['height_mm']) ?></p>
                                    <p><strong>Gap Middle Rear Seat:</strong> <?= displayValue($getData['gap_middle_rear_seat']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Tools:</strong> <?= displayValue($getData['tools']) ?></p>
                                    <p><strong>Screw Driver:</strong> <?= displayValue($getData['screw_driver']) ?></p>
                                    <p><strong>Jack Handle:</strong> <?= displayValue($getData['jack_handle']) ?></p>
                                    <p><strong>Wheel Wrench:</strong> <?= displayValue($getData['wheel_wrench']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Spanner:</strong> <?= displayValue($getData['spanner']) ?></p>
                                    <p><strong>Hydraulic Jack:</strong> <?= displayValue($getData['hydraulic_jack']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .main {
        margin: 0 auto;
        padding: 2rem;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .details-box {
        transition: all 0.3s ease;
    }

    .details-box:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .details-box p {
        margin: 0.5rem 0;
        font-size: 0.875rem;
        color: #374151;
    }

    .details-box strong {
        color: #1f2937;
        font-weight: 600;
        display: inline-block;
        min-width: 150px;
    }

    .btn-add:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .btn-export:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    @media (max-width: 768px) {
        .main {
            padding: 1.5rem;
            border-radius: 0;
        }
        .pagetitle h1 {
            font-size: 1.5rem;
        }
        .details-box strong {
            min-width: 100px;
        }
    }
    .img-dime {
        height: 100px;
    }
    .img-dime-wrapper {
        display: flex;
    }
</style>

<?php include "includes/footer.php" ?>