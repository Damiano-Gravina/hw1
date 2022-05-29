<?php
    require_once 'check.php';

    $prova = 5;

    if (checked()){
        header("Location: home.php");
        exit;
    }


    if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && !empty($_POST["confirm_password"]))  {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));

        
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT Username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Questo username non è disponibile";
            }
            if (strlen($_POST["username"]) > 50) {
                $error[] = "Username troppo lungo";
            }
        }


        if (strlen($_POST["password"]) < 8) {
            $error[] = "Password troppo corta";
        } 
        if (strlen($_POST["password"]) > 50 ){
            $error[] = "Password troppo lunga";
        }
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "I campi password e conferma Password sono differenti";
        }


        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Questa email è già in uso";
            }
        }


        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            //$password_0 = mysqli_real_escape_string($conn, $_POST['password']);
            //$password = password_hash($password_0, PASSWORD_DEFAULT);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            //PROBLEMA QUI

            $query = "INSERT INTO USERS(Username, Email, Nome, Cognome, Password) VALUES('$username', '$email', '$name', '$surname', '$password')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["string_session_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }


        $i = 0;
        if(count($error) != 0){
            echo("<section>
                <article class = 'errorWindow'>
                    <div class = 'warning'>⚠️Registrazione non corretta⚠️</div>
                    ");
            while(array_key_exists($i,$error)){
                echo "<p>$error[$i]</p>";
            
            $i++;
            }
            echo ("</article>
            </section>");
        }
        

    
    }else if( isset($_POST["name"]) || isset($_POST["surname"]) || isset($_POST["username"]) || isset($_POST["password"]) || isset($_POST["email"]) || isset($_POST["confirm_password"]) ){
        $error = array("Riempi tutti i campi");
        echo("<section>
            <article class = 'errorWindow'>
                <div class = 'warning'>⚠️Registrazione non corretta⚠️</div>
                <p>$error[0]</p>
            </article>
        </section>");
    }
?>



<html>
    <head>
        <title>String Regist</title>
        <link rel='stylesheet' href='css/login_register.css'>
        <script src='./script/regist.js' defer></script>

        <meta name="viewport" content="width=device width, initial-scale=1">
    </head>


    <body>

        <section class="hide">
            <article class = 'errorWindow'>
                <div class = 'warning'>⚠️Registrazione non corretta⚠️</div>
                <p>Modulo non compilato correttamente</p>
            </article>
        </section>

        <article>
            <section id="register">
            <div>
                <div id="icon">🦊String</div>
                <div id="description">Buy and sell music tools</div>
            </div>

                <form name='regist' method='post' autocomplete="off">
                    <div class="name">
                        <label id="label_name"><strong>Name</strong> <input type='text' name='name' class='label_class'></label>
                        <span class = "hide"></span>
                    </div>
                    <div class="surname">
                        <label><strong>Surname </strong><input type='text' name='surname' class='label_class'></label>
                        <span class = "hide"></span>
                    </div>
                    <div class="username">
                        <label><strong>Username </strong><input type='text' name='username' class='label_class'></label>
                        <span class = "hide"></span>
                    </div>
                    <div class="email">
                        <label><strong>E-mail </strong><input type='text' name='email' class='label_class'></label>
                        <span class = "hide"></span>
                    </div>
                    <div class="password">
                        <label><strong>Password </strong><input type='text' name='password' class='label_class'></label>
                        <span class = "hide"></span>
                    </div> 
                    <div class="confirm_password">  
                        <label><strong>Confirm PW </strong><input type='text' name='confirm_password' class='label_class'></label>
                        <span class = "hide"></span>
                    </div>
                    <label>&nbsp;<input type='submit' id="regist" value='Regist'></label>
                    <a href="login.php">(Already have an account?)</a>
                </form>

            </section>
        </article>
    </body>

</html>