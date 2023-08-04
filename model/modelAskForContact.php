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

 }

?>