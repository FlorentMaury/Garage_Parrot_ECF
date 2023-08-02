<?php 

    $title = 'Tableau de bord';  

    ob_start();

?>

<div class="container">

    <?php 
    if($_SESSION['id'] == 0) { 
    ?>

    <h2>Nouveau collaborateur</h2>

    <form method="POST" action="index.php?page=dashboard">

        <?php if(isset($_GET['success'])) {
        echo '<p class="mt-4 fw-bold text-success">Inscription réalisée avec succès !</p>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
        } 
        ?>

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
        
        <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

    </form>

    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5"></div>
    <div class="overflow-hidden" style="max-height: 30vh;"></div>

    <h2>Liste des employés : </h2>

    <?php
    require('./model/modelConnectionDB.php');

    while($utilisateur = $users->fetch()) {
    ?>
        <p>
            <?= $utilisateur['email'] ?>
            <button class="btn btn-dark">
                <?= $utilisateur['id'] ?>
            </button>
        </p>
    <?php
    }
    ?>

        <h2>Horaires du garage : </h2>

        <form method="POST" action="index.php?page=dashboard">

            <?php if(isset($_GET['modifySchedule'])) {
            echo '<p class="mt-4 fw-bold text-success">Horaire modifiée avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

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

            <p class="form-floating m-2">
                <input type="text" name="morningStart" class="form-control" id="morningStart" placeholder="Ouverture">
                <label for="morningStart">Ouverture</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="morningEnd" class="form-control" id="morningEnd" placeholder="Fin de matinée">
                <label for="morningEnd">Fin de matinée</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="afternoonStart" class="form-control" id="afternoonStart" placeholder="Début après-midi">
                <label for="afternoonStart">Début après-midi</label>
            </p>

            <p class="form-floating m-2">
                <input type="text" name="afternoonEnd" class="form-control" id="afternoonEnd" placeholder="Fermeture">
                <label for="afternoonEnd">Fermeture</label>
            </p>
            
            <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

        </form>

        <h2>Modification des forfait d'entretient : </h2>

        <form method="POST" action="index.php?page=dashboard">

            <?php if(isset($_GET['modifyService'])) {
            echo '<p class="mt-4 fw-bold text-success">Prestation modifiée avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

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

            <p class="form-floating m-2">
                <input type="text" name="included" class="form-control" id="included" placeholder="Prestation">
                <label for="included">Prestation</label>
            </p>

            <p class="form-floating m-2">
                <input type="number" name="price" class="form-control" id="price" placeholder="Prix">
                <label for="price">Prix</label>
            </p>
            
            <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

        </form>

    <?php } ?>

    <?php 
        if($_SESSION['id'] > 0) { 
    ?>

        <h2>Véhicules en ligne : </h2>
        <h2>Mettre un véhicule en ligne : </h2>

        <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">

            <?php if(isset($_GET['addNewCar'])) {
            echo '<p class="mt-4 fw-bold text-success">Nouveau véhicule ajouté avec succès !</p>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
            } 
            ?>

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
                <input type="file" name="carImg" class="form-control" id="carImg" placeholder="Photo du véhicule">
                <label for="carImg">Photo du véhicule</label>
            </p>

            <button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>

        </form>

    <?php } ?>

    <div class="my-4">
        <button type="button" href="" class="btn btn-primary me-2">
            <a class="text-decoration-none text-white" href="index.php?page=logout">Déconnexion</a>
        </button>
    </div>

</div>




<?php 

    $content = ob_get_clean();

    require('base.php');

?>