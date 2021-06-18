<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nicholas">

        <title> ECN - Smartwatch </title>

        <link href="../css/homePage.css" type="text/css" rel="stylesheet">
    
    </head>
    <body>
    <?php
        $dbconnect = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
        or die('Impossibile connettersi al database' . pg_last_error());

    ?>
        <div class="header">
            <div class="container">
                <div class = "navbar">
                    <div class = "logo">
                        <a href="../Homepage/homePage.php"> <img src="../Img/Logo_3.png" width="175px">
                    </div>
                    <nav>
                        <ul>
                            <li><a href="../Homepage/homePage.php"> Home </a></li>
                            <li><a href="../Prodotti/Smartphone.php"> Smartphone </a></li>
                            <li><a href="#"> Smartwatch </a></li>
                            <li><a href="../Prodotti/Auricolari.php"> Auricolari </a></li>
                            <li><a href="../AboutUs/AboutUs.html"> Chi siamo </a></li>
                        </ul>
                    </nav>
                        <li><a href="../Carrello/ShoppingBag.php"> <img src="../Img/cart_2.png" width="30px" height="30px"> </a></li>
                </div>
            </div>
        </div>
        <div class="container-light">
            <div class = "row" style="background-color:rgb(241,241,241) !important">
                <div class = "col-2" style="padding-left:10%; text-align: center">
                    <h1 style="color:black">Il futuro della tua salute è qui. <br> Al tuo polso. </h1>
                </div>
                <div class="col-2">
                    <br>
                    <img src="../Img/Vetrina_Smartwatch_2.webp" style="padding:0 0 !important">
                </div>
            </div>
        </div>


        <!-- Spazio Novità -->

        <div class="container-50">
            <div class="row">
                <div class="col-50">
                    <div class="img-vetrinetta">
                        <a href="../PaginaProdotto/prodotto.php?input=Apple Watch SE">
                            <img src="../Img/Vetrina_Smartwatch.webp">
                        </a>
                    </div>
                </div>
                <div class="col-50">
                    <div class="img-vetrinetta">
                        <br>
                        <h5 style="font-size:30px"> Apple Watch SE </h5>
                        <br>
                        <p> Sa fare proprio tutto. Anche costarti meno. </p>
                        <a href='../PaginaProdotto/prodotto.php?input=Apple Watch SE' class ='btn'> Esplora </a>
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
                <br><br>
                <div class="row">
                    <?php
                        $q1 = "select count(*) from prodotti where prodotti.categoria='Smartwatch'";
                        $_count = pg_query($dbconnect, $q1);
                        $_row = pg_fetch_row($_count);

                        $q1 = "select * from prodotti where prodotti.categoria='Smartwatch' order by numero_vendite DESC;";
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