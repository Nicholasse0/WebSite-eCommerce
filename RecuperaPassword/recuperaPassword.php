<?php
session_start();
if (!(isset($_POST['email']))) {
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
                                        
    <script type = 'text/javascript' lang = 'javascript' src='../js/recuperaPassword.js'> </script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
                                        
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
    <body>
        <br><br>
        <div class='signup-content justify-content-center formLogIn'>
            <div class='signin-form-2'>
        <?php
            $_SESSION['email'] = $_POST['email'];
            $email_utente = $_POST['email'];

            //$_SESSION['password'] = md5($_POST['password']);
            //$password_utente = md5($_POST['password']);

            $codConferma = rand(1000, 9999);
            $_SESSION['codConferma'] = $codConferma;

            $dbconn = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
            or die('Impossibile connettersi al database' . pg_last_error());

            $q1 = "select * from utenti where email=$1";
            $result = pg_query_params($dbconn, $q1, array($email_utente));
            if($line=pg_fetch_array($result, null, PGSQL_ASSOC)){ //controllo se registrato
                $mailto = $_POST['email'];
                $mailSub = 'Nicholasse';
                $mailMsg = "[$codConferma] è il tuo codice da inserire per poter cambiare la password.";
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
                    <meta http-equiv='refresh' content='5;url=../Registrazione/signin.php'> 
                    <div class='msgWelcome'>
                        Qualcosa nell'invio dell'e-mail è andato storto, ti stiamo reindirizzando alla pagina di registrazione.
                    </div>
                    <br>
                    </div>
                    ";
                } else {
                    echo "
                    <form class='register-form' id='formcodConferma' name='formcodConferma' action='confermaCambio.php' method='POST' onsubmit='return validaForm()'> 
                        <div class='msgWelcome'>
                            Inserisci  il codice di conferma che abbiamo inviato a $email_utente per completare il cambio delle password.
                        </div>
                        <hr>
                        <div class='form-group sizeDivButton classSx insCod'>
                            <input class='form-control insEmail' type='number' name='codConferma' id='codConferma' placeholder='Codice di conferma'/>
                            <div class='invalid' id='inv_cod'>
                                Inserisci il codice di conferma
                            </div>
                        </div>
                        <div class='form-group sizeDivButton insPassword classDx'>
                            <input class='form-control insPass' type='password' name='password' id='password' placeholder='Nuova password'/>
                            <div class='invalid' id='inv_password'>
                                Inserisci la password
                            </div>
                        </div>
                        <div class='form-group sizeDivButton insConfPass classSx'>
                            <input class='form-control' type='password' name='conferma_password' id='conferma_password' placeholder='Conferma nuova password'/>
                            <div class='invalid' id='inv_conf_password'>
                                Conferma la password
                            </div>
                            <div class='invalid' id='inv_conf_password_2'>
                                Le password non coincidono
                            </div>
                        </div>
                        <div class='form-group'>
                            <a>
                                <button class='btn btn-outline-success'>Ok</button>
                            </a>
                        </div>
                        <br>
                    </form>
                    ";
                }
            }
            else{
                echo"
                <div class='register-form'>
                <meta http-equiv='refresh' content='5;url=../Registrazione/signin.php'> 
                <div class='msgWelcome'>
                    L'e-mail che hai inserito nonè collegata nessun account, ti stiamo reindirizzando alla pagina di registrazione.
                </div>
                <br>
                </div>
                ";
            }
        ?>
        </div>
    </div>
</body>
</html>
