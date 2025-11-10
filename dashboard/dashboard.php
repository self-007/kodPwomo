<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Suivi de Commandes</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== COLOR PALETTE ===== */
        :root {
            --primary-green: #27ae60;
            --primary-green-light: #2ecc71;
            --primary-green-dark: #229954;
            --white: #ffffff;
            --orange: #f39c12;
            --orange-light: #f5b041;
            --orange-dark: #e67e22;
            --light-gray: #f8f9fa;
            --medium-gray: #ecf0f1;
            --dark-gray: #34495e;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #e0e0e0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* ===== LAYOUT ===== */
        .container {
            display: flex;
            min-height: 100vh;
            background-color: var(--light-gray);
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sidebar-nav {
            list-style: none;
        }

        .nav-item {
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--white);
            padding-left: 24px;
            border-right: 4px solid var(--orange);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* ===== MAIN CONTENT ===== */
        .main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ===== HEADER ===== */
        .header {
            background-color: var(--white);
            padding: 16px 30px;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-green);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--orange) 0%, var(--primary-green) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 18px;
            box-shadow: var(--shadow);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }

        .user-status {
            font-size: 12px;
            color: var(--text-light);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow-hover);
            min-width: 200px;
            z-index: 1001;
            overflow: hidden;
            display: none;
            margin-top: 10px;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--primary-green);
            padding-left: 20px;
        }

        .dropdown-item.logout {
            color: #e74c3c;
            border-top: 1px solid var(--border-color);
        }

        .dropdown-item.logout:hover {
            background-color: rgba(231, 76, 60, 0.1);
        }

        /* ===== PAGE CONTENT ===== */
        .page-content {
            flex: 1;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--primary-green);
            font-size: 32px;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== SECTION: HOME ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--white);
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-green);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-icon {
            font-size: 28px;
            color: var(--primary-green);
            margin-bottom: 12px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== SECTION: ORDERS ===== */
        .orders-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .order-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary-green);
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .order-number {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 16px;
        }

        .order-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .order-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-preparation {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-in-transit {
            background-color: #cfe2ff;
            color: #084298;
        }

        .status-delivered {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #842029;
        }

        .order-details {
            margin: 16px 0;
            padding: 12px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .order-detail-item {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .order-detail-item:last-child {
            margin-bottom: 0;
        }

        .order-detail-label {
            color: var(--text-light);
        }

        .order-amount {
            font-weight: 700;
            color: var(--primary-green);
            font-size: 18px;
            margin-top: 12px;
        }

        .order-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 16px;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background-color: var(--orange);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
        }

        .btn-secondary {
            background-color: var(--medium-gray);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: var(--primary-green-light);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* ===== SECTION: PROFILE ===== */
        .profile-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .profile-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .profile-section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-section-title i {
            color: var(--primary-green);
            font-size: 18px;
        }

        .profile-field {
            margin-bottom: 18px;
        }

        .profile-field:last-child {
            margin-bottom: 0;
        }

        .field-label {
            font-size: 12px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
            font-weight: 600;
        }

        .field-value {
            font-size: 14px;
            color: var(--text-dark);
            padding: 10px 12px;
            background-color: var(--light-gray);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn-edit {
            flex: 1;
            background-color: var(--primary-green);
            color: var(--white);
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-edit:hover {
            background-color: var(--primary-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .address-item {
            padding: 12px;
            background-color: var(--light-gray);
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .address-text {
            font-size: 13px;
            color: var(--text-dark);
        }

        .address-type {
            font-size: 11px;
            background-color: var(--primary-green);
            color: var(--white);
            padding: 4px 8px;
            border-radius: 4px;
            margin-bottom: 4px;
            display: inline-block;
            font-weight: 600;
        }

        /* ===== SECTION: REVIEWS ===== */
        .reviews-container {
            max-width: 600px;
        }

        .review-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-green);
            transition: all 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .review-restaurant {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 15px;
        }

        .review-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .review-rating {
            display: flex;
            gap: 4px;
            margin-bottom: 12px;
        }

        .star {
            color: var(--orange);
            font-size: 14px;
        }

        .star.empty {
            color: var(--border-color);
        }

        .review-comment {
            font-size: 13px;
            color: var(--text-dark);
            line-height: 1.6;
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state-text {
            font-size: 14px;
        }

        /* ===== SECTION: SUPPORT ===== */
        .support-container {
            max-width: 600px;
        }

        .support-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: var(--text-dark);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 150px;
        }

        .btn-submit {
            background-color: var(--primary-green);
            color: var(--white);
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            background-color: var(--primary-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        /* ===== MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-hover);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            color: var(--text-dark);
            transform: rotate(90deg);
        }

        .modal-body {
            margin-bottom: 24px;
        }

        .order-detail {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .order-detail:last-child {
            border-bottom: none;
        }

        .order-detail-label {
            color: var(--text-light);
            font-weight: 500;
        }

        .order-detail-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background-color: var(--light-gray);
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .product-name {
            font-weight: 500;
            color: var(--text-dark);
        }

        .product-qty {
            color: var(--text-light);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .orders-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .profile-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transition: width 0.3s ease;
            }

            .sidebar.show {
                width: 260px;
            }

            .main {
                margin-left: 0;
            }

            .header {
                padding: 12px 20px;
            }

            .page-content {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .orders-container {
                grid-template-columns: 1fr;
            }

            .order-actions {
                grid-template-columns: 1fr;
            }

            .btn {
                font-size: 12px;
                padding: 8px 12px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 0;
            }

            .header-right {
                gap: 10px;
            }

            .user-info {
                display: none;
            }

            .page-content {
                padding: 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .page-title {
                font-size: 18px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .modal-content {
                width: 95%;
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo">
                    <i class="fas fa-box"></i>
                    DeliApp
                </a>
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" onclick="showSection('home', event)">
                            <i class="fas fa-home"></i>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('orders', event)">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Mes Commandes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('profile', event)">
                            <i class="fas fa-user"></i>
                            <span>Mon Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('reviews', event)">
                            <i class="fas fa-star"></i>
                            <span>Mes Avis</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('support', event)">
                            <i class="fas fa-headset"></i>
                            <span>Support</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <i class="fas fa-bars" id="menuToggle" style="cursor: pointer; display: none; color: var(--primary-green);"></i>
                </div>
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-avatar">JD</div>
                        <div class="user-info">
                            <div class="user-name">Jean Dupont</div>
                            <div class="user-status">Client Premium</div>
                        </div>
                        <i class="fas fa-chevron-down" style="color: var(--text-light); cursor: pointer;"></i>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#" class="dropdown-item" onclick="showSection('profile', event)">
                                <i class="fas fa-user"></i> Profil
                            </a>
                            <a href="#" class="dropdown-item" onclick="alert('Paramètres')">
                                <i class="fas fa-cog"></i> Paramètres
                            </a>
                            <a href="#" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content">
                <!-- HOME SECTION -->
                <section id="home" class="section active">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fas fa-home"></i> Bienvenue, Jean !
                        </h1>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-box"></i></div>
                            <div class="stat-number">12</div>
                            <div class="stat-label">Commandes Totales</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-truck"></i></div>
                            <div class="stat-number">3</div>
                            <div class="stat-label">En Route</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="stat-number">8</div>
                            <div class="stat-label">Livrées</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-euro-sign"></i></div>
                            <div class="stat-number">527€</div>
                            <div class="stat-label">Total Dépensé</div>
                        </div>
                    </div>
                </section>

                <!-- ORDERS SECTION -->
                <section id="orders" class="section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fas fa-shopping-bag"></i> Mes Commandes
                        </h1>
                    </div>

                    <div class="orders-container">
                        <!-- Order Card 1 -->
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">Commande #2024001</div>
                                    <div class="order-date">12 Janvier 2024</div>
                                </div>
                                <div class="order-status status-delivered">
                                    <i class="fas fa-check-circle"></i> Livrée
                                </div>
                            </div>
                            <div class="order-details">
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Restaurant:</span>
                                    <span>Pizza Bella</span>
                                </div>
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Adresse:</span>
                                    <span>123 Rue Principale</span>
                                </div>
                            </div>
                            <div class="order-amount">45,50€</div>
                            <div class="order-actions">
                                <button class="btn btn-primary" onclick="openOrderModal(1)">
                                    <i class="fas fa-eye"></i> Détails
                                </button>
                            </div>
                        </div>

                        <!-- Order Card 2 -->
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">Commande #2024002</div>
                                    <div class="order-date">15 Janvier 2024</div>
                                </div>
                                <div class="order-status status-in-transit">
                                    <i class="fas fa-car"></i> En Route
                                </div>
                            </div>
                            <div class="order-details">
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Restaurant:</span>
                                    <span>Burger King</span>
                                </div>
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Adresse:</span>
                                    <span>456 Avenue Central</span>
                                </div>
                            </div>
                            <div class="order-amount">32,75€</div>
                            <div class="order-actions">
                                <button class="btn btn-primary" onclick="openOrderModal(2)">
                                    <i class="fas fa-eye"></i> Détails
                                </button>
                            </div>
                        </div>

                        <!-- Order Card 3 -->
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">Commande #2024003</div>
                                    <div class="order-date">18 Janvier 2024</div>
                                </div>
                                <div class="order-status status-preparation">
                                    <i class="fas fa-hourglass-start"></i> En Préparation
                                </div>
                            </div>
                            <div class="order-details">
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Restaurant:</span>
                                    <span>Sushi Tokyo</span>
                                </div>
                                <div class="order-detail-item">
                                    <span class="order-detail-label">Adresse:</span>
                                    <span>789 Boulevard Saint-Michel</span>
                                </div>
                            </div>
                            <div class="order-amount">68,90€</div>
                            <div class="order-actions">
                                <button class="btn btn-primary" onclick="openOrderModal(3)">
                                    <i class="fas fa-eye"></i> Détails
                                </button>
                                <button class="btn btn-secondary" onclick="toggleOrderStatus(3, 'disable')">
                                    <i class="fas fa-ban"></i> Désactiver
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- PROFILE SECTION -->
                <section id="profile" class="section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fas fa-user"></i> Mon Profil
                        </h1>
                    </div>

                    <div class="profile-container">
                        <!-- Personal Info -->
                        <div class="profile-card">
                            <div class="profile-section-title">
                                <i class="fas fa-id-card"></i> Informations Personnelles
                            </div>
                            <div class="profile-field">
                                <span class="field-label">Prénom et Nom</span>
                                <div class="field-value">
                                    <span>Jean Dupont</span>
                                    <i class="fas fa-edit" style="color: var(--orange); cursor: pointer;"></i>
                                </div>
                            </div>
                            <div class="profile-field">
                                <span class="field-label">Email</span>
                                <div class="field-value">
                                    <span>jean.dupont@email.com</span>
                                    <i class="fas fa-edit" style="color: var(--orange); cursor: pointer;"></i>
                                </div>
                            </div>
                            <div class="profile-field">
                                <span class="field-label">Téléphone</span>
                                <div class="field-value">
                                    <span>+33 6 12 34 56 78</span>
                                    <i class="fas fa-edit" style="color: var(--orange); cursor: pointer;"></i>
                                </div>
                            </div>
                            <div class="profile-actions">
                                <button class="btn-edit">
                                    <i class="fas fa-save"></i> Enregistrer les Modifications
                                </button>
                            </div>
                        </div>

                        <!-- Addresses -->
                        <div class="profile-card">
                            <div class="profile-section-title">
                                <i class="fas fa-map-marker-alt"></i> Mes Adresses
                            </div>
                            <div class="address-item">
                                <div>
                                    <span class="address-type">Domicile</span>
                                    <div class="address-text">123 Rue Principale<br>75000 Paris, France</div>
                                </div>
                                <i class="fas fa-edit" style="color: var(--orange); cursor: pointer;"></i>
                            </div>
                            <div class="address-item">
                                <div>
                                    <span class="address-type">Travail</span>
                                    <div class="address-text">456 Avenue Central<br>75001 Paris, France</div>
                                </div>
                                <i class="fas fa-edit" style="color: var(--orange); cursor: pointer;"></i>
                            </div>
                            <div class="profile-actions">
                                <button class="btn-edit">
                                    <i class="fas fa-plus"></i> Ajouter une Adresse
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- REVIEWS SECTION -->
                <section id="reviews" class="section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fas fa-star"></i> Mes Avis
                        </h1>
                    </div>

                    <div class="reviews-container">
                        <!-- Review 1 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div>
                                    <div class="review-restaurant">Pizza Bella</div>
                                    <div class="review-date">12 Janvier 2024</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                            </div>
                            <div class="review-comment">
                                "Excellente pizza, livraison rapide et livreur très courtois. Je recommande vivement !"
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div>
                                    <div class="review-restaurant">Burger King</div>
                                    <div class="review-date">10 Janvier 2024</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star empty"></i>
                            </div>
                            <div class="review-comment">
                                "Bon repas mais les frites étaient froides à la livraison. Sinon c'est correct."
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div>
                                    <div class="review-restaurant">Sushi Tokyo</div>
                                    <div class="review-date">8 Janvier 2024</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                                <i class="fas fa-star star"></i>
                            </div>
                            <div class="review-comment">
                                "Délicieux sushi frais et présentation magnifique. Équipe très professionnelle !"
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SUPPORT SECTION -->
                <section id="support" class="section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="fas fa-headset"></i> Support Client
                        </h1>
                    </div>

                    <div class="support-container">
                        <div class="support-card">
                            <form onsubmit="handleSupportForm(event)">
                                <div class="form-group">
                                    <label class="form-label">Sujet</label>
                                    <select class="form-input" required>
                                        <option value="">Choisir un sujet...</option>
                                        <option value="livraison">Problème de livraison</option>
                                        <option value="commande">Problème de commande</option>
                                        <option value="produit">Produit manquant</option>
                                        <option value="qualite">Problème de qualité</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Adresse Email</label>
                                    <input type="email" class="form-input" placeholder="jean.dupont@email.com" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-textarea" placeholder="Décrivez votre problème en détail..." required></textarea>
                                </div>

                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane"></i> Envoyer mon Message
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalOrderNumber">Commande #2024001</h2>
                <button class="modal-close" onclick="closeOrderModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-detail">
                    <span class="order-detail-label">Date:</span>
                    <span class="order-detail-value">12 Janvier 2024 à 14:30</span>
                </div>
                <div class="order-detail">
                    <span class="order-detail-label">Statut:</span>
                    <span class="order-detail-value">
                        <span class="order-status status-delivered">
                            <i class="fas fa-check-circle"></i> Livrée
                        </span>
                    </span>
                </div>
                <div class="order-detail">
                    <span class="order-detail-label">Restaurant:</span>
                    <span class="order-detail-value">Pizza Bella</span>
                </div>
                <div class="order-detail">
                    <span class="order-detail-label">Adresse de Livraison:</span>
                    <span class="order-detail-value">123 Rue Principale, 75000 Paris</span>
                </div>

                <div style="margin: 20px 0; padding: 16px 0; border-top: 2px solid var(--border-color); border-bottom: 2px solid var(--border-color);">
                    <div style="font-weight: 700; margin-bottom: 12px; color: var(--text-dark);">Articles</div>
                    <div class="product-item">
                        <div class="product-name">Pizza Margherita</div>
                        <div class="product-qty">x1 - 15,90€</div>
                    </div>
                    <div class="product-item">
                        <div class="product-name">Pizza Quattro Formaggi</div>
                        <div class="product-qty">x1 - 16,90€</div>
                    </div>
                    <div class="product-item">
                        <div class="product-name">Coca-Cola 1.5L</div>
                        <div class="product-qty">x1 - 3,00€</div>
                    </div>
                </div>

                <div class="order-detail">
                    <span class="order-detail-label">Sous-total:</span>
                    <span class="order-detail-value">35,80€</span>
                </div>
                <div class="order-detail">
                    <span class="order-detail-label">Frais de livraison:</span>
                    <span class="order-detail-value">5,00€</span>
                </div>
                <div class="order-detail">
                    <span class="order-detail-label">Frais de service:</span>
                    <span class="order-detail-value">4,70€</span>
                </div>
                <div class="order-detail" style="border-top: 2px solid var(--primary-green); margin-top: 12px; padding-top: 12px;">
                    <span class="order-detail-label" style="font-weight: 700; font-size: 15px;">Total:</span>
                    <span class="order-detail-value" style="font-weight: 700; font-size: 15px; color: var(--primary-green);">45,50€</span>
                </div>

                <!-- Rating Section (only show if order status is 'Livrée') -->
                <div id="ratingSection" style="margin-top: 24px; padding-top: 24px; border-top: 2px solid var(--border-color); display: none;">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: var(--text-dark);">
                            <i class="fas fa-star" style="color: var(--orange); margin-right: 8px;"></i>
                            Évaluez la livraison
                        </label>
                        <div class="rating-stars" style="display: flex; gap: 12px; margin-bottom: 16px;">
                            <i class="fas fa-star rating-star" data-rating="1" style="font-size: 28px; color: #ddd; cursor: pointer; transition: all 0.2s;"></i>
                            <i class="fas fa-star rating-star" data-rating="2" style="font-size: 28px; color: #ddd; cursor: pointer; transition: all 0.2s;"></i>
                            <i class="fas fa-star rating-star" data-rating="3" style="font-size: 28px; color: #ddd; cursor: pointer; transition: all 0.2s;"></i>
                            <i class="fas fa-star rating-star" data-rating="4" style="font-size: 28px; color: #ddd; cursor: pointer; transition: all 0.2s;"></i>
                            <i class="fas fa-star rating-star" data-rating="5" style="font-size: 28px; color: #ddd; cursor: pointer; transition: all 0.2s;"></i>
                        </div>
                        <div id="ratingValue" style="font-weight: 600; color: var(--primary-green); font-size: 14px;">Aucune note sélectionnée</div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: var(--text-dark);">
                            <i class="fas fa-comment" style="color: var(--orange); margin-right: 8px;"></i>
                            Votre impression sur le livreur
                        </label>
                        <textarea id="deliveryFeedback" class="form-textarea" placeholder="Partagez votre expérience avec le livreur..." style="width: 100%; padding: 12px 14px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif; font-size: 13px; min-height: 100px; resize: vertical;"></textarea>
                    </div>

                    <button class="btn btn-primary" onclick="openCompleteDeliveryModal()" style="width: 100%;">
                        <i class="fas fa-check-circle"></i> Terminer la Livraison
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Complete Delivery Confirmation Modal -->
    <div id="completeDeliveryModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h2 class="modal-title">Confirmer la Livraison</h2>
                <button class="modal-close" onclick="closeCompleteDeliveryModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="font-size: 48px; color: var(--orange); margin-bottom: 12px;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <p style="color: var(--text-dark); font-weight: 600; margin-bottom: 8px;">Confirmation de Sécurité</p>
                    <p style="color: var(--text-light); font-size: 14px;">Veuillez entrer le code de l'agent pour confirmer la fin de livraison</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Code de l'Agent</label>
                    <input type="text" id="agentCodeInput" class="form-input" placeholder="Entrez le code à 4 chiffres" maxlength="4" style="text-align: center; font-size: 18px; letter-spacing: 8px; font-weight: 700;">
                    <div id="codeError" style="color: #e74c3c; font-size: 12px; margin-top: 8px; display: none;">
                        <i class="fas fa-exclamation-circle"></i> Code incorrect
                    </div>
                </div>

                <div style="background: var(--light-gray); padding: 16px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Code Agent</div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary-green); letter-spacing: 4px;">4821</div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <button class="btn btn-secondary" onclick="closeCompleteDeliveryModal()" style="width: 100%;">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button class="btn btn-primary" onclick="confirmDeliveryWithCode()" style="width: 100%;">
                        <i class="fas fa-check"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle User Dropdown Menu
        document.querySelector('.user-profile').addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('show');
        });

        document.addEventListener('click', function() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.remove('show');
        });

        // Show/Hide Sections
        function showSection(sectionId, event) {
            if (event) event.preventDefault();

            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });

            // Remove active class from all nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');

            // Add active class to clicked nav link
            event.target.closest('.nav-link').classList.add('active');

            // Close sidebar on mobile
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
            }
        }

        let currentRating = 0;

        // Rating Stars Interaction
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('rating-star')) {
                currentRating = parseInt(e.target.getAttribute('data-rating'));
                updateRatingDisplay();
            }
        });

        function updateRatingDisplay() {
            const stars = document.querySelectorAll('.rating-star');
            const ratingValue = document.getElementById('ratingValue');
            
            stars.forEach((star, index) => {
                if (index < currentRating) {
                    star.style.color = 'var(--orange)';
                } else {
                    star.style.color = '#ddd';
                }
            });

            if (currentRating > 0) {
                const labels = ['Très mauvais', 'Mauvais', 'Acceptable', 'Très bien', 'Excellent'];
                ratingValue.textContent = currentRating + '/5 - ' + labels[currentRating - 1];
            } else {
                ratingValue.textContent = 'Aucune note sélectionnée';
            }
        }

        // Open Order Details Modal
        function openOrderModal(orderId) {
            const modal = document.getElementById('orderModal');
            const ratingSection = document.getElementById('ratingSection');
            
            // Show rating section only for delivered orders
            const orderStatus = document.querySelectorAll('.order-status')[orderId - 1];
            if (orderStatus && orderStatus.textContent.includes('Livrée')) {
                ratingSection.style.display = 'block';
                currentRating = 0;
                document.getElementById('deliveryFeedback').value = '';
                updateRatingDisplay();
            } else {
                ratingSection.style.display = 'none';
            }
            
            modal.classList.add('show');
        }

        // Close Order Details Modal
        function closeOrderModal() {
            const modal = document.getElementById('orderModal');
            modal.classList.remove('show');
        }

        // Open Complete Delivery Confirmation Modal
        function openCompleteDeliveryModal() {
            if (currentRating === 0) {
                alert('Veuillez évaluer la livraison avec au moins une étoile.');
                return;
            }

            const feedback = document.getElementById('deliveryFeedback').value.trim();
            if (!feedback) {
                alert('Veuillez donner votre impression sur le livreur.');
                return;
            }

            document.getElementById('agentCodeInput').value = '';
            document.getElementById('codeError').style.display = 'none';
            
            const completeModal = document.getElementById('completeDeliveryModal');
            completeModal.classList.add('show');
            
            // Focus on input
            setTimeout(() => {
                document.getElementById('agentCodeInput').focus();
            }, 300);
        }

        // Close Complete Delivery Modal
        function closeCompleteDeliveryModal() {
            const modal = document.getElementById('completeDeliveryModal');
            modal.classList.remove('show');
            document.getElementById('agentCodeInput').value = '';
            document.getElementById('codeError').style.display = 'none';
        }

        // Confirm Delivery with Code
        function confirmDeliveryWithCode() {
            const enteredCode = document.getElementById('agentCodeInput').value;
            const correctCode = '4821'; // Agent code (should come from backend)
            const codeError = document.getElementById('codeError');

            if (enteredCode === correctCode) {
                codeError.style.display = 'none';
                alert('✅ Livraison confirmée avec succès !\nNote: ' + currentRating + '/5\nMerci pour votre feedback !');
                closeCompleteDeliveryModal();
                closeOrderModal();
                // Here you would typically update the database with the rating and feedback
            } else {
                codeError.style.display = 'block';
                document.getElementById('agentCodeInput').value = '';
                document.getElementById('agentCodeInput').focus();
            }
        }

        // Allow Enter key to submit code
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && document.getElementById('completeDeliveryModal').classList.contains('show')) {
                confirmDeliveryWithCode();
            }
        });

        // Toggle Order Status (Disable/Enable)
        function toggleOrderStatus(orderId, action) {
            if (action === 'disable') {
                if (confirm('Êtes-vous sûr de vouloir désactiver cette commande ?')) {
                    alert('Commande #' + (2000 + orderId) + ' désactivée');
                    // Update UI - change button from "Désactiver" to "Activer"
                    // This would typically call a backend API
                }
            } else if (action === 'enable') {
                if (confirm('Êtes-vous sûr de vouloir réactiver cette commande ?')) {
                    alert('Commande #' + (2000 + orderId) + ' réactivée');
                    // Update UI
                }
            }
        }
    </script>
</body>
</html>
