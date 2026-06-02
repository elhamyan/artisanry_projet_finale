<?php
// --- 1. CONNEXION À LA BASE DE DONNÉES ---
$host = "localhost";
$db_name = "artisanry_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// --- 2. TRAITEMENT DES FORMULAIRES (POST) ---
$message_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Si le formulaire Client ou Artisan est soumis
    if ($_POST['action'] == 'soumettre_formulaire') {
        $type = $_POST['type_utilisateur'];
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $msg = htmlspecialchars($_POST['message']);

        if (!empty($nom) && !empty($email) && !empty($msg)) {
            $stmt = $pdo->prepare("INSERT INTO messages (type_utilisateur, nom, email, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$type, $nom, $email, $msg]);
            $message_success = "Merci $nom, votre message en tant que ($type) a bien été envoyé !";
        }
    }
}

// --- 3. RÉCUPÉRATION DES PRODUITS (GET) ---
$stmt = $pdo->query("SELECT * FROM produits");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisanry - L'Artisanat Authentique</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        :root { --primary-color: #5c3a21; --secondary-color: #7b4f24; --bg-light: #fafafa; }
        body { background-color: var(--bg-light); color: #333; }
        
        header { background-color: var(--primary-color); color: white; padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        header h1 { font-family: 'Georgia', serif; }
        nav ul { list-style: none; display: flex; gap: 20px; }
        nav ul li a { color: white; text-decoration: none; }

        .hero { background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&q=80') center/cover; height: 350px; display: flex; align-items: center; padding: 0 50px; color: white; }
        .hero h2 { font-size: 2.5rem; font-family: 'Georgia', serif; margin-bottom: 10px; }
        
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; margin: 20px auto; width: 80%; border-radius: 5px; text-align: center; font-weight: bold; }

        .services { padding: 50px; }
        .section-title { background-color: var(--primary-color); color: white; text-align: center; padding: 12px; border-radius: 25px; margin: 0 auto 40px; width: 60%; }
        .services-grid { display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; }
        .service-card { background: white; border-radius: 10px; padding: 25px; width: 320px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #eee; }
        .service-card h3 { color: var(--primary-color); margin-bottom: 15px; }
        
        /* Formulaire Style */
        .form-group { margin-bottom: 10px; text-align: left; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px; }
        .btn { background-color: var(--secondary-color); color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 10px; text-decoration: none; display: inline-block; text-align: center;}
        .btn:hover { background-color: #8c5b2a; }

        .products { padding: 50px; background-color: white; }
        .products-grid { display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin-top: 30px;}
        .product-card { border: 1px solid #eee; border-radius: 10px; padding: 20px; width: 280px; background-color: var(--bg-light); box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .product-img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
        .artisan-name { font-size: 0.8rem; color: #d35400; background-color: #fdebd0; padding: 3px 8px; border-radius: 4px; display: inline-block; margin: 5px 0 10px; }
        .price { font-weight: bold; color: var(--primary-color); font-size: 1.1rem; }

        footer { background-color: var(--primary-color); color: white; text-align: center; padding: 15px; margin-top: 40px; }
    </style>
</head>
<body>

    <header>
        <h1>Artisanry</h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#produits">Produits</a></li>
                <li><a href="#">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div>
            <h2>Découvrez l'Artisanat Authentique</h2>
            <p>Des produits uniques faits à la main par des artisans marocains.</p>
            <a href="#produits" class="btn" style="width: auto;">Découvrir les produits</a>
        </div>
    </section>

    <?php if (!empty($message_success)): ?>
        <div class="alert-success"><?= $message_success ?></div>
    <?php endif; ?>

    <section id="services" class="services">
        <h2 class="section-title">Services</h2>
        <div class="services-grid">
            
            <div class="service-card">
                <h3>Service Client</h3>
                <p style="font-size: 0.9rem; margin-bottom: 15px; color:#666;">Assistance des clients, réponse aux questions et communication rapide.</p>
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="soumettre_formulaire">
                    <input type="hidden" name="type_utilisateur" value="Client">
                    <div class="form-group">
                        <input type="text" name="nom" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Votre email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Votre question..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn">Envoyer l'avis</button>
                </form>
            </div>

            <div class="service-card">
                <h3>Services Artisanaux</h3>
                <p style="font-size: 0.9rem; margin-bottom: 15px; color:#666;">Gestion des produits artisanaux et amélioration de la visibilité en ligne.</p>
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="soumettre_formulaire">
                    <input type="hidden" name="type_utilisateur" value="Artisan">
                    <div class="form-group">
                        <input type="text" name="nom" placeholder="Nom de l'artisan" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email professionnel" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Détails de votre création..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn">Rejoindre la plateforme</button>
                </form>
            </div>

            <div class="service-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3>Visiteur Public</h3>
                    <p style="font-size: 0.9rem; color:#666; line-height: 1.5;">Explorez notre catalogue de produits authentiques, découvrez l'histoire de chaque création et soutenez l'artisanat local.</p>
                </div>
                <a href="#produits" class="btn">Visiter la boutique</a>
            </div>

        </div>
    </section>

    <section id="produits" class="products">
        <h2>Liste des Produits</h2>
        <div class="products-grid">
            
            <?php if (count($produits) > 0): ?>
                <?php foreach($produits as $produit): ?>
                    <div class="product-card">
                        <img src="<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" class="product-img">
                        <h3><?= htmlspecialchars($produit['titre']) ?></h3>
                        <span class="artisan-name">Artisan: <?= htmlspecialchars($produit['artisan']) ?></span>
                        <p style="font-size: 0.9rem; color: #555; height: 60px; overflow: hidden;"><?= htmlspecialchars($produit['description']) ?></p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                            <span class="price"><?= $produit['prix'] ?> MAD</span>
                            <a href="#" class="btn" style="width: auto; margin-top: 0; padding: 5px 10px; font-size: 0.9rem;">Acheter</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun produit disponible pour le moment.</p>
            <?php endif; ?>

        </div>
    </section>

    <footer>
        <p>&copy; 2026 Artisanry - Tous droits réservés.</p>
    </footer>

</body>
</html>