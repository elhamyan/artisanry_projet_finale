
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Artisanry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Artisanry</h1>
    <p>Plateforme de gestion des produits artisanaux</p>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="ajouter.php">Ajouter Produit</a>
</nav>

<div class="container">
    <h2>Produits Artisanaux</h2>

    <?php
    $sql = "SELECT * FROM produits";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="card">
            <img src="<?php echo $row['image']; ?>" alt="">
            <h3><?php echo $row['nom']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <strong><?php echo $row['prix']; ?> DH</strong>
        </div>
    <?php } ?>
</div>

<footer>
    <p>© 2026 Artisanry</p>
</footer>

</body>
</html>
