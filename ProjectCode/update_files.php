<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Update Files</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>Choose what files you want to update in the database</h1>
        <nav>
            <a href="admin_home.php">Home</a>
            <a href="update_products.php">Update Products</a>
            <a href="update_categories.php">Update Categories</a>
            <a href="update_subcategories.php">Update Subcategories</a>
            <a href="update_shops.php">Update Shops</a>
        </nav>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
