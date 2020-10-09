<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php include("./conf.php"); 
    header_remove("Location");
    ?>
    <div class="container-fluid">
        <strong>
            <?php if (array_key_exists('msg', $_GET))
                echo $_GET['msg'];
            ?>
        </strong>
    
    
        <form method="POST" action="check-login.php" style="width: 25%">
            <div class="form-group">
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

</body>

</html>