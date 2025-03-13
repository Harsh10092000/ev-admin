<?php include "includes/header.php"; ?>
<main id="main" class="main" style="padding: 2rem; min-height: 100vh; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;  border-radius: 16px; ">
    
    <!-- Success Alert (Optional) -->
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert" 
             style="position: relative; border-radius: 12px; padding: 1rem 1.25rem; background: #ecfdf5; border: none; 
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 450px; margin: 0 auto 2rem; font-size: 0.875rem;">
            <i class="bi bi-check-circle" style="color: #10b981; font-size: 1.25rem; margin-right: 0.5rem;"></i>
            <span style="color: #1f2937; font-weight: 600;">Order Updated Successfully!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="opacity: 0.5;"></button>
        </div>
    <?php endif; ?>

    <!-- Page Title -->
    <div class="pagetitle" style="margin-bottom: 2rem; padding: 1rem;  border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
        <nav aria-label="breadcrumb" style="font-size: 0.75rem; color: #6b7280;">
            <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="index.php" style="color: #4b5563; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: #4b5563; text-decoration: none;">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #374151;">Order Details</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <h5 style=" font-weight: 700; color: #1f2937; letter-spacing: -0.025em;">
                Order <span style="background: #3b82f6; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; font-size: 1.1rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">ORD123456</span>
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-export" style="background: #ffffff; color: #4b5563; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                    Export PDF
                </button>
                <a href="editorder.php?id=123456" class="btn btn-add" style="background: #3b82f6; color: #fff; border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease; text-decoration: none;">
                    Edit Order
                </a>
            </div>
        </div>
        <p style="font-size: 1rem; color: #6b7280; margin-top: 0.5rem;">Detailed view of order information and status.</p>
    </div>

    <!-- Order Details Section -->
    <section class="section">
        <div class="card" style="border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.06); background: #ffffff; border: none; overflow: hidden; transition: all 0.3s ease;">
            <div class="card-body" style="padding: 2rem;">
                <!-- Dummy Data -->
                <?php
                $orderData = [
                    'order_id' => 'ORD123456',
                    'customer_name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'phone' => '+91-9876543210',
                    'order_date' => '2025-03-10 14:35:22',
                    'status' => 'Shipped',
                    'total_amount' => 12500.75,
                    'payment_method' => 'Credit Card',
                    'payment_status' => 'Paid',
                    'shipping_address' => '123, Green Avenue, Mumbai, Maharashtra, India - 400001',
                    'billing_address' => '123, Green Avenue, Mumbai, Maharashtra, India - 400001',
                    'shipping_method' => 'Express Delivery',
                    'tracking_number' => 'TRK987654321',
                    'estimated_delivery' => '2025-03-15',
                    'order_notes' => 'Please deliver before noon.',
                    'subtotal' => 10500.00,
                    'tax' => 1500.00,
                    'discount' => 500.00,
                    'shipping_cost' => 500.00,
                    'coupon_code' => 'SAVE50',
                    'order_weight' => '1.2 kg',
                    'order_source' => 'Website',
                    'customer_ip' => '192.168.1.1',
                    'browser' => 'Chrome 119.0',
                    'device' => 'Desktop',
                    'created_by' => 'Admin User',
                    'last_updated' => '2025-03-11 09:15:00',
                    'warehouse' => 'Mumbai WH-01',
                    'invoice_number' => 'INV-123456',
                    'return_status' => 'None',
                    'return_reason' => '',
                    'refund_amount' => 0.00,
                    'gift_wrap' => 'Yes',
                    'gift_message' => 'Happy Birthday!',
                    'priority' => 'High',
                    'currency' => 'INR',
                    'language' => 'English',
                    'order_tags' => 'Urgent, Gift',
                    'customer_type' => 'Returning',
                    'loyalty_points_used' => 100,
                    'loyalty_points_earned' => 125,
                    'sales_channel' => 'Online Store',
                ];
                ?>

                <!-- Grid Layout for Order Details -->
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Order Overview -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Order Overview</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Customer Name:</strong> <?= htmlspecialchars($orderData['customer_name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($orderData['email']) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($orderData['phone']) ?></p>
                                <p><strong>Order Date:</strong> <?= htmlspecialchars($orderData['order_date']) ?></p>
                                <p><strong>Status:</strong> 
                                    <span class="badge" style="background: #10b981; color: #fff; padding: 0.375rem 0.75rem; border-radius: 6px;"><?= htmlspecialchars($orderData['status']) ?></span>
                                </p>
                            </div>
                        </div>

                        <!-- Shipping Details -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Shipping Details</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Shipping Address:</strong> <?= htmlspecialchars($orderData['shipping_address']) ?></p>
                                <p><strong>Shipping Method:</strong> <?= htmlspecialchars($orderData['shipping_method']) ?></p>
                                <p><strong>Tracking Number:</strong> <?= htmlspecialchars($orderData['tracking_number']) ?></p>
                                <p><strong>Estimated Delivery:</strong> <?= htmlspecialchars($orderData['estimated_delivery']) ?></p>
                                <p><strong>Order Weight:</strong> <?= htmlspecialchars($orderData['order_weight']) ?></p>
                            </div>
                        </div>

                        <!-- Billing Details -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Billing Details</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Billing Address:</strong> <?= htmlspecialchars($orderData['billing_address']) ?></p>
                                <p><strong>Payment Method:</strong> <?= htmlspecialchars($orderData['payment_method']) ?></p>
                                <p><strong>Payment Status:</strong> <span class="badge" style="background: #10b981; color: #fff; padding: 0.375rem 0.75rem; border-radius: 6px;"><?= htmlspecialchars($orderData['payment_status']) ?></span></p>
                                <p><strong>Total Amount:</strong> ₹<?= number_format($orderData['total_amount'], 2) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <!-- Additional Details -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Additional Details</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Order Notes:</strong> <?= htmlspecialchars($orderData['order_notes']) ?></p>
                                <p><strong>Subtotal:</strong> ₹<?= number_format($orderData['subtotal'], 2) ?></p>
                                <p><strong>Tax:</strong> ₹<?= number_format($orderData['tax'], 2) ?></p>
                                <p><strong>Discount:</strong> ₹<?= number_format($orderData['discount'], 2) ?></p>
                                <p><strong>Shipping Cost:</strong> ₹<?= number_format($orderData['shipping_cost'], 2) ?></p>
                                <p><strong>Coupon Code:</strong> <?= htmlspecialchars($orderData['coupon_code']) ?></p>
                            </div>
                        </div>

                        <!-- System & Metadata -->
                        <div class="mb-4">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">System & Metadata</h2>
                            <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                <p><strong>Order Source:</strong> <?= htmlspecialchars($orderData['order_source']) ?></p>
                                <p><strong>Customer IP:</strong> <?= htmlspecialchars($orderData['customer_ip']) ?></p>
                                <p><strong>Browser:</strong> <?= htmlspecialchars($orderData['browser']) ?></p>
                                <p><strong>Device:</strong> <?= htmlspecialchars($orderData['device']) ?></p>
                                <p><strong>Created By:</strong> <?= htmlspecialchars($orderData['created_by']) ?></p>
                                <p><strong>Last Updated:</strong> <?= htmlspecialchars($orderData['last_updated']) ?></p>
                                <p><strong>Warehouse:</strong> <?= htmlspecialchars($orderData['warehouse']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Section for Remaining Data -->
                    <div class="col-12">
                        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Miscellaneous</h2>
                        <div class="details-box" style="background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Invoice Number:</strong> <?= htmlspecialchars($orderData['invoice_number']) ?></p>
                                    <p><strong>Return Status:</strong> <?= htmlspecialchars($orderData['return_status']) ?></p>
                                    <p><strong>Return Reason:</strong> <?= htmlspecialchars($orderData['return_reason']) ?></p>
                                    <p><strong>Refund Amount:</strong> ₹<?= number_format($orderData['refund_amount'], 2) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Gift Wrap:</strong> <?= htmlspecialchars($orderData['gift_wrap']) ?></p>
                                    <p><strong>Gift Message:</strong> <?= htmlspecialchars($orderData['gift_message']) ?></p>
                                    <p><strong>Priority:</strong> <?= htmlspecialchars($orderData['priority']) ?></p>
                                    <p><strong>Currency:</strong> <?= htmlspecialchars($orderData['currency']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Language:</strong> <?= htmlspecialchars($orderData['language']) ?></p>
                                    <p><strong>Order Tags:</strong> <?= htmlspecialchars($orderData['order_tags']) ?></p>
                                    <p><strong>Customer Type:</strong> <?= htmlspecialchars($orderData['customer_type']) ?></p>
                                    <p><strong>Sales Channel:</strong> <?= htmlspecialchars($orderData['sales_channel']) ?></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>Loyalty Points Used:</strong> <?= htmlspecialchars($orderData['loyalty_points_used']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Loyalty Points Earned:</strong> <?= htmlspecialchars($orderData['loyalty_points_earned']) ?></p>
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
        /* background: #f1f5f9; */
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
</style>

<?php include "includes/footer.php" ?>