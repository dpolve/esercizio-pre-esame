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
                echo $_GET['msg'];
            ?>
        </strong>
        
        <div class="row">
            <div class="col-md-2 offset-md-5">
                <form method="POST" action="check-login.php">
                    <div class="form-group">
                    <br>
                        <label for="utenteLogin">Nome Utente</label>
                        <input name="utenteLogin" type="text" class="form-control" id="utenteLogin">
                    </div>
                    <div class="form-group">
                        <label for="passwordLogin">Password</label>
                        <input name="passwordLogin" type="password" class="form-control" id="passwordLogin">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>