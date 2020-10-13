<?php
    //documento php richiesto per il logout

    //ripristino della sezione
    session_start();

    //libera tutte le variabili registrate in sessione
    session_unset();

    //distrugge tutti i dati associati alla sessione
    session_destroy();
    
    //mi sposto nell'index.php indicando come testo "LogOut completato"
    header("Location: index.php?msg=Logout completato");
?>