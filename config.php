<?php
    // Parametri di configurazione del database
    $servername = "mysql";
    $username = "root";
    $password = "root";
    $dbname = "MyPoliClassDB";

    // Creazione della connessione
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controlla la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
?>