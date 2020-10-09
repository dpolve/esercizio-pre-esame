<?php
    session_start();
    include("./conf.php");

    if(!$_SESSION['login']){
        header("Location: index.php?msg=Autenticazione necessaria");
    }
    else if($_SESSION['ute_ruolo'] == "users"){
        header("Location: argomenti.php");
    }else{
        echo '<div class="container-fluid">
            <strong><h1>Area riservata ADMIN</h1></strong>
            
            <br>
            <strong>Totale accessi eventi:</strong>
            <br>';

        $records= $db->prepare(
            'SELECT eventi.eve_nome,statistiche.sta_data,COUNT(*)
            FROM statistiche 
            INNER JOIN eventi 
            ON eventi.eve_id = statistiche.sta_eve_id
            GROUP BY eventi.eve_nome');
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);

        foreach($records as $record){
            $eve_nome = $record["eve_nome"];
            $contatore = $record["COUNT(*)"];

            echo '<strong>'.$eve_nome . ':</strong> ' .$contatore .'<br>';
        }


        echo '<br><a href="logout.php" class="btn btn-primary btn-danger">LogOut</a>
        </div>';
        







    }

//     SELECT eventi.eve_nome,COUNT(*) FROM statistiche 
// inner join eventi on eventi.eve_id = statistiche.sta_eve_id 
// group by statistiche.sta_eve_id
?>