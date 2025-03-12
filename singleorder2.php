<?php
// Dummy data for the order with 50 fields
$order = [
    'order_id' => 'ORD-12345',
    'date' => 'February 26, 2025',
    'customer_name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'phone' => '+1 (555) 123-4567',
    'total_amount' => 199.99,
    'status' => 'Processing',
    'description' => 'This is a sample order description with custom requirements.',
    'attached_file' => 'specification_document.pdf',
    'image_url' => 'https://via.placeholder.com/150', // Dummy image URL
    'shipping_address' => '123 Main St, City, Country',
    'billing_address' => '456 Oak Ave, Town, Country',
    'payment_method' => 'Credit Card',
    'payment_status' => 'Completed',
    'tracking_number' => 'TRK-789101',
    'delivery_date' => 'March 5, 2025',
    'order_source' => 'Website',
    'currency' => 'USD',
    'tax_amount' => 19.99,
    'discount' => 10.00,
    'shipping_cost' => 15.00,
    'item_count' => 3,
    'weight' => '5.5 kg',
    'height' => '120 cm',
    'width' => '80 cm',
    'depth' => '60 cm',
    'material' => 'Wood',
    'color' => 'Brown',
    'quantity_ordered' => 2,
    'unit_price' => 99.99,
    'subtotal' => 189.99,
    'custom_field_1' => 'Special Coating',
    'custom_field_2' => 'Fast Delivery',
    'custom_field_3' => 'Eco-Friendly',
    'custom_field_4' => 'Assembly Required',
    'custom_field_5' => 'Gift Wrapped',
    'customer_id' => 'CUST-98765',
    'order_type' => 'Retail',
    'priority' => 'High',
    'notes' => 'Customer prefers morning delivery.',
    'warehouse_id' => 'WH-456',
    'supplier' => 'Furniture Co.',
    'production_time' => '3 days',
    'warranty' => '1 Year',
    'return_policy' => '30 Days',
    'customer_rating' => '4.5',
    'last_updated' => 'March 12, 2025 10:00',
    'created_by' => 'Admin User',
    'approved_by' => 'Manager John',
    'invoice_number' => 'INV-54321'
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

        <!-- Pinned Key Fields Section -->
        <div class="pinned-section" style="position: sticky; top: 0; background: #ffffff; z-index: 10; padding: 1rem 0; border-bottom: 1px solid #e5e7eb; margin: -30px -30px 20px -30px; padding-left: 30px; padding-right: 30px;">
            <div class="order-info" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
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
            </div>
        </div>

        <!-- Multi-Column Grid for All Fields -->
        <div class="fields-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
            <!-- Customer Info -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Customer Info</h3>
                <div class="info-item"><label>Customer ID</label><span><?= htmlspecialchars($order['customer_id']) ?></span></div>
                <div class="info-item"><label>Email</label><span><?= htmlspecialchars($order['email']) ?></span></div>
                <div class="info-item"><label>Phone</label><span><?= htmlspecialchars($order['phone']) ?></span></div>
            </div>

            <!-- Order Info -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Order Info</h3>
                <div class="info-item"><label>Order ID</label><span>#<?= htmlspecialchars($order['order_id']) ?></span></div>
                <div class="info-item"><label>Date</label><span><?= htmlspecialchars($order['date']) ?></span></div>
                <div class="info-item"><label>Status</label><span><?= htmlspecialchars($order['status']) ?></span></div>
                <div class="info-item"><label>Total Amount</label><span>₹<?= number_format($order['total_amount'], 2) ?></span></div>
                <div class="info-item"><label>Description</label><span><?= htmlspecialchars($order['description']) ?></span></div>
                <div class="info-item"><label>Attached File</label><a href="#" class="file-link"><?= htmlspecialchars($order['attached_file']) ?></a></div>
                <div class="info-item"><label>Order Image</label>
                    <a href="<?= htmlspecialchars($order['image_url']) ?>" target="_blank" style="text-decoration: none;">
                        <img src="<?= htmlspecialchars($order['image_url']) ?>" 
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';" 
                             onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';" alt="Order Image">
                    </a>
                </div>
            </div>

            <!-- Logistics -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Logistics</h3>
                <div class="info-item"><label>Shipping Address</label><span><?= htmlspecialchars($order['shipping_address']) ?></span></div>
                <div class="info-item"><label>Billing Address</label><span><?= htmlspecialchars($order['billing_address']) ?></span></div>
                <div class="info-item"><label>Payment Method</label><span><?= htmlspecialchars($order['payment_method']) ?></span></div>
                <div class="info-item"><label>Payment Status</label><span><?= htmlspecialchars($order['payment_status']) ?></span></div>
                <div class="info-item"><label>Tracking Number</label><span><?= htmlspecialchars($order['tracking_number']) ?></span></div>
                <div class="info-item"><label>Delivery Date</label><span><?= htmlspecialchars($order['delivery_date']) ?></span></div>
                <div class="info-item"><label>Order Source</label><span><?= htmlspecialchars($order['order_source']) ?></span></div>
                <div class="info-item"><label>Currency</label><span><?= htmlspecialchars($order['currency']) ?></span></div>
                <div class="info-item"><label>Tax Amount</label><span>₹<?= number_format($order['tax_amount'], 2) ?></span></div>
                <div class="info-item"><label>Discount</label><span>₹<?= number_format($order['discount'], 2) ?></span></div>
                <div class="info-item"><label>Shipping Cost</label><span>₹<?= number_format($order['shipping_cost'], 2) ?></span></div>
            </div>

            <!-- Product Details -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Product Details</h3>
                <div class="info-item"><label>Item Count</label><span><?= htmlspecialchars($order['item_count']) ?></span></div>
                <div class="info-item"><label>Weight</label><span><?= htmlspecialchars($order['weight']) ?></span></div>
                <div class="info-item"><label>Height</label><span><?= htmlspecialchars($order['height']) ?></span></div>
                <div class="info-item"><label>Width</label><span><?= htmlspecialchars($order['width']) ?></span></div>
                <div class="info-item"><label>Depth</label><span><?= htmlspecialchars($order['depth']) ?></span></div>
                <div class="info-item"><label>Material</label><span><?= htmlspecialchars($order['material']) ?></span></div>
                <div class="info-item"><label>Color</label><span><?= htmlspecialchars($order['color']) ?></span></div>
                <div class="info-item"><label>Quantity Ordered</label><span><?= htmlspecialchars($order['quantity_ordered']) ?></span></div>
                <div class="info-item"><label>Unit Price</label><span>₹<?= number_format($order['unit_price'], 2) ?></span></div>
                <div class="info-item"><label>Subtotal</label><span>₹<?= number_format($order['subtotal'], 2) ?></span></div>
            </div>

            <!-- Custom Fields -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Custom Fields</h3>
                <div class="info-item"><label>Custom Field 1</label><span><?= htmlspecialchars($order['custom_field_1']) ?></span></div>
                <div class="info-item"><label>Custom Field 2</label><span><?= htmlspecialchars($order['custom_field_2']) ?></span></div>
                <div class="info-item"><label>Custom Field 3</label><span><?= htmlspecialchars($order['custom_field_3']) ?></span></div>
                <div class="info-item"><label>Custom Field 4</label><span><?= htmlspecialchars($order['custom_field_4']) ?></span></div>
                <div class="info-item"><label>Custom Field 5</label><span><?= htmlspecialchars($order['custom_field_5']) ?></span></div>
            </div>

            <!-- Admin Notes -->
            <div class="field-section">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Admin Notes</h3>
                <div class="info-item"><label>Order Type</label><span><?= htmlspecialchars($order['order_type']) ?></span></div>
                <div class="info-item"><label>Priority</label><span><?= htmlspecialchars($order['priority']) ?></span></div>
                <div class="info-item"><label>Notes</label><span><?= htmlspecialchars($order['notes']) ?></span></div>
                <div class="info-item"><label>Warehouse ID</label><span><?= htmlspecialchars($order['warehouse_id']) ?></span></div>
                <div class="info-item"><label>Supplier</label><span><?= htmlspecialchars($order['supplier']) ?></span></div>
                <div class="info-item"><label>Production Time</label><span><?= htmlspecialchars($order['production_time']) ?></span></div>
                <div class="info-item"><label>Warranty</label><span><?= htmlspecialchars($order['warranty']) ?></span></div>
                <div class="info-item"><label>Return Policy</label><span><?= htmlspecialchars($order['return_policy']) ?></span></div>
                <div class="info-item"><label>Customer Rating</label><span><?= htmlspecialchars($order['customer_rating']) ?></span></div>
                <div class="info-item"><label>Last Updated</label><span><?= htmlspecialchars($order['last_updated']) ?></span></div>
                <div class="info-item"><label>Created By</label><span><?= htmlspecialchars($order['created_by']) ?></span></div>
                <div class="info-item"><label>Approved By</label><span><?= htmlspecialchars($order['approved_by']) ?></span></div>
                <div class="info-item"><label>Invoice Number</label><span><?= htmlspecialchars($order['invoice_number']) ?></span></div>
            </div>
        </div>

        <!-- Order Items Section -->
        <div class="order-items" style="grid-column: 1 / -1; margin-top: 2rem;">
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

<style>
    .body-class {
        background: #ffffff;
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
        max-width: 1400px;
        width: 100%;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
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
        background: linear-gradient(to right, #3b82f6, #10b981);
    }

    .header-class {
        padding-bottom: 20px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
    }

    .header-class h1 {
        color: #1f2937;
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em;
    }

    .status-badge {
        padding: 6px 12px;
        background: #ecfdf5;
        color: #10b981;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
    }

    .info-item {
        background: #f9fafb;
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background: #ffffff;
    }

    .info-item label {
        font-weight: 600;
        color: #6b7280;
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-item span {
        color: #374151;
        font-size: 0.875rem;
        font-weight: 500;
        word-break: break-word;
    }

    .file-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .file-link:hover {
        color: #2563eb;
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
        padding: 0.625rem 1.25rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-primary {
        background: #3b82f6;
        color: #ffffff;
        border: none;
    }

    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .btn-secondary {
        background: #ffffff;
        color: #4b5563;
    }

    .btn-secondary:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-1px);
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

    @media (max-width: 1024px) {
        .fields-grid {
            grid-template-columns: 1fr;
        }
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

        .pinned-section {
            top: 0;
            margin: -20px -20px 20px -20px;
            padding-left: 20px;
            padding-right: 20px;
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