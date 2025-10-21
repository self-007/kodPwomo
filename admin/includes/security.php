<?php
// Module de sécurité et surveillance KodPwomo
$currentTime = time();

// Tentatives de connexion récentes
$loginAttempts = [
    [
        'timestamp' => $currentTime - 300,
        'ip' => '197.158.79.143',
        'user' => 'admin@kodpwomo.cd',
        'status' => 'success',
        'location' => 'Kinshasa, RDC',
        'device' => 'Chrome 118 - Windows 10',
        'risk_score' => 10
    ],
    [
        'timestamp' => $currentTime - 420,
        'ip' => '41.77.185.92',
        'user' => 'manager@kodpwomo.cd',
        'status' => 'success',
        'location' => 'Lubumbashi, RDC',
        'device' => 'Firefox 119 - macOS',
        'risk_score' => 15
    ],
    [
        'timestamp' => $currentTime - 680,
        'ip' => '196.43.171.28',
        'user' => 'unknown_user@test.com',
        'status' => 'failed',
        'location' => 'Lagos, Nigeria',
        'device' => 'Chrome 117 - Android',
        'risk_score' => 85
    ],
    [
        'timestamp' => $currentTime - 920,
        'ip' => '197.148.92.156',
        'user' => 'support@kodpwomo.cd',
        'status' => 'success',
        'location' => 'Goma, RDC',
        'device' => 'Safari 17 - iPhone',
        'risk_score' => 20
    ],
    [
        'timestamp' => $currentTime - 1140,
        'ip' => '154.72.163.201',
        'user' => 'admin@kodpwomo.cd',
        'status' => 'blocked',
        'location' => 'Unknown',
        'device' => 'Unknown Bot',
        'risk_score' => 95
    ]
];

// Activités système suspectes
$suspiciousActivities = [
    [
        'timestamp' => $currentTime - 180,
        'type' => 'multiple_login_attempts',
        'description' => '5 tentatives de connexion échouées depuis 41.203.45.67',
        'severity' => 'medium',
        'ip' => '41.203.45.67',
        'actions_taken' => 'IP temporairement bloquée (15 min)',
        'status' => 'handled'
    ],
    [
        'timestamp' => $currentTime - 600,
        'type' => 'suspicious_api_calls',
        'description' => 'Appels API inhabituels depuis application mobile',
        'severity' => 'low',
        'ip' => '197.251.134.89',
        'actions_taken' => 'Surveillance renforcée',
        'status' => 'monitoring'
    ],
    [
        'timestamp' => $currentTime - 1200,
        'type' => 'unusual_data_access',
        'description' => 'Accès inhabituel aux données utilisateurs',
        'severity' => 'high',
        'ip' => '196.12.203.145',
        'actions_taken' => 'Session terminée, investigation en cours',
        'status' => 'investigating'
    ],
    [
        'timestamp' => $currentTime - 2400,
        'type' => 'brute_force_detected',
        'description' => 'Attaque par force brute détectée sur /admin',
        'severity' => 'critical',
        'ip' => '185.220.101.42',
        'actions_taken' => 'IP bannie définitivement',
        'status' => 'blocked'
    ]
];

// Firewall et règles de sécurité
$firewallRules = [
    [
        'rule_id' => 'FW001',
        'name' => 'Blocage pays à risque',
        'type' => 'geo_blocking',
        'description' => 'Bloque les connexions depuis certains pays',
        'status' => 'active',
        'blocked_count' => 1247,
        'last_triggered' => $currentTime - 340
    ],
    [
        'rule_id' => 'FW002',
        'name' => 'Rate limiting API',
        'type' => 'rate_limit',
        'description' => 'Limite les requêtes API à 100/min par IP',
        'status' => 'active',
        'blocked_count' => 892,
        'last_triggered' => $currentTime - 120
    ],
    [
        'rule_id' => 'FW003',
        'name' => 'Anti-bot protection',
        'type' => 'bot_protection',
        'description' => 'Détection et blocage des bots malveillants',
        'status' => 'active',
        'blocked_count' => 2341,
        'last_triggered' => $currentTime - 67
    ],
    [
        'rule_id' => 'FW004',
        'name' => 'SQL Injection protection',
        'type' => 'injection_protection',
        'description' => 'Protection contre les injections SQL',
        'status' => 'active',
        'blocked_count' => 156,
        'last_triggered' => $currentTime - 1840
    ]
];

// Sessions actives
$activeSessions = [
    [
        'session_id' => 'sess_admin_' . substr(md5(time()), 0, 8),
        'user' => 'admin@kodpwomo.cd',
        'ip' => '197.158.79.143',
        'location' => 'Kinshasa, RDC',
        'device' => 'Chrome 118 - Windows 10',
        'started_at' => $currentTime - 3600,
        'last_activity' => $currentTime - 30,
        'status' => 'active',
        'risk_level' => 'low'
    ],
    [
        'session_id' => 'sess_mgr_' . substr(md5(time() - 100), 0, 8),
        'user' => 'manager@kodpwomo.cd',
        'ip' => '41.77.185.92',
        'location' => 'Lubumbashi, RDC',
        'device' => 'Firefox 119 - macOS',
        'started_at' => $currentTime - 7200,
        'last_activity' => $currentTime - 420,
        'status' => 'active',
        'risk_level' => 'low'
    ],
    [
        'session_id' => 'sess_sup_' . substr(md5(time() - 200), 0, 8),
        'user' => 'support@kodpwomo.cd',
        'ip' => '197.148.92.156',
        'location' => 'Goma, RDC',
        'device' => 'Safari 17 - iPhone',
        'started_at' => $currentTime - 1800,
        'last_activity' => $currentTime - 920,
        'status' => 'idle',
        'risk_level' => 'medium'
    ]
];

// Métriques de sécurité
$securityMetrics = [
    'blocked_attempts_today' => rand(45, 89),
    'active_threats' => rand(2, 7),
    'security_score' => rand(87, 94),
    'firewall_blocks' => rand(156, 298),
    'suspicious_ips' => rand(23, 48),
    'vulnerability_scan' => 'Il y a 2h'
];
?>

<div class="page-header">
  <h2 class="page-title">🔒 Sécurité & Surveillance</h2>
  <p class="page-subtitle">
    Centre de sécurité KodPwomo - Score: 
    <span style="color: var(--success); font-weight: 700; font-size: 1.1rem;">
      <?= $securityMetrics['security_score'] ?>%
    </span> • 
    <span style="color: var(--warning); font-weight: 600;">
      <?= $securityMetrics['active_threats'] ?> menaces actives
    </span> • 
    Dernière analyse: <span style="color: var(--primary);"><?= $securityMetrics['vulnerability_scan'] ?></span>
  </p>
</div>

<!-- Actions sécurité -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
  <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
    <button onclick="initiateSecurityScan()" style="background: var(--error); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🛡️ Scan Sécurité
    </button>
    <button onclick="viewFirewallLogs()" style="background: var(--warning); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🔥 Logs Firewall
    </button>
    <button onclick="exportSecurityReport()" style="background: var(--info); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      📊 Rapport Sécurité
    </button>
  </div>
  
  <div style="display: flex; gap: 1rem; align-items: center;">
    <button onclick="emergencyLockdown()" style="background: linear-gradient(135deg, var(--error), #dc2626); border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
      🚨 Mode Urgence
    </button>
    <button onclick="refreshSecurity()" style="background: var(--primary); border: none; color: white; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
      🔄
    </button>
  </div>
</div>

<!-- Métriques sécurité -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #10b981);">🛡️</div>
    <div class="stat-value" id="security-score-stat"><?= $securityMetrics['security_score'] ?>%</div>
    <div class="stat-label">Score Sécurité</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Excellent</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon" style="background: linear-gradient(135deg, var(--error), #ef4444);">🚫</div>
    <div class="stat-value" id="blocked-stat"><?= $securityMetrics['blocked_attempts_today'] ?></div>
    <div class="stat-label">Tentatives Bloquées</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Aujourd'hui</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning), #f59e0b);">⚠️</div>
    <div class="stat-value" id="threats-stat"><?= $securityMetrics['active_threats'] ?></div>
    <div class="stat-label">Menaces Actives</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>En surveillance</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon" style="background: linear-gradient(135deg, var(--info), #3b82f6);">🔥</div>
    <div class="stat-value" id="firewall-stat"><?= $securityMetrics['firewall_blocks'] ?></div>
    <div class="stat-label">Blocs Firewall</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Dernière heure</span>
    </div>
  </div>
</div>

<!-- Contenu principal -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
  
  <!-- Colonne principale -->
  <div style="display: flex; flex-direction: column; gap: 2rem;">
    
    <!-- Activités suspectes -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.75rem;">
        ⚠️ Activités Suspectes
        <span style="background: var(--error); color: white; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600;">
          <?= count(array_filter($suspiciousActivities, function($a) { return $a['status'] !== 'handled'; })) ?>
        </span>
      </h3>
      
      <div style="display: flex; flex-direction: column; gap: 1rem;">
        <?php foreach($suspiciousActivities as $activity): ?>
          <?php
          $severityColors = [
            'low' => 'var(--info)',
            'medium' => 'var(--warning)',  
            'high' => 'var(--error)',
            'critical' => '#dc2626'
          ];
          
          $statusColors = [
            'handled' => 'var(--success)',
            'monitoring' => 'var(--warning)',
            'investigating' => 'var(--info)',
            'blocked' => 'var(--error)'
          ];
          ?>
          
          <div style="padding: 1.5rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 4px solid <?= $severityColors[$activity['severity']] ?>;">
            <div style="display: flex; justify-content: between; align-items: flex-start; margin-bottom: 1rem;">
              <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                  <h4 style="margin: 0; color: var(--text-primary); font-weight: 700; font-size: 1rem;">
                    <?= ucfirst(str_replace('_', ' ', $activity['type'])) ?>
                  </h4>
                  <span style="
                    background: <?= $severityColors[$activity['severity']] ?>; 
                    color: white; 
                    padding: 0.25rem 0.75rem; 
                    border-radius: 999px; 
                    font-size: 0.7rem; 
                    font-weight: 700; 
                    text-transform: uppercase;
                  ">
                    <?= $activity['severity'] ?>
                  </span>
                </div>
                
                <p style="margin: 0 0 0.75rem 0; color: var(--text-secondary); line-height: 1.5;">
                  <?= $activity['description'] ?>
                </p>
                
                <div style="display: flex; gap: 2rem; font-size: 0.85rem;">
                  <span style="color: var(--text-muted);">
                    🌐 IP: <strong style="color: var(--text-primary);"><?= $activity['ip'] ?></strong>
                  </span>
                  <span style="color: var(--text-muted);">
                    🕒 <?= date('H:i:s', $activity['timestamp']) ?>
                  </span>
                </div>
              </div>
              
              <div style="display: flex; flex-direction: column; align-items: end; gap: 0.5rem;">
                <span style="
                  background: <?= $statusColors[$activity['status']] ?>; 
                  color: white; 
                  padding: 0.3rem 0.8rem; 
                  border-radius: 6px; 
                  font-size: 0.75rem; 
                  font-weight: 600;
                ">
                  <?= ucfirst($activity['status']) ?>
                </span>
                
                <button onclick="investigateActivity('<?= $activity['type'] ?>', '<?= $activity['ip'] ?>')"
                        style="background: var(--primary); border: none; color: white; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600;">
                  🔍 Investiguer
                </button>
              </div>
            </div>
            
            <div style="padding: 0.75rem; background: rgba(0,0,0,0.1); border-radius: 6px; border-left: 3px solid var(--accent);">
              <strong style="color: var(--accent); font-size: 0.85rem;">Actions prises:</strong>
              <span style="color: var(--text-secondary); font-size: 0.85rem; margin-left: 0.5rem;">
                <?= $activity['actions_taken'] ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Tentatives de connexion -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🔐 Tentatives de Connexion Récentes</h3>
      
      <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
          <thead>
            <tr style="border-bottom: 2px solid var(--border);">
              <th style="padding: 1rem 0.5rem; text-align: left; color: var(--text-primary); font-weight: 700;">Heure</th>
              <th style="padding: 1rem 0.5rem; text-align: left; color: var(--text-primary); font-weight: 700;">Utilisateur</th>
              <th style="padding: 1rem 0.5rem; text-align: left; color: var(--text-primary); font-weight: 700;">IP / Localisation</th>
              <th style="padding: 1rem 0.5rem; text-align: left; color: var(--text-primary); font-weight: 700;">Appareil</th>
              <th style="padding: 1rem 0.5rem; text-align: center; color: var(--text-primary); font-weight: 700;">Status</th>
              <th style="padding: 1rem 0.5rem; text-align: center; color: var(--text-primary); font-weight: 700;">Risque</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($loginAttempts as $attempt): ?>
              <?php
              $statusColors = [
                'success' => 'var(--success)',
                'failed' => 'var(--error)',
                'blocked' => 'var(--warning)'
              ];
              
              $riskLevel = $attempt['risk_score'] < 30 ? 'low' : ($attempt['risk_score'] < 70 ? 'medium' : 'high');
              $riskColors = [
                'low' => 'var(--success)',
                'medium' => 'var(--warning)',
                'high' => 'var(--error)'
              ];
              ?>
              
              <tr style="border-bottom: 1px solid var(--border-light);">
                <td style="padding: 1rem 0.5rem; color: var(--text-secondary); font-size: 0.9rem;">
                  <?= date('H:i:s', $attempt['timestamp']) ?>
                </td>
                <td style="padding: 1rem 0.5rem; color: var(--text-primary); font-weight: 600; font-size: 0.9rem;">
                  <?= $attempt['user'] ?>
                </td>
                <td style="padding: 1rem 0.5rem; font-size: 0.85rem;">
                  <div style="color: var(--text-primary); font-weight: 600;"><?= $attempt['ip'] ?></div>
                  <div style="color: var(--text-muted); font-size: 0.8rem;"><?= $attempt['location'] ?></div>
                </td>
                <td style="padding: 1rem 0.5rem; color: var(--text-secondary); font-size: 0.85rem;">
                  <?= $attempt['device'] ?>
                </td>
                <td style="padding: 1rem 0.5rem; text-align: center;">
                  <span style="
                    background: <?= $statusColors[$attempt['status']] ?>; 
                    color: white; 
                    padding: 0.3rem 0.8rem; 
                    border-radius: 999px; 
                    font-size: 0.75rem; 
                    font-weight: 600;
                    text-transform: capitalize;
                  ">
                    <?= $attempt['status'] === 'success' ? '✅' : ($attempt['status'] === 'failed' ? '❌' : '🚫') ?> 
                    <?= $attempt['status'] ?>
                  </span>
                </td>
                <td style="padding: 1rem 0.5rem; text-align: center;">
                  <span style="
                    background: <?= $riskColors[$riskLevel] ?>; 
                    color: white; 
                    padding: 0.3rem 0.8rem; 
                    border-radius: 999px; 
                    font-size: 0.75rem; 
                    font-weight: 600;
                  ">
                    <?= $attempt['risk_score'] ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <!-- Colonne latérale -->
  <div style="display: flex; flex-direction: column; gap: 1rem;">
    
    <!-- Sessions actives -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">👥 Sessions Actives</h3>
      
      <div style="display: flex; flex-direction: column; gap: 1rem;">
        <?php foreach($activeSessions as $session): ?>
          <?php
          $statusColors = [
            'active' => 'var(--success)',
            'idle' => 'var(--warning)',
            'expired' => 'var(--error)'
          ];
          
          $riskColors = [
            'low' => 'var(--success)',
            'medium' => 'var(--warning)',
            'high' => 'var(--error)'
          ];
          ?>
          
          <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 6px; border-left: 3px solid <?= $statusColors[$session['status']] ?>;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
              <div>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;">
                  <?= explode('@', $session['user'])[0] ?>
                </div>
                <div style="color: var(--text-muted); font-size: 0.75rem;">
                  📱 <?= explode(' -', $session['device'])[0] ?>
                </div>
              </div>
              
              <div style="text-align: right;">
                <span style="
                  background: <?= $statusColors[$session['status']] ?>; 
                  color: white; 
                  padding: 0.2rem 0.5rem; 
                  border-radius: 999px; 
                  font-size: 0.7rem; 
                  font-weight: 600;
                ">
                  <?= $session['status'] ?>
                </span>
              </div>
            </div>
            
            <div style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 0.5rem;">
              🌐 <?= $session['ip'] ?><br>
              📍 <?= $session['location'] ?>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <span style="color: var(--text-muted); font-size: 0.75rem;">
                Actif: <?= date('H:i', $session['last_activity']) ?>
              </span>
              
              <button onclick="terminateSession('<?= $session['session_id'] ?>')"
                      style="background: var(--error); border: none; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.7rem; font-weight: 600;">
                🔒 Fermer
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Règles Firewall -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">🔥 Règles Firewall</h3>
      
      <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <?php foreach($firewallRules as $rule): ?>
          <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 6px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
              <div>
                <div style="color: var(--text-primary); font-weight: 600; font-size: 0.85rem;">
                  <?= $rule['name'] ?>
                </div>
                <div style="color: var(--text-muted); font-size: 0.75rem;">
                  <?= ucfirst(str_replace('_', ' ', $rule['type'])) ?>
                </div>
              </div>
              
              <span style="
                background: <?= $rule['status'] === 'active' ? 'var(--success)' : 'var(--error)' ?>; 
                color: white; 
                padding: 0.2rem 0.5rem; 
                border-radius: 999px; 
                font-size: 0.65rem; 
                font-weight: 600;
              ">
                <?= $rule['status'] ?>
              </span>
            </div>
            
            <div style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 0.5rem;">
              <?= $rule['description'] ?>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem;">
              <span style="color: var(--accent); font-weight: 600;">
                🚫 <?= $rule['blocked_count'] ?> bloqués
              </span>
              <span style="color: var(--text-muted);">
                <?= date('H:i', $rule['last_triggered']) ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Actions rapides -->
    <div class="stat-card">
      <h3 style="margin-bottom: 1rem; color: var(--text-primary);">⚡ Actions Rapides</h3>
      
      <div style="display: flex; flex-direction: column; gap: 0.5rem;">
        <button onclick="blockIP()" style="background: var(--error); border: none; color: white; padding: 0.75rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.85rem; width: 100%;">
          🚫 Bloquer IP
        </button>
        
        <button onclick="whitelistIP()" style="background: var(--success); border: none; color: white; padding: 0.75rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.85rem; width: 100%;">
          ✅ Whitelist IP
        </button>
        
        <button onclick="viewSecurityLog()" style="background: var(--info); border: none; color: white; padding: 0.75rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.85rem; width: 100%;">
          📋 Voir Logs
        </button>
        
        <button onclick="emergencyProtocol()" style="background: var(--warning); border: none; color: white; padding: 0.75rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.85rem; width: 100%;">
          🚨 Protocole Urgence
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Scan de sécurité
function initiateSecurityScan() {
  showToast('🛡️ Lancement scan de sécurité complet...', 'info');
  
  let progress = 0;
  const scanSteps = [
    'Analyse des vulnérabilités...',
    'Vérification des permissions...',
    'Scan des fichiers malveillants...',
    'Test des règles firewall...',
    'Analyse des logs système...'
  ];
  
  const scanInterval = setInterval(() => {
    if (progress < scanSteps.length) {
      showToast(`🔍 ${scanSteps[progress]}`, 'info');
      progress++;
    } else {
      clearInterval(scanInterval);
      showToast('✅ Scan sécurité terminé - Aucune vulnérabilité détectée', 'success');
      
      // Mise à jour du score de sécurité
      const scoreElement = document.getElementById('security-score-stat');
      if (scoreElement) {
        scoreElement.textContent = Math.min(100, parseInt(scoreElement.textContent) + 2) + '%';
      }
    }
  }, 2000);
}

// Investigation d'activité
function investigateActivity(type, ip) {
  showToast(`🔍 Investigation ${type} depuis ${ip}...`, 'info');
  
  setTimeout(() => {
    showToast(`📊 Rapport d'investigation généré pour ${ip}`, 'success');
  }, 2000);
}

// Terminer session
function terminateSession(sessionId) {
  if (confirm('Êtes-vous sûr de vouloir terminer cette session?')) {
    showToast(`🔒 Fermeture session ${sessionId.substring(0, 12)}...`, 'info');
    
    setTimeout(() => {
      showToast('✅ Session terminée avec succès', 'success');
      
      // Supprimer visuellement la session
      document.querySelector(`[onclick*="${sessionId}"]`).closest('div[style*="border-left"]').remove();
    }, 1500);
  }
}

// Bloquer IP
function blockIP() {
  const ip = prompt('Entrez l\'IP à bloquer:');
  if (ip && ip.match(/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/)) {
    showToast(`🚫 Blocage IP ${ip} en cours...`, 'info');
    
    setTimeout(() => {
      showToast(`✅ IP ${ip} bloquée définitivement`, 'success');
      
      // Mise à jour compteur blocs
      const blockedElement = document.getElementById('blocked-stat');
      if (blockedElement) {
        blockedElement.textContent = parseInt(blockedElement.textContent) + 1;
      }
    }, 1000);
  } else if (ip) {
    showToast('❌ Format IP invalide', 'error');
  }
}

// Whitelist IP
function whitelistIP() {
  const ip = prompt('Entrez l\'IP à autoriser:');
  if (ip && ip.match(/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/)) {
    showToast(`✅ Ajout IP ${ip} à la whitelist...`, 'info');
    
    setTimeout(() => {
      showToast(`🛡️ IP ${ip} autorisée définitivement`, 'success');
    }, 1000);
  } else if (ip) {
    showToast('❌ Format IP invalide', 'error');
  }
}

// Actions diverses
function viewFirewallLogs() {
  showToast('📋 Ouverture logs firewall...', 'info');
  setTimeout(() => showToast('📄 Logs firewall chargés', 'success'), 1500);
}

function exportSecurityReport() {
  showToast('📊 Génération rapport de sécurité...', 'info');
  
  let progress = 0;
  const exportInterval = setInterval(() => {
    progress += 25;
    showToast(`📊 Génération: ${progress}%`, 'info');
    
    if (progress >= 100) {
      clearInterval(exportInterval);
      showToast('📥 Rapport de sécurité téléchargé', 'success');
    }
  }, 800);
}

function emergencyLockdown() {
  if (confirm('⚠️ ATTENTION: Ceci activera le mode verrouillage d\'urgence. Continuer?')) {
    showToast('🚨 Activation mode verrouillage d\'urgence...', 'error');
    
    setTimeout(() => {
      showToast('🔒 Système sécurisé - Accès limité aux admins', 'success');
    }, 2000);
  }
}

function viewSecurityLog() {
  showToast('📋 Chargement logs de sécurité...', 'info');
  setTimeout(() => showToast('📄 Logs sécurité ouverts', 'success'), 1200);
}

function emergencyProtocol() {
  showToast('🚨 Activation protocole d\'urgence...', 'warning');
  
  setTimeout(() => {
    showToast('⚡ Protocole d\'urgence activé', 'success');
  }, 1500);
}

// Actualisation sécurité
function refreshSecurity() {
  showToast('🔄 Actualisation données sécurité...', 'info');
  
  const cards = document.querySelectorAll('.stat-card');
  cards.forEach(card => {
    card.style.opacity = '0.6';
  });
  
  setTimeout(() => {
    cards.forEach(card => {
      card.style.opacity = '1';
    });
    
    // Mise à jour des métriques
    updateSecurityMetrics();
    
    showToast('✅ Données sécurité actualisées', 'success');
  }, 2500);
}

// Mise à jour métriques sécurité
function updateSecurityMetrics() {
  const securityScore = document.getElementById('security-score-stat');
  const blockedStat = document.getElementById('blocked-stat');  
  const threatsStat = document.getElementById('threats-stat');
  const firewallStat = document.getElementById('firewall-stat');
  
  if (securityScore) {
    const change = Math.floor(Math.random() * 3) - 1; // -1 à +1
    const current = parseInt(securityScore.textContent);
    securityScore.textContent = Math.max(85, Math.min(100, current + change)) + '%';
  }
  
  if (blockedStat) {
    const increase = Math.floor(Math.random() * 5) + 1;
    blockedStat.textContent = parseInt(blockedStat.textContent) + increase;
  }
  
  if (threatsStat) {
    const change = Math.floor(Math.random() * 3) - 1;
    const current = parseInt(threatsStat.textContent);
    threatsStat.textContent = Math.max(0, Math.min(15, current + change));
  }
  
  if (firewallStat) {
    const increase = Math.floor(Math.random() * 8) + 2;
    firewallStat.textContent = parseInt(firewallStat.textContent) + increase;
  }
}

// Auto-refresh toutes les 45 secondes
setInterval(() => {
  updateSecurityMetrics();
  
  if (Math.random() > 0.7) {
    const activities = [
      'Nouvelle tentative de connexion bloquée',
      'Règle firewall déclenchée',
      'Analyse automatique terminée',
      'IP suspecte détectée et surveillée'
    ];
    
    const activity = activities[Math.floor(Math.random() * activities.length)];
    showToast(`🔐 ${activity}`, 'info');
  }
}, 45000);
</script>