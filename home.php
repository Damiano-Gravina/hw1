<?php 
    require_once 'check.php';

    if (!$userid = checked()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));
    $query = "SELECT * FROM USERS WHERE Id = $userid";
    $row1 = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($row1);   
?>


<html>
    <head>
        <title>String</title>
        <link rel='stylesheet' href='css/homepage.css'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src='script/home.js' defer></script>

        <meta name="viewport" content="width=device width, initial-scale=1">
    </head>

    <body>
        <div id="title_image">
            <div id="icon">🦊</div>
            <section>
                <div id="user_image">
                    <span><?php echo($user['Nome'][0].$user['Cognome'][0]) ?><span>
                </div>
                <div><?php echo($user['Nome']." ".$user['Cognome']) ?></div>
            </section>

            <div id="option_bar">
                <a href="userPage.php"><strong>My profile</strong></a>
                <a href="logout.php"><strong>Logout</strong></a>
            </div>
            <div id="shade"></div>
            <strong>Buy and sell music tools</strong>
        </div>

        <section id="musicPlaylists">
            <span>Qualche playlist che puoi ascoltare mentre sei qui</span>
            <a href="https://www.youtube.com/watch?v=UP2XoGfhJ1Y"><span class="material-symbols-outlined">play_circle</span>Blues</a>
            <a href="https://www.youtube.com/watch?v=tAGnKpE4NCI&list=PLZN_exA7d4RVmCQrG5VlWIjMOkMFZVVOc"><span class="material-symbols-outlined">play_circle</span>Rock</a>
            <a href="https://www.youtube.com/watch?v=WxnN05vOuSM&list=PLw6p6PA8M2miu0w4K1g6vQ1BHUBeyM4_-"><span class="material-symbols-outlined">play_circle</span>Hard Rock</a>
            <a href="https://www.youtube.com/watch?v=xnKhsTXoKCI&list=PLhQCJTkrHOwSX8LUnIMgaTq3chP1tiTut"><span class="material-symbols-outlined">play_circle</span>Metal</a>
            <a href="https://www.youtube.com/watch?v=BrRBWU-EfTA"><span class="material-symbols-outlined">play_circle</span>Indie</a>
            <a href="https://www.youtube.com/watch?v=OPf0YbXqDm0&list=PLMC9KNkIncKtPzgY-5rmhvj7fax8fdxoj"><span class="material-symbols-outlined">play_circle</span>Pop</a>
            <a href="https://www.youtube.com/watch?v=AZals4U6Z_I"><span class="material-symbols-outlined">play_circle</span>Lo-fi</a>
            <a href="hhttps://www.youtube.com/playlist?list=PLGl0_ap7UnS8IL7XhVcJEkN5qWJeou65k"><span class="material-symbols-outlined">play_circle</span>Hit Italiane</a>
        </section>

        <a href="post.php" id = "new_sale"> + Crea un annuncio </a> 

        <main>
        </main>




        <footer>Developed By: Damiano Gravina (1000011319)</footer>
    </body>

    
</html>