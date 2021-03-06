<?php

    session_start();
    if(isset($_SESSION['user_id'])) {

        //Already logged in
        header('Location: /tutorialswebsite/home.php');

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorials & Questions Spot</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
</head>
<body>

    <div class="modal">
        <div class="content">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <div class="modal">
        <div class="content">

            <img src="./imgs/cancel.png" alt="Close button" class="close">

            <div class="success">

                <img src="./imgs/success.png" alt="Success icon" class="icon">
                <span class="message"></span>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="background">
            <div class="overlay"></div>
        </div>

        <div class="showcase">

            <div class="logo">
                <img src="./imgs/icon.png" alt="Web site icon">
                <h1>Tutorials Website</h1>
            </div>

            <div class="content">
                <p>
                    If you need help on something, here you can find the answers to your questions, or you can be the person who helps others by answering their questions or posting tutorials on any subject you want.
                </p>
                <a href="#signBloc">Enroll now</a>
            </div>

            <div class="scrollDown">
                <img src="./imgs/scroll.png" alt="Scroll down icon">
            </div>

        </div>

        <div class="signBloc" id="signBloc">

            <form class="signIn active">

                <h1>Sign In</h1>

                <label class="signin_email">Email Adress</label>
                <input type="email" id="signin_email" name="signin_email" data-title="Email adress" data-class="signin_email">
                
                <label class="signin_password">Password</label>
                <input type="password" id="signin_password" name="signin_password" data-title="Password" data-class="signin_password">
                
                <input type="submit" value="Sign in">
                
            </form>
            
            <form class="signUp">
                
                <h1>Sign Up</h1>
                
                <label class="signup_name">Full Name</label>
                <input type="text" id="signup_name" name="signup_name" data-title="Full name" data-class="signup_name">

                <label class="signup_email">Email Adress</label>
                <input type="email" id="signup_email" name="signup_email" data-title="Email adress" data-class="signup_email">

                <label class="signup_password">Password</label>
                <input type="password" id="signup_password" name="signup_password" data-title="Password" data-class="signup_password">
                
                <input type="submit" value="Sign up">

            </form>

            <div class="touchSwitch active">
                <img src="./imgs/touch.png" alt="Touch icon" data-title="tap here">
            </div>

            <div class="modal">

                <img src="./imgs/cancel.png" alt="Close button" class="close">

                <div class="content">
                    <div class="errors">
                        <img src="./imgs/error.png" alt="Error icon" class="icon">
                        <span class="errorText"></span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="./js/main.js"></script>
</body>
</html>