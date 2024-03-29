<?php
include_once './header.php';
require_once './connection.php';
require_once './includes/functions.inc.php';

if (!isset($_GET["eventID"]) || !is_numeric($_GET["eventID"])) {
    // reindirizza l'utente all'home se nell'url non c'è un evento valido
    header("location: ./homepage.php?error=eventdoesntexist");
    exit();
}
$eventID = $_GET["eventID"];
$eventData = getEventInfo($conn, $eventID);
if(!($eventData !== null)) {
    // reindirizza l'utente all'home se nell'url c'è un evento non esistente
    header("location: ./homepage.php?error=eventdoesntexist");
    exit();
}
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $eventData["nome_evento"]; ?></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="evento.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script src="./functions.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>
            window.onload = function(){
                document.getElementById('prenotazione').addEventListener("click", function() {
                    var eventID = <?php echo $eventID; ?>;
                    var userID = <?php echo $_SESSION["UID"]; ?>;
                    bookTicket(eventID, userID);
                });
            }
            
        </script>

    </head>

    <body>

        <!-- Creazione del box inclusi le informazioni dell'evento -->

        <div class="container-evento">
            <div class="box-evento">
                <div class="box-messaggio">
                    <form action="./homepage.php">
                            <button class="bottone-ritorno">Torna indietro</button>
                    </form>
                </div>
                <div id="locandina_evento">
                    <div class="image-container">
                        <img src="<?php echo $eventData["url_foto"]?>">
                    </div>
                </div>
                <div class="info-evento">
                    <div id="titolo_evento">
                        <h1><?php echo $eventData["nome_evento"]; ?></h1>
                    </div>

                    <div id="descrizione_evento">
                        <p><?php echo $eventData["info_evento"]; ?></p>
                    </div>

                    <div id="data_evento">
                        <p><?php echo $eventData["data_evento"]; ?></p>
                    </div>
                    <div class="button"> <!-- Il pulsante non permette la prenotazione qualora non si è prenotati -->
                        <?php if (isset($_SESSION['username'])){ ?>
    
                            <button id="prenotazione">Prenotati per l'evento</button>
                        <?php } 
                        else{ ?>
                            <form action="./login.php">
                                <button id="prenotazione">Accedi per prenotarti!</button>
                            </form> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
include_once './footer.php';
?>