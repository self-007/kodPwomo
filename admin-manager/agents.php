<?php
// Agents Management Page
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Agents — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FF6B35;
            --primary-dark: #D84315;
            --secondary: #004E89;
            --accent: #00D4FF;
            --success: #1ABC9C;
            --success-dark: #16A085;
            --error: #FF6B35;
            --dark: #1a1a2e;
            --gray: #64748b;
            --light: #f8f9fa;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.5;
        }

        .am-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .am-header {
            margin-bottom: 2.5rem;
        }

        .am-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.5px;
        }

        .am-subtitle {
            font-size: 0.95rem;
            color: var(--gray);
            margin: 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .am-controls {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .am-btn {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .am-btn--primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
        }

        .am-btn--primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 53, 0.35);
        }

        .am-btn--secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .am-btn--secondary:hover {
            background: var(--primary);
            color: white;
        }

        /* Table */
        .am-table-wrap {
            background: var(--white);
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(255, 107, 53, 0.08);
            border: 1px solid rgba(255, 107, 53, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .am-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .am-table thead {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.02), rgba(0, 212, 255, 0.01));
            border-bottom: 2px solid rgba(255, 107, 53, 0.1);
        }

        .am-table th {
            padding: 1rem 1.25rem;
            text-align: left;
            font-weight: 700;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .am-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f0f1f3;
            color: #2d3748;
        }

        .am-table tbody tr {
            transition: background 0.15s ease;
        }

        .am-table tbody tr:hover {
            background: rgba(255, 107, 53, 0.02);
        }

        .am-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badge */
        .am-badge {
            display: inline-block;
            padding: 0.35em 0.85em;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85em;
            letter-spacing: 0.3px;
        }

        .am-badge--online {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            box-shadow: 0 2px 8px rgba(26, 188, 156, 0.2);
        }

        .am-badge--offline {
            background: rgba(100, 116, 139, 0.1);
            color: var(--gray);
        }

        .am-badge--busy {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.2);
        }

        /* Cards for Mobile */
        .am-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(255, 107, 53, 0.08);
            border-left: 5px solid var(--primary);
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }

        .am-card:hover {
            box-shadow: 0 8px 24px rgba(255, 107, 53, 0.12);
            transform: translateY(-2px);
        }

        .am-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .am-card-title {
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1em;
        }

        .am-card-meta {
            font-size: 0.9em;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }

        /* Modal */
        .am-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(26, 26, 46, 0.3);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .am-modal.active {
            display: flex;
        }

        .am-modal-dialog {
            background: var(--white);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 500px;
            width: 95vw;
            box-shadow: 0 16px 48px rgba(255, 107, 53, 0.2);
            border-top: 5px solid var(--primary);
            animation: slideUp 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        @keyframes slideUp {
            from { transform: scale(0.9) translateY(20px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .am-modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(255, 107, 53, 0.1);
            border: none;
            font-size: 1.8rem;
            color: var(--primary);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .am-modal-close:hover {
            background: var(--primary);
            color: white;
            transform: rotate(90deg);
        }

        .am-form-group {
            margin-bottom: 1.5rem;
        }

        .am-label {
            display: block;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .am-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .am-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        /* Toast */
        .am-toast {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            padding: 1em 1.8em;
            border-radius: 10px;
            font-weight: 700;
            z-index: 2000;
            animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            color: white;
        }

        .am-toast--success {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
        }

        .am-toast--error {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        /* Responsive */
        @media (max-width: 768px) {
            .am-container { padding: 1rem; }
            .am-title { font-size: 1.8rem; }
            .am-table-wrap { display: none; }
            .am-modal-dialog { padding: 1.5rem 1rem; }
        }

        .am-skeleton {
            background: linear-gradient(90deg, #f8f9fa 25%, #fff5f0 50%, #f8f9fa 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
            border-radius: 8px;
            height: 1rem;
        }

        @keyframes shimmer {
            0% { background-position: 0%; }
            100% { background-position: 200%; }
        }
    </style>
</head>
<body>
    <div class="am-container">
        <header class="am-header">
            <h1 class="am-title">Gestion des Agents</h1>
            <p class="am-subtitle">Gérez les livreurs et leur statut</p>
            <div class="am-controls">
                <button class="am-btn am-btn--primary" id="addAgentBtn">+ Ajouter un agent</button>
                <button class="am-btn am-btn--secondary" id="refreshBtn">⟲ Actualiser</button>
            </div>
        </header>

        <!-- Table View -->
        <div class="am-table-wrap">
            <table class="am-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Livraisons</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="agentsTableBody">
                    <tr><td colspan="6" class="am-skeleton" style="height: 50px;"></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Cards View (Mobile) -->
        <div id="agentsCardsList" style="display: none;"></div>
    </div>

    <!-- Add/Edit Agent Modal -->
    <div id="agentModal" class="am-modal">
        <div class="am-modal-dialog">
            <button class="am-modal-close" onclick="closeAgentModal()">&times;</button>
            <h2 style="margin-top: 0; color: var(--dark); font-weight: 800;">Ajouter un agent</h2>
            <form id="agentForm" onsubmit="submitAgent(event)">
                <div class="am-form-group">
                    <label class="am-label">Nom complet</label>
                    <input type="text" class="am-input" id="agentName" required>
                </div>
                <div class="am-form-group">
                    <label class="am-label">Email</label>
                    <input type="email" class="am-input" id="agentEmail" required>
                </div>
                <div class="am-form-group">
                    <label class="am-label">Téléphone</label>
                    <input type="tel" class="am-input" id="agentPhone">
                </div>
                <button type="submit" class="am-btn am-btn--primary" style="width: 100%;">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="am-toast" style="display: none;"></div>

    <script>
        const AGENTS_API = '/kodpwomo/backend/agents/adm';

        // Load agents
        async function loadAgents() {
            try {
                const response = await fetch(AGENTS_API);
                const data = await response.json();
                const agents = Array.isArray(data) ? data : (data.agents || []);
                renderAgents(agents);
            } catch (error) {
                showToast('Erreur lors du chargement', 'error');
                console.error(error);
            }
        }

        function renderAgents(agents) {
            const tbody = document.getElementById('agentsTableBody');
            const cardsList = document.getElementById('agentsCardsList');

            if (!agents.length) {
                tbody.innerHTML = '<tr><td colspan="6">Aucun agent trouvé</td></tr>';
                cardsList.innerHTML = '<p>Aucun agent trouvé</p>';
                return;
            }

            tbody.innerHTML = agents.map((agent, i) => `
                <tr>
                    <td>${escapeHtml(agent.name || '—')}</td>
                    <td>${escapeHtml(agent.email || '—')}</td>
                    <td>${escapeHtml(agent.phone || '—')}</td>
                    <td><span class="am-badge am-badge--${agent.status === 'online' ? 'online' : 'offline'}">${agent.status || 'offline'}</span></td>
                    <td>${agent.total_deliveries || 0}</td>
                    <td>
                        <button class="am-btn am-btn--secondary" onclick="editAgent(${agent.id})">Éditer</button>
                    </td>
                </tr>
            `).join('');

            cardsList.innerHTML = agents.map(agent => `
                <div class="am-card">
                    <div class="am-card-header">
                        <div class="am-card-title">${escapeHtml(agent.name || '—')}</div>
                        <span class="am-badge am-badge--${agent.status === 'online' ? 'online' : 'offline'}">${agent.status || 'offline'}</span>
                    </div>
                    <div class="am-card-meta">${escapeHtml(agent.email || '—')}</div>
                    <div class="am-card-meta">📞 ${escapeHtml(agent.phone || '—')}</div>
                    <div class="am-card-meta">📦 ${agent.total_deliveries || 0} livraisons</div>
                </div>
            `).join('');
        }

        function openAgentModal() {
            document.getElementById('agentModal').classList.add('active');
        }

        function closeAgentModal() {
            document.getElementById('agentModal').classList.remove('active');
            document.getElementById('agentForm').reset();
        }

        function editAgent(id) {
            openAgentModal();
            // Implementation for editing
        }

        function submitAgent(event) {
            event.preventDefault();
            showToast('Agent enregistré avec succès', 'success');
            closeAgentModal();
            loadAgents();
        }

        function showToast(msg, type) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.className = `am-toast am-toast--${type}`;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 3000);
        }

        function escapeHtml(str) {
            if (typeof str !== 'string') return str;
            return str.replace(/[&<>"']/g, m => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;',
                '"': '&quot;', "'": '&#39;'
            }[m]));
        }

        document.getElementById('addAgentBtn').onclick = openAgentModal;
        document.getElementById('refreshBtn').onclick = loadAgents;
        document.getElementById('agentModal').onclick = (e) => {
            if (e.target.id === 'agentModal') closeAgentModal();
        };

        // Initial load
        loadAgents();
    </script>
</body>
</html>
