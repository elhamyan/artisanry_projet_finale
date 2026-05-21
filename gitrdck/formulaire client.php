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
       <style>
        /* Reset de base bach yji l'affichage b7al b7al f ga3 les navigateurs */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* L'arrière-plan w centrage dyal l'formulaire f lwest dyal la page */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('image/background.png'); 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Le cadre (box) li jam3 l'formulaire */
.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 420px;
}

/* L'3enwan */
h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 25px;
    font-size: 24px;
}

/* Tarteeb dyal les champs wa7d t7t wa7d */
form {
    display: flex;
    flex-direction: column;
}

/* Les champs de saisie (Inputs w Textarea) */
input[type="text"],
textarea {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    font-family: inherit;
    font-size: 15px;
    transition: border-color 0.3s ease;
}

/* Fach katcliqui 3la l'input (Focus) */
input[type="text"]:focus,
textarea:focus {
    border-color: #d88c51; /* Loun artisan/terre cuite */
    outline: none;
}

/* Réglage khass b textarea bach tkon kbira chwiya */
textarea {
    resize: vertical;
    min-height: 120px;
}

/* L'bouton d'ajout */
button {
    background-color: #d88c51; 
    color: white;
    padding: 14px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.1s;
}

/* Animation sghira fach kat7t la souris 3la l'bouton */
button:hover {
    background-color: #bf7842;
}

/* Animation sghira fach katwrek 3la l'bouton */
button:active {
    transform: scale(0.98);
}
    </style>
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