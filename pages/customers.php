<?php
    include '../config/dbConfig.php';
    include '../partials/header.php';
    include '../partials/navigation.php';
?> 

<div class="custcontainer" style="background-color: #FFFFFF;">
    <div class="customers-content flex flex-wrap">
        
        <!-- left div -->
        <div class="custbox  bg-white p-12 rounded-lg shadow-lg m-4 w-full md:w-1/2" style="background-color: #f8d574; border-color: #592E15;">
            <h2 class="montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Customer list</h2>
            <p style="color: #0D0D0D;">Here the customers are listed</p>
        </div>
        
        <!-- right div -->
        <div class="custbox bg-white p-12 rounded-lg shadow-lg m-4  w-full md:w-1/2" style="background-color: #f8d574; border-color: #592E15;">
            <h2 class="montsheading text-4xl font-bold mb-4" style="color: #F28F38;">Order details</h2>
            <p style="color: #0D0D0D;">Here the order details are listed</p>
        </div>
    </div>
</div>

<?php
    include '../partials/footer.php';
?>