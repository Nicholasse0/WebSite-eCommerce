<?php
session_start();
?>
<html>

<?php

    if (isset($_POST['input']))
        $temp = $_POST['input'];
    else
        $temp = $_GET['input'];
    echo " 
        <title>$temp</title>
    ";
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nicholas">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>

        <title> ECN </title>

        <link href="../css/homePage.css" type="text/css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <script src="jquery.nice-number.js"></script>
        <script type="text/javascript"> 
            $(function(){
                $('input[type="number"]').niceNumber();
            });
        </script>

        <script type="text/javascript" src="../vue/vue.min.js"> </script>
    
    </head>
    <body>
    <div id="app">
        <?php
            $dbconnect = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
            or die('Could not connect' . pg_last_error());
        ?>
            <div class="header">
                <div class="container">
                    <div class = "navbar">
                        <div class = "logo">
                            <a id="casa"  href="../Homepage/homePage.php">
                                <img src="../Img/Logo_3.png" width="175px">
                            </a>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="../Homepage/homePage.php"> Home </a></li>
                                <li><a href="../Prodotti/Smartphone.php"> Smartphone </a></li>
                                <li><a href="../Prodotti/Smartwatch.php"> Smartwatch </a></li>
                                <li><a href="../Prodotti/Auricolari.php"> Auricolari </a></li>
                                <li><a href="../AboutUs/AboutUs.php"> About us </a></li>
                            </ul>
                        </nav>
                            <li><a id="car" href="../Carrello/ShoppingBag.php"> <img src="../Img/cart_2.png" width="30px" height="30px"> </a></li>
                    </div>
                </div>
            </div>
        
            <!-- Prodotto -->
            <div class ="categories">
                <div class="small-container single-product">
                    <div class="row ">
                        <?php
                            $q1 = "select * from prodotti where prodotti.nome = '$temp' ;";
                            $result = pg_query($dbconnect, $q1);
                            $array = pg_fetch_row($result);

                            echo "
                                <div class='col-2'>
                                    <div style='background-color: rgb(239, 239, 239)'>
                                    <img src='../Img/Prodotti/$array[1]_1.png' width='100%' id='ProductImg'>
                                </div>
                                    <div class='small-img-row'>
                                        <div class='small-img-col'>
                                            <img src='../Img/Prodotti/$array[1]_1.png' width='100%' class='small-img'>
                                        </div>
                                        <div class='small-img-col'>
                                            <img src='../Img/Prodotti/$array[1]_2.png' width='100%' class='small-img'>
                                        </div>
                                        <div class='small-img-col'>
                                            <img src='../Img/Prodotti/$array[1]_3.png' width='100%' class='small-img'>
                                        </div>
                                        <div class='small-img-col'>
                                            <img src='../Img/Prodotti/$array[1]_4.png' width='100%' class='small-img'>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class ='col-2'>
                                    <h3> $array[1]  </h3>
                                    <p> $array[4] €</p>
                                    <br>
                                    <div class=''>
                                        <input readonly type='number' value='0' id='inp' min='0' max='$array[3]' step='1'/>
                                    </div>
                                    <a href ='../Carrello/ShoppingBag.php'>
                                    <button class='btn' value='$array[1]' id='adt' role='button' onclick='aggiungi()'> Aggiungi al carrello </button>
                                    </a>
                                    <h3 style='font-size: 20px'> Dettagli prodotto </h3>
                                    <p> $array[2] </p>
                                </div>
                            ";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Piu Ricercati -->

        <div class="all-products">
            <div class="small-container" style="padding-top:50px">
                <div class="separator">
                    <h2 class="title-dark"> I più ricercati </h2>
                </div>
                <br><br>
                <div class="row">
                    <?php
                        $q1 = "select count(*) from prodotti";
                        $_count = pg_query($dbconnect, $q1);
                        $_row = pg_fetch_row($_count);

                        $q1 = "select * from prodotti order by numero_vendite DESC;";
                        $result = pg_query($dbconnect, $q1);

                        for ($i = 0; $i < 4; $i++) {
                            $array = pg_fetch_row($result);
                            echo "
                            <div class='col-4 zoom-in-2'>
                                <a href='../PaginaProdotto/prodotto.php?input=$array[1]'>
                                    <img src='../Img/Prodotti/$array[1]_1.png'>
                                <a>
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
    </div>
    <!-- Script per il carrello -->
    <script type="text/javascript" src="../vue/carrello.js"></script>

    </body>


    <!-- Script seleziona Img -->

    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
        SmallImg[0].onclick = function(){
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function(){
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function(){
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function(){
            ProductImg.src = SmallImg[3].src;
        }
    </script>
    
</html>