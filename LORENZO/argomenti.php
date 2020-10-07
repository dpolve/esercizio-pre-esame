<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARGOMENTI</title>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center">
        <br>
        <?php
        include("./conf.php");

        /*  1. connessione al DB eventi2020 */
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
        /*   2. lettura records tabella argomenti */
        $records = $db->prepare("SELECT arg_id, arg_argomento FROM argomenti ORDER BY arg_argomento ASC");
        $records->execute();
        $records = $records->fetchAll(PDO::FETCH_ASSOC);
        /*    3. */
        ?>
        <table class="table" style="width: 25%; text-align: center">
            <thead class="thead-dark">
                <tr>
                    <th scope="row">Argomenti</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($records as $record) {
                    $arg_id = $record["arg_id"];
                    $arg_a = $record["arg_argomento"];

                    echo '<tr><td><a href="eventi.php?id_argomento=' . $arg_id . '&nome_argomento=' . $arg_a . '">' . $arg_a . '</a></td></tr>';
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