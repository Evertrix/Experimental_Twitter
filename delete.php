<?php
//session_start();
//require('db.php');
//require('dashboard.php');
//
//    if(isset($_SESSION["user_id"])) {
//        $sql = "DELETE FROM tweets WHERE tweet='$make_a_tweet'";
//        $res = mysqli_query( $sql );
//        header("Location:dashboard.php");
//    }
//
//
//    //redirecting to the display page
//
//mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Delete a Blog Entry</title>
</head>
<body>
<h1>Delete an Entry</h1>
<?php

session_start();
include_once('db.php');


if (isset($_GET['id']) && is_numeric($_GET['id'])) { // Display the entry in a form:
    // Define the query:
    $query = "SELECT * FROM tweets WHERE id={$_GET['id']}";
    if ($r = mysqli_query($conn, $query)) {
        // Run the query.
        $row = mysqli_fetch_array($r); // Retrieve the information.

        // Make the form:
        print '<form action="delete.php" method="post">
		<p>Are you sure you want to delete this entry?</p>
		<p><h3>' . $row['user'] . '</h3>' .
            $row['tweet'] . '<br>
		<input type="hidden" name="id" value="' . $_GET['id'] . '">
	    <input type="submit" name="submit" value="Delete this Entry!"></p>

		</form>';
        
    } else { // Couldn't get the information.
        print '<p style="color: red;">Could not retrieve the blog entry because:<br>' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
    }
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.
    // Define the query:
    $query = "DELETE FROM tweets WHERE id={$_POST['id']} LIMIT 1";
    $r = mysqli_query($conn, $query); // Execute the query.
    // Report on the result:
    if (mysqli_affected_rows($conn) == 1) {
        print '<p>The blog entry has been deleted.</p>';
        header("Location: profile.php");
        exit;

    } else {
        print '<p style="color: red;">Could not delete the blog entry because:<br>' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
    }
} else { // No ID received.
    print '<p style="color: red;">This page has been accessed in error.</p>';

} // End of main IF.
mysqli_close($conn); // Close the connection.
?>
</body>
</html>