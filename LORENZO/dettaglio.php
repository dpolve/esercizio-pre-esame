<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventi</title>
</head>

<body>

    <?php
    session_start();
    if (!$_SESSION['login']) {
        header("Location: index.php?msg=Per poter vedere i contenuti bisogna effettuare l'accesso");
    }
    include("./conf.php");

    $eve_id = $_REQUEST["id_evento"];
    $eve_nome = $_REQUEST["nome_evento"];
    $eve_arg_id = $_REQUEST["id_argomento"];

    ?>
    <div class="container-fluid justify-content-center" style="text-align: center">
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php echo 'Utente collegato: <strong>' . $_SESSION['ute_nome']; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="btn-group" role="group" aria-label="Basic example">
                <?php
                    if($_SESSION['ute_ruolo'] == "admin"){
                        echo '<a href="menu.php" class="btn btn-primary">Sezione Admin</a>';
                    }
                ?>
                    <button type="button" class="btn btn-primary" onClick="history.go(-2)">HomePage</button>
                    <button type="button" class="btn btn-primary" onClick="history.go(-1)">Indietro</button>
                    <a href="logout.php" class="btn btn-primary btn-danger">Logout</a>
                </div>
            </div>
        </div>
        <br>
        <h5>Evento selezionato: <br> <strong><?php echo $eve_nome ?></strong></h5>
        <br>
        <?php
        // try {
        //     $hostname = "localhost";
        //     $dbname = "eventi2020";
        //     $user = "root";
        //     $pass = "";
        //     $dsn = "mysql:dbname=" . $dbname . ";host=" . $hostname;
        //     $db = new PDO($dsn, $user, $pass);
        // } catch (PDOException $e) {
        //     echo "Errore: " . $e->getMessage();
        //     die();
        // }
        $records = $db->prepare(
            "SELECT *
            FROM eventi
            WHERE eve_id = :id"
        );
        $records->bindParam(":id", $eve_id);
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="table-responsive-md">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="row">Nome Evento</th>
                                <th scope="row">Data Inizio Evento</th>
                                <th scope="row">Data Fine Evento</th>
                                <th scope="row">Luogo</th>
                                <th scope="row">Breve Descrizione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $eve_nome = $records[0]["eve_nome"];
                            $eve_id = $records[0]["eve_id"];
                            $eve_data_inizio = $records[0]["eve_data_inizio"];
                            $eve_data_fine = $records[0]["eve_data_fine"];
                            $eve_luogo = $records[0]["eve_dove"];
                            $eve_desc = $records[0]["eve_descriz"];
                            $eve_img_url = $records[0]["eve_image"];
                            echo
                                '<tr>
                            <td>' . $eve_nome . '</td>
                            <td>' . data_ordinata($eve_data_inizio) . '</td>
                            <td>' . data_ordinata($eve_data_fine) . '</td>
                            <td>' . $eve_luogo . '</td>
                            <td>' . $eve_desc . '</td>
                    </tr>';


                            $conteggio = $db->prepare('INSERT INTO statistiche (sta_eve_id) VALUE (:evento_id)');
                            $conteggio->bindParam("evento_id", $eve_id);
                            $conteggio->execute();
                            ?>
                        </tbody>
                    </table>
                </div>
                <img src="<?php echo $eve_img_url ?>" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    </div>
</body>

</html>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->