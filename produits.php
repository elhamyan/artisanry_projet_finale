<?php
include 'connexion.php';

$sql = "SELECT * FROM produits";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<h3><?php echo $row['nom']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><?php echo $row['prix']; ?> DH</p>

<a href="modifier_produit.php?id=<?php echo $row['id']; ?>">
Modifier
</a>

<a href="supprimer_produit.php?id=<?php echo $row['id']; ?>">
Supprimer
</a>

<hr>

<?php
}
?>