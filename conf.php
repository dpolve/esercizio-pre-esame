<?php
        $host = "localhost";
        $user = "root";
        $password = "password";
        $dbname = "eventi2020";
        $dsn = 'mysql:dbname=' . $dbname . ';host=' . $host . ";charset=utf8";
        $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $conn = new PDO($dsn, $user, $password, $dsn_Options);
            // echo "Connessione eseguita con successo <br>";
        } catch (PDOException $e) {
            echo "Errore di connessione al database " . $e->getMessage();
        }