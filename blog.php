<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kodPwomo - Blog & Actualités</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Blog kodPwomo - Actualités, guides d'utilisation, avis clients, top agents et améliorations de la plateforme de livraison étudiante en Haïti.">
    <meta name="keywords" content="blog kodpwomo, avis clients, top agents, guides, actualités livraison haiti">
    
    <link rel="stylesheet" href="assets/css/kodpwomo-colors.css">
    
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
        
        /* Hamburger menu */
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
            top: 50px;
            min-width: 200px;
            max-width: 90vw;
            max-height: 60vh;
            overflow-y: auto;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 10px;
            box-shadow: 8px 8px 20px rgba(0,0,0,0.10), -8px -8px 20px rgba(255,255,255,0.70);
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
        .nav-menu a:hover { background: #f5f7fb; color: #f7b642; }
        
        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        /* ===== PAGE HEADER ===== */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-title {
            font-size: 36px;
            font-weight: 700;
            color: #234777;
            margin-bottom: 12px;
        }
        
        .page-subtitle {
            font-size: 18px;
            color: #6b7280;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* ===== FILTERS SECTION ===== */
        .filters-section {
            background: rgba(255,255,255,0.92);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        
        .filters-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .filter-label {
            font-weight: 600;
            color: #234777;
            margin-right: 8px;
        }
        
        .filter-btn {
            padding: 10px 20px;
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            color: #64748b;
        }
        
        .filter-btn:hover {
            border-color: #f7b642;
            color: #f7b642;
        }
        
        .filter-btn.active {
            background: #f7b642;
            border-color: #f7b642;
            color: #fff;
        }
        
        /* ===== ADD POST BUTTON ===== */
        .add-post-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.4);
        }
        
        .add-post-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.6);
        }
        
        /* ===== POSTS LIST (NOTIFICATION STYLE) ===== */
        .posts-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .post-item {
            background: rgba(255,255,255,0.95);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .post-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateX(4px);
            border-color: #f7b642;
        }
        
        .post-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #f7b642 0%, #e19627 100%);
        }
        
        .post-icon.avis { background: linear-gradient(135deg, #27ae60 0%, #229954 100%); }
        .post-icon.guide { background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); }
        .post-icon.top { background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); }
        .post-icon.actualite { background: linear-gradient(135deg, #f7b642 0%, #e19627 100%); }
        .post-icon.amelioration { background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%); }
        
        .post-info {
            flex: 1;
            min-width: 0;
        }
        
        .post-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }
        
        .post-category {
            display: inline-block;
            padding: 4px 10px;
            background: #f7b642;
            color: #fff;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .post-category.avis { background: #27ae60; }
        .post-category.guide { background: #3498db; }
        .post-category.top { background: #e74c3c; }
        .post-category.actualite { background: #f7b642; }
        .post-category.amelioration { background: #9b59b6; }
        
        .post-title {
            font-size: 16px;
            font-weight: 600;
            color: #234777;
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .post-excerpt {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.4;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .post-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: #9ca3af;
            flex-shrink: 0;
        }
        
        .post-author {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .author-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f7b642;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 11px;
        }
        
        .post-date {
            color: #9ca3af;
            font-size: 12px;
        }
        
        .post-stats {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            color: #9ca3af;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .view-more-btn {
            padding: 8px 20px;
            background: #f7b642;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .view-more-btn:hover {
            background: #e19627;
            transform: scale(1.05);
        }
        
        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 2000;
            overflow-y: auto;
            padding: 20px;
            align-items: center;
            justify-content: center;
        }
        
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-content {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            max-width: 700px;
            margin: 40px auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            color: #6b7280;
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
            background: #f3f4f6;
            color: #e74c3c;
        }
        
        .modal-header {
            margin-bottom: 25px;
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #234777;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #234777;
        }
        
        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #f7b642;
        }
        
        .rating-input {
            display: flex;
            gap: 10px;
            font-size: 28px;
        }
        
        .star {
            cursor: pointer;
            color: #d1d5db;
            transition: all 0.2s ease;
        }
        
        .star:hover,
        .star.active {
            color: #fbbf24;
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #f7b642, #e19627);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(247, 182, 66, 0.4);
        }
        
        /* ===== POST DETAIL MODAL ===== */
        .post-detail {
            max-width: 800px;
        }
        
        .post-detail-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .post-detail-content {
            line-height: 1.8;
            color: #374151;
            font-size: 16px;
        }
        
        .comments-section {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
        }
        
        .comments-title {
            font-size: 20px;
            font-weight: 700;
            color: #234777;
            margin-bottom: 20px;
        }
        
        .comment-item {
            background: #f9fafb;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .comment-author {
            font-weight: 600;
            color: #234777;
        }
        
        .comment-date {
            font-size: 12px;
            color: #9ca3af;
        }
        
        .comment-text {
            color: #6b7280;
            line-height: 1.6;
        }
        
        /* ===== LOADING & ALERTS ===== */
        .loading {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #f7b642;
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
            top: 80px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            z-index: 3000;
            transform: translateX(400px);
            transition: all 0.3s ease;
            max-width: 350px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .alert.show {
            transform: translateX(0);
        }
        
        .alert.success {
            background: #27ae60;
            color: #fff;
        }
        
        .alert.error {
            background: #e74c3c;
            color: #fff;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6b7280;
        }
        
        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .page-title { font-size: 28px; }
            .page-subtitle { font-size: 16px; }
            
            .post-item {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            
            .post-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .post-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .post-title {
                white-space: normal;
                overflow: visible;
            }
            
            .post-excerpt {
                white-space: normal;
                overflow: visible;
            }
            
            .view-more-btn {
                width: 100%;
                padding: 10px;
            }
            
            .filters-container { 
                flex-direction: column; 
                align-items: stretch; 
            }
            
            .filter-btn { 
                text-align: center; 
            }
            
            .modal-content { 
                padding: 20px; 
                margin: 20px auto; 
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <img src="image/logo/logo1.1.jpg" alt="kodPwomo">
            </div>
            <nav class="nav">
                <button class="hamburger-btn" id="hamburgerBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="nav-menu" id="navMenu">
                    <a href="dashboard_user/dashboard.php">Dashboard</a>
                    <a href="boutique.php">Boutique</a>
                    <a href="agent.php">Restaurant</a>
                    <a href="blog.php">Blog</a>
                    <a href="index.php">Accueil</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Blog & Actualités kodPwomo</h1>
            <p class="page-subtitle">
                Découvrez les actualités, guides d'utilisation, avis clients et les meilleurs agents de notre communauté
            </p>
        </div>

        <!-- Add Post Button -->
        <button class="add-post-btn" onclick="openAddPostModal()">
            + Partager mon avis ou suggestion
        </button>

        <!-- Filters Section -->
        <div class="filters-section">
            <div class="filters-container">
                <span class="filter-label">Filtrer par :</span>
                <button class="filter-btn active" onclick="filterPosts('tous')">Tous</button>
                <button class="filter-btn" onclick="filterPosts('actualite')">Actualités</button>
                <button class="filter-btn" onclick="filterPosts('guide')">Guides</button>
                <button class="filter-btn" onclick="filterPosts('avis')">Avis Clients</button>
                <button class="filter-btn" onclick="filterPosts('top')">Top Agents/Clients</button>
                <button class="filter-btn" onclick="filterPosts('amelioration')">Améliorations</button>
            </div>
        </div>

        <!-- Posts List -->
        <div id="postsList" class="posts-list">
            <!-- Posts will be loaded here -->
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="loading" style="display: none;">
            <div class="loading-spinner"></div>
            <p>Chargement des publications...</p>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state" style="display: none;">
            <div class="empty-icon">📝</div>
            <h3>Aucune publication pour le moment</h3>
            <p>Soyez le premier à partager votre avis ou suggestion !</p>
        </div>
    </main>

    <!-- Add Post Modal -->
    <div id="addPostModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeAddPostModal()">&times;</button>
            
            <div class="modal-header">
                <h2 class="modal-title">Partager mon avis ou suggestion</h2>
            </div>
            
            <form id="addPostForm" onsubmit="submitPost(event)">
                <div class="form-group">
                    <label class="form-label">Catégorie *</label>
                    <select class="form-select" id="postCategory" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="avis">Avis Client</option>
                        <option value="amelioration">Suggestion d'amélioration</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" class="form-input" id="postTitle" required 
                           placeholder="Ex: Excellent service de livraison !">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Votre message *</label>
                    <textarea class="form-textarea" id="postContent" required 
                              placeholder="Partagez votre expérience, vos suggestions..."></textarea>
                </div>
                
                <div class="form-group" id="ratingGroup" style="display: none;">
                    <label class="form-label">Note (optionnelle)</label>
                    <div class="rating-input">
                        <span class="star" data-rating="1" onclick="setRating(1)">★</span>
                        <span class="star" data-rating="2" onclick="setRating(2)">★</span>
                        <span class="star" data-rating="3" onclick="setRating(3)">★</span>
                        <span class="star" data-rating="4" onclick="setRating(4)">★</span>
                        <span class="star" data-rating="5" onclick="setRating(5)">★</span>
                    </div>
                    <input type="hidden" id="postRating" value="0">
                </div>
                
                <button type="submit" class="btn-submit">→ Publier</button>
            </form>
        </div>
    </div>

    <!-- Post Detail Modal -->
    <div id="postDetailModal" class="modal-overlay">
        <div class="modal-content post-detail">
            <button class="modal-close" onclick="closePostDetailModal()">&times;</button>
            
            <div id="postDetailContent">
                <!-- Post detail will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Alert -->
    <div id="alert" class="alert"></div>

    <script>
        // ===== GLOBAL VARIABLES =====
        let currentFilter = 'tous';
        let selectedRating = 0;
        let allPosts = [];

        // ===== NAVIGATION MENU =====
        (function(){
            const btn = document.getElementById('hamburgerBtn');
            const menu = document.getElementById('navMenu');
            if (btn && menu) {
                btn.addEventListener('click', function(){
                    menu.classList.toggle('show');
                });
                document.addEventListener('click', function(e){
                    if (!menu.contains(e.target) && !btn.contains(e.target)) {
                        menu.classList.remove('show');
                    }
                });
            }
        })();

        // ===== INITIALIZATION =====
        document.addEventListener('DOMContentLoaded', function() {
            loadPosts();
            
            // Show rating for avis category
            document.getElementById('postCategory').addEventListener('change', function() {
                const ratingGroup = document.getElementById('ratingGroup');
                if (this.value === 'avis') {
                    ratingGroup.style.display = 'block';
                } else {
                    ratingGroup.style.display = 'none';
                }
            });
        });

        // ===== LOAD POSTS =====
        async function loadPosts() {
            showLoading(true);
            
            // Simulation de données pour visualiser l'apparence
            setTimeout(() => {
                allPosts = [
                    {
                        id: 1,
                        category: 'actualite',
                        title: 'Nouvelle fonctionnalité : Suivi en temps réel',
                        content: 'Nous sommes ravis d\'annoncer le lancement de notre nouvelle fonctionnalité de suivi en temps réel ! Vous pouvez maintenant suivre votre commande du début à la fin avec des notifications instantanées. Cette mise à jour améliore considérablement l\'expérience utilisateur et la transparence de nos services.',
                        image: '',
                        author_name: 'Admin kodPwomo',
                        author_email: 'admin@kodpwomo.com',
                        rating: 0,
                        comments_count: 0,
                        created_at: '2025-12-01T10:30:00'
                    },
                    {
                        id: 2,
                        category: 'guide',
                        title: 'Comment passer votre première commande',
                        content: 'Guide complet pour les nouveaux utilisateurs. Étape 1 : Créez votre compte avec votre email universitaire. Étape 2 : Parcourez les produits disponibles dans votre université. Étape 3 : Ajoutez vos articles au panier. Étape 4 : Choisissez votre lieu de livraison. Étape 5 : Confirmez et suivez votre commande !',
                        image: '',
                        author_name: 'Admin kodPwomo',
                        author_email: 'admin@kodpwomo.com',
                        rating: 0,
                        comments_count: 0,
                        created_at: '2025-11-28T14:15:00'
                    },
                    {
                        id: 3,
                        category: 'avis',
                        title: 'Excellent service de livraison !',
                        content: 'J\'ai commandé hier soir et j\'ai reçu ma commande ce matin. L\'agent était très professionnel et courtois. Les produits sont arrivés en parfait état. Je recommande vivement kodPwomo à tous les étudiants !',
                        image: '',
                        author_name: 'Marie Dubois',
                        author_email: 'marie.d@student.com',
                        rating: 5,
                        comments_count: 0,
                        created_at: '2025-12-02T16:45:00'
                    },
                    {
                        id: 4,
                        category: 'avis',
                        title: 'Très satisfait du service',
                        content: 'Première fois que j\'utilise kodPwomo et je suis agréablement surpris. La plateforme est intuitive, les prix sont corrects et la livraison est rapide. Quelques petites suggestions : ajouter plus de choix de produits et peut-être une option de livraison express.',
                        image: '',
                        author_name: 'Jean Martin',
                        author_email: 'jean.m@student.com',
                        rating: 4,
                        comments_count: 0,
                        created_at: '2025-12-01T09:20:00'
                    },
                    {
                        id: 5,
                        category: 'top',
                        title: 'Top 5 Agents du Mois - Novembre 2025',
                        content: 'Félicitations à nos meilleurs agents du mois de novembre ! 🏆\n\n1. Agent Patrick - 156 livraisons\n2. Agent Sophie - 142 livraisons\n3. Agent David - 138 livraisons\n4. Agent Lisa - 125 livraisons\n5. Agent Marc - 118 livraisons\n\nMerci pour votre excellent travail et votre dévouement !',
                        image: '',
                        author_name: 'Admin kodPwomo',
                        author_email: 'admin@kodpwomo.com',
                        rating: 0,
                        comments_count: 0,
                        created_at: '2025-12-01T08:00:00'
                    },
                    {
                        id: 6,
                        category: 'amelioration',
                        title: 'Suggestion : Programme de fidélité',
                        content: 'Bonjour, je suggère la création d\'un programme de fidélité pour les clients réguliers. Par exemple, après 10 commandes, offrir une réduction ou une livraison gratuite. Cela encouragerait les étudiants à utiliser plus souvent la plateforme.',
                        image: '',
                        author_name: 'Claire Laurent',
                        author_email: 'claire.l@student.com',
                        rating: 0,
                        comments_count: 0,
                        created_at: '2025-11-30T11:30:00'
                    },
                    {
                        id: 7,
                        category: 'amelioration',
                        title: 'Ajouter un système de notation des produits',
                        content: 'Ce serait génial de pouvoir noter et commenter les produits après achat. Ça aiderait les autres étudiants à faire de meilleurs choix et ça permettrait aussi aux vendeurs d\'améliorer leurs offres.',
                        image: '',
                        author_name: 'Thomas Petit',
                        author_email: 'thomas.p@student.com',
                        rating: 0,
                        comments_count: 0,
                        created_at: '2025-11-29T15:10:00'
                    },
                    {
                        id: 8,
                        category: 'avis',
                        title: 'Bon service mais quelques améliorations nécessaires',
                        content: 'Dans l\'ensemble, le service est bon. La livraison est généralement rapide et les agents sont sympas. Cependant, j\'ai remarqué que certains produits ne sont pas toujours disponibles alors qu\'ils apparaissent sur le site. Il faudrait améliorer la mise à jour du stock en temps réel.',
                        image: '',
                        author_name: 'Sarah Dupont',
                        author_email: 'sarah.d@student.com',
                        rating: 3,
                        comments_count: 7,
                        created_at: '2025-11-27T13:25:00'
                    }
                ];
                
                displayPosts(allPosts);
                showLoading(false);
            }, 800); // Simule un délai de chargement
        }

        // ===== DISPLAY POSTS =====
        function displayPosts(posts) {
            const list = document.getElementById('postsList');
            list.innerHTML = '';
            
            if (posts.length === 0) {
                showEmptyState();
                return;
            }
            
            document.getElementById('emptyState').style.display = 'none';
            
            posts.forEach(post => {
                const item = createPostItem(post);
                list.appendChild(item);
            });
        }

        // ===== CREATE POST ITEM (NOTIFICATION STYLE) =====
        function createPostItem(post) {
            const item = document.createElement('div');
            item.className = 'post-item';
            
            const icon = getCategoryIcon(post.category);
            const ratingHtml = post.rating > 0 ? `<span class="stat-item">⭐ ${post.rating}/5</span>` : '';
            
            item.innerHTML = `
                <div class="post-icon ${post.category}">${icon}</div>
                <div class="post-info">
                    <div class="post-header">
                        <span class="post-category ${post.category}">${getCategoryLabel(post.category)}</span>
                    </div>
                    <h3 class="post-title">${post.title}</h3>
                    <p class="post-excerpt">${truncateText(post.content, 100)}</p>
                </div>
                <div class="post-meta">
                    <div class="post-author">
                        <div class="author-avatar">${getInitials(post.author_name)}</div>
                        <span>${post.author_name}</span>
                    </div>
                    <span class="post-date">${formatDate(post.created_at)}</span>
                    <div class="post-stats">
                        ${ratingHtml}
                    </div>
                </div>
            `;
            
            // Add view button
            const viewBtn = document.createElement('button');
            viewBtn.className = 'view-more-btn';
            viewBtn.textContent = 'Voir plus';
            viewBtn.onclick = (e) => {
                e.stopPropagation();
                openPostDetail(post);
            };
            item.appendChild(viewBtn);
            
            return item;
        }

        // ===== FILTER POSTS =====
        function filterPosts(category) {
            currentFilter = category;
            
            // Update filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter posts
            if (category === 'tous') {
                displayPosts(allPosts);
            } else {
                const filtered = allPosts.filter(post => post.category === category);
                displayPosts(filtered);
            }
        }

        // ===== RATING SYSTEM =====
        function setRating(rating) {
            selectedRating = rating;
            document.getElementById('postRating').value = rating;
            
            // Update stars
            document.querySelectorAll('.star').forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // ===== SUBMIT POST =====
        async function submitPost(event) {
            event.preventDefault();
            
            const category = document.getElementById('postCategory').value;
            const title = document.getElementById('postTitle').value;
            const content = document.getElementById('postContent').value;
            const rating = parseInt(document.getElementById('postRating').value) || 0;
            
            // Validation
            if (!category || !title || !content) {
                showAlert('Veuillez remplir tous les champs obligatoires', 'error');
                return;
            }
            
            if (category === 'avis' && rating === 0) {
                showAlert('Veuillez donner une note pour votre avis', 'error');
                return;
            }
            
            // Simulation de la soumission
            showAlert('Envoi en cours...', 'success');
            
            setTimeout(() => {
                // Simuler l'ajout du post
                const newPost = {
                    id: allPosts.length + 1,
                    category: category,
                    title: title,
                    content: content,
                    image: '',
                    author_name: 'Vous',
                    author_email: 'user@student.com',
                    rating: rating,
                    comments_count: 0,
                    created_at: new Date().toISOString()
                };
                
                allPosts.unshift(newPost); // Ajouter au début
                displayPosts(currentFilter === 'tous' ? allPosts : allPosts.filter(p => p.category === currentFilter));
                
                showAlert('✅ Publication créée avec succès ! (Mode simulation)', 'success');
                closeAddPostModal();
                
                // Réinitialiser le formulaire
                document.getElementById('addPostForm').reset();
                selectedRating = 0;
                setRating(0);
            }, 1000);
        }

        // ===== OPEN POST DETAIL =====
        function openPostDetail(post) {
            const modal = document.getElementById('postDetailModal');
            const content = document.getElementById('postDetailContent');
            
            const hasImage = post.image && post.image !== '';
            const imageHtml = hasImage 
                ? `<img src="${post.image}" alt="${post.title}" class="post-detail-image">`
                : '';
            
            const ratingHtml = post.rating > 0 
                ? `<div style="margin: 15px 0; font-size: 24px;">⭐ ${post.rating}/5</div>`
                : '';
            
            content.innerHTML = `
                <span class="post-category ${post.category}">${getCategoryLabel(post.category)}</span>
                <h2 class="post-title" style="font-size: 28px; margin: 15px 0;">${post.title}</h2>
                
                <div class="post-meta" style="margin-bottom: 25px;">
                    <div class="post-author">
                        <div class="author-avatar">${getInitials(post.author_name)}</div>
                        <div>
                            <div style="font-weight: 600;">${post.author_name}</div>
                            <div class="post-date">${formatDate(post.created_at)}</div>
                        </div>
                    </div>
                </div>
                
                ${imageHtml}
                ${ratingHtml}
                
                <div class="post-detail-content">
                    ${post.content.replace(/\n/g, '<br>')}
                </div>
                
                
            `;
            
            modal.classList.add('active');
        }

        // ===== MODAL FUNCTIONS =====
        function openAddPostModal() {
            document.getElementById('addPostModal').classList.add('active');
            document.getElementById('addPostForm').reset();
            selectedRating = 0;
            document.querySelectorAll('.star').forEach(star => star.classList.remove('active'));
        }

        function closeAddPostModal() {
            document.getElementById('addPostModal').classList.remove('active');
        }

        function closePostDetailModal() {
            document.getElementById('postDetailModal').classList.remove('active');
        }

        // Close modals on background click
        document.getElementById('addPostModal').addEventListener('click', function(e) {
            if (e.target === this) closeAddPostModal();
        });

        document.getElementById('postDetailModal').addEventListener('click', function(e) {
            if (e.target === this) closePostDetailModal();
        });

        // ===== UTILITY FUNCTIONS =====
        function showLoading(show) {
            document.getElementById('loadingState').style.display = show ? 'block' : 'none';
            document.getElementById('postsList').style.display = show ? 'none' : 'flex';
        }

        function showEmptyState() {
            document.getElementById('emptyState').style.display = 'block';
            document.getElementById('postsList').style.display = 'none';
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

        function getCategoryIcon(category) {
            const icons = {
                'actualite': '📢',
                'guide': '📚',
                'avis': '⭐',
                'top': '🏆',
                'amelioration': '💡'
            };
            return icons[category] || '📝';
        }

        function getCategoryLabel(category) {
            const labels = {
                'actualite': 'Actualité',
                'guide': 'Guide',
                'avis': 'Avis Client',
                'top': 'Top Agents/Clients',
                'amelioration': 'Amélioration'
            };
            return labels[category] || category;
        }

        function getInitials(name) {
            if (!name) return 'U';
            const parts = name.split(' ');
            if (parts.length >= 2) {
                return (parts[0][0] + parts[1][0]).toUpperCase();
            }
            return name.substring(0, 2).toUpperCase();
        }

        function truncateText(text, maxLength) {
            if (text.length <= maxLength) return text;
            return text.substring(0, maxLength) + '...';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays === 0) return "Aujourd'hui";
            if (diffDays === 1) return "Hier";
            if (diffDays < 7) return `Il y a ${diffDays} jours`;
            
            return date.toLocaleDateString('fr-FR', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric' 
            });
        }
    </script>
</body>
</html>
