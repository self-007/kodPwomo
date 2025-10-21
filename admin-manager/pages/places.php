<?php
// Places admin page — CRUD for places per university
?>
<section aria-labelledby="places-title">
    <style>
        /* KodPwomo Places Styles */
        .places-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:linear-gradient(135deg, var(--surface-elevated, #ffffff), var(--surface-container-low, #f8fafc));
            padding:20px 24px;border-radius:16px;border:2px solid var(--brand-danger, #FF7675);
            box-shadow:0 4px 12px rgba(255, 118, 117, 0.15);margin-bottom:20px
        }
        .places-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;
            background:linear-gradient(45deg, var(--brand-danger, #FF7675), var(--brand-primary, #FF6B6B));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text
        }
        .places-panel{display:grid;grid-template-columns:1fr 380px;gap:20px;margin-top:20px}
        .places-list{
            background:var(--surface-elevated, #ffffff);padding:20px;border-radius:16px;
            border:2px solid var(--brand-danger, #FF7675);box-shadow:0 8px 24px rgba(255, 118, 117, 0.15)
        }
        .places-form{
            background:var(--surface-elevated, #ffffff);padding:20px;border-radius:16px;
            border:2px solid var(--brand-primary, #FF6B6B);box-shadow:0 8px 24px rgba(255, 107, 107, 0.15);
            position:relative;overflow:hidden
        }
        .places-form::before{
            content:'';position:absolute;top:0;left:0;right:0;height:4px;
            background:linear-gradient(90deg, var(--brand-primary, #FF6B6B), var(--brand-danger, #FF7675))
        }
        .places-list table{width:100%;border-collapse:collapse}
        .places-list thead{background:linear-gradient(135deg, var(--brand-danger, #FF7675), var(--brand-primary, #FF6B6B))}
        .places-list th{
            padding:16px 12px;text-align:left;color:#ffffff;font-weight:700;
            text-transform:uppercase;letter-spacing:0.5px;border:none
        }
        .places-list td{padding:14px 12px;border-bottom:1px solid #ffecec;color:var(--on-surface, #0f172a);font-weight:500}
        .places-list tbody tr:nth-child(odd){background:linear-gradient(90deg, #fff5f5, #ffecec)}
        .places-list tbody tr:hover{
            background:linear-gradient(90deg, var(--primary-100, #fed7d7), #ffe4e4);
            transform:scale(1.01);transition:all 0.2s ease
        }
        .muted{color:var(--on-surface-muted, #64748b)}
        .input, textarea{
            width:100%;padding:12px;border:2px solid var(--brand-primary, #FF6B6B);border-radius:12px;
            background:var(--surface-elevated, #ffffff);transition:all 0.3s ease;font-family:inherit
        }
        .input:focus, textarea:focus{
            border-color:var(--brand-danger, #FF7675);outline:none;
            box-shadow:0 0 0 3px rgba(255, 118, 117, 0.2)
        }
        .btn{
            padding:10px 16px;border-radius:12px;border:0;cursor:pointer;font-weight:600;
            text-transform:uppercase;font-size:0.9rem;transition:all 0.3s ease
        }
        .btn-primary{
            background:linear-gradient(135deg, var(--brand-primary, #FF6B6B), var(--brand-danger, #FF7675));
            color:#fff;box-shadow:0 4px 12px rgba(255, 107, 107, 0.3)
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(255, 107, 107, 0.4)}
        .btn-secondary{
            background:var(--surface-elevated, #ffffff);border:2px solid var(--brand-primary, #FF6B6B);
            color:var(--brand-primary, #FF6B6B)
        }
        .btn-secondary:hover{background:var(--primary-50, #fff5f5)}
        .btn-danger{
            background:linear-gradient(135deg, var(--brand-danger, #FF7675), #ff4757);
            color:#fff;box-shadow:0 3px 8px rgba(255, 118, 117, 0.3)
        }
        .btn-danger:hover{transform:scale(1.05);box-shadow:0 4px 12px rgba(255, 118, 117, 0.4)}
        @media (max-width:900px){ .places-panel{grid-template-columns:1fr;gap:16px} }
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
            <div style="overflow:auto">
                <table>
                    <thead><tr><th>ID</th><th>Nom</th><th>Type</th><th>Capacité</th><th></th></tr></thead>
                    <tbody id="placesBody"><tr><td colspan="5" class="muted">Chargement...</td></tr></tbody>
                </table>
            </div>
        </div>

        <div class="places-form">
            <h3>Créer / Modifier</h3>
            <div style="display:grid;gap:8px">
                <input id="placeId" type="hidden">
                <label>Nom <input id="placeName" class="input" placeholder="Ex: Amphithéâtre A"></label>
                <label>Type <input id="placeType" class="input" placeholder="Ex: Amphithéâtre / Salle"></label>
                <label>Capacité <input id="placeCapacity" class="input" type="number" min="0" placeholder="0"></label>
                <div style="display:flex;gap:8px">
                    <button id="placeSave" class="btn btn-primary">Enregistrer</button>
                    <button id="placeReset" class="btn">Réinitialiser</button>
                </div>
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
            }catch(e){ document.getElementById('placesBody').innerHTML = `<tr><td colspan="5" class="muted">Erreur: ${e.message}</td></tr>` }
        }

        function render(list){
            const body = document.getElementById('placesBody'); body.innerHTML = '';
            if(!list.length) { body.innerHTML = `<tr><td colspan="5" class="muted">Aucune place</td></tr>`; return }
            for(const p of list){
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escape(p.id)}</td>
                    <td>${escape(p.name)}</td>
                    <td>${escape(p.type||'')}</td>
                    <td>${escape(p.capacity||'')}</td>
                    <td>
                        <button class="btn" data-edit="${escape(p.id)}">Modifier</button>
                        <button class="btn" data-delete="${escape(p.id)}">Supprimer</button>
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
                document.getElementById('placeId').value = p.id || '';
                document.getElementById('placeName').value = p.name || '';
                document.getElementById('placeType').value = p.type || '';
                document.getElementById('placeCapacity').value = p.capacity || '';
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

        async function savePlace(){
            const id = document.getElementById('placeId').value || null;
            const body = { name: document.getElementById('placeName').value || '', type: document.getElementById('placeType').value || '', capacity: Number(document.getElementById('placeCapacity').value) || 0 };
            try{
                if(id){
                    const res = await fetch(`${base}/${univ}/${encodeURIComponent(id)}`, { method:'PUT', headers:{'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify(body) });
                    await res.text();
                } else {
                    const res = await fetch(`${base}/${univ}`, { method:'POST', headers:{'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify(body) });
                    await res.text();
                }
                resetForm(); fetchPlaces();
            }catch(e){ alert('Erreur sauvegarde: '+(e.message||e)); }
        }

        function resetForm(){ document.getElementById('placeId').value=''; document.getElementById('placeName').value=''; document.getElementById('placeType').value=''; document.getElementById('placeCapacity').value=''; }

        document.getElementById('placeSave').addEventListener('click', savePlace);
        document.getElementById('placeReset').addEventListener('click', resetForm);

        // initial load
        fetchPlaces();
    })();
    </script>

</section>
