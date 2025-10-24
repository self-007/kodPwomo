<?php
// Places admin page — CRUD for places per university
?>
<section aria-labelledby="places-title">
    <style>
        /* KodPwomo Places Styles */
        .places-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:linear-gradient(135deg, rgba(59,130,246,0.12), rgba(34,197,94,0.12));
            padding:20px 24px;border-radius:20px;border:1px solid rgba(59,130,246,0.18);
            box-shadow:0 20px 40px rgba(15,23,42,0.08);margin-bottom:20px
        }
        .places-hero h2{
            margin:0;font-weight:700;font-size:1.6rem;
            color:var(--primary-700, #1d4ed8)
        }
        .places-panel{display:grid;grid-template-columns:1fr 360px;gap:24px;margin-top:20px}
        .places-list{
            background:#fff;padding:24px;border-radius:20px;
            border:1px solid rgba(148,163,184,0.12);box-shadow:0 24px 48px rgba(15,23,42,0.08)
        }
        .table-header{
            display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;gap:12px
        }
        .places-form{
            background:#fff;padding:24px;border-radius:20px;
            border:1px solid rgba(59,130,246,0.18);box-shadow:0 24px 48px rgba(15,23,42,0.08);
            position:relative;overflow:hidden
        }
        .places-form::before{
            content:'';position:absolute;top:0;left:0;right:0;height:4px;
            background:linear-gradient(90deg, #3b82f6, #22c55e)
        }
        .places-list table{width:100%;border-collapse:collapse}
        .places-list thead{background:linear-gradient(135deg, #1d4ed8, #3b82f6);color:#fff}
        .places-list th{
            padding:16px 12px;text-align:left;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none
        }
        .places-list td{padding:14px 12px;border-bottom:1px solid rgba(148,163,184,0.18);color:#0f172a;font-weight:500;vertical-align:middle}
        .places-list tbody tr:nth-child(odd){background:rgba(59,130,246,0.05)}
        .places-list tbody tr:hover{
            background:rgba(34,197,94,0.08);
            transform:scale(1.01);transition:all 0.2s ease
        }
        .place-thumb{width:64px;height:48px;border-radius:12px;object-fit:cover;border:1px solid rgba(148,163,184,0.18)}
        .muted{color:#64748b}
        .input, textarea{
            width:100%;padding:12px;border:2px solid rgba(59,130,246,0.25);border-radius:12px;
            background:#f8fafc;transition:all 0.3s ease;font-family:inherit
        }
        .input:focus, textarea:focus{
            border-color:#3b82f6;outline:none;
            box-shadow:0 0 0 3px rgba(59,130,246,0.2)
        }
        .btn{
            padding:10px 16px;border-radius:12px;border:0;cursor:pointer;font-weight:600;
            text-transform:uppercase;font-size:0.85rem;transition:all 0.3s ease
        }
        .btn-primary{
            background:linear-gradient(135deg, #3b82f6, #2563eb);
            color:#fff;box-shadow:0 10px 25px rgba(37,99,235,0.25)
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 18px 32px rgba(37,99,235,0.25)}
        .btn-secondary{
            background:#fff;border:2px solid rgba(34,197,94,0.4);
            color:#16a34a
        }
        .btn-secondary:hover{background:rgba(34,197,94,0.08)}
        .btn-danger{
            background:linear-gradient(135deg, #f97316, #ea580c);
            color:#fff;box-shadow:0 10px 20px rgba(249,115,22,0.25)
        }
        .btn-danger:hover{transform:scale(1.05);box-shadow:0 14px 28px rgba(249,115,22,0.3)}
        @media (max-width:900px){ .places-panel{grid-template-columns:1fr;gap:20px} }
    </style>

    <div class="places-hero">
        <div>
            <h2 id="places-title">Places</h2>
            <div class="muted">Créer, modifier et supprimer des lieux (salles) par université</div>
        </div>
        <div>
            <small class="muted">Utilisez le formulaire pour créer une nouvelle place</small>
        </div>
    </div>

    <div class="places-panel">
        <div class="places-list">
            <div class="table-header">
                <h3 style="margin:0;font-weight:600;color:#0f172a">Salles enregistrées</h3>
            </div>
            <div style="overflow:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="placesBody">
                        <tr>
                            <td colspan="3" class="muted">Chargement...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `/kodpwomo/backend/places/adm`;

        function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

        async function fetchPlaces(){
            const url = `${base}/${univ}`;
            try{
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                render(data.places || []);
            }catch(e){ document.getElementById('placesBody').innerHTML = `<tr><td colspan="3" class="muted">Erreur: ${e.message}</td></tr>` }
        }

        function render(list){
            const body = document.getElementById('placesBody'); body.innerHTML = '';
            if(!list.length) { body.innerHTML = `<tr><td colspan="3" class="muted">Aucune place</td></tr>`; return }
            for(const p of list){
                const tr = document.createElement('tr');
                const imagePath = p.image ? `/kodpwomo/${p.image}`.replace('//','/') : null;
                const picture = imagePath ? `<img src="${escape(imagePath)}" alt="${escape(p.name||'Salle')}" class="place-thumb">` : `<div class="place-thumb" style="display:flex;align-items:center;justify-content:center;background:#e2e8f0;color:#1d4ed8;font-weight:700;">${(p.name||'?').slice(0,2).toUpperCase()}</div>`;
                tr.innerHTML = `
                    <td>${picture}</td>
                    <td>${escape(p.name)}</td>
                    <td>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <button class="btn btn-secondary" data-edit="${escape(p.id)}">Modifier</button>
                            <button class="btn btn-danger" data-delete="${escape(p.id)}">Supprimer</button>
                        </div>
                    </td>
                `;
                body.appendChild(tr);
            }

            // attach handlers
            body.querySelectorAll('button[data-edit]').forEach(b=> b.addEventListener('click', ()=> loadForEdit(b.getAttribute('data-edit'))));
            body.querySelectorAll('button[data-delete]').forEach(b=> b.addEventListener('click', ()=> removePlace(b.getAttribute('data-delete'))));
        }

        async function loadForEdit(id){
            try{
                const res = await fetch(`${base}/${univ}/${encodeURIComponent(id)}`, { headers:{'Accept':'application/json'} });
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                const p = data.place || data;
                alert(`Modifier: ${p.name}`); // Placeholder for edit functionality
            }catch(e){ alert('Erreur chargement: '+(e.message||e)); }
        }

        async function removePlace(id){
            if(!confirm('Confirmer suppression ?')) return;
            try{
                const res = await fetch(`${base}/${univ}/${encodeURIComponent(id)}`, { method: 'DELETE', headers:{'Accept':'application/json'} });
                await res.text();
                fetchPlaces();
            }catch(e){ alert('Erreur suppression: '+(e.message||e)); }
        }

        // initial load
        fetchPlaces();
    })();
    </script>

</section>
