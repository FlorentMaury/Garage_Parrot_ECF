<?php

// Vérification du formulaire de demande de contact.
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

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $customerMessage = wordwrap($customerMessage, 70, "\r\n");

    // Personnalisation du conatenu en fonction des variables.
    $header = [
        "From" => $customerEmail,
        "Name" => $customerName
    ];

    // L'adresse email est-elle correcte ?
    if(!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?page=home&error=1&L\'adresse email est invalide.');
        exit();
    } else {
        mail($to, $subject, $customerMessage, $header);
    }
    // Validation de la demande.
    header('location: index.php?page=home&askForContact=1');
    exit();


// Demande de contact pour un véhicule spécifique. 
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

    // Chercher la bonne marque du vehicule.
    $q = $bdd->prepare("SELECT car_brand FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carBrand = $q->fetchColumn();

    // Chercher le bon modèle de vehicule.
    $q = $bdd->prepare("SELECT car_type FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carType = $q->fetchColumn();

    // Chercher le bon prix vehicule.
    $q = $bdd->prepare("SELECT car_price FROM `cars` WHERE id = ?");
    $q->execute([$serviceId]);
    $carPrice = $q->fetchColumn();

    // Personnalisation du contenu du message en fonction des variables.
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
    // Validation du message.
    header('location: index.php?page=home&askForDetails=1');
    exit();

 } else {
    // Si rien n'est renseigné.
    header('location: index.php?error=1&Veuillez rédiger une demande.');
 }

?>