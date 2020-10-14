<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-dark text-white">
    <?php
    session_start();
    include("./conf.php");

    if (!$_SESSION['login']) {
        header("Location: index.php?msg=Autenticazione necessaria");
    } else if ($_SESSION['ute_ruolo'] == "users") {
        header("Location: argomenti.php");
    } else if ($_SESSION['ute_ruolo'] == "admin") {

    ?>
        <div class="container-fluid" style="text-align: center">
            <br>
            <div class="row">
                <div class="col-md-1">
                    <a href="argomenti.php" class="btn btn-primary ">Vedi Pagina</a>
                </div>
                <div class="col-md-10">
                    <strong>
                        <h1>Area riservata ADMIN</h1>
                    </strong>
                </div>
                <div class="col-md-1">
                    <a href="logout.php" class="btn btn-danger ">Logout</a>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">

                    <form action="" method="POST">
                        <div class="form-group">
                            <label><strong>Visite eventi: </strong></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="ieri" value="Ieri">
                            <input type="submit" class="btn btn-success" name="oggi" value="Oggi">
                            <input type="submit" class="btn btn-success" name="totali" value="Totali">
                        </div>
                        <div class="form-group">
                            <label><strong>Inserisci: </strong></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="argomento" value="Argomento">
                            <input type="submit" class="btn btn-success" name="evento" value="Evento">
                            <input type="submit" class="btn btn-success" name="utente" value="Utente">
                        </div>
                
                </form>
                </div>
            </div>

            <br>
            <?php
            if (array_key_exists('msg_admin', $_GET)) {
                echo  $_GET["msg_admin"] . '<br><br>';
                header("Refresh: 2; url=menu.php");
            }

            if (isset($_POST['totali'])) {
            ?>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h5><strong>Totale visite eventi:</strong></h5>
                        <br>
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
                        ?>
                        <div class="col-md-6 offset-md-3">
                            <h5><strong>Totale visite eventi di ieri <?php echo date("d/m/Y", strtotime("-1 days")) ?>:</strong></h5>
                            <br>

                            <?php
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
                            ?>
                            <div class="col-md-6 offset-md-3">
                                <h5><strong>Totale visite eventi di oggi <?php echo date("d/m/Y") ?>:</strong></h5>
                                <br>
                                <?php
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

                                /**
                                 * FORM EVENTO
                                 */
                            } else if (isset($_POST['evento'])) {
                                ?>
                                <div class="col-md-6 offset-md-3">
                                    <form action="insert-event.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNomeEvento">Nome Evento</label>
                                                <input type="text" class="form-control" name="inputNomeEvento" id="inputNomeEvento" placeholder="Inserisci il nome evento" required="true">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputDataInizio">Data Inizio</label>
                                                <input type="date" class="form-control" name="inputDataInizio" id="inputDataInizio" placeholder="Inserisci la data di inizio evento" required="true">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputDataFine">Data Fine</label>
                                                <input type="date" class="form-control" name="inputDataFine" id="inputDataFine" placeholder="Inserisci la data di fine evento" required="true">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputLogin">Argomento</label>
                                                <select name="inputArgomento" class="form-control">
                                                    <?php
                                                    $sql_option = "SELECT * FROM argomenti";
                                                    $select_records = $db->prepare($sql_option);
                                                    $select_records->execute();
                                                    $select_records = $select_records->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($select_records as $s_record) {
                                                        echo '<option value="' . $s_record['arg_id'] . '">' . $s_record['arg_argomento'] . '</option>';
                                                    }
                                                    ?>

                                                </select>

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputLuogoEvento">Luogo Evento</label>
                                                <input type="text" class="form-control" name="inputLuogoEvento" id="inputLuogoEvento" placeholder="Inserisci il luogo dell'Evento" required="true">
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputDescrizione">Breve descrizione</label>
                                                <input type="text" class="form-control" name="inputDescrizione" id="inputDescrizione" placeholder="Inserisci una breve descrizione dell'evento" required="true">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputUrlImage">Url Immagine Evento</label>
                                                <input type="url" class="form-control" name="inputUrlImage" id="inputUrlImage" placeholder="Inserisci l'url immagine dell'evento" required="true">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-2">Inserisci Evento</button>
                                    </form>
                                </div>


                            <?php
                                /**
                                 * FORM UTENTE
                                 */
                            } else if (isset($_POST['utente'])) {
                            ?> <div class="col-md-6 offset-md-3">
                                    <form action="insert-user.php" method="POST">
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
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputName">Nome</label>
                                                <input type="text" class="form-control" id="inputName" placeholder="Inserisci il tuo nome completo" required="true">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Inserisci la tua mail" required="true">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputUtente">Tipo Utente</label>
                                                <select id="inputUtente" class="form-control">
                                                    <option selected>User</option>
                                                    <option>Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-2">Inserisci utente</button>
                                    </form>
                                </div>



                            <?php
                                /**
                                 * FORM ARGOMENTO
                                 */
                            } else if (isset($_POST['argomento'])) {

                            ?>
                                <div class="col-md-2 offset-md-5">
                                    <form action="insert-topic.php" method="POST">
                                        <div class="form-group">
                                            <label for="inputTopic">Nome Argomento</label>
                                            <input type="text" class="form-control" name="inputTopic" id="inputTopic" placeholder="Inserisci il nome dell'argomento" required="true">
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-12">Inserisci argomento</button>
                                    </form>
                                </div>
                        <?php
                            }
                            echo '</div></div>';
                        }
                        ?>
</body>

</html>