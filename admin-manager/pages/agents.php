<?php
// Agents admin page — lists agents, supports pagination and status toggle via PUT
?>
<section aria-labelledby="agents-title">
    <style>
        /* KodPwomo Agents Styles */
        .agents-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:linear-gradient(135deg, var(--surface-elevated, #ffffff), var(--surface-container-low, #f8fafc));
            padding:20px 24px;border-radius:16px;border:2px solid var(--brand-info, #74B9FF);
            box-shadow:0 4px 12px rgba(116, 185, 255, 0.15);margin-bottom:20px;flex-wrap:wrap;
        }
        .agents-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;
            background:linear-gradient(45deg, var(--brand-info, #74B9FF), var(--brand-accent, #45B7D1));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text
        }
        .agents-hero .controls{
            display:flex;gap:8px;align-items:center;flex-wrap:wrap;
        }
        .agents-table{
            margin-top:20px;background:var(--surface-elevated, #ffffff);padding:20px;border-radius:16px;
            border:2px solid var(--brand-info, #74B9FF);box-shadow:0 8px 24px rgba(116, 185, 255, 0.15)
        }
        .agents-table-container{
            overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;margin-top:16px;
        }
        .agents-table table{width:100%;border-collapse:collapse;min-width:1000px}
        .agents-table thead{background:linear-gradient(135deg, var(--brand-info, #74B9FF), var(--brand-accent, #45B7D1))}
        .agents-table th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none;white-space:nowrap;
        }
        .agents-table .status-col{min-width:120px;width:120px}
        .agents-table .btn-col{min-width:100px;width:100px;text-align:center}
        .agents-table td{
            padding:14px 12px;border-bottom:1px solid var(--accent-100, #dbeafe);
            color:var(--on-surface, #0f172a);font-weight:500;white-space:nowrap;
        }
        .agents-table tbody tr:nth-child(odd){background:linear-gradient(90deg, var(--accent-50, #eff6ff), #f8faff)}
        .agents-table tbody tr:hover{
            background:linear-gradient(90deg, var(--accent-100, #dbeafe), var(--secondary-100, #ccfbf1));
            transform:scale(1.01);transition:all 0.2s ease
        }
        .muted{color:var(--on-surface-muted, #64748b)}
        .search{
            padding:10px 12px;border-radius:12px;border:2px solid var(--brand-info, #74B9FF);
            background:var(--surface-elevated, #ffffff);transition:all 0.3s ease;min-width:200px;
            box-sizing:border-box;
        }
        .search:focus{border-color:var(--brand-accent, #45B7D1);outline:none;box-shadow:0 0 0 3px rgba(69, 183, 209, 0.2)}
        .btn{
            padding:8px 16px;border-radius:12px;border:2px solid var(--brand-info, #74B9FF);
            background:var(--accent-100, #dbeafe);color:var(--brand-info, #74B9FF);
            font-weight:600;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;
            box-sizing:border-box;
        }
        .btn:hover{background:var(--brand-info, #74B9FF);color:#ffffff;transform:scale(1.05)}
        .pager{
            display:flex;gap:10px;align-items:center;margin-top:16px;justify-content:center;
            flex-wrap:wrap;
        }
        .pager button{
            padding:8px 12px;border-radius:12px;border:0;
            background:linear-gradient(135deg, var(--surface-elevated, #ffffff), var(--surface-container-low, #f8fafc));
            color:var(--brand-info, #74B9FF);cursor:pointer;font-weight:600;
            border:2px solid var(--brand-info, #74B9FF);transition:all 0.3s ease;
            min-width:40px;
        }
        .pager button:hover{
            background:linear-gradient(135deg, var(--brand-info, #74B9FF), var(--brand-accent, #45B7D1));
            color:#fff;transform:translateY(-2px)
        }
        .badge-status{
            padding:4px 10px;border-radius:16px;font-weight:600;font-size:10px;
            text-transform:uppercase;letter-spacing:0.3px;box-shadow:0 2px 6px rgba(0,0,0,0.1);
            white-space:nowrap;max-width:100px;overflow:hidden;text-overflow:ellipsis;
        }
        .status-active{
            background:linear-gradient(135deg, var(--success-100, #dcfce7), var(--success-50, #f0fdf4));
            color:var(--brand-success, #96CEB4);border:2px solid var(--brand-success, #96CEB4)
        }
        .status-active::before{content:'🟢';margin-right:4px}
        .status-inactive{
            background:linear-gradient(135deg, var(--warning-100, #fef3c7), var(--warning-50, #fffbeb));
            color:var(--brand-warning, #FFEAA7);border:2px solid var(--brand-warning, #FFEAA7)
        }
        .status-inactive::before{content:'🟡';margin-right:4px}
        .btn-sm{
            padding:6px 10px;border-radius:8px;border:0;cursor:pointer;font-weight:600;
            background:linear-gradient(135deg, var(--brand-info, #74B9FF), var(--brand-accent, #45B7D1));
            color:#fff;transition:all 0.3s ease;text-transform:uppercase;font-size:0.7rem;
            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%;
            box-sizing:border-box;
        }
        .btn-sm:hover{transform:scale(1.05)}
        
        /* Enhanced Responsive Design */
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
        const base = `/kodpwomo/backend/agents/adm`;
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
                        const putUrl = `/kodpwomo/backend/agents/availability`;
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
