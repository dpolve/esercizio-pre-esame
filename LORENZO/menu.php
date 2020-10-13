<?php
session_start();
include("./conf.php");

if (!$_SESSION['login']) {
    header("Location: index.php?msg=Autenticazione necessaria");
} else if ($_SESSION['ute_ruolo'] == "users") {
    header("Location: argomenti.php");
} else {
?>
    <div class="container-fluid justify-content-center" style="text-align: center">
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <strong>
                    <h1>Area riservata ADMIN</h1>
                </strong>
                <br>
            </div>
        </div>
        <a href="logout.php" class="btn btn-danger">LogOut</a>
        <br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3">

                <form action="" method="POST">
                    <div class="form-group">
                        <label><strong>Visite eventi: </strong></label>
                        <input type="submit" class="btn btn-primary" name="totali" value="Totali">
                        <input type="submit" class="btn btn-primary" name="oggi" value="Oggi">
                        <input type="submit" class="btn btn-primary" name="ieri" value="Ieri">
                    </div>
                    <div class="form-group">
                        <label><strong>Inserisci: </strong></label>
                        <input type="submit" class="btn btn-primary" name="evento" value="Evento">
                        <input type="submit" class="btn btn-primary" name="utente" value="Utente">
                    </div>
                </form>
            </div>
        </div>
        <br>
        <?php
        if (isset($_POST['totali'])) {
        ?>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h5><strong>Totale visite eventi:</strong></h5>
                    <br>'
            <?php

            $sql_total =   "SELECT eventi.eve_nome,statistiche.sta_data,COUNT(*)
                    FROM statistiche 
                    INNER JOIN eventi 
                    ON eventi.eve_id = statistiche.sta_eve_id
                    GROUP BY eventi.eve_nome";
            $total_records = $db->prepare($sql_total);
            $total_records->execute();
            $total_records = $total_records->fetchAll(PDO::FETCH_ASSOC);

            foreach ($total_records as $t_record) {
                $eve_nome = $t_record["eve_nome"];
                $contatore = $t_record["COUNT(*)"];

                echo $eve_nome . ': <strong>' . $contatore . '</strong><br>';
            }


            echo
                '</div>';
        } else if (isset($_POST['ieri'])) {
            echo '
                <div class="col-md-6 offset-md-3">
                    <h5><strong>Totale visite eventi di ieri (' . date('d/m/Y', strtotime("-1 days")) . '):</strong></h5>
                    <br>';
            $yesterday = date('Y-m-d', strtotime("-1 days"));
            $sql_yesterday =   "SELECT eventi.eve_nome, statistiche.sta_data, COUNT(*) 
                        FROM statistiche 
                        INNER JOIN eventi 
                        ON eventi.eve_id = statistiche.sta_eve_id
                        WHERE DATE(statistiche.sta_data) = :yesterday
                        GROUP BY eventi.eve_nome";
            $yesterday_records = $db->prepare($sql_yesterday);
            $yesterday_records->bindParam(':yesterday', $yesterday);
            $yesterday_records->execute();
            $yesterday_records = $yesterday_records->fetchAll(PDO::FETCH_ASSOC);

            foreach ($yesterday_records as $y_record) {
                $eve_nome = $y_record["eve_nome"];
                $contatore = $y_record["COUNT(*)"];

                echo $eve_nome . ': <strong>' . $contatore . '</strong><br>';
            }


            echo '</div>';
        } else if (isset($_POST['oggi'])) {
            echo '
                <div class="col-md-6 offset-md-3">
                    <h5><strong>Totale visite eventi di oggi (' . date("d/m/Y") . '):</strong></h5>
                    <br>';
            $today = date("Y-m-d");
            $sql_today =   "SELECT eventi.eve_nome, statistiche.sta_data, COUNT(*) 
                    FROM statistiche 
                    INNER JOIN eventi 
                    ON eventi.eve_id = statistiche.sta_eve_id
                    WHERE DATE(statistiche.sta_data) = :today
                    GROUP BY eventi.eve_nome";
            $today_records = $db->prepare($sql_today);
            $today_records->bindParam(':today', $today);
            $today_records->execute();
            $today_records = $today_records->fetchAll(PDO::FETCH_ASSOC);

            foreach ($today_records as $tod_record) {
                $eve_nome = $tod_record["eve_nome"];
                $contatore = $tod_record["COUNT(*)"];

                echo $eve_nome . ': <strong>' . $contatore . '</strong><br>';
            }
            echo '</div>';
        } else if (isset($_POST['evento'])) {
            echo '<div class="col-md-6 offset-md-3">
        
        </div>';
        } else if (isset($_POST['utente'])) {
            echo '<div class="col-md-6 offset-md-3">
        <form action="insert.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputLogin">ID Login</label>
                <input type="text" class="form-control" id="inputLogin" placeholder="Inserisci il nome utente per il login" required="true">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Inserisci la password per il login" required="true">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" id="inputName" placeholder="Inserisci il tuo nome completo" required="true">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Inserisci la tua mail" required="true">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 offset-md-4">
                <label for="inputUtente">Tipo Utente</label>
                <select id="inputUtente" class="form-control">
                    <option selected>User</option>
                    <option>Admin</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-2">Inserisci utente</button>
    </form>
        </div>';
        }
        echo '</div></div>';
    }

//     SELECT eventi.eve_nome,COUNT(*) FROM statistiche 
// inner join eventi on eventi.eve_id = statistiche.sta_eve_id 
// group by statistiche.sta_eve_id
