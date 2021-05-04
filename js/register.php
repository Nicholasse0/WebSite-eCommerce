<html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=EsempioPHP user=postgres password=Nicholas1998")
                or die('Could not connect' . pg_last_error());
            if(!(isset($_POST['btn_register']))) //se vado nella pagina non passando per il bottone
                header("Location: ../index.html");
            else{   
                $email = $_POST['txt_email'];
                $q1 = "select * from users where email=$1";
                $result = pg_query_params($dbconn, $q1, array($email));
                if($line=pg_fetch_array($result, null, PGSQL_ASSOC)){ //controllo se sono già registrato
                    echo "<h1> Sorry, you are alredy a registreted user</h1>
                    <a href=../paginaLogin/login.html>Click here to login</a>";
                }
                else{   //se NON sono registrato
                    $nome=$_POST['txt_nome'];
                    $cognome=$_POST['txt_cognome'];
                    $cap=$_POST['txt_cap'];
                    $password=md5($_POST['txt_password']);
                    $q2="insert into users values($1, $2, $3, $4, $5)";
                    $data=pg_query_params($dbconn, $q2, array($email, $nome, $cognome, $cap, $password));
                    if($data){
                        echo "<h1> Registration is completed. Start using the web site <br></h1>";
                        echo "<a href=../welcome.php?name=$nome> Premi qui </a> per iniziare ad utilizzare il sito web";
                    }

                }
            }
        ?>
    </body>

</html>