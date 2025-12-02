<?php
// Simple Notifications page using the same design language (green accents, orange actions)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifications - KodPwomo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#f9fafb; --white:#ffffff; --text:#111827; --muted:#6b7280;
            --green:#10b981; --orange:#f59e0b; --border:#e5e7eb;
            --shadow-sm:0 1px 2px rgba(0,0,0,0.06); --shadow-lg:0 10px 25px rgba(0,0,0,0.10);
            --radius:16px; --ease:cubic-bezier(0.25,0.1,0.25,1);
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{margin:0; font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif; background:var(--bg); color:var(--text)}
        .header{position:sticky; top:0; z-index:100; background:var(--white); border-bottom:1px solid var(--border)}
        .header-inner{display:flex; align-items:center; gap:12px; padding:12px 16px}
        .logo{font-weight:800; color:var(--text)}
        .container{max-width:1100px; margin:24px auto; padding:0 16px}
        h1{margin:0 0 16px; font-size:22px}
        .grid{display:grid; grid-template-columns:1fr; gap:16px}
        @media(min-width:768px){.grid{grid-template-columns:repeat(2,1fr)}}
        @media(min-width:1200px){.grid{grid-template-columns:repeat(3,1fr)}}
        .card{background:var(--white); border-radius:var(--radius); box-shadow:var(--shadow-sm); padding:16px; position:relative}
        .card::before{content:''; position:absolute; top:0; left:0; right:0; height:4px; border-radius:var(--radius) var(--radius) 0 0; background:var(--green)}
        .notif{display:flex; gap:12px; align-items:flex-start}
        .icon{width:44px; height:44px; border-radius:10px; background:linear-gradient(135deg,#e5e7eb,#d1d5db); display:grid; place-items:center}
        .title{margin:0; font-weight:700; font-size:16px}
        .meta{font-size:12px; color:var(--muted)}
        .desc{margin:8px 0 0; font-size:13px; color:var(--text)}
        .badge{display:inline-block; font-size:10px; font-weight:700; letter-spacing:.3px; text-transform:uppercase; padding:5px 10px; border-radius:6px}
        .badge.info{background:#d1fae5; color:#047857}
        .badge.alert{background:#fee2e2; color:#b91c1c}
        .badge.update{background:#dbeafe; color:#1e40af}
        .actions{margin-top:12px; display:flex; gap:10px}
        .btn{appearance:none; border:0; cursor:pointer; border-radius:8px; padding:10px 16px; font-weight:600; font-size:13px; display:inline-flex; align-items:center; gap:6px}
        .btn-outline{background:var(--white); box-shadow:inset 0 0 0 1px var(--border)}
        .btn-primary{background:var(--orange); color:#fff}
        .btn:hover{opacity:.95}
        .empty{display:grid; place-items:center; height:200px; color:var(--muted)}
    </style>
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="logo">KodPwomo</div>
        </div>
    </header>

    <main class="container">
        <h1>Notifications</h1>
        <div class="grid">
            <div class="card">
                <div class="notif">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"><path d="M12 2 2 7l10 5 10-5-10-5Zm0 7-10 5 10 5 10-5-10-5Z" stroke="#10b981" stroke-width="2"/></svg>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex; justify-content:space-between; align-items:center">
                            <h3 class="title">Commande #2024012 confirmée</h3>
                            <span class="badge info">Info</span>
                        </div>
                        <div class="meta">12 Janvier 2025 • 14:32</div>
                        <p class="desc">Votre commande a été acceptée par l'agent. Suivi disponible dans Mes Commandes.</p>
                        <div class="actions">
                            <button class="btn btn-outline" onclick="location.href='../dashboard_user/dashboard.php'">Voir la commande</button>
                            <button class="btn btn-primary">Marquer comme lue</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="notif">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"><path d="M3 16h18l-2-7H6L3 16Z" stroke="#10b981" stroke-width="2" stroke-linecap="round"/><path d="M7 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" stroke="#10b981" stroke-width="2"/></svg>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex; justify-content:space-between; align-items:center">
                            <h3 class="title">Commande en route</h3>
                            <span class="badge update">Mise à jour</span>
                        </div>
                        <div class="meta">12 Janvier 2025 • 15:05</div>
                        <p class="desc">L'agent est en route vers votre place de livraison à Université Joseph Ki-Zerbo.</p>
                        <div class="actions">
                            <button class="btn btn-outline" onclick="location.href='../dashboard_user/dashboard.php#orders'">Suivre</button>
                            <button class="btn btn-primary">Marquer comme lue</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="notif">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"><path d="M20 6 9 17l-5-5" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex; justify-content:space-between; align-items:center">
                            <h3 class="title">Livraison terminée</h3>
                            <span class="badge info">Succès</span>
                        </div>
                        <div class="meta">12 Janvier 2025 • 16:40</div>
                        <p class="desc">Votre commande a été livrée. Donnez une note et un avis dans Mes Avis.</p>
                        <div class="actions">
                            <button class="btn btn-outline" onclick="location.href='../dashboard_user/dashboard.php#reviews'">Donner un avis</button>
                            <button class="btn btn-primary">Marquer comme lue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty state example -->
        <!-- <div class="card empty">Aucune notification pour l'instant</div> -->
    </main>
</body>
</html>
