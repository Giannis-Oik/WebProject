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
        <h1>Welcome to the stats selection page</h1>
        <p>Here you can choose to display stats for daily number of sales or a weekly percentage of sales prices</p>
        <nav>
            <a href="admin_home.php">Home</a>
            <a href="mean_sale_price.php">Sales percentage by week</a>
            <a href="day_stats.php">Daily sales per day</a>
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