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

//     SELECT eventi.eve_nome,COUNT(*) FROM statistiche 
// inner join eventi on eventi.eve_id = statistiche.sta_eve_id 
// group by statistiche.sta_eve_id
?>