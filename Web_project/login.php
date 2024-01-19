<?php
session_start();
    if (isset($_SESSION['username'])){
        header("location: ./homepage.php?error=alreadylogged");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php require_once 'header.php'?>

        <div id="div_login">
            <h1 id="titolo_login">LOGIN</h1>
            <p>Inserire nome utente e password: </p>
        </div>

        <form action="includes/login.inc.php" method="post">
            <div id="form_login">
                <input type="text" name="username" placeholder="Inserisci username o email">
                <br><br>
                <input type="password" name="password" placeholder="Inserisci la tua password">
                <br><br>
                <button type="submit" name="submit">Accedi</button>
            </div>

            <div id="registrati_ora">
                <p style='display: inline'>Non sei ancora registrato?</p>
                <a href="./registration.php">Registrati ora</a>
            </div>
        </form>
        
        <!-- Gestione errori php -->
        <div id="messaggi_errori_login">
        <?php
            if (isset($_GET['error'])) {
                if($_GET['error'] == 'emptyinput'){
                    echo '<p>Riempi tutti i campi!</p>';
                }
                if($_GET['error'] == 'wronglogin'){
                    echo '<p>Utente non esistente!</p>';
                }
                if($_GET['error'] == 'incorrectpassword'){
                    echo '<p>La mail o la password non è corretta!</p>';
                }
            }
        ?>

        <?php require_once 'footer.php'?>

    </body>
</html>