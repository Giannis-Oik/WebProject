<?php
session_start();
include "db_conn.php";

$login_error = ''; // Initialize the login error message

if(isset($_POST['uname']) && isset($_POST['password']))
{
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname))
    {
        header("Location: index.php?error=User Name is required");
        exit();
    }
    else if(empty($pass))
    {
        header("Location: index.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
    $sqladmin = "SELECT * FROM admins WHERE user_name='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);
    $resultadmin = mysqli_query($conn, $sqladmin);

    if(mysqli_num_rows($result) === 1)
    {
        $row = mysqli_fetch_assoc($result);
        if($row['user_name'] === $uname && $row['password'] === $pass)
        {
            echo "You are now logged in.";
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        }
        else
        {
            header("Location: index.php?error=Incorrect User Name or Password. Please try again or sign up");
            exit();
        }
    }
    else if(mysqli_num_rows($resultadmin) === 1)
    {
        $row = mysqli_fetch_assoc($resultadmin);
        if($row['user_name'] === $uname && $row['password'] === $pass)
        {
            echo "You are now logged in.";
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            header("Location: admin_home.php");
            exit();
        }
        else
        {
            header("Location: index.php?error=Incorrect User Name or Password. Please try again or sign up");
            exit();
        }
    }
    else
    {
        header("Location: index.php?error=Incorrect User Name or Password. Please try again or sign up");
        exit();
    }
    
}
else
{
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form action="signup.php" method="post">
            <h2>Sign Up</h2>
            <label>User Name</label>
            <input type="text" name="uname" placeholder="User Name" required>
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <p id="passwordError" style="color: red;"></p>
            <button class="login-button" type="submit">Sign Up</button>
            <button class="login-button" type="button" onclick="location.href='index.php'">Return Back</button>
        </form>
    </div>
    <script src="password-validation.js"></script>
</body>
</html>
