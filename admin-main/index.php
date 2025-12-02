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
      --header-height:70px;
      --sidebar-width:270px;
      --bg:#f8fafc;
      --card:#ffffff;
      --muted:#64748b;
      --primary:#f7b642;
      --primary-dark:#e19627;
      --accent-orange:#ff7a18;
      --accent-blue:#2563eb;
      --accent-green:#27ae60;
      --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
      --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
      --shadow-soft: 0 2px 8px rgba(0,0,0,0.08);
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
      padding:0 1.5rem;
      background:#ffffff;
      border-bottom:1px solid #e2e8f0;
      z-index:1000;
      box-shadow: var(--shadow-3d-base);
      transition: all 0.3s ease;
    }
    .header:hover{
      box-shadow: var(--shadow-3d-hover);
    }
    .brand{
      display:flex;
      align-items:center;
      gap:1rem;
      cursor:pointer;
      transition: transform 0.3s ease;
    }
    .brand:hover{
      transform: translateY(-2px);
    }
    .logo{
      width:48px;
      height:48px;
      border-radius:12px;
      display:inline-grid;
      place-items:center;
      background:linear-gradient(135deg, var(--primary), var(--primary-dark));
      color:white;
      font-weight:700;
      font-size:1.2rem;
      box-shadow: var(--shadow-3d-base);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .logo:before{
      content:'';
      position:absolute;
      inset:0;
      background:rgba(255,255,255,0.2);
      transform:translateX(-100%);
      transition:transform 0.6s ease;
    }
    .brand:hover .logo{
      box-shadow: var(--shadow-3d-hover);
      transform: scale(1.05);
    }
    .brand:hover .logo:before{
      transform:translateX(100%);
    }
    .brand h1{
      font-size:1.2rem;
      margin:0;
      line-height:1.2;
      color:#1a1a2e;
      font-weight:700;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .brand p{
      margin:0;
      font-size:0.85rem;
      color:var(--muted);
      font-weight:500;
    }

    .header-actions{
      display:flex;
      align-items:center;
      gap:.75rem;
    }
    .btn-hamburger{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:48px;
      height:48px;
      border-radius:12px;
      border:none;
      background:#ffffff;
      cursor:pointer;
      box-shadow: var(--shadow-3d-base);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .btn-hamburger:before{
      content:'';
      position:absolute;
      inset:0;
      background:rgba(247,182,66,0.1);
      transform:scale(0);
      transition:transform 0.4s ease;
      border-radius:12px;
    }
    .btn-hamburger:hover{
      box-shadow: var(--shadow-3d-hover);
      transform: translateY(-2px);
    }
    .btn-hamburger:hover:before{
      transform:scale(1);
    }
    .btn-hamburger:active{
      transform: translateY(0) scale(0.95);
    }
    .hamburger-icon{
      width:22px;
      height:16px;
      display:block;
      position:relative;
      z-index:1;
    }
    .hamburger-icon span{
      position:absolute;
      left:0;
      right:0;
      height:2.5px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius:2px;
      transition:transform .3s cubic-bezier(0.4, 0, 0.2, 1), opacity .2s ease;
    }
    .hamburger-icon span:nth-child(1){top:0}
    .hamburger-icon span:nth-child(2){top:7px}
    .hamburger-icon span:nth-child(3){top:14px}
    .drawer-open .hamburger-icon span:nth-child(1){
      transform: translateY(7px) rotate(45deg);
    }
    .drawer-open .hamburger-icon span:nth-child(2){
      opacity: 0;
    }
    .drawer-open .hamburger-icon span:nth-child(3){
      transform: translateY(-7px) rotate(-45deg);
    }

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
      top:var(--header-height);
      bottom:0;
      width:var(--sidebar-width);
      background:#ffffff;
      border-right:1px solid #e2e8f0;
      padding:1.5rem 0;
      box-shadow: var(--shadow-3d-base);
      overflow:auto;
      z-index:900;
      transform:translateX(0);
      transition:transform .3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-list{
      list-style:none;
      margin:0;
      padding:0 1rem;
    }
    .nav-item{
      display:flex;
      align-items:center;
      gap:1rem;
      padding:0.75rem 1rem;
      border-radius:12px;
      margin:0.5rem 0;
      color:#1a1a2e;
      background:#ffffff;
      border:1px solid transparent;
      box-shadow: var(--shadow-soft);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    .nav-item:before{
      content:'';
      position:absolute;
      left:0;
      top:0;
      bottom:0;
      width:4px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      transform:scaleX(0);
      transform-origin:left;
      transition:transform 0.3s ease;
    }
    .nav-item:hover{
      background:#f0fdf4;
      border-color:var(--primary);
      box-shadow: var(--shadow-3d-base);
      transform: translateX(4px);
    }
    .nav-item:hover:before{
      transform:scaleX(1);
    }
    .nav-item.active{
      background: linear-gradient(135deg, rgba(247,182,66,0.1), rgba(225,150,39,0.05));
      border-color:var(--primary);
      box-shadow: var(--shadow-3d-hover);
      font-weight:600;
    }
    .nav-item.active:before{
      transform:scaleX(1);
    }
    .nav-item .icon{
      width:42px;
      height:42px;
      display:inline-grid;
      place-items:center;
      border-radius:10px;
      color:white;
      font-weight:700;
      flex:0 0 42px;
      box-shadow: var(--shadow-soft);
      transition: all 0.3s ease;
    }
    .nav-item:hover .icon{
      box-shadow: var(--shadow-3d-base);
      transform: scale(1.1) rotate(-5deg);
    }
    .nav-item .meta{
      display:flex;
      flex-direction:column;
      gap:2px;
    }
    .nav-item .meta .label{
      font-weight:600;
      font-size:0.95rem;
      color:#1a1a2e;
    }
    .nav-item .meta .sub{
      font-size:0.8rem;
      color:var(--muted);
      font-weight:500;
    }

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
      border-radius:16px;
      padding:1.5rem;
      box-shadow: var(--shadow-3d-base);
      border:1px solid #e2e8f0;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .card:hover{
      box-shadow: var(--shadow-3d-hover);
      transform: translateY(-4px);
    }
    .card:before{
      content:'';
      position:absolute;
      top:0;
      left:0;
      right:0;
      height:4px;
      background: linear-gradient(90deg, var(--primary), var(--primary-dark));
      transform:scaleX(0);
      transform-origin:left;
      transition:transform 0.3s ease;
    }
    .card:hover:before{
      transform:scaleX(1);
    }
    h2{
      margin:0;
      font-weight:700;
      font-size:1.5rem;
      color:#1a1a2e;
    }
    p.lead{
      margin:0.5rem 0 0;
      color:var(--muted);
      font-size:1rem;
      line-height:1.6;
    }

    /* Mobile / Tablet: hide fixed sidebar and enable overlay drawer */
    @media (max-width:991px){
      .sidebar{
        transform:translateX(-110%);
        position:fixed;
        top:var(--header-height);
        z-index:1001;
        width:270px;
      }
      .main{
        margin-left:0;
        padding:1rem;
      }
      .btn-hamburger{
        display:inline-flex;
      }
      .brand h1{
        font-size:1rem;
      }
      .logo{
        width: 100px;
        height:42px;
      }
      .header{
        padding:0 1rem;
      }
    }
    @media (max-width:640px){
      .header{
        padding:0 0.75rem;
      }
      .brand h1{
        font-size:0.9rem;
      }
      .brand p{
        font-size:0.75rem;
      }
      .logo{
        width:38px;
        height:38px;
        font-size:1rem;
      }
      .btn-hamburger{
        width:42px;
        height:42px;
      }
    }
    @media (min-width:992px){
      .btn-hamburger{
        display:none;
      }
    }

    /* Drawer states */
    .drawer-open .sidebar{
      transform:translateX(0);
      box-shadow: var(--shadow-3d-hover);
    }
    .drawer-overlay{
      display:none;
      position:fixed;
      inset:0;
      background:rgba(0,0,0,0.5);
      backdrop-filter:blur(4px);
      z-index:1000;
      opacity:0;
      transition:opacity .3s ease;
    }
    .drawer-open .drawer-overlay{
      display:block;
      opacity:1;
    }

    /* small style tweaks for icons colors */
    .ic-orange{
      background:linear-gradient(135deg, var(--accent-orange), #ffbd85);
      box-shadow: 0 2px 8px rgba(255,122,24,0.3);
    }
    .ic-blue{
      background:linear-gradient(135deg, var(--accent-blue), #60a5fa);
      box-shadow: 0 2px 8px rgba(37,99,235,0.3);
    }
    .ic-green{
      background:linear-gradient(135deg, var(--accent-green), #6ee7b7);
      box-shadow: 0 2px 8px rgba(39,174,96,0.3);
    }

    /* scrollbar small style */
    .sidebar::-webkit-scrollbar{
      width:8px;
    }
    .sidebar::-webkit-scrollbar-track{
      background:#f8fafc;
      border-radius:10px;
    }
    .sidebar::-webkit-scrollbar-thumb{
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius:10px;
      transition: all 0.3s ease;
    }
    .sidebar::-webkit-scrollbar-thumb:hover{
      background: var(--primary-dark);
    }
  </style>
</head>
<body class="app" id="appRoot">
  <!-- Header -->
  <header class="header" role="banner">
    <div class="brand" aria-hidden="false">
      <div class="logo" aria-hidden="true" style="background:#fff;display:flex;align-items:center;justify-content:center;padding:0; width: 200px;">
        <img src="../image/logo/logo1.1.jpg" alt="KodPwomo" style="width:100%;height:100%;object-fit:cover;border-radius:12px" onerror="this.src='../image/logo/logo1.1.jpg'" />
      </div>
      <div>
        
       
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