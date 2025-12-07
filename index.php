<?php
// kodPwomo - Version améliorée basée sur wireframes
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kodPwomo - Livraison Campus | Commande, On livre, Tu étudies 🎓</title>
    <link rel="icon" type="image/png" href="image/logo/logo1.1.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        :root {
            --primary: #f7b642;
            --primary-dark: #E67E00;
            --secondary: #27AE60;
            --secondary-dark: #1E8449;
            --bg: #F8F9FA;
            --text: #1c1a63ff;
            --text-muted: #7F8C8D;
            --card: #FFFFFF;
            --radius: 16px;
            --shadow: 0 10px 30px rgba(0,0,0,0.08);
            --shadow-hover: 0 15px 40px rgba(0,0,0,0.12);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0; display: block; }
        
        /* Header Sticky */
        header {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            font-size: 24px;
            color: var(--primary);
        }
        
        .logo img { height: 40px; border-radius: 8px; }
        
        nav { display: none; }
        
        .btn {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }
        
        .btn-outline {
            background: white;
            color: var(--text);
            border: 1px solid #e5e7eb;
        }
        .btn-outline:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .btn-secondary {
            background: var(--secondary);
            color: white;
        }
        .btn-secondary:hover {
            background: var(--secondary-dark);
        }
        
        /* Hero Section - FORT & IMPACTANT */
        .hero {
            background: white;
            padding: 50px 10px 40px;
            margin-top: 0;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, -30px) scale(1.1); }
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .hero h3 {
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            color: var(--text);
        }
        
        .hero p {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 40px;
        }
        
        .hero-cta {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .hero-visual {
            background: rgba(248,249,250,0.5);
            border-radius: 16px;
            padding: 20px;
            
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
		.hero-visual img {
			width: 100%;
			height: auto;
			border-radius: 12px;
			box-shadow: var(--shadow);
			/*animation: float 6s ease-in-out infinite;*/
		}
        
        @media (max-width: 768px) {
            .hero {
                grid-template-columns: 1fr;
            }
            .hero h3 {
                font-size: 28px;
            }
            .hero-visual {
                height: 180px;
            }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Badge Section */
        .badge-strip {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(8px);
            padding: 16px;
            text-align: center;
            border-radius: 12px;
            margin: -20px auto 30px;
            max-width: 1200px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            display: none;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 16px;
        }
        
        .badge-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .badge-item .icon {
            font-size: 24px;
        }
        
        .badge-item strong {
            font-size: 14px;
            color: var(--text);
        }
        
        .badge-item span {
            color: var(--text-muted);
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .badge-strip {
                flex-direction: column;
                gap: 12px;
            }
        }
        
        /* Section Title */
        .section {
            padding: 60px 10px;
        }
        
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .section-header h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .section-header p {
            color: var(--text-muted);
            font-size: 16px;
        }
        
        /* Problème / Solution */
        .problem-solution {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .problem-solution {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
        
        .ps-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            transition: all 0.3s;
            text-align: center;
        }
        
        .ps-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.16);
        }
        
        .ps-card .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        
        .ps-card h3 {
            font-size: 14px;
            margin-bottom: 4px;
            color: #2a2680ff;
        }
        
        .ps-card .problem {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .ps-card .solution {
            background: linear-gradient(135deg, rgba(39,174,96,0.1), rgba(39,174,96,0.05));
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--secondary-dark);
        }
        
        /* Carousel Produits */
        .product-section {
            background: rgba(248,249,250,0.4);
        }
        
        .product-carousel-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        
        .product-carousel {
            display: flex;
            gap: 16px;
            overflow: hidden;
            padding: 10px 0;
            position: relative;
        }
        
        .product-carousel-track {
            display: flex;
            gap: 16px;
            animation: scroll 30s linear infinite;
        }
        
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .product-carousel:hover .product-carousel-track {
            animation-play-state: paused;
        }
        
        .product-carousel-item {
            min-width: 200px;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }
        
        .product-carousel-item:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        
        .product-carousel-image {
            width: 100%;
            height: 150px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            position: relative;
        }
        
        .product-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--secondary);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
        }
        
        .product-carousel-info {
            padding: 12px;
            text-align: center;
        }
        
        .product-carousel-info h4 {
            font-size: 14px;
            margin-bottom: 4px;
        }
        
        .product-carousel-info .price {
            font-size: 16px;
            font-weight: 800;
            color: green;
        }
        
        .product-cta-section {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        /* Témoignages + Stats */
        .trust-section {
            background: rgba(248,249,250,0.5);
        }
        
        .testimonials {
            display: flex;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto 10px;
            overflow: hidden;
            position: relative;
        }
        
        .testimonials-track {
            display: flex;
            gap: 20px;
            animation: scrollTestimonials 25s linear infinite;
        }
        
        @keyframes scrollTestimonials {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .testimonials:hover .testimonials-track {
            animation-play-state: paused;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            min-width: 350px;
            flex-shrink: 0;
        }
        
        .testimonial-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2px;
        }
        
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2a2680ff;
            font-weight: 700;
            font-size: 18px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .testimonial-info h5 {
            font-size: 14px;
            margin-bottom: 2px;
        }
        
        .stars {
            color: #2a2680ff;
            font-size: 10px;
        }
        
        .testimonial-card p {
            color: var(--text-muted);
            font-size: 14px;
            font-style: italic;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        }
        
        
        .stat-card .label {
            color: var(--text-muted);
            font-size: 14px;
        }
        
        /* Comment ça marche */
        .how-it-works {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        @media (max-width: 992px) {
            .how-it-works {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .how-it-works {
                grid-template-columns: 1fr;
            }
        }
        
        .step-card {
            text-align: center;
            position: relative;
            transition: transform 0.3s ease;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: transparent;
            color: #243692ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            margin: 0 auto 10px;
            box-shadow: 0 6px 20px rgba(0, 5, 7, 0.39);
        }
        
        .step-card h4 {
            margin-bottom: 8px;
        }
        
        .step-card p {
            color: var(--text-muted);
            font-size: 14px;
        }
        
        /* CTA Final */
        .final-cta {
            background: #1f3065ff;
            padding: 40px 10px;
            text-align: center;
            color: white;
			box-shadow: 0 6px 20px rgba(0, 0, 0, 0.58);
            border-radius: 12px;
		}
        
        .final-cta h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        
        .final-cta p {
            font-size: 14px;
            margin-bottom: 2px;
            opacity: 0.95;
        }
        
        .final-cta .btn {
            background: transparent;
            color: var(--primary);
            font-size: 18px;
            padding: 14px 32px;
			box-shadow: 0 6px 20px rgba(229, 233, 234, 0.39);
        }
        
        .final-cta .btn:hover {
            transform: scale(1.05);
        }
        
        /* Footer */
        footer {
            background: rgba(255,255,255,0.02);
            backdrop-filter: blur(10px);
            box-shadow: 0 -4px 16px rgba(96, 96, 96, 0.42);
            color: #162867ff;
            padding: 60px 10px 0;
            margin-top: 10px;
            position: relative;
			border-radius: 12px;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 30px;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
        
        .footer-section h4 {
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 700;
            color: #1c1d64ff;
            text-shadow: 0 2px 8px rgba(30, 144, 255, 0.4), 0 0 12px rgba(30, 144, 255, 0.2);
            letter-spacing: 0.5px;
        }
        
        .footer-section p {
            font-size: 14px;
            line-height: 1.6;
			color: rgba(34, 26, 118, 0.8);
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section li {
            margin-bottom: 8px;
        }
        
        .footer-section a {
            color: rgba(34, 26, 118, 0.8);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
        }
        
        .footer-section a:hover {
            color: #FFD700;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.6), 0 0 16px rgba(255, 215, 0, 0.3);
            transform: translateX(4px);
        }
        
        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(30, 144, 255, 0.1);
            border: 1.5px solid rgba(30, 144, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 18px;
            box-shadow: 0 0 8px rgba(30, 144, 255, 0.2);
        }
        
        .social-links a:hover {
            background: #FFD700;
            border-color: #FFD700;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 24px rgba(255, 215, 0, 0.5), 0 0 16px rgba(255, 215, 0, 0.3);
        }
        
        .footer-bottom {
            text-align: center;
            padding: 30px 0 20px;
            
            color: rgba(44, 26, 143, 1);
            font-size: 13px;
            background: rgba(23, 61, 98, 0.03) !important;
            margin-top: 40px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        
        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
            }
            
            .hero h3 {
                font-size: 20px;
            }
        
        @media (min-width: 768px) and (max-width: 968px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .testimonials,
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Header Sticky -->
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="image/logo/logo1.1.jpg" alt="kodPwomo">
                
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="login.php" class="btn btn-outline">Connexion</a>
                <a href="login.php" class="btn btn-primary">Inscription</a>
            </div>
        </div>
    </header>

    <!-- Hero Section - FORT -->
    <section id="accueil" class="hero">
        <div class="hero-content">
            <div>
                <h3>Commande depuis ta salle de classe Et nous On s'occupe du reste. </h3>
                <p>Bienvenue sur kodPwomo, la premiere platforme de livraison sur les campus universitaire d'haiti Dis nous sur quel campus vous etes et nous vous apporterons ce que vous voudrez.</p>
                <div class="hero-cta">
                    <a href="boutique.php" class="btn btn-primary" style="font-size: 14px; padding: 8px 18px;">
                        a propros
                    </a>
                    <a href="#comment" class="btn btn-outline" style="font-size: 13px; padding: 8px 18px;">Comment ça marche</a>
                </div>
                <div style="margin-top: 20px; display: flex; gap: 20px; color: var(--text-muted); font-size: 13px;">
                    <span><ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Livraison en 15 min</span>
                    <span><ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Agents certifiés</span>
                    <span><ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Paiement sécurisé</span>
                </div>
            </div>
            <div class="hero-visual">
                
                <img src="image/OIP.webp" alt="hero">
                
            </div>
        </div>
    </section>

    <!-- Badge Strip -->
    <div class="container">
        <div class="badge-strip fade-in">
            <div class="badge-item">
                <span class="icon">👥</span>
                <div>
                    <strong>5 000+</strong><br>
                    <span>Étudiants actifs</span>
                </div>
            </div>
            <div class="badge-item">
                <span class="icon">⚡</span>
                <div>
                    <strong>15 min</strong><br>
                    <span>Livraison moyenne</span>
                </div>
            </div>
            <div class="badge-item">
                <span class="icon">🏫</span>
                <div>
                    <strong>6 Campus</strong><br>
                    <span>Partenaires</span>
                </div>
            </div>
            <div class="badge-item">
                <span class="icon"><ion-icon name="star" style="color: #FFD700;"></ion-icon></span>
                <div>
                    <strong>4.8/5</strong><br>
                    <span>Satisfaction</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Problème / Solution -->
    <section id="services" class="section">
        <div class="section-header fade-in">
            <h2>On résout tes vrais problèmes d'étudiant</h2>
            <p>Tu connais ces galères ? Voici comment on les règle.</p>
        </div>
        <div class="problem-solution">
            <div class="ps-card fade-in">
                <div class="icon">⏱️</div>
                <h3>Plus de temps perdu</h3>
                <p class="problem"><ion-icon name="close-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Faire la queue, traverser le campus, perdre 1h par jour</p>
                <div class="solution"><ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Commande en 30 sec, livraison interne rapide</div>
            </div>
            <div class="ps-card fade-in">
                <div class="icon">❓</div>
                <h3>Disponibilité garantie</h3>
                <p class="problem"><ion-icon name="close-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Tu te déplaces et le produit n'est plus disponible</p>
                <div class="solution"><ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Catalogue en temps réel par campus</div>
            </div>
            <div class="ps-card fade-in">
                <div class="icon"><ion-icon name="lock-closed" style="font-size: 48px;"></ion-icon></div>
                <h3>Confiance & Sécurité</h3>
                <p class="problem"><ion-icon name="close-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Tu ne sais pas qui livre, pas de suivi</p>
                <div class="solution">✅ Agents certifiés + tracking en direct</div>
            </div>
        </div>
    </section>

    <!-- Carousel Produits -->
    <section class="section product-section">
        <div class="section-header fade-in">
            <h2>Nos produits populaires</h2>
            <p>Découvre ce que nos étudiants commandent le plus.</p>
        </div>
        
        <div class="container">
            <div class="product-carousel-container fade-in">
                <div class="product-carousel">
                    <div class="product-carousel-track">
                        <!-- Product 1 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="fast-food" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge">Populaire</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Burger Complet</h4>
                                <div class="price">350 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 2 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="pizza" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Pizza Margherita</h4>
                                <div class="price">450 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 3 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="cafe" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge" style="background: #E74C3C;">Promo</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Café + Croissant</h4>
                                <div class="price">180 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 4 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="book" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Pack Fournitures</h4>
                                <div class="price">550 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 5 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="water" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge">Populaire</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Jus Naturel</h4>
                                <div class="price">120 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 6 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="nutrition" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Wrap Poulet</h4>
                                <div class="price">280 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 7 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="headset" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Location Écouteurs</h4>
                                <div class="price">50 HTG/j</div>
                            </div>
                        </div>
                        
                        <!-- Product 8 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="package" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge" style="background: #3498DB;">Nouveau</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Service Colis</h4>
                                <div class="price">100 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 9 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="flame" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Frites + Sauce</h4>
                                <div class="price">150 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Product 10 -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="leaf" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Salade Fraîche</h4>
                                <div class="price">320 HTG</div>
                            </div>
                        </div>
                        
                        <!-- Duplicate for infinite loop -->
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                🍔
                                <span class="product-badge">Populaire</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Burger Complet</h4>
                                <div class="price">350 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">🍕</div>
                            <div class="product-carousel-info">
                                <h4>Pizza Margherita</h4>
                                <div class="price">450 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                ☕
                                <span class="product-badge" style="background: #E74C3C;">Promo</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Café + Croissant</h4>
                                <div class="price">180 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="book" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Pack Fournitures</h4>
                                <div class="price">550 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="water" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge">Populaire</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Jus Naturel</h4>
                                <div class="price">120 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="nutrition" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Wrap Poulet</h4>
                                <div class="price">280 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image"><ion-icon name="headset" style="font-size: 48px;"></ion-icon></div>
                            <div class="product-carousel-info">
                                <h4>Location Écouteurs</h4>
                                <div class="price">50 HTG/j</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">
                                <ion-icon name="package" style="font-size: 48px;"></ion-icon>
                                <span class="product-badge" style="background: #3498DB;">Nouveau</span>
                            </div>
                            <div class="product-carousel-info">
                                <h4>Service Colis</h4>
                                <div class="price">100 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">🍟</div>
                            <div class="product-carousel-info">
                                <h4>Frites + Sauce</h4>
                                <div class="price">150 HTG</div>
                            </div>
                        </div>
                        
                        <div class="product-carousel-item">
                            <div class="product-carousel-image">🥗</div>
                            <div class="product-carousel-info">
                                <h4>Salade Fraîche</h4>
                                <div class="price">320 HTG</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="product-cta-section fade-in">
                <a href="boutique.php" class="btn btn-outline" style="font-size: 13px; padding: 8px 16px;">
                    📖 Voir notre catalogue complet
                </a>
                <a href="boutique.php" class="btn btn-primary" style="font-size: 13px; padding: 8px 16px;">
                    🛒 Commander maintenant
                </a>
            </div>
        </div>
    </section>

    <!-- Témoignages + Stats -->
    <section id="campus" class="section trust-section">
        <div class="section-header fade-in">
            <h2>Ils nous font confiance</h2>
            <p>Des milliers d'étudiants utilisent kodPwomo chaque jour.</p>
        </div>
        
        <div class="container">
            <div class="testimonials">
                <div class="testimonials-track">
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">M</div>
                            <div class="testimonial-info">
                                <h5>Marie-Claire, UEH</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Je commande entre deux cours, c'est livré avant la pause. Je gagne tellement de temps !"</p>
                    </div>
                    
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">J</div>
                            <div class="testimonial-info">
                                <h5>Jean-Baptiste, Quisqueya</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Le suivi en temps réel me rassure. Et les agents sont toujours sympas et pro."</p>
                    </div>
                    
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">S</div>
                            <div class="testimonial-info">
                                <h5>Sarah, UNDH</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Plus besoin de courir au resto. Je me concentre sur mes études, kodPwomo gère le reste."</p>
                    </div>
                    
                    <!-- Duplicate for infinite scroll -->
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">M</div>
                            <div class="testimonial-info">
                                <h5>Marie-Claire, UEH</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Je commande entre deux cours, c'est livré avant la pause. Je gagne tellement de temps !"</p>
                    </div>
                    
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">J</div>
                            <div class="testimonial-info">
                                <h5>Jean-Baptiste, Quisqueya</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Le suivi en temps réel me rassure. Et les agents sont toujours sympas et pro."</p>
                    </div>
                    
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="avatar">S</div>
                            <div class="testimonial-info">
                                <h5>Sarah, UNDH</h5>
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p>"Plus besoin de courir au resto. Je me concentre sur mes études, kodPwomo gère le reste."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comment ça marche -->
    <section id="comment" class="section">
        <div class="section-header fade-in">
            <h2>Comment ça marche ?</h2>
            <p>En 4 étapes simples, tu reçois ta commande sur ton campus.</p>
        </div>
        
        <div class="container">
            <div class="how-it-works">
                <div class="step-card fade-in">
                    <div class="step-number">1</div>
                    <h4>Tu commandes</h4>
                    <p>Choisis tes produits sur l'app ou le site en 30 secondes.</p>
                </div>
                <div class="step-card fade-in">
                    <div class="step-number">2</div>
                    <h4>Agent accepte</h4>
                    <p>Un agent étudiant certifié prend ta commande.</p>
                </div>
                <div class="step-card fade-in">
                    <div class="step-number">3</div>
                    <h4>Suivi en direct</h4>
                    <p>Tu reçois des notifications et vois l'avancement.</p>
                </div>
                <div class="step-card fade-in">
                    <div class="step-number">4</div>
                    <h4>Tu reçois</h4>
                    <p>Livraison avec code, tu notes l'agent. Simple !</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="final-cta">
        <h2>pret a revolutinner ta vie d'etidiant?<br>Concentre-toi sur l'essentiel. </h2>
        <p>Crée ton compte en 30 secondes et profite de la livraison interne sur ton campus.</p>
        <a href="login.php" class="btn" style="font-size: 14px; padding: 8px 20px;">Créer mon compte gratuitement</a>
        <div style="margin-top: 20px; font-size: 13px; opacity: 0.9;">
            <ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Inscription gratuite • <ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Première livraison offerte • <ion-icon name="checkmark-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Support 7j/7
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h4><ion-icon name="sparkles" style="vertical-align: middle; margin-right: 5px;"></ion-icon>À propos de kodPwomo</h4>
                <p style="color: rgba(32, 43, 101, 0.7); margin-bottom: 16px;">
                    La première plateforme de livraison interne sur campus en Haïti. 
                    Modernise ta vie étudiante avec nous.
                </p>
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 12px; color: rgba(255,255,255,0.5); margin-bottom: 8px;">Nous suivre:</p>
                    <div class="social-links">
                        <a href="#" title="Facebook"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="#" title="Instagram"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="#" title="Twitter"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="#" title="YouTube"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-section">
                <h4><ion-icon name="link" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Liens rapides</h4>
                <ul>
                    <li><a href="boutique.php"><ion-icon name="bag-handle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Boutique</a></li>
                    <li><a href="agent.php"><ion-icon name="bicycle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Devenir agent</a></li>
                    <li><a href="blog.php"><ion-icon name="document-text" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Blog & Guides</a></li>
                    <li><a href="#"><ion-icon name="help-circle" style="vertical-align: middle; margin-right: 5px;"></ion-icon>FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4><ion-icon name="scale" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Légal</h4>
                <ul>
                    <li><a href="#"><ion-icon name="document" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Mentions légales</a></li>
                    <li><a href="#"><ion-icon name="list" style="vertical-align: middle; margin-right: 5px;"></ion-icon>CGU</a></li>
                    <li><a href="#"><ion-icon name="lock-closed" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Politique de confidentialité</a></li>
                    <li><a href="#"><ion-icon name="shield" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Cookies</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4><ion-icon name="call" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Contact</h4>
                <ul>
                    <li><a href="mailto:support@kodpwomo.com"><ion-icon name="mail" style="vertical-align: middle; margin-right: 5px;"></ion-icon>support@kodpwomo.com</a></li>
                    <li><a href="tel:+509XXXXXXXX"><ion-icon name="phone-portrait" style="vertical-align: middle; margin-right: 5px;"></ion-icon>+509 XXXX XXXX</a></li>
                    <li><a href="#"><ion-icon name="location" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Port-au-Prince, Haïti</a></li>
                    <li><a href="#"><ion-icon name="time" style="vertical-align: middle; margin-right: 5px;"></ion-icon>Lun-Ven: 8h-18h</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            © <?php echo date('Y'); ?> kodPwomo - Tous droits réservés • Projet en cours de légalisation auprès du Ministère du Commerce
        </div>
    </footer>

    <script>
        // Intersection Observer pour fade-in
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
