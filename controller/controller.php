<?php

function home() {
    require('model/modelConnectionDB.php');
    require('view/homeView.php');
};

function dashboard() {
    require('model/modelNewUser.php');

    require('model/modelSetServices.php');

    require('model/modelAddCar.php');

    require('view/dashboardView.php');
    
};

function logOut() {
    require('model/modelLogout.php');
};

?>