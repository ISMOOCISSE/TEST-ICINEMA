<?php 
session_start();
include('php/verification_ticket.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACHETER UN TICKET</title>
    <link rel="icon" href="img films/icon zodiak.png" sizes="12x12">
    
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>

  



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
    </style>

    <style>
        /* stylisons le design de la page du formulaire. */
        body {
            background: url(BACKGROUND\ FORM.png);
            background-color: black;
            background-size: cover;

            font-family: 'Questrial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            position: relative;
        }




        /* Stylisons le formulaire. */
        form {
            background: rgba(255, 255, 255, 0.251);
            padding: 3rem;
            margin-top: 100px;
            max-height: 95%;
            border-radius: 20px;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-top: 1px solid rgba(255, 255, 255, .3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            -moz-backdrop-filter: blur(10px);
            box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, .2);
            text-align: center;
        }



        /* Stylisons maintenant les textes. */
        img {
            width: 10vh;
        }

        p {
            color: white;
            font-weight: 500;
            opacity: .7;
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
        }

        a {
            text-decoration: none;
            color: #ddd;
            font-size: 16px;
            margin-bottom: 5px;
        }

        a:hover {
            text-shadow: 2px 2px 6px #00000040;
        }

        a:active {
            text-shadow: none;
        }


        /* stylisons les  aux inputs. */
        input {
            background: transparent;
            border: none;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-top: 1px solid rgba(255, 255, 255, .3);
            padding: 1rem;
            width: 200px;
            border-radius: 50px;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            -moz-backdrop-filter: blur(5px);
            box-shadow: 4px 4px 60px rgba(0, 0, 0, .2);
            color: white;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
            transition: all .3s;
            margin-bottom: 2em;
            font-family: 'Questrial', sans-serif;
        }



        /* Stylisons les interactions. */
        input:hover,
        input[type="text"]:focus,
        input[type="text"]:focus {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);

        }

        input[type="submit"] {
            margin-top: 5px;
            width: 150px;
            font-size: 1rem;
            cursor: pointer;
        }

        .valider:hover {
            background-color: rgba(150, 150, 0, 0.274);
        }

        .valider {
            background-color: rgba(150, 150, 0, 0.442);
        }

        .prix {
            background-color: rgba(3, 162, 3, 0.633);
        }

        .prix:hover {
            background-color: rgba(2, 90, 2, 0.641);
        }

        ::placeholder {
            color: #fff;
        }

        form{
            position: relative;
            left: 80vh;
        }
    </style>

    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js
"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- ACHETER TICKET --> 
    <center>
    
        <div class="container">
        
            <form action="php/add_ticket.php" method="POST">
                <img src="img films/Logo zodiak.png">
                <?php echo $message?>
                <a href="#"><input type="submit" value="acheter un ticket" class="valider" id="valider"></a><br>
             <a href="index.php" onclick="resetTimer()">Retour</a> 
                

            </form>


        </div>
    </center>







    




















<center>
    <h2 style="max-width:90%; color: white">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        NB: en cliquant sur acheter un ticket sa dois le rediriger sur le guichet de paiement CINETPAY avant d'enregistrer son ticket dans la base de donnée et lui 
        attribuer son temps de visionnage pour le film ( voir : php/add_ticket.php) 
    </h2>
</center>


    

<script>
var isTimerRunning = false; // Variable pour vérifier si le minuteur est en cours d'exécution
var intervalId; // Variable pour stocker l'ID de l'intervalle de mise à jour du minuteur

function startTimer() {
  if (isTimerRunning) {
    return; // Si le minuteur est déjà en cours d'exécution, sortir de la fonction
  }
  
  var startTime = localStorage.getItem('timerStartTime'); // Récupérer le temps de départ depuis le stockage local
  var delay = 3 * 60 * 1000; // Delai de 3 miniute pour acheter un ticket cinema

  // Vérifier si le temps de départ existe dans le stockage local
  if (!startTime) {
    startTime = new Date().getTime(); // Temps de départ en millisecondes
    localStorage.setItem('timerStartTime', startTime); // Stocker le temps de départ dans le stockage local
  }

  // Fonction pour mettre à jour le minuteur
  function updateTimer() {
    var currentTime = new Date().getTime(); // Temps actuel en millisecondes
    var elapsedTime = currentTime - startTime; // Temps écoulé depuis le départ
    var remainingTime = delay - elapsedTime; // Temps restant avant la redirection

    // Vérifier si le temps est écoulé
    if (remainingTime <= 0) {
      clearInterval(intervalId); // Arrêter la mise à jour du minuteur
      localStorage.removeItem('timerStartTime'); // Supprimer le temps de départ du stockage local
      window.location.href = "index.php"; // Rediriger vers une autre page
    }

    // Convertir le temps restant en heures, minutes et secondes
    var hours = Math.floor((remainingTime / 1000) / 3600);
    var minutes = Math.floor(((remainingTime / 1000) % 3600) / 60);
    var seconds = Math.floor(((remainingTime / 1000) % 3600) % 60);

    // Afficher le temps restant dans la console (à des fins de test)
    //  console.log("Temps restant : " + hours + " h " + minutes + " min " + seconds + " sec");
   }

  // Appel initial à la fonction de mise à jour du minuteur
  updateTimer();

  // Mise à jour du minuteur toutes les secondes
  intervalId = setInterval(updateTimer, 1000);
  
  isTimerRunning = true; // Définir le minuteur comme étant en cours d'exécution
}

// Réinitialiser le minuteur à zéro
function resetTimer() {
  clearInterval(intervalId); // Arrêter la mise à jour du minuteur
  localStorage.removeItem('timerStartTime'); // Supprimer le temps de départ du stockage local
  isTimerRunning = false; // Définir le minuteur comme étant arrêté
  // Vous pouvez également effectuer d'autres actions de réinitialisation si nécessaire
  
  console.log("Minuteur réinitialisé !");
}

// Démarrer le minuteur lorsque la page est chargée
window.addEventListener("load", startTimer);
</script>





    <style>
        .messageTicket{
            color: white;
            white-space: nowrap;
            padding: 5px;
        }
    </style>

<script src="script/timer.js"></script>
    <script>
        
        <?php echo " getTimer( ' $fin ' )" ?>
    </script>
    <script src="partage.js"></script>
</body>

</html>
