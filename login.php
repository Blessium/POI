<?php
    $title = "Entra - POI";
    session_start();
    include __DIR__ . "/pagine/template.html";
    include __DIR__ . "/database.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ($_POST['username'] == "" || $_POST['password'] == "") {
            $error = "Devi riempire i campi";
            include __DIR__ . '/pagine/login.html';
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = Database::get_singleton();
        $result = $db->verifica_utente($username, $password);
        if (isset($result)) {
            $_SESSION["username"] = $result;
            $_SESSION["isLogged"] = true;
            header("Location: index.php");
        } else {
            $error = "Username e/o password non corretta";
        }
    }

    include __DIR__ . "/pagine/login.html";
?>