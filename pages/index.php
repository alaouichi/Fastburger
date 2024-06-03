<?php
include '../config/dbConfig.php';
include '../partials/header.php';
include '../partials/navigation.php';

// SQL query to get staff names and shifts
$shiftQuery = $conn->prepare("SELECT staff_firstname, staff_surname, shift FROM Staff");
$shiftQuery->execute();
$shiftQuery->bind_result($firstname, $surname, $shift);
?>

<div class="container flex-grow mx-auto px-2 md:px-6 py-8" style="background-color: #FFFFFF;">
    <div class="grid grid-rows-1 md:grid-cols-3 gap-6">

        <!-- Weekly shift pattern div-->
        <div class="col-span-2 row-start-1 shift-list bg-white p-12 rounded-lg shadow-lg h-128" style="background-color: #f8d574; border-color: #592E15;">
            <h2 class="montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Weekly Shift pattern</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="montsheading py-2" style="color: #F28F38;">First Name</th>
                        <th class="montsheading py-2" style="color: #F28F38;">Surname</th>
                        <th class="montsheading py-2" style="color: #F28F38;">Shift</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($shiftQuery->fetch()): ?>
                        <tr style="border-color: #592E15;">
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($firstname) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($surname) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($shift) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Right side divs -->
        <div class="col-start-3 col-span-1 space-y-8">
            <div class="index-right flex flex-wrap">  
                <!-- Staff div -->
                <div class="most-orders bg-white p-12 rounded-lg shadow-lg h-64 mb-4" style="background-color: #f8d574; border-color: #592E15;">
                    <h2 class="montsheading text-1xl font-bold mb-1" style="color: #F28F38;">Staff member with the most orders</h2>
                    <p style="color: #0D0D0D;">
                        <?php
                        $totalOrders = $conn->prepare("SELECT Staff.staff_firstname, Staff.staff_surname, COUNT(Orders.order_id) AS total_orders
                            FROM Orders
                            JOIN Staff 
                            ON Orders.fk_staff_id = Staff.staff_id
                            GROUP BY Staff.staff_id
                            ORDER BY total_orders DESC LIMIT 1;");
                        $totalOrders->execute();
                        $totalOrders->bind_result($firstname, $surname, $orderCount);
                        $totalOrders->fetch();
                        $staffName = $firstname . " " . $surname;
                        $totalOrdersCount = $orderCount;
                        ?>
                        <?= htmlspecialchars($staffName) ?> is in the lead for taking <?= htmlspecialchars($totalOrdersCount) ?> orders.
                    </p>
                </div>

                <!-- Stock div -->
                <div class="seasonal-promo bg-white p-12 rounded-lg shadow-lg h-64" style="background-color: #f8d574; border-color: #592E15;">
                    <h2 class="montsheading text-1xl font-bold mb-1" style="color: #F28F38;">Seasonal stock updates and promotions</h2>
                    <p style="color: #0D0D0D;">Information about seasonal stock and promotions</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>