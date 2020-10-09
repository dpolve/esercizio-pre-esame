<?php
session_start();

if (!$_SESSION['login']) {
    header("Location: index.php?msg=Autenticazione necessaria");
} else if ($_SESSION['ute_ruolo'] == "users") {
    header("Location: argomenti.php");
} else {
    echo "Area riservata ADMIN";
?>

    <!-- inizio html pagina riservata -->
    <?php include("./conf.php") ?>
    <html>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Area Riservata</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">Menu</button>
                <button type="button" class="btn btn-secondary">Gestione Utenti</button>
                <a href="#" class="btn btn-primary btn-outline-danger">Esci (LogOut)</a>
            </div>
            <h1>Statistiche <a href="menu.php?freq=T"> Totali</a>,<a href="menu.php?freq=I"> Ieri</a>,<a href="menu.php?freq=O"> Oggi </a>per Argomento</h1>
            <?php
            $today = date("Y-m-d");
            $day_before = date("Y-m-d", strtotime($today . ' -1 day'));


            $freq = $_REQUEST["freq"];
            if ($_REQUEST["freq"] == "T") {
                // 2. lettura records di tabella statistiche totali per argomento
                $stat_sum =
                    " SELECT argomenti.arg_argomento , argomenti.arg_id ,
                        COUNT(argomenti.arg_argomento) as sta_tot 
                        FROM statistiche
                        INNER JOIN eventi ON eventi.eve_id = statistiche.sta_eve_id
                        INNER JOIN argomenti ON eventi.eve_arg_id = argomenti.arg_id
                        GROUP BY argomenti.arg_argomento
                        ORDER BY argomenti.arg_argomento  ";
                $st_stat_sum = $conn->prepare($stat_sum);
                $st_stat_sum->execute();
                $sta_sum = $st_stat_sum->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Statistiche di Argomenti</th>
                            <th scope="col">Visite Totali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $link_id = "stat_dettaglio.php?id_argomento=";
                        $link_argomento = "&argomento_nome=";

                        foreach ($sta_sum as $record) {
                            $arg_id = $record["arg_id"];
                            $arg_a = $record["arg_argomento"];
                            $sta_tot = $record["sta_tot"];
                            echo '
                        <tr>
                           <td>
                                <a href="' . $link_id . $arg_id . $link_argomento . $arg_a . '">' . $arg_a . '</a>
                            </td>
                            <td>
                            ' . $sta_tot . '
                            </td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php
                exit;
            } else if ($_REQUEST["freq"] == "I") {
                // 2.1 lettura records di tabella statistiche totali per argomento
                $stat_ier =
                    " SELECT argomenti.arg_id , argomenti.arg_argomento , COUNT(*) as sta_tot
                    FROM statistiche 
                    INNER JOIN eventi on eventi.eve_id = statistiche.sta_eve_id
                    INNER JOIN argomenti ON eventi.eve_arg_id = argomenti.arg_id
                    WHERE statistiche.sta_data = '$day_before'
                    GROUP BY argomenti.arg_argomento ";
                $st_stat_ier = $conn->prepare($stat_ier);
                $st_stat_ier->execute();
                $sta_ier = $st_stat_ier->fetchAll(PDO::FETCH_ASSOC);

            ?><!-- <pre><?php var_dump($sta_ier)?></pre> -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Statistiche di Argomenti</th>
                            <th scope="col">Visite di Ieri: <?php echo $day_before ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $link_id = "stat_dettaglio.php?id_argomento=";
                        $link_argomento = "&argomento_nome=";

                        foreach ($sta_ier as $record) {
                            $arg_id = $record["arg_id"];
                            $arg_a = $record["arg_argomento"];
                            $sta_tot = $record["sta_tot"];
                            echo '
                            <tr>
                               <td>
                                    <a href="' . $link_id . $arg_id . $link_argomento . $arg_a . '">' . $arg_a . '</a>
                                </td>
                                <td>
                                ' . $sta_tot . '
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php
                exit;
            } else {
                echo "Oggi";
                exit;
            }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Statistiche di Argomenti</th>
                        <th scope="col">Visite totali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $link_id = "stat_dettaglio.php?id_argomento=";
                    $link_argomento = "&argomento_nome=";

                    foreach ($sta_sum as $record) {
                        $arg_id = $record["arg_id"];
                        $arg_a = $record["arg_argomento"];
                        $sta_tot = $record["sta_tot"];
                        echo '
                        <tr>
                           <td>
                                <a href="' . $link_id . $arg_id . $link_argomento . $arg_a . '">' . $arg_a . '</a>
                            </td>
                            <td>
                            ' . $sta_tot . '
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>

<?php
}
?>