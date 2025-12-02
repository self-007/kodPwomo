<?php
// Settings admin page — view and edit university settings (GET + PUT)
?>
<section aria-labelledby="settings-title">
    <style>
        /* KodPwomo Settings Styles - Unified Neumorphic Palette */
        :root{
            --primary: #f7b642;
            --primary-dark: #e19627;
            --secondary: #27ae60;
            --secondary-dark: #229954;
            --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
            --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
        }
        .settings-hero{
            background:#ffffff;
            padding:20px 24px;border-radius:16px;border:2px solid #e2e8f0;
            box-shadow:var(--shadow-3d-base);margin-bottom:20px;border-left:4px solid var(--primary);
            transition:all .25s ease;
        }
        .settings-hero:hover{box-shadow:var(--shadow-3d-hover);transform:translateY(-2px);}
        .settings-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;
            color:var(--primary);
        }
        .settings-card{
            background:#ffffff;padding:24px;border-radius:16px;
            border:2px solid #e2e8f0;max-width:900px;
            box-shadow:var(--shadow-3d-base);position:relative;overflow:hidden;transition:all .25s ease;
        }
        .settings-card:hover{box-shadow:var(--shadow-3d-hover);}
        .settings-card::before{
            content:'';position:absolute;top:0;left:0;right:0;height:4px;
            background:var(--primary);
        }
        .settings-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .input, textarea, select{
            width:100%;padding:12px;border:2px solid #e2e8f0;border-radius:12px;
            background:#ffffff;transition:all 0.3s ease;font-family:inherit;box-shadow:var(--shadow-3d-base);
        }
        .input:focus, textarea:focus, select:focus{
            border-color:var(--primary);outline:none;
            box-shadow:var(--shadow-3d-hover);
        }
        label{
            display:block;color:#1a1a2e;font-weight:600;margin-bottom:6px;
            font-size:0.95rem
        }
        .muted{color:#64748b}
        .btn{
            padding:12px 20px;border-radius:12px;border:0;cursor:pointer;font-weight:600;
            text-transform:uppercase;font-size:0.9rem;transition:all 0.3s ease;margin-top:16px;
            box-shadow:var(--shadow-3d-base);
        }
        .btn-primary{
            background:var(--primary);
            color:#fff;
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:var(--shadow-3d-hover);background:var(--primary-dark);}
        .btn-secondary{
            background:#ffffff;border:2px solid #64748b;
            color:#64748b
        }
        .btn-secondary:hover{background:#f8fafc;box-shadow:var(--shadow-3d-hover);transform:translateY(-2px);}
        @media (max-width:700px){ .settings-row{grid-template-columns:1fr} }
    </style>

    <div class="settings-hero">
        <h2 id="settings-title">Settings</h2>
        <div class="muted">Configuration de l'université — modifiez et enregistrez</div>
    </div>

    <div style="margin-top:12px" class="settings-card">
        <div style="display:grid;gap:10px">
            <div class="settings-row">
                <label>Nom du site <input id="s_siteName" class="input"></label>
                <label>Devise <input id="s_currency" class="input" placeholder="FC"></label>
            </div>
            <div class="settings-row">
                <label>Email contact <input id="s_contactEmail" class="input" placeholder="contact@exemple.com"></label>
                <label>Téléphone support <input id="s_supportPhone" class="input" placeholder="+243 81 ..."></label>
            </div>
            <label>Autoriser commandes invitées
                <select id="s_allowGuest" class="input"><option value="1">Oui</option><option value="0">Non</option></select>
            </label>

            <div style="display:flex;gap:8px">
                <button id="sSave" class="btn btn-primary">Enregistrer</button>
                <button id="sReset" class="btn">Réinitialiser</button>
            </div>
        </div>
    </div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `/backend/settings/adm`;

        function setValues(o){ document.getElementById('s_siteName').value = o.site_name || ''; document.getElementById('s_currency').value = o.currency || 'FC'; document.getElementById('s_contactEmail').value = o.contact_email || ''; document.getElementById('s_supportPhone').value = o.support_phone || ''; document.getElementById('s_allowGuest').value = (o.allow_guest_orders?1:0); }

        async function load(){
            try{
                const res = await fetch(`${base}/${univ}`, { headers:{'Accept':'application/json'} });
                const txt = await res.text(); if(!txt) throw new Error('empty');
                const data = JSON.parse(txt);
                setValues(data.settings || data || {});
            }catch(e){ alert('Erreur chargement paramètres: '+(e.message||e)); }
        }

        async function save(){
            const payload = { site_name: document.getElementById('s_siteName').value||'', currency: document.getElementById('s_currency').value||'FC', contact_email: document.getElementById('s_contactEmail').value||'', support_phone: document.getElementById('s_supportPhone').value||'', allow_guest_orders: Number(document.getElementById('s_allowGuest').value) };
            try{
                const res = await fetch(`${base}/${univ}`, { method:'PUT', headers:{'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify(payload) });
                await res.text(); alert('Paramètres enregistrés');
            }catch(e){ alert('Erreur sauvegarde: '+(e.message||e)); }
        }

        document.getElementById('sSave').addEventListener('click', save);
        document.getElementById('sReset').addEventListener('click', load);

        // init
        load();
    })();
    </script>

</section>
