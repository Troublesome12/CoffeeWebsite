<?php

$title = 'Uploading Image';
$content = "<form action='' method='post' enctype='multipart/form-data'>
                <fieldset>
                    <legend>Uploading an image</legend>
                    <label for='file'>File :</label>
                    <input type='file' name='file' id='file'><br/>
                    <input type='submit' name='submit' value='submit'>
                </fieldset>
            </form>";


if (isset($_POST['submit'])) {
    //Check if the file formet is valid
    $fileType = $_FILES['file']['type'];

    if (($fileType == "image/gif") ||
            ($fileType == "image/jpg") ||
            ($fileType == "image/jpeg") ||
            ($fileType == "image/png")) {

        //check if the file already exists
        if (file_exists("Images/Coffee/" . $_FILES['file']['name']))
            echo 'File already exists!';

        else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'Images/Coffee/' . $_FILES['file']['name']);
            header("Refresh:0; url=Management.php");
        }
    }
}


include './Template.php';
