/* ═══════════════════════════════════════════════════════
   ARTISANRY — produits.js
   Contient :
     • Données démo (catégories, artisans, produits)
     • Logique modal Inscription Client / Artisan
     • Logique modal Connexion
     • Smooth scroll
   Remplacez les tableaux démo par des appels fetch() PHP/MySQL
   ═══════════════════════════════════════════════════════ */

/* ────────────────────────────────────────────────────────
   DONNÉES DÉMO
   (À remplacer par : fetch('api/produits.php').then(...))
──────────────────────────────────────────────────────── */
const CATEGORIES = [
  { id: 1, nom: 'Poterie'  },
  { id: 2, nom: 'Cuir'     },
  { id: 3, nom: 'Zellige'  },
  { id: 4, nom: 'Tapis'    },
  { id: 5, nom: 'Bijoux'   },
];

const ARTISANS = [
  { id: 1, nom: 'Hassan El Fassi',    telephone: '212612345678', ville: 'Fès'       },
  { id: 2, nom: 'Fatima Benali',      telephone: '212698765432', ville: 'Marrakech' },
  { id: 3, nom: 'Ahmed Ouazzani',     telephone: '212677889900', ville: 'Meknès'    },
  { id: 4, nom: 'Khadija Moussaoui', telephone: '212655443322', ville: 'Salé'      },
];

const PRODUITS = [
  {
    id: 1,
    nom: 'Tajine Décoratif en Terre Cuite',
    description: 'Tajine artisanal peint à la main, motifs berbères traditionnels. Idéal comme pièce de décoration ou usage culinaire.',
    prix: 320,
    image: 'https://images.unsplash.com/photo-1590080875897-21cb1d003196?w=600&q=80',
    categorie_id: 1,
    artisan_id: 1,
  },
  {
    id: 2,
    nom: 'Babouches en Cuir de Fès',
    description: 'Babouches authentiques en cuir tanné naturellement. Broderie main dorée, confort exceptionnel.',
    prix: 450,
    image: 'https://images.unsplash.com/photo-1608231387042-66d1773d3028?w=600&q=80',
    categorie_id: 2,
    artisan_id: 2,
  },
  {
    id: 3,
    nom: 'Panneau Zellige Bleu de Fès',
    description: 'Panneau mural en zellige 30×30cm, couleurs bleues et blanches traditionnelles. Pièce unique.',
    prix: 890,
    image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
    categorie_id: 3,
    artisan_id: 1,
  },
  {
    id: 4,
    nom: 'Tapis Berbère Azilal',
    description: 'Tapis en laine naturelle tissé à la main, motifs géométriques berbères. 120×180cm.',
    prix: 1850,
    image: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&q=80',
    categorie_id: 4,
    artisan_id: 4,
  },
  {
    id: 5,
    nom: 'Collier Argent Filigrane',
    description: 'Collier en argent 925 travail filigrane traditionnel du Souss. Motifs floraux délicats.',
    prix: 680,
    image: 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&q=80',
    categorie_id: 5,
    artisan_id: 3,
  },
  {
    id: 6,
    nom: 'Vase Poterie Safi Turquoise',
    description: 'Vase en poterie émaillée de Safi, couleur turquoise profond. Idéal pour fleurs séchées.',
    prix: 280,
    image: 'https://images.unsplash.com/photo-1612196808214-b7e239e5f6b2?w=600&q=80',
    categorie_id: 1,
    artisan_id: 2,
  },
];

/* helpers */
function getCatName(id)     { const c = CATEGORIES.find(c => c.id === id); return c ? c.nom : '—'; }
function getArtisan(id)     { return ARTISANS.find(a => a.id === id) || {}; }


/* ────────────────────────────────────────────────────────
   MODAL INSCRIPTION CLIENT
──────────────────────────────────────────────────────── */
function openRegModal(type) {
  document.getElementById('modal-' + type).classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeRegModal(type) {
  document.getElementById('modal-' + type).classList.remove('open');
  document.body.style.overflow = '';
}

function submitClient() {
  const nom   = document.getElementById('c-nom').value.trim();
  const email = document.getElementById('c-email').value.trim();
  const pass  = document.getElementById('c-pass').value;
  const pass2 = document.getElementById('c-pass2').value;

  if (!nom || !email || !pass) {
    alert('Veuillez remplir les champs obligatoires *');
    return;
  }
  if (pass !== pass2) {
    alert('Les mots de passe ne correspondent pas.');
    return;
  }
  if (pass.length < 8) {
    alert('Le mot de passe doit contenir au moins 8 caractères.');
    return;
  }

  /* ─ Intégration PHP :
     const fd = new FormData();
     fd.append('nom', nom); fd.append('email', email); fd.append('password', pass);
     await fetch('register_client.php', { method: 'POST', body: fd });
  ─ */

  document.getElementById('client-form-wrap').style.display = 'none';
  document.getElementById('client-success').classList.add('show');
}


/* ────────────────────────────────────────────────────────
   MODAL INSCRIPTION ARTISAN
──────────────────────────────────────────────────────── */
function submitArtisan() {
  const nom   = document.getElementById('a-nom').value.trim();
  const email = document.getElementById('a-email').value.trim();
  const tel   = document.getElementById('a-tel').value.trim();
  const pass  = document.getElementById('a-pass').value;

  if (!nom || !email || !tel || !pass) {
    alert('Veuillez remplir les champs obligatoires *');
    return;
  }
  if (pass.length < 8) {
    alert('Le mot de passe doit contenir au moins 8 caractères.');
    return;
  }

  /* ─ Intégration PHP :
     const fd = new FormData();
     fd.append('nom', nom); fd.append('email', email);
     fd.append('telephone', tel); fd.append('password', pass);
     fd.append('ville', document.getElementById('a-ville').value);
     fd.append('specialite', document.getElementById('a-spec').value);
     await fetch('register_artisan.php', { method: 'POST', body: fd });
  ─ */

  document.getElementById('artisan-form-wrap').style.display = 'none';
  document.getElementById('artisan-success').classList.add('show');
}


/* ────────────────────────────────────────────────────────
   MODAL CONNEXION
──────────────────────────────────────────────────────── */
function openModal()  { document.getElementById('modal').classList.add('open');    }
function closeModal() { document.getElementById('modal').classList.remove('open'); }

function switchTab(tab, btn) {
  document.querySelectorAll('.modal-tab').forEach(t  => t.classList.remove('active'));
  document.querySelectorAll('.modal-form').forEach(f => f.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-' + tab).classList.add('active');
}

function handleLogin() {
  const email = document.getElementById('login-email').value;
  const pass  = document.getElementById('login-password').value;
  if (!email || !pass) { alert('Veuillez remplir tous les champs.'); return; }
  /* fetch('login.php', ...) */
  alert('Connexion réussie ! (Intégrez votre backend PHP ici)');
  closeModal();
}

function handleRegister() {
  const nom   = document.getElementById('reg-nom').value;
  const email = document.getElementById('reg-email').value;
  const pass  = document.getElementById('reg-password').value;
  if (!nom || !email || !pass) { alert('Veuillez remplir tous les champs obligatoires.'); return; }
  /* fetch('register_client.php', ...) */
  alert('Compte créé ! (Intégrez votre backend PHP ici)');
  closeModal();
}


/* ────────────────────────────────────────────────────────
   FERMETURE MODALS AU CLIC OVERLAY
──────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {

  ['modal-client', 'modal-artisan'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', e => {
      if (e.target === e.currentTarget) closeRegModal(id.replace('modal-', ''));
    });
  });

  document.getElementById('modal')?.addEventListener('click', e => {
    if (e.target === e.currentTarget) closeModal();
  });

  /* ────────────────────────────────────────────────────
     SMOOTH SCROLL
  ──────────────────────────────────────────────────── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
  });

});