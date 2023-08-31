<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_POST['newemail']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $ne = validate($_POST['newemail']);

        if(empty($ne))
        {
            header("Location: change-email.php?error=A new email is required.");
            exit();
        }
        else
        {
            $id = $_SESSION['id'];
            $email = $_SESSION['email'];
            $sql = "SELECT email FROM users WHERE id='$id' AND email='$email'";
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result) === 1)
            {
                $sqlchange = "UPDATE users SET email='$ne' WHERE id='$id'";
                mysqli_query($conn,$sqlchange);
                $_SESSION['email']=$ne;
                header("Location: change-email.php?success=Email change was succesful");
                exit();
            }
            else
            {
                header("Location: change-email.php?error=User not found");
                exit();
            }
        }
    }
    else
    {
        header("Location: change-email.php");
        exit();
    }
}
else
{
    header("Location: index.php");
    exit();
}