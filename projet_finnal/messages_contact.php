<?php 
require 'connexion _db.php';
session_start();

$msg = "";
$status = "";

// 1. RECUPERATION DE L-ID PRODUIT MN L-LIEN (URL)
$produit_id = isset($_GET['produit_id']) ? intval($_GET['produit_id']) : 0;
$artisan_id = 0;

// Ila jla l-client mn la page produits, njibou l-id dyal l'artisan li sweb dak l-produit
if ($produit_id > 0) {
    $stmt_prod = $pdo->prepare("SELECT artisan_id FROM produits WHERE id = :id");
    $stmt_prod->execute([':id' => $produit_id]);
    $prod_info = $stmt_prod->fetch();
    if ($prod_info) {
        $artisan_id = $prod_info['artisan_id'];
    }
}

// 2. TRAITEMENT DYAL L-ENREGISTREMENT (INSERT)
if (isset($_POST['send_order'])) {
    $message_text = htmlspecialchars($_POST['message']);
    $p_id = intval($_POST['produit_id']);
    $a_id = intval($_POST['artisan_id']);
    
    // Hna ghadi n-diro idclient fictif (Ex: 1) 7ta t-swb login.php dyal l-client
    // Mn b3d ghadi y-rj3: $client_id = $_SESSION['client_id'];
    $client_id = 1; 

    if (!empty($message_text)) {
        // La requête direct f la table orders kima 3ndk exact!
        $sql = "INSERT INTO orders (idclient, idartisan, idproduit, idmessage, date_envoi) 
                VALUES (:idclient, :idartisan, :idproduit, :idmessage, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':idclient'  => $client_id,
            ':idartisan'  => $a_id,
            ':idproduit'  => $p_id,
            ':idmessage'  => $message_text // 7ttna l-message f had la colonne kima dertيها
        ]);
        
        $msg = "Votre commande/message a été envoyé avec succès !";
        $status = "success";
    } else {
        $msg = "Veuillez écrire un message pour l'artisan.";
        $status = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commander le Produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main style="margin-top: 120px; padding: 40px 20px; display: flex; justify-content: center; background-color: #fdfaf6;">
    <div style="width: 100%; max-width: 500px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--copper);">
        <h2 style="color: var(--primary-brown); margin-bottom: 20px; text-align: center;">Envoyer une Commande</h2>
        
        <?php if(!empty($msg)): ?>
            <div style="padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; 
                background: <?php echo ($status == 'success') ? '#d4edda' : '#f8d7da'; ?>; 
                color: <?php echo ($status == 'success') ? '#155724' : '#721c24'; ?>;">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <form action="contact.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <input type="hidden" name="produit_id" value="<?php echo $produit_id; ?>">
            <input type="hidden" name="artisan_id" value="<?php echo $artisan_id; ?>">

            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #555;">Votre Message / Détails de la commande</label>
                <textarea name="message" rows="6" placeholder="Ex: Bonjour, je veux commander ce produit, la taille..." required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit;"></textarea>
            </div>
            
            <button type="submit" name="send_order" style="background: var(--primary-brown); color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s;">
                Confirmé la Commande
            </button>
            <a href="produits.php" style="text-align: center; color: #666; text-decoration: none; font-size: 14px; margin-top: 5px;">Retour au catalogue</a>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>