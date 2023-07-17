<?php

    $title = 'Accueil';

    ob_start();

    var_dump($_SESSION);

?>


<!-- LES VOITURES -->

<div class="container my-4">
    <h2>Nos véhicules</h2>
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


<!-- LES SERVICES -->

<div class="container my-4">
    <h2>Nos services</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col" colspan="2">Prestations</th>
                <th scope="col">Prix</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Basique</th>
                <td colspan="2">
                    <p>Vidange huile moteur</p>
                    <p>Changement des filtres</p>
                </td>
                <td>299 €</td>
            </tr>
            <tr>
                <th scope="row">Confort</th>
                <td colspan="2">
                <p>Vidange huile moteur</p>
                    <p>Changement des filtres</p>
                    <p>Changement liquides de refroidissement</p>
                    <p>Changement du liquide de frein</p>
                </td>
                <td>499 €</td>
            </tr>
            <tr>
                <th scope="row">Premium</th>
                <td colspan="2">
                <p>Vidange huile moteur</p>
                    <p>Changement des filtres</p>
                    <p>Changement liquides de refroidissement</p>
                    <p>Changement du liquide de frein</p>
                    <p>Vidange boîte de vitesse</p>
                </td>
                <td>899 €</td>
            </tr>
            <tr>
                <th scope="row">Climatisation</th>
                <td colspan="2">
                <p>Recharge climatisation</p>
                </td>
                <td>59 €</td>
            </tr>
            <tr>
                <th scope="row">Pneumatiques</th>
                <td colspan="2">
                <p>Changement pneus (par deux)</p>
                </td>
                <td>48 €*</td>
            </tr>
        </tbody>

    </table>

<p class="text-muted">* Prix du pneu non-inclus.</p>
</div>

<!-- FORMULAIRE DE CONTACT -->


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
            <form method="POST" action="index.php">

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