
<?php include 'config.php'; ?>

<?php
if(isset($_POST['ajouter'])) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];

    $sql = "INSERT INTO produits(nom, description, prix, image)
            VALUES(:nom, :description, :prix, :image)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':description' => $description,
        ':prix' => $prix,
        ':image' => $image
    ]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Ajouter un Produit</h1>
</header>

<div class="container">
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom du produit" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <input type="number" step="0.01" name="prix" placeholder="Prix" required>

        <input type="text" name="image" placeholder="images/produit.jpg" required>

        <button type="submit" name="ajouter">Ajouter</button>
    </form>
</div>

</body>
</html>
