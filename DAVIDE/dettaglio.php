<?php include("./conf.php") ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dettaglio Eventi</title>
</head>

<body>
    <div class="container-xl">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" onClick="history.go(-2)">HomePage</button>
            <button type="button" class="btn btn-secondary" onClick="history.go(-1)">Indietro</button>
            <a href="#" class="btn btn-primary btn-outline-danger">Esci (LogOut)</a>
        </div>

        <?php
        // 1. lettura valori passati dalla pagina precedente
        $id_eve = $_REQUEST["id_evento"];
        $dettaglio_nome = $_REQUEST["evento_nome"];

        // 2. lettura dettagli del record scelto di tabella eventi con riferimento al id_evento 
        //      della pagina precedente
        $dettaglio = " SELECT * 
                    FROM eventi 
                    WHERE eve_id = :id_eve 
                    ORDER BY eve_data_inizio ASC ";
        $st_dettaglio = $conn->prepare($dettaglio);
        $st_dettaglio->bindParam(":id_eve", $id_eve);
        $st_dettaglio->execute();
        $records = $st_dettaglio->fetchAll(PDO::FETCH_ASSOC);
        // 3. creare tabella con bootsrap per l'impaginazione
        $eve_nome = $records[0]["eve_nome"];
        $eve_descriz = $records[0]["eve_descriz"];
        $eve_data_inizio = $records[0]["eve_data_inizio"];
        $eve_data_fine = $records[0]["eve_data_fine"];
        $eve_dove = $records[0]["eve_dove"];
        $eve_image = $records[0]["eve_image"];
        ?>
        <h1>Tutti i dettagli dell'evento scelto: <?php echo "<br>" . $eve_nome; ?></h1>

        <div class="bd-example">
            <div class="card" style="width: 18rem;">
                <title><?php echo $eve_nome ?></title>
                <img src="<?php echo $eve_image ?>" alt="">


                <div class="card-body">
                    <h5 class="card-title"> Io sono: <?php echo $eve_nome; ?></h5>
                    <p class="card-text"> Che si fà? <?php echo $eve_descriz; ?></p>
                    <p class="card-text"> DAL: <?php echo date_db2user($eve_data_inizio) ?></p>
                    <p class="card-text"> AL: <?php echo date_db2user($eve_data_fine) ?></p>
                    <a href="#" class="btn btn-primary">Prenota / Self-CheckIn</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>