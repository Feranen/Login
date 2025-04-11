<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" id="Username1" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" id="Password1" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password</a>
            </div>
            <button type="submit" class="btn" id="btn">Login</button>
            <div class="register-link">
                <p>Don't have an acoount <a href="register.php">Register</a></p>
            </div>
        </form>

         <?php include "php/LoginForm.php" ?>
        <!---<div class="msg-box">
            <p>test</p>
        </div>  --->
    </div>
    <script src="js/script.js"></script>
</body>
</html>
