<?php
include('connect-db.php');
session_start();

// Récupération de l'ID du client
$id_client = $_SESSION['id']; // Remplacer 1 par l'ID du client connecté (peut être récupéré depuis la session par exemple)

// Vérification si le client a déjà un ticket
$resultat = mysqli_query($link, "SELECT * FROM ticket WHERE id_client = $id_client");
if (mysqli_num_rows($resultat) == 0) {
	// Si le client n'a pas de ticket, création d'un nouveau ticket
	$date_debut = date("Y-m-d H:i:s");
	$date_fin = date("Y-m-d H:i:s", strtotime($date_debut . " +1 hours 30 minute "));
	mysqli_query($link, "INSERT INTO ticket (id_client, heure_debut, heure_fin) VALUES ($id_client, '$date_debut', '$date_fin')");
	echo "Nouveau ticket créé : $date_debut - $date_fin";
	header("Location: ../acheter_ticket.php");
} else {
	// Si le client a déjà un ticket, vérification de la date de fin
	$ticket = mysqli_fetch_assoc($resultat);
	if (strtotime($ticket['heure_fin']) < time()) {
		// Si la date de fin est déjà passée, modification du ticket en ajoutant 3 heures à la date de fin
		$nouvelle_date_fin = date("Y-m-d H:i:s", strtotime(" +1 hours 30 minute "));
        $nouvelle_date_debut = date("Y-m-d H:i:s");
        mysqli_query($link, "UPDATE ticket SET heure_fin = '$nouvelle_date_fin', heure_debut = '$nouvelle_date_debut' WHERE id_client = $id_client");
		echo "Ticket modifié : " . $ticket['heure_debut'] . " - " . $nouvelle_date_fin;
		header("Location: ../acheter_ticket.php");
	
	} else {
		// Sinon, le ticket est toujours valide
		echo "Ticket toujours valide : " . $ticket['heure_debut'] . " - " . $ticket['heure_fin'];
		header("Location: ../acheter_ticket.php");
	}
}

// Fermeture de la connexion
mysqli_close($link);
?> 


 







 




