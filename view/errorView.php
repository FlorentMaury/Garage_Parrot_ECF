<?php 
    $title = 'Une erreur s\'est produite';

    ob_start();
?>

    <div class="container">

        <h1>Oups...</h1>

        <p><?= $error ?></p>

    </div>
    
<?php

    $content = ob_get_clean();

    require('base.php');  

?>