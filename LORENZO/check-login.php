<?php
session_start();

$records= $db->prepare(
        'SELECT *
        FROM utenti
        WHERE ute_login = :login AND ute_password = :password'
);

$records->bindParam()
?>