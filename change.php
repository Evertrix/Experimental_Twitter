<?php

session_start();
include_once('db.php');

$errors = [];

if (empty($_POST['old_password'])) {
    array_push($errors, 'Old Password is required');
}

if (empty($_POST['new_password']) || empty($_POST['re-typed_password'])) {
    array_push($errors, 'Password are required');
}

if ($_POST['new_password'] !== $_POST['re-typed_password']) {
    array_push($errors, 'Passwords do not match');

}


if (isset($_POST['submit']) && isset($_POST['new_password']) && isset($_POST['old_password']) && isset($_POST['re-typed_password'])) {
    if ($_POST['new_password'] == $_POST['re-typed_password']) {
        $new_password = $_POST['new_password'];
        $retyped_password = $_POST['re-typed_password'];
        $new_password = md5($new_password);
        $old_password = $_POST['old_password'];
        $old_password = md5($old_password);
        $user = $_SESSION['username'];
        $search_for_password = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$user'");

        if (mysqli_num_rows($search_for_password) == 1) {
            $result = mysqli_fetch_array($search_for_password);
            if ($result['password'] == $old_password) {
                $updating_the_password = mysqli_query($conn, "UPDATE `users` SET `password`='$new_password' WHERE `username`='$user'");

                if ($updating_the_password) {
                    echo 'Updated password!';
                    header("Location: login.php");
                    exit;
                } else
                    echo 'Failed to update your password.';
            } else
                echo 'Your entered current password was not correct. Please try again.';
        } else
            echo 'Your username was not found in our users database!';
    } else
        echo 'The two new passwords did not match. Please ensure they match and that the current password field is correct then try again.';

}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet" type="text/css" href="assets/CSS/style_login.scss">
    <link rel="stylesheet" type="text/css" href="assets/CSS/style_register.css">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
</head>
<body>


<div class="col-md">
    <div id="logbox">
        <form id="signup" action="change.php" method='post'>
            <h1>Change your Password</h1>
            <input type="password" name="old_password" placeholder="Old Password" pattern="^[\w]{3,16}$" autofocus="autofocus" required="required" class="input pass"/>

            <input type="password" name="new_password" placeholder="New Password" required="required" class="input pass"/>

            <input type="password" name="re-typed_password" placeholder="Re-Type New Password" class="input pass">

            <input type="submit" name="submit" value="Change" class="inputButton">
        </form>
    </div>
</body>
</html>
