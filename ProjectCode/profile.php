<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    $uname = $_SESSION['user_name'];
    $email = $_SESSION['email'];
    $sqlemail = "SELECT * FROM users WHERE user_name='$uname' AND email='$email'";
    $result = mysqli_query($conn,$sqlemail);
    $row = mysqli_fetch_assoc($result);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['user_name']; ?> this is your profile page. </h1>
        <p>Here you can change your username, password and email.</p>
        
        <ul>
            <li>Username: <?php echo $_SESSION['user_name']; ?> </li>
            <li>Email: <?php echo $_SESSION['email']; ?></li>
        </ul>
        <nav>
            <a href="change-username.php">Change username</a>
            <a href="change-email.php">Change email</a>
            <a href="change-password.php">Change password</a>
            <a href="home.php">Home</a>
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