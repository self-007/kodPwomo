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
        /* ===== CUSTOM COLOR PALETTE ===== */
        :root {
            --primary: #f39c12;
            --primary-dark: #e67e22;
            --secondary: #27ae60;
            --secondary-dark: #229954;
            --white: #ffffff;
            --dark-gray: #1A1A1A;
            --medium-gray: #666666;
            --light-gray: #F5F5F5;
            --border-color: #E0E0E0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            color: var(--dark-gray);
        }
        
        /* ===== HEADER ===== */
        .header {
            background: var(--secondary);
            padding: 12px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 800;
            color: var(--white);
            text-decoration: none;
        }
        
        .agent-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .agent-name {
            font-weight: 600;
            color: var(--white);
            font-size: 14px;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .logout-btn {
            background: rgba(0, 0, 0, 0.1);
            color: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: translateY(-1px);
        }
        
        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        
        /* ===== WELCOME SECTION ===== */
        .welcome-section {
            background: var(--white);
            border-radius: 12px;
            padding: 24px 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            text-align: center;
            border-top: 4px solid var(--primary);
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 12px;
        }
        
        .welcome-message {
            font-size: 15px;
            color: var(--medium-gray);
            margin-bottom: 24px;
            line-height: 1.5;
        }
        
        /* ===== STATUS SECTION ===== */
        .status-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .status-available {
            background: var(--secondary);
            color: var(--white);
            box-shadow: 0 2px 6px rgba(39, 174, 96, 0.2);
        }
        
        .status-unavailable {
            background: #e74c3c;
            color: var(--white);
            box-shadow: 0 2px 6px rgba(231, 76, 60, 0.2);
        }
        
        .status-icon {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--white);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .toggle-status-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 2px 6px rgba(243, 156, 18, 0.2);
        }
        
        .toggle-status-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
            margin-top: 30px;
        }
        
        .action-btn {
            background: var(--white);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 24px 18px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark-gray);
            position: relative;
            overflow: hidden;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .action-btn:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }
        
        .action-btn:hover::before {
            transform: scaleX(1);
        }
        
        .action-btn-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }
        
        .action-btn-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--primary);
        }
        
        .action-btn-desc {
            color: var(--medium-gray);
            font-size: 14px;
            line-height: 1.4;
        }
        
        /* ===== MODALS ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            overflow-y: auto;
            padding: 20px 15px;
        }
        
        .modal-content {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            position: relative;
            width: 100%;
            border-top: 4px solid var(--primary);
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--light-gray);
            border: none;
            font-size: 28px;
            color: var(--medium-gray);
            cursor: pointer;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .modal-close:hover {
            background: #e74c3c;
            color: var(--white);
        }
        
        .modal-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .modal-icon {
            font-size: 28px;
        }
        
        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: var(--white);
            padding: 18px;
            border-radius: 12px;
            text-align: center;
            border: 2px solid var(--border-color);
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--medium-gray);
            font-weight: 600;
            font-size: 13px;
        }
        
        /* ===== LISTS ===== */
        .transactions-list, .orders-list {
            max-height: 450px;
            overflow-y: auto;
        }
        
        .transaction-item, .order-item {
            background: var(--white);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .transaction-item:hover, .order-item:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .transaction-header, .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .transaction-id, .order-id {
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
        }
        
        .transaction-date {
            color: var(--medium-gray);
            font-size: 12px;
        }
        
        .transaction-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            font-size: 13px;
        }
        
        .transaction-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            width: fit-content;
        }
        
        .status-completed {
            background: var(--secondary);
            color: var(--white);
        }
        
        .status-pending {
            background: #f39c12;
            color: var(--white);
        }
        
        .status-in-progress {
            background: var(--primary);
            color: var(--white);
        }
        
        /* ===== ORDER SPECIFIC ===== */
        .order-info {
            flex: 1;
            min-width: 150px;
        }
        
        .order-university {
            color: #555;
            font-weight: 600;
            font-size: 13px;
        }
        
        .order-amount {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
        }
        
        .product-summary {
            background: var(--light-gray);
            padding: 12px;
            border-radius: 8px;
            margin: 12px 0;
            font-size: 13px;
            border-left: 3px solid var(--primary);
        }
        
        .take-order-btn {
            background: var(--secondary);
            color: var(--white);
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 12px;
        }
        
        .take-order-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
        }
        
        /* ===== DELIVERY ===== */
        .delivery-details {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid var(--primary);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary);
        }
        
        .detail-value {
            color: var(--medium-gray);
            text-align: right;
            flex: 1;
        }
        
        .delivery-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .delivery-btn {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        
        .done-btn {
            background: var(--secondary);
            color: var(--white);
        }
        
        .done-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
        }
        
        .feedback-btn {
            background: var(--primary);
            color: var(--white);
        }
        
        .feedback-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .feedback-section {
            border-top: 2px solid var(--light-gray);
            padding-top: 18px;
        }
        
        .feedback-section h3 {
            font-size: 14px;
            margin-bottom: 12px;
            color: var(--primary);
        }
        
        .feedback-form {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }
        
        .feedback-input {
            flex: 1;
            min-width: 200px;
            padding: 10px 14px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            font-size: 13px;
            transition: all 0.3s ease;
        }
        
        .feedback-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
        }
        
        .send-feedback-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        .send-feedback-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .feedback-list {
            max-height: 250px;
            overflow-y: auto;
        }
        
        .feedback-item {
            background: var(--white);
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 8px;
            border-left: 4px solid var(--primary);
            font-size: 13px;
        }
        
        .feedback-time {
            font-size: 11px;
            color: var(--medium-gray);
            margin-bottom: 4px;
        }
        
        /* ===== LOADING & ALERTS ===== */
        .loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--white);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            z-index: 3000;
            text-align: center;
            border-top: 4px solid var(--primary);
        }
        
        .loading-spinner {
            width: 36px;
            height: 36px;
            border: 4px solid var(--light-gray);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 12px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .alert {
            position: fixed;
            top: 80px;
            right: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            z-index: 3000;
            transform: translateX(400px);
            transition: all 0.3s ease;
            max-width: 300px;
        }
        
        .alert.show {
            transform: translateX(0);
        }
        
        .alert.success {
            background: var(--secondary);
            color: var(--white);
        }
        
        .alert.error {
            background: #e74c3c;
            color: var(--white);
        }
        
        .alert.warning {
            background: var(--primary);
            color: var(--white);
        }
        
        .alert.info {
            background: var(--primary);
            color: var(--white);
        }
        
        .alert.taken {
            background: var(--primary);
            color: var(--white);
        }
        
        /* ===== NOTIFICATIONS ===== */
        .notifications-container {
            position: fixed;
            top: 70px;
            right: 15px;
            z-index: 2500;
            max-width: 380px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .notification {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-left: 4px solid var(--primary);
            position: relative;
            animation: slideIn 0.3s ease;
            min-width: 300px;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        
        .notification.closing {
            animation: slideOut 0.3s ease forwards;
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .notification-title {
            font-weight: 700;
            font-size: 14px;
            color: var(--dark-gray);
            flex: 1;
        }
        
        .notification-close {
            background: none;
            border: none;
            color: var(--medium-gray);
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .notification-close:hover {
            color: #e74c3c;
            transform: rotate(90deg);
        }
        
        .notification-message {
            font-size: 15px;
            color: #000000;
            margin-bottom: 14px;
            line-height: 1.6;
            font-weight: 600;
        }
        
        .notification-time {
            font-size: 12px;
            color: #444444;
            margin-bottom: 14px;
            font-weight: 500;
        }
        
        /* ===== NOTIFICATION TYPES ===== */
        /* PROMO */
        .notification.promo {
            border-left-color: var(--primary);
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.08) 0%, rgba(230, 126, 34, 0.08) 100%);
        }
        
        .notification.promo .notification-title {
            color: var(--primary);
        }
        
        .notification.promo .notification-message {
            color: #000000;
        }
        
        /* AGENT */
        .notification.agent {
            border-left-color: var(--secondary);
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.08) 0%, rgba(34, 153, 84, 0.08) 100%);
        }
        
        .notification.agent .notification-title {
            color: var(--secondary);
        }
        
        .notification.agent .notification-message {
            color: #000000;
        }
        
        /* DELIVERY_FEEDBACK */
        .notification.delivery_feedback {
            border-left-color: var(--primary);
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.08) 0%, rgba(230, 126, 34, 0.08) 100%);
        }
        
        .notification.delivery_feedback .notification-title {
            color: var(--primary);
        }
        
        .notification.delivery_feedback .notification-message {
            color: #000000;
        }
        
        /* COMMANDE (Order confirmation) */
        .notification.commande {
            border-left-color: var(--secondary);
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.08) 0%, rgba(34, 153, 84, 0.08) 100%);
        }
        
        .notification.commande .notification-title {
            color: var(--secondary);
        }
        
        .notification.commande .notification-message {
            color: #000000;
        }
        
        .notification.unread {
            background-color: rgba(243, 156, 18, 0.08);
        }
        
        .notification-icon {
            display: inline-block;
            margin-right: 8px;
            font-size: 16px;
        }
        
        /* ===== NOTIFICATION BUTTONS ===== */
        .notification-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            flex-wrap: wrap;
        }
        
        .notification-btn {
            flex: 1;
            min-width: 120px;
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            text-align: center;
        }
        
        .take-promo-btn {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 6px rgba(243, 156, 18, 0.2);
        }
        
        .take-promo-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .take-order-notification-btn {
            background: var(--secondary);
            color: white;
            box-shadow: 0 2px 6px rgba(39, 174, 96, 0.2);
            flex: 1.5;
        }
        
        .take-order-notification-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
        }
        
        .mark-read-btn {
            background: var(--light-gray);
            color: var(--primary);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }
        
        .mark-read-btn:hover {
            background: var(--border-color);
            transform: translateY(-2px);
        }
        
        .notification-btn:active {
            transform: translateY(0);
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .notifications-container {
                right: 10px;
                left: 10px;
                max-width: none;
                top: 60px;
            }
            
            .notification {
                min-width: 100%;
                max-width: none;
            }
            
            .notification-actions {
                flex-direction: column;
            }
            
            .notification-btn {
                width: 100%;
                text-align: center;
            }
        }
        
        .notifications-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .notifications-container::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
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

    <!-- Notifications Container -->
    <div id="notificationsContainer" class="notifications-container"></div>

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
                    initNotificationSystem(); // Ajouter cette ligne
                } else {
                    // Redirect to login if not authenticated
                   // window.location.href = 'login.php';
                }
                
            } catch (error) {
                console.error('Erreur lors du chargement des données agent:', error);
                showAlert('Erreur lors du chargement des données', 'error');
                // Redirect to login on error
                setTimeout(() => {
                //    window.location.href = 'login.php';
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
            // Vérifier que data est un objet valide
            if (!data || typeof data !== 'object') {
                showAlert('Format de données invalide reçu du serveur', 'error');
                return;
            }

            // Extraire les données du backend avec sécurité
            const transactions = Array.isArray(data.deliveries) ? data.deliveries : [];
            const stats = (typeof data.stats === 'object' && data.stats) ? data.stats : {};
            
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
            
            // Vérifier que orders est un array valide
            if (!Array.isArray(orders)) {
                ordersList.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: var(--medium-gray);">
                        <div style="font-size: 48px; margin-bottom: 15px;">📦</div>
                        <p>Erreur : Format de données invalide</p>
                    </div>
                `;
                return;
            }

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
                
                groupedOrders[orderId].total_amount += parseFloat(item.price) * parseInt(item.qnt)|| 0;
                groupedOrders[orderId].total_quantity += parseInt(item.qnt)  || 1;
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
                
                if (result.success === true) {
                    showAlert('✅ Commande prise avec succès !', 'success');
                    closeOrdersModal();
                    // Refresh the orders list after a short delay
                    setTimeout(() => openOrdersModal(), 1500);
                } else if (result.status === 'taken') {
                    showAlert('⚠️ ' + result.message, 'taken');
                    // Refresh the orders list to show available orders
                    setTimeout(() => openOrdersModal(), 1500);
                } else {
                    showAlert(result.message || '❌ Erreur lors de la prise de commande', 'error');
                    // Refresh the orders list to show available orders
                    setTimeout(() => openOrdersModal(), 1000);
                }
                
            } catch (error) {
                console.error('Erreur lors de la prise de commande:', error);
                showAlert('❌ Erreur lors de la prise de commande', 'error');
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
                            delivery_id: item.delivery_id,
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
                        <button class="delivery-btn done-btn" onclick="markDeliveryDone('${delivery.order_id}', '${delivery.delivery_id}' )">
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
                        <button class="delivery-btn done-btn" onclick="markDeliveryDone('${deliveryData.order_id}', '${deliveryData.delivery_id}')">
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
                loadDeliveryFeedbacks(deliveryData.order_id);
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
                const response = await fetch('backend/notifications', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
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

        async function markDeliveryDone(orderId, deliveryId) {
            console.log(`Marquer la livraison ${deliveryId} de la commande ${orderId} comme terminée`);
            //orderID is a string deliveryId is intval for the number of delivery place
            if (!confirm('Êtes-vous sûr que la livraison est terminée ? Cette action ne peut pas être annulée.')) {
                return;
            }
            
            showLoading(true);
            
            try {
                const result = await completeDeliveryAPI(orderId, AGENT_UNIQUE_ID, deliveryId);
                
                if (result.success) {
                    // Nettoyer automatiquement les feedbacks localStorage
                    clearDeliveryFeedbacks(orderId);
                    
                    // Afficher le message renvoyé par le backend (ou message par défaut)
                    showAlert('✅ ' + (result.message || 'Livraison terminée ! Messages nettoyés.'), 'success');
                    closeDeliveryModal();
                    currentDelivery = null;
                    
                    // Refresh des données si nécessaire
                } else {
                    // Afficher message d'erreur fourni par le backend si présent
                    showAlert('❌ ' + (result.message || 'Erreur lors de la finalisation de la livraison'), 'error');
                }
                
            } catch (error) {
                console.error('Erreur lors de la finalisation:', error);
                showAlert('❌ Erreur lors de la finalisation de la livraison', 'error');
            } finally {
                showLoading(false);
            }
        }

        async function completeDeliveryAPI(deliveryId, agentId, id) {
            try {
                const response = await fetch(`backend/delivery/status/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        order_id: deliveryId,
                        agent_id: agentId,
                        status: 'completed'
                    })
                });

                // Lire le JSON même en cas d'erreur pour afficher le message backend
                let data = {};
                try {
                    data = await response.json();
                } catch (e) {
                    // body vide ou non JSON
                    data = {};
                }

                if (!response.ok) {
                    // retourner success=false et message backend si fourni
                    return {
                        success: false,
                        message: data.message || `Erreur serveur (${response.status})`,
                        _data: data
                    };
                }

                // Réponse OK
                return {
                    success: (typeof data.success !== 'undefined') ? Boolean(data.success) : true,
                    message: data.message || 'Livraison terminée avec succès',
                    data: data
                };
            } catch (error) {
                console.error('Erreur API completeDelivery:', error);
                return {
                    success: false,
                    message: 'Erreur lors de la communication avec le serveur'
                };
            }
        }

        // ===== AUTO REFRESH =====
        function startAutoRefresh() {
            // Refresh data every 30 seconds - BUT NOT FOR AVAILABILITY
            refreshInterval = setInterval(() => {
                if (!document.hidden) { // Only refresh if page is visible
                    // checkAgentStatus(); // REMOVED - Only check on initial load and after manual toggle
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
                const response = await fetch(`backend/agents/availability/${agentUniqueId}`,
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
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
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
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
                const response = await fetch(`backend/deliveries/agent/${agentId}`,
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                if (!response.ok) {
                    throw new Error('Failed to get agent transactions');
                }
                const data = await response.json();
                
                // Adapter les données backend au format attendu par le frontend
                return {
                    deliveries: Array.isArray(data.lastMonthDeliveries) ? data.lastMonthDeliveries : [],
                    stats: {
                        totalDeliveries: data.nbrsTotalDeliveries || 0,
                        totalAmount: data.totalAmount || 0,
                        completedDeliveries: Array.isArray(data.lastMonthDeliveries) ? data.lastMonthDeliveries.filter(d => d.status === 'completed' || d.status === 1).length : 0
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
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Retourner un array, jamais undefined
                if (Array.isArray(data.orders)) {
                    return data.orders;
                } else if (Array.isArray(data)) {
                    return data;
                } else {
                    return [];
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des commandes disponibles:', error);
                showAlert('Erreur lors du chargement des commandes', 'error');
                return [];
            }
        }

        async function assignOrderToAgentAPI(orderId, agentId) {
            try {
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 seconds timeout

                const response = await fetch('backend/orders/assign', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        agent_id: agentId
                    }),
                    signal: controller.signal
                });

                clearTimeout(timeoutId);

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                
                // ...existing code...
            } catch (error) {
                console.error('Erreur API assignOrder:', error);
                
                let errorMessage = 'Erreur lors de l\'assignation de la commande';
                let errorStatus = 'error';
                
                if (error.name === 'AbortError') {
                    errorMessage = 'Le serveur n\'a pas répondu à temps. Veuillez réessayer.';
                    errorStatus = 'timeout';
                } else if (error instanceof TypeError) {
                    errorMessage = 'Erreur de connexion au serveur. Vérifiez votre connexion internet.';
                    errorStatus = 'connection';
                }
                
                return {
                    success: false,
                    status: errorStatus,
                    message: errorMessage,
                    error: error.message
                };
            }
        }

        async function getCurrentDeliveryAPI(agentId) {
            try {
                const response = await fetch(`backend/deliveries/agent/orderProcess/${agentId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Retourner les données en toute sécurité
                if (Array.isArray(data.deliveries) && data.deliveries.length > 0) {
                    return data.deliveries;
                } else if (Array.isArray(data) && data.length > 0) {
                    return data;
                } else {
                    return null;
                }
            } catch (error) {
                console.error('Erreur lors de la récupération de la livraison en cours:', error);
                showAlert('Erreur lors du chargement de la livraison en cours', 'error');
                return null;
            }
        }

        // ===== NOTIFICATIONS =====
        let notificationCheckInterval = null;
        let activeNotifications = [];
        
        // Initialiser le système de notifications
        function initNotificationSystem() {
            // Charger les notifications immédiatement
            loadNotifications();
            
            // Puis toutes les 30 secondes
            notificationCheckInterval = setInterval(() => {
                if (!document.hidden) {
                    loadNotifications();
                }
            }, 30000);
        }
        
        async function loadNotifications() {
            try {
                const response = await fetch(`backend/notifications/${AGENT_UNIQUE_ID}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Vérifier format backend: {nbrs: 1, notifications: {...}}
                // Le backend retourne un objet unique, pas un array
                if (!data.notifications || data.nbrs === 0) {
                    console.log('Aucune notification');
                    return;
                }
                
                // Traiter la notification - peut être un objet ou un array
                let notificationsArray = Array.isArray(data.notifications) ? data.notifications : [data.notifications];
                
                notificationsArray.forEach(notification => {
                    // Vérifier si la notification n'est pas déjà affichée
                    if (!activeNotifications.find(n => n.id === notification.id)) {
                        displayNotification(notification);
                        activeNotifications.push(notification);
                    }
                });
                
            } catch (error) {
                console.error('Erreur lors du chargement des notifications:', error);
            }
        }
        
        function displayNotification(notification) {
            // ...existing code...
        }

        function closeDeliveryModal() {
            document.getElementById('deliveryModal').style.display = 'none';
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
            if (notificationCheckInterval) {
                clearInterval(notificationCheckInterval);
            }
        });
    </script>
</body>
</html>