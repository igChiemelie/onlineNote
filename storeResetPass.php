<?php
session_start();

include "connection.php";


    if(!isset($_POST['userId']) || !isset($_POST['key'])){
        echo  '<div class="error">pls click on the link you recieve by Email</div>';
        exit;
    }

    $userId = $_POST['userId'];
    $key = $_POST['key'];
    $time = time() - 86400;

    $userId = mysqli_real_escape_string($link, $userId);
    $key = mysqli_real_escape_string($link, $key);


    $sql = "SELECT userId FROM forgotpassword WHERE rkey = '$key' AND userId = '$userId' AND time > '$time' AND status = 'pending'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="error">'.mysqli_error($link).'</div>';
        echo '<div class="error">Error running query</div>';
        exit;
    }

    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="error">Pls try again</div>';
        exit;
    }

    $errors =  "";
   
    $missingPassword = '<p><strong>Please enter a Password!</strong></p>';
    $invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
    $differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
    $missingPassword2 = '<p><strong>Please confirm your password</strong></p>';

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
        //prepare variable for d query
        $password = mysqli_real_escape_string($link, $password);
        $password = hash('sha256', $password);
        $userId = mysqli_real_escape_string($link, $userId);

        // Run query to update Users password in d Users table db.
        $sql = "UPDATE users SET `password`= '$password' WHERE userId = '$userId'";
        $result = mysqli_query($link, $sql);
        if(!$result ){
            echo '<div class="error">There was an Error storing the new password in d database!</div>';
            echo '<div class="error">'.mysqli_error($link).'</div>';
            exit;    // === Also the same as elseif statement===
        }

        //Set d key status to "USED" in d forgotPass table to prevent being used twice.
        $sql = "UPDATE forgotpassword SET `status`= 'used' WHERE rkey = '$key' AND userId = '$userId'";
        $result = mysqli_query($link, $sql);
        if(!$result ){
            echo '<div class="error">Error runnig d Query!</div>';
            echo '<div class="error">'.mysqli_error($link).'</div>';
        }else{
            echo '<div class="success">Your Password has been updated successfully!<a href="index.php #modal2" class="green  modal-trigger ">Login</a></div>';
            
        }
    }

   
?>