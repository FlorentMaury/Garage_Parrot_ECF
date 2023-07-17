<?php

function home() {
    require('view/homeView.php');
};

function dashboard() {
    require('model/modelNewUser.php');

    require('view/dashboardView.php');
    
};

function logOut() {
    require('model/modelLogout.php');
};

?>