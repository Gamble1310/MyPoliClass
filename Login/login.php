<?php
//implemantare con il config.php

session_start();

    // Parametri ricevuti dal form
    $username = $_POST['username'];
    $password_utente = $_POST['pwd'];


    // Connessione al database
    $dbhost = "localhost";
    $dbname = "MyPoliClassDB";
    $dbuser = "root";
    $dbpassword = "";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    
    $sql1 = "SELECT * FROM utenti WHERE Email = ? AND Psw = ?";
    $stmt = $mysqli->prepare($sql1);
    $stmt->bind_param("ss", $username, $password_utente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifica se l'utente trovato è l'amministratore specifico
        if ($row['Email'] === 'admin@poliba.it' && $row['Psw'] === 'admin') {

            $_SESSION['last_activity'] = time(); // Salva il timestamp dell'ultima attività
            $_SESSION['timeout_duration'] = 1800; // Timeout in secondi (30 minuti)

            $_SESSION['username'] = $username;
            header("Location: ../Registration/index.php");       
        }
        else {

            $_SESSION['last_activity'] = time(); // Salva il timestamp dell'ultima attività
            $_SESSION['timeout_duration'] = 900; // Timeout in secondi (15 minuti)

            //salvo nella sessione l'username
            $_SESSION['username'] = $username;

            //USERNAMELOGIN 
            $_SESSION['usernameLogin'] = $username;

            //prendo l'immagine del profilo (serve solo quando il login è effettuato nell'effettivo nella WebApp) DA VEDERE
            $_SESSION['icon'] = $row['Img_Profilo']; // Salva il BLOB nella sessione
            header("Location: ../Dashboard/index.php");
        }
    } else {
        $_SESSION['errore_login'] = "Credenziali errate, riprova";
        header("Location: index.php");
    } 
        
    $stmt->close();     
    $mysqli->close();
    
?>
