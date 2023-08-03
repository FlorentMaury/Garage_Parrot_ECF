<?php

if(
    !empty($_POST['testimonialContent']) && 
    !empty($_POST['customerNote']) && 
    !empty($_POST['customer'])
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $testimonialContent = htmlspecialchars($_POST['testimonialContent']);
    $customer           = htmlspecialchars($_POST['customer']);
    $customerNote       = htmlspecialchars($_POST['customerNote']);
    $writer             = $_SESSION['email'];
    $authorized         = 1;

    // Modifier un service.
    $req = $bdd->prepare('INSERT INTO testimonials(testimonial, note, client, writer, authorized) VALUES(?, ?, ?, ?, ?)');
    $req->execute([$testimonialContent,$customerNote, $customer, $writer, $authorized]);

    header('location: index.php?page=dashboard&addNewTestimonial=1');
    exit();

 }


if(
    !empty($_POST['testimonialContentClient']) && 
    !empty($_POST['customerNoteClient']) && 
    !empty($_POST['customerClient'])
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $testimonialContent = htmlspecialchars($_POST['testimonialContentClient']);
    $customer           = htmlspecialchars($_POST['customerClient']);
    $customerNote       = htmlspecialchars($_POST['customerNoteClient']);
    $authorized         = 0;

    // Modifier un service.
    $req = $bdd->prepare('INSERT INTO testimonials(testimonial, note, client, authorized) VALUES(?, ?, ?, ?)');
    $req->execute([$testimonialContent,$customerNote, $customer, $authorized]);

    header('location: index.php?page=dashboard&addNewTestimonial=1');
    exit();

 }

?>