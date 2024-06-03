<?php
    include '../config/dbConfig.php';
    include '../partials/header.php';
    include '../partials/navigation.php';

    if (isset($_GET['order_id'])) {
        $orderId = intval($_GET['order_id']);
        
        $orderDetailsQuery = $conn->prepare("SELECT 
                Orders.order_id,
                Orders.order_date,
                Orders.order_time,
                Orders.fk_customer_id,
                Customer.customer_name,
                Staff.staff_firstname,
                Staff.staff_surname,
                Payment.payment_type,
                Item.item_name,
                Order_Items.quantity
            FROM 
                Orders
            LEFT JOIN 
                Customer ON Orders.fk_customer_id = Customer.customer_id
            LEFT JOIN 
                Staff ON Orders.fk_staff_id = Staff.staff_id
            LEFT JOIN 
                Payment ON Orders.fk_payment_id = Payment.payment_id
            LEFT JOIN 
                Order_Items ON Orders.order_id = Order_Items.fk_order_id
            LEFT JOIN 
                Item ON Order_Items.fk_item_id = Item.item_id
            WHERE 
                Orders.order_id = ?
        ");
        
        $orderDetailsQuery->bind_param('i', $orderId);
        $orderDetailsQuery->execute();
        $orderDetailsQuery->bind_result($orderId, $orderDate, $orderTime, $customerId, $customerName, $staffFirstname, $staffSurname, $paymentType, $itemName, $quantity);
        
        $orderDetails = [];
        while ($orderDetailsQuery->fetch()) {
            $orderDetails[] = [
                'order_id' => $orderId,
                'order_date' => $orderDate,
                'order_time' => $orderTime,
                'customer_id' => $customerId,
                'customer_name' => $customerName,
                'staff_name' => $staffFirstname . ' ' . $staffSurname,
                'payment_type' => $paymentType,
                'item_name' => $itemName,
                'quantity' => $quantity,
            ];
        }
    }
?>

<!-- order details div -->
<div class="container flex-grow mx-auto px-2 md:px-6 py-8">
    <div class="overflow bg-white p-10 rounded-lg shadow-lg h-full" style="background-color: #f8d574;">
        <h2 class=".montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Order Details</h2>
        <?php if (!empty($orderDetails)): ?>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class=".montsheading py-2" style="color: #F28F38;">Order ID</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Order Date</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Order Time</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Customer ID</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Customer Name</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Staff Name</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Payment Type</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Item Name</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['order_id']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['order_date']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['order_time']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['customer_id']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['customer_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['staff_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['payment_type']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['item_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($detail['quantity']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No order details found.</p>
        <?php endif; ?>
    </div>
</div>

<?php
    include '../partials/footer.php';
?>