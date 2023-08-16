<?php

// Connexion à la base de données.
require('modelConnectionDB.php'); 

// Vérification si les filtres ont étés modifiés.
if(isset($_POST["action"])) {

    // Demande générale des véhicules dans la base de données.
    $query = "SELECT * FROM cars WHERE id > 0";

    // Filtrage en fonction du prix.
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
        // Concaténation de la requête générale avec le filtre de prix.
        $query .= " AND car_price BETWEEN ".$_POST["minimum_price"]." AND ".$_POST["maximum_price"]." ";
    }

    // Filtrage en fonction du kilométrage.
    if(isset($_POST["minimum_km"], $_POST["maximum_km"]) | !empty($_POST["minimum_km"]) && !empty($_POST["maximum_km"])) {
        // Concaténation de la requête générale avec le filtre du kilométrage.
        $query .= " AND car_km BETWEEN ".$_POST["minimum_km"]." AND ".$_POST["maximum_km"]." ";
        print_r($_POST["maximum_km"]);
    }

    // Filtrage en fonction de l'année.
    if(isset($_POST["minimum_year"], $_POST["maximum_year"]) && !empty($_POST["minimum_year"]) && !empty($_POST["maximum_year"])) {
        // Concaténation de la requête générale avec le filtre de l'année.
        $query .= " AND car_year BETWEEN ".$_POST["minimum_year"]." AND ".$_POST["maximum_year"]." ";
    }
        
    // Récuperation de la requête finale.
    $statement = $bdd->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';

    // Vérification des résultats effectifs.
    if($total_row > 0) {

        // Création d'une carte Bootstrap et d'une colonne par résultat.
        foreach($result as $row) {
        $output .= '
        <div class="col">
        <div class="card shadow-sm w-100 h-100" >                        
            <img src="./public/assets/cars/'.$row["car_img_face"].'" alt="Photo voiture" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">' .$row["car_brand"] .'</h5>
                <h6 class="card-subtitle text-muted">' .$row["car_type"] .'</h6>
                <p class="card-text">
                    <ul>
                        <li>' .$row["car_km"] .' Km</li>
                        <li>' .$row["car_year"] .'</li>
                        <li>' .$row["car_price"] .' €</li>
                    </ul>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#more' .$row["id"] .'">Détails</button>

                </p>
            </div>

        </div>
    </div>
            ';
        }
    } else {
        // Si la requête ne retourne rien.
        $output = '<h3>Aucun résultat</h3>';
    }

    // Contenu du résultat de la requête finale.
    echo $output;
}

?>

