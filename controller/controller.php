<?php

    // Gestion des contenus dans chacunes des pages.
    
    // Dans la page d'accueil.
    function home() {
        require('model/modelConnectionDB.php');
        require('model/modelFilterCars.php');
        
        require('view/homeView.php');
    };

    // Dans le tableau de bord, pour les employés.
    function dashboard() {
        require('model/modelNewUser.php');
        require('model/modelSetServices.php');
        require('model/modelSetSchedule.php');
        require('model/modelAddCar.php');
        require('model/modelAddTestimonal.php');

        require('view/dashboardView.php');
        
    };

    // Dans la fonction de déconnexion.
    function logOut() {
        require('model/modelLogout.php');
    };

?>