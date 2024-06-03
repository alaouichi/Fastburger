<?php
    include '../config/dbConfig.php';
    include '../partials/header.php';
    include '../partials/navigation.php';

    $itemPopularityQuery = $conn->prepare("SELECT 
            item.*, 
            COUNT(Order_Items.fk_item_id) AS popularity
        FROM 
            item
        LEFT JOIN 
            Order_Items ON item.item_id = Order_Items.fk_item_id
        GROUP BY 
            item.item_id
        ORDER BY 
            popularity DESC;
    ");

    $itemPopularityQuery->execute();
    $itemPopularityQuery->bind_result($itemId, $itemName, $itemCost, $stockLimit, $popularity);
    
    $items = [];
    while ($itemPopularityQuery->fetch()) {
        $items[] = [
            'id' => $itemId,
            'name' => $itemName,
            'cost' => $itemCost,
            'stock_limit' => $stockLimit,
            'popularity' => $popularity,
        ];
    }
?>

<div class="container flex-grow mx-auto px-2 md:px-6 py-8" style="background-color: #FFFFFF;">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Search box in the top-left row -->
        <div class="search-box md:col-span-2">
            <form action="search_results.php" method="get" class="flex">
                <input type="text" name="query" placeholder="Search..." class="w-full p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-red-600"/>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-r-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">Search</button>
            </form>
        </div>
        
        <!-- Stock div -->
        <div class="stock-list md:col-span-2 bg-white p-12 rounded-lg shadow-lg h-full row-span-2" style="background-color: #f8d574; border-color: #592E15;">
            <h2 class=".montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Stock list</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class=".montsheading py-2" style="color: #F28F38;">Item ID</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Item Name</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Cost</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Stock Limit</th>
                        <th class=".montsheading py-2" style="color: #F28F38;">Popularity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr style="border-color: #592E15;">
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($item['id']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($item['name']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($item['cost']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($item['stock_limit']) ?></td>
                            <td class="border px-4 py-2" style="color: #0D0D0D;"><?= htmlspecialchars($item['popularity']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Right div -->
        <div class="space-y-8">
            
            <div class="regular-items bg-white p-12 rounded-lg shadow-lg h-64" style="background-color: #f8d574; border-color: #592E15;">
                <h2 class=".montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Regular menu items</h2>
                <p style="color: #0D0D0D;">Regular menu items on the list</p>
            </div>

            <div class="sales-items bg-white p-12 rounded-lg shadow-lg h-64" style="background-color: #f8d574; border-color: #592E15;">
                <h2 class=".montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Sales menu items</h2>
                <p style="color: #0D0D0D;">List of menu items that are for sale</p>
            </div>
        </div>
    </div>
</div>

<?php
    include '../partials/footer.php';
?>