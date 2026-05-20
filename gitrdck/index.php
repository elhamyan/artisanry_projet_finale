
<?php 
require 'config.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Artisanry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
    <a href="index.php">Accueil</a>
    <a href="ajouter.php">connexecion</a>
</nav>

<header class="hero-header">
    <div class="header-content">
        <h1>Artisanry</h1>
        <p>Plateforme de gestion des produits artisanaux</p>
    </div>
</header>

<main class="services-container">
    <h2>Services</h2>
    <div class="services-grid">
        <div class="card">
            <h3>Service Client</h3>
            <p>Assistance des clients, réponse aux questions et communication rapide avec les artisans.</p>
            <a href="formulaire client.php"><button class="btn">Formulaire client</button></a>
        </div>
        <div class="card">
            <h3>Services Artisanaux</h3>
            <p>Gestion des produits artisanaux, présentation des créations traditionnelles et amélioration de la visibilité en ligne.</p>
            <a href="formulaire artisanaux.php"><button class="btn">Formulaire Artisan</button></a>
        </div>
    </div>
</main>
<footer>
    <p>© 2026 Artisanry</p>
</footer>

</body>
</html>
