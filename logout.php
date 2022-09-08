<?php

// if(isset($_SESSION['userId'])){
// //   && $_GET['logout'] == 1
//     session_destroy();
//     setcookie("rememberMe", "", time()-3600);
//     header('index.php');
// }

session_start();
// remove all session variables
session_unset();
unset($_SESSION["loggedIn"]);
setcookie("rememberMe", "", time()-3600);
// destroy the session
session_destroy();

header('location: ./index.php');
?>