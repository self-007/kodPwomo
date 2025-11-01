<!-- Page Catégories - Admin WeManage -->
<style>
    .wm-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 2rem;
    }
    .wm-title { font-size: 2rem; font-weight: 600; color: #1b3556; }
    .wm-btn {
        padding: 0.5rem 1.2rem; border: none; border-radius: 4px;
        font-weight: 500; cursor: pointer; transition: background 0.2s;
        margin-left: 0.5rem;
    }
    .wm-btn-primary { background: #1b8eb7; color: #fff; }
    .wm-btn-primary:hover { background: #176e8c; }
    .wm-btn-edit { background: #f7b32b; color: #fff; }
    .wm-btn-edit:hover { background: #e09e18; }
    .wm-btn-delete { background: #e4572e; color: #fff; }
    .wm-btn-delete:hover { background: #b6321c; }
    .wm-table {
        width: 100%; border-collapse: collapse; background: #fff;
        box-shadow: 0 2px 8px #0001; border-radius: 8px; overflow: hidden;
    }
    .wm-table th, .wm-table td {
        padding: 0.9rem 1rem; text-align: left;
    }
    .wm-table th {
        background: #eaf6fb; color: #1b3556; font-weight: 600;
    }
    .wm-table tr:not(:last-child) { border-bottom: 1px solid #e0e0e0; }
    .wm-table td { color: #333; }
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
    .wm-modal-content { position: relative; background: #fff; border-radius: 10px; box-shadow: 0 4px 32px #0002; min-width: 320px; max-width: 95vw; padding: 0; overflow: hidden; animation: modalIn 0.2s; }
    @keyframes modalIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .wm-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 1.1rem 1.5rem 0.5rem 1.5rem; border-bottom: 1px solid #e0e0e0; }
    .wm-modal-header span { font-size: 1.2rem; font-weight: 600; color: #1b3556; }
    .wm-modal-close { background: none; border: none; font-size: 1.7rem; color: #888; cursor: pointer; }
    .wm-modal-close:hover { color: #e4572e; }
    .wm-modal-body { padding: 1.2rem 1.5rem; display: flex; flex-direction: column; gap: 0.7rem; }
    .wm-modal-input { padding: 0.6rem 1rem; border: 1px solid #bcdff1; border-radius: 5px; font-size: 1rem; outline: none; transition: border 0.2s; }
    .wm-modal-input:focus { border: 1.5px solid #1b8eb7; }
    .wm-modal-footer { display: flex; justify-content: flex-end; gap: 0.7rem; padding: 0.7rem 1.5rem 1.2rem 1.5rem; border-top: 1px solid #e0e0e0; }
</style>

<div class="wm-header">
    <div class="wm-title">Catégories</div>
    <button class="wm-btn wm-btn-primary" id="btn-add-category">Ajouter une catégorie</button>
</div>

<div style="overflow-x:auto">
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
        const res = await fetch('/kodpwomo/backend/category/super', { credentials: 'same-origin' });
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
            fetch(`/kodpwomo/backend/category/super/${id}`, {
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
            const res = await fetch('/kodpwomo/backend/category/super', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify({ id, name })
            });
            if (!res.ok) throw new Error('Erreur serveur');
        } else {
            // Ajout
            const res = await fetch('/kodpwomo/backend/category/super', {
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
