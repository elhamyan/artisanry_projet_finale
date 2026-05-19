<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artisanry — Artisanat Traditionnel Marocain</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Tajawal:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ═══ NAV ═══ -->
<nav>
  <a href="#" class="logo">Artis<span>anry</span></a>
  <div class="nav-links">
    <a href="#" class="active">Accueil</a>
    <a href="#services">Services</a>
    <a href="#" class="btn-connexion" onclick="openModal(); return false;">Connexion</a>
  </div>
</nav>

<!-- ═══ HERO ═══ -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-pattern"></div>
  <div class="hero-img"></div>
  <div class="hero-content">
    <div class="hero-eyebrow">Artisanat Traditionnel Marocain</div>
    <h1>L'Art de nos <em>Ancêtres,</em><br>Vivant Aujourd'hui</h1>
    <p>Découvrez des pièces uniques façonnées à la main par des artisans passionnés. Chaque objet porte l'âme d'un savoir-faire transmis de génération en génération.</p>
    <div class="hero-btns">
      <a href="#services" class="btn-primary">Nos Services</a>
    </div>
  </div>
</section>

<!-- ═══ SERVICES ═══ -->
<section id="services">
  <div class="section-header">
    <div class="section-label">Nos Services</div>
    <h2>Pour Qui Sommes-Nous ?</h2>
  </div>
  <p class="services-intro">
    Artisanry réunit clients passionnés et artisans talentueux. Rejoignez notre communauté et bénéficiez de services adaptés à vos besoins.
  </p>

  <div class="services-columns">

    <!-- ── COLONNE CLIENTS ── -->
    <div>
      <div class="services-col-header">
        <div class="col-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div>
          <h3>Espace Client</h3>
          <p>Découvrez et commandez l'artisanat authentique</p>
        </div>
      </div>

      <!-- Card 1 -->
      <div class="service-card" style="animation-delay:0.1s">
        <div class="service-card-top">
          <div class="service-icon">🛍️</div>
          <div>
            <h4>Accès au Catalogue Complet</h4>
          </div>
        </div>
        <p>Parcourez des centaines de pièces uniques créées par nos artisans sélectionnés. Filtrez par catégorie, région ou savoir-faire.</p>
        <ul class="service-features">
          <li>Catalogue filtrable par catégorie</li>
          <li>Fiches produits détaillées avec prix</li>
          <li>Contact direct artisan via WhatsApp</li>
        </ul>
        <button class="btn-register" onclick="openRegModal('client')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          S'inscrire comme Client
        </button>
      </div>

      <!-- Card 2 -->
      <div class="service-card" style="animation-delay:0.2s">
        <div class="service-card-top">
          <div class="service-icon">⭐</div>
          <div>
            <h4>Commandes & Favoris</h4>
          </div>
        </div>
        <p>Sauvegardez vos articles préférés, suivez vos demandes et restez connecté avec les artisans de votre choix.</p>
        <ul class="service-features">
          <li>Liste de favoris personnalisée</li>
          <li>Historique de vos demandes</li>
          <li>Notifications sur les nouveautés</li>
        </ul>
        <button class="btn-register" onclick="openRegModal('client')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          S'inscrire comme Client
        </button>
      </div>
    </div>

    <!-- ── COLONNE ARTISANS ── -->
    <div>
      <div class="services-col-header">
        <div class="col-icon gold-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <div>
          <h3>Espace Artisan</h3>
          <p>Présentez et vendez votre savoir-faire</p>
        </div>
      </div>

      <!-- Card 1 -->
      <div class="service-card artisan-card" style="animation-delay:0.15s">
        <div class="service-card-top">
          <div class="service-icon">🏺</div>
          <div>
            <h4>Vitrine en Ligne Gratuite</h4>
          </div>
        </div>
        <p>Créez votre profil artisan et publiez vos produits facilement. Touchez des clients dans tout le Maroc et à l'international.</p>
        <ul class="service-features">
          <li>Profil artisan personnalisé</li>
          <li>Publication illimitée d'articles</li>
          <li>Gestion des prix et descriptions</li>
        </ul>
        <button class="btn-register gold-btn" onclick="openRegModal('artisan')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          S'inscrire comme Artisan
        </button>
      </div>

      <!-- Card 2 -->
      <div class="service-card artisan-card" style="animation-delay:0.25s">
        <div class="service-card-top">
          <div class="service-icon">📱</div>
          <div>
            <h4>Commandes via WhatsApp</h4>
          </div>
        </div>
        <p>Recevez les demandes de vos clients directement sur WhatsApp. Négociez, confirmez et livrez simplement, sans intermédiaire.</p>
        <ul class="service-features">
          <li>Lien WhatsApp personnalisé</li>
          <li>Messages clients pré-formatés</li>
          <li>Zéro commission sur vos ventes</li>
        </ul>
        <button class="btn-register gold-btn" onclick="openRegModal('artisan')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          S'inscrire comme Artisan
        </button>
      </div>
    </div>
    <div class="service-section">
    <div class="service-header visitor-header">
        <div class="icon-box visitor-icon">
            <span class="emoji-icon">👁️</span> 
        </div>
        <div class="header-text">
            <h3>Espace Visiteur</h3>
            <p>Explorez la plateforme librement sans inscription</p>
        </div>
    </div>

    <div class="service-card">
        <div class="card-title-row">
            <div class="title-icon-box visitor-sub-icon">🏺</div>
            <h4>Accès Libre à la Découverte</h4>
        </div>
        
        <p class="card-description">
            Parcourez notre galerie publique et découvrez le savoir-faire marocain. Idéal pour jeter un coup d'œil rapide ou s'inspirer sans engagement.
        </p>

        <ul class="card-features">
            <li><span class="check-mark">✓</span> Consultation des produits phares</li>
            <li><span class="check-mark">✓</span> Recherche par région et spécialité</li>
            <li><span class="check-mark">✓</span> Découverte des histoires des artisans</li>
        </ul>

        <a href="#" class="btn-service btn-visitor">
            <span class="plus-sign">+</span> Explorer sans compte
        </a>
    </div>
</div>



  </div>
</section>

<!-- ═══ MODAL INSCRIPTION CLIENT ═══ -->
<div class="reg-modal-overlay" id="modal-client">
  <div class="reg-modal">
    <button class="reg-modal-close" onclick="closeRegModal('client')">×</button>
    <div class="reg-modal-header">
      <h2>Inscription Client</h2>
      <p>Créez votre compte pour accéder au catalogue artisanal</p>
    </div>
    <div class="reg-modal-body">
      <div id="client-form-wrap">
        <div class="reg-form">
          <div class="reg-row">
            <div class="reg-field">
              <label>Nom complet *</label>
              <input type="text" id="c-nom" placeholder="Votre nom">
            </div>
            <div class="reg-field">
              <label>Téléphone</label>
              <input type="tel" id="c-tel" placeholder="+212 6XX XXX XXX">
            </div>
          </div>
          <div class="reg-field">
            <label>Email *</label>
            <input type="email" id="c-email" placeholder="votre@email.com">
          </div>
          <div class="reg-field">
            <label>Mot de passe *</label>
            <input type="password" id="c-pass" placeholder="Minimum 8 caractères">
          </div>
          <div class="reg-field">
            <label>Confirmer le mot de passe *</label>
            <input type="password" id="c-pass2" placeholder="Répétez votre mot de passe">
          </div>
          <div class="reg-submit">
            <button onclick="submitClient()">Créer mon compte Client</button>
          </div>
        </div>
      </div>
      <div class="reg-success" id="client-success">
        <div class="reg-success-icon">✅</div>
        <h3>Bienvenue !</h3>
        <p>Votre compte client a été créé avec succès.<br>Vous pouvez maintenant explorer notre catalogue.</p>
      </div>
    </div>
  </div>
</div>

<!-- ═══ MODAL INSCRIPTION ARTISAN ═══ -->
<div class="reg-modal-overlay" id="modal-artisan">
  <div class="reg-modal artisan-modal">
    <button class="reg-modal-close" onclick="closeRegModal('artisan')">×</button>
    <div class="reg-modal-header">
      <h2>Inscription Artisan</h2>
      <p>Rejoignez notre plateforme et présentez votre savoir-faire</p>
    </div>
    <div class="reg-modal-body">
      <div id="artisan-form-wrap">
        <div class="reg-form">
          <div class="reg-row">
            <div class="reg-field">
              <label>Nom complet *</label>
              <input type="text" id="a-nom" placeholder="Votre nom">
            </div>
            <div class="reg-field">
              <label>Téléphone *</label>
              <input type="tel" id="a-tel" placeholder="+212 6XX XXX XXX">
            </div>
          </div>
          <div class="reg-row">
            <div class="reg-field">
              <label>Email *</label>
              <input type="email" id="a-email" placeholder="votre@email.com">
            </div>
            <div class="reg-field">
              <label>Ville</label>
              <select id="a-ville">
                <option value="">— Sélectionner —</option>
                <option>Fès</option>
                <option>Marrakech</option>
                <option>Casablanca</option>
                <option>Rabat</option>
                <option>Meknès</option>
                <option>Essaouira</option>
                <option>Agadir</option>
                <option>Tétouan</option>
                <option>Autre</option>
              </select>
            </div>
          </div>
          <div class="reg-field">
            <label>Spécialité / Savoir-faire</label>
            <input type="text" id="a-spec" placeholder="Ex: Poterie, Tissage, Cuir...">
          </div>
          <div class="reg-field">
            <label>Mot de passe *</label>
            <input type="password" id="a-pass" placeholder="Minimum 8 caractères">
          </div>
          <div class="reg-submit">
            <button onclick="submitArtisan()">Créer mon compte Artisan</button>
          </div>
        </div>
      </div>
      <div class="reg-success" id="artisan-success">
        <div class="reg-success-icon">🏺</div>
        <h3>Demande envoyée !</h3>
        <p>Votre inscription artisan est en cours de validation.<br>Nous vous contacterons dans les 24h pour activer votre compte.</p>
      </div>
    </div>
  </div>
</div>

<!-- ═══ FOOTER ═══ -->
<footer>
  <a href="#" class="logo">Artis<span>anry</span></a>
  <p>© 2025 Artisanry — Artisanat Traditionnel Marocain</p>
</footer>

<!-- ═══ MODAL CONNEXION ═══ -->
<div class="modal-overlay" id="modal">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">×</button>
    <h2>Bienvenue</h2>
    <p>Connectez-vous ou créez un compte client</p>
    <div class="modal-tabs">
      <button class="modal-tab active" onclick="switchTab('login', this)">Connexion</button>
      <button class="modal-tab" onclick="switchTab('register', this)">Inscription</button>
    </div>
    <!-- Login -->
    <div class="modal-form active" id="tab-login">
      <div class="form-group">
        <label>Email</label>
        <input type="email" placeholder="votre@email.com" id="login-email">
      </div>
      <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" placeholder="••••••••" id="login-password">
      </div>
      <button class="btn-full" onclick="handleLogin()">Se connecter</button>
      <div class="modal-note">
        <a href="admin.html">Espace Artisan / Admin →</a>
      </div>
    </div>
    <!-- Register -->
    <div class="modal-form" id="tab-register">
      <div class="form-group">
        <label>Nom complet</label>
        <input type="text" placeholder="Votre nom" id="reg-nom">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" placeholder="votre@email.com" id="reg-email">
      </div>
      <div class="form-group">
        <label>Téléphone</label>
        <input type="tel" placeholder="+212 6XX XXX XXX" id="reg-tel">
      </div>
      <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" placeholder="••••••••" id="reg-password">
      </div>
      <button class="btn-full" onclick="handleRegister()">Créer un compte</button>
    </div>
  </div>
</div>

<script>
// ─── REGISTRATION MODALS ─────────────────────────────────────────────────
function openRegModal(type) {
  document.getElementById('modal-' + type).classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeRegModal(type) {
  document.getElementById('modal-' + type).classList.remove('open');
  document.body.style.overflow = '';
}
// Close on overlay click
document.getElementById('modal-client').addEventListener('click', e => { if (e.target === e.currentTarget) closeRegModal('client'); });
document.getElementById('modal-artisan').addEventListener('click', e => { if (e.target === e.currentTarget) closeRegModal('artisan'); });

function submitClient() {
  const nom = document.getElementById('c-nom').value.trim();
  const email = document.getElementById('c-email').value.trim();
  const pass = document.getElementById('c-pass').value;
  const pass2 = document.getElementById('c-pass2').value;
  if (!nom || !email || !pass) { alert('Veuillez remplir les champs obligatoires *'); return; }
  if (pass !== pass2) { alert('Les mots de passe ne correspondent pas.'); return; }
  if (pass.length < 8) { alert('Le mot de passe doit contenir au moins 8 caractères.'); return; }
  // ➜ Intégrez ici votre appel PHP: fetch('register_client.php', { method:'POST', body: formData })
  document.getElementById('client-form-wrap').style.display = 'none';
  document.getElementById('client-success').classList.add('show');
}

function submitArtisan() {
  const nom = document.getElementById('a-nom').value.trim();
  const email = document.getElementById('a-email').value.trim();
  const tel = document.getElementById('a-tel').value.trim();
  const pass = document.getElementById('a-pass').value;
  if (!nom || !email || !tel || !pass) { alert('Veuillez remplir les champs obligatoires *'); return; }
  if (pass.length < 8) { alert('Le mot de passe doit contenir au moins 8 caractères.'); return; }
  // ➜ Intégrez ici votre appel PHP: fetch('register_artisan.php', { method:'POST', body: formData })
  document.getElementById('artisan-form-wrap').style.display = 'none';
  document.getElementById('artisan-success').classList.add('show');
}

// ─── MODAL CONNEXION ─────────────────────────────────────────────────────
function openModal() { document.getElementById('modal').classList.add('open'); }
function closeModal() { document.getElementById('modal').classList.remove('open'); }
document.getElementById('modal').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

function switchTab(tab, btn) {
  document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.modal-form').forEach(f => f.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-' + tab).classList.add('active');
}

function handleLogin() {
  const email = document.getElementById('login-email').value;
  const pass = document.getElementById('login-password').value;
  if (!email || !pass) { alert('Veuillez remplir tous les champs.'); return; }
  alert('Connexion réussie ! (Intégrez votre backend PHP ici)');
  closeModal();
}

function handleRegister() {
  const nom = document.getElementById('reg-nom').value;
  const email = document.getElementById('reg-email').value;
  const pass = document.getElementById('reg-password').value;
  if (!nom || !email || !pass) { alert('Veuillez remplir tous les champs obligatoires.'); return; }
  alert('Compte créé ! (Intégrez votre backend PHP ici)');
  closeModal();
}

// ─── SMOOTH SCROLL ────────────────────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
  });
});
</script>
</body>
</html>