<?php

if(
    !empty($_POST['service']) && 
    !empty($_POST['included']) && 
    !empty($_POST['price'])
    ) {

    // Connexion à la base de données.
    $bdd = new PDO('mysql:host=localhost;dbname=garage_parrot;charset=utf8', 'root', '');


    // Variables.
    $service  = htmlspecialchars($_POST['service']);
    $included = htmlspecialchars($_POST['included']);
    $price    = htmlspecialchars($_POST['price']);

    // Ajouter un véhicule.
    $req = $bdd->prepare('UPDATE service(service, included, price) SET(?, ?, ?)');
    $req->execute([$service, $included, $price]);

    

    header('location: index.php?page=dashboard&modifyService=1');
    exit();

 }

?>