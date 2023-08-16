<!-- Contenu réservé aux employés du garage. -->
<?php 

    // Mise à jour du contenu du titre de la page.
    $title = 'Tableau de bord';  

    // Début d'enregistrement du contenu HTML.
    ob_start();

?>

<div class="container mt-5">

    <!-- Contenu réservé au patron du garage. -->
    <?php 
    if($_SESSION['id'] == 0) { 
    ?>

    <h2 class="pt-5 display-4 text-primary text-center">Nouveau collaborateur</h2>

    <!-- Formulaire d'enregistrement d'un nouvel employé. -->
    <form class="d-flex flex-column" method="POST" action="index.php?page=dashboard">

        <!-- Messages de succès ou d'erreur, le cas échéant. -->
        <?php if(isset($_GET['success'])) {
        echo '<p class="mt-4 fw-bold text-success">Inscription réalisée avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>

        <!-- Formulaire. -->
        <p class="form-floating m-2">
            <input type="email" name="email" class="form-control" id="email" placeholder="dupont@email.com">
            <label for="email">Email</label>
        </p>

        <p class="form-floating m-2">
            <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </p>

        <p class="form-floating m-2">
            <input type="password" name="passwordTwo" class="form-control" id="passwordTwo" placeholder="Confirmez votre mot de passe">
            <label for="passwordTwo">Confirmez le mot de passe</label>
        </p>
        
        <button class="w-50 btn btn-lg btn-primary mt-4 align-self-center" type="submit">Enregister</button>

    </form>

        <!-- Liste des employés. -->
    <h2 class="mt-5 display-4 text-primary text-center">Liste des employés : </h2>

    <?php

    if(isset($_GET['deletedUser'])) {
        echo '<p class="mt-4 fw-bold text-success">Utilisateur supprimé avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 

    require('./model/modelConnectionDB.php');

    while($user = $users->fetch()) {
    ?>
        <p>
            <?= $user['email'] ?>
                <a 
                    href='./model/modelDeleteUser.php?id=<?=$user["id"]?>' 
                    type="button" 
                    class="btn btn-info">
                    <img class="w-50" src="./public/assets/multiplier.png" alt="Image de suppression">
                </a>
        </p>
    <?php
    }
    ?>

    <!-- Horaires du garage pour modification. -->
    <h2 class="mt-5 display-4 text-primary text-center">Horaires du garage : </h2>

    <!-- Formulaire de modification. -->
    <form class="d-flex flex-column" method="POST" action="index.php?page=dashboard">

        <!-- Message de validation ou d'erreur. -->
        <?php if(isset($_GET['modifySchedule'])) {
        echo '<p class="mt-4 fw-bold text-success">Horaire modifiée avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>

        <!-- Menu déroulant pour chacun des jours et récupérer l'id. -->
        <div class="input-group mb-3">
            <label  class="input-group-text" for="inputGroupSelect01">Options</label>
            <select name="schedule" class="form-select" id="inputGroupSelect01">
                <option selected>Choix du jour</option>
                <?php
                    while($timetable = $schedule->fetch()) {
                    ?>
                        <option value="<?= $timetable['id']?>" ><?= $timetable['day']?></option>

                    <?php }  ?>
            </select>
        </div>

        <!-- Modification des horaires. -->
        <p class="form-floating m-2">
            <input type="time" name="morningStart" class="form-control" id="morningStart" placeholder="Ouverture">
            <label for="morningStart">Ouverture</label>
        </p>

        <p class="form-floating m-2">
            <input type="time" name="morningEnd" class="form-control" id="morningEnd" placeholder="Fin de matinée">
            <label for="morningEnd">Fin de matinée</label>
        </p>

        <p class="form-floating m-2">
            <input type="time" name="afternoonStart" class="form-control" id="afternoonStart" placeholder="Début après-midi">
            <label for="afternoonStart">Début après-midi</label>
        </p>

        <p class="form-floating m-2">
            <input type="time" name="afternoonEnd" class="form-control" id="afternoonEnd" placeholder="Fermeture">
            <label for="afternoonEnd">Fermeture</label>
        </p>
        
        <button class="w-50 btn btn-lg btn-primary mt-4 align-self-center" type="submit">Enregister</button>

    </form>


    <!-- Modification des forfaits d'entretient. -->
    <h2 class="mt-5 display-4 text-primary text-center">Modification des forfait d'entretient : </h2>

    <!-- Formlulaire de modification. -->
    <form class="d-flex flex-column" method="POST" action="index.php?page=dashboard">

        <!-- Message de validation oub d'erreurs. -->
        <?php if(isset($_GET['modifyService'])) {
        echo '<p class="mt-4 fw-bold text-success">Prestation modifiée avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>

        <!-- Menu déroulant pour récupérer l'id du service à modifier. -->
        <div class="input-group mb-3">
            <label  class="input-group-text" for="inputGroupSelect02">Options</label>
            <select name="service" class="form-select" id="inputGroupSelect02">
                <option selected>Type de prestation</option>
                <?php
                    while($services = $service->fetch()) {
                    ?>
                        <option value="<?= $services['id']?>" ><?= $services['service_name']?></option>

                    <?php }  ?>
            </select>
        </div>

        <!-- Service en question. -->
        <p class="form-floating m-2">
            <input type="text" name="included" class="form-control" id="included" placeholder="Prestation">
            <label for="included">Prestation</label>
        </p>

        <p class="form-floating m-2">
            <input type="number" name="price" class="form-control" id="price" placeholder="Prix">
            <label for="price">Prix</label>
        </p>
        
        <button class="w-50 btn btn-lg btn-primary mt-4 align-self-center" type="submit">Enregister</button>

    </form>

    <?php } ?>


    <!-- Partie reservée au employés. -->
    <?php 
        if($_SESSION['id'] > 0) { 
    ?>

        <!-- Véhicules en ligne. -->
        <h2 class="pt-5 display-4 text-primary text-center">Véhicules en ligne : </h2>

        <!-- Message de validation ou d'erreur. -->
        <?php if(isset($_GET['deletedCar'])) {
            echo '<p class="mt-4 fw-bold text-success">Vehicule supprimé avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

        <!-- tableau des véhicules. -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-2">Marque</th>
                        <th class="px-2">Modèle</th>
                        <th class="px-2">Kilomètrage</th>
                        <th class="px-2">Prix</th>
                        <th class="px-2">Année</th>
                        <th class="px-2">Description</th>
                        <th class="px-2">Supprimer</th>
                    </tr>
                </thead>

            <?php
            require('./model/modelConnectionDB.php');
                while($car = $cars->fetch()) {
            ?>

                <tbody>
                    <tr>
                        <td class="px-2"><?= $car['car_brand'] ?></td>
                        <td class="px-2"><?= $car['car_type'] ?></td>
                        <td class="px-2"><?= $car['car_km'] ?></td>
                        <td class="px-2"><?= $car['car_price'] ?></td>
                        <td class="px-2"><?= $car['car_year'] ?></td>
                        <td class="px-2"><?= $car['car_desc'] ?></td>
                        <td class="px-2">
                            <a 
                                href='./model/modelDeleteCar.php?id=<?=$car["id"]?>' 
                                type="button" 
                                class="btn btn-info">
                                <img class="w-75" src="./public/assets/multiplier.png" alt="Image de suppression">
                            </a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <?php
            }
        ?>

        <!-- Ajout d'un véhicule. -->
        <h2 class="display-4 text-primary text-center mt-5">Mettre un véhicule en ligne : </h2>

        <!-- Formulaire d'ajout d'un véhicule. -->
        <form class="d-flex flex-column"  method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">

            <!-- Message de validation ou d'erreur. -->
            <?php if(isset($_GET['addNewCar'])) {
            echo '<p class="mt-4 fw-bold text-success">Nouveau véhicule ajouté avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

            <!-- Formulaire. -->
            <p class="form-floating m-2">
                <input type="text" name="carBrand" class="form-control" id="carBrand" placeholder="Marque du véhicule">
                <label for="carBrand">Marque</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="carType" class="form-control" id="carType" placeholder="Modèle du véhicule">
                <label for="carType">Modèle</label>
            </p>

            <p class="form-floating m-2">
                <input type="date" name="carDate" class="form-control" id="carDate" placeholder="Année du véhicule">
                <label for="carDate">Année</label>
            </p>

            <p class="form-floating m-2">
                <input type="number" name="carPrice" class="form-control" id="carPrice" placeholder="Prix du véhicule">
                <label for="carPrice">Prix</label>
            </p>

            <p class="form-floating mx-2 my-0">
                <input type="number" name="carKm" class="form-control" id="carKm" placeholder="Kilométrage du véhicule">
                <label for="carKm">Kilométrage du véhicule</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="carDesc" class="form-control" id="carDesc" placeholder="Description du véhicule">
                <label for="carDesc">Description</label>
            </p>

            <p class="form-floating m-2">
                <input type="file" name="carImg1" class="form-control" id="carImg1" placeholder="Avant du véhicule">
                <label for="carImg1">Avant du véhicule</label>
            </p>

            <p class="form-floating m-2">
                <input type="file" name="carImg2" class="form-control" id="carImg2" placeholder="Côté du véhicule">
                <label for="carImg2">Côté du véhicule</label>
            </p>

            <p class="form-floating m-2">
                <input type="file" name="carImg3" class="form-control" id="carImg3" placeholder="Interieur du véhicule">
                <label for="carImg3">Interieur du véhicule</label>
            </p>

            <button class="w-50 btn btn-lg btn-primary mt-4 align-self-center" type="submit">Enregister</button>

        </form>


        <!-- Témoignages clients. -->
        <h2 class="display-4 text-primary text-center mt-5">Témoignages clients : </h2>

        <!-- Formulaire d'ajout d'un témoignage. -->
        <form class="d-flex flex-column" method="POST" action="index.php?page=dashboard">

            <!-- Message de validation ou d'erreur. -->
            <?php if(isset($_GET['addNewTestimonial'])) {
            echo '<p class="mt-4 fw-bold text-success">Témoignage enregistré avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

            <!-- Formulaire. -->
            <p class="form-floating m-2">
                <input type="text" name="testimonialContent" class="form-control" id="testimonialContent" placeholder="Témoignage">
                <label for="testimonialContent">Témoignage</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="customer" class="form-control" id="customer" placeholder="Nom du client">
                <label for="customer">Nom du client</label>
            </p>

            <p class="form-floating m-2">
                <input type="number" min="0" max="5" name="customerNote" class="form-control" id="customerNote" placeholder="Note du client">
                <label for="customerNote">Note du client</label>
            </p>

            <button class="w-50 btn btn-lg btn-primary mt-4 align-self-center" type="submit">Enregister</button>

        </form>


        <!-- Espace de modération des témoignages. -->
        <h2 class="display-4 text-primary text-center mt-5">Témoignages à valider : </h2>

        <div class="container mt-5">
            <!-- Message de validation ou d'erreur -->
            <?php if(isset($_GET['deletedTestimonial'])) {
            echo '<p class="mt-4 fw-bold text-success">Témoignage supprimé avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            else if(isset($_GET['validateTestimonial'])) {
                echo '<p class="mt-4 fw-bold text-success">Témoignage validé avec succès !</p>';
            } 
            ?>

            <!-- Récupération des messages. -->
            <?php while($testimonialNotValidate = $testimonialsNotValidate->fetch()) { ?>

            <div class="mb-5 d-flex justify-content-center">
                <p>"<?= $testimonialNotValidate['testimonial'] ?>"</p>
                <p>— <cite><?= $testimonialNotValidate['client'] ?></cite> —</p>
                <p><?= $testimonialNotValidate['note'] ?>/5</p>
                <a 
                    href='./model/modelValidateTestimonial.php?id=<?=$testimonialNotValidate["id"]?>' 
                    class="btn btn-success mx-2">
                    <img class="" src="./public/assets/check.png" alt="Image de validation">                
                </a>
                <a 
                    href='./model/modelDeleteTestimonial.php?id=<?=$testimonialNotValidate["id"]?>' 
                    class="btn btn-info mx-2">
                    <img class="w-75" src="./public/assets/multiplier.png" alt="Image de suppression">
                </a>
            </div>

            <?php } ?>
    </div>
</div>

    <?php } ?>

    <!-- Bouton de déconnexion. -->
    <div class="container my-4 d-flex justify-content-end">
        <button type="button" href="" class="btn btn-primary me-2">
            <a class="text-decoration-none text-white p-5" href="index.php?page=logout">Déconnexion</a>
        </button>
    </div>

</div>




<?php 
    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>