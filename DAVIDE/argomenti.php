<?php include("./conf.php") ?>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elenco Argomenti</title>
</head>

<body>
    <div class="container-fluid">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Menu</button>
            <button type="button" class="btn btn-secondary">Profilo</button>
            <a href="#" class="btn btn-primary btn-outline-danger">Esci (LogOut)</a>
        </div>
        <h1>Quale argomento ti interessa?</h1>
        <?php
        // 2. lettura records di tabella argomenti
        $argomenti = " SELECT arg_id,arg_argomento FROM argomenti ORDER BY arg_argomento ASC ";
        $st_argomenti = $conn->prepare($argomenti);
        $st_argomenti->execute();
        $records = $st_argomenti->fetchAll(PDO::FETCH_ASSOC);

        // 3. creare tabella con bootsrap per l'impaginazione
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tipologia di Argomenti</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $link_id = "eventi.php?id_argomento=";
                $link_argomento = "&argomento_nome=";
                foreach ($records as $record) {
                    $arg_id = $record["arg_id"];
                    $arg_a = $record["arg_argomento"];
                    echo '<tr><td><a href="' . $link_id . $arg_id . $link_argomento . $arg_a . '">'
                        . $arg_a . '</a></td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>