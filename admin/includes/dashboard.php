<?php
// Simulation de données temps réel ultra-réaliste
$currentHour = date('H');
$currentMinute = date('i');

// Données qui évoluent selon l'heure
$liveStats = [
    'universities_active' => 8,
    'total_users' => 15420 + rand(-50, 100),
    'monthly_orders' => 8934 + rand(-20, 50),
    'daily_revenue' => ($currentHour < 12 ? 45000 : 78000) + rand(-5000, 15000),
    'online_users' => $currentHour >= 8 && $currentHour <= 22 ? rand(120, 350) : rand(15, 60),
    'pending_orders' => rand(5, 25),
    'delivery_agents_active' => $currentHour >= 7 && $currentHour <= 23 ? rand(25, 47) : rand(3, 12),
    'avg_delivery_time' => rand(18, 32),
    'satisfaction_rate' => rand(94, 99) + (rand(0, 9) / 10)
];

// Activités récentes dynamiques
$recentActivities = [
    [
        'type' => 'order',
        'icon' => '✅',
        'title' => 'Nouvelle commande #' . (8934 + rand(1, 100)),
        'description' => 'UNIKIN - Pizza Margherita - ' . number_format(rand(12000, 25000)) . ' FC',
        'time' => rand(1, 5) . ' min',
        'status' => 'success'
    ],
    [
        'type' => 'user',
        'icon' => '👤',
        'title' => 'Nouvel utilisateur inscrit',
        'description' => 'Student - Université de Lubumbashi',
        'time' => rand(3, 15) . ' min',
        'status' => 'info'
    ],
    [
        'type' => 'delivery',
        'icon' => '🚚',
        'title' => 'Livraison terminée',
        'description' => 'Commande #' . (8900 + rand(1, 33)) . ' - Temps: ' . rand(15, 30) . ' min',
        'time' => rand(5, 25) . ' min',
        'status' => 'success'
    ],
    [
        'type' => 'stock',
        'icon' => '⚠️',
        'title' => 'Stock faible détecté',
        'description' => ['Café Expresso', 'Pizza Margherita', 'Sandwich Club', 'Jus d\'Orange'][rand(0,3)] . ' - Reste ' . rand(3, 12) . ' unités',
        'time' => rand(30, 90) . ' min',
        'status' => 'warning'
    ],
    [
        'type' => 'payment',
        'icon' => '💳',
        'title' => 'Paiement traité',
        'description' => 'Transaction ' . strtoupper(substr(md5(time()), 0, 8)) . ' - ' . number_format(rand(8000, 35000)) . ' FC',
        'time' => rand(2, 8) . ' min',
        'status' => 'success'
    ]
];

// Top universités avec données réalistes
$topUniversities = [
    ['name' => 'UNIKIN', 'orders' => 2340 + rand(-50, 100), 'revenue' => 89600 + rand(-5000, 10000), 'growth' => '+12.5%', 'color' => 'var(--primary)'],
    ['name' => 'UNILU', 'orders' => 1890 + rand(-30, 80), 'revenue' => 72300 + rand(-3000, 8000), 'growth' => '+8.7%', 'color' => 'var(--accent)'],
    ['name' => 'UOB', 'orders' => 1456 + rand(-20, 60), 'revenue' => 55800 + rand(-2000, 6000), 'growth' => '+15.2%', 'color' => 'var(--success)'],
    ['name' => 'UNIKIS', 'orders' => 987 + rand(-15, 40), 'revenue' => 38900 + rand(-1500, 4000), 'growth' => '+5.3%', 'color' => 'var(--warning)']
];

// Métriques performance temps réel
$performanceMetrics = [
    'server_cpu' => rand(25, 75),
    'database_load' => rand(15, 45), 
    'api_response' => rand(120, 280),
    'error_rate' => rand(0, 3) + (rand(0, 9) / 10),
    'cache_hit' => rand(85, 98),
    'uptime' => 99.7 + (rand(0, 3) / 10)
];
?>

<div class="page-header">
  <h2 class="page-title">📊 Dashboard Principal</h2>
  <p class="page-subtitle">
    Vue d'ensemble temps réel de la plateforme KodPwomo - 
    Dernière mise à jour: <span style="color: var(--success); font-weight: 600;"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Statistiques principales temps réel -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon">🏫</div>
    <div class="stat-value"><?= $liveStats['universities_active'] ?></div>
    <div class="stat-label">Universités Actives</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Toutes opérationnelles</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">👥</div>
    <div class="stat-value" id="live-users"><?= number_format($liveStats['total_users']) ?></div>
    <div class="stat-label">Utilisateurs Totaux</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= $liveStats['online_users'] ?> en ligne maintenant</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📦</div>
    <div class="stat-value" id="live-orders"><?= number_format($liveStats['monthly_orders']) ?></div>
    <div class="stat-label">Commandes Ce Mois</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= $liveStats['pending_orders'] ?> en attente</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💰</div>
    <div class="stat-value" id="live-revenue"><?= number_format($liveStats['daily_revenue']) ?> FC</div>
    <div class="stat-label">Revenus Aujourd'hui</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= rand(500, 2000) ?> FC/heure</span>
    </div>
  </div>
</div>

<!-- Métriques de performance en temps réel -->
<div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      📈 Performance Système
      <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">LIVE</span>
    </h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
      <div style="text-align: center;">
        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">CPU Usage</div>
        <div style="font-size: 1.8rem; font-weight: 700; color: <?= $performanceMetrics['server_cpu'] > 60 ? 'var(--warning)' : 'var(--success)' ?>;">
          <?= $performanceMetrics['server_cpu'] ?>%
        </div>
      </div>
      <div style="text-align: center;">
        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">API Response</div>
        <div style="font-size: 1.8rem; font-weight: 700; color: <?= $performanceMetrics['api_response'] > 200 ? 'var(--warning)' : 'var(--success)' ?>;">
          <?= $performanceMetrics['api_response'] ?>ms
        </div>
      </div>
      <div style="text-align: center;">
        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">Uptime</div>
        <div style="font-size: 1.8rem; font-weight: 700; color: var(--success);">
          <?= $performanceMetrics['uptime'] ?>%
        </div>
      </div>
      <div style="text-align: center;">
        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">Error Rate</div>
        <div style="font-size: 1.8rem; font-weight: 700; color: <?= $performanceMetrics['error_rate'] > 2 ? 'var(--error)' : 'var(--success)' ?>;">
          <?= $performanceMetrics['error_rate'] ?>%
        </div>
      </div>
    </div>
  </div>
  
  <div class="stat-card">
    <h3 style="margin-bottom: 1rem; color: var(--text-primary);">🚚 Livraisons</h3>
    <div style="text-align: center; margin-bottom: 1rem;">
      <div style="font-size: 2.5rem; font-weight: 900; color: var(--accent);"><?= $liveStats['delivery_agents_active'] ?></div>
      <div style="color: var(--text-muted); font-size: 0.9rem;">Agents Actifs</div>
    </div>
    <div style="text-align: center;">
      <div style="font-size: 1.5rem; font-weight: 700; color: var(--success);"><?= $liveStats['avg_delivery_time'] ?> min</div>
      <div style="color: var(--text-muted); font-size: 0.85rem;">Temps Moyen</div>
    </div>
  </div>
  
  <div class="stat-card">
    <h3 style="margin-bottom: 1rem; color: var(--text-primary);">⭐ Satisfaction</h3>
    <div style="text-align: center; margin-bottom: 1rem;">
      <div style="font-size: 2.5rem; font-weight: 900; color: var(--success);"><?= number_format($liveStats['satisfaction_rate'], 1) ?>%</div>
      <div style="color: var(--text-muted); font-size: 0.9rem;">Taux Global</div>
    </div>
    <div style="display: flex; justify-content: center; gap: 0.25rem;">
      <?php for($i = 1; $i <= 5; $i++): ?>
        <span style="color: var(--warning); font-size: 1.2rem;">⭐</span>
      <?php endfor; ?>
    </div>
  </div>
</div>

<!-- Graphiques temps réel et Top universités -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h3 style="margin: 0; color: var(--text-primary);">📊 Commandes Temps Réel (Aujourd'hui)</h3>
      <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-size: 0.85rem;">
        <div class="realtime-dot"></div>
        <span>Live Update</span>
      </div>
    </div>
    <div style="height: 200px; display: flex; align-items: end; gap: 0.5rem;">
      <?php 
      $hours = ['8h', '10h', '12h', '14h', '16h', '18h', '20h', '22h'];
      foreach($hours as $i => $hour): 
        $height = rand(40, 100);
        $isCurrentHour = (date('H') >= ($i + 8) && date('H') < ($i + 10));
      ?>
        <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
          <div style="
            background: <?= $isCurrentHour ? 'var(--success)' : 'var(--primary)' ?>; 
            height: <?= $height ?>%; 
            width: 100%; 
            border-radius: 4px; 
            margin-bottom: 0.5rem;
            <?= $isCurrentHour ? 'animation: pulse 2s infinite;' : '' ?>
          "></div>
          <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: <?= $isCurrentHour ? '700' : '400' ?>;"><?= $hour ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🏆 Top Universités</h3>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
      <?php foreach($topUniversities as $index => $uni): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 3px solid <?= $uni['color'] ?>;">
          <div>
            <div style="color: var(--text-primary); font-weight: 600;"><?= $uni['name'] ?></div>
            <div style="color: var(--text-muted); font-size: 0.85rem;"><?= number_format($uni['orders']) ?> commandes</div>
          </div>
          <div style="text-align: right;">
            <div style="color: var(--success); font-weight: 600; font-size: 0.9rem;"><?= $uni['growth'] ?></div>
            <div style="color: var(--text-secondary); font-size: 0.8rem;"><?= number_format($uni['revenue']) ?> FC</div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- Activités récentes temps réel -->
<div class="stat-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h3 style="margin: 0; color: var(--text-primary);">📋 Activités Récentes</h3>
    <div style="display: flex; gap: 0.5rem;">
      <button onclick="refreshActivities()" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.5rem; border-radius: 6px; cursor: pointer; font-size: 0.9rem;">
        🔄 Actualiser
      </button>
      <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-size: 0.85rem;">
        <div class="realtime-dot"></div>
        <span>Auto-refresh 30s</span>
      </div>
    </div>
  </div>
  
  <div id="activities-container" style="display: flex; flex-direction: column; gap: 0.75rem;">
    <?php foreach($recentActivities as $activity): ?>
      <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; transition: all 0.3s ease;" 
           onmouseenter="this.style.background='rgba(255,255,255,0.06)'" 
           onmouseleave="this.style.background='rgba(255,255,255,0.03)'">
        <div style="font-size: 1.5rem;"><?= $activity['icon'] ?></div>
        <div style="flex: 1;">
          <div style="color: var(--text-primary); font-weight: 500;"><?= $activity['title'] ?></div>
          <div style="color: var(--text-muted); font-size: 0.9rem;"><?= $activity['description'] ?></div>
        </div>
        <div style="text-align: right;">
          <div style="color: var(--text-muted); font-size: 0.85rem;">Il y a <?= $activity['time'] ?></div>
          <div style="margin-top: 0.25rem;">
            <span style="
              background: var(--<?= $activity['status'] ?>); 
              color: white; 
              padding: 0.15rem 0.5rem; 
              border-radius: 999px; 
              font-size: 0.7rem; 
              font-weight: 600;
            "><?= ucfirst($activity['status']) ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Actions rapides avec effet réaliste -->
<div style="margin-top: 2rem;">
  <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">⚡ Actions Rapides</h3>
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
    <button onclick="quickAction('orders')" style="
      background: linear-gradient(135deg, var(--primary), var(--primary-dark)); 
      border: none; 
      color: white; 
      padding: 1.25rem; 
      border-radius: 12px; 
      cursor: pointer; 
      font-weight: 600; 
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
      <span style="font-size: 1.3rem;">📦</span>
      <div style="text-align: left;">
        <div>Voir Commandes</div>
        <div style="font-size: 0.8rem; opacity: 0.9;"><?= $liveStats['pending_orders'] ?> en attente</div>
      </div>
    </button>
    
    <button onclick="quickAction('users')" style="
      background: linear-gradient(135deg, var(--success), #059669); 
      border: none; 
      color: white; 
      padding: 1.25rem; 
      border-radius: 12px; 
      cursor: pointer; 
      font-weight: 600; 
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
      <span style="font-size: 1.3rem;">👥</span>
      <div style="text-align: left;">
        <div>Gérer Utilisateurs</div>
        <div style="font-size: 0.8rem; opacity: 0.9;"><?= $liveStats['online_users'] ?> en ligne</div>
      </div>
    </button>
    
    <button onclick="quickAction('analytics')" style="
      background: linear-gradient(135deg, var(--accent), #0891b2); 
      border: none; 
      color: white; 
      padding: 1.25rem; 
      border-radius: 12px; 
      cursor: pointer; 
      font-weight: 600; 
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(6, 182, 212, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
      <span style="font-size: 1.3rem;">📊</span>
      <div style="text-align: left;">
        <div>Analytics</div>
        <div style="font-size: 0.8rem; opacity: 0.9;">Rapports détaillés</div>
      </div>
    </button>
    
    <button onclick="quickAction('settings')" style="
      background: linear-gradient(135deg, var(--warning), #d97706); 
      border: none; 
      color: white; 
      padding: 1.25rem; 
      border-radius: 12px; 
      cursor: pointer; 
      font-weight: 600; 
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(245, 158, 11, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
      <span style="font-size: 1.3rem;">⚙️</span>
      <div style="text-align: left;">
        <div>Paramètres</div>
        <div style="font-size: 0.8rem; opacity: 0.9;">Configuration</div>
      </div>
    </button>
  </div>
</div>

<script>
// Actions rapides réalistes
function quickAction(action) {
  const actions = {
    'orders': () => {
      showToast('Redirection vers la gestion des commandes...', 'info');
      setTimeout(() => window.location = '?page=orders', 1000);
    },
    'users': () => {
      showToast('Chargement de la base utilisateurs...', 'info');
      setTimeout(() => window.location = '?page=users', 1000);
    },
    'analytics': () => {
      showToast('Génération des rapports analytics...', 'info');
      setTimeout(() => window.location = '?page=analytics', 1000);
    },
    'settings': () => {
      showToast('Ouverture des paramètres système...', 'info');
      setTimeout(() => window.location = '?page=settings', 1000);
    }
  };
  
  actions[action] && actions[action]();
}

// Actualisation des activités
function refreshActivities() {
  showToast('Actualisation des activités récentes...', 'info');
  const container = document.getElementById('activities-container');
  container.style.opacity = '0.5';
  
  setTimeout(() => {
    container.style.opacity = '1';
    showToast('Activités mises à jour', 'success');
  }, 1500);
}

// Simulation temps réel des données
function updateRealTimeData() {
  // Mise à jour des utilisateurs en ligne
  const usersElement = document.getElementById('live-users');
  if (usersElement) {
    const currentUsers = parseInt(usersElement.textContent.replace(/,/g, ''));
    const change = Math.floor(Math.random() * 20) - 10;
    const newUsers = Math.max(15000, currentUsers + change);
    usersElement.textContent = new Intl.NumberFormat().format(newUsers);
  }
  
  // Mise à jour des commandes
  const ordersElement = document.getElementById('live-orders');
  if (ordersElement) {
    const currentOrders = parseInt(ordersElement.textContent.replace(/,/g, ''));
    if (Math.random() > 0.7) { // 30% chance d'augmenter
      ordersElement.textContent = new Intl.NumberFormat().format(currentOrders + 1);
      showToast('Nouvelle commande reçue! 📦', 'success');
    }
  }
  
  // Mise à jour des revenus
  const revenueElement = document.getElementById('live-revenue');
  if (revenueElement) {
    const currentRevenue = parseInt(revenueElement.textContent.replace(/[FC,\s]/g, ''));
    const increase = Math.floor(Math.random() * 2000) + 500;
    revenueElement.textContent = new Intl.NumberFormat().format(currentRevenue + increase) + ' FC';
  }
}

// Auto-refresh toutes les 30 secondes
setInterval(updateRealTimeData, 30000);

// Refresh activités toutes les 60 secondes
setInterval(() => {
  if (Math.random() > 0.5) {
    refreshActivities();
  }
}, 60000);
</script>