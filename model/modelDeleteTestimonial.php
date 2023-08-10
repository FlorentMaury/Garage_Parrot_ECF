<?php

// Suppression d'un témoignage.
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/modelConnectionDB.php');

    // Suppression du témoignage de la base de données.
    $req = $bdd->prepare('DELETE FROM testimonials WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard&deletedTestimonial=1');
    exit();
}

?>