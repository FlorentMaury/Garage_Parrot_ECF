<?php

    // Modification du titre de la page.
    $title = 'Accueil';
    // Début d'enregistrement du HTML.
    ob_start();

?>


<!-- TEMOIGNAGES -->

<div class="my-5">

    <!-- Message de validation ou d'erreur -->
    <?php if(isset($_GET['logout'])) {
    echo '<p class="mt-4 fw-bold text-success">Vous êtes maintenant déconnecté !</p>';
    }
    else if(isset($_GET['error']) && !empty($_GET['message'])) {
    echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
    }
    ?>

    <!-- Présentation des témoignages clients. -->
    <h2 class="display-4 text-primary text-center" id="testimony">Ils parlent de nous</h2>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            <!-- Récupération des témoignages sur la base de données. -->
            <?php while($testimonial = $testimonials->fetch()) { ?>

                <div class="carousel-item active text-center">
                    <blockquote>
                        <p>"<?= $testimonial['testimonial'] ?>"</p>
                        <p><?= $testimonial['note'] ?> / 5</p>
                        <footer>— <cite><?= $testimonial['client'] ?></cite> —</footer>
                    </blockquote>
                </div>

            <?php } ?>

            </div>

        <!-- Flèches de navigation du carousel. -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only text-dark">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only text-dark">Suivant</span>
        </a>
    </div>
</div>


<!-- Présentation des véhicules. -->
<h2 class="pt-5 display-4 text-primary text-center" id="cars">Nos véhicules</h2>

<!-- Outils de filtre des véhicules. -->
<div class="d-flex flex-column align-items-center justify-content-md-between flex-md-row">

    <!-- Outil de filtre 'prix'. -->
    <div class="list-group w-25">
        <h3>Prix</h3>
        <input type="hidden" id="hidden_minimum_price" value="0" />
        <input type="hidden" id="hidden_maximum_price" value="30000" />
        <p id="price_show">0 - 30000</p>
        <div id="price_range"></div>
    </div>

    <!-- Outil de filtre 'kilométrage'. -->
    <div class="list-group w-25">
        <h3>Kilométrage</h3>
        <input type="hidden" id="hidden_minimum_km" value="0" />
        <input type="hidden" id="hidden_maximum_km" value="300000" />
        <p id="km_show">0 - 300000</p>
        <div id="km_range"></div>
    </div>     

    <!-- Outil de filtre 'année'. -->
    <div class="list-group w-25">
        <h3>Année</h3>
        <input type="hidden" id="hidden_minimum_year" value="0" />
        <input type="hidden" id="hidden_maximum_year" value="2023" />
        <p id="year_show">1980 - 2023</p>
        <div id="year_range"></div>
    </div> 

</div>

<!-- Présentation des véhicules via 'modelFilterCars'. -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-4 filter_data">
</div>



<!-- Création d'une modale pour chaque véhicule affiché. -->
<?php
    while($car = $cars->fetch()) {
?>

<div class="modal fade" id="more<?= $car['id'] ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Titre de la modale. -->
            <div class="modal-header text-primary">
                <h4 class="modal-title"><?= $car['car_brand'].' ' ?><?= $car['car_type'] ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Corps de la modale. -->
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
                <p class="m-4"><?= $car['car_price'] ?> €</p>
                <p class="m-4"><?= $car['car_km'] ?> km</p>

                <h4 class="text-primary">En savoir plus sur ce véhicule</h4>
                <!-- Formulaire de demande de contact pour un véhicule en particulier.  -->
                <form method="POST" action="index.php?page=home&car=<?= $car['id'] ?>">

                    <!-- Message de validation ou d'erreur. -->
                    <?php if(isset($_GET['askForDetails'])) {
                    echo '<p class="mt-4 fw-bold text-success">Demande envoyé avec succès !</p>';
                    }
                    else if(isset($_GET['error']) && !empty($_GET['message'])) {
                    echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
                    } 
                    ?>

                    <p class="form-floating">
                        <input type="text" name="customerDetailsName" class="form-control" id="customerDetailsName" placeholder="Votre nom">
                        <label for="customerDetailsName">Votre nom</label>
                    </p>

                    <p class="form-floating">
                        <input type="email" name="customerDetailsEmail" class="form-control" id="customerDetailsEmail" placeholder="Votre email">
                        <label for="customerDetailsEmail">Votre email</label>
                    </p>

                    <p class="form-floating">
                        <input type="text" rows='5' name="customerDetailsMessage" class="form-control" id="customerDetailsMessage" placeholder="Votre message">
                        <label for="customerDetailsMessage">Votre demande</label>
                    </p>

                    <button class="btn btn-outline-info" type="submit">En savoir plus</button>

                </form>
            </div>

            <!-- Pied-de-page de la modale. -->
            <div class="modal-footer">

                <?php if(isset($_SESSION['connect'])) { ?>
                    <a 
                    href='./model/modelDeleteCar.php?id=<?=$car["id"]?>' 
                    type="button" 
                    class="btn btn-info">
                    Supprimer
                </a>
                <?php } ?>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div> 

<?php
    }
?>


<!-- Présentation des services proposés. -->
<div class="container my-4">

    <h2 id="services" class="display-4 text-primary text-center">Nos services</h2>

    <!-- Tableau de présentation. -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Forfait</th>
                <th scope="col">Prestation</th>
                <th scope="col">Prix</th>
            </tr>
        </thead>
        <tbody>

            <!-- Récuperation des services présents sur la base de données. -->
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


<!-- Formulaire de contact général. -->
<div class="d-flex flex-column flex-md-row">

<div class="container">
    <h2 id="contact" class="display-4 text-primary text-center">Nous contacter</h2>

    <div class="col-lg-6 mx-auto my-1 p-3">
    <!-- Formulaire. -->
    <form method="POST" action="index.php?page=home">
        <!-- Message de validation ou d'erreur. -->
        <?php if(isset($_GET['askForContact'])) {
        echo '<p class="mt-4 fw-bold text-success">Message envoyé avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>
        <!-- Formulaire. -->
        <p class="form-floating m-2">
            <input type="text" name="customerName" class="form-control" id="customerName" placeholder="Votre nom">
            <label for="customerName">Votre nom</label>
        </p>

        <p class="form-floating m-2">
            <input type="email" name="customerEmail" class="form-control" id="customerEmail" placeholder="Votre email">
            <label for="customerEmail">Votre email</label>
        </p>

        <p class="form-floating m-2">
            <input type="text" rows='5' name="customerMessage" class="form-control" id="customerMessage" placeholder="Votre message">
            <label for="customerMessage">Votre message</label>
        </p>

        <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

        </form>
    </div>
</div>

<!-- Formualire de témoignages pour les clients. -->
<div class="container">

    <h2 class="display-4 text-primary text-center">Votre expérience</h2>

    <!-- Formulaire. -->
    <form class="col-lg-6 mx-auto my-1 p-3" method="POST" action="index.php?page=dashboard">
    <!-- Message de validation ou d'erreur. -->
    <?php if(isset($_GET['addNewTestimonialClient'])) {
    echo '<p class="mt-4 fw-bold text-success">Témoignage enregistré avec succès !</p>';
    }
    else if(isset($_GET['error']) && !empty($_GET['message'])) {
    echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
    } 
    ?>

    <!-- Formulaire. -->
    <p class="form-floating m-2">
        <input type="text" name="testimonialContentClient" class="form-control" id="testimonialContentClient" placeholder="Témoignage">
        <label for="testimonialContentClient">Votre expérience</label>
    </p>

    <p class="form-floating m-2">
        <input type="text" name="customerClient" class="form-control" id="customerClient" placeholder="Nom du client">
        <label for="customerClient">Votre nom</label>
    </p>

    <p class="form-floating m-2">
        <input type="number" min="0" max="5" name="customerNoteClient" class="form-control" id="customerNoteClient" placeholder="Note du client">
        <label for="customerNoteClient">Votre note (sur 5)</label>
    </p>

    <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

    </form>
</div>

</div>

<!-- Section à propos du garage. -->
<div class="container my-4">
    <h2 id="about" class="display-4 text-primary text-center">À propos</h2>
    <div>
        <h4>Bienvenue chez Vincent Parrot Garage Automobile !</h4>

        <p>
            Fondé en 2021 par Vincent Parrot, notre garage automobile à Toulouse est le fruit de 15 années d'expérience solide et passionnée dans le domaine de la réparation automobile. 
            Fortement investi dans le monde de l'automobile depuis ses débuts, Vincent Parrot a décidé de concrétiser son rêve en établissant son propre garage, dédié à offrir des services de réparation et d'entretien exceptionnels.
        </p>

        <p>Notre Mission :</p>

        <p>
            Chez Vincent Parrot Garage Automobile, notre mission est claire : fournir à nos clients des services de réparation automobile de la plus haute qualité, 
            combinés à un service clientèle exceptionnel. Nous comprenons que la confiance de nos clients repose sur notre expertise et notre engagement envers l'excellence. 
            Chaque membre de notre équipe partage cette vision et s'efforce de fournir des solutions fiables et efficaces pour tous les besoins en matière de réparation et d'entretien automobile.
        </p>

        <p>Notre Approche :</p>

        <p>
            Nous croyons en une approche transparente et personnalisée envers chaque véhicule qui entre dans notre garage. 
            Chaque problème est examiné en détail, expliqué clairement au client et résolu de manière professionnelle. 
            Notre équipe de techniciens qualifiés et expérimentés utilise les derniers équipements et techniques pour assurer que votre voiture reçoive les meilleurs soins possibles.
        </p>

        <p>Pourquoi Nous Choisir :</p>

        <ul>
            <li>Expertise : Avec plus d'une décennie d'expérience, Vincent Parrot est un nom de confiance dans le domaine de la réparation automobile.</li>
            <li>Qualité : Nous nous engageons à fournir des services de la plus haute qualité pour garantir la sécurité et la performance de votre véhicule.</li>
            <li>Service Clientèle : Votre satisfaction est notre priorité absolue. Notre équipe amicale est là pour répondre à vos questions et vous assister à chaque étape.</li>
            <li>Transparence : Nous croyons en une communication ouverte et honnête. Vous serez informé de toutes les étapes du processus de réparation.</li>
        </ul>

        <p>
            Nous sommes fiers de servir la communauté automobile de Toulouse et de ses environs. 
            Merci de nous faire confiance pour prendre soin de votre voiture. 
            N'hésitez pas à nous contacter pour toutes vos questions ou besoins en matière de réparation et d'entretien automobile.
        </p>

        <p>L'équipe de Vincent Parrot Garage Automobile</p>
</div>
</div>


<!-- Modale de connexion. -->
<div class="modal fade" id="signIn" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">

            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Connectez-vous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <!-- Corps de la modale. -->
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

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>