<?php
// Inizia la sessione
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['username'])) {
    // Reindirizza alla pagina di login se la sessione non è attiva (casi di accessi pagine riservate da utenti NON loggati)
    session_start();
    $_SESSION['accesso_negato'] = "Devi effettuare l'accesso per accedere";
    header("Location: ../Login");    
    exit();
}

// Controlla il timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['timeout_duration'])) {
    
    // La sessione è scaduta
    session_unset();     // Rimuove tutte le variabili di sessione
    session_destroy();   // Distrugge la sessione
    session_start();
    $_SESSION['sessione_scaduta'] = "Sessione scaduta, riaccedi";
    header("Location: ../Login");  //gestire il messaggio di errore
    exit();
}

     // Aggiorna il timestamp dell'ultima attività quando l'utente compie una azione
    $_SESSION['last_activity'] = time();

session_write_close()
?>
