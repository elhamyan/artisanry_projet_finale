<?php

if(isset($_POST['send'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $to = "azizaelhamyani40@gmail.com";

    $subject = "Nouveau message client";

    $body = "
    Nom : $nom

    Email : $email

    Message :
    $message
    ";

    $headers = "From: $email";

    if(mail($to, $subject, $body, $headers)){
        echo "<script>alert('Message envoyé avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\\'envoi');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Formulaire Client</h2>

    <form>

        <input type="text" placeholder="Nom complet" required>

        <input type="email" placeholder="Email" required>

        <textarea placeholder="Votre message"></textarea>

        <button type="submit">Envoyer</button>

    </form>

</div>

</body>
</html>