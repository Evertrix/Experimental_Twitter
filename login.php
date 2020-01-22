<?php
session_start();

include('db.php');

$errors = array();


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
    <link rel="stylesheet" type="text/css" href="assets/CSS/style_register.css">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Document</title>
</head>
<body id="body">

<header>
    <div>
        <img src="assets/images/twitter-icon-18-256.png" class="tweet-image">
    </div>
</header>


<div class="col-md">
    <div id="logbox">
        <form id="signup" method="post" action="login.php">
            <h1>Log In To Your Account</h1>
            <input name="username" type="text" placeholder="What's your username?" pattern="^[\w]{3,16}$"
                   autofocus="autofocus" required="required" class="input pass"/>

            <input name="password" type="password" placeholder="Password" required="required"
                   class="input pass"/>

            <input type="submit" name="login" value="Log In" class="inputButton">
            <?php if(count($errors) > 0) {
                foreach($errors as $error) {
                    echo '<p class="text-center alert alert-danger">'.$error.'</p>';
                }
                }

                ?>

            <div class="text-center">
                Don't have an account? <a href="register.php" name="user-sign-in" id="login_id">Sign Up</a>
            </div>
        </form>
    </div>

</body>
</html>