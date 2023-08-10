<?php
    
    // Sppression de la session et des cookies.

    // session_start();   // Initialiser
    session_unset();   // Désactiver
    session_destroy(); // Détruire

    setcookie('auth', '', time() - 1);
    header('location: index.php?page=home&logout=1');
    exit();
?>