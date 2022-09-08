<?php
session_start();
include('connection.php');

$noteId = $_POST['id'];

$sql = "DELETE FROM notes WHERE id = '$noteId'";
$result = mysqli_query($link, $sql);
if(!$result){
    // echo 'error';
    echo '<div class="error">'.mysqli_error($link).'</div>';

    // exit;
}


?>