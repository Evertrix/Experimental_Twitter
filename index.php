<?php
session_start();

include_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/Images/twitter-white-icon-16.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Twitter</title>
</head>
<body>

<div id="container">
    <div class="full-nav">
        <div class="nav-bar">
            <div class="navigation-align">
                <nav class="nav-components">
                    <div class="twitt-logo"><img src="assets/images/twitter-icon-18-256.png"></div>
                    <br>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#explore">Explore</a></li>
                        <li><a href="#notif">Notifications</a></li>
                        <li><a href="#messages">Messages</a></li>
                        <li><a href="#bookmarks">Bookmarks</a></li>
                        <li><a href="#lists">Lists</a></li>
                        <li><a href="#profile">Profile</a></li>
                        <li><a href="#more">More</a></li>
                    </ul>
                    <br>
                </nav>
            </div>
        </div>
        <div class="tweets">
            <?php
            $select = "SELECT * FROM tweets ORDER BY id DESC";
            $res = mysqli_query($conn, $select);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
//                echo "<p>id: ".$row['user_id']."User: ".$row['user']."Tweet: ".$row['tweet']. "</p>";
                    echo "<div class = 'text-center'><p>User: " . $row['user'] . " Tweet: " . $row['tweet'] . "</p></div>";
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>
</body>
</html>