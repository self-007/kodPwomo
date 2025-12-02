<!-- Page Catégories - Admin WeManage -->
<style>
    :root{
        --primary:#f7b642;
        --primary-dark:#e19627;
        --accent-green:#27ae60;
        --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
        --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
    }
    .wm-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 2rem;
    }
    .wm-title { font-size: 2.2rem; font-weight: 800; color: #00295c; letter-spacing:-.5px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .wm-btn {
        padding: 0.65rem 1.3rem; border: none; border-radius: 10px;
        font-weight: 600; cursor: pointer; transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        margin-left: 0.5rem; box-shadow: var(--shadow-3d-base); position:relative; overflow:hidden;
    }
    .wm-btn:hover { box-shadow: var(--shadow-3d-hover); transform: translateY(-2px); }
    .wm-btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; }
    .wm-btn-edit { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; }
    .wm-btn-delete { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; }
    .wm-table {
        width: 100%; border-collapse: collapse; background: transparent;
        border-radius: 16px; overflow: hidden;
    }
    .wm-table th, .wm-table td {
        padding: 1rem 1.25rem; text-align: left;
    }
    .wm-table th {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; font-weight: 700; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.5px; box-shadow:0 2px 4px rgba(0,0,0,0.08); position:relative;
    }
    .wm-table thead tr::after { content:""; position:absolute; left:0; right:0; bottom:0; height:2px; background:linear-gradient(90deg, rgba(247,182,66,.35), rgba(225,150,39,.2)); }
    .wm-table tbody tr { transition:all .28s cubic-bezier(0.4,0,0.2,1); position:relative; }
    .wm-table tr:not(:last-child) td { border-bottom: 1px solid #f1f5f9; }
    .wm-table tbody tr:hover { background:linear-gradient(180deg, rgba(240,253,244,0.9), rgba(255,255,255,0.95)) !important; box-shadow:8px 8px 20px rgba(0,0,0,0.08), -8px -8px 20px rgba(255,255,255,0.8); transform:translateY(-2px) scale(1.003); z-index:1; }
    .wm-table td { color: #475569; font-weight:500; transition:color .18s ease; }
    .wm-table tbody td:first-child { font-weight:600; color:#1f2937; }
    .wm-table tbody tr:hover td { color:#0f172a; }
    @media (max-width: 700px) {
        .wm-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .wm-title { font-size: 1.3rem; }
        .wm-table th, .wm-table td { padding: 0.6rem 0.5rem; }
    }
</style>

<!-- Modal pour ajouter/modifier une catégorie -->
<div id="category-modal" class="wm-modal" style="display:none;">
    <div class="wm-modal-backdrop"></div>
    <div class="wm-modal-content">
        <div class="wm-modal-header">
            <span id="modal-title">Ajouter une catégorie</span>
            <button class="wm-modal-close" id="modal-close">&times;</button>
        </div>
        <div class="wm-modal-body">
            <label for="category-name" style="font-weight:500;">Nom de la catégorie</label>
            <input type="text" id="category-name" class="wm-modal-input" placeholder="Nom..." autocomplete="off" />
            <input type="hidden" id="category-id" />
        </div>
        <div class="wm-modal-footer">
            <button class="wm-btn" id="modal-cancel">Annuler</button>
            <button class="wm-btn wm-btn-primary" id="modal-validate">Valider</button>
        </div>
    </div>
</div>

<style>
    .wm-modal { position: fixed; z-index: 1000; left: 0; top: 0; width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; }
    .wm-modal-backdrop { position: absolute; left:0; top:0; width:100vw; height:100vh; background: #0006; }
    .wm-modal-content { position: relative; background: #fff; border-radius: 16px; box-shadow: var(--shadow-3d-hover); min-width: 320px; max-width: 95vw; padding: 0; overflow: hidden; animation: modalIn 0.25s cubic-bezier(0.34,1.56,0.64,1); border:1px solid #e2e8f0; }
    @keyframes modalIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .wm-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 1.1rem 1.5rem 0.7rem 1.5rem; background:linear-gradient(135deg, var(--primary), var(--primary-dark)); border-bottom:none; }
    .wm-modal-header span { font-size: 1.3rem; font-weight: 700; color: #fff; letter-spacing:0.5px; }
    .wm-modal-close { background: none; border: none; font-size: 2rem; color: rgba(255,255,255,0.9); cursor: pointer; transition:all .3s ease; font-weight:700; }
    .wm-modal-close:hover { color: #ef4444; transform:rotate(90deg); }
    .wm-modal-body { padding: 1.5rem 1.5rem; display: flex; flex-direction: column; gap: 0.8rem; }
    .wm-modal-input { padding: 0.7rem 1rem; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; outline: none; transition: all 0.3s; box-shadow:inset 2px 2px 5px rgba(0,0,0,0.05); }
    .wm-modal-input:focus { border: 2px solid var(--primary); box-shadow:0 0 0 3px rgba(247,182,66,0.1); }
    .wm-modal-footer { display: flex; justify-content: flex-end; gap: 0.7rem; padding: 0.7rem 1.5rem 1.2rem 1.5rem; border-top: 1px solid #e0e0e0; }
</style>

<div class="wm-header">
    <div class="wm-title" style="color: #00295c;">Catégories</div>
    <button class="wm-btn wm-btn-primary" id="btn-add-category">Ajouter une catégorie</button>
</div>

<div style="overflow-x:auto; background:linear-gradient(135deg,#ffffff 0%,#f6f8fb 100%); border-radius:16px; box-shadow:var(--shadow-3d-base); border:1px solid #e2e8f0; transition:all .3s ease;" onmouseover="this.style.boxShadow='var(--shadow-3d-hover)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='var(--shadow-3d-base)'; this.style.transform='translateY(0)'">
    <table class="wm-table" id="category-list">
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <!-- JS: lignes dynamiques -->
        </tbody>
    </table>
</div>

<script>

// Charge les catégories depuis l'API backend
async function loadCategories() {
    try {
        const res = await fetch('../backend/category/super', { credentials: 'same-origin' });
        if (!res.ok) throw new Error('Erreur serveur');
        const data = await res.json();
        // On accepte data sous forme d'objet { categories: [...] } ou tableau direct
        const cats = Array.isArray(data) ? data : (data.categories || []);
        renderCategories(cats);
    } catch (e) {
        renderCategories([]);
        console.error('Erreur chargement catégories:', e);
    }
}

function renderCategories(data) {
    const tbody = document.querySelector('#category-list tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    if (!Array.isArray(data) || !data.length) {
        tbody.innerHTML = '<tr><td colspan="3" style="text-align:center;color:#888">Aucune catégorie</td></tr>';
        return;
    }
    data.forEach(cat => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${cat.id}</td>
            <td>${cat.name}</td>
            <td>
                <button class="wm-btn wm-btn-edit" data-action="edit" data-id="${cat.id}">Modifier</button>
                <button class="wm-btn wm-btn-delete" data-action="delete" data-id="${cat.id}">Supprimer</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}


// Gestion des actions (edit/delete)
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.wm-btn');
    if (!btn) return;
    const action = btn.getAttribute('data-action');
    const id = btn.getAttribute('data-id');
    if (action === 'edit') {
        // handled elsewhere
    } else if (action === 'delete') {
        if (confirm('Supprimer la catégorie ID: ' + id + ' ?')) {
            fetch(`../backend/category/super/${id}`, {
                method: 'DELETE',
                credentials: 'same-origin'
            })
            .then(res => {
                if (!res.ok) throw new Error('Erreur serveur');
                return res.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    loadCategories();
                } else {
                    alert(data.error || 'Erreur lors de la suppression');
                }
            })
            .catch(() => alert('Erreur lors de la suppression'));
        }
    }
});





// --- Modal logique ---
const modal = document.getElementById('category-modal');
const modalTitle = document.getElementById('modal-title');
const modalClose = document.getElementById('modal-close');
const modalCancel = document.getElementById('modal-cancel');
const modalValidate = document.getElementById('modal-validate');
const inputName = document.getElementById('category-name');
const inputId = document.getElementById('category-id');

function openModal({ title = 'Ajouter une catégorie', name = '', id = '' } = {}) {
    modalTitle.textContent = title;
    inputName.value = name;
    inputId.value = id;
    modal.style.display = 'flex';
    setTimeout(() => inputName.focus(), 100);
}
function closeModal() {
    modal.style.display = 'none';
    inputName.value = '';
    inputId.value = '';
}
modalClose.onclick = modalCancel.onclick = closeModal;
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

// Ouvre le modal pour ajouter
document.getElementById('btn-add-category').addEventListener('click', function() {
    openModal({ title: 'Ajouter une catégorie' });
});

// Ouvre le modal pour modifier (depuis bouton Modifier)
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.wm-btn-edit');
    if (!btn) return;
    const id = btn.getAttribute('data-id');
    const row = btn.closest('tr');
    const name = row ? row.children[1].textContent : '';
    openModal({ title: 'Modifier la catégorie', name, id });
});

// Valider (ajout ou modif)
modalValidate.onclick = async function() {
    const name = inputName.value.trim();
    const id = inputId.value;
    if (!name) { inputName.focus(); inputName.style.borderColor = '#e4572e'; setTimeout(()=>inputName.style.borderColor='', 800); return; }
    try {
        if (id) {
            // Modification
            const res = await fetch('../backend/category/super', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify({ id, name })
            });
            if (!res.ok) throw new Error('Erreur serveur');
        } else {
            // Ajout
            const res = await fetch('../backend/category/super', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify({ name })
            });
            if (!res.ok) throw new Error('Erreur serveur');
        }
        closeModal();
        await loadCategories();
    } catch (e) {
        alert('Erreur lors de l\'enregistrement');
    }
};

// Initialisation
loadCategories();
</script>
