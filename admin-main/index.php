<?php
// /c:/wamp64/www/kodPwomo/admin-main/index.php
?><!doctype html>
<html lang="fr">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>WeManage — Espace admin</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
function nav_active($slug, $page) {
  return $slug === $page ? ' active' : '';
}
?>
    :root{
      --header-height:64px;
      --sidebar-width:260px;
      --bg:#f7fafc;
      --card:#ffffff;
      --muted:#6b7280;
      --accent-orange:#ff7a18;
      --accent-blue:#2563eb;
      --accent-green:#10b981;
      --shadow: 0 6px 18px rgba(15,23,42,0.06);
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,#ffffff 0%, var(--bg) 100%);color:#0f172a}
    a{color:inherit;text-decoration:none}
    button{font:inherit}

    /* Header */
    .header{
      position:fixed;
      top:0;
      width:100%;
      height:var(--header-height);
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:0 1rem;
      background:linear-gradient(90deg,#fff 0%, #fbfbff 100%);
      border-bottom:1px solid rgba(15,23,42,0.06);
      z-index:1000; /* header must be above sidebar */
      box-shadow: var(--shadow);
    }
      display:flex;
      align-items:center;
      gap:.75rem;
    }
    .logo{
      width:36px;height:36px;border-radius:8px;
      display:inline-grid;place-items:center;
      background:linear-gradient(135deg,var(--accent-orange), #ffb57b);
      color:white;font-weight:700;
      box-shadow: 0 4px 14px rgba(255,122,24,0.12);
    }
    .brand h1{font-size:1rem;margin:0;line-height:1;color:#0f172a;font-weight:600}
    .brand p{margin:0;font-size:0.8rem;color:var(--muted)}

    .header-actions{
      display:flex;
      align-items:center;
      gap:.5rem;
    }
    .btn-hamburger{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:44px;height:44px;border-radius:8px;border:none;
      background:transparent;cursor:pointer;
    }
    .hamburger-icon{width:20px;height:14px;display:block;position:relative}
    .hamburger-icon span{
      position:absolute;left:0;right:0;height:2px;background:#0f172a;border-radius:2px;
      transition:transform .25s ease,opacity .2s ease;
    }
    .hamburger-icon span:nth-child(1){top:0}
    .hamburger-icon span:nth-child(2){top:6px}
    .hamburger-icon span:nth-child(3){top:12px}

    /* Layout */
    .app{
      display:flex;
      align-items:stretch;
      min-height:100vh;
      padding-top:var(--header-height);
    }

    /* Sidebar (desktop) */
    .sidebar{
      position:fixed;
      top:var(--header-height); /* starts under header */
      bottom:0;
      width:var(--sidebar-width);
      background:var(--card);
      border-right:1px solid rgba(15,23,42,0.04);
      padding:1rem 0;
      box-shadow: 0 4px 30px rgba(2,6,23,0.04);
  overflow:auto;
  z-index:900;
  transform:translateX(0);
  transition:transform .25s ease;
    }
    .nav-list{list-style:none;margin:0;padding:0 0.5rem}
  .nav-item{display:flex;align-items:center;gap:.75rem;padding:.6rem .75rem;border-radius:8px;margin:.35rem 0;color:#0f172a}
  .nav-item:hover, .nav-item.active{background:linear-gradient(90deg, rgba(37,99,235,0.08), rgba(255,122,24,0.04))}
    .nav-item .icon{
      width:36px;height:36px;display:inline-grid;place-items:center;border-radius:8px;color:white;font-weight:700;flex:0 0 36px;
    }
    .nav-item .meta{display:flex;flex-direction:column}
    .nav-item .meta .label{font-weight:600}
    .nav-item .meta .sub{font-size:0.8rem;color:var(--muted)}

    /* Main content */
    .main{
      flex:1;
      margin-left:var(--sidebar-width);
      padding:2rem;
      min-height:calc(100vh - var(--header-height));
      display:flex;
      flex-direction:column;
      gap:1.25rem;
    }

    .card{
      background:var(--card);
      border-radius:12px;
      padding:1.5rem;
      box-shadow: var(--shadow);
      border:1px solid rgba(15,23,42,0.03);
    }
    h2{margin:0;font-weight:700;font-size:1.5rem}
    p.lead{margin:0;color:var(--muted)}

    /* Mobile / Tablet: hide fixed sidebar and enable overlay drawer */
    @media (max-width:991px){
      .sidebar{transform:translateX(-110%);position:fixed;top:var(--header-height);z-index:1001;width:260px}
      .main{margin-left:0;padding:1rem}
      .btn-hamburger{display:inline-flex}
    }
    @media (min-width:992px){
      .btn-hamburger{display:none}
    }

    /* Drawer states */
    .drawer-open .sidebar{transform:translateX(0)}
    .drawer-overlay{
      display:none;
      position:fixed;inset:0;background:rgba(2,6,23,0.36);z-index:1000;opacity:0;transition:opacity .2s ease;
    }
    .drawer-open .drawer-overlay{display:block;opacity:1}

    /* small style tweaks for icons colors */
    .ic-orange{background:linear-gradient(135deg,var(--accent-orange), #ffbd85)}
    .ic-blue{background:linear-gradient(135deg,var(--accent-blue), #60a5fa)}
    .ic-green{background:linear-gradient(135deg,var(--accent-green), #6ee7b7)}

    /* scrollbar small style */
    .sidebar::-webkit-scrollbar{width:10px}
    .sidebar::-webkit-scrollbar-thumb{background:rgba(15,23,42,0.06);border-radius:10px}
  </style>
</head>
<body class="app" id="appRoot">
  <!-- Header -->
  <header class="header" role="banner">
    <div class="brand" aria-hidden="false">
      <div class="logo" aria-hidden="true">WM</div>
      <div>
        <h1>WeManage</h1>
        <p style="font-size:.75rem;color:var(--muted)">Espace administration</p>
      </div>
    </div>

    <div class="header-actions">
      <button class="btn-hamburger" id="btnMenu" aria-controls="sidebar" aria-expanded="false" aria-label="Ouvrir le menu">
        <span class="hamburger-icon" aria-hidden="true">
          <span></span><span></span><span></span>
        </span>
      </button>
    </div>
  </header>

  <!-- Drawer overlay for mobile -->
  <div class="drawer-overlay" id="drawerOverlay" tabindex="-1"></div>

  <!-- Sidebar -->
  <nav id="sidebar" class="sidebar" aria-label="Navigation principale">
    <ul class="nav-list" role="menu">
      <li role="none">
        <a class="nav-item<?=nav_active('dashboard',$page)?>" href="index.php?page=dashboard" role="menuitem">
          <span class="icon ic-blue" aria-hidden="true">
            <!-- home icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 11.5L12 4l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-8.5z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Accueil</span><span class="sub">Vue d'ensemble</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('dashboard',$page)?>" href="index.php?page=dashboard" role="menuitem">
          <span class="icon ic-orange" aria-hidden="true">
            <!-- dashboard icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM13 3v8h8V3h-8zM3 21h8v-6H3v6z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Dashboard</span><span class="sub">Rapports</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('users',$page)?>" href="index.php?page=users" role="menuitem">
          <span class="icon ic-green" aria-hidden="true">
            <!-- users icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M16 11c1.657 0 3-1.343 3-3S17.657 5 16 5s-3 1.343-3 3 1.343 3 3 3zM6 11c1.657 0 3-1.343 3-3S7.657 5 6 5 3 6.343 3 8s1.343 3 3 3zm10 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5c0-2.33-4.67-3.5-7-3.5zM6 13c-2.67 0-8 1.34-8 4v3h11v-3c0-2.66-5.33-4-8-4z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Utilisateurs</span><span class="sub">Gestion</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('categories',$page)?>" href="index.php?page=categories" role="menuitem">
          <span class="icon ic-orange" aria-hidden="true">
            <!-- categories icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM3 21h8v-6H3v6zM13 3v8h8V3h-8z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Catégories</span><span class="sub">Organiser</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('universities',$page)?>" href="index.php?page=universities" role="menuitem">
          <span class="icon ic-blue" aria-hidden="true">
            <!-- university icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2L1 7l11 5 9-4.09V17h2V7L12 2zM5 20v-2h14v2H5z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Universités</span><span class="sub">Liste</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('analytics',$page)?>" href="index.php?page=analytics" role="menuitem">
          <span class="icon ic-green" aria-hidden="true">
            <!-- analytics icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 13h2v5H3v-5zm6-8h2v13h-2V5zm6 4h2v9h-2V9zm6-6h2v15h-2V3z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Analytique</span><span class="sub">Statistiques</span></span>
        </a>
      </li>

      <li role="none">
        <a class="nav-item<?=nav_active('settings',$page)?>" href="index.php?page=settings" role="menuitem">
          <span class="icon ic-blue" aria-hidden="true">
            <!-- settings icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M19.14 12.936a7.962 7.962 0 0 0 0-1.872l2.037-1.58a.5.5 0 0 0 .12-.637l-1.928-3.338a.5.5 0 0 0-.607-.22l-2.4.96a8.06 8.06 0 0 0-1.62-.94l-.36-2.54A.5.5 0 0 0 13.5 2h-3a.5.5 0 0 0-.494.423l-.36 2.54a8.06 8.06 0 0 0-1.62.94l-2.4-.96a.5.5 0 0 0-.607.22L2.7 8.747a.5.5 0 0 0 .12.637L4.86 10.96a7.962 7.962 0 0 0 0 1.872L2.822 14.41a.5.5 0 0 0-.12.637l1.928 3.338c.16.277.49.39.78.29l2.4-.96c.5.36 1.06.66 1.62.94l.36 2.54c.05.28.28.49.56.49h3c.28 0 .51-.21.56-.49l.36-2.54c.56-.28 1.12-.58 1.62-.94l2.4.96c.29.12.62-.01.78-.29l1.928-3.338a.5.5 0 0 0-.12-.637l-2.037-1.58zM12 15.5A3.5 3.5 0 1 1 12 8.5a3.5 3.5 0 0 1 0 7z" fill="white"/></svg>
          </span>
          <span class="meta"><span class="label">Paramètres</span><span class="sub">Préférences</span></span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main content -->
  <main class="main" role="main">
    <?php
    // Routage simple par include
    $pageFile = __DIR__ . '/pages/' . basename($page) . '.php';
    if (file_exists($pageFile)) {
      include $pageFile;
    } else {
      echo '<section class="card"><h2>Page introuvable</h2><p class="lead">La page demandée n’existe pas.</p></section>'.$pageFile;
    }
    ?>
  </main>

  <script>
    (function(){
      const app = document.getElementById('appRoot');
      const btn = document.getElementById('btnMenu');
      const overlay = document.getElementById('drawerOverlay');

      function openDrawer(){
        app.classList.add('drawer-open');
        btn.setAttribute('aria-expanded','true');
        // focus first link for accessibility
        const firstLink = document.querySelector('#sidebar a');
        firstLink && firstLink.focus();
      }
      function closeDrawer(){
        app.classList.remove('drawer-open');
        btn.setAttribute('aria-expanded','false');
        btn.focus();
      }

      btn.addEventListener('click', function(){
        if(app.classList.contains('drawer-open')) closeDrawer();
        else openDrawer();
      });

      overlay.addEventListener('click', closeDrawer);

      // close on Escape
      window.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && app.classList.contains('drawer-open')){
          closeDrawer();
        }
      });

      // close drawer when resizing to desktop to avoid stuck state
      let resizeTimer;
      window.addEventListener('resize', function(){
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function(){
          if(window.innerWidth >= 992){
            app.classList.remove('drawer-open');
            btn.setAttribute('aria-expanded','false');
          }
        }, 150);
      });
    })();
  </script>
</body>
</html>