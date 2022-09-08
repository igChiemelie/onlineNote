<?php
session_start();

include 'connection.php';
// include "logout.php";

$errors =  "";

$missingEmail = '<p><strong>pls enter ur email address</strong></p>';
$missingPassword = '<p><strong>pls enter ur password</strong></p>';


if(empty($_POST["loginEmail"])){
    $errors.= $missingEmail;
}else{
    $email = filter_var($_POST["loginEmail"], FILTER_SANITIZE_EMAIL);
}


if(empty($_POST["loginPassword"])){
    $errors.= $missingPassword;
}else{
    $password = filter_var($_POST["loginPassword"], FILTER_SANITIZE_STRING);
}

if($errors){
    $resultMessage = '<div class="error">'.$errors.'</div>';
    echo $resultMessage;
   
}else {
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256',$password);


    $sql = "SELECT * FROM USERS WHERE email = '$email' AND password = '$password' AND activation = 'activated' ";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="error">'.mysqli_error($link).'</div>';

        // echo '<div class="error">Error running the query!</div>';
        exit;
    }  

    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="error">Wrong Username or Password</div>';
    }else {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['userId'] = $row['userId'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        if(empty($_POST['rememberMe'])){
            echo 'success';
        }else{
            $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
            $authentificator2 = openssl_random_pseudo_bytes(20);

            function f1($a, $b){
               $c = $a .", ". bin2hex($b);
               return $c;
            }

            setcookie(
                "remenberMe",
                $cookieValue = f1($authentificator1, $authentificator2),
                // time() + 15*24*60*60; /*** COKKIES EXPIRES AFTER  15 DAYS ****/
                time() + 1296000
            );

            function f2($a){
                $b = hash('sha256', $a);
                return $b;
            }

            $f2authentificator2	 = f2($authentificator1);
            $userId = $_SESSION['userId'];
            $expiration = date('Y-m-d H:i:s', time() + 1296000);

            // $sql = "INSERT INTO rememberme ('authentificator1','f2authentificator2','userId','expires') VALUES ('$authentificator1', '$f2authentificator2', '$userId', '$expiration')";
                                        /** single dots dosent insert into database 'authentificator1' () **/    
            $sql = "INSERT INTO rememberme (`authentificator1`, `f2authentificator2`, `userId`, `expires`) VALUES ('$authentificator1', '$f2authentificator2', '$userId', '$expiration')";
            $result = mysqli_query($link, $sql);

            if(!$result){
                 echo '<div class="error">'.mysqli_error($link).'</div>';
                // echo '<div class="error">There waas an error while storing data to remember you next time !</div>';
                exit;
            }else {
                echo 'success';
            }
        }
    }
}
?>