<?php 
    require_once 'check.php';
    if (!$userid = checked()){
        header("Location: login.php");
        exit;
    }else{
        header("Location: home.php");
    }

    header('Content-Type: application/json');    //informa il sito che effettua la richiesta di aspettarsi in ritorno un json

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db_name']) or die(mysqli_error($conn));

    $query = "SELECT USERS.id as userId, USERS.Username as userUsername, USERS.Nome as userNome, USERS.Cognome as userCognome, 
    POSTS.Id as postsId, POSTS.User as postsUserId, POSTS.Title as postsTitle, POSTS.Text as postsText, POSTS.Time as postsTime
    FROM POSTS JOIN USERS ON POSTS.User = USERS.Id  ORDER BY postsId DESC LIMIT 10";     //ordinando per post id avrò per ultimi i post più recenti

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $postArray = array();
    while($row = mysqli_fetch_assoc($res)) {
        $postsTime = getTime($row['postsTime']);
        $postArray[] = array('userId' => $row['userId'], 'userUsername' => $row['userUsername'], 'userNome' => $row['userNome'], 
                            'userCognome' => $row['userCognome'], 'postsId' => $row['postsId'], 'postsUserId' => $row['postsUserId'], 
                            'postsTitle' => $row['postsTitle'], 'postsText' => $row['postsText'], 
                            'postsTime' => "$postsTime");
    }
    echo json_encode($postArray);   //Traduce l'array in formato json




    function getTime($time) {            
        $unixTime = strtotime($time);              //cambia il formato di $time in una stringa di numeri in un particolare formato unix che indica il numero di secondi trascorsi da un certo evento
        $deltaTime = time() - $unixTime;           //time determina il numero di secondi trascorsi dall'evento sopra indicato
        $unixTime = date('d/m/y', $unixTime);      //traduciamo unix time in un formato con giorno, mese e anno 

        if ($deltaTime /60 <1) {
            return intval($deltaTime%60)." secondi fa";
        } else if (intval($deltaTime/60) == 1)  {
            return "1 minuto fa";  
        } else if ($deltaTime / 60 < 60) {
            return intval($deltaTime/60)." minuti fa";
        } else if (intval($deltaTime / 3600) == 1) {
            return "1 ora fa";
        } else if ($deltaTime / 3600 <24) {
            return intval($deltaTime/3600) . " ore fa";
        } else if (intval($deltaTime/86400) == 1) {
            return "Ieri";
        } else if ($deltaTime/86400 < 30) {
            return intval($deltaTime/86400) . " giorni fa";
        } else {
            return $unixTime; 
        }
    }

?>