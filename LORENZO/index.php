<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php include("./conf.php");
    ?>
    <div class="container-fluid justify-content-center" style="text-align: center">
        <br>
        <strong>
            <?php if (array_key_exists('msg', $_GET))
                echo $_GET['msg'] . '<br><br>';
            ?>
        </strong>

        <div class="row">
            <div class="col-md-6 offset-md-4">
                <form method="POST" action="check-login.php">
<<<<<<< HEAD
                    <div class="form-group row">
                        <label for="utenteLogin" class="col-sm-2">Nome Utente</label>
                        <input name="utenteLogin" type="text" class="form-control col-sm-4" id="utenteLogin">
                    </div>
                    <div class="form-group row">
                        <label for="passwordLogin" class="col-sm-2">Password</label>
                        <input name="passwordLogin" type="password" class="form-control col-sm-4" id="passwordLogin">
=======
                    <div class="form-group">
                        <br>
                        <label for="utenteLogin">Nome Utente</label>
                        <input name="utenteLogin" type="text" class="form-control" id="utenteLogin">
>>>>>>> c2e9fcb4c58797635f0f7192e36b38a268e59245
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary col-sm-2 offset-md-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>