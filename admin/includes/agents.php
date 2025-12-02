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
            --primary: #f7b642;
            --primary-dark: #e19627;
            --secondary: #27ae60;
            --secondary-dark: #229954;
            --success: #27AE60;
            --error: #E74C3C;
            --dark: #1a1a2e;
            --gray: #64748b;
            --light: #f8f9fa;
            --white: #ffffff;
            --dark-gray: #1A1A1A;
            --medium-gray: #666666;
            --light-gray: #F5F5F5;
            --border-color: #E0E0E0;
            --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
            --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
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
            background: var(--white);
            margin: -2rem -1.5rem 2.5rem -1.5rem;
            padding: 2rem 1.5rem;
            border-radius: 0 0 12px 12px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-3d-base);
            transition: all 0.25s ease;
        }

        .am-header:hover {
            box-shadow: var(--shadow-3d-hover);
            transform: translateY(-2px);
        }

        .am-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary);
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
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-3d-base);
        }

        .am-btn--primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-3d-hover);
        }

        .am-btn--secondary {
            background: var(--white);
            color: var(--primary);
            border: 2px solid var(--primary);
            box-shadow: var(--shadow-3d-base);
        }

        .am-btn--secondary:hover {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-3d-hover);
        }

        /* Table */
        .am-table-wrap {
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow-3d-base);
            border: 1px solid #e0e0e0;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.25s ease;
        }

        .am-table-wrap:hover {
            box-shadow: var(--shadow-3d-hover);
        }

        .am-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .am-table thead {
            background: var(--secondary);
            border-bottom: 2px solid var(--secondary-dark);
        }

        .am-table th {
            padding: 1rem 1.25rem;
            text-align: left;
            font-weight: 700;
            color: var(--white);
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
            background: #f5f5f5;
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
            background: var(--success);
            color: var(--white);
        }

        .am-badge--offline {
            background: #e0e0e0;
            color: #666;
        }

        .am-badge--busy {
            background: var(--primary);
            color: var(--white);
        }

        /* Cards for Mobile */
        .am-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-3d-base);
            border-left: 5px solid var(--primary);
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }

        .am-card:hover {
            box-shadow: var(--shadow-3d-hover);
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
            background: rgba(0, 0, 0, 0.3);
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
            box-shadow: var(--shadow-3d-hover);
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
            background: #f0f0f0;
            border: none;
            font-size: 1.8rem;
            color: var(--gray);
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
            color: var(--white);
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
            box-shadow: var(--shadow-3d-base);
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
            color: var(--white);
        }

        .am-toast--success {
            background: var(--success);
        }

        .am-toast--error {
            background: var(--error);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .am-container { padding: 1rem; }
            .am-header { margin: -1rem -1rem 2.5rem -1rem; padding: 1.5rem 1rem; }
            .am-title { font-size: 1.8rem; }
            .am-table-wrap { display: none; }
            .am-modal-dialog { padding: 1.5rem 1rem; }
        }

        .am-skeleton {
            background: #e8e8e8;
            animation: shimmer 2s infinite;
            border-radius: 8px;
            height: 1rem;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
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
        const AGENTS_API = '/backend/agents/adm';

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
