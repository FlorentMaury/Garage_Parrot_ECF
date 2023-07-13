<?php 

    // Traitement.
    session_start();

    
    require('model/modelConnectionDB.php');
    require('model/modelConnectionUser.php');
    require('model/modelCookies.php');

    // Routeur.

    require('controller\controller.php');

    try{
        if(isset($_GET['page'])) {

            if($_GET['page'] == 'home') {
                home();
            }

            else if ($_GET['page'] == 'dashboard') {
                dashboard();
            }
            else {
                throw new Exception("Cette page n'existe pas ou a été supprimée.");
            }

        }
        else {
            home();
        };
    }
    catch(Exception $e) {
        $error = $e->getMessage();
        require('view/errorView.php');
    };

    require('./view/base.php');

?>