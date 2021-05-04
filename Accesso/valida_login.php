<?php
    session_start();
    session_unset();
?>
                
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='author' content='Nicholas'>
                
    <link href='../css/bootstrap.css' type='text/css' rel='stylesheet'/>
    <link href='../css/my_css copy.css' type='text/css' rel='stylesheet'/>
    <link href='../css/login.css' type='text/css' rel='stylesheet'/>
                        
    <script type = 'text/javascript' lang = 'javascript' src='../js/loginScript.js'> </script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
                        
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $('div.formLogIn').animate({
                top: 0,
                opacity: 1
            }, 'fast')
        }, 300);
        setTimeout(function() {
            $('div.classSx').animate({
                left: 0,
                opacity: 1
            }, 'fast')
        }, 400);
        setTimeout(function() {
            $('div.classDx').animate({
                right: 0,
                opacity: 1
            }, 'fast')
        }, 400);
        setTimeout(function() {
            $('div.classHide').animate({
                opacity: 1
            }, 'fast')
        }, 500);
    });
    </script>
                
    <title> ECN - Login </title>
</head>
<body  onload='cookibar()'>
    <div class='alert text-center cookibar' role='alert'>
        <div class='acceptcookies'>
            <b>Acconsenti all&#39utilizzo dei cookies?</b> &#x1F36A; Utiliziamo i cookies per assicurarti la migliore esperienza sul nostro sito. <a href='media/informativa-cookies.pdf' target='_blank'>Per saperne di più</a>
        </div>
        <button type='button' class=' btn-primary btn-sm' onclick='accettaCookies()'>
            Acconsento
        </button>
                
    </div>
    <div class='signup-content justify-content-center formLogIn'>
        <div class='signup-form'>
            <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
                or die('Could not connect' . pg_last_error());

            $email = $_POST['email'];
            $q1 = "select * from utenti where email=$1";
            $result = pg_query_params($dbconn, $q1, array($email));
            if(!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){ //account NON registrato
                echo '
                <form class="register-form" id="form_login" name="formLogin" action="valida_login.php" method="POST" onsubmit="return validaCredenziali()">
                    <div class="msgWelcome">
                        Accedi a ECN
                    </div>
                    <div class="form-group sizeDivButton classSx "  style="margin-bottom:23px">
                        <input class="form-control insEmail" type="text" name="email" id="email" placeholder="Email" style="border-color:red"/>
                        <span class="invalidShow" id="inv_email">
                            L&#39indirizzo e-mail che hai inserito non è collegato a un account.
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
                        <button id="form-group sizeDivButton" class="btn btn-outline-success" type="submit">Accedi</button>
                    </div>
                    <hr>
                    <div class="form-group classDx" style="padding-bottom: 10;">
                        <a href="../Registrazione/signin.php">
                            <button id="btn_login" class="btn btn-outline-dark my-2 mr-sm-2" type="button">Crea nuovo account</button>
                        </a>
                    </div>
                </form>
                ';
            }
            else{// password errata
                $password=md5($_POST['password']);
                $q2="select * from utenti where email = $1 and password = $2";
                $result=pg_query_params($dbconn, $q2, array($email, $password));
                if(!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){    
                    echo "
                    <form class='register-form' id='form_login' name='formLogin' action='valida_login.php' method='POST' onsubmit='return validaCredenziali()'>
                        <div class='msgWelcome'>
                            Accedi a ECN
                        </div>
                        <div class='form-group sizeDivButton classSx '  style='margin-bottom:23px'>
                            <input class='form-control insEmail' type='text' name='email' id='email' placeholder='Email' value = '$email'/>
                            <span class='invalid ' id='inv_email'>
                                Inserisci l&#39e-mail
                            </span>
                            </div>
                            <div class='form-group sizeDivButton classDx'>
                                <input class='form-control insPass' type='password' name='password' id='password' placeholder='Password' style='border-color:red'/>
                            <div class='invalidShow' id='inv_password'>
                                Password errata
                            </div>
                        </div>
                        <div class='form-group remember classSx'>
                            <input type='checkbox' !checked id='checkBox'>Ricordami
                        </div>
                        <div class='form-group classDx'>
                            <button id='form-group sizeDivButton' class='btn btn-outline-success' type='submit'>Accedi</button>
                        </div>
                        <div class='form-group form-submit classSx'>
                            <a href='../RecuperaPassword/passwordDimenticata.php'>Password dimenticata?</a>
                        </div>
                        <hr>
                    </form>
                    ";
                }
                else{//se la password è giusta
                    //prendo il nome restituito dalla query()
                    $nome=$line['nome'];
                    echo '
                        <meta http-equiv="refresh" content="1;url=../Homepage/homePage.php"> 
                    ';
                }
            }
        ?>
        </div>
    </div>
</body>
</html>