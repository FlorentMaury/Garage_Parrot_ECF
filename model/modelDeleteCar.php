<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/modelConnectionDB.php');

    $r = $bdd->prepare("SELECT car_img_face FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgFace = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgFace);

    $r = $bdd->prepare("SELECT car_img_side FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgSide = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgSide);

    $r = $bdd->prepare("SELECT car_img_inside FROM `cars` WHERE id = ?");
    $r->execute([$id]);
    $imgInside = $r->fetchColumn();
    unlink('../public/assets/cars/'.$imgInside);

    $req = $bdd->prepare('DELETE FROM cars WHERE id = ?');
    $req->execute([$id]);

    header('location: ../index.php?page=dashboard&deletedCar=1');

    exit();
}

?>