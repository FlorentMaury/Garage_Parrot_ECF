<?php

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordTwo'])) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $email       = htmlspecialchars($_POST['email']);
    $password    = htmlspecialchars($_POST['password']);
    $passwordTwo = htmlspecialchars($_POST['passwordTwo']);

    // Les mots de passe sont-ils identiques ?
    if($password != $passwordTwo) {
        header('location: index.php?error=1&message=Les mots de passe ne sont pas identiques.');
        exit();
    }

    // L'adresse email est-elle correcte ?
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?error=1&L\'adresse email est invalide.');
        exit();
    }

    // L'adresse email est-elle en doublon ?
    $req = $bdd->prepare('SELECT COUNT(*) as numberEmail FROM user WHERE email = ?');
    $req->execute([$email]);

    while($emailVerification = $req->fetch()) {
        if($emailVerification['numberEmail'] != 0) {
            header('location: index.php?page=dashboard&error=1&message=Cette adresse e-mail est déjà utilisée.');
            exit();
        }
    }

    // Chiffrement du mot de passe.
    $password = "bx1".sha1($password ."456")."123";

    // Secret.
    $secret = sha1($email).time();
    $secret = sha1($secret).time();

    // Ajouter un utilisateur.
    $req = $bdd->prepare('INSERT INTO user(email, password, secret) VALUES(?, ?, ?)');
    $req->execute([$email, $password, $secret]);

    header('location: index.php?page=dashboard&success=1');
    exit();

 }

?>