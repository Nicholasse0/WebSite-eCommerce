<?php
session_start();
if (!(isset($_POST['conferma_password']))) {
    header("Location: ../Registrazione/signin.php");
}
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
        <div class='signup-content justify-content-center formLogIn'>
            <div class='signin-form-2'>
        <?php

            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['cognome'] = $_POST['cognome'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = md5($_POST['password']);
            $codConferma = rand(1000, 9999);
            $_SESSION['codConferma'] = $codConferma;
        
            $nome_utente = $_POST['nome'];
            $cognome_utente = $_POST['cognome'];
            $email_utente = $_POST['email'];
            $password_utente = md5($_POST['password']);

            $dbconn = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
            or die('Impossibile connettersi al database' . pg_last_error());

            $q1 = "select * from utenti where email=$1";
            $result = pg_query_params($dbconn, $q1, array($email_utente));
            if($line=pg_fetch_array($result, null, PGSQL_ASSOC)){ //controllo se sono già registrato
                echo "
                <div class='register-form'>
                    <meta http-equiv='refresh' content='5;url=../Accesso/login.php'> 
                    <div class='msgWelcome'>
                        L'e-mail $email_utente risulta già collegata ad un account, ti stiamo reindirizzando alla pagina di login.
                    </div>
                    <br>
                </div>
                ";
            }
            else{
                $mailto = $_POST['email'];
                $mailSub = 'Valida e-mail E-commerce';
                $mailMsg = "[$codConferma] è il tuo codice di conferma per la verifica dell'e-mail";
                $mymail = 'brachelenn@gmail.com';
                $mypassword = 'Nicholas1998';
                require '../PHPMailer-master/PHPMailerAutoload.php';
                $mail = new PHPMailer(true);
                $mail->IsSmtp();
                $mail->SMTPDebug = 0;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';// ssl o tls
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true); //formato email html
                $mail->Username = $mymail;
                $mail->Password = $mypassword;
                $mail->SetFrom($mymail);
                $mail->Subject = $mailSub;
                $mail->Body = $mailMsg;
                $mail->AddAddress($mailto);

                if (!$mail->Send()) {
                    echo "
                    <div class='register-form'>
                    <meta http-equiv='refresh' content='5;url=signin.php'>
                    <div class='msgWelcome'>
                        Qualcosa nell'invio dell'e-mail è andato storto, ti stiamo reindirizzando alla pagina di registrazione.
                    </div>
                    <br>
                    </div>
                    ";
                }
                else {
                    echo "
                    <form class='register-form' id='formcodConferma' name='formcodConferma' action='accettazioneEmail.php' method='POST' onsubmit='return validacodConferma()'>
                        <div class='form-row'>    
                            <div class='msgWelcome'>
                                Inserisci  il codice di conferma che abbiamo inviato a $email_utente per completare la registrazione.
                            </div>
                            <hr>
                            <div class='form-group sizeDivButton '>
                                <input class='form-control insEmail' type='number' name='codConferma' id='codConferma' placeholder='Codice di conferma'/>
                            </div>
                            <div class='form-group'>
                                <a>
                                    <button class='btn btn-outline-success'>Ok</button>
                                </a>
                            </div>
                            <br>
                        </div>
                    </form>
                    ";
                }
            }
        ?>
        </div>
    </div>
</body>
</html>
