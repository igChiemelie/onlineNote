<?php

session_start();

include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Account Activation</title>
        <link rel="stylesheet" href="css/materialize.min.css">
        <link rel="stylesheet" href="fonts/material-icons.css">
        <link rel="stylesheet" href="css/styling.css">
        <style>
            h1{
                color:purple;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
        <body>
    <div class="container">
        <div class="row">
            <div class="col s9 offset-s2 contactForm">
                <h1>Account Activation</h1>

<?php
    if(!isset($_GET['email']) || !isset($_GET['key'])){
        echo  '<div class="error">There was an error pls click on the activation link u recieved in your email</div>';
        exit;
    }

    $email = $_GET['email'];
    $key = $_GET['key'];

    $email = mysqli_real_escape_string($link, $email);
    $key = mysqli_real_escape_string($link, $key);


    $sql = "UPDATE users SET activation = 'activated' WHERE (email = '$email' AND activation='$key') LIMIT 1";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link) == 1){
        echo '<div class="success">Your account has been activated</div>';
        echo '<a href="index.php" class="btn waves-effect waves-light btn-medium green right" >Login</a>';
    }else {
        echo  '<div class="error">Your account has not been activated, please try again later.</div>';
    
    }

?>

    </div>
         </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
</body>
</html>
