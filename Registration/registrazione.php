<?php
session_start();
require_once '../config.php';

try {
    // Verifica che il modulo sia stato inviato
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera i dati dal modulo
        $nome = $conn->real_escape_string($_POST['name']);
        $cognome = $conn->real_escape_string($_POST['surname']);
        $email = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['pwd']); // Consiglio di usare password_hash()

        // Gestione immagine
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            // Controlla le dimensioni del file (massimo 64 kB)
            $maxSize = 64 * 1024; // 64 kB in byte
            if ($_FILES['img']['size'] > $maxSize) {
                $_SESSION['registrazione_errore_foto'] = "Errore: foto inserita troppo grande (max 64kB)";
                header("Location: index.php");
                exit();
            }

            // Leggi il contenuto del file
            $imageData = file_get_contents($_FILES['img']['tmp_name']);
            $imageData = $conn->real_escape_string($imageData); // Escapa il contenuto per il DB
        } else {
            $imageData = null; // Nessuna immagine caricata
        }

        // Inserisci i dati nella tabella
        $sql = "INSERT INTO utenti (Nome, Cognome, Email, Psw, Img_Profilo)
                VALUES ('$nome', '$cognome', '$email', '$password', " . ($imageData ? "'$imageData'" : "NULL") . ")";

        // Esegui la query
        $conn->query($sql);

        // Se l'inserimento è riuscito
        $_SESSION['registrazione_successo'] = "Registrazione effettuata con successo";
        header("Location: index.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    // Gestione dell'errore di chiave duplicata
    if ($e->getCode() === 1062) { // 1062 è il codice per "Duplicate Entry"
        $_SESSION['registrazione_errore'] = "Errore: l'email è già registrata nel sistema.";
    } else {
        // Per altri errori
        $_SESSION['registrazione_errore_vario'] = "Errore durante la registrazione: tutti i campi sono obbligatori " ;
    }
    header("Location: index.php");
    exit();
} finally {
    // Chiude la connessione al database
    $conn->close();
}
?>