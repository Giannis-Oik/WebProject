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
    <h1>Update values in each category</h1>
        <nav>
            <!-- Update Buttons -->
            <div class="update-buttons">
                <a href="update_products.php">Update Products</a>
                <a href="update_categories.php">Update Categories</a>
                <a href="update_subcategories.php">Update Subcategories</a>
            </div>
            <div>
            <a href="admin_home.php">Back to Home</a>
        </div>
        </nav>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
