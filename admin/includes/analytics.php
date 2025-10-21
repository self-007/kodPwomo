<?php
// Analytics avancés temps réel avec visualisations
$currentTime = time();
$currentHour = date('H');
$currentDay = date('w'); // 0 = dimanche, 1 = lundi, etc.

// Génération de données analytics réalistes
function generateAnalyticsData() {
    global $currentTime, $currentHour, $currentDay;
    
    // Données des 7 derniers jours
    $weeklyData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', $currentTime - ($i * 86400));
        $dayOfWeek = date('w', $currentTime - ($i * 86400));
        
        // Ajustement selon le jour de la semaine
        $baseOrders = 120;
        if ($dayOfWeek == 0 || $dayOfWeek == 6) $baseOrders = 180; // Weekend
        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) $baseOrders = rand(85, 140); // Semaine
        
        $orders = $baseOrders + rand(-20, 30);
        $revenue = $orders * rand(12000, 18000);
        
        $weeklyData[] = [
            'date' => $date,
            'day' => date('D', $currentTime - ($i * 86400)),
            'orders' => $orders,
            'revenue' => $revenue,
            'users' => rand(60, 95),
            'avg_order' => round($revenue / $orders),
            'conversion' => round(rand(85, 152) / 10, 1)
        ];
    }
    
    // Données horaires pour aujourd'hui
    $hourlyData = [];
    for ($h = 0; $h < 24; $h++) {
        $orders = 0;
        $revenue = 0;
        
        // Distribution réaliste par heure
        if ($h >= 7 && $h <= 9) { // Petit-déjeuner
            $orders = rand(25, 45);
        } elseif ($h >= 12 && $h <= 14) { // Déjeuner
            $orders = rand(60, 85);
        } elseif ($h >= 18 && $h <= 21) { // Dîner
            $orders = rand(45, 70);
        } elseif ($h >= 10 && $h <= 11) { // Pause matinale
            $orders = rand(15, 30);
        } elseif ($h >= 15 && $h <= 17) { // Pause après-midi
            $orders = rand(20, 35);
        } else {
            $orders = rand(2, 15);
        }
        
        if ($h > $currentHour) {
            $orders = 0; // Pas de données futures
            $revenue = 0;
        } else {
            $revenue = $orders * rand(11000, 19000);
        }
        
        $hourlyData[] = [
            'hour' => $h,
            'hour_label' => sprintf('%02d:00', $h),
            'orders' => $orders,
            'revenue' => $revenue,
            'avg_order' => $orders > 0 ? round($revenue / $orders) : 0
        ];
    }
    
    // Performance par université
    $universities = [
        ['code' => 'UNIKIN', 'name' => 'Université de Kinshasa', 'orders' => rand(850, 1200), 'revenue' => rand(12000000, 18000000)],
        ['code' => 'UNILU', 'name' => 'Université de Lubumbashi', 'orders' => rand(650, 950), 'revenue' => rand(8500000, 13500000)],
        ['code' => 'UOB', 'name' => 'Université Officielle de Bukavu', 'orders' => rand(400, 680), 'revenue' => rand(5500000, 9200000)],
        ['code' => 'UNIKIS', 'name' => 'Université de Kisangani', 'orders' => rand(380, 620), 'revenue' => rand(5200000, 8800000)],
        ['code' => 'UNIGOM', 'name' => 'Université de Goma', 'orders' => rand(280, 480), 'revenue' => rand(3800000, 6500000)],
        ['code' => 'UNIKAT', 'name' => 'Université de Katanga', 'orders' => rand(320, 520), 'revenue' => rand(4200000, 7200000)]
    ];
    
    // Tri par revenus
    usort($universities, function($a, $b) {
        return $b['revenue'] - $a['revenue'];
    });
    
    return [
        'weekly' => $weeklyData,
        'hourly' => $hourlyData,
        'universities' => $universities
    ];
}

$analyticsData = generateAnalyticsData();
$weeklyData = $analyticsData['weekly'];
$hourlyData = $analyticsData['hourly'];
$universityData = $analyticsData['universities'];

// Calculs KPI
$todayOrders = array_sum(array_column($hourlyData, 'orders'));
$todayRevenue = array_sum(array_column($hourlyData, 'revenue'));
$avgOrderValue = $todayOrders > 0 ? round($todayRevenue / $todayOrders) : 0;

$weeklyOrders = array_sum(array_column($weeklyData, 'orders'));
$weeklyRevenue = array_sum(array_column($weeklyData, 'revenue'));

// Comparaison avec la semaine précédente (simulation)
$lastWeekOrders = $weeklyOrders + rand(-50, 80);
$lastWeekRevenue = $weeklyRevenue + rand(-500000, 1200000);

$ordersGrowth = $lastWeekOrders > 0 ? round((($weeklyOrders - $lastWeekOrders) / $lastWeekOrders) * 100, 1) : 0;
$revenueGrowth = $lastWeekRevenue > 0 ? round((($weeklyRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1) : 0;

// Taux de conversion et métriques
$conversionRate = round(rand(125, 183) / 10, 1);
$customerSatisfaction = round(rand(43, 48) / 10, 1);
$avgDeliveryTime = rand(18, 26);

// Top produits de la semaine
$topProducts = [
    ['name' => 'Pizza Margherita', 'emoji' => '🍕', 'sold' => rand(180, 250), 'revenue' => rand(2700000, 3750000)],
    ['name' => 'Burger Classic', 'emoji' => '🍔', 'sold' => rand(160, 220), 'revenue' => rand(2240000, 3080000)],
    ['name' => 'Café Expresso', 'emoji' => '☕', 'sold' => rand(300, 420), 'revenue' => rand(900000, 1260000)],
    ['name' => 'Club Sandwich', 'emoji' => '🥪', 'sold' => rand(140, 190), 'revenue' => rand(1680000, 2280000)],
    ['name' => 'Coca Cola 50cl', 'emoji' => '🥤', 'sold' => rand(250, 350), 'revenue' => rand(500000, 700000)]
];

// Tri par revenus
usort($topProducts, function($a, $b) {
    return $b['revenue'] - $a['revenue'];
});
?>

<div class="page-header">
  <h2 class="page-title">📊 Analytics & Rapports</h2>
  <p class="page-subtitle">
    Tableau de bord analytique KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      Performance temps réel
    </span> • 
    <span style="color: var(--accent); font-weight: 600;">
      <?= $todayOrders ?> commandes aujourd'hui
    </span> • 
    Dernière analyse: <span style="color: var(--primary);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Contrôles et filtres analytics -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 0.75rem; align-items: center;">
    <select id="time-range" onchange="updateAnalytics(this.value)" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.9rem; font-weight: 600;">
      <option value="today">Aujourd'hui</option>
      <option value="week" selected>Cette semaine</option>
      <option value="month">Ce mois</option>
      <option value="quarter">Ce trimestre</option>
      <option value="year">Cette année</option>
    </select>
    
    <select id="metric-type" onchange="updateMetrics(this.value)" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.9rem; font-weight: 600;">
      <option value="revenue">Revenus</option>
      <option value="orders">Commandes</option>
      <option value="users">Utilisateurs</option>
      <option value="conversion">Conversion</option>
    </select>
    
    <button onclick="compareWithPrevious()" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      📈 Comparer
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <button onclick="exportAnalytics()" style="background: linear-gradient(135deg, var(--success), #059669); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📊 Export PDF
    </button>
    <button onclick="scheduleReport()" style="background: var(--warning); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🕐 Programmer
    </button>
    <button onclick="refreshAnalytics()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- KPI Principales métriques -->
<div class="stats-grid" style="margin-bottom: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
  <div class="stat-card">
    <div class="stat-icon">💰</div>
    <div class="stat-value" id="revenue-kpi"><?= number_format($todayRevenue) ?> FC</div>
    <div class="stat-label">Revenus Aujourd'hui</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span style="color: <?= $revenueGrowth >= 0 ? 'var(--success)' : 'var(--error)' ?>;">
        <?= $revenueGrowth >= 0 ? '↗️' : '↘️' ?> <?= abs($revenueGrowth) ?>% vs sem. passée
      </span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📦</div>
    <div class="stat-value" id="orders-kpi"><?= $todayOrders ?></div>
    <div class="stat-label">Commandes Aujourd'hui</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span style="color: <?= $ordersGrowth >= 0 ? 'var(--success)' : 'var(--error)' ?>;">
        <?= $ordersGrowth >= 0 ? '↗️' : '↘️' ?> <?= abs($ordersGrowth) ?>% vs sem. passée
      </span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💳</div>
    <div class="stat-value" id="avg-order-kpi"><?= number_format($avgOrderValue) ?> FC</div>
    <div class="stat-label">Panier Moyen</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Objectif: 16,000 FC</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-value" id="conversion-kpi"><?= $conversionRate ?>%</div>
    <div class="stat-label">Taux Conversion</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span style="color: var(--success);">↗️ +2.3% ce mois</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">⭐</div>
    <div class="stat-value" id="satisfaction-kpi"><?= $customerSatisfaction ?>/5</div>
    <div class="stat-label">Satisfaction Client</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span style="color: var(--success);">Excellente</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🚚</div>
    <div class="stat-value" id="delivery-kpi"><?= $avgDeliveryTime ?> min</div>
    <div class="stat-label">Temps Livraison</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span style="color: var(--accent);">Dans les normes</span>
    </div>
  </div>
</div>

<!-- Graphiques analytics principaux -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <!-- Graphique principal -->
  <div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h3 style="margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
        📈 Évolution des Revenus (7 jours)
        <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">TEMPS RÉEL</span>
      </h3>
      <div style="display: flex; gap: 0.5rem;">
        <button onclick="toggleChartView('revenue')" id="btn-revenue" class="chart-toggle active" style="background: var(--primary); border: none; color: white; padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600;">Revenus</button>
        <button onclick="toggleChartView('orders')" id="btn-orders" class="chart-toggle" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600;">Commandes</button>
        <button onclick="toggleChartView('users')" id="btn-users" class="chart-toggle" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600;">Utilisateurs</button>
      </div>
    </div>
    
    <!-- Graphique linéaire simulation -->
    <div style="height: 300px; position: relative; background: rgba(255,255,255,0.02); border-radius: 8px; padding: 1rem;">
      <div style="display: flex; align-items: end; justify-content: space-around; height: 100%; gap: 0.5rem;">
        <?php foreach($weeklyData as $day): ?>
          <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
            <div style="position: relative; width: 100%; display: flex; justify-content: center;">
              <div style="
                background: linear-gradient(to top, var(--primary), var(--accent)); 
                height: <?= min(100, ($day['revenue'] / max(array_column($weeklyData, 'revenue'))) * 90) ?>%; 
                width: 80%; 
                border-radius: 4px 4px 0 0; 
                margin-bottom: 0.75rem;
                position: relative;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(99,102,241,0.3);
              " title="<?= number_format($day['revenue']) ?> FC - <?= $day['orders'] ?> commandes">
                <div style="position: absolute; top: 0; width: 100%; height: 30%; background: rgba(255,255,255,0.2); animation: shimmer 3s infinite;"></div>
              </div>
              <!-- Indicateur de croissance -->
              <?php 
              $growth = rand(-5, 15);
              if ($growth > 0): ?>
                <div style="position: absolute; top: -20px; font-size: 0.7rem; color: var(--success); font-weight: 700;">+<?= $growth ?>%</div>
              <?php endif; ?>
            </div>
            <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;"><?= $day['day'] ?></span>
            <span style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;"><?= date('d/m', strtotime($day['date'])) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Ligne de tendance -->
      <div style="position: absolute; top: 30%; left: 10%; right: 10%; height: 2px; background: linear-gradient(to right, transparent, var(--accent), transparent); opacity: 0.6;"></div>
    </div>
    
    <!-- Métriques du graphique -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
      <div style="text-align: center;">
        <div style="font-size: 1.5rem; font-weight: 900; color: var(--success);"><?= number_format($weeklyRevenue) ?></div>
        <div style="color: var(--text-muted); font-size: 0.85rem;">Revenus 7 jours</div>
      </div>
      <div style="text-align: center;">
        <div style="font-size: 1.5rem; font-weight: 900; color: var(--primary);"><?= $weeklyOrders ?></div>
        <div style="color: var(--text-muted); font-size: 0.85rem;">Commandes 7 jours</div>
      </div>
      <div style="text-align: center;">
        <div style="font-size: 1.5rem; font-weight: 900; color: var(--accent);"><?= round($weeklyRevenue / $weeklyOrders) ?></div>
        <div style="color: var(--text-muted); font-size: 0.85rem;">Panier moyen (FC)</div>
      </div>
    </div>
  </div>
  
  <!-- Performance par heure -->
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🕐 Performance Horaire</h3>
    <div style="height: 300px; display: flex; flex-direction: column; gap: 0.3rem;">
      <?php 
      $maxOrders = max(array_column($hourlyData, 'orders'));
      foreach($hourlyData as $hour): 
        if ($hour['hour'] > $currentHour) continue;
      ?>
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <span style="font-size: 0.75rem; color: var(--text-muted); min-width: 35px; font-weight: 600;"><?= $hour['hour_label'] ?></span>
          <div style="flex: 1; background: rgba(255,255,255,0.05); border-radius: 4px; height: 20px; position: relative; overflow: hidden;">
            <div style="
              background: linear-gradient(to right, 
                <?= $hour['hour'] >= 7 && $hour['hour'] <= 9 ? 'var(--warning)' : 
                   ($hour['hour'] >= 12 && $hour['hour'] <= 14 ? 'var(--success)' : 
                   ($hour['hour'] >= 18 && $hour['hour'] <= 21 ? 'var(--primary)' : 'var(--accent)')) ?>, 
                rgba(255,255,255,0.3)); 
              height: 100%; 
              width: <?= $maxOrders > 0 ? ($hour['orders'] / $maxOrders * 100) : 0 ?>%; 
              border-radius: 4px;
              transition: all 0.3s ease;
            "></div>
          </div>
          <span style="font-size: 0.75rem; color: var(--text-secondary); min-width: 25px; text-align: right; font-weight: 700;"><?= $hour['orders'] ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    
    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
        <span style="color: var(--text-muted);">Pic du jour:</span>
        <span style="color: var(--success); font-weight: 700;">12h-14h (<?= max(array_column($hourlyData, 'orders')) ?> commandes)</span>
      </div>
    </div>
  </div>
</div>

<!-- Performance par université et top produits -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <!-- Performance universités -->
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      🏫 Performance par Campus
      <span style="background: var(--accent); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">MENSUEL</span>
    </h3>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
      <?php foreach($universityData as $index => $uni): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 4px solid <?= ['var(--primary)', 'var(--success)', 'var(--warning)', 'var(--accent)', 'var(--error)', 'var(--info)'][$index % 6] ?>;">
          <div>
            <div style="font-weight: 700; color: var(--text-primary); font-size: 1rem;">
              <?= $index + 1 ?>. <?= $uni['code'] ?>
            </div>
            <div style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.25rem; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
              <?= $uni['name'] ?>
            </div>
          </div>
          <div style="text-align: right;">
            <div style="font-weight: 700; color: var(--success); font-size: 1.1rem;">
              <?= number_format($uni['revenue'] / 1000) ?>K FC
            </div>
            <div style="color: var(--text-muted); font-size: 0.8rem;">
              <?= $uni['orders'] ?> commandes
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <!-- Top produits -->
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      🏆 Top Produits (Semaine)
      <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">HOT</span>
    </h3>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
      <?php foreach($topProducts as $index => $product): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; position: relative; overflow: hidden;">
          <!-- Barre de progression en arrière-plan -->
          <div style="position: absolute; top: 0; left: 0; height: 100%; background: linear-gradient(to right, <?= ['var(--primary)', 'var(--success)', 'var(--warning)', 'var(--accent)', 'var(--error)'][$index] ?>, transparent); width: <?= 100 - ($index * 15) ?>%; opacity: 0.1; z-index: 0;"></div>
          
          <div style="display: flex; align-items: center; gap: 1rem; z-index: 1; position: relative;">
            <div style="font-size: 2rem;"><?= $product['emoji'] ?></div>
            <div>
              <div style="font-weight: 700; color: var(--text-primary); font-size: 1rem;">
                <?= $index + 1 ?>. <?= $product['name'] ?>
              </div>
              <div style="color: var(--text-muted); font-size: 0.85rem;">
                <?= $product['sold'] ?> vendus
              </div>
            </div>
          </div>
          <div style="text-align: right; z-index: 1; position: relative;">
            <div style="font-weight: 700; color: var(--success); font-size: 1.1rem;">
              <?= number_format($product['revenue'] / 1000) ?>K FC
            </div>
            <div style="color: var(--text-muted); font-size: 0.8rem;">
              <?= number_format($product['revenue'] / $product['sold']) ?> FC/unité
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- Métriques avancées -->
<div class="stat-card">
  <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
    🎯 Métriques Avancées & Insights
    <span style="background: var(--primary); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">AI-POWERED</span>
  </h3>
  
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Funnel de conversion -->
    <div style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
      <h4 style="color: var(--text-primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        🎯 Funnel de Conversion
      </h4>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span>Visiteurs</span>
          <span style="color: var(--primary); font-weight: 700;"><?= number_format(rand(8500, 12000)) ?></span>
        </div>
        <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
          <div style="height: 100%; width: 100%; background: var(--primary); border-radius: 4px;"></div>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span>Ajouts panier</span>
          <span style="color: var(--accent); font-weight: 700;"><?= number_format(rand(2100, 3200)) ?></span>
        </div>
        <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
          <div style="height: 100%; width: 75%; background: var(--accent); border-radius: 4px;"></div>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span>Commandes</span>
          <span style="color: var(--success); font-weight: 700;"><?= $todayOrders + rand(850, 1200) ?></span>
        </div>
        <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
          <div style="height: 100%; width: 45%; background: var(--success); border-radius: 4px;"></div>
        </div>
        
        <div style="margin-top: 0.5rem; padding-top: 0.75rem; border-top: 1px solid var(--border); text-center;">
          <span style="color: var(--success); font-weight: 700; font-size: 1.1rem;"><?= $conversionRate ?>%</span>
          <div style="color: var(--text-muted); font-size: 0.8rem;">Taux conversion global</div>
        </div>
      </div>
    </div>
    
    <!-- Insights IA -->
    <div style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
      <h4 style="color: var(--text-primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        🤖 Insights IA
      </h4>
      <div style="display: flex; flex-direction: column; gap: 1rem;">
        <div style="padding: 0.75rem; background: rgba(16,185,129,0.1); border-radius: 6px; border-left: 3px solid var(--success);">
          <div style="color: var(--success); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;">📈 Opportunité détectée</div>
          <div style="color: var(--text-secondary); font-size: 0.85rem;">Les ventes de café augmentent de +23% entre 14h-16h. Recommandé: promo "Pause Café"</div>
        </div>
        
        <div style="padding: 0.75rem; background: rgba(245,158,11,0.1); border-radius: 6px; border-left: 3px solid var(--warning);">
          <div style="color: var(--warning); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;">⚠️ Attention stock</div>
          <div style="color: var(--text-secondary); font-size: 0.85rem;">Stock Pizza Margherita critique sur UNIKIN. Réappro recommandé sous 24h</div>
        </div>
        
        <div style="padding: 0.75rem; background: rgba(99,102,241,0.1); border-radius: 6px; border-left: 3px solid var(--primary);">
          <div style="color: var(--primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;">💡 Prédiction</div>
          <div style="color: var(--text-secondary); font-size: 0.85rem;">Pic de commandes prévu demain 12h-13h (+15% vs aujourd'hui)</div>
        </div>
      </div>
    </div>
    
    <!-- Performance temps réel -->
    <div style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
      <h4 style="color: var(--text-primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        ⚡ Performance Temps Réel
      </h4>
      <div style="display: flex; flex-direction: column; gap: 1rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px;">
          <span style="display: flex; align-items: center; gap: 0.5rem;">
            <div class="realtime-dot"></div>
            Commandes/min
          </span>
          <span style="color: var(--accent); font-weight: 700;"><?= rand(2, 8) ?></span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px;">
          <span style="display: flex; align-items: center; gap: 0.5rem;">
            <div class="realtime-dot"></div>
            Revenus/min
          </span>
          <span style="color: var(--success); font-weight: 700;"><?= number_format(rand(25000, 85000)) ?> FC</span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px;">
          <span style="display: flex; align-items: center; gap: 0.5rem;">
            <div class="realtime-dot"></div>
            Nouveaux utilisateurs
          </span>
          <span style="color: var(--primary); font-weight: 700;"><?= rand(5, 15) ?>/h</span>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px;">
          <span style="display: flex; align-items: center; gap: 0.5rem;">
            <div class="realtime-dot"></div>
            Temps réponse API
          </span>
          <span style="color: var(--success); font-weight: 700;"><?= rand(45, 120) ?>ms</span>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.chart-toggle {
  transition: all 0.2s ease;
}

.chart-toggle.active {
  background: var(--primary) !important;
  color: white !important;
  border: 1px solid var(--primary) !important;
}

.chart-toggle:hover:not(.active) {
  background: rgba(255,255,255,0.1) !important;
}
</style>

<script>
// Gestion des graphiques
function toggleChartView(type) {
  document.querySelectorAll('.chart-toggle').forEach(btn => {
    btn.classList.remove('active');
    btn.style.background = 'var(--glass-bg)';
    btn.style.color = 'var(--text-primary)';
    btn.style.border = '1px solid var(--border)';
  });
  
  const activeBtn = document.getElementById('btn-' + type);
  activeBtn.classList.add('active');
  
  showToast(`Affichage: ${type}`, 'info');
}

// Mise à jour analytics
function updateAnalytics(timeRange) {
  showToast(`Chargement données: ${timeRange}`, 'info');
  
  // Simulation de chargement
  const charts = document.querySelectorAll('.stat-card');
  charts.forEach(chart => {
    chart.style.opacity = '0.7';
  });
  
  setTimeout(() => {
    charts.forEach(chart => {
      chart.style.opacity = '1';
    });
    showToast('📊 Analytics mis à jour', 'success');
    
    // Mise à jour des valeurs
    updateKPIValues();
  }, 2000);
}

function updateMetrics(metricType) {
  showToast(`Métriques: ${metricType}`, 'info');
}

function compareWithPrevious() {
  showToast('Génération comparaison période précédente...', 'info');
  
  setTimeout(() => {
    showToast('📈 Rapport comparatif généré', 'success');
  }, 1500);
}

function exportAnalytics() {
  showToast('Génération rapport PDF...', 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 25;
    showToast(`Export PDF: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast('📊 Rapport PDF téléchargé', 'success');
    }
  }, 500);
}

function scheduleReport() {
  showToast('Ouverture programmation rapports...', 'info');
  
  setTimeout(() => {
    showToast('🕐 Rapport programmé: quotidien 8h00', 'success');
  }, 1000);
}

function refreshAnalytics() {
  showToast('Actualisation données temps réel...', 'info');
  
  // Animation de refresh
  document.querySelectorAll('.realtime-dot').forEach(dot => {
    dot.style.animation = 'none';
    setTimeout(() => dot.style.animation = '', 100);
  });
  
  setTimeout(() => {
    showToast('✅ Données actualisées', 'success');
    updateKPIValues();
  }, 2000);
}

// Mise à jour temps réel des KPI
function updateKPIValues() {
  // Revenus
  const revenueKPI = document.getElementById('revenue-kpi');
  if (revenueKPI) {
    const current = parseInt(revenueKPI.textContent.replace(/[FC,\s]/g, ''));
    const increase = Math.floor(Math.random() * 50000) + 10000;
    revenueKPI.textContent = new Intl.NumberFormat().format(current + increase) + ' FC';
  }
  
  // Commandes
  const ordersKPI = document.getElementById('orders-kpi');
  if (ordersKPI) {
    const current = parseInt(ordersKPI.textContent);
    const increase = Math.floor(Math.random() * 5) + 1;
    ordersKPI.textContent = current + increase;
  }
  
  // Panier moyen
  const avgOrderKPI = document.getElementById('avg-order-kpi');
  if (avgOrderKPI) {
    const change = Math.floor(Math.random() * 2000) - 1000; // -1000 à +1000
    const current = parseInt(avgOrderKPI.textContent.replace(/[FC,\s]/g, ''));
    const newValue = Math.max(10000, current + change);
    avgOrderKPI.textContent = new Intl.NumberFormat().format(newValue) + ' FC';
  }
  
  // Taux de conversion
  const conversionKPI = document.getElementById('conversion-kpi');
  if (conversionKPI) {
    const change = (Math.random() - 0.5) * 2; // -1 à +1
    const current = parseFloat(conversionKPI.textContent.replace('%', ''));
    const newValue = Math.max(5, Math.min(25, current + change));
    conversionKPI.textContent = newValue.toFixed(1) + '%';
  }
}

// Simulation d'insights IA temps réel
function generateAIInsights() {
  const insights = [
    { type: 'success', icon: '📈', title: 'Tendance positive', message: 'Les ventes de burgers augmentent de +18% cette semaine' },
    { type: 'warning', icon: '⚠️', title: 'Stock critique', message: 'Plus que 8 Pizza Pepperoni en stock sur UNILU' },
    { type: 'info', icon: '💡', title: 'Recommandation', message: 'Lancer une promo "Happy Hour" 15h-17h pour booster les ventes' },
    { type: 'success', icon: '🎯', title: 'Objectif atteint', message: 'Taux de satisfaction client dépasse 4.8/5 ce mois' },
    { type: 'warning', icon: '🚚', title: 'Livraisons', message: 'Temps de livraison moyen augmente (+3min) à UNIKIN' }
  ];
  
  if (Math.random() > 0.7) {
    const insight = insights[Math.floor(Math.random() * insights.length)];
    showToast(`${insight.icon} IA: ${insight.message}`, insight.type);
  }
}

// Auto-refresh des données toutes les 30 secondes
setInterval(() => {
  updateKPIValues();
  generateAIInsights();
}, 30000);

// Simulation de données temps réel
setInterval(() => {
  if (Math.random() > 0.8) {
    showToast('📊 Nouvelle donnée analytics disponible', 'info');
  }
}, 45000);
</script>