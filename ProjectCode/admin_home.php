<?php //Arxikh selida twn admins me to menu poy afora tis energeies twn admins
session_start();
include "tokens.php";
include_once "update_active_sales.php";

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
        <h1>Welcome, admin <?php echo $_SESSION['user_name']; ?> </h1>
        
        <nav>
            <a href="logout.php">Logout</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="stats.php">Stats</a>
            <a href="upload_choices.php">Upload choices</a>
            <a href="map_admin.php">Open store map</a>
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