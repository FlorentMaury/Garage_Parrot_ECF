<?php

// Vérification du formulaire d'ajout des véhicules.
if(
    !empty($_POST['carBrand']) && 
    !empty($_POST['carType']) && 
    !empty($_POST['carDate']) && 
    !empty($_POST['carPrice']) && 
    !empty($_POST['carKm']) && 
    !empty($_POST['carDesc']) && 
    isset($_FILES['carImg1']) &&
    isset($_FILES['carImg2']) &&
    isset($_FILES['carImg3']) 
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    // Pour les entrées textes (description, dates, etc...)
    $carBrand = htmlspecialchars($_POST['carBrand']);
    $carType  = htmlspecialchars($_POST['carType']);
    $carDate  = htmlspecialchars($_POST['carDate']);
    $carPrice = htmlspecialchars($_POST['carPrice']);
    $carKm    = htmlspecialchars($_POST['carKm']);  
    $carDesc  = htmlspecialchars($_POST['carDesc']);  


    // Pour les images du véhicule de face.
    $imgName1    = $_FILES['carImg1']['name'];
    $imgTmpName1 = $_FILES['carImg1']['tmp_name'];
    $imgSize1    = $_FILES['carImg1']['size'];
    $imgError1   = $_FILES['carImg1']['error'];

    // Pour les images du véhicule de profil.
    $imgTmpName2 = $_FILES['carImg2']['tmp_name'];
    $imgName2    = $_FILES['carImg2']['name'];
    $imgSize2    = $_FILES['carImg2']['size'];
    $imgError2   = $_FILES['carImg2']['error'];

    // Pour les images du véhicule de l'intérieur.
    $imgTmpName3 = $_FILES['carImg3']['tmp_name'];
    $imgName3    = $_FILES['carImg3']['name'];
    $imgSize3    = $_FILES['carImg3']['size'];
    $imgError3   = $_FILES['carImg3']['error'];

    // Récupérer l'extension des images.
    $tabExtension1 = explode('.', $imgName1);
    $tabExtension2 = explode('.', $imgName2);
    $tabExtension3 = explode('.', $imgName3);

    // Mise en minuscule de cette extendion.
    $extension1 = strtolower(end($tabExtension1));
    $extension2 = strtolower(end($tabExtension2));
    $extension3 = strtolower(end($tabExtension3));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image de face.
    if(in_array($extension1, $extensions) && $imgSize1 <= $maxSize && $imgError1 == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $carImg1 = $uniqId.".".$extension1;
        // Enregistrement de l'image dans le dossier 'cars'.
        move_uploaded_file($imgTmpName1, './public/assets/cars/'.$carImg1);

        // Vérification de l'extension et de la taille de l'image de profil.
        if(in_array($extension2, $extensions) && $imgSize2 <= $maxSize && $imgError2 == 0){
            $uniqId = uniqid('', true);
            // Création d'un uniqid.
            $carImg2 = $uniqId.".".$extension2;
            // Enregistrement de l'image dans le dossier 'cars'.
            move_uploaded_file($imgTmpName2, './public/assets/cars/'.$carImg2);

            // Vérification de l'extension et de la taille de l'image de l'intérieur.
            if(in_array($extension3, $extensions) && $imgSize3 <= $maxSize && $imgError3 == 0){
                $uniqId = uniqid('', true);
                // Création d'un uniqid
                $carImg3 = $uniqId.".".$extension3;
                // Enregistrement de l'image dans le dossier 'cars'.
                move_uploaded_file($imgTmpName3, './public/assets/cars/'.$carImg3);

                // Ajout d'un véhicule avec toutes les informations si toutes les images ont étés validées.
                $req = $bdd->prepare('INSERT INTO cars(car_brand, car_type, car_year, car_price, car_km, car_desc, car_img_face, car_img_side, car_img_inside) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $req->execute([$carBrand, $carType, $carDate, $carPrice, $carKm, $carDesc, $carImg1, $carImg2, $carImg3]);
                // Redirection avec message de validation.
                header('location: index.php?page=dashboard&addNewCar=1');
                exit();

            } else {
                header('location: index.php?page=dashboard&error=1&La photo de l\'intérieur du véhicule est invalide.');
            };

        } else {
            header('location: index.php?page=dashboard&error=1&La photo du profil du véhicule est invalide.');
        };

    } else {
        header('location: index.php?page=dashboard&error=1&La photo de face du véhicule est invalide.');
    };
};

?>