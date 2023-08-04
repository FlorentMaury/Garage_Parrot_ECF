<?php

if (isset($_GET['id'])) {
$id = $_GET['id'];

// Connexion à la base de données.
require('../model/modelConnectionDB.php');

$req = $bdd->prepare('DELETE FROM testimonials WHERE id = ?');
$req->execute([$id]);

header('location: ../index.php?page=dashboard&deletedTestimonial=1');
exit();
}

?>