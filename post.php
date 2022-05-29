<?php
    require_once 'check.php';
    if (!$userid = checked()){
            header("Location: login.php");
            exit;
    }


    if (!empty($_POST["title"]) && !empty($_POST["text"]) )  {

        $title = $_POST["title"];
        $text = $_POST["text"];

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));

        if(strlen($title) < 25 && $title != "Titolo annuncio" && strlen($text) > 0 && strlen($text) < 255){
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));
            $query = "INSERT INTO POSTS (Title, Text, User) VALUES('$title', '$text', $userid)";
            echo("<div id = 'published_header'>
                    <div id = 'published'>Pubblicazione effettuata</div>
                  </div>");
            mysqli_query($conn, $query);        
        }
    }
?>


<html>
    <head>
        <title>String Post</title>
        <script src='script/post.js' defer></script>
        <link rel='stylesheet' href='css/post.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <meta name="viewport" content="width=device width, initial-scale=1">
    </head>


    <body>
        <div id = "header">
            <div id="icon">🦊</div>
            <a href="home.php">Home</a>
            <a href='post.php'>Nuovo annuncio</a>
        </div>


        <section class= "hide">
            <article class = 'errorWindow'>
                <div class = 'warning'>⚠️Errore compilazione⚠️</div>
                <p class = "hide" id="title_error">Il titolo deve essere compreso tra 0 e 25 caratteri</p>
                <p class = "hide" id="text_error">Il testo deve essere compreso tra 0 e 255 caratteri</p>
            </article>
        </section>


        <form id="post" method = "post">
            <label><input type=text name="title" id="postTitle" value = "Titolo annuncio"></label>
            <textarea name="text" id="postText"></textarea>
            <input type='submit' id="publish" value='Pubblica annuncio'>
        </form>
        

    </body>
</html>