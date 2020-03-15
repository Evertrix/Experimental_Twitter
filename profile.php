<?php
session_start();

include_once('db.php');

include_once('upload.php');


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/CSS/profile_style.css" type="text/css">
    <link rel="stylesheet" href="assets/CSS/style_prof.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/twitter-icon-18-256.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<script>
    $(".container").scroll(function () {
        if ($(this).scrollTop() >= 80) {
            $(".bar").delay(200).addClass("changed");
            $(".profile-pic").addClass("changed");
            if ($(this).scrollTop() >= 180) {
                $(".bar-name").addClass("changed");
                $(".bar-username").addClass("changed");
            } else {
                $(".bar-name").removeClass("changed");
                $(".bar-username").removeClass("changed");
            }
        } else {
            $(".bar").removeClass("changed");
            $(".profile-pic").removeClass("changed");
        }
    });


    $('#exampleModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<div class="container" id="better-scrollbar" style="width: 540px">

    <a href="dashboard.php">
        <img style="position: absolute; left: 0px; top: 0px; height: 50px"
             src="https://cdn2.iconfinder.com/data/icons/simple-circular-icons-line/84/Left_Carrot-512.png">
    </a>

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
    <div class="cover">
        <?php
        $info_wall = 'SELECT wallpaper FROM users WHERE username = "' . $_SESSION["username"] . '"';
        $user_info_wall = mysqli_query($conn, $info_wall);
        $img_wall = mysqli_fetch_array($user_info_wall);

        echo '<img style="width:100px; height:100px;" src="assets/wallpaper/' . $img_wall['wallpaper'] . '">';
        ?>
    </div>


    <div class="profile-pic">


        <div class="avatar-wrapper">

            <div id="wrapper">
                <?php
                $info = 'SELECT profile_image FROM users WHERE username = "' . $_SESSION["username"] . '"';
                $user_info = mysqli_query($conn, $info);
                $img = mysqli_fetch_array($user_info);
                echo '<img id = "uploaded_image" style="width:100px; height:100px;" src="assets/profile_image/' . $img['profile_image'] . '">';

                ?>
            </div>

        </div>
        <div class="d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary text-md-right" id="myInput" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Edit Profile
            </button>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <br>
                        <input type="file" name="upload_wall" id="upload_file"/>
                        <input type="submit" name='submit_wall' class="btn btn-primary"
                               value="Upload Wallpaper"/><br><br><br>

                        <input type="file" name="upload_file" id="upload_file"/>
                        <input type="submit" name='submit_image' class="btn btn-primary"
                               value="Upload Profile Pictire"/>
                        <br><br>

                        <h4> Add Bio: </h4>
                        <textarea style="width: 350px; height: 100px;" name="mybio" id="Bio"
                                  placeholder="Add Bio:"></textarea>
                        <input name="set_bio" class="btn btn-primary" value="Update Bio" type="submit"/>

                        <!--                        <input type="submit" name='submit_image' class="btn btn-primary" value="Upload Image"/>-->

                        <div class="cover">
                            <?php
                            $info_wall = 'SELECT wallpaper FROM users WHERE username = "' . $_SESSION["username"] . '"';
                            $user_info_wall = mysqli_query($conn, $info_wall);
                            $img_wall = mysqli_fetch_array($user_info_wall);

                            //echo '<img style="width:100px; height:100px;" src="assets/wallpaper/' . $img_wall['wallpaper']. '">';
                            echo '</div>';

                            echo '<div id="wrapper">';

                            $info = 'SELECT profile_image FROM users WHERE username = "' . $_SESSION["username"] . '"';
                            $user_info = mysqli_query($conn, $info);
                            $img = mysqli_fetch_array($user_info);

                            //echo '<img style="width:50px; height:100px;" src="assets/profile_image/' . $img['profile_image']. '">';

                            ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!--                            <input type="submit" name='submit_image' class="btn btn-primary" value="Upload Image"/>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="name">
        <div class="name--fullname"><?php echo $_SESSION['username'] ?></div>
        <div class="name--description">
            <!--            I am usually not very inspired...<br>P.S I don't have twitter don't search-->
            <?php
            $info_bio = 'SELECT bio FROM users WHERE username = "' . $_SESSION["username"] . '"';
            $user_bio = mysqli_query($conn, $info_bio);
            $display_bio = mysqli_fetch_assoc($user_bio);

            echo $display_bio['bio'];

            ?>
        </div>
    </div>
    <div class="stats">

        <?php

        $count = 'SELECT COUNT(id) AS Total FROM tweets WHERE user = "' . $_SESSION["username"] . '"';
        $num_seats = mysqli_query($conn, $count);
        $rows = mysqli_fetch_array($num_seats);

        echo 'You have ' . '<b>' . $rows['Total'] . '</b> Tweets &nbsp;&nbsp;';
        //        echo '<b>99</b> Comments';

        ?>

    </div>
    <div class="separating-line"></div>
    <div class="post">
        <?php
        $select = "SELECT * FROM tweets WHERE user = '" . $_SESSION['username'] . "' ORDER BY id DESC";
        $res = mysqli_query($conn, $select);

        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                echo '<div class="tweet-wrap">
  <div class="tweet-header">
    <img src="assets/profile_image/' . $img['profile_image'] . '" class="avatаr">
    <div class="tweet-header-info">';

                echo '<a style = "margin-left: 330px" href="delete.php?id=' . $row["id"] . '">
<svg class="svg-icon" viewBox="0 0 20 20" style = "width: 20px; height: 20px">
	<path fill="none" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
</svg>
</a>';
                echo "<div>" . $row['user'] . "<span>•</span>" . "<span>" . $row['time'] . "</span>" . "</div>";
                echo "<p>" . $row['tweet'] . "</p>";
                if ($row['image']) {
                    echo '<img style="text-align: center; display: block; width:300px; height:300px; margin-left: 15px;" src="assets/uploads/' . $row['image'] . '">';
                }

                echo "</div>";
                echo "</div>";

                echo '<div class="tweet-info-counts">
                        <div class="comments">
                        <svg class="feather feather-message-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
      <div class="comment-count">33</div>
                        </div>
                        <div class="retweets">
      <svg class="feather feather-repeat sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
      <div class="retweet-count">397</div>
    </div>
    <div class="likes">
      <svg class="heart" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
      <div class="likes-count">
       2.6k
      </div>
    </div>
    <div class="message">
      <svg class="feather feather-send sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
    </div>
    </div>';
                echo "</div>";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</div>

</body>
</html>