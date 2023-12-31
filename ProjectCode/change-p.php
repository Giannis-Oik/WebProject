<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['conpassword']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function validatePassword($password) 
        {
            $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%^&*()_+\-=])[A-Za-z\d!@#\$%^&*()_+\-=]{8,}$/';
            return preg_match($pattern, $password);
        }

        $oldpass = validate($_POST['oldpassword']);
        $newpass = validate($_POST['newpassword']);
        $conpass = validate($_POST['conpassword']);

        if(empty($oldpass)) //Elegxos an exoyn dwthei palio, neo password kai an to neo me to epivevaiwshs einai idia
        {
            header("Location: change-password.php?error=Old password is required.");
            exit();
        }else if(empty($newpass))
        {
            header("Location: change-password.php?error=New password is required.");
            exit();
        }else if($newpass != $conpass)
        {
            header("Location: change-password.php?error=Passwords are not matching.");
            exit();
        }else
        {
            $id = $_SESSION['id']; //An exoyn dwthei swsto ta tria password epelexe twn xrhsth apo th vash me ayto to id kai password 
            $sql = "SELECT password FROM users WHERE id='$id' AND password='$oldpass'";
            $result = mysqli_query($conn,$sql);

            if (!validatePassword($newpass)) //An o neos kwdikos den threi ths proypotheseis emfanise mhnyma lathoys
            {
                header("Location: change-password.php?error=New password must contain at least 8 characters, one capital letter, one number, and one symbol");
                exit();
            } 
            else 
            {
                if(mysqli_num_rows($result) === 1) //An vrethei o xrhsths me to id kai password enhmerwse ton kwdiko toy ston neo kai emfanise mhnyma epityxias
                {
                    $sqlchange = "UPDATE users SET password='$newpass' WHERE id='$id'";
                    mysqli_query($conn,$sqlchange);
                    header("Location: change-password.php?success=Password change was succesful");
                    exit();
                }
                else
                {
                    header("Location: change-password.php?error=Incorrect password");
                    exit();
                }
            }
        }
    }
    else
    {
        header("Location: change-password.php");
        exit();
    }
}
else
{
    header("Location: index.php");
    exit();
}