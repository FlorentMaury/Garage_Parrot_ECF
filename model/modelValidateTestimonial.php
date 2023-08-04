<?php

$id = $_GET['id'];
$authorized = 1;

// Connexion à la base de données.
require('../model/modelConnectionDB.php');

$req = $bdd->prepare('UPDATE testimonials SET authorized = ? WHERE id = ?');
$req->execute([$authorized, $id]);

header('location: ../index.php?page=dashboard&validateTestimonial=1');
exit();

 ?>