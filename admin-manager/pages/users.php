<?php
// Users admin page — lists users and allows status updates via PUT
?>
<section aria-labelledby="users-title">
    <style>
        /* KodPwomo Users Styles */
        .users-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:linear-gradient(135deg, var(--surface-elevated, #ffffff), var(--surface-container-low, #f8fafc));
            padding:20px 24px;border-radius:16px;border:2px solid var(--brand-secondary, #4ECDC4);
            box-shadow:0 4px 12px rgba(78, 205, 196, 0.15);margin-bottom:20px;
            flex-wrap:wrap;
        }
        .users-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;
            background:linear-gradient(45deg, var(--brand-secondary, #4ECDC4), var(--brand-accent, #45B7D1));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text
        }
        .users-hero .controls{
            display:flex;gap:8px;align-items:center;flex-wrap:wrap;
        }
        .users-table{
            margin-top:20px;background:var(--surface-elevated, #ffffff);padding:20px;border-radius:16px;
            border:2px solid var(--brand-secondary, #4ECDC4);box-shadow:0 8px 24px rgba(78, 205, 196, 0.15)
        }
        .users-table-container{
            overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;margin-top:16px;
        }
    .users-table table{width:100%;border-collapse:collapse;min-width:900px}
        .users-table thead{background:linear-gradient(135deg, var(--brand-secondary, #4ECDC4), var(--brand-accent, #45B7D1))}
        .users-table th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none;white-space:nowrap;
        }
        .users-table .status-col{min-width:120px;width:120px}
        .users-table .btn-col{min-width:100px;width:100px;text-align:center}
        .users-table td{
            padding:14px 12px;border-bottom:1px solid var(--secondary-100, #ccfbf1);
            color:var(--on-surface, #0f172a);font-weight:500;white-space:nowrap;
        }
        .users-table tbody tr:nth-child(odd){background:linear-gradient(90deg, var(--secondary-50, #f0fdfa), var(--accent-50, #eff6ff))}
        .users-table tbody tr:hover{
            background:linear-gradient(90deg, var(--secondary-100, #ccfbf1), var(--accent-100, #dbeafe));
            transform:scale(1.01);transition:all 0.2s ease
        }
        .btn-sm{
            padding:6px 10px;border-radius:8px;border:0;cursor:pointer;font-weight:600;
            text-transform:uppercase;font-size:0.7rem;transition:all 0.3s ease;
            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%;
            box-sizing:border-box;
        }
        .btn-role{
            background:linear-gradient(135deg, var(--secondary-100, #ccfbf1), var(--secondary-50, #f0fdfa));
            color:var(--brand-secondary, #4ECDC4);border:2px solid rgba(78,205,196,0.35);
        }
        .btn-role:hover{transform:scale(1.05);background:var(--brand-secondary, #4ECDC4);color:#fff}
        .btn-active{
            background:linear-gradient(135deg, var(--success-100, #dcfce7), var(--success-50, #f0fdf4));
            color:var(--brand-success, #96CEB4);border:2px solid var(--brand-success, #96CEB4);
            box-shadow:0 2px 6px rgba(150, 206, 180, 0.3)
        }
        .btn-active::before{content:'✅';margin-right:4px}
        .btn-active:hover{transform:scale(1.05)}
        .btn-inactive{
            background:linear-gradient(135deg, var(--warning-100, #fef3c7), var(--warning-50, #fffbeb));
            color:var(--brand-warning, #FFEAA7);border:2px solid var(--brand-warning, #FFEAA7);
            box-shadow:0 2px 6px rgba(255, 234, 167, 0.3)
        }
        .btn-inactive::before{content:'⏸️';margin-right:4px}
        .btn-inactive:hover{transform:scale(1.05)}
        .badge-status{
            display:inline-flex;align-items:center;padding:4px 8px;border-radius:12px;
            font-size:10px;font-weight:600;text-transform:uppercase;white-space:nowrap;
            max-width:100px;overflow:hidden;text-overflow:ellipsis;
        }
        .muted{color:var(--on-surface-muted, #64748b)}
        .search{
            padding:10px 12px;border-radius:12px;border:2px solid var(--brand-secondary, #4ECDC4);
            background:var(--surface-elevated, #ffffff);transition:all 0.3s ease;min-width:180px;
            box-sizing:border-box;
        }
        .search:focus{border-color:var(--brand-accent, #45B7D1);outline:none;box-shadow:0 0 0 3px rgba(69, 183, 209, 0.2)}
        .btn{
            padding:8px 16px;border-radius:12px;border:2px solid var(--brand-accent, #45B7D1);
            background:var(--accent-100, #dbeafe);color:var(--brand-accent, #45B7D1);
            font-weight:600;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;
            box-sizing:border-box;
        }
        .btn:hover{background:var(--brand-accent, #45B7D1);color:#ffffff;transform:scale(1.05)}
        
        /* Enhanced Responsive Design */
        @media (max-width:1024px){
            .users-table table{min-width:700px}
            .users-table th, .users-table td{padding:12px 8px}
        }
        @media (max-width:768px){
            .users-hero{flex-direction:column;align-items:flex-start;padding:16px}
            .users-hero .controls{width:100%;justify-content:stretch}
            .users-table{padding:16px}
            .users-table table{min-width:600px;font-size:12px}
            .users-table th, .users-table td{padding:8px 6px}
            .search{min-width:140px;flex:1}
            .btn{flex-shrink:0}
            .btn-sm{font-size:0.65rem;padding:4px 8px}
            .badge-status{font-size:9px;padding:2px 6px;max-width:80px}
        }
        @media (max-width:480px){
            .users-hero{padding:12px}
            .users-hero .controls{flex-direction:column;gap:8px}
            .search, .btn{width:100%}
            .users-table{padding:12px;margin:0 -4px}
            .users-table-container{margin:16px -12px 0;border-radius:0}
            .users-table table{min-width:500px;font-size:11px}
            .users-table th, .users-table td{padding:6px 4px}
            .status-col{min-width:90px !important;width:90px}
            .btn-col{min-width:80px !important;width:80px}
        }
    </style>

    <div class="users-hero">
        <div>
            <h2 id="users-title">Users</h2>
            <div class="muted">Gestion des utilisateurs — GET et PUT</div>
        </div>
        <div class="controls">
            <input id="usersSearch" class="search" placeholder="Rechercher nom ou email...">
            <button id="usersReload" class="btn">Recharger</button>
        </div>
    </div>

    <div class="users-table">
        <div class="users-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Inscrit</th>
                        <th>Commandes</th>
                        <th>Total dépensé</th>
                        <th>Rôle</th>
                        <th class="status-col">Statut</th>
                        <th class="btn-col"></th>
                    </tr>
                </thead>
                <tbody id="usersBody"><tr><td colspan="9" class="muted">Chargement...</td></tr></tbody>
            </table>
        </div>
    </div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `/kodpwomo/backend/users/adm`;

        async function fetchUsers(){
            const url = `${base}`;
            try{
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                render(data.users || []);
            }catch(e){ document.getElementById('usersBody').innerHTML = `<tr><td colspan="8" class="muted">Erreur: ${e.message}</td></tr>` }
        }

        function fmtDate(s){ if(!s) return '-'; try{ return new Date(s.replace(' ','T')).toLocaleString(); }catch(e){ return s } }
        function fmtNum(n){ if(n===null||n===undefined) return '0'; return Number(n).toLocaleString(); }
        function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

        function render(list){
            const body = document.getElementById('usersBody'); body.innerHTML = '';
            const q = (document.getElementById('usersSearch').value||'').trim().toLowerCase();
            const show = q ? list.filter(u => (u.name||'').toLowerCase().includes(q) || (u.email||'').toLowerCase().includes(q) || (u.id_unique||'').toLowerCase().includes(q)) : list;
            if(!show.length) { body.innerHTML = `<tr><td colspan="9" class="muted">Aucun utilisateur</td></tr>`; return }
            for(const u of show){
                const tr = document.createElement('tr');
                const status = (u.status||'').toLowerCase();
                const btnClass = status==='active' ? 'btn-active' : 'btn-inactive';
                const statusLabel = status || 'inactive';
                const roleLabel = (u.role || '').toLowerCase() || 'client';
                tr.innerHTML = `
                    <td>${escape(u.id_unique)}</td>
                    <td>${escape(u.name)}</td>
                    <td>${escape(u.email)}</td>
                    <td class="small muted">${fmtDate(u.date)}</td>
                    <td>${fmtNum(u.total_orders||0)}</td>
                    <td>${u.total_spent? fmtNum(u.total_spent)+' FC' : '-'}</td>
                    <td>${escape(roleLabel)}</td>
                    <td><span class="badge-status ${btnClass}">${escape(statusLabel)}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end;">
                            <button class="btn-sm" data-id="${escape(u.id_unique)}" data-status="${escape(statusLabel)}">Basculer</button>
                            <button class="btn-sm btn-role" data-role="agent" data-id="${escape(u.id_unique)}">Nommer agent</button>
                        </div>
                    </td>
                `;
                body.appendChild(tr);
            }

            // attach handlers for toggle
            body.querySelectorAll('button[data-id]').forEach(b=>{
                if(b.classList.contains('btn-role')){
                    return;
                }
                b.addEventListener('click', async ()=>{
                    const id = b.getAttribute('data-id');
                    const cur = b.getAttribute('data-status') || 'inactive';
                    const next = cur.toLowerCase()==='active' ? 'inactive' : 'active';
                    b.textContent = '…'; b.disabled = true;
                    try{
                        const putUrl = `/kodpwomo/backend/users/status`;
                        const res = await fetch(putUrl, { method: 'PUT', headers: {'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify({ id: id, status: next }) });
                        await res.text();
                        await fetchUsers();
                    }catch(e){ alert('Erreur mise à jour: '+(e.message||e)); }
                    finally{ b.disabled = false }
                })
            })

            body.querySelectorAll('button.btn-role').forEach(btn=>{
                btn.addEventListener('click', async ()=>{
                    const id = btn.getAttribute('data-id');
                    const role = btn.getAttribute('data-role') || 'agent';
                    btn.textContent = '…'; btn.disabled = true;
                    try{
                        const res = await fetch(`/kodpwomo/backend/user/role`, {
                            method: 'PUT',
                            headers: {'Content-Type':'application/json','Accept':'application/json'},
                            body: JSON.stringify({ id: id, role: role })
                        });
                        await res.text();
                        await fetchUsers();
                    }catch(e){ alert('Erreur attribution rôle: '+(e.message||e)); }
                    finally{ btn.disabled = false; btn.textContent = 'Nommer agent'; }
                });
            });
        }

        document.getElementById('usersReload').addEventListener('click', fetchUsers);
        document.getElementById('usersSearch').addEventListener('input', ()=> fetchUsers());

        // initial load
        fetchUsers();
    })();
    </script>
</section>
