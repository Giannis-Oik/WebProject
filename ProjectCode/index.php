<!DOCTYPE html>
<html>
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <button class="button" type="button" onclick="location.href='signup.php';">Sign Up</button>
    </form>
</body>
</html>
