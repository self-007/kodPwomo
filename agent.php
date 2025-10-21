<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kodPwomo - Espace Agent | Gestion des Livraisons</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Espace agent kodPwomo - Gérez vos livraisons, suivez vos transactions et restez disponible pour les commandes étudiantes en Haïti.">
    <meta name="keywords" content="agent kodpwomo, livraison campus, gestion commandes, espace agent haiti">
    <meta name="author" content="kodPwomo Team">
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="stylesheet" href="assets/css/kodpwomo-colors.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient-primary);
            min-height: 100vh;
            color: var(--dark-gray);
        }
        
        /* ===== HEADER ===== */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }
        
        .agent-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .agent-name {
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .logout-btn {
            background: var(--error);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: var(--error-dark);
        }
        
        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        /* ===== WELCOME SECTION ===== */
        .welcome-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .welcome-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 15px;
        }
        
        .welcome-message {
            font-size: 18px;
            color: var(--medium-gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        /* ===== STATUS SECTION ===== */
        .status-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 25px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
        }
        
        .status-available {
            background: var(--success);
            color: white;
        }
        
        .status-unavailable {
            background: var(--error);
            color: white;
        }
        
        .status-icon {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: white;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .toggle-status-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .toggle-status-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        
        .action-btn {
            background: white;
            border: 3px solid var(--light-gray);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark-gray);
        }
        
        .action-btn:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .action-btn-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .action-btn-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .action-btn-desc {
            color: var(--medium-gray);
            line-height: 1.5;
        }
        
        /* ===== MODALS ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 90vw;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            width: 800px;
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 30px;
            color: var(--medium-gray);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .modal-close:hover {
            background: var(--light-gray);
            color: var(--error);
        }
        
        .modal-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-gray);
        }
        
        .modal-icon {
            font-size: 32px;
        }
        
        /* ===== TRANSACTIONS MODAL ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--medium-gray);
            font-weight: 600;
        }
        
        .transactions-list {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .transaction-item {
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .transaction-item:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .transaction-id {
            font-weight: 700;
            color: var(--dark-gray);
        }
        
        .transaction-date {
            color: var(--medium-gray);
            font-size: 14px;
        }
        
        .transaction-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .transaction-status {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-completed {
            background: var(--success);
            color: white;
        }
        
        .status-pending {
            background: var(--warning);
            color: var(--dark-gray);
        }
        
        .status-in-progress {
            background: var(--primary);
            color: white;
        }
        
        /* ===== ORDERS MODAL ===== */
        .order-item {
            background: white;
            border: 2px solid var(--light-gray);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .order-item:hover {
            border-color: var(--primary);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .order-info {
            flex: 1;
        }
        
        .order-id {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 5px;
        }
        
        .order-university {
            color: var(--primary);
            font-weight: 600;
        }
        
        .order-total {
            text-align: right;
        }
        
        .order-amount {
            font-size: 24px;
            font-weight: 800;
            color: var(--success);
        }
        
        .order-products {
            margin: 15px 0;
        }
        
        .product-summary {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .take-order-btn {
            background: var(--success);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .take-order-btn:hover {
            background: var(--success-dark);
            transform: translateY(-2px);
        }
        
        /* ===== DELIVERY MODAL ===== */
        .delivery-details {
            background: var(--light-gray);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .detail-value {
            color: var(--medium-gray);
        }
        
        .delivery-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .delivery-btn {
            padding: 15px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        
        .done-btn {
            background: var(--success);
            color: white;
        }
        
        .done-btn:hover {
            background: var(--success-dark);
        }
        
        .feedback-btn {
            background: var(--primary);
            color: white;
        }
        
        .feedback-btn:hover {
            background: var(--primary-dark);
        }
        
        .feedback-section {
            border-top: 2px solid var(--light-gray);
            padding-top: 25px;
        }
        
        .feedback-form {
            display: flex;
            gap: 15px;
        }
        
        .feedback-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid var(--light-gray);
            border-radius: 25px;
            font-size: 16px;
        }
        
        .feedback-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .send-feedback-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
        }
        
        .feedback-list {
            margin-top: 20px;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .feedback-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            border-left: 4px solid var(--primary);
        }
        
        .feedback-time {
            font-size: 12px;
            color: var(--medium-gray);
            margin-bottom: 5px;
        }
        
        /* ===== LOADING & ALERTS ===== */
        .loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 3000;
            text-align: center;
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--light-gray);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .alert {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            z-index: 3000;
            transform: translateX(400px);
            transition: all 0.3s ease;
        }
        
        .alert.show {
            transform: translateX(0);
        }
        
        .alert.success {
            background: var(--success);
            color: white;
        }
        
        .alert.error {
            background: var(--error);
            color: white;
        }
        
        .alert.warning {
            background: var(--warning);
            color: var(--dark-gray);
        }
        
        .alert.info {
            background: var(--primary);
            color: white;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 15px;
            }
            
            .main-container {
                padding: 20px 15px;
            }
            
            .welcome-section {
                padding: 20px;
            }
            
            .welcome-title {
                font-size: 24px;
            }
            
            .status-section {
                flex-direction: column;
            }
            
            .action-buttons {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .modal-content {
                width: 95vw;
                margin: 10px;
                padding: 20px;
            }
            
            .delivery-actions {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .transaction-details {
                grid-template-columns: 1fr;
            }
            
            .feedback-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="index.html" class="logo">kodPwomo Agent</a>
            
            <div class="agent-info">
                <span id="agentName" class="agent-name">Chargement...</span>
                <button class="logout-btn" onclick="logout()">Déconnexion</button>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Welcome Section -->
        <section class="welcome-section">
            <h1 class="welcome-title">🚀 Bienvenue dans votre espace agent !</h1>
            <p id="welcomeMessage" class="welcome-message">
                Chargement de votre statut...
            </p>
            
            <!-- Status Section -->
            <div class="status-section">
                <div id="statusIndicator" class="status-indicator">
                    <div class="status-icon"></div>
                    <span id="statusText">Vérification du statut...</span>
                </div>
                
                <button id="toggleStatusBtn" class="toggle-status-btn" onclick="toggleStatus()">
                    <span id="toggleBtnText">Chargement...</span>
                </button>
            </div>
        </section>

        <!-- Action Buttons -->
        <section class="action-buttons">
            <div class="action-btn" onclick="openTransactionsModal()">
                <div class="action-btn-icon">📊</div>
                <div class="action-btn-title">Mes Transactions</div>
                <div class="action-btn-desc">Consultez vos livraisons effectuées et votre historique de transactions</div>
            </div>
            
            <div class="action-btn" onclick="openOrdersModal()">
                <div class="action-btn-icon">📦</div>
                <div class="action-btn-title">Commandes Disponibles</div>
                <div class="action-btn-desc">Prenez de nouvelles commandes en attente de confirmation</div>
            </div>
            
            <div class="action-btn" onclick="openDeliveryModal()">
                <div class="action-btn-icon">🚚</div>
                <div class="action-btn-title">Livraison en Cours</div>
                <div class="action-btn-desc">Gérez votre livraison actuelle et communiquez avec le client</div>
            </div>
        </section>
    </main>

    <!-- Transactions Modal -->
    <div id="transactionsModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeTransactionsModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon">📊</div>
                <h2 class="modal-title">Mes Transactions</h2>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div id="totalDeliveries" class="stat-number">0</div>
                    <div class="stat-label">Livraisons Totales</div>
                </div>
                <div class="stat-card">
                    <div id="completedDeliveries" class="stat-number">0</div>
                    <div class="stat-label">Complétées</div>
                </div>
                <div class="stat-card">
                    <div id="totalEarnings" class="stat-number">0 HTG</div>
                    <div class="stat-label">Gains Totaux</div>
                </div>
                <div class="stat-card">
                    <div id="monthlyEarnings" class="stat-number">0 HTG</div>
                    <div class="stat-label">Ce Mois</div>
                </div>
            </div>
            
            <div id="transactionsList" class="transactions-list">
                <!-- Transactions will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Available Orders Modal -->
    <div id="ordersModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeOrdersModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon">📦</div>
                <h2 class="modal-title">Commandes Disponibles</h2>
            </div>
            
            <div id="ordersList" class="orders-list">
                <!-- Available orders will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Current Delivery Modal -->
    <div id="deliveryModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeliveryModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon">🚚</div>
                <h2 class="modal-title">Livraison en Cours</h2>
            </div>
            
            <div id="deliveryContent">
                <!-- Current delivery details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Loading -->
    <div id="loading" class="loading">
        <div class="loading-spinner"></div>
        <div>Chargement...</div>
    </div>

    <!-- Alert -->
    <div id="alert" class="alert"></div>

    <script>
        // ===== GLOBAL VARIABLES =====
        let currentAgent = null;
        let agentStatus = false; // false = unavailable, true = available
        let currentDelivery = null;
        let refreshInterval = null;
        const AGENT_UNIQUE_ID = 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1'; // Your unique ID

        // ===== INITIALIZATION =====
        document.addEventListener('DOMContentLoaded', function() {
            loadAgentData();
            startAutoRefresh();
        });

        // ===== AGENT DATA FUNCTIONS =====
        async function loadAgentData() {
            showLoading(true);
            
            try {
                // Simulate loading agent data from API
                // Replace this with actual API call
                currentAgent = await loadAgentFromAPI();
                
                if (currentAgent) {
                    displayAgentInfo();
                    await checkAgentStatus();
                } else {
                    // Redirect to login if not authenticated
                    window.location.href = 'login.php';
                }
                
            } catch (error) {
                console.error('Erreur lors du chargement des données agent:', error);
                showAlert('Erreur lors du chargement des données', 'error');
                // Redirect to login on error
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            } finally {
                showLoading(false);
            }
        }

        function displayAgentInfo() {
            document.getElementById('agentName').textContent = currentAgent.name || 'Agent';
        }

        async function checkAgentStatus() {
            try {
                // Get agent status from API using unique ID
                const status = await getAgentStatusFromAPI(AGENT_UNIQUE_ID);
                agentStatus = status.is_available;
                updateStatusDisplay();
                
            } catch (error) {
                console.error('Erreur lors de la vérification du statut:', error);
                updateStatusDisplay();
            }
        }

        function updateStatusDisplay() {
            const statusIndicator = document.getElementById('statusIndicator');
            const statusText = document.getElementById('statusText');
            const welcomeMessage = document.getElementById('welcomeMessage');
            const toggleBtn = document.getElementById('toggleBtnText');
            
            if (agentStatus) {
                // Agent is available
                statusIndicator.className = 'status-indicator status-available';
                statusText.textContent = 'Disponible';
                welcomeMessage.textContent = 'Vous êtes disponible pour le moment ! Soyez attentif aux nouvelles commandes.';
                toggleBtn.textContent = 'Fermer / Non Disponible';
            } else {
                // Agent is unavailable
                statusIndicator.className = 'status-indicator status-unavailable';
                statusText.textContent = 'Non Disponible';
                welcomeMessage.textContent = 'Vous n\'êtes pas disponible actuellement. Si vous voulez travailler, cliquez sur "Disponible".';
                toggleBtn.textContent = 'Disponible';
            }
        }

        async function toggleStatus() {
            showLoading(true);
            
            try {
                // Toggle agent status via API using your backend logic
                const newStatus = !agentStatus; // Simple boolean toggle
                const result = await updateAgentStatusAPI(AGENT_UNIQUE_ID, newStatus);
                
                if (result.success) {
                    agentStatus = newStatus;
                    updateStatusDisplay();
                    
                    const statusMessage = newStatus ? 
                        'Vous êtes maintenant disponible pour les commandes !' :
                        'Vous êtes maintenant non disponible';
                    showAlert(statusMessage, 'success');
                } else {
                    showAlert('Erreur lors de la mise à jour du statut', 'error');
                }
                
            } catch (error) {
                console.error('Erreur lors du changement de statut:', error);
                showAlert('Erreur lors du changement de statut', 'error');
            } finally {
                showLoading(false);
            }
        }

        // ===== TRANSACTIONS MODAL =====
        async function openTransactionsModal() {
            showLoading(true);
            
            try {
                const transactions = await getAgentTransactionsAPI(AGENT_UNIQUE_ID);
                displayTransactions(transactions);
                document.getElementById('transactionsModal').style.display = 'block';
                
            } catch (error) {
                console.error('Erreur lors du chargement des transactions:', error);
                showAlert('Erreur lors du chargement des transactions', 'error');
            } finally {
                showLoading(false);
            }
        }

        function displayTransactions(data) {
            // Extraire les données du backend
            const transactions = data.deliveries || [];
            const stats = data.stats || {};
            
            // Update stats depuis le backend
            const totalDeliveries = stats.totalDeliveries || transactions.length;
            const completedDeliveries = stats.completedDeliveries || transactions.filter(t => t.status === 'completed' || t.status === 1).length;
            const totalEarnings = stats.totalAmount || transactions.reduce((sum, t) => sum + (t.amount || t.commission || 0), 0);
            
            // Calculate monthly earnings (current month)
            const currentMonth = new Date().getMonth();
            const currentYear = new Date().getFullYear();
            const monthlyEarnings = transactions.filter(t => {
                const date = new Date(t.date);
                return date.getMonth() === currentMonth && date.getFullYear() === currentYear;
            }).reduce((sum, t) => sum + (t.delivery_price || 0), 0);
            
            document.getElementById('totalDeliveries').textContent = totalDeliveries;
            document.getElementById('completedDeliveries').textContent = completedDeliveries;
            document.getElementById('totalEarnings').textContent = totalEarnings + ' HTG';
            document.getElementById('monthlyEarnings').textContent = monthlyEarnings + ' HTG';
            
            // Display transactions list
            const transactionsList = document.getElementById('transactionsList');
            transactionsList.innerHTML = '';
            
            if (transactions.length === 0) {
                transactionsList.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: var(--medium-gray);">
                        <div style="font-size: 48px; margin-bottom: 15px;">📦</div>
                        <p>Aucune transaction pour le moment</p>
                    </div>
                `;
                return;
            }
            
            transactions.forEach(transaction => {
                const item = document.createElement('div');
                item.className = 'transaction-item';
                
                // Adapter status selon votre backend (1=completed, 2=pending, etc.)
                const statusClass = (transaction.status === 'completed' || transaction.status === 1) ? 'status-completed' :
                                   (transaction.status === 'pending' || transaction.status === 2) ? 'status-pending' : 'status-in-progress';
                
                const statusText = (transaction.status === 'completed' || transaction.status === 1) ? 'Terminée' :
                                  (transaction.status === 'pending' || transaction.status === 2) ? 'En attente' : 'En cours';
                
                item.innerHTML = `
                    <div class="transaction-header">
                        <div class="transaction-id">Livraison #${transaction.id}</div>
                        <div class="transaction-date">${formatDate(transaction.date || new Date().toISOString())}</div>
                    </div>
                    <div class="transaction-details">
                        <div>
                            <strong>Commande:</strong> ${transaction.id_commande}<br>
                            <strong>Prix:</strong> ${transaction.delivery_price} HTG<br>
                            <strong>Note:</strong> ⭐ ${transaction.note}/5
                        </div>
                        <div style="text-align: right;">
                            <div class="transaction-status ${statusClass}">${statusText}</div>
                            <div style="margin-top: 10px; font-weight: 600;">
                                Total: ${transaction.delivery_price} HTG
                            </div>
                        </div>
                    </div>
                `;
                
                transactionsList.appendChild(item);
            });
        }

        function closeTransactionsModal() {
            document.getElementById('transactionsModal').style.display = 'none';
        }

        // ===== ORDERS MODAL =====
        async function openOrdersModal() {
            showLoading(true);
            
            try {
                const availableOrders = await getAvailableOrdersAPI();
                displayAvailableOrders(availableOrders);
                document.getElementById('ordersModal').style.display = 'block';
                
            } catch (error) {
                console.error('Erreur lors du chargement des commandes:', error);
                showAlert('Erreur lors du chargement des commandes', 'error');
            } finally {
                showLoading(false);
            }
        }

        function displayAvailableOrders(orders) {
            const ordersList = document.getElementById('ordersList');
            ordersList.innerHTML = '';
            
            if (orders.length === 0) {
                ordersList.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: var(--medium-gray);">
                        <div style="font-size: 48px; margin-bottom: 15px;">📦</div>
                        <p>Aucune commande disponible pour le moment</p>
                    </div>
                `;
                return;
            }
            
            // Regrouper les données par order_id
            const groupedOrders = {};
            
            orders.forEach(item => {
                const orderId = item.order_id;
                
                if (!groupedOrders[orderId]) {
                    groupedOrders[orderId] = {
                        order_id: orderId,
                        university_name: item.university_name,
                        salle_name: item.salle_name,
                        items: [],
                        total_amount: 0,
                        total_quantity: 0
                    };
                }
                
                groupedOrders[orderId].items.push({
                    name: item.product_name || 'Produit',
                    quantity: parseInt(item.qnt) || 1,
                    price: parseFloat(item.price) || 0
                });
                
                groupedOrders[orderId].total_amount += parseFloat(item.price) || 0;
                groupedOrders[orderId].total_quantity += parseInt(item.qnt) || 1;
            });
            
            // Afficher chaque commande groupée
            Object.values(groupedOrders).forEach(order => {
                const item = document.createElement('div');
                item.className = 'order-item';
                
                item.innerHTML = `
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-id">Commande #${order.order_id}</div>
                            <div class="order-university">${order.university_name}</div>
                        </div>
                        <div class="order-total">
                            <div class="order-amount">${order.total_amount} HTG</div>
                        </div>
                    </div>
                    
                    <div class="order-products">
                        <div class="product-summary">
                            <strong>Produits (${order.total_quantity} items):</strong><br>
                            ${order.items.map(p => `${p.name} x${p.quantity} (${p.price} HTG)`).join('<br>')}
                        </div>
                        <div class="delivery-address">
                            <strong>📍 Adresse de livraison:</strong> ${order.university_name} - ${order.salle_name}
                        </div>
                    </div>
                    
                    <button class="take-order-btn" onclick="takeOrder('${order.order_id}')">
                        🚚 Prendre cette commande
                    </button>
                `;
                
                ordersList.appendChild(item);
            });
        }

        async function takeOrder(orderId) {
            if (!confirm('Voulez-vous vraiment prendre cette commande ?')) {
                return;
            }
            
            showLoading(true);
            
            try {
                const result = await assignOrderToAgentAPI(orderId, AGENT_UNIQUE_ID);
                
                if (result.success) {
                    showAlert('Commande prise avec succès !', 'success');
                    closeOrdersModal();
                    // Refresh the orders list
                    setTimeout(() => openOrdersModal(), 1000);
                } else {
                    showAlert(result.message || 'Cette commande n\'est plus disponible', 'error');
                    // Refresh the orders list
                    setTimeout(() => openOrdersModal(), 1000);
                }
                
            } catch (error) {
                console.error('Erreur lors de la prise de commande:', error);
                showAlert('Erreur lors de la prise de commande', 'error');
            } finally {
                showLoading(false);
            }
        }

        function closeOrdersModal() {
            document.getElementById('ordersModal').style.display = 'none';
        }

        // ===== DELIVERY MODAL =====
        async function openDeliveryModal() {
            showLoading(true);
            
            try {
                const delivery = await getCurrentDeliveryAPI(AGENT_UNIQUE_ID);
                
                if (delivery) {
                    currentDelivery = delivery;
                    displayCurrentDelivery(delivery);
                    document.getElementById('deliveryModal').style.display = 'block';
                } else {
                    showAlert('Aucune livraison en cours', 'info');
                }
                
            } catch (error) {
                console.error('Erreur lors du chargement de la livraison:', error);
                showAlert('Erreur lors du chargement de la livraison', 'error');
            } finally {
                showLoading(false);
            }
        }

        function displayCurrentDelivery(deliveryData) {
            const content = document.getElementById('deliveryContent');
            
            // Si deliveryData est un array (données du backend), traiter les données
            if (Array.isArray(deliveryData)) {
                // Regrouper par order_id (au cas où plusieurs commandes)
                const groupedOrders = {};
                
                deliveryData.forEach(item => {
                    const orderId = item.order_id;
                    
                    if (!groupedOrders[orderId]) {
                        groupedOrders[orderId] = {
                            order_id: orderId,
                            university_name: item.name,
                            salle_name: item.salle_name,
                            id_user: item.id_user,
                            items: [],
                            total_order_amount: 0,
                            total_delivery_amount: 0,
                            total_quantity: 0,
                            varieties_count: 0
                        };
                    }
                    
                    groupedOrders[orderId].items.push({
                        product_name: item.product_name,
                        quantity: parseInt(item.qnt) || 1,
                        order_price: parseFloat(item.order_price) || 0,
                        delivery_price: parseFloat(item.delivery_price) || 0
                    });
                    
                    groupedOrders[orderId].total_order_amount += parseFloat(item.order_price) || 0;
                    groupedOrders[orderId].total_delivery_amount += parseFloat(item.delivery_price) || 0;
                    groupedOrders[orderId].total_quantity += parseInt(item.qnt) || 1;
                    groupedOrders[orderId].varieties_count += 1;
                });
                
                // Prendre la première commande (ou vous pouvez traiter toutes)
                const delivery = Object.values(groupedOrders)[0];
                
                content.innerHTML = `
                    <div class="delivery-details">
                        <div class="detail-row">
                            <span class="detail-label">Commande:</span>
                            <span class="detail-value">#${delivery.order_id}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Client:</span>
                            <span class="detail-value">Commande #${delivery.order_id}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Université:</span>
                            <span class="detail-value">${delivery.university_name}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Adresse:</span>
                            <span class="detail-value">${delivery.university_name} - ${delivery.salle_name}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Total Commande:</span>
                            <span class="detail-value">${delivery.total_order_amount} HTG</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Frais de Livraison:</span>
                            <span class="detail-value">${delivery.total_delivery_amount} HTG</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Produits:</span>
                            <span class="detail-value">
                                <strong>${delivery.total_quantity} produits (${delivery.varieties_count} variétés)</strong><br>
                                ${delivery.items.map(p => `${p.product_name} x${p.quantity} (${p.order_price} HTG)`).join('<br>')}
                            </span>
                        </div>
                    </div>
                    
                    <div class="delivery-actions">
                        <button class="delivery-btn done-btn" onclick="markDeliveryDone('${delivery.order_id}')">
                            ✅ Terminé
                        </button>
                        <button class="delivery-btn feedback-btn" onclick="showFeedbackForm()">
                            💬 Envoyer Feedback
                        </button>
                    </div>
                    
                    <div class="feedback-section">
                        <h3 style="margin-bottom: 15px;">💬 Communication Client</h3>
                        
                        <div id="feedbackForm" style="display: none;">
                            <div class="feedback-form">
                                <input type="text" id="feedbackInput" class="feedback-input" 
                                       placeholder="Tapez votre message au client...">
                                <button class="send-feedback-btn" onclick="sendFeedback()">Envoyer</button>
                            </div>
                        </div>
                        
                        <div id="feedbackList" class="feedback-list">
                            <!-- Feedbacks will be loaded here -->
                        </div>
                    </div>
                `;
                
                // Load existing feedbacks
                loadDeliveryFeedbacks(delivery.order_id);
            } else {
                // Format ancien (cas de fallback)
                content.innerHTML = `
                    <div class="delivery-details">
                        <div class="detail-row">
                            <span class="detail-label">Commande:</span>
                            <span class="detail-value">#${deliveryData.order_id}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Client:</span>
                            <span class="detail-value">${deliveryData.client_name || deliveryData.id_user}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Université:</span>
                            <span class="detail-value">${deliveryData.university_name}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Total:</span>
                            <span class="detail-value">${deliveryData.total_amount} HTG</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Produits:</span>
                            <span class="detail-value">${deliveryData.products ? deliveryData.products.map(p => `${p.name} x${p.quantity}`).join(', ') : 'Détails non disponibles'}</span>
                        </div>
                    </div>
                    
                    <div class="delivery-actions">
                        <button class="delivery-btn done-btn" onclick="markDeliveryDone('${deliveryData.id || deliveryData.order_id}')">
                            ✅ Terminé
                        </button>
                        <button class="delivery-btn feedback-btn" onclick="showFeedbackForm()">
                            💬 Envoyer Feedback
                        </button>
                    </div>
                    
                    <div class="feedback-section">
                        <h3 style="margin-bottom: 15px;">💬 Communication Client</h3>
                        
                        <div id="feedbackForm" style="display: none;">
                            <div class="feedback-form">
                                <input type="text" id="feedbackInput" class="feedback-input" 
                                       placeholder="Tapez votre message au client...">
                                <button class="send-feedback-btn" onclick="sendFeedback()">Envoyer</button>
                            </div>
                        </div>
                        
                        <div id="feedbackList" class="feedback-list">
                            <!-- Feedbacks will be loaded here -->
                        </div>
                    </div>
                `;
                
                // Load existing feedbacks
                loadDeliveryFeedbacks(deliveryData.id || deliveryData.order_id);
            }
        }

        function showFeedbackForm() {
            const form = document.getElementById('feedbackForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
            
            if (form.style.display === 'block') {
                document.getElementById('feedbackInput').focus();
            }
        }

        async function sendFeedback() {
            const input = document.getElementById('feedbackInput');
            const message = input.value.trim();
            
            if (!message) {
                showAlert('Veuillez saisir un message', 'warning');
                return;
            }
            
            showLoading(true);
            
            try {
                // Récupérer les données de la livraison actuelle
                const deliveryData = Array.isArray(currentDelivery) ? currentDelivery[0] : currentDelivery;
                const orderId = deliveryData.order_id;
                const userId = deliveryData.id_user; // Disponible mais pas affiché
                
                // Envoyer le feedback au client via API
                const result = await sendFeedbackToClientAPI(message, userId, orderId);
                
                if (result.success) {
                    // Stocker le message localement
                    saveFeedbackToLocalStorage(orderId, message, 'agent');
                    
                    showAlert('Message envoyé au client !', 'success');
                    input.value = '';
                    
                    // Recharger les feedbacks depuis localStorage
                    loadLocalFeedbacks(orderId);
                } else {
                    showAlert('Erreur lors de l\'envoi du message', 'error');
                }
                
            } catch (error) {
                console.error('Erreur lors de l\'envoi du feedback:', error);
                showAlert('Erreur lors de l\'envoi du message', 'error');
            } finally {
                showLoading(false);
            }
        }

        // Nouvelle fonction pour envoyer feedback au client
        async function sendFeedbackToClientAPI(message, userId, orderId) {
            try {
                const response = await fetch('backend/notifications/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: message,
                        id_user: userId,
                        order_id: orderId,
                        type: 'delivery_feedback'
                    })
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Erreur API feedback:', error);
                return { success: false, error: error.message };
            }
        }

        // Gestion localStorage pour les feedbacks
        function saveFeedbackToLocalStorage(orderId, message, sender) {
            const storageKey = `feedback_${orderId}`;
            let feedbacks = JSON.parse(localStorage.getItem(storageKey)) || [];
            
            feedbacks.push({
                message: message,
                sender: sender, // 'agent' ou 'client' 
                timestamp: new Date().toISOString()
            });
            
            localStorage.setItem(storageKey, JSON.stringify(feedbacks));
        }

        function loadLocalFeedbacks(orderId) {
            const storageKey = `feedback_${orderId}`;
            const feedbacks = JSON.parse(localStorage.getItem(storageKey)) || [];
            const feedbackList = document.getElementById('feedbackList');
            
            if (feedbacks.length === 0) {
                feedbackList.innerHTML = '<p style="color: var(--medium-gray); text-align: center;">Aucun message envoyé</p>';
                return;
            }
            
            feedbackList.innerHTML = '';
            feedbacks.forEach(feedback => {
                const item = document.createElement('div');
                item.className = `feedback-item ${feedback.sender}`;
                item.innerHTML = `
                    <div class="feedback-time">${formatDateTime(feedback.timestamp)}</div>
                    <div class="feedback-message">${feedback.message}</div>
                    <div class="feedback-sender">${feedback.sender === 'agent' ? 'Vous' : 'Client'}</div>
                `;
                feedbackList.appendChild(item);
            });
            
            // Scroll vers le bas pour voir le dernier message
            feedbackList.scrollTop = feedbackList.scrollHeight;
        }

        // Nettoyer localStorage à la fin de livraison
        function clearDeliveryFeedbacks(orderId) {
            const storageKey = `feedback_${orderId}`;
            localStorage.removeItem(storageKey);
            console.log(`Feedbacks nettoyés pour la commande ${orderId}`);
        }

        async function loadDeliveryFeedbacks(orderId) {
            // Utiliser localStorage au lieu de l'API
            loadLocalFeedbacks(orderId);
        }

        async function markDeliveryDone(orderId) {
            if (!confirm('Êtes-vous sûr que la livraison est terminée ? Cette action ne peut pas être annulée.')) {
                return;
            }
            
            showLoading(true);
            
            try {
                const result = await completeDeliveryAPI(orderId, AGENT_UNIQUE_ID);
                
                if (result.success) {
                    // Nettoyer automatiquement les feedbacks localStorage
                    clearDeliveryFeedbacks(orderId);
                    
                    showAlert('✅ Livraison terminée ! Messages nettoyés.', 'success');
                    closeDeliveryModal();
                    currentDelivery = null;
                    
                    // Refresh des données
                    checkAgentStatus();
                } else {
                    showAlert('Erreur lors de la finalisation de la livraison', 'error');
                }
                
            } catch (error) {
                console.error('Erreur lors de la finalisation:', error);
                showAlert('Erreur lors de la finalisation de la livraison', 'error');
            } finally {
                showLoading(false);
            }
        }

        function closeDeliveryModal() {
            document.getElementById('deliveryModal').style.display = 'none';
        }

        // ===== AUTO REFRESH =====
        function startAutoRefresh() {
            // Refresh data every 30 seconds
            refreshInterval = setInterval(() => {
                if (!document.hidden) { // Only refresh if page is visible
                    checkAgentStatus();
                }
            }, 30000);
        }

        // ===== UTILITY FUNCTIONS =====
        function showLoading(show) {
            document.getElementById('loading').style.display = show ? 'block' : 'none';
        }

        function showAlert(message, type = 'success') {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = `alert ${type}`;
            alert.classList.add('show');
            
            setTimeout(() => {
                alert.classList.remove('show');
            }, 4000);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function formatDateTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function logout() {
            if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
                // Clear any stored data
                localStorage.removeItem('agent_token');
                // Redirect to login
                window.location.href = 'login.php';
            }
        }

        // ===== API FUNCTIONS - USING YOUR BACKEND =====
        async function loadAgentFromAPI() {
            // Using your backend with the unique ID
            const agentUniqueId = 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1';
            
            // For now simulate, but this will call your backend
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve({
                        id_unique: agentUniqueId,
                        name: 'Jean Baptiste',
                        email: 'jean@kodpwomo.com',
                        phone: '+509 1234-5678',
                        is_available: false
                    });
                }, 1000);
            });
        }

        async function getAgentStatusFromAPI(agentUniqueId) {
            // Utilise votre route GET via .htaccess rewrite
            try {
                const response = await fetch(`backend/agents/availability/${agentUniqueId}`);
                if (!response.ok) {
                    throw new Error('Failed to get agent status');
                }
                const data = await response.json();
                return {
                    is_available: Boolean(data.is_available), // Convertit 1/0 en true/false
                    last_activity: data.updated_at || new Date().toISOString()
                };
            } catch (error) {
                console.log('Backend call failed, using simulated data:', error);
                // Fallback en cas d'erreur
                return {
                    is_available: false,
                    last_activity: new Date().toISOString()
                };
            }
        }

        async function updateAgentStatusAPI(agentUniqueId, isAvailable) {
            // PUT avec JSON data selon votre backend
            try {
                const response = await fetch('backend/agents/availability', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        agentId: agentUniqueId,      // Correspond à votre backend
                        isAvailable: isAvailable     // Correspond à votre backend
                    })
                });
                
                if (!response.ok) {
                    throw new Error('Failed to update agent status');
                }
                
                return await response.json();
            } catch (error) {
                console.log('Backend call failed, using simulation');
                // Fallback simulation
                return {
                    success: true,
                    message: 'Status updated successfully (simulated)'
                };
            }
        }

        async function getAgentTransactionsAPI(agentId) {
            // Utilise votre vraie route backend
            try {
                const response = await fetch(`backend/deliveries/agent/${agentId}`);
                if (!response.ok) {
                    throw new Error('Failed to get agent transactions');
                }
                const data = await response.json();
                
                // Adapter les données backend au format attendu par le frontend
                return {
                    deliveries: data.lastMonthDeliveries || [],
                    stats: {
                        totalDeliveries: data.nbrsTotalDeliveries || 0,
                        totalAmount: data.totalAmount || 0,
                        completedDeliveries: data.lastMonthDeliveries ? data.lastMonthDeliveries.filter(d => d.status === 'completed' || d.status === 1).length : 0
                    }
                };
            } catch (error) {
                console.log('Backend call failed, using simulated data:', error);
                // Fallback simulation
                return {
                    deliveries: [
                        {
                            id: 'tx_001',
                            order_id: '12345',
                            client_name: 'Marie Dupont',
                            university_name: 'UEH', 
                            status: 'completed',
                            total_amount: 850,
                            commission: 85,
                            date: '2024-01-15T10:30:00Z'
                        }
                    ],
                    stats: {
                        totalDeliveries: 1,
                        totalAmount: 850,
                        completedDeliveries: 1
                    }
                };
            }
        }

        async function getAvailableOrdersAPI() {
            try {
                const response = await fetch('backend/orders/available', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                if (data.orders && data.orders.length > 0) {
                    return data.orders;
                } else {
                    return [];
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des commandes disponibles:', error);
                showNotification('Erreur lors du chargement des commandes', 'error');
                return [];
            }
        }

        async function assignOrderToAgentAPI(orderId, agentId) {
            // Mock API call
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve({
                        success: true,
                        message: 'Order assigned successfully'
                    });
                }, 800);
            });
        }

        async function getCurrentDeliveryAPI(agentId) {
            try {
                const response = await fetch(`backend/deliveries/agent/orderProcess/${agentId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Retourner toutes les livraisons en cours pour traitement
                if (data.deliveries && data.deliveries.length > 0) {
                    return data.deliveries; // Toutes les livraisons pour regroupement
                } else {
                    return null; // Aucune livraison en cours
                }
            } catch (error) {
                console.error('Erreur lors de la récupération de la livraison en cours:', error);
                showNotification('Erreur lors du chargement de la livraison en cours', 'error');
                return null;
            }
        }

        async function sendDeliveryFeedbackAPI(deliveryId, agentId, message) {
            // Mock API call
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve({
                        success: true,
                        feedback_id: 'fb_' + Date.now()
                    });
                }, 500);
            });
        }

        async function getDeliveryFeedbacksAPI(deliveryId) {
            // Mock data - replace with real API
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve([
                        {
                            id: 'fb_001',
                            message: 'Je suis en route vers votre campus',
                            sent_at: '2024-01-16T16:10:00Z'
                        },
                        {
                            id: 'fb_002',
                            message: 'Arrivé sur le campus, je me dirige vers le bloc C',
                            sent_at: '2024-01-16T16:25:00Z'
                        }
                    ]);
                }, 500);
            });
        }

        async function completeDeliveryAPI(deliveryId, agentId) {
            // Mock API call
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve({
                        success: true,
                        message: 'Delivery completed successfully'
                    });
                }, 800);
            });
        }

        // ===== EVENT LISTENERS =====
        // Close modals on background click
        document.getElementById('transactionsModal').addEventListener('click', function(e) {
            if (e.target === this) closeTransactionsModal();
        });

        document.getElementById('ordersModal').addEventListener('click', function(e) {
            if (e.target === this) closeOrdersModal();
        });

        document.getElementById('deliveryModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeliveryModal();
        });

        // Handle Enter key in feedback input
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.id === 'feedbackInput') {
                sendFeedback();
            }
        });

        // Clean up interval on page unload
        window.addEventListener('beforeunload', function() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        });
    </script>
</body>
</html>