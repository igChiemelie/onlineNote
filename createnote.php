<?php
session_start();
include('connection.php');

$userId = $_SESSION['userId'];

$time = time();

$sql = "INSERT INTO notes (`userId`, `note`, `time`) VALUES ('$userId', '', '$time')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}else {
    # code...
    //Returns the Auto generated id used in th last query
    echo mysqli_insert_id($link);
}
?>