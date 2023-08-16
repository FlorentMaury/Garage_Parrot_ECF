<?php 

    // Modification de titre de la page.
    $title = 'Une erreur s\'est produite';

    // Début de l'enregistrement du HTML.
    ob_start();
?>

    <div class="container mt-5">

        <h1 class="py-4">Oups...</h1>

        <p><?= $error ?></p>

    </div>
    
<?php

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');  

?>