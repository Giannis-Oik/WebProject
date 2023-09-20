<?php //Epilegeis ti eidous upload tha kaneis
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1> Pick a choice of the below for the files. </h1>
        
        <nav>
            <a href="insert_files.php">Insert files</a>
            <a href="delete_files.php">Delete files</a>
            <a href="update_files.php">Update files</a>

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