<?php
session_start();

include_once('db.php');

// check if user is logged in if not redirect to login.php

$make_a_tweet = $_POST['tweet'];

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// check if a tweet has been submitted if not just show the form

if (isset($_POST["tweet"])) {
    $sql = "INSERT INTO tweets (user_id, user, tweet) VALUES ('{$_SESSION['user_id']}', '{$_SESSION['username']}', '$make_a_tweet')";

    if (mysqli_query($conn, $sql) == true) {
        header("Location: dashboard.php");
        exit;
    }

}

// if a tweet has been submitted the save it in the database an then show the form

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>

            function gotkey() {
                var count = document.getElementById("postMessage").value.length;

                if(count > 140) {
                    var output = "Sorry";
                    count;
                }
                else {
                    var output = "Character count: " + count + " of " + 140;
                }
                document.getElementById("status").innerHTML = output;
            }

    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">
    <link rel="stylesheet" href="assets/CSS/style.php" media="screen">
    <link rel="shortcut icon" type="image/x-icon" href="images/twitter-white-icon-16.jpg">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Twitter</title>
</head>
<body>

<div>
    <p class="logout"><a href="logout.php">Log Out</a></p>
    <p class="logout"><a href="change.php">Change Password</a></p>
    <div class="account">
        <p><?php echo "Hello, " . $_SESSION['username'] ?></p>
    </div>
</div>

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

        <div class="publish">
            <form method="post" action="dashboard.php">
                <div><textarea id="postMessage" onkeyup = "gotkey()" name="tweet" plcaeholder="Tweet here" rows="3" cols="40"></textarea></div>
                <div id = "status"></div>
                <div>
                    <input type="submit" name="submit" value="Publish">
                </div>
            </form>
            <br>
        </div>

        <?php
        $select = "SELECT * FROM tweets ORDER BY id DESC";
        $res = mysqli_query($conn, $select);
        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<blockquote class = 'text-center'><p class='twitter-tweet'>User: " . $row['user'] . " Tweet: " . $row['tweet'] . "</p></blockquote>";
            }
        }
        mysqli_close($conn);
        ?>

    </div>
</div>
</body>
</html>