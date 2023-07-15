<?php
// verifier si un tiket existe pour l'utilisateur co
include('connect-db.php');
// session_start();
$message = '<p></p>';
$fin = '00:00';
$ticketValide = false;

if (isset($_SESSION['id'])) {
    $id_client = $_SESSION['id']; // Remplacer 1 par l'ID du client connecté (peut être récupéré depuis la session par exemple)
    


    // Vérification si le client a déjà un ticket
    $resultat = mysqli_query($link, "SELECT * FROM ticket WHERE id_client = $id_client");
    if (mysqli_num_rows($resultat) == 0) {
        // Si le client n'a pas de ticket
        $message = "<p class='messageTicket' >Vous n'avez pas de ticket</p>";
    } else {
        $ticket = mysqli_fetch_assoc($resultat);
        if (strtotime($ticket['heure_fin']) < time()) {
            // Si la date de fin est déjà passée
            $message = "<p class='messageTicket'>Durée du film: 1H 30 min</p>";
            
        } else {
            // si le ticket existe
            $message = "<p class='messageTicket' >Vous avez dejà acheter un ticket<br>continuer de regarder le film <br><br> <span id=timer> ( Validité du Ticket: 1h27min )</span></p>";
            $fin =  explode(' ',$ticket['heure_fin'])[1];
            $ticketValide = true;
        }
    }
}
