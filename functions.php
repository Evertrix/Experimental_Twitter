<?php
session_start();
include_once('db.php');

function upload_image()
{

    define('MAX_FILE_SIZE', 1000000);
    $permitted = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'text/plain');
    $abs_upload_path = __DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $filetype = "";

    if ($_FILES['the_file']['size'] > 0 && $_FILES['the_file']['size'] <= MAX_FILE_SIZE) {
        if ($_FILES['the_file']['error'] == 0) {
            move_uploaded_file($_FILES["the_file"]["tmp_name"], $abs_upload_path . $_FILES["the_file"]["name"]);

            if (in_array($_FILES['the_file']['type'], $permitted)) {

                echo '<img src="assets/uploads/' . $_FILES["the_file"]["name"] . '">';
            } elseif ($filetype == "text") {
                echo nl2br(file_get_contents("assets/uploads/" . $_FILES["the_file"]["name"]));
            }

        } else {
            echo "Not permitted filetype.";
        }
    }
}

//<img src="https://icon-library.net/images/user-icon-image/user-icon-image-20.jpg" style="padding-left: 10px" class="avator">



function upload_tweet($conection, $db_table)
{

    $info = 'SELECT profile_image FROM users WHERE username = "' . $_SESSION["username"] . '"';
    $user_info = mysqli_query($conection, $info);
    $img = mysqli_fetch_array($user_info);

    $select = "SELECT * FROM $db_table ORDER BY id DESC";
    $res = mysqli_query($conection, $select);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            echo '<div class="tweet-wrap">
                  <div class="tweet-header">';
            echo '<div class="profile-pic">
        <div class="avatar-wrapper">';
            echo '<img id = "uploaded_image" class = "avator" style="width:50px; height:50px;" src="assets/profile_image/' . $img['profile_image'] . '">';
//                echo '<img id = "uploaded_image" class = "avator" style="width:50px; height:50px;" src="https://icon-library.net/images/user-icon-image/user-icon-image-20.jpg">';
            echo '</div>';
            echo '</div>';
            echo '<div class="tweet-header-info">';

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
    mysqli_close($conection);
}