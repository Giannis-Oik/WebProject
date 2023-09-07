<?php
session_start();
include "db_conn.php";

$login_error = ''; //Arxikopoihsh mhnymatos gia login error

if(isset($_POST['uname']) && isset($_POST['password']))
{
    function validate($data) //Synarthsh poy katharizei ta dwsmena dedomena
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname)) //An den yparxei username tote emfanise error
    {
        header("Location: index.php?error=User Name is required");
        exit();
    }
    else if(empty($pass)) //An den yparxei password submitted tote emfanise error
    {
        header("Location: index.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'"; //Retrieve apo th vash ta dedomena xrhstwn kai admin
    $sqladmin = "SELECT * FROM admins WHERE user_name='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);
    $resultadmin = mysqli_query($conn, $sqladmin);

    if(mysqli_num_rows($result) === 1) //Perna ta dedomena xrhstwn kai psaxe gia xrhsth me ta dwsmena username, password
    {
        $row = mysqli_fetch_assoc($result);
        if($row['user_name'] === $uname && $row['password'] === $pass) //Vrethike xrhsths: emfanise mhnyma eisodoy, arxikopoihse to session kai fortwse to home page
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
    else if(mysqli_num_rows($resultadmin) === 1) //Perna ta dedomena admin kai psaxe gia admin me ta dwsmena username, password
    {
        $row = mysqli_fetch_assoc($resultadmin);
        if($row['user_name'] === $uname && $row['password'] === $pass) //Vrethike admin: emfanise mhnyma eisodoy, arxikopoihse to session kai fortwse to home page
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

<!DOCTYPE html> <!-- Forma gia to signup poy yparxei mazi me to login -->
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
