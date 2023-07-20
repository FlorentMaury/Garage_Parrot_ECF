    <?php 

    $title = 'Tableau de bord';  
  
    ob_start();

?>

<div class="container">

<?php 
if($_SESSION['id'] == 0) { 
?>

<h2>Nouveau collaborateur</h2>

<form method="POST" action="index.php?page=dashboard">

<?php if(isset($_GET['success'])) {
echo '<p class="mt-4 fw-bold text-success">Inscription réalisée avec succès !</p>';
}
else if(isset($_GET['error']) && !empty($_GET['message'])) {
echo '<p class="mt-4 fw-bold text-danger">'.htmlspecialchars($_GET['message']).'</p>';
} 
?>

<p class="form-floating m-2">
<input type="email" name="email" class="form-control" id="email" placeholder="dupont@email.com">
<label for="email">Email</label>
</p>
<p class="form-floating m-2">
<input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
<label for="password">Mot de passe</label>
</p>
<p class="form-floating m-2">
<input type="password" name="passwordTwo" class="form-control" id="passwordTwo" placeholder="Confirmez votre mot de passe">
<label for="passwordTwo">Confirmez le mot de passe</label>
</p>
<button class="w-50 btn btn-lg btn-primary mt-4" type="submit">Enregister</button>
</form>
<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5"></div>
<div class="overflow-hidden" style="max-height: 30vh;"></div>

<h2>Liste des employés : </h2>

<?php

require('./model/modelConnectionDB.php');

while($utilisateur = $requete->fetch()) {

?>
<p><?= $utilisateur['email'] ?></p>
<?php
}
?>

<h2>Liste des services : </h2>
<h2>Horaires du garage : </h2>

<?php } ?>

<?php 
if($_SESSION['id'] > 0) { 
?>

<h2>Véhicules en ligne : </h2>
<h2>Mettre un véhicule en ligne : </h2>

<?php } ?>

    <button type="button" href="" class="btn btn-primary me-2">
        <a class="text-decoration-none text-white" href="index.php?page=logout">Déconnexion</a>
    </button>

</div>




<?php 

    $content = ob_get_clean();

    require('base.php');

?>