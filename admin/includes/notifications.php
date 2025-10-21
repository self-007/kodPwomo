<?php
// Système de notifications temps réel KodPwomo
$currentTime = time();

// Types de notifications
$notificationTypes = [
    'order' => ['label' => 'Commande', 'color' => 'var(--primary)', 'icon' => '📦'],
    'user' => ['label' => 'Utilisateur', 'color' => 'var(--accent)', 'icon' => '👤'],
    'system' => ['label' => 'Système', 'color' => 'var(--warning)', 'icon' => '⚙️'],
    'delivery' => ['label' => 'Livraison', 'color' => 'var(--success)', 'icon' => '🚚'],
    'payment' => ['label' => 'Paiement', 'color' => 'var(--info)', 'icon' => '💳'],
    'alert' => ['label' => 'Alerte', 'color' => 'var(--error)', 'icon' => '🚨'],
    'promo' => ['label' => 'Promotion', 'color' => 'var(--accent)', 'icon' => '🎉']
];

// Priorités
$priorities = [
    'low' => ['label' => 'Faible', 'color' => 'var(--info)', 'icon' => '🔵'],
    'normal' => ['label' => 'Normal', 'color' => 'var(--accent)', 'icon' => '🟡'],
    'high' => ['label' => 'Haute', 'color' => 'var(--warning)', 'icon' => '🟠'],
    'urgent' => ['label' => 'Urgente', 'color' => 'var(--error)', 'icon' => '🔴']
];

// Génération de notifications réalistes
function generateNotifications() {
    global $notificationTypes, $priorities, $currentTime;
    
    $notifications = [];
    $messages = [
        // Notifications commandes
        ['type' => 'order', 'priority' => 'normal', 'title' => 'Nouvelle commande reçue', 'message' => 'Commande KP251008045 de Jean Mukadi (UNIKIN) - 25,000 FC'],
        ['type' => 'order', 'priority' => 'high', 'title' => 'Commande en retard', 'message' => 'Commande KP251008032 dépasse le délai prévu de 15 minutes'],
        ['type' => 'order', 'priority' => 'normal', 'title' => 'Commande livrée', 'message' => 'Commande KP251008028 livrée avec succès à UNILU'],
        ['type' => 'order', 'priority' => 'urgent', 'title' => 'Problème livraison', 'message' => 'Client introuvable pour commande KP251008038 - Action requise'],
        
        // Notifications utilisateurs
        ['type' => 'user', 'priority' => 'low', 'title' => 'Nouvel utilisateur', 'message' => 'Sarah Kalala s\'est inscrite depuis UNIKAT'],
        ['type' => 'user', 'priority' => 'normal', 'title' => 'Compte vérifié', 'message' => 'Daniel Mwamba a vérifié son compte avec succès'],
        ['type' => 'user', 'priority' => 'high', 'title' => 'Compte suspendu', 'message' => 'Suspension automatique du compte USR2847 (activité suspecte)'],
        
        // Notifications système
        ['type' => 'system', 'priority' => 'normal', 'title' => 'Sauvegarde complétée', 'message' => 'Backup automatique de la base de données terminé'],
        ['type' => 'system', 'priority' => 'high', 'title' => 'Utilisation CPU élevée', 'message' => 'CPU à 87% - Surveillance recommandée'],
        ['type' => 'system', 'priority' => 'urgent', 'title' => 'Erreur API externe', 'message' => 'Service de paiement Mobile Money indisponible'],
        ['type' => 'system', 'priority' => 'low', 'title' => 'Mise à jour disponible', 'message' => 'KodPwomo v2.1.5 disponible au téléchargement'],
        
        // Notifications livraison
        ['type' => 'delivery', 'priority' => 'normal', 'title' => 'Agent connecté', 'message' => 'Livreur AGT004 est maintenant en ligne'],
        ['type' => 'delivery', 'priority' => 'high', 'title' => 'Zone surchargée', 'message' => 'UNIKIN: 15 commandes en attente, temps d\'attente prolongé'],
        ['type' => 'delivery', 'priority' => 'urgent', 'title' => 'Agent indisponible', 'message' => 'AGT002 ne répond pas - 3 commandes affectées'],
        
        // Notifications paiement
        ['type' => 'payment', 'priority' => 'normal', 'title' => 'Paiement reçu', 'message' => 'Paiement Mobile Money de 18,000 FC confirmé'],
        ['type' => 'payment', 'priority' => 'high', 'title' => 'Paiement échoué', 'message' => 'Échec paiement commande KP251008041 - Fonds insuffisants'],
        ['type' => 'payment', 'priority' => 'urgent', 'title' => 'Transaction suspecte', 'message' => 'Transaction de 150,000 FC nécessite validation manuelle'],
        
        // Alertes
        ['type' => 'alert', 'priority' => 'urgent', 'title' => 'Stock critique', 'message' => 'Pizza Margherita: plus que 3 unités en stock'],
        ['type' => 'alert', 'priority' => 'high', 'title' => 'Pic de commandes', 'message' => '45 commandes en 10 minutes - Capacité limite atteinte'],
        ['type' => 'alert', 'priority' => 'urgent', 'title' => 'Panne électrique', 'message' => 'Coupure d\'électricité signalée à UNILU - Impact livraisons'],
        
        // Promotions
        ['type' => 'promo', 'priority' => 'low', 'title' => 'Promo activée', 'message' => 'Promotion "Happy Hour" lancée avec succès'],
        ['type' => 'promo', 'priority' => 'normal', 'title' => 'Promo expirée', 'message' => 'Code promo STUDENT20 a expiré - 127 utilisations']
    ];
    
    // Génération de 35 notifications avec timestamps réalistes
    for ($i = 0; $i < 35; $i++) {
        $message = $messages[array_rand($messages)];
        $timeAgo = rand(1, 4320); // 1 minute à 3 jours
        
        $notifications[] = [
            'id' => 'NOTIF' . str_pad($i + 1001, 4, '0', STR_PAD_LEFT),
            'type' => $message['type'],
            'priority' => $message['priority'],
            'title' => $message['title'],
            'message' => $message['message'],
            'timestamp' => $currentTime - ($timeAgo * 60),
            'time_ago' => $timeAgo,
            'read' => rand(0, 100) > 30, // 70% lues
            'action_required' => $message['priority'] === 'urgent' || ($message['priority'] === 'high' && rand(0, 100) > 50)
        ];
    }
    
    // Tri par timestamp (plus récent en premier)
    usort($notifications, function($a, $b) {
        return $b['timestamp'] - $a['timestamp'];
    });
    
    return $notifications;
}

$notifications = generateNotifications();

// Statistiques notifications
$totalNotifications = count($notifications);
$unreadNotifications = array_filter($notifications, fn($n) => !$n['read']);
$urgentNotifications = array_filter($notifications, fn($n) => $n['priority'] === 'urgent');
$actionRequiredNotifications = array_filter($notifications, fn($n) => $n['action_required']);

// Stats par type
$notificationsByType = [];
foreach ($notificationTypes as $typeKey => $typeInfo) {
    $typeNotifications = array_filter($notifications, fn($n) => $n['type'] === $typeKey);
    $notificationsByType[$typeKey] = [
        'info' => $typeInfo,
        'count' => count($typeNotifications),
        'unread' => count(array_filter($typeNotifications, fn($n) => !$n['read']))
    ];
}

// Activités système récentes
$recentActivity = [
    ['time' => 'Il y a 2 min', 'action' => 'Backup automatique complété', 'status' => 'success'],
    ['time' => 'Il y a 8 min', 'action' => 'Nouveau livreur AGT007 ajouté', 'status' => 'info'],
    ['time' => 'Il y a 15 min', 'action' => 'Alerte stock Pizza Pepperoni', 'status' => 'warning'],
    ['time' => 'Il y a 23 min', 'action' => 'Mise à jour sécurité appliquée', 'status' => 'success'],
    ['time' => 'Il y a 35 min', 'action' => 'Pic de trafic détecté (UNIKIN)', 'status' => 'info']
];
?>

<div class="page-header">
  <h2 class="page-title">🔔 Centre de Notifications</h2>
  <p class="page-subtitle">
    Notifications système KodPwomo - 
    <span style="color: var(--error); font-weight: 600;">
      <?= count($unreadNotifications) ?> non lues
    </span> • 
    <span style="color: var(--warning); font-weight: 600;">
      <?= count($urgentNotifications) ?> urgentes
    </span> • 
    Temps réel: <span style="color: var(--success);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Actions et filtres -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
    <button onclick="filterNotifications('all')" id="filter-all" class="filter-btn active-filter" style="background: var(--primary); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Toutes (<?= $totalNotifications ?>)
    </button>
    <button onclick="filterNotifications('unread')" id="filter-unread" class="filter-btn" style="background: var(--error); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      Non lues (<?= count($unreadNotifications) ?>)
    </button>
    <button onclick="filterNotifications('urgent')" id="filter-urgent" class="filter-btn" style="background: var(--error); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      🔴 Urgentes (<?= count($urgentNotifications) ?>)
    </button>
    <button onclick="filterNotifications('action')" id="filter-action" class="filter-btn" style="background: var(--warning); border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
      ⚡ Action requise (<?= count($actionRequiredNotifications) ?>)
    </button>
    
    <?php foreach(array_slice($notificationsByType, 0, 4) as $typeKey => $typeData): ?>
      <button onclick="filterNotifications('<?= $typeKey ?>')" id="filter-<?= $typeKey ?>" class="filter-btn" style="background: <?= $typeData['info']['color'] ?>; border: none; color: white; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.2s ease;">
        <?= $typeData['info']['icon'] ?> <?= $typeData['info']['label'] ?> (<?= $typeData['count'] ?>)
      </button>
    <?php endforeach; ?>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <button onclick="markAllAsRead()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      ✅ Tout marquer lu
    </button>
    <button onclick="clearOldNotifications()" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🗑️ Nettoyer anciennes
    </button>
    <button onclick="exportNotifications()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📊 Exporter
    </button>
    <button onclick="refreshNotifications()" style="background: var(--warning); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Statistiques notifications -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">📬</div>
    <div class="stat-value" id="total-notif-stat"><?= $totalNotifications ?></div>
    <div class="stat-label">Total Notifications</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Dernières 72h</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🔴</div>
    <div class="stat-value" id="unread-stat"><?= count($unreadNotifications) ?></div>
    <div class="stat-label">Non Lues</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span><?= round((count($unreadNotifications)/$totalNotifications)*100, 1) ?>% du total</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">⚡</div>
    <div class="stat-value" id="urgent-stat"><?= count($urgentNotifications) ?></div>
    <div class="stat-label">Urgentes</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Action immédiate</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-value" id="rate-stat">+<?= rand(15, 35) ?>%</div>
    <div class="stat-label">Évolution (24h)</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>vs hier</span>
    </div>
  </div>
</div>

<!-- Contenu principal -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
  
  <!-- Liste des notifications -->
  <div class="stat-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <div>
        <h3 style="margin: 0; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
          📋 Flux Notifications
          <span style="background: var(--success); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600; animation: pulse 2s infinite;">
            TEMPS RÉEL
          </span>
        </h3>
        <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">
          Dernières notifications • Auto-refresh 10s
        </div>
      </div>
      <div style="display: flex; gap: 0.5rem; align-items: center;">
        <select onchange="sortNotifications(this.value)" style="padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary); font-size: 0.85rem;">
          <option value="recent">Plus récentes</option>
          <option value="priority">Par priorité</option>
          <option value="type">Par type</option>
          <option value="unread">Non lues d'abord</option>
        </select>
      </div>
    </div>
    
    <div style="max-height: 600px; overflow-y: auto; border-radius: 8px;">
      <div id="notifications-list">
        <?php foreach($notifications as $notification): ?>
          <div class="notification-item" 
               data-type="<?= $notification['type'] ?>" 
               data-priority="<?= $notification['priority'] ?>" 
               data-read="<?= $notification['read'] ? 'true' : 'false' ?>"
               data-action="<?= $notification['action_required'] ? 'true' : 'false' ?>"
               data-notification-id="<?= $notification['id'] ?>"
               style="
                 display: flex; 
                 align-items: flex-start; 
                 gap: 1rem; 
                 padding: 1rem; 
                 margin-bottom: 0.5rem; 
                 background: <?= $notification['read'] ? 'rgba(255,255,255,0.02)' : 'rgba(99,102,241,0.1)' ?>; 
                 border-radius: 8px; 
                 border-left: 4px solid <?= $priorities[$notification['priority']]['color'] ?>; 
                 cursor: pointer; 
                 transition: all 0.2s ease;
                 <?= $notification['read'] ? '' : 'border: 1px solid rgba(99,102,241,0.3);' ?>
               "
               onclick="markAsRead('<?= $notification['id'] ?>')"
               onmouseenter="this.style.background='rgba(255,255,255,0.05)'" 
               onmouseleave="this.style.background='<?= $notification['read'] ? 'rgba(255,255,255,0.02)' : 'rgba(99,102,241,0.1)' ?>'">
            
            <!-- Icône type + priorité -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.25rem; flex-shrink: 0;">
              <div style="font-size: 1.5rem;"><?= $notificationTypes[$notification['type']]['icon'] ?></div>
              <div style="font-size: 0.8rem;"><?= $priorities[$notification['priority']]['icon'] ?></div>
            </div>
            
            <!-- Contenu notification -->
            <div style="flex: 1; min-width: 0;">
              <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                <h4 style="margin: 0; color: var(--text-primary); font-weight: 700; font-size: 0.95rem; line-height: 1.3;">
                  <?= $notification['title'] ?>
                  <?php if (!$notification['read']): ?>
                    <span style="background: var(--primary); color: white; padding: 0.15rem 0.4rem; border-radius: 999px; font-size: 0.7rem; margin-left: 0.5rem;">NOUVEAU</span>
                  <?php endif; ?>
                  <?php if ($notification['action_required']): ?>
                    <span style="background: var(--error); color: white; padding: 0.15rem 0.4rem; border-radius: 999px; font-size: 0.7rem; margin-left: 0.5rem; animation: pulse 2s infinite;">ACTION</span>
                  <?php endif; ?>
                </h4>
                <div style="display: flex; flex-direction: column; align-items: end; gap: 0.25rem; flex-shrink: 0; margin-left: 1rem;">
                  <span style="color: var(--text-muted); font-size: 0.8rem; font-weight: 600;">
                    <?php 
                    if ($notification['time_ago'] < 60) {
                      echo 'Il y a ' . $notification['time_ago'] . ' min';
                    } elseif ($notification['time_ago'] < 1440) {
                      echo 'Il y a ' . round($notification['time_ago'] / 60) . 'h';
                    } else {
                      echo 'Il y a ' . round($notification['time_ago'] / 1440) . 'j';
                    }
                    ?>
                  </span>
                  <span style="
                    background: <?= $priorities[$notification['priority']]['color'] ?>; 
                    color: white; 
                    padding: 0.2rem 0.5rem; 
                    border-radius: 999px; 
                    font-size: 0.7rem; 
                    font-weight: 600;
                  ">
                    <?= $priorities[$notification['priority']]['label'] ?>
                  </span>
                </div>
              </div>
              
              <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4;">
                <?= $notification['message'] ?>
              </p>
              
              <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.75rem;">
                <span style="
                  background: <?= $notificationTypes[$notification['type']]['color'] ?>; 
                  color: white; 
                  padding: 0.25rem 0.6rem; 
                  border-radius: 999px; 
                  font-size: 0.75rem; 
                  font-weight: 600;
                  display: inline-flex;
                  align-items: center;
                  gap: 0.25rem;
                ">
                  <?= $notificationTypes[$notification['type']]['icon'] ?>
                  <?= $notificationTypes[$notification['type']]['label'] ?>
                </span>
                
                <div style="display: flex; gap: 0.5rem;">
                  <?php if ($notification['action_required']): ?>
                    <button onclick="event.stopPropagation(); takeAction('<?= $notification['id'] ?>')" style="background: var(--warning); border: none; color: white; padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 600;">
                      ⚡ Agir
                    </button>
                  <?php endif; ?>
                  <button onclick="event.stopPropagation(); archiveNotification('<?= $notification['id'] ?>')" style="background: var(--accent); border: none; color: white; padding: 0.4rem 0.8rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 600;">
                    📁 Archiver
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  
  <!-- Panneau latéral -->
  <div style="display: flex; flex-direction: column; gap: 1rem;">
    
    <!-- Notifications par type -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">📊 Répartition par Type</h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <?php foreach($notificationsByType as $typeKey => $typeData): ?>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.03); border-radius: 6px; border-left: 3px solid <?= $typeData['info']['color'] ?>;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
              <span style="font-size: 1.2rem;"><?= $typeData['info']['icon'] ?></span>
              <span style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem;"><?= $typeData['info']['label'] ?></span>
            </div>
            <div style="text-align: right;">
              <div style="color: <?= $typeData['info']['color'] ?>; font-weight: 700; font-size: 1rem;"><?= $typeData['count'] ?></div>
              <?php if ($typeData['unread'] > 0): ?>
                <div style="color: var(--error); font-size: 0.75rem; font-weight: 600;"><?= $typeData['unread'] ?> nouvelles</div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Activité système récente -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
        ⚡ Activité Système
        <span style="background: var(--accent); color: white; padding: 0.2rem 0.5rem; border-radius: 999px; font-size: 0.7rem;">LIVE</span>
      </h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <?php foreach($recentActivity as $activity): ?>
          <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 6px;">
            <div style="width: 8px; height: 8px; border-radius: 50%; background: <?= $activity['status'] === 'success' ? 'var(--success)' : ($activity['status'] === 'warning' ? 'var(--warning)' : 'var(--info)') ?>; flex-shrink: 0;"></div>
            <div style="flex: 1; min-width: 0;">
              <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem; margin-bottom: 0.25rem;"><?= $activity['action'] ?></div>
              <div style="color: var(--text-muted); font-size: 0.75rem;"><?= $activity['time'] ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Actions rapides -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">🚀 Actions Rapides</h3>
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <button onclick="createCustomNotification()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%; text-align: left;">
          📝 Créer notification
        </button>
        <button onclick="configureAlerts()" style="background: var(--warning); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%; text-align: left;">
          ⚙️ Configurer alertes
        </button>
        <button onclick="viewAnalytics()" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%; text-align: left;">
          📈 Analytics notifs
        </button>
        <button onclick="manageSubscriptions()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%; text-align: left;">
          🔔 Abonnements
        </button>
      </div>
    </div>
  </div>
</div>

<style>
.filter-btn {
  opacity: 0.8;
  transform: scale(0.95);
}

.filter-btn:hover {
  opacity: 1;
  transform: scale(1.02);
}

.active-filter {
  opacity: 1;
  transform: scale(1);
  box-shadow: 0 4px 12px rgba(99,102,241,0.3);
}

.notification-item {
  position: relative;
}

.notification-item:hover {
  transform: translateX(2px);
}
</style>

<script>
// Filtrage des notifications
function filterNotifications(filter) {
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.classList.remove('active-filter');
  });
  document.getElementById('filter-' + filter).classList.add('active-filter');
  
  const items = document.querySelectorAll('.notification-item');
  items.forEach((item, index) => {
    let show = false;
    
    if (filter === 'all') show = true;
    else if (filter === 'unread') show = item.dataset.read === 'false';
    else if (filter === 'urgent') show = item.dataset.priority === 'urgent';
    else if (filter === 'action') show = item.dataset.action === 'true';
    else show = item.dataset.type === filter;
    
    item.style.transition = 'all 0.3s ease';
    
    if (show) {
      item.style.display = '';
      item.style.opacity = '0';
      item.style.transform = 'translateY(-10px)';
      
      setTimeout(() => {
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
      }, index * 30);
    } else {
      item.style.opacity = '0';
      item.style.transform = 'translateY(10px)';
      setTimeout(() => item.style.display = 'none', 200);
    }
  });
  
  showToast(`Filtrage: ${filter}`, 'info');
}

// Marquer comme lue
function markAsRead(notificationId) {
  const item = document.querySelector(`[data-notification-id="${notificationId}"]`);
  if (item && item.dataset.read === 'false') {
    item.dataset.read = 'true';
    item.style.background = 'rgba(255,255,255,0.02)';
    item.style.border = 'none';
    
    // Supprimer le badge "NOUVEAU"
    const newBadge = item.querySelector('span:contains("NOUVEAU")');
    if (newBadge) newBadge.remove();
    
    showToast(`Notification ${notificationId} marquée comme lue`, 'success');
    
    // Mise à jour du compteur
    updateUnreadCount(-1);
  }
}

// Marquer toutes comme lues
function markAllAsRead() {
  showToast('Marquage de toutes les notifications...', 'info');
  
  const unreadItems = document.querySelectorAll('.notification-item[data-read="false"]');
  let count = 0;
  
  unreadItems.forEach((item, index) => {
    setTimeout(() => {
      markAsRead(item.dataset.notificationId);
      count++;
      
      if (count === unreadItems.length) {
        showToast(`✅ ${count} notifications marquées comme lues`, 'success');
      }
    }, index * 100);
  });
}

// Actions sur notifications
function takeAction(notificationId) {
  showToast(`Action sur notification ${notificationId}...`, 'warning');
  
  setTimeout(() => {
    showToast(`⚡ Action effectuée pour ${notificationId}`, 'success');
    
    const item = document.querySelector(`[data-notification-id="${notificationId}"]`);
    if (item) {
      item.dataset.action = 'false';
      const actionBadge = item.querySelector('span:contains("ACTION")');
      if (actionBadge) actionBadge.remove();
    }
  }, 1500);
}

function archiveNotification(notificationId) {
  showToast(`Archivage notification ${notificationId}...`, 'info');
  
  const item = document.querySelector(`[data-notification-id="${notificationId}"]`);
  if (item) {
    item.style.opacity = '0';
    item.style.transform = 'translateX(100px)';
    
    setTimeout(() => {
      item.remove();
      showToast(`📁 Notification ${notificationId} archivée`, 'success');
    }, 300);
  }
}

function clearOldNotifications() {
  if (confirm('Supprimer les notifications de plus de 7 jours ?')) {
    showToast('Suppression anciennes notifications...', 'info');
    
    setTimeout(() => {
      showToast('🗑️ Anciennes notifications supprimées', 'success');
    }, 1500);
  }
}

function exportNotifications() {
  showToast('Export des notifications...', 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 25;
    showToast(`Export: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast('📊 Export terminé avec succès', 'success');
    }
  }, 400);
}

function refreshNotifications() {
  showToast('Actualisation notifications...', 'info');
  
  const notifList = document.getElementById('notifications-list');
  notifList.style.opacity = '0.5';
  
  setTimeout(() => {
    notifList.style.opacity = '1';
    showToast('✅ Notifications actualisées', 'success');
    
    // Simulation nouvelle notification
    if (Math.random() > 0.5) {
      showToast('🔔 Nouvelle notification reçue', 'success');
      updateUnreadCount(1);
    }
  }, 2000);
}

// Actions rapides
function createCustomNotification() {
  showToast('Ouverture créateur notification...', 'info');
}

function configureAlerts() {
  showToast('Ouverture configuration alertes...', 'info');
}

function viewAnalytics() {
  showToast('Chargement analytics notifications...', 'info');
}

function manageSubscriptions() {
  showToast('Gestion des abonnements...', 'info');
}

// Tri notifications
function sortNotifications(criteria) {
  showToast(`Tri par: ${criteria}`, 'info');
  
  const notifList = document.getElementById('notifications-list');
  notifList.style.opacity = '0.7';
  
  setTimeout(() => {
    notifList.style.opacity = '1';
    showToast('Notifications triées', 'success');
  }, 800);
}

// Mise à jour compteur non lues
function updateUnreadCount(change) {
  const unreadElement = document.getElementById('unread-stat');
  if (unreadElement) {
    const current = parseInt(unreadElement.textContent);
    const newValue = Math.max(0, current + change);
    unreadElement.textContent = newValue;
  }
}

// Simulation nouvelles notifications
function simulateNewNotification() {
  const types = ['order', 'user', 'system', 'delivery', 'payment'];
  const priorities = ['normal', 'high', 'urgent'];
  const messages = [
    'Nouvelle commande reçue',
    'Problème détecté système',
    'Livraison terminée',
    'Paiement confirmé',
    'Alerte stock faible'
  ];
  
  if (Math.random() > 0.7) {
    const type = types[Math.floor(Math.random() * types.length)];
    const priority = priorities[Math.floor(Math.random() * priorities.length)];
    const message = messages[Math.floor(Math.random() * messages.length)];
    
    showToast(`🔔 ${message}`, priority === 'urgent' ? 'error' : 'info');
    updateUnreadCount(1);
  }
}

// Auto-refresh toutes les 30 secondes
setInterval(() => {
  simulateNewNotification();
}, 30000);
</script>