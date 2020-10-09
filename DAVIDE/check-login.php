<?php
session_start();
include("./conf.php");



$logging = "SELECT * FROM utenti WHERE ute_login = :login AND ute_password = :password ";
$st_logging = $conn->prepare($logging);
$st_logging->bindParam(':login', $_POST["login"]);
$st_logging->bindParam(':password', $_POST["password"]);
$st_logging->execute();
$records = $st_logging->fetchAll(PDO::FETCH_ASSOC);

if (count($records) == 0){
    $_SESSION['login']=False;
    header("location: index.php?msg=Utente o password errati!");
} else {
    $_SESSION['login']=True;
    $_SESSION['ute_id']=$records[0]['ute_id'];
    $_SESSION['ute_ruolo']=$records[0]['ute_ruolo'];
    header("location: menu.php?freq=T");
}