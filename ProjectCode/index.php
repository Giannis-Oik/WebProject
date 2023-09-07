<!DOCTYPE html>
<html>
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .signup-button {
            background-color: #f0f0f0; 
            border: none;
            color: #333;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px; 
        }

        .button {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post"> <!-- Arxeio ypodeixhs gia to poia selida emfanizetai otan fortwthei to site -->
        <h2>LOGIN</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
                <p class="success"> <?php echo $_GET['success']; ?></p>
        <?php } ?>
        <label> User Name </label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <label> Password </label>
        <input type="password" name="password" placeholder="Password"><br>

        <button class="button" type="submit">Login</button>
        <button class="signup-button" type="button" onclick="location.href='signup.php';">Sign Up</button>
    </form>
</body>
</html>
