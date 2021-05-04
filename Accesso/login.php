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
        
        <script type = "text/javascript" lang = "javascript" src="../js/loginScript.js"> </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        
        <script>
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
            setTimeout(function() {
                $("div.classHide").animate({
                    opacity: 1
                }, "fast")
            }, 500);
        });
        </script>

        <title> ECN - login </title>
    </head>
    <!--<body background="../images/Comune.jpg" style="background-repeat: no-repeat; background-size: cover;">-->
    <body  onload="cookibar()">
        <div class="alert text-center cookibar" role="alert">
            <div class="acceptcookies">
                <b>Acconsenti all'utilizzo dei cookies?</b> &#x1F36A; Utiliziamo i cookies per assicurarti la migliore esperienza sul nostro sito. <a href="media/informativa-cookies.pdf" target="_blank">Per saperne di più</a>
            </div>
            <button type="button" class=" btn-primary btn-sm" onclick="accettaCookies()">
                Acconsento
            </button>

        </div>
        <div class="signup-content justify-content-center formLogIn">
            <div class="signup-form">
                <form class="register-form" id="form_login" name="formLogin" action="valida_login.php" method="POST" onsubmit="return validaCredenziali()">
                    <div class="msgWelcome">
                        Accedi a ECN
                    </div>
                    <div class="form-group sizeDivButton classSx ">
                        <input class="form-control insEmail" type="text" name="email" id="email" placeholder="Email"/>
                        <span class="invalid " id="inv_email">
                            Inserisci l'email
                        </span>
                    </div>
                    <div class="form-group sizeDivButton classDx">
                        <input class="form-control insPass" type="password" name="password" id="password" placeholder="Password"/>
                        <div class="invalid" id="inv_password">
                            Inserisci la password
                        </div>
                    </div>
                    <div class="form-group remember classSx">
                        <input type="checkbox" !checked id="checkBox">Ricordami
                    </div>
                    <div class="form-group classDx">
                        <button id="btn_accedi" class="btn btn-outline-success" type="submit">Accedi</button>
                    </div>
                    <div class="form-group form-submit classSx">
                        <a href="../RecuperaPassword/passwordDimenticata.php">Password dimenticata?</a>
                    </div>
                    <hr>
                    <div class="form-group classDx" style="padding-bottom: 10;">
                        <a href="../Registrazione/signin.php">
                            <button id="btn_login" class="btn btn-outline-dark my-2 mr-sm-2" type="button">Crea nuovo account</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>