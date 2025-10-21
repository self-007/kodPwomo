<?php
// Simulation ultra-réaliste des produits et restaurants avec données temps réel
$currentTime = time();
$currentHour = date('H');

// Catégories de produits avec emojis
$categories = [
    'pizza' => ['name' => 'Pizzas', 'emoji' => '🍕', 'color' => '#e74c3c'],
    'burger' => ['name' => 'Burgers', 'emoji' => '🍔', 'color' => '#f39c12'],
    'sandwich' => ['name' => 'Sandwichs', 'emoji' => '🥪', 'color' => '#27ae60'],
    'salad' => ['name' => 'Salades', 'emoji' => '🥗', 'color' => '#2ecc71'],
    'drink' => ['name' => 'Boissons', 'emoji' => '🥤', 'color' => '#3498db'],
    'coffee' => ['name' => 'Café/Thé', 'emoji' => '☕', 'color' => '#8b4513'],
    'dessert' => ['name' => 'Desserts', 'emoji' => '🧁', 'color' => '#e91e63'],
    'african' => ['name' => 'Plats Africains', 'emoji' => '🍛', 'color' => '#ff5722'],
    'snack' => ['name' => 'Snacks', 'emoji' => '🥨', 'color' => '#ff9800'],
    'breakfast' => ['name' => 'Petit-déjeuner', 'emoji' => '🥐', 'color' => '#ffc107']
];

// Restaurants partenaires réalistes
$restaurants = [
    [
        'id' => 'REST001',
        'name' => 'Pizza Palace UNIKIN',
        'owner' => 'Jean-Claude Mukadi',
        'specialty' => 'pizza',
        'rating' => 4.8,
        'orders_count' => rand(450, 650),
        'revenue_today' => rand(180000, 320000),
        'status' => 'active',
        'joined_months_ago' => rand(6, 24)
    ],
    [
        'id' => 'REST002', 
        'name' => 'Burger King Campus',
        'owner' => 'Sarah Kalala',
        'specialty' => 'burger',
        'rating' => 4.6,
        'orders_count' => rand(380, 520),
        'revenue_today' => rand(150000, 280000),
        'status' => 'active',
        'joined_months_ago' => rand(8, 18)
    ],
    [
        'id' => 'REST003',
        'name' => 'Café des Étudiants',
        'owner' => 'Paul Ntumba',
        'specialty' => 'coffee',
        'rating' => 4.9,
        'orders_count' => rand(290, 450),
        'revenue_today' => rand(90000, 180000),
        'status' => 'active',
        'joined_months_ago' => rand(12, 30)
    ],
    [
        'id' => 'REST004',
        'name' => 'Mama Nzuzi Kitchen',
        'owner' => 'Grace Mbuyi',
        'specialty' => 'african',
        'rating' => 4.7,
        'orders_count' => rand(320, 480),
        'revenue_today' => rand(140000, 250000),
        'status' => 'active',
        'joined_months_ago' => rand(4, 15)
    ],
    [
        'id' => 'REST005',
        'name' => 'Fresh & Healthy',
        'owner' => 'Daniel Kasongo',
        'specialty' => 'salad',
        'rating' => 4.5,
        'orders_count' => rand(180, 320),
        'revenue_today' => rand(85000, 160000),
        'status' => 'active',
        'joined_months_ago' => rand(3, 12)
    ],
    [
        'id' => 'REST006',
        'name' => 'Sandwich Corner',
        'owner' => 'Marie Furaha',
        'specialty' => 'sandwich',
        'rating' => 4.4,
        'orders_count' => rand(220, 380),
        'revenue_today' => rand(110000, 190000),
        'status' => 'maintenance',
        'joined_months_ago' => rand(6, 20)
    ]
];

// Produits populaires avec données réalistes
function generateProducts() {
    global $categories;
    
    $products = [
        // Pizzas
        ['name' => 'Pizza Margherita', 'category' => 'pizza', 'price' => 15000, 'cost' => 8000, 'stock' => rand(15, 35), 'sold_today' => rand(25, 45)],
        ['name' => 'Pizza Pepperoni', 'category' => 'pizza', 'price' => 18000, 'cost' => 9500, 'stock' => rand(12, 28), 'sold_today' => rand(20, 38)],
        ['name' => 'Pizza Végétarienne', 'category' => 'pizza', 'price' => 16000, 'cost' => 8500, 'stock' => rand(8, 25), 'sold_today' => rand(15, 30)],
        ['name' => 'Pizza 4 Fromages', 'category' => 'pizza', 'price' => 20000, 'cost' => 11000, 'stock' => rand(6, 20), 'sold_today' => rand(12, 25)],
        
        // Burgers
        ['name' => 'Burger Classic', 'category' => 'burger', 'price' => 14000, 'cost' => 7500, 'stock' => rand(20, 40), 'sold_today' => rand(30, 50)],
        ['name' => 'Cheeseburger Deluxe', 'category' => 'burger', 'price' => 16000, 'cost' => 8500, 'stock' => rand(15, 32), 'sold_today' => rand(22, 40)],
        ['name' => 'Burger Chicken', 'category' => 'burger', 'price' => 15000, 'cost' => 8000, 'stock' => rand(12, 28), 'sold_today' => rand(18, 35)],
        
        // Sandwichs
        ['name' => 'Club Sandwich', 'category' => 'sandwich', 'price' => 12000, 'cost' => 6500, 'stock' => rand(25, 45), 'sold_today' => rand(35, 55)],
        ['name' => 'Croque-Monsieur', 'category' => 'sandwich', 'price' => 10000, 'cost' => 5500, 'stock' => rand(20, 38), 'sold_today' => rand(28, 45)],
        ['name' => 'Sandwich Thon', 'category' => 'sandwich', 'price' => 9000, 'cost' => 5000, 'stock' => rand(18, 35), 'sold_today' => rand(25, 42)],
        
        // Boissons
        ['name' => 'Coca Cola 50cl', 'category' => 'drink', 'price' => 2000, 'cost' => 1200, 'stock' => rand(50, 100), 'sold_today' => rand(80, 120)],
        ['name' => 'Fanta Orange 50cl', 'category' => 'drink', 'price' => 2000, 'cost' => 1200, 'stock' => rand(45, 90), 'sold_today' => rand(65, 95)],
        ['name' => 'Eau Minérale 50cl', 'category' => 'drink', 'price' => 1500, 'cost' => 800, 'stock' => rand(60, 120), 'sold_today' => rand(90, 140)],
        ['name' => 'Jus d\'Orange Frais', 'category' => 'drink', 'price' => 3500, 'cost' => 2000, 'stock' => rand(20, 40), 'sold_today' => rand(25, 45)],
        
        // Café/Thé
        ['name' => 'Café Expresso', 'category' => 'coffee', 'price' => 3000, 'cost' => 1500, 'stock' => rand(30, 60), 'sold_today' => rand(45, 75)],
        ['name' => 'Cappuccino', 'category' => 'coffee', 'price' => 4000, 'cost' => 2000, 'stock' => rand(25, 50), 'sold_today' => rand(35, 60)],
        ['name' => 'Thé Vert', 'category' => 'coffee', 'price' => 2500, 'cost' => 1200, 'stock' => rand(35, 65), 'sold_today' => rand(40, 70)],
        
        // Plats Africains
        ['name' => 'Pondu + Riz', 'category' => 'african', 'price' => 8000, 'cost' => 4500, 'stock' => rand(15, 35), 'sold_today' => rand(20, 40)],
        ['name' => 'Poulet + Fufu', 'category' => 'african', 'price' => 12000, 'cost' => 7000, 'stock' => rand(10, 25), 'sold_today' => rand(15, 30)],
        ['name' => 'Poisson Braisé + Banane', 'category' => 'african', 'price' => 15000, 'cost' => 8500, 'stock' => rand(8, 20), 'sold_today' => rand(12, 25)],
        
        // Salades
        ['name' => 'Salade César', 'category' => 'salad', 'price' => 16000, 'cost' => 8000, 'stock' => rand(12, 25), 'sold_today' => rand(8, 20)],
        ['name' => 'Salade Mixte', 'category' => 'salad', 'price' => 12000, 'cost' => 6000, 'stock' => rand(15, 30), 'sold_today' => rand(10, 25)],
        
        // Desserts
        ['name' => 'Muffin Chocolat', 'category' => 'dessert', 'price' => 5000, 'cost' => 2500, 'stock' => rand(20, 40), 'sold_today' => rand(15, 35)],
        ['name' => 'Tarte aux Fruits', 'category' => 'dessert', 'price' => 7000, 'cost' => 3500, 'stock' => rand(12, 25), 'sold_today' => rand(8, 18)],
        
        // Petit-déjeuner
        ['name' => 'Croissant Beurre', 'category' => 'breakfast', 'price' => 4500, 'cost' => 2200, 'stock' => rand(25, 50), 'sold_today' => rand(35, 60)],
        ['name' => 'Pain au Chocolat', 'category' => 'breakfast', 'price' => 5000, 'cost' => 2500, 'stock' => rand(20, 40), 'sold_today' => rand(25, 45)]
    ];
    
    // Ajout d'ID et calculs
    foreach ($products as $key => $product) {
        $products[$key]['id'] = 'PROD' . str_pad($key + 1, 3, '0', STR_PAD_LEFT);
        $products[$key]['profit_margin'] = round((($product['price'] - $product['cost']) / $product['price']) * 100, 1);
        $products[$key]['revenue_today'] = $product['sold_today'] * $product['price'];
        $products[$key]['profit_today'] = $product['sold_today'] * ($product['price'] - $product['cost']);
        $products[$key]['popularity_score'] = $product['sold_today'] + rand(-5, 15);
    }
    
    return $products;
}

$products = generateProducts();

// Tri par popularité
usort($products, function($a, $b) {
    return $b['sold_today'] - $a['sold_today'];
});

// Calculs des statistiques
$totalProducts = count($products);
$totalRevenue = array_sum(array_column($products, 'revenue_today'));
$totalProfit = array_sum(array_column($products, 'profit_today'));
$avgMargin = round(array_sum(array_column($products, 'profit_margin')) / $totalProducts, 1);
$totalSoldToday = array_sum(array_column($products, 'sold_today'));
$lowStockProducts = array_filter($products, fn($p) => $p['stock'] < 15);
$topSellerToday = $products[0] ?? null;

// Performance par catégorie
$categoryStats = [];
foreach ($categories as $catKey => $catInfo) {
    $catProducts = array_filter($products, fn($p) => $p['category'] === $catKey);
    $categoryStats[$catKey] = [
        'info' => $catInfo,
        'count' => count($catProducts),
        'revenue' => array_sum(array_column($catProducts, 'revenue_today')),
        'sold' => array_sum(array_column($catProducts, 'sold_today'))
    ];
}

// Tri par revenus
uasort($categoryStats, function($a, $b) {
    return $b['revenue'] - $a['revenue'];
});
?>

<div class="page-header">
  <h2 class="page-title">🛍️ Produits & Restaurants</h2>
  <p class="page-subtitle">
    Catalogue KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      <?= $totalSoldToday ?> vendus aujourd'hui
    </span> • 
    <span style="color: var(--warning); font-weight: 600;">
      <?= count($lowStockProducts) ?> stock bas
    </span> • 
    Sync: <span style="color: var(--primary);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Filtres et actions -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
    <button onclick="filterProducts('all')" id="filter-all" class="filter-btn active-filter" style="background: var(--primary); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Tous (<?= $totalProducts ?>)
    </button>
    <?php foreach(array_slice($categoryStats, 0, 6) as $catKey => $catStat): ?>
      <button onclick="filterProducts('<?= $catKey ?>')" id="filter-<?= $catKey ?>" class="filter-btn" style="background: <?= $catStat['info']['color'] ?>; border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
        <?= $catStat['info']['emoji'] ?> <?= $catStat['info']['name'] ?> (<?= $catStat['count'] ?>)
      </button>
    <?php endforeach; ?>
    <button onclick="filterProducts('low-stock')" id="filter-low-stock" class="filter-btn" style="background: var(--error); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      ⚠️ Stock Bas (<?= count($lowStockProducts) ?>)
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <input type="text" placeholder="🔍 Rechercher produit..." onkeyup="searchProducts(this.value)" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); min-width: 250px; font-size: 0.9rem;">
    <select onchange="sortProducts(this.value)" style="padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.9rem;">
      <option value="popularity">Trier par popularité</option>
      <option value="price-asc">Prix croissant</option>
      <option value="price-desc">Prix décroissant</option>
      <option value="margin">Marge bénéficiaire</option>
      <option value="stock">Stock disponible</option>
    </select>
    <button onclick="addNewProduct()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      ➕ Nouveau Produit
    </button>
    <button onclick="bulkImport()" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📥 Import CSV
    </button>
    <button onclick="refreshProducts()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Statistiques des produits -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">📦</div>
    <div class="stat-value" id="total-products-stat"><?= $totalProducts + 156 ?></div>
    <div class="stat-label">Produits Actifs</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= $totalSoldToday ?> vendus</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💰</div>
    <div class="stat-value" id="revenue-stat"><?= number_format($totalRevenue) ?> FC</div>
    <div class="stat-label">Revenus Produits</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= number_format(rand(15000, 35000)) ?> FC/h</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-value" id="margin-stat"><?= $avgMargin ?>%</div>
    <div class="stat-label">Marge Moyenne</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= number_format($totalProfit) ?> FC profit</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">⚠️</div>
    <div class="stat-value" id="low-stock-stat"><?= count($lowStockProducts) ?></div>
    <div class="stat-label">Stocks Faibles</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Réappro. nécessaire</span>
    </div>
  </div>
</div>

<!-- Performance par catégorie -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      📊 Performance par Catégorie
      <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">TEMPS RÉEL</span>
    </h3>
    <div style="display: grid; gap: 1rem;">
      <?php foreach($categoryStats as $catKey => $catStat): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 4px solid <?= $catStat['info']['color'] ?>;">
          <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem;"><?= $catStat['info']['emoji'] ?></div>
            <div>
              <div style="font-weight: 700; color: var(--text-primary); font-size: 1.1rem;"><?= $catStat['info']['name'] ?></div>
              <div style="color: var(--text-muted); font-size: 0.9rem;"><?= $catStat['count'] ?> produits</div>
            </div>
          </div>
          <div style="text-align: right;">
            <div style="font-weight: 700; color: <?= $catStat['info']['color'] ?>; font-size: 1.2rem;"><?= number_format($catStat['revenue']) ?> FC</div>
            <div style="color: var(--text-muted); font-size: 0.85rem;"><?= $catStat['sold'] ?> vendus</div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div style="display: flex; flex-direction: column; gap: 1rem;">
    <!-- Top seller -->
    <?php if($topSellerToday): ?>
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
        🏆 Meilleure Vente
      </h3>
      <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, var(--success), #059669); border-radius: 12px; color: white;">
        <div style="font-size: 2.5rem; margin-bottom: 0.5rem;"><?= $categories[$topSellerToday['category']]['emoji'] ?></div>
        <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;"><?= $topSellerToday['name'] ?></div>
        <div style="font-size: 2rem; font-weight: 900; margin-bottom: 0.25rem;"><?= $topSellerToday['sold_today'] ?></div>
        <div style="font-size: 0.9rem; opacity: 0.9;">vendus aujourd'hui</div>
        <div style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.8;"><?= number_format($topSellerToday['revenue_today']) ?> FC</div>
      </div>
    </div>
    <?php endif; ?>
    
    <!-- Restaurants actifs -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">🏪 Restaurants Partenaires</h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <?php foreach(array_slice($restaurants, 0, 4) as $restaurant): ?>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px;">
            <div>
              <div style="font-weight: 600; color: var(--text-primary); font-size: 0.95rem;"><?= $restaurant['name'] ?></div>
              <div style="color: var(--text-muted); font-size: 0.8rem; display: flex; align-items: center; gap: 0.25rem;">
                ⭐ <?= $restaurant['rating'] ?>/5 • <?= $restaurant['orders_count'] ?> commandes
              </div>
            </div>
            <div style="text-align: right;">
              <div style="font-weight: 700; color: var(--success); font-size: 0.9rem;"><?= number_format($restaurant['revenue_today']) ?></div>
              <div style="color: var(--text-muted); font-size: 0.75rem;">FC aujourd'hui</div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- Liste des produits -->
<div class="stat-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
      <h3 style="margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
        🛍️ Catalogue Produits
        <span style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; animation: pulse 2s infinite;">
          LIVE
        </span>
      </h3>
      <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">
        <?= count($products) ?> produits • Mis à jour en temps réel
      </div>
    </div>
    <div style="display: flex; gap: 0.5rem; align-items: center;">
      <button onclick="viewProductAnalytics()" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.9rem; font-weight: 500;">
        📈 Analytics
      </button>
      <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-size: 0.85rem;">
        <div class="realtime-dot"></div>
        <span>Inventaire sync</span>
      </div>
    </div>
  </div>
  
  <div style="overflow-x: auto; border-radius: 12px; border: 1px solid var(--border);">
    <table style="width: 100%; border-collapse: collapse; background: var(--glass-bg);">
      <thead>
        <tr style="background: rgba(255,255,255,0.05);">
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Produit</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Catégorie</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Prix</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Stock</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Vendus</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Marge</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Revenus</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Actions</th>
        </tr>
      </thead>
      <tbody id="products-table-body">
        <?php foreach($products as $product): ?>
          <tr class="product-row" data-category="<?= $product['category'] ?>" data-product-id="<?= $product['id'] ?>" data-stock="<?= $product['stock'] ?>"
              style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; cursor: pointer;"
              onmouseenter="this.style.background='rgba(255,255,255,0.05)'" 
              onmouseleave="this.style.background='transparent'"
              onclick="showProductDetails('<?= $product['id'] ?>')">
            
            <td style="padding: 1rem 0.75rem;">
              <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;"><?= $categories[$product['category']]['emoji'] ?></div>
                <div>
                  <div style="color: var(--text-primary); font-weight: 700; font-size: 1rem;"><?= $product['name'] ?></div>
                  <div style="color: var(--text-muted); font-size: 0.85rem; font-family: 'Courier New', monospace;"><?= $product['id'] ?></div>
                  <div style="color: var(--text-muted); font-size: 0.8rem;">Coût: <?= number_format($product['cost']) ?> FC</div>
                </div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <span style="
                background: <?= $categories[$product['category']]['color'] ?>; 
                color: white; 
                padding: 0.35rem 0.75rem; 
                border-radius: 999px; 
                font-size: 0.8rem; 
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
              ">
                <?= $categories[$product['category']]['emoji'] ?>
                <?= $categories[$product['category']]['name'] ?>
              </span>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="color: var(--primary); font-weight: 700; font-size: 1.1rem;"><?= number_format($product['price']) ?> FC</div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <div style="display: flex; flex-direction: column; align-items: center; gap: 0.25rem;">
                <span style="
                  background: <?= $product['stock'] < 15 ? 'var(--error)' : ($product['stock'] < 25 ? 'var(--warning)' : 'var(--success)') ?>; 
                  color: white; 
                  padding: 0.35rem 0.75rem; 
                  border-radius: 999px; 
                  font-size: 0.9rem; 
                  font-weight: 700;
                ">
                  <?= $product['stock'] ?>
                </span>
                <?php if($product['stock'] < 15): ?>
                  <div style="color: var(--error); font-size: 0.75rem; font-weight: 600;">Stock bas!</div>
                <?php endif; ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="color: var(--accent); font-weight: 700; font-size: 1.1rem;"><?= $product['sold_today'] ?></div>
              <div style="color: var(--text-muted); font-size: 0.8rem;">aujourd'hui</div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="color: var(--success); font-weight: 700; font-size: 1rem;"><?= $product['profit_margin'] ?>%</div>
              <div style="color: var(--text-muted); font-size: 0.8rem;"><?= number_format($product['profit_today']) ?> FC</div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="color: var(--success); font-weight: 700; font-size: 1.1rem;"><?= number_format($product['revenue_today']) ?></div>
              <div style="color: var(--text-muted); font-size: 0.8rem;">FC</div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <div style="display: flex; justify-content: center; gap: 0.5rem;">
                <button onclick="event.stopPropagation(); showProductDetails('<?= $product['id'] ?>')" title="Voir détails" style="background: none; border: none; color: var(--primary); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  👁️
                </button>
                <button onclick="event.stopPropagation(); editProduct('<?= $product['id'] ?>')" title="Modifier" style="background: none; border: none; color: var(--warning); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  ✏️
                </button>
                <button onclick="event.stopPropagation(); updateStock('<?= $product['id'] ?>')" title="Gérer stock" style="background: none; border: none; color: var(--accent); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  📦
                </button>
                <button onclick="event.stopPropagation(); duplicateProduct('<?= $product['id'] ?>')" title="Dupliquer" style="background: none; border: none; color: var(--success); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  📋
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<style>
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
// Filtrage des produits
function filterProducts(category) {
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.classList.remove('active-filter');
  });
  document.getElementById('filter-' + category).classList.add('active-filter');
  
  const rows = document.querySelectorAll('.product-row');
  rows.forEach((row, index) => {
    row.style.transition = 'all 0.5s ease';
    
    setTimeout(() => {
      let show = false;
      if (category === 'all') show = true;
      else if (category === 'low-stock') show = parseInt(row.dataset.stock) < 15;
      else show = row.dataset.category === category;
      
      if (show) {
        row.style.display = '';
        row.style.opacity = '0';
        row.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
          row.style.opacity = '1';
          row.style.transform = 'translateY(0)';
        }, 50);
      } else {
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';
        setTimeout(() => row.style.display = 'none', 300);
      }
    }, index * 20);
  });
  
  showToast(`Filtrage: ${category}`, 'info');
}

// Recherche produits
function searchProducts(query) {
  const rows = document.querySelectorAll('.product-row');
  const normalizedQuery = query.toLowerCase().trim();
  
  rows.forEach(row => {
    const productName = row.querySelector('td:first-child').textContent.toLowerCase();
    const productId = row.dataset.productId.toLowerCase();
    
    const matches = productName.includes(normalizedQuery) || productId.includes(normalizedQuery);
    
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

// Tri des produits
function sortProducts(criteria) {
  showToast(`Tri par ${criteria}...`, 'info');
  
  const tbody = document.getElementById('products-table-body');
  tbody.style.opacity = '0.7';
  
  setTimeout(() => {
    tbody.style.opacity = '1';
    showToast('Produits triés', 'success');
  }, 800);
}

// Actions produits
function showProductDetails(productId) {
  showToast(`Chargement détails produit ${productId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Détails produit ${productId} affichés`, 'success');
  }, 1000);
}

function editProduct(productId) {
  showToast(`Modification produit ${productId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Formulaire d'édition ouvert`, 'success');
  }, 800);
}

function updateStock(productId) {
  const newStock = prompt(`Entrer le nouveau stock pour ${productId}:`);
  if (newStock && !isNaN(newStock)) {
    showToast(`Mise à jour stock ${productId}: ${newStock} unités`, 'success');
    
    // Mise à jour visuelle
    const row = document.querySelector(`[data-product-id="${productId}"]`);
    if (row) {
      const stockCell = row.querySelector('td:nth-child(4) span');
      stockCell.textContent = newStock;
      stockCell.style.background = newStock < 15 ? 'var(--error)' : (newStock < 25 ? 'var(--warning)' : 'var(--success)');
    }
  }
}

function duplicateProduct(productId) {
  showToast(`Duplication produit ${productId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Produit ${productId} dupliqué avec succès`, 'success');
  }, 1200);
}

function addNewProduct() {
  showToast('Ouverture formulaire nouveau produit...', 'info');
  
  setTimeout(() => {
    showToast('📝 Formulaire produit ouvert', 'success');
  }, 800);
}

function bulkImport() {
  showToast('Ouverture import CSV...', 'info');
  
  setTimeout(() => {
    showToast('📥 Sélectionner fichier CSV', 'info');
  }, 500);
}

function viewProductAnalytics() {
  showToast('Chargement analytics produits...', 'info');
  
  setTimeout(() => {
    showToast('📈 Rapport analytics généré', 'success');
  }, 1500);
}

function refreshProducts() {
  showToast('Synchronisation catalogue...', 'info');
  
  const tableBody = document.getElementById('products-table-body');
  tableBody.style.opacity = '0.5';
  
  setTimeout(() => {
    tableBody.style.opacity = '1';
    showToast('✅ Catalogue synchronisé', 'success');
    
    updateProductStats();
  }, 2000);
}

// Mise à jour temps réel
function updateProductStats() {
  const revenueElement = document.getElementById('revenue-stat');
  if (revenueElement) {
    const current = parseInt(revenueElement.textContent.replace(/[FC,\s]/g, ''));
    const increase = Math.floor(Math.random() * 10000) + 2000;
    revenueElement.textContent = new Intl.NumberFormat().format(current + increase) + ' FC';
  }
  
  const lowStockElement = document.getElementById('low-stock-stat');
  if (lowStockElement) {
    const change = Math.floor(Math.random() * 3) - 1; // -1, 0, ou +1
    const current = parseInt(lowStockElement.textContent);
    const newValue = Math.max(0, current + change);
    lowStockElement.textContent = newValue;
  }
}

// Auto-refresh toutes les 20 secondes
setInterval(() => {
  updateProductStats();
  
  if (Math.random() > 0.8) {
    showToast('🛍️ Nouvelle vente enregistrée!', 'success');
  }
}, 20000);
</script>