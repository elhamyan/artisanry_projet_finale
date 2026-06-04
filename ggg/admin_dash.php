<?php
require 'connexion _db.php';
session_start();

// Traitement dyal l-validation (Mli l-admin i-cliki approuver)
if (isset($_GET['action']) && $_GET['action'] == 'approuver') {
    $id_prod = intval($_GET['id']);
    
    $sql = "UPDATE produits SET statut = 'approuve' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id_prod]);
    
    header("Location: admin_dash.php?msg=approved");
    exit();
}

// Njibou gha l-produits li b9aw en attente
$sql = "SELECT p.*, a.nom as artisan_nom FROM produits p 
        JOIN artisans a ON p.artisan_id = a.id 
        WHERE p.statut = 'en_attente' ORDER BY p.date_ajout DESC";
$produits_en_attente = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Modérateur (Admin)</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin-top: 120px; padding: 20px; background-color: #fdfaf6; }
        .admin-box { max-width: 1000px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { color: var(--primary-brown); margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f7f1eb; color: var(--primary-brown); }
        .img-admin { width: 70px; height: 70px; object-fit: cover; border-radius: 4px; }
        .btn-validate { background: #28a745; color: #fff; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; }
        .btn-validate:hover { background: #218838; }
        .alert { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="admin-box">
    <h1>Validation des Produits Artisanaux</h1>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'approved'): ?>
        <div class="alert">Le produit a été approuvé et publié avec succès !</div>
    <?php endif; ?>

    <?php if(count($produits_en_attente) == 0): ?>
        <p>Aucun produit en attente de validation pour le moment. Tout est clean !</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Artisan</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produits_en_attente as $p): ?>
                    <tr>
                        <td><img src="uploads/<?php echo $p['image']; ?>" class="img-admin"></td>
                        <td>
                            <strong><?php echo $p['titre']; ?></strong><br>
                            <small style="color:#666;"><?php echo $p['description']; ?></small>
                        </td>
                        <td><?php echo $p['artisan_nom']; ?></td>
                        <td><?php echo $p['prix']; ?> DH</td>
                        <td>
                            <a href="admin_dash.php?action=approuver&id=<?php echo $p['id']; ?>" class="btn-validate">Approuver</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>