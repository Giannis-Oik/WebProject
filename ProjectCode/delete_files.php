<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Files</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>Choose what files you want to delete from the database</h1>
        <nav>
            <a href="admin_home.php">Home</a>
            <a href="delete_products.php">Delete Products</a>
            <a href="delete_categories.php">Delete Categories</a>
            <a href="delete_subcategories.php">Delete Subcategories</a>
            <a href="delete_shops.php">Delete Shops</a>
        </nav>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
