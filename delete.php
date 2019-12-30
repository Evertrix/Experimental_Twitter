<?php
session_start();
require('db.php');
//require('dashboard.php');

    $id = 4;
    $query = "DELETE FROM tweets WHERE user_id='{$_SESSION['user_id']}'";
    $result = mysqli_query($conn,$query) or die ( mysqli_error());
    $row = mysqli_fetch_assoc($result);
    header("Location: dashboard.php");


?>