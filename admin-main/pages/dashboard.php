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
/* Palette: bleu (#2563eb), vert (#10b981), orange (#ff7a18), gris clair (#f7fafc), gris foncé (#0f172a) */
.wm-dashboard { font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; color: #0f172a; width:100%; padding:1rem; box-sizing:border-box; }
.wm-sr-only{ position:absolute !important; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0; white-space:nowrap; }

/* Grid responsive */
.wm-stats-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap:0.75rem;
    width:100%;
    margin-bottom:1rem;
}

/* Card base */
.wm-card { border-radius:10px; color: #fff; padding:0.75rem; box-sizing:border-box; min-height:88px; display:flex; align-items:center; }
.wm-card:focus { outline:3px solid rgba(37,99,235,0.25); outline-offset:2px; }

/* Card body layout */
.wm-card-body { width:100%; display:flex; flex-direction:column; gap:0.5rem; }
.wm-card-title { font-size:0.9rem; margin:0; opacity:0.95; }
.wm-card-value { font-size:1.35rem; font-weight:700; margin:0; }

/* Card actions */
.wm-card-actions { display:flex; gap:0.5rem; margin-top:auto; }
.wm-btn { background:none; border:0; color:inherit; padding:0.25rem 0.5rem; border-radius:6px; cursor:pointer; font-size:0.85rem; }
.wm-btn:focus { outline:2px solid rgba(255,255,255,0.35); }
.wm-btn-ghost { background: rgba(255,255,255,0.08); }
.wm-btn-primary { background:#0f172a; color:#f7fafc; border-radius:8px; padding:0.5rem 0.75rem; }
.wm-btn-outline { background: transparent; border:1px solid rgba(15,23,42,0.08); padding:0.4rem 0.6rem; border-radius:8px; }

/* Panel / table */
.wm-panel { background:transparent; width:100%; }
.wm-panel-header { display:flex; align-items:center; justify-content:space-between; gap:0.5rem; margin-bottom:0.5rem; }
.wm-panel-header h3 { margin:0; font-size:1.05rem; color:#0f172a; }
.wm-panel-actions { display:flex; gap:0.5rem; }

.wm-panel-body { background: #f7fafc; border-radius:10px; padding:0.5rem; box-sizing:border-box; color:#0f172a; }
.wm-table-wrap { overflow:auto; width:100%; }
.wm-table { width:100%; border-collapse:collapse; min-width:600px; }
.wm-table thead th { text-align:left; padding:0.6rem 0.5rem; font-weight:600; font-size:0.85rem; color:#0f172a; }
.wm-table tbody td { padding:0.55rem 0.5rem; border-top:1px solid rgba(15,23,42,0.05); font-size:0.9rem; color:#0f172a; }

/* Placeholder row */
.wm-placeholder-row td { text-align:center; color:rgba(15,23,42,0.6); padding:1rem 0; }

/* Status area */
.wm-status { margin-top:0.6rem; font-size:0.9rem; color:#0f172a; }

/* Card colors */
.wm-card[data-key="users"] { background: linear-gradient(135deg,#2563eb 0%, #1e40af 100%); }
.wm-card[data-key="universities"] { background: linear-gradient(135deg,#10b981 0%, #059669 100%); }
.wm-card[data-key="products"] { background: linear-gradient(135deg,#ff7a18 0%, #ff5500 100%); }
.wm-card[data-key="orders"] { background: linear-gradient(135deg,#2563eb 0%, #1e40af 100%); }
.wm-card[data-key="deliveries_month"] { background: linear-gradient(135deg,#10b981 0%, #059669 100%); }
.wm-card[data-key="revenue"] { background: linear-gradient(135deg,#ff7a18 0%, #d35400 100%); }
.wm-card[data-key="notifications"] { background: linear-gradient(135deg,#2563eb 0%, #1e40af 100%); }
.wm-card[data-key="seats"] { background: linear-gradient(135deg,#10b981 0%, #059669 100%); }

/* Responsive tweaks: stack vertically on narrow widths */
@media (max-width:720px){
    .wm-dashboard { padding:0.75rem; }
    .wm-card { min-height:84px; }
    .wm-table { min-width:100%; }
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
    const API_URL = '/kodpwomo/backend/dashboard/super';

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