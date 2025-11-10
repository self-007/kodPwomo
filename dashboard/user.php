<?php
// /c:/wamp64/www/kodPwomo/dashboard/user.php
// Sample dynamic data (replace with real DB queries)

$user = [
    'name' => 'Alice Dupont',
    'email' => 'alice@example.com',
    'avatar' => 'https://i.pravatar.cc/48?img=12',
    'addresses' => [
        'Domicile' => '12 rue de la Paix, 75001 Paris',
        'Bureau' => '4 avenue Victor Hugo, 75016 Paris'
    ]
];

$orders = [
    ['id' => 'PW-1001', 'date' => '2025-10-21', 'status' => 'En route', 'total' => '24.50', 'items' => [
        ['name'=>'Burger Classique','qty'=>1,'price'=>'8.50'],
        ['name'=>'Frites','qty'=>1,'price'=>'3.00'],
        ['name'=>'Coca','qty'=>1,'price'=>'3.00'],
    ], 'address' => $user['addresses']['Domicile']],
    ['id' => 'PW-1002', 'date' => '2025-10-18', 'status' => 'Livrée', 'total' => '15.00', 'items' => [
        ['name'=>'Salade César','qty'=>1,'price'=>'9.00'],
        ['name'=>'Eau','qty'=>1,'price'=>'1.50'],
    ], 'address' => $user['addresses']['Bureau']],
    ['id' => 'PW-1003', 'date' => '2025-10-10', 'status' => 'Annulée', 'total' => '0.00', 'items' => [], 'address' => $user['addresses']['Domicile']],
];

$reviews = [
    ['restaurant'=>'Le Coin Gourmand','rating'=>5,'comment'=>'Très bon service et plats savoureux.'],
    ['restaurant'=>'Pizza Express','rating'=>4,'comment'=>'Bonne pâte, livraison rapide.'],
];
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard utilisateur - KodPwomo</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Font Awesome (icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
:root{
  --green:#27ae60;
  --green-light:#2ecc71;
  --orange:#f39c12;
  --white:#ffffff;
  --radius:12px;
  --shadow: 0 6px 18px rgba(39,46,56,0.08);
  --muted: #7a7a7a;
  --maxw:1200px;
  font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  color: #222;
  background: var(--white);
}
*{box-sizing:border-box}
body,html{height:100%; margin:0; background:var(--white)}

.container{
  max-width:var(--maxw);
  margin:24px auto;
  display:flex;
  gap:24px;
  padding:0 16px;
}

/* Sidebar */
.sidebar{
  width:260px;
  background:linear-gradient(180deg,var(--green), #219150);
  color:var(--white);
  padding:18px;
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  height:calc(100vh - 96px);
  position:sticky;
  top:48px;
  display:flex;
  flex-direction:column;
  gap:12px;
}
.brand{display:flex;gap:12px;align-items:center;font-weight:600}
.brand .logo{
  width:44px;height:44px;background:var(--white);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--green);font-weight:700;
  box-shadow:0 4px 10px rgba(0,0,0,0.06)
}
.sidebar nav a{
  display:flex;align-items:center;gap:12px;padding:10px;border-radius:10px;color:var(--white);text-decoration:none;font-weight:500;
  transition:background .18s, transform .12s;
}
.sidebar nav a:hover{background:rgba(255,255,255,0.08);transform:translateX(4px)}
.sidebar .spacer{flex:1}

/* Main panel */
.main{
  flex:1;
  display:flex;
  flex-direction:column;
  gap:18px;
  min-height:80vh;
}

/* Header */
.header{
  display:flex;align-items:center;justify-content:space-between;
  gap:12px;
}
.header-left{display:flex;align-items:center;gap:12px}
.header .hamburger{display:none;padding:10px;border-radius:10px;background:transparent;border:0;font-size:18px}
.usermenu{display:flex;align-items:center;gap:10px;cursor:pointer;position:relative}
.user-avatar{width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #fff}
.dropdown{
  position:absolute;right:0;top:64px;background:var(--white);color:#222;border-radius:10px;box-shadow:var(--shadow);overflow:hidden;min-width:160px;display:none;
  z-index:1000;
}
.dropdown a{display:block;padding:10px 12px;text-decoration:none;color:inherit}
.dropdown a:hover{background:#f6f6f6}

/* Content cards and sections */
.section{background:var(--white);padding:16px;border-radius:var(--radius);box-shadow:var(--shadow)}
.section h2{margin:0 0 12px 0;font-size:18px}

/* Orders layout */
.orders-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:12px}
.order-card{padding:14px;border-radius:12px;background:linear-gradient(180deg,#fff,#fbfbfb);transition:transform .12s, box-shadow .12s;cursor:default}
.order-card:hover{transform:translateY(-6px);box-shadow:0 12px 30px rgba(0,0,0,0.06)}
.order-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.status{padding:6px 10px;border-radius:999px;font-weight:600;font-size:13px;color:#fff}
.status.prep{background:#f1c40f;color:#222}
.status.route{background:var(--green)}
.status.delivered{background:#3498db}
.status.cancel{background:#e74c3c}

/* Buttons */
.btn{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:10px;border:0;background:var(--orange);color:var(--white);cursor:pointer;font-weight:600;transition:background .12s,transform .08s}
.btn:hover{background:var(--green-light); transform:translateY(-2px)}
.btn.ghost{background:transparent;border:1px solid #eee;color:inherit}
.small{padding:6px 10px;font-size:14px}

/* Profile section */
.profile-grid{display:grid;grid-template-columns:1fr 320px;gap:12px}
.profile-card{padding:14px}
.field{display:flex;flex-direction:column;margin-bottom:10px}
.field label{font-size:13px;color:var(--muted);margin-bottom:6px}
.field .value{font-weight:600}

/* Reviews */
.review{display:flex;gap:12px;align-items:flex-start;padding:10px;border-radius:10px;background:#fff}

/* Support */
.support-form textarea{min-height:120px;padding:10px;border-radius:10px;border:1px solid #eee;font-family:inherit}

/* Footer / small muted */
.muted{color:var(--muted);font-size:13px}

/* Responsive */
@media (max-width: 920px){
  .container{flex-direction:column;padding:12px}
  .sidebar{width:100%;height:auto;position:relative;top:0;flex-direction:row;align-items:center;gap:8px;padding:12px}
  .sidebar nav{display:flex;gap:8px;overflow:auto}
  .header .hamburger{display:inline-flex}
  .profile-grid{grid-template-columns:1fr}
  .dropdown{right:8px;top:56px}
}
</style>
</head>
<body>

<div style="max-width:var(--maxw);margin:12px auto;padding:0 16px">
  <header class="header" style="padding:8px 0">
    <div class="header-left">
      <button class="hamburger" id="toggleSidebar" aria-label="Toggle menu"><i class="fa fa-bars"></i></button>
      <div style="display:flex;align-items:center;gap:12px">
        <div style="width:44px;height:44px;border-radius:10px;background:var(--green);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">KP</div>
        <div>
          <div style="font-weight:700">KodPwomo</div>
          <div class="muted" style="font-size:13px">Tableau de bord</div>
        </div>
      </div>
    </div>

    <div class="usermenu" id="userMenuToggle" title="Compte">
      <div style="text-align:right">
        <div style="font-weight:600"><?=htmlspecialchars($user['name'])?></div>
        <div class="muted" style="font-size:13px"><?=htmlspecialchars($user['email'])?></div>
      </div>
      <img class="user-avatar" src="<?=htmlspecialchars($user['avatar'])?>" alt="avatar">
      <div class="dropdown" id="userDropdown">
        <a href="#profile"><i class="fa fa-user"></i> Profil</a>
        <a href="#settings"><i class="fa fa-cog"></i> Paramètres</a>
        <a href="#" id="logoutBtn"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
      </div>
    </div>
  </header>
</div>

<div class="container">
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="logo">KP</div>
      <div>
        <div style="font-weight:600">KodPwomo</div>
        <div style="font-size:13px;opacity:0.95">Livraison</div>
      </div>
    </div>

    <nav aria-label="Main navigation" style="margin-top:6px">
      <a href="#home"><i class="fa fa-home"></i> Accueil</a>
      <a href="#orders"><i class="fa fa-box"></i> Mes commandes</a>
      <a href="#profile"><i class="fa fa-user"></i> Mon profil</a>
      <a href="#reviews"><i class="fa fa-star"></i> Mes avis</a>
      <a href="#support"><i class="fa fa-life-ring"></i> Support</a>
    </nav>

    <div class="spacer"></div>

    <div style="font-size:13px">
      <div class="muted">Besoin d'aide ?</div>
      <a href="#support" class="btn small" style="margin-top:8px"><i class="fa fa-envelope"></i> Contacter</a>
    </div>
  </aside>

  <main class="main">
    <!-- Orders -->
    <section id="orders" class="section">
      <h2>Mes commandes</h2>
      <div class="orders-grid">
        <?php foreach($orders as $o): 
            $statusClass = match($o['status']){
              'En préparation' => 'prep',
              'En route' => 'route',
              'Livrée' => 'delivered',
              'Annulée' => 'cancel',
              default => 'prep'
            };
        ?>
        <div class="order-card">
          <div class="order-meta">
            <div>
              <div style="font-size:14px;font-weight:700"><?=$o['id']?></div>
              <div class="muted" style="font-size:13px"><?=$o['date']?></div>
            </div>
            <div style="text-align:right">
              <div class="status <?=$statusClass?>"><?=htmlspecialchars($o['status'])?></div>
              <div class="muted" style="font-size:13px;margin-top:6px">€ <?=$o['total']?></div>
            </div>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px">
            <div class="muted" style="font-size:13px"><?=htmlspecialchars($o['address'])?></div>
            <div>
              <button class="btn small" data-order='<?=htmlspecialchars(json_encode($o), ENT_QUOTES)?>' onclick="openOrderModal(this)"><i class="fa fa-eye"></i> Détails</button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div style="margin-top:12px" class="muted">Survolez une commande pour voir plus de détails. Cliquez sur "Détails" pour ouvrir le récapitulatif.</div>
    </section>

    <!-- Profile -->
    <section id="profile" class="section">
      <h2>Mon profil</h2>
      <div class="profile-grid">
        <div class="profile-card">
          <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
            <img class="user-avatar" src="<?=htmlspecialchars($user['avatar'])?>" alt="avatar" style="width:72px;height:72px;border-radius:12px">
            <div>
              <div style="font-weight:700;font-size:18px"><?=htmlspecialchars($user['name'])?></div>
              <div class="muted"><?=htmlspecialchars($user['email'])?></div>
            </div>
          </div>

          <div class="field">
            <label>Nom</label>
            <div class="value" id="nameDisplay"><?=htmlspecialchars($user['name'])?></div>
            <input type="text" id="nameEdit" style="display:none;padding:8px;border-radius:8px;border:1px solid #eee" value="<?=htmlspecialchars($user['name'])?>">
          </div>

          <div class="field">
            <label>Email</label>
            <div class="value" id="emailDisplay"><?=htmlspecialchars($user['email'])?></div>
            <input type="email" id="emailEdit" style="display:none;padding:8px;border-radius:8px;border:1px solid #eee" value="<?=htmlspecialchars($user['email'])?>">
          </div>

          <div style="display:flex;gap:8px">
            <button class="btn" id="editProfileBtn" onclick="toggleEditProfile()"><i class="fa fa-pen"></i> Modifier</button>
            <button class="btn ghost" style="background:#f6f6f6;color:#222;border:0;display:none" id="saveProfileBtn" onclick="saveProfile()">Enregistrer</button>
            <button class="btn ghost" style="background:#f6f6f6;color:#222;border:0;display:none" id="cancelProfileBtn" onclick="toggleEditProfile(true)">Annuler</button>
          </div>
        </div>

        <div class="profile-card">
          <h3 style="margin-top:0">Adresses enregistrées</h3>
          <?php foreach($user['addresses'] as $label=>$addr): ?>
            <div style="margin-bottom:10px">
              <div style="font-weight:600"><?=$label?></div>
              <div class="muted" style="font-size:13px"><?=$addr?></div>
            </div>
          <?php endforeach; ?>
          <button class="btn small" style="width:100%;margin-top:8px"><i class="fa fa-plus"></i> Ajouter une adresse</button>
        </div>
      </div>
    </section>

    <!-- Reviews -->
    <section id="reviews" class="section">
      <h2>Mes avis</h2>
      <div style="display:flex;flex-direction:column;gap:10px">
        <?php foreach($reviews as $r): ?>
        <div class="review">
          <div style="width:46px;height:46px;border-radius:10px;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0"><?=strtoupper($r['restaurant'][0])?></div>
          <div style="flex:1">
            <div style="display:flex;align-items:center;justify-content:space-between">
              <div style="font-weight:700"><?=$r['restaurant']?></div>
              <div style="color:var(--orange);font-weight:700">
                <?php for($i=0;$i<5;$i++): ?>
                  <i class="fa <?= $i < $r['rating'] ? 'fa-star' : 'fa-star-o' ?>" style="color: <?= $i < $r['rating'] ? 'var(--orange)' : '#ddd' ?>; margin-left:4px"></i>
                <?php endfor; ?>
              </div>
            </div>
            <div class="muted" style="margin-top:6px"><?=$r['comment']?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Support -->
    <section id="support" class="section">
      <h2>Support</h2>
      <div style="display:flex;gap:12px;flex-direction:column">
        <div class="support-form" style="max-width:720px">
          <div class="field">
            <label>Sujet</label>
            <input id="supportSubject" type="text" placeholder="Ex: Problème avec une commande" style="padding:10px;border-radius:10px;border:1px solid #eee">
          </div>
          <div class="field">
            <label>Message</label>
            <textarea id="supportMessage" placeholder="Décrivez votre problème..."></textarea>
          </div>
          <div style="display:flex;gap:8px">
            <button class="btn" onclick="sendSupport()"><i class="fa fa-paper-plane"></i> Envoyer</button>
            <div class="muted" style="align-self:center">Réponse sous 24h en général</div>
          </div>
        </div>
      </div>
    </section>

    <div style="text-align:center" class="muted">© <?=date('Y')?> KodPwomo — Tableau de bord utilisateur</div>
  </main>
</div>

<!-- Order modal -->
<div id="orderModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.35);align-items:center;justify-content:center;padding:20px;z-index:999">
  <div style="background:var(--white);border-radius:12px;max-width:720px;width:100%;padding:18px;box-shadow:var(--shadow);position:relative">
    <button onclick="closeOrderModal()" style="position:absolute;right:12px;top:12px;border-radius:8px;border:0;background:#f6f6f6;padding:8px;cursor:pointer"><i class="fa fa-times"></i></button>
    <div id="orderModalContent"></div>
  </div>
</div>

<script>
// UI interactions
document.getElementById('userMenuToggle').addEventListener('click', function(e){
  e.stopPropagation();
  document.getElementById('userDropdown').style.display =
    document.getElementById('userDropdown').style.display === 'block' ? 'none' : 'block';
});
document.addEventListener('click', function(){ document.getElementById('userDropdown').style.display = 'none'; });

// Sidebar toggle for small screens
document.getElementById('toggleSidebar').addEventListener('click', function(){
  const sb = document.getElementById('sidebar');
  sb.style.display = sb.style.display === 'none' || getComputedStyle(sb).display === 'none' ? 'flex' : 'none';
});

// Order modal
function openOrderModal(btn){
  const order = JSON.parse(btn.getAttribute('data-order'));
  let html = '<h3 style="margin-top:0">Récapitulatif — ' + order.id + '</h3>';
  html += '<div style="display:flex;justify-content:space-between;gap:12px;margin-bottom:12px"><div><strong>Date:</strong> ' + order.date + '<br><strong>Statut:</strong> ' + order.status + '</div><div style="text-align:right"><strong>Total:</strong> € ' + order.total + '<br><span class="muted">'+order.address+'</span></div></div>';
  if(order.items && order.items.length){
    html += '<table style="width:100%;border-collapse:collapse;margin-top:8px"><thead><tr class="muted"><th style="text-align:left;padding:6px">Produit</th><th style="padding:6px;text-align:center">Qté</th><th style="padding:6px;text-align:right">Prix</th></tr></thead><tbody>';
    order.items.forEach(i=>{
      html += '<tr><td style="padding:6px">'+i.name+'</td><td style="padding:6px;text-align:center">'+i.qty+'</td><td style="padding:6px;text-align:right">€ '+i.price+'</td></tr>';
    });
    html += '</tbody></table>';
  } else {
    html += '<div class="muted">Aucun produit listé pour cette commande.</div>';
  }
  html += '<div style="margin-top:12px;text-align:right"><button class="btn" onclick="closeOrderModal()">Fermer</button></div>';
  document.getElementById('orderModalContent').innerHTML = html;
  document.getElementById('orderModal').style.display = 'flex';
}
function closeOrderModal(){ document.getElementById('orderModal').style.display = 'none'; }

// Profile edit
function toggleEditProfile(cancel=false){
  const editBtn = document.getElementById('editProfileBtn');
  const saveBtn = document.getElementById('saveProfileBtn');
  const cancelBtn = document.getElementById('cancelProfileBtn');
  const nameDisplay = document.getElementById('nameDisplay');
  const emailDisplay = document.getElementById('emailDisplay');
  const nameEdit = document.getElementById('nameEdit');
  const emailEdit = document.getElementById('emailEdit');

  const editing = nameEdit.style.display !== 'block' && !cancel;
  if(editing){
    nameDisplay.style.display = 'none';
    emailDisplay.style.display = 'none';
    nameEdit.style.display = 'block';
    emailEdit.style.display = 'block';
    editBtn.style.display = 'none';
    saveBtn.style.display = 'inline-flex';
    cancelBtn.style.display = 'inline-flex';
  } else {
    // cancel or save will close
    nameDisplay.style.display = 'block';
    emailDisplay.style.display = 'block';
    nameEdit.style.display = 'none';
    emailEdit.style.display = 'none';
    editBtn.style.display = 'inline-flex';
    saveBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
  }
}

function saveProfile(){
  // In a real app, make an AJAX request to save. Here we simply update UI.
  const nameEdit = document.getElementById('nameEdit').value;
  const emailEdit = document.getElementById('emailEdit').value;
  document.getElementById('nameDisplay').textContent = nameEdit;
  document.getElementById('emailDisplay').textContent = emailEdit;
  toggleEditProfile();
  alert('Profil mis à jour (simulation).');
}

// Support form
function sendSupport(){
  const subj = document.getElementById('supportSubject').value.trim();
  const msg = document.getElementById('supportMessage').value.trim();
  if(!subj || !msg){ alert('Veuillez renseigner le sujet et le message.'); return; }
  // Simulate send
  document.getElementById('supportSubject').value = '';
  document.getElementById('supportMessage').value = '';
  alert('Votre message a été envoyé. Nous vous répondrons bientôt.');
}

// Logout (simulation)
document.getElementById('logoutBtn').addEventListener('click', function(e){
  e.preventDefault();
  if(confirm('Se déconnecter ?')){ alert('Déconnecté (simulation).'); /* redirect or post to logout in real app */ }
});

// Simple escape close for modal
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){ closeOrderModal(); document.getElementById('userDropdown').style.display='none'; }
});
</script>

</body>
</html>