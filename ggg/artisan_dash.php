<?php
// 1. L-CONNEXION W L-SESSIONS
require 'connexion _db';
session_start();

// Hna rani dert id fictif (Ex: 1) gha bch t-tester, mn b3d mli t7et login.php ghadi t-tbdel b: $_SESSION['artisan_id']
$artisan_id = 1; 

$message = "";
$status = "";

// ==========================================
// 2. TRAITEMENT : AJOUTER UN PRODUIT (CREATE)
// ==========================================
if (isset($_POST['ajouter_produit'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $categorie_id = intval($_POST['categorie_id']);
    
    // Upload dyal l-image
    $target_dir = "uploads/";
    // Bch image matتعاودش, nzidouha time() f l-smiya
    $image_name = time() . "_" . basename($_file = $_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérification wach image nite
    if(!empty($_FILES["image"]["tmp_name"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            $message = "Le fichier n'est pas une image.";
            $status = "error";
            $uploadOk = 0;
        }
    } else {
        $message = "Veuillez sélectionner une image.";
        $status = "error";
        $uploadOk = 0;
    }

    // Ila l-image mzyana, ndwzo l-upload w l-base de données
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Requête SQL b PDO
            $sql = "INSERT INTO produits (titre, description, prix, image, artisan_id, categorie_id) 
                    VALUES (:titre, :description, :prix, :image, :artisan_id, :categorie_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':prix' => $prix,
                ':image' => $image_name,
                ':artisan_id' => $artisan_id,
                ':categorie_id' => $categorie_id
            ]);
            $message = "Produit ajouté avec succès !";
            $status = "success";
        } else {
            $message = "Erreur lors de l'uploade de l'image.";
            $status = "error";
        }
    }
}

// ==========================================
// 3. TRAITEMENT : SUPPRIMER UN PRODUIT (DELETE)
// ==========================================
if (isset($_GET['supprimer'])) {
    $id_produit = intval($_GET['supprimer']);
    
    // Njibou smiya d l-image bch nms7oha 7ta mn l-dossier uploads/
    $sql_img = "SELECT image FROM produits WHERE id = :id AND artisan_id = :artisan_id";
    $stmt_img = $pdo->prepare($sql_img);
    $stmt_img->execute([':id' => $id_produit, ':artisan_id' => $artisan_id]);
    $prod = $stmt_img->fetch();
    
    if ($prod) {
        if (file_exists("uploads/" . $prod['image'])) {
            unlink("uploads/" . $prod['image']); // Msa7 t-tswira mn l-serveur
        }
        
        // Msa7 mn l-base de données
        $sql_del = "DELETE FROM produits WHERE id = :id AND artisan_id = :artisan_id";
        $stmt_del = $pdo->prepare($sql_del);
        $stmt_del->execute([':id' => $id_produit, ':artisan_id' => $artisan_id]);
        
        header("Location: artisan_dash.php?msg=deleted");
        exit();
    }
}

// ==========================================
// 4. RÉCUPÉRATION DES DONNÉES (READ)
// ==========================================
// Njibou l-produits dyal had l-artisan bo7do
$sql_produits = "SELECT p.*, c.nom_categorie FROM produits p 
                 LEFT JOIN categories c ON p.categorie_id = c.id 
                 WHERE p.artisan_id = :artisan_id ORDER BY p.date_ajout DESC";
$stmt_prod = $pdo->prepare($sql_produits);
$stmt_prod->execute([':artisan_id' => $artisan_id]);
$mes_produits = $stmt_prod->fetchAll();

// Njibou l-catégories bch n-affichouhom f l-formulaire (Select)
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Artisan</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS Khass b l-Dashboard bch ykoun clean w jdid */
        body { margin-top: 100px; padding: 20px; background-color: #fdfaf6; }
        .dash-container { max-width: 1200px; margin: 0 auto; display: flex; gap: 40px; }
        
        /* Formulaire */
        .form-box { flex: 1; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid var(--copper); height: fit-content; }
        .form-box h2 { color: var(--primary-brown); margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        .form-group label { margin-bottom: 5px; font-weight: 600; color: #555; }
        .form-group input, .form-group textarea, .form-group select { padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--copper); outline: none; }
        .btn-add { background-color: var(--primary-brown); color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        .btn-add:hover { background-color: var(--copper); }
        
        /* Table des produits */
        .products-box { flex: 2; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .products-box h2 { color: var(--primary-brown); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; }
        th { background-color: #f7f1eb; color: var(--primary-brown); }
        .img-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; }
        .btn-delete { color: #d9534f; text-decoration: none; font-weight: bold; }
        .btn-delete:hover { text-decoration: underline; }
        
        /* Notification Messages */
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; font-weight: 500; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="dash-container">
    
    <!-- ÉCRAN D'AJOUT (FORMULAIRE) -->
    <div class="form-box">
        <h2>Ajouter un Produit</h2>
        
        <?php if(!empty($message)): ?>
            <div class="alert alert-<?php echo $status; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success">Produit supprimé avec succès !</div>
        <?php endif; ?>

        <!-- Note: Khass dima enctype="multipart/form-data" f l-upload d t-tsawer -->
        <form action="artisan_dash.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom du produit</label>
                <input type="text" name="titre" required placeholder="Ex: Tapis Zayanis">
            </div>
            
            <div class="form-group">
                <label>Catégorie</label>
                <select name="categorie_id" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Prix (DH)</label>
                <input type="number" step="0.01" name="prix" required placeholder="Ex: 450.00">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" required placeholder="Détails sur la fabrication, matière..."></textarea>
            </div>

            <div class="form-group">
                <label>Image du produit</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <button type="submit" name="ajouter_produit" class="btn-add">Enregistrer le Produit</button>
        </form>
    </div>

    <!-- LISTE DES PRODUITS (TABLEAU) -->
    <div class="products-box">
        <h2>Mes Produits Exposés</h2>
        
        <?php if(count($mes_produits) == 0): ?>
            <p>Vous n'avez pas encore ajouté de produits. Commencez dès maintenant !</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mes_produits as $p): ?>
                        <tr>
                            <td><img src="uploads/<?php echo $p['image']; ?>" class="img-thumb" alt=""></td>
                            <td><strong><?php echo $p['titre']; ?></strong></td>
                            <td><?php echo $p['nom_categorie'] ?? 'Non classé'; ?></td>
                            <td><?php echo $p['prix']; ?> DH</td>
                            <td>
                                <a href="artisan_dash.php?supprimer=<?php echo $p['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
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