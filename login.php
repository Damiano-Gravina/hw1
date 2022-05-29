<?php
    require_once 'check.php';

    if (checked()){
        header("Location: home.php");
        exit;
    }


    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $query = "SELECT Id, Username, Password FROM USERS WHERE username = '$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            //echo($row["Password"]);
            //echo($password);
            //echo(password_hash($password, PASSWORD_DEFAULT));
            //echo(password_hash($password, PASSWORD_DEFAULT));

            //if(password_verify($password, $row['Password'])){
            if($password == $row['Password']){
                echo("SONO QUI"); 
                $_SESSION["string_session_id"] = $row['Id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
        echo("<section>
            <article class = 'errorWindow'>
                <div class = 'warning'>⚠️Registrazione non corretta⚠️</div>
                <p>$error</p>
            </article>
        </section>");
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
        echo("<section>
            <article class = 'errorWindow'>
                <div class = 'warning'>⚠️Registrazione non corretta⚠️</div>
                <p>$error</p>
            </article>
        </section>");
    }
?>




<html>
    <head>
        <title>String Login</title>
        <link rel='stylesheet' href='css/login_register.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src='script/login.js' defer></script>

        <meta name="viewport" content="width=device width, initial-scale=1">
    </head>

    <body>
        <article>
            <section id="register">
                <div>
                    <div id="icon">🦊String</div>
                    <div id="description">Buy and sell music tools</div>
                </div>
                <form name='login' method='post'>
                    <label id="label_username"><strong>Username </strong> <input type='text' name='username' class='label_class'></label>
                    <label><strong> Password </strong><input type='password' name='password' id="label_password"></label> 
                    <span class="material-symbols-outlined">visibility</span>
                    <label>&nbsp;<input type='submit' id="regist" value='Login'></label>
                    <a href="regist.php">(Don't have an account?)</a>
                </form>
            </section>
        </article>
    </body>

</html>