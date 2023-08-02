<?php

if(
    !empty($_POST['schedule']) && 
    !empty($_POST['morningStart']) && 
    !empty($_POST['morningEnd']) &&
    !empty($_POST['afternoonStart']) && 
    !empty($_POST['afternoonEnd'])
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

    // Modifier un jour.
    $req = $bdd->prepare('UPDATE schedule SET day = ?, morning_start = ?, morning_end = ?, afternoon_start = ? , afternoon_end = ? WHERE id = ?');
    $req->execute([$dayName, $morningStart, $morningEnd, $afternoonStart, $afternoonEnd, $dayId]);

   
    header('location: index.php?page=dashboard&modifySchedule=1');
    exit();

 } 

?>