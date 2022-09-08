<?php
session_start();

include "connection.php";

//get userId and new email sent through Ajax
$userId = $_SESSION['userId'];
$newEmail = $_POST['email'];

//check if new email already exists in the database
$sql = "SELECT * FROM users WHERE email = '$newEmail'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count > 0){
    echo '<div class="error">There is already a user registered with that email!. Pls choose another one</div>';
    exit;
}


//get the current email
$sql = "SELECT * FROM users WHERE userId = '$userId'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $email = $row['email'];
}else{
    echo 'There was an Error retriving email from the databases';
    // echo '<div class="error">'.mysqli_error($link).'</div>';

    exit;
}

// //create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
$activationKey = "Pending";


$sql = "UPDATE users SET activation2 = '$activationKey' WHERE userId = '$userId'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="error">There was an error inserting user details in the database</div>';
    
    echo '<div class="error">'.mysqli_error($link).'</div>';

    // exit;
}else{
     // Send the user an email with a link to activate.php with their email and activation code
     $message = "pls click on this link to prove you own this account:\n\n";
     $message .= "http://onlinenote.ig/activateNewEmail.php?email=".urlencode($email)."&newEmail=".urlencode($newEmail)."&key=$activationKey";
     if(mail($newEmail, 'Email update for your onlineNote App', $message,'From:'.'ezehigc@gmail.com')){
         echo "<div class='success'>An email has been sent to $email please click on the activation link to prove you 're the owner</div>";
     }
}


?>