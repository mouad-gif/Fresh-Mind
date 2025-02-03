<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$nomBDD = "reservations_db";

// Créer une connexion
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBDD);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

$date = $_GET['date'];
$creneaux = [];

// Rechercher les créneaux déjà réservés
$sql = "SELECT heure FROM reservations WHERE date = '$date'";
$resultat = $connexion->query($sql);

$creneauxReserves = [];
while ($ligne = $resultat->fetch_assoc()) {
    $creneauxReserves[] = $ligne['heure'];
}

// Définir les créneaux horaires disponibles
$tousLesCreneaux = ['9h-10h', '10h-11h', '11h-12h', '13h-14h', '14h-15h', '15h-16h', '16h-17h', '17h-18h'];
$creneauxDisponibles = array_diff($tousLesCreneaux, $creneauxReserves);

echo json_encode(['creneaux' => $creneauxDisponibles]);

$connexion->close();
?>
