<?php
session_start();
include "db_conn.php"; 

$signup_message = ''; //Arxikopoihsh metavlhths mhnumatos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Insert dedomenwn sth vash
    $insertQuery = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        //Dhmiourgia session
        $_SESSION['user_name'] = $username;
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        //Epistrofi sto login page me mhnuma epityxias
        header("Location: index.php?success=Sign up successful.");
        exit();
    } else {
        $signup_message = "Sign up failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .signup-button {
            background-color: #333; 
            border: none;
            color: #fff;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px; 
        }

        .button {
            background-color: #f0f0f0; 
            border: none;
            color: #333;
            padding: 10px 15px;
            cursor: pointer;
        }

        .return-button {
            background-color: #fff;
            border: none;
            color: #333;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px; 
        }
    </style>
</head>
<body>
    <form action="signup.php" method="post"> <!-- Dhmiourgia formas gia to sign up -->
        <h2>Sign Up</h2>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <p id="passwordError" style="color: red;"></p>
        
        <button class="signup-button" type="submit">Sign Up</button>
        <button class="return-button" type="button" onclick="location.href='index.php'">Return Back</button>
    </form>
    <p class="signup-message" id="signupMessage"><?php echo $signup_message; ?></p>

    <!-- Xrhsh toy javascript gia to password validation -->
    <script src="password-validation.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("form").addEventListener("submit", function (e) {
                if (!validatePassword()) {
                    e.preventDefault(); //An den ginei validate to password na mhn kataxwrhtei h forma signup
                }
            });
        });
    </script>
</body>
</html>