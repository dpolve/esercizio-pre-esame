<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU' ACCESSO</title>
</head>

<body>
    <div class="container-fluid justify-content-center" style="text-align: center">
        <?php include("./conf.php") ?>
        <?php if (array_key_exists('msg', $_GET))
            echo "<div><strong>" . $_GET['msg'] . "</strong></div>";
        ?>
        <br>
        <h1>Applicazione Eventi2020</h1>
                <form action="check-login.php" method="POST">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="login" class="form-control" placeholder="Inserisci la Login o e-mail">
                        </div>
                        <div class="form-group">
                            <input type="text" name="password" class="form-control" placeholder="Inserisci la password">
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary">Accedi</button>
                        </p>
                    </div>
                </form>

            </div>
        </div>
</body>

</html>