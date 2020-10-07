<?php include("./conf.php") ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elenco Eventi</title>
</head>

<body>
    <div class="container-fluid">
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary" onClick="history.go(-1)">HomePage</button>
            <button type="button" class="btn btn-secondary" onClick="history.go(-1)">Indietro</button>
            <a href="#" class="btn btn-primary btn-outline-danger">Esci (LogOut)</a>
        </div>

        <h1>Quale evento ti interessa ?</h1>
        <?php
        // 1. lettura valori passati dalla pagina precedente
        $id_arg = $_REQUEST["id_argomento"];
        $argomento_nome = $_REQUEST["argomento_nome"];

        // 2. lettura records di tabella eventi con riferimento al id_argomento 
        //      della pagina precedente
        $eventi = " SELECT eve_id,eve_arg_id,eve_nome,eve_data_inizio 
                    FROM eventi 
                    WHERE eve_arg_id = :id_arg 
                    ORDER BY eve_data_inizio ASC ";
        $st_eventi = $conn->prepare($eventi);
        $st_eventi->bindParam(":id_arg", $id_arg);
        $st_eventi->execute();
        $records = $st_eventi->fetchAll(PDO::FETCH_ASSOC);

        // 3. creare tabella con bootsrap per l'impaginazione
        ?>
        <table class="table table-striped" style="width: 50%">
            <thead>
                <tr>
                    <th scope="col">Tutti gli eventi dell'argomento scelto: <?php echo $argomento_nome ?></th>
                    <th>Data Evento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $link = "dettaglio.php?id_evento=";
                $link_evento = "&evento_nome=";
                foreach ($records as $record) {
                    $eve_id = $record["eve_id"];
                    $eve_e = $record["eve_nome"];
                    $eve_data_inizio = $record["eve_data_inizio"];
                    echo '<tr>
                    <td><a href="' . $link . $eve_id . $link_evento . $eve_e . '">'
                        . $eve_e . '</a></td>
                        <td>'
                        . date_db2user($eve_data_inizio) . '</td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>