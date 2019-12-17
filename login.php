<?php
session_start();

include('db.php');

$errors = array();
// $login = $_POST["login"];


if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "You are now logged in";
            header('Location: dashboard.php');
            die();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet" type="text/css" href="assets/CSS/style_login.scss">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Document</title>
</head>
<body>


<!--<header>-->
<!--    <form method="post" action="login.php">-->
<!--        <input type="text" name="username" placeholder="Username">-->
<!--        <input type="password" name="password" placeholder="Password">-->
<!--        <input type="submit" name="login" value="Log In"><br>-->
<!--        <span><a href="forgotten_password.php">Forgot your password?</a></span>-->
<!--    </form>-->
<!--    <p>You don't have an account? <a href="register.php" name="user-sign-up">Sign Up</a></p>-->
<!--</header>-->


<div class='screen'>

    <img class='logo' src='https://s.cdpn.io/15065/twitter-bird-dark-bgs.png'/>

    <form method="post" action="login.php">

        <p class='large'>Welcome</p>

        <div><input type="text" name="username" placeholder="Username"></div>
        <br>
        <div><input type="password" name="password" placeholder="Password"></div>

        <!--        <a class='small flo-l' href=''>Did you forget?</a>-->
        <div class='flo-r cf'>
            <input class='flo-l' type='checkbox' id='remember-me'/>

            <label class='small flo-l' for='remember-me'>Remember me</label>
        </div>

        <div class='signup-link flo-l clr-l'>
            <!--            <p class='small'>New to Twitter?<a href="register.php" name="user-sign-up">Sign Up</a></p>-->
            <p class='small'>You are new to twitter?</p>
            <a class='medium' href="register.php" name="user-sign-up">Sign Up</a>
        </div>
        <input class='flo-r' type="submit" name="login" value="Sign In"/>
    </form>

</div>

</body>
</html>