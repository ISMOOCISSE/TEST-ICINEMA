function getTimer(heureFin) {
  // Conversion de l'heure de fin en un objet Date
  var dateFin = new Date();
  var heureMinute = heureFin.split(':');
  dateFin.setHours(parseInt(heureMinute[0]), parseInt(heureMinute[1]), 0, 0);

  // Fonction pour mettre à jour le minuteur toutes les secondes
  function updateTimer() {
    // Calcul de la différence entre l'heure de fin et l'heure actuelle
    var difference = Math.floor((dateFin - new Date()) / 1000);
    var heures = Math.floor(difference / 7200);
    var minutes = Math.floor((difference % 3600) / 60);
    var secondes = Math.floor(difference % 60);
    // Mise à jour du paragraphe avec le temps restant
    var timer = document.getElementById("timer");
    timer.innerHTML = "( Validité du Ticket: 1H30min )";

    // Si le temps est écoulé, arrêter la mise à jour du minuteur
    if (difference <= 0) {
      clearInterval(intervalId);
      document.querySelector('.messageTicket').innerText = "Durée du film: 1H30min";
      timer.innerHTML = "Durée du film: 1H30min";
    }
  }

  // Appel initial à la fonction de mise à jour du minuteur
  updateTimer();

  // Mise à jour du minuteur toutes les secondes
  var intervalId = setInterval(updateTimer, 1000);
}
