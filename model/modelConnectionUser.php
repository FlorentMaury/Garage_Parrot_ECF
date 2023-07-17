<?php

if(!empty($_POST['email']) && !empty($_POST['password'])) {


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

    while($emailVerification = $req->fetch()) {
        if($emailVerification['numberEmail'] != 1) {
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }

    // Connexion.
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute([$email]);

    while($user = $req->fetch()) {
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

            header('location: index.php?success=1');
            exit();
        } else {
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }
}

if(isset($_GET['success'])) {
    echo '<div class=\'container\'><p class="mt-4 fw-bold text-success">Connexion réalisée avec succès.</p></div>';
}
else if(isset($_GET['error']) && !empty($_GET['message'])) {
    echo '<div class=\'container\'><p class="mt-4 fw-bold text-error">'.htmlspecialchars($_GET['message']).'</p></div>';
} 
    
?>