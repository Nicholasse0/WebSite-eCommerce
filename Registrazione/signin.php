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
        
        <script type = "text/javascript" lang = "javascript" src="../js/registerScript.js"> </script>
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

        <title> ECN - Registrazione </title>
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
            <div class="signin-form">
                <form class="register-form" id="formRec" name="formRec" action="valida_signin.php" method="POST" onsubmit="return validaForm()">
                    <div class="msgWelcome">
                        Accedi a ECN
                    </div>
                    <div class="form-row">
                        <div class="form-group sizeDivButton insNome classSx">
                            <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome"/>
                            <div class="invalid" id="inv_nome">
                                Inserisci il nome
                            </div>
                        </div>
                        <div class="form-group sizeDivButton insCognome classDx">
                            <input class="form-control" type="text" name="cognome" id="cognome" placeholder="Cognome"/>
                            <div class="invalid" id="inv_cognome">
                                Inserisci il cognome
                            </div>
                        </div>           
                    </div>
                    <div class="form-group sizeDivButton insEmail classSx ">
                        <input class="form-control insEmail" type="text" name="email" id="email" placeholder="Email"/>
                        <span class="invalid " id="inv_email">
                            Inserire l'e-mail
                        </span>
                    </div>
                    <div class="form-group sizeDivButton insPassword classDx">
                        <input class="form-control insPass" type="password" name="password" id="password" placeholder="Password"/>
                        <div class="invalid" id="inv_password">
                            Inserire la password
                        </div>
                    </div>
                    <div class="form-group sizeDivButton insConfPass classSx">
                        <input class="form-control" type="password" name="conferma_password" id="conferma_password" placeholder="Conferma password"/>
                        <div class="invalid" id="inv_conf_password">
                            Conferma la password
                        </div>
                        <div class="invalid" id="inv_conf_password_2">
                            Le password non coincidono
                        </div>
                    </div>
                    <hr>
                    <div class="form-group classDx">
                        <button class="btn btn-outline-success" type="submit" onclick="valida_signin()">Conferma</button>
                    </div>
                    <div class="form-group form-submit classSx">
                        <a href="../Accesso/login.php">Hai già un account?</a>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </body>
</html>