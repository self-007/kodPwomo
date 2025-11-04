<?php
// Admin Manager - Single Entry
// Responsive admin shell: fixed header, left sidebar (desktop), hamburger menu (mobile/tablet)
// Main area shows welcome message or includes page content based on ?page=...

function safe($s) {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9\-\_]/i', '', $_GET['page']) : '';

// KodPwomo Hybrid Color Palette
$primary = '#FF6B35';
$primary_dark = '#D84315';
$secondary = '#004E89';
$accent = '#00D4FF';
$success = '#1ABC9C';
$success_dark = '#16A085';
$error = '#FF6B35';
$warning = '#F39C12';
$bg = '#f8f9fa';
$muted = '#64748b';

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
            /* KodPwomo Hybrid Brand Colors */
            --brand-primary: #FF6B35;
            --brand-primary-dark: #D84315;
            --brand-secondary: #004E89;
            --brand-accent: #00D4FF;
            --brand-success: #1ABC9C;
            --brand-success-dark: #16A085;
            --brand-danger: #FF6B35;
            --brand-info: #00D4FF;
            --brand-warning: #F39C12;
            
            /* Surface Colors */
            --surface: #ffffff;
            --surface-dim: #f8f9fa;
            --surface-bright: #ffffff;
            --surface-container: #f1f5f9;
            --surface-container-low: #f8f9fa;
            --surface-container-high: #e2e8f0;
            --surface-elevated: #ffffff;
            
            /* Text Colors */
            --on-surface: #1a1a2e;
            --on-surface-variant: #475569;
            --on-surface-muted: #64748b;
            --outline: #cbd5e1;
            --outline-variant: #e2e8f0;
            
            /* Light Tints */
            --primary-50: #fff5f0;
            --primary-100: #ffd9cc;
            --secondary-50: #f0f4ff;
            --secondary-100: #cce4ff;
            --accent-50: #e0f7ff;
            --accent-100: #b3f0ff;
            --success-50: #f0fdf4;
            --success-100: #dcfce7;
            --warning-50: #fffbeb;
            --warning-100: #fef3c7;
            
            /* Elevations */
            --md-elevation-1: 0px 1px 3px 1px rgba(0, 0, 0, 0.15), 0px 1px 2px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-2: 0px 2px 6px 2px rgba(0, 0, 0, 0.15), 0px 1px 2px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-3: 0px 4px 8px 3px rgba(0, 0, 0, 0.15), 0px 1px 3px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-4: 0px 6px 10px 4px rgba(0, 0, 0, 0.15), 0px 2px 3px 0px rgba(0, 0, 0, 0.30);
            --md-elevation-5: 0px 8px 12px 6px rgba(0, 0, 0, 0.15), 0px 4px 4px 0px rgba(0, 0, 0, 0.30);
            
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
            font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            color: var(--on-surface);
            line-height: 1.6;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Header - Simplified */
        header.admin-header {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 64px;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-primary-dark));
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            padding: 0 var(--spacing-2);
            z-index: 100;
        }
        
        header .brand {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: #ffffff;
        }
        
        header .hamburger {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #ffffff;
            cursor: pointer;
            padding: var(--spacing-1);
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        header .hamburger:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        
        header .profile {
            display: flex;
            align-items: center;
            gap: var(--spacing-1);
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
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
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: var(--spacing-2) 0;
            position: fixed;
            left: 0;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            box-shadow: 1px 0 3px rgba(0, 0, 0, 0.05);
        }
        
        nav.sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        nav.sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--brand-primary) 0%, var(--brand-accent) 100%);
            box-shadow: inset 0 0 6px rgba(255, 107, 53, 0.3);
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
            transition: all 0.2s ease;
        }
        
        .sidebar a:hover {
            background: #f1f5f9;
            color: var(--brand-primary);
            border-left-color: var(--brand-primary);
        }
        
        .sidebar a.active {
            background: #fff5f0;
            color: var(--brand-primary);
            border-left-color: var(--brand-primary);
            font-weight: 600;
        }
        
        /* Content Area - Spacious */
        main.content {
            margin-left: 280px;
            padding: var(--spacing-4);
            min-height: calc(100vh - 64px);
            background: #f8fafc;
        }
        
        /* KodPwomo Welcome Card */
        .welcome {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-5);
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
            background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
        }
        
        .welcome h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.3;
            color: #1a1a2e;
            margin-bottom: var(--spacing-2);
        }
        
        .welcome .subtitle-badge {
            display: inline-block;
            background: #fff5f0;
            color: var(--brand-primary);
            padding: 0.35rem 0.85rem;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: var(--spacing-2);
            border: 1px solid #ffd9cc;
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
            background: #f8fafc;
            border-radius: 12px;
            border-left: 3px solid var(--brand-primary);
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
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-primary-dark));
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.15);
            border: none;
        }
        
        .quick-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
        }
        
        /* Typography - Cleaner */
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
        }
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
