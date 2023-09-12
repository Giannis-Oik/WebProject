<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Upload Files</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
    <h1>Upload values in each category</h1>
        <nav>
            <!-- Upload Buttons////ousiastika phgainei sto insert, apla allazei mono to json arxeio -->
            <div class="upload-buttons"> 
                <a href="upload_products.php">Upload Products</a>
                <a href="upload_categories.php">Upload Categories</a>
                <a href="upload_subcategories.php">Upload Subcategories</a>
                <a href="upload_shops.php">Upload Shops</a>

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
