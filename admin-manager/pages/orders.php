<?php
// Orders admin page — list orders by university, supports pagination and simple status display
?>
<section aria-labelledby="orders-title">
    <style>
        /* KodPwomo Orders Styles - Unified Green Palette */
        .orders-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:#ffffff;padding:20px 24px;border-radius:16px;border:1px solid #e2e8f0;
            box-shadow:0 1px 3px rgba(0,0,0,0.05);margin-bottom:20px;flex-wrap:wrap;
            border-left:4px solid var(--primary);
        }
        .orders-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;color:var(--primary);
        }
        .orders-hero .controls{
            display:flex;gap:8px;align-items:center;flex-wrap:wrap;
        }
        .orders-table{
            margin-top:20px;background:#ffffff;padding:20px;border-radius:16px;
            border:1px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.05);
            border-left:4px solid var(--primary);
        }
        .orders-table-container{
            overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;margin-top:16px;
        }
        .orders-table table{width:100%;border-collapse:collapse;min-width:1000px}
        .orders-table thead{background:var(--primary)}
        .orders-table th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none;white-space:nowrap;
        }
        .orders-table .status-col{min-width:120px;width:120px}
        .orders-table td{
            padding:14px 12px;border-bottom:1px solid #f1f5f9;
            color:#475569;font-weight:500;white-space:nowrap;
        }
        .orders-table tbody tr:nth-child(odd){background:#f8fafc}
        .orders-table tbody tr:hover{
            background:#f0fdf4;transition:all 0.2s ease
        }
        .search{
            padding:10px 12px;border-radius:12px;border:2px solid #e2e8f0;
            background:#ffffff;transition:all 0.3s ease;min-width:200px;
            box-sizing:border-box;
        }
        .search:focus{border-color:var(--primary);outline:none;box-shadow:0 0 0 3px rgba(39,174,96,0.1)}
        .btn{
            padding:8px 16px;border-radius:12px;border:2px solid var(--primary);
            background:#ffffff;color:var(--primary);
            font-weight:600;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;
            box-sizing:border-box;
        }
        .btn:hover{background:var(--primary);color:#ffffff;transform:scale(1.05)}
        .muted{color:#64748b}
        .pager{
            display:flex;gap:10px;align-items:center;margin-top:16px;justify-content:center;
            flex-wrap:wrap;
        }
        .pager button{
            padding:8px 12px;border-radius:12px;border:2px solid var(--primary);
            background:#ffffff;color:var(--primary);cursor:pointer;font-weight:600;
            transition:all 0.3s ease;min-width:40px;
        }
        .pager button:hover{
            background:var(--primary);color:#ffffff;transform:translateY(-2px)
        }
        .pager button:disabled{
            opacity:0.5;cursor:not-allowed
        }
        .tag{
            padding:4px 10px;border-radius:16px;font-weight:600;font-size:10px;
            text-transform:uppercase;letter-spacing:0.3px;
            white-space:nowrap;max-width:100px;overflow:hidden;text-overflow:ellipsis;
        }
        .tag-completed{
            background:#f0fdf4;color:var(--primary);border:1px solid var(--primary);
        }
        .tag-completed::before{content:'✅';margin-right:4px}
        .tag-processing{
            background:#fff5f0;color:#F39C12;border:1px solid #F39C12;
        }
        .tag-processing::before{content:'⏳';margin-right:4px}
        
        /* Responsive */
        @media (max-width:1024px){
            .orders-table table{min-width:900px}
            .orders-table th, .orders-table td{padding:12px 8px}
        }
        @media (max-width:768px){
            .orders-hero{flex-direction:column;align-items:flex-start;padding:16px}
            .orders-hero .controls{width:100%;justify-content:stretch}
            .orders-table{padding:16px}
            .orders-table table{min-width:800px;font-size:12px}
            .orders-table th, .orders-table td{padding:8px 6px}
            .search{min-width:160px;flex:1}
            .btn{flex-shrink:0}
            .tag{font-size:9px;padding:2px 6px;max-width:80px}
            .pager{gap:6px}
            .pager button{padding:6px 10px;min-width:36px}
        }
        @media (max-width:480px){
            .orders-hero{padding:12px}
            .orders-hero .controls{flex-direction:column;gap:8px}
            .search, .btn{width:100%}
            .orders-table{padding:12px;margin:0 -4px}
            .orders-table-container{margin:16px -12px 0;border-radius:0}
            .orders-table table{min-width:700px;font-size:11px}
            .orders-table th, .orders-table td{padding:6px 4px}
            .status-col{min-width:90px !important;width:90px}
            .pager{gap:4px}
            .pager button{padding:4px 8px;min-width:32px;font-size:12px}
        }
    </style>

    <div class="orders-hero">
        <div>
            <h2 id="orders-title">Orders</h2>
            <div class="muted">Liste des commandes par université — pagination</div>
        </div>
        <div class="controls">
            <input id="ordersSearch" class="search" placeholder="Rechercher commande / client...">
            <button id="ordersReload" class="btn">Recharger</button>
        </div>
    </div>

    <div class="orders-table">
        <div class="orders-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Client</th>
                        <th>Commande</th>
                        <th>Date</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Salle</th>
                        <th>Agent</th>
                        <th>Note</th>
                        <th class="status-col">Statut</th>
                    </tr>
                </thead>
                <tbody id="ordersBody"><tr><td colspan="10" class="muted">Chargement...</td></tr></tbody>
            </table>
        </div>
        <div id="ordersPagination" class="pager" aria-hidden="true"></div>
    </div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `/backend/orders/adm`;
        let lastData = null;

        function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
        function fmtDate(s){ if(!s) return '-'; try{ return new Date(s.replace(' ','T')).toLocaleString(); }catch(e){ return s } }
        function fmtNum(n){ if(n===null||n===undefined) return '0'; return Number(n).toLocaleString(); }

        async function fetchOrders(page=null, search=''){
            let url;
            if (page){ url = `${base}/${univ}/page/${page}` + (search? `/${encodeURIComponent(search)}` : ''); }
            else { url = `${base}/${univ}` + (search? `/search/${encodeURIComponent(search)}` : ''); }
            try{
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                lastData = data;
                const list = data.orders || [];
                render(list, data.pagination || data);
            }catch(e){ document.getElementById('ordersBody').innerHTML = `<tr><td colspan="10" class="muted">Erreur: ${e.message}</td></tr>` }
        }

        function render(list, pagination){
            const body = document.getElementById('ordersBody'); body.innerHTML = '';
            if(!list || !list.length){ body.innerHTML = `<tr><td colspan="10" class="muted">Aucune commande</td></tr>`; renderPagination(null); return }
            for(const o of list){
                const tr = document.createElement('tr');
                const status = (o.status||'').toLowerCase();
                const tagClass = status==='completed' ? 'tag-completed' : 'tag-processing';
                tr.innerHTML = `
                    <td>${escape(o.product_name||'')}</td>
                    <td>${escape(o.user_name||'')}</td>
                    <td>${escape(o.order_id||'')}</td>
                    <td class="muted">${fmtDate(o.date)}</td>
                    <td>${fmtNum(o.qnt||0)}</td>
                    <td>${fmtNum(o.price||0)} FC</td>
                    <td>${escape(o.salle_name||'')}</td>
                    <td>${escape(o.agent_name||o.id_agent||'-')}</td>
                    <td>${o.note||'-'}</td>
                    <td><span class="tag ${tagClass}">${escape(o.status||'processing')}</span></td>
                `;
                body.appendChild(tr);
            }
            renderPagination(pagination);
        }

        function renderPagination(p){
            const el = document.getElementById('ordersPagination'); el.innerHTML=''; if(!p || (!p.total_pages && !p.total && !p.total_orders)) { el.setAttribute('aria-hidden','true'); return }
            el.setAttribute('aria-hidden','false');
            const current = p.current_page || 1; const total = p.total_pages || p.total_orders || p.total || 1;
            const prev=document.createElement('button'); prev.textContent='<'; prev.disabled=current<=1; prev.addEventListener('click', ()=> fetchOrders(current-1, document.getElementById('ordersSearch').value||'')); el.appendChild(prev);
            const start=Math.max(1,current-2); const end=Math.min(total,start+4);
            for(let i=start;i<=end;i++){ const b=document.createElement('button'); b.textContent=i; if(i===current) b.style.fontWeight='800'; b.addEventListener('click', ()=> fetchOrders(i, document.getElementById('ordersSearch').value||'')); el.appendChild(b) }
            const next=document.createElement('button'); next.textContent='>'; next.disabled=current>=total; next.addEventListener('click', ()=> fetchOrders(current+1, document.getElementById('ordersSearch').value||'')); el.appendChild(next);
        }

        document.getElementById('ordersReload').addEventListener('click', ()=> fetchOrders());
        let ordTimer=null; document.getElementById('ordersSearch').addEventListener('input', ()=>{ clearTimeout(ordTimer); ordTimer=setTimeout(()=> fetchOrders(null, document.getElementById('ordersSearch').value||''), 300); });

        // initial load
        fetchOrders();
    })();
    </script>
</section>
