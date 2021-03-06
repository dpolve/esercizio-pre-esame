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
    header_remove();
    $id = $_REQUEST["id_argomento"];
    $nome = $_REQUEST["nome_argomento"];
    ?>
    <div class="container-fluid justify-content-center" style="text-align: center">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php echo '<br>Utente collegato: <strong>' . $_SESSION['ute_nome'] . '<br>'; ?>
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
                    <button type="button" class="btn btn-primary" onClick="history.go(-1)">Indietro</button>
                    <a href="logout.php" class="btn btn-primary btn-danger">Logout</a>
                </div>
            </div>
        </div>
        <br>
        <h5>Eventi presenti per l'argomento: <strong> <?php echo $nome ?></strong></h5>
        <br>
        <?php
        $records = $db->prepare("SELECT eve_id, eve_arg_id, eve_nome, eve_data_inizio FROM eventi WHERE eve_arg_id = :id ORDER BY eve_data_inizio ASC");
        $records->bindParam(":id", $id);
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="table-responsive-md">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="row">Nome Evento</th>
                                <th scope="row">Data Inizio Evento</th>
                                <th scope="row">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($records as $record) {
                                $eve_nome = $record["eve_nome"];
                                $eve_id = $record["eve_id"];
                                $eve_data_inizio = $record["eve_data_inizio"];
                                $eve_id_arg = $record["eve_arg_id"];

                                echo
                                    '<tr>
                        <td>' . $eve_nome . '</td>
                        <td>' . data_ordinata($eve_data_inizio) . '</td>
                        <td><a href="dettaglio.php?id_evento=' . $eve_id . '&nome_evento=' . $eve_nome . '&id_argomento=' . $eve_id_arg . '"> Dettagli </a></td>
                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>