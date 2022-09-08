<?php
session_start();

include "connection.php";

$errors =  "";

$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';

if(empty($_POST["forgotEmail"])){
    $errors.= $missingEmail;
}else{
    $email = filter_var($_POST["forgotEmail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors.= $invalidEmail;
    } 
}

if($errors){
    $resultMessage = '<div class="error">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}

$email = mysqli_real_escape_string($link, $email);

// if email exists in the user table print error
$sql = "SELECT * FROM  users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="error">Error running the query!</div>';
    exit;
}

$count = mysqli_num_rows($result);
if($count != 1 ){
    echo '<div class="error">That email does not exits on our database! </div>';
    exit;
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$userId = $row['userId'];

// //create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
// date('Y-m-d H:i:s', time() + 1296000);
$status = "pending"; 

// $sql = "INSERT INTO forgotpassword (`userId`,`key`,`time`,`status`) VALUES ('$userId','$activationKey','$time','$status')";
$sql = "INSERT INTO forgotpassword (`userId`, `rkey`, `time`, `status`) VALUES ('$userId', '$activationKey', '$time', '$status')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="error">'.mysqli_error($link).'</div>';
    echo '<div class="error">There was an error  inserting users details in the database </div>';
    exit;
}

// Send the user an email with a link to resetPass.php with userId and activation code
$message = "pls click on this link to reset your password:\n\n";
$message .= "http://onlinenote.ig/resetpass.php?userId=$userId&key=$activationKey";
if(mail($email, 'Reset your password', $message,'From:'.'ezehigc@gmail.com')){
    echo "<div class='success'>An email has been sent to $email. please click on the link to reset your password </div>";
}

?>