<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notifications | kodPwomo</title>
	<link rel="stylesheet" href="assets/css/kodpwomo-colors.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		:root{
			--primary:#f7b642;
			--primary-dark:#e19627;
			--secondary:#27ae60;
			--secondary-dark:#229954;
			--text:#234777;
			--muted:#6b7280;
			--white:#ffffff;
			--white-95:rgba(255,255,255,0.95);
			--white-92:rgba(255,255,255,0.92);
			--panel-border:1px solid rgba(0,0,0,0.06);
			--panel-shadow:0 6px 20px rgba(0,0,0,0.08);
			--row-shadow:0 10px 30px rgba(255, 107, 53, 0.08);
		}
		*{box-sizing:border-box;margin:0;padding:0}
		body{
			background: #fafafa; /* blanc pâle */
			color: var(--text);
			font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
			min-height:100vh;
		}
		.container{max-width:1100px;margin:0 auto;padding:24px}
		/* Header (same pattern as boutique) */
		.header{background:#ffffff; backdrop-filter:blur(10px); padding:12px 0; box-shadow:0 6px 20px rgba(0,0,0,0.08); position:sticky; top:0; z-index:100; border-radius:15px; border-bottom:1px solid rgba(0,0,0,0.05); }
		.header-content{width:100%;margin:0;padding:0 16px;display:flex;justify-content:space-between;align-items:center}
		.logo{display:flex;align-items:center;height:40px}
		.logo img{height:100%;width:auto;max-width:160px;border-radius:8px}
		.nav{position:relative}
		.hamburger-btn{display:inline-flex;flex-direction:column;justify-content:center;align-items:center;width:44px;height:44px;border:1px solid rgba(0,0,0,0.15);border-radius:6px;background:#fff;cursor:pointer;box-shadow:3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85)}
		.hamburger-btn span{width:20px;height:2px;background:#333;margin:2px 0;border-radius:2px}
		.nav-menu{position:absolute;right:0;top:44px;min-width:200px;max-width:90vw;max-height:60vh;overflow-y:auto;background:rgba(255,255,255,0.95);border:1px solid rgba(0,0,0,0.06);border-radius:10px;box-shadow:var(--panel-shadow);backdrop-filter:blur(12px);display:none;z-index:1200}
		.nav-menu.show{display:block}
		.nav-menu a{display:block;padding:10px 14px;text-decoration:none;color:#234777;font-weight:600;border-bottom:1px solid rgba(0,0,0,0.05)}
		.nav-menu a:last-child{border-bottom:none}
		.nav-menu a:hover{background:#f5f7fb;color:var(--primary)}
		/* Header */
		.header{
			display:flex;align-items:center;gap:12px;margin-bottom:16px
		}
        .header-content{
            width:100%;
            
        }
		
		img{width:30%;height:auto;}
        @media (max-width:600px){
            img{width:40%;height:auto;}
        }
         @media (max-width:400px){
            img{width:55%;height:auto;}
        }
		.title-wrap{display:flex;flex-direction:column}
		.site{font-weight:800;letter-spacing:0.2px}
		.subtitle{color:var(--muted);font-weight:600;font-size:13px}
		/* Search + Filters */
		.toolbar{display:flex;gap:12px;align-items:center;margin:16px 0;flex-wrap:wrap}
		.search{flex:1;min-width:220px;background:var(--white-95);backdrop-filter:blur(8px);border:var(--panel-border);border-radius:12px;padding:10px 12px;color:var(--text);box-shadow:var(--panel-shadow)}
		.chips{display:flex;gap:8px;flex-wrap:wrap}
		.chip{padding:8px 12px;border-radius:999px;background:#fff;color:var(--text);border:2px solid #e2e8f0;cursor:pointer;user-select:none;box-shadow:3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85)}
		.chip.active{background:var(--primary); color:#fff;border-color:var(--primary)}
		.chip:hover{filter:brightness(1.1)}
		/* Layout */
		.grid{display:grid;grid-template-columns:1fr 280px;gap:16px}
		@media (max-width:900px){.grid{grid-template-columns:1fr}}
		/* Panel */
		.panel{background:var(--white-92);backdrop-filter:blur(8px);border:var(--panel-border);border-radius:16px;box-shadow:var(--panel-shadow)}
		.panel .content{padding:16px}
		/* Row */
		.row{display:flex;gap:12px;padding:14px 16px;border-radius:14px;background:#fff;border:1px solid rgba(0,0,0,0.06);align-items:flex-start;box-shadow:var(--row-shadow)}
		.row + .row{margin-top:10px}
		.avatar{width:44px;height:44px;border-radius:12px;background: lightgray;display:flex;align-items:center;justify-content:center;font-weight:800;color:#ffffff}
		.meta{flex:1}
		.title{font-weight:700}
		.desc{color:var(--muted);margin-top:4px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
		.time{color:#6b7280;margin-top:6px;font-size:12px}
		.actions{display:flex;flex-direction:column;gap:8px;min-width:120px}
		.more{margin-top:6px;color:var(--primary);cursor:pointer;font-weight:600}
		.btn{padding:8px 12px;border-radius:999px;background:#fff;color:var(--text);border:2px solid #e2e8f0;cursor:pointer;text-align:center;box-shadow:3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85)}
		.btn.primary{background:var(--primary); border:none;color:#fff}
		.btn.warn{background:linear-gradient(135deg, #FF6B35, #D84315); border:none;color:#ffffff}
		.badge-pill{padding:6px 10px;border-radius:999px;background:#fff;border:2px solid #e2e8f0;color:var(--text);font-weight:700;min-width:72px;text-align:center}
		/* Sidebar stats */
		.stats{padding:16px}
		.stat-title{color:var(--text);font-weight:700;margin-bottom:12px}
		.stat-item{display:flex;justify-content:space-between;color:var(--text);padding:8px 0;border-bottom:1px dashed rgba(0,0,0,0.08)}
		.stat-item:last-child{border-bottom:none}
		/* Top row filters inside panel header */
		.panel-header{display:flex;gap:8px;align-items:center;padding:12px 16px;border-bottom:1px solid rgba(0,0,0,0.06)}
	</style>
</head>
	<body>
	<header class="header" style="z-index:1000">
		<div class="header-content">
			<img src="image/logo/logo1.1.jpg" alt="kodPwomo">
			<nav class="nav">
				<button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu" aria-expanded="false" aria-controls="navMenu">
					<span></span><span></span><span></span>
				</button>
				<div class="nav-menu" id="navMenu" role="menu">
					<a href="dashboard_user/dashboard.php" role="menuitem">Dashboard</a>
					<a href="boutique.php" role="menuitem">Boutique</a>
					<a href="agent.php" role="menuitem">Restaurant</a>
					<a href="index.php" role="menuitem">Home</a>
				</div>
			</nav>
		</div>
	</header>
	<div class="container">
		<div class="header" style="background:transparent;box-shadow:none;padding:0">
			<div class="title-wrap">
				<div class="site">Notifications</div>
				<div class="subtitle">Votre activité récente</div>
			</div>
		</div>

		<div class="toolbar">
			<input id="searchInput" class="search" type="text" placeholder="Rechercher…" />
			<div class="chips">
				<div class="chip active" data-filter="all"><i class="fas fa-inbox"></i> Tout <span id="countAll" style="margin-left:6px;opacity:.8">0</span></div>
				<div class="chip" data-filter="unread"><i class="fas fa-envelope"></i> Non lus <span id="countUnread" style="margin-left:6px;opacity:.8">0</span></div>
				<div class="chip" data-filter="read"><i class="fas fa-check-circle"></i> Lus <span id="countRead" style="margin-left:6px;opacity:.8">0</span></div>
				<div class="chip" id="markAllRead"><i class="fas fa-check-double"></i> Tout marquer lu</div>
				<div class="chip" id="refreshBtn"><i class="fas fa-sync-alt"></i> Actualiser</div>
			</div>
		</div>

		<div class="grid">
			<div class="panel" id="listPanel">
				<div class="panel-header">
					<span class="badge-pill">Filtré</span>
					<span id="activeFilterLabel" style="color:#bcd0ff">Tout</span>
				</div>
				<div class="content" id="rows"></div>
			</div>
			<div class="panel">
				<div class="stats">
					<div class="stat-title">Résumé</div>
					<div class="stat-item"><span>Total</span><strong id="statTotal">0</strong></div>
					<div class="stat-item"><span>Non lus</span><strong id="statUnread">0</strong></div>
					<div class="stat-item"><span>Lus</span><strong id="statRead">0</strong></div>
				</div>
			</div>
		</div>
	</div>

	<script>
		let state = { filter:'all', search:'', items:[] };

		const rowsEl = document.getElementById('rows');
		const chips = Array.from(document.querySelectorAll('.chip[data-filter]'));
		const searchInput = document.getElementById('searchInput');
		const statTotal = document.getElementById('statTotal');
		const statUnread = document.getElementById('statUnread');
		const statRead = document.getElementById('statRead');
		const countAll = document.getElementById('countAll');
		const countUnread = document.getElementById('countUnread');
		const countRead = document.getElementById('countRead');
		const activeFilterLabel = document.getElementById('activeFilterLabel');

		// ============ CHARGER LES NOTIFICATIONS DU BACKEND ============
		async function loadNotifications() {
			try {
				console.log('📡 Chargement des notifications...');
				const accessToken = localStorage.getItem('access_token');
				
				if (!accessToken) {
					console.error('❌ Token d\'accès manquant');
					rowsEl.innerHTML = '<div style="padding:16px;color:#c91f16">Erreur: Token d\'accès manquant</div>';
					return;
				}

				const response = await fetch(`${window.location.origin}/kodPwomo/backend/notifications/all`, {
					method: 'GET',
					headers: {
						'Accept': 'application/json',
						'Authorization': 'Bearer ' + accessToken
					}
				});

				if (!response.ok) {
					console.error('❌ Erreur lors du chargement:', response.status);
					rowsEl.innerHTML = '<div style="padding:16px;color:#c91f16">Erreur lors du chargement des notifications</div>';
					return;
				}

				const data = await response.json();
				console.log('✅ Notifications reçues:', data);

				// Vérifier la structure
				if (!data.notifications || !Array.isArray(data.notifications)) {
					console.warn('⚠️ Structure invalide');
					rowsEl.innerHTML = '<div style="padding:16px;color:#9bb2d9">Aucune notification</div>';
					return;
				}

				// Transformer les données du backend au format interne
				state.items = data.notifications.map((n) => ({
					id: n.id,
					type: n.type || 'system',
					title: getTitleByType(n.type, n.message),
					desc: n.message,
					ts: new Date(n.date).toISOString(),
					unread: n.status === 'unread',
					link: n.link || ''
				}));

				console.log('✅ Données transformées:', state.items);
				render();

			} catch (error) {
				console.error('❌ Erreur réseau:', error);
				rowsEl.innerHTML = '<div style="padding:16px;color:#c91f16">Erreur réseau: ' + error.message + '</div>';
			}
		}

		// Fonction pour déterminer le titre selon le type
		function getTitleByType(type, message) {
			switch(type) {
				case 'delivery_feedback': return 'Avis de livraison';
				case 'agent': return 'Notification agent';
				case 'commande': return 'Commande';
				default: return 'Notification système';
			}
		}

		// Obtenir l'icône selon le type
		function getIconByType(type) {
			switch(type) {
				case 'delivery_feedback': return '<i class="fas fa-star"></i>';
				case 'agent': return '<i class="fas fa-user-tie"></i>';
				case 'commande': return '<i class="fas fa-shopping-bag"></i>';
				default: return '<i class="fas fa-bell"></i>';
			}
		}

		// Event wiring
		chips.forEach(ch => ch.addEventListener('click', () => {
			chips.forEach(x => x.classList.remove('active'));
			ch.classList.add('active');
			const f = ch.getAttribute('data-filter');
			if (f) state.filter = f;
			activeFilterLabel.textContent = f === 'all' ? 'Tout' : (f === 'unread' ? 'Non lus' : 'Lus');
			render();
		}));

		document.getElementById('markAllRead').addEventListener('click', async () => {
			// Marquer toutes les notifications comme lues via une seule requête
			try {
				const btn = document.getElementById('markAllRead');
				
				// Vérifier si une requête est déjà en cours
				if (btn.disabled || btn.dataset.loading === 'true') {
					console.warn('⚠️ Requête déjà en cours, ignorée');
					return;
				}
				
				// Désactiver le bouton
				btn.disabled = true;
				btn.dataset.loading = 'true';
				btn.style.opacity = '0.5';
				btn.style.cursor = 'not-allowed';
				const originalText = btn.textContent;
				btn.textContent = 'Traitement...';
				
				console.log('📡 Marquage de toutes les notifications comme lues...');
				const accessToken = localStorage.getItem('access_token');
				
				if (!accessToken) {
					console.error('❌ Token d\'accès manquant');
					btn.disabled = false;
					btn.dataset.loading = 'false';
					btn.style.opacity = '1';
					btn.style.cursor = 'pointer';
					btn.textContent = originalText;
					return;
				}

				const payload = {
					all: true,
					status: 'read'
				};

				const response = await fetch(`${window.location.origin}/kodPwomo/backend/notifications/status`, {
					method: 'PUT',
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json',
						'Authorization': 'Bearer ' + accessToken
					},
					body: JSON.stringify(payload)
				});

				const result = await response.json();
				console.log('✅ Réponse du serveur:', result);

				if (result.status === 'success') {
					// Mettre à jour l'état local
					state.items = state.items.map(n => ({...n, unread:false}));
					console.log('✅ Toutes les notifications marquées comme lues');
					render();
				} else {
					console.error('❌ Erreur serveur:', result.error);
				}

			} catch (error) {
				console.error('❌ Erreur:', error);
			} finally {
				// Réactiver le bouton
				const btn = document.getElementById('markAllRead');
				btn.disabled = false;
				btn.dataset.loading = 'false';
				btn.style.opacity = '1';
				btn.style.cursor = 'pointer';
				btn.textContent = 'Tout marquer lu';
			}
		});

		// ============ METTRE À JOUR LE STATUS D'UNE NOTIFICATION ============
		async function updateNotificationStatus(notificationId, status, accessToken) {
			try {
				const payload = {
					notification_id: notificationId,
					status: status
				};

				console.log('📡 Mise à jour du status:', payload);

				const response = await fetch(`${window.location.origin}/kodPwomo/backend/notifications/status`, {
					method: 'PUT',
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json',
						'Authorization': 'Bearer ' + accessToken
					},
					body: JSON.stringify(payload)
				});

				const result = await response.json();
				console.log('📥 Réponse du serveur:', result);

				if (!response.ok) {
					console.error('❌ Erreur HTTP:', response.status, result.error);
					return;
				}

				if (result.status === 'success') {
					console.log('✅ Status mis à jour');
				} else {
					console.error('❌ Erreur serveur:', result.error);
				}

			} catch (error) {
				console.error('❌ Erreur réseau:', error);
			}
		}

		document.getElementById('refreshBtn').addEventListener('click', () => {
			loadNotifications();
		});

		searchInput.addEventListener('input', e => { state.search = e.target.value.trim().toLowerCase(); render(); });

		function timeAgo(ts){
			const d = new Date(ts);
			const diff = (Date.now() - d.getTime())/1000;
			if (diff < 60) return `${Math.floor(diff)}s`;
			if (diff < 3600) return `${Math.floor(diff/60)}m`;
			if (diff < 86400) return `${Math.floor(diff/3600)}h`;
			return d.toLocaleString();
		}

		function filtered(){
			let arr = [...state.items];
			if (state.filter === 'unread') arr = arr.filter(n => n.unread);
			if (state.filter === 'read') arr = arr.filter(n => !n.unread);
			if (state.search) arr = arr.filter(n =>
				n.title.toLowerCase().includes(state.search) ||
				n.desc.toLowerCase().includes(state.search)
			);
			return arr;
		}

		function render(){
			const arr = filtered();
			statTotal.textContent = state.items.length;
			statUnread.textContent = state.items.filter(n => n.unread).length;
			statRead.textContent = state.items.filter(n => !n.unread).length;
			countAll.textContent = state.items.length;
			countUnread.textContent = state.items.filter(n => n.unread).length;
			countRead.textContent = state.items.filter(n => !n.unread).length;

			rowsEl.innerHTML = '';
			if (!arr.length){
				rowsEl.innerHTML = '<div style="padding:16px;color:#9bb2d9">Aucune notification</div>';
				return;
			}
			arr.forEach(n => rowsEl.appendChild(rowEl(n)));
		}

		function rowEl(n){
			const wrap = document.createElement('div');
			wrap.className = 'row';
			wrap.innerHTML = `
				<div class="avatar">${getIconByType(n.type)}</div>
				<div class="meta">
					<div class="title">${n.title}</div>
					<div class="desc">${n.desc}</div>
					<div class="time">${timeAgo(n.ts)}</div>
					${n.link ? `<div class="more" style="cursor:pointer">Voir plus →</div>` : ''}
				</div>
				<div class="actions">
					<div class="badge-pill">${n.unread ? '<i class="fas fa-envelope"></i> Non lu' : '<i class="fas fa-envelope-open"></i> Lu'}</div>
					<button class="btn primary">${n.unread ? '<i class="fas fa-check"></i> Marquer lu' : '<i class="fas fa-times"></i> Marquer non lu'}</button>
					<button class="btn"><i class="fas fa-trash"></i> Supprimer</button>
				</div>
			`;
			// Actions
			const buttons = wrap.querySelectorAll('.btn');
			
			// Bouton marquer lu/non lu
			buttons[0].addEventListener('click', async () => {
				// Vérifier si une requête est déjà en cours
				if (buttons[0].disabled || buttons[0].dataset.loading === 'true') {
					console.warn('⚠️ Requête déjà en cours, ignorée');
					return;
				}
				
				// Désactiver le bouton
				buttons[0].disabled = true;
				buttons[0].dataset.loading = 'true';
				buttons[0].style.opacity = '0.5';
				const originalText = buttons[0].textContent;
				buttons[0].textContent = '⏳...';
				
				try {
					const accessToken = localStorage.getItem('access_token');
					if (!accessToken) {
						console.error('❌ Token d\'accès manquant');
						return;
					}

					const newStatus = n.unread ? 'read' : 'unread';
					await updateNotificationStatus(n.id, newStatus, accessToken);
					
					// Mettre à jour l'état local
					n.unread = !n.unread;
					render();
				} catch (error) {
					console.error('❌ Erreur:', error);
					// Réactiver le bouton en cas d'erreur
					buttons[0].disabled = false;
					buttons[0].dataset.loading = 'false';
					buttons[0].style.opacity = '1';
					buttons[0].textContent = originalText;
				}
			});
			
			// Bouton supprimer
			buttons[1].addEventListener('click', async () => {
				// Vérifier si une requête est déjà en cours
				if (buttons[1].disabled || buttons[1].dataset.loading === 'true') {
					console.warn('⚠️ Suppression déjà en cours, ignorée');
					return;
				}
				
				// Désactiver le bouton
				buttons[1].disabled = true;
				buttons[1].dataset.loading = 'true';
				buttons[1].style.opacity = '0.5';
				const deleteText = buttons[1].innerHTML;
				buttons[1].innerHTML = '<i class="fas fa-spinner fa-spin"></i> ⏳...';
				
				try {
					const accessToken = localStorage.getItem('access_token');
					if (!accessToken) {
						console.error('❌ Token d\'accès manquant');
						buttons[1].disabled = false;
						buttons[1].dataset.loading = 'false';
						buttons[1].style.opacity = '1';
						buttons[1].innerHTML = deleteText;
						return;
					}

					console.log('🗑️ Suppression de la notification:', n.id);
					
					const response = await fetch(`${window.location.origin}/kodPwomo/backend/notifications/${n.id}`, {
						method: 'DELETE',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'Authorization': 'Bearer ' + accessToken
						}
					});

					const result = await response.json();
					console.log('📥 Réponse du serveur:', result);

					if (result.status === 'success') {
						console.log('✅ Notification supprimée');
						// Supprimer de l'état local
						state.items = state.items.filter(x => x.id !== n.id);
						render();
					} else {
						console.error('❌ Erreur serveur:', result.error);
						// Réactiver le bouton en cas d'erreur
						buttons[1].disabled = false;
						buttons[1].dataset.loading = 'false';
						buttons[1].style.opacity = '1';
						buttons[1].innerHTML = deleteText;
					}

				} catch (error) {
					console.error('❌ Erreur réseau:', error);
					// Réactiver le bouton en cas d'erreur
					buttons[1].disabled = false;
					buttons[1].dataset.loading = 'false';
					buttons[1].style.opacity = '1';
					buttons[1].innerHTML = deleteText;
				}
			});
			
			// Voir plus: naviguer ou toggle clamp
			const more = wrap.querySelector('.more');
			const desc = wrap.querySelector('.desc');
			if (more) {
				more.addEventListener('click', () => {
					if (n.link) {
						window.location.href = n.link;
					} else {
						const expanded = desc.style.webkitLineClamp === 'unset';
						if (expanded){
							desc.style.webkitLineClamp = '2';
							more.textContent = 'Voir plus →';
						} else {
							desc.style.webkitLineClamp = 'unset';
							more.textContent = 'Voir moins ←';
						}
					}
				});
			}
			return wrap;
		}

		// Header nav toggle
		(function(){
			const btn = document.getElementById('hamburgerBtn');
			const menu = document.getElementById('navMenu');
			if (btn && menu){
				btn.addEventListener('click', function(){
					const isOpen = menu.classList.toggle('show');
					btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
				});
				document.addEventListener('click', function(e){
					if (!menu.contains(e.target) && !btn.contains(e.target)){
						menu.classList.remove('show');
						btn.setAttribute('aria-expanded','false');
					}
				});
				document.addEventListener('keydown', function(e){
					if (e.key === 'Escape'){
						menu.classList.remove('show');
						btn.setAttribute('aria-expanded','false');
					}
				});
			}
		})();

		// Charger les notifications au démarrage
		loadNotifications();
	</script>
	 <?php include 'heartbeat.php'; ?>
</body>
</html>
