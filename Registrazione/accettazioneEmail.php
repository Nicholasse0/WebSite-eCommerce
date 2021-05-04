<?php
session_start();
?>

<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='author' content='Nicholas'>
                                
        <link href='../css/bootstrap.css' type='text/css' rel='stylesheet'/>
        <link href='../css/my_css copy.css' type='text/css' rel='stylesheet'/>
        <link href='../css/login.css' type='text/css' rel='stylesheet'/>
        
        <script type = 'text/javascript' lang = 'javascript' src='../js/registerScript.js'> </script>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
                                        
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('div.formLogIn').animate({
                        top: 0,
                        opacity: 1
                    }, 'fast')
                }, 300);
            });
        </script>
                                
        <title> ECN - Registrazione </title>
    </head>
    <body>
        <br><br><br><br><br>
        <div class="signup-content justify-content-center formLogIn">
            <div class="signin-form">
                <div class="register-form">
                    <?php

                    if (!(isset($_POST['codConferma']))) {
                        header("Location: ../Registrazione/signin.php");
                    } else {
                    $nome_utente = $_SESSION['nome'];
                    $cognome_utente = $_SESSION['cognome'];
                    $passwordUtente = $_SESSION['password'];
                    $email_utente = $_SESSION['email'];

                    if ($_SESSION['codConferma'] == $_POST['codConferma']) { //Devo aggiungere l'utente al database
                        $dbconnect = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
                        or die('Impossibile connettersi al database' . pg_last_error());

                        $q1 = "insert into utenti values($1,$2,$3,$4);"; //Quel $1 sta a significare che il valore ad email ancora deve essere stanziato
                        $result = pg_query_params($dbconnect, $q1, array($email_utente, $nome_utente, $cognome_utente, $passwordUtente));

                        echo "
                        <meta http-equiv='refresh' content='5;../Accesso/login.php'> 
                        <div class='msgWelcome'>
                            Registrazione completata con successo, ti stiamo reindirizzando alla pagina di login.
                        </div>
                        ";
                    } else {
                        echo "
                        <meta http-equiv='refresh' content='5;signin.php'> 
                        <div class='msgWelcome'>
                            Il codice che hai inserito non è valido, ti stiamo reindirizzando alla pagina di registrazione. 
                        </div>
                        ";
                        }
                    }

                    session_destroy();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>