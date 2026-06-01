
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
    <nav class="navbar">
        <h1>Artisanry</h1>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="ajouter.php">Connexion</a></li>
        <li><a href="#services">Services</a></li>
    </ul>
</nav>
<header class="hero-header">
    <div class="header-content">
        <h1>Artisanry</h1>
        <p>Plateforme de gestion des produits artisanaux</p>
        <a href="les produit.php"> <button class="btn">découvrire les produit</button></a>
    </div>
</header>

<main class="services-container">
    <div id="services" class="services-section"> <h2>Services</h2>
    
     <div class="services-grid">
        <div class="card">
            <h3>Service Client</h3>
            <p>Assistance des clients, réponse aux questions et communication rapide avec les artisans.</p>
            <a href="formulaire client.php"><button class="btnn">Formulaire client</button></a>
        </div>
        <div class="card">
            <h3>Services Artisanaux</h3>
            <p>Gestion des produits artisanaux, présentation des créations traditionnelles et amélioration de la visibilité en ligne.</p>
            <a href="formulaire artisanaux.php"><button class="btn">Formulaire Artisan</button></a>
        </div>
        <div class="card">
            <h3>visiteur public</h3>
            <p>Gestion des produits artisanaux, présentation des créations traditionnelles et amélioration de la visibilité en ligne.</p>
            <a href="les produit.php"><button class="btn">découvrire les produit </button></a>
        </div>
     </div>
    </div>
</main>
<footer>
    <p>© 2026 Artisanry</p>
</footer>

</body>
</html>
