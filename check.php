<?php
    $dbconfig = [
        'host'     => '127.0.0.1',
        'db_name'  => 'string',
        'user'     => 'root',
        'password' => ''
    ];


    session_start();

    function checked() {
        if(isset($_SESSION['string_session_id'])) {
            return $_SESSION['string_session_id'];
        } else 
            return 0;
    }
?>