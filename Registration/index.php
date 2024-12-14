
<html lang="it">

<!-- Verifica se la sessione è attiva tramite il file checksession, già qui apro la sessione -->
<?php
include '../checksession.php';
?>

<head>
    <title>MyPoliClass</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link all'icona della pagina accanto al titolo -->
    <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

    <!-- Link ai file dell'estetica-->
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Registration/registration.css">

    <!-- Aggiunta della rimozione sottolineatura in questa pagina per non avere conflitti -->
    <style>
        .logoutrec {
            text-decoration: none; /* Rimuove la sottolineatura */
            color: inherit; /* Mantiene il colore del testo corrente */
            font-size: 16px; /* Dimensione del testo */
            font-weight: bold; /* Grassetto per evidenziare il link (opzionale) */
        }
        .logoutrec:hover {
            color: blue; /* Cambia colore al passaggio del mouse (opzionale) */
        }
    </style>
</head>


<body>
    <div class="registration">
        <div class="registrationform">
            <form method="post" enctype="multipart/form-data" action="registrazione.php">
                <legend>Inserire le credenziali per creare un account:</legend>
                <fieldset>
                    <span><label>Nome</label><br>
                        <input type="text" id="name" name="name" required autofocus spellcheck="false"></span><br>
                    <span><label>Cognome</label><br>
                        <input type="text" id="surname" name="surname" required spellcheck="false"></span><br>
                    <span><label>Email</label><br>
                        <input type="text" id="username" name="username" required spellcheck="false"></span><br>
                    <span><label>Password</label><br>
                        <input type="password" id="pwd" name="pwd" required></span><br>
                    <span><label>Immagine profilo</label><br>
                        <input type="file" id="img" name="img" required></span><br><br>
                    <input type="submit" value="Registra"><br><br>

                    <span><a href="../Logout.php" class="logoutrec"> Logout </a> </span>

                     <!-- GESTIONE MESSAGGI -->
                     <?php
                        session_start();
                        // Mostra il messaggio di errore se inserita una foto che supera 64kB
                        if (isset($_SESSION['registrazione_errore_foto'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['registrazione_errore_foto']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['registrazione_errore_foto']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>

                    <?php
                        session_start();
                        // Mostra il messaggio di registrazione se effettuata correttamente
                        if (isset($_SESSION['registrazione_successo'])) {
                            echo "<p style='color: green; font-size: 14px; margin-top: 10px;'>".$_SESSION['registrazione_successo']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['registrazione_successo']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>

                    <?php
                        session_start();
                        // Mostra il messaggio di registrazione se effettuata correttamente
                        if (isset($_SESSION['registrazione_errore'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['registrazione_errore']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['registrazione_errore']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>     
                    <?php
                        session_start();
                        // Mostra il messaggio di registrazione se effettuata correttamente
                        if (isset($_SESSION['registrazione_errore_vario'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['registrazione_errore_vario']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['registrazione_errore_vario']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>    



                    </div>

                </fieldset>  
            </form>
        </div>
    </div>





    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
</body>

</html>