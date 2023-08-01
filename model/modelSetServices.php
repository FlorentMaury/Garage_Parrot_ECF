<?php

if(
    !empty($_POST['service']) && 
    !empty($_POST['included']) && 
    !empty($_POST['price'])
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $serviceId = htmlspecialchars($_POST['service']);
    $included  = htmlspecialchars($_POST['included']);
    $price     = htmlspecialchars($_POST['price']);

    // Modifier un service.
    $q = $bdd->prepare("SELECT service_name FROM `service` WHERE id = ?");
    $q->execute([$serviceId]);
    $serviceName = $q->fetchColumn();

    // Modifier un service.
    $req = $bdd->prepare('UPDATE service SET service_name = ?, included = ?, price = ? WHERE id = ?');
    $req->execute([$serviceName, $included, $price, $serviceId]);

    

    header('location: index.php?page=dashboard&modifyService=1');
    exit();

 }

?>