<?php
// Inizia la sessione
session_start();

// Distrugge tutte le variabili di sessione
session_unset();

// Distrugge la sessione
session_destroy();

// Reindirizza alla pagina Login.php con un messaggio
session_start();
$_SESSION['logout'] = "Logout effettuato, arrivederci";
header("Location: Login/index.php");
exit();
?>