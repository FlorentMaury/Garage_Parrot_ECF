<?php

    $title = 'Accueil';

    ob_start();

?>


<!-- LES VOITURES -->



<div class="container mt-5 my-4">
    <h2 class="pt-4" id="cars">Nos véhicules</h2>

    <p class="fa-lg">Price:</p>

    <label for="customRange" class="form-label">Min</label>
    <input type="range" class="form-range" value="80" min="0" max="3000" id="customRange" autocompleted="">

    <p id="min-val">Current: 87$</p>

    <label for="customRange2" class="form-label">Max</label>
    <input type="range" class="form-range" value="120" min="1000" max="10000" id="customRange2" autocompleted="">

    <p id="max-val">Current: 108$</p>
</div>



<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-4">

        <?php
            while($car = $cars->fetch()) {
        ?>

        <div class="col">
            <div class="card shadow-sm w-100 h-100" >                        
                <img src="<?= './public/assets/cars/'.$car['car_img_face'] ?>" alt="Photo voiture" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $car['car_brand'] ?></h5>
                    <h6 class="card-subtitle text-muted"><?= $car['car_type'] ?></h6>
                    <p class="card-text">
                        <ul>
                            <li><?= $car['car_km'] ?> Km</li>
                            <li><?= $car['car_year'] ?></li>
                            <li><?= $car['car_price'] ?> €</li>
                        </ul>
                        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#more<?= $car['id'] ?>">Détails</button>
                        <?php if(isset($_SESSION['connect'])) { ?>
                            <a href="" class="btn btn-outline-danger">Supprimer</a>
                        <?php } ?>
                    </p>
                </div>

            </div>
        </div>

        <!-- Modale -->

        <div class="modal fade" id="more<?= $car['id'] ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Titre de la modale -->
                    <div class="modal-header text-primary">
                        <h5 class="modal-title"><?= $car['car_brand'].' ' ?><?= $car['car_type'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Corps de la modale -->
                    <div class="modal-body">

                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="<?= './public/assets/cars/'.$car['car_img_face'] ?>" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="<?= './public/assets/cars/'.$car['car_img_side'] ?>" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="<?= './public/assets/cars/'.$car['car_img_inside'] ?>" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    

                        <p class="m-4"><?= $car['car_desc'] ?></p>
                        <p class="m-4"><?= $car['car_price'] ?></p>
                        <a href="#contact" class="btn">Reserver un essai</a>
                    </div>

                    <!-- Pied-de-page de la modale -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div> 

        <?php
            }
        ?>

    </div>
</div>

<!-- LES SERVICES -->

<div class="container my-4">
    <h2 id="services">Nos services</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Forfait</th>
                <th scope="col">Prestation</th>
                <th scope="col">Prix</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while($services = $service->fetch()) {
                ?>
                    <tr>
                        <td scope="row"><?= $services['service_name'] ?></td>
                        <td scope="row"><?= $services['included']; 
                            if($services['id'] == 4) {
                                echo' (*)';
                            } 
                            ?>
                        </td>
                        <td><?= $services['price'] ?> €</td>
                    </tr>
                <?php
                }
            ?>

        </tbody>
    </table>

    <p class="text-muted">* Prix du pneu non-inclu.</p>
</div>


<!-- FORMULAIRE DE CONTACT -->

<div class="container my-4">
    <h2 id="contact">Nous contacter</h2>
</div>


<!-- MODALE DE CONNECTION -->

<div class="modal fade" id="signIn" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">

            <!-- Titre de la modale -->
            <div class="modal-header">
                <h5 class="modal-title">Connectez-vous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <!-- Corps de la modale -->
            <form method="POST" action="index.php?page=home">

                <p class="form-floating m-2">
                    <input type="email" name="email" class="form-control" id="email" placeholder="dupont@email.com">
                    <label for="email">Email</label>
                </p>
                <p class="form-floating m-2">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
                    <label for="password">Mot de passe</label>
                </p>

                <p class="checkbox my-4">
                    <label>
                        <input type="checkbox" name="auto" value="remember-me"> Se souvenir de moi
                    </label>
                </p>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Connexion</button>
            </form>
        </div>
    </div>
</div>


<?php 

    $content = ob_get_clean();

    require('base.php');

?>