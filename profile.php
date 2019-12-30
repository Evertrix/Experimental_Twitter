<?php
session_start();

include_once('db.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/CSS/profile_style.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <title>Document</title>
</head>
<body>
<script>
    $(".container").scroll(function() {
        if($(this).scrollTop()>=80) {
            $(".bar").delay(200).addClass("changed");
            $(".profile-pic").addClass("changed");
            if($(this).scrollTop()>=180) {
                $(".bar-name").addClass("changed");
                $(".bar-username").addClass("changed");
            }
            else {
                $(".bar-name").removeClass("changed");
                $(".bar-username").removeClass("changed");
            }
        }
        else {
            $(".bar").removeClass("changed");
            $(".profile-pic").removeClass("changed");
        }
    });
</script>


<div class="container" id="better-scrollbar">
    <div class="bar">
        <h3 class="bar-name"><?php echo $_SESSION['username'] ?></h3>
    </div>

    <div class="icons">
        <div class="icons--back">
            <i class="fa fa-arrow-left"></i>
        </div>
        <div class="icons--menu">
            <i class="fa fa-bars"></i>
        </div>
    </div>


    <div class="cover"></div>
    <div class="profile-pic"></div>
    <div class="edit-profile">Edit profile</div>
    <div class="name">
        <div class="name--fullname"><?php echo $_SESSION['username'] ?></div>
        <div class="name--description">I am usually not very inspired...<br>P.S I don't have twitter don't search</div>
    </div>
    <div class="stats">
        <b>9</b> Likes &nbsp;&nbsp; <b>99</b> Comments
    </div>
    <div class="separating-line"></div>
    <div class="post">
        <?php
        $select = "select * from tweets where user = '".$_SESSION['username']."' ORDER BY id DESC";
//        $select = "SELECT * FROM tweets ORDER BY id DESC";
        $res = mysqli_query($conn, $select);

        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {

                echo "<div class=\"tweet-wrap\">
  <div class=\"tweet-header\">
    <img src=\"https://cdn2.iconfinder.com/data/icons/audio-16/96/user_avatar_profile_login_button_account_member-512.png\" style='padding-left: 10px' alt=\"\" class=\"avator\"> 
    <div class=\"tweet-header-info\">";
                echo "<div>".$row['user']."<span>•</span>"."<span>". $row['time'] ."</span>"."</div>";
                echo "<p>" . $row['tweet'] . "</p>";

                echo "</div>";
                echo "</div>";

                echo "<div class=\"tweet-info-counts\">
    
                        <div class=\"comments\">
                        <svg class=\"feather feather-message-circle sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><path d=\"M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z\"></path></svg>
      <div class=\"comment-count\">33</div>
                        </div>
                        
                        <div class=\"retweets\">
      <svg class=\"feather feather-repeat sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><polyline points=\"17 1 21 5 17 9\"></polyline><path d=\"M3 11V9a4 4 0 0 1 4-4h14\"></path><polyline points=\"7 23 3 19 7 15\"></polyline><path d=\"M21 13v2a4 4 0 0 1-4 4H3\"></path></svg>
      <div class=\"retweet-count\">397</div>
    </div>
    
    
    
    <div class=\"likes\">
      <svg class='heart' xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><path d=\"M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z\"></path></svg>
      <div class=\"likes-count\">
       2.6k
      </div>
    </div>
    
    
    
    <div class=\"message\">
      <svg class=\"feather feather-send sc-dnqmqq jxshSx\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"><line x1=\"22\" y1=\"2\" x2=\"11\" y2=\"13\"></line><polygon points=\"22 2 15 22 11 13 2 9 22 2\"></polygon></svg>
    </div>
    </div>";
                echo "</div>";
            }
        }

        mysqli_close($conn);
    ?>
    </div>
</div>

</body>
</html>