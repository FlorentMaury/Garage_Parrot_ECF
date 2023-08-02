<?php

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
    $carBrand = htmlspecialchars($_POST['carBrand']);
    $carType  = htmlspecialchars($_POST['carType']);
    $carDate  = htmlspecialchars($_POST['carDate']);
    $carPrice = htmlspecialchars($_POST['carPrice']);
    $carKm    = htmlspecialchars($_POST['carKm']);  
    $carDesc  = htmlspecialchars($_POST['carDesc']);  

    $imgName1    = $_FILES['carImg1']['name'];
    $imgTmpName1 = $_FILES['carImg1']['tmp_name'];
    $imgSize1    = $_FILES['carImg1']['size'];
    $imgError1   = $_FILES['carImg1']['error'];

    $imgTmpName2 = $_FILES['carImg2']['tmp_name'];
    $imgName2    = $_FILES['carImg2']['name'];
    $imgSize2    = $_FILES['carImg2']['size'];
    $imgError2   = $_FILES['carImg2']['error'];

    $imgTmpName3 = $_FILES['carImg3']['tmp_name'];
    $imgName3    = $_FILES['carImg3']['name'];
    $imgSize3    = $_FILES['carImg3']['size'];
    $imgError3   = $_FILES['carImg3']['error'];


    $tabExtension1 = explode('.', $imgName1);
    $tabExtension2 = explode('.', $imgName2);
    $tabExtension3 = explode('.', $imgName3);

    $extension1 = strtolower(end($tabExtension1));
    $extension2 = strtolower(end($tabExtension2));
    $extension3 = strtolower(end($tabExtension3));
    //Tableau des extensions que l'on accepte
    $extensions = ['jpg', 'png', 'jpeg'];
    //Taille max que l'on accepte
    $maxSize = 50000000;

    if(in_array($extension1, $extensions) && $imgSize1 <= $maxSize && $imgError1 == 0){
        $uniqId = uniqid('', true);
        //uniqid
        $carImg1 = $uniqId.".".$extension1;

        move_uploaded_file($imgTmpName1, './public/assets/cars/'.$carImg1);

        if(in_array($extension2, $extensions) && $imgSize2 <= $maxSize && $imgError2 == 0){
            $uniqId = uniqid('', true);
            //uniqid
            $carImg2 = $uniqId.".".$extension2;
    
            move_uploaded_file($imgTmpName2, './public/assets/cars/'.$carImg2);

            if(in_array($extension3, $extensions) && $imgSize3 <= $maxSize && $imgError3 == 0){
                $uniqId = uniqid('', true);
                //uniqid
                $carImg3 = $uniqId.".".$extension3;
        
                move_uploaded_file($imgTmpName3, './public/assets/cars/'.$carImg3);

                        // Ajouter un véhicule.
                        $req = $bdd->prepare('INSERT INTO cars(car_brand, car_type, car_year, car_price, car_km, car_desc, car_img_face, car_img_side, car_img_inside) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
                        $req->execute([$carBrand, $carType, $carDate, $carPrice, $carKm, $carDesc, $carImg1, $carImg2, $carImg3]);

                        header('location: index.php?page=dashboard&addNewCar=1');
                        exit();
            };
        };

    } else {

    echo "Une erreur est survenue";

    }
 }

?>