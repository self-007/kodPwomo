<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kodPwomo - Boutique Campus | Livraison Étudiante en Haïti</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Boutique kodPwomo - Commandez vos produits favoris et recevez-les directement sur votre campus universitaire en Haïti. Livraison rapide entre étudiants.">
    <meta name="keywords" content="boutique étudiante, livraison campus, université haïti, kodPwomo, commande en ligne, livraison rapide">
    <meta name="author" content="kodPwomo Team">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="kodPwomo - Boutique Campus">
    <meta property="og:description" content="Commandez et recevez vos produits directement sur votre campus universitaire">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kodpwomo.com/boutique">
    <meta property="og:image" content="assets/images/boutique-preview.jpg">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "OnlineStore",
        "name": "kodPwomo Boutique",
        "description": "Boutique en ligne pour livraison campus-to-campus en Haïti",
        "url": "https://kodpwomo.com/boutique",
        "currenciesAccepted": "HTG",
        "paymentAccepted": "Cash, Mobile Payment"
    }
    </script>
    
    <link rel="stylesheet" href="assets/css/kodpwomo-colors.css">
    <link rel="stylesheet" href="assets/css/notifications-system.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="canonical" href="https://kodpwomo.com/boutique">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fff5f0 0%, #f0f4ff 100%);
            min-height: 100vh;
            color: #1a1a2e;
        }
        
        /* ===== COLOR PALETTE (Unified with Agent page) ===== */
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
            --shadow-3d-base: 8px 8px 20px rgba(0, 0, 0, 0.10), -8px -8px 20px rgba(255, 255, 255, 0.70);
            --shadow-3d-hover: 16px 16px 32px rgba(0, 0, 0, 0.12), -16px -16px 32px rgba(255, 255, 255, 0.80);
        }
        
        /* ===== HEADER (Unified + Neumorphism) ===== */
        .header {
            background: #ffffff;
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-radius: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
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
            display: flex;
            align-items: center;
            height: 60px;
        }
        .logo img {
            height: 100%;
            width: auto;
            max-width: clamp(140px, 25vw, 300px);
            border-radius: 8px;
        }

        /* Hamburger menu (header) */
        .nav { position: relative; }
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
            top: 44px;
            min-width: 200px;
            max-width: 90vw;
            max-height: 60vh;
            overflow-y: auto;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 10px;
            box-shadow: var(--shadow-3d-base);
            backdrop-filter: blur(12px);
            display: none;
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
        .nav-menu a:hover { background: #f5f7fb; color: var(--primary); }
        
        .cart-btn {
            background: linear-gradient(135deg, #FF6B35, #D84315);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            display: none;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
        }
        
        .cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 107, 53, 0.6);
        }
        
        .cart-count {
            background: white;
            color: #FF6B35;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }
        
        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        /* ===== UNIVERSITIES SECTION ===== */
        .universities-section {
            text-align: center;
            color: #234777;
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: #234777;
            margin-bottom: 15px;
        }
        
        .section-subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        
        .universities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-top: 20px;
        }
        
        .university-card {
            background: rgba(255,255,255,0.92);
            border-radius: 15px;
            padding: 12px;
            box-shadow: var(--shadow-3d-base);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.45);
        }
        
        .university-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-3d-hover);
            border-color: var(--primary);
        }
        
        .university-image {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        
        .university-name {
            font-size: 14px;
            font-weight: 700;
            color: #234777;
            margin-bottom: 6px;
        }
        
        .university-location {
            color: #6b7280;
            font-size: 10px;
        }
        
        /* ===== PRODUCTS SECTION ===== */
        .products-section {
            display: none;
        }
        
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .back-btn {
            background: #f8f9fa;
            color: #1a1a2e;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: #e2e8f0;
            color: #FF6B35;
        }
        
        .university-info {
            text-align: center;
            flex: 1;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }
        
        .product-card {
            background: rgba(255,255,255,0.92);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-3d-base);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.45);
        }
        
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-3d-hover);
        }
        @media (max-width: 310px)  {
            .product-price {
                font-size: 12px;
                font-weight: 600;
                color: red;
                margin-bottom: 6px;
            }
            
            .product-image {
                width: 100%;
                height: 90px;
                object-fit: cover;
            }

            .product-name {
                font-size: 10px;
                font-weight: 600;
                color: #234777;
                margin-bottom: 6px;
            }
        
        }
        
        .product-image {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }
        
        .product-info {
            padding: 12px;
        }
        
        .product-name {
            font-size: 12px;
            font-weight: 700;
            color: #234777;
            margin-bottom: 6px;
        }
        
        .product-price {
            font-size: 10px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 6px;
            background-color: #ffebebff;
        }
        
        .product-stock {
            color: var(--success);
            font-size: 14px;
            font-weight: 600;
        }
        
        .product-stock.low {
            color: var(--warning);
        }
        
        .product-stock.out {
            color: var(--error);
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
        
        /* ===== PRODUCT MODAL ===== */
        .product-modal-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }
        
        .product-modal-image {
            width: 100%;
            border-radius: 15px;
        }
        
        .product-modal-info h2 {
            font-size: 28px;
            color: var(--dark-gray);
            margin-bottom: 15px;
        }
        
        .product-modal-price {
            font-size: 32px;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .product-description {
            color: var(--medium-gray);
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .quantity-selector {
            margin-bottom: 25px;
        }
        
        .quantity-label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-gray);
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #FF6B35;
            background: white;
            color: #FF6B35;
            border-radius: 50%;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background: #FF6B35;
            color: white;
        }
        
        .add-to-cart-btn {
            background: linear-gradient(135deg, #FF6B35, #D84315);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.5);
        }
        
        /* ===== CART MODAL ===== */
        .cart-modal .modal-content {
            width: 600px;
        }
        
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .cart-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-gray);
        }
        
        .clear-cart-btn {
            background: var(--error);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .cart-items {
            margin-bottom: 25px;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .cart-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .cart-item-info {
            flex: 1;
        }
        
        .cart-item-name {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 5px;
        }
        
        .cart-item-price {
            color: var(--primary);
            font-weight: 700;
        }
        
        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .remove-item-btn {
            background: var(--error);
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .cart-summary {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            border-top: 2px solid var(--medium-gray);
            padding-top: 10px;
            margin-top: 15px;
            color: var(--primary);
        }
        
        .checkout-btn {
            background: linear-gradient(135deg, #1ABC9C, #16A085);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 188, 156, 0.5);
        }
        
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: var(--medium-gray);
        }
        
        .empty-cart-icon {
            font-size: 64px;
            margin-bottom: 15px;
        }
        
        /* ===== LOADING ===== */
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
        
        /* ===== ALERTS ===== */
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
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 15px;
                gap: 12px;
            }
            
            .logo { height: 50px; }
            .logo img { max-width: clamp(120px, 30vw, 240px); }
            
            .main-container {
                padding: 20px 15px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
            .section-subtitle {
                font-size: 16px;
            }
            
            .universities-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
            
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
            
            .products-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .product-modal-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .cart-modal .modal-content {
                width: 95vw;
                margin: 20px;
            }
            
            .modal-content {
                padding: 20px;
                margin: 10px;
            }
            
            .cart-item {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .cart-item-controls {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 550px) {
            .logo { height: 44px; }
            .logo img { max-width: clamp(100px, 40vw, 200px); }
        }
        @media (max-width: 480px) {
            .university-card {
                padding: 10px;
            }
            
            .product-card {
                margin-bottom: 12px;
            }
            
            .quantity-controls {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .cart-btn {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 410px) {
            .header-content .cart-btn:not(.cart-btn-fixed) {
                display: none !important;
            }
            #cartBtn {
                display: none !important;
            }
        }
        @media (min-width: 410px){
            .cart-btn-fixed {
                display: none !important;
            }
        }
        /* Fixed cart button - always hidden by default, shown via JS when needed and screen < 410px */
        .cart-btn-fixed {
            display: none;
            position: fixed;
            top: 250px;
            right: 10px;
            z-index: 15000;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            border-radius: 50px;
            padding: 12px 18px;
        }
        
        /* ===== CATEGORIES BAR ===== */
        .categories-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
            padding: 15px;
            background: rgba(255,255,255,0.92);
            border-radius: 15px;
            box-shadow: var(--shadow-3d-base);
        }
        
        .category-btn {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
            padding: 10px 18px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85);
        }
        
        .category-btn:hover {
            border-color: #FF6B35;
            color: #FF6B35;
            background: rgba(255, 107, 53, 0.05);
        }
        
        .category-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* ===== CATEGORIES BURGER (Mobile/Tablet) ===== */
        .categories-burger { margin: 10px 0; }
        .burger-btn {
            background: #fff;
            color: #234777;
            border: 1px solid rgba(0,0,0,0.15);
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 3px 3px 8px rgba(0,0,0,0.12), -3px -3px 8px rgba(255,255,255,0.85);
        }
        .categories-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            display: none;
            z-index: 2000;
        }
        .categories-menu-overlay.show { display: block; }
        .categories-menu-overlay .menu-content {
            position: absolute;
            right: 12px;
            top: 80px;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 12px;
            padding: 10px;
            min-width: 220px;
            max-width: 90vw;
            max-height: 60vh;
            overflow-y: auto;
            box-shadow: var(--shadow-3d-base);
        }
        
        /* ===== PRODUCT CARD ===== */
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 107, 53, 0.15);
        }
        
        /* ===== TAILWIND CSS STYLES ===== */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom scrollbar for WebKit browsers */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #FF6B35, #004E89);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #D84315, #003566);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo"><img src="image/logo/logo1.1.jpg" alt="kodpwomo"></div>
            <!-- Cart Button (Hidden initially) -->
            <button id="cartBtn" class="cart-btn">
                🛒 
                <span id="cartCount" class="cart-count">0</span>
            </button>
            <!-- Fixed cart button for small screens -->
            <button id="cartBtnFixed" class="cart-btn cart-btn-fixed" style="display:none;">
                🛒
                <span id="cartCountFixed" class="cart-count">0</span>
            </button>
            <nav class="nav">
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu" aria-expanded="false" aria-controls="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="nav-menu" id="navMenu" role="menu">
                    <a href="index.php" role="menuitem">Accueil</a>
                    <a href="blog.php" role="menuitem">Blog</a>
                    <a href="boutique.php" role="menuitem">Boutique</a>
                    <a href="dashboard_user/dashboard.php" role="menuitem">Dashboard</a>
                    <a href="agent.php" role="menuitem">Restaurant</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Universities Section -->
        <section id="universitiesSection" class="universities-section">
            <h1 class="section-title"> Choisissez votre université</h1>
            <p class="section-subtitle">
                Sélectionnez votre campus pour découvrir les produits disponibles et profiter de la livraison rapide entre étudiants !
            </p>
            
            <div id="universitiesGrid" class="universities-grid">
                <!-- Universities will be loaded here -->
            </div>
        </section>

        <!-- Products Section (Hidden initially) -->
        <section id="productsSection" class="products-section">
            <div class="products-header">
                <button id="backBtn" class="back-btn">
                    ← Retour aux universités
                </button>
                <div class="university-info">
                    <h2 id="currentUniversityName" class="section-title"></h2>
                    <p class="section-subtitle">Découvrez nos produits disponibles sur ce campus</p>
                </div>
            </div>
            <!-- Barre de catégories (PC) -->
            <nav id="categoriesBar" class="categories-bar" style="display:none;"></nav>
            <!-- Menu burger (mobile/tablette) -->
            <div id="categoriesBurger" class="categories-burger" style="display:none;">
                <button id="openCategoriesMenu" class="burger-btn">☰ Catégories</button>
                <div id="categoriesMenu" class="categories-menu-overlay"></div>
            </div>
            <div id="productsGrid" class="products-grid">
                <!-- Products will be loaded here -->
            </div>
        </section>
    </main>

    <!-- Product Detail Modal -->
    <div id="productModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeProductModal()">&times;</button>
            
            <div class="product-modal-content">
                <img id="modalProductImage" class="product-modal-image" src="" alt="">
                
                <div class="product-modal-info">
                    <h2 id="modalProductName"></h2>
                    <div id="modalProductPrice" class="product-modal-price"></div>
                    <p id="modalProductDescription" class="product-description"></p>
                    
                    <div class="quantity-selector">
                        <label class="quantity-label">Quantité :</label>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                            <input type="number" id="quantityInput" class="quantity-input" value="1" min="1" max="1">
                            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    
                    <button id="addToCartBtn" class="add-to-cart-btn" onclick="addToCart()">
                        🛒 Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div id="cartModal" class="modal-overlay cart-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCartModal()">&times;</button>
            
            <div class="cart-header">
                <h2 class="cart-title">🛒 Votre Panier</h2>
                <button class="clear-cart-btn" onclick="clearCart()">Vider le panier</button>
            </div>
            
            <div id="cartItems" class="cart-items">
                <!-- Cart items will be displayed here -->
            </div>
            
            <!-- Sélection de la salle de livraison -->
            <div id="deliveryLocation" class="delivery-location" style="margin: 20px 0; padding: 15px; border: 1px solid var(--primary-color); border-radius: 8px; background: rgba(0, 255, 204, 0.05);">
                <h3 style="margin: 0 0 10px 0; color: var(--primary-color);">📍 Lieu de livraison</h3>
                <div style="margin-bottom: 10px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Université :</label>
                    <span id="selectedUniversity" style="color: var(--primary-color);">Sélectionnez une université</span>
                </div>
                <div>
                    <label for="deliveryPlace" style="display: block; margin-bottom: 5px; font-weight: 600;">Salle/Lieu :</label>
                    <select id="deliveryPlace" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; background: white;">
                        <option value="">Choisissez d'abord une université</option>
                    </select>
                </div>
            </div>
            
            <div id="cartSummary" class="cart-summary">
                <div class="summary-row">
                    <span>Sous-total produits :</span>
                    <span id="subtotalPrice">0 HTG</span>
                </div>
                <div class="summary-row">
                    <span>Frais de livraison :</span>
                    <span id="deliveryPrice">50 HTG</span>
                </div>
                <div class="summary-row total">
                    <span>Total :</span>
                    <span id="totalPrice">50 HTG</span>
                </div>
            </div>
            
            <button class="checkout-btn" onclick="checkout()">
                💳 Passer la commande
            </button>
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
        // ===== NAV MENU TOGGLE (Header) =====
        (function(){
            const btn = document.getElementById('hamburgerBtn');
            const menu = document.getElementById('navMenu');
            if (btn && menu) {
                btn.addEventListener('click', function(){
                    const isOpen = menu.classList.toggle('show');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
                document.addEventListener('click', function(e){
                    if (!menu.contains(e.target) && !btn.contains(e.target)) {
                        menu.classList.remove('show');
                        btn.setAttribute('aria-expanded','false');
                    }
                });
                document.addEventListener('keydown', function(e){
                    if (e.key === 'Escape') {
                        menu.classList.remove('show');
                        btn.setAttribute('aria-expanded','false');
                    }
                });
            }
        })();

        // ===== GLOBAL VARIABLES =====
        let currentUniversity = null;
        let currentProduct = null;
        let cart = JSON.parse(localStorage.getItem('kodpwomo_cart')) || [];

        // ===== INITIALIZATION =====
        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
            loadUniversities();
            
            // Event listeners
            document.getElementById('backBtn').addEventListener('click', backToUniversities);
            document.getElementById('cartBtn').addEventListener('click', openCartModal);
            document.getElementById('cartBtnFixed').addEventListener('click', openCartModal);
            
            // Close modals on background click
            document.getElementById('productModal').addEventListener('click', function(e) {
                if (e.target === this) closeProductModal();
            });
            
            document.getElementById('cartModal').addEventListener('click', function(e) {
                if (e.target === this) closeCartModal();
            });
        });

        // ===== UNIVERSITY FUNCTIONS =====
        async function loadUniversities() {
            showLoading(true);
            
            try {
                const universities = await loadUniversitiesFromAPI();
                displayUniversities(universities);
            } catch (error) {
                console.error('Erreur lors du chargement des universités:', error);
                showAlert('Erreur lors du chargement des universités', 'error');
            } finally {
                showLoading(false);
            }
        }

        function displayUniversities(universities) {
            const grid = document.getElementById('universitiesGrid');
            grid.innerHTML = '';

            universities.forEach(university => {
                const card = document.createElement('div');
                card.className = 'university-card';
                card.onclick = () => selectUniversity(university);
                
                // Use your backend structure: id, name, zone, image
                card.innerHTML = `
                    <img src="${university.image || 'https://via.placeholder.com/400x200/FF6B6B/FFFFFF?text=' + encodeURIComponent(university.name)}" 
                         alt="${university.name}" class="university-image" 
                         onerror="this.src='https://via.placeholder.com/400x200/FF6B6B/FFFFFF?text=' + encodeURIComponent('${university.name}')">
                    <h3 class="university-name">${university.name}</h3>
                    <p class="university-location">${university.Zone}</p>
                `;
                
                grid.appendChild(card);
            });
        }

    async function selectUniversity(university) {
            currentUniversity = university;
            
            // Stocker l'ID et le nom de l'université dans localStorage
            localStorage.setItem('selectedUniversityId', university.id);
            localStorage.setItem('selectedUniversityName', university.name);
            
            showLoading(true);
            

            try {
                // Charger les catégories et les produits
                const categories = await loadCategoriesByUniversityFromAPI(university.id);
                window.currentCategories = categories;
                
                // Charger tous les produits une seule fois
                await loadProductsByUniversityFromAPI(university.id);
                
                // Afficher la barre ou le menu burger selon la taille d'écran
                showCategoriesUI(categories);
                
                // Par défaut, sélectionner la catégorie "Nourriture" si elle existe, sinon la première
                let defaultCategory = categories.find(cat => cat.name.toLowerCase().includes('nourriture')) || categories[0];
                if (defaultCategory) {
                    await selectCategory(defaultCategory);
                } else {
                    displayProducts([]);
                }
                
                // Switch to products view
                document.getElementById('universitiesSection').style.display = 'none';
                document.getElementById('productsSection').style.display = 'block';
                document.getElementById('currentUniversityName').textContent = university.name;
            } catch (error) {
                console.error('Erreur lors du chargement des catégories:', error);
                showAlert('Erreur lors du chargement des catégories', 'error');
            } finally {
                showLoading(false);
            }
        }

        function backToUniversities() {
            document.getElementById('productsSection').style.display = 'none';
            document.getElementById('universitiesSection').style.display = 'block';
            currentUniversity = null;
            
            // Nettoyer le localStorage
            localStorage.removeItem('selectedUniversityId');
            localStorage.removeItem('selectedUniversityName');
        }

        // ===== PRODUCT FUNCTIONS =====
        function displayProducts(products) {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            products.forEach(product => {
                const card = document.createElement('div');
                card.className = 'product-card';
                card.onclick = () => openProductModal(product);
                card.innerHTML = `
                    <img src="${product.picture || 'https://via.placeholder.com/300x200/96CEB4/FFFFFF?text=' + encodeURIComponent(product.name)}" 
                         alt="${product.name}" class="product-image"
                         onerror="this.src='https://via.placeholder.com/300x200/96CEB4/FFFFFF?text=' + encodeURIComponent('${product.name}')">
                    <div class="product-info">
                        <h3 class="product-name">${product.name}</h3>
                        <div class="product-price">${product.prices} HTG</div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        async function openProductModal(product) {
            currentProduct = product;
            document.getElementById('modalProductImage').src = product.picture || 'https://via.placeholder.com/400x300/96CEB4/FFFFFF?text=' + encodeURIComponent(product.name);
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductPrice').textContent = product.prices + ' HTG';
            document.getElementById('modalProductDescription').textContent = product.description || 'Aucune description disponible.';
            document.getElementById('quantityInput').value = 1;
            document.getElementById('productModal').style.display = 'block';
        }

        function closeProductModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        // Affiche la barre de catégories (PC) ou le menu burger (mobile/tablette)
        function showCategoriesUI(categories) {
            const bar = document.getElementById('categoriesBar');
            const burger = document.getElementById('categoriesBurger');
            const menu = document.getElementById('categoriesMenu');
            // Responsive : barre horizontale sur PC, burger sur mobile
            function updateCategoriesDisplay() {
                if (window.innerWidth > 900) {
                    // PC : barre horizontale
                    bar.style.display = 'flex';
                    burger.style.display = 'none';
                    bar.innerHTML = '';
                    categories.forEach(cat => {
                        const btn = document.createElement('button');
                        btn.className = 'category-btn';
                        btn.textContent = cat.name;
                        btn.onclick = () => selectCategory(cat);
                        bar.appendChild(btn);
                    });
                } else {
                    // Mobile/tablette : menu burger
                    bar.style.display = 'none';
                    burger.style.display = 'block';
                    menu.innerHTML = '<div class="menu-content"></div>';
                    const content = menu.querySelector('.menu-content');
                    content.innerHTML = '';
                    categories.forEach(cat => {
                        const btn = document.createElement('button');
                        btn.className = 'category-btn';
                        btn.textContent = cat.name;
                        btn.onclick = () => {
                            selectCategory(cat);
                            menu.classList.remove('show');
                        };
                        content.appendChild(btn);
                    });
                }
            }
            updateCategoriesDisplay();
            window.addEventListener('resize', updateCategoriesDisplay);
            // Burger menu toggle
            document.getElementById('openCategoriesMenu').onclick = () => {
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                } else {
                    menu.classList.add('show');
                }
            };
            // Close overlay on click
            menu.addEventListener('click', (e) => {
                if (e.target === menu) menu.classList.remove('show');
            });
        }

        // Sélection d'une catégorie : filtre les produits déjà chargés
        async function selectCategory(category) {
            try {
                showLoading(true);
                // Filtrer les produits déjà chargés par catégorie
                const filteredProducts = (window.allProducts || []).filter(
                    product => product.id_category === category.id
                );
                displayProducts(filteredProducts);
            } catch (error) {
                showAlert('Erreur lors du chargement des produits', 'error');
                displayProducts([]);
            } finally {
                showLoading(false);
            }
        }

        // API pour charger les catégories d'une université
        async function loadCategoriesByUniversityFromAPI(universityId) {
            try {
                const response = await fetch(`backend/categories`);
                if (!response.ok) throw new Error('Erreur lors du chargement des catégories');
                const data = await response.json();
                // L'API renvoie {categories: [...]} donc on extrait le tableau
                return data.categories || data;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        // API pour charger les produits d'une université
        async function loadProductsByUniversityFromAPI(universityId) {
            try {
                const response = await fetch(`backend/products/${universityId}`);
                if (!response.ok) throw new Error('Erreur lors du chargement des produits');
                const data = await response.json();
                // Stocker tous les produits pour filtrage au front
                window.allProducts = data.products || data || [];
                return window.allProducts;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantityInput');
            const current = parseInt(input.value);
            
            if (current > 1) {
                input.value = current - 1;
            }
        }

        function increaseQuantity() {
            const input = document.getElementById('quantityInput');
            const current = parseInt(input.value);
            const max = parseInt(input.max);
            
            if (current < max) {
                input.value = current + 1;
            }
        }

        // ===== CART FUNCTIONS =====
        function addToCart() {
            if (!currentProduct) return;
            
            const quantity = parseInt(document.getElementById('quantityInput').value);
            
            // Check if cart has products from different university
            if (cart.length > 0 && cart[0].universityId !== currentUniversity.id) {
                showAlert('Vous ne pouvez commander que dans une seule université à la fois. Videz votre panier pour changer d\'université.', 'error');
                return;
            }
            
            // Check if product already exists in cart
            const existingItem = cart.find(item => item.id === currentProduct.id);
            
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    ...currentProduct,
                    quantity: quantity,
                    universityId: currentUniversity.id,
                    universityName: currentUniversity.name,
                    // Ensure we use the right property names for cart display
                    price: currentProduct.prices, // Map prices to price for cart consistency
                    image: currentProduct.picture // Map picture to image for cart consistency
                });
            }
            
            // Save to localStorage
            localStorage.setItem('kodpwomo_cart', JSON.stringify(cart));
            
            updateCartDisplay();
            closeProductModal();
            showAlert(`${currentProduct.name} ajouté au panier !`, 'success');
        }

        function removeFromCart(productId) {
            console.log('🗑️ Suppression produit ID:', productId, 'Type:', typeof productId);
            console.log('🛒 Contenu panier avant suppression:', cart.map(item => ({id: item.id, type: typeof item.id, name: item.name})));
            
            // Conversion pour gérer les types string/number
            const itemIndex = cart.findIndex(item => item.id == productId); // == au lieu de === pour gérer les types
            console.log('📍 Index trouvé:', itemIndex);
            
            if (itemIndex > -1) {
                cart[itemIndex].quantity--;
                console.log(`📦 Nouvelle quantité: ${cart[itemIndex].quantity}`);
                
                if (cart[itemIndex].quantity <= 0) {
                    cart.splice(itemIndex, 1);
                    console.log('❌ Produit supprimé complètement du panier');
                }
            } else {
                console.log('⚠️ Produit non trouvé dans le panier');
            }
            
            localStorage.setItem('kodpwomo_cart', JSON.stringify(cart));
            updateCartDisplay();
            displayCartItems();
        }

        function clearCart() {
            cart = [];
            localStorage.removeItem('kodpwomo_cart');
            updateCartDisplay();
            displayCartItems();
            showAlert('Panier vidé !', 'success');
        }

        function updateCartDisplay() {
            const cartBtn = document.getElementById('cartBtn');
            const cartCount = document.getElementById('cartCount');
            const cartBtnFixed = document.getElementById('cartBtnFixed');
            const cartCountFixed = document.getElementById('cartCountFixed');
            
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            
            if (totalItems > 0) {
                cartBtn.style.display = 'flex';
                cartBtnFixed.style.display = 'flex';
                cartCount.textContent = totalItems;
                cartCountFixed.textContent = totalItems;
            } else {
                cartBtn.style.display = 'none';
                cartBtnFixed.style.display = 'none';
            }
        }

        // Variables pour gérer la sélection de lieu
        let selectedDeliveryPlace = null;

        // Fonction pour charger les lieux de livraison d'une université
        async function loadDeliveryPlaces(universityId) {
            try {
                console.log('Chargement des lieux pour université ID:', universityId);
                const response = await fetch(`backend/places/${universityId}`);
                if (response.ok) {
                    const data = await response.json();
                    console.log('Réponse API places:', data);
                    // L'API renvoie {places: [...]}
                    const places = data.places || [];
                    populateDeliveryPlaces(places);
                } else {
                    console.error('Erreur lors du chargement des lieux:', response.status);
                    populateDeliveryPlaces([]);
                }
            } catch (error) {
                console.error('Erreur:', error);
                populateDeliveryPlaces([]);
            }
        }

        // Fonction pour remplir la liste des lieux
        function populateDeliveryPlaces(places) {
            console.log('🏢 Remplissage des lieux:', places);
            const select = document.getElementById('deliveryPlace');
            select.innerHTML = '<option value="">Sélectionnez un lieu de livraison</option>';
            
            if (places && places.length > 0) {
                console.log(`${places.length} lieux trouvés`);
                places.forEach((place, index) => {
                    console.log(`🏛️ Salle ${index}:`, place);
                    console.log(`   - ID: ${place.id}`);
                    console.log(`   - salle_name: "${place.salle_name}"`);
                    console.log(`   - Toutes les propriétés:`, Object.keys(place));
                    
                    const option = document.createElement('option');
                    // Value = ID (pour la base de données), Text = nom de la salle (pour l'affichage)
                    option.value = place.id;  // ID de la salle pour la DB
                    option.textContent = place.salle_name;  // Nom affiché à l'utilisateur
                    
                    console.log(`   - Option créée: value="${option.value}", text="${option.textContent}"`);
                    select.appendChild(option);
                });
            } else {
                console.log('Aucun lieu trouvé');
                select.innerHTML = '<option value="">Aucun lieu disponible</option>';
            }
        }

        // Gestionnaire d'événement pour la sélection de lieu
        document.addEventListener('DOMContentLoaded', function() {
            const deliveryPlaceSelect = document.getElementById('deliveryPlace');
            if (deliveryPlaceSelect) {
                deliveryPlaceSelect.addEventListener('change', function() {
                    selectedDeliveryPlace = this.value;
                });
            }
        });

        function openCartModal() {
            console.log('🛒 Ouverture du panier - cart length:', cart.length);
            displayCartItems();
            updateDeliveryLocationDisplay();
            document.getElementById('cartModal').style.display = 'block';
        }

        function updateDeliveryLocationDisplay() {
            console.log('🔍 updateDeliveryLocationDisplay appelée');
            console.log('📦 Taille du panier:', cart.length);
            console.log('🏫 localStorage université ID:', localStorage.getItem('selectedUniversityId'));
            console.log('🏫 localStorage université Name:', localStorage.getItem('selectedUniversityName'));
            
            // Vérifier si le panier a des produits
            if (cart.length === 0) {
                console.log('⚠️ Panier vide');
                document.getElementById('selectedUniversity').textContent = 'Panier vide - Sélectionnez une université';
                const select = document.getElementById('deliveryPlace');
                select.innerHTML = '<option value="">Ajoutez d\'abord des produits</option>';
                return;
            }

            // Récupérer l'ID université depuis localStorage
            const universityId = localStorage.getItem('selectedUniversityId');
            const universityName = localStorage.getItem('selectedUniversityName');
            
            if (universityId && universityName) {
                console.log('✅ Panier non vide, chargement des lieux pour:', universityName);
                document.getElementById('selectedUniversity').textContent = universityName;
                loadDeliveryPlaces(universityId);
            } else {
                console.log('❌ Pas d\'université sélectionnée');
                document.getElementById('selectedUniversity').textContent = 'Sélectionnez une université';
                const select = document.getElementById('deliveryPlace');
                select.innerHTML = '<option value="">Choisissez d\'abord une université</option>';
            }
        }

        function closeCartModal() {
            document.getElementById('cartModal').style.display = 'none';
        }

        function displayCartItems() {
            const cartItems = document.getElementById('cartItems');
            
            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart">
                        <div class="empty-cart-icon">🛒</div>
                        <p>Votre panier est vide</p>
                    </div>
                `;
                document.getElementById('cartSummary').style.display = 'none';
                return;
            }
            
            document.getElementById('cartSummary').style.display = 'block';
            
            cartItems.innerHTML = '';
            let subtotal = 0;
            
            cart.forEach(item => {
                const price = item.price || item.prices; // Handle both price formats
                const image = item.image || item.picture; // Handle both image formats
                const itemTotal = price * item.quantity;
                subtotal += itemTotal;
                
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <img src="${image || 'https://via.placeholder.com/60x60/96CEB4/FFFFFF?text=Produit'}" 
                         alt="${item.name}" class="cart-item-image"
                         onerror="this.src='https://via.placeholder.com/60x60/96CEB4/FFFFFF?text=Produit'">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">${price} HTG x ${item.quantity} = ${itemTotal} HTG</div>
                    </div>
                    <div class="cart-item-controls">
                        <span>Qté: ${item.quantity}</span>
                        <button class="remove-item-btn" onclick="removeFromCart('${item.id}')">×</button>
                    </div>
                `;
                
                cartItems.appendChild(cartItem);
            });
            
            // Update summary
            const deliveryFee = 50;
            const total = subtotal + deliveryFee;
            
            document.getElementById('subtotalPrice').textContent = subtotal + ' HTG';
            document.getElementById('totalPrice').textContent = total + ' HTG';
        }

        async function checkout() {
            if (cart.length === 0) {
                showAlert('Votre panier est vide', 'error');
                return;
            }

            // Vérifier qu'un lieu de livraison est sélectionné
            if (!selectedDeliveryPlace) {
                showAlert('Veuillez sélectionner un lieu de livraison', 'error');
                return;
            }
            
            showLoading(true);
            
            try {
                // Calculer le total
                const subtotal = cart.reduce((total, item) => {
                    const price = item.price || item.prices;
                    return total + (price * item.quantity);
                }, 0);
                
                const deliveryFee = 50;
                const totalAmount = subtotal + deliveryFee;
                
                // Préparer les données de commande
                const orderData = {
                    university_id: cart[0].universityId,
                    university_name: cart[0].universityName,
                    delivery_place_id: selectedDeliveryPlace,
                    total_amount: totalAmount,
                    delivery_fee: deliveryFee,
                    subtotal: subtotal,
                    items_count: cart.length,
                    products: []
                };
                
                // Boucle forEach pour traiter chaque produit du panier
                cart.forEach(item => {
                    const price = item.price || item.prices;
                    const itemTotal = price * item.quantity;
                    
                    orderData.products.push({
                        product_id: item.id,
                        product_name: item.name,
                        quantity: item.quantity,
                        unit_price: price,
                        total_price: itemTotal,
                        category_id: item.id_category || null
                    });
                });
                
                console.log('Order data prepared:', orderData);
                
                // Envoyer la commande au backend
                const response = await fetch('backend/orders', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                    },
                    body: JSON.stringify(orderData)
                });
                
                if (!response.ok) {
                    if(response.status === 401){
                        showAlert('Votre session a expiré. Veuillez vous reconnecter.', 'error');
                        //rediriger vers la page de connexion after 5s
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 5000);
                        
                        return;
                    }
                    throw new Error('Erreur lors de la création de la commande');
                }
                
                const result = await response.json();
                
                if (result.status === 'success' || result.order_id) {
                    // Commande réussie
                    showAlert('🎉 Commande passée avec succès ! Vous recevrez bientôt vos produits.', 'success');
                    
                    // Vider le panier
                    clearCart();
                    
                    // Fermer le modal
                    closeCartModal();
                    
                    // Optionnel : rediriger vers une page de confirmation
                    // window.location.href = `confirmation.php?order=${result.order_id}`;
                    
                } else {
                    showAlert('Erreur lors de la commande: ' + (result.message || result.error), 'error');
                }
                
            } catch (error) {
                console.error('Checkout error:', error);
                showAlert('Erreur lors de la commande. Veuillez réessayer.', 'error');
            } finally {
                showLoading(false);
            }
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
            }, 3000);
        }

        // ===== API FUNCTIONS =====
        async function loadUniversitiesFromAPI() {
            try {
                const response = await fetch('backend/universities');
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement des universités');
                }
                const data = await response.json();
                console.log(data);
                return data; // Assuming your API returns the universities array
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }
    </script>
    
    <!-- Sistema de Notificaciones Global -->
    <script src="assets/js/notifications-system.js"></script>
</body>
</html>