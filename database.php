<?php
    
    class Database {

    private static $db = null;
    private mysqli $connection;

    private function __construct() {
        $servername = "localhost";
        $user = "blessium";
        $pwd = "blessium";
        $db = "POI";
        $this->connection = new mysqli($servername, $user, $pwd);
        if ($this->connection->connect_error) {
            die("Database error");
        }

        $create_db = "CREATE DATABASE IF NOT EXISTS " . $db; 
        if ($this->connection->query($create_db) == false) {
            die("Database error");
        }
        $this->connection->select_db($db);

        $user_table = "CREATE TABLE IF NOT EXISTS utenti ( 
            username VARCHAR(20) PRIMARY KEY NOT NULL,
            password VARCHAR(20) NOT NULL
        )";

        if ($this->connection->query($user_table) == false) {
            die("Database error");
        }
        
        $poi_db = "CREATE TABLE IF NOT EXISTS poi(
            luogo VARCHAR(20) PRIMARY KEY,
            latitudine INT(6) NOT NULL,
            longitudine INT(6) NOT NULL,
            video1 VARCHAR(100) NOT NULL,
            video2 VARCHAR(100) NOT NULL,
            photo1 VARCHAR(100) NOT NULL,
            photo2 VARCHAR(100) NOT NULL,
            photo3 VARCHAR(100) NOT NULL,
            photo4 VARCHAR(100) NOT NULL,
            photo5 VARCHAR(100) NOT NULL
        )";

        if ($this->connection->query($poi_db) == false) {
            die("Database error");
        }
    }

    static function get_singleton() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db;
    }

    function registra_utente($username, $password) {
        $connessione = $this->connection;
        $statement = $connessione->prepare("INSERT INTO utenti VALUES (?, ?)");
        $statement->bind_param('ss', $username, $password);
        try  {
            $result = $statement->execute();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function verifica_utente($username, $password) {
        $connessione = $this->connection;
        $statement = $connessione->prepare("SELECT username FROM utenti WHERE username=? AND password=?");
        $statement->bind_param('ss', $username, $password);
        $statement->bind_result($username);
        try  {
            $statement->execute();
            $statement->fetch();
            return $username;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function trova_poi($latitudine, $longitudine) {
        $connessione = $this->connection;
        $result = $connessione->query("SELECT * FROM poi WHERE latitudine='$latitudine' AND longitudine='$longitudine'");
        $poi = $result->fetch_assoc();
        return $poi;
    }
}
?>