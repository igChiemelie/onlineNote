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
        <title>Password Reset</title>
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
                <h1>Reset Password</h1>
                <div id="resultMessage"></div>

<?php
    if(!isset($_GET['userId']) || !isset($_GET['key'])){
        echo  '<div class="error">pls click on the link you recieve by Email</div>';
        exit;
    }

    $userId = $_GET['userId'];
    $key = $_GET['key'];
    //time - 24 hours ago
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
        echo '<div class="error">Pls try again later!</div>';
        exit;
    }
    echo "<form action='' method='POST' id='passwordReset'>
            <input type=hidden name=key value=$key>
            <input type=hidden name=userId value=$userId>
            <div class='input-field'>
                <input type='password' name='password' id='password' placeholder='Enter Password'>
                <label for='password'>Enter your new Password:-</label>
            </div>

            <div class='input-field'>
                <input type='password' name='password2' id='password2' placeholder='Re-Enter Password'>
                <label for='password2'>Re-Enter Password:-</label>
            </div>

            <div class='center' style='padding-bottom: 15px;' >
                <button  type='Submit'  value='resetpassword' name='resetpassword' class='btn btn-medium waves-effect waves-light green'>Reset password</button>
            </div>
        
        </form>";
    

?>

    </div>
         </div>
    </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/onlineNote.js"></script>
<script>
    //Ajax call to storeResetPass.php which process form data.
    $('#passwordReset').submit(function (e) {
    e.preventDefault();
    console.log('fyjj');
    var dataToPost = $(this).serializeArray();
    console.log(dataToPost);

    $.ajax({
        url: "./storeResetPass.php",
        type: "POST",
        data: dataToPost,
        success: function (data) {
            $('#resultMessage').html(data);
        },
        error: function () {
            $('#resultMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");
            // M.toast({ html: 'Network error!' });
        }
    });
});
</script>
</body>
</html>
