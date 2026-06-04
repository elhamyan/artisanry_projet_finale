<?php
require 'connexion _db.php';
session_start();

// 1. RÉCUPÉRATION DES CATÉGORIES (Pour le filtre)
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// 2. GESTION DU FILTRE PAR CATÉGORIE
$categorie_filtre = isset($_GET['categorie']) ? intval($_GET['categorie']) : 0;

// =========================================================================
// HNA FIN ZDNA L-FILTRE DYAL 'approuve' BCH L-PRODUIT L-JDIID MAYBANSH DIRECT
// =========================================================================
if ($categorie_filtre > 0) {
    // Ila l-client khtar chi catégorie spécifique + khass ykoun approuvé
    $sql = "SELECT p.*, a.nom as artisan_nom, c.nom_categorie 
            FROM produits p 
            JOIN artisans a ON p.artisan_id = a.id 
            JOIN categories c ON p.categorie_id = c.id 
            WHERE p.categorie_id = :cat_id AND p.statut = 'approuve' 
            ORDER BY p.date_ajout DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cat_id' => $categorie_filtre]);
} else {
    // Ila makhgatar walo, n-affichou kolshi li approuvé 
    $sql = "SELECT p.*, a.nom as artisan_nom, c.nom_categorie 
            FROM produits p 
            JOIN artisans a ON p.artisan_id = a.id 
            LEFT JOIN categories c ON p.categorie_id = c.id 
            WHERE p.statut = 'approuve' 
            ORDER BY p.date_ajout DESC";
    $stmt = $pdo->query($sql);
}

$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue des Produits Artisanaux</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin-top: 120px; background-color: #fdfaf6; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .page-title { text-align: center; color: var(--primary-brown); margin-bottom: 30px; font-size: 2.5rem; }
        
        /* Style de la barre des filtres */
        .filter-bar { display: flex; justify-content: center; gap: 15px; margin-bottom: 40px; flex-wrap: wrap; }
        .filter-btn { background-color: #fff; color: var(--primary-brown); border: 2px solid var(--primary-brown); padding: 8px 20px; border-radius: 20px; text-decoration: none; font-weight: bold; transition: 0.3s ease; }
        .filter-btn:hover, .filter-btn.active { background-color: var(--copper); color: #fff; border-color: var(--copper); }
        
        /* Grid des produits */
        .products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        
        /* Card Produit */
        .product-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); display: flex; flex-direction: column; border-top: 3px solid transparent; transition: transform 0.3s; }
        .product-card:hover { transform: translateY(-5px); border-top-color: var(--copper); }
        .product-img { width: 100%; height: 250px; object-fit: cover; }
        .product-info { padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .product-meta { font-size: 12px; text-transform: uppercase; color: var(--copper); font-weight: bold; margin-bottom: 5px; }
        .product-title { color: var(--primary-brown); margin-bottom: 10px; font-size: 1.3rem; }
        .product-desc { font-size: 14px; color: #666; margin-bottom: 15px; line-height: 1.5; }
        .product-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px; }
        .product-price { font-size: 1.2rem; font-weight: bold; color: var(--primary-brown); }
        .artisan-name { font-size: 13px; color: #88px; }
        
        /* Button Contact pour commander */
        .btn-contact-prod { display: block; text-align: center; background: var(--copper); color: #fff; text-decoration: none; padding: 10px; border-radius: 4px; margin-top: 15px; font-weight: bold; transition: 0.3s; }
        .btn-contact-prod:hover { background: var(--primary-brown); }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="page-title">Découvrez nos Merveilles</h1>
    
    <!-- BARRE DE FILTRAGE PAR CATÉGORIE -->
    <div class="filter-bar">
        <a href="produits.php" class="filter-btn <?php echo ($categorie_filtre == 0) ? 'active' : ''; ?>">Tout afficher</a>
        <?php foreach($categories as $cat): ?>
            <a href="produits.php?categorie=<?php echo $cat['id']; ?>" class="filter-btn <?php echo ($categorie_filtre == $cat['id']) ? 'active' : ''; ?>">
                <?php echo $cat['nom_categorie']; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- LISTE DES PRODUITS -->
    <?php if(count($produits) == 0): ?>
        <p style="text-align: center; color: #777; font-size: 1.2rem; margin-top: 40px;">Aucun produit n'est disponible dans cette catégorie pour le moment.</p>
    <?php else: ?>
        <div class="products-grid">
            <?php foreach($produits as $p): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo $p['image']; ?>" class="product-img" alt="<?php echo $p['titre']; ?>">
                    <div class="product-info">
                        <div>
                            <span class="product-meta"><?php echo $p['nom_categorie'] ?? 'Artisanat'; ?></span>
                            <h3 class="product-title"><?php echo $p['titre']; ?></h3>
                            <p class="product-desc"><?php echo $p['description']; ?></p>
                        </div>
                        <div>
                            <div class="product-bottom">
                                <span class="product-price"><?php echo $p['prix']; ?> DH</span>
                                <span class="artisan-name">Par: <strong><?php echo $p['artisan_nom']; ?></strong></span>
                            </div>
                            <!-- Bouton qui redirige vers la page contact ou whatsapp -->
                            <a href="contact.php?produit_id=<?php echo $p['id']; ?>" class="btn-contact-prod">Commander / Contacter</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>