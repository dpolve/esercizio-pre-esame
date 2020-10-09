<?php
    session_start();
    include("./conf.php");

    if(!$_SESSION['login']){
        header("Location: index.php?msg=Autenticazione necessaria");
    }
    else if($_SESSION['ute_ruolo'] == "users"){
        header("Location: argomenti.php");
    }else{

        
        echo '<div class="container-fluid justify-content-center" style="text-align: center">
            <br>
            <div class="row">
                <div class="col-md-6 offset-md-3">
            <strong><h1>Area riservata ADMIN</h1></strong>
            <br>
            </div></div>
            <a href="logout.php" class="btn btn-primary btn-danger">LogOut</a>
            <br><br>

            <div class="row">
                <div class="col-md-2 offset-md-3">
                    <h5><strong>Totale accessi eventi:</strong></h5>
                    <br><br>';

        $total_records= $db->prepare(
            'SELECT eventi.eve_nome,statistiche.sta_data,COUNT(*)
            FROM statistiche 
            INNER JOIN eventi 
            ON eventi.eve_id = statistiche.sta_eve_id
            GROUP BY eventi.eve_nome');
        $total_records->execute();
        $total_records = $total_records->fetchAll(PDO::FETCH_ASSOC);

        foreach($total_records as $t_record){
            $eve_nome = $t_record["eve_nome"];
            $contatore = $t_record["COUNT(*)"];

            echo '<strong>'.$eve_nome . ':</strong> ' .$contatore .'<br>';
        }


        echo 
        '</div>
                <div class="col-md-2">
                    <h5><strong>Totale accessi eventi di ieri '.date('d/m/Y',strtotime("-1 days")).':</strong></h5>
                    <br>';
                    $yesterday_records= $db->prepare(
                        'SELECT eventi.eve_nome,statistiche.sta_data,COUNT(*)
                        FROM statistiche 
                        INNER JOIN eventi 
                        ON eventi.eve_id = statistiche.sta_eve_id
                        WHERE statistiche.sta_data BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() - INTERVAL 1 SECOND 
                        GROUP BY eventi.eve_nome');
                    $yesterday_records->execute();
                    $yesterday_records = $yesterday_records->fetchAll(PDO::FETCH_ASSOC);
            
                    foreach($yesterday_records as $y_record){
                        $eve_nome = $y_record["eve_nome"];
                        $contatore = $y_record["COUNT(*)"];
            
                        echo '<strong>'.$eve_nome . ':</strong> ' .$contatore .'<br>';
                    }
        
        
        echo '</div>
                <div class="col-md-2">
                    <h5><strong>Totale accessi eventi di oggi '.date("d/m/Y").':</strong></h5>
                    <br>';
                    $today_records= $db->prepare(
                        'SELECT eventi.eve_nome,statistiche.sta_data,COUNT(*)
                        FROM statistiche 
                        INNER JOIN eventi 
                        ON eventi.eve_id = statistiche.sta_eve_id
                        WHERE statistiche.sta_data = now()
                        GROUP BY eventi.eve_nome');
                    $today_records->execute();
                    $today_records = $today_records->fetchAll(PDO::FETCH_ASSOC);
            
                    foreach($today_records as $tod_record){
                        $eve_nome = $tod_record["eve_nome"];
                        $contatore = $tod_record["COUNT(*)"];
            
                        echo '<strong>'.$eve_nome . ':</strong> ' .$contatore .'<br>';
                    }
        
        
        echo '</div></div></div>';
        







    }

//     SELECT eventi.eve_nome,COUNT(*) FROM statistiche 
// inner join eventi on eventi.eve_id = statistiche.sta_eve_id 
// group by statistiche.sta_eve_id
?>