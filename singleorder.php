<?php
include "includes/header.php";

// Dummy data for the order
$order = [
    'order_id' => 'ORD-12345',
    'date' => 'February 26, 2025',
    'customer_name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'phone' => '+1 (555) 123-4567',
    'total_amount' => 199.99,
    'status' => 'Processing',
    'description' => 'This is a sample order description. Customer requested a custom product with specific requirements and additional features.',
    'attached_file' => 'specification_document.pdf'
];

// Dummy order items
$order_items = [
    ['product_name' => 'Custom Dining Table', 'quantity' => 1, 'price' => 149.99],
    ['product_name' => 'Chair Set', 'quantity' => 2, 'price' => 25.00]
];
?>

<div class="body-class">
    <div class="container container-class">
        <div class="header-class">
            <h1>Order Details</h1>
            <span class="status-badge"><?= htmlspecialchars($order['status']) ?></span>
        </div>

        <div class="order-info">
            <div class="info-item">
                <label>Order ID</label>
                <span>#<?= htmlspecialchars($order['order_id']) ?></span>
            </div>

            <div class="info-item">
                <label>Date of Order</label>
                <span><?= htmlspecialchars($order['date']) ?></span>
            </div>

            <div class="info-item">
                <label>Name</label>
                <span><?= htmlspecialchars($order['customer_name']) ?></span>
            </div>

            <div class="info-item">
                <label>Email</label>
                <span><?= htmlspecialchars($order['email']) ?></span>
            </div>

            <div class="info-item">
                <label>Phone</label>
                <span><?= htmlspecialchars($order['phone']) ?></span>
            </div>

            <div class="info-item">
                <label>Price</label>
                <span>₹<?= number_format($order['total_amount'], 2) ?></span>
            </div>

            <div class="info-item description">
                <label>Description</label>
                <span><?= htmlspecialchars($order['description']) ?></span>
            </div>

            <div class="file-section">
                <span class="file-icon">📎</span>
                <div>
                    <label>Attached File</label>
                    <a href="#" class="file-link"><?= htmlspecialchars($order['attached_file']) ?></a>
                </div>
            </div>

            <!-- Order Items Section -->
            <div class="order-items" style="grid-column: 1 / -1;">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Order Items</h2>
                <div class="card" style="border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;">
                    <table class="table table-hover" style="width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem;">
                        <thead style="background: #f9fafb; color: #374151; font-weight: 600;">
                            <tr>
                                <th style="padding: 1rem; border-bottom: 1px solid #e5e7eb; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Product Name</th>
                                <th style="padding: 1rem; border-bottom: 1px solid #e5e7eb; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Quantity</th>
                                <th style="padding: 1rem; border-bottom: 1px solid #e5e7eb; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Price</th>
                                <th style="padding: 1rem; border-bottom: 1px solid #e5e7eb; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_items as $item) : ?>
                                <tr style="transition: all 0.2s ease; background: #fff;">
                                    <td style="padding: 1rem; vertical-align: middle; color: #374151; font-weight: 500;">
                                        <?= htmlspecialchars($item['product_name']) ?>
                                    </td>
                                    <td style="padding: 1rem; vertical-align: middle; color: #374151; font-weight: 500;">
                                        <?= htmlspecialchars($item['quantity']) ?>
                                    </td>
                                    <td style="padding: 1rem; vertical-align: middle; color: #374151; font-weight: 500;">
                                        ₹<?= number_format($item['price'], 2) ?>
                                    </td>
                                    <td style="padding: 1rem; vertical-align: middle; color: #374151; font-weight: 500;">
                                        ₹<?= number_format($item['quantity'] * $item['price'], 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="actions">
                <a href="orders.php" class="btn btn-secondary">Back to Orders</a>
                <button class="btn btn-primary">Update Order</button>
            </div>
        </div>
    </div>
</div>

<style>
    .body-class {
       
        margin: 0;
        padding: 40px 20px;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #2d3748;
    }

    .container-class {
        max-width: 1100px;
        width: 100%;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); /* Adjusted shadow to match your design */
        border: none;
        position: relative;
        overflow: hidden;
    }

    .container-class::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #3b82f6, #10b981); /* Adjusted to your blue-green gradient */
    }

    .header-class {
        padding-bottom: 20px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb; /* Changed to your border color */
    }

    .header-class h1 {
        color: #1f2937; /* Changed to your primary text color */
        font-size: 1.75rem; /* Adjusted to match your typography */
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em; /* Adjusted to your letter spacing */
    }

    .status-badge {
        padding: 6px 12px;
        background: #ecfdf5; /* Changed to your success background */
        color: #10b981; /* Changed to your success text color */
        border-radius: 12px; /* Adjusted to match your design */
        font-size: 0.875rem; /* Adjusted to match your font size */
        font-weight: 600; /* Adjusted to match your font weight */
    }

    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: #f9fafb; /* Changed to your light background */
        padding: 1rem; /* Adjusted to match your padding */
        border-radius: 8px;
        border: 1px solid #e5e7eb; /* Changed to your border color */
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-item:hover {
        transform: translateY(-2px); /* Adjusted to match your hover effect */
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); /* Adjusted to match your shadow */
        background: #ffffff;
    }

    .info-item label {
        font-weight: 600;
        color: #6b7280; /* Changed to your secondary text color */
        display: block;
        margin-bottom: 0.5rem; /* Adjusted to match your spacing */
        font-size: 0.75rem; /* Adjusted to match your typography */
        text-transform: uppercase;
        letter-spacing: 0.05em; /* Adjusted to match your letter spacing */
    }

    .info-item span {
        color: #374151; /* Changed to your body text color */
        font-size: 1rem; /* Adjusted to match your typography */
        font-weight: 500; /* Adjusted to match your font weight */
        word-break: break-word;
    }

    .description {
        grid-column: 1 / -1;
        background: #f9fafb;
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .file-section {
        grid-column: 1 / -1;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .file-icon {
        color: #3b82f6; /* Changed to your primary color */
        font-size: 24px;
    }

    .file-link {
        color: #3b82f6; /* Changed to your primary color */
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .file-link:hover {
        color: #2563eb; /* Adjusted to your hover color */
        text-decoration: underline;
    }

    .actions {
        grid-column: 1 / -1;
        margin-top: 30px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .btn {
        padding: 0.625rem 1.25rem; /* Adjusted to match your button padding */
        border: 1px solid #d1d5db; /* Changed to your border color */
        border-radius: 8px; /* Adjusted to match your radius */
        cursor: pointer;
        font-weight: 500; /* Adjusted to match your font weight */
        font-size: 0.875rem; /* Adjusted to match your font size */
        transition: all 0.3s ease;
        text-decoration: none; /* Added for consistency with your links */
    }

    .btn-primary {
        background: #3b82f6; /* Changed to your primary color */
        color: #ffffff;
        border: none; /* Removed border for primary button */
    }

    .btn-primary:hover {
        background: #2563eb; /* Adjusted to your hover color */
        transform: translateY(-1px); /* Adjusted to match your hover effect */
        box-shadow: 0 4px 8px rgba(0,0,0,0.15); /* Adjusted to match your shadow */
    }

    .btn-secondary {
        background: #ffffff;
        color: #4b5563; /* Changed to your secondary text color */
    }

    .btn-secondary:hover {
        background: #f3f4f6; /* Adjusted to match your hover background */
        border-color: #9ca3af; /* Adjusted to match your hover border */
        transform: translateY(-1px); /* Adjusted to match your hover effect */
    }

    .table td, .table th {
        border-color: #e5e7eb;
        padding: 1rem;
    }

    .table tbody tr:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .table thead th {
        background: #f9fafb;
        color: #374151;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        position: relative;
    }

    .table tbody td {
        color: #374151;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    @media (max-width: 768px) {
        .body-class {
            padding: 20px 10px;
        }

        .container-class {
            padding: 20px;
        }

        .order-info {
            grid-template-columns: 1fr;
        }

        .header-class {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .actions {
            flex-direction: column;
            align-items: stretch;
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
</style>

<?php include "includes/footer.php" ?>