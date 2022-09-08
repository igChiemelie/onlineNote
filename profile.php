<?php
session_start();
if(!isset($_SESSION['userId'])){
    header("location: index.php");
}

include "connection.php";

$userId = $_SESSION['userId'];
$email = $_SESSION['email'];
// $email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE userId = '$userId'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
    echo '<div class="error">'.mysqli_error($link).'</div>';

    // exit;
}
$count = mysqli_num_rows($result);
if($count == 1){
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo 'There was an Error retriving username and email from the database';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title> 
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="fonts/material-icons.css">
    <link rel="stylesheet" href="css/styling.css">
    <style>
        /* body{
              background-image: url('img/image.png');
        } */
    </style>
</head>
<body>

    <div class="navbar-fixed">
        <nav>
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s6">
                    <div class="col s4">
                          <a href="index.php" class="brand-logo bb left">Online Notes</a>
                    </div>
                  
                    <div class="col s8">
                        <ul class="hide-on-med-and-down">
                            <li class="active "><a href="#!" >Profile</a></li>
                            <li><a href="#!">Help</a></li>
                            <li><a href="#!">Contact Us</a></li>
                            <li ><a href="mainPage.php">My Notes</a></li>
                        </ul>  
                    </div>
                </div>

                <div class="col s6">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#!" ><i><?php  echo $username; ?></i></a></li>  
                        <li><a href="logout.php">Log Out</a></li> 
                    </ul>
                </div> 
            </div>
        </div>
        </nav>
    </div>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="badges.html">Home</a></li>
        <li><a href="sass.html">Help</a></li>
        <li><a href="sass.html">Contact Us</a></li>
         <li><a  href="#regModal">Login</a></li>  
    </ul>

    <div class="container " id="conn">
      <div class="row">
          <div class="offest-m3 m6">
             <h4>General Account Setting</h4>
               <div class="responsive-table">
                    <table class="stripped">
                        <thead>
                        <tr>
                            <th><a href='#'> Username</a></th>
                            <th><a href='#'> Email</a></th>
                            <th><a href='#'> Password</a></th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><a href='#modal' class='modal-trigger black-text'><?php echo $username; ?></a></td>
                                <td><a href='#modal2' class='modal-trigger black-text'> <?php echo $email; ?></a></td>
                                <td><a href='#modal3' class='modal-trigger black-text'> Hidden</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>


    <!-- update Username -->
    <form action="" method="POST" id="updateUnameForm">  
        <!-- Modal Structure -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <h5>Edit Username:</h5>
                <hr>
                <br>

                <div class="editMessage"></div>

                <div class="input-field">
                    <input id="username" name="username" value="<?php  echo $username; ?>" required type="text">
                    <label for="username">Email</label>
                </div>

              
            </div>

            <div class="modal-footer">
                <button class="btn waves-effect waves-light green" type="submit" name="updateUname">Submit
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>

    <!-- update Email  -->
    <form action="" method="POST" id="updateEmailForm">  
        <!-- Modal Structure -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h5>Edit new email:</h5>
                <hr>
                <br>
                <div class="editMessage"></div>
                <div class="input-field">
                    <input id="email" name="email" value="<?php  echo $email; ?>" required type="email">
                    <label for="email">Email</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn waves-effect waves-light green" type="submit" name="updateUname">Submit
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>

     <!-- update password  -->
    <form action="" method="POST" id="updatePassForm">  
        <!-- Modal Structure -->
        <div id="modal3" class="modal">
            <div class="modal-content">
                <h5>Enter Current and New password:</h5>
                <hr>
                <br>

                <div class="editMessage2"></div>

                <div class="input-field">
                    <input id="currentPassword" name="currentPassword" placeholder="Your current Password"  type="password">
                    <label for="currentPassword">Your current Password</label>
                </div>

                <div class="input-field">
                    <input id="password" name="password" placeholder="Choose a Password"  type="password">
                    <label for="password">Choose a Password</label>
                </div>

                <div class="input-field">
                    <input id="password2" name="password2" placeholder="Confirm Password"  type="password">
                    <label for="password2">Confirm Password</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn waves-effect waves-light green" type="submit" name="">Submit
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>



    <footer class="page-footer">    
        <div class="footer-copyright">
        <div class="container">
            <div class="center">
                    <a class="grey-text text-lighten-4 center" href="#!">igc@gmail.com &copy; 2013- <?php  $today = date("Y");  echo  $today ?> Copyright Text</a>
            </div>
        
        </div>
        </div>
    </footer>
            
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>