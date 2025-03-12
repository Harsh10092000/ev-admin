<main id="main" class="main" style="padding: 1.5rem; background: #f9fafb; min-height: 100vh; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;">
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="position: relative; border-radius: 8px; padding: 0.75rem 1rem; background: #f0fff4; border: 1px solid #c6f6d5; 
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-width: 400px; margin: 0 auto 1.5rem; font-size: 0.875rem;">
            <i class="bi bi-check-circle" style="color: #38a169; font-size: 1rem; margin-right: 0.5rem;"></i>
            <span style="color: #2d3748; font-weight: 500;">Successfully Updated!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="opacity: 0.5;"></button>
        </div>
    <?php endif; ?>

    <div class="pagetitle mb-4" style="margin-bottom: 1.5rem;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb" style="font-size: 0.75rem; color: #718096;">
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" style="color: #4a5568; text-decoration: none;">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" style="color: #4a5568; text-decoration: none;">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #4a5568;">All Products</li>
                    </ol>
                </nav>
                <h1 style="font-size: 1.5rem; font-weight: 600; color: #2d3748; margin-top: 0.5rem;">Products</h1>
                <p style="font-size: 0.875rem; color: #718096; margin-top: 0.25rem;">Manage your products and view their sales performance.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-export" style="background: #edf2f7; color: #4a5568; border-radius: 6px; padding: 0.5rem 1rem; 
                           font-size: 0.875rem; border: none; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    Export
                </button>
                <a href="addproduct.php" class="btn btn-add" style="background: #3182ce; color: #fff; border-radius: 6px; padding: 0.5rem 1rem; 
                    font-size: 0.875rem; text-decoration: none; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    Add Product
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card" style="border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); background: #fff; border: 1px solid #e2e8f0;">
            <div class="card-body p-0">
                <table class="datatable table table-hover mb-0" style="width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem;">
                    <thead style="background: #edf2f7; color: #4a5568; font-weight: 600;">
                        <tr>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Sno.</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Image</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Name</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Main Category</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Category</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Subcategory</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Brand</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Price</th>
                            <th style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; while ($getData = $result->fetch_assoc()) { ?>
                            <tr style="transition: all 0.2s ease; background: #fff;">
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #4a5568; font-weight: 500;">
                                    <?= $count++ ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle;">
                                    <a href="../dashboard/assets/products/<?= htmlspecialchars($getData['p_image']) ?>" target="_blank" style="text-decoration: none;">
                                        <img src="../dashboard/assets/products/<?= htmlspecialchars($getData['p_image']) ?>" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0; transition: all 0.2s ease;"
                                             onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" alt="Product Image">
                                    </a>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #2d3748; font-weight: 500;">
                                    <?= htmlspecialchars($getData['p_name']) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #4a5568;">
                                    <?= htmlspecialchars($getData['p_main_category']) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #4a5568;">
                                    <?= htmlspecialchars($getData['p_category_type']) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #4a5568;">
                                    <?= htmlspecialchars($getData['p_subcategory']) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #4a5568;">
                                    <?= htmlspecialchars($getData['p_brand']) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle; color: #2d3748; font-weight: 500;">
                                    ₹<?= number_format($getData['p_price'], 2) ?>
                                </td>
                                <td style="padding: 0.75rem 1rem; vertical-align: middle;">
                                    <div class="d-flex gap-2">
                                        <a href="editproduct2.php?id=<?= $getData['p_id'] ?>" class="btn btn-sm" 
                                           style="background: #edf2f7; color: #4a5568; border-radius: 6px; padding: 0.25rem 0.75rem; 
                                                  font-size: 0.75rem; transition: all 0.2s ease; text-decoration: none;"
                                           onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#edf2f7'">
                                            Edit
                                        </a>
                                        <a href="actions/deleteProduct.php?id=<?= $getData['p_id'] ?>" class="btn btn-sm" 
                                           style="background: #fed7d7; color: #742a2a; border-radius: 6px; padding: 0.25rem 0.75rem; 
                                                  font-size: 0.75rem; transition: all 0.2s ease; text-decoration: none;"
                                           onmouseover="this.style.background='#feb2b2'" onmouseout="this.style.background='#fed7d7'"
                                           onclick="return confirm('Are you sure you want to delete this product?');">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="table-footer" style="padding: 0.75rem 1rem; background: #edf2f7; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: #718096;">
                    <span>Showing 1-5 of 10 products</span>
                    <div>
                        <button class="btn btn-prev" style="background: none; border: none; color: #4a5568; padding: 0 0.5rem; cursor: pointer;">Prev</button>
                        <button class="btn btn-next" style="background: none; border: none; color: #4a5568; padding: 0 0.5rem; cursor: pointer;">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .table-hover tbody tr:hover {
        background: #f7fafc;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .table td, .table th {
        border-color: #e2e8f0;
    }

    .main {
        margin: 0 auto;
        /* max-width: 1200px; */
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-add:hover {
        background: #2b6cb0;
    }

    .btn-export:hover {
        background: #e2e8f0;
    }

    @media (max-width: 768px) {
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        .pagetitle h1 {
            font-size: 1.25rem;
        }
        .main {
            padding: 1rem;
        }
        .btn {
            padding: 0.25rem 0.5rem !important;
        }
    }

    .datatable-wrapper.no-header .datatable-container {
    border-top: 1px solid #e2e8f0; /* Updated to match table border color */
}

.datatable-wrapper.no-footer .datatable-container {
    border-bottom: 1px solid #e2e8f0; /* Updated to match table border color */
}

.datatable-top,
.datatable-bottom {
    padding: 0.75rem 1rem; /* Reduced padding to match the table footer */
    background: #edf2f7; /* Match the table footer background */
    border-top: 1px solid #e2e8f0; /* Add border to match table style */
    font-size: 0.75rem; /* Match font size of table footer */
    color: #718096; /* Match text color */
}

.datatable-top > nav:first-child,
.datatable-top > div:first-child,
.datatable-bottom > nav:first-child,
.datatable-bottom > div:first-child {
    float: left;
}

.datatable-top > nav:last-child,
.datatable-top > div:not(:first-child),
.datatable-bottom > nav:last-child,
.datatable-bottom > div:last-child {
    float: right;
}

.datatable-selector {
    padding: 0.5rem; /* Adjusted padding to match button sizes */
    border: 1px solid #e2e8f0; /* Match table border */
    border-radius: 6px; /* Match button border-radius */
    background: #fff; /* White background for dropdown */
    font-size: 0.875rem; /* Match table font size */
    color: #4a5568; /* Match text color */
}

.datatable-input {
    padding: 0.5rem 0.75rem; /* Adjusted padding to match search bar */
    border: 1px solid #e2e8f0; /* Match table border */
    border-radius: 6px; /* Match button border-radius */
    font-size: 0.875rem; /* Match table font size */
    color: #4a5568; /* Match text color */
    background: #fff; /* White background */
    outline: none; /* Remove default outline */
}

.datatable-info {
    margin: 7px 0;
    font-size: 0.75rem; /* Match table footer font size */
    color: #718096; /* Match text color */
}

/* PAGER */
.datatable-pagination ul {
    margin: 0;
    padding-left: 0;
}

.datatable-pagination li {
    list-style: none;
    float: left;
}

.datatable-pagination li.datatable-hidden {
    visibility: hidden;
}

.datatable-pagination a,
.datatable-pagination button {
    border: 1px solid #e2e8f0; /* Match table border */
    float: left;
    margin-left: 2px;
    padding: 0.25rem 0.75rem; /* Adjusted padding to match table buttons */
    position: relative;
    text-decoration: none;
    color: #4a5568; /* Match text color */
    cursor: pointer;
    background: #fff; /* White background for pagination buttons */
    border-radius: 6px; /* Match button border-radius */
    font-size: 0.75rem; /* Match table footer font size */
    transition: all 0.2s ease; /* Smooth transition */
}

.datatable-pagination a:hover,
.datatable-pagination button:hover {
    background-color: #e2e8f0; /* Match hover state of table buttons */
}

.datatable-pagination .datatable-active a,
.datatable-pagination .datatable-active a:focus,
.datatable-pagination .datatable-active a:hover,
.datatable-pagination .datatable-active button,
.datatable-pagination .datatable-active button:focus,
.datatable-pagination .datatable-active button:hover {
    background-color: #e2e8f0; /* Match active state */
    cursor: default;
}

.datatable-pagination .datatable-ellipsis a,
.datatable-pagination .datatable-disabled a,
.datatable-pagination .datatable-disabled a:focus,
.datatable-pagination .datatable-disabled a:hover,
.datatable-pagination .datatable-ellipsis button,
.datatable-pagination .datatable-disabled button,
.datatable-pagination .datatable-disabled button:focus,
.datatable-pagination .datatable-disabled button:hover {
    pointer-events: none;
    cursor: default;
}

.datatable-pagination .datatable-disabled a,
.datatable-pagination .datatable-disabled a:focus,
.datatable-pagination .datatable-disabled a:hover,
.datatable-pagination .datatable-disabled button,
.datatable-pagination .datatable-disabled button:focus,
.datatable-pagination .datatable-disabled button:hover {
    cursor: not-allowed;
    opacity: 0.4;
}

.datatable-pagination .datatable-pagination a,
.datatable-pagination .datatable-pagination button {
    font-weight: 500; /* Match table button font weight */
}

/* TABLE */
.datatable-table {
    max-width: 100%;
    width: 100%;
    border-spacing: 0;
    border-collapse: separate;
    font-size: 0.875rem; /* Match table font size */
}

.datatable-table > tbody > tr > td,
.datatable-table > tbody > tr > th,
.datatable-table > tfoot > tr > td,
.datatable-table > tfoot > tr > th,
.datatable-table > thead > tr > td,
.datatable-table > thead > tr > th {
    vertical-align: middle; /* Match table alignment */
    padding: 0.75rem 1rem; /* Match table padding */
}

.datatable-table > thead > tr > th {
    vertical-align: bottom;
    text-align: left;
    border-bottom: 1px solid #e2e8f0; /* Match table border */
    background: #edf2f7; /* Match table header background */
    color: #4a5568; /* Match text color */
    font-weight: 600; /* Match table header font weight */
}

.datatable-table > tfoot > tr > th {
    vertical-align: bottom;
    text-align: left;
    border-top: 1px solid #e2e8f0; /* Match table border */
}

.datatable-table th {
    vertical-align: bottom;
    text-align: left;
}

.datatable-table th a {
    text-decoration: none;
    color: inherit;
}

.datatable-table th button,
.datatable-pagination-list button {
    color: inherit;
    border: 0;
    background-color: inherit;
    cursor: pointer;
    text-align: inherit;
    font-family: inherit;
    font-weight: inherit;
    font-size: inherit;
}

.datatable-sorter, .datatable-filter {
    display: inline-block;
    height: 100%;
    position: relative;
    width: 100%;
}

.datatable-sorter::before,
.datatable-sorter::after {
    content: "";
    height: 0;
    width: 0;
    position: absolute;
    right: 4px;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    opacity: 0.2;
}

.datatable-sorter::before {
    border-top: 4px solid #4a5568; /* Match text color */
    bottom: 0px;
}

.datatable-sorter::after {
    border-bottom: 4px solid #4a5568; /* Match text color */
    border-top: 4px solid transparent;
    top: 0px;
}

.datatable-ascending .datatable-sorter::after,
.datatable-descending .datatable-sorter::before,
.datatable-ascending .datatable-filter::after,
.datatable-descending .datatable-filter::before {
    opacity: 0.6;
}

.datatable-filter::before {
    content: "";
    position: absolute;
    right: 4px;
    opacity: 0.2;
    width: 0;
    height: 0;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    border-radius: 50%;
    border-top: 10px solid #4a5568; /* Match text color */
    top: 25%;
}

.datatable-filter-active .datatable-filter::before {
    opacity: 0.6;
}

.datatable-empty {
    text-align: center;
    color: #4a5568; /* Match text color */
}

.datatable-top::after, .datatable-bottom::after {
    clear: both;
    content: " ";
    display: table;
}

table.datatable-table:focus tr.datatable-cursor > td:first-child {
    border-left: 3px solid #3182ce; /* Match primary button color */
}

table.datatable-table:focus {
    outline: solid 1px #3182ce; /* Match primary button color */
    outline-offset: -1px;
}

/* Hover effect for table rows */
.datatable-table > tbody > tr:hover {
    background: #f7fafc; /* Match table hover background */
    box-shadow: 0 1px 3px rgba(0,0,0,0.05); /* Match table hover shadow */
    transition: all 0.2s ease; /* Match transition */
}

/* Ensure table cells match the design */
.datatable-table > tbody > tr > td {
    color: #4a5568; /* Match text color */
    font-weight: 500; /* Match font weight for key data */
}

/* Style for specific columns like price */
.datatable-table > tbody > tr > td:nth-child(8) {
    color: #2d3748; /* Match price text color */
    font-weight: 500; /* Match price font weight */
}
</style>