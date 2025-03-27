<main id="main" class="main" style="padding: 2rem; min-height: 100vh; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;  box-shadow: 0 2px 4px rgba(0,0,0,0.02); border-radius: 16px;">
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="position: relative; border-radius: 12px; padding: 1rem 1.25rem; background: #ecfdf5; border: none; 
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 450px; margin: 0 auto 2rem; font-size: 0.875rem;">
            <i class="bi bi-check-circle" style="color: #10b981; font-size: 1.25rem; margin-right: 0.5rem;"></i>
            <span style="color: #1f2937; font-weight: 600;">Successfully Updated!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="opacity: 0.5;"></button>
        </div>
    <?php endif; ?>

    <div class="pagetitle " style="margin-bottom: 14px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb" style="font-size: 0.75rem; color: #6b7280;">
                    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="index.php" style="color: #4b5563; text-decoration: none;">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" style="color: #4b5563; text-decoration: none;">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #374151;">All Products</li>
                    </ol>
                </nav>
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-top: 0.75rem; letter-spacing: -0.025em;">Products</h1>
                <p style="font-size: 1rem; color: #6b7280; margin-top: 0.5rem;">Track and manage your product catalog efficiently.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-export" style="background: #ffffff; color: #4b5563; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.625rem 1.25rem; 
                           font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                    Export
                </button>
                <a href="addproduct.php" class="btn btn-add" style="background: #3b82f6; color: #fff; border-radius: 8px; padding: 0.625rem 1.25rem; 
                    font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease; text-decoration: none;">
                    Add Product
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card" style="border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); background: #ffffff; border: none; overflow: hidden;">
            <div class="card-body p-0">
                <table class="datatable table table-hover mb-0" style="width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem;">
                    <thead style="background: #f3f4f6; color: #374151; font-weight: 600;">
                        <tr>
                            <th class="table-head-inline">
                                Sno. <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Image <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Name <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Main Category <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Category <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Subcategory <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Brand <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th class="table-head-inline">
                                Price <span class="sort-indicator" table-head-inline-span>▲▼</span>
                            </th>
                            <th style="padding: 1rem; border-bottom: 2px solid #e5e7eb; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; while ($getData = $result->fetch_assoc()) { ?>
                            <tr style="transition: all 0.2s ease; background: #fff;">
                                <td style=" font-weight: 500;">
                                    <?= $count++ ?>
                                </td>
                                <td class="table-data-inline" style="padding: 1rem; vertical-align: middle;">
                                    <a href="../dashboard/assets/products/<?= htmlspecialchars($getData['p_image']) ?>" target="_blank" style="text-decoration: none;">
                                        <img src="../dashboard/assets/products/<?= htmlspecialchars($getData['p_image']) ?>" 
                                             style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                             onmouseover="this.style.transform='scale(1.15)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';" 
                                             onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';" alt="Product Image">
                                    </a>
                                </td>
                                <td class="table-data-inline" style=" font-weight: 500;">
                                    <?= htmlspecialchars($getData['p_name']) ?>
                                </td>
                                <td class="table-data-inline" style="">
                                    <?= htmlspecialchars($getData['p_main_category']) ?>
                                </td>
                                <td class="table-data-inline" style="">
                                    <?= htmlspecialchars($getData['p_category_type']) ?>
                                </td>
                                <td class="table-data-inline" style="">
                                    <?= htmlspecialchars($getData['p_subcategory']) ?>
                                </td>
                                <td class="table-data-inline" style="">
                                    <?= htmlspecialchars($getData['p_brand']) ?>
                                </td>
                                <td class="table-data-inline" style=" font-weight: 500;">
                                    ₹<?= number_format($getData['p_price'], 2) ?>
                                </td>
                                <td class="table-data-inline" style="padding: 1rem; vertical-align: middle;">
                                    <div class="d-flex gap-2">
                                        <a href="editproduct2.php?id=<?= $getData['p_id'] ?>" class="btn btn-sm" 
                                           style="background: #ffffff; color: #4b5563; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.375rem 0.875rem; 
                                                  font-size: 0.75rem; transition: all 0.3s ease; text-decoration: none;"
                                           onmouseover="this.style.background='#f3f4f6'; this.style.borderColor='#9ca3af';"
                                           onmouseout="this.style.background='#ffffff'; this.style.borderColor='#d1d5db';">
                                            Edit
                                        </a>
                                        <a href="actions/deleteProduct.php?id=<?= $getData['p_id'] ?>" class="btn btn-sm" 
                                           style="background: #fee2e2; color: #991b1b; border-radius: 6px; padding: 0.375rem 0.875rem; 
                                                  font-size: 0.75rem; transition: all 0.3s ease; text-decoration: none;"
                                           onmouseover="this.style.background='#fecaca';" 
                                           onmouseout="this.style.background='#fee2e2';"
                                           onclick="return confirm('Are you sure you want to delete this product?');">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<style>
    /* .main {
        margin: 0 auto;
        padding: 2rem;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    } */

    .section {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        border-radius: 5px;
    }

    .table-head-inline {
       padding: 1rem;
       border-bottom: 2px solid #e5e7eb;
       text-transform: uppercase; 
       font-size: 0.95rem; 
       letter-spacing: 0.05em; 
       position: relative;"
    }

    .table-head-inline-span {
        display: inline-block; 
        margin-left: 0.25rem; 
        color: #9ca3af; 
        font-size: 0.625rem;
    }


    .table-data-inline {
        padding: 1rem;
        vertical-align: middle; 
        color: #374151;
    }

    .table-hover tbody tr:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .table td, .table th {
        border-color: #e5e7eb;
        padding: 1rem;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .btn-export:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-1px);
    }

    .btn-prev:hover, .btn-next:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-1px);
    }

    .datatable-table > thead > tr > th {
        background: #f3f4f6;
        color: #374151;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
        position: relative;
    }

    .datatable-table > thead > tr > th:hover {
        background:rgb(235, 236, 239);
        color: #1f2937;
    }

    .datatable-table > tbody > tr > td {
        color: #374151;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .table-footer {
        background: #f9fafb;
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        color: #6b7280;
        font-weight: 500;
    }

    img {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sort-indicator {
        color: #9ca3af;
        font-size: 0.625rem;
        vertical-align: middle;
        transition: color 0.3s ease;
    }

    .datatable-table > thead > tr > th:hover .sort-indicator {
        color: #3b82f6;
    }

    @media (max-width: 768px) {
        .main {
            padding: 1.5rem;
            border-radius: 0;
        }
        .pagetitle h1 {
            font-size: 1.5rem;
        }
        .table td, .table th {
            padding: 0.75rem;
        }
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }

    /* Pagination */
    .datatable-pagination ul {
        margin: 0;
        padding-left: 0;
    }

    .datatable-pagination li {
        list-style: none;
        float: left;
    }

    .datatable-pagination a, .datatable-pagination button {
        background: #ffffff;
        border: 1px solid #d1d5db;
        color: #4b5563;
        border-radius: 8px;
        padding: 0.375rem 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-left: 0.25rem;
    }

    .datatable-pagination a:hover, .datatable-pagination button:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-1px);
    }

    .datatable-pagination .datatable-active a {
        background: #3b82f6;
        color: #ffffff;
        border-color: #3b82f6;
    }

    .datatable-top, .datatable-bottom {
        padding: 1rem;
        background: #f9fafb;
        /* border-top: 1px solid #e5e7eb; */
        font-size: 0.75rem;
        color: #6b7280;
    }

    .datatable-input {
        padding: 0.5rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.875rem;
        color: #374151;
        background: #fff;
        outline: none;
    }

    .datatable-selector {
        padding: 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        font-size: 0.875rem;
        color: #374151;
    }
    .datatable-sorter::before {
        display: none;
    }
    .datatable-sorter::after {
        display: none;
    }

</style>