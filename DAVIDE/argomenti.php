<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
        include("./conf.php");
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



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </div>
</body>

</html>