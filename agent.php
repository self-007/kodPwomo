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
    <link rel="stylesheet" href="assets/css/notifications-system.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" />
    
    <style>
        /* ===== CUSTOM COLOR PALETTE ===== */
        :root {
            --primary: #f7b642;
            --primary-dark: #e19627;

            --secondary: #27ae60;
            --secondary-dark: #229954;
            --white: #ffffff;
            --dark-gray: #1A1A1A;
            --medium-gray: #666666;
            --light-gray: #F5F5F5;
            --border-color: #E0E0E0;
            --shadow-3d-base: 
            8px 8px 20px rgba(0, 0, 0, 0.10),
            -8px -8px 20px rgba(255, 255, 255, 0.70);

            --shadow-3d-hover:
            16px 16px 32px rgba(0, 0, 0, 0.12),
            -16px -16px 32px rgba(255, 255, 255, 0.80);

            --shadow-3d-active:
            6px 6px 16px rgba(0, 0, 0, 0.08),
            -6px -6px 16px rgba(255, 255, 255, 0.65);

            --depth-tilt: 9deg;
            --depth-tilt-strong: 13deg;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f3f9;
            min-height: 100vh;
            color: var(--dark-gray);
        }
        
        /* ===== HEADER ===== */
        .header {
            background: #ffffff;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);

            border-bottom: 1px solid rgba(0,0,0,0.05);
            backdrop-filter: blur(12px);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-radius: 15px;
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
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            width: fit-content;
            height: 60px;
            
        }
        .logo img {
            height: 100%;
            width: auto;
            max-width: clamp(140px, 25vw, 300px);
            border-radius: 8px;
        }
        
        .agent-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .agent-name {
            font-weight: 600;
            color: var(--primary);
            font-size: 14px;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .logout-btn {
            background: rgba(230, 8, 8, 0.6);
            color: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;

            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
           -3px -3px 8px rgba(255,255,255,0.85);

        }
        
        .logout-btn:hover {
            background: rgba(243, 11, 11, 0.9);
            transform: translateY(-1px);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        }

        /* ===== NAV MENU (Hamburger) ===== */
        .nav {
            position: relative;
        }
        .hamburger-btn {
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 44px;
            height: 44px;
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            box-shadow: 3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85);
        }
        .hamburger-btn span {
            width: 20px;
            height: 2px;
            background: #333;
            margin: 2px 0;
            border-radius: 2px;
        }
        .nav-menu {
            position: absolute;
            right: 0;
            top: 40px;
            min-width: 180px;
            max-width: 90vw;
            max-height: 60vh;
            overflow-y: auto;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 10px;
            box-shadow: 8px 8px 20px rgba(0,0,0,0.10), -8px -8px 20px rgba(255,255,255,0.70);
            backdrop-filter: blur(12px);
            display: none;
            overflow: hidden;
            z-index: 1200;
        }
        .nav-menu.show { display: block; }
        .nav-menu a {
            display: block;
            padding: 10px 14px;
            text-decoration: none;
            color: #234777;
            font-weight: 600;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .nav-menu a:last-child { border-bottom: none; }
        .nav-menu a:hover {
            background: #f5f7fb;
            color: var(--primary);
        }

        /* ===== RESPONSIVE HEADER ===== */
        @media (max-width: 768px) {
            .header-content { gap: 12px; }
            .logo { height: 50px; }
            .logo img { max-width: clamp(120px, 30vw, 240px); }
        }
        @media (max-width: 550px) {
            .header { padding: 10px 0; }
            .logo { height: 44px; }
            .logo img { max-width: clamp(100px, 40vw, 200px); }
            .logout-btn { display: none; }
            .header-content { gap: 12px; }
        }
        
        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
            perspective: 1800px;
            
        }
        
        /* ===== WELCOME SECTION ===== */
        .welcome-section {
            background: rgba(255,255,255,0.92);
            border-radius: 20px;
            padding: 24px 20px;
            box-shadow:
            12px 12px 25px rgba(0, 0, 0, 0.12),
            -12px -12px 25px rgba(255, 255, 255, 0.95);

            margin-bottom: 25px;
            text-align: center;
            /*border-top: 4px solid var(--primary);*/
            position: relative;
            overflow: hidden;

            border-radius: 18px;
            box-shadow:
            10px 10px 22px rgba(0,0,0,0.10),
            -10px -10px 22px rgba(255,255,255,0.95);
        }
        
        .welcome-section::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background:
                linear-gradient(160deg, rgba(255,255,255,0.55) 0%, rgba(255,255,255,0.05) 60%) ;
            mix-blend-mode: overlay;
            pointer-events: none;
            opacity: .75;
            transition: opacity .4s ease;
        }
        
        .welcome-section::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: inherit;
            border: 2px solid rgba(255,255,255,0.35);
            box-shadow: 12px 12px 25px rgba(0, 0, 0, 0.12), -12px -12px 25px rgba(255, 255, 255, 0.95);
            opacity: 0;
            transition: opacity .5s ease;
            pointer-events: none;
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: #234777;
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
            border-radius: 12px;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .status-available {
            background: var(--secondary);
            color: var(--white);
            box-shadow:
            12px 12px 25px rgba(0, 0, 0, 0.12),
            -12px -12px 25px rgba(255, 255, 255, 0.95);

        }
        
        .status-unavailable {
            background: #e74c3c;
            color: var(--white);
            box-shadow: var(--neo-shadow-base);
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
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: var(--neo-shadow-base);
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);

        }
        
        .toggle-status-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        }
        
        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
            margin-top: 30px;
            box-shadow:
            

        }
        
        .action-btn {
            position: relative;
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.45);
            border-radius: 12px;
            padding: 24px 18px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark-gray);
            overflow: hidden;
            transform-style: preserve-3d;
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);
            backdrop-filter: blur(14px);
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
            transform: translateY(-10px) rotateX(5deg) rotateY(-4deg);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        }
        
        .action-btn:hover::before {
            transform: scaleX(1);
        }
        
        .action-btn-icon {
            font-size: 48px;
            margin-bottom: 12px;
            color: #234777;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover .action-btn-icon {
            transform: scale(1.1);
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
            background: rgba(255,255,255,0.92);
            border-radius: 12px;
            padding: 24px;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: var(--neo-shadow-base);
            position: relative;
            width: 100%;
            border-top: 4px solid var(--primary);
            backdrop-filter: blur(14px);
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
            font-size: 32px;
            color: #234777;
            min-height: 40px;
        }
        
        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.92);
            padding: 18px;
            border-radius: 12px;
            text-align: center;
            border: 2px solid var(--border-color);
            /*border-left: 4px solid var(--primary);*/
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
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
        
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-3d-hover);
        }
        
        .stat-card:hover::before {
            transform: scaleX(1);
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
            background: rgba(255,255,255,0.92);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }
        
        .transaction-item::before,
        .order-item::before {
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
        
        .transaction-item:hover, .order-item:hover {
            border-color: var(--primary);
            box-shadow: 10px 10px 20px #bebebe, -10px -10px 20px #ffffff;
            transform: translateY(-10px); /* increase hover lift */
        }
        
        .transaction-item:hover::before,
        .order-item:hover::before {
            transform: scaleX(1);
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .take-order-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        }
        
        /* ===== DELIVERY ===== */
        .delivery-details {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }
        
        .delivery-details::before {
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
        
        .delivery-details:hover::before {
            transform: scaleX(1);
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .done-btn {
            background: var(--secondary);
            color: var(--white);
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);
            box-shadow: var(--neo-shadow-base);
            width: 100%;
            text-align: center;
            font-size: 14px;
            white-space: nowrap;
        }
        
        .done-btn:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        }
        
        .feedback-btn {
            background: var(--primary);
            color: var(--white);
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);

        }
        
        .feedback-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

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
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
           -3px -3px 8px rgba(255,255,255,0.85);
            box-shadow: var(--neo-shadow-base);
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
            box-shadow: var(--neo-shadow-base);
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

        /* ===== FONT AWESOME ICONS ===== */
        i {
            display: inline-block;
        }

        i.fas,
        i.far,
        i.fal,
        i.fad,
        i.fab {
            font-size: inherit;
            line-height: inherit;
        }

        /* ===== ACTION BTN ICONS FIXES ===== */
        .action-btn-icon i,
        .modal-icon i {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: inherit;
        }

        .action-btn-icon i::before,
        .modal-icon i::before {
            display: inline-block;
            font-size: inherit;
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
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            box-shadow: var(--neo-shadow-base);
            border: 1px solid rgba(255,255,255,0.4);
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .alert.show {
            transform: translateX(0);
        }
        
        .alert.success {
            background: linear-gradient(145deg,rgba(39,174,96,0.85),rgba(39,174,96,0.65));
            color:#fff;
        }
        
        .alert.success i {
            color: #fff;
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .alert.error {
            background: linear-gradient(145deg,rgba(231,76,60,0.85),rgba(231,76,60,0.65));
            color:#fff;
        }
        
        .alert.error i {
            color: #fff;
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .alert.warning,
        .alert.info,
        .alert.taken {
            background: linear-gradient(145deg,rgba(243,156,18,0.88),rgba(230,126,34,0.65));
            color:#fff;
        }

        .alert.warning i,
        .alert.info i,
        .alert.taken i {
            color: #fff;
            font-size: 16px;
            flex-shrink: 0;
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
            background: rgba(255,255,255,0.92);
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--shadow-3d-base);
            border-left: 4px solid var(--primary);
            position: relative;
            animation: slideIn 0.3s ease;
            min-width: 300px;
            backdrop-filter: blur(14px);
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
            gap: 10px;
        }

        .notification-header i {
            color: #234777;
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .notification-type {
            font-weight: 700;
            font-size: 13px;
            color: #234777;
            text-transform: capitalize;
            flex: 1;
        }

        .notification-date {
            font-size: 11px;
            color: var(--medium-gray);
            white-space: nowrap;
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

        .notification-content {
            margin-bottom: 12px;
        }

        .notification-actions {
            display: flex;
            gap: 8px;
        }

        .notification-btn {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .close-btn {
            background: #f5f5f5;
            color: var(--medium-gray);
        }

        .close-btn:hover {
            background: #e74c3c;
            color: white;
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
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);

        }
        
        .take-promo-btn {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 6px rgba(243, 156, 18, 0.2);
        }
        
        .take-promo-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-10px);
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
            box-shadow:
            inset 3px 3px 6px rgba(0,0,0,0.25),
            inset -3px -3px 6px rgba(255,255,255,0.70);

        }
        
        /* ===== 3D EFFECTS ===== */
        .depth-3d {
            position: relative;
            background: #f1f3f9;
    
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow-3d-base);
            transform-style: preserve-3d;
            transition: transform .5s cubic-bezier(.19,1,.22,1), box-shadow .4s ease;
            border: 1px solid rgba(255,255,255,0.35);
        }
        
        .depth-3d::after {
            content:'';
            position:absolute;
            inset:0;
            border-radius: inherit;
            background: linear-gradient(145deg,rgba(255,255,255,0.35),rgba(255,255,255,0.05));
            pointer-events:none;
            mix-blend-mode:overlay;
        }
        
        .depth-3d:hover {
            transform: translateY(-8px) rotateX(4deg) rotateY(-3deg);
            box-shadow: var(--shadow-3d-hover);
        }
        
        .depth-3d:active {
            transform: translateY(-2px) scale(.985);
            box-shadow: var(--shadow-3d-base);
            transition: transform .15s ease, box-shadow .25s ease;
        }

        /* Application des effets aux blocs */
        .welcome-section,
        .action-btn,
        .stat-card,
        .transaction-item,
        .order-item,
        .modal-content,
        .delivery-details,
        .product-summary,
        .feedback-item,
        .loading,
        .notification { border-radius:18px; }
        .welcome-section,
        .action-btn,
        .stat-card,
        .transaction-item,
        .order-item,
        .modal-content,
        .delivery-details,
        .product-summary,
        .feedback-item,
        .loading,
        .notification { background: rgba(255,255,255,0.92); box-shadow: var(--shadow-3d-base); backdrop-filter: blur(16px); }

        .action-btn { /* existing overrides + 3D */
            /* ...existing code... */
            border: 1px solid rgba(255,255,255,0.45);
        }
        .action-btn:hover {
            /* ...existing code... */
            box-shadow: 10px 10px 20px #bebebe, -10px -10px 20px #ffffff;
            transform: translateY(-10px) rotateX(5deg) rotateY(-4deg);
        }
        .stat-card:hover,
        .transaction-item:hover,
        .order-item:hover,
        .modal-content:hover,
        .delivery-details:hover,
        .feedback-item:hover,
        .notification:hover {
            box-shadow: var(--shadow-3d-hover);
            transform: translateY(-10px);
        }

        /* Boutons inchangés mais renforcer relief */
        .toggle-status-btn,
        .take-order-btn,
        .done-btn,
        .feedback-btn,
        .send-feedback-btn,
        .take-promo-btn,
        .take-order-notification-btn {
            box-shadow: 0 10px 26px rgba(0,0,0,0.08), 0 18px 50px rgba(255,255,255,0.9);
            transition: transform .5s cubic-bezier(.19,1,.22,1), box-shadow .45s ease;
        }
        .toggle-status-btn:hover,
        .take-order-btn:hover,
        .done-btn:hover,
        .feedback-btn:hover,
        .send-feedback-btn:hover,
        .take-promo-btn:hover,
        .take-order-notification-btn:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow:
            5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);


        }

        /* Notifications spécifiques */
        .notification {
            /* ...existing code... */
            transform: translateZ(0);
        }
        .notification:hover {
            transform: translateY(-6px) scale(1.015);
        }

        /* All alerts 3D */
        .alert {
            background: #f1f3f9;

            backdrop-filter: blur(12px);
            box-shadow: ;
            border: 1px solid rgba(255,255,255,0.4);
            color: var(--dark-gray);
        }
        .alert.success { background: linear-gradient(145deg,rgba(39,174,96,0.85),rgba(39,174,96,0.65)); color:#fff; }
        .alert.error { background: linear-gradient(145deg,rgba(231,76,60,0.85),rgba(231,76,60,0.65)); color:#fff; }
        .alert.warning,
        .alert.info,
        .alert.taken { background: linear-gradient(145deg,rgba(243,156,18,0.88),rgba(230,126,34,0.65)); color:#fff; }

        /* Scrollbar léger */
        .transactions-list::-webkit-scrollbar,
        .orders-list::-webkit-scrollbar,
        .feedback-list::-webkit-scrollbar {
            width:8px;
        }
        .transactions-list::-webkit-scrollbar-thumb,
        .orders-list::-webkit-scrollbar-thumb,
        .feedback-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg,#ffffff,#f0f0f0);
            border-radius:6px;
            border:1px solid rgba(0,0,0,0.05);
        }
        .transactions-list::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg,#fafafa,#eaeaea);
        }

        /* Optional: subtle tilt on pointer move */
        .action-btn {
            transform-style: preserve-3d;
            transition: transform 0.2s ease;
            will-change: transform;
            box-shadow:
            3px 3px 8px rgba(0,0,0,0.18),
            -3px -3px 8px rgba(255,255,255,0.85);

        }
        .action-btn:hover { 
            will-change: transform;
            box-shadow:
             5px 5px 12px rgba(0,0,0,0.20),
            -5px -5px 12px rgba(255,255,255,0.90);

        
        }

        /* JS was incorrectly placed here; moved to <script> below */
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo"> <img src="image/logo/logo1.1.jpg" alt="logo"></div>
            <div class="agent-info">
                <button class="logout-btn" onclick="logout()">Déconnexion</button>
                <nav class="nav">
                    <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu" aria-expanded="false" aria-controls="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="nav-menu" id="navMenu" role="menu">
                        <a href="dashboard.php" role="menuitem">Dashboard</a>
                        <a href="boutique.php" role="menuitem">Boutique</a>
                        <a href="blog.php" role="menuitem">Blog</a>
                        <a href="notifications.php" role="menuitem">Notifications</a>
                        <a href="#restaurant" role="menuitem">Restaurant</a>
                        <a href="index.php" role="menuitem">Home</a>
                        <a href="login.php" role="menuitem" id="logoutLink">Deconnexion</a>
                        
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Welcome Section -->
        <section class="welcome-section box-3d">
            <h1 class="welcome-title"> Bienvenue dans votre espace agent !</h1>
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
            <div class="action-btn box-3d" onclick="openTransactionsModal()">
                <div class="action-btn-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="action-btn-title">Mes Transactions</div>
                <div class="action-btn-desc">Consultez vos livraisons effectuées et votre historique de transactions</div>
            </div>
            
            <div class="action-btn box-3d" onclick="openOrdersModal()">
                <div class="action-btn-icon"><i class="fas fa-box"></i></div>
                <div class="action-btn-title">Commandes Disponibles</div>
                <div class="action-btn-desc">Prenez de nouvelles commandes en attente de confirmation</div>
            </div>
            
            <div class="action-btn box-3d" onclick="openDeliveryModal()">
                <div class="action-btn-icon"><i class="fas fa-truck"></i></div>
                <div class="action-btn-title">Livraison en Cours</div>
                <div class="action-btn-desc">Gérez votre livraison actuelle et communiquez avec le client</div>
            </div>
        </section>
    </main>

    <!-- Transactions Modal -->
    <div id="transactionsModal" class="modal-overlay">
        <div class="modal-content box-3d">
            <button class="modal-close" onclick="closeTransactionsModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon"><i class="fas fa-chart-bar"></i></div>
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
        <div class="modal-content box-3d">
            <button class="modal-close" onclick="closeOrdersModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon"><i class="fas fa-box"></i></div>
                <h2 class="modal-title">Commandes Disponibles</h2>
            </div>
            
            <div id="ordersList" class="orders-list">
                <!-- Available orders will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Current Delivery Modal -->
    <div id="deliveryModal" class="modal-overlay">
        <div class="modal-content box-3d">
            <button class="modal-close" onclick="closeDeliveryModal()">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon"><i class="fas fa-truck"></i></div>
                <h2 class="modal-title">Livraison en Cours</h2>
            </div>
            
            <div id="deliveryContent">
                <!-- Current delivery details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Loading -->
    <div id="loading" class="loading box-3d">
        <div class="loading-spinner"></div>
        <div>Chargement...</div>
    </div>

    <!-- Alert -->
    <div id="alert" class="alert"></div>

    <!-- Notifications Container -->
    <div id="notificationsContainer" class="notifications-container">
        <!-- Items .notification recevront la classe via JS -->
    </div>

    <script src="assets/js/notifications-system.js"></script>
    <script>
        // ===== NAV MENU TOGGLE =====
        (function(){
            const btn = document.getElementById('hamburgerBtn');
            const menu = document.getElementById('navMenu');
            if (btn && menu) {
                btn.addEventListener('click', function(){
                    const isOpen = menu.classList.toggle('show');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
                // Close on outside click
                document.addEventListener('click', function(e){
                    if (!menu.contains(e.target) && !btn.contains(e.target)) {
                        menu.classList.remove('show');
                        btn.setAttribute('aria-expanded','false');
                    }
                });
                // Close on Escape
                document.addEventListener('keydown', function(e){
                    if (e.key === 'Escape') {
                        menu.classList.remove('show');
                        btn.setAttribute('aria-expanded','false');
                    }
                });
            }
        })();

        // ===== Card tilt effect (moved from CSS) =====
        (function(){
            const cards = document.querySelectorAll('.action-btn');
            cards.forEach(card => {
                card.setAttribute('data-tilt','');
                card.addEventListener('mousemove', e => {
                    const r = card.getBoundingClientRect();
                    const x = e.clientX - r.left;
                    const y = e.clientY - r.top;
                    const rotateY = ((x / r.width) - 0.5) * 18;
                    const rotateX = ((y / r.height) - 0.5) * -18;
                    card.style.transform = `translateY(-14px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                });
            });
        })();

        // ===== GLOBAL VARIABLES =====
        let currentAgent = null;
        let agentStatus = false; // false = unavailable, true = available
        let currentDelivery = null;
        let refreshInterval = null;

        // ===== INITIALIZATION =====
        document.addEventListener('DOMContentLoaded', function() {
            loadAgentData();
            startAutoRefresh();
        });

        // ===== API ERROR HANDLER =====
        function handleAPIError(response, data) {
            // Vérifier si status est 401 ou 403
            if (response.status === 401 || response.status === 403) {
                // Rediriger vers login après 5 secondes
                showAlert('Session expirée. Redirection vers login...', 'warning');
                setTimeout(() => {
                    localStorage.removeItem('access_token');
                    window.location.href = 'login.php';
                }, 5000);
                return null;
            }
            
            // Vérifier si data contient un error
            if (data && data.error) {
                return {
                    success: false,
                    message: data.error,
                    error: data.error
                };
            }
            
            return null;
        }

        // ===== AGENT DATA FUNCTIONS =====
        async function loadAgentData() {
            showLoading(true);
            
            try {
                currentAgent = await loadAgentFromAPI();
                
                if (currentAgent) {
                    await checkAgentStatus();
                } else {
                    // Si null, c'est probablement une redirection 401/403 en cours
                    // Ne rien faire, handleAPIError s'en charge
                }
                
            } catch (error) {
                // Si c'est une erreur de redirection 401/403, ne pas afficher d'alerte supplémentaire
                if (error.message && error.message.includes('Session expirée')) {
                    // Déjà géré par handleAPIError
                    return;
                }
                
                console.error('Erreur lors du chargement des données agent:', error);
                showAlert('Erreur lors du chargement des données', 'error');
            } finally {
                showLoading(false);
            }
        }



        async function checkAgentStatus() {
            try {
                // Get agent status from API using authentication token
                const status = await getAgentStatusFromAPI();
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
                // Toggle agent status via API using authentication token
                const newStatus = !agentStatus; // Simple boolean toggle
                const result = await updateAgentStatusAPI(newStatus);
                
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
                const transactions = await getAgentTransactionsAPI();
                displayTransactions(transactions);
                document.getElementById('transactionsModal').style.display = 'block';
                
            } catch (error) {
                console.error('Erreur lors du chargement des transactions:', error);
                showAlert('Erreur lors du chargement des transactions', 'error');
            } finally {
                showLoading(false);
            }
        }
        // Fonction pour calculer le temps d'attente
        function calculateWaitTime(dateTimeString) {
            const createdTime = new Date(dateTimeString);
            const currentTime = new Date();
            const diffMs = currentTime - createdTime;
            const diffSeconds = Math.floor(diffMs / 1000);
            const diffMinutes = Math.floor(diffSeconds / 60);
            const diffHours = Math.floor(diffMinutes / 60);
            
            if (diffHours > 0) {
                const remainingMinutes = diffMinutes % 60;
                return `${diffHours}h ${remainingMinutes}m`;
            } else if (diffMinutes > 0) {
                const remainingSeconds = diffSeconds % 60;
                return `${diffMinutes}m ${remainingSeconds}s`;
            } else {
                return `${diffSeconds}s`;
            }
        }

        function displayTransactions(data) {
            // Vérifier que data est un objet valide
            if (!data || typeof data !== 'object') {
                showAlert('Format de données invalide reçu du serveur', 'error');
                return;
            }

            // Extraire les données du backend avec sécurité
            // La structure est: {nbrsTotalDeliveries, totalAmount, totalEarnedThisMonth, currentMonthDeliveries}
            const transactions = Array.isArray(data.currentMonthDeliveries) ? data.currentMonthDeliveries : 
                                 Array.isArray(data.deliveries) ? data.deliveries : [];
            
            // Récupérer nbrsTotalDeliveries directement du root
            const nbrsTotalDeliveries = data.nbrsTotalDeliveries || 0;
            
            // Vérifier s'il y a une commande en cours (processing)
            const hasProcessingOrder = transactions.some(t => t.status === 'processing');
            
            // Calculer le total complété UNIQUEMENT au front: total - 1 si commande en cours
            const totalCompleted = nbrsTotalDeliveries - (hasProcessingOrder ? 1 : 0);
            
            // Autres stats du backend
            const totalEarnings = data.totalAmount || 0;
            const monthlyEarnings = data.totalEarnedThisMonth || 0;
            
            // Mettre à jour les affichages stats
            const totalDelElem = document.getElementById('totalDeliveries');
            const completedDelElem = document.getElementById('completedDeliveries');
            const totalEarnElem = document.getElementById('totalEarnings');
            const monthlyEarnElem = document.getElementById('monthlyEarnings');
            
            if (totalDelElem) totalDelElem.textContent = nbrsTotalDeliveries;
            if (completedDelElem) completedDelElem.textContent = totalCompleted;
            if (totalEarnElem) totalEarnElem.textContent = (totalEarnings || 0) + ' HTG';
            if (monthlyEarnElem) monthlyEarnElem.textContent = (monthlyEarnings || 0) + ' HTG';
            
            // Afficher la liste des transactions
            const transactionsList = document.getElementById('transactionsList');
            transactionsList.innerHTML = '';
            
            // Cas 1: Aucune transaction
            if (transactions.length === 0) {
                transactionsList.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: var(--medium-gray);">
                        <div style="font-size: 48px; margin-bottom: 15px;"><i class="fas fa-inbox"></i></div>
                        <p>Aucune livraison ce mois-ci</p>
                    </div>
                `;
                return;
            }
            
            // Cas 2: Afficher les transactions
            transactions.forEach(transaction => {
                const item = document.createElement('div');
                item.className = 'transaction-item';
                
                // Déterminer le status et son style
                const statusValue = transaction.status || 'pending';
                const statusClass = (statusValue === 'completed' || statusValue === 1) ? 'status-completed' :
                                   (statusValue === 'pending' || statusValue === 2) ? 'status-pending' : 'status-in-progress';
                
                const statusText = (statusValue === 'completed' || statusValue === 1) ? 'Terminée' :
                                  (statusValue === 'pending' || statusValue === 2) ? 'En attente' : 'En cours';
                
                // Formater la date
                const deliveryDate = transaction.created_at || transaction.date || new Date().toISOString();
                const formattedDate = formatDate(deliveryDate);
                
                // AFFICHER LE TEMPS D'ATTENTE UNIQUEMENT SI STATUS = 'processing'
                let waitTimeHtml = '';
                if (statusValue === 'processing') {
                    const waitTime = calculateWaitTime(deliveryDate);
                    const diffSeconds = Math.floor((new Date() - new Date(deliveryDate)) / 1000);
                    const isOvertime = diffSeconds > 600; // 600s = 10min
                    const overtimeClass = isOvertime ? 'style="color: #ef4444; font-weight: 600;"' : '';
                    waitTimeHtml = `<br><strong>En attente depuis:</strong> <span ${overtimeClass}>${waitTime}</span>`;
                }
                
                item.innerHTML = `
                    <div class="transaction-header">
                        <div class="transaction-id">Livraison #${transaction.id || 'N/A'}</div>
                        <div class="transaction-date">${formattedDate}</div>
                    </div>
                    <div class="transaction-details">
                        <div>
                            <strong>Commande:</strong> ${transaction.id_commande || 'N/A'}<br>
                            <strong>Montant:</strong> ${(transaction.order_price || 0).toFixed(2)} HTG<br>
                            <strong>Commission:</strong> ${(transaction.delivery_price || 0).toFixed(2)} HTG
                            ${waitTimeHtml}
                        </div>
                        <div style="text-align: right;">
                            <div class="transaction-status ${statusClass}">${statusText}</div>
                            <div style="margin-top: 10px; font-weight: 600;">
                                Total: ${((transaction.order_price || 0) + (transaction.delivery_price || 0)).toFixed(2)} HTG
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
                        <div style="font-size: 48px; margin-bottom: 15px;"><i class="fas fa-box"></i></div>
                        <p>Erreur : Format de données invalide</p>
                    </div>
                `;
                return;
            }

            if (orders.length === 0) {
                ordersList.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: var(--medium-gray);">
                        <div style="font-size: 48px; margin-bottom: 15px;"><i class="fas fa-box"></i></div>
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
                        date: item.date,  // Stocker la date
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
                
                // Calculer le temps d'attente
                const waitTime = order.date ? calculateWaitTime(order.date) : 'N/A';
                const diffSeconds = order.date ? Math.floor((new Date() - new Date(order.date)) / 1000) : 0;
                const isOvertime = diffSeconds > 600; // 600s = 10min
                const overtimeClass = isOvertime ? 'style="color: #ef4444; font-weight: 600;"' : '';
                
                item.innerHTML = `
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-id">Commande #${order.order_id}</div>
                            <div class="order-university">${order.university_name}</div>
                        </div>
                        <div class="order-total">
                            <div class="order-amount">${order.total_amount} HTG</div>
                            <div style="font-size: 12px; color: var(--medium-gray); margin-top: 5px;">
                                En attente depuis: <span ${overtimeClass}>${waitTime}</span>
                            </div>
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
                        <i class="fas fa-truck"></i> Prendre cette commande
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
                const result = await assignOrderToAgentAPI(orderId);
                
                if (result.success === true) {
                    showAlert('Commande prise avec succès !', 'success');
                    closeOrdersModal();
                    // Refresh the orders list after a short delay
                    setTimeout(() => openOrdersModal(), 1500);
                } else if (result.status === 'taken') {
                    showAlert(result.message, 'taken');
                    // Refresh the orders list to show available orders
                    setTimeout(() => openOrdersModal(), 1500);
                } else {
                    showAlert(result.message || 'Erreur lors de la prise de commande', 'error');
                    // Refresh the orders list to show available orders
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
                const delivery = await getCurrentDeliveryAPI();
                
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
                            delivery_date: item.created_at || item.date || new Date().toISOString(),
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
                            <span class="detail-label">En cours depuis:</span>
                            <span class="detail-value" style="color: #ef4444; font-weight: 600;">${calculateWaitTime(delivery.delivery_date)}</span>
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
                            <i class="fas fa-check-circle"></i> Terminé
                        </button>
                        <button class="delivery-btn feedback-btn" onclick="showFeedbackForm()">
                            <i class="fas fa-comment"></i> Envoyer Feedback
                        </button>
                    </div>
                    
                    <div class="feedback-section">
                        <h3 style="margin-bottom: 15px;"><i class="fas fa-comments"></i> Communication Client</h3>
                        
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
                            <i class="fas fa-check-circle"></i> Terminé
                        </button>
                        <button class="delivery-btn feedback-btn" onclick="showFeedbackForm()">
                            <i class="fas fa-comment"></i> Envoyer Feedback
                        </button>
                    </div>
                    
                    <div class="feedback-section">
                        <h3 style="margin-bottom: 15px;"><i class="fas fa-comments"></i> Communication Client</h3>
                        
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
                        order_id: orderId,
                        type: 'delivery_feedback'
                    })
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || `Erreur serveur ${response.status}`);
                }
                
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
                const result = await completeDeliveryAPI(orderId, deliveryId);
                
                if (result.success) {
                    // Nettoyer automatiquement les feedbacks localStorage
                    clearDeliveryFeedbacks(orderId);
                    
                    // Afficher le message renvoyé par le backend (ou message par défaut)
                    showAlert(result.message || 'Livraison terminée ! Messages nettoyés.', 'success');
                    closeDeliveryModal();
                    currentDelivery = null;
                    
                    // Refresh des données si nécessaire
                } else {
                    // Afficher message d'erreur fourni par le backend si présent
                    showAlert(result.message || 'Erreur lors de la finalisation de la livraison', 'error');
                }
                
            } catch (error) {
                console.error('Erreur lors de la finalisation:', error);
                showAlert('Erreur lors de la finalisation de la livraison', 'error');
            } finally {
                showLoading(false);
            }
        }

        async function completeDeliveryAPI(deliveryId, deliveryRecordId) {
            try {
                await enforceThrottleDelay();
                const response = await fetch(`backend/delivery/status/${deliveryRecordId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        order_id: deliveryId,
                        status: 'completed'
                    })
                });

                // Lire le JSON même en cas d'erreur pour afficher le message backend
                let data = {};
                try {
                    data = await response.json();
                } catch (e) {
                    data = {};
                }
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) {
                    return {
                        success: false,
                        message: errorResponse.message,
                        error: errorResponse.error
                    };
                }
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;

                if (!response.ok) {
                    return {
                        success: false,
                        message: data.message || data.error || `Erreur serveur (${response.status})`,
                        _data: data
                    };
                }

                return {
                    success: (typeof data.success !== 'undefined') ? Boolean(data.success) : true,
                    message: data.message || 'Livraison terminée avec succès',
                    data: data
                };
            } catch (error) {
                console.error('Erreur API completeDelivery:', error);
                return {
                    success: false,
                    message: 'Erreur lors de la communication avec le serveur',
                    error: error.message
                };
            }
        }

        // ===== AUTO REFRESH =====
        function startAutoRefresh() {
            // Refresh data every 30 seconds - BUT NOT FOR AVAILABILITY
            refreshInterval = setInterval(() => {
                if (!document.hidden) { // Only refresh if page is visible
                    checkAgentStatus(); // REMOVED - Only check on initial load and after manual toggle
                }
            }, 30000);
        }

        // ===== UTILITY FUNCTIONS =====
        // ===== THROTTLING SYSTÈME is loaded from notifications-system.js =====
        // REQUEST_THROTTLE_MS, lastRequestTime, isThrottled, and enforceThrottleDelay() 
        // are defined in assets/js/notifications-system.js

        // ===== LOADING STATE MANAGEMENT =====
        let loadingStartTime = 0;
        const MINIMUM_LOADING_TIME = 5000; // 5 secondes minimum
        
        function showLoading(show) {
            const loadingElement = document.getElementById('loading');
            if (!loadingElement) return;
            
            if (show) {
                // Afficher le loader et enregistrer l'heure
                loadingElement.style.display = 'block';
                loadingStartTime = Date.now();
                
                // Désactiver tous les boutons qui font des requêtes
                const requestButtons = document.querySelectorAll('button[onclick*="Agent"], button[onclick*="toggle"], button[onclick*="open"], button[onclick*="assign"], button[onclick*="mark"], .available-btn, .order-btn, [data-action], .modal-btn, [role="menuitem"]');
                requestButtons.forEach(btn => {
                    btn.disabled = true;
                    btn.style.opacity = '0.5';
                    btn.style.cursor = 'not-allowed';
                    btn.dataset.wasDisabled = 'true'; // Marquer comme désactivé par le throttle
                });
            } else {
                // Vérifier si 5 secondes se sont écoulées
                const elapsedTime = Date.now() - loadingStartTime;
                const remainingTime = MINIMUM_LOADING_TIME - elapsedTime;
                
                if (remainingTime > 0) {
                    // Attendre le temps restant avant de fermer le loader
                    setTimeout(() => {
                        loadingElement.style.display = 'none';
                        // Réactiver les boutons
                        const requestButtons = document.querySelectorAll('button[data-was-disabled="true"]');
                        requestButtons.forEach(btn => {
                            btn.disabled = false;
                            btn.style.opacity = '1';
                            btn.style.cursor = 'pointer';
                            delete btn.dataset.wasDisabled;
                        });
                    }, remainingTime);
                } else {
                    // 5 secondes déjà écoulées, fermer immédiatement
                    loadingElement.style.display = 'none';
                    const requestButtons = document.querySelectorAll('button[data-was-disabled="true"]');
                    requestButtons.forEach(btn => {
                        btn.disabled = false;
                        btn.style.opacity = '1';
                        btn.style.cursor = 'pointer';
                        delete btn.dataset.wasDisabled;
                    });
                }
            }
        }

        function showAlert(message, type = 'success') {
            const alert = document.getElementById('alert');
            
            // Vider l'alerte
            alert.innerHTML = '';
            
            // Créer un map des icônes selon le type
            const iconMap = {
                'success': 'fa-check-circle',
                'error': 'fa-times-circle',
                'warning': 'fa-exclamation-triangle',
                'info': 'fa-info-circle',
                'taken': 'fa-exclamation-triangle'
            };
            
            // Ajouter l'icône si le message contient une balise <i>
            if (message.includes('<i class=')) {
                // Extraire et créer l'icône
                const iconMatch = message.match(/class="([^"]+)"/);
                const messageText = message.replace(/<i class="[^"]*"><\/i>\s*/g, '');
                
                const icon = document.createElement('i');
                icon.className = iconMatch ? iconMatch[1] : `fas ${iconMap[type] || 'fa-info'}`;
                
                alert.appendChild(icon);
                alert.appendChild(document.createTextNode(' ' + messageText));
            } else {
                // Ajouter une icône par défaut selon le type
                const icon = document.createElement('i');
                icon.className = `fas ${iconMap[type] || 'fa-info'}`;
                
                alert.appendChild(icon);
                alert.appendChild(document.createTextNode(' ' + message));
            }
            
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
            // Using your backend - obtener datos de disponibilité et stats de livraison
            try {
                const response = await fetch('backend/deliveries/agent', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null, donc on n'arrive pas ici
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors du chargement du profil');
                }
                
                // Retourner les données du backend
                return data;
            } catch (error) {
                console.error('Erreur lors du chargement du profil agent:', error);
                throw error;
            }
        }

        async function getAgentStatusFromAPI() {
            try {
                await enforceThrottleDelay();
                const response = await fetch(`backend/agents/availability`,
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de la récupération du statut');
                }
                
                return {
                    is_available: Boolean(data.is_available)
                };
            } catch (error) {
                throw error;
            }
        }

        async function updateAgentStatusAPI(isAvailable) {
            try {
                await enforceThrottleDelay();
                const response = await fetch('backend/agents/availability', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        isAvailable: isAvailable
                    })
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de la mise à jour du statut');
                }
                
                return data;
            } catch (error) {
                throw error;
            }
        }

        async function getAgentTransactionsAPI() {
            try {
                await enforceThrottleDelay();
                const response = await fetch(`backend/deliveries/agent`,
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de la récupération des transactions');
                }
                
                // Retourner les données brutes du backend directement
                // Structure: {nbrsTotalDeliveries, totalAmount, totalEarnedThisMonth, currentMonthDeliveries}
                return data;
            } catch (error) {
                throw error;
            }
        }

        async function getAvailableOrdersAPI() {
            try {
                await enforceThrottleDelay();
                const response = await fetch('backend/orders/available', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || `Erreur serveur ${response.status}`);
                }
                
                // Retourner un array, jamais undefined
                if (Array.isArray(data.orders)) {
                    return data.orders;
                } else if (Array.isArray(data)) {
                    return data;
                } else {
                    throw new Error('Format de données invalide du serveur');
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des commandes disponibles:', error);
                showAlert('Erreur lors du chargement des commandes', 'error');
                throw error;
            }
        }



        async function assignOrderToAgentAPI(orderId) {
            try {
                await enforceThrottleDelay();
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 10000);

                const response = await fetch('backend/orders/assign', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                    }),
                    signal: controller.signal
                });

                clearTimeout(timeoutId);
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 (redirection)
                if (response.status === 401 || response.status === 403) {
                    handleAPIError(response, data);
                    return null;
                }
                
                // Si data.error existe, retourner l'erreur (pas de throw)
                if (data.error) {
                    return {
                        success: false,
                        status: data.status || 'error',
                        message: data.error,
                        error: data.error
                    };
                }

                if (!response.ok) {
                    return {
                        success: false,
                        status: 'error',
                        message: data.message || `Erreur serveur ${response.status}`,
                        error: data.message || `Erreur serveur ${response.status}`
                    };
                }

                return data;
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
                } else {
                    errorMessage = error.message || errorMessage;
                }
                
                return {
                    success: false,
                    status: errorStatus,
                    message: errorMessage,
                    error: errorMessage
                };
            }
        }

        async function getCurrentDeliveryAPI() {
            try {
                await enforceThrottleDelay();
                const response = await fetch(`backend/deliveries/agent/orderProcess`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    }
                });
                
                const data = await response.json();
                
                // Vérifier les erreurs 401/403 et data.error
                const errorResponse = handleAPIError(response, data);
                if (errorResponse !== null) throw new Error(errorResponse.message);
                
                // Si 401/403, handleAPIError redirige et retourne null
                if (response.status === 401 || response.status === 403) return null;
                
                if (!response.ok) {
                    throw new Error(data.message || `Erreur serveur ${response.status}`);
                }
                
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
        // Sistema de notificaciones cargado desde assets/js/notifications-system.js
        // Se inicializa automáticamente si hay access_token en localStorage

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
        // Appliquer .box-3d aux listes dynamiques après rendu
        function enhance3D() {
            document.querySelectorAll('.transaction-item, .order-item, .feedback-item, .notification, .stat-card, .delivery-details, .product-summary')
                .forEach(el => el.classList.add('box-3d'));
        }
        // Tilt dynamique sur .action-btn
        function initTilt() {
            document.querySelectorAll('.action-btn.box-3d').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const r = card.getBoundingClientRect();
                    const x = e.clientX - r.left;
                    const y = e.clientY - r.top;
                    const rotateY = ((x / r.width) - 0.5) * 22;
                    const rotateX = ((y / r.height) - 0.5) * -22;
                    card.style.transform = `translateY(-18px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                });
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            enhance3D();
            initTilt();
        });
        // Après mises à jour dynamiques (ex: listes)
        function afterDataRender() {
            enhance3D();
        }
        // Intégrer afterDataRender dans displayTransactions / displayAvailableOrders / displayCurrentDelivery
    </script>
    
    <?php include 'heartbeat.php'; ?>
</body>
</html>