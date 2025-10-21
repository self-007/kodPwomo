<?php
// Configuration et paramètres système KodPwomo
$currentTime = time();

// Configuration actuelle (simulation)
$systemConfig = [
    'app_name' => 'KodPwomo',
    'app_version' => '2.1.4',
    'timezone' => 'Africa/Kinshasa',
    'currency' => 'FC',
    'language' => 'fr',
    'maintenance_mode' => false,
    'debug_mode' => false,
    'api_rate_limit' => 1000,
    'max_file_size' => '10MB',
    'session_timeout' => 3600
];

// Paramètres de livraison
$deliveryConfig = [
    'default_delivery_time' => 25,
    'max_delivery_radius' => 15,
    'delivery_fee_base' => 2000,
    'delivery_fee_per_km' => 500,
    'free_delivery_threshold' => 25000,
    'working_hours_start' => '07:00',
    'working_hours_end' => '22:00',
    'weekend_surcharge' => 1000
];

// Paramètres de notification
$notificationConfig = [
    'email_notifications' => true,
    'sms_notifications' => true,
    'push_notifications' => true,
    'order_confirmation' => true,
    'delivery_updates' => true,
    'promotional_emails' => false,
    'low_stock_alerts' => true,
    'daily_reports' => true
];

// Paramètres de sécurité
$securityConfig = [
    'two_factor_auth' => true,
    'password_min_length' => 8,
    'session_encryption' => true,
    'login_attempts_max' => 5,
    'account_lockout_duration' => 15,
    'password_expiry_days' => 90,
    'ip_whitelist_enabled' => false,
    'audit_logging' => true
];

// Métriques système temps réel
$systemMetrics = [
    'uptime' => '99.7%',
    'response_time' => rand(45, 120) . 'ms',
    'cpu_usage' => rand(15, 35) . '%',
    'memory_usage' => rand(60, 85) . '%',
    'disk_usage' => rand(40, 70) . '%',
    'active_connections' => rand(450, 850),
    'api_calls_today' => rand(15000, 25000),
    'error_rate' => round(rand(1, 8) / 10, 1) . '%'
];
?>

<div class="page-header">
  <h2 class="page-title">⚙️ Paramètres Système</h2>
  <p class="page-subtitle">
    Configuration KodPwomo - 
    <span style="color: var(--success); font-weight: 600;">
      Système opérationnel
    </span> • 
    <span style="color: var(--accent); font-weight: 600;">
      Uptime: <?= $systemMetrics['uptime'] ?>
    </span> • 
    Dernière sync: <span style="color: var(--primary);"><?= date('H:i:s') ?></span>
  </p>
</div>

<!-- Navigation des paramètres -->
<div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
  <button onclick="showSettingsTab('general')" id="tab-general" class="settings-tab active-tab" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s ease;">
    🏢 Général
  </button>
  <button onclick="showSettingsTab('delivery')" id="tab-delivery" class="settings-tab" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s ease;">
    🚚 Livraison
  </button>
  <button onclick="showSettingsTab('notifications')" id="tab-notifications" class="settings-tab" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s ease;">
    🔔 Notifications
  </button>
  <button onclick="showSettingsTab('security')" id="tab-security" class="settings-tab" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s ease;">
    🔐 Sécurité
  </button>
  <button onclick="showSettingsTab('system')" id="tab-system" class="settings-tab" style="background: var(--glass-bg); border: 1px solid var(--border); color: var(--text-primary); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s ease;">
    💻 Système
  </button>
</div>

<!-- Métriques système -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">⚡</div>
    <div class="stat-value" id="uptime-stat"><?= $systemMetrics['uptime'] ?></div>
    <div class="stat-label">Uptime Système</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Stable</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🚀</div>
    <div class="stat-value" id="response-stat"><?= $systemMetrics['response_time'] ?></div>
    <div class="stat-label">Temps Réponse</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Optimal</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🔗</div>
    <div class="stat-value" id="connections-stat"><?= number_format($systemMetrics['active_connections']) ?></div>
    <div class="stat-label">Connexions Actives</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Normal</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">📊</div>
    <div class="stat-value" id="api-calls-stat"><?= number_format($systemMetrics['api_calls_today']) ?></div>
    <div class="stat-label">Appels API Aujourd'hui</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>+<?= rand(150, 300) ?>/min</span>
    </div>
  </div>
</div>

<!-- Onglet Paramètres Généraux -->
<div id="settings-general" class="settings-content">
  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <div class="stat-card">
      <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🏢 Configuration Générale</h3>
      
      <form onsubmit="saveGeneralSettings(event)" style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div>
            <label style="display: block; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem;">Nom de l'application</label>
            <input type="text" value="<?= $systemConfig['app_name'] ?>" style="width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary);">
          </div>
          <div>
            <label style="display: block; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem;">Version</label>
            <input type="text" value="<?= $systemConfig['app_version'] ?>" readonly style="width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: rgba(255,255,255,0.03); color: var(--text-muted);">
          </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div>
            <label style="display: block; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem;">Fuseau Horaire</label>
            <select style="width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary);">
              <option selected>Africa/Kinshasa</option>
              <option>Africa/Lubumbashi</option>
              <option>UTC</option>
            </select>
          </div>
          <div>
            <label style="display: block; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem;">Devise</label>
            <select style="width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary);">
              <option selected>FC (Franc Congolais)</option>
              <option>USD (Dollar US)</option>
              <option>EUR (Euro)</option>
            </select>
          </div>
        </div>
        
        <div>
          <label style="display: block; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem;">Langue par défaut</label>
          <select style="width: 100%; padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: var(--glass-bg); color: var(--text-primary);">
            <option selected>Français</option>
            <option>Anglais</option>
            <option>Lingala</option>
            <option>Swahili</option>
          </select>
        </div>
        
        <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
          <input type="checkbox" id="maintenance-mode" <?= $systemConfig['maintenance_mode'] ? 'checked' : '' ?> style="width: 18px; height: 18px;">
          <label for="maintenance-mode" style="color: var(--text-primary); font-weight: 600;">Mode Maintenance</label>
          <span style="color: var(--text-muted); font-size: 0.85rem; margin-left: auto;">Désactive temporairement l'application</span>
        </div>
        
        <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
          <input type="checkbox" id="debug-mode" <?= $systemConfig['debug_mode'] ? 'checked' : '' ?> style="width: 18px; height: 18px;">
          <label for="debug-mode" style="color: var(--text-primary); font-weight: 600;">Mode Debug</label>
          <span style="color: var(--text-muted); font-size: 0.85rem; margin-left: auto;">Affiche les erreurs détaillées</span>
        </div>
        
        <button type="submit" style="background: var(--success); border: none; color: white; padding: 1rem 2rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">
          💾 Sauvegarder
        </button>
      </form>
    </div>
    
    <div style="display: flex; flex-direction: column; gap: 1rem;">
      <div class="stat-card">
        <h3 style="margin-bottom: 1rem; color: var(--text-primary);">📈 Utilisation Ressources</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
          <div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
              <span style="color: var(--text-secondary);">CPU</span>
              <span style="color: var(--primary); font-weight: 700;"><?= $systemMetrics['cpu_usage'] ?></span>
            </div>
            <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
              <div style="height: 100%; width: <?= intval($systemMetrics['cpu_usage']) ?>%; background: var(--primary); border-radius: 4px;"></div>
            </div>
          </div>
          
          <div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
              <span style="color: var(--text-secondary);">Mémoire</span>
              <span style="color: var(--accent); font-weight: 700;"><?= $systemMetrics['memory_usage'] ?></span>
            </div>
            <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
              <div style="height: 100%; width: <?= intval($systemMetrics['memory_usage']) ?>%; background: var(--accent); border-radius: 4px;"></div>
            </div>
          </div>
          
          <div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
              <span style="color: var(--text-secondary);">Disque</span>
              <span style="color: var(--warning); font-weight: 700;"><?= $systemMetrics['disk_usage'] ?></span>
            </div>
            <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
              <div style="height: 100%; width: <?= intval($systemMetrics['disk_usage']) ?>%; background: var(--warning); border-radius: 4px;"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="stat-card">
        <h3 style="margin-bottom: 1rem; color: var(--text-primary);">🔧 Actions Système</h3>
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
          <button onclick="clearCache()" style="background: var(--accent); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%;">
            🗑️ Vider Cache
          </button>
          <button onclick="restartServices()" style="background: var(--warning); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%;">
            🔄 Redémarrer Services
          </button>
          <button onclick="backupDatabase()" style="background: var(--success); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%;">
            💾 Backup DB
          </button>
          <button onclick="exportLogs()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%;">
            📄 Export Logs
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Autres onglets (masqués par défaut) -->
<div id="settings-delivery" class="settings-content" style="display: none;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🚚 Configuration Livraison</h3>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Paramètres relatifs aux livraisons et frais de transport.</p>
    
    <!-- Contenu configuration livraison -->
    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
      <div style="font-size: 4rem; margin-bottom: 1rem;">🚧</div>
      <div style="font-size: 1.2rem; font-weight: 600;">Configuration Livraison</div>
      <div style="margin-top: 0.5rem;">Fonctionnalité en cours de développement</div>
    </div>
  </div>
</div>

<div id="settings-notifications" class="settings-content" style="display: none;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🔔 Configuration Notifications</h3>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Gestion des notifications emails, SMS et push.</p>
    
    <!-- Contenu configuration notifications -->
    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
      <div style="font-size: 4rem; margin-bottom: 1rem;">🚧</div>
      <div style="font-size: 1.2rem; font-weight: 600;">Configuration Notifications</div>
      <div style="margin-top: 0.5rem;">Fonctionnalité en cours de développement</div>
    </div>
  </div>
</div>

<div id="settings-security" class="settings-content" style="display: none;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🔐 Configuration Sécurité</h3>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Paramètres de sécurité et contrôle d'accès.</p>
    
    <!-- Contenu configuration sécurité -->
    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
      <div style="font-size: 4rem; margin-bottom: 1rem;">🚧</div>
      <div style="font-size: 1.2rem; font-weight: 600;">Configuration Sécurité</div>
      <div style="margin-top: 0.5rem;">Fonctionnalité en cours de développement</div>
    </div>
  </div>
</div>

<div id="settings-system" class="settings-content" style="display: none;">
  <div class="stat-card">
    <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">💻 Informations Système</h3>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Détails techniques et monitoring serveur.</p>
    
    <!-- Contenu informations système -->
    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
      <div style="font-size: 4rem; margin-bottom: 1rem;">🚧</div>
      <div style="font-size: 1.2rem; font-weight: 600;">Informations Système</div>
      <div style="margin-top: 0.5rem;">Fonctionnalité en cours de développement</div>
    </div>
  </div>
</div>

<style>
.settings-tab {
  transition: all 0.2s ease;
  opacity: 0.7;
}

.settings-tab:hover {
  opacity: 1;
  transform: translateY(-1px);
}

.active-tab {
  opacity: 1;
  box-shadow: 0 4px 12px rgba(99,102,241,0.3);
}

.settings-content {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
// Navigation entre onglets
function showSettingsTab(tabName) {
  // Masquer tous les contenus
  document.querySelectorAll('.settings-content').forEach(content => {
    content.style.display = 'none';
  });
  
  // Désactiver tous les onglets
  document.querySelectorAll('.settings-tab').forEach(tab => {
    tab.classList.remove('active-tab');
    tab.style.background = 'var(--glass-bg)';
    tab.style.color = 'var(--text-primary)';
    tab.style.border = '1px solid var(--border)';
  });
  
  // Activer l'onglet sélectionné
  const activeTab = document.getElementById('tab-' + tabName);
  activeTab.classList.add('active-tab');
  activeTab.style.background = 'var(--primary)';
  activeTab.style.color = 'white';
  activeTab.style.border = '1px solid var(--primary)';
  
  // Afficher le contenu correspondant
  document.getElementById('settings-' + tabName).style.display = 'block';
  
  showToast(`Paramètres: ${tabName}`, 'info');
}

// Sauvegarde paramètres généraux
function saveGeneralSettings(event) {
  event.preventDefault();
  showToast('Sauvegarde des paramètres...', 'info');
  
  setTimeout(() => {
    showToast('✅ Paramètres sauvegardés avec succès', 'success');
  }, 1500);
}

// Actions système
function clearCache() {
  showToast('Vidage du cache en cours...', 'info');
  
  setTimeout(() => {
    showToast('🗑️ Cache vidé avec succès', 'success');
  }, 2000);
}

function restartServices() {
  if (confirm('⚠️ Redémarrer les services ?\n\nCela peut interrompre temporairement le service.')) {
    showToast('Redémarrage des services...', 'warning');
    
    setTimeout(() => {
      showToast('🔄 Services redémarrés avec succès', 'success');
    }, 3000);
  }
}

function backupDatabase() {
  showToast('Création backup base de données...', 'info');
  
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += 20;
    showToast(`Backup: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(progressInterval);
      showToast('💾 Backup créé avec succès', 'success');
    }
  }, 500);
}

function exportLogs() {
  showToast('Export des logs système...', 'info');
  
  setTimeout(() => {
    showToast('📄 Logs exportés avec succès', 'success');
  }, 1200);
}

// Mise à jour temps réel des métriques
function updateSystemMetrics() {
  const uptimeElement = document.getElementById('uptime-stat');
  const responseElement = document.getElementById('response-stat');
  const connectionsElement = document.getElementById('connections-stat');
  const apiCallsElement = document.getElementById('api-calls-stat');
  
  if (responseElement) {
    const newResponse = Math.floor(Math.random() * 50) + 50; // 50-100ms
    responseElement.textContent = newResponse + 'ms';
  }
  
  if (connectionsElement) {
    const current = parseInt(connectionsElement.textContent.replace(/,/g, ''));
    const change = Math.floor(Math.random() * 20) - 10; // -10 à +10
    const newValue = Math.max(400, Math.min(900, current + change));
    connectionsElement.textContent = new Intl.NumberFormat().format(newValue);
  }
  
  if (apiCallsElement) {
    const current = parseInt(apiCallsElement.textContent.replace(/,/g, ''));
    const increase = Math.floor(Math.random() * 50) + 10; // +10 à +60
    apiCallsElement.textContent = new Intl.NumberFormat().format(current + increase);
  }
}

// Auto-refresh métriques toutes les 15 secondes
setInterval(() => {
  updateSystemMetrics();
}, 15000);
</script>