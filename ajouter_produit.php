<?php
session_start();
include 'connexion.php';

if(isset($_POST['ajouter'])){

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO produits(nom, description, prix, artisan_id)
            VALUES('$nom','$description','$prix','".$_SESSION['artisan_id']."')";

    if($conn->query($sql)){
        echo "Produit ajouté";
    } else{
        echo "Erreur";
    }
}
?>

<form method="POST">

    <input type="text" name="nom" placeholder="Nom produit">

    <textarea name="description"></textarea>

    <input type="number" name="prix" placeholder="Prix">

    <button type="submit" name="ajouter">
        Ajouter
    </button>

</form>