<?php
require_once('forgotten_password.php');
require_once('db.php');
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<link rel = "shortcut icon" type = "image/x-icon" href = "assets/images/twitter-icon-18-256.png">
<head>
    <meta charset="UTF-8">
    <title>Password Reset PHP</title>
</head>
<body>

<form class="login-form" action="pending_email.php" method="post" style="text-align: center;">
    <p>
        We sent an email to <b><?php echo $_POST['username'] ?></b> to help you recover your account.
    </p>
    <p>Please login into your email account and click on the link we sent to reset your password</p>
</form>

</body>
</html>