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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $sql = "INSERT INTO reservations (date, heure, nom, email) VALUES ('$date', '$heure', '$nom', '$email')";

    if ($connexion->query($sql) === TRUE) {
        echo "Réservation réussie !";
    } else {
        echo "Erreur : " . $sql . "<br>" . $connexion->error;
    }

    $connexion->close();
}
?>
