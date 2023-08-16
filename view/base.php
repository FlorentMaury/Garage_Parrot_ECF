<!-- Base générale des pages du site. -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./public/assets/favicon.ico" type="image/x-icon">
        <meta name="description" content="Garage Parrot 15 ans d'expérience à votre service.">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="./design/defaut.css">
        <title><?= $title ?> | Garage V. Parrot</title>
    </head>
    <body> 
        
        <!-- Titre, NavBar et Formulaire d'inscription. -->
        <header>
            <nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-md" id="menu">
                <div class="container">
                    <div class="navbar-brand">
                        <img src="./public/assets/logouni.png" alt="logo">
                        GARAGE V. PARROT
                    </div>
                    <!-- Le bouton s'affichera sur les petits écrans. -->
                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#smallNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                <!-- Navbar, menu -->
                <div class="collapse navbar-collapse" id="smallNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php?page=home" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="#cars" class="nav-link">Véhicules</a>
                            </li>
                        <li class="nav-item">
                            <a href="#services" class="nav-link">Services</a>
                            </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact</a>
                            </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">À propos</a>
                            </li>
                        <!-- Modification du contenu si l'utilisateur est connecté ou non. -->
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

        <!-- Lien de retour en haut de page. -->
        <a 
            class="rounded-circle d-flex justify-content-center shadow-sm"
            href="#" 
            style="
                position: fixed;
                width: 3vw;
                height: 5vh;
                bottom: 50px;
                right: 30px;"
        >
        <img src="./public/assets/up.png" alt="Retour haut de page">
        </a>


        <!-- Message de validation de la connexion utilisateur. -->
        <?php
            if(isset($_GET['connexion'])) {
                echo '<div class=\'container\'><p class="mt-4 fw-bold text-success">Connexion réalisée avec succès.</p></div>';
            }
            else if(isset($_GET['error']) && !empty($_GET['message'])) {
                echo '<div class=\'container\'><p class="mt-4 fw-bold text-error">'.htmlspecialchars($_GET['message']).'</p></div>';
            } 
        ?>

        <!-- Contenu des pages. -->

        <main class="container pt-5">

            <?= $content ?>

        </main>

        <!-- Pied-de-page. -->
        
        <hr class="text-primary container">

        <footer class="container d-flex flex-column align-items-center justify-content-between flex-md-row">
            <div class="align-items-center">

                <!-- Horaires. -->
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
                            <td><p><?= $time['morning_start'].' -' ?></p></td>
                            <td><p><?= $time['morning_end'] ?></p></td>
                            <td><p><?= $time['afternoon_start'].' -' ?></p></td>
                            <td><p><?= $time['afternoon_end'] ?></p></td>
                        </tbody>

                            <?php
                                }
                            ?>
                            </tr>
                    </table>
            </div>

            <!-- Signature. -->
            <div class="col-md-4 d-flex align-items-center">
                <span class="text-muted">© 2022 Florent Maury</span>
            </div>
        </footer>

        <!-- JQuery animation et AJAX. -->

        <script
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous">
        </script>

        <script
            src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
            integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
            crossorigin="anonymous">
        </script>

        <!-- Script JavaScript pour animations (ex : modales) Bootstrap. -->

        <script 
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
            crossorigin="anonymous">
        </script>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" 
            integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" 
            crossorigin="anonymous">
        </script>

        <!-- Script personnel. -->

        <script src="./src/script.js"></script>

    </body>
</html>