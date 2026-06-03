<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="logo">
        <h2><a href="index.php" style="color: var(--copper); text-decoration: none;">ArtisatMaroc</a></h2>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php#services">Services</a></li>
            <li><a href="produits.php">Produits</a></li>
            <li><a href="a_propos.php">À propos</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(isset($_SESSION['artisan_id'])): ?>
                <li><a href="artisan_dash.php" style="color: var(--copper); font-weight: bold;">Mon Espace</a></li>
                <li><a href="logout.php" style="color: #d9534f;">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login.php" style="border: 1px solid var(--copper); padding: 5px 15px; border-radius: 4px;">Connexion Artisan</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>