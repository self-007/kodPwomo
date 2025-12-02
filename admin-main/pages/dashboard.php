<?php
// Contenu principal du dashboard à inclure dans <main class="main">
// Ne contient pas de header/sidebar/html/head/body
?>
<section class="wm-dashboard" aria-labelledby="dashboardTitle" role="region">
    <h2 id="dashboardTitle" class="wm-sr-only">Tableau de bord</h2>

    <div class="wm-dashboard-inner" aria-live="polite">
        <!-- Statistiques -->
        <section class="wm-stats" aria-label="Statistiques principales">
            <div class="wm-stats-grid" role="list">
                <div class="wm-card" role="listitem" data-key="users" tabindex="0" aria-labelledby="stat-users">
                    <div class="wm-card-body">
                        <p id="stat-users" class="wm-card-title">Utilisateurs</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/users.php">Voir</button>
                            <button class="wm-btn wm-btn-ghost" data-action="export" data-export="users" aria-label="Exporter les utilisateurs">Exporter</button>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="universities" tabindex="0" aria-labelledby="stat-universities">
                    <div class="wm-card-body">
                        <p id="stat-universities" class="wm-card-title">Universités</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/universities.php">Voir</button>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="products" tabindex="0" aria-labelledby="stat-products">
                    <div class="wm-card-body">
                        <p id="stat-products" class="wm-card-title">Produits</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/products.php">Voir</button>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="orders" tabindex="0" aria-labelledby="stat-orders">
                    <div class="wm-card-body">
                        <p id="stat-orders" class="wm-card-title">Commandes</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/orders.php">Voir</button>
                        </div>
                    </div>
                </div>

                <!-- Boîtes stats du mois -->
                <div class="wm-month-stats-cards" style="display:flex;gap:1rem;margin-top:1rem;flex-wrap:wrap;width:100%">
                    <div class="wm-card" id="wm-month-orders-card" style="background:#2563eb;color:#fff;min-width:180px;flex:1">
                        <div class="wm-card-body">
                            <p class="wm-card-title">Commandes ce mois</p>
                            <p class="wm-card-value" id="wm-month-orders">0</p>
                        </div>
                    </div>
                    <div class="wm-card" id="wm-month-gains-card" style="background:#10b981;color:#fff;min-width:180px;flex:1">
                        <div class="wm-card-body">
                            <p class="wm-card-title">Gains ce mois</p>
                            <p class="wm-card-value" id="wm-month-gains">0 €</p>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="revenue" tabindex="0" aria-labelledby="stat-revenue">
                    <div class="wm-card-body">
                        <p id="stat-revenue" class="wm-card-title">Argent</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="export" data-export="revenue" aria-label="Exporter le chiffre d'affaires">Exporter</button>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="notifications" tabindex="0" aria-labelledby="stat-notifs">
                    <div class="wm-card-body">
                        <p id="stat-notifs" class="wm-card-title">Notifications</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/notifications.php">Voir</button>
                        </div>
                    </div>
                </div>

                <div class="wm-card" role="listitem" data-key="seats" tabindex="0" aria-labelledby="stat-seats">
                    <div class="wm-card-body">
                        <p id="stat-seats" class="wm-card-title">Places</p>
                        <p class="wm-card-value" data-value>--</p>
                        <div class="wm-card-actions">
                            <button class="wm-btn wm-btn-ghost" data-action="view" data-target="/kodpwomo/admin-main/pages/seats.php">Voir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="wm-dashboard-status" class="wm-status" aria-live="assertive" role="status"></div>
    </div>
</section>

<style>
/* Styles locaux au composant (préfixés .wm-dashboard) */
/* KodPwomo Design System - Unified Neumorphic Palette */
:root{
    --primary:#f7b642;
    --primary-dark:#e19627;
    --accent-green:#27ae60;
    --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
    --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
}

.wm-dashboard { 
    font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; 
    color: #1a1a2e; 
    width:100%; 
    padding:1.5rem; 
    box-sizing:border-box;
}

.wm-sr-only{ 
    position:absolute !important; 
    width:1px; 
    height:1px; 
    padding:0; 
    margin:-1px; 
    overflow:hidden; 
    clip:rect(0,0,0,0); 
    border:0; 
    white-space:nowrap; 
}

/* Grid responsive */
.wm-stats-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap:1.25rem;
    width:100%;
    margin-bottom:1.5rem;
}

/* Card base with 3D effect */
.wm-card { 
    border-radius:16px; 
    color: #fff; 
    padding:1.25rem; 
    box-sizing:border-box; 
    min-height:120px; 
    display:flex; 
    align-items:center;
    box-shadow: var(--shadow-3d-base);
    border:1px solid rgba(255,255,255,0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.wm-card:before{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(255,255,255,0.05);
    transform:translateX(-100%);
    transition:transform 0.6s ease;
}

.wm-card:hover {
    box-shadow: var(--shadow-3d-hover);
    transform: translateY(-6px) scale(1.02);
}

.wm-card:hover:before{
    transform:translateX(100%);
}

.wm-card:focus { 
    outline:3px solid rgba(247,182,66,0.4); 
    outline-offset:2px; 
}

/* Card body layout */
.wm-card-body { 
    width:100%; 
    display:flex; 
    flex-direction:column; 
    gap:0.75rem;
    position: relative;
    z-index:1;
}

.wm-card-title { 
    font-size:0.95rem; 
    margin:0; 
    opacity:0.95;
    font-weight:600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.wm-card-value { 
    font-size:2rem; 
    font-weight:700; 
    margin:0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Card actions */
.wm-card-actions { 
    display:flex; 
    gap:0.5rem; 
    margin-top:auto; 
}

.wm-btn { 
    background:rgba(255,255,255,0.15); 
    border:1px solid rgba(255,255,255,0.2); 
    color:inherit; 
    padding:0.5rem 0.75rem; 
    border-radius:10px; 
    cursor:pointer; 
    font-size:0.85rem;
    font-weight:600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.wm-btn:hover{
    background:rgba(255,255,255,0.25);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.wm-btn:active{
    transform: translateY(0) scale(0.98);
}

.wm-btn:focus { 
    outline:2px solid rgba(255,255,255,0.5);
    outline-offset:2px;
}

/* Month stats cards */
.wm-month-stats-cards{
    display:flex;
    gap:1.25rem;
    margin-top:1.25rem;
    flex-wrap:wrap;
    width:100%;
}

.wm-month-stats-cards .wm-card{
    min-width:200px;
    flex:1;
}

/* Card colors with gradients */
.wm-card[data-key="users"] { 
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}
.wm-card[data-key="universities"] { 
    background: linear-gradient(135deg, var(--accent-green) 0%, #1e7e41 100%);
}
.wm-card[data-key="products"] { 
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
}
.wm-card[data-key="orders"] { 
    background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
}
.wm-card[data-key="revenue"] { 
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}
.wm-card[data-key="notifications"] { 
    background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
}
.wm-card[data-key="seats"] { 
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
}

#wm-month-orders-card{
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
}

#wm-month-gains-card{
    background: linear-gradient(135deg, var(--accent-green) 0%, #1e7e41 100%) !important;
}

/* Status area */
.wm-status { 
    margin-top:1rem; 
    font-size:0.95rem; 
    color:#64748b;
    font-weight:500;
    padding:0.75rem 1rem;
    background:#f0fdf4;
    border-radius:12px;
    border:1px solid var(--primary);
    box-shadow: var(--shadow-3d-base);
}

/* Responsive tweaks */
@media (max-width:720px){
    .wm-dashboard { 
        padding:1rem; 
    }
    .wm-stats-grid {
        grid-template-columns: 1fr;
        gap:1rem;
    }
    .wm-card { 
        min-height:100px;
        padding:1rem;
    }
    .wm-card-value{
        font-size:1.75rem;
    }
}

@media (max-width:480px){
    .wm-card-value{
        font-size:1.5rem;
    }
    .wm-card-title{
        font-size:0.85rem;
    }
}
</style>

<script>
(function(){
    // Petit helper pour insérer du texte en sécurité
    function text(node, value){ if(node) node.textContent = value ?? ''; }

    // Éléments
    const statusEl = document.getElementById('wm-dashboard-status');
    const cards = Array.from(document.querySelectorAll('.wm-card'));

    // Construire URL relative
    const API_URL = '../backend/dashboard/super';

    // Fetch et rendu
    async function loadData(){
        try{
            statusEl.textContent = 'Chargement des données…';
            // remplace le contenu des cards par un placeholder
            document.querySelectorAll('.wm-card .wm-card-value').forEach(el => text(el,'—'));

            const res = await fetch(API_URL, { credentials: 'same-origin' });
            if(!res.ok) throw new Error('Erreur réseau ' + res.status);
            const data = await res.json();

            // Correction : extraire les stats directement de la racine de la réponse
            const stats = data || {};
            // Mapping entre data-key et clé de l'API
            const keyMap = {
                users: 'totalUsers',
                universities: 'university',
                products: 'Products',
                orders: 'Orders',
                revenue: 'money',
                notifications: 'notifications',
                seats: 'places',
                deliveries_month: 'monthStats', // à adapter si besoin
            };
            cards.forEach(card => {
                const key = card.getAttribute('data-key');
                const valueEl = card.querySelector('[data-value]');
                let val = stats[keyMap[key] || key];
                if(key === 'revenue' && typeof val === 'number'){
                    val = new Intl.NumberFormat('fr-FR', { style:'currency', currency:'EUR' }).format(val);
                }
                if(val === undefined || val === null) { val = '—'; }
                text(valueEl, val);
            });

            // Affichage du tableau stats du mois
            renderMonthStats(stats.monthStats);
    // Affiche les boîtes stats du mois
    function renderMonthStats(monthStats){
        const ordersEl = document.getElementById('wm-month-orders');
        const gainsEl = document.getElementById('wm-month-gains');
        let nOrders = 0;
        let totalAmount = 0;
        if(monthStats && Array.isArray(monthStats.deliveries) && monthStats.deliveries.length > 0){
            nOrders = monthStats.nbrs ?? 0;
            monthStats.deliveries.forEach((d) => {
                totalAmount += d.total_amount ?? 0;
            });
        }
        if(ordersEl) ordersEl.textContent = nOrders;
        if(gainsEl) gainsEl.textContent = new Intl.NumberFormat('fr-FR', { style:'currency', currency:'EUR' }).format(totalAmount);
    }

            statusEl.textContent = 'Données chargées';
            setTimeout(()=>{ if(statusEl.textContent === 'Données chargées') statusEl.textContent = ''; }, 3000);
        }catch(err){
            console.error(err);
            statusEl.textContent = 'Impossible de charger les données.';
            recentRows.innerHTML = '<tr class="wm-placeholder-row"><td colspan="6">Erreur de chargement</td></tr>';
        }
    }


    function formatMoney(v){
        if(v === undefined || v === null || v === '') return '-';
        if(typeof v === 'number') return new Intl.NumberFormat('fr-FR',{style:'currency',currency:'EUR'}).format(v);
        return String(v);
    }

    function formatDate(d){
        if(!d) return '-';
        const dt = new Date(d);
        if(isNaN(dt)) return String(d);
        return dt.toLocaleString('fr-FR', { year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
    }

    // Export CSV minimal
    function exportCsv(rows, filename = 'export.csv'){
        if(!rows || !rows.length) return alert('Aucune donnée à exporter');
        const headers = ['id','user','product','status','date','amount'];
        const csv = [headers.join(',')].concat(rows.map(r => headers.map(h => {
            const v = r[h] ?? '';
            // échapper les guillemets
            return '"' + String(v).replace(/"/g,'""') + '"';
        }).join(',')));
        const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = filename; document.body.appendChild(a); a.click();
        a.remove(); URL.revokeObjectURL(url);
    }

    // Delegation des boutons
    document.addEventListener('click', function(e){
        const btn = e.target.closest('.wm-btn');
        if(!btn) return;
        const action = btn.getAttribute('data-action');
        if(action === 'view'){
            const target = btn.getAttribute('data-target') || '#';
            // navigation intégrée (respecter la structure admin)
            window.location.href = target;
        } else if(action === 'export'){
            // simple export de la clé correspondante en CSV (requiert endpoint plus complet)
            const key = btn.getAttribute('data-export');
            // On récupère les données actuelles affichées dans le tableau pour export rapide
            // Ici on re-fetch pour s'assurer d'avoir les dernières données
            fetch(API_URL, { credentials: 'same-origin' })
                .then(r => r.json())
                .then(data => {
                    const rows = data.recent_deliveries || [];
                    exportCsv(rows, (key || 'export') + '.csv');
                })
                .catch(()=> alert('Impossible d\'exporter'));
        }
    });

    // Suppression des gestionnaires de boutons obsolètes (refresh/export)

    // Initial load
    document.addEventListener('DOMContentLoaded', function(){ loadData(); });

    // Exposer pour debug si besoin
    window.wmDashboardReload = loadData;

})();
</script>