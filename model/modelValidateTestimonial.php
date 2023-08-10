<?php

// Validation du témoignage.
$id = $_GET['id'];
$authorized = 1;

// Connexion à la base de données.
require('../model/modelConnectionDB.php');

// Valider le témoignage sur la base de données.
$req = $bdd->prepare('UPDATE testimonials SET authorized = ? WHERE id = ?');
$req->execute([$authorized, $id]);

// Redirection.
header('location: ../index.php?page=dashboard&validateTestimonial=1');
exit();

 ?>