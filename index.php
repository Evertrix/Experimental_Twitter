<?php
session_start();

include_once('db.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">

    </script>
    <title>Twitter</title>
</head>
<body>


<div id="container">
    <div class="full-nav">
        <div class="nav-bar">
            <div class="navigation-align">
                <nav class="nav-components">
                    <div class="twitt-logo"><img src="assets/images/Monogram.png"></div>
                    <br>
                    <ul>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="register.php">Sign Up</a></li>
                    </ul>
                    <br>
                </nav>
            </div>
        </div>
        <div class="tweets">
            <br>
            <?php
//            select_database($conn, "tweets");
            upload_tweet($conn, "tweets");
            ?>
        </div>
    </div>
</div>
</body>
</html>