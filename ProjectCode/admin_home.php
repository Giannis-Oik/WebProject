<?php //Arxikh selida twn admins me to menu poy afora tis energeies twn admins
session_start();
include "tokens.php";

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
        <h1>Hello, Admin <?php echo $_SESSION['user_name']; ?> </h1>
        
        <nav>
            <a href="upload_choices.php">Upload choices</a>
            <a href="stats.php">Stats</a>
            <a href="logout.php">Logout</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="shop_files.php">Supermarket files</a>
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