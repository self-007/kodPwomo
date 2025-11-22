<?php
// Simple dashboard page — frontend fetches data from backend and renders it
?>
<section aria-labelledby="dashboard-title">
    <style>
        /* KodPwomo Dashboard Styles - Unified Green Palette */
        .dash-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--spacing-2, 16px);
            margin-bottom: var(--spacing-3, 24px);
            background: #ffffff;
            padding: 20px 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }
        
        .dash-hero h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .dash-hero .univ {
            background: #f0fdf4;
            color: var(--primary);
            font-size: 14px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid var(--primary);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: var(--spacing-2, 16px);
            margin-bottom: var(--spacing-3, 24px);
        }
        
        .kpi {
            background: #ffffff;
            padding: var(--spacing-3, 24px);
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-left: 4px solid var(--primary);
        }
        
        .kpi:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-4px);
        }
        
        .kpi .label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: var(--spacing-1, 8px);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        
        .kpi .value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1.2;
        }
        
        .kpi .sub {
            font-size: 12px;
            color: #64748b;
            margin-top: var(--spacing-1, 8px);
            background: #f0fdf4;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
            border: 1px solid var(--primary);
        }

        .orders-card {
            background: #ffffff;
            border-radius: 24px;
            padding: var(--spacing-3, 24px);
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }
        
        .orders-table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            margin-top: 16px;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
        }
        
        .orders-table thead th {
            position: sticky;
            top: 0;
            background: var(--primary);
            color: #ffffff;
            z-index: 2;
            padding: var(--spacing-2, 16px);
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            border-bottom: none;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            white-space: nowrap;
        }
        
        .orders-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .orders-table tbody tr:hover {
            background: #f0fdf4;
        }
        
        .orders-table td {
            padding: var(--spacing-2, 16px);
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            color: #475569;
            font-weight: 500;
            white-space: nowrap;
            min-width: 80px;
        }
        
        .orders-table .status-col {
            min-width: 120px;
            width: 120px;
        }
        
        .orders-table tbody tr:nth-child(odd) {
            background: #f8fafc;
        }
        
        .orders-table tbody tr:nth-child(even) {
            background: #ffffff;
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .badge.pending {
            background: #fff5f0;
            color: #F39C12;
            border: 1px solid #F39C12;
        }
        .badge.pending::before { content: '⏳'; margin-right: 4px; }
        
        .badge.completed {
            background: #f0fdf4;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        .badge.completed::before { content: '✅'; margin-right: 4px; }

        .controls {
            display: flex;
            gap: var(--spacing-1, 8px);
            align-items: center;
            margin-bottom: var(--spacing-2, 16px);
            flex-wrap: wrap;
        }
        
        .search, .filter {
            padding: var(--spacing-1, 8px) var(--spacing-2, 16px);
            border-radius: 20px;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            color: #1a1a2e;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            box-sizing: border-box;
        }
        
        .search:focus, .filter:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(39,174,96,0.1);
        }
        
        .search {
            min-width: 200px;
            flex: 1;
            max-width: 300px;
        }

        .count-anim {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .skeleton {
            background: #e2e8f0;
            animation: shimmer 1.5s ease-in-out infinite;
            border-radius: 8px;
        }
        
        @keyframes shimmer {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        .muted {color:#64748b}

        /* Responsive */
        @media (max-width: 1024px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-1);
            }
            
            .dash-hero {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .orders-table {
                min-width: 700px;
            }
        }

        @media (max-width: 768px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-1);
            }
            
            .dash-hero {
                flex-direction: column;
                align-items: flex-start;
                padding: 16px;
            }
            
            .dash-hero h2 {
                font-size: 1.5rem;
            }
            
            .orders-card {
                padding: 16px;
            }
            
            .controls {
                flex-direction: column;
                align-items: stretch;
                gap: var(--spacing-1);
            }
            
            .search, .filter {
                width: 100%;
                min-width: auto;
                max-width: none;
            }
            
            .orders-table {
                font-size: 12px;
                min-width: 600px;
            }
            
            .orders-table th, .orders-table td {
                padding: 8px 6px;
            }
            
            .badge {
                font-size: 9px;
                padding: 2px 6px;
                max-width: 80px;
            }
        }
        
        @media (max-width: 480px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }
            
            .dash-hero {
                padding: 12px;
            }
            
            .dash-hero h2 {
                font-size: 1.3rem;
            }
            
            .orders-card {
                padding: 12px;
                margin: 0 -4px;
            }
            
            .orders-table-container {
                margin: 16px -12px 0;
                border-radius: 0;
            }
            
            .orders-table {
                font-size: 11px;
                min-width: 500px;
            }
            
            .orders-table th, .orders-table td {
                padding: 6px 4px;
            }
            
            .status-col {
                min-width: 90px !important;
                width: 90px;
            }
        }
    </style>

    <div class="dash-hero">
        <div>
            <h2 id="dashboard-title">Dashboard • Statistiques</h2>
            <div class="univ" id="univName">—</div>
        </div>
        <div class="muted">Dernières données</div>
    </div>

    <div id="dash-root">
        <div class="controls">
            <input class="search" id="searchInput" placeholder="Rechercher produit, client, commande...">
            <select id="statusFilter" class="filter">
                <option value="">Tous les statuts</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div class="kpi-grid" aria-hidden="false">
            <div class="kpi"><div class="label">Utilisateurs</div><div class="value" id="totalUsers">—</div><div class="sub">Total utilisateurs enregistrés</div></div>
            <div class="kpi"><div class="label">Produits (univ)</div><div class="value" id="universityProducts">—</div><div class="sub">Produits actifs</div></div>
            <div class="kpi"><div class="label">Commandes (univ)</div><div class="value" id="universityOrders">—</div><div class="sub">Commandes ce mois</div></div>
            <div class="kpi"><div class="label">Revenu (mois)</div><div class="value" id="monthRevenue">—</div><div class="sub">Montant en FC</div></div>
        </div>

        <div class="orders-card">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
                <h3 style="margin:0">Dernières commandes</h3>
                <div class="muted">Total: <span id="ordersCount">—</span></div>
            </div>
            <div class="orders-table-container">
                <table class="orders-table" aria-describedby="dashboard-title">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Client</th>
                            <th>Commande</th>
                            <th>Date</th>
                            <th>Qnt</th>
                            <th style="text-align:right">Prix</th>
                            <th>Salle</th>
                            <th class="status-col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="ordersBody">
                        <tr><td colspan="8"><div class="skeleton" style="height:60px;width:100%"></div></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const univId = new URLSearchParams(window.location.search).get('univ') || '1';
            const url = `/backend/dashboard/adm/${univId}`;
            let _orders = [];

            async function load(){
                try{
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    const txt = await res.text();
                    if (!txt) throw new Error('empty response');
                    const data = JSON.parse(txt);
                    fill(data);
                }catch(err){
                    document.getElementById('dash-root').innerHTML = '<div class="muted">Erreur chargement: '+(err.message||err)+'</div>';
                }
            }

            function animateCount(el, target){
                const start = 0; const end = Number(target) || 0; const duration = 700; const startTime = performance.now();
                function step(now){
                    const t = Math.min(1, (now - startTime)/duration);
                    const val = Math.floor(start + (end - start) * (1 - Math.pow(1-t,3)));
                    el.textContent = val;
                    if (t < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            function toCurrency(n){ if (!n && n!==0) return '0'; return new Intl.NumberFormat('fr-FR').format(n); }

            function fill(d){
                document.getElementById('univName').textContent = d.university || '—';
                animateCount(document.getElementById('totalUsers'), d.totalUsers ?? 0);
                animateCount(document.getElementById('universityProducts'), d.universityProducts ?? 0);
                animateCount(document.getElementById('universityOrders'), d.universityOrders ?? 0);
                document.getElementById('monthRevenue').textContent = toCurrency(d.monthRevenue ?? 0) + ' FC';

                _orders = (d.orders && d.orders.orders) || [];
                document.getElementById('ordersCount').textContent = (d.orders && d.orders.nbrs) || _orders.length;
                renderOrders(_orders);

                // wire search/filter
                document.getElementById('searchInput').addEventListener('input', e => renderOrders(_orders));
                document.getElementById('statusFilter').addEventListener('change', e => renderOrders(_orders));
            }

            function renderOrders(list){
                const q = (document.getElementById('searchInput').value||'').toLowerCase().trim();
                const status = (document.getElementById('statusFilter').value||'').toLowerCase();
                const body = document.getElementById('ordersBody'); body.innerHTML = '';
                const filtered = list.filter(o => {
                    const text = ((o.product_name||'')+' '+(o.user_name||'')+' '+(o.order_id||'')+' '+(o.salle_name||'')).toLowerCase();
                    if (q && text.indexOf(q) === -1) return false;
                    if (status && ((o.status||'').toLowerCase() !== status)) return false;
                    return true;
                });
                if (filtered.length === 0) { body.innerHTML = '<tr><td colspan="8" style="padding:12px;color:var(--muted)">Aucun résultat</td></tr>'; return; }
                for (const o of filtered){
                    const tr = document.createElement('tr');
                    const status = (o.status||'').toLowerCase();
                    const badgeClass = status==='completed' ? 'badge completed' : 'badge pending';
                    tr.innerHTML = `
                        <td>${escape(o.product_name)}</td>
                        <td>${escape(o.user_name)}</td>
                        <td>${escape(o.order_id)}</td>
                        <td>${escape(o.date)}</td>
                        <td>${o.qnt}</td>
                        <td style="text-align:right">${toCurrency(o.price)}</td>
                        <td>${escape(o.salle_name)}</td>
                        <td><span class="${badgeClass}">${escape(o.status||'pending')}</span></td>
                    `;
                    body.appendChild(tr);
                }
            }

            function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

            load();
        })();
    </script>

</section>
