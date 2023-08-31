<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_POST['newusername']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $newname = validate($_POST['newusername']);

        if(empty($newname))
        {
            header("Location: change-username.php?error=A new username is required.");
            exit();
        }
        else
        {
            $id = $_SESSION['id'];
            $uname = $_SESSION['user_name'];
            $sql = "SELECT user_name FROM users WHERE id='$id' AND user_name='$uname'";
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result) === 1)
            {
                $sqlchange = "UPDATE users SET user_name='$newname' WHERE id='$id'";
                mysqli_query($conn,$sqlchange);
                $_SESSION['user_name']=$newname;
                header("Location: change-username.php?success=Username change was succesful");
                exit();
            }
            else
            {
                header("Location: change-username.php?error=User not found");
                exit();
            }
        }
    }
    else
    {
        header("Location: change-username.php");
        exit();
    }
}
else
{
    header("Location: index.php");
    exit();
}