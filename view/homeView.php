<?php

    $title = 'Accueil';

    ob_start();

?>


<!-- LES VOITURES -->



<div class="container my-4">
    <h2 id="cars">Nos véhicules</h2>

    <p class="fa-lg">Price:</p>

    <label for="customRange" class="form-label">Min</label>
    <input type="range" class="form-range" value="80" min="0" max="3000" id="customRange" autocompleted="">

    <p id="min-val">Current: 87$</p>

    <label for="customRange2" class="form-label">Max</label>
    <input type="range" class="form-range" value="120" min="1000" max="10000" id="customRange2" autocompleted="">

    <p id="max-val">Current: 108$</p>


    <div class="row">
        <div class="col-md-4 col-sm-6">
        <div class="card">
        <img src="./public/assets/kangoo.jpg" alt="kangoo" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">RENAULT Kangoo</h5>
                <h6 class="card-subtitle text-muted">Phase 2 1.5 DCI 90 LIFE</h6>
                <p class="card-text">
                    <ul>
                        <li>125000 km</li>
                        <li>5 portes</li>
                        <li>4500 €</li>
                    </ul>
                    <button class="btn btn-dark">Détails</button>
                </p>
            </div>
    </div>
        </div>
        <div class="col-md-4 col-sm-6">
        <div class="card">
        <img src="./public/assets/kangoo.jpg" alt="kangoo" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">RENAULT Kangoo</h5>
                <h6 class="card-subtitle text-muted">Phase 2 1.5 DCI 90 LIFE</h6>
                <p class="card-text">
                    <ul>
                        <li>125000 km</li>
                        <li>5 portes</li>
                        <li>4500 €</li>
                    </ul>
                    <button class="btn btn-dark">Détails</button>
                </p>
            </div>
    </div>
        </div>
    </div>
</div>


<?php
            while($car = $cars->fetch()) {
                ?>
                    <div>
                        <p scope="row"><?= $car['car_brand'] ?></p>
                        <p><?= $car['car_price'] ?> €</p>
                        <img src="<?= $car['car_img'] ?>"></img>
                    </div>
                <?php
                }
            ?>

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