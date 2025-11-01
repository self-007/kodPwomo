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

    <style>
        :root{
            --blue:#2563eb;
            --orange:#ff7a18;
            --green:#10b981;
            --violet:#7c3aed;
            --bg:#f7fafc;
            --card:#ffffff;
            --muted:#6b7280;
            --radius:12px;
            --shadow: 0 6px 18px rgba(16,24,40,0.06);
            --glass: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
        }

        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;
            background:var(--bg);
            color:#0f172a;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            line-height:1.35;
            padding:28px;
        }

        header{margin-bottom:18px}
        .title{
            display:flex;
            gap:12px;
            align-items:baseline;
            justify-content:space-between;
            flex-wrap:wrap;
        }
        h1{font-size:20px;margin:0;font-weight:600}
        p.lead{margin:0;color:var(--muted);font-size:13px}

        /* Controls */
        .controls{display:flex;gap:10px;align-items:center}

        /* Layout */
        .grid-cards{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:14px;
            margin:18px 0 24px;
        }
        @media (max-width:900px){ .grid-cards{ grid-template-columns:repeat(2,1fr); } }
        @media (max-width:520px){ .grid-cards{ grid-template-columns:1fr; } }

        .card{
            background:var(--card);
            border-radius:var(--radius);
            padding:16px;
            box-shadow:var(--shadow);
            display:flex;
            gap:12px;
            align-items:center;
            transition:transform .18s ease, box-shadow .18s ease;
            cursor:default;
            min-height:72px;
        }
        .card:focus-within, .card:hover{
            transform:translateY(-4px);
            box-shadow: 0 10px 30px rgba(16,24,40,0.08);
            outline:none;
        }

        .card .icon{
            width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;
            font-size:20px;color:#fff;
            flex-shrink:0;
        }
        .card .meta{flex:1;min-width:0}
        .card .label{color:var(--muted);font-size:13px;margin-bottom:6px}
        .card .value{font-weight:700;font-size:18px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

        /* Colors for icon blocks */
        .c-blue{background:var(--blue)}
        .c-orange{background:var(--orange)}
        .c-green{background:var(--green)}
        .c-violet{background:var(--violet)}

        /* Main panel */
        .panel{
            background:var(--card);
            border-radius:var(--radius);
            padding:18px;
            box-shadow:var(--shadow);
            transition:opacity .25s ease, transform .25s ease;
        }

        .chart-wrap{margin-top:12px}
        canvas{max-width:100%;height:320px !important}

        /* Tables */
        .two-col{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:14px;
            margin-top:18px;
        }
        @media (max-width:920px){ .two-col{ grid-template-columns:1fr } }

        table{width:100%;border-collapse:collapse;background:transparent}
        thead th{font-size:12px;text-align:left;color:var(--muted);padding:12px 12px}
        tbody tr{transition:background .12s ease}
        tbody tr:hover{background:linear-gradient(90deg, rgba(37,99,235,0.03), rgba(124,58,237,0.02))}
        td{padding:10px 12px;border-top:1px solid rgba(15,23,42,0.04);font-size:14px}

        /* Assistant */
        .assistant{margin-top:20px;display:flex;gap:8px;align-items:flex-start;flex-direction:column}
        .assistant .row{display:flex;gap:8px;width:100%}
        .assistant input[type="text"]{
            flex:1;padding:12px;border-radius:10px;border:1px solid rgba(15,23,42,0.08);
            font-size:14px;outline:none;background:transparent;
        }
        .assistant button{
            background:var(--blue);color:#fff;border:0;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;
            transition:transform .12s ease,opacity .12s ease;
        }
        .assistant button:active{transform:translateY(1px)}
        .assistant .result{
            margin-top:8px;padding:12px;border-radius:10px;background:linear-gradient(180deg, rgba(255,255,255,0.9), rgba(250,250,255,0.95));
            box-shadow:var(--shadow);min-height:44px;color:#0f172a;
        }

        /* Loader / skeleton */
        .skeleton{animation:shimmer 1.2s linear infinite;background:linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.4), rgba(255,255,255,0));background-size:200% 100%}
        .skeleton-box{background:linear-gradient(180deg, rgba(0,0,0,0.03), rgba(0,0,0,0.02));border-radius:8px}
        @keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}

        /* Fade-in */
        .fade-in{opacity:0;transform:translateY(6px);animation:fadeIn .42s forwards}
        @keyframes fadeIn{to{opacity:1;transform:none}}

        /* Accessibility */
        button:focus, input:focus, .card:focus-within{box-shadow:0 0 0 3px rgba(37,99,235,0.12)}
        .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
    </style>
</head>
<body>
    <header>
        <div class="title">
            <div>
                <h1>Analytics</h1>
                <p class="lead">Vue d’ensemble des livraisons, chiffre d’affaires et activité utilisateur sur les 7 derniers jours.</p>
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

        <!-- Assistant -->
        <section class="panel assistant fade-in" aria-label="Assistant d'analyse">
            <strong>Assistant d’analyse</strong>
            <div class="row" role="search">
                <input id="assistantInput" type="text" placeholder="Posez une question ou demandez un rapport (ex: 'Livraisons hier')" aria-label="Question pour l'assistant" />
                <button id="assistantBtn">Envoyer</button>
            </div>
            <div id="assistantResult" class="result" aria-live="polite">Entrez une question pour obtenir un résumé.</div>
        </section>
    </main>

    <script>
        // Configuration
        const API = '/kodpwomo/backend/analytics/super';
        const chartColors = {
            deliveries: getComputedStyle(document.documentElement).getPropertyValue('--blue').trim(),
            revenue: getComputedStyle(document.documentElement).getPropertyValue('--orange').trim()
        };

        // DOM
        const statCardsEl = document.getElementById('statCards');
        const refreshBtn = document.getElementById('refreshBtn');
        const darkToggle = document.getElementById('darkToggle');
        const assistantInput = document.getElementById('assistantInput');
        const assistantBtn = document.getElementById('assistantBtn');
        const assistantResult = document.getElementById('assistantResult');
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
            // d expected as ISO or YYYY-MM-DD
            try{ const dt = new Date(d); return dt.toLocaleDateString(undefined,{month:'short',day:'numeric'}); }catch(e){ return d; }
        }

        // Build cards markup once data available
        function renderCards(data){
            const cards = [
                { key:'deliveries', label:'Livraisons', icon:'🚚', color:'c-blue', value: data.deliveries ?? null },
                { key:'revenue', label:'Chiffre d\'affaires', icon:'💶', color:'c-orange', value: data.revenue ?? null, prefix: '€' },
                { key:'agents', label:'Agents', icon:'🧑‍💼', color:'c-green', value: data.agents ?? null },
                { key:'clients', label:'Clients', icon:'👤', color:'c-violet', value: data.clients ?? null },
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
                tr.tabIndex = 0;
                tr.setAttribute('role','button');
                tr.addEventListener('keydown', e => { if(e.key==='Enter') tr.click(); });
                tr.addEventListener('click', () => {
                    // Example action: focus assistant with context
                    assistantInput.value = `Détails pour ${email} (ID: ${id})`;
                    assistantInput.focus();
                });
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
        async function fetchData(query=null){
            try {
                // show skeletons
                if (!query){
                    statCardsEl.querySelectorAll('.card').forEach(c=>c.classList.add('skeleton'));
                    agentsTable.innerHTML = '<tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>';
                    clientsTable.innerHTML = '<tr><td colspan="2" class="skeleton-box" style="height:48px"></td></tr>';
                    assistantResult.textContent = query ? 'Chargement...' : assistantResult.textContent;
                }

                const opts = {
                    method: query ? 'POST' : 'GET',
                    headers: { 'Accept':'application/json', 'Content-Type':'application/json' }
                };
                if (query) opts.body = JSON.stringify({ query });

                const resp = await fetch(API, opts);
                if (!resp.ok) throw new Error('Erreur réseau: ' + resp.status);
                const json = await resp.json();

                // Example expected structure:
                // { deliveries: 123, revenue: 4567.89, agents: 12, clients: 345,
                //   series: { labels:['2025-10-21',...], deliveries:[...], revenue:[...] },
                //   top_agents: [{email,id},...], top_clients:[...] }
                const data = json ?? {};

                renderCards({
                    deliveries: data.deliveries ?? data.count_deliveries ?? null,
                    revenue: data.revenue ?? data.chiffre_affaires ?? null,
                    agents: data.agents ?? null,
                    clients: data.clients ?? null
                });

                // chart
                if (data.series && Array.isArray(data.series.labels)){
                    const labels = data.series.labels.map(isoDateLabel);
                    const seriesObj = {
                        deliveries: data.series.deliveries || [],
                        revenue: data.series.revenue || []
                    };
                    renderChart(labels, seriesObj);
                } else {
                    // no timeseries, clear chart
                    if (mainChart) mainChart.destroy();
                    chartCanvas.getContext('2d').clearRect(0,0,chartCanvas.width, chartCanvas.height);
                }

                renderTopList(agentsTable, data.top_agents || data.topAgents || []);
                renderTopList(clientsTable, data.top_clients || data.topClients || []);

                // Assistant: if server returned a quick analysis
                if (query){
                    if (json.result) assistantResult.textContent = json.result;
                    else if (json.summary) assistantResult.textContent = json.summary;
                    else assistantResult.textContent = 'Aucune réponse textuelle fournie par l\'API.';
                }

            } catch (err){
                console.error(err);
                // Minimal user-friendly error display
                statCardsEl.innerHTML = `<div style="grid-column:1/-1" class="panel" role="alert">Impossible de charger les données. ${err.message}</div>`;
                agentsTable.innerHTML = `<tr><td colspan="2" style="color:var(--muted)">Erreur lors du chargement</td></tr>`;
                clientsTable.innerHTML = `<tr><td colspan="2" style="color:var(--muted)">Erreur lors du chargement</td></tr>`;
                assistantResult.textContent = 'Erreur : ' + (err.message || 'Impossible de contacter l\'API.');
            } finally {
                // remove skeletons
                statCardsEl.querySelectorAll('.card.skeleton').forEach(c=>c.classList.remove('skeleton'));
            }
        }

        // Events
        refreshBtn.addEventListener('click', () => fetchData());

        assistantBtn.addEventListener('click', async () => {
            const q = assistantInput.value.trim();
            if (!q) { assistantResult.textContent = 'Veuillez entrer une question.'; assistantInput.focus(); return; }
            assistantResult.textContent = 'Génération du rapport…';
            assistantBtn.disabled = true;
            try {
                await fetchData(q);
            } finally {
                assistantBtn.disabled = false;
            }
        });

        assistantInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') assistantBtn.click();
        });

        darkToggle.addEventListener('click', () => {
            const isDark = document.documentElement.style.getPropertyValue('--bg') === '#0f172a';
            if (!isDark){
                document.documentElement.style.setProperty('--bg','#0f172a');
                document.documentElement.style.setProperty('--card','#0b1220');
                document.documentElement.style.setProperty('--muted','#9aa4b2');
                document.documentElement.style.setProperty('--shadow','0 8px 30px rgba(2,6,23,0.6)');
                document.body.style.background = '#0f172a';
                darkToggle.setAttribute('aria-pressed','true');
            } else {
                document.documentElement.style.setProperty('--bg','#f7fafc');
                document.documentElement.style.setProperty('--card','#ffffff');
                document.documentElement.style.setProperty('--muted','#6b7280');
                document.documentElement.style.setProperty('--shadow','0 6px 18px rgba(16,24,40,0.06)');
                document.body.style.background = '#f7fafc';
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