<!-- Module de surveillance système -->
<div class="page-header">
  <h2 class="page-title">🖥️ Surveillance Système</h2>
  <p class="page-subtitle">
    Monitoring en temps réel de KodPwomo - 
    <span style="color: var(--success); font-weight: 600;" id="system-uptime">99.8% uptime</span> • 
    <span style="color: var(--accent); font-weight: 600;" id="monitoring-time"></span>
  </p>
</div>

<!-- Statut système -->
<div class="stats-grid" style="margin-bottom: 2rem;">
  <div class="stat-card">
    <div class="stat-icon">🖥️</div>
    <div class="stat-value" id="cpu-usage">24%</div>
    <div class="stat-label">Utilisation CPU</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Normal</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💾</div>
    <div class="stat-value" id="memory-usage">67%</div>
    <div class="stat-label">Mémoire RAM</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Stable</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">💽</div>
    <div class="stat-value" id="disk-usage">52%</div>
    <div class="stat-label">Espace Disque</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Disponible</span>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon">🌐</div>
    <div class="stat-value" id="network-usage">45%</div>
    <div class="stat-label">Réseau</div>
    <div class="realtime-indicator">
      <div class="realtime-dot"></div>
      <span>Optimal</span>
    </div>
  </div>
</div>

<!-- Services actifs -->
<div class="stat-card">
  <h3 style="margin-bottom: 1.5rem; color: var(--text-primary);">🔧 Services Système</h3>
  
  <div id="services-list" style="display: grid; gap: 1rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
      <div>
        <span style="color: var(--text-primary); font-weight: 600;">API Gateway</span>
        <div style="color: var(--text-muted); font-size: 0.8rem;">Temps réponse: <span id="api-response">156ms</span></div>
      </div>
      <span style="background: var(--success); color: white; padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
        ✅ En ligne
      </span>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
      <div>
        <span style="color: var(--text-primary); font-weight: 600;">Base de données</span>
        <div style="color: var(--text-muted); font-size: 0.8rem;">Connexions: <span id="db-connections">45</span></div>
      </div>
      <span style="background: var(--success); color: white; padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
        ✅ En ligne
      </span>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
      <div>
        <span style="color: var(--text-primary); font-weight: 600;">Système de paiement</span>
        <div style="color: var(--text-muted); font-size: 0.8rem;">Transactions: <span id="payment-transactions">23</span>/h</div>
      </div>
      <span style="background: var(--success); color: white; padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
        ✅ En ligne
      </span>
    </div>
  </div>
</div>

<script>
// Mise à jour temps réel du monitoring
function updateMonitoringData() {
  const now = new Date();
  document.getElementById('monitoring-time').textContent = now.toLocaleTimeString('fr-FR');
  
  // Simulation variations CPU
  const currentCPU = parseInt(document.getElementById('cpu-usage').textContent);
  const newCPU = Math.max(15, Math.min(80, currentCPU + (Math.random() - 0.5) * 10));
  document.getElementById('cpu-usage').textContent = Math.round(newCPU) + '%';
  
  // Simulation mémoire
  const currentMem = parseInt(document.getElementById('memory-usage').textContent);
  const newMem = Math.max(50, Math.min(90, currentMem + (Math.random() - 0.5) * 5));
  document.getElementById('memory-usage').textContent = Math.round(newMem) + '%';
  
  // Simulation réseau
  const currentNet = parseInt(document.getElementById('network-usage').textContent);
  const newNet = Math.max(20, Math.min(95, currentNet + (Math.random() - 0.5) * 15));
  document.getElementById('network-usage').textContent = Math.round(newNet) + '%';
  
  // Temps de réponse API
  const apiResponse = Math.round(120 + Math.random() * 100);
  document.getElementById('api-response').textContent = apiResponse + 'ms';
  
  // Connexions DB
  const dbConn = Math.round(35 + Math.random() * 20);
  document.getElementById('db-connections').textContent = dbConn;
  
  // Transactions paiement
  const paymentTx = Math.round(15 + Math.random() * 15);
  document.getElementById('payment-transactions').textContent = paymentTx;
}

// Démarrer les mises à jour
setInterval(updateMonitoringData, 3000);
updateMonitoringData();
</script>