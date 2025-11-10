<?php
// dashboar.php
session_start();

// Mock user & data (replace with real DB queries)
$user = [
    'name' => 'Alex Martin',
    'email' => 'alex.martin@univ.edu',
    'student_id' => 'U20251234',
    'avatar' => 'https://i.pravatar.cc/100?img=12'
];

$orders = [
    ['id'=> 'ORD-1001','date'=>'2025-11-01','status'=>'En route','total'=>'€12.50','items'=>[['name'=>'Panini poulet','qty'=>1,'price'=>'6.50'],['name'=>'Coca','qty'=>1,'price'=>'2.00']],'eta'=>'18:20','deliverer'=>'Samir'],
    ['id'=> 'ORD-1002','date'=>'2025-10-28','status'=>'Livrée','total'=>'€8.00','items'=>[['name'=>'Salade grecque','qty'=>1,'price'=>'8.00']],'eta'=>'13:05','deliverer'=>'Ana'],
    ['id'=> 'ORD-1003','date'=>'2025-10-20','status'=>'Annulée','total'=>'€0.00','items'=>[['name'=>'Menu étudiant','qty'=>1,'price'=>'0.00']],'eta'=>'—','deliverer'=>null],
];

$reviews = [
    ['place'=>'Café Campus','rating'=>4,'comment'=>'Service rapide, bon café.','date'=>'2025-09-18'],
    ['place'=>'Resto Vert','rating'=>5,'comment'=>'Très bon, livraison ponctuelle.','date'=>'2025-08-02'],
];
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard - Livraison Campus</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="" crossorigin="anonymous">
<style>
:root{
  --green:#27ae60;
  --white:#ffffff;
  --orange:#f39c12;
  --orange-hover:#2ecc71; /* light green hover for buttons */
  --card-radius:12px;
  --shadow: 0 6px 18px rgba(39,174,96,0.08);
  --glass: rgba(0,0,0,0.03);
  font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  color:#222;
  background: var(--white);
}
*{box-sizing:border-box}
body,html{height:100%;margin:0;padding:0;background:var(--white)}
.app{
  display:flex;
  min-height:100vh;
  transition:all .2s ease;
}

/* Sidebar */
.sidebar{
  width:260px;
  background:var(--green);
  color:var(--white);
  padding:20px 16px;
  display:flex;
  flex-direction:column;
  gap:18px;
  transition:transform .25s ease;
}
.logo{display:flex;align-items:center;gap:10px;font-weight:700;font-size:18px}
.logo .mark{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#2ecc71,#27ae60);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
.nav{display:flex;flex-direction:column;gap:8px;margin-top:6px}
.nav a{
  display:flex;align-items:center;gap:12px;padding:10px;border-radius:10px;color:var(--white);text-decoration:none;font-weight:500;opacity:.95;transition:background .15s,transform .12s;
}
.nav a:hover{background:rgba(0,0,0,0.08);transform:translateX(4px)}
.sidebar-bottom{margin-top:auto;font-size:13px;opacity:.95}

/* Main area */
.main{
  flex:1;padding:20px;
}
.header{
  display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px;
}
.header-left{display:flex;align-items:center;gap:14px}
.hamburger{display:none;background:none;border:none;color:var(--green);padding:8px;border-radius:8px}
.header-title{font-size:20px;font-weight:600;color:#111}
.userbox{display:flex;align-items:center;gap:12px}
.userbox .name{font-weight:600}
.avatar{width:40px;height:40px;border-radius:50%;overflow:hidden;border:2px solid rgba(0,0,0,0.06)}
.dropdown{position:relative}
.dropbtn{background:transparent;border:none;color:#111;padding:8px;border-radius:8px;display:flex;gap:8px;align-items:center;cursor:pointer}
.dropmenu{position:absolute;right:0;top:calc(100% + 8px);background:#fff;min-width:180px;border-radius:8px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;display:none;z-index:40}
.dropmenu a{display:block;padding:10px 12px;color:#333;text-decoration:none;font-weight:500}
.dropmenu a:hover{background:var(--glass)}

/* Cards and panels */
.panel{background:#fff;border-radius:var(--card-radius);box-shadow:var(--shadow);padding:16px}
.toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:12px}
.tabs{display:flex;gap:8px}
.tab{padding:8px 12px;border-radius:10px;background:transparent;border:1px solid rgba(0,0,0,0.06);cursor:pointer;font-weight:600}
.tab.active{background:var(--green);color:#fff;border-color:transparent}

.card-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
.order-card{padding:14px;border-radius:12px;background:linear-gradient(180deg,#fff,#fbfbfb);display:flex;flex-direction:column;gap:10px}
.order-row{display:flex;justify-content:space-between;align-items:center;gap:8px}
.badge{padding:6px 10px;border-radius:999px;font-weight:600;font-size:13px;color:#fff}

/* status colors */
.status-Prepar {background:#f39c12}
.status-En{background:#3498db}
.status-En\ route{background:#f39c12}
.status-Livrée{background:#27ae60}
.status-Annulée{background:#bdc3c7}

/* Buttons */
.btn{padding:8px 12px;border-radius:10px;border:none;cursor:pointer;font-weight:600}
.btn-primary{background:var(--orange);color:#fff}
.btn-primary:hover{background:var(--orange-hover)}
.btn-ghost{background:transparent;border:1px solid rgba(0,0,0,0.08)}

/* Profile & forms */
.form-row{display:flex;gap:12px}
.input,textarea{width:100%;padding:10px;border-radius:10px;border:1px solid rgba(0,0,0,0.08);background:#fff}
textarea{min-height:120px;resize:vertical}

/* Reviews */
.review{padding:12px;border-radius:10px;background:var(--glass);display:flex;flex-direction:column;gap:6px}

/* Modal */
.modal-backdrop{position:fixed;inset:0;background:rgba(0,0,0,0.35);display:none;align-items:center;justify-content:center;z-index:60}
.modal{background:#fff;padding:18px;border-radius:12px;max-width:720px;width:94%;box-shadow:0 20px 50px rgba(0,0,0,0.25)}

/* small screen */
@media(max-width:900px){
  .sidebar{position:fixed;left:0;top:0;bottom:0;z-index:50;transform:translateX(-110%);width:240px}
  .sidebar.open{transform:translateX(0)}
  .hamburger{display:inline-flex}
  .logo{gap:8px}
  .card-grid{grid-template-columns:1fr}
  .header-title{font-size:16px}
}
</style>
</head>
<body>
<div class="app">
  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <div class="mark"><i class="fa-solid fa-motorcycle"></i></div>
      <div>
        <div style="font-weight:700">CampusMove</div>
        <div style="font-size:12px;opacity:.9">Livraison Étudiante</div>
      </div>
    </div>

    <nav class="nav">
      <a href="#" data-section="dashboard" onclick="switchSection(event,'dashboard')"><i class="fa-solid fa-house"></i> Accueil</a>
      <a href="#" data-section="orders" onclick="switchSection(event,'orders')"><i class="fa-solid fa-box"></i> Mes commandes</a>
      <a href="#" data-section="profile" onclick="switchSection(event,'profile')"><i class="fa-solid fa-user"></i> Mon profil</a>
      <a href="#" data-section="reviews" onclick="switchSection(event,'reviews')"><i class="fa-solid fa-star"></i> Mes avis</a>
      <a href="#" data-section="support" onclick="switchSection(event,'support')"><i class="fa-solid fa-headset"></i> Support</a>
    </nav>

    <div class="sidebar-bottom">
      <div style="font-weight:600;margin-bottom:6px">Besoin d'aide ?</div>
      <div style="font-size:13px;opacity:.95">support@campusmove.univ</div>
    </div>
  </aside>

  <main class="main">
    <header class="header">
      <div class="header-left">
        <button class="hamburger" id="btnHamb" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
        <div style="display:flex;flex-direction:column">
          <div class="header-title">Tableau de bord</div>
          <div style="font-size:13px;color:rgba(0,0,0,0.5)">Bonjour, <?=htmlspecialchars(explode(' ',$user['name'])[0])?> 👋</div>
        </div>
      </div>

      <div class="userbox">
        <div class="dropdown">
          <button class="dropbtn" onclick="toggleDropdown(event)">
            <div style="text-align:right">
              <div class="name"><?=htmlspecialchars($user['name'])?></div>
              <div style="font-size:12px;color:rgba(0,0,0,0.5)"><?=htmlspecialchars($user['email'])?></div>
            </div>
            <div class="avatar"><img src="<?=htmlspecialchars($user['avatar'])?>" alt="avatar" style="width:100%;height:100%;object-fit:cover"></div>
          </button>
          <div class="dropmenu" id="dropmenu">
            <a href="#" onclick="openEditProfile(event)"><i class="fa-regular fa-user"></i> Profil</a>
            <a href="#" onclick="openChangePassword(event)"><i class="fa-solid fa-key"></i> Modifier le mot de passe</a>
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Sections -->
    <section id="section-dashboard">
      <div class="panel">
        <div class="toolbar">
          <div style="display:flex;align-items:center;gap:12px">
            <div style="font-weight:700;font-size:18px">Bienvenue sur ton espace</div>
            <div style="color:rgba(0,0,0,0.6)">Gère tes commandes et demandes en un clin d'œil</div>
          </div>
          <div>
            <button class="btn btn-primary" onclick="switchSection(null,'orders')"><i class="fa-solid fa-box-open" style="margin-right:8px"></i> Voir mes commandes</button>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
          <div class="panel" style="border-radius:12px;">
            <div style="font-size:13px;color:rgba(0,0,0,0.6)">Commandes</div>
            <div style="font-weight:700;font-size:22px"><?=count($orders)?></div>
          </div>
          <div class="panel" style="border-radius:12px;">
            <div style="font-size:13px;color:rgba(0,0,0,0.6)">Avis</div>
            <div style="font-weight:700;font-size:22px"><?=count($reviews)?></div>
          </div>
          <div class="panel" style="border-radius:12px;">
            <div style="font-size:13px;color:rgba(0,0,0,0.6)">Support</div>
            <div style="font-weight:700;font-size:22px">Contact</div>
          </div>
        </div>
      </div>
    </section>

    <section id="section-orders" style="display:none">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
        <div style="font-weight:700;font-size:18px">Mes commandes</div>
        <div style="color:rgba(0,0,0,0.6)">Historique et suivi</div>
      </div>

      <div class="card-grid">
        <?php foreach($orders as $o): ?>
        <div class="order-card panel">
          <div class="order-row">
            <div>
              <div style="font-weight:700"><?=htmlspecialchars($o['id'])?></div>
              <div style="font-size:13px;color:rgba(0,0,0,0.6)"><?=htmlspecialchars($o['date'])?></div>
            </div>
            <div style="text-align:right">
              <div class="badge" style="background:<?= $o['status']=='Livrée' ? 'var(--green)' : ($o['status']=='Annulée' ? '#bdc3c7' : 'var(--orange)')?>"><?=htmlspecialchars($o['status'])?></div>
              <div style="font-weight:700;margin-top:8px"><?=htmlspecialchars($o['total'])?></div>
            </div>
          </div>

          <div style="display:flex;justify-content:space-between;align-items:center;gap:8px">
            <div style="font-size:13px;color:rgba(0,0,0,0.6)"><?=count($o['items'])?> article(s)</div>
            <div style="display:flex;gap:8px">
              <button class="btn btn-ghost" onclick="openOrderDetails('<?=htmlspecialchars($o['id'])?>')">Détails</button>
              <button class="btn btn-primary" onclick="trackOrder('<?=htmlspecialchars($o['id'])?>')">Suivre</button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="section-profile" style="display:none">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
        <div style="font-weight:700;font-size:18px">Mon profil</div>
        <div>
          <button class="btn btn-ghost" onclick="openEditProfile(event)">Modifier mes informations</button>
          <button class="btn btn-primary" onclick="openChangePassword(event)">Changer mon mot de passe</button>
        </div>
      </div>

      <div class="panel" style="max-width:720px">
        <div style="display:flex;gap:18px;align-items:center">
          <div class="avatar" style="width:84px;height:84px"><img src="<?=htmlspecialchars($user['avatar'])?>" alt="avatar" style="width:100%;height:100%;object-fit:cover"></div>
          <div>
            <div style="font-weight:700;font-size:18px"><?=htmlspecialchars($user['name'])?></div>
            <div style="font-size:13px;color:rgba(0,0,0,0.6)"><?=htmlspecialchars($user['email'])?></div>
            <div style="font-size:13px;color:rgba(0,0,0,0.6)">ID: <?=htmlspecialchars($user['student_id'])?></div>
          </div>
        </div>
      </div>
    </section>

    <section id="section-reviews" style="display:none">
      <div style="font-weight:700;font-size:18px;margin-bottom:12px">Mes avis</div>
      <div style="display:grid;gap:10px;max-width:760px">
        <?php foreach($reviews as $r): ?>
        <div class="review panel" style="display:flex;justify-content:space-between;align-items:flex-start">
          <div>
            <div style="font-weight:700"><?=htmlspecialchars($r['place'])?></div>
            <div style="display:flex;gap:8px;align-items:center;font-size:13px;color:rgba(0,0,0,0.6);margin-top:6px">
              <div><?php for($i=0;$i<5;$i++): ?><i class="fa-solid fa-star" style="color:<?= $i<$r['rating'] ? 'var(--orange)' : '#eee' ?>;font-size:12px;margin-right:4px"></i><?php endfor; ?></div>
              <div><?=htmlspecialchars($r['date'])?></div>
            </div>
            <div style="margin-top:8px;color:#333"><?=htmlspecialchars($r['comment'])?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="section-support" style="display:none">
      <div style="font-weight:700;font-size:18px;margin-bottom:12px">Support</div>
      <div class="panel" style="max-width:720px">
        <form id="supportForm" onsubmit="submitSupport(event)">
          <div style="margin-bottom:8px"><input class="input" id="supportSubject" placeholder="Sujet du message" required></div>
          <div style="margin-bottom:12px"><textarea id="supportBody" placeholder="Explique ton problème ou ta question..." required></textarea></div>
          <div style="display:flex;gap:10px;align-items:center">
            <button class="btn btn-primary" type="submit">Envoyer</button>
            <div id="supportMessage" style="color:var(--green);font-weight:600;display:none"></div>
          </div>
        </form>
      </div>
    </section>
  </main>
</div>

<!-- Order Modal -->
<div class="modal-backdrop" id="modalBackdrop">
  <div class="modal" id="modalContent">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <div style="font-weight:700" id="modalTitle">Détails commande</div>
      <div><button class="btn btn-ghost" onclick="closeModal()">Fermer</button></div>
    </div>
    <div id="modalBody"></div>
  </div>
</div>

<!-- Hidden edit profile form modal -->
<div class="modal-backdrop" id="profileModal" style="display:none;align-items:center">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <div style="font-weight:700">Modifier mes informations</div>
      <div><button class="btn btn-ghost" onclick="closeProfileModal()">Annuler</button></div>
    </div>
    <form id="editProfileForm" onsubmit="saveProfile(event)">
      <div style="display:grid;gap:10px">
        <input class="input" id="editName" value="<?=htmlspecialchars($user['name'])?>" required>
        <input class="input" id="editEmail" value="<?=htmlspecialchars($user['email'])?>" type="email" required>
        <input class="input" id="editId" value="<?=htmlspecialchars($user['student_id'])?>">
        <div style="display:flex;gap:8px;justify-content:flex-end">
          <button type="button" class="btn btn-ghost" onclick="closeProfileModal()">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Change password modal -->
<div class="modal-backdrop" id="pwdModal" style="display:none;align-items:center">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <div style="font-weight:700">Changer le mot de passe</div>
      <div><button class="btn btn-ghost" onclick="closePwdModal()">Annuler</button></div>
    </div>
    <form id="pwdForm" onsubmit="changePassword(event)">
      <div style="display:grid;gap:10px">
        <input class="input" id="oldPwd" type="password" placeholder="Ancien mot de passe" required>
        <input class="input" id="newPwd" type="password" placeholder="Nouveau mot de passe" required>
        <div style="display:flex;gap:8px;justify-content:flex-end">
          <button type="button" class="btn btn-ghost" onclick="closePwdModal()">Annuler</button>
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
// UI helpers
function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('open'); }
function toggleDropdown(e){ e.stopPropagation(); document.getElementById('dropmenu').style.display = document.getElementById('dropmenu').style.display === 'block' ? 'none' : 'block'; }
document.addEventListener('click',()=>{ document.getElementById('dropmenu').style.display='none'; });

// Navigation
function switchSection(e, id){
  if(e) e.preventDefault();
  const sections = ['dashboard','orders','profile','reviews','support'];
  sections.forEach(s => document.getElementById('section-'+s).style.display = (s===id ? '' : 'none'));
  // close mobile sidebar when selecting
  document.getElementById('sidebar').classList.remove('open');
}

// Orders modal logic
const orders = <?=json_encode($orders)?>;
function openOrderDetails(id){
  const o = orders.find(x=>x.id===id);
  if(!o) return;
  document.getElementById('modalTitle').innerText = 'Commande ' + o.id;
  let html = '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px"><div><strong>Date:</strong> '+o.date+'</div><div><strong>Statut:</strong> '+o.status+'</div></div>';
  html += '<div style="margin-bottom:10px"><strong>Produits:</strong><ul>';
  o.items.forEach(it=>{ html += '<li>'+it.qty+' × '+it.name+' — '+it.price+' </li>'; });
  html += '</ul></div>';
  html += '<div style="display:flex;justify-content:space-between;align-items:center"><div><strong>Heure estimée:</strong> '+o.eta+'</div><div><strong>Livré par:</strong> '+(o.deliverer?o.deliverer:'—')+'</div></div>';
  html += '<div style="margin-top:14px;display:flex;justify-content:flex-end"><button class="btn btn-primary" onclick="closeModal()">Fermer</button></div>';
  document.getElementById('modalBody').innerHTML = html;
  document.getElementById('modalBackdrop').style.display = 'flex';
}
function closeModal(){ document.getElementById('modalBackdrop').style.display = 'none'; }
function trackOrder(id){ alert('Ouverture du suivi pour ' + id); /* placeholder */ }

// Support form
function submitSupport(e){
  e.preventDefault();
  const subj = document.getElementById('supportSubject').value.trim();
  const body = document.getElementById('supportBody').value.trim();
  if(!subj || !body) return;
  // Here you'd send via fetch to backend. We'll simulate success:
  document.getElementById('supportMessage').innerText = "Merci, nous avons bien reçu ton message 👌";
  document.getElementById('supportMessage').style.display = 'block';
  // reset
  document.getElementById('supportForm').reset();
  setTimeout(()=>{ document.getElementById('supportMessage').style.display='none'; }, 4000);
}

// Profile modals
function openEditProfile(e){ if(e) e.preventDefault(); document.getElementById('profileModal').style.display='flex'; }
function closeProfileModal(){ document.getElementById('profileModal').style.display='none'; }
function saveProfile(e){
  e.preventDefault();
  // In real app: send to server; here simulate and update UI
  const name = document.getElementById('editName').value;
  const email = document.getElementById('editEmail').value;
  document.querySelector('.dropbtn .name')?.innerText = name;
  alert('Profil mis à jour');
  closeProfileModal();
}

// Password modal
function openChangePassword(e){ if(e) e.preventDefault(); document.getElementById('pwdModal').style.display='flex'; }
function closePwdModal(){ document.getElementById('pwdModal').style.display='none'; }
function changePassword(e){
  e.preventDefault();
  // Validate & send to server
  const oldp = document.getElementById('oldPwd').value;
  const newp = document.getElementById('newPwd').value;
  if(newp.length < 6){ alert('Le nouveau mot de passe doit contenir au moins 6 caractères'); return; }
  closePwdModal();
  alert('Mot de passe modifié');
}

// small UX niceties
document.addEventListener('keyup',(e)=>{ if(e.key==='Escape'){ closeModal(); closeProfileModal(); closePwdModal(); } });
</script>
</body>
</html>