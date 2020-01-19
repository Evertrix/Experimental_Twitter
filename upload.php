<?php
include('db.php');

define ('MAX_FILE_SIZE', 1000000);

$permitted = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'text/plain'); //Set array of permittet filetypes
$error = true; //Define an error boolean variable
$filetype = ""; //Just define it empty.

foreach( $permitted as $key => $value ) //Run through all permitted filetypes
{
    if( $_FILES['file']['type'] == $value ) {
        $error = false;
        $filetype = explode("/",$_FILES['file']['type']);
        $filetype = $filetype[0];
    }
}

if  ($_FILES['file']['size'] > 0 && $_FILES['file']['size'] <= MAX_FILE_SIZE) //Check for the size
{
    if( $error == false ) //If the file is permitted
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "assets/uploads/" . $_FILES["file"]["name"]); //Move the file from the temporary position till a new one.
        if( $filetype == "image" ) //If the filetype is image, show it!
        {
            echo '<img src="assets/uploads/'.$_FILES["file"]["name"].'">';
        }
        elseif($filetype == "text") //If its text, print it.
        {
            echo nl2br( file_get_contents("assets/uploads/".$_FILES["file"]["name"]) );
        }

    }
    else
    {
        echo "Not permitted filetype.";
    }
}
else
{
    echo "File is too large.";
}

?>
