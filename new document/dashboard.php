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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />Parfait ! Je vois ta structure. Laisse-moi analyser et discuter de la méthode de récupération.
    
    📊 Analyse de ta structure JSON
    Points positifs :
    
    ✅ Une seule requête pour tout récupérer
    ✅ Tu as les stats (totalAmounts, totalSpent)
    
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
            <div class="logo" aria-label="KodPwomo"><img src="../image/logo/logo1.1.jpg" alt=""></div>
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
                        <strong style="font-size:13px; color:#111827">Jean Dupont</strong>
                        
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
                <a href="#" class="nav-link" data-target="notifications">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3c-3.314 0-6 2.686-6 6v3.382l-1.447 2.894A1 1 0 0 0 5.447 17h13.106a1 1 0 0 0 .894-1.447L18 12.382V9c0-3.314-2.686-6-6-6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Notifications
                </a>
                <a href="#" class="nav-link" data-target="logout">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 4h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Déconnexion
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
                                    <input id="firstName" class="input" type="text" placeholder="Jean" />
                                </div>
                                <div>
                                    <label for="lastName">Nom</label>
                                    <input id="lastName" class="input" type="text" placeholder="Dupont" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div>
                                    <label for="email">Email</label>
                                    <input id="email" class="input" type="email" placeholder="jean.dupont@example.com" />
                                </div>
                                <div>
                                    <label for="phone">Téléphone</label>
                                    <input id="phone" class="input" type="tel" placeholder="+33 6 12 34 56 78" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div>
                                    <label for="country">Pays</label>
                                    <select id="country" class="select">
                                        <option>France</option>
                                        <option>Belgique</option>
                                        <option>Canada</option>
                                        <option>Suisse</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="city">Ville</label>
                                    <input id="city" class="input" type="text" placeholder="Paris" />
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary">Enregistrer</button>
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
                                <button type="button" class="btn btn-primary">Mettre à jour</button>
                                <button type="button" class="btn btn-outline">Se déconnecter</button>
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
                        <div style="margin-top:12px; display:flex; gap:10px">
                            <button type="button" class="btn btn-primary">Envoyer</button>
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
                <button class="btn btn-primary">Télécharger la facture</button>
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

            // ============ API CONFIGURATION ============
            const API_BASE = `${window.location.origin}/kodPwomo/backend/deliveries/user`;
            
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
                    window.location.href = '../login.php';
                }, 5000);
            }

            // ============ API HELPER ============
            async function fetchAPI() {
                try {
                    const accessToken = localStorage.getItem('access_token');
                    if (!accessToken) {
                        console.warn('No access token found');
                        return null;
                    }

                    const response = await fetch(API_BASE, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + accessToken
                        }
                    });

                    if (!response.ok) {
                        if (response.status === 401 || response.status === 403) {
                            handleSessionExpired();
                            return null;
                        }
                        console.error(`HTTP Error: ${response.status}`);
                        return null;
                    }

                    const data = await response.json();
                    
                    // Vérifier les messages d'erreur du backend
                    if (data.error && (data.error.includes('expired') || data.error.includes('out') || data.error.includes('Unauthorized'))) {
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
                // Gérer les réponses vides ou sans structure
                if (!apiResponse) {
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
                    return {
                        commandes: [],
                        stats: {
                            nombreCommandes: 0,
                            totalGlobal: apiResponse.total_delivery || 0,
                            totalLivraisons: 0,
                            totalProduits: 0,
                            noteMoyenne: 0,
                            enRoute: apiResponse.processing_delivery || 0,
                            livrees: apiResponse.completed_delivery || 0
                        }
                    };
                }

                // Grouper les items par id_commande
                const commandesMap = new Map();
                
                datas.forEach(item => {
                    if (!commandesMap.has(item.id_commande)) {
                        commandesMap.set(item.id_commande, {
                            id_commande: item.id_commande,
                            note: item.note,
                            status: item.status,
                            feedback: item.feedback,
                            name: item.name,
                            salle_name: item.salle_name,
                            items: [],
                            totalCommande: 0
                        });
                    }
                    
                    const subtotal = item.qnt * item.prices;
                    commandesMap.get(item.id_commande).items.push({
                        qnt: item.qnt,
                        prices: item.prices,
                        subtotal: subtotal
                    });
                    
                    commandesMap.get(item.id_commande).totalCommande += subtotal;
                });

                // Convertir en array et trier par le plus récent
                const commandes = Array.from(commandesMap.values()).reverse();

                // Calculer les stats
                const stats = {
                    nombreCommandes: commandes.length,
                    totalGlobal: apiResponse.total_delivery || 0,
                    totalLivraisons: apiResponse.totalAmounts?.total_amount || 0,
                    totalProduits: apiResponse.totalSpent || 0,
                    noteMoyenne: commandes.filter(c => c.note).reduce((sum, c) => sum + c.note, 0) / commandes.filter(c => c.note).length || 0,
                    enRoute: apiResponse.processing_delivery || commandes.filter(c => c.status === 'in-route').length,
                    livrees: apiResponse.completed_delivery || commandes.filter(c => c.status === 'completed').length
                };

                return { commandes, stats };
            }

            // ============ RENDER FUNCTIONS ============
            function renderStats(stats) {
                const statsGrid = qs('.grid-stats');
                if (!statsGrid) return;

                statsGrid.innerHTML = `
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M4 7h16v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z" stroke="#10b981" stroke-width="2"/><path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke="#10b981" stroke-width="2"/></svg>
                        </div>
                        <div class="stat-value">${stats.nombreCommandes}</div>
                        <p class="card-sub">COMMANDES TOTALES</p>
                    </div>
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M3 16h18l-2-7H6L3 16Z" stroke="#10b981" stroke-width="2" stroke-linecap="round"/><path d="M7 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" stroke="#10b981" stroke-width="2"/></svg>
                        </div>
                        <div class="stat-value">${stats.enRoute}</div>
                        <p class="card-sub">EN ROUTE</p>
                    </div>
                    <div class="card order-card">
                        <div class="stat-icon green">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M20 6 9 17l-5-5" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div class="stat-value">${stats.livrees}</div>
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
                const ordersGrid = qs('#ordersGrid');
                if (!ordersGrid) return;

                if (commandes.length === 0) {
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
                    } else if (cmd.status === 'in-route') {
                        badgeClass = 'en-route';
                        badgeText = '🚗 En route';
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
                                <div class="value">${cmd.name}</div>
                                <div class="label">Salle:</div>
                                <div class="value">${cmd.salle_name}</div>
                            </div>
                            <div class="order-price">${cmd.totalCommande.toFixed(2)}€</div>
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

            // ============ INITIALIZATION ============
            async function initDashboard() {
                // Charger les données via l'accessToken
                const apiData = await fetchAPI();
                
                // Transformer les données (retourne toujours une structure valide)
                const transformed = transformData(apiData);

                // Rendre les sections
                renderStats(transformed.stats);
                renderOrders(transformed.commandes);
                renderReviews(transformed.commandes);
            }

            // Initialiser le dashboard au chargement
            initDashboard();

            const state = { current: 'home' };

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
                e.preventDefault();
                const target = link.getAttribute('data-target');
                if(target) setActiveSection(target);
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
                    setActiveSection('support');
                });
            }
            if(btnLogout){
                btnLogout.addEventListener('click', (e)=>{
                    e.preventDefault();
                    // Minimal logout handler placeholder
                    alert('Déconnexion...');
                });
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

            // Event delegation for "Voir détails"
            qs('#content').addEventListener('click', (e)=>{
                const btn = e.target.closest('[data-open-modal="order"]');
                if(!btn) return;
                e.preventDefault();
                const card = btn.closest('.order-card');
                const orderId = card?.getAttribute('data-order-id') || btn.getAttribute('data-order') || '';
                const status = card?.getAttribute('data-status') || 'attente';
                const date = card?.getAttribute('data-date') || '';
                const restaurant = card?.getAttribute('data-restaurant') || '';
                const address = card?.getAttribute('data-address') || '';
                const totalAttr = card?.getAttribute('data-total') || '0';
                
                // Articles demo
                const items = [
                    { name:'Pizza Margherita', qty:1, price:15.90 },
                    { name:'Pizza Quattro Formaggi', qty:1, price:16.90 },
                    { name:'Coca-Cola 1.5L', qty:1, price:3.00 }
                ];
                
                const subTotal = items.reduce((a,b)=>a+(b.price*b.qty),0);
                const delivery = 5.00;
                const service = 4.70;
                const total = subTotal + delivery + service;
                
                const articleRows = items.map(i=>`
                    <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f3f4f6">
                        <div>
                            <div style="font-weight:600">${i.name}</div>
                            <div style="font-size:13px; color:var(--muted)">x${i.qty}</div>
                        </div>
                        <div style="font-weight:600">${i.price.toFixed(2)}€</div>
                    </div>
                `).join('');
                
                let statusBadge = '';
                if(status === 'livree') statusBadge = '<span class="badge livree">✓ Livrée</span>';
                else if(status === 'en-route') statusBadge = '<span class="badge en-route">🚗 En route</span>';
                else if(status === 'attente') statusBadge = '<span class="badge attente">⏳ En préparation</span>';
                else if(status === 'annulee') statusBadge = '<span class="badge annulee">✕ Annulée</span>';
                
                const html = `
                    <div style="margin-bottom:16px">
                        <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:12px">
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Date:</div>
                                <div style="font-weight:600">${date} à 14:30</div>
                            </div>
                            <div style="text-align:right">${statusBadge}</div>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:12px">
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Université:</div>
                                <div style="font-weight:600">${restaurant}</div>
                            </div>
                            <div>
                                <div style="font-size:13px; color:var(--muted)">Places:</div>
                                <div style="font-weight:600">${address}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="border-top:2px solid #e5e7eb; padding-top:16px; margin-top:16px">
                        <h4 style="margin:0 0 12px; font-size:16px; font-weight:700">Articles</h4>
                        ${articleRows}
                        <div style="margin-top:16px; padding-top:12px; border-top:2px solid #e5e7eb">
                            <div style="display:flex; justify-content:space-between; margin-bottom:8px">
                                <span>Sous-total:</span>
                                <span style="font-weight:600">${subTotal.toFixed(2)}€</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:8px">
                                <span>Frais de livraison:</span>
                                <span style="font-weight:600">${delivery.toFixed(2)}€</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:12px">
                                <span>Frais de service:</span>
                                <span style="font-weight:600">${service.toFixed(2)}€</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; padding-top:12px; border-top:2px solid var(--green); font-size:18px">
                                <span style="font-weight:700">Total:</span>
                                <span style="font-weight:700; color:var(--green)">${total.toFixed(2)}€</span>
                            </div>
                        </div>
                    </div>
                    
                    ${status==='livree' ? `
                    <div style="margin-top:20px; padding-top:20px; border-top:2px solid #e5e7eb">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="#f59e0b"><path d="m12 2 2.7 5.47 6.05.88-4.38 4.27 1.03 6.01L12 16.9l-5.39 2.83 1.03-6.01L3.26 8.35l6.05-.88L12 2Z"/></svg>
                            <h4 style="margin:0; font-size:16px; font-weight:700">Évaluez la livraison</h4>
                        </div>
                        <div id="ratingStars" style="display:flex; gap:8px; font-size:28px; cursor:pointer; margin-bottom:8px" aria-label="Note sur 5">
                            <span data-v="1">☆</span><span data-v="2">☆</span><span data-v="3">☆</span><span data-v="4">☆</span><span data-v="5">☆</span>
                        </div>
                        <p class="muted" id="ratingHint" style="margin:0 0 14px; font-size:13px">Aucune note sélectionnée</p>
                        
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="#f59e0b"><path d="M12 22c4.97 0 9-4.03 9-9S16.97 4 12 4 3 8.03 3 13c0 1.84.55 3.55 1.49 4.97L4 22l4.2-1.32A8.96 8.96 0 0 0 12 22Z"/></svg>
                            <h4 style="margin:0; font-weight:700">Votre impression sur le livreur</h4>
                        </div>
                        <textarea id="deliveryReview" class="textarea" placeholder="Partagez votre expérience avec le livreur..." style="min-height:100px"></textarea>
                        
                        <div style="margin-top:16px">
                            <button class="btn btn-primary" id="finishDeliveryBtn" style="width:100%">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
                                TERMINER LA LIVRAISON
                            </button>
                        </div>
                    </div>` : ''}
                `;
                
                openModal(orderId, html);

                // rating stars (if present)
                const starsWrap = qs('#ratingStars');
                if(starsWrap){
                    let rating = 0;
                    starsWrap.addEventListener('click',(ev)=>{
                        const el = ev.target.closest('[data-v]');
                        if(!el) return;
                        rating = Number(el.getAttribute('data-v'))||0;
                        Array.from(starsWrap.children).forEach((s,idx)=>{ s.textContent = (idx<rating?'★':'☆'); });
                        const hint = qs('#ratingHint');
                        if(hint) hint.textContent = rating? `${rating}/5` : 'Aucune note sélectionnée';
                    });
                }

                // finish delivery -> open code modal
                const finishBtn = qs('#finishDeliveryBtn');
                if(finishBtn){
                    finishBtn.addEventListener('click', ()=>{
                        closeModal();
                        openCodeModal(status);
                    });
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
                if(!code){ alert('Veuillez saisir le code agent.'); return; }
                // Placeholder success
                alert('Livraison confirmée. Merci !');
                closeCodeModal();
            });

            // Initialize default section
            setActiveSection(state.current);
        })();
    </script>
</body>
</html>