<?php //I selida opou epilegeis ti eidous insert tha kaneis
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Insert Files</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>Insert values in each category</h1>
        <nav>
            <!-- Insert Buttons/ Choices -->
            <div class="insert-buttons">
                <a href="insert_products.php">Insert Products</a>
                <a href="insert_categories.php">Insert Categories</a>
                <a href="insert_subcategories.php">Insert Subcategories</a>
                <a href="insert_shops.php">Insert Shops</a>
                <a href="insert_weekly_prices.php">Insert Weekly Prices</a>
                <a href="insert_daily_prices.php">Insert Daily Prices</a>

            </div>
        </nav>
        <div>
            <a href="admin_home.php">Back to Home</a>
        </div>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
