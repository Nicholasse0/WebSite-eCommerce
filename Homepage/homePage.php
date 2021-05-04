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
                        <a href="#">
                            <img src="../Img/Logo_3.png" width="175px">
                        </a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="#"> Home </a></li>
                            <li><a href="../Prodotti/Smartphone.php"> Smartphone </a></li>
                            <li><a href="../Prodotti/Smartwatch.php"> Smartwatch </a></li>
                            <li><a href="../Prodotti/Auricolari.php"> Auricolari </a></li>
                            <li><a href="../AboutUs/AboutUs.html"> About us </a></li>
                        </ul>
                    </nav>
                    <img src="../Img/cart_2.png" width="30px" height="30px">
                </div>
                <div class = "row">
                    <div class = "col-2">
                        <h1> I tuoi prodotti sono unici. Anche il tuo negozio dovrebbe esserlo. </h1>
                        <p> Gli sconti che sognavi! </p>
                        <!-- <a href="" class ="btn"> Esplora </a> -->
                    </div>
                    <div class="col-2">
                        <img src="../Img/Vetrina_2.png">
                    </div>
                </div>
            </div>
        </div>


        <!-- Carosello best seller -->

        <div id = "myCarousel" class="carousel slide" data-ride="carousel">
        <br><br><br>
            <div class="separator">
                <h2 class="title-dark"> I più venduti</h2>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
        
            <div class="carousel-inner">
                <?php
                    $q1 = "select * from prodotti order by numero_vendite DESC;";
                    $result = pg_query($dbconnect, $q1);
                    for ($i = 0; $i < 1; $i++) {
                        $array = pg_fetch_row($result);
                        echo "
                        <div class='carousel-item active'>
                            <div class = 'row'>
                                <div class='col-6 zoom-in-2' style='padding-left:100px'>
                                    <a href='../PaginaProdotto/prodotto.php?input=$array[1]'>
                                        <img src='../Img/Prodotti/$array[1]_1.png' style='width:60%'>
                                    </a>
                                </div>
                                <div class = 'col-6' style='padding-right:25px'>
                                    <h1>$array[1]</h1>
                                    <p>$array[2] €</p>
                                    <br>
                                    <p>$array[4] €</p>
                                    <div style='text-align:right; margin-right:50px'>
                                    <a href='../PaginaProdotto/prodotto.php?input=$array[1]' class ='btn'> Esplora </a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    for ($i = 1; $i < 3; $i++) {
                        $array = pg_fetch_row($result);
                        echo "
                        <div class='carousel-item'>
                            <div class = 'row'>
                                <div class='col-6 zoom-in-2' style='padding-left:100px'>
                                    <a href='../PaginaProdotto/prodotto.php?input=$array[1]'>
                                        <img src='../Img/Prodotti/$array[1]_1.png' style='width:60%'>
                                    </a>
                                </div>
                                <div class = 'col-6'  style='padding-right:25px'>
                                    <h1>$array[1]</h1>
                                    <p>$array[2] €</p>
                                    <br>
                                    <p>$array[4] €</p>
                                    <div style='text-align:right; margin-right:50px'>
                                    <a href='../PaginaProdotto/prodotto.php?input=$array[1]' class ='btn'> Esplora </a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>


        <!-- Categorie -->

        <div class ="categories">
            <div class="small-container" >
                <br><br>
                <div class="separator">
                    <h2 class="title-dark"> Categorie </h2>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-3">
                        <a href="../Prodotti/Smartwatch.php">
                            <h5> Smartwatch </h5>
                            <br><br><br>
                            <img src="../Img/categoria_2.1.jpg" class="zoom-in">
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="../Prodotti/Smartphone.php">
                            <h5> Smartphone </h5>
                            <br><br><br>
                            <img src="../Img/categoria_1.jpg" class="zoom-in">
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="../Prodotti/Auricolari.php">
                            <h5> Auricolari </h5>
                            <br><br><br>
                            <img src="../Img/categoria_3.1.jpg" class="zoom-in">
                        </a>
                    </div>
                </div>
                <br><br>
            </div>
        </div>


        <!-- Tutti i prodotti -->

        <div class="all-products">
            <div class="small-container" style="padding-top:50px">
                <div class="separator">
                    <h2 class="title-dark">Tutti i prodotti</h2>
                </div>
                <br><br>
                <div class="row">
                    <?php
                        $q1 = "select count(*) from prodotti";
                        $_count = pg_query($dbconnect, $q1);
                        $_row = pg_fetch_row($_count);

                        $q1 = "select * from prodotti order by numero_vendite DESC;";
                        $result = pg_query($dbconnect, $q1);

                        for ($i = 0; $i < $_row[0]; $i++) {
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

        <!-- Script per il carosello -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
    
</html>