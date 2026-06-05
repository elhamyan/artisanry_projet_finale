<?php
require 'connexion _db.php';
session_start();

$message = "";

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['mot_de_passe'];

    // Récupérer l'artisan b l'email
    $stmt = $pdo->prepare("SELECT * FROM artisans WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $artisan = $stmt->fetch();

    // Vérifier mot de passe hashé
    if ($artisan && password_verify($password, $artisan['mot_de_passe'])) {
        $_SESSION['artisan_id'] = $artisan['id'];
        $_SESSION['artisan_nom'] = $artisan['nom'];
        
        header("Location: artisan_dash.php");
        exit();
    } else {
        $message = "Email ou mot de passe incorrect !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Artisan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin-top: 150px; display: flex; justify-content: center; padding: 20px; }
        .auth-box { width: 100%; max-width: 400px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--copper); }
        .auth-box h2 { color: var(--primary-brown); margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        .form-group label { margin-bottom: 5px; font-weight: 600; color: #555; }
        .form-group input { padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-auth { background: var(--primary-brown); color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; width: 100%; margin-top: 10px; }
        .btn-auth:hover { background: var(--copper); }
        .alert-error { padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #f8d7da; color: #721c24; text-align: center; }
        .auth-link { text-align: center; margin-top: 15px; }
        .auth-link a { color: var(--copper); text-decoration: none; font-weight: bold; }
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="auth-box">
    <h2>Espace Artisan</h2>
    
    <?php if(!empty($message)): ?>
        <div class="alert-error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="votre@email.com">
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required>
        </div>
        <button type="submit" name="login" class="btn-auth">Se Connecter</button>
    </form>
    
    <div class="auth-link">
        Nouveau sur la plateforme ? <a href="register.php">Inscrivez-vous</a>
    </div>
</div>

</body>
</html>