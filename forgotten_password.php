<?php
session_start();

require_once('db.php');

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        exit ("Email sent to User");
    } else {
        echo "User with such email does not exist in database";
    }

    $r = mysqli_fetch_assoc($res);
    $password = $r['password'];

    $to = $r['email'];
    $subject = "Your Recovered Password";
    $message = "use this link to reset password " . preg_replace('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', '<a href="http://localhost/twitt_clone/reset.php">link</a>', 'reset.php');;
    $headers = "From : no-reply@gmail.com";
    if (mail($to, $subject, $message, $headers)) {
        header('Location: reset.php?email=' . $to);
        exit("ALL SENT");
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
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="images/twitter-white-icon-16.jpg">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form class="form-signin" action="forgotten_password.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Send</button>
</form>

</body>
</html>
