<?php
session_start();




if (isset($_POST['logout'])) {
    // Destruction de la session
    session_unset();
    session_destroy();
    // var_dump($_SESSION);
}

include('php/verification_ticket.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
    



<center>
    <a href="acheter_ticket.php">

    <button>
          <h1>CLIQUEZ ICI POUR ACHETER UN TICKET</h1>
    </button>


    </a>

    <h3>la base de donnée est dans le dossier !!! </h3>
    <h3>le PRIX DU TICKET EST A 800 XOF </h3>
</center>



</body>

<style>
        .messageTicket {
            color: white;
            white-space: nowrap;
            padding: 5px;
        }
    </style>
    <script src="script/timer.js"></script>
    <script>
        <?php echo " getTimer( ' $fin' )" ?>
    </script>
    
</html>