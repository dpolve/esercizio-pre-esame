<?php
session_start(); //fa partire la sessione (o la ripristina)

if (!$_SESSION['login']) {
    header("Location: index.php?msg=Autenticazione necessaria");
}

include("conf.php");

$sql_controllo =   "SELECT arg_argomento
                    FROM argomenti
                    WHERE arg_argomento = :arg";
$controllo = $db->prepare($sql_controllo);
$controllo->bindParam(':arg', strtoupper($_POST['inputTopic']));
$controllo->execute();
$controllo = $controllo->fetchAll(PDO::FETCH_ASSOC);

if (count($controllo) == 0) {
    $sql = "INSERT INTO argomenti (arg_argomento) VALUE(:nome_arg) ";
    $inserimento = $db->prepare($sql);
    $inserimento->bindParam(':nome_arg', strtoupper($_POST['inputTopic']));
    $inserimento->execute();

    header("Location: menu.php?msg_admin=Argomento inserito correttamente");
} else {
    header("Location: menu.php?msg_admin=Argomento già presente");
}
