<?php 
include 'includes/header.php'; 
$msg = "";

if (isset($_POST['send_contact'])) {
    // Hna standard text message, f l-avenir t9der t-sauvegardih f table dyal l'admin
    $msg = "Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.";
}
?>

<main style="margin-top: 120px; padding: 40px 20px; display: flex; justify-content: center;">
    <div style="width: 100%; max-width: 500px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--copper);">
        <h2 style="color: var(--primary-brown); margin-bottom: 20px; text-align: center;">Contactez-nous</h2>
        
        <?php if(!empty($msg)): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center;"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form action="contact.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #555;">Nom complet</label>
                <input type="text" name="name" required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #555;">Email</label>
                <input type="email" name="email" required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; color: #555;">Message</label>
                <textarea name="message" rows="5" required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
            </div>
            <button type="submit" name="send_contact" style="background: var(--primary-brown); color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">Envoyer</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>