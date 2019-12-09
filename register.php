<?php

session_start();

include_once('db.php');

$errors = array();

if (isset($_POST['signin'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $retyped_password = $_POST['retyped_password'];

    // form validation: ensure that the form is correctly filled ...
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($password !== $retyped_password) {
        array_push($errors, "Passwords must match!");
    }


    if (mysqli_num_rows($username) > 0) {
        $name_error = "Sorry... username already taken";
    } else if (mysqli_num_rows($email) > 0) {
        $email_error = "Sorry... email already taken";
    } else {
        $query = "INSERT INTO users (username, email, password) 
      	    	  VALUES ('$username', '$email', '" . md5($password) . "')";
        $results = mysqli_query($conn, $query);
        header("Location: login.php");
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="images/twitter-white-icon-16.jpg">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Index Page</title>
</head>
<body>
<header>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="retyped_password" placeholder="Re-Type Your Password">
        <input type="submit" name="signin" value="Sign In"><br>
    </form>
    <p>You have an account? <a href="login.php" name="user-sign-in">Log In</a></p>
</header>
</body>
</html>