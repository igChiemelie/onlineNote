<?php
session_start();

include "connection.php";

$errors =  "";

$missingUsername = '<p><strong>Please enter a username!</strong></p>';
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';


if(empty($_POST["username"])){
    $errors.= $missingUsername;
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}


if(empty($_POST["email"])){
    $errors.= $missingEmail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors.= $invalidEmail;
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
   exit;
}else {
    # code...



    $username = mysqli_real_escape_string($link, $username);
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    //128bits = 32 characters
    //256bits = 64 characters

    // $username = '';
    // $email = '';
    // $password = '';

    // if username already exists in the user table print error
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $sql);
    if(!$result ){
        echo '<div class="error">Error running the query!</div>';
        echo '<div class="error">'.mysqli_error($link).'</div>';
        exit;    // === Also the same as elseif statement===
    }

    $results = mysqli_num_rows($result);
    if($results){
        echo '<div class="error">That username is already registered. Do you what to log in? </div>';
        exit;
    }

    
    // if email exists in the user table print error
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo '<div class="error">Error running the query!</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if($results){
        echo '<div class="error">That email is already registered. Do you what to log in? </div>';
        exit;
    }

    // //create a unique activation code
    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));
    $activationKeyss = "Pending";
    // byte = unit of data 8 bit
    //bit = 0 || 1
    //16 bytes = 16 * 8 = 128 bits

    //insert user detail and activation code in the users table

    // $sql = "INSERT INTO users ('username', 'email', 'password','activation') VALUES ('$username','$email','$password','$activationKey')";
    $sql = "INSERT INTO users (`username`, `email`, `password`, `activation`, `activation2`) VALUES ('$username', '$email', '$password', '$activationKey' , '$//')";

    $results = mysqli_query($link, $sql);
    if(!$results){
        echo '<div class="error">'.mysqli_error($link).'</div>';
        // echo '<div class="error">There was an error  inserting users details in the database </div>';
        exit;
    }

    // Send the user an email with a link to activate.php with their email and activation code
    $message = "pls click on this link to activate ur account:\n\n";
    $message .= "http://onlinenote.ig/activate.php?email=".urlencode($email)."&key=$activationKey";
    if(mail($email, 'Confirm your Registration', $message,'From:'.'ezehigc@gmail.com')){
        echo "<div class='success'>Thanks for your registering: Confirmation email has been sent to $email please click on the activation link to activate your account  </div>";
    }

}
?> 