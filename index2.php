<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('rememberme.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online-Notes</title> 
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="fonts/material-icons.css">
    <link rel="stylesheet" href="css/animate.css">
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
                          <a href="#!" class="brand-logo bb left animate__infinite animate__animated animate__headShake">Online Notes</a>
                    </div>
                  
                    <div class="col s8">
                        <ul class="hide-on-med-and-down">
                            <li class="active "><a href="#!" >Home</a></li>
                            <li><a href="#!">Help</a></li>
                            <li><a href="#!">Contact Us</a></li>
                        </ul>  
                    </div>
                </div>

                <div class="col s6">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#modal2" class="modal-trigger">Login</a></li>  
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
         <li><a href="#modal2" class="modal-trigger" >Login</a></li>  
    </ul>

    <div class="container center" id="con">
        <h1>Online Notes Apps</h1>
        <p>Your Notes with you wherever you go.</p>
        <p>Easy to use protect all your Notes!</p>
        <a href="#modal1" class="btn btn-large waves-effect waves-light green modal-trigger">Sign up-its free</a>
    </div>

    <!-- Sign up Form -->
    <form action="" method="POST" id="signupForm">  
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h6>Sign up for today and Start using our Online Notes</h6>
                <hr>
                <br>

                <div id="signupMessage"></div>
                <div class="input-field">       
                    <input type="text" name="username" id="username"  placeholder="Username" >
                   <label for="username">Username </label>
                </div>

                <div class="input-field">
                    <input id="email" name="email"  placeholder="Email" type="email">
                    <label for="email">Email</label>
                </div>

                <div class="input-field">
                    <input id="password" name="password"  placeholder="Choose a Password" type="password">
                    <label for="password">Choose a Password </label>
                </div>

                <div class="input-field">
                    <input id="password2" name="password2"  placeholder="Confirm Password" type="password">
                    <label for="password2">Confirm Password </label>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light green left" type="submit" name="signUp">Sign up
                    <i class="tiny material-icons  right">send</i>
                </button>

                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="tiny material-icons  right">close</i>
                </button>
            </div>
        </div>

    </form>

    <!-- Login Form -->
    <form action="" method="POST" id="loginForm">  
        <!-- Modal Structure -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h5>Login:</h5>
                <hr>
                <br>

                <div id="loginMessage"></div>

                <div class="input-field">
                    <input id="loginEmail" name="loginEmail"  placeholder="Email" type="email">
                    <label for="loginEmail">Email</label>
                </div>

                <div class="input-field">
                    <input id="loginPassword" name="loginPassword"  placeholder="Choose a Password" type="password">
                    <label for="loginPassword">Choose a Password </label>
                </div>

                <div class="checkBox ">
                    <label for="rememberMe">
                        <input type="checkbox" name="rememberMe" id="rememberMe" >
                            <span>Remember Me</span>
                    </label>
                    <a href="#modal3" class="right modal-trigger modal-close">Forgot Password?</a>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#modal1" class="btn waves-effect waves-light green left modal-trigger modal-close">Register</a>
                
                <button class="btn waves-effect waves-light green" type="submit" name="login">Login
                    <i class="tiny material-icons  right">send</i>
                </button>

                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>

    <!-- Forgot Password -->
    <form action="" method="POST" id="forgotpassForm1">  
        <!-- Modal Structure -->
        <div id="modal3" class="modal">
            <div class="modal-content">
                <h5>Forgot Password? Enter Your Email Address</h5>
                <hr>
                <br>

                <div id="forgotpassMessage"></div>

                <div class="input-field">
                    <input id="forgotEmail" name="forgotEmail"  placeholder="Email" type="email">
                    <label for="forgotEmail">Email</label>
                </div>

            </div>

            <div class="modal-footer">
                <a href="#modal1" class="btn waves-effect waves-light green left modal-trigger modal-close">Register</a>
               
                <button class="btn waves-effect waves-light green" type="submit" name="forgotPass">Submit
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
    <script src="js/onlineNote.js"></script>
</body>
</html>