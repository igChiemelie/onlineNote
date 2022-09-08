<?php
session_start();
if(!isset($_SESSION['userId'])){
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-Notes</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="fonts/material-icons.css">
    <link rel="stylesheet" href="css/styling.css">
    <style>
    /* body{
              background-image: url('img/image.png');
        } */
    .noteheader {
        border: 1px solid grey;
        border-radius: 10px;
        margin-bottom: 10px;
        margin-top:10px;
        cursor: pointer;
        padding: 0 10px;
        background: linear-gradient(white, grey)
    }

    .text {
        font-size: 16px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .timeText {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    </style>
</head>

<body>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s6">
                        <div class="col s4">
                            <a href="#!" class="brand-logo bb left">Online Notes</a>
                        </div>

                        <div class="col s8">
                            <ul class="hide-on-med-and-down">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="#!">Help</a></li>
                                <li><a href="#!">Contact Us</a></li>
                                <li class="active "><a href="#!">My Notes</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col s6">
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i
                                class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#"class="black-text"><i><?php  echo $_SESSION['username']; ?></i></a></li>
                            <li><a href="logout.php">Log Out</a></li>
                            <!-- <li><a href="index.php?logout=1">Log Out</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <ul class="sidenav" id="mobile-demo">
        <li><a class="dropdown-trigger" href="#!" data-target="userProfile1"><i class="material-icons ">account_circle </i><?php  echo $_SESSION['username']; ?><i class="material-icons right">arrow_drop_down</i></a>
            <ul id="userProfile1" class="dropdown-content" tabindex="0" style="">
                <li tabindex="0"><a href="logout.php">Logout</a></li>    
            </ul>
        </li>
        <li><a href="index.php">Home</a></li>
        <li><a href="mainPage.php">Notes</a></li>
        <li><a href="#!">Help</a></li>
        <li><a href="#!">Contact Us</a></li>
    </ul>

    <div class="container " id="conn">
        <!--ALERT MESSAGE--->
        <div class="collasipble red card ">
            <p id="alertContent" class='white-text'></p>      
        </div>

        <div class="row">
            <div class="">

                <button  class="btn btn-large waves-effect waves-light blue" type="button" id="addNote">Add Note</button>

                <button type="button" class="btn btn-large waves-effect waves-light right blue" id="edit">Edit</button>


                <button type="button" class="btn btn-large waves-effect waves-light right green" id="done">Done</button>


                <button type="button" class="btn btn-large waves-effect waves-light blue" id="allNotes">All
                    Notes</button>

            </div>
            <div id="notepad">
                <textarea name="" id="" class="mterialize-textarea" rows="10"></textarea>
            </div>

            <div class="notes" id="notes"></div>
        </div>
    </div>

    <!-- Sign up Form -->
    <form action="" method="post" id="signupForm">
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h6>Sign up for today and Start using our Online Notes</h6>
                <hr>
                <br>

                <div class="signupMessage"></div>
                <div class="input-field">
                    <input type="text" name="username" id="username" required placeholder="Username" data-length="30">
                    <label for="username">Username:- </label>
                </div>

                <div class="input-field">
                    <input id="email" name="email" required placeholder="Email" type="email">
                    <label for="email">Email</label>
                </div>

                <div class="input-field">
                    <input id="password" name="password" required placeholder="Choose a Password" type="password">
                    <label for="password">Choose a Password </label>
                </div>

                <div class="input-field">
                    <input id="password2" name="password2" required placeholder="Confirm Password" type="password">
                    <label for="password">Confirm Password </label>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light green" type="submit" name="signUp">Sign up
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>

    <!-- Login Form -->
    <form action="" method="post" id="loginForm">
        <!-- Modal Structure -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h5>Login:</h5>
                <hr>
                <br>

                <div class="loginMessage"></div>

                <div class="input-field">
                    <input id="loginEmail" name="loginEmail" required placeholder="Email" type="email">
                    <label for="loginEmail">Email</label>
                </div>

                <div class="input-field">
                    <input id="loginPassword" name="loginPassword" required placeholder="Choose a Password"
                        type="password">
                    <label for="loginPassword">Choose a Password </label>
                </div>

                <div class="checkBox">
                    <label for="rememberMe">
                        <input type="checkbox" name="rememberMe" id="rememberMe">
                        Remember Me
                    </label>
                    <a href="#modal3" class="right modal-trigger modal-close">Forgot Password?</a>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#modal1" class="btn waves-effect waves-light green left modal-trigger modal-close">Register</a>
                <button class="btn waves-effect waves-light green" type="submit" name="login">Login
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn waves-effect waves-light modal-close green">Cancel
                    <i class="material-icons right">close</i>
                </button>
            </div>
        </div>

    </form>

    <!-- Forgot Password -->
    <form action="" method="post" id="forgotpassForm">
        <!-- Modal Structure -->
        <div id="modal3" class="modal">
            <div class="modal-content">
                <h5>Forgot Password? Enter Your Email Address</h5>
                <hr>
                <br>

                <div class="forgotpassMessage"></div>

                <div class="input-field">
                    <input id="loginEmail" name="loginEmail" required placeholder="Email" type="email">
                    <label for="loginEmail">Email</label>
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
                    <a class="grey-text text-lighten-4 center" href="#!">igc@gmail.com &copy; 2013-
                        <?php  $today = date("Y");  echo  $today ?> Copyright Text</a>
                </div>

            </div>
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/mynotes.js"></script>
    <script src="js/onlineNote.js"></script>
</body>

</html>