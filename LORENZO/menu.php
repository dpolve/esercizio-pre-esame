<?php
    session_start();

    if( ! $_SESSION['login']){
        header("Location: index.php?msg=Autenticazione necessaria");
    }
    else if($_SESSION['ute_ruolo'] == "users"){
        header("Location: argomenti.php");
    }else{
        echo "Area riservata ADMIN";
    }
?>