<?php

    // Mise en place de la session et des cookies.

    if(isset($_COOKIE['auth']) && !isset($_SESSION['connect'])) {
        // Connexion à la bdd
        require_once('modelConnectionDB.php');

        // Variables
        $secret = htmlspecialchars($_COOKIE['auth']);

        // Le secret existe-t-il ?
        $req = $bdd->prepare('SELECT COUNT(*) AS secretNumber FROM user WHERE secret = ?');
        $req->execute([$secret]);

        while($user = $req->fetch()) {
            if($user['secretNumber'] == 1) {
                // Lire ce qui concerne l'utilisateur
                $informations = $bdd->prepare('SELECT * FROM user WHERE secret = ?');
                $informations->execute([$secret]);

                while($userInformations = $informations->fetch()) {
                    $_SESSION['connect'] = 1;
                    $_SESSION['email']   = $userInformations['email'];
                    $_SESSION['id']      = $userInformations['id'];
                }
            }
        }
    }

    ?>