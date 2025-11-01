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
.wm-users-module{font-family:'Poppins', 'Roboto', Arial, sans-serif;max-width:1000px;margin:auto;padding:1.5rem 1rem}
.wm-users-title{font-size:2rem;font-weight:700;color:#0f172a;margin-bottom:.5rem}
.wm-users-subtitle{font-size:1.15rem;color:#2563eb;margin-bottom:1.5rem}
.wm-users-table-wrap{overflow-x:auto;background:transparent}
.wm-users-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;min-width:720px;box-shadow:0 2px 8px rgba(37,99,235,.07)}
.wm-users-table th,.wm-users-table td{padding:.85rem .75rem;text-align:left;border-bottom:1px solid #f3f6fa;font-size:1rem;color:#0f172a}
.wm-users-table thead{background:#f7fafc}
.wm-users-table tr:last-child td{border-bottom:0}
.wm-users-table__actions{text-align:right;width:1%}
.wm-skeleton{color:transparent;background:linear-gradient(90deg,#f7fafc 25%, #eef2ff 50%, #f7fafc 75%);background-size:200% 100%}
.wm-badge{display:inline-block;padding:.2em .7em;font-size:.95em;border-radius:1em;font-weight:600;vertical-align:middle}
.wm-badge--active{background:#10b981;color:#fff}
.wm-badge--inactive{background:#ff7a18;color:#fff}
.wm-badge--adm{display:block;font-size:.8em;color:#2563eb;margin-top:2px}
.wm-btn{font:inherit;padding:.45rem .85rem;border-radius:8px;border:1px solid transparent;cursor:pointer;display:inline-flex;align-items:center;gap:.5rem;transition:background .18s}
.wm-btn--ghost{background:transparent;color:#2563eb;border:1px solid #2563eb}
.wm-btn--ghost:hover{background:#2563eb;color:#fff}
.wm-btn--mini{padding:.25rem .5rem;font-size:.9em;border-radius:6px;margin-left:.25rem}
.wm-btn--blue{background:#2563eb;color:#fff;}
.wm-btn--red{background:#ff7a18;color:#fff;}
.wm-users-list{display:none;flex-direction:column;gap:.7rem}
.wm-user-card{background:#fff;padding:1rem;border-radius:12px;box-shadow:0 2px 8px rgba(37,99,235,.07);display:flex;justify-content:space-between;align-items:center;gap:.5rem}
.wm-user-info{display:flex;flex-direction:column}
.wm-user-name{font-weight:600;color:#0f172a;font-size:1.1em}
.wm-user-meta{font-size:.97em;color:#475569}
.wm-user-status{font-size:.95em;margin-top:.2em}
.wm-user-modal{position:fixed;z-index:1000;top:0;left:0;width:100vw;height:100vh;display:flex;align-items:center;justify-content:center;background:rgba(15,23,42,.18);transition:opacity .2s}
.wm-user-modal[style*="display: none"]{opacity:0;pointer-events:none}
.wm-user-modal-dialog{background:#fff;border-radius:14px;box-shadow:0 8px 32px rgba(37,99,235,.13);padding:2rem 1.5rem;max-width:400px;width:95vw;max-height:90vh;overflow-y:auto;position:relative;animation:wm-modal-zoom .22s}
@keyframes wm-modal-zoom{from{transform:scale(.85);opacity:0}to{transform:scale(1);opacity:1}}
.wm-user-modal-close{position:absolute;top:1rem;right:1rem;background:none;border:none;font-size:2rem;color:#2563eb;cursor:pointer}
.wm-user-modal-backdrop{position:absolute;top:0;left:0;width:100vw;height:100vh;z-index:-1}
.wm-toast{position:fixed;bottom:2.5rem;left:50%;transform:translateX(-50%);background:#2563eb;color:#fff;padding:.7em 1.5em;border-radius:8px;font-size:1.1em;box-shadow:0 2px 8px rgba(37,99,235,.13);z-index:2000;display:none}
@media (max-width:900px){.wm-users-table{min-width:0}.wm-users-list{display:flex}.wm-users-table-wrap{display:none}}
@media (max-width:600px){.wm-user-modal-dialog{padding:1.2rem .5rem}}
</style>

</script>
<script>

// Toast feedback visuel
function showToast(msg,type){
  const toast = document.getElementById('wm-toast');
  toast.textContent = msg;
  toast.style.background = type==='error'?'#ff7a18':'#2563eb';
  toast.style.display = 'block';
  setTimeout(()=>{toast.style.display='none';}, 2200);
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
