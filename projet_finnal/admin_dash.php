<?php
require 'connexion _db.php';
session_start();

$message = "";
$status = "";

// ==========================================
// 1. TRAITEMENT : APPROUVER UN PRODUIT
// ==========================================
if (isset($_GET['action']) && $_GET['action'] == 'approuver') {
    $id_prod = intval($_GET['id']);
    $sql = "UPDATE produits SET statut = 'approuve' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id_prod]);
    header("Location: admin_dash.php?msg=approved");
    exit();
}

// ==========================================
// 2. TRAITEMENT : SUPPRIMER UN PRODUIT (DELETE)
// ==========================================
if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $id_prod = intval($_GET['id']);
    
    // Njibou l-image bch nms7oha mn l-dossier uploads/
    $stmt_img = $pdo->prepare("SELECT image FROM produits WHERE id = :id");
    $stmt_img->execute([':id' => $id_prod]);
    $prod = $stmt_img->fetch();
    
    if ($prod) {
        if (file_exists("uploads/" . $prod['image'])) {
            unlink("uploads/" . $prod['image']);
        }
        // Msa7 mn la base de données
        $stmt_del = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt_del->execute([':id' => $id_prod]);
        header("Location: admin_dash.php?msg=deleted");
        exit();
    }
}

// ==========================================
// 3. TRAITEMENT : MODIFIER UN PRODUIT (UPDATE)
// ==========================================
if (isset($_POST['modifier_produit'])) {
    $id_prod = intval($_POST['id_produit']);
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    
    // Check wach l-admin bgha y-bdl t-tswira
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update m3a l-image l-jdida
            $sql = "UPDATE produits SET titre = :titre, description = :description, prix = :prix, image = :image WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':titre' => $titre, ':description' => $description, ':prix' => $prix, ':image' => $image_name, ':id' => $id_prod]);
        }
    } else {
        // Update bla tbdil dial l-image
        $sql = "UPDATE produits SET titre = :titre, description = :description, prix = :prix WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':titre' => $titre, ':description' => $description, ':prix' => $prix, ':id' => $id_prod]);
    }
    header("Location: admin_dash.php?msg=updated");
    exit();
}

// ==========================================
// 4. RÉCUPÉRATION DES DONNÉES POUR L-AFFICHAGE
// ==========================================
// A. Produits en attente
$sql_attente = "SELECT p.*, a.nom as artisan_nom FROM produits p JOIN artisans a ON p.artisan_id = a.id WHERE p.statut = 'en_attente' ORDER BY p.date_ajout DESC";
$produits_en_attente = $pdo->query($sql_attente)->fetchAll();

// B. Produits déjà approuvés (bch l-admin y9der y-msa7hom wla y-modifihom 7ta homa)
$sql_approuve = "SELECT p.*, a.nom as artisan_nom FROM produits p JOIN artisans a ON p.artisan_id = a.id WHERE p.statut = 'approuve' ORDER BY p.date_ajout DESC";
$produits_approuves = $pdo->query($sql_approuve)->fetchAll();

// C. Si l-admin a cliqué sur "Modifier", on récupère les infos du produit unique
$produit_a_modifier = null;
if (isset($_GET['edit_id'])) {
    $stmt_edit = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
    $stmt_edit->execute([':id' => intval($_GET['edit_id'])]);
    $produit_a_modifier = $stmt_edit->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Administration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin-top: 120px; padding: 20px; background-color: #fdfaf6; }
        .admin-container { max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; gap: 40px; }
        .section-box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid var(--copper); }
        h2 { color: var(--primary-brown); margin-bottom: 20px; border-bottom: 2px solid #f7f1eb; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f7f1eb; color: var(--primary-brown); }
        .img-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
        
        /* Les Boutons d'action */
        .btn-act { padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; margin-right: 5px; display: inline-block; }
        .btn-v { background: #28a745; color: #fff; } /* Valider */
        .btn-v:hover { background: #218838; }
        .btn-e { background: #ffc107; color: #212529; } /* Modifier */
        .btn-e:hover { background: #e0a800; }
        .btn-d { background: #d9534f; color: #fff; } /* Supprimer */
        .btn-d:hover { background: #c9302c; }

        /* Notification */
        .alert { background: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb; font-weight: 500; text-align: center; }
        
        /* Formulaire de modification simple style */
        .edit-form { background: #fff; padding: 20px; border: 2px solid var(--copper); border-radius: 8px; margin-bottom: 30px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 15px; }
        .form-group input, .form-group textarea { padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="admin-container">

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert">
            <?php 
                if($_GET['msg'] == 'approved') echo "Le produit a été approuvé et publié !";
                if($_GET['msg'] == 'deleted') echo "Le produit a été supprimé définitivement !";
                if($_GET['msg'] == 'updated') echo "Le produit a été modifié avec succès !";
            ?>
        </div>
    <?php endif; ?>

    <?php if ($produit_a_modifier): ?>
        <div class="edit-form">
            <h3 style="color: var(--primary-brown); margin-bottom: 15px;">Modifier le produit : <?php echo $produit_a_modifier['titre']; ?></h3>
            <form action="admin_dash.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_produit" value="<?php echo $produit_a_modifier['id']; ?>">
                
                <div class="form-group">
                    <label>Titre du produit</label>
                    <input type="text" name="titre" value="<?php echo $produit_a_modifier['titre']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Prix (DH)</label>
                    <input type="number" step="0.01" name="prix" value="<?php echo $produit_a_modifier['prix']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" required><?php echo $produit_a_modifier['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Changer l'image (Laissez vide pour garder l'ancienne)</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <button type="submit" name="modifier_produit" class="btn-act btn-v" style="border:none; cursor:pointer; padding:10px 20px;">Enregistrer les modifications</button>
                <a href="admin_dash.php" style="color: #666; margin-left:15px; text-decoration:none;">Annuler</a>
            </form>
        </div>
    <?php endif; ?>


    <div class="section-box">
        <h2>📥 Demandes de Validation (En Attente)</h2>
        <?php if(count($produits_en_attente) == 0): ?>
            <p style="color:#777;">Aucun produit en attente de validation.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Artisan</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produits_en_attente as $p): ?>
                        <tr>
                            <td><img src="uploads/<?php echo $p['image']; ?>" class="img-thumb"></td>
                            <td><strong><?php echo $p['titre']; ?></strong></td>
                            <td><?php echo $p['artisan_nom']; ?></td>
                            <td><?php echo $p['prix']; ?> DH</td>
                            <td>
                                <a href="admin_dash.php?action=approuver&id=<?php echo $p['id']; ?>" class="btn-act btn-v">Approuver</a>
                                <a href="admin_dash.php?edit_id=<?php echo $p['id']; ?>" class="btn-act btn-e">Modifier</a>
                                <a href="admin_dash.php?action=supprimer&id=<?php echo $p['id']; ?>" class="btn-act btn-d" onclick="return confirm('Supprimer définitivement ce produit ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>


    <div class="section-box">
        <h2>✅ Produits Publiés (En Ligne)</h2>
        <?php if(count($produits_approuves) == 0): ?>
            <p style="color:#777;">Aucun produit n'est en ligne pour le moment.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Artisan</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produits_approuves as $p): ?>
                        <tr>
                            <td><img src="uploads/<?php echo $p['image']; ?>" class="img-thumb"></td>
                            <td><strong><?php echo $p['titre']; ?></strong></td>
                            <td><?php echo $p['artisan_nom']; ?></td>
                            <td><?php echo $p['prix']; ?> DH</td>
                            <td>
                                <a href="admin_dash.php?edit_id=<?php echo $p['id']; ?>" class="btn-act btn-e">Modifier</a>
                                <a href="admin_dash.php?action=supprimer&id=<?php echo $p['id']; ?>" class="btn-act btn-d" onclick="return confirm('Supprimer ce produit du site ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>

</body>
</html>