<?php

function home() {
    require('view/homeView.php');
};

function dashboard() {
    require('model/modelLogout.php');
    require('model/modelNewUser.php');

    require('view/dashboardView.php');
};

?>