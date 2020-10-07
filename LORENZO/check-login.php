<?php
session_start();

include("./conf.php");

$records= $db->prepare(
        'SELECT *
        FROM utenti
        WHERE ute_login = :login AND ute_password = :password'
);

    $records->bindParam(':login',$_POST['utenteLogin']);
    $records->bindParam(':password',$_POST['passwordLogin']);
    $records->execute();
    $records=$records->fetchAll(PDO::FETCH_ASSOC);

    if(count($records)==0){
        //login errato
        $_SESSION['login']=false;
        header("Location: index.php?msg=Utente o password errati");
    } else {
        //login corretto
        $_SESSION['login']=true;
        $_SESSION['ute_id']= $records[0]['ute_id'];
        header("Location: argomenti.php");
    }
?>