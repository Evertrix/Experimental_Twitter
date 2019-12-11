<?php

session_start();

include_once('db.php');

$email = mysqli_real_escape_string($conn, $_POST['email']);
$submit = $_POST['submit'];
$new_password = $_POST['new_password'];
$confirm_new_password = $_POST['confirm_new_password'];

if (isset($submit)) {
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($conn, $_POST['confirm_new_password']);

    $errors = [];
    if (empty($new_password) || empty($confirm_new_password)) {
        array_push($errors, "Password Required!");
    }
    if ($new_password !== $confirm_new_password) {
        array_push($errors, "Passwords Do Not Match!!");
    }

    if (count($errors) == 0) {

        $sql = "SELECT * FROM users WHERE email ='$email'";
        $res = mysqli_query($conn, $sql);
        $email = mysqli_fetch_assoc($res)['email'];

        if ($email) {
            $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
            $res = mysqli_query($conn, $sql);
            header('Location: login.php');
        }
    }


}


mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel = "shortcut icon" type = "image/x-icon" href = "assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset forgotten password</title>
</head>
<body>

<form action="reset.php" method="post">
    <input type="password" name="new_password" placeholder="New password">
    <br>
    <input type="password" name="confirm_new_password" placeholder="Confirm Password">
    <div class="form-group">
        <button type="submit" name="submit" class="login-btn">Submit</button>
    </div>
</form>

</body>
</html>
