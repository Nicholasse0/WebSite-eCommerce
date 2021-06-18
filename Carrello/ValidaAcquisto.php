<?php
session_start();
?>

<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='author' content='Nicholas&Francesco'>
                                
    <link href='../css/bootstrap.css' type='text/css' rel='stylesheet'/>
    <link href='../css/my_css copy.css' type='text/css' rel='stylesheet'/>
    <link href='../css/login.css' type='text/css' rel='stylesheet'/>


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
                                        
    <title> ECN - Valida Acquisto </title>
    </head>
    <body>
        <br><br><br><br><br>
        <div class='signup-content justify-content-center formLogIn'>
            <div class="signin-form-2">
                <?php
                    $dbconn = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
                    or die('Impossibile connettersi al database' . pg_last_error());

                    $q1 = "select count(*) from carrelli";
                    $result = pg_query($dbconn, $q1);
                    $n = pg_fetch_row($result);

                    $q1 = "select * from carrelli";
                    $result = pg_query($dbconn, $q1);
                    if($n[0] > 0){ // carrelli > 0
                        for ($i = 0; $i < $n[0]; $i++) {
                            // elemento i carrelli
                            $array = pg_fetch_row($result);
                            // update numero_vendite
                            $q1 = "select quantità from carrelli where nome=$1";
                            $qua = pg_query_params($dbconn, $q1, array($array[1]));
                            $r1 = pg_fetch_row($qua);
                            $q2 = "select numero_vendite from prodotti where nome=$1";
                            $qu = pg_query_params($dbconn, $q2, array($array[1]));
                            $r2 = pg_fetch_row($qu);
                            $ret = $r1[0] + $r2[0];
                            //aggiorna db
                            $q1 = "update prodotti SET numero_vendite=$1 where nome=$2";
                            $res = pg_query_params($dbconn, $q1, array($ret, $array[1]));
                            pg_fetch_row($res);
                        }
                        $q2 = "delete FROM carrelli";
                        $result = pg_query($dbconn, $q2);
                        pg_fetch_row($result);

                        echo "
                            <div class='register-form'>
                                <meta http-equiv='refresh' content='5;url=ShoppingBag.php'> 
                                <div class='msgWelcome'>
                                    Acquisto completato con successo!<br>
                                    Continua a visitare il nostro sito per altri prodotti.
                                </div>
                                <br>
                            </div>
                        ";
                    }
                    else{
                        echo "
                            <div class='register-form'>
                                <meta http-equiv='refresh' content='5;url=../Homepage/homePage.php'> 
                                <div class='msgWelcome'>
                                    Il carrello è vuoto, visita il nostro sito ed aggiungi al carrello i nostri prodotti.
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
