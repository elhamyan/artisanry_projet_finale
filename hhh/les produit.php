<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<nav class="navbar">
        <h1>Artisanry</h1>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="crud.php">Connexion</a></li>
        <li><a href="#services">Services</a></li>
    </ul>
</nav>

<body>
    <style>
body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(222, 172, 172, 0.5)), url('background.png');
    background-position:left;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    
    /* Added some default height and padding for a hero section */
    min-height: 80vh; 
    display: flex;
    
    justify-content:left;
}
    /* L'bassa li jm3a ga3 les produits */
.products-section {
    width: 100%;
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}


.navbar {
    display: flex;
    justify-content: space-between; /* This pushes the logo to the left and links to the right */
    align-items: center;
    background-color: #613b06; /* Your brown color */
    padding: 15px 30px; /* Gives it breathing room top/bottom and sides */
}

/* The list containing your links */
.nav-links {
    display: flex;
    list-style: none; /* Removes the bullet points */
    gap: 25px; /* Adds space BETWEEN the links automatically */
    margin: 0;
    padding: 0;
}

/* The actual clickable links */
.nav-links a {
    color: #ffffff; /* White text so it's readable on the dark brown background */
    text-decoration: none; /* Removes the default underline */
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s ease;
}

/* Hover effect to make it interactive */
.nav-links a:hover {
    color: #deacac; /* Changes color smoothly when you hover over it */
}

/* L'3enwan dyal la section */
.products-section h3 {
    text-align: center;
    color: #f2f0f0;
    font-size: 22px;
    margin-bottom: 25px;
    position: relative;
}

/* Had l'effet sghir t7t l'3enwan bach yban zwin */
.products-section h3::after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background-color: #d88c51;
    margin: 8px auto 0 auto;
    border-radius: 2px;
}

/* L'grid li kyt7kkm f l'affichage dyal les cartes */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px; /* L'espace bin les cartes */
}

/* L'carte dyal kol produit */
.product-card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    border: 1px solid #eeeeee;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Effet fach kat7t la souris 3la la carte */
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

/* Emoji/Icon dyal l'produit */
.product-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

/* Smiya dyal l'produit */
.product-title {
    color: #333333;
    font-size: 18px;
    margin-bottom: 5px;
}

/* L'badge dyal l'artisan */
.artisan-tag {
    display: inline-block;
    font-size: 12px;
    background-color: #fdf2e9;
    color: #d88c51;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
    margin-bottom: 12px;
}

/* Description dyal l'produit */
.product-desc {
    color: #666666;
    font-size: 14px;
    line-height: 1.5;
}
footer{
    background-color: #513204;
    padding: 33px;
    margin: 0;
    text-align: center;
}

</style>
<header>
<nav>
    <a href="index.php">accuiel</a>
    <a href=""></a>
</nav>
</header>
    

 <main class="products-section">
    <h3>Liste des Produits</h3>
    
    <div class="products-grid">
        <!-- Produit 1 -->
        <div class="product-card">
            <div class="product-icon">🏺</div>
            <h4 class="product-title">Tajine Traditionnel</h4>
            <span class="artisan-tag">Artisan: Ahmed</span>
            <p class="product-desc">Un magnifique tajine en terre cuite fait entièrement à la main, idéal pour une cuisson traditionnelle.</p>
            <button type="submit"> acheter</button>
        </div>

        <!-- Produit 2 -->
        <div class="product-card">
            <div class="product-icon">🧵</div>
            <h4 class="product-title">Tapis Berbère</h4>
            <span class="artisan-tag">Artisane: Fatima</span>
            <p class="product-desc">Tapis en laine pure tissé à la main avec des motifs traditionnels de l'Atlas.</p>
            <button type="submit"> acheter</button>

        </div>

        <!-- Produit 3 -->
        <div class="product-card">
            <div class="product-icon">💼</div>
            <h4 class="product-title">Sac en Cuir</h4>
            <span class="artisan-tag">Artisan: Youssef</span>
            <p class="product-desc">Sac à main en cuir véritable tanné de façon naturelle à Fès, très résistant.</p>
            <button type="submit"> acheter</button>


        </div>
    </div>
 
</main>
<!-- <footer>  
        <p>© 2026 Artisanry</p>
</footer> -->

</body>
</html>