<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nicholas">

        <title> ECN - Carrello</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>


        <script type="text/javascript" src="../vue/vue.min.js"></script>
        <link href="../css/homePage.css" type="text/css" rel="stylesheet">
    
    </head>
    <body>
    <?php
        $dbconnect = pg_connect("host=localhost port=5432 dbname=eCommerce user=postgres password=Nicholas1998")
        or die('Could not connect' . pg_last_error());
        
        if (isset($_GET['checkout'])) {
            //Togli quantita from db
            $q1 = "delete FROM carrelli";
            $result = pg_query($dbconnect, $q1);
            pg_fetch_row($result);
        } 
        else if (isset($_GET['del'])) {
            $prod = $_GET['del'];
            $q1 = "select quantità from carrelli where nome=$1";
            $qua = pg_query_params($dbconnect, $q1, array($prod));
            $r1 = pg_fetch_row($qua);
            $q2 = "select quantità from prodotti where nome=$1";
            $qu = pg_query_params($dbconnect, $q2, array($prod));
            $r2 = pg_fetch_row($qu);
            $ret = $r1[0] + $r2[0];
            //aggiorna db
            $q1 = "update prodotti SET quantità=$1 where nome=$2";
            $res = pg_query_params($dbconnect, $q1, array($ret, $prod));
            pg_fetch_row($res);
    
            $q1 = "delete FROM carrelli WHERE nome=$1";
            $result = pg_query_params($dbconnect, $q1, array($prod));
            pg_fetch_row($result);
        }
    ?>

    <div id="app" style="background-image: linear-gradient(rgb(255 240 250), rgb(255 255 255));">
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
                            <li><a href="../Prodotti/Smartwatch.php"> Smartwatch </a></li>
                            <li><a href="../Prodotti/Auricolari.php"> Auricolari </a></li>
                            <li><a href="../AboutUs/AboutUs.html"> Chi siamo </a></li>
                        </ul>
                    </nav>
                        <li><a href="#"> <img src="../Img/cart_2.png" width="30px" height="30px"> </a></li>
                </div>
            </div>
        </div>
       
        <!-- cart item details  -->

        <div class="small-container-cart cart-page">
            <table>
                <tr>
                    <th>Prodotto</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                </tr>
                <?php
                    function fromMoney($input)
                    {
                        $prezzo_stringato1 = substr($input[4], 0, strpos($input[2], '.'));
                        $prezzo_stringato2 = substr($input[4], strpos($input[2], '.') + 1, strpos($input[2], ' '));
                                
                        $pr = (float) ($prezzo_stringato1 . "." . $prezzo_stringato2);
                        return $pr;
                    }
                            
                    $q1 = "select count(*) from carrelli";
                    $_count = pg_query($dbconnect, $q1);
                    $_row = pg_fetch_row($_count);
                    $q2 = "select * from carrelli";
                    $result = pg_query($dbconnect, $q2);

                    $q1 = "select * from carrelli";
                    $_count = pg_query($dbconnect, $q1);

                    $ttt=0;
                    for($i=0;$i<$_row[0];$i++){
                        $_som = pg_fetch_row($_count);
                        $ttt+=(fromMoney($_som)*$_som[3]);
                    }

                    $sped = 8;
                    if ($ttt == 0) {
                        $sped = 0;
                    }

                    $tt = $ttt + $sped;

                    for ($i = 0; $i < $_row[0]; $i++) {
                        $array = pg_fetch_row($result);
                        $pr=fromMoney($array);
                        $prezzo = $pr;        
                        echo "
                        <tr>
                            <td>
                                <div class='cart-info'>
                                <a href='../PaginaProdotto/prodotto.php?input=$array[1]'>
                                        <img src='../Img/Prodotti/$array[1]_1.png'>
                                    </a>
                                    <div>
                                        <p>$array[1]</p>
                                        <a onClick='del(this.id)' value='$array[3]' id='$array[1]' style='cursor:pointer'>
                                            remove
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>$array[3]</td>
                            <td>$array[4]€</td>
                        </tr>
                        ";
                    }
            ?>
            </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Sub-total</td>
                    <td> <?php echo " <td class='text-right'>$ttt.00 €</td>"; ?> </td>
                </tr>
                <tr>
                    <td>Costi di spedizione</td>
                    <td> <?php echo "<td class='text-right'>$sped.00 €</td>"; ?> </td>
                </tr>
                <tr>
                    <td>Totale</td>
                    <td> <?php echo "<td class='text-right'><strong>$tt.00 €</strong></td>";?> </td>
                </tr>
            </table>
        </div>
        <form action="ValidaAcquisto.php" method="POST">
            <button class='btn' role='button' > Acquista </button>   
        </form>
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
    <script type="text/javascript" src="../vue/carrello.js"></script>
    </body>

</html>