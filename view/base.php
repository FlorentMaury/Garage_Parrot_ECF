<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Garage Parrot 15 ans d'expérience à votre service.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./design/defaut.css">
    <!-- <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    <title><?= $title ?> | Garage Parrot</title>
</head>
<body> 
       
       <!-- Titre, NavBar et Formulaire d'inscription -->
    

       <header>
       <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top" id="menu">
    <div class="container">
        <div class="navbar-brand">
            GARAGE PARROT
        </div>
        <!-- Le bouton s'affichera sur les petits écrans -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#smallNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="smallNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php?page=home" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Véhicules</a>
                    </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Services</a>
                    </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Contact</a>
                    </li>
                    <?php if(isset($_SESSION['connect'])) { ?>
                <li class="nav-item">
                    <a href="index.php?page=dashboard" class="nav-link">Tableau de Bord</a>
                    </li>
                    <?php } ?>
                    <?php if(!isset($_SESSION['connect'])) { ?>
                <li class="nav-item">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#signIn">Espace collaborateurs</a>
                    </li>
                    <?php } ?>
                </ul>
        </div>
</nav>
    </header>

    <?php
        if(isset($_GET['connexion'])) {
            echo '<div class=\'container\'><p class="mt-4 fw-bold text-success">Connexion réalisée avec succès.</p></div>';
        }
        else if(isset($_GET['error']) && !empty($_GET['message'])) {
            echo '<div class=\'container\'><p class="mt-4 fw-bold text-error">'.htmlspecialchars($_GET['message']).'</p></div>';
        } 
    ?>

    <!-- Contenu -->

    <?= $content ?>

    <!-- Pied-de-page. -->
    
    <div class="container">


        <hr class="text-primary">
        <footer class="d-flex flex-wrap m-5 justify-content-between align-items-center">

        <div>


<h3>Nos horaires</h3>
<table>
    <thead>
        <tr>
            <th>Jour</th>
            <th colspan="2">Matin</th>
            <th colspan="2">Après-midi</th>
        </tr>
    </thead>

    
    <tbody>
        <tr>

        <?php
    require('./model/modelConnectionDB.php');

    while($time = $schedule->fetch()) {

        ?>
            <td><p><?= $time['day'] ?></p></td>
            <td><p><?= $time['opening'] ?>h - </p></td>
            <td><p><?= $time['break_start'] ?>h</p></td>
            <td><p><?= $time['break_end'] ?>h - </p></td>
            <td><p><?= $time['closing'] ?>h</p></td>
        </tbody>
        <?php
    }
    ?>
        </tr>
</table>


</div>

            <div class="col-md-4 d-flex align-items-center">
                <span class="text-muted">© 2022 Florent Maury</span>
            </div>


    <!-- Script JavaScript pour animations (ex : modales) Bootstrap. -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>
</html>