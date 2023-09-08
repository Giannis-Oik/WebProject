<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Files</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
    <h1>Delete values in each category</h1>
        <nav>
            <!-- Delete Buttons -->
            <div class="delete-buttons">
                <a href="delete_products.php">Delete Products</a>
                <a href="delete_categories.php">Delete Categories</a>
                <a href="delete_subcategories.php">Delete Subcategories</a>
            </div>
            <div>
            <a href="../admin_home.php">Back to Home</a>
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
