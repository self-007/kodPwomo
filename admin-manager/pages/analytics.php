<?php
// Analytics admin page — fetches analytics for a university and displays charts/tables.
?>
<section aria-labelledby="analytics-title">
    <style>
        /* KodPwomo Analytics Styles - Unified Neumorphic Palette */
        :root{
            --primary: #f7b642;
            --primary-dark: #e19627;
            --secondary: #27ae60;
            --secondary-dark: #229954;
            --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
            --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
        }
        .analytics-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:#ffffff;padding:20px 24px;border-radius:16px;border:1px solid #e2e8f0;
            box-shadow:var(--shadow-3d-base);margin-bottom:20px;flex-wrap:wrap;
            /*border-left:4px solid var(--primary); */transition:all .25s ease;
        }
        .analytics-hero:hover{box-shadow:var(--shadow-3d-hover);transform:translateY(-2px);}
        .analytics-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;color: #294e7a;
        }
        .filters{display:flex;gap:12px;align-items:center;margin-top:12px;flex-wrap:wrap}
        .date{
            padding:10px 12px;border:2px solid #e2e8f0;border-radius:12px;
            background:#ffffff;transition:all 0.3s ease;box-sizing:border-box;min-width:140px;
            box-shadow:var(--shadow-3d-base);
        }
        .date:focus{border-color:var(--primary);outline:none;box-shadow:var(--shadow-3d-hover)}
        .btn{
            padding:8px 16px;border-radius:12px;border:2px solid var(--primary);
            background:#ffffff;color:var(--primary);
            font-weight:600;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;
            box-sizing:border-box;box-shadow:var(--shadow-3d-base);
        }
        .btn:hover{background:var(--primary);color:#ffffff;transform:scale(1.05);box-shadow:var(--shadow-3d-hover)}
        
        .kpi-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:16px}
        .kpi{
            background:#ffffff;padding:20px;border-radius:16px;
            border:1px solid #e2e8f0;box-shadow:var(--shadow-3d-base);
            position:relative;overflow:hidden;transition:all 0.3s ease;
            /*border-left:4px solid var(--primary);*/
        }
        .kpi:hover{transform:translateY(-4px);box-shadow:var(--shadow-3d-hover)}
        .kpi .label{font-size:12px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.5px}
        .kpi .value{
            font-size:2rem;font-weight:700;margin-top:8px;color:var(--primary);
            transition:all .6s cubic-bezier(.2,.9,.2,1)
        }
        
        .analytics-table{
            margin-top:20px;background:#ffffff;padding:20px;border-radius:16px;
            border:1px solid #e2e8f0;box-shadow:var(--shadow-3d-base);
            border-left:4px solid var(--primary); transition:all .25s ease;
        }
        .analytics-table:hover{box-shadow:var(--shadow-3d-hover);}
        .analytics-table-container{
            overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;margin-top:16px;
        }
        .analytics-table table{width:100%;border-collapse:collapse;min-width:400px}
        .analytics-table thead{background:var(--primary); }
        .analytics-table th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none;white-space:nowrap;
            box-shadow: var(--shadow-3d-hover);
            border-radius: 12px;
        }
        .analytics-table td{
            padding:14px 12px;border-bottom:1px solid #f1f5f9;
            color:#475569;font-weight:500;white-space:nowrap;
            border-radius: 12px;
        }
        .analytics-table tbody tr:nth-child(odd){background:#f8fafc}
        .analytics-table tbody tr:hover{
            background:#f0fdf4;transition:all 0.2s ease
        }

        .delivery-card{
            background:#ffffff;padding:16px;border-radius:12px;
            border:1px solid #e2e8f0;box-shadow:var(--shadow-3d-base);
            transition:all 0.3s ease;position:relative;overflow:hidden;
            margin-top: 10px ;
            /*border-left:4px solid var(--primary);*/
        }
        .delivery-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-3d-hover)}
        .delivery-meta{display:flex;gap:8px;align-items:center;margin-top:8px;flex-wrap:wrap}
        .badge-status{
            padding:4px 10px;border-radius:16px;font-weight:600;font-size:10px;
            text-transform:uppercase;letter-spacing:0.3px;
            white-space:nowrap;max-width:100px;overflow:hidden;text-overflow:ellipsis;
        }
        .status-processing{
            background:#fff5f0;color:#F39C12;border:1px solid #F39C12;
        }
        .status-processing::before{content:'⏳';margin-right:4px}
        .status-completed{
            background:#f0fdf4;color:var(--primary);border:1px solid var(--primary);
        }
        .status-completed::before{content:'✅';margin-right:4px}
        .status-cancelled{
            background:#fef2f2;color:#E74C3C;border:1px solid #E74C3C;
        }
        .status-cancelled::before{content:'❌';margin-right:4px}

        .muted{color:#64748b}
        .small{font-size:13px}
        
        /* Responsive */
        @media (max-width:1024px){
            .kpi-row{grid-template-columns:repeat(2,1fr);gap:12px}
            .analytics-table{padding:16px}
        }
        @media (max-width:768px){
            .analytics-hero{flex-direction:column;align-items:flex-start;padding:16px}
            .filters{width:100%;justify-content:stretch;gap:8px}
            .date, .btn{flex:1;min-width:120px}
            .kpi-row{grid-template-columns:repeat(2,1fr);gap:8px}
            .kpi{padding:16px}
            .kpi .value{font-size:1.6rem}
            .analytics-table{padding:12px}
            .analytics-table table{font-size:12px;min-width:350px}
            .analytics-table th, .analytics-table td{padding:8px 6px}
            .badge-status{font-size:9px;padding:2px 6px;max-width:80px}
        }
        @media (max-width:480px){
            .analytics-hero{padding:12px}
            .filters{flex-direction:column;gap:8px}
            .date, .btn{width:100%;min-width:auto}
            .kpi-row{grid-template-columns:1fr}
            .analytics-table{padding:8px;margin:0 -4px}
            .analytics-table-container{margin:16px -8px 0;border-radius:0}
            .analytics-table table{font-size:11px;min-width:300px}
            .analytics-table th, .analytics-table td{padding:6px 4px}
        }
    </style>

    <div class="analytics-hero">
        <div>
            <h2 id="analytics-title">Analytics</h2>
            <div class="muted">Analyse des commandes et performances</div>
        </div>
        <div>
            <div class="filters">
                <input type="date" id="fromDate" class="date">
                <input type="date" id="toDate" class="date">
                <button id="runFilter" class="btn">Filtrer</button>
            </div>
        </div>
    </div>

    <div id="analytics-root">
        <div class="kpi-row">
            <div class="kpi"><div class="label">Total Users</div><div class="value" id="a_totalUsers">—</div></div>
            <div class="kpi"><div class="label">Total Orders</div><div class="value" id="a_totalOrders">—</div></div>
            <div class="kpi"><div class="label">Revenue</div><div class="value" id="a_revenue">—</div></div>
            <div class="kpi"><div class="label">Average Ticket</div><div class="value" id="a_avg">—</div></div>
        </div>

        <div class="analytics-table">
            <h3>Top commandes</h3>
            <div class="analytics-table-container">
                <table id="analyticsTable">
                    <thead>
                        <tr><th>Produit</th><th>Nb commandes</th><th>Revenue</th></tr>
                    </thead>
                    <tbody id="analyticsBody"><tr><td colspan="3" class="muted">Chargement...</td></tr></tbody>
                </table>
            </div>
        </div>
        
        <div style="margin-top:18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:12px">
            <div class="analytics-table" id="overviewBox">
                <h3>Overview Deliveries</h3>
                <div id="overviewContent" class="muted">Chargement...</div>
            </div>

            <div class="analytics-table" id="dailyBox">
                <h3>Daily Orders</h3>
                <div id="dailyContent" class="muted">Chargement...</div>
            </div>

            <div class="analytics-table" id="customersBox">
                <h3>Top Customers</h3>
                <div style="overflow:auto"><table style="width:100%"><thead><tr><th>Client</th><th>Total livré</th><th>Total dépensé</th></tr></thead><tbody id="customersBody"><tr><td colspan="3" class="muted">Chargement...</td></tr></tbody></table></div>
            </div>

            <div class="analytics-table" id="agentsBox">
                <h3>Top Agents</h3>
                <div style="overflow:auto"><table style="width:100%"><thead><tr><th>Agent</th><th>Livraisons</th><th>Moyenne note</th></tr></thead><tbody id="agentsBody"><tr><td colspan="3" class="muted">Chargement...</td></tr></tbody></table></div>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const univ = new URLSearchParams(window.location.search).get('univ') || '1';
            const base = `../backend/analytics/adm`;

            async function fetchData(from, to){
                const params = from && to ? `?from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}` : '';
                const url = `${base}/${univ}${params}`;
                try{
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                    const txt = await res.text();
                    if (!txt) throw new Error('empty');
                    const data = JSON.parse(txt);
                    render(data);
                }catch(e){ document.getElementById('analytics-root').innerHTML = '<div class="muted">Erreur: '+(e.message||e)+'</div>' }
            }

            function render(d){
                // small helpers
                function fmtNum(n){ if (n===null||n===undefined) return '0'; return Number(n).toLocaleString(); }
                function fmtMoney(n){ if (n===null||n===undefined) return '0 FC'; return fmtNum(n)+' FC'; }
                function fmtDate(s){ if(!s) return ''; try{ const d=new Date(s.replace(' ','T')); return d.toLocaleString(); }catch(e){return s} }

                // KPIs: prefer aggregated nbrs when available, else fallbacks
                const totalUsers = (d.overview && d.overview.nbrs) || d.totalUsers || 0;
                const totalOrders = (d.orders && d.orders.nbrs) || (d.overview && d.overview.nbrs) || (d.dailyOrders && d.dailyOrders.nbrs) || 0;
                // revenue: sum overview deliveries total_amount when present
                let revenue = 0; if (d.overview && Array.isArray(d.overview.deliveries)) revenue = d.overview.deliveries.reduce((s,it)=>s+(Number(it.total_amount)||0),0);
                const avg = (d.overview && d.overview.deliveries && d.overview.deliveries.length)? (d.overview.deliveries.reduce((s,it)=>s+(Number(it.note)||0),0)/d.overview.deliveries.length).toFixed(2) : (d.avg||0);

                document.getElementById('a_totalUsers').textContent = fmtNum(totalUsers);
                document.getElementById('a_totalOrders').textContent = fmtNum(totalOrders);
                document.getElementById('a_revenue').textContent = fmtMoney(revenue);
                document.getElementById('a_avg').textContent = avg;

                // Top commandes (reuse existing orders list if present)
                const body = document.getElementById('analyticsBody'); body.innerHTML = '';
                const rows = (d.orders && d.orders.orders) || [];
                if (!rows.length) { body.innerHTML = '<tr><td colspan="3" class="muted">Aucun résultat</td></tr>'; }
                for (const r of rows){
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${escape(r.product_name||r.name||'')}</td><td>${r.qnt||0}</td><td>${r.price||0}</td>`;
                    body.appendChild(tr);
                }

                // Overview deliveries
                const ov = d.overview && d.overview.deliveries ? d.overview.deliveries : [];
                const ovBox = document.getElementById('overviewContent'); ovBox.innerHTML = '';
                if (!ov.length) {
                    ovBox.innerHTML = '<div class="muted">Aucune livraison</div>';
                } else {
                    for (const item of ov){
                        const div = document.createElement('div');
                        div.className = 'delivery-card';
                        const status = (item.status||'').toLowerCase();
                        let cls = 'status-processing'; if (status==='completed') cls='status-completed'; else if (status==='cancelled') cls='status-cancelled';
                        div.innerHTML = `
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <div><strong>${escape(item.id_commande)}</strong><div class="muted">${escape(item.university_name||'')}</div></div>
                                <div class="badge-status ${cls}">${escape(item.status||'processing')}</div>
                            </div>
                            <div class="delivery-meta">
                                <div class="muted">Montant: <strong>${item.total_amount || 0} FC</strong></div>
                                <div class="muted">Livraison: <strong>${item.delivery_price || 0} FC</strong></div>
                                <div class="muted">Note: <strong>${item.note || 0}</strong></div>
                            </div>
                            <div style="margin-top:8px;color:#0b1720">${escape(item.feedback || '')}</div>
                        `;
                        ovBox.appendChild(div);
                    }
                }

                // Daily orders (render like small cards)
                const dail = d.dailyOrders && d.dailyOrders.deliveries ? d.dailyOrders.deliveries : [];
                const dBox = document.getElementById('dailyContent'); dBox.innerHTML = '';
                if (!dail.length) {
                    dBox.innerHTML = '<div class="muted">Aucune donnée journalière</div>';
                } else {
                    for (const dl of dail){
                        const div = document.createElement('div'); div.className='delivery-card';
                        const s = (dl.status||'').toLowerCase(); let cls='status-processing'; if(s==='completed') cls='status-completed'; else if(s==='cancelled') cls='status-cancelled';
                        div.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:center"><div><strong>${escape(dl.id_commande||'')}</strong><div class="small muted">${fmtDate(dl.date)}</div></div><div class="badge-status ${cls}">${escape(dl.status||'')}</div></div><div class="delivery-meta"><div class="muted">Montant: <strong>${fmtMoney(dl.total_amount||0)}</strong></div><div class="muted">Livraison: <strong>${fmtMoney(dl.delivery_price||0)}</strong></div></div>`;
                        dBox.appendChild(div);
                    }
                }

                // Top customers
                const cust = d.topCustomers && d.topCustomers.customers ? d.topCustomers.customers : [];
                const custBody = document.getElementById('customersBody'); custBody.innerHTML = '';
                if (!cust.length) custBody.innerHTML = '<tr><td colspan="3" class="muted">Aucun client</td></tr>';
                for (const c of cust){ const tr = document.createElement('tr'); tr.innerHTML = `<td>${escape(c.name||c.email||'')}</td><td>${fmtNum(c.total_deliveries||0)}</td><td>${fmtMoney(c.total_spent||0)}</td>`; custBody.appendChild(tr); }

                // Top agents
                const ag = d.topAgents && d.topAgents.agents ? d.topAgents.agents : [];
                const agentBody = document.getElementById('agentsBody'); agentBody.innerHTML = '';
                if (!ag.length) agentBody.innerHTML = '<tr><td colspan="3" class="muted">Aucun agent</td></tr>';
                for (const a of ag){ const tr = document.createElement('tr'); tr.innerHTML = `<td>${escape(a.name||a.email||a.id_unique)}</td><td>${fmtNum(a.completed_deliveries_count||a.total_deliveries||0)}</td><td>${a.avg_note||a.avg||0}</td>`; agentBody.appendChild(tr); }
            }

            function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

            document.getElementById('runFilter').addEventListener('click', ()=>{
                const from = document.getElementById('fromDate').value || null;
                const to = document.getElementById('toDate').value || null;
                fetchData(from,to);
            });

            // initial load
            fetchData();
        })();
    </script>

</section>
