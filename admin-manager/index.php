<?php
// Admin Manager - Single Entry
// Responsive admin shell: fixed header, left sidebar (desktop), hamburger menu (mobile/tablet)
// Main area shows welcome message or includes page content based on ?page=...

function safe($s) {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9\-\_]/i', '', $_GET['page']) : '';

// KodPwomo base palette (from palettes_couleurs.html)
$primary = '#FF6B6B';
$secondary = '#4ECDC4';
$accent = '#45B7D1';
$success = '#96CEB4';
$warning = '#FFEAA7';
$bg = '#f8fafc';
$muted = '#6b7280';

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
        /* KodPwomo Design System */
        :root {
            /* KodPwomo Brand Colors */
            --brand-primary: #FF6B6B;
            --brand-secondary: #4ECDC4;
            --brand-accent: #45B7D1;
            --brand-success: #96CEB4;
            --brand-warning: #FFEAA7;
            --brand-danger: #FF7675;
            --brand-info: #74B9FF;
            
            /* KodPwomo Surface Colors */
            --surface: #ffffff;
            --surface-dim: #f8fafc;
            --surface-bright: #ffffff;
            --surface-container: #f1f5f9;
            --surface-container-low: #f8fafc;
            --surface-container-high: #e2e8f0;
            --surface-elevated: #ffffff;
            
            /* KodPwomo Text Colors */
            --on-surface: #0f172a;
            --on-surface-variant: #475569;
            --on-surface-muted: #64748b;
            --outline: #cbd5e1;
            --outline-variant: #e2e8f0;
            
            /* KodPwomo Light Tints */
            --primary-50: #fff5f5;
            --primary-100: #fed7d7;
            --secondary-50: #f0fdfa;
            --secondary-100: #ccfbf1;
            --accent-50: #eff6ff;
            --accent-100: #dbeafe;
            --success-50: #f0fdf4;
            --success-100: #dcfce7;
            --warning-50: #fffbeb;
            --warning-100: #fef3c7;
            
            /* Material Design Elevations */
            --md-elevation-1: 0px 1px 3px 1px rgba(0, 0, 0, 0.15), 0px 1px 2px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-2: 0px 2px 6px 2px rgba(0, 0, 0, 0.15), 0px 1px 2px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-3: 0px 4px 8px 3px rgba(0, 0, 0, 0.15), 0px 1px 3px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-4: 0px 6px 10px 4px rgba(0, 0, 0, 0.15), 0px 2px 3px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-5: 0px 8px 12px 6px rgba(0, 0, 0, 0.15), 0px 4px 4px 0px rgba(0, 0, 0, 0.30);
            
            /* 8dp Grid System */
            --spacing-1: 8px;
            --spacing-2: 16px;
            --spacing-3: 24px;
            --spacing-4: 32px;
            --spacing-5: 40px;
            --spacing-6: 48px;
        }
        
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: var(--surface-dim);
            color: var(--on-surface);
            line-height: 1.5;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Header with KodPwomo branding */
        header.admin-header {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 64px;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 var(--spacing-2);
            z-index: 100;
            border-bottom: 1px solid var(--outline-variant);
            box-shadow: var(--md-elevation-2);
        }
        
        header .brand {
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 0.5px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        header .header-right {
            margin-left: auto;
            display: flex;
            gap: var(--spacing-2);
            align-items: center;
        }
        
        header .hamburger {
            display: none;
            background: rgba(255,255,255,0.1);
            border: 0;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
            padding: var(--spacing-1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        header .hamburger:hover {
            background-color: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }
        
        header .profile {
            display: flex;
            align-items: center;
            gap: var(--spacing-1);
            background: rgba(255,255,255,0.15);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
        }
        
        /* Layout */
        .app-wrap {
            display: block;
            padding-top: 64px;
            min-height: 100vh;
        }
        
        /* KodPwomo Navigation Sidebar */
        nav.sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--surface-elevated), var(--surface-container-low));
            border-right: 2px solid var(--brand-secondary);
            padding: var(--spacing-2) 0;
            position: fixed;
            left: 0;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }
        
        nav.sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        nav.sidebar::-webkit-scrollbar-thumb {
            background: var(--brand-accent);
            border-radius: 3px;
        }
        
        .sidebar .nav-group {
            margin-bottom: var(--spacing-3);
        }
        
        .sidebar .nav-group h4 {
            margin: 0 0 var(--spacing-1) var(--spacing-2);
            color: var(--on-surface-variant);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            background: linear-gradient(90deg, var(--brand-accent), var(--brand-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            color: var(--on-surface);
            padding: 12px var(--spacing-2);
            text-decoration: none;
            margin: 4px var(--spacing-1);
            border-radius: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
        }
        
        .sidebar a .material-icons {
            margin-right: 12px;
            font-size: 20px;
            transition: all 0.3s ease;
        }
        
        /* Individual icon colors */
        .sidebar a[href*="dashboard"] .material-icons { color: var(--brand-primary); }
        .sidebar a[href*="analytics"] .material-icons { color: var(--brand-accent); }
        .sidebar a[href*="users"] .material-icons { color: var(--brand-secondary); }
        .sidebar a[href*="agents"] .material-icons { color: var(--brand-info); }
        .sidebar a[href*="products"] .material-icons { color: var(--brand-warning); }
        .sidebar a[href*="orders"] .material-icons { color: var(--brand-success); }
        .sidebar a[href*="places"] .material-icons { color: var(--brand-danger); }
        .sidebar a[href*="settings"] .material-icons { color: var(--on-surface-variant); }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 16px;
        }
        
        .sidebar a:hover {
            border-color: var(--brand-accent);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .sidebar a:hover::before {
            opacity: 0.1;
        }
        
        .sidebar a:hover .material-icons {
            transform: scale(1.1);
            filter: brightness(1.2);
        }
        
        .sidebar a.active {
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            color: #ffffff;
            border-color: var(--brand-accent);
            box-shadow: 0 6px 16px rgba(255, 107, 107, 0.3);
        }
        
        .sidebar a.active .material-icons {
            color: #ffffff;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        .sidebar a.active::before {
            opacity: 0;
        }
        
        /* Content Area */
        main.content {
            margin-left: 280px;
            padding: var(--spacing-3);
            min-height: calc(100vh - 64px);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--surface-dim);
        }
        
        /* KodPwomo Welcome Card */
        .welcome {
            background: linear-gradient(135deg, var(--surface-elevated), var(--surface-container-low));
            padding: var(--spacing-5);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            max-width: 1000px;
            margin: var(--spacing-3) auto;
            border: 2px solid var(--brand-accent);
            position: relative;
            overflow: hidden;
        }
        
        .welcome::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--brand-primary), var(--brand-secondary), var(--brand-accent));
        }
        
        .welcome h1 {
            margin: 0 0 var(--spacing-1) 0;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }
        
        .welcome .subtitle-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--brand-accent), var(--brand-info));
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: var(--spacing-2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(69, 183, 209, 0.3);
        }
        
        .welcome .lead {
            margin-top: var(--spacing-1);
            color: var(--on-surface-variant);
            font-size: 16px;
            line-height: 1.6;
        }
        
        /* Material Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-1);
            padding: 10px var(--spacing-3);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            min-height: 40px;
        }
        
        .btn-primary {
            background: var(--md-primary);
            color: var(--md-on-primary);
            box-shadow: var(--md-elevation-1);
        }
        
        .btn-primary:hover {
            box-shadow: var(--md-elevation-2);
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: var(--md-secondary-container);
            color: var(--md-on-secondary-container);
            border: 1px solid var(--md-outline);
        }
        
        .btn-secondary:hover {
            box-shadow: var(--md-elevation-1);
        }
        
        /* Enhanced Responsive Design */
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
            
            header .brand {
                font-size: 18px;
            }
            
            nav.sidebar {
                position: fixed;
                left: -280px;
                top: 64px;
                height: calc(100vh - 64px);
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1000;
                box-shadow: var(--md-elevation-4);
            }
            
            nav.sidebar.open {
                left: 0;
            }
            
            main.content {
                margin-left: 0;
                padding: var(--spacing-2);
            }
            
            .welcome {
                padding: var(--spacing-3);
            }
            
            .welcome h1 {
                font-size: 1.8rem;
            }
            
            /* Table Improvements */
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 12px;
                margin: 0 -4px;
            }
            
            table {
                min-width: 600px;
                width: 100%;
            }
            
            th, td {
                white-space: nowrap;
                min-width: 100px;
            }
            
            th:last-child, td:last-child {
                position: sticky;
                right: 0;
                background: var(--surface-elevated);
                z-index: 1;
                box-shadow: -2px 0 4px rgba(0,0,0,0.1);
            }
            
            .status-col {
                min-width: 120px !important;
                max-width: 140px;
            }
            
            .btn-col {
                min-width: 100px !important;
                padding: 8px 4px !important;
            }
            
            /* Button Fixes */
            .btn, .btn-sm {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 100%;
                box-sizing: border-box;
            }
            
            .controls {
                flex-wrap: wrap;
                gap: var(--spacing-1);
            }
            
            .search {
                min-width: 160px;
                max-width: 100%;
                box-sizing: border-box;
            }
        }
        
        @media (max-width: 480px) {
            header {
                padding: 0 var(--spacing-1);
            }
            
            .welcome {
                padding: var(--spacing-2);
                margin: var(--spacing-1);
            }
            
            .welcome h1 {
                font-size: 1.5rem;
            }
            
            main.content {
                padding: var(--spacing-1);
            }
            
            .kpi-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-1);
            }
            
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search, .filter, .btn {
                width: 100%;
                margin-bottom: var(--spacing-1);
            }
            
            /* Mobile Card Layout for Tables */
            .mobile-cards {
                display: block;
            }
            
            .mobile-cards table {
                display: none;
            }
            
            .card {
                background: var(--surface-elevated);
                border: 1px solid var(--outline-variant);
                border-radius: 12px;
                padding: var(--spacing-2);
                margin-bottom: var(--spacing-1);
                box-shadow: var(--md-elevation-1);
            }
            
            .card-header {
                font-weight: 700;
                color: var(--brand-primary);
                margin-bottom: var(--spacing-1);
                border-bottom: 1px solid var(--outline-variant);
                padding-bottom: var(--spacing-1);
            }
            
            .card-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: var(--spacing-1);
                margin-bottom: var(--spacing-1);
            }
            
            .card-field {
                display: flex;
                flex-direction: column;
            }
            
            .card-label {
                font-size: 11px;
                color: var(--on-surface-variant);
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 2px;
            }
            
            .card-value {
                font-weight: 500;
                color: var(--on-surface);
            }
            
            .card-actions {
                display: flex;
                gap: var(--spacing-1);
                justify-content: flex-end;
                flex-wrap: wrap;
            }
            
            .card-actions .btn, .card-actions .btn-sm {
                flex: 1;
                min-width: 80px;
            }
        }
        
        /* Material Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 400;
            letter-spacing: -0.01em;
        }
        
        h1 { font-size: 2.5rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.75rem; }
        h4 { font-size: 1.5rem; }
        h5 { font-size: 1.25rem; }
        h6 { font-size: 1rem; }
        
        /* Utilities */
        .muted { color: var(--md-on-surface-variant); }
    </style>
</head>
<body>
    <header class="admin-header" role="banner">
        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span class="material-icons">menu</span>
        </button>
        <div class="brand">KodPwomo Admin</div>
        <div class="header-right">
            <div class="profile" aria-label="Profil administrateur">
                <div style="width:32px;height:32px;border-radius:50%;background:var(--md-primary-container);display:flex;align-items:center;justify-content:center;color:var(--md-on-primary-container);font-weight:500">A</div>
                <div class="name"><?php echo safe('Admin'); ?></div>
            </div>
        </div>
    </header>

    <div class="app-wrap">
        <nav class="sidebar" id="sidebar" role="navigation" aria-label="Menu principal">
            <div class="nav-group">
                <h4>Général</h4>
                <a href="?page=home" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">home</span>
                    Accueil
                </a>
                <a href="?page=dashboard" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">dashboard</span>
                    Dashboard
                </a>
                <a href="?page=analytics" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">analytics</span>
                    Analytics
                </a>
            </div>
            <div class="nav-group">
                <h4>Gestion</h4>
                <a href="?page=agents" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">delivery_dining</span>
                    Agents
                </a>
                <a href="?page=users" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">people</span>
                    Users
                </a>
                <a href="?page=products" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">inventory</span>
                    Products
                </a>
                <a href="?page=places" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">place</span>
                    Places
                </a>
                <a href="?page=orders" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">shopping_cart</span>
                    Orders
                </a>
            </div>
            <div class="nav-group">
                <h4>Paramètres</h4>
                <a href="?page=settings" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">settings</span>
                    Settings
                </a>
                <a href="?page=logout" class="nav-link">
                    <span class="material-icons" style="margin-right: 12px; font-size: 20px;">logout</span>
                    Logout
                </a>
            </div>
            <small class="muted" style="padding: 16px;">&copy; KodPwomo</small>
        </nav>

        <main class="content" role="main">
            <?php if (!$page || $page === 'home'): ?>
                <section class="welcome" aria-labelledby="welcome-title">
                    <div class="welcome-inner">
                        <div class="welcome-left">
                            <span class="subtitle-badge">Administration</span>
                            <h1 id="welcome-title">Bienvenue sur le Tableau de bord KodPwomo</h1>
                            <div class="lead">Ce panneau central vous permet de superviser l'activité de la plateforme, d'intervenir sur les commandes et les livraisons, et d'analyser les performances.</div>

                            <div class="feature-list" aria-hidden="false">
                                <div class="feature">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="var(--secondary)" stroke-width="1.5"/><path d="M8 12h8" stroke="var(--primary)" stroke-width="1.6" stroke-linecap="round"/></svg>
                                    <div>
                                        <strong>Surveillance en temps réel</strong>
                                        <small>Commandes et agents</small>
                                    </div>
                                </div>
                                <div class="feature">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="16" rx="2" stroke="var(--accent)" stroke-width="1.5"/><path d="M7 9h10M7 13h6" stroke="var(--primary)" stroke-width="1.4" stroke-linecap="round"/></svg>
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
                        <aside class="welcome-right">
                            <div class="welcome-illustration">
                                <div style="text-align:center">
                                    <h3 style="margin:0 0 6px 0">Résumé rapide</h3>
                                    <div style="font-size:28px;font-weight:700;color:var(--primary)">—</div>
                                    <div style="margin-top:8px;color:var(--muted);font-size:13px">Commandes aujourd'hui • Agents actifs • Nouveaux utilisateurs</div>
                                </div>
                            </div>
                        </aside>
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

            // Close sidebar when clicking outside on small screens
            document.addEventListener('click', function(e){
                if (window.innerWidth <= 900) {
                    if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });

            // Highlight active link
            const active = new URLSearchParams(window.location.search).get('page') || 'home';
            document.querySelectorAll('.nav-link').forEach(a => {
                const href = (a.getAttribute('href')||'').replace('?page=','');
                if (href === active) a.classList.add('link-active');
            });
        })();
    </script>
</body>
</html>
