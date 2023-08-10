<?php

// Vérification du formulaire de modification du planning.
if(
    !empty($_POST['schedule']) 
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $dayId          = htmlspecialchars($_POST['schedule']);
    $morningStart   = htmlspecialchars($_POST['morningStart']);
    $morningEnd     = htmlspecialchars($_POST['morningEnd']);
    $afternoonStart = htmlspecialchars($_POST['afternoonStart']);
    $afternoonEnd   = htmlspecialchars($_POST['afternoonEnd']);

    // Sélection du jour.
    $r = $bdd->prepare("SELECT day FROM `schedule` WHERE id = ?");
    $r->execute([$dayId]);
    $dayName = $r->fetchColumn();

    // Remplacer une date vide par une information de fermeture du garage.
    if($morningStart == null) {
        $morningStart = 'Fermé';
    }

    // Modification un jour dans la base de données.
    $req = $bdd->prepare('UPDATE schedule SET day = ?, morning_start = ?, morning_end = ?, afternoon_start = ? , afternoon_end = ? WHERE id = ?');
    $req->execute([$dayName, $morningStart, $morningEnd, $afternoonStart, $afternoonEnd, $dayId]);

    // Redirection.
    header('location: index.php?page=dashboard&modifySchedule=1');
    exit();

 } 

?>