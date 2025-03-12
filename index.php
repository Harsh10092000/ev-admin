<?php
ob_start();
include "includes/header.php";
include "includes/session.php"; 
if ($_SESSION['username'] === '') {
    header("Location:login.php");
}
include "includes/connection.php";

// Fetch product counts by main category
$stmt_men = $conn->prepare("SELECT COUNT(*) as men_count FROM product WHERE p_main_category = 'Men'");
$stmt_men->execute();
$men_result = $stmt_men->get_result()->fetch_assoc();
$men_count = $men_result['men_count'];

$stmt_women = $conn->prepare("SELECT COUNT(*) as women_count FROM product WHERE p_main_category = 'Women'");
$stmt_women->execute();
$women_result = $stmt_women->get_result()->fetch_assoc();
$women_count = $women_result['women_count'];

$stmt_kids = $conn->prepare("SELECT COUNT(*) as kids_count FROM product WHERE p_main_category = 'Kids'");
$stmt_kids->execute();
$kids_result = $stmt_kids->get_result()->fetch_assoc();
$kids_count = $kids_result['kids_count'];

$stmt_other = $conn->prepare("SELECT COUNT(*) as other_count FROM product WHERE p_main_category = 'Other'");
$stmt_other->execute();
$other_result = $stmt_other->get_result()->fetch_assoc();
$other_count = $other_result['other_count'];

// Fetch top brands by product count (limited to top 5)
$stmt_brands = $conn->prepare("SELECT p_brand, COUNT(*) as brand_count FROM product GROUP BY p_brand ORDER BY brand_count DESC LIMIT 5");
$stmt_brands->execute();
$brands_result = $stmt_brands->get_result();
$top_brands = [];
while ($row = $brands_result->fetch_assoc()) {
    $top_brands[] = $row;
}

// Fetch top subcategories by product count (limited to top 5)
$stmt_subcats = $conn->prepare("SELECT p_subcategory, COUNT(*) as subcat_count FROM product GROUP BY p_subcategory ORDER BY subcat_count DESC LIMIT 5");
$stmt_subcats->execute();
$subcats_result = $stmt_subcats->get_result();
$top_subcats = [];
while ($row = $subcats_result->fetch_assoc()) {
    $top_subcats[] = $row;
}

// Clean up
$stmt_men->close();
$stmt_women->close();
$stmt_kids->close();
$stmt_other->close();
//$stmt_blass="card-body"rands->close();
$stmt_subcats->close();
?>

<main id="main" class="main" >
    <div class="pagetitle mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 1.75rem; font-weight: 600; color: #374151; letter-spacing: -0.025rem;">Dashboard</h1>
                <nav>
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" 
                            style="color: #60a5fa; text-decoration: none; transition: color 0.3s ease;"
                            onmouseover="this.style.color='#3b82f6'" 
                            onmouseout="this.style.color='#60a5fa'">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #9ca3af; font-weight: 500;">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Main Category Cards -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Men's Products Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.1rem;">Men's Products <span style="color: #6b7280; font-weight: 400;">| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; background: #dbeafe; color: #60a5fa;">
                                        <i class="bi bi-person-standing"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 1.5rem; font-weight: 600; color: #374151;"><?php echo $men_count; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Men's Products Card -->

                    <!-- Women's Products Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.1rem;">Women's Products <span style="color: #6b7280; font-weight: 400;">| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; background: #fce7f3; color: #ec4899;">
                                        <i class="bi bi-person-standing-dress"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 1.5rem; font-weight: 600; color: #374151;"><?php echo $women_count; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Women's Products Card -->

                    <!-- Kids' Products Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.1rem;">Kids' Products <span style="color: #6b7280; font-weight: 400;">| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; background: #d1fae5; color: #10b981;">
                                        <i class="bi bi-emoji-smile"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 1.5rem; font-weight: 600; color: #374151;"><?php echo $kids_count; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Kids' Products Card -->

                    <!-- Other Products Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.1rem;">Other Products <span style="color: #6b7280; font-weight: 400;">| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; background: #e5e7eb; color: #6b7280;">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 1.5rem; font-weight: 600; color: #374151;"><?php echo $other_count; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Other Products Card -->
                </div>
            </div><!-- End Main Category Cards -->

            <!-- Top Brands Card -->
            <div class="col-lg-6">
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                    <div class="card-body" style="padding: 1.5rem;">
                        <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.25rem;">Top Brands</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($top_brands as $brand): ?>
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: #6b7280; font-size: 0.95rem;"><?php echo htmlspecialchars($brand['p_brand']); ?></span>
                                    <span style="color: #374151; font-weight: 500; font-size: 0.95rem;"><?php echo $brand['brand_count']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div><!-- End Top Brands Card -->

            <!-- Top Subcategories Card -->
            <div class="col-lg-6">
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); background: #ffffff;">
                    <div class="card-body" style="padding: 1.5rem;">
                        <h5 class="card-title" style="color: #374151; font-weight: 500; font-size: 1.25rem;">Top Subcategories</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($top_subcats as $subcat): ?>
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: #6b7280; font-size: 0.95rem;"><?php echo htmlspecialchars($subcat['p_subcategory']); ?></span>
                                    <span style="color: #374151; font-weight: 500; font-size: 0.95rem;"><?php echo $subcat['subcat_count']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div><!-- End Top Subcategories Card -->
        </div>
    </section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include "includes/footer.php"; ?>