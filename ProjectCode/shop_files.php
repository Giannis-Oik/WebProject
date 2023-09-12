<?php //Selida apo thn opoia epilegei o admin gia upload, delete, update arxeiwn sxetika me ta katasthmata
session_start();
include "tokens.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Shop files</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <nav>
            <a href="upload_files.php">Upload Files</a>
            <a href="delete_files.php">Delete Files</a>
            <a href="update_files.php">Update Files</a>
        </nav>
    </body>
    </html>

    <?php
}
else
{
    header("Location: index.php");
    exit();
}