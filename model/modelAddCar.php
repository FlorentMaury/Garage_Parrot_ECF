<?php

if(
    !empty($_POST['carBrand']) && 
    !empty($_POST['carType']) && 
    !empty($_POST['carDate']) && 
    !empty($_POST['carPrice']) && 
    !empty($_POST['carKm']) && 
    !empty($_POST['carImg'])
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $carBrand = htmlspecialchars($_POST['carBrand']);
    $carType  = htmlspecialchars($_POST['carType']);
    $carDate  = htmlspecialchars($_POST['carDate']);
    $carPrice = htmlspecialchars($_POST['carPrice']);
    $carKm    = htmlspecialchars($_POST['carKm']);
    $carImg   = htmlspecialchars($_POST['carImg']);

    // Ajouter un véhicule.
    $req = $bdd->prepare('INSERT INTO cars(car_brand, car_type, car_year, car_price, car_km, car_img) VALUES(?, ?, ?, ?, ?, ?)');
    $req->execute([$carBrand, $carType, $carDate, $carPrice, $carKm, file_get_contents($carImg)]);

    

    header('location: index.php?page=dashboard&addNewCar=1');
    exit();

 }

?>