<?php
// dashboard.php - KodPwomo User Dashboard (Vanilla PHP/HTML/CSS/JS, no external deps except Google Fonts)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>KodPwomo - Dashboard Utilisateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/notifications-system.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <style>
        :root{
            --white:#ffffff;
            --bg:#f9fafb;
            --text:#01295b;;
            --muted:#6b7280;
            --green:#10b981;
            --green-dark:#059669;
            --indigo:#6366f1;
            --shadow-sm:0 2px 8px rgba(0,0,0,0.06);
            --shadow-md:0 4px 16px rgba(0,0,0,0.06);
            --shadow-lg:0 8px 32px rgba(0,0,0,0.10);
            --shadow-green:0 4px 12px rgba(16,185,129,0.30);
            --radius-sm:12px;
            --radius-md:16px;
            --radius-lg:20px;
            --h-header:70px;
            --sidebar-w:260px;
            --hover-bg:#f0fdf4;
            --duration:0.3s;
            --ease:ease;
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
            color:var(--text);
            background:var(--bg);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }
        a{color:inherit;text-decoration:none}
        button{font-family:inherit}
        img{display:block;max-width:100%}
        /* Header */
        header.app-header{
            position:fixed; top:0; left:0; right:0; height:var(--h-header);
            background:var(--white);
            box-shadow:var(--shadow-sm);
            z-index:1000;
            display:flex; align-items:center; justify-content:space-between;
            padding:0 16px;
        }
        .header-left{
            display:flex; align-items:center; gap:12px;
        }
        .logo{
            font-weight:700; letter-spacing:.2px;
            background:linear-gradient(135deg,var(--green),var(--green-dark));
            -webkit-background-clip:text; background-clip:text;
            color:transparent;
            font-size:20px;
        }
        .logo img{
            width:27%; height:auto; border-radius:8px; object-fit:cover;
        }
        @media (max-width:600px){
            .logo img{width:45%;}
        }
        @media (max-width:350px){
            .logo img{width:60%;}
        }
        .header-center{
            display:flex; align-items:center; justify-content:center; flex:1;
        }
        .burger{
            display:flex; flex-direction:column; gap:5px; width:36px; height:32px;
            align-items:center; justify-content:center; cursor:pointer;
            transition:transform var(--duration) var(--ease);
        }
        .burger span{
            display:block; width:22px; height:2px; background:var(--text);
            border-radius:2px; transition:transform var(--duration) var(--ease),opacity var(--duration) var(--ease);
        }
        .burger.active{transform:rotate(180deg)}
        .burger.active span:nth-child(1){transform:translateY(7px) rotate(45deg)}
        .burger.active span:nth-child(2){opacity:0}
        .burger.active span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}
        @media(min-width:600px){
            .header-center .burger{display:none}
        }
        .header-right{
            display:flex; align-items:center; gap:12px;
        }
        .user-menu{
            position:relative; display:flex; align-items:center; gap:10px; cursor:pointer;
            padding:6px 10px; border-radius:999px;
            transition:background var(--duration) var(--ease), box-shadow var(--duration) var(--ease);
        }
        .user-menu:hover{background:#f3f4f6; box-shadow:var(--shadow-sm)}
        .avatar{
            width:34px; height:34px; border-radius:50%;
            background:linear-gradient(135deg,#34d399,#06b6d4);
            box-shadow:var(--shadow-sm);
            flex:0 0 auto;
        }
        .user-name{font-size:14px; color:var(--text); font-weight:500}
        .user-dropdown{
            position:absolute; top:calc(100% + 8px); right:0; min-width:200px;
            background:var(--white); border-radius:12px; box-shadow:var(--shadow-lg);
            padding:8px; display:none; z-index:1200;
        }
        .user-dropdown.open{display:block}
        .user-dropdown a{
            display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; color:var(--text); font-size:14px;
            transition:background var(--duration) var(--ease), box-shadow var(--duration) var(--ease);
        }
        .user-dropdown a:hover{background:var(--hover-bg); box-shadow:var(--shadow-sm)}
        /* Layout */
        .app-body{display:block}
        aside.sidebar{
            position:fixed; top:var(--h-header); left:0;
            width:var(--sidebar-w); height:calc(100vh - var(--h-header));
            background:var(--white);
            box-shadow:2px 0 12px rgba(0,0,0,0.04);
            overflow-y:auto; z-index:999;
            transform:translateX(-100%); transition:transform var(--duration) var(--ease);
        }
        aside.sidebar.open{transform:translateX(0)}
        @media(min-width:600px){
            aside.sidebar{transform:none}
        }
        .sidebar .nav{
            display:flex; flex-direction:column; gap:8px; padding:16px;
        }
        .nav-link{
            display:flex; align-items:center; gap:12px; padding:16px 24px; border-radius:12px; color: #01295b; font-weight:700; font-size:14px;
            transition:background var(--duration) var(--ease), box-shadow var(--duration) var(--ease), transform var(--duration) var(--ease), color var(--duration) var(--ease);
            will-change:transform;
        }
        .nav-link a{
            color: #01295b;
        }
        .nav-link:hover{background:var(--hover-bg); box-shadow:0 2px 8px rgba(16,185,129,0.1)}
        .nav-link.active{
            background:linear-gradient(135deg,var(--green),var(--green-dark));
            color:#fff;
            box-shadow:0 4px 12px rgba(16,185,129,0.3);
        }
        
        h2, h3{
            color:#01295b;
        }

        .nav-link svg{width:20px; height:20px; flex:0 0 20px}
        /* Overlay (mobile sidebar) */
        .overlay{
            position:fixed; inset:0; background:rgba(0,0,0,0.5);
            z-index:998; opacity:0; pointer-events:none; transition:opacity var(--duration) var(--ease);
        }
        .overlay.show{opacity:1; pointer-events:auto}
        /* Content */
        main.content{
            margin-top:var(--h-header);
            padding:16px;
            min-height:calc(100vh - var(--h-header));
            background:var(--bg);
        }
        @media(min-width:600px){
            main.content{margin-left:var(--sidebar-w); width:calc(100% - var(--sidebar-w)); padding:32px}
        }
        section[data-section]{display:none}
        section[data-section].active{display:block}
        /* Cards + grids */
        .grid-stats{
            display:grid; grid-template-columns:1fr; gap:16px;
        }
        @media(min-width:600px){ .grid-stats{grid-template-columns:repeat(2,1fr)} }
        @media(min-width:1024px){ .grid-stats{grid-template-columns:repeat(4,1fr)} }
        .card{
            background:var(--white); border-radius:16px; box-shadow:var(--shadow-md);
            padding:24px; transition:transform var(--duration) var(--ease), box-shadow var(--duration) var(--ease);
            will-change:transform;
        }
        .card:hover{transform:translateY(-4px); box-shadow:var(--shadow-lg)}
        .card-title{font-size:18px; font-weight:600; margin:0 0 6px}
        .card-sub{font-size:14px; color:var(--muted); margin:0}
        .stat-value{font-size:28px; font-weight:700; margin-top:8px}
        .stat-icon{
            width:42px; height:42px; border-radius:12px; display:grid; place-items:center; margin-bottom:12px;
        }
        .stat-icon.green{background:linear-gradient(135deg,#d1fae5,#a7f3d0)}
        .stat-icon.indigo{background:linear-gradient(135deg,#e0e7ff,#c7d2fe)}
        .stat-icon.orange{background:linear-gradient(135deg,#ffedd5,#fed7aa)}
        .stat-icon.blue{background:linear-gradient(135deg,#dbeafe,#bfdbfe)}
        /* Orders */
        .grid-orders{
            display:grid; grid-template-columns:1fr; gap:16px;
        }
            /* Sidebar nav redesign */
            .nav{display:flex; flex-direction:column; padding:8px}
            .nav-link{display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; color:var(--text); text-decoration:none}
            .nav-link svg{width:18px; height:18px}
            .nav-link:hover{background:#f3f4f6}
            .nav-link.active{background: #fea500; color:#01295b; box-shadow:inset 0 0 0 2px #fed7aa}
            .nav-link.active svg{stroke:#f59e0b}
        @media(min-width:600px){ .grid-orders{grid-template-columns:repeat(2,1fr)} }
        @media(min-width:1024px){ .grid-orders{grid-template-columns:repeat(3,1fr)} }
        .order-card{position:relative; padding-top:8px}
        .order-card::before{content:''; position:absolute; top:0; left:0; right:0; height:4px; border-radius:16px 16px 0 0; background: white;}
        .order-card .order-header{
            display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:6px; gap:12px;
        }
        .order-card .order-header strong{font-size:14px; font-weight:700; color:var(--text)}
        /* First section divider (header + date) */
        .order-card .order-date{font-size:12px; color:var(--muted); margin:0 0 8px; padding-bottom:8px; border-bottom:1px solid #e5e7eb}
        /* Second section divider (info) */
        .order-info{display:grid; grid-template-columns:auto 1fr; gap:6px 16px; padding:10px 0; border-bottom:1px solid #e5e7eb}
        .order-info .label{color:var(--muted); font-size:12px; white-space:nowrap}
        .order-info .value{font-weight:600; font-size:13px; text-align:right}
        .order-price{font-size:18px; font-weight:700; color:var(--green); margin:10px 0 12px}
        .badge{
            font-size:10px; padding:5px 10px; border-radius:6px; font-weight:700; text-transform:uppercase; letter-spacing:0.3px;
        }
        .badge.attente{background:#fef9c3; color:#a16207}
        .badge.en-route{background:#dbeafe; color:#1e40af}
        .badge.livree{background:#d1fae5; color:#047857}
        .badge.annulee{background:#fee2e2; color:#b91c1c}
        .order-footer{display:flex; gap:10px; flex-wrap:wrap}
        .thumb{
            width:44px; height:44px; border-radius:10px; background:linear-gradient(135deg,#e5e7eb,#d1d5db);
            box-shadow:var(--shadow-sm);
        }
        .order-footer{
            display:flex; align-items:center; justify-content:space-between; gap:12px
        }
        .btn{
            appearance:none; border:0; cursor:pointer; border-radius:8px; padding:10px 16px; font-weight:600; font-size:13px;
            transition:transform var(--duration) var(--ease), box-shadow var(--duration) var(--ease), background var(--duration) var(--ease), opacity var(--duration) var(--ease);
            display:inline-flex; align-items:center; justify-content:center; gap:6px;
        }
        .btn:active{transform:translateY(1px)}
        .btn-primary{
            background:#f59e0b; color:#fff; box-shadow:0 2px 8px rgba(245,158,11,0.3);
        }
        .btn-primary:hover{box-shadow:0 4px 16px rgba(245,158,11,0.4)}
        .btn-outline{
            background:#fff; box-shadow:var(--shadow-sm); color:var(--text); border:1px solid #e5e7eb;
        }
        .btn-danger{background:#fff; color:#374151; border:1px solid #d1d5db; box-shadow:var(--shadow-sm)}
        .btn-danger:hover{background:#f9fafb; box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        /* Profile */
        .grid-2{
            display:grid; grid-template-columns:1fr; gap:16px;
        }
        @media(min-width:600px){ .grid-2{grid-template-columns:repeat(2,1fr)} }
        .form-row{display:grid; grid-template-columns:1fr; gap:12px; margin-bottom:12px}
        @media(min-width:600px){ .form-row{grid-template-columns:1fr 1fr} }
        label{font-size:13px; color:var(--muted); margin-bottom:6px; display:block}
        .input, .textarea, .select{
            width:100%; padding:12px 14px; border-radius:12px; border:1px solid #e5e7eb; background:#fff; color:var(--text); font-size:16px;
            box-shadow:var(--shadow-sm); outline:none; transition:box-shadow var(--duration) var(--ease), border-color var(--duration) var(--ease), background var(--duration) var(--ease);
        }
        .input:focus, .textarea:focus, .select:focus{
            border-color:var(--green); box-shadow:0 0 0 4px rgba(16,185,129,0.15);
        }
        .textarea{min-height:120px; resize:vertical}
        /* Reviews */
        .reviews{display:flex; flex-direction:column; gap:12px}
        .review-card{display:flex; gap:12px; align-items:flex-start}
        .review-thumb{width:60px; height:60px; border-radius:12px; background:linear-gradient(135deg,#fde68a,#fca5a5); box-shadow:var(--shadow-sm); flex:0 0 auto}
        .stars{display:flex; gap:2px; color:#f59e0b}
        .review-title{margin:0 0 6px; font-size:16px; font-weight:600}
        .review-text{margin:0; color:var(--muted); font-size:14px}
        /* Modal */
        .modal-overlay{
            position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:2000; display:none; align-items:center; justify-content:center; padding:16px;
            opacity:0; transition:opacity var(--duration) var(--ease);
        }
        .modal-overlay.open{display:flex; opacity:1}
        .modal{
            background:var(--white); border-radius:16px; box-shadow:var(--shadow-lg); width:100%; max-width:720px; padding:16px;
            max-height:85vh; display:flex; flex-direction:column;
        }
        .modal-header{display:flex; align-items:center; justify-content:space-between; margin-bottom:10px}
        .modal-title{font-size:16px; font-weight:700; margin:0}
        .modal-content{color:var(--text); font-size:13px; overflow-y:auto; flex:1 1 auto; min-height:0; padding-right:6px}
        .modal-actions{display:flex; justify-content:flex-end; gap:10px; margin-top:12px}
        .close-x{width:34px; height:34px; border-radius:10px; display:grid; place-items:center; cursor:pointer; background:#f3f4f6; transition:background var(--duration) var(--ease)}
        .close-x:hover{background:#e5e7eb}
        /* Helpers */
        .section-title{font-size:22px; font-weight:700; margin:8px 0 16px}
        .muted{color:var(--muted)}
        /* Stepper for code modal */
        .stepper{display:flex; align-items:start; gap:0; margin-bottom:18px}
        .stepper-step{display:flex; flex-direction:column; align-items:center; gap:6px; flex:1}
        .stepper-step .dot{width:12px; height:12px; border-radius:50%; background:#e5e7eb; transition:background 0.3s ease}
        .stepper-step .dot.active{background:var(--green)}
        .stepper-step .label{font-size:11px; color:var(--muted); font-weight:600; text-align:center}
        .stepper-step .label.active{color:var(--green)}
        .stepper-line{flex:1; height:3px; background:#e5e7eb; margin:0 -8px; align-self:start; margin-top:6px}
        .stepper-line.active{background:var(--green)}
        /* Reduced motion */
        @media (prefers-reduced-motion:reduce){
            *{transition:none !important; animation:none !important}
        }
    </style>
</head>
<body>
    <header class="app-header" role="banner">
        <div class="header-left">
            <div class="logo" aria-label="KodPwomo"><img src="image/logo/logo1.1.jpg" alt=""></div>
        </div>
        <div class="header-center">
            <div class="burger" id="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="sidebar" role="button" tabindex="0">
                <span></span><span></span><span></span>
            </div>
        </div>
    </header>

    <div class="app-body">
        <aside class="sidebar" id="sidebar" aria-label="Menu latéral">
            <div class="sidebar-header" style="padding:12px 16px; border-bottom:1px solid #e5e7eb">
                <div class="logo" aria-label="KodPwomo" style="font-weight:800; font-size:16px">KodPwomo</div>
                <div class="user-mini" style="display:flex; align-items:center; gap:8px; margin-top:8px">
                    <div class="avatar" aria-hidden="true"></div>
                    <div style="display:flex; flex-direction:column">
                        <strong id="userNameDisplay" style="font-size:13px; color:#111827">Jean Dupont</strong>
                        
                    </div>
                </div>
            </div>
            <nav class="nav" id="nav">
                <a href="#" class="nav-link active" data-target="home">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Accueil (Statistiques)
                </a>
                <a href="#" class="nav-link" data-target="orders">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 7h18M3 12h18M3 17h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Mes Commandes
                </a>
                <a href="#" class="nav-link" data-target="profile">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-5 0-8 3-8 6v1h16v-1c0-3-3-6-8-6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Mon Profil
                </a>
                <a href="#" class="nav-link" data-target="reviews">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Avis & Notes
                </a>
                <a href="#" class="nav-link" data-target="support">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M18 10V7a6 6 0 1 0-12 0v3m-2 0h16v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Support
                </a>
                <a href="notifications.php" class="nav-link" data-target="notifications">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3c-3.314 0-6 2.686-6 6v3.382l-1.447 2.894A1 1 0 0 0 5.447 17h13.106a1 1 0 0 0 .894-1.447L18 12.382V9c0-3.314-2.686-6-6-6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Notifications
                </a>
                <a href="#" class="nav-link" data-target="logout">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 4h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Déconnexion
                </a>
                <hr style="margin:12px 0; border:none; border-top:1px solid #e5e7eb">
                <a href="index.php" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Accueil
                </a>
                <a href="blog.php" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 8h16M4 13h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Blog
                </a>
                <a href="boutique.php" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 2L6.46 9H2l5.91 4.29L7.46 21 12 17.29 16.54 21l-1.45-7.71L21 9h-4.46L9 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Boutique
                </a>
            </nav>
        </aside>
        <div class="overlay" id="overlay" aria-hidden="true"></div>

        <main class="content" id="content" role="main">
            <!-- Section: Accueil -->
            <section data-section="home" class="active" aria-labelledby="title-home">
                <h2 class="section-title" id="title-home">Accueil - Mes Statistiques</h2>
                <div class="grid-stats"></div>
            </section>

            <!-- Section: Commandes -->
            <section data-section="orders" aria-labelledby="title-orders">
                <h2 class="section-title" id="title-orders">🛍️ Mes Commandes</h2>
                <div class="grid-orders" id="ordersGrid"></div>
            </section>

            <!-- Section: Profil -->
            <section data-section="profile" aria-labelledby="title-profile">
                <h2 class="section-title" id="title-profile">Mon Profil</h2>
                <div class="grid-2">
                    <div class="card">
                        <h3 class="card-title">Informations personnelles</h3>
                        <form id="profileForm">
                            <div class="form-row">
                                <div>
                                    <label for="firstName">Prénom</label>
                                    <input id="firstName" class="input" type="text" placeholder="Votre prénom" />
                                </div>
                                <div>
                                    <label for="lastName">Nom</label>
                                    <input id="lastName" class="input" type="text" placeholder="Votre nom complet" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div>
                                    <label for="phone">Téléphone</label>
                                    <input id="phone" class="input" type="tel" placeholder="+233 50 123 45 67" />
                                </div>
                                <div>
                                    <label for="university">Université</label>
                                    <select id="university" class="select">
                                        <option value="">Sélectionnez votre université</option>
                                        <option>Université de Ghana</option>
                                        <option>KNUST</option>
                                        <option>Université d'Accra</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="saveProfileBtn">Enregistrer</button>
                        </form>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Sécurité</h3>
                        <form id="securityForm">
                            <div>
                                <label for="currentPass">Mot de passe actuel</label>
                                <input id="currentPass" class="input" type="password" placeholder="••••••••" />
                            </div>
                            <div class="form-row" style="margin-top:12px">
                                <div>
                                    <label for="newPass">Nouveau mot de passe</label>
                                    <input id="newPass" class="input" type="password" placeholder="••••••••" />
                                </div>
                                <div>
                                    <label for="confirmPass">Confirmer</label>
                                    <input id="confirmPass" class="input" type="password" placeholder="••••••••" />
                                </div>
                            </div>
                            <div style="margin-top:12px; display:flex; gap:10px">
                                <button type="button" class="btn btn-primary" id="updateSecurityBtn">Mettre à jour</button>
                                <button type="button" class="btn btn-outline" id="logoutBtn">Se déconnecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Section: Avis & Notes -->
            <section data-section="reviews" aria-labelledby="title-reviews">
                <h2 class="section-title" id="title-reviews">Avis & Notes</h2>
                <div class="reviews">
                    <div class="card review-card">
                        <div class="review-thumb" aria-hidden="true"></div>
                        <div>
                            <h4 class="review-title">Produit Alpha</h4>
                            <div class="stars" aria-label="4 étoiles">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="#d1d5db"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                            </div>
                            <p class="review-text">Très bon produit, livraison rapide et service client réactif.</p>
                        </div>
                    </div>
                    <div class="card review-card">
                        <div class="review-thumb" aria-hidden="true"></div>
                        <div>
                            <h4 class="review-title">Produit Beta</h4>
                            <div class="stars" aria-label="5 étoiles">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                            </div>
                            <p class="review-text">Qualité exceptionnelle, je recommande.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: Support -->
            <section data-section="support" aria-labelledby="title-support">
                <h2 class="section-title" id="title-support">Support</h2>
                <div class="card">
                    <form id="supportForm">
                        <div class="form-row">
                            <div>
                                <label for="subject">Sujet</label>
                                <input id="subject" class="input" type="text" placeholder="Décrivez brièvement votre problème" />
                            </div>
                            <div>
                                <label for="category">Catégorie</label>
                                <select id="category" class="select">
                                    <option>Commande</option>
                                    <option>Paiement</option>
                                    <option>Compte</option>
                                    <option>Autre</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="message">Message</label>
                            <textarea id="message" class="textarea" placeholder="Expliquez votre demande..."></textarea>
                        </div>
                        <div>
                            <label for="supportUniversity">Université concernée</label>
                            <select id="supportUniversity" class="select">
                                <option value="">Sélectionnez une université</option>
                            </select>
                        </div>
                        <div style="margin-top:12px; display:flex; gap:10px">
                            <button type="button" id="supportSendBtn" class="btn btn-primary">Envoyer</button>
                            <button type="reset" class="btn btn-outline">Réinitialiser</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Détails Commande -->
    <div class="modal-overlay" id="modalOverlay" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal" role="document">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Détails commande</h3>
                <div class="close-x" id="modalClose" aria-label="Fermer">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M6 6l12 12M18 6 6 18" stroke="#111827" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
            </div>
            <div class="modal-content" id="modalContent">
                <!-- Rempli dynamiquement -->
            </div>
            <div class="modal-actions">
                <button class="btn btn-outline" id="modalCancel">Fermer</button>
                <button class="btn btn-primary" id="downloadInvoiceBtn">Télécharger la facture</button>
            </div>
        </div>
    </div>

    <!-- Modal Code Agent -->
    <div class="modal-overlay" id="codeModal" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal" role="document" style="max-width:480px">
            <div class="modal-header">
                <h3 class="modal-title">Validation de livraison</h3>
                <div class="close-x" id="codeModalClose" aria-label="Fermer">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M6 6l12 12M18 6 6 18" stroke="#111827" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
            </div>
            <div class="modal-content">
                <div class="stepper" id="deliveryStepper">
                    <div class="stepper-step" data-step="attente">
                        <div class="dot"></div>
                        <div class="label">Attente</div>
                    </div>
                    <div class="stepper-line"></div>
                    <div class="stepper-step" data-step="en-route">
                        <div class="dot"></div>
                        <div class="label">En route</div>
                    </div>
                    <div class="stepper-line"></div>
                    <div class="stepper-step" data-step="livree">
                        <div class="dot"></div>
                        <div class="label">Terminé</div>
                    </div>
                </div>
                <p class="muted" style="margin-bottom:12px">Entrez le code de l'agent pour confirmer la livraison.</p>
                <input id="agentCodeInput" class="input" placeholder="Code agent (ex: 6 chiffres)" />
            </div>
            <div class="modal-actions">
                <button class="btn btn-outline" id="codeModalCancel">Annuler</button>
                <button class="btn btn-primary" id="codeModalConfirm">Confirmer</button>
            </div>
        </div>
    </div>

    <!-- Modal Notification Personnalisée -->
    <div class="modal-overlay" id="notificationModal" aria-hidden="true" role="alert" aria-modal="true" style="justify-content:flex-end; align-items:flex-start; padding:20px">
        <div class="modal" role="document" style="max-width:400px; margin:20px; border-radius:12px; box-shadow:0 10px 40px rgba(0,0,0,0.2)">
            <div style="display:flex; align-items:flex-start; gap:12px; padding:20px">
                <div id="notificationIcon" style="font-size:28px; flex-shrink:0">ℹ️</div>
                <div style="flex:1">
                    <h4 id="notificationTitle" style="margin:0 0 8px 0; font-size:16px; font-weight:700; color:#1f2937">Notification</h4>
                    <p id="notificationMessage" style="margin:0; font-size:14px; color:#666; line-height:1.5">Message</p>
                </div>
                <button id="notificationClose" class="close-x" style="cursor:pointer; border:none; background:none; padding:0; flex-shrink:0">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M6 6l12 12M18 6 6 18" stroke="#111827" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const qs = (sel, ctx=document) => ctx.querySelector(sel);
            const qsa = (sel, ctx=document) => Array.from(ctx.querySelectorAll(sel));
            const sidebar = qs('#sidebar');
            const overlay = qs('#overlay');
            const burger = qs('#burger');
            const nav = qs('#nav');
            const sections = qsa('section[data-section]');
            const btnNotifications = qs('a.nav-link[data-target="notifications"]');
            const btnLogout = qs('a.nav-link[data-target="logout"]');
            const modalOverlay = qs('#modalOverlay');
            const modalContent = qs('#modalContent');
            const modalTitle = qs('#modalTitle');
            const modalClose = qs('#modalClose');
            const modalCancel = qs('#modalCancel');
            const codeModal = qs('#codeModal');
            const codeModalClose = qs('#codeModalClose');
            const codeModalCancel = qs('#codeModalCancel');
            const codeModalConfirm = qs('#codeModalConfirm');
            const deliveryStepper = qs('#deliveryStepper');
            const agentCodeInput = qs('#agentCodeInput');
            const notificationModal = qs('#notificationModal');
            const notificationIcon = qs('#notificationIcon');
            const notificationTitle = qs('#notificationTitle');
            const notificationMessage = qs('#notificationMessage');
            const notificationClose = qs('#notificationClose');
            const universitySelect = qs('#university');

            // ============ FONCTION DE NOTIFICATION PERSONNALISÉE ============
            function showNotification(message, type = 'info', title = 'Notification') {
                notificationTitle.textContent = title;
                notificationMessage.textContent = message;
                
                // Définir l'icône et la couleur selon le type
                let icon = 'ℹ️';
                let bgColor = '#e0f2fe';
                let borderColor = '#0ea5e9';
                let textColor = '#0369a1';
                
                if (type === 'success') {
                    icon = '✅';
                    bgColor = '#dcfce7';
                    borderColor = '#22c55e';
                    textColor = '#15803d';
                } else if (type === 'error' || type === 'warning') {
                    icon = '⚠️';
                    bgColor = '#fef2f2';
                    borderColor = '#ef4444';
                    textColor = '#991b1b';
                }
                
                notificationIcon.textContent = icon;
                notificationModal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                notificationModal.querySelector('.modal').style.borderLeft = `4px solid ${borderColor}`;
                notificationTitle.style.color = textColor;
                
                // Afficher la modale
                notificationModal.classList.add('open');
                notificationModal.removeAttribute('aria-hidden');
                
                // Fermer automatiquement après 4 secondes
                const timeout = setTimeout(() => {
                    closeNotification();
                }, 4000);
                
                // Permettre la fermeture manuelle
                notificationClose.onclick = closeNotification;
                notificationModal.addEventListener('click', (e) => {
                    if (e.target === notificationModal) closeNotification();
                }, { once: true });
                
                function closeNotification() {
                    clearTimeout(timeout);
                    notificationModal.classList.remove('open');
                    notificationModal.setAttribute('aria-hidden', 'true');
                }
            }

            // ============ API CONFIGURATION ============
            const API_BASE = `${window.location.origin}/kodPwomo/backend/deliveries/user`;
            const UNIVERSITIES_API = `${window.location.origin}/kodPwomo/backend/universities`;
            const USER_DATA_API = `${window.location.origin}/kodPwomo/backend/users/datas`;
            
            // ============ CHARGER LES DONNÉES UTILISATEUR ============
            async function loadUserData() {
                try {
                    console.log('👤 Chargement des données utilisateur depuis:', USER_DATA_API);
                    const accessToken = localStorage.getItem('access_token');
                    
                    if (!accessToken) {
                        console.error('❌ ERREUR: Pas de token trouvé');
                        return null;
                    }

                    const response = await fetch(USER_DATA_API, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + accessToken
                        }
                    });

                    if (!response.ok) {
                        console.error('❌ Erreur lors du chargement des données utilisateur:', response.status);
                        return null;
                    }

                    const apiResponse = await response.json();
                    console.log('✅ Réponse API brute:', apiResponse);
                    
                    // Gérer la structure de réponse du backend
                    if (apiResponse.status === 'success' && apiResponse.user) {
                        const user = apiResponse.user;
                        
                        // Transformer les données pour avoir une structure cohérente
                        // user.firstname = Prénom (ex: "Bill")
                        // user.name = Nom complet (ex: "Bill James-sky Voltaire")
                        // user.email = Email
                        // user.phone = Téléphone (peut être vide)
                        // user.university_name = Université (peut être vide)
                        
                        const userData = {
                            first_name: user.firstname || '',
                            last_name: user.name || '',
                            email: user.email || '',
                            phone: user.phone || '',
                            university_name: user.university_name || ''
                        };
                        
                        console.log('✅ Données utilisateur transformées:', userData);
                        return userData;
                    }
                    
                    return null;

                } catch (error) {
                    console.error('❌ Erreur lors du chargement des données utilisateur:', error);
                    return null;
                }
            }

            // ============ CHARGER LES UNIVERSITÉS ============
            async function loadUniversities() {
                try {
                    console.log('🎓 Chargement des universités depuis:', UNIVERSITIES_API);
                    const response = await fetch(UNIVERSITIES_API, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        console.error('❌ Erreur lors du chargement des universités:', response.status);
                        return;
                    }

                    const universities = await response.json();
                    console.log('✅ Universités reçues:', universities);

                    // Vérifier que c'est un tableau
                    if (!Array.isArray(universities) || universities.length === 0) {
                        console.warn('⚠️ Aucune université trouvée');
                        universitySelect.innerHTML = '<option value="">Aucune université disponible</option>';
                        const supportUniversitySelect = qs('#supportUniversity');
                        if (supportUniversitySelect) {
                            supportUniversitySelect.innerHTML = '<option value="">Aucune université disponible</option>';
                        }
                        return;
                    }

                    // Construire les options avec id et name
                    let options = '<option value="">Sélectionnez votre université</option>';
                    universities.forEach(uni => {
                        const { id, name } = uni;
                        
                        if (id && name) {
                            options += `<option value="${id}" data-id="${id}">${name}</option>`;
                            console.log(`  ✓ ${name} (ID: ${id})`);
                        }
                    });

                    universitySelect.innerHTML = options;
                    console.log('✅ Universités chargées dans le select profil');

                    // Charger aussi le select de support
                    const supportUniversitySelect = qs('#supportUniversity');
                    if (supportUniversitySelect) {
                        let supportOptions = '<option value="">Sélectionnez une université</option>';
                        universities.forEach(uni => {
                            const { id, name } = uni;
                            if (id && name) {
                                supportOptions += `<option value="${id}" data-id="${id}">${name}</option>`;
                            }
                        });
                        supportUniversitySelect.innerHTML = supportOptions;
                        console.log('✅ Universités chargées dans le select support');
                    }

                    // Ajouter un event listener pour capturer l'ID sélectionné
                    universitySelect.addEventListener('change', (e) => {
                        const selectedId = e.target.value;
                        const selectedOption = e.target.options[e.target.selectedIndex];
                        const selectedName = selectedOption.text;
                        
                        console.log('🎓 Université sélectionnée:', {
                            id: selectedId,
                            name: selectedName
                        });
                        
                        // Stocker dans une variable globale pour l'utiliser lors de l'enregistrement
                        window.selectedUniversityId = selectedId;
                        window.selectedUniversityName = selectedName;
                    });

                } catch (error) {
                    console.error('❌ Erreur lors du chargement des universités:', error);
                    universitySelect.innerHTML = '<option value="">Erreur lors du chargement</option>';
                    const supportUniversitySelect = qs('#supportUniversity');
                    if (supportUniversitySelect) {
                        supportUniversitySelect.innerHTML = '<option value="">Erreur lors du chargement</option>';
                    }
                }
            }

            // Charger les universités et les données utilisateur au démarrage
            async function initializeProfileData() {
                // Charger les universités
                await loadUniversities();
                
                // Charger les données utilisateur
                const userData = await loadUserData();
                if (userData) {
                    // Pré-remplir le formulaire avec les données réelles
                    const firstNameInput = qs('#firstName');
                    const lastNameInput = qs('#lastName');
                    const phoneInput = qs('#phone');
                    const universitySelect = qs('#university');
                    
                    // Pré-remplir Prénom
                    if (firstNameInput && userData.first_name) {
                        firstNameInput.value = userData.first_name;
                        console.log('✅ Prénom chargé:', userData.first_name);
                    }
                    
                    // Pré-remplir Nom (depuis user.name du backend)
                    if (lastNameInput && userData.last_name) {
                        lastNameInput.value = userData.last_name;
                        console.log('✅ Nom chargé:', userData.last_name);
                    }
                    
                    // Pré-remplir Téléphone
                    if (phoneInput && userData.phone) {
                        phoneInput.value = userData.phone;
                        console.log('✅ Téléphone chargé:', userData.phone);
                    }
                    
                    // Sélectionner l'université si elle existe
                    if (universitySelect && userData.university_name) {
                        // Attendre un peu que les universités soient chargées
                        setTimeout(() => {
                            // Chercher l'université par son nom
                            const options = Array.from(universitySelect.querySelectorAll('option'));
                            const matchingOption = options.find(opt => opt.textContent.trim() === userData.university_name.trim());
                            
                            if (matchingOption) {
                                universitySelect.value = matchingOption.value;
                                window.selectedUniversityId = matchingOption.value;
                                window.selectedUniversityName = userData.university_name;
                                console.log('✅ Université sélectionnée:', userData.university_name);
                            } else {
                                console.warn('⚠️ Université non trouvée dans la liste:', userData.university_name);
                            }
                        }, 500);
                    }
                    
                    console.log('✅ Formulaire de profil pré-rempli avec les données réelles');
                    
                    // Mettre à jour le nom dans la barre latérale
                    const userNameDisplay = qs('#userNameDisplay');
                    if (userNameDisplay && userData.first_name) {
                        userNameDisplay.textContent = userData.first_name;
                        console.log('✅ Nom mis à jour dans le menu:', userData.first_name);
                    }
                } else {
                    console.warn('⚠️ Aucune donnée utilisateur reçue');
                }
            }
            
            // Initialiser les données de profil
            initializeProfileData();
            
            // Traduction des statuts
            const statusTranslations = {
                'processing': 'En préparation',
                'in-route': 'En route',
                'completed': 'Livrée',
                'canceled': 'Annulée'
            };

            // ============ SESSION MANAGEMENT ============
            function handleSessionExpired() {
                const msgDiv = document.createElement('div');
                msgDiv.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#fee2e2;border:2px solid #fca5a5;padding:24px;border-radius:12px;text-align:center;z-index:9999;max-width:400px;box-shadow:0 10px 40px rgba(0,0,0,0.3)';
                msgDiv.innerHTML = `
                    <h2 style="color:#b91c1c;margin:0 0 12px;font-size:20px">Session expirée</h2>
                    <p style="color:#7f1d1d;margin:0 0 16px;font-size:14px">Votre session a expiré. Vous allez être redirigé vers la page de connexion.</p>
                    <p style="color:#7f1d1d;margin:0;font-size:12px">Redirection dans 5 secondes...</p>
                `;
                document.body.appendChild(msgDiv);
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 5000);
            }

            // ============ API HELPER ============
            async function fetchAPI() {
                try {
                    const accessToken = localStorage.getItem('access_token');
                    if (!accessToken) {
                        console.error('❌ ERREUR: Pas de token trouvé');
                        handleSessionExpired();
                        return null;
                    }

                    console.log('📡 Appel API:', API_BASE);
                    const response = await fetch(API_BASE, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + accessToken
                        }
                    });

                    if (!response.ok) {
                        if (response.status === 401 || response.status === 403) {
                            console.error('❌ Session expirée (401/403)');
                            handleSessionExpired();
                            return null;
                        }
                        console.error(`❌ HTTP Error: ${response.status}`);
                        return null;
                    }

                    const data = await response.json();
                    console.log('✅ Données reçues:', data);
                    
                    // Vérifier les messages d'erreur du backend
                    if (data.error && (data.error.includes('expired') || data.error.includes('out') || data.error.includes('Unauthorized'))) {
                        console.error('❌ Session expirée (message):', data.error);
                        handleSessionExpired();
                        return null;
                    }

                    return data;
                } catch (error) {
                    console.error('API Error:', error);
                    return null;
                }
            }

            // ============ DATA TRANSFORMATION ============
            function transformData(apiResponse) {
                console.log('🔄 Transformation des données:', apiResponse);
                
                // Gérer les réponses vides ou sans structure
                if (!apiResponse || !apiResponse.datas) {
                    console.warn('⚠️ Pas de datas reçues');
                    return {
                        commandes: [],
                        stats: {
                            nombreCommandes: 0,
                            totalGlobal: 0,
                            totalLivraisons: 0,
                            totalProduits: 0,
                            noteMoyenne: 0,
                            enRoute: 0,
                            livrees: 0
                        }
                    };
                }

                const datas = apiResponse.datas || [];
                
                if (datas.length === 0) {
                    console.warn('⚠️ Tableau datas vide');
                    return {
                        commandes: [],
                        stats: {
                            nombreCommandes: 0,
                            totalGlobal: apiResponse.totalAmounts?.total_order_amount || 0,
                            totalLivraisons: 0,
                            totalProduits: 0,
                            noteMoyenne: 0,
                            enRoute: 0,
                            livrees: 0
                        }
                    };
                }

                console.log('📦 Items reçus:', datas.length);
                console.log('🔍 Premier item:', datas[0]);

                // Grouper les items par id_commande
                const commandesMap = new Map();
                
                datas.forEach((item, idx) => {
                    console.log(`Item ${idx}:`, {
                        id_commande: item.id_commande,
                        product_name: item.product_name,
                        qnt: item.qnt,
                        prices: item.prices,
                        room_name: item.room_name,
                        university_name: item.university_name
                    });
                    
                    if (!commandesMap.has(item.id_commande)) {
                        commandesMap.set(item.id_commande, {
                            id_commande: item.id_commande,
                            note: item.note || 0,
                            status: item.status || 'pending',
                            feedback: item.feedback || '',
                            university_name: item.university_name || '',
                            room_name: item.room_name || '',
                            items: [],
                            totalCommande: 0
                        });
                    }
                    
                    // S'assurer que qnt et prices sont des nombres
                    const qnt = parseInt(item.qnt) || 1;
                    const price = parseFloat(item.prices) || 0;
                    const subtotal = qnt * price;
                    
                    console.log(`  ➜ Subtotal: ${qnt} × ${price} = ${subtotal}`);
                    
                    commandesMap.get(item.id_commande).items.push({
                        product_name: item.product_name || 'Produit inconnu',
                        qnt: qnt,
                        prices: price,
                        subtotal: subtotal
                    });
                    
                    commandesMap.get(item.id_commande).totalCommande += subtotal;
                });

                // Convertir en array et trier par le plus récent
                const commandes = Array.from(commandesMap.values()).reverse();

                // Calculer les stats
                const notesArray = commandes.filter(c => c.note && c.note > 0).map(c => c.note);
                const noteMoyenne = notesArray.length > 0 ? notesArray.reduce((a, b) => a + b, 0) / notesArray.length : 0;

                const stats = {
                    nombreCommandes: commandes.length,
                    totalGlobal: parseFloat(apiResponse.totalAmounts?.total_order_amount) || 0,
                    totalLivraisons: parseFloat(apiResponse.totalAmounts?.total_amount) || 0,
                    totalProduits: parseFloat(apiResponse.totalSpent) || 0,
                    noteMoyenne: noteMoyenne,
                    enRoute: commandes.filter(c => c.status === 'processing').length,
                    livrees: commandes.filter(c => c.status === 'completed').length
                };

                console.log('✅ Transformation complète:');
                console.log('  Commandes:', commandes.length);
                console.log('  Stats:', stats);
                commandes.forEach(cmd => {
                    console.log(`  - ${cmd.id_commande}: ${cmd.items.length} items, total: ${cmd.totalCommande}€`);
                });
                
                return { commandes, stats };
            }

            // ============ RENDER FUNCTIONS ============
            function renderStats(stats) {
                console.log('📊 Rendu des stats:', stats);
                const statsGrid = qs('.grid-stats');
                if (!statsGrid) {
                    console.error('❌ Élément .grid-stats non trouvé');
                    return;
                }

                statsGrid.innerHTML = `
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M4 7h16v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z" stroke="#10b981" stroke-width="2"/><path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke="#10b981" stroke-width="2"/></svg>
                        </div>
                        <div class="stat-value">${stats.nombreCommandes || 0}</div>
                        <p class="card-sub">COMMANDES TOTALES</p>
                    </div>
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M3 16h18l-2-7H6L3 16Z" stroke="#10b981" stroke-width="2" stroke-linecap="round"/><path d="M7 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" stroke="#10b981" stroke-width="2"/></svg>
                        </div>
                        <div class="stat-value">${stats.enRoute || 0}</div>
                        <p class="card-sub">EN ROUTE</p>
                    </div>
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M20 6 9 17l-5-5" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div class="stat-value">${stats.livrees || 0}</div>
                        <p class="card-sub">LIVRÉES</p>
                    </div>
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M12 3v18M4 7h12a4 4 0 1 1 0 8H4" stroke="#10b981" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <div class="stat-value">${(stats.totalGlobal || 0).toFixed(2)}€</div>
                        <p class="card-sub">TOTAL DÉPENSÉ</p>
                    </div>
                `;
            }

            function renderOrders(commandes) {
                console.log('🛒 Rendu des commandes:', commandes.length);
                const ordersGrid = qs('#ordersGrid');
                if (!ordersGrid) {
                    console.error('❌ Élément #ordersGrid non trouvé');
                    return;
                }

                if (commandes.length === 0) {
                    console.warn('⚠️ Aucune commande à afficher');
                    ordersGrid.innerHTML = '<p class="muted" style="text-align:center;padding:40px;grid-column:1/-1">Aucune commande disponible</p>';
                    return;
                }

                ordersGrid.innerHTML = commandes.map(cmd => {
                    const statusLabel = statusTranslations[cmd.status] || cmd.status;
                    let badgeClass = 'attente';
                    let badgeText = '⏳ En préparation';

                    if (cmd.status === 'completed') {
                        badgeClass = 'livree';
                        badgeText = '✓ Livrée';
                    } else if (cmd.status === 'processing') {
                        badgeClass = 'attente';
                        badgeText = '⏳ En préparation';
                    } else if (cmd.status === 'canceled') {
                        badgeClass = 'annulee';
                        badgeText = '✕ Annulée';
                    }

                    return `
                        <div class="card order-card" data-order-id="${cmd.id_commande}" data-status="${cmd.status}">
                            <div class="order-header">
                                <strong>Commande ${cmd.id_commande}</strong>
                                <span class="badge ${badgeClass}">${badgeText}</span>
                            </div>
                            <p class="order-date">${new Date().toLocaleDateString('fr-FR')}</p>
                            <div class="order-info">
                                <div class="label">Université:</div>
                                <div class="value">${cmd.university_name || '-'}</div>
                                <div class="label">Salle:</div>
                                <div class="value">${cmd.room_name || '-'}</div>
                            </div>
                            <div class="order-price">${(cmd.totalCommande || 0).toFixed(2)}€</div>
                            <div class="order-footer">
                                <button class="btn btn-primary" data-open-modal="order" data-order="${cmd.id_commande}">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                    DÉTAILS
                                </button>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            function renderReviews(commandes) {
                const reviewsSection = qs('section[data-section="reviews"]');
                if (!reviewsSection) return;

                const reviewsContainer = reviewsSection.querySelector('.reviews');
                if (!reviewsContainer) return;

                const completedOrders = commandes.filter(c => c.status === 'completed' && c.feedback);

                if (completedOrders.length === 0) {
                    reviewsContainer.innerHTML = '<p class="muted" style="text-align:center;padding:20px">Aucun avis disponible</p>';
                    return;
                }

                reviewsContainer.innerHTML = completedOrders.map(cmd => {
                    const stars = Array.from({length: 5}, (_, i) => 
                        `<svg viewBox="0 0 24 24" width="18" height="18" fill="${i < cmd.note ? 'currentColor' : '#d1d5db'}"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>`
                    ).join('');

                    return `
                        <div class="card review-card">
                            <div class="review-thumb" aria-hidden="true"></div>
                            <div>
                                <h4 class="review-title">Commande ${cmd.id_commande}</h4>
                                <div class="stars" aria-label="${cmd.note} étoiles">
                                    ${stars}
                                </div>
                                <p class="review-text">${cmd.feedback}</p>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // ============ GLOBAL STATE ============
            let dashboardState = {
                commandes: [],
                stats: {}
            };

            // ============ INITIALIZATION ============
            async function initDashboard() {
                console.log('🚀 Initialisation du dashboard...');
                
                // Charger les données via l'accessToken
                const apiData = await fetchAPI();
                console.log('📥 Données brutes de l\'API:', apiData);
                
                // Transformer les données (retourne toujours une structure valide)
                const transformed = transformData(apiData);
                console.log('✨ Données transformées:', transformed);
                
                // SAUVEGARDER LES DONNÉES GLOBALES (pour le modal)
                dashboardState.commandes = transformed.commandes;
                dashboardState.stats = transformed.stats;
                console.log('💾 State sauvegardé:', dashboardState);

                // Rendre les sections
                renderStats(transformed.stats);
                renderOrders(transformed.commandes);
                renderReviews(transformed.commandes);
                
                console.log('✅ Dashboard initialisé avec succès');
            }

            // Initialiser le dashboard au chargement
            initDashboard();

            const state = { current: 'home' };

            // ============ LOCALSTORAGE MANAGEMENT ============
            const STORAGE_KEY = 'kodPwomo_activeSection';

            // Récupérer la section sauvegardée dans localStorage
            function getActiveSection() {
                const saved = localStorage.getItem(STORAGE_KEY);
                return saved || 'home'; // Par défaut: 'home'
            }

            // Sauvegarder la section active dans localStorage
            function saveActiveSection(section) {
                localStorage.setItem(STORAGE_KEY, section);
                console.log('💾 Section sauvegardée dans localStorage:', section);
            }

            function isMobile(){ return window.innerWidth < 600; }

            function openSidebar(){
                sidebar.classList.add('open');
                overlay.classList.add('show');
                burger.classList.add('active');
                burger.setAttribute('aria-expanded','true');
            }
            function closeSidebar(){
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                burger.classList.remove('active');
                burger.setAttribute('aria-expanded','false');
            }
            function toggleSidebar(){ (sidebar.classList.contains('open') ? closeSidebar : openSidebar)(); }

            burger.addEventListener('click', toggleSidebar);
            burger.addEventListener('keydown', (e)=>{ if(e.key==='Enter' || e.key===' '){ e.preventDefault(); toggleSidebar(); }});
            overlay.addEventListener('click', closeSidebar);

            function setActiveSection(target){
                state.current = target;
                
                // Sauvegarder dans localStorage
                saveActiveSection(target);
                
                // links
                qsa('.nav-link').forEach(a=>{
                    const active = a.getAttribute('data-target')===target;
                    a.classList.toggle('active', active);
                });
                // sections
                sections.forEach(sec=>{ sec.classList.toggle('active', sec.getAttribute('data-section')===target); });
                if(isMobile()) closeSidebar();
                // scroll to top smoothly
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            nav.addEventListener('click', (e)=>{
                const link = e.target.closest('.nav-link');
                if(!link) return;
                const target = link.getAttribute('data-target');
                // Solo prevenir el comportamiento por défaut si c'est un lien interne (avec data-target)
                if(target) {
                    e.preventDefault();
                    setActiveSection(target);
                }
                // Sinon laisser le lien fonctionner normalement (pour Accueil, Blog, Boutique)
            });

            // Keyboard access
            document.addEventListener('keydown', (e)=>{
                if(e.key==='Escape'){
                    closeSidebar();
                    closeModal();
                }
            });

            // Notifications and Logout actions
            if(btnNotifications){
                btnNotifications.addEventListener('click', (e)=>{
                    e.preventDefault();
                    window.location.href = 'notifications.php';
                });
            }
            if(btnLogout){
                btnLogout.addEventListener('click', (e)=>{
                    e.preventDefault();
                    // Minimal logout handler placeholder
                    showNotification('Vous êtes en cours de déconnexion...', 'info', 'Déconnexion');
                    logout();
                });
            }

            // Fonction pour générer et télécharger la facture
            function generateAndDownloadInvoice(orderId) {
                console.log('📄 Génération de facture pour:', orderId);
                
                // Chercher la commande
                const commande = dashboardState.commandes.find(cmd => cmd.id_commande === orderId);
                if (!commande) {
                    showNotification('Impossible de charger les détails de cette commande.', 'error', 'Erreur');
                    return;
                }
                
                // Infos de l'entreprise
                const company = {
                    name: 'KodPwomo',
                    tagline: 'Service de Livraison Universitaire',
                    address: 'Accra, Ghana',
                    phone: '+233 500 XXXXX',
                    email: 'contact@kodpwomo.com',
                    website: 'www.kodpwomo.com'
                };
                
                // Créer un canvas pour la facture
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 900;
                canvas.height = 1300;
                
                // Couleurs
                const bgColor = '#ffffff';
                const primaryColor = '#1f2937';
                const accentColor = '#f59e0b';
                const lightGray = '#f9fafb';
                const borderColor = '#e5e7eb';
                
                // Fond blanc
                ctx.fillStyle = bgColor;
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                // En-tête avec fond coloré
                ctx.fillStyle = primaryColor;
                ctx.fillRect(0, 0, canvas.width, 150);
                
                // Logo/Nom de l'entreprise
                ctx.font = 'bold 48px Arial';
                ctx.fillStyle = accentColor;
                ctx.fillText(company.name, 50, 80);
                
                // Tagline
                ctx.font = '14px Arial';
                ctx.fillStyle = '#fff';
                ctx.fillText(company.tagline, 50, 105);
                
                // Infos entreprise à droite
                ctx.font = '12px Arial';
                ctx.fillStyle = '#ccc';
                const rightX = canvas.width - 250;
                ctx.fillText(company.address, rightX, 50);
                ctx.fillText(`Tél: ${company.phone}`, rightX, 70);
                ctx.fillText(`Email: ${company.email}`, rightX, 90);
                ctx.fillText(`Site: ${company.website}`, rightX, 110);
                
                // Ligne de séparation
                ctx.strokeStyle = accentColor;
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(50, 160);
                ctx.lineTo(canvas.width - 50, 160);
                ctx.stroke();
                
                // Titre de la facture
                ctx.font = 'bold 28px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText('FACTURE', 50, 210);
                
                // Numéro et date
                let y = 250;
                ctx.font = 'bold 13px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText('Détails de la facture:', 50, y);
                
                ctx.font = '13px Arial';
                ctx.fillStyle = '#666';
                y += 30;
                ctx.fillText(`N° Facture: ${orderId}`, 50, y);
                y += 25;
                ctx.fillText(`Date d'émission: ${new Date().toLocaleDateString('fr-FR')}`, 50, y);
                y += 25;
                ctx.fillText(`Date de livraison: ${new Date().toLocaleDateString('fr-FR')}`, 50, y);
                
                // Statut de la commande
                ctx.fillStyle = '#22c55e';
                ctx.fillText('✓ Livrée', 50, y + 40);
                
                // Informations client
                y = 250;
                ctx.font = 'bold 13px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText('Destinataire:', canvas.width / 2 + 50, y);
                
                ctx.font = '13px Arial';
                ctx.fillStyle = '#666';
                y += 30;
                ctx.fillText(`Université: ${commande.university_name || '-'}`, canvas.width / 2 + 50, y);
                y += 25;
                ctx.fillText(`Salle/Chambre: ${commande.room_name || '-'}`, canvas.width / 2 + 50, y);
                y += 25;
                ctx.fillText(`Statut: Livraison confirmée`, canvas.width / 2 + 50, y);
                
                // Tableau des articles
                y = 400;
                ctx.font = 'bold 14px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText('Articles commandés', 50, y);
                
                // En-têtes tableau
                y += 35;
                ctx.fillStyle = accentColor;
                ctx.fillRect(50, y - 20, canvas.width - 100, 35);
                
                ctx.font = 'bold 13px Arial';
                ctx.fillStyle = '#ffffff';
                ctx.fillText('Produit', 70, y + 5);
                ctx.fillText('Quantité', 500, y + 5);
                ctx.fillText('Prix unitaire', 650, y + 5);
                ctx.fillText('Sous-total', 800, y + 5);
                
                // Articles
                y += 50;
                ctx.fillStyle = '#333';
                ctx.font = '12px Arial';
                let totalHT = 0;
                
                commande.items.forEach((item, idx) => {
                    const subtotal = (item.qnt || 0) * (item.prices || 0);
                    totalHT += subtotal;
                    
                    // Fond gris alternant
                    if (idx % 2 === 0) {
                        ctx.fillStyle = lightGray;
                        ctx.fillRect(50, y - 18, canvas.width - 100, 30);
                    }
                    
                    ctx.fillStyle = '#333';
                    ctx.fillText(item.product_name || 'Produit', 70, y);
                    ctx.fillText((item.qnt || 0).toString(), 510, y);
                    ctx.fillText(`${(item.prices || 0).toFixed(2)} GHS`, 670, y);
                    ctx.fillText(`${subtotal.toFixed(2)} GHS`, 820, y);
                    y += 35;
                });
                
                // Ligne de séparation
                y += 10;
                ctx.strokeStyle = borderColor;
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(50, y);
                ctx.lineTo(canvas.width - 50, y);
                ctx.stroke();
                
                // Résumé des totaux
                y += 30;
                ctx.font = '13px Arial';
                ctx.fillStyle = '#666';
                ctx.textAlign = 'right';
                
                ctx.fillText(`Montant HT: ${totalHT.toFixed(2)} GHS`, canvas.width - 70, y);
                y += 30;
                
                // TVA (si applicable)
                const tva = totalHT * 0.15;
                ctx.fillText(`TVA (15%): ${tva.toFixed(2)} GHS`, canvas.width - 70, y);
                y += 30;
                
                // Total TTC
                const totalTTC = totalHT + tva;
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText(`MONTANT TOTAL TTC: ${totalTTC.toFixed(2)} GHS`, canvas.width - 70, y);
                
                // Mode de paiement
                y += 50;
                ctx.font = 'bold 12px Arial';
                ctx.fillStyle = primaryColor;
                ctx.textAlign = 'left';
                ctx.fillText('Conditions de paiement:', 50, y);
                
                ctx.font = '12px Arial';
                ctx.fillStyle = '#666';
                y += 25;
                ctx.fillText('Paiement à la livraison', 50, y);
                
                // Notes/Termes
                y += 50;
                ctx.font = 'bold 12px Arial';
                ctx.fillStyle = primaryColor;
                ctx.fillText('Merci pour votre confiance!', 50, y);
                
                ctx.font = '11px Arial';
                ctx.fillStyle = '#999';
                y += 25;
                ctx.fillText('Cette facture confirme votre commande livrée avec succès.', 50, y);
                y += 20;
                ctx.fillText('Pour toute question, contactez-nous à contact@kodpwomo.com', 50, y);
                
                // Pied de page
                y = canvas.height - 80;
                ctx.font = '11px Arial';
                ctx.fillStyle = '#999';
                ctx.textAlign = 'center';
                ctx.fillText('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━', canvas.width / 2, y);
                y += 25;
                ctx.fillText(`KodPwomo © ${new Date().getFullYear()} | Service de Livraison Universitaire`, canvas.width / 2, y);
                y += 20;
                ctx.fillText(`Facture générée le ${new Date().toLocaleString('fr-FR')}`, canvas.width / 2, y);
                
                // Télécharger le canvas en PNG
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = `FACTURE_${orderId}_${new Date().getTime()}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                console.log('✅ Facture générée et téléchargée');
                showNotification('Votre facture a été téléchargée avec succès.', 'success', 'Facture téléchargée');
            }

            // Modal (Orders)
            function openModal(orderId, detailsHtml){
                modalTitle.textContent = `Détails ${orderId || ''}`.trim();
                modalContent.innerHTML = detailsHtml || '<p class="muted">Chargement...</p>';
                modalOverlay.classList.add('open');
                modalOverlay.removeAttribute('aria-hidden');
            }
            function closeModal(){
                modalOverlay.classList.remove('open');
                modalOverlay.setAttribute('aria-hidden','true');
            }
            modalClose.addEventListener('click', closeModal);
            modalCancel.addEventListener('click', closeModal);
            modalOverlay.addEventListener('click', (e)=>{ if(e.target === modalOverlay) closeModal(); });

            // Gestion du bouton télécharger la facture
            const downloadInvoiceBtn = qs('#downloadInvoiceBtn');
            if (downloadInvoiceBtn) {
                downloadInvoiceBtn.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    console.log('📄 Tentative téléchargement facture - Status:', window.currentOrderStatus);
                    
                    if (window.currentOrderStatus !== 'completed') {
                        showNotification('Les factures ne sont disponibles que pour les commandes livrées. Veuillez attendre la confirmation de votre livraison.', 'warning', 'Commande en cours');
                        return;
                    }
                    
                    // Générer et télécharger la facture
                    generateAndDownloadInvoice(window.currentOrderId);
                });
            }

            // Event delegation for "Voir détails"
            qs('#content').addEventListener('click', (e)=>{
                const btn = e.target.closest('[data-open-modal="order"]');
                if(!btn) return;
                e.preventDefault();
                
                const card = btn.closest('.order-card');
                const orderId = card?.getAttribute('data-order-id');
                const status = card?.getAttribute('data-status');
                
                // Chercher la commande dans les données du state
                const commande = dashboardState.commandes.find(cmd => cmd.id_commande === orderId);
                if (!commande) {
                    openModal(orderId, '<p class="muted">Erreur: Commande non trouvée</p>');
                    return;
                }
                
                // Générer le HTML des articles
                const articleRows = commande.items.map(item => `
                    <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f3f4f6">
                        <div>
                            <div style="font-weight:600">${item.product_name}</div>
                            <div style="font-size:13px; color:var(--muted)">x${item.qnt}</div>
                        </div>
                        <div style="text-align:right">
                            <div style="font-weight:600">${item.prices.toFixed(2)}€</div>
                            <div style="font-size:12px; color:var(--muted)">Sous-total: ${item.subtotal.toFixed(2)}€</div>
                        </div>
                    </div>
                `).join('');
                
                // Déterminer le badge de statut
                let statusBadge = '';
                if(status === 'completed') statusBadge = '<span class="badge livree">✓ Livrée</span>';
                else if(status === 'processing') statusBadge = '<span class="badge attente">⏳ En préparation</span>';
                else if(status === 'canceled') statusBadge = '<span class="badge annulee">✕ Annulée</span>';
                
                let html = `
                    <div style="margin-bottom:16px">
                        <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:12px">
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Date:</div>
                                <div style="font-weight:600">${new Date().toLocaleDateString('fr-FR')}</div>
                            </div>
                            <div style="text-align:right">${statusBadge}</div>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:12px">
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Université:</div>
                                <div style="font-weight:600">${commande.university_name || '-'}</div>
                            </div>
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Salle:</div>
                                <div style="font-weight:600">${commande.room_name || '-'}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="border-top:2px solid #e5e7eb; padding-top:16px; margin-top:16px">
                        <h4 style="margin:0 0 12px; font-size:16px; font-weight:700">Produits (${commande.items.length})</h4>
                        ${articleRows}
                        <div style="margin-top:16px; padding-top:12px; border-top:2px solid #e5e7eb">
                            <div style="display:flex; justify-content:space-between; padding-top:12px; border-top:2px solid var(--green); font-size:18px">
                                <span style="font-weight:700">Total:</span>
                                <span style="font-weight:700; color:var(--green)">${commande.totalCommande.toFixed(2)}€</span>
                            </div>
                        </div>
                    </div>
                `;
                
                // Stocker le status et l'ID pour le bouton télécharger la facture
                window.currentOrderStatus = status;
                window.currentOrderId = orderId;
                
                // SI COMMANDE EN COURS: Ajouter le formulaire de note + feedback + code agent
                if (status === 'processing') {
                    html += `
                    <div style="margin-top:20px; padding-top:20px; border-top:2px solid #e5e7eb">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="#f59e0b"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                            <h4 style="margin:0; font-size:16px; font-weight:700">Confirmer la livraison</h4>
                        </div>
                        
                        <!-- Note (Étoiles) -->
                        <div style="margin-bottom:12px">
                            <label style="font-size:13px; color:var(--muted); display:block; margin-bottom:8px">Votre note:</label>
                            <div class="delivery-rating-stars" style="display:flex; gap:8px; font-size:28px; cursor:pointer">
                                <span data-rating="1" style="user-select:none">☆</span>
                                <span data-rating="2" style="user-select:none">☆</span>
                                <span data-rating="3" style="user-select:none">☆</span>
                                <span data-rating="4" style="user-select:none">☆</span>
                                <span data-rating="5" style="user-select:none">☆</span>
                            </div>
                            <p class="rating-hint" style="margin:8px 0 0; font-size:12px; color:var(--muted)">Aucune note sélectionnée</p>
                        </div>
                        
                        <!-- Feedback -->
                        <div style="margin-bottom:12px">
                            <label style="font-size:13px; color:var(--muted); display:block; margin-bottom:6px">Votre avis:</label>
                            <textarea class="delivery-feedback" placeholder="Partagez votre expérience avec la livraison..." style="width:100%; padding:10px; border-radius:8px; border:1px solid #e5e7eb; font-size:13px; min-height:80px; font-family:inherit"></textarea>
                        </div>
                        
                        <!-- Code Agent -->
                        <div style="margin-bottom:12px">
                            <label style="font-size:13px; color:var(--muted); display:block; margin-bottom:6px">Code agent:</label>
                            <input type="text" class="delivery-agent-code" placeholder="Entrez le code fourni par l'agent" style="width:100%; padding:10px; border-radius:8px; border:1px solid #e5e7eb; font-size:13px; font-family:monospace" />
                        </div>
                        
                        <!-- Bouton de confirmation -->
                        <button class="btn btn-primary deliver-confirm-btn" style="width:100%; margin-top:12px">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
                            CONFIRMER LA LIVRAISON
                        </button>
                    </div>
                    `;
                }
                
                openModal(orderId, html);
                
                // Si c'est une commande en cours, ajouter les event listeners
                if (status === 'processing') {
                    setTimeout(() => {
                        const starsContainer = qs('.delivery-rating-stars');
                        const feedbackInput = qs('.delivery-feedback');
                        const codeInput = qs('.delivery-agent-code');
                        const confirmBtn = qs('.deliver-confirm-btn');
                        let selectedRating = 0;
                        
                        // Gestion des étoiles
                        if (starsContainer) {
                            starsContainer.addEventListener('click', (ev) => {
                                const star = ev.target.closest('[data-rating]');
                                if (!star) return;
                                selectedRating = parseInt(star.getAttribute('data-rating')) || 0;
                                
                                // Mettre à jour l'affichage des étoiles
                                Array.from(starsContainer.querySelectorAll('[data-rating]')).forEach((s, idx) => {
                                    s.textContent = (idx < selectedRating) ? '★' : '☆';
                                });
                                
                                // Mettre à jour le hint
                                const hint = qs('.rating-hint');
                                if (hint) {
                                    hint.textContent = selectedRating ? `${selectedRating}/5` : 'Aucune note sélectionnée';
                                }
                            });
                        }
                        
                        // Gestion du bouton de confirmation
                        if (confirmBtn) {
                            confirmBtn.addEventListener('click', async () => {
                                const feedback = feedbackInput?.value.trim() || '';
                                const code = codeInput?.value.trim() || '';
                                
                                if (!selectedRating) {
                                    showNotification('Veuillez sélectionner une note de 1 à 5 étoiles.', 'warning', 'Champ obligatoire');
                                    return;
                                }
                                if (!feedback) {
                                    showNotification('Veuillez laisser un avis sur votre livraison.', 'warning', 'Champ obligatoire');
                                    return;
                                }
                                if (!code) {
                                    showNotification('Veuillez entrer le code agent fourni lors de la livraison.', 'warning', 'Champ obligatoire');
                                    return;
                                }
                                
                                // Préparer le payload
                                const payload = {
                                    order_id: orderId,
                                    agent_code: code,
                                    rating: selectedRating,
                                    feedback: feedback
                                };
                                
                                console.log('📡 Envoi de la notation à:', payload);
                                
                                try {
                                    const accessToken = localStorage.getItem('access_token');
                                    if (!accessToken) {
                                        showNotification('Erreur: Token d\'accès manquant', 'error', 'Erreur d\'authentification');
                                        return;
                                    }
                                    
                                    const response = await fetch(`${window.location.origin}/kodPwomo/backend/rate/agent`, {
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                            'Authorization': 'Bearer ' + accessToken
                                        },
                                        body: JSON.stringify(payload)
                                    });
                                    
                                    const result = await response.json();
                                    console.log('📥 Réponse du serveur:', result);
                                    
                                    if (!response.ok) {
                                        showNotification(result.error || 'Erreur serveur', 'error', 'Erreur');
                                        console.error('❌ Erreur HTTP:', response.status);
                                        return;
                                    }
                                    
                                    if (result.status === 'success') {
                                        showNotification('Votre livraison a été confirmée avec succès. Merci pour votre notation!', 'success', 'Livraison confirmée');
                                        console.log('✅ Notation envoyée');
                                        setTimeout(() => closeModal(), 1500);
                                    } else {
                                        showNotification(result.error || 'Erreur inconnue', 'error', 'Erreur');
                                    }
                                    
                                } catch (error) {
                                    console.error('❌ Erreur lors de l\'envoi de la notation:', error);
                                    showNotification('Erreur réseau: ' + error.message, 'error', 'Erreur');
                                }
                            });
                        }
                    }, 0);
                }
            });

            // Responsive adjustments
            function onResize(){
                if(!isMobile()){
                    overlay.classList.remove('show');
                    burger.classList.remove('active');
                    burger.setAttribute('aria-expanded','false');
                }
            }
            window.addEventListener('resize', onResize);

            // ============ FONCTION DE SAUVEGARDE (INFOS PERSONNELLES ET SÉCURITÉ) ============
            async function handleSaveData(type) {
                console.log('💾 Tentative de sauvegarde:', type);
                const accessToken = localStorage.getItem('access_token');
                
                if (!accessToken) {
                    showNotification('Erreur: Token d\'accès manquant', 'error', 'Erreur d\'authentification');
                    return;
                }

                let payload = {};
                let isValid = true;

                // ============ VALIDATION ET PRÉPARATION DES DONNÉES ============
                if (type === 'userDatas') {
                    // Récupérer les données du formulaire
                    const firstName = qs('#firstName').value.trim();
                    const lastName = qs('#lastName').value.trim();
                    const phone = qs('#phone').value.trim();
                    const university = window.selectedUniversityId || '';

                    // Validation
                    if (!firstName) {
                        showNotification('Veuillez entrer votre prénom', 'warning', 'Prénom requis');
                        isValid = false;
                    }
                    if (!lastName) {
                        showNotification('Veuillez entrer votre nom complet (ex: Bill James-sky Voltaire)', 'warning', 'Nom complet requis');
                        isValid = false;
                    }
                    if (!phone) {
                        showNotification('Veuillez entrer votre numéro de téléphone (ex: +233 50 123 45 67)', 'warning', 'Téléphone requis');
                        isValid = false;
                    }

                    if (isValid) {
                        payload = {
                            type: 'userDatas',
                            firstname: firstName,
                            name: lastName,
                            phone: phone,
                            university_id: university || null
                        };
                        console.log('✅ Données personnelles valides:', payload);
                    }

                } else if (type === 'security') {
                    // Récupérer les données du formulaire de sécurité
                    const currentPass = qs('#currentPass').value;
                    const newPass = qs('#newPass').value;
                    const confirmPass = qs('#confirmPass').value;

                    // Validation
                    // Note: Le mot de passe actuel peut être vide (utilisateurs Google sans password)
                    // Dans ce cas, on l'envoie vide et le backend gère la logique
                    
                    if (!newPass) {
                        showNotification('Veuillez entrer un nouveau mot de passe', 'warning', 'Nouveau mot de passe requis');
                        isValid = false;
                    }
                    if (newPass && newPass.length < 8) {
                        showNotification('Le mot de passe doit contenir au moins 8 caractères. Vous en avez actuellement ' + newPass.length, 'warning', 'Mot de passe trop court');
                        isValid = false;
                    }
                    // Vérifier que le mot de passe contient au moins une lettre ET un chiffre
                    if (newPass && !/[a-zA-Z]/.test(newPass)) {
                        showNotification('Le mot de passe doit contenir au moins une lettre (a-z ou A-Z)', 'warning', 'Aucune lettre détectée');
                        isValid = false;
                    }
                    if (newPass && !/[0-9]/.test(newPass)) {
                        showNotification('Le mot de passe doit contenir au moins un chiffre (0-9)', 'warning', 'Aucun chiffre détecté');
                        isValid = false;
                    }
                    // Vérifier alphanumérique + caractères spéciaux autorisés
                    if (newPass && !/^[a-zA-Z0-9!@#$%^&*()_+=\-{}[\]:;"'<>,.?/\\|`~]*$/.test(newPass)) {
                        showNotification('Le mot de passe contient des caractères non autorisés. Utilisez uniquement: lettres (a-z, A-Z), chiffres (0-9) et ces caractères spéciaux: !@#$%^&*()_+-=[]{}:;"\'<>,.?/|`~', 'warning', 'Format invalide');
                        isValid = false;
                    }
                    if (!confirmPass) {
                        showNotification('Veuillez confirmer votre nouveau mot de passe dans le champ "Confirmer"', 'warning', 'Confirmation requise');
                        isValid = false;
                    }
                    if (newPass && confirmPass && newPass !== confirmPass) {
                        showNotification('Les deux mots de passe ne correspondent pas. Assurez-vous que le nouveau mot de passe et sa confirmation sont exactement identiques', 'warning', 'Mots de passe non identiques');
                        isValid = false;
                    }

                    if (isValid) {
                        payload = {
                            type: 'security',
                            current_password: currentPass,
                            new_password: newPass
                        };
                        console.log('✅ Données de sécurité valides');
                    }
                }

                // Si les données ne sont pas valides, ne pas envoyer
                if (!isValid) {
                    console.error('❌ Validation échouée');
                    return;
                }

                // ============ ENVOI AU SERVEUR ============
                try {
                    console.log('📡 Envoi des données au serveur...');
                    const response = await fetch(`${window.location.origin}/kodPwomo/backend/users/update`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + accessToken
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();
                    console.log('📥 Réponse du serveur:', result);

                    if (!response.ok) {
                        showNotification(result.error || 'Erreur serveur', 'error', 'Erreur');
                        console.error('❌ Erreur HTTP:', response.status);
                        return;
                    }

                    if (result.status === 'success') {
                        const message = type === 'userDatas' 
                            ? 'Vos informations personnelles ont été mises à jour avec succès!'
                            : 'Votre mot de passe a été modifié avec succès!';
                        
                        showNotification(message, 'success', 'Succès');
                        console.log('✅ Mise à jour réussie');

                        // Réinitialiser le formulaire de sécurité si c'était celui-ci
                        if (type === 'security') {
                            qs('#currentPass').value = '';
                            qs('#newPass').value = '';
                            qs('#confirmPass').value = '';
                        }
                    } else {
                        showNotification(result.error || 'Erreur inconnue', 'error', 'Erreur');
                    }

                } catch (error) {
                    console.error('❌ Erreur lors de l\'envoi:', error);
                    showNotification('Erreur réseau: ' + error.message, 'error', 'Erreur');
                }
            }

            // ============ GESTION DES SOUMISSIONS DE SUPPORT ============
            async function handleSupportSubmit() {
                console.log('💾 Tentative d\'envoi du formulaire de support');
                const accessToken = localStorage.getItem('access_token');
                
                if (!accessToken) {
                    showNotification('Erreur: Token d\'accès manquant', 'error', 'Erreur d\'authentification');
                    return;
                }

                const subject = qs('#subject').value.trim();
                const category = qs('#category').value.trim();
                const message = qs('#message').value.trim();
                const universityId = qs('#supportUniversity').value;

                let isValid = true;

                // Validation
                if (!subject) {
                    showNotification('Veuillez entrer un sujet pour votre demande', 'warning', 'Sujet requis');
                    isValid = false;
                }
                if (!message) {
                    showNotification('Veuillez entrer votre message', 'warning', 'Message requis');
                    isValid = false;
                }
                if (!universityId) {
                    showNotification('Veuillez sélectionner une université', 'warning', 'Université requise');
                    isValid = false;
                }

                if (!isValid) {
                    console.error('❌ Validation du formulaire de support échouée');
                    return;
                }

                // Préparation des données
                const payload = {
                    subject: subject,
                    category: category,
                    message: message,
                    university_id: universityId
                };

                console.log('✅ Données de support valides:', payload);

                // Envoi au serveur
                try {
                    console.log('📡 Envoi du formulaire de support au serveur...');
                    const response = await fetch(`${window.location.origin}/kodPwomo/backend/support/create`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + accessToken
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();
                    console.log('📥 Réponse du serveur:', result);

                    if (!response.ok) {
                        showNotification(result.error || 'Erreur serveur', 'error', 'Erreur');
                        console.error('❌ Erreur HTTP:', response.status);
                        return;
                    }

                    if (result.status === 'success') {
                        showNotification('Votre demande de support a été envoyée avec succès! Nous vous répondrons dans les plus brefs délais.', 'success', 'Succès');
                        console.log('✅ Formulaire de support envoyé');

                        // Réinitialiser le formulaire
                        qs('#subject').value = '';
                        qs('#category').value = 'Commande';
                        qs('#message').value = '';
                        qs('#supportUniversity').value = '';
                    } else {
                        showNotification(result.error || 'Erreur inconnue', 'error', 'Erreur');
                    }

                } catch (error) {
                    console.error('❌ Erreur lors de l\'envoi du formulaire de support:', error);
                    showNotification('Erreur réseau: ' + error.message, 'error', 'Erreur');
                }
            }

            // ============ EVENT LISTENERS POUR LES BOUTONS ============
            const saveProfileBtn = qs('#saveProfileBtn');
            if (saveProfileBtn) {
                saveProfileBtn.addEventListener('click', () => {
                    handleSaveData('userDatas');
                });
            }

            const updateSecurityBtn = qs('#updateSecurityBtn');
            if (updateSecurityBtn) {
                updateSecurityBtn.addEventListener('click', () => {
                    handleSaveData('security');
                });
            }

            const logoutBtn = qs('#logoutBtn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', () => {
                    if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                        localStorage.removeItem('access_token');
                        localStorage.removeItem('refresh_token');
                        window.location.href = `${window.location.origin}/kodPwomo/login.php`;
                    }
                });
            }

            const supportSendBtn = qs('#supportSendBtn');
            if (supportSendBtn) {
                supportSendBtn.addEventListener('click', () => {
                    handleSupportSubmit();
                });
            }

            // Cancel button (only if not assigned)
            qsa('.order-card').forEach(card=>{
                const canCancel = card.getAttribute('data-status')==='attente' && card.getAttribute('data-assigned')==='false';
                const cancelBtn = card.querySelector('.js-cancel');
                if(cancelBtn){
                    if(!canCancel){ cancelBtn.style.display='none'; }
                    cancelBtn.addEventListener('click', ()=>{
                        if(!confirm('Annuler cette commande ?')) return;
                        card.setAttribute('data-status','annulee');
                        const badge = card.querySelector('.badge');
                        if(badge){ badge.className='badge annulee'; badge.textContent='✕ Annulée'; }
                        cancelBtn.remove();
                    });
                }
            });

            // Code modal helpers
            function setStepper(status){
                if(!deliveryStepper) return;
                const map = ['attente','en-route','livree'];
                const idx = Math.max(0, map.indexOf(status));
                const steps = Array.from(deliveryStepper.querySelectorAll('.stepper-step'));
                const lines = Array.from(deliveryStepper.querySelectorAll('.stepper-line'));
                steps.forEach((step,i)=>{
                    const dot = step.querySelector('.dot');
                    const label = step.querySelector('.label');
                    const isActive = i<=idx;
                    if(dot) dot.classList.toggle('active', isActive);
                    if(label) label.classList.toggle('active', isActive);
                });
                lines.forEach((l,i)=> l.classList.toggle('active', i<idx));
            }
            function openCodeModal(status){
                setStepper(status);
                agentCodeInput.value='';
                codeModal.classList.add('open');
                codeModal.removeAttribute('aria-hidden');
                agentCodeInput.focus({preventScroll:true});
            }
            function closeCodeModal(){
                codeModal.classList.remove('open');
                codeModal.setAttribute('aria-hidden','true');
            }
            codeModalClose.addEventListener('click', closeCodeModal);
            codeModalCancel.addEventListener('click', closeCodeModal);
            codeModal.addEventListener('click', (e)=>{ if(e.target===codeModal) closeCodeModal(); });
            codeModalConfirm.addEventListener('click', ()=>{
                const code = agentCodeInput.value.trim();
                if(!code){ showNotification('Veuillez saisir le code agent fourni par le livreur.', 'warning', 'Code requis'); return; }
                // Placeholder success
                showNotification('Livraison confirmée avec succès. Merci!', 'success', 'Confirmation');
                closeCodeModal();
            });

            // Initialize with section saved in localStorage
            const activeSection = getActiveSection();
            console.log('🔄 Chargement de la section depuis localStorage:', activeSection);
            setActiveSection(activeSection);
        })();
    </script>
    
    <!-- Sistema de Notificaciones Global -->
    <script src="assets/js/notifications-system.js"></script>
    
     <?php include 'heartbeat.php'; ?>
</body>
</html>