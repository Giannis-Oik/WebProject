<?php
include "db_conn.php"; // Include your database connection file

$signup_message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password validation
    function validatePassword($password) {
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%^&*()_+\-=])[A-Za-z\d!@#\$%^&*()_+\-=]{8,}$/';
        return preg_match($pattern, $password);
    }

    if (!validatePassword($password)) {
        $signup_message = "The password must contain at least 8 characters, one capital letter, one number, and one symbol.";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            $signup_message = "Sign up successful!";
        } else {
            $signup_message = "Sign up failed. Please try again.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
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
            <label> User Name </label>
            <input type="text" name="uname" placeholder="User Name" required>
            <label> Email </label>
            <input type="email" name="email" placeholder="Email" required>
            <label> Password </label>
            <input type="password" name="password" placeholder="Password" required>
            <p style="color: red;"><?php echo $signup_message; ?></p>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
