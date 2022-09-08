<?php
session_start();
include "connection.php";

$id = $_SESSION['userId'];
$userName = $_POST['username'];


$sql = "UPDATE users SET username = '$userName' WHERE userId = '$id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
    echo '<div class="error">'.mysqli_error($link).'</div>';

    // exit;
}

?>