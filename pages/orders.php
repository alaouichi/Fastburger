<?php
    include '../config/dbConfig.php';
    include '../partials/header.php';
    include '../partials/navigation.php';

    $ordersQuery = $conn->prepare("SELECT 
            Orders.order_id,
            Orders.order_date,
            Orders.order_time,
            Orders.fk_customer_id,
            Customer.customer_name,
            Staff.staff_firstname,
            Staff.staff_surname,
            Payment.payment_type
        FROM 
            Orders
        LEFT JOIN 
            Customer ON Orders.fk_customer_id = Customer.customer_id
        LEFT JOIN 
            Staff ON Orders.fk_staff_id = Staff.staff_id
        LEFT JOIN 
            Payment ON Orders.fk_payment_id = Payment.payment_id
        ORDER BY 
            Orders.order_date DESC, Orders.order_time DESC;
    ");

    $ordersQuery->execute();
    $ordersQuery->bind_result($orderId, $orderDate, $orderTime, $customerId, $customerName, $staffFirstname, $staffSurname, $paymentType);
    
    $orders = [];
    while ($ordersQuery->fetch()) {
        $orders[] = [
            'order_id' => $orderId,
            'order_date' => $orderDate,
            'order_time' => $orderTime,
            'customer_id' => $customerId,
            'customer_name' => $customerName,
            'staff_name' => $staffFirstname . ' ' . $staffSurname,
            'payment_type' => $paymentType,
        ];
    }
?>

<div class="ordercontainer flex-grow mx-auto px-2 md:px-6 py-8" style="background-color: #FFFFFF;">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        
        <div class="search-box md:col-span-1">
            <form action="search_results.php" method="get" class="flex">
                <input type="text" name="query" placeholder="Search..." class="w-full p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-red-600"/>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-r-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">Search</button>

            </form>
        </div>

        <!-- List of orders div -->
        <div class="overflow md:col-span-1 bg-white p-12 rounded-lg shadow-lg h-full row-span-2" style="background-color: #f8d574; border-color: #592E15;">
            <h2 class=".montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Orders List</h2>
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
                        <th class=".montsheading py-2" style="color: #F28F38;">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr style="border-color: #592E15;">
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['order_id']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['order_date']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['order_time']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['customer_id']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['staff_name']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($order['payment_type']) ?></td>
                            <td class="border px-4 py-2"><a href="OrderDetails?order_id=<?= htmlspecialchars($order['order_id']) ?>" class="text-red-600 hover:text-red-700">View Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include '../partials/footer.php';
?>