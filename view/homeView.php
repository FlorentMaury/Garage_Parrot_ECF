<?php

    $title = 'Accueil';

    ob_start();

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

<?php 

    $content = ob_get_clean();

    require('base.php');

?>