<?php
// /c:/wamp64/www/kodPwomo/admin-main/pages/analytics.php
// Minimal PHP wrapper - page is mostly client-side
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Analytics — Admin</title>

    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Suppression Font Awesome : utilisation d'icônes SVG inline pour fiabilité -->

    <style>
        :root{
            --blue:#FF6B35;              /* Primary: Warm Orange-Red */
            --orange:#004E89;            /* Secondary: Deep Blue */
            --green:#1ABC9C;             /* Success: Turquoise Mint */
            --violet:#00D4FF;            /* Accent: Cyan */
            --bg:#f8f9fa;                /* Light background */
            --card:#ffffff;              /* Card background */
            --muted:#64748b;             /* Muted text */
            --radius:12px;
            --shadow: 0 6px 18px rgba(255, 107, 53, 0.08);
            --glass: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
        }

        * { box-sizing:border-box; }
        html, body { height:100%; }
        body {
            margin:0;
            font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;
            background:var(--bg);
            color:#1a1a2e;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            line-height:1.35;
            padding:28px;
        }

        header { margin-bottom:18px; }
        .title {
            display:flex;
            gap:12px;
            align-items:baseline;
            justify-content:space-between;
            flex-wrap:wrap;
        }
        h1 { font-size:20px; margin:0; font-weight:600; }
        p.lead { margin:0; color:var(--muted); font-size:13px; }

        .controls { display:flex; gap:10px; align-items:center; }

        .grid-cards {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:14px;
            margin:18px 0 24px;
        }
        @media (max-width:900px) { .grid-cards { grid-template-columns:repeat(2,1fr); } }
        @media (max-width:520px) { .grid-cards { grid-template-columns:1fr; } }

        .card {
            position:relative;
            background:linear-gradient(135deg, #ffffff 0%, #f5f7fa 100%);
            border-radius:var(--radius);
            padding:18px 18px 18px 20px;
            box-shadow:var(--shadow), inset 0 0 0 1px rgba(0,0,0,0.04);
            display:flex;
            gap:14px;
            align-items:center;
            transition:transform .22s cubic-bezier(.22,.9,.3,1), box-shadow .22s ease, background .4s ease;
            cursor:default;
            min-height:78px;
            overflow:hidden;
        }
        .card::after {
            content:""; position:absolute; inset:0; pointer-events:none;
            background:radial-gradient(circle at 25% 20%, rgba(255,255,255,0.65), rgba(255,255,255,0) 60%);
            opacity:.55; mix-blend-mode:overlay;
            transition:opacity .4s ease;
        }
        .card:focus-within, .card:hover {
            transform:translateY(-6px);
            box-shadow:0 14px 34px -6px rgba(255,107,53,0.28);
            outline:none;
            background:linear-gradient(135deg, #ffffff 0%, #eef2f6 100%);
        }
        .card:hover::after { opacity:.8; }

        .card .icon {
            width:50px; height:50px; border-radius:14px; display:flex; align-items:center; justify-content:center;
            font-size:22px; color:#fff;
            flex-shrink:0; position:relative;
            box-shadow:0 4px 14px -2px rgba(0,0,0,0.15);
        }
        .card .icon svg { width:24px; height:24px; filter:drop-shadow(0 2px 2px rgba(0,0,0,0.15)); }
        .card .icon svg path { fill:#fff; }
        .card .meta { flex:1; min-width:0; }
        .card .label { color:var(--muted); font-size:13px; margin-bottom:6px; }
        .card .value { font-weight:700; font-size:18px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

        .c-blue { background:linear-gradient(135deg, #FF6B35 0%, #D84315 100%); }
        .c-orange { background:linear-gradient(135deg, #004E89 0%, #003566 100%); }
        .c-green { background:linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); }
        .c-violet { background:linear-gradient(135deg, #00D4FF 0%, #0099cc 100%); }

        /* Table enhancements */
        thead th { position:relative; }
        thead th::after { content:""; position:absolute; left:0; bottom:0; height:1px; width:100%; background:linear-gradient(90deg, rgba(255,107,53,.25), rgba(0,212,255,.25)); }
        tbody tr { backdrop-filter:saturate(140%); }
        tbody tr:hover { box-shadow:inset 0 0 0 999px rgba(255,255,255,0.5); }
        tbody td:first-child { font-weight:500; }
        tbody td { transition:color .18s ease; }
        tbody tr:hover td { color:#0f172a; }

        .panel {
            background:var(--card);
            border-radius:var(--radius);
            padding:18px;
            box-shadow:var(--shadow);
            transition:opacity .25s ease, transform .25s ease;
        }

        .chart-wrap { margin-top:12px; }
        canvas { max-width:100%; height:320px !important; }

        .two-col {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:14px;
            margin-top:18px;
        }
        @media (max-width:920px) { .two-col { grid-template-columns:1fr; } }

        table { width:100%; border-collapse:collapse; background:transparent; }
        thead th { font-size:12px; text-align:left; color:var(--muted); padding:12px 12px; }
        tbody tr { transition:background .12s ease; }
        tbody tr:hover { background:linear-gradient(90deg, rgba(255, 107, 53, 0.03), rgba(0, 212, 255, 0.02)); }
        td { padding:10px 12px; border-top:1px solid rgba(26, 26, 46, 0.04); font-size:14px; }


        .skeleton { animation:shimmer 1.2s linear infinite; background:linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.4), rgba(255,255,255,0)); background-size:200% 100%; }
        .skeleton-box { background:linear-gradient(180deg, rgba(0,0,0,0.03), rgba(0,0,0,0.02)); border-radius:8px; }
        @keyframes shimmer { 0% { background-position:-200% 0; } 100% { background-position:200% 0; } }

        .fade-in { opacity:0; transform:translateY(6px); animation:fadeIn .42s forwards; }
        @keyframes fadeIn { to { opacity:1; transform:none; } }

        button:focus, input:focus, .card:focus-within { box-shadow:0 0 0 3px rgba(255, 107, 53, 0.12); }
        .sr-only { position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
    </style>
</head>
<body>
    <header>
        <div class="title">
            <div>
                <h1>Analytics</h1>
                <p class="lead">Vue d'ensemble des livraisons, chiffre d'affaires et activité utilisateur sur les 7 derniers jours.</p>
            </div>
            <div class="controls">
                <button id="refreshBtn" title="Rafraîchir les données" aria-label="Rafraîchir" style="background:transparent;border:0;color:var(--blue);font-weight:600;cursor:pointer">Rafraîchir</button>
                <button id="darkToggle" title="Basculer mode sombre" aria-pressed="false" style="background:transparent;border:0;cursor:pointer">🌓</button>
            </div>
        </div>
    </header>

    <main>
        <!-- Statistic cards -->
        <section class="grid-cards" id="statCards" aria-live="polite">
            <!-- Skeletons shown by default -->
            <div class="card skeleton fade-in"><div class="icon c-blue"></div><div class="meta"><div class="label skeleton-box" style="width:80px;height:12px;margin-bottom:8px"></div><div class="value skeleton-box" style="width:120px;height:18px"></div></div></div>
            <div class="card skeleton fade-in"><div class="icon c-orange"></div><div class="meta"><div class="label skeleton-box" style="width:100px;height:12px;margin-bottom:8px"></div><div class="value skeleton-box" style="width:120px;height:18px"></div></div></div>
            <div class="card skeleton fade-in"><div class="icon c-green"></div><div class="meta"><div class="label skeleton-box" style="width:70px;height:12px;margin-bottom:8px"></div><div class="value skeleton-box" style="width:120px;height:18px"></div></div></div>
            <div class="card skeleton fade-in"><div class="icon c-violet"></div><div class="meta"><div class="label skeleton-box" style="width:80px;height:12px;margin-bottom:8px"></div><div class="value skeleton-box" style="width:120px;height:18px"></div></div></div>
        </section>

        <!-- Main chart panel -->
        <section class="panel fade-in" id="chartPanel" aria-live="polite" aria-label="Graphique d'évolution">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
                <strong>Evolution — 7 derniers jours</strong>
                <div style="color:var(--muted);font-size:13px">Données mises à jour automatiquement</div>
            </div>
            <div class="chart-wrap" id="chartWrap">
                <canvas id="mainChart" role="img" aria-label="Graphique des livraisons sur 7 jours"></canvas>
            </div>
        </section>

        <!-- Top lists -->
        <section class="two-col" aria-live="polite">
            <div class="panel fade-in" id="topAgentsPanel">
                <strong>Top Agents</strong>
                <div style="margin-top:8px">
                    <table id="agentsTable" aria-describedby="topAgentsPanel">
                        <thead><tr><th>Agent</th><th>ID</th></tr></thead>
                        <tbody>
                            <tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel fade-in" id="topClientsPanel">
                <strong>Top Clients</strong>
                <div style="margin-top:8px">
                    <table id="clientsTable" aria-describedby="topClientsPanel">
                        <thead><tr><th>Client</th><th>ID</th></tr></thead>
                        <tbody>
                            <tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    <script>
        // Configuration
        const API = '../backend/analytics/super';
        const chartColors = {
            deliveries: getComputedStyle(document.documentElement).getPropertyValue('--blue').trim(),
            revenue: getComputedStyle(document.documentElement).getPropertyValue('--orange').trim()
        };

        const statCardsEl = document.getElementById('statCards');
        const refreshBtn = document.getElementById('refreshBtn');
        const darkToggle = document.getElementById('darkToggle');
        const agentsTable = document.getElementById('agentsTable').querySelector('tbody');
        const clientsTable = document.getElementById('clientsTable').querySelector('tbody');
        const chartCanvas = document.getElementById('mainChart');

        let mainChart = null;

        // Helpers
        function numberFormat(n){
            if (n === null || n === undefined) return '-';
            return n.toLocaleString();
        }

        function isoDateLabel(d){
            try{ const dt = new Date(d); return dt.toLocaleDateString(undefined,{month:'short',day:'numeric'}); }catch(e){ return d; }
        }

        function renderCards(data){
            const cards = [
                { key:'deliveries', label:'Livraisons', icon:`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7h11v9H3V7zm13 0h3.586L22 10.414V16h-6V7zm-9.5 11a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM14 9H5v5h9V9z"/></svg>`, color:'c-blue', value: data.deliveries ?? null },
                { key:'revenue', label:'Chiffre d\'affaires', icon:`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10a9.96 9.96 0 0 0 8.94-5.986l-1.838-.79A8.001 8.001 0 1 1 20 12h2c0 5.514-4.486 10-10 10zm.5-15h-1v2.05A3.501 3.501 0 0 0 8 12a3.5 3.5 0 0 0 3.5 3.5V17h1v-1.45A3.5 3.5 0 0 0 16 12a3.501 3.501 0 0 0-3.5-3.95V4z"/></svg>`, color:'c-orange', value: data.revenue ?? null, prefix: '€' },
                { key:'agents', label:'Agents', icon:`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>`, color:'c-green', value: data.agents ?? null },
                { key:'clients', label:'Clients', icon:`<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 11c1.654 0 3-1.346 3-3S17.654 5 16 5s-3 1.346-3 3 1.346 3 3 3zm-8 0c1.654 0 3-1.346 3-3S9.654 5 8 5 5 6.346 5 8s1.346 3 3 3zm0 2c-2.673 0-8 1.337-8 4v2h10v-2c0-2.663-5.327-4-8-4zm8 0c-.29 0-.618.018-.974.046 1.236.86 1.974 2.037 1.974 3.454v2H24v-2c0-2.663-5.327-4-8-4z"/></svg>`, color:'c-violet', value: data.clients ?? null },
            ];

            statCardsEl.innerHTML = '';
            for (const c of cards){
                const div = document.createElement('div');
                div.className = 'card';
                div.setAttribute('tabindex','0');
                div.innerHTML = `
                    <div class="icon ${c.color}" aria-hidden="true">${c.icon}</div>
                    <div class="meta">
                        <div class="label">${c.label}</div>
                        <div class="value">${c.prefix ? c.prefix + ' ' : ''}${c.value !== null ? numberFormat(c.value) : '-'}</div>
                    </div>
                `;
                statCardsEl.appendChild(div);
            }
        }

        function renderTopList(tbodyEl, items){
            tbodyEl.innerHTML = '';
            if (!Array.isArray(items) || items.length === 0){
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="2" style="color:var(--muted);padding:12px">Aucune donnée</td>`;
                tbodyEl.appendChild(tr);
                return;
            }
            for (const it of items){
                const tr = document.createElement('tr');
                const email = it.email || it.name || '-';
                const id = it.id ?? '-';
                tr.innerHTML = `<td style="max-width:230px;overflow:hidden;text-overflow:ellipsis">${email}</td><td>${id}</td>`;
                tbodyEl.appendChild(tr);
            }
        }

        function renderChart(labels, series){
            if (mainChart) mainChart.destroy();
            const ctx = chartCanvas.getContext('2d');

            mainChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Livraisons',
                            data: series.deliveries,
                            borderColor: chartColors.deliveries,
                            backgroundColor: hexToRgba(chartColors.deliveries, 0.08),
                            tension: 0.32,
                            pointRadius:4,
                            pointBackgroundColor:chartColors.deliveries,
                            fill: true
                        },
                        {
                            label: 'Chiffre d\'affaires',
                            data: series.revenue,
                            borderColor: chartColors.revenue,
                            backgroundColor: hexToRgba(chartColors.revenue, 0.06),
                            tension: 0.32,
                            pointRadius:4,
                            pointBackgroundColor:chartColors.revenue,
                            fill: false,
                            yAxisID: 'y2'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        x: { grid: { display:false } },
                        y: {
                            beginAtZero:true,
                            grid: { color: 'rgba(15,23,42,0.04)' },
                            ticks: { color: '#374151' }
                        },
                        y2: {
                            position: 'right',
                            grid: { display: false },
                            ticks: { color: '#374151' },
                            beginAtZero: true
                        }
                    },
                    interaction: { mode: 'index', intersect: false },
                    transitions: { show: { animations: { x: { from: 0 }, y: { from: 0 } } }, hide: { animations: { x: { to: 0 }, y: { to: 0 } } } }
                }
            });
        }

        function hexToRgba(hex, a){
            const h = hex.replace('#','');
            const bigint = parseInt(h,16);
            const r = (bigint >> 16) & 255;
            const g = (bigint >> 8) & 255;
            const b = bigint & 255;
            return `rgba(${r},${g},${b},${a})`;
        }

        // Fetch and update UI
        async function fetchData(){
            try {
                // show skeletons
                statCardsEl.querySelectorAll('.card').forEach(c=>c.classList.add('skeleton'));
                agentsTable.innerHTML = '<tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>';
                clientsTable.innerHTML = '<tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>';

                const opts = {
                    method: 'GET',
                    headers: { 'Accept':'application/json' }
                };

                const resp = await fetch(API, opts);
                if (!resp.ok) throw new Error('Erreur réseau: ' + resp.status);
                const json = await resp.json();

                // Nouvelle structure attendue (exemple fourni):
                // {
                //   overview: { nbrs: 1, deliveries: [ { total_amount: null }, ... ] },
                //   dailyOrders: { nbrs: 0, orders: [ { date: "2025-11-06", total_amount: 123 }, ... ] },
                //   topAgents: { nbrs: 1, agents: [ { id_unique, email, name, total_earned, ... } ] },
                //   topCustomers: { nbrs: 1, customers: [ { id, name, email, total_spent, ... } ] }
                // }
                const overview = json.overview || {};
                const dailyOrders = json.dailyOrders || {};
                const topAgentsData = json.topAgents || json.top_agents || {};
                const topCustomersData = json.topCustomers || json.top_clients || {};

                // Calcul du chiffre d'affaires: somme des total_amount (ignorer null)
                const revenueSum = Array.isArray(overview.deliveries)
                    ? overview.deliveries.reduce((acc, d) => acc + (Number(d.total_amount) || 0), 0)
                    : 0;

                renderCards({
                    deliveries: typeof overview.nbrs === 'number' ? overview.nbrs : null,
                    revenue: revenueSum,
                    agents: typeof topAgentsData.nbrs === 'number' ? topAgentsData.nbrs : (Array.isArray(topAgentsData.agents) ? topAgentsData.agents.length : null),
                    clients: typeof topCustomersData.nbrs === 'number' ? topCustomersData.nbrs : (Array.isArray(topCustomersData.customers) ? topCustomersData.customers.length : null)
                });

                // Construction du graphique
                let chartLabels = [];
                let deliveriesSeries = [];
                let revenueSeries = [];

                if (Array.isArray(dailyOrders.orders) && dailyOrders.orders.length) {
                    // Si la structure contient des objets avec date et total_amount
                    chartLabels = dailyOrders.orders.map(o => isoDateLabel(o.date || '')); // fallback date vide
                    deliveriesSeries = dailyOrders.orders.map(o => (o.qnt || 1)); // Nombre de livraisons ou quantité
                    revenueSeries = dailyOrders.orders.map(o => Number(o.total_amount) || 0);
                } else if (Array.isArray(overview.deliveries) && overview.deliveries.length) {
                    // Fallback: utiliser overview comme source unique (un seul point ou agrégation)
                    chartLabels = ['Total'];
                    deliveriesSeries = [overview.nbrs || overview.deliveries.length];
                    revenueSeries = [revenueSum];
                }

                if (chartLabels.length) {
                    renderChart(chartLabels, { deliveries: deliveriesSeries, revenue: revenueSeries });
                } else {
                    if (mainChart) mainChart.destroy();
                    chartCanvas.getContext('2d').clearRect(0,0,chartCanvas.width, chartCanvas.height);
                }

                // Listes Top
                renderTopList(agentsTable, topAgentsData.agents || []);
                renderTopList(clientsTable, topCustomersData.customers || []);


            } catch (err){
                console.error(err);
                // Minimal user-friendly error display
                statCardsEl.innerHTML = `<div style="grid-column:1/-1" class="panel" role="alert">Impossible de charger les données. ${err.message}</div>`;
                agentsTable.innerHTML = `<tr><td colspan="2" style="color:var(--muted)">Erreur lors du chargement</td></tr>`;
                clientsTable.innerHTML = `<tr><td colspan="2" style="color:var(--muted)">Erreur lors du chargement</td></tr>`;
            } finally {
                // remove skeletons
                statCardsEl.querySelectorAll('.card.skeleton').forEach(c=>c.classList.remove('skeleton'));
            }
        }

        // Events
        refreshBtn.addEventListener('click', () => fetchData());


        darkToggle.addEventListener('click', () => {
            const isDark = document.documentElement.style.getPropertyValue('--bg') === '#0f172a';
            if (!isDark){
                document.documentElement.style.setProperty('--bg','#0f172a');
                document.documentElement.style.setProperty('--card','#0b1220');
                document.documentElement.style.setProperty('--muted','#9aa4b2');
                document.documentElement.style.setProperty('--shadow','0 8px 30px rgba(255, 107, 53, 0.15)');
                document.body.style.background = '#0f172a';
                darkToggle.setAttribute('aria-pressed','true');
            } else {
                document.documentElement.style.setProperty('--bg','#f8f9fa');
                document.documentElement.style.setProperty('--card','#ffffff');
                document.documentElement.style.setProperty('--muted','#64748b');
                document.documentElement.style.setProperty('--shadow','0 6px 18px rgba(255, 107, 53, 0.08)');
                document.body.style.background = '#f8f9fa';
                darkToggle.setAttribute('aria-pressed','false');
            }
        });

        // Initial load
        fetchData();

        // Polling for fresh data every 60s (optional)
        setInterval(fetchData, 60000);
    </script>
</body>
</html>