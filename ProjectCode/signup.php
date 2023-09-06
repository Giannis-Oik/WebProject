<?php
session_start();
include "db_conn.php"; // Include your database connection file

$signup_message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user data into the database
    $insertQuery = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        // Create a session for the user
        $_SESSION['user_name'] = $username;
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Redirect the user to index.php
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
        /* Additional style for the "Sign Up" button */
        .signup-button {
            background-color: #333; /* Use the same color as the Login button in index.php */
            border: none;
            color: #fff;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px; /* Add some margin between the buttons */
        }

        /* Apply the same button style for consistency */
        .button {
            background-color: #f0f0f0; /* Use the same color as the Sign Up button in index.php */
            border: none;
            color: #333;
            padding: 10px 15px;
            cursor: pointer;
        }

        /* Style for the "Return Back" button to make it white */
        .return-button {
            background-color: #fff;
            border: none;
            color: #333;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px; /* Add some margin between the buttons */
        }
    </style>
</head>
<body>
    <form action="signup.php" method="post">
        <h2>Sign Up</h2>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <p id="passwordError" style="color: red;"></p>
        
        <!-- Apply the updated button styles -->
        <button class="signup-button" type="submit">Sign Up</button>
        <button class="return-button" type="button" onclick="location.href='index.php'">Return Back</button>
    </form>
    <p class="signup-message" id="signupMessage"><?php echo $signup_message; ?></p>

    <!-- Include the password validation script -->
    <script src="password-validation.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("form").addEventListener("submit", function (e) {
                if (!validatePassword()) {
                    e.preventDefault(); // Prevent the form submission if validation fails
                }
            });
        });
    </script>
</body>
</html>