<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nicholas">

        <title> ECN </title>

        <link href="../css/homePage.css" type="text/css" rel="stylesheet">
        <link href="../css/carousel.css" type="text/css" rel="stylesheet">
    
    </head>
    <body>
    <?php
        $dbconnect = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
            or die('Impossibile connettersi al database' . pg_last_error());

        /*
        //Nome
        $q1 = "Select nome from utenti where email= $1";
        $result = pg_query_params($dbconnect, $q1, array($_SESSION['email']));
        $row = pg_fetch_row($result);
        $_SESSION['nome'] = $row[0];

        //Settaggio tabella carrello
        if (isset($_GET['nome'])) { //devo aggiornare la tabella
            $nome_prodotto = $_GET['nome'];
            $q1 = "Select * from prodotti where nome= $1";
            $result = pg_query_params($dbconnect, $q1, array($nome_prodotto));
            $row = pg_fetch_row($result); // riga tabella prodotti del nome

            $q1 = "Select * from carrello where nome= $1";
            $result = pg_query_params($dbconnect, $q1, array($nome_prodotto));

            $riga = pg_fetch_row($result);
            if ($riga == FALSE) {
                $q1 = "insert into carrello values($1,$2,$3,$4)";
                $result = pg_query_params($dbconnect, $q1, array($row[0], $row[1], $row[2], $_GET['quanti']));
            } else { //fai addizione
                //UPDATE tableSET column1 = value1 where nome=dsada

                $qu = $_GET['quanti'] + $riga[3];
                $q1 = "update carrello SET quantià=$1 where nome=$2";
                $res = pg_query_params($dbconnect, $q1, array($qu, $_GET['nome']));
            }


            //Togli quantita from db
            $q1 = "Select * from prodotti where nome= $1";
            $result = pg_query_params($dbconnect, $q1, array($nome_prodotto));
            $row = pg_fetch_row($result);
            $qu = $row[3] - $_GET['quanti'];

            $q1 = "update prodotti SET quantià=$1 where nome=$2";
            $res = pg_query_params($dbconnect, $q1, array($qu, $_GET['nome']));
        }
    


        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $q1 = "Select * from utenti where email= $1"; //Quel $1 sta a significare che il valore ad email ancora deve essere stanziato
        $result = pg_query_params($dbconnect, $q1, array($email));
        $row = pg_fetch_row($result);
    */
    ?>
        <div class="header">
            <div class="container">
                <div class = "navbar">
                    <div class = "logo">
                        <a href="../Homepage/homePage.php">
                            <img src="../Img/Logo_3.png" width="175px">
                        </a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="../Homepage/homePage.php"> Home </a></li>
                            <li><a href="#"> Smartphone </a></li>
                            <li><a href="../Prodotti/Smartwatch.php"> Smartwatch </a></li>
                            <li><a href="../Prodotti/Auricolari.php"> Auricolari </a></li>
                            <li><a href="../AboutUs/AboutUs.html"> About us </a></li>
                        </ul>
                    </nav>
                    <img src="../Img/cart_2.png" width="30px" height="30px">
                </div>
                    <div class = "vetrina-verticale" style="text-align:center">
                        <br><br><br><br>
                        <h2> Fai un salto nel futuro. </h1>
                        <br>
                        <p> Preordina ora o acquista gli ultimi modelli. </p>
                        <br><br><br>
                        <img src="../Img/Vetrina_Smartphone_2.png">
                    </div>
            </div>
        </div>

        <!-- Spazio Novità -->

        <div class="container-50">
            <div class="row">
                <div class="col-8">
                    <div class="img-vetrinetta">
                        <img src="../Img/Vetrina_Smartphone.png">
                    </div>
                </div>
                <div class="col-8-1">
                    <div class="img-vetrinetta">
                        <br>
                        <h5 style="font-size:30px"> One Plus 9 </h5>
                        <br>
                        <p> Non perderti la nuova collezione One Plus 2.<br>
                            La velocità è aportata di mano! </p>
                        <a href='../PaginaProdotto/prodotto.php?input=One Plus 9' class ='btn'> Esplora </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tutti i prodotti -->

        <div class="all-products">
            <div class="small-container">
                <div class="separator">
                    <h2 class="title-dark">Tutti i prodotti</h2>
                </div>
                <!--<h2 class="title-dark"> Tutti i prodotti </h2>-->
                <br><br>
                <div class="row">
                    <?php
                        $q1 = "select count(*) from prodotti where prodotti.categoria='Smartphone'";
                        $_count = pg_query($dbconnect, $q1);
                        $_row = pg_fetch_row($_count);

                        $q1 = "select * from prodotti where prodotti.categoria='Smartphone' order by numero_vendite DESC;";
                        $result = pg_query($dbconnect, $q1);

                        for ($i = 0; $i < $_row[0]; $i++) {
                            $array = pg_fetch_row($result);
                            echo "
                            <div class='col-4 zoom-in-2'>
                                <a href='../PaginaProdotto/prodotto.php?input=$array[1]'>
                                <img src='../Img/Prodotti/$array[1]_1.png'>
                                </a>
                                <h4> $array[1] </h4>
                                <p> $array[4] €</p>
                            </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
        

        <!-- Brands -->

        <div class="brands">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="../Img/Brands/one-plus-logo.png">
                    </div>
                    <div class="col-5">
                        <img src="../Img/Brands/apple-logo.png">
                    </div>
                    <div class="col-5">
                        <img src="../Img/Brands/LG-Logo.png">
                    </div>
                    <div class="col-5">
                        <img src="../Img/Brands/samsung-logo.png">
                    </div>
                    <div class="col-5">
                        <img src="../Img/Brands/logo-paypal.png">
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col-1">
                        <h3> Scarica la nostra app </h3>
                        <p> Scarica le app per Android e ios per telefono </p>
                        <div class="app-logo">
                            <img src="../Img/Brands/play-store.png">
                            <img src="../Img/Brands/app-store.png">
                        </div>
                    </div>
                    <div class="footer-col-2">
                        <img src="../Img/Logo_3.png">
                        <p> Scopri tutti i nostri prodotti! <br>
                            Le migliori offerte su prodotti tecnologici, ce l'abbiamo noi.</p>
                    </div>
                    <div class="footer-col-3">
                        <h3> Link utili </h3>
                        <ul>
                            <li> Coupons </li>
                            <li> Blog Post </li>
                            <li> Policy </li>
                            <li> Affiliate </li>
                        </ul>
                    </div>
                    <div class="footer-col-4">
                        <h3> Seguici </h3>
                        <ul>
                            <li> Facebook </li>
                            <li> Instagram </li>
                            <li> Twitter </li>
                            <li> YouTube </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <p class="copyright"> Copyright 2021 - ECN </p>
            </div>
        </div>
    </body>
    
</html>