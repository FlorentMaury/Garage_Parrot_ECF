<?php

if(
    !empty($_POST['customerName']) && 
    !empty($_POST['customerEmail']) && 
    !empty($_POST['customerMessage'])
    ) {

    // Variables.
    $customerName    = htmlspecialchars($_POST['customerName']);
    $customerEmail   = htmlspecialchars($_POST['customerEmail']);
    $customerMessage = htmlspecialchars($_POST['customerMessage']);
    $to              = 'contact@florent-maury.fr';
    $subject         = 'Demande de contact | Garage Parrot';

    $customerMessage = wordwrap($customerMessage, 70, "\r\n");

    $header = [
        "From" => $customerEmail,
        "Name" => $customerName
    ];

    // L'adresse email est-elle correcte ?
    if(!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?error=1&L\'adresse email est invalide.');
        exit();
    } else {
        mail($to, $subject, $customerMessage, $header);
    }

    header('location: index.php?page=home&askForContact=1');
    exit();

 } else if (
    !empty($_POST['customerDetailsName']) && 
    !empty($_POST['customerDetailsEmail']) && 
    !empty($_POST['customerDetailsMessage'])
    ) {

    // Variables.
    $customerName    = htmlspecialchars($_POST['customerDetailsName']);
    $customerEmail   = htmlspecialchars($_POST['customerDetailsEmail']);
    $customerMessage = htmlspecialchars($_POST['customerDetailsMessage']);
    $carId           = $GET_['id'];
    $to              = 'contact@florent-maury.fr';
    $subject         = 'Demande de contact | Garage Parrot';

    $customerMessage = wordwrap($customerMessage, 70, "\r\n");

    // Chercher le bon vehicule.
    $q = $bdd->prepare("SELECT car_brand FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carBrand = $q->fetchColumn();

    // Chercher le bon vehicule.
    $q = $bdd->prepare("SELECT car_type FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carType = $q->fetchColumn();

    // Chercher le bon vehicule.
    $q = $bdd->prepare("SELECT car_price FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carPrice = $q->fetchColumn();

    $header = [
        "From" => $customerEmail,
        "Name" => $customerName,
        "Car"  => $carBrand. $carType. $carPrice
    ];

    // L'adresse email est-elle correcte ?
    if(!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?error=1&L\'adresse email est invalide.');
        exit();
    } else {
        mail($to, $subject, $customerMessage, $header);
    }

    header('location: index.php?page=home&askForDetails=1');
    exit();

 } else {
    header('location: index.php?error=1&Veuillez rédiger une demande.');
 }

?>