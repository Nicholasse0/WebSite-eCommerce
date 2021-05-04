<?php
    session_start();
    session_unset();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nicholas">

        <link href="../css/bootstrap.css" type="text/css" rel="stylesheet"/>
        <link href="../css/my_css copy.css" type="text/css" rel="stylesheet"/>
        <link href="../css/login.css" type="text/css" rel="stylesheet"/>
        
        <script type = "text/javascript" lang = "javascript" src="../js/passwordScript.js"> </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        
        <script>
        //jQuery
        $(document).ready(function() {
            setTimeout(function() {
                $("div.formLogIn").animate({
                    top: 0,
                    opacity: 1
                }, "fast")
            }, 300);
            setTimeout(function() {
                $("div.classSx").animate({
                    left: 0,
                    opacity: 1
                }, "fast")
            }, 400);
            setTimeout(function() {
                $("div.classDx").animate({
                    right: 0,
                    opacity: 1
                }, "fast")
            }, 400);
        });
        </script>

        <title> ECN - Recupera Password </title>
    </head>
    <!--<body background="../images/Comune.jpg" style="background-repeat: no-repeat; background-size: cover;">-->
    <body  onload="cookibar()">
        <br><br><br><br>
        <div class="signup-content justify-content-center formLogIn">
            <div class="signin-form">
                <form class="register-form" id="formRecupera" name="formRecupera" action="recuperaPassword.php" method="POST" onsubmit="return validaForm()">
                    <div class="msgWelcome">
                        Inserisci l'e-mail che hai collegato al tuo account
                    </div>
                    <div class="form-group sizeDivButton insEmail classSx ">
                        <input class="form-control insEmail" type="text" name="email" id="email" placeholder="Email"/>
                        <span class="invalid " id="inv_email">
                            Inserire l'email
                        </span>
                    </div>
                    <hr>
                    <div class="form-group classDx">
                        <button class="btn btn-outline-success" type="submit">Recupera la tua password</button>
                    </div>
                    <div class="form-group form-submit classSx">
                        <a href="../Accesso/login.php">Torna al login</a>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </body>
</html>