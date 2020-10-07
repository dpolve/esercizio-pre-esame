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
    include("./conf.php");

    $eve_id = $_REQUEST["id_evento"];
    $eve_nome = $_REQUEST["nome_evento"];
    $eve_arg_id = $_REQUEST["id_argomento"];
    ?>
    <div class="container-fluid">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" onClick="history.go(-2)">HomePage</button>
            <button type="button" class="btn btn-secondary" onClick="history.go(-1)">Indietro</button>
            <a href="#" class="btn btn-primary btn-danger">Esci (LogOut)</a>
        </div>
        <br><br>
        <h5>Evento <?php echo $eve_nome ?> </h5>
        <br>
        <?php
        try {
            $hostname = "localhost";
            $dbname = "eventi2020";
            $user = "root";
            $pass = "";
            $dsn = "mysql:dbname=" . $dbname . ";host=" . $hostname;
            $db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
            die();
        }
        $records = $db->prepare(
            "SELECT *
            FROM eventi
            WHERE eve_id = :id
            ORDER BY eve_data_inizio ASC"
        );
        $records->bindParam(":id", $eve_id);
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- <pre>
            <?php
            // var_dump($records);
            ?>
        </pre> -->
        <table class="table" style="width: 0%">
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
                foreach ($records as $record) {
                    $eve_nome = $record["eve_nome"];
                    $eve_id = $record["eve_id"];
                    $eve_data_inizio = $record["eve_data_inizio"];
                    $eve_data_fine = $record["eve_data_fine"];
                    $eve_luogo = $record["eve_dove"];
                    $eve_desc = $record["eve_descriz"];
                    echo
                        '<tr>
                            <td>' . $eve_nome . '</td>
                            <td>' . data_ordinata($eve_data_inizio) . '</td>
                            <td>' . data_ordinata($eve_data_fine) . '</td>
                            <td>' . $eve_luogo . '</td>
                            <td>' . $eve_desc . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->