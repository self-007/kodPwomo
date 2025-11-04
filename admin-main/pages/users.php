<script>
const USERS_API_URL = '/kodpwomo/backend/users/adm';
function loadUsersData(cb) {
	fetch(USERS_API_URL, {credentials:'same-origin'})
		.then(r=>r.json())
		.then(data => {
			let users = Array.isArray(data) ? data : (data.users || []);
			window.usersData = users;
			cb(users);
		})
		.catch(() => {
			cb([]);
		});
}
</script>
<!-- Composant Gestion des Utilisateurs (inclusif, encapsulé) -->
<section class="wm-users-module">
	<h2 class="wm-users-title">Gestion des utilisateurs</h2>
	<h3 class="wm-users-subtitle">Liste des utilisateurs</h3>
	<div class="wm-users-table-wrap">
		<table class="wm-users-table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Email</th>
					<th>Rôle</th>
					<th>Statut</th>
					<th>Créé le</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="wm-users-tbody">
				<tr><td colspan="6" class="wm-skeleton">Chargement…</td></tr>
			</tbody>
		</table>
	</div>
	<div class="wm-users-list" id="wm-users-list" aria-hidden="true"></div>
</section>

<div id="wm-user-modal" class="wm-user-modal" style="display:none">
	<div class="wm-user-modal-backdrop"></div>
	<div class="wm-user-modal-dialog">
		<button class="wm-user-modal-close" id="wm-user-modal-close">&times;</button>
		<div id="wm-user-modal-content">Chargement…</div>
	</div>
</div>

<div id="wm-toast" class="wm-toast" style="display:none"></div>

<style>
.wm-users-module{font-family:'Inter', 'Poppins', 'Roboto', Arial, sans-serif;max-width:1100px;margin:auto;padding:2rem 1.5rem}
.wm-users-title{font-size:2.2rem;font-weight:800;color:#1a1a2e;margin-bottom:.3rem;letter-spacing:-.5px}
.wm-users-subtitle{font-size:0.95rem;color:#64748b;margin-bottom:2rem;font-weight:500;text-transform:uppercase;letter-spacing:1px}

.wm-users-table-wrap{overflow-x:auto;background:transparent;border-radius:14px}
.wm-users-table{width:100%;border-collapse:collapse;background:#fff;border-radius:14px;overflow:hidden;min-width:720px;box-shadow:0 4px 16px rgba(255, 107, 53, 0.08);border:1px solid rgba(255, 107, 53, 0.05)}
.wm-users-table th{padding:1rem 1.25rem;text-align:left;border-bottom:2px solid rgba(255, 107, 53, 0.1);font-size:0.9rem;font-weight:700;color:#1a1a2e;background:linear-gradient(135deg, rgba(255, 107, 53, 0.02), rgba(0, 212, 255, 0.01));text-transform:uppercase;letter-spacing:0.5px}
.wm-users-table td{padding:1rem 1.25rem;text-align:left;border-bottom:1px solid #f0f1f3;font-size:0.95rem;color:#2d3748}
.wm-users-table tbody tr{transition:background .15s ease, box-shadow .15s ease}
.wm-users-table tbody tr:hover{background:rgba(255, 107, 53, 0.02)}
.wm-users-table tr:last-child td{border-bottom:0}
.wm-users-table__actions{text-align:right;width:1%}

.wm-skeleton{color:transparent;background:linear-gradient(90deg, #f8f9fa 25%, #fff5f0 50%, #f8f9fa 75%);background-size:200% 100%;animation:shimmer 2s infinite}
@keyframes shimmer{0%{background-position:0%}100%{background-position:200%}}

.wm-badge{display:inline-block;padding:.35em .85em;font-size:0.85em;border-radius:8px;font-weight:700;vertical-align:middle;letter-spacing:0.3px}
.wm-badge--active{background:linear-gradient(135deg, #1ABC9C, #16A085);color:#fff;box-shadow:0 2px 8px rgba(26, 188, 156, 0.2)}
.wm-badge--inactive{background:linear-gradient(135deg, #FF6B35, #D84315);color:#fff;box-shadow:0 2px 8px rgba(255, 107, 53, 0.2)}
.wm-badge--adm{display:inline-block;font-size:0.75em;color:#fff;background:#FF6B35;padding:0.25em 0.6em;border-radius:6px;margin-left:0.5rem;font-weight:800;text-transform:uppercase;letter-spacing:0.5px}

.wm-btn{font:inherit;padding:.55rem 1rem;border-radius:8px;border:2px solid transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;transition:all .2s ease;font-weight:600;font-size:0.95rem}
.wm-btn--ghost{background:transparent;color:#FF6B35;border:2px solid #FF6B35}
.wm-btn--ghost:hover{background:#FF6B35;color:#fff;box-shadow:0 4px 12px rgba(255, 107, 53, 0.3)}
.wm-btn--mini{padding:0.4rem 0.7rem;font-size:0.85em;border-radius:6px;margin-left:0.5rem}
.wm-btn--blue{background:linear-gradient(135deg, #FF6B35, #D84315);color:#fff;border:none;box-shadow:0 4px 12px rgba(255, 107, 53, 0.25)}
.wm-btn--blue:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(255, 107, 53, 0.35)}
.wm-btn--blue:active{transform:translateY(0)}
.wm-btn--red{background:#FF6B35;color:#fff;border:none;box-shadow:0 4px 12px rgba(255, 107, 53, 0.25)}
.wm-btn--red:hover{background:#D84315;transform:translateY(-2px);box-shadow:0 6px 16px rgba(255, 107, 53, 0.35)}

.wm-users-list{display:none;flex-direction:column;gap:1rem}
.wm-user-card{background:#fff;padding:1.25rem;border-radius:12px;box-shadow:0 4px 16px rgba(255, 107, 53, 0.08);display:flex;justify-content:space-between;align-items:center;gap:1rem;border-left:5px solid #FF6B35;transition:all .2s ease;border:1px solid rgba(255, 107, 53, 0.1)}
.wm-user-card:hover{box-shadow:0 8px 24px rgba(255, 107, 53, 0.12);transform:translateY(-2px)}
.wm-user-info{display:flex;flex-direction:column;gap:0.35rem;flex:1}
.wm-user-name{font-weight:800;color:#1a1a2e;font-size:1.05em;letter-spacing:-.3px}
.wm-user-meta{font-size:0.9em;color:#64748b;font-weight:500}
.wm-user-status{font-size:0.9em;margin-top:0.25em;display:flex;gap:0.5rem;align-items:center}

.wm-user-modal{position:fixed;z-index:1000;top:0;left:0;width:100vw;height:100vh;display:flex;align-items:center;justify-content:center;background:rgba(26, 26, 46, 0.3);transition:opacity .25s;backdrop-filter:blur(4px)}
.wm-user-modal[style*="display: none"]{opacity:0;pointer-events:none}
.wm-user-modal-dialog{background:#fff;border-radius:16px;box-shadow:0 16px 48px rgba(255, 107, 53, 0.2);padding:2.5rem 2rem;max-width:420px;width:95vw;max-height:90vh;overflow-y:auto;position:relative;animation:wm-modal-zoom .25s cubic-bezier(0.34, 1.56, 0.64, 1);border-top:5px solid #FF6B35}
.wm-user-modal-dialog h2{font-size:1.5rem;font-weight:800;color:#1a1a2e;margin-bottom:1.5rem;letter-spacing:-.3px}
.wm-user-modal-dialog div{margin-bottom:1rem;font-size:0.95rem;color:#2d3748;display:flex;justify-content:space-between}
.wm-user-modal-dialog b{color:#1a1a2e;font-weight:700;min-width:120px}

@keyframes wm-modal-zoom{from{transform:scale(.9);opacity:0}to{transform:scale(1);opacity:1}}
.wm-user-modal-close{position:absolute;top:1.5rem;right:1.5rem;background:rgba(255, 107, 53, 0.1);border:none;font-size:1.8rem;color:#FF6B35;cursor:pointer;transition:all .2s;width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center}
.wm-user-modal-close:hover{background:#FF6B35;color:#fff;transform:rotate(90deg)}
.wm-user-modal-backdrop{position:absolute;top:0;left:0;width:100vw;height:100vh;z-index:-1}
.wm-toast{position:fixed;bottom:2rem;left:50%;transform:translateX(-50%);color:#fff;padding:1em 1.8em;border-radius:10px;font-size:1em;box-shadow:0 8px 24px rgba(255, 107, 53, 0.25);z-index:2000;display:none;font-weight:700;letter-spacing:0.3px;animation:slide-up .3s cubic-bezier(0.34, 1.56, 0.64, 1)}
@keyframes slide-up{from{transform:translateX(-50%) translateY(20px);opacity:0}to{transform:translateX(-50%) translateY(0);opacity:1}}

@media (max-width:900px){.wm-users-table{min-width:0}.wm-users-list{display:flex}.wm-users-table-wrap{display:none}.wm-users-module{padding:1.5rem 1rem}}
@media (max-width:600px){.wm-user-modal-dialog{padding:1.5rem 1rem;border-radius:12px}.wm-users-title{font-size:1.8rem}.wm-users-subtitle{font-size:0.85rem}}
</style>

</script>
<script>

// Toast feedback visuel
function showToast(msg,type){
  const toast = document.getElementById('wm-toast');
  toast.textContent = msg;
  toast.style.background = type==='error'?'linear-gradient(135deg, #FF6B35, #D84315)':'linear-gradient(135deg, #1ABC9C, #16A085)';
  toast.style.display = 'block';
  setTimeout(()=>{toast.style.display='none';}, 2500);
}
// API pour nommer/révoquer admin
function setUserRole(id, role){
  let url = '';
  if(role==='admin') url = `/kodpwomo/backend/setAdm/${id}`;
  else if(role==='client') url = `/kodpwomo/backend/setUser/${id}`;
  else return;
  fetch(url, {method:'PUT'})
    .then(r=>r.json())
    .then(data=>{
      showToast(data.status==='success' ? (role==='admin'?'Utilisateur nommé admin.':'Admin révoqué.') : (data.error||'Erreur lors de la modification.'), data.status==='success'?'':'error');
      if(data.status==='success') loadUsersData(function(users){ renderUsersTable(users); renderUsersList(users); });
    })
    .catch(()=>showToast('Erreur réseau','error'));
}
function renderUsersTable(users){
  const tbody = document.getElementById('wm-users-tbody');
  if(!users.length){
    tbody.innerHTML = '<tr><td colspan="6">Aucun utilisateur ou erreur de chargement.</td></tr>';
    return;
  }
  tbody.innerHTML = users.map((u,i)=>{
    const status = u.status === 'active' ? '<span class="wm-badge wm-badge--active">Actif</span>' : '<span class="wm-badge wm-badge--inactive">Inactif</span>';
    const adm = (u.role && u.role.toLowerCase()==='admin') ? '<span class="wm-badge--adm">adm</span>' : '';
    let adminBtn = '';
    if((u.role||'').toLowerCase() !== 'adm'){
      adminBtn = `<button class="wm-btn wm-btn--mini wm-btn--blue" data-action="make-admin" data-id="${u.id_unique||u.id}" title="Nommer admin">★</button>`;
    } else {
      adminBtn = `<button class="wm-btn wm-btn--mini wm-btn--red" data-action="revoke-admin" data-id="${u.id_unique||u.id}" title="Révoquer admin">✕</button>`;
    }
    return `<tr class="${i%2===0?'wm-table--alt':''}">
      <td>${escapeHtml(u.name||u.username||'—')}</td>
      <td>${escapeHtml(u.email||'—')}</td>
      <td>${escapeHtml(u.role||'—')}</td>
      <td>${status}${adm}</td>
      <td>${escapeHtml(formatDate(u.date||u.created_at||u.created||'—'))}</td>
      <td><button class="wm-btn wm-btn--ghost" data-action="view" data-id="${u.id_unique||u.id}">Voir</button> ${adminBtn}</td>
    </tr>`;
  }).join('');
  tbody.querySelectorAll('button[data-action]').forEach(btn => {
    btn.onclick = () => {
      const id = btn.getAttribute('data-id');
      const action = btn.getAttribute('data-action');
      const user = users.find(u => u.id_unique === id || u.id === id);
      if(action==='view' && user) openUserModal(user);
      else if(action === 'make-admin') setUserRole(id, 'admin');
      else if(action === 'revoke-admin') setUserRole(id, 'client');
    };
  });
}
function renderUsersList(users){
  const list = document.getElementById('wm-users-list');
  if(!users.length){
    list.innerHTML = '<div class="wm-user-card">Aucun utilisateur ou erreur de chargement.</div>';
    return;
  }
  list.innerHTML = users.map(u=>{
    const status = u.status === 'active' ? '<span class="wm-badge wm-badge--active">Actif</span>' : '<span class="wm-badge wm-badge--inactive">Inactif</span>';
    const adm = (u.role && u.role.toLowerCase()==='adm') ? '<span class="wm-badge--adm">adm</span>' : '';
    let adminBtn = '';
    if((u.role||'').toLowerCase() !== 'adm'){
      adminBtn = `<button class="wm-btn wm-btn--mini wm-btn--blue" data-action="make-admin" data-id="${u.id_unique||u.id}" title="Nommer admin">★</button>`;
    } else {
      adminBtn = `<button class="wm-btn wm-btn--mini wm-btn--red" data-action="revoke-admin" data-id="${u.id_unique||u.id}" title="Révoquer admin">✕</button>`;
    }
    return `<article class="wm-user-card">
      <div class="wm-user-info">
        <div class="wm-user-name">${escapeHtml(u.name||u.username||'—')}</div>
        <div class="wm-user-meta">${escapeHtml(u.email||'—')} • ${escapeHtml(u.role||'—')}</div>
        <div class="wm-user-status">${status}${adm}</div>
      </div>
      <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5em">
        <button class="wm-btn wm-btn--ghost" data-action="view" data-id="${u.id_unique||u.id}">Voir</button>
        ${adminBtn}
      </div>
    </article>`;
  }).join('');
  list.querySelectorAll('button[data-action]').forEach(btn=>{
    btn.onclick = ()=>{
      const id = btn.getAttribute('data-id');
      const action = btn.getAttribute('data-action');
      const user = users.find(u=>u.id_unique===id||u.id===id);
      if(action==='view' && user) openUserModal(user);
      else if(action==='make-admin') setUserRole(id, 'admin');
      else if(action==='revoke-admin') setUserRole(id, 'client');
    };
  });
}
function openUserModal(user){
  const modal = document.getElementById('wm-user-modal');
  const content = document.getElementById('wm-user-modal-content');
  content.innerHTML = `
    <h2 style="margin-bottom:.7em">${escapeHtml(user.name||user.username||'—')}</h2>
    <div><b>ID:</b> ${escapeHtml(user.id_unique||user.id||'—')}</div>
    <div><b>Email:</b> ${escapeHtml(user.email||'—')}</div>
    <div><b>Rôle:</b> ${escapeHtml(user.role||'—')}</div>
    <div><b>Statut:</b> ${escapeHtml(user.status||'—')}</div>
    <div><b>Créé le:</b> ${escapeHtml(formatDate(user.date||user.created_at||user.created||'—'))}</div>
    <div><b>Total commandes:</b> ${user.total_orders ?? '—'}</div>
    <div><b>Total dépensé:</b> ${user.total_spent ?? '—'}</div>
    <div><b>Dernière université:</b> ${escapeHtml(user.last_university||'—')}</div>
    <div><b>Dernière connexion:</b> ${escapeHtml(user.last_date||'—')}</div>
    <div><b>Téléphone:</b> ${escapeHtml(user.phone||'—')}</div>
    <div><b>Adresse:</b> ${escapeHtml(user.address||'—')}</div>
  `;
  modal.style.display = 'flex';
}
document.getElementById('wm-user-modal-close').onclick = ()=>{
  document.getElementById('wm-user-modal').style.display = 'none';
};
document.getElementById('wm-user-modal').addEventListener('click',e=>{
  if(e.target.classList.contains('wm-user-modal-backdrop')){
    document.getElementById('wm-user-modal').style.display = 'none';
  }
});
function escapeHtml(s){
  if(typeof s !== 'string') return s;
  return s.replace(/[&<>"]|'/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[m];
  });
}
function formatDate(s){
  try{const d=new Date(s);if(isNaN(d))return s;return d.toLocaleDateString(undefined,{year:'numeric',month:'short',day:'numeric'});}catch(e){return s;}
}
function renderResponsive(){
  const list = document.getElementById('wm-users-list');
  const isSmall = window.matchMedia('(max-width:900px)').matches;
  if(isSmall){
    list.setAttribute('aria-hidden','false');
    document.querySelector('.wm-users-table-wrap').style.display = 'none';
  }else{
    list.setAttribute('aria-hidden','true');
    document.querySelector('.wm-users-table-wrap').style.display = '';
  }
}
loadUsersData(function(users){
  renderUsersTable(users);
  renderUsersList(users);
  renderResponsive();
  window.addEventListener('resize', renderResponsive);
});
</script>
