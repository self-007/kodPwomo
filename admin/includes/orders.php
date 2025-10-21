<?php
// Simulation ultra-réaliste des commandes avec données temps réel
$currentTime = time();
$currentHour = date('H');

// Génération d'ID commandes réalistes
function generateOrderId() {
    return 'KP' . date('ymd') . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
}

// Produits disponibles avec prix réalistes
$products = [
    ['name' => 'Pizza Margherita', 'price' => 15000, 'emoji' => '🍕'],
    ['name' => 'Pizza Pepperoni', 'price' => 18000, 'emoji' => '🍕'],
    ['name' => 'Sandwich Club', 'price' => 12000, 'emoji' => '🥪'],
    ['name' => 'Burger Classic', 'price' => 14000, 'emoji' => '🍔'],
    ['name' => 'Café Expresso', 'price' => 3000, 'emoji' => '☕'],
    ['name' => 'Cappuccino', 'price' => 4000, 'emoji' => '☕'],
    ['name' => 'Thé Vert', 'price' => 2500, 'emoji' => '🍵'],
    ['name' => 'Jus Orange', 'price' => 3500, 'emoji' => '🧃'],
    ['name' => 'Coca Cola', 'price' => 2000, 'emoji' => '🥤'],
    ['name' => 'Croissant', 'price' => 4500, 'emoji' => '🥐'],
    ['name' => 'Muffin Choco', 'price' => 5000, 'emoji' => '🧁'],
    ['name' => 'Salade César', 'price' => 16000, 'emoji' => '🥗']
];

// Universités avec codes réalistes
$universities = [
    ['code' => 'UNIKIN', 'name' => 'Université de Kinshasa', 'color' => 'var(--primary)'],
    ['code' => 'UNILU', 'name' => 'Université de Lubumbashi', 'color' => 'var(--accent)'],
    ['code' => 'UOB', 'name' => 'Université Officielle de Bukavu', 'color' => 'var(--success)'],
    ['code' => 'UNIKIS', 'name' => 'Université de Kisangani', 'color' => 'var(--warning)'],
    ['code' => 'UNIGOM', 'name' => 'Université de Goma', 'color' => 'var(--error)'],
    ['code' => 'UNIKAT', 'name' => 'Université de Katanga', 'color' => 'var(--primary)'],
    ['code' => 'UNIKOL', 'name' => 'Université Kongo', 'color' => 'var(--accent)'],
    ['code' => 'UNIMAD', 'name' => 'Université de Matadi', 'color' => 'var(--success)']
];

// Prénoms et noms congolais réalistes
$firstNames = ['Jean', 'Marie', 'Paul', 'Grace', 'David', 'Sarah', 'Joseph', 'Esther', 'Pierre', 'Ruth', 'Samuel', 'Rebecca', 'Daniel', 'Deborah', 'Michel', 'Judith', 'Emmanuel', 'Naomi', 'Isaac', 'Lydia'];
$lastNames = ['Mukadi', 'Kabongo', 'Tshisekedi', 'Mbuyi', 'Kasongo', 'Ngoy', 'Mwamba', 'Kalala', 'Luamba', 'Furaha', 'Banza', 'Ntumba', 'Kashala', 'Lunda', 'Mbayo', 'Kalonji', 'Mujinga', 'Tshimbombo', 'Katanga', 'Lokonga'];

// Agents de livraison
$deliveryAgents = [
    ['id' => 'AGT001', 'name' => 'Prisca Mukadi', 'rating' => 4.9, 'deliveries' => rand(45, 89)],
    ['id' => 'AGT002', 'name' => 'Daniel Mwamba', 'rating' => 4.7, 'deliveries' => rand(38, 76)],
    ['id' => 'AGT003', 'name' => 'Sarah Kasongo', 'rating' => 4.8, 'deliveries' => rand(42, 82)],
    ['id' => 'AGT004', 'name' => 'Jean Kalala', 'rating' => 4.6, 'deliveries' => rand(35, 68)],
    ['id' => 'AGT005', 'name' => 'Ruth Kabongo', 'rating' => 4.9, 'deliveries' => rand(48, 91)],
    ['id' => 'AGT006', 'name' => 'Paul Ntumba', 'rating' => 4.5, 'deliveries' => rand(32, 65)]
];

// Génération de commandes réalistes
$orderStatuses = [
    'pending' => ['label' => 'En attente', 'color' => 'var(--warning)', 'icon' => '⏱️'],
    'confirmed' => ['label' => 'Confirmée', 'color' => 'var(--info)', 'icon' => '✅'],
    'preparing' => ['label' => 'Préparation', 'color' => 'var(--accent)', 'icon' => '👨‍🍳'],
    'ready' => ['label' => 'Prête', 'color' => 'var(--primary)', 'icon' => '📦'],
    'delivering' => ['label' => 'En livraison', 'color' => 'var(--accent)', 'icon' => '🚚'],
    'delivered' => ['label' => 'Livrée', 'color' => 'var(--success)', 'icon' => '✅'],
    'cancelled' => ['label' => 'Annulée', 'color' => 'var(--error)', 'icon' => '❌']
];

// Fonction pour générer une commande réaliste
function generateOrder($id) {
    global $products, $universities, $firstNames, $lastNames, $deliveryAgents, $orderStatuses, $currentTime;
    
    $orderId = generateOrderId();
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $university = $universities[array_rand($universities)];
    
    // Sélection aléatoire de produits
    $orderProducts = [];
    $numProducts = rand(1, 3);
    $totalPrice = 0;
    
    for ($i = 0; $i < $numProducts; $i++) {
        $product = $products[array_rand($products)];
        $quantity = rand(1, 2);
        $orderProducts[] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'emoji' => $product['emoji']
        ];
        $totalPrice += $product['price'] * $quantity;
    }
    
    // Statut basé sur l'heure et probabilité
    $statusKeys = array_keys($orderStatuses);
    $statusProbabilities = [0.15, 0.1, 0.2, 0.15, 0.25, 0.1, 0.05]; // Probabilités pour chaque statut
    $randomStatus = $statusKeys[array_search(max($statusProbabilities), $statusProbabilities)];
    
    // Ajustement selon l'heure
    if ($currentHour >= 12 && $currentHour <= 14) {
        $randomStatus = ['preparing', 'delivering', 'ready'][array_rand([0, 1, 2])];
    } elseif ($currentHour >= 18 && $currentHour <= 20) {
        $randomStatus = ['delivering', 'delivered'][array_rand([0, 1])];
    }
    
    $agent = null;
    if (in_array($randomStatus, ['delivering', 'delivered'])) {
        $agent = $deliveryAgents[array_rand($deliveryAgents)];
    }
    
    $timeAgo = rand(1, 180); // 1 à 180 minutes
    $orderTime = $currentTime - ($timeAgo * 60);
    
    return [
        'id' => $orderId,
        'customer_name' => $firstName . ' ' . $lastName,
        'customer_email' => strtolower($firstName . '.' . substr($lastName, 0, 1)) . '@' . strtolower($university['code']) . '.ac.cd',
        'university' => $university,
        'products' => $orderProducts,
        'total' => $totalPrice,
        'status' => $randomStatus,
        'agent' => $agent,
        'created_at' => $orderTime,
        'time_ago' => $timeAgo
    ];
}

// Génération de 25 commandes réalistes
$recentOrders = [];
for ($i = 0; $i < 25; $i++) {
    $recentOrders[] = generateOrder($i);
}

// Tri par heure de création (plus récent en premier)
usort($recentOrders, function($a, $b) {
    return $b['created_at'] - $a['created_at'];
});

// Calcul des statistiques temps réel
$totalOrders = count($recentOrders);
$pendingOrders = array_filter($recentOrders, fn($o) => in_array($o['status'], ['pending', 'confirmed', 'preparing', 'ready', 'delivering']));
$deliveredOrders = array_filter($recentOrders, fn($o) => $o['status'] === 'delivered');
$cancelledOrders = array_filter($recentOrders, fn($o) => $o['status'] === 'cancelled');
$totalRevenue = array_sum(array_map(fn($o) => $o['status'] !== 'cancelled' ? $o['total'] : 0, $recentOrders));
$avgDeliveryTime = rand(18, 28);
$successRate = round((count($deliveredOrders) / max(1, $totalOrders)) * 100, 1);

// Calcul performance par heure
$hourlyPerformance = [];
for ($h = 8; $h <= 22; $h++) {
    $hourlyPerformance[] = [
        'hour' => $h . 'h',
        'orders' => rand(15, 45),
        'revenue' => rand(180000, 450000)
    ];
}
?>

<div class="page-header">
  <h2 class="page-title">📦 Gestion des Commandes</h2>
  <p class="page-subtitle">
    Suivi temps réel des commandes KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      <?= count($pendingOrders) ?> en cours
    </span> • 
    Dernière mise à jour: <span style="color: var(--accent);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Filtres et actions avancés -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
    <button onclick="filterOrders('all')" id="filter-all" class="filter-btn active-filter" style="background: var(--primary); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Toutes (<?= $totalOrders ?>)
    </button>
    <button onclick="filterOrders('pending')" id="filter-pending" class="filter-btn" style="background: var(--warning); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      En attente (<?= count(array_filter($recentOrders, fn($o) => $o['status'] === 'pending')) ?>)
    </button>
    <button onclick="filterOrders('preparing')" id="filter-preparing" class="filter-btn" style="background: var(--accent); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Préparation (<?= count(array_filter($recentOrders, fn($o) => $o['status'] === 'preparing')) ?>)
    </button>
    <button onclick="filterOrders('delivering')" id="filter-delivering" class="filter-btn" style="background: var(--info); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Livraison (<?= count(array_filter($recentOrders, fn($o) => $o['status'] === 'delivering')) ?>)
    </button>
    <button onclick="filterOrders('delivered')" id="filter-delivered" class="filter-btn" style="background: var(--success); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Livrées (<?= count($deliveredOrders) ?>)
    </button>
    <button onclick="filterOrders('cancelled')" id="filter-cancelled" class="filter-btn" style="background: var(--error); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Annulées (<?= count($cancelledOrders) ?>)
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <input type="text" placeholder="🔍 Rechercher par ID, client..." onkeyup="searchOrders(this.value)" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); min-width: 250px; font-size: 0.9rem;">
    <select onchange="filterByUniversity(this.value)" style="padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.9rem;">
      <option value="">Toutes universités</option>
      <?php foreach($universities as $uni): ?>
        <option value="<?= $uni['code'] ?>"><?= $uni['code'] ?></option>
      <?php endforeach; ?>
    </select>
    <button onclick="exportOrders()" style="background: linear-gradient(135deg, var(--accent), #0891b2); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📊 Exporter Excel
    </button>
    <button onclick="refreshOrders()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Statistiques temps réel des commandes -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">📦</div>
    <div class="stat-value" id="total-orders-stat"><?= number_format($totalOrders + 8909) ?></div>
    <div class="stat-label">Commandes Totales</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= rand(5, 15) ?> aujourd'hui</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">⏱️</div>
    <div class="stat-value" id="avg-time-stat"><?= $avgDeliveryTime ?> min</div>
    <div class="stat-label">Temps Moyen Livraison</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= rand(-3, 2) > 0 ? '↗️ Amélioration' : '↘️ Optimisation' ?></span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💰</div>
    <div class="stat-value" id="revenue-stat"><?= number_format($totalRevenue + rand(450000, 789000)) ?> FC</div>
    <div class="stat-label">Revenus Aujourd'hui</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= number_format(rand(15000, 35000)) ?> FC/h</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">✅</div>
    <div class="stat-value" id="success-rate-stat"><?= number_format($successRate + rand(90, 98), 1) ?>%</div>
    <div class="stat-label">Taux de Réussite</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= count($pendingOrders) ?> en cours</span>
    </div>
  </div>
</div>

<!-- Liste des commandes avec design avancé -->
<div class="stat-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
      <h3 style="margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
        📋 Commandes Récentes
        <span style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; animation: pulse 2s infinite;">
          LIVE
        </span>
      </h3>
      <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">
        Affichage de <?= count($recentOrders) ?> commandes • Auto-refresh 15s
      </div>
    </div>
    <div style="display: flex; gap: 0.5rem; align-items: center;">
      <button onclick="showQuickStats()" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.9rem; font-weight: 500;">
        📊 Stats Rapides
      </button>
      <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-size: 0.85rem;">
        <div class="realtime-dot"></div>
        <span>Temps réel</span>
      </div>
    </div>
  </div>
  
  <div style="overflow-x: auto; border-radius: 12px; border: 1px solid var(--border);">
    <table style="width: 100%; border-collapse: collapse; background: var(--glass-bg);">
      <thead>
        <tr style="background: rgba(255,255,255,0.05);">
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;" onclick="sortTable('id')">
              Commande <span style="font-size: 0.7rem;">⚡</span>
            </div>
          </th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Client</th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Campus</th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Produits</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Total</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Statut</th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Livreur</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Actions</th>
        </tr>
      </thead>
      <tbody id="orders-table-body">
        <?php foreach($recentOrders as $order): ?>
          <tr class="order-row" data-status="<?= $order['status'] ?>" data-university="<?= $order['university']['code'] ?>" data-order-id="<?= $order['id'] ?>" 
              style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; cursor: pointer;"
              onmouseenter="this.style.background='rgba(255,255,255,0.05)'" 
              onmouseleave="this.style.background='transparent'"
              onclick="showOrderDetails('<?= $order['id'] ?>')">
            
            <td style="padding: 1rem 0.75rem;">
              <div style="display: flex; flex-direction: column;">
                <div style="color: var(--text-primary); font-weight: 700; font-family: 'Courier New', monospace;"><?= $order['id'] ?></div>
                <div style="color: var(--text-muted); font-size: 0.8rem;">
                  <?php 
                  if ($order['time_ago'] < 60) {
                    echo 'Il y a ' . $order['time_ago'] . ' min';
                  } else {
                    echo 'Il y a ' . round($order['time_ago'] / 60, 1) . 'h';
                  }
                  ?>
                </div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 0.9rem;">
                  <?= strtoupper(substr($order['customer_name'], 0, 2)) ?>
                </div>
                <div>
                  <div style="color: var(--text-primary); font-weight: 600;"><?= $order['customer_name'] ?></div>
                  <div style="color: var(--text-muted); font-size: 0.85rem;"><?= $order['customer_email'] ?></div>
                </div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <span style="background: <?= $order['university']['color'] ?>; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700; display: inline-block;">
                <?= $order['university']['code'] ?>
              </span>
              <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.25rem;">
                <?= $order['university']['name'] ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                <?php foreach($order['products'] as $product): ?>
                  <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary); font-size: 0.9rem;">
                    <span><?= $product['emoji'] ?></span>
                    <span><?= $product['name'] ?> x<?= $product['quantity'] ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="color: var(--success); font-weight: 700; font-size: 1.1rem;"><?= number_format($order['total']) ?> FC</div>
              <div style="color: var(--text-muted); font-size: 0.8rem;">
                <?= count($order['products']) ?> article<?= count($order['products']) > 1 ? 's' : '' ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                <span style="
                  background: <?= $orderStatuses[$order['status']]['color'] ?>; 
                  color: white; 
                  padding: 0.35rem 0.75rem; 
                  border-radius: 999px; 
                  font-size: 0.8rem; 
                  font-weight: 600;
                  display: flex;
                  align-items: center;
                  gap: 0.25rem;
                ">
                  <?= $orderStatuses[$order['status']]['icon'] ?>
                  <?= $orderStatuses[$order['status']]['label'] ?>
                </span>
                <?php if ($order['status'] === 'delivering'): ?>
                  <div style="color: var(--accent); font-size: 0.75rem; font-weight: 600; animation: pulse 2s infinite;">
                    🚚 En route
                  </div>
                <?php endif; ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <?php if ($order['agent']): ?>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                  <div style="width: 30px; height: 30px; border-radius: 50%; background: var(--success); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: white; font-weight: 700;">
                    <?= strtoupper(substr($order['agent']['name'], 0, 2)) ?>
                  </div>
                  <div>
                    <div style="color: var(--text-secondary); font-weight: 600; font-size: 0.85rem;"><?= $order['agent']['id'] ?></div>
                    <div style="color: var(--text-muted); font-size: 0.75rem; display: flex; align-items: center; gap: 0.25rem;">
                      ⭐ <?= $order['agent']['rating'] ?>/5
                    </div>
                  </div>
                </div>
              <?php else: ?>
                <div style="color: var(--text-muted); font-style: italic; font-size: 0.85rem;">Non assigné</div>
              <?php endif; ?>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <div style="display: flex; justify-content: center; gap: 0.5rem;">
                <button onclick="event.stopPropagation(); showOrderDetails('<?= $order['id'] ?>')" title="Voir détails" style="background: none; border: none; color: var(--primary); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(99,102,241,0.1)'" onmouseout="this.style.background='none'">
                  👁️
                </button>
                <?php if (in_array($order['status'], ['pending', 'confirmed'])): ?>
                  <button onclick="event.stopPropagation(); assignAgent('<?= $order['id'] ?>')" title="Assigner livreur" style="background: none; border: none; color: var(--success); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(16,185,129,0.1)'" onmouseout="this.style.background='none'">
                    👨‍💼
                  </button>
                <?php endif; ?>
                <?php if ($order['status'] === 'delivering'): ?>
                  <button onclick="event.stopPropagation(); trackOrder('<?= $order['id'] ?>')" title="Suivi GPS" style="background: none; border: none; color: var(--accent); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(6,182,212,0.1)'" onmouseout="this.style.background='none'">
                    📍
                  </button>
                <?php endif; ?>
                <?php if (in_array($order['status'], ['pending', 'confirmed', 'preparing'])): ?>
                  <button onclick="event.stopPropagation(); cancelOrder('<?= $order['id'] ?>')" title="Annuler" style="background: none; border: none; color: var(--error); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='none'">
                    ❌
                  </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Graphiques de performance -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-top: 2rem;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      📈 Performance Horaire (Aujourd'hui)
      <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">TEMPS RÉEL</span>
    </h3>
    <div style="height: 250px; display: flex; align-items: end; justify-content: space-around; gap: 0.25rem; padding: 1rem 0;">
      <?php foreach($hourlyPerformance as $hour): ?>
        <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
          <div style="
            background: linear-gradient(to top, var(--primary), var(--accent)); 
            height: <?= rand(30, 90) ?>%; 
            width: 100%; 
            border-radius: 4px 4px 0 0; 
            margin-bottom: 0.5rem;
            position: relative;
            overflow: hidden;
          ">
            <div style="position: absolute; bottom: 0; width: 100%; height: 20%; background: rgba(255,255,255,0.2); animation: shimmer 2s infinite;"></div>
          </div>
          <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600; transform: rotate(-45deg); margin-top: 0.5rem;"><?= $hour['hour'] ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🎯 Métriques Clés</h3>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
      <div style="text-align: center; padding: 1rem; background: rgba(16,185,129,0.1); border-radius: 8px; border-left: 4px solid var(--success);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--success); margin-bottom: 0.25rem;"><?= count($deliveredOrders) ?></div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">Livrées aujourd'hui</div>
        <div style="color: var(--success); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;">+<?= rand(5, 15) ?>% vs hier</div>
      </div>
      
      <div style="text-align: center; padding: 1rem; background: rgba(245,158,11,0.1); border-radius: 8px; border-left: 4px solid var(--warning);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--warning); margin-bottom: 0.25rem;"><?= count($pendingOrders) ?></div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">En cours traitement</div>
        <div style="color: var(--warning); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;">Temps moy: <?= $avgDeliveryTime ?> min</div>
      </div>
      
      <div style="text-align: center; padding: 1rem; background: rgba(99,102,241,0.1); border-radius: 8px; border-left: 4px solid var(--primary);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-bottom: 0.25rem;"><?= number_format($totalRevenue / 1000, 0) ?>K</div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">Revenus (FC)</div>
        <div style="color: var(--primary); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;">Objectif: 850K FC</div>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.filter-btn {
  opacity: 0.7;
  transform: scale(0.95);
}

.filter-btn:hover {
  opacity: 1;
  transform: scale(1.05);
}

.active-filter {
  opacity: 1;
  transform: scale(1);
  box-shadow: 0 4px 12px rgba(99,102,241,0.3);
}
</style>

<script>
// Filtrage des commandes avec animation
function filterOrders(status) {
  // Mise à jour des boutons de filtre
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.classList.remove('active-filter');
  });
  document.getElementById('filter-' + status).classList.add('active-filter');
  
  // Animation de filtrage
  const rows = document.querySelectorAll('.order-row');
  rows.forEach((row, index) => {
    row.style.transition = 'all 0.5s ease';
    
    setTimeout(() => {
      if (status === 'all' || row.dataset.status === status) {
        row.style.display = '';
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
          row.style.opacity = '1';
          row.style.transform = 'translateX(0)';
        }, 50);
      } else {
        row.style.opacity = '0';
        row.style.transform = 'translateX(20px)';
        setTimeout(() => row.style.display = 'none', 300);
      }
    }, index * 30);
  });
  
  const statusLabels = {
    'all': 'Toutes les commandes',
    'pending': 'Commandes en attente',
    'preparing': 'Commandes en préparation',
    'delivering': 'Commandes en livraison',
    'delivered': 'Commandes livrées',
    'cancelled': 'Commandes annulées'
  };
  
  showToast(`Filtrage: ${statusLabels[status]}`, 'info');
}

// Recherche en temps réel
function searchOrders(query) {
  const rows = document.querySelectorAll('.order-row');
  const normalizedQuery = query.toLowerCase().trim();
  
  rows.forEach(row => {
    const orderId = row.dataset.orderId.toLowerCase();
    const customerName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
    const university = row.dataset.university.toLowerCase();
    
    const matches = orderId.includes(normalizedQuery) || 
                   customerName.includes(normalizedQuery) || 
                   university.includes(normalizedQuery);
    
    row.style.display = matches || query === '' ? '' : 'none';
    
    if (matches && query !== '') {
      row.style.background = 'rgba(99,102,241,0.1)';
      setTimeout(() => row.style.background = '', 2000);
    }
  });
  
  if (query.length > 2) {
    showToast(`Recherche: "${query}"`, 'info');
  }
}

// Filtre par université
function filterByUniversity(uniCode) {
  const rows = document.querySelectorAll('.order-row');
  
  rows.forEach(row => {
    if (uniCode === '' || row.dataset.university === uniCode) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
  
  if (uniCode) {
    showToast(`Filtrage université: ${uniCode}`, 'info');
  }
}

// Actions sur les commandes
function showOrderDetails(orderId) {
  showToast(`Chargement détails commande ${orderId}...`, 'info');
  
  // Simulation d'ouverture de modal
  setTimeout(() => {
    showToast(`Détails commande ${orderId} chargés`, 'success');
  }, 1200);
}

function assignAgent(orderId) {
  const agents = ['AGT001', 'AGT002', 'AGT003', 'AGT004', 'AGT005'];
  const randomAgent = agents[Math.floor(Math.random() * agents.length)];
  
  showToast(`Assignation livreur ${randomAgent} à ${orderId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Livreur ${randomAgent} assigné avec succès`, 'success');
    // Mise à jour du statut en temps réel
    const row = document.querySelector(`[data-order-id="${orderId}"]`);
    if (row) {
      const statusCell = row.querySelector('td:nth-child(6)');
      statusCell.innerHTML = `
        <span style="background: var(--accent); color: white; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600;">
          🚚 En livraison
        </span>
      `;
      row.dataset.status = 'delivering';
    }
  }, 1500);
}

function trackOrder(orderId) {
  showToast(`Ouverture suivi GPS commande ${orderId}`, 'info');
  
  // Simulation de mise à jour de position
  setTimeout(() => {
    showToast(`📍 Position mise à jour: Campus UNIKIN, Bloc A`, 'success');
  }, 1000);
}

function cancelOrder(orderId) {
  if (confirm(`⚠️ Confirmer l'annulation de la commande ${orderId} ?\n\nCette action est irréversible.`)) {
    showToast(`Annulation commande ${orderId}...`, 'warning');
    
    setTimeout(() => {
      showToast(`Commande ${orderId} annulée - Remboursement traité`, 'success');
      
      // Mise à jour visuelle
      const row = document.querySelector(`[data-order-id="${orderId}"]`);
      if (row) {
        row.style.opacity = '0.6';
        const statusCell = row.querySelector('td:nth-child(6)');
        statusCell.innerHTML = `
          <span style="background: var(--error); color: white; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600;">
            ❌ Annulée
          </span>
        `;
        row.dataset.status = 'cancelled';
      }
    }, 2000);
  }
}

// Export Excel
function exportOrders() {
  showToast('Génération export Excel...', 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 25;
    showToast(`Export en cours: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast('📊 Export Excel téléchargé avec succès', 'success');
    }
  }, 500);
}

// Actualisation
function refreshOrders() {
  showToast('Actualisation des commandes...', 'info');
  
  const tableBody = document.getElementById('orders-table-body');
  tableBody.style.opacity = '0.5';
  
  setTimeout(() => {
    tableBody.style.opacity = '1';
    showToast('✅ Données actualisées', 'success');
    
    // Simulation de nouvelles commandes
    updateRealTimeStats();
  }, 2000);
}

// Stats rapides
function showQuickStats() {
  const modal = `
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; display: flex; align-items: center; justify-content: center;" onclick="this.remove()">
      <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 16px; padding: 2rem; min-width: 400px;" onclick="event.stopPropagation()">
        <h3 style="color: var(--text-primary); margin-bottom: 1.5rem;">📊 Statistiques Rapides</h3>
        
        <div style="display: grid; gap: 1rem;">
          <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
            <span>Commandes cette heure:</span>
            <strong style="color: var(--success);"><?= rand(8, 24) ?></strong>
          </div>
          
          <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
            <span>Temps moyen actuel:</span>
            <strong style="color: var(--accent);"><?= rand(15, 25) ?> min</strong>
          </div>
          
          <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
            <span>Revenus dernière heure:</span>
            <strong style="color: var(--primary);"><?= number_format(rand(25000, 45000)) ?> FC</strong>
          </div>
          
          <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
            <span>Agents actifs:</span>
            <strong style="color: var(--warning);"><?= rand(15, 28) ?>/47</strong>
          </div>
        </div>
        
        <button onclick="this.parentElement.parentElement.remove()" style="background: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; margin-top: 1.5rem; cursor: pointer; font-weight: 600; width: 100%;">
          Fermer
        </button>
      </div>
    </div>
  `;
  
  document.body.insertAdjacentHTML('beforeend', modal);
}

// Mise à jour temps réel des stats
function updateRealTimeStats() {
  // Mise à jour nombre total
  const totalElement = document.getElementById('total-orders-stat');
  if (totalElement) {
    const current = parseInt(totalElement.textContent.replace(/,/g, ''));
    totalElement.textContent = new Intl.NumberFormat().format(current + Math.floor(Math.random() * 3));
  }
  
  // Mise à jour temps moyen
  const timeElement = document.getElementById('avg-time-stat');
  if (timeElement) {
    const change = Math.floor(Math.random() * 6) - 3; // -3 à +2
    const currentTime = parseInt(timeElement.textContent.split(' ')[0]);
    const newTime = Math.max(15, Math.min(35, currentTime + change));
    timeElement.textContent = newTime + ' min';
  }
  
  // Mise à jour revenus
  const revenueElement = document.getElementById('revenue-stat');
  if (revenueElement) {
    const current = parseInt(revenueElement.textContent.replace(/[FC,\s]/g, ''));
    const increase = Math.floor(Math.random() * 5000) + 1000;
    revenueElement.textContent = new Intl.NumberFormat().format(current + increase) + ' FC';
  }
}

// Auto-refresh toutes les 15 secondes
setInterval(() => {
  updateRealTimeStats();
  
  // Simulation nouvelles commandes
  if (Math.random() > 0.6) {
    showToast('🔔 Nouvelle commande reçue!', 'success');
  }
}, 15000);

// Tri du tableau
function sortTable(column) {
  showToast(`Tri par ${column}...`, 'info');
  
  const tbody = document.getElementById('orders-table-body');
  tbody.style.opacity = '0.7';
  
  setTimeout(() => {
    tbody.style.opacity = '1';
    showToast('Tableau trié', 'success');
  }, 800);
}
</script>