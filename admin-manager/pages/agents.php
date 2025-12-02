<?php
// Agents admin page — lists agents, supports pagination and status toggle via PUT
?>
<section aria-labelledby="agents-title">
    <style>
        /* KodPwomo Agents Styles - Unified Neumorphic Palette */
        :root{
            --primary: #f7b642;
            --primary-dark: #e19627;
            --secondary: #27ae60;
            --secondary-dark: #229954;
            --white: #ffffff;
            --dark-gray: #1A1A1A;
            --medium-gray: #666666;
            --light-gray: #F5F5F5;
            --border-color: #E0E0E0;
            --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
            --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
        }
        /* Admin Manager Header (global) */
        header{
            background:#ffffff;
            border:1px solid #e2e8f0;
            border-radius:14px;
            box-shadow:var(--shadow-3d-base);
        }
        header:hover{ box-shadow:var(--shadow-3d-hover); transition:all .25s ease; }
        .agents-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:#ffffff;padding:20px 24px;border-radius:16px;border:1px solid #e2e8f0;
            box-shadow:var(--shadow-3d-base);margin-bottom:20px;flex-wrap:wrap;
           /* border-left:4px solid var(--primary); */
        }
        .agents-hero:hover{ box-shadow:var(--shadow-3d-hover); transform:translateY(-2px); transition:all .25s ease; }
        .agents-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;color: #294e7a;
        }
        .agents-hero .controls{
            display:flex;gap:8px;align-items:center;flex-wrap:wrap;
        }
        .agents-table{
            margin-top:20px;background:#ffffff;padding:20px;border-radius:16px;
            border:1px solid #e2e8f0;box-shadow:var(--shadow-3d-base)
        }
        .agents-table:hover{ box-shadow:var(--shadow-3d-hover); transition:all .25s ease; }
        .agents-table-container{
            overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;margin-top:16px;
        }
        .agents-table table{width:100%;border-collapse:collapse;min-width:1000px}
        .agents-table thead{background: var(--secondary); }
        .agents-table th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none;white-space:nowrap;
        }
        .agents-table .status-col{min-width:120px;width:120px}
        .agents-table .btn-col{min-width:100px;width:100px;text-align:center}
        .agents-table td{
            padding:14px 12px;border-bottom:1px solid #f1f5f9;
            color:#475569;font-weight:500;white-space:nowrap;
        }
        .agents-table tbody tr:nth-child(odd){background:#f8fafc}
        .agents-table tbody tr:hover{
            background:#f0fdf4;
            transition:all 0.2s ease
        }
        .muted{color:#64748b}
        .search{
            padding:10px 12px;border-radius:12px;border:2px solid #e2e8f0;
            background:#ffffff;transition:all 0.3s ease;min-width:200px;
            box-sizing:border-box;
            box-shadow:var(--shadow-3d-base);
        }
        .search:focus{border-color:var(--primary);outline:none;box-shadow:var(--shadow-3d-hover)}
        .btn{
            padding:8px 16px;border-radius:12px;border:2px solid var(--primary);
            background:#ffffff;color:var(--primary);
            font-weight:600;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;
            box-sizing:border-box;
            box-shadow:var(--shadow-3d-base);
        }
        .btn:hover{background:var(--primary);color:#ffffff;transform:scale(1.05); box-shadow:var(--shadow-3d-hover)}
        .pager{
            display:flex;gap:10px;align-items:center;margin-top:16px;justify-content:center;
            flex-wrap:wrap;
        }
        .pager button{
            padding:8px 12px;border-radius:12px;border:2px solid var(--primary);
            background:#ffffff;color:var(--primary);cursor:pointer;font-weight:600;
            transition:all 0.3s ease;min-width:40px;
            box-shadow:var(--shadow-3d-base);
        }
        .pager button:hover{
            background:var(--primary);color:#ffffff;transform:translateY(-2px); box-shadow:var(--shadow-3d-hover)
        }
        .pager button:disabled{
            opacity:0.5;cursor:not-allowed
        }
        .badge-status{
            padding:4px 10px;border-radius:16px;font-weight:600;font-size:10px;
            text-transform:uppercase;letter-spacing:0.3px;
            white-space:nowrap;max-width:100px;overflow:hidden;text-overflow:ellipsis;
        }
        .status-active{
            background:#f0fdf4;color:var(--primary);border:1px solid var(--primary);
        }
        .status-active::before{content:'🟢';margin-right:4px}
        .status-inactive{
            background:#fff5f0;color:#F39C12;border:1px solid #F39C12;
        }
        .status-inactive::before{content:'🟡';margin-right:4px}
        .btn-sm{
            padding:6px 10px;border-radius:8px;border:none;cursor:pointer;font-weight:600;
            background:var(--primary);color:#ffffff;transition:all 0.3s ease;
            text-transform:uppercase;font-size:0.7rem;white-space:nowrap;
            overflow:hidden;text-overflow:ellipsis;max-width:100%;box-sizing:border-box;
            box-shadow:var(--shadow-3d-base);
        }
        .btn-sm:hover{background:var(--primary-dark);transform:scale(1.05); box-shadow:var(--shadow-3d-hover)}
        .btn-sm:disabled{opacity:0.6;cursor:not-allowed}
        
        /* Responsive */
        @media (max-width:1024px){
            .agents-table table{min-width:900px}
            .agents-table th, .agents-table td{padding:12px 8px}
        }
        @media (max-width:768px){
            .agents-hero{flex-direction:column;align-items:flex-start;padding:16px}
            .agents-hero .controls{width:100%;justify-content:stretch}
            .agents-table{padding:16px}
            .agents-table table{min-width:800px;font-size:12px}
            .agents-table th, .agents-table td{padding:8px 6px}
            .search{min-width:160px;flex:1}
            .btn{flex-shrink:0}
            .btn-sm{font-size:0.65rem;padding:4px 8px}
            .badge-status{font-size:9px;padding:2px 6px;max-width:80px}
            .pager{gap:6px}
            .pager button{padding:6px 10px;min-width:36px}
        }
        @media (max-width:480px){
            .agents-hero{padding:12px}
            .agents-hero .controls{flex-direction:column;gap:8px}
            .search, .btn{width:100%}
            .agents-table{padding:12px;margin:0 -4px}
            .agents-table-container{margin:16px -12px 0;border-radius:0}
            .agents-table table{min-width:700px;font-size:11px}
            .agents-table th, .agents-table td{padding:6px 4px}
            .status-col{min-width:90px !important;width:90px}
            .btn-col{min-width:80px !important;width:80px}
            .pager{gap:4px}
            .pager button{padding:4px 8px;min-width:32px;font-size:12px}
        }
    </style>

    <div class="agents-hero">
        <div>
            <h2 id="agents-title">Agents</h2>
            <div class="muted">Liste des agents — pagination optionnelle</div>
        </div>
        <div class="controls">
            <input id="agentsSearch" class="search" placeholder="Rechercher nom, email ou commande...">
            <button id="agentsReload" class="btn">Recharger</button>
        </div>
    </div>

    <div class="agents-table">
        <div class="agents-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Inscrit</th>
                        <th>Dernière commande</th>
                        <th>Livraisons</th>
                        <th>Gains</th>
                        <th>Note</th>
                        <th class="status-col">Statut</th>
                        <th class="btn-col"></th>
                    </tr>
                </thead>
                <tbody id="agentsBody"><tr><td colspan="10" class="muted">Chargement...</td></tr></tbody>
            </table>
        </div>
        <div id="agentsPagination" class="pager" aria-hidden="true"></div>
    </div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `../backend/agents/adm`;
        let lastData = null;

        function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
        function fmtDate(s){ if(!s) return '-'; try{ return new Date(s.replace(' ','T')).toLocaleString(); }catch(e){ return s } }
        function fmtNum(n){ if(n===null||n===undefined) return '0'; return Number(n).toLocaleString(); }

        async function fetchAgents(page=null, search=''){
            // backend may accept path-segment pagination or simple unpaged endpoint
            let url;
            if (page){
                url = `${base}/${univ}/page/${page}` + (search? `/${encodeURIComponent(search)}` : '');
            } else {
                url = `${base}/${univ}` + (search? `/search/${encodeURIComponent(search)}` : '');
            }
            try{
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                lastData = data;
                // data may present arrays under different keys: agents, orders, or agents.orders
                const list = data.agents || data.orders || (data.agents && data.agents.agents) || [];
                render(list, data.pagination || data);
            }catch(e){ document.getElementById('agentsBody').innerHTML = `<tr><td colspan="10" class="muted">Erreur: ${e.message}</td></tr>` }
        }

        function render(list, pagination){
            const body = document.getElementById('agentsBody'); body.innerHTML = '';
            if(!list || !list.length){ body.innerHTML = `<tr><td colspan="10" class="muted">Aucun agent</td></tr>`; renderPagination(null); return }
            for(const a of list){
                const tr = document.createElement('tr');
                const status = (a.status||'').toLowerCase();
                const badgeClass = status==='active' ? 'status-active' : 'status-inactive';
                tr.innerHTML = `
                    <td>${escape(a.id_unique)}</td>
                    <td>${escape(a.name)}</td>
                    <td>${escape(a.email)}</td>
                    <td class="muted">${fmtDate(a.date)}</td>
                    <td class="muted">${escape(a.id_commande||'-')}</td>
                    <td>${fmtNum(a.total_deliveries||a.total_orders||0)}</td>
                    <td>${a.total_earnings? fmtNum(a.total_earnings)+' FC':'-'}</td>
                    <td>${a.average_rating || '-'}</td>
                    <td><span class="badge-status ${badgeClass}">${escape(status||'inactive')}</span></td>
                    <td><button class="btn-sm" data-id="${escape(a.id_unique)}" data-status="${escape(status||'inactive')}">Basculer</button></td>
                `;
                body.appendChild(tr);
            }
            renderPagination(pagination);

            // attach toggle handlers
            body.querySelectorAll('button[data-id]').forEach(b=>{
                b.addEventListener('click', async ()=>{
                    const id = b.getAttribute('data-id');
                    const cur = b.getAttribute('data-status') || 'inactive';
                    const next = cur.toLowerCase()==='active' ? 'inactive' : 'active';
                    b.textContent = '…'; b.disabled = true;
                    try{
                        const putUrl = `/backend/agents/availability`;
                        const res = await fetch(putUrl, { method: 'PUT', headers: {'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify({ id: id, status: next }) });
                        const txt = await res.text(); const json = txt? JSON.parse(txt): {};
                        // refresh agents list for this university
                        await fetchAgents();
                    }catch(e){ alert('Erreur mise à jour: '+(e.message||e)); }
                    finally{ b.disabled = false }
                })
            })
        }

        function renderPagination(p){
            const el = document.getElementById('agentsPagination'); el.innerHTML = ''; if(!p || (!p.total_pages && !p.total_agents && !p.total)) { el.setAttribute('aria-hidden','true'); return }
            el.setAttribute('aria-hidden','false');
            const current = p.current_page || 1; const total = p.total_pages || p.total_agents || p.total || 1;
            // prev
            const prev = document.createElement('button'); prev.textContent = '<'; prev.disabled = current<=1; prev.addEventListener('click', ()=> fetchAgents(current-1, document.getElementById('agentsSearch').value||'')); el.appendChild(prev);
            // page numbers (show up to 5)
            const start = Math.max(1, current-2); const end = Math.min(total, start+4);
            for(let i=start;i<=end;i++){ const b=document.createElement('button'); b.textContent = i; if(i===current) b.style.fontWeight='800'; b.addEventListener('click', ()=> fetchAgents(i, document.getElementById('agentsSearch').value||'')); el.appendChild(b) }
            // next
            const next = document.createElement('button'); next.textContent = '>'; next.disabled = current>=total; next.addEventListener('click', ()=> fetchAgents(current+1, document.getElementById('agentsSearch').value||'')); el.appendChild(next);
        }

        document.getElementById('agentsReload').addEventListener('click', ()=> fetchAgents());
        let searchTimer = null; document.getElementById('agentsSearch').addEventListener('input', ()=>{ clearTimeout(searchTimer); searchTimer=setTimeout(()=> fetchAgents(null, document.getElementById('agentsSearch').value||''), 350); });

        // initial load
        fetchAgents();
    })();
    </script>
</section>
