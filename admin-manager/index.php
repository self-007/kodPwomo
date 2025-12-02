<?php
// Admin Manager - Single Entry
// Responsive admin shell: fixed header, left sidebar (desktop), hamburger menu (mobile/tablet)
// Main area shows welcome message or includes page content based on ?page=...

function safe($s) {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9\-\_]/i', '', $_GET['page']) : '';

?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin • KodPwomo</title>
    <meta name="description" content="Interface d'administration KodPwomo — gestion des utilisateurs, produits, agents, commandes, analytics et dashboard.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="/kodpwomo/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Neumorphic White Palette */
        :root {
            --surface: #ffffff;
            --surface-dim: #f8f9fa;
            --surface-container: #f1f5f9;
            
            --on-surface: #2a4f7d;
            --on-surface-variant: #475569;
            --on-surface-muted: #64748b;
            --outline: #cbd5e1;
            --outline-variant: #e2e8f0;
            --shadow-neo: 10px 10px 22px rgba(0,0,0,0.10), -10px -10px 22px rgba(255,255,255,0.95);
            
            --spacing-1: 8px;
            --spacing-2: 16px;
            --spacing-3: 24px;
            --spacing-4: 32px;
            --spacing-5: 40px;
        }
        
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body {
            font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            color: var(--on-surface);
            line-height: 1.6;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Header - White with Neumorphic shadow */
        header.admin-header {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 64px;
            background: #ffffff;
            box-shadow: var(--shadow-neo);
            display: flex;
            align-items: center;
            padding: 0 var(--spacing-2);
            z-index: 100;
        }
        
        header .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.3px;
            color: var(--on-surface);
        }
        
        header .brand img.brand-logo {
            height: 50px;
            width: auto;
            display: block;
            object-fit: contain;
        }
        
        header .hamburger {
            display: none;
            background: #f1f5f9;
            border: none;
            color: var(--on-surface);
            cursor: pointer;
            padding: var(--spacing-1);
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-neo);
        }
        
        header .hamburger:hover {
            background: #eef2f7;
        }
        
        header .profile {
            display: flex;
            align-items: center;
            gap: var(--spacing-1);
            background: #f8fafc;
            color: var(--on-surface);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            margin-left: auto;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        
        /* Layout */
        .app-wrap {
            display: block;
            padding-top: 64px;
            min-height: 100vh;
        }
        
        /* Sidebar */
        nav.sidebar {
            width: 280px;
            background: #ffffff;
            padding: var(--spacing-2) 0;
            position: fixed;
            left: 0;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            box-shadow: var(--shadow-neo);
        }
        
        nav.sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        nav.sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .sidebar .nav-group {
            margin-bottom: var(--spacing-3);
        }
        
        .sidebar .nav-group h4 {
            margin: 0 var(--spacing-2) var(--spacing-1);
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            color: #475569;
            padding: 10px var(--spacing-2);
            text-decoration: none;
            margin: 4px var(--spacing-1);
            border-radius: 8px;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar a .material-icons {
            margin-right: 12px;
            font-size: 18px;
        }
        
        .sidebar a:hover {
            background: #f1f5f9;
            color: var(--on-surface);
            border-left-color: #cbd5e1;
        }
        
        .sidebar a.link-active {
            background: #f1f5f9;
            color: var(--on-surface);
            border-left-color: #94a3b8;
            font-weight: 700;
        }
        
        /* Content Area */
        main.content {
            margin-left: 280px;
            padding: var(--spacing-4);
            min-height: calc(100vh - 64px);
            background: #f8fafc;
        }
        
        /* Welcome Card */
        .welcome {
            background: #ffffff;
            border: 1px solid #eef2f7;
            border-radius: 16px;
            box-shadow: var(--shadow-neo);
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-5);
            position: relative;
            overflow: hidden;
        }
        
        .welcome::before {
            content: none;
        }
        
        .welcome h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.3;
            color: #2a4f7d;
            margin-bottom: var(--spacing-2);
        }
        
        .welcome .subtitle-badge {
            display: inline-block;
            background: #ffffff;
            color: #475569;
            padding: 0.35rem 0.85rem;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: var(--spacing-2);
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-neo);
        }
        
        .welcome .lead {
            font-size: 15px;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: var(--spacing-3);
            max-width: 700px;
        }
        
        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-3);
            margin: var(--spacing-4) 0;
        }
        
        .feature {
            display: flex;
            gap: var(--spacing-2);
            padding: var(--spacing-3);
            background: #ffffff;
            border-radius: 12px;
            box-shadow: var(--shadow-neo);
        }
        
        .feature svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            stroke: #94a3b8;
        }
        
        .feature strong {
            color: #1a1a2e;
            font-weight: 700;
            font-size: 14px;
        }
        
        .feature small {
            color: #64748b;
            font-size: 13px;
            margin-top: 0.25rem;
        }
        
        .quick-links {
            display: flex;
            gap: var(--spacing-2);
            flex-wrap: wrap;
            margin-top: var(--spacing-4);
        }
        
        .quick-links a {
            padding: 0.7rem 1.5rem;
            background: #ffffff;
            color: var(--on-surface);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            transition: all 0.2s ease;
            border: 1px solid #eaeef3;
            cursor: pointer;
            box-shadow: var(--shadow-neo);
        }
        
        .quick-links a:hover {
            transform: translateY(-2px);
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        
        h1 { font-size: 2.2rem; line-height: 1.3; }
        h2 { font-size: 1.8rem; line-height: 1.3; }
        h3 { font-size: 1.4rem; line-height: 1.4; }
        h4 { font-size: 1.1rem; line-height: 1.4; }
        h5 { font-size: 0.95rem; line-height: 1.5; }
        h6 { font-size: 0.9rem; line-height: 1.5; }
        header .hamburger {
            display: none;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .kpi-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: var(--spacing-1);
            }
        }
        
        @media (max-width: 768px) {
            header .hamburger {
                display: flex;
            }
            
            nav.sidebar {
                position: fixed;
                left: -280px;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            
            nav.sidebar.open {
                left: 0;
            }
            
            main.content {
                margin-left: 0;
                padding: var(--spacing-3);
            }
            
            .welcome {
                padding: var(--spacing-4);
            }
            
            .welcome h1 {
                font-size: 1.8rem;
            }
            header .profile { display: none; }
            header .brand img.brand-logo { height: 40px; }
        }
        
        @media (max-width: 480px) {
            .welcome {
                padding: var(--spacing-3);
            }
            
            .welcome h1 {
                font-size: 1.4rem;
            }
            
            .feature-list {
                grid-template-columns: 1fr;
            }
            
            .quick-links {
                flex-direction: column;
            }
            
            .quick-links a {
                width: 100%;
                text-align: center;
            }
            header .brand img.brand-logo { height: 28px; }
        }
    </style>
</head>
<body>
    <header class="admin-header" role="banner">
        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span class="material-icons">menu</span>
        </button>
        <div class="brand">
            <img src="../image/logo/logo1.1.jpg" alt="KodPwomo" class="brand-logo">
        
        </div>
        <div class="profile" aria-label="Profil administrateur">
            <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;color:white;font-weight:500">A</div>
            <div class="name"><?php echo safe('Admin'); ?></div>
        </div>
    </header>

    <div class="app-wrap">
        <nav class="sidebar" id="sidebar" role="navigation" aria-label="Menu principal">
            <div class="nav-group">
                <h4>Général</h4>
                <a href="?page=home" class="nav-link">
                    <span class="material-icons">home</span>
                    Accueil
                </a>
                <a href="?page=dashboard" class="nav-link">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>
                <a href="?page=analytics" class="nav-link">
                    <span class="material-icons">analytics</span>
                    Analytics
                </a>
            </div>
            <div class="nav-group">
                <h4>Gestion</h4>
                <a href="?page=agents" class="nav-link">
                    <span class="material-icons">delivery_dining</span>
                    Agents
                </a>
                <a href="?page=users" class="nav-link">
                    <span class="material-icons">people</span>
                    Users
                </a>
                <a href="?page=products" class="nav-link">
                    <span class="material-icons">inventory</span>
                    Products
                </a>
                <a href="?page=places" class="nav-link">
                    <span class="material-icons">place</span>
                    Places
                </a>
                <a href="?page=orders" class="nav-link">
                    <span class="material-icons">shopping_cart</span>
                    Orders
                </a>
            </div>
            <div class="nav-group">
                <h4>Paramètres</h4>
                <a href="?page=settings" class="nav-link">
                    <span class="material-icons">settings</span>
                    Settings
                </a>
                <a href="?page=logout" class="nav-link">
                    <span class="material-icons">logout</span>
                    Logout
                </a>
            </div>
            <small class="muted" style="padding: 16px;">&copy; KodPwomo</small>
        </nav>

        <main class="content" role="main">
            <?php if (!$page || $page === 'home'): ?>
                <section class="welcome" aria-labelledby="welcome-title">
                    <div class="welcome-inner">
                        <span class="subtitle-badge">Administration</span>
                        <h1 id="welcome-title">Bienvenue sur le Tableau de bord KodPwomo</h1>
                        <div class="lead">Ce panneau central vous permet de superviser l'activité de la plateforme, d'intervenir sur les commandes et les livraisons, et d'analyser les performances.</div>

                        <div class="feature-list">
                            <div class="feature">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="var(--secondary)" stroke-width="1.5"/><path d="M8 12h8" stroke="var(--secondary)" stroke-width="1.6" stroke-linecap="round"/></svg>
                                <div>
                                    <strong>Surveillance en temps réel</strong>
                                    <small>Commandes et agents</small>
                                </div>
                            </div>
                            <div class="feature">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="16" rx="2" stroke="var(--secondary)" stroke-width="1.5"/><path d="M7 9h10M7 13h6" stroke="var(--secondary)" stroke-width="1.4" stroke-linecap="round"/></svg>
                                <div>
                                    <strong>Gestion</strong>
                                    <small>Utilisateurs, produits, lieux</small>
                                </div>
                            </div>
                        </div>

                        <div class="quick-links">
                            <a href="?page=orders">Voir les commandes</a>
                            <a href="?page=users">Gérer les utilisateurs</a>
                            <a href="?page=analytics">Consulter analytics</a>
                        </div>
                    </div>
                </section>
            <?php else: ?>
                <?php
                    // Resolve allowed pages to prevent arbitrary file includes
                    $allowed = ['dashboard','analytics','agents','users','products','places','orders','settings','logout'];
                    if (in_array($page, $allowed)) {
                        // Try to include a page implementation if exists
                        $pfile = __DIR__ . '/pages/' . $page . '.php';
                        if (is_file($pfile)) {
                            include $pfile;
                        } else {
                            echo '<section class="welcome"><h2>Section: '.safe($page).'</h2><p class="muted">Aucun contenu spécifique pour cette page. Créez "admin-manager/pages/'.safe($page).'.php" pour afficher les données ici.</p></section>';
                        }
                    } else {
                        echo '<section class="welcome"><h2>Page inconnue</h2><p class="muted">La page demandée est inconnue.</p></section>';
                    }
                ?>
            <?php endif; ?>
        </main>
    </div>

    <script>
        (function(){
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            hamburger.addEventListener('click', function(){
                sidebar.classList.toggle('open');
            });

            document.addEventListener('click', function(e){
                if (window.innerWidth <= 900) {
                    if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            const active = new URLSearchParams(window.location.search).get('page') || 'home';
            document.querySelectorAll('.nav-link').forEach(a => {
                const href = (a.getAttribute('href')||'').replace('?page=','');
                if (href === active) a.classList.add('link-active');
            });
        })();
    </script>
</body>
</html>
