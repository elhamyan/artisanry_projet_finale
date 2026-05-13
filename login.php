<?php
session_start();
include 'connexion.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM artisans WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if($password == $user['password']){

            $_SESSION['artisan_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];

            header("Location: dashboard.php");
        }
        else{
            echo "Mot de passe incorrect";
        }

    } else{
        echo "Utilisateur introuvable";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <button type="submit" name="login">Login</button>
</form>



