<?php
    $title = "Richiesta descrizione - POI";
    $page = __DIR__ . "/pagine/checkPOI.html";
    session_start();
    if (!isset($_SESSION["isLogged"])) {
        header("Location: login.php");
    }


    include __DIR__ . "/pagine/template.html";
    include __DIR__ . "/pagine/checkPOI.html";
?>