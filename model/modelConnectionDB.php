<?php

    // Connexion à la base de donnée : "garage_parrot".

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=garage_parrot;charset=utf8', 'root', '');
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    };

    $requete = $bdd->query('SELECT * FROM user');
    $schedule = $bdd->query('SELECT * FROM schedule');
    $service = $bdd->query('SELECT * FROM service');
?>