<?php
session_start();

if(!isset($_SESSION['artisan_id'])){
    header("Location: login.php");
}
?>

<h1>Bienvenue <?php echo $_SESSION['nom']; ?></h1>

<a href="ajouter_produit.php">Ajouter Produit</a>
<br>
<a href="produits.php">Voir Produits</a>