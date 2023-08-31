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

    // Password validation
    function validatePassword($password) {
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%\^&\*\(\)_\+\-=])[A-Za-z\d!@#\$%\^&\*\(\)_\+\-=]{8,}$/';
        return preg_match($pattern, $password);
    }

    if (!validatePassword($pass)) {
        header("Location: index.php?error=The password must contain at least 8 characters, one capital letter, one number, and one symbol");
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
            header("Location: index.php?error=Incorrect User Name or Password");
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
            header("Location: index.php?error=Incorrect User Name or Password");
            exit();
        }
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validatePassword(passwordField, errorField) {
            var password = passwordField.value;
            var isValid = <?php echo validatePassword('/^[A-Za-z\d!@#\$%\^&\*\(\)_\+\-=]{8,}$/'); ?>;

            if (!isValid) {
                errorField.innerHTML = "The password must contain at least 8 characters, one capital letter, one number, and one symbol.";
                return false;
            }

            errorField.innerHTML = "";
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post" onsubmit="return validatePassword(document.getElementById('login_password'), document.getElementById('login_passwordError'));">
            <h2>Login</h2>
            <label> User Name </label>
            <input type="text" name="uname" placeholder="User Name" required>
            <label> Password </label>
            <input type="password" name="password" id="login_password" placeholder="Password" required>
            <p id="login_passwordError" style="color: red;"></p>
            <button type="submit">Login</button>
        </form>

        <form action="signup_page.php">
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
