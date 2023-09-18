<?php //Arxeio poy emfanizei ta aparaithta gia thn allagh password
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Change username</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Please insert the old and new password in order to change it</h1>
        <form action="change-p.php" method="post">

            <?php if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <?php if(isset($_GET['success'])) { ?>
                <p class="success"> <?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label> Old password </label>
            <input type="password" name="oldpassword" placeholder="Old Password"><br>

            <label> New Password </label>
            <input type="password" name="newpassword" placeholder="New Password"><br>

            <label> Confirm New Password </label>
            <input type="password" name="conpassword" placeholder="Confirm New Password"><br>

            <button class="button" type="submit">Confirm change</button>
            <button class="button" type="button" onclick="location.href='home.php';">Home</button>
        </form>
    </body>
    </html>

    <?php
}
else
{
    header("Location: index.php");
    exit();
}