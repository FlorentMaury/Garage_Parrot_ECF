<?php

if(
    !empty($_POST['carBrand']) && 
    !empty($_POST['carType']) && 
    !empty($_POST['carDate']) && 
    !empty($_POST['carPrice']) && 
    !empty($_POST['carKm']) && 
    isset($_FILES['carImg'])
    ) {

    // Connexion à la base de données.
    require('./model/modelConnectionDB.php');

    // Variables.
    $carBrand = htmlspecialchars($_POST['carBrand']);
    $carType  = htmlspecialchars($_POST['carType']);
    $carDate  = htmlspecialchars($_POST['carDate']);
    $carPrice = htmlspecialchars($_POST['carPrice']);
    $carKm    = htmlspecialchars($_POST['carKm']);  
    $imgTmpName = $_FILES['carImg']['tmp_name'];
    $imgName    = $_FILES['carImg']['name'];
    $imgSize    = $_FILES['carImg']['size'];
    $imgError   = $_FILES['carImg']['error'];


    $tabExtension = explode('.', $imgName);
$extension = strtolower(end($tabExtension));
//Tableau des extensions que l'on accepte
$extensions = ['jpg', 'png', 'jpeg'];
//Taille max que l'on accepte
$maxSize = 50000000;
if(in_array($extension, $extensions) && $imgSize <= $maxSize && $imgError == 0){
    $uniqueName = uniqid('', true);
    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
    $carImg = $uniqueName.".".$extension;
    //$file = 5f586bf96dcd38.73540086.jpg
    move_uploaded_file($imgTmpName, './public/assets/cars/'.$carImg);

    // Ajouter un véhicule.
    $req = $bdd->prepare('INSERT INTO cars(car_brand, car_type, car_year, car_price, car_km, car_img) VALUES(?, ?, ?, ?, ?, ?)');
    $req->execute([$carBrand, $carType, $carDate, $carPrice, $carKm, $carImg]);
echo "Image enregistrée";
}
else{
    echo "Une erreur est survenue";
}
    header('location: index.php?page=dashboard&addNewCar=1');
    exit();

 }

?>