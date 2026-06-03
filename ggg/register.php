<?php
require 'connexion _db.php';
session_start();

$message = "";
$status = "";

if (isset($_POST['register'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $ville = htmlspecialchars($_POST['ville']);
    $bio = htmlspecialchars($_POST['bio']);
    $password = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Sécurité max

    // Vérifier wach l'email déjà f la base
    $check = $pdo->prepare("SELECT id FROM artisans WHERE email = :email");
    $check->execute([':email' => $email]);
    
    if ($check->rowCount() > 0) {
        $message = "Cet email est déjà utilisé !";
        $status = "error";
    } else {
        // Insertion dial l'artisan
        $sql = "INSERT INTO artisans (nom, email, mot_de_passe, telephone, ville, bio) 
                VALUES (:nom, :email, :password, :telephone, :ville, :bio)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':password' => $password,
            ':telephone' => $telephone,
            ':ville' => $ville,
            ':bio' => $bio
        ]);
        
        $message = "Inscription réussie ! Vous pouvez vous connecter.";
        $status = "success";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Artisan</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { margin-top: 120px; display: flex; justify-content: center; padding: 20px; }
        .auth-box { width: 100%; max-width: 500px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--copper); }
        .auth-box h2 { color: var(--primary-brown); margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        .form-group label { margin-bottom: 5px; font-weight: 600; color: #555; }
        .form-group input, .form-group textarea { padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-auth { background: var(--primary-brown); color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; width: 100%; margin-top: 10px; }
        .btn-auth:hover { background: var(--copper); }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .auth-link { text-align: center; margin-top: 15px; }
        .auth-link a { color: var(--copper); text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="auth-box">
    <h2>Créer un Compte Artisan</h2>
    
    <?php if(!empty($message)): ?>
        <div class="alert alert-<?php echo $status; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <div class="form-group">
            <label>Nom complet / Atelier</label>
            <input type="text" name="nom" required placeholder="Ex: Ahmed El Fakhar">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Ex: ahmed@mail.com">
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required minlength="6">
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone" required placeholder="Ex: 0612345678">
        </div>
        <div class="form-group">
            <label>Ville</label>
            <input type="text" name="ville" required placeholder="Ex: Safi, Fès...">
        </div>
        <div class="form-group">
            <label>Votre Bio / Spécialité</label>
            <textarea name="bio" rows="3" placeholder="Parlez brièvement de vos créations..."></textarea>
        </div>
        <button type="submit" name="register" class="btn-auth">S'inscrire</button>
    </form>
    
    <div class="auth-link">
        Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>
    </div>
</div>

</body>
</html>