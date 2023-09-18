<?php
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
    <h1>Choose what files you want to insert into the database</h1>
        <nav>
            <a href="admin_home.php">Home</a>
            <a href="insert_products.php">Insert Products</a>
            <a href="insert_categories.php">Insert Categories</a>
            <a href="insert_subcategories.php">Insert Subcategories</a>
            <a href="insert_shops.php">Insert Shops</a>
            <a href="insert_weekly_prices.php">Insert weekly prices</a>
            <a href="insert_daily_prices.php">Insert daily prices</a>
        </nav>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
