<?php
// Système de rapports avancés KodPwomo
$currentTime = time();

// Types de rapports disponibles
$reportTypes = [
    'sales' => [
        'name' => 'Rapport des Ventes',
        'icon' => '💰',
        'color' => 'var(--success)',
        'description' => 'Analyse détaillée des revenus et performances commerciales',
        'frequency' => 'Quotidien, Hebdomadaire, Mensuel'
    ],
    'orders' => [
        'name' => 'Rapport des Commandes',
        'icon' => '📦',
        'color' => 'var(--primary)',
        'description' => 'Suivi des commandes, statuts et temps de traitement',
        'frequency' => 'Temps réel, Quotidien'
    ],
    'users' => [
        'name' => 'Rapport Utilisateurs',
        'icon' => '👥',
        'color' => 'var(--accent)',
        'description' => 'Croissance utilisateurs, engagement et rétention',
        'frequency' => 'Hebdomadaire, Mensuel'
    ],
    'delivery' => [
        'name' => 'Rapport Livraisons',
        'icon' => '🚚',
        'color' => 'var(--warning)',
        'description' => 'Performance livreurs, temps et zones de couverture',
        'frequency' => 'Quotidien, Hebdomadaire'
    ],
    'inventory' => [
        'name' => 'Rapport Stock',
        'icon' => '📊',
        'color' => 'var(--info)',
        'description' => 'Gestion des stocks, rotation et approvisionnement',
        'frequency' => 'Quotidien'
    ],
    'financial' => [
        'name' => 'Rapport Financier',
        'icon' => '💎',
        'color' => 'var(--error)',
        'description' => 'Bilan financier, marges et rentabilité',
        'frequency' => 'Mensuel, Trimestriel'
    ]
];

// Rapports récents générés
$recentReports = [
    [
        'id' => 'RPT241008001',
        'type' => 'sales',
        'title' => 'Rapport Ventes - Semaine 41',
        'period' => '30 Sep - 06 Oct 2025',
        'generated_at' => $currentTime - 3600,
        'size' => '2.4 MB',
        'format' => 'PDF',
        'status' => 'completed'
    ],
    [
        'id' => 'RPT241008002',
        'type' => 'orders',
        'title' => 'Analyse Commandes - Octobre',
        'period' => '01 Oct - 08 Oct 2025',
        'generated_at' => $currentTime - 7200,
        'size' => '1.8 MB',
        'format' => 'Excel',
        'status' => 'completed'
    ],
    [
        'id' => 'RPT241008003',
        'type' => 'users',
        'title' => 'Croissance Utilisateurs Q4',
        'period' => 'Oct - Déc 2025',
        'generated_at' => $currentTime - 14400,
        'size' => '3.1 MB',
        'format' => 'PDF',
        'status' => 'completed'
    ],
    [
        'id' => 'RPT241008004',
        'type' => 'delivery',
        'title' => 'Performance Livraisons',
        'period' => '07 Oct 2025',
        'generated_at' => $currentTime - 1800,
        'size' => '892 KB',
        'format' => 'PDF',
        'status' => 'generating'
    ],
    [
        'id' => 'RPT241008005',
        'type' => 'financial',
        'title' => 'Bilan Financier Septembre',
        'period' => 'Septembre 2025',
        'generated_at' => $currentTime - 86400,
        'size' => '4.2 MB',
        'format' => 'Excel',
        'status' => 'completed'
    ]
];

// Rapports programmés
$scheduledReports = [
    [
        'id' => 'SCHED001',
        'type' => 'sales',
        'name' => 'Ventes Quotidiennes',
        'frequency' => 'Quotidien à 08:00',
        'recipients' => ['admin@kodpwomo.cd', 'manager@kodpwomo.cd'],
        'format' => 'PDF + Excel',
        'active' => true,
        'next_run' => 'Demain 08:00'
    ],
    [
        'id' => 'SCHED002',
        'type' => 'users',
        'name' => 'Croissance Hebdomadaire',
        'frequency' => 'Lundi à 09:00',
        'recipients' => ['marketing@kodpwomo.cd'],
        'format' => 'PDF',
        'active' => true,
        'next_run' => 'Lundi 09:00'
    ],
    [
        'id' => 'SCHED003',
        'type' => 'financial',
        'name' => 'Bilan Mensuel',
        'frequency' => '1er du mois à 10:00',
        'recipients' => ['finance@kodpwomo.cd', 'ceo@kodpwomo.cd'],
        'format' => 'Excel',
        'active' => false,
        'next_run' => '01 Nov 10:00'
    ]
];

// Métriques des rapports
$reportMetrics = [
    'total_generated' => 1247,
    'this_month' => 89,
    'automated' => 67,
    'downloads' => 3421,
    'avg_generation_time' => '2.3 min',
    'success_rate' => 98.7
];

// KPIs pour le tableau de bord rapports
$dashboardKPIs = [
    'revenue_today' => rand(250000, 450000),
    'orders_today' => rand(85, 145),
    'users_growth' => rand(12, 28),
    'delivery_success' => rand(94, 98),
    'inventory_alerts' => rand(3, 12),
    'profit_margin' => rand(23, 31)
];
?>

<div class="page-header">
  <h2 class="page-title">📊 Rapports & Analyses</h2>
  <p class="page-subtitle">
    Centre de rapports KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      <?= $reportMetrics['this_month'] ?> ce mois
    </span> • 
    <span style="color: var(--accent); font-weight: 600;">
      <?= $reportMetrics['success_rate'] ?>% réussite
    </span> • 
    Dernière génération: <span style="color: var(--primary);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Actions rapides -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
    <button onclick="generateQuickReport('sales')" style="background: var(--success); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      💰 Rapport Ventes
    </button>
    <button onclick="generateQuickReport('orders')" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📦 Rapport Commandes
    </button>
    <button onclick="generateQuickReport('users')" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      👥 Rapport Utilisateurs
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <button onclick="openReportBuilder()" style="background: linear-gradient(135deg, var(--warning), #f59e0b); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🔧 Créateur Rapport
    </button>
    <button onclick="scheduleReport()" style="background: var(--info); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🕐 Programmer
    </button>
    <button onclick="refreshReports()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Métriques rapports -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-value" id="total-reports-stat"><?= number_format($reportMetrics['total_generated']) ?></div>
    <div class="stat-label">Rapports Générés</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= $reportMetrics['this_month'] ?> ce mois</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🤖</div>
    <div class="stat-value" id="automated-stat"><?= $reportMetrics['automated'] ?>%</div>
    <div class="stat-label">Automatisation</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= count($scheduledReports) ?> programmés</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📥</div>
    <div class="stat-value" id="downloads-stat"><?= number_format($reportMetrics['downloads']) ?></div>
    <div class="stat-label">Téléchargements</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= rand(15, 45) ?> aujourd'hui</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">⚡</div>
    <div class="stat-value" id="speed-stat"><?= $reportMetrics['avg_generation_time'] ?></div>
    <div class="stat-label">Temps Génération</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Performance optimale</span>
    </div>
  </div>
</div>

<!-- Contenu principal -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
  
  <!-- Types de rapports disponibles -->
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
      📋 Types de Rapports Disponibles
    </h3>
    
    <div style="display: grid; gap: 1rem;">
      <?php foreach($reportTypes as $typeKey => $type): ?>
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 4px solid <?= $type['color'] ?>; transition: all 0.2s ease; cursor: pointer;"
             onclick="showReportDetails('<?= $typeKey ?>')"
             onmouseenter="this.style.background='rgba(255,255,255,0.06)'"
             onmouseleave="this.style.background='rgba(255,255,255,0.03)'">
          
          <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2.5rem; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));"><?= $type['icon'] ?></div>
            <div>
              <h4 style="margin: 0 0 0.5rem 0; color: var(--text-primary); font-weight: 700; font-size: 1.1rem;">
                <?= $type['name'] ?>
              </h4>
              <p style="margin: 0 0 0.5rem 0; color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4;">
                <?= $type['description'] ?>
              </p>
              <span style="color: var(--text-muted); font-size: 0.8rem; font-weight: 600;">
                📅 <?= $type['frequency'] ?>
              </span>
            </div>
          </div>
          
          <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: end;">
            <button onclick="event.stopPropagation(); generateReport('<?= $typeKey ?>')" 
                    style="background: <?= $type['color'] ?>; border: none; color: white; padding: 0.6rem 1.2rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'">
              🚀 Générer
            </button>
            <button onclick="event.stopPropagation(); customizeReport('<?= $typeKey ?>')" 
                    style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.8rem;">
              ⚙️ Personnaliser
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <!-- Panneau latéral -->
  <div style="display: flex; flex-direction: column; gap: 1rem;">
    
    <!-- KPIs temps réel -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
        ⚡ KPIs Temps Réel
        <span style="background: var(--success); color: white; padding: 0.2rem 0.5rem; border-radius: 999px; font-size: 0.7rem;">LIVE</span>
      </h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(16,185,129,0.1); border-radius: 6px;">
          <span style="color: var(--text-secondary); font-size: 0.9rem;">💰 Revenus aujourd'hui</span>
          <span style="color: var(--success); font-weight: 700; font-size: 1rem;" id="revenue-kpi"><?= number_format($dashboardKPIs['revenue_today']) ?> FC</span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(99,102,241,0.1); border-radius: 6px;">
          <span style="color: var(--text-secondary); font-size: 0.9rem;">📦 Commandes</span>
          <span style="color: var(--primary); font-weight: 700; font-size: 1rem;" id="orders-kpi"><?= $dashboardKPIs['orders_today'] ?></span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(6,182,212,0.1); border-radius: 6px;">
          <span style="color: var(--text-secondary); font-size: 0.9rem;">👥 Nouveaux users</span>
          <span style="color: var(--accent); font-weight: 700; font-size: 1rem;" id="users-kpi">+<?= $dashboardKPIs['users_growth'] ?></span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(245,158,11,0.1); border-radius: 6px;">
          <span style="color: var(--text-secondary); font-size: 0.9rem;">🚚 Taux livraison</span>
          <span style="color: var(--warning); font-weight: 700; font-size: 1rem;" id="delivery-kpi"><?= $dashboardKPIs['delivery_success'] ?>%</span>
        </div>
      </div>
    </div>
    
    <!-- Rapports récents -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">📄 Rapports Récents</h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem; max-height: 300px; overflow-y: auto;">
        <?php foreach(array_slice($recentReports, 0, 6) as $report): ?>
          <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 6px; border-left: 3px solid <?= $reportTypes[$report['type']]['color'] ?>;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
              <div style="flex: 1; min-width: 0;">
                <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem; margin-bottom: 0.25rem;">
                  <?= $reportTypes[$report['type']]['icon'] ?> <?= $report['title'] ?>
                </div>
                <div style="color: var(--text-muted); font-size: 0.75rem;">
                  <?= $report['period'] ?>
                </div>
              </div>
              
              <div style="text-align: right;">
                <span style="
                  background: <?= $report['status'] === 'completed' ? 'var(--success)' : 'var(--warning)' ?>; 
                  color: white; 
                  padding: 0.2rem 0.5rem; 
                  border-radius: 999px; 
                  font-size: 0.7rem; 
                  font-weight: 600;
                ">
                  <?= $report['status'] === 'completed' ? '✅ Prêt' : '⏳ En cours' ?>
                </span>
              </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <span style="color: var(--text-muted); font-size: 0.75rem;">
                <?= $report['format'] ?> • <?= $report['size'] ?>
              </span>
              
              <?php if ($report['status'] === 'completed'): ?>
                <button onclick="downloadReport('<?= $report['id'] ?>')" 
                        style="background: var(--accent); border: none; color: white; padding: 0.4rem 0.8rem; border-radius: 4px; cursor: pointer; font-size: 0.7rem; font-weight: 600;">
                  📥 Télécharger
                </button>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Rapports programmés -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
        🕐 Rapports Programmés
      </h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <?php foreach($scheduledReports as $scheduled): ?>
          <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 6px; border-left: 3px solid <?= $reportTypes[$scheduled['type']]['color'] ?>;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
              <div>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem;">
                  <?= $reportTypes[$scheduled['type']]['icon'] ?> <?= $scheduled['name'] ?>
                </div>
                <div style="color: var(--text-muted); font-size: 0.75rem;">
                  <?= $scheduled['frequency'] ?>
                </div>
              </div>
              
              <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="
                  background: <?= $scheduled['active'] ? 'var(--success)' : 'var(--error)' ?>; 
                  color: white; 
                  padding: 0.2rem 0.5rem; 
                  border-radius: 999px; 
                  font-size: 0.7rem; 
                  font-weight: 600;
                ">
                  <?= $scheduled['active'] ? 'Actif' : 'Inactif' ?>
                </span>
              </div>
            </div>
            
            <div style="color: var(--text-muted); font-size: 0.75rem;">
              Prochain: <?= $scheduled['next_run'] ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<style>
.report-type-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>

<script>
// Génération rapide de rapports
function generateQuickReport(type) {
  const reportNames = {
    'sales': 'Rapport des Ventes',
    'orders': 'Rapport des Commandes', 
    'users': 'Rapport Utilisateurs'
  };
  
  showToast(`Génération ${reportNames[type]} en cours...`, 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 20;
    showToast(`${reportNames[type]}: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast(`📊 ${reportNames[type]} généré avec succès`, 'success');
    }
  }, 600);
}

// Génération personnalisée
function generateReport(type) {
  const reportNames = {
    'sales': 'Ventes',
    'orders': 'Commandes',
    'users': 'Utilisateurs',
    'delivery': 'Livraisons',
    'inventory': 'Stock',
    'financial': 'Financier'
  };
  
  showToast(`Génération rapport ${reportNames[type]}...`, 'info');
  
  setTimeout(() => {
    showToast(`✅ Rapport ${reportNames[type]} en cours de génération`, 'success');
    
    // Simulation ajout à la liste des rapports récents
    setTimeout(() => {
      showToast(`📥 Rapport ${reportNames[type]} prêt au téléchargement`, 'success');
    }, 3000);
  }, 1000);
}

// Personnalisation rapport
function customizeReport(type) {
  showToast(`Ouverture personnalisation rapport ${type}...`, 'info');
  
  setTimeout(() => {
    showToast('⚙️ Interface de personnalisation ouverte', 'success');
  }, 800);
}

// Détails rapport
function showReportDetails(type) {
  const reportNames = {
    'sales': 'Ventes',
    'orders': 'Commandes',
    'users': 'Utilisateurs',
    'delivery': 'Livraisons',
    'inventory': 'Stock',
    'financial': 'Financier'
  };
  
  showToast(`Affichage détails rapport ${reportNames[type]}`, 'info');
}

// Téléchargement rapport
function downloadReport(reportId) {
  showToast(`Téléchargement rapport ${reportId}...`, 'info');
  
  setTimeout(() => {
    showToast(`📥 Rapport ${reportId} téléchargé avec succès`, 'success');
  }, 1200);
}

// Créateur de rapports
function openReportBuilder() {
  showToast('Ouverture créateur de rapports avancé...', 'info');
  
  setTimeout(() => {
    showToast('🔧 Créateur de rapports chargé', 'success');
  }, 1500);
}

// Programmation rapports
function scheduleReport() {
  showToast('Ouverture planificateur de rapports...', 'info');
  
  setTimeout(() => {
    showToast('🕐 Interface de programmation ouverte', 'success');
  }, 1000);
}

// Actualisation
function refreshReports() {
  showToast('Actualisation liste des rapports...', 'info');
  
  const reportCards = document.querySelectorAll('.stat-card');
  reportCards.forEach(card => {
    card.style.opacity = '0.6';
  });
  
  setTimeout(() => {
    reportCards.forEach(card => {
      card.style.opacity = '1';
    });
    showToast('✅ Liste des rapports actualisée', 'success');
    updateReportKPIs();
  }, 2000);
}

// Mise à jour KPIs temps réel
function updateReportKPIs() {
  const revenueElement = document.getElementById('revenue-kpi');
  if (revenueElement) {
    const current = parseInt(revenueElement.textContent.replace(/[FC,\s]/g, ''));
    const increase = Math.floor(Math.random() * 25000) + 5000;
    revenueElement.textContent = new Intl.NumberFormat().format(current + increase) + ' FC';
  }
  
  const ordersElement = document.getElementById('orders-kpi');
  if (ordersElement) {
    const current = parseInt(ordersElement.textContent);
    const increase = Math.floor(Math.random() * 5) + 1;
    ordersElement.textContent = current + increase;
  }
  
  const usersElement = document.getElementById('users-kpi');
  if (usersElement) {
    const current = parseInt(usersElement.textContent.replace('+', ''));
    const change = Math.floor(Math.random() * 3) + 1;
    usersElement.textContent = '+' + (current + change);
  }
  
  const deliveryElement = document.getElementById('delivery-kpi');
  if (deliveryElement) {
    const change = (Math.random() - 0.5) * 2; // -1 à +1
    const current = parseFloat(deliveryElement.textContent.replace('%', ''));
    const newValue = Math.max(90, Math.min(100, current + change));
    deliveryElement.textContent = newValue.toFixed(1) + '%';
  }
}

// Auto-refresh KPIs toutes les 30 secondes
setInterval(() => {
  updateReportKPIs();
  
  if (Math.random() > 0.8) {
    showToast('📊 Nouveau rapport généré automatiquement', 'info');
  }
}, 30000);
</script>