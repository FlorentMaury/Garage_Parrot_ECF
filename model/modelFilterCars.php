<?php

require('modelConnectionDB.php'); 

if(isset($_POST["action"])) {

    $query = "SELECT * FROM cars";

    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
        
        $min = $_POST["minimum_price"];
        $max = $_POST["maximum_price"];
        
        $query .= " WHERE car_price BETWEEN ".$_POST["minimum_price"]." AND ".$_POST["maximum_price"]."";
        print_r($query);
    }

    if(isset($_POST["minimum_km"], $_POST["maximum_km"]) && !empty($_POST["minimum_km"]) && !empty($_POST["maximum_km"])) {

        $min = $_POST["minimum_km"];
        $max = $_POST["maximum_km"];
        
        $query .= " AND car_km BETWEEN ".$_POST["minimum_km"]." AND ".$_POST["maximum_km"]."";
        print_r($query);
    }
        
    $statement = $bdd->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';

        if($total_row > 0) {

            foreach($result as $row) {
            $output .= '
                <div class="col-sm-4 col-lg-3 col-md-3">
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
                    <img src="image/'. $row['car_img_face'] .'" alt="" class="img-responsive" >
                    <p align="center"><strong><a href="#">'. $row['car_brand'] .'</a></strong></p>
                    <h4 style="text-align:center;" class="text-danger" >'. $row['car_price'] .'</h4>
                </div>

                </div>
                ';
            }
        } else {

         $output = '<h3>Aucun résultat</h3>';

        }

    echo $output;
}

?>