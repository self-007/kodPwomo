<?php $page = $_GET['page'] ?? 'dashboard'; ?>
<?php
session_start();
// Simulation d'authentification super admin réaliste
date_default_timezone_set('Africa/Kinshasa');
$currentTime = date('H:i:s');
$currentDate = date('d/m/Y');
$adminName = "Dr. Joseph Kabila";
$adminRole = "Super Administrateur";
$lastLogin = date('d/m/Y à H:i', strtotime('-2 hours'));

// Simulation de données en temps réel
$realTimeData = [
    'online_users' => rand(145, 289),
    'active_orders' => rand(12, 34),
    'daily_revenue' => rand(45000, 78000),
    'server_load' => rand(23, 67),
    'new_notifications' => rand(2, 8)
];

$isSuperAdmin = true;

if($isSuperAdmin) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KodPwomo Super Admin - <?= ucfirst($page) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --accent: #06b6d4;
      --success: #10b981;
      --warning: #f59e0b;
      --error: #ef4444;
      --bg-primary: #0a0a1a;
      --bg-secondary: #1a1625;
      --bg-card: #312e81;
      --text-primary: #ffffff;
      --text-secondary: #cbd5e1;
      --text-muted: #94a3b8;
      --border: #475569;
      --glass-bg: rgba(49, 46, 129, 0.3);
      --glass-border: rgba(255, 255, 255, 0.1);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
      color: var(--text-primary);
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    nav {
      width: 260px;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border-right: 1px solid var(--glass-border);
      padding: 20px;
      flex-shrink: 0;
      transition: transform 0.3s ease;
      overflow-y: auto;
    }

    .admin-profile {
      text-align: center;
      margin-bottom: 2rem;
      padding: 1rem;
      background: rgba(255,255,255,0.03);
      border-radius: 12px;
      border: 1px solid var(--glass-border);
    }

    .admin-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 800;
      color: white;
      margin: 0 auto 0.75rem;
    }

    .admin-name {
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 0.25rem;
    }

    .admin-role {
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    .nav-section {
      margin-bottom: 2rem;
    }

    .nav-section-title {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 0.5rem;
      padding-left: 0.5rem;
    }

    nav a {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin: 8px 0;
      padding: 12px;
      border-radius: 12px;
      text-decoration: none;
      color: var(--text-secondary);
      transition: all 0.2s ease;
      font-weight: 500;
      position: relative;
    }

    nav a:hover, nav a.active {
      background: var(--primary);
      color: white;
      transform: translateX(4px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .nav-icon {
      font-size: 1.1rem;
      width: 20px;
      text-align: center;
    }

    .nav-badge {
      margin-left: auto;
      padding: 0.25rem 0.5rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      animation: pulse 2s infinite;
    }

    .nav-badge.success {
      background: var(--success);
      color: white;
    }

    .nav-badge.warning {
      background: var(--warning);
      color: white;
    }

    .nav-badge.live {
      background: var(--error);
      color: white;
    }

    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.7; }
      100% { opacity: 1; }
    }

    .container {
      display: flex;
      flex-direction: column;
      flex: 1;
      height: 100vh;
    }

    header {
      height: 70px;
      flex-shrink: 0;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .breadcrumb {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    .page-title-header {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-primary);
      margin: 0;
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .time-display {
      background: var(--glass-bg);
      padding: 0.5rem 1rem;
      border-radius: 8px;
      border: 1px solid var(--glass-border);
      font-size: 0.9rem;
      color: var(--text-secondary);
      font-weight: 600;
    }

    .notification-btn {
      position: relative;
      padding: 0.75rem;
      border-radius: 50%;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      color: var(--text-primary);
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 1.1rem;
    }

    .notification-btn:hover {
      background: var(--primary);
      transform: scale(1.05);
    }

    .notification-badge {
      position: absolute;
      top: -4px;
      right: -4px;
      width: 20px;
      height: 20px;
      background: var(--error);
      border-radius: 50%;
      font-size: 0.7rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: bounce 1s infinite;
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
      40% { transform: translateY(-3px); }
      60% { transform: translateY(-1px); }
    }

    #menu-toggle {
      display: none;
      background: var(--primary);
      border: none;
      color: white;
      padding: 8px 16px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
    }

    main {
      flex: 1;
      overflow-y: auto;
      padding: 30px;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    footer {
      text-align: center;
      padding: 15px;
      color: var(--text-muted);
      font-size: 0.85rem;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border-top: 1px solid var(--glass-border);
      flex-shrink: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-stats {
      display: flex;
      gap: 2rem;
      font-size: 0.8rem;
    }

    .footer-stat {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .status-indicator {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--success);
      animation: pulse 2s infinite;
    }

    /* Page Content Styles */
    .page-header {
      margin-bottom: 2rem;
      animation: slideInDown 0.5s ease;
    }

    @keyframes slideInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .page-title {
      font-size: 2rem;
      font-weight: 800;
      color: var(--text-primary);
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      font-size: 1.1rem;
      color: var(--text-muted);
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 1.5rem;
      transition: all 0.3s ease;
      animation: slideInUp 0.6s ease;
    }

    @keyframes slideInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .stat-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(99, 102, 241, 0.25);
      border-color: var(--primary);
    }

    .stat-icon {
      font-size: 2rem;
      margin-bottom: 0.5rem;
    }

    .stat-value {
      font-size: 2rem;
      font-weight: 900;
      color: var(--text-primary);
    }

    .stat-label {
      font-size: 0.9rem;
      color: var(--text-muted);
      font-weight: 500;
    }

    .realtime-indicator {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.8rem;
      color: var(--success);
      margin-top: 0.5rem;
    }

    .realtime-dot {
      width: 6px;
      height: 6px;
      background: var(--success);
      border-radius: 50%;
      animation: pulse 1.5s infinite;
    }

    /* RESPONSIVE */
    @media screen and (max-width: 768px) {
      nav {
        position: fixed;
        top: 70px;
        left: 0;
        height: calc(100% - 70px);
        transform: translateX(-100%);
        z-index: 999;
        width: 280px;
      }

      nav.open {
        transform: translateX(0);
      }

      #menu-toggle {
        display: inline-block;
      }

      main {
        padding: 20px;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .page-title {
        font-size: 1.5rem;
      }

      .footer-stats {
        display: none;
      }
    }

    /* Toast Notifications */
    .toast {
      position: fixed;
      top: 90px;
      right: 20px;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      padding: 1rem 1.5rem;
      color: var(--text-primary);
      z-index: 9999;
      opacity: 0;
      transform: translateX(100%);
      transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      min-width: 300px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .toast.show {
      opacity: 1;
      transform: translateX(0);
    }

    .toast.success {
      border-color: var(--success);
      background: rgba(16, 185, 129, 0.1);
    }

    .toast.error {
      border-color: var(--error);
      background: rgba(239, 68, 68, 0.1);
    }

    .toast.warning {
      border-color: var(--warning);
      background: rgba(245, 158, 11, 0.1);
    }

    .toast.info {
      border-color: var(--accent);
      background: rgba(6, 182, 212, 0.1);
    }
  </style>
</head>
<body>
  
  <nav id="sidebar">
    <div class="admin-profile">
      <div class="admin-avatar">JK</div>
      <div class="admin-name"><?= $adminName ?></div>
      <div class="admin-role"><?= $adminRole ?></div>
    </div>
    
    <div class="nav-section">
      <div class="nav-section-title">📊 Vue d'ensemble</div>
      <a href="?page=dashboard" class="<?= $page == 'dashboard' ? 'active' : '' ?>">
        <span class="nav-icon">🏠</span>
        <span>Dashboard</span>
        <span class="nav-badge live"><?= $realTimeData['online_users'] ?></span>
      </a>
      <a href="?page=analytics" class="<?= $page == 'analytics' ? 'active' : '' ?>">
        <span class="nav-icon">📈</span>
        <span>Analytics</span>
      </a>
      <a href="?page=monitoring" class="<?= $page == 'monitoring' ? 'active' : '' ?>">
        <span class="nav-icon">🖥️</span>
        <span>Monitoring</span>
        <span class="nav-badge success">Live</span>
      </a>
    </div>
    
    <div class="nav-section">
      <div class="nav-section-title">🏛️ Gestion Platform</div>
      <a href="?page=universities" class="<?= $page == 'universities' ? 'active' : '' ?>">
        <span class="nav-icon">🏫</span>
        <span>Universités</span>
        <span class="nav-badge warning">8</span>
      </a>
      <a href="?page=users" class="<?= $page == 'users' ? 'active' : '' ?>">
        <span class="nav-icon">👥</span>
        <span>Utilisateurs</span>
        <span class="nav-badge success"><?= number_format($realTimeData['online_users']) ?></span>
      </a>
      <a href="?page=orders" class="<?= $page == 'orders' ? 'active' : '' ?>">
        <span class="nav-icon">📦</span>
        <span>Commandes</span>
        <span class="nav-badge warning"><?= $realTimeData['active_orders'] ?></span>
      </a>
      <a href="?page=products" class="<?= $page == 'products' ? 'active' : '' ?>">
        <span class="nav-icon">🍔</span>
        <span>Produits</span>
      </a>
      <a href="?page=agents" class="<?= $page == 'agents' ? 'active' : '' ?>">
        <span class="nav-icon">🚚</span>
        <span>Livreurs</span>
        <span class="nav-badge success">47</span>
      </a>
    </div>
    
    <div class="nav-section">
      <div class="nav-section-title">⚙️ Administration</div>
      <a href="?page=managers" class="<?= $page == 'managers' ? 'active' : '' ?>">
        <span class="nav-icon">👨‍💼</span>
        <span>Managers</span>
        <span class="nav-badge warning"><?= $realTimeData['new_notifications'] ?></span>
      </a>
      <a href="?page=financial" class="<?= $page == 'financial' ? 'active' : '' ?>">
        <span class="nav-icon">💰</span>
        <span>Financier</span>
      </a>
      <a href="?page=settings" class="<?= $page == 'settings' ? 'active' : '' ?>">
        <span class="nav-icon">⚙️</span>
        <span>Paramètres</span>
      </a>
      <a href="../index.php">
        <span class="nav-icon">🌐</span>
        <span>Site Public</span>
      </a>
      <a href="javascript:void(0)" onclick="logout()">
        <span class="nav-icon">🚪</span>
        <span>Déconnexion</span>
      </a>
    </div>
  </nav>

  <div class="container">
    <header>
      <div class="header-left">
        <div>
          <div class="breadcrumb">KodPwomo Admin / <?= ucfirst($page) ?></div>
          <h1 class="page-title-header">
            <?php 
            $titles = [
              'dashboard' => '🏠 Tableau de Bord',
              'analytics' => '📈 Analytics Avancées',
              'monitoring' => '🖥️ Monitoring Système',
              'universities' => '🏫 Gestion Universités',
              'users' => '👥 Gestion Utilisateurs',
              'orders' => '📦 Gestion Commandes',
              'products' => '🍔 Gestion Produits',
              'agents' => '🚚 Gestion Livreurs',
              'managers' => '👨‍💼 Gestion Managers',
              'financial' => '💰 Gestion Financière',
              'settings' => '⚙️ Paramètres Système'
            ];
            echo $titles[$page] ?? '🚀 KodPwomo Admin';
            ?>
          </h1>
        </div>
      </div>
      
      <div class="header-actions">
        <div class="time-display" id="live-time">
          <?= $currentTime ?> | <?= $currentDate ?>
        </div>
        <button class="notification-btn" onclick="showNotifications()">
          🔔
          <span class="notification-badge" id="notif-count"><?= $realTimeData['new_notifications'] ?></span>
        </button>
        <button id="menu-toggle">☰</button>
      </div>
    </header>

    <main>
      <?php
        // Navigation par page avec includes modulaires
        switch($page) {
          case 'dashboard':
            include 'includes/dashboard.php';
            break;
          case 'analytics':
            include 'includes/analytics.php';
            break;
          case 'monitoring':
            include 'includes/monitoring.php';
            break;
          case 'universities':
            include 'includes/universities.php';
            break;
          case 'users':
            include 'includes/users.php';
            break;
          case 'orders':
            include 'includes/orders.php';
            break;
          case 'products':
            include 'includes/products.php';
            break;
          case 'agents':
            include 'includes/agents.php';
            break;
          case 'managers':
            include 'includes/managers.php';
            break;
          case 'financial':
            include 'includes/financial.php';
            break;
          case 'settings':
            include 'includes/settings.php';
            break;
          default:
            echo "<div style='color: var(--primary); background: var(--glass-bg); border-radius: 16px; padding: 3rem; text-align: center; border: 1px solid var(--glass-border);'>
              <div style='font-size: 4rem; margin-bottom: 1rem;'>🚀</div>
              <h2>Bienvenue <?= explode(' ', $adminName)[1] ?> !</h2>
              <p style='color: var(--text-muted); margin-top: 1rem; font-size: 1.1rem;'>Plateforme de gestion KodPwomo</p>
              <p style='color: var(--text-secondary); margin-top: 0.5rem;'>Dernière connexion: <?= $lastLogin ?></p>
              <div style='margin-top: 2rem; display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;'>
                <button onclick=\"window.location='?page=dashboard'\" style='background: var(--primary); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600;'>📊 Dashboard</button>
                <button onclick=\"window.location='?page=orders'\" style='background: var(--success); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600;'>📦 Commandes</button>
                <button onclick=\"window.location='?page=users'\" style='background: var(--accent); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600;'>👥 Utilisateurs</button>
              </div>
            </div>";
        }
      ?>
    </main>

    <footer>
      <div>
        &copy; <?= date('Y') ?> KodPwomo Super Admin | Connecté: <strong><?= $adminName ?></strong>
      </div>
      
      <div class="footer-stats">
        <div class="footer-stat">
          <div class="status-indicator"></div>
          <span>Système Opérationnel</span>
        </div>
        <div class="footer-stat">
          <span>👥 <?= $realTimeData['online_users'] ?> en ligne</span>
        </div>
        <div class="footer-stat">
          <span>💰 <?= number_format($realTimeData['daily_revenue']) ?> FC aujourd'hui</span>
        </div>
        <div class="footer-stat">
          <span>⚡ CPU: <?= $realTimeData['server_load'] ?>%</span>
        </div>
      </div>
    </footer>
  </div>

  <script>
    // Navigation mobile
    const toggle = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");

    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });

    // Horloge en temps réel
    function updateTime() {
      const now = new Date();
      const timeStr = now.toLocaleTimeString('fr-CD', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      }) + ' | ' + now.toLocaleDateString('fr-CD');
      document.getElementById('live-time').textContent = timeStr;
    }
    setInterval(updateTime, 1000);

    // Simulation de notifications en temps réel
    function updateNotifications() {
      const count = Math.floor(Math.random() * 15) + 1;
      const badge = document.getElementById('notif-count');
      if (badge) {
        badge.textContent = count;
        if (count > 10) {
          badge.style.animation = 'bounce 0.5s ease';
        }
      }
    }
    setInterval(updateNotifications, 30000); // Toutes les 30 secondes

    // Toast notifications réalistes
    function showToast(message, type = 'info') {
      const toast = document.createElement('div');
      toast.className = `toast ${type}`;
      
      const icon = {
        'success': '✅',
        'error': '❌', 
        'warning': '⚠️',
        'info': 'ℹ️'
      };
      
      toast.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <span style="font-size: 1.2rem;">${icon[type] || 'ℹ️'}</span>
          <div>
            <div style="font-weight: 600;">${message}</div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
              ${new Date().toLocaleTimeString('fr-CD')}
            </div>
          </div>
        </div>
      `;
      
      document.body.appendChild(toast);
      
      setTimeout(() => toast.classList.add('show'), 100);
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
      }, 4000);
    }

    // Actions interactives réalistes
    function editItem(type, id) {
      showToast(`Ouverture éditeur ${type}: ${id}`, 'info');
      setTimeout(() => showToast(`${type} ${id} mis à jour`, 'success'), 1500);
    }

    function deleteItem(type, id) {
      if (confirm(`⚠️ Supprimer définitivement ${type}: ${id} ?\n\nCette action est irréversible.`)) {
        showToast(`Suppression de ${type} ${id}...`, 'warning');
        setTimeout(() => showToast(`${type} ${id} supprimé avec succès`, 'success'), 2000);
      }
    }

    function approveItem(type, id) {
      showToast(`Validation de ${type}: ${id}`, 'info');
      setTimeout(() => showToast(`${type} ${id} approuvé et activé`, 'success'), 1000);
    }

    function rejectItem(type, id) {
      if (confirm(`Rejeter ${type}: ${id} ?`)) {
        showToast(`${type} ${id} rejeté`, 'warning');
      }
    }

    function showNotifications() {
      showToast('Centre de notifications ouvert', 'info');
      // Ici on pourrait ouvrir un modal avec les vraies notifications
    }

    function logout() {
      if (confirm('Se déconnecter de la session admin ?')) {
        showToast('Déconnexion en cours...', 'info');
        setTimeout(() => {
          window.location.href = '../index.php';
        }, 1500);
      }
    }

    // Simulation de données temps réel
    function simulateRealTimeUpdates() {
      // Mise à jour des badges de navigation
      const badges = document.querySelectorAll('.nav-badge.live, .nav-badge.warning');
      badges.forEach(badge => {
        if (badge.textContent && !isNaN(badge.textContent)) {
          const currentVal = parseInt(badge.textContent);
          const change = Math.floor(Math.random() * 6) - 2; // -2 à +3
          const newVal = Math.max(0, currentVal + change);
          badge.textContent = newVal;
        }
      });
      
      // Animation des indicateurs live
      const liveIndicators = document.querySelectorAll('.realtime-dot, .status-indicator');
      liveIndicators.forEach(indicator => {
        indicator.style.animation = 'none';
        setTimeout(() => indicator.style.animation = 'pulse 1.5s infinite', 10);
      });
    }

    // Mise à jour toutes les 5 secondes pour effet réaliste
    setInterval(simulateRealTimeUpdates, 5000);

    // Message de bienvenue réaliste au chargement
    window.addEventListener('load', () => {
      setTimeout(() => {
        showToast(`Bienvenue Dr. Kabila! Session admin activée`, 'success');
      }, 1000);
    });
  </script>

</body>
</html>
<?php
} else {
    header("Location: ../login.php");
    exit;
}
?>