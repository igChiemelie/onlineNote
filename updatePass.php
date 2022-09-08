<?php
session_start();

include "connection.php";

// $currentPassword =  "";


//define error messages
$missingCurrentPassword = '<p><strong>Please enter your Current Password!</strong></p>';
$incorrectCurrentPassword = '<p><strong>The password entered is incorrect!</strong></p>';
$missingPassword = '<p><strong>Please enter a new Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';

if(empty($_POST["currentPassword"])){
    $errors .= $missingCurrentPassword;

}else{

    $currentPassword = $_POST["currentPassword"];
    $currentPassword = filter_var($currentPassword, FILTER_SANITIZE_STRING);
    $currentPassword = mysqli_real_escape_string ($link, $currentPassword);
    $currentPassword = hash('sha256', $currentPassword);

    $userId = $_SESSION['userId'];
    $sql = "SELECT password FROM users WHERE userId = '$userId'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo 'error';
        echo '<div class="error">'.mysqli_error($link).'</div>';
        exit;
    }

    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="error">There was a problem running the query</div>';
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($currentPassword != $row['password']){
            $errors .= $incorrectCurrentPassword;
        }
    }
}

if(empty($_POST["password"])){
    $errors.= $missingPassword;

}elseif(!(strlen($_POST["password"]) > 6 
    and preg_match('/[A-Z]/', $_POST["password"])
    and preg_match('/[0-9]/', $_POST["password"]) 
    )
){
    $errors.= $invalidPassword;
}else {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if(empty($_POST['password2'])){
        $errors.= $missingPassword2;
    }else {
        $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);

        if($password !== $password2){
            $errors.= $differentPassword;
        }
    }
}
       

if($errors){
    $resultMessage = '<div class="error">'.$errors.'</div>';
    echo $resultMessage;
}else{
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    $sql = "UPDATE users SET password = '$password' WHERE userId = '$userId'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo 'The password could not be reset, pls try again!';
        echo '<div class="error">'.mysqli_error($link).'</div>';
        exit;
    }else{
        echo '<div class="success">Your password has been updated succesfully</div>';
        echo "<script>
              setTimeout(() => {
                location.reload();

            }, 6000);
        </script>";
        
    }

}


?>