<?php
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
        <h1>Hello, <?php echo $_SESSION['user_name']; ?> </h1>
        <nav>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Check your profile</a>
            <a href="map.php">Open store map</a>
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