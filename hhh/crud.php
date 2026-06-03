
<?php
// index.php
require 'config.php';

// 1. CREATE : Ajouter produit jdid
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO produits (nom, description, prix) VALUES ('$nom', '$description', '$prix')";
    $conn->query($sql);
    header("Location: les produits.php"); // Recharger l-page
}

// 2. DELETE : Supprimer produit
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM produits WHERE id=$id";
    $conn->query($sql);
    header("Location: les produits.php");
}

// 3. READ : Njibo l-produits kamlin
$result = $conn->query("SELECT * FROM produits");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Artisanat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f9f9f9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #2c3e50; color: white; }
        form { background: #fff; padding: 20px; border: 1px solid #ddd; max-width: 400px; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: #27ae60; color: white; border: none; padding: 10px; cursor: pointer; }
        .btn-del { color: red; text-decoration: none; margin-left: 10px; }
        .btn-edit { color: blue; text-decoration: none; }
    </style>
</</head>
<body>

    <h2>Ajouter un Produit Artisanal</h2>
    <form action="index.php" method="POST">
        <input type="text" name="nom" placeholder="Nom du produit" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="prix" placeholder="Prix (DH)" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h2>Liste des Produits</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC))?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['prix']; ?> DH</td>
            <td>
                <a class="btn-edit" href="edit.php?id=<?php echo $row['id']; ?>">Modifier</a>
                <a class="btn-del" href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Sûr bghiti tmsa7?')">Supprimer</a>
            </td>
        </tr>
       
    </table>

</body>
</html>