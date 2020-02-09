<?php
session_start();

include_once('db.php');

define('MAX_FILE_SIZE', 1000000);
$permitted = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'text/plain');

if (isset($_POST["submit_image"])) {

    $sql = "UPDATE users SET profile_image = '{$_FILES['upload_file']['name']}' WHERE username = '{$_SESSION['username']}';";
    $num_wall = mysqli_query($conn, $sql);
    $file_image = mysqli_fetch_assoc($num_wall);
}

if (!empty($_POST["upload_file"])) {

    $uploadfile = $_FILES["upload_file"]["tmp_name"];
    $abs_upload_path = __DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "profile_image" . DIRECTORY_SEPARATOR;
    $filetype = "";

    if ($_FILES['upload_file']['size'] > 0 && $_FILES['upload_file']['size'] <= MAX_FILE_SIZE) {
        if ($_FILES['the_file']['error'] == 0) {

            move_uploaded_file($_FILES["upload_file"]["tmp_name"], "$abs_upload_path" . $_FILES["upload_file"]["name"]);

            if (in_array($_FILES['upload_file']['type'], $permitted) && in_array($_FILES['upload_file']['type'], $permitted)) {
                echo '<img src="assets/profile_image/' . $_FILES["upload_file"]["name"] . '">';
            }

            if ($filetype == "text") {

                echo nl2br(file_get_contents("assets/profile_image/" . $_FILES["upload_file"]["name"]));
            }

        } else {
            echo "Not permitted filetype.";
        }
    }
}


if (isset($_POST["submit_wall"])) {
    $sql = "UPDATE users SET wallpaper = '{$_FILES['upload_wall']['name']}' WHERE username = '{$_SESSION['username']}';";
    $num_wall = mysqli_query($conn, $sql);
    $file_image = mysqli_fetch_assoc($num_wall);
}

if (!empty($_POST["upload_wall"])) {

    $uploadfile_wall = $_FILES["upload_wall"]["tmp_name"];
    $abs_upload_path_wall = __DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "wallpaper" . DIRECTORY_SEPARATOR;

    if ($_FILES['upload_wall']['size'] > 0 && $_FILES['upload_wall']['size'] <= MAX_FILE_SIZE) {
        if ($_FILES['the_file']['error'] == 0) {

            move_uploaded_file($_FILES["upload_wall"]["tmp_name"], "$abs_upload_path_wall" . $_FILES["upload_wall"]["name"]);

            if (in_array($_FILES['upload_wall']['type'], $permitted)) {
                echo '<img src="assets/wallpaper/' . $_FILES["upload_wall"]["name"] . '">';

            }
            if ($filetype == "text") {
                echo nl2br(file_get_contents("assets/wallpaper/" . $_FILES["upload_wall"]["name"]));
            }

        } else {
            echo "Not permitted filetype.";
        }

    }
}


if (isset($_POST["mybio"]) && !empty($_POST["mybio"])) {

    $bio = $_POST['mybio'];
    $sql = "UPDATE users SET bio = '$bio' WHERE username = '{$_SESSION['username']}'";
    $query_bio = mysqli_query($conn, $sql);
    $make_bio = mysqli_fetch_array($query_bio);
}

if (mysqli_query($conn, $sql) == true) {
    header("Location: profile.php");
    die();
}
?>
