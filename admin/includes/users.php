<?php
// Simulation ultra-réaliste des utilisateurs avec données temps réel
$currentTime = time();
$currentHour = date('H');

// Universités avec codes réalistes
$universities = [
    ['code' => 'UNIKIN', 'name' => 'Université de Kinshasa', 'color' => 'var(--primary)', 'students' => rand(28000, 32000)],
    ['code' => 'UNILU', 'name' => 'Université de Lubumbashi', 'color' => 'var(--accent)', 'students' => rand(18000, 22000)],
    ['code' => 'UOB', 'name' => 'Université Officielle de Bukavu', 'color' => 'var(--success)', 'students' => rand(12000, 16000)],
    ['code' => 'UNIKIS', 'name' => 'Université de Kisangani', 'color' => 'var(--warning)', 'students' => rand(15000, 19000)],
    ['code' => 'UNIGOM', 'name' => 'Université de Goma', 'color' => 'var(--error)', 'students' => rand(8000, 12000)],
    ['code' => 'UNIKAT', 'name' => 'Université de Katanga', 'color' => 'var(--primary)', 'students' => rand(14000, 18000)],
    ['code' => 'UNIKOL', 'name' => 'Université Kongo', 'color' => 'var(--accent)', 'students' => rand(6000, 10000)],
    ['code' => 'UNIMAD', 'name' => 'Université de Matadi', 'color' => 'var(--success)', 'students' => rand(5000, 8000)]
];

// Prénoms et noms congolais réalistes
$firstNames = ['Jean', 'Marie', 'Paul', 'Grace', 'David', 'Sarah', 'Joseph', 'Esther', 'Pierre', 'Ruth', 'Samuel', 'Rebecca', 'Daniel', 'Deborah', 'Michel', 'Judith', 'Emmanuel', 'Naomi', 'Isaac', 'Lydia', 'Benjamin', 'Rachel', 'André', 'Priscilla', 'Moïse'];
$lastNames = ['Mukadi', 'Kabongo', 'Tshisekedi', 'Mbuyi', 'Kasongo', 'Ngoy', 'Mwamba', 'Kalala', 'Luamba', 'Furaha', 'Banza', 'Ntumba', 'Kashala', 'Lunda', 'Mbayo', 'Kalonji', 'Mujinga', 'Tshimbombo', 'Katanga', 'Lokonga', 'Ilunga', 'Mulumba', 'Kayembe', 'Mwanza', 'Mpiana'];

// Facultés réalistes
$faculties = [
    'Médecine', 'Droit', 'Sciences Économiques', 'Polytechnique', 'Lettres et Sciences Humaines',
    'Sciences', 'Agronomie', 'Médecine Vétérinaire', 'Théologie', 'Psychologie et Sciences de l\'Éducation',
    'Sciences Sociales', 'Architecture', 'Pharmacie', 'Kinésithérapie', 'Sciences de l\'Information'
];

// Types d'utilisateurs
$userTypes = [
    'student' => ['label' => 'Étudiant', 'color' => 'var(--primary)', 'icon' => '🎓'],
    'agent' => ['label' => 'Agent Livraison', 'color' => 'var(--success)', 'icon' => '🚚'],
    'restaurant' => ['label' => 'Restaurant', 'color' => 'var(--warning)', 'icon' => '🍽️'],
    'admin' => ['label' => 'Administrateur', 'color' => 'var(--error)', 'icon' => '👨‍💼']
];

// Statuts utilisateurs
$userStatuses = [
    'active' => ['label' => 'Actif', 'color' => 'var(--success)', 'icon' => '✅'],
    'inactive' => ['label' => 'Inactif', 'color' => 'var(--warning)', 'icon' => '⏸️'],
    'suspended' => ['label' => 'Suspendu', 'color' => 'var(--error)', 'icon' => '⛔'],
    'pending' => ['label' => 'En attente', 'color' => 'var(--info)', 'icon' => '⏳']
];

// Génération d'utilisateurs réalistes
function generateUser($id) {
    global $firstNames, $lastNames, $universities, $faculties, $userTypes, $userStatuses, $currentTime;
    
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $university = $universities[array_rand($universities)];
    $userTypeKey = array_rand($userTypes);
    
    // Distribution réaliste des types d'utilisateurs
    $typeDistribution = ['student' => 85, 'agent' => 8, 'restaurant' => 5, 'admin' => 2];
    $rand = rand(1, 100);
    if ($rand <= 85) $userTypeKey = 'student';
    elseif ($rand <= 93) $userTypeKey = 'agent';
    elseif ($rand <= 98) $userTypeKey = 'restaurant';
    else $userTypeKey = 'admin';
    
    $statusKey = array_rand($userStatuses);
    // 80% actifs, 15% inactifs, 4% suspendus, 1% en attente
    $statusRand = rand(1, 100);
    if ($statusRand <= 80) $statusKey = 'active';
    elseif ($statusRand <= 95) $statusKey = 'inactive';
    elseif ($statusRand <= 99) $statusKey = 'suspended';
    else $statusKey = 'pending';
    
    $joinedDaysAgo = rand(1, 365);
    $joinedTime = $currentTime - ($joinedDaysAgo * 24 * 3600);
    
    $lastActiveHours = rand(1, 168); // Dernière activité dans les 7 derniers jours
    $lastActiveTime = $currentTime - ($lastActiveHours * 3600);
    
    $userId = 'USR' . str_pad($id + 1001, 4, '0', STR_PAD_LEFT);
    $email = strtolower($firstName . '.' . substr($lastName, 0, 4)) . '@' . strtolower($university['code']) . '.ac.cd';
    
    $faculty = null;
    $studentId = null;
    if ($userTypeKey === 'student') {
        $faculty = $faculties[array_rand($faculties)];
        $studentId = date('Y', $joinedTime) . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }
    
    return [
        'id' => $userId,
        'name' => $firstName . ' ' . $lastName,
        'email' => $email,
        'phone' => '+243 ' . rand(80, 99) . rand(100, 999) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
        'university' => $university,
        'faculty' => $faculty,
        'student_id' => $studentId,
        'type' => $userTypeKey,
        'status' => $statusKey,
        'joined_at' => $joinedTime,
        'last_active' => $lastActiveTime,
        'orders_count' => rand(0, 45),
        'total_spent' => rand(0, 250000),
        'rating' => rand(40, 50) / 10, // 4.0 à 5.0
        'verified' => rand(0, 100) > 15 // 85% vérifiés
    ];
}

// Génération de 30 utilisateurs réalistes
$users = [];
for ($i = 0; $i < 30; $i++) {
    $users[] = generateUser($i);
}

// Tri par dernière activité (plus récent en premier)
usort($users, function($a, $b) {
    return $b['last_active'] - $a['last_active'];
});

// Calcul des statistiques
$totalUsers = count($users) + rand(8500, 9500);
$activeUsers = array_filter($users, fn($u) => $u['status'] === 'active');
$newUsersToday = rand(15, 35);
$onlineUsers = rand(250, 450);
$verifiedUsers = array_filter($users, fn($u) => $u['verified']);

// Stats par type
$studentCount = count(array_filter($users, fn($u) => $u['type'] === 'student'));
$agentCount = count(array_filter($users, fn($u) => $u['type'] === 'agent'));
$restaurantCount = count(array_filter($users, fn($u) => $u['type'] === 'restaurant'));
$adminCount = count(array_filter($users, fn($u) => $u['type'] === 'admin'));
?>

<div class="page-header">
  <h2 class="page-title">👥 Gestion des Utilisateurs</h2>
  <p class="page-subtitle">
    Base utilisateurs KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      <?= $onlineUsers ?> en ligne
    </span> • 
    <span style="color: var(--accent); font-weight: 600;">
      +<?= $newUsersToday ?> aujourd'hui
    </span> • 
    Dernière sync: <span style="color: var(--primary);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Filtres et actions avancés -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
    <button onclick="filterUsers('all')" id="filter-all" class="filter-btn active-filter" style="background: var(--primary); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Tous (<?= number_format($totalUsers) ?>)
    </button>
    <button onclick="filterUsers('student')" id="filter-student" class="filter-btn" style="background: var(--primary); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      🎓 Étudiants (<?= number_format($studentCount + 7890) ?>)
    </button>
    <button onclick="filterUsers('agent')" id="filter-agent" class="filter-btn" style="background: var(--success); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      🚚 Livreurs (<?= $agentCount + 47 ?>)
    </button>
    <button onclick="filterUsers('restaurant')" id="filter-restaurant" class="filter-btn" style="background: var(--warning); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      🍽️ Restaurants (<?= $restaurantCount + 28 ?>)
    </button>
    <button onclick="filterUsers('active')" id="filter-active" class="filter-btn" style="background: var(--success); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      ✅ Actifs (<?= count($activeUsers) + rand(7500, 8200) ?>)
    </button>
    <button onclick="filterUsers('verified')" id="filter-verified" class="filter-btn" style="background: var(--accent); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      ✓ Vérifiés (<?= count($verifiedUsers) + rand(6800, 7500) ?>)
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <input type="text" placeholder="🔍 Rechercher utilisateur..." onkeyup="searchUsers(this.value)" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); min-width: 250px; font-size: 0.9rem;">
    <select onchange="filterByUniversity(this.value)" style="padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.9rem;">
      <option value="">Toutes universités</option>
      <?php foreach($universities as $uni): ?>
        <option value="<?= $uni['code'] ?>"><?= $uni['code'] ?> (<?= number_format($uni['students']) ?>)</option>
      <?php endforeach; ?>
    </select>
    <button onclick="exportUsers()" style="background: linear-gradient(135deg, var(--accent), #0891b2); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📊 Exporter
    </button>
    <button onclick="addNewUser()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      ➕ Nouveau
    </button>
    <button onclick="refreshUsers()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Statistiques temps réel des utilisateurs -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">👥</div>
    <div class="stat-value" id="total-users-stat"><?= number_format($totalUsers) ?></div>
    <div class="stat-label">Utilisateurs Totaux</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= $newUsersToday ?> aujourd'hui</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🟢</div>
    <div class="stat-value" id="online-users-stat"><?= $onlineUsers ?></div>
    <div class="stat-label">Utilisateurs En Ligne</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= round(($onlineUsers/$totalUsers)*100, 1) ?>% du total</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-value" id="growth-stat">+<?= rand(15, 35) ?>%</div>
    <div class="stat-label">Croissance Mensuelle</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Tendance positive</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">✓</div>
    <div class="stat-value" id="verified-stat"><?= round((count($verifiedUsers)/$totalUsers)*100, 1) ?>%</div>
    <div class="stat-label">Taux Vérification</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= count($verifiedUsers) + rand(6800, 7500) ?> vérifiés</span>
    </div>
  </div>
</div>

<!-- Répartition par universités -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
      🏫 Répartition par Campus
      <span style="background: var(--success); color: white; padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">LIVE</span>
    </h3>
    <div style="display: grid; gap: 1rem;">
      <?php foreach($universities as $uni): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 4px solid <?= $uni['color'] ?>;">
          <div>
            <div style="font-weight: 700; color: var(--text-primary); font-size: 1.1rem;"><?= $uni['code'] ?></div>
            <div style="color: var(--text-muted); font-size: 0.9rem;"><?= $uni['name'] ?></div>
          </div>
          <div style="text-align: right;">
            <div style="font-weight: 700; color: <?= $uni['color'] ?>; font-size: 1.2rem;"><?= number_format($uni['students']) ?></div>
            <div style="color: var(--text-muted); font-size: 0.8rem;">étudiants actifs</div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">📊 Types d'Utilisateurs</h3>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
      <div style="text-align: center; padding: 1rem; background: rgba(99,102,241,0.1); border-radius: 8px; border-left: 4px solid var(--primary);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-bottom: 0.25rem;"><?= number_format($studentCount + 7890) ?></div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">🎓 Étudiants</div>
        <div style="color: var(--primary); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;"><?= round((($studentCount + 7890)/$totalUsers)*100, 1) ?>% du total</div>
      </div>
      
      <div style="text-align: center; padding: 1rem; background: rgba(16,185,129,0.1); border-radius: 8px; border-left: 4px solid var(--success);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--success); margin-bottom: 0.25rem;"><?= $agentCount + 47 ?></div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">🚚 Livreurs</div>
        <div style="color: var(--success); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;"><?= rand(85, 95) ?>% actifs</div>
      </div>
      
      <div style="text-align: center; padding: 1rem; background: rgba(245,158,11,0.1); border-radius: 8px; border-left: 4px solid var(--warning);">
        <div style="font-size: 2rem; font-weight: 900; color: var(--warning); margin-bottom: 0.25rem;"><?= $restaurantCount + 28 ?></div>
        <div style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">🍽️ Restaurants</div>
        <div style="color: var(--warning); font-size: 0.8rem; margin-top: 0.25rem; font-weight: 600;">Partenaires certifiés</div>
      </div>
    </div>
  </div>
</div>

<!-- Liste des utilisateurs -->
<div class="stat-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
      <h3 style="margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
        👤 Utilisateurs Récents
        <span style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; animation: pulse 2s infinite;">
          TEMPS RÉEL
        </span>
      </h3>
      <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">
        Affichage de <?= count($users) ?> utilisateurs • Mis à jour en continu
      </div>
    </div>
    <div style="display: flex; gap: 0.5rem; align-items: center;">
      <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--success); font-size: 0.85rem;">
        <div class="realtime-dot"></div>
        <span><?= $onlineUsers ?> en ligne maintenant</span>
      </div>
    </div>
  </div>
  
  <div style="overflow-x: auto; border-radius: 12px; border: 1px solid var(--border);">
    <table style="width: 100%; border-collapse: collapse; background: var(--glass-bg);">
      <thead>
        <tr style="background: rgba(255,255,255,0.05);">
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Utilisateur</th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Contact</th>
          <th style="text-align: left; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Campus</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Type</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Statut</th>
          <th style="text-align: right; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Activité</th>
          <th style="text-align: center; padding: 1rem 0.75rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid var(--border);">Actions</th>
        </tr>
      </thead>
      <tbody id="users-table-body">
        <?php foreach($users as $user): ?>
          <tr class="user-row" data-type="<?= $user['type'] ?>" data-status="<?= $user['status'] ?>" data-university="<?= $user['university']['code'] ?>" data-user-id="<?= $user['id'] ?>"
              style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; cursor: pointer;"
              onmouseenter="this.style.background='rgba(255,255,255,0.05)'" 
              onmouseleave="this.style.background='transparent'"
              onclick="showUserDetails('<?= $user['id'] ?>')">
            
            <td style="padding: 1rem 0.75rem;">
              <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="position: relative;">
                  <div style="width: 45px; height: 45px; border-radius: 50%; background: linear-gradient(135deg, <?= $userTypes[$user['type']]['color'] ?>, var(--accent)); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 1rem;">
                    <?= strtoupper(substr($user['name'], 0, 2)) ?>
                  </div>
                  <?php if ($user['verified']): ?>
                    <div style="position: absolute; bottom: -2px; right: -2px; background: var(--success); border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; border: 2px solid var(--bg-primary);">
                      <span style="font-size: 0.6rem; color: white;">✓</span>
                    </div>
                  <?php endif; ?>
                  <?php if (rand(0, 100) < 15): // 15% en ligne ?>
                    <div style="position: absolute; top: -2px; right: -2px; background: var(--success); border-radius: 50%; width: 12px; height: 12px; border: 2px solid var(--bg-primary); animation: pulse 2s infinite;"></div>
                  <?php endif; ?>
                </div>
                <div>
                  <div style="color: var(--text-primary); font-weight: 700; font-size: 1rem;"><?= $user['name'] ?></div>
                  <div style="color: var(--text-muted); font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem;">
                    <?= $userTypes[$user['type']]['icon'] ?> <?= $user['id'] ?>
                    <?php if ($user['student_id']): ?>
                      • ID: <?= $user['student_id'] ?>
                    <?php endif; ?>
                  </div>
                  <?php if ($user['faculty']): ?>
                    <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.25rem;"><?= $user['faculty'] ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <div>
                <div style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0.25rem;"><?= $user['email'] ?></div>
                <div style="color: var(--text-muted); font-size: 0.85rem;"><?= $user['phone'] ?></div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem;">
              <span style="background: <?= $user['university']['color'] ?>; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 700; display: inline-block;">
                <?= $user['university']['code'] ?>
              </span>
              <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.25rem; max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <?= $user['university']['name'] ?>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <span style="
                background: <?= $userTypes[$user['type']]['color'] ?>; 
                color: white; 
                padding: 0.35rem 0.75rem; 
                border-radius: 999px; 
                font-size: 0.8rem; 
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
              ">
                <?= $userTypes[$user['type']]['icon'] ?>
                <?= $userTypes[$user['type']]['label'] ?>
              </span>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <span style="
                background: <?= $userStatuses[$user['status']]['color'] ?>; 
                color: white; 
                padding: 0.35rem 0.75rem; 
                border-radius: 999px; 
                font-size: 0.8rem; 
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
              ">
                <?= $userStatuses[$user['status']]['icon'] ?>
                <?= $userStatuses[$user['status']]['label'] ?>
              </span>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: right;">
              <div style="display: flex; flex-direction: column; align-items: end; gap: 0.25rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem; font-weight: 600;">
                  <?php 
                  $hoursAgo = floor((time() - $user['last_active']) / 3600);
                  if ($hoursAgo < 1) echo 'Maintenant';
                  elseif ($hoursAgo < 24) echo 'Il y a ' . $hoursAgo . 'h';
                  else echo 'Il y a ' . floor($hoursAgo / 24) . 'j';
                  ?>
                </div>
                <div style="color: var(--text-muted); font-size: 0.8rem;">
                  <?= $user['orders_count'] ?> commandes
                </div>
                <div style="color: var(--success); font-size: 0.8rem; font-weight: 600;">
                  <?= number_format($user['total_spent']) ?> FC
                </div>
              </div>
            </td>
            
            <td style="padding: 1rem 0.75rem; text-align: center;">
              <div style="display: flex; justify-content: center; gap: 0.5rem;">
                <button onclick="event.stopPropagation(); showUserDetails('<?= $user['id'] ?>')" title="Voir profil" style="background: none; border: none; color: var(--primary); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  👁️
                </button>
                <button onclick="event.stopPropagation(); editUser('<?= $user['id'] ?>')" title="Modifier" style="background: none; border: none; color: var(--warning); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  ✏️
                </button>
                <?php if ($user['status'] !== 'suspended'): ?>
                  <button onclick="event.stopPropagation(); suspendUser('<?= $user['id'] ?>')" title="Suspendre" style="background: none; border: none; color: var(--error); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                    ⛔
                  </button>
                <?php else: ?>
                  <button onclick="event.stopPropagation(); activateUser('<?= $user['id'] ?>')" title="Réactiver" style="background: none; border: none; color: var(--success); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                    ✅
                  </button>
                <?php endif; ?>
                <button onclick="event.stopPropagation(); messageUser('<?= $user['id'] ?>')" title="Message" style="background: none; border: none; color: var(--accent); cursor: pointer; font-size: 1.2rem; padding: 0.25rem; border-radius: 4px; transition: all 0.2s ease;">
                  💬
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
// Filtrage des utilisateurs
function filterUsers(type) {
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.classList.remove('active-filter');
  });
  document.getElementById('filter-' + type).classList.add('active-filter');
  
  const rows = document.querySelectorAll('.user-row');
  rows.forEach((row, index) => {
    row.style.transition = 'all 0.5s ease';
    
    setTimeout(() => {
      let show = false;
      if (type === 'all') show = true;
      else if (type === 'active') show = row.dataset.status === 'active';
      else if (type === 'verified') show = row.querySelector('.user-row td:first-child .fa-check') !== null;
      else show = row.dataset.type === type;
      
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
  
  const filterLabels = {
    'all': 'Tous les utilisateurs',
    'student': 'Étudiants uniquement',
    'agent': 'Livreurs uniquement', 
    'restaurant': 'Restaurants uniquement',
    'active': 'Utilisateurs actifs',
    'verified': 'Utilisateurs vérifiés'
  };
  
  showToast(`Filtrage: ${filterLabels[type]}`, 'info');
}

// Recherche utilisateurs
function searchUsers(query) {
  const rows = document.querySelectorAll('.user-row');
  const normalizedQuery = query.toLowerCase().trim();
  
  rows.forEach(row => {
    const userId = row.dataset.userId.toLowerCase();
    const userName = row.querySelector('td:first-child').textContent.toLowerCase();
    const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
    
    const matches = userId.includes(normalizedQuery) || 
                   userName.includes(normalizedQuery) || 
                   userEmail.includes(normalizedQuery);
    
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
  const rows = document.querySelectorAll('.user-row');
  
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

// Actions utilisateurs
function showUserDetails(userId) {
  showToast(`Chargement profil utilisateur ${userId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Profil ${userId} ouvert`, 'success');
  }, 1000);
}

function editUser(userId) {
  showToast(`Modification utilisateur ${userId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Formulaire de modification ouvert`, 'success');
  }, 800);
}

function suspendUser(userId) {
  if (confirm(`⚠️ Suspendre l'utilisateur ${userId} ?\n\nL'utilisateur ne pourra plus passer de commandes.`)) {
    showToast(`Suspension utilisateur ${userId}...`, 'warning');
    
    setTimeout(() => {
      showToast(`Utilisateur ${userId} suspendu`, 'success');
      
      const row = document.querySelector(`[data-user-id="${userId}"]`);
      if (row) {
        const statusCell = row.querySelector('td:nth-child(5)');
        statusCell.innerHTML = `
          <span style="background: var(--error); color: white; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
            ⛔ Suspendu
          </span>
        `;
        row.dataset.status = 'suspended';
      }
    }, 1500);
  }
}

function activateUser(userId) {
  showToast(`Réactivation utilisateur ${userId}...`, 'info');
  
  setTimeout(() => {
    showToast(`Utilisateur ${userId} réactivé`, 'success');
    
    const row = document.querySelector(`[data-user-id="${userId}"]`);
    if (row) {
      const statusCell = row.querySelector('td:nth-child(5)');
      statusCell.innerHTML = `
        <span style="background: var(--success); color: white; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
          ✅ Actif
        </span>
      `;
      row.dataset.status = 'active';
    }
  }, 1200);
}

function messageUser(userId) {
  showToast(`Ouverture messagerie pour ${userId}`, 'info');
  
  setTimeout(() => {
    showToast(`💬 Message envoyé à ${userId}`, 'success');
  }, 1000);
}

function addNewUser() {
  showToast('Ouverture formulaire nouveau utilisateur...', 'info');
  
  setTimeout(() => {
    showToast('📝 Formulaire d\'inscription ouvert', 'success');
  }, 800);
}

function exportUsers() {
  showToast('Génération export utilisateurs...', 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 20;
    showToast(`Export en cours: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast('📊 Export utilisateurs téléchargé', 'success');
    }
  }, 400);
}

function refreshUsers() {
  showToast('Synchronisation base utilisateurs...', 'info');
  
  const tableBody = document.getElementById('users-table-body');
  tableBody.style.opacity = '0.5';
  
  setTimeout(() => {
    tableBody.style.opacity = '1';
    showToast('✅ Base utilisateurs synchronisée', 'success');
    
    updateUserStats();
  }, 2500);
}

// Mise à jour temps réel des stats
function updateUserStats() {
  const totalElement = document.getElementById('total-users-stat');
  if (totalElement) {
    const current = parseInt(totalElement.textContent.replace(/,/g, ''));
    totalElement.textContent = new Intl.NumberFormat().format(current + Math.floor(Math.random() * 5));
  }
  
  const onlineElement = document.getElementById('online-users-stat');
  if (onlineElement) {
    const change = Math.floor(Math.random() * 20) - 10;
    const current = parseInt(onlineElement.textContent);
    const newValue = Math.max(200, Math.min(500, current + change));
    onlineElement.textContent = newValue;
  }
}

// Auto-refresh toutes les 30 secondes
setInterval(() => {
  updateUserStats();
  
  if (Math.random() > 0.7) {
    showToast('👋 Nouvel utilisateur inscrit!', 'success');
  }
}, 30000);
</script>