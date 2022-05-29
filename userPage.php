<?php 
    require_once 'check.php';

    if (!$userid = checked()) {
        header("Location: login.php");
        exit;
    }

    if (!empty($_GET["username"])){
        $username = $_GET["username"];

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));
        $query = 'SELECT * FROM USERS WHERE Username = '."'".$username."'";
        $row1 = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($row1); 
    }else{
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));
        $query = "SELECT * FROM USERS WHERE Id = $userid";
        $row1 = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($row1); 
    }
?>



<html>
    <head>
        <title>NOME UTENTE</title>
        <link rel='stylesheet' href='css/userPage.css'>

        <meta name="viewport" content="width=device width, initial-scale=1">
    </head>

    <body>


        <div id = "header">
            <div id="icon">🦊</div>
            <a href="home.php">Home</a>
            <a href='post.php'>Nuovo annuncio</a>
        </div>

        <section>
            <div id="user_image">
                <span> <?php echo($user['Nome'][0].$user['Cognome'][0]) ?> </span>
            </div>

            <div id="username">Nome Utente: <?php echo($user['Username']) ?></div>
            <div id="num_posts">Numero di post pubblicati: <?php echo($user['Nposts'])?></div>
            <div id="email">Contatta il venditore per il suo annuncio: <?php echo($user['Email'])?></div>

        </section>
    </body>
</html>
