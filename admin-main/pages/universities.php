<?php
// /c:/wamp64/www/kodPwomo/admin-main/pages/universities.php
// Minimal admin page for managing universities. Expects JSON API under /kodpwomo/backend/university/*
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Administration — Universités</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <style>
        /* Minimal styling matching wm-* classes used elsewhere */
        .wm-toolbar { display:flex; justify-content:flex-end; margin:12px 0; background:linear-gradient(90deg,#2563eb 60%,#1b8eb7 100%); padding:18px 0 18px 0; border-radius:10px; box-shadow:0 2px 12px #0001; }
        .wm-btn { padding:8px 12px; border-radius:4px; border:1px solid #ccc; background:#f5f5f5; cursor:pointer; font-weight:500; }
        .wm-btn-primary { background:#2563eb; color:#fff; border-color:#1e40af; }
        .wm-btn-edit { background:#f59e0b; color:#fff; border-color:#b45309; }
        .wm-btn-delete { background:#ef4444; color:#fff; border-color:#b91c1c; }
        .table-responsive { overflow:auto; margin-top:24px; }
        table { width:100%; border-collapse:separate; border-spacing:0; font-family:Arial,Helvetica,sans-serif; border-radius:12px; overflow:hidden; box-shadow:0 4px 24px #0002; background:#fff; }
        th, td { padding:10px 12px; border-bottom:1px solid #e0e7ef; text-align:left; vertical-align:middle; }
        .action-btns { display:flex; gap:0.5rem; }
        .img-modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.7); display:flex; align-items:center; justify-content:center; z-index:10000; }
        .img-modal-content { background:#fff; border-radius:10px; padding:18px; box-shadow:0 8px 32px #0005; display:flex; flex-direction:column; align-items:center; }
        .img-modal-content img { max-width:80vw; max-height:70vh; border-radius:8px; box-shadow:0 2px 12px #0003; }
        .img-modal-close { margin-top:12px; background:#ef4444; color:#fff; border:none; border-radius:4px; padding:8px 18px; font-size:1.1rem; cursor:pointer; }
        th { background:linear-gradient(90deg,#1b8eb7 60%,#2563eb 100%); color:#fff; font-weight:700; font-size:1rem; border-bottom:2px solid #1b8eb7; }
        tr:nth-child(even) td { background:#f3f8fc; }
        tr:hover td { background:#eaf6fb; }
        img.thumb { max-width:60px; max-height:40px; object-fit:cover; border-radius:4px; border:2px solid #1b8eb7; background:#fff; }
        /* simple modal */
        .modal-backdrop { position:fixed; inset:0;background:rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; z-index:9999; }
        .modal { background:#fff; padding:18px; border-radius:8px; width:420px; max-width:95%; box-shadow:0 6px 22px rgba(0,0,0,0.2); }
        .modal h2 { margin:0 0 12px 0; font-size:18px; }
        .form-row { margin-bottom:10px; display:flex; flex-direction:column; }
        .form-row label { font-size:13px; margin-bottom:6px; color:#333; }
        .form-row input, .form-row select { padding:8px; border:1px solid #ccc; border-radius:4px; font-size:14px; }
        .modal-actions { display:flex; justify-content:flex-end; gap:8px; margin-top:12px; }
        .hidden { display:none; }
        .muted { color:#666; font-size:13px; }

        /* Modal header for university modal */
        .modal-header-uni {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg,#2563eb 60%,#1b8eb7 100%);
            color: #fff;
            padding: 1.1rem 1.5rem 0.7rem 1.5rem;
            border-radius: 8px 8px 0 0;
            margin: -18px -18px 18px -18px;
            box-shadow: 0 2px 8px #0001;
        }
        .modal-header-uni h2 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            color: #fff;
            letter-spacing: 0.5px;
        }
        .modal-close-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            cursor: pointer;
            line-height: 1;
            padding: 0 0.5rem;
            transition: color 0.2s;
        }
        .modal-close-btn:hover {
            color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="wm-toolbar">
        <button id="btn-add-university" class="wm-btn wm-btn-primary">Ajouter une université</button>
    </div>

    <div class="table-responsive">
        <table id="university-list" aria-label="Liste des universités">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Zone</th>
                    <th>Image</th>
                    <th>Produits</th>
                    <th>Espaces</th>
                    <th>Livraisons</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rempli dynamiquement via JS -->
            </tbody>
        </table>
    </div>

    <!-- Modal add/edit -->
    <div id="university-modal" class="hidden" role="dialog" aria-modal="true">
        <div class="modal-backdrop" id="university-modal-backdrop">
            <div class="modal" role="document" aria-labelledby="university-modal-title">
                <div class="modal-header-uni">
                    <h2 id="university-modal-title">Ajouter / Modifier une université</h2>
                    <button type="button" class="modal-close-btn" id="modal-close-btn" title="Fermer">&times;</button>
                </div>
                <form id="university-form">
                    <input type="hidden" id="university-id" name="id" value="" />
                    <div class="form-row">
                        <label for="university-name">Nom</label>
                        <input id="university-name" name="name" type="text" required />
                    </div>
                    <div class="form-row">
                        <label for="university-zone">Zone</label>
                        <input id="university-zone" name="zone" type="text" />
                    </div>
                    <div class="form-row">
                        <label for="university-image-file">Image (upload)</label>
                        <input id="university-image-file" name="image_file" type="file" accept="image/*" />
                        <div class="muted">Choisissez une image à uploader (optionnel).</div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" id="university-cancel" class="wm-btn">Annuler</button>
                        <button type="submit" id="university-save" class="wm-btn wm-btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // GitHub Copilot style JS: robust, defensive, minimal dependencies
        (function () {
            const API_BASE = '/kodpwomo/backend/university';
            const listTable = document.getElementById('university-list');
            const tbody = listTable ? listTable.querySelector('tbody') : null;
            const btnAdd = document.getElementById('btn-add-university');
            const modal = document.getElementById('university-modal');
            const modalBackdrop = document.getElementById('university-modal-backdrop');
            const form = document.getElementById('university-form');
            const inputId = document.getElementById('university-id');
            const inputName = document.getElementById('university-name');
            const inputZone = document.getElementById('university-zone');
            // const inputImageUrl = document.getElementById('university-image');
            const inputImageFile = document.getElementById('university-image-file');
            const btnCancel = document.getElementById('university-cancel');

            if (!tbody || !btnAdd || !modal || !form) {
                console.error('Required DOM elements missing. Aborting universities admin JS.');
                return;
            }

            function showModal(mode, data) {
                inputId.value = data && data.id ? data.id : '';
                inputName.value = data && data.name ? data.name : '';
                inputZone.value = data && data.zone ? data.zone : '';
                // inputImageUrl.value = data && data.image ? data.image : '';
                inputImageFile.value = '';
                modal.classList.remove('hidden');
                if (modalBackdrop && typeof modalBackdrop.focus === 'function') modalBackdrop.focus();
                document.body.style.overflow = 'hidden';
                const title = document.getElementById('university-modal-title');
                if (title) title.textContent = mode === 'edit' ? 'Modifier une université' : 'Ajouter une université';
            }

            function hideModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            function showMessage(msg, isError = false) {
                // minimal toast fallback: alert (could be replaced by nicer UI)
                if (isError) console.error(msg);
                else console.log(msg);
                // use toast only if available; otherwise alert for immediate feedback
                if (window.toastr) {
                    isError ? toastr.error(msg) : toastr.success(msg);
                } else {
                    // keep unobtrusive: use console and a small on-screen flash (optional)
                    // fallback: alert only on error
                    if (isError) alert(msg);
                }
            }

            async function loadUniversities() {
                try {
                    const res = await fetch(`${API_BASE}/super`, { method: 'GET', credentials: 'same-origin' });
                    if (!res.ok) throw new Error('Impossible de charger les universités');
                    const data = await res.json();
                        // Correction : structure attendue {universities: {nbrs: X, universities: [...]}}
                        let unis = [];
                        if (data && data.universities && Array.isArray(data.universities.universities)) {
                            unis = data.universities.universities;
                        } else if (Array.isArray(data.universities)) {
                            unis = data.universities;
                        } else if (Array.isArray(data)) {
                            unis = data;
                        }
                        renderList(unis);
                } catch (err) {
                    console.error(err);
                    showMessage('Erreur lors du chargement des universités', true);
                    renderList([]);
                }
            }

            function safeText(v) {
                return (v === null || v === undefined) ? '' : String(v);
            }

            function renderList(items) {
                tbody.innerHTML = '';
                if (!Array.isArray(items) || items.length === 0) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = '<td colspan="8" class="muted">Aucune université trouvée.</td>';
                    tbody.appendChild(tr);
                    return;
                }
                for (const u of items) {
                    const id = safeText(u.id);
                    const name = safeText(u.name);
                    // Correction zone: parfois "Zone" parfois "zone"
                    const zone = safeText(u.Zone || u.zone);
                    const image = u.image || u.image_url || '';
                    const products = u.products_count != null ? u.products_count : (u.products ? u.products.length : 0);
                    const espaces = u.places_count != null ? u.places_count : (u.espaces_count != null ? u.espaces_count : (u.places ? u.places.length : 0));
                    const deliveries = u.deliveries_count != null ? u.deliveries_count : (u.deliveries ? u.deliveries.length : 0);

                    const tr = document.createElement('tr');
                    tr.setAttribute('data-id', id);

                    // image cell: chemin ../image/universities/{image}
                    let imgHtml = '';
                    if (image) {
                        const imgPath = image.match(/^https?:\/\//i) ? image : `../image/${image.replace(/^image[\\/]/,'')}`;
                        imgHtml = `<img class="thumb" src="${imgPath}" alt="${name}">`;
                    } else {
                        imgHtml = '<div class="muted">—</div>';
                    }

                    tr.innerHTML = `
                        <td>${id}</td>
                        <td>${escapeHtml(name)}</td>
                        <td>${escapeHtml(zone)}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.4rem;">
                                ${imgHtml}
                                ${image ? `<button class='wm-btn' data-action='view-img' title='Voir l\'image'>&#128065;</button>` : ''}
                            </div>
                        </td>
                        <td>${escapeHtml(products)}</td>
                        <td>${escapeHtml(espaces)}</td>
                        <td>${escapeHtml(deliveries)}</td>
                        <td>
                            <div class="action-btns">
                                <button class="wm-btn wm-btn-edit" data-action="edit">Modifier</button>
                                <button class="wm-btn wm-btn-delete" data-action="delete">Supprimer</button>
                            </div>
                        </td>
                    `;
                    console.log(imgHtml);
                    tbody.appendChild(tr);
                }
            }

            // Basic escaping to avoid accidental XSS when inserting text
            function escapeHtml(str) {
                if (str === null || str === undefined) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }


            // Event delegation for edit/delete/view-img
            tbody.addEventListener('click', function (e) {
                const btn = e.target.closest('button');
                const img = e.target.closest('img.thumb');
                const tr = (btn || img) ? (btn ? btn.closest('tr') : img.closest('tr')) : null;
                if (!tr) return;
                const id = tr.getAttribute('data-id');
                if (btn) {
                    const action = btn.getAttribute('data-action');
                    if (action === 'edit') {
                        // Ouvre le modal pré-rempli depuis la ligne du tableau (pas de requête)
                        const tds = tr.querySelectorAll('td');
                        const name = tds[1] ? tds[1].textContent.trim() : '';
                        const zone = tds[2] ? tds[2].textContent.trim() : '';
                        let image = '';
                        const imgEl = tr.querySelector('img.thumb');
                        if (imgEl) image = imgEl.getAttribute('src') || '';
                        showModal('edit', { id, name, zone, image });
                    } else if (action === 'delete') {
                        if (!confirm('Voulez-vous vraiment supprimer cette université ? Cette action est irréversible.')) return;
                        fetch(`${API_BASE}/super/${encodeURIComponent(id)}`, { method: 'DELETE', credentials: 'same-origin' })
                            .then(async res => {
                                if (!res.ok) {
                                    const text = await res.text().catch(()=>null);
                                    throw new Error(text || 'Erreur lors de la suppression');
                                }
                                showMessage('Université supprimée');
                                tr.remove();
                            })
                            .catch(err => {
                                console.error(err);
                                showMessage('Erreur lors de la suppression', true);
                            });
                    } else if (action === 'view-img') {
                        // Ouvre le modal image
                        const imgEl = tr.querySelector('img.thumb');
                        if (imgEl) openImageModal(imgEl.src, imgEl.alt);
                    }
                } else if (img) {
                    openImageModal(img.src, img.alt);
                }
            });

            // Modal image
            function openImageModal(src, alt) {
                let modal = document.getElementById('img-modal');
                if (modal) modal.remove();
                modal = document.createElement('div');
                modal.id = 'img-modal';
                modal.className = 'img-modal-backdrop';
                modal.innerHTML = `
                    <div class="img-modal-content">
                        <img src="${src}" alt="${escapeHtml(alt||'Aperçu image')}" />
                        <button class="img-modal-close">Fermer</button>
                    </div>
                `;
                document.body.appendChild(modal);
                modal.querySelector('.img-modal-close').onclick = () => modal.remove();
                modal.onclick = e => { if (e.target === modal) modal.remove(); };
            }

            // Add button handler
            btnAdd.addEventListener('click', function () {
                showModal('create', null);
            });

            // modal cancel / backdrop click to close
            btnCancel.addEventListener('click', hideModal);
            modalBackdrop.addEventListener('click', function (e) {
                if (e.target === modalBackdrop) hideModal();
                // bouton croix header
                document.getElementById('modal-close-btn').addEventListener('click', hideModal);
            });

            // form submit: create or update
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const id = inputId.value ? String(inputId.value) : '';
                const name = (inputName.value || '').trim();
                const zone = (inputZone.value || '').trim();
                // const imageUrl = (inputImageUrl.value || '').trim();
                const file = inputImageFile.files && inputImageFile.files[0] ? inputImageFile.files[0] : null;

                if (!name) {
                    showMessage('Le nom est requis.', true);
                    return;
                }

                const isEdit = !!id;
                if (!isEdit) {
                    // Création classique (POST)
                    const fd = new FormData();
                    fd.append('name', name);
                    fd.append('zone', zone);
                    if (file) fd.append('image_file', file);
                    try {
                        const res = await fetch(`${API_BASE}/super`, { method: 'POST', body: fd, credentials: 'same-origin' });
                        if (!res.ok) {
                            const errText = await res.text().catch(()=>null);
                            throw new Error(errText || 'Erreur serveur');
                        }
                        showMessage('Université créée');
                        hideModal();
                        await loadUniversities();
                    } catch (err) {
                        console.error(err);
                        showMessage('Erreur lors de l\'enregistrement', true);
                    }
                    return;
                }

                // Edition : si image, POST image puis PUT infos, sinon juste PUT infos
                let imagePath = '';
                if (file) {
                    // 1. Upload image (POST)
                    const imgFd = new FormData();
                    imgFd.append('image_file', file);
                    try {
                        const imgRes = await fetch(`${API_BASE}/image-update/${encodeURIComponent(id)}`, { method: 'POST', body: imgFd, credentials: 'same-origin' });
                        if (!imgRes.ok) {
                            const errText = await imgRes.text().catch(()=>null);
                            throw new Error(errText || 'Erreur upload image');
                        }
                        const imgData = await imgRes.json().catch(()=>null);
                        imagePath = imgData && imgData.image ? imgData.image : '';
                    } catch (err) {
                        console.error(err);
                        showMessage('Erreur lors de l\'upload de l\'image', true);
                        return;
                    }
                }

                // 2. PUT infos

                try {
                    const res = await fetch(`${API_BASE}/super/${encodeURIComponent(id)}`, { method: 'PUT', headers: { 'Content-Type': 'application/json' }, credentials: 'same-origin', body: JSON.stringify({name, zone}) });
                    if (!res.ok) {
                        const errText = await res.text().catch(()=>null);
                        throw new Error(errText || 'Erreur serveur');
                    }
                    showMessage('Université mise à jour');
                    hideModal();
                    await loadUniversities();
                } catch (err) {
                    console.error(err);
                    showMessage('Erreur lors de l\'enregistrement', true);
                }
            });

            // initial load
            document.addEventListener('DOMContentLoaded', loadUniversities);
            // also try once if already loaded
            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                loadUniversities();
            }

        })();
    </script>
</body>
</html>