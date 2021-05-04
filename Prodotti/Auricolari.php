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
        <div class="header" style="background-image:linear-gradient(black, rgb(248, 183, 228)">
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
                            <li><a href="../Prodotti/Smartphone.php"> Smartphone </a></li>
                            <li><a href="../Prodotti/Smartwatch.php"> Smartwatch </a></li>
                            <li><a href="#"> Auricolari </a></li>
                            <li><a href="../AboutUs/AboutUs.html"> About us </a></li>
                        </ul>
                    </nav>
                    <img src="../Img/cart_2.png" width="30px" height="30px">
                </div>
                <div class = "row">
                    <div class="col-2">
                        <img src="../Img/Vetrina_Auricolari.png" style="width:80%">
                    </div>
                    <div class = "col-2">
                        <h1 style="text-align: center; color:black; font-size:75px"> Potenzia <br> il <br> suono </h1>
                        <!-- <a href="" class ="btn"> Esplora </a> -->
                    </div>
                </div>
            </div>
            <br><br><br>
        </div>

        <!-- Spazio Novità -->

        <div class="container-50">
            <div class="row"  style="background-image:linear-gradient(rgb(248, 183, 228), rgb(211, 211, 211))">
                <div class="col-50">
                    <div class="img-vetrinetta" style="background-color:rgb(30,30,30);"><br>
                        <h5 style="font-size:30px; color:rgb(255,255,255)"> AirPods Pro </h5>
                        <p style="color:rgb(255,255,255)"> Sa fare proprio tutto. Anche costarti meno. </p>
                        <p><a href='#' class ='btn' onclick="toggle();"> Esplora </a></p>
                        <a href="../PaginaProdotto/prodotto.php?input=AirPods">
                        <img src="../Img/Vetrinetta_Auricolari_1.png" class="zoom-in" style="width: 50% !important;">
                        </a>
                    </div>
                </div>
                <div class="col-50">
                    <div class="img-vetrinetta" style="background-color:rgb(235,235,235)"><br>
                        <h5 style="font-size:30px; color:rgb(0,0,0);"> LG Tone Free Fn7 </h5>
                        <p style="color:rgb(0,0,0);"> Nuovo Design per massimizzare la cancellazione attiva del rumore. </p>
                        <p><a href='#' class ='btn' onclick="toggle2();"> Esplora </a></p>
                        <a href='../PaginaProdotto/prodotto.php?input=LG Tone Free Fn7'>
                        <img src="../Img/Vetrinetta_Auricolari_2.png"  class="zoom-in" style="width: 50% !important;">
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Video AirPods -->
        <div class="trailer">
            <video id="vid1" src="../Img/Trailer-AirPods.mp4" controls="true"></video>
            <img src="../Img/close.png" class="close" onclick="toggle();">
        </div>
        <script type="text/javascript">
            function toggle(){
                var trailer = document.querySelector(".trailer");
                var video = document.querySelector("#vid1");
                trailer.classList.toggle("active");
                video.pause();
                video.currentTime = 0;
            }
        </script>


        <!-- Video LG Free Tone -->

        <div class="trailer2">
            <video id="vid2" src="../Img/Trailer-LGFree.mp4" controls="true"></video>
            <img src="../Img/close.png" class="close" onclick="toggle2();">
        </div>
        <script type="text/javascript">
            function toggle2(){
                var trailer2 = document.querySelector(".trailer2");
                var video2 = document.querySelector("#vid2");
                trailer2.classList.toggle("active");
                video2.pause();
                video2.currentTime = 0;
            }
        </script>


        <!-- Tutti i prodotti -->

        <div class="all-products-reverse">
            <div class="small-container">
                <div class="separator">
                    <h2 class="title-dark">Tutti i prodotti</h2>
                </div>
                <br><br>
                <div class="row">
                    <?php
                        $q1 = "select count(*) from prodotti where prodotti.categoria='Auricolari'";
                        $_count = pg_query($dbconnect, $q1);
                        $_row = pg_fetch_row($_count);

                        $q1 = "select * from prodotti where prodotti.categoria='Auricolari' order by numero_vendite DESC;";
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