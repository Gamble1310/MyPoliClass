<!DOCTYPE html>
<html lang="it">

<head>
    <title>MyPoliClass</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link all'icona della pagina accanto al titolo -->
    <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

    <!-- Link ai file dell'estetica-->
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Login/login.css">
</head>

<body>

    <div class="login">
        <div class="loginform">
            <form action="login.php" method="POST">
                <legend>Inserire le credenziali di Esse3 per accedere alla piattaforma</legend>
                <fieldset>
                    <span><label>Nome utente</label><br>
                    <input type="text" id="username" name="username" required autofocus></span><br>
                    <span><label>Password</label><br>
                    <input type="password" id="pwd" name="pwd" required></span><br><br>
                    <input type="submit" value="Accedi"><br><br>

                    <!-- OTTIMIZZARE I MESSAGGI DI ERRORE CON UNO SWITCH    -->

                    <?php
                        // Mostra il messaggio di logout, se esiste
                        session_start();
                        if (isset($_SESSION['logout'])) {
                            echo "<p style='color: green; font-size: 14px; margin-top: 10px;'>".$_SESSION['logout']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['logout']);
                        }
                        // Chiudi la sessione
                        session_write_close();

                    ?>

                    <?php
                        // Mostra il messaggio di sessione scaduta, se esiste
                        session_start();
                        if (isset($_SESSION['sessione_scaduta'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['sessione_scaduta']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['sessione_scaduta']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>

                    <?php
                        // Mostra il messaggio di errore login, se esiste
                        session_start();    
                        if (isset($_SESSION['errore_login'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['errore_login']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['errore_login']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>

                    <?php
                        // Mostra il messaggio di sessione scaduta, se esiste
                        session_start();
                        if (isset($_SESSION['accesso_negato'])) {
                            echo "<p style='color: red; font-size: 14px; margin-top: 10px;'>".$_SESSION['accesso_negato']."</p>";
                            // Rimuovi il messaggio dopo averlo mostrato
                            unset($_SESSION['accesso_negato']);
                        }
                        // Chiudi la sessione
                        session_write_close();
                    ?>
                       			 

                </fieldset>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
</body>

</html>
