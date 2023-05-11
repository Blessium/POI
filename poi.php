<?php
    $title = "POI";
    session_start();
    include __DIR__ . "/pagine/template.html";
    include __DIR__ . "/database.php";
    
    if (!isset($_SESSION['isLogged']) || $_SERVER['REQUEST_METHOD'] !== 'GET') {
        header("Location: login.php");
    }
    $alt = explode(".", $_GET['latitudine'])[0];
    $long = explode(".", $_GET['longitudine'])[0];

    $db = Database::get_singleton();
    $poi = $db->trova_poi($alt, $long);   
    if ($poi == null) {
        $errore = "Nessun POI trovato nelle vicinanze";
        include __DIR__ . '/pagine/poi.html';
        exit;
    } 

    $luogo = $poi['luogo'];  
    $videos = array(
        'primo' => $poi['video1'],
        'secondo' => $poi['video2'],
    );

    $photos = array(
        'prima' => $poi['photo1'],  
        'seconda' => $poi['photo2'],  
        'terza' => $poi['photo3'],
        'quarta' => $poi['photo4'],  
        'quinta' => $poi['photo5'],  
    );
    include __DIR__ . '/pagine/poi.html';
    
?>