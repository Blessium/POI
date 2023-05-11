<?php
$title = "Registrati - POI";
include __DIR__ . '/pagine/template.html';
include __DIR__ . '/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] == "" || $_POST['password'] == "") {

        $error = "Devi riempire i campi";
        include __DIR__ . '/pagine/registrati.html';
        exit;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = Database::get_singleton();
    $result = $db->registra_utente($username, $password);
    if (isset($result)) {
        $error = "Username gia' in uso";
    } else {
        header("Location: login.php");
    }
}
    include __DIR__ . '/pagine/registrati.html';
?>