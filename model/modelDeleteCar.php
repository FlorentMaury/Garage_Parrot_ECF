<?php

// Demande de suppression d'un véhicule.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/modelConnectionDB.php');

    // Suppression de l'image de face du véhicule du serveur.
    $r = $bdd->prepare("SELECT car_img_face FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgFace = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgFace);

    // Suppression de l'image de profil du véhicule du serveur.
    $r = $bdd->prepare("SELECT car_img_side FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgSide = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgSide);

    // Suppression de l'image de l'intérieur du véhicule du serveur.
    $r = $bdd->prepare("SELECT car_img_inside FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgInside = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgInside);

    // Suppression des informations du véhicule de la base de donnée.
    $req = $bdd->prepare('DELETE FROM cars WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard&deletedCar=1');
    exit();
}

?>