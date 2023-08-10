<?php

// Vérification du formulaire de connexion.
if(!empty($_POST['email']) && !empty($_POST['password']) && empty($_SESSION)) {

    // Sécurisation des variables.
    $email     = htmlspecialchars($_POST['email']);
    $password  = htmlspecialchars($_POST['password']);

    // L'adresse email est-elle correcte ?
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?error=1&Votre adresse email est invalide.');
        exit();
    }

    // Chiffrement du mot de passe.
    $password = "bx1".sha1($password ."456")."123";

    // L'adresse email est-elle bien utilisée ?
    $req = $bdd->prepare('SELECT COUNT(*) as numberEmail FROM user WHERE email = ?');
    $req->execute([$email]);

    // Si l'email n'est pas reconnu.
    while($emailVerification = $req->fetch()) {
        if($emailVerification['numberEmail'] != 1) {
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }

    // Connexion si le mot de passe est le bon.
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute([$email]);

    while($user = $req->fetch()) {
        // Si le mot de passe est le bon création d'une session..
        if($password == $user['password']) {
            $_SESSION['connect'] = 1;
            $_SESSION['email']   = $user['email'];
            $_SESSION['id']      = $user['id'];

            // Connexion auto par cookie.
            if(isset($_POST['auto'])) {
                setcookie('auth', $user['secret'], [
                    'expires' => time() + 365*24*3600, 
                    'path' => '/', 
                    'domain' => null, 
                    'secure' => false, 
                    'httponly' => true, 
                    'SameSite' => 'Strict',
                ]);
            } 
            // Validation de la connexion.
            header('location: index.php?connexion=1');
            exit();
        } else {
            // Erreur dans lee mot de passe.
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }
}
    
?>