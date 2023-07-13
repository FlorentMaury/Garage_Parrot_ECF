<?= 
    $title = 'Accueil';

    ob_start();
?>
    <div class="container">
    <h1>Oups...</h1>
    <p><?= $error ?></p>
    </div>
<?=

    $content = ob_get_clean();

    require('base.php');  

?>