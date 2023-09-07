<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) //Selida poy emfanizei to menu ston admin sxetika me poia statistika thelei na dei h epsitrofh sthn arxikh
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Stats</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <nav>
            <a href="day_stats.php">Daily sales number stats</a>
            <a href="mean_sale_price.php">Sale prices stats</a>
            <a href="admin_home.php">Home</a>
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