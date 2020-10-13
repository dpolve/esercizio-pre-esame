<?php

session_start(); //fa partire la sessione (o la ripristina)

if (!$_SESSION['login']) {
    header("Location: index.php?msg=Autenticazione necessaria");
}

include("conf.php");

if($_POST['inputDataFine'] < $_POST['inputDataInizio']){
    header('Location: menu.php?msg_admin=Data fine evento precedente a data inizio evento');
}else{
    $sql_controllo =   "SELECT eve_nome
                        FROM eventi
                        WHERE eve_nome = :eve";
    $controllo = $db->prepare($sql_controllo);
    $controllo->bindParam(':eve', $_POST['inputNomeEvento']);
    $controllo->execute();
    $controllo = $controllo->fetchAll(PDO::FETCH_ASSOC);

    if (count($controllo) == 0) {
        $sql = "INSERT INTO eventi (eve_arg_id, eve_nome, eve_data_inizio, eve_data_fine, eve_dove, eve_descriz, eve_image)
        VALUE(:arg_id, :e_nome, :e_data_i, :e_data_f, :e_dove, :e_desc, :e_image)";
        $inserimento = $db->prepare($sql);
        $inserimento->bindParam(':arg_id',$_POST['inputArgomento']);
        $inserimento->bindParam(':e_nome',$_POST['inputNomeEvento']);
        $inserimento->bindParam(':e_data_i',$_POST['inputDataInizio']);
        $inserimento->bindParam(':e_data_f',$_POST['inputDataFine']);
        $inserimento->bindParam(':e_dove',$_POST['inputLuogoEvento']);
        $inserimento->bindParam(':e_desc',$_POST['inputDescrizione']);
        $inserimento->bindParam(':e_image',$_POST['inputUrlImage']);
        $inserimento->execute();
    
        header("Location: menu.php?msg_admin=Evento inserito correttamente");
    } else {
        header("Location: menu.php?msg_admin=Evento già presente");
    }
}

// echo $_POST['inputNomeEvento'] .' + ' . $_POST['inputDataInizio'].' + ' . $_POST['inputDataFine'].' + ' . $_POST['inputArgomento'].' + ' . $_POST['inputLuogoEvento'].' + ' . $_POST['inputDescrizione'].' + ' . $_POST['inputUrlImage'];
