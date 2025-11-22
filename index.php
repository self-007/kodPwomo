<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KodPwomo - Livraison d'Étudiants pour Étudiants 🎲</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FF8C00;
            --primary-dark: #E67E00;
            --primary-light: #FFB347;
            --secondary: #27AE60;
            --secondary-dark: #1E8449;
            --secondary-light: #52BE80;
            --accent: #FFFFFF;
            --success: #27AE60;
            --warning: #E67E22;
            --error: #E74C3C;
            --info: #3498DB;
            --bg-primary: #F8F9FA;
            --bg-secondary: #FFFFFF;
            --bg-tertiary: #ECF0F1;
            --text-primary: #2C3E50;
            --text-secondary: #34495E;
            --text-muted: #7F8C8D;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(39, 174, 96, 0.2);
            --glass-blur: blur(10px);
            --radius-xl: 1.5rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-xl: 0 25px 50px -12px rgb(255, 140, 0 / 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #F5F7FA;
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 5%;
            background: var(--primary);
            backdrop-filter: blur(10px);
            border-bottom: none;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(255, 140, 0, 0.15);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 900;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #FFFFFF;
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #FFE5CC;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 140, 0, 0.3);
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 2px solid white;
            font-weight: 600;
        }

        .btn-secondary:hover {
            background: transparent;
            color: white;
            border-color: white;
        }

        /* Hero Section */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 5%;
            position: relative;
            overflow: hidden;
            background: #FFFFFF;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            opacity: 0.15;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
            opacity: 0.15;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 900px;
        }

        .hero-badge {
            display: inline-block;
            background: var(--glass-bg);
            border: 2px solid var(--primary);
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            backdrop-filter: var(--glass-blur);
        }

        .hero-title {
            font-size: 5rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Features Section */
        .features {
            padding: 5rem 5%;
            background: #F5F7FA;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 1.2rem;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .feature-card {
            background: #FFFFFF;
            backdrop-filter: var(--glass-blur);
            border: 2px solid #E8E8E8;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            transition: var(--transition);
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 12px 30px rgba(255, 140, 0, 0.15);
        }

        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* How It Works */
        .how-it-works {
            padding: 5rem 5%;
            background: #FFFFFF;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .step {
            position: relative;
            padding: 2rem;
            background: #FFFFFF;
            backdrop-filter: var(--glass-blur);
            border: 2px solid #E8E8E8;
            border-radius: var(--radius-xl);
            text-align: center;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .step:hover {
            border-color: var(--secondary);
            box-shadow: 0 12px 30px rgba(39, 174, 96, 0.12);
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            background: var(--secondary);
            border-radius: 50%;
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
        }

        .step-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .step-description {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Lottery Section */
        .lottery {
            padding: 5rem 5%;
            background: var(--secondary);
            border-top: 3px solid var(--secondary-dark);
            border-bottom: 3px solid var(--secondary-dark);
        }

        .lottery-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .lottery-wheel {
            perspective: 1000px;
        }

        .wheel {
            width: 300px;
            height: 300px;
            margin: 0 auto;
            background: conic-gradient(
                from 0deg,
                #27AE60 0deg 60deg,
                #52BE80 60deg 120deg,
                #FF8C00 120deg 180deg,
                #E67E00 180deg 240deg,
                #FFFFFF 240deg 300deg,
                #FFB347 300deg 360deg
            );
            border-radius: 50%;
            box-shadow: 0 0 40px rgba(255, 140, 0, 0.4);
            animation: spin 3s linear infinite;
            border: 8px solid var(--bg-primary);
            position: relative;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .wheel::after {
            content: '';
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 30px solid var(--primary);
            z-index: 10;
        }

        .lottery-content h3 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            color: #FFFFFF;
        }

        .lottery-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .reward-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .reward-item {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 1.5rem;
            border-radius: 1rem;
            text-align: center;
            transition: var(--transition);
        }

        .reward-item:hover {
            border-color: #FFFFFF;
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.25);
        }

        .reward-percent {
            font-size: 1.8rem;
            font-weight: 900;
            color: #FFFFFF;
            margin-bottom: 0.5rem;
        }

        .reward-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        /* Pricing Section */
        .pricing {
            padding: 5rem 5%;
            background: #F5F7FA;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .pricing-card {
            background: #FFFFFF;
            backdrop-filter: var(--glass-blur);
            border: 2px solid #E8E8E8;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            text-align: center;
            transition: var(--transition);
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .pricing-card:hover {
            border-color: var(--primary);
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(255, 140, 0, 0.15);
        }

        .pricing-card.featured {
            border-color: var(--primary);
            background: #FFF8E8;
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(255, 140, 0, 0.2);
        }

        .pricing-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .pricing-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        .pricing-price {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .pricing-period {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .pricing-features {
            list-style: none;
            text-align: left;
            margin-bottom: 2rem;
        }

        .pricing-features li {
            color: var(--text-secondary);
            padding: 0.75rem 0;
            border-bottom: 1px solid #E8E8E8;
            font-size: 0.95rem;
            position: relative;
            padding-left: 1.5rem;
        }

        .pricing-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--secondary);
            font-weight: bold;
        }

        /* CTA Section */
        .cta {
            padding: 5rem 5%;
            text-align: center;
            background: var(--primary);
            border-top: none;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            color: #FFFFFF;
        }

        .cta-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 400;
        }

        /* Footer */
        footer {
            background: var(--secondary);
            border-top: none;
            padding: 3rem 5%;
            text-align: center;
            color: #FFFFFF;
        }

        .footer-section h4 {
            color: #FFFFFF;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .footer-section a:hover {
            color: #FFFFFF;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .nav-links {
                display: none;
            }

            .lottery-container {
                grid-template-columns: 1fr;
            }

            .pricing-card.featured {
                transform: scale(1);
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">🎲 KodPwomo</div>
        <ul class="nav-links">
            <li><a href="#features">Fonctionnalités</a></li>
            <li><a href="#how">Fonctionnement</a></li>
            <li><a href="#lottery">Loterie</a></li>
            <li><a href="#pricing">Tarifs</a></li>
        </ul>
        <div class="btn-group">
            <a href="login.php" class="btn btn-secondary">Se Connecter</a>
            <a href="register.php" class="btn btn-primary">S'hello</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">🚀 Livraison d'étudiants pour étudiants</div>
            <h1 class="hero-title">Commandez, Livrez, Gagnez 🎲</h1>
            <p class="hero-subtitle">
                KodPwomo est la plateforme révolutionnaire de livraison ultra-rapide sur le campus. 
                Étudiants: commandez ce que vous voulez. Livreurs: gagnez de l'argent flexible. 
                Et à chaque commande, tirez votre chance pour des réductions aléatoires!
            </p>
            <div class="hero-buttons">
                <a href="register.php?role=client" class="btn btn-primary">Je veux commander 🛒</a>
                <a href="register.php?role=livreur" class="btn btn-secondary">Je veux livrer 📦</a>
                <a href="admin/control.php" class="btn btn-secondary">Admin Hub 👑</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Pourquoi KodPwomo?</h2>
        <p class="section-subtitle">
            Une expérience de livraison pensée pour les étudiants, par les étudiants
        </p>
        
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">⚡</span>
                <h3 class="feature-title">Ultra-Rapide</h3>
                <p class="feature-description">
                    Livraison en 15-30 minutes sur tout le campus. Tes produits arrivent frais et chauds!
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-icon">🎲</span>
                <h3 class="feature-title">Loterie Exclusive</h3>
                <p class="feature-description">
                    À chaque commande, tire une boule et gagne des rabais aléatoires de -5% à -50%!
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-icon">💰</span>
                <h3 class="feature-title">Emploi Flexible</h3>
                <p class="feature-description">
                    Livreurs étudiants gagnent 6-8 HTG par livraison. Travaillez quand vous voulez!
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-icon">🏪</span>
                <h3 class="feature-title">Tout en Un</h3>
                <p class="feature-description">
                    Nourriture, fournitures, événements - trouvez tout ce que vous cherchez ici.
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-icon">🎓</span>
                <h3 class="feature-title">Pour le Campus</h3>
                <p class="feature-description">
                    Livraison exclusivement sur votre université. Pas de déplacement, c'est livré à votre salle!
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-icon">📱</span>
                <h3 class="feature-title">App Simple</h3>
                <p class="feature-description">
                    Interface intuitive. 3 clics pour commander. Suivi GPS en temps réel du livreur.
                </p>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how">
        <h2 class="section-title">Comment ça marche?</h2>
        <p class="section-subtitle">Trois étapes simples pour transformer ta vie d'étudiant</p>
        
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1️⃣</div>
                <h3 class="step-title">Sélectionne & Commande</h3>
                <p class="step-description">
                    Choisir ton université, ta boutique, tes produits. Spécifie ta salle. C'est tout!
                </p>
            </div>

            <div class="step">
                <div class="step-number">2️⃣</div>
                <h3 class="step-title">Tire ta Boule!</h3>
                <p class="step-description">
                    Avant de payer, fais tourner la roue. Gagne un rabais aléatoire de -5% à -50%!
                </p>
            </div>

            <div class="step">
                <div class="step-number">3️⃣</div>
                <h3 class="step-title">Reçois ta Commande</h3>
                <p class="step-description">
                    Un étudiant livreur la récupère. Tu reçois une notif. Elle arrive en 15-30 min!
                </p>
            </div>

            <div class="step">
                <div class="step-number">4️⃣</div>
                <h3 class="step-title">Confirme & Évalue</h3>
                <p class="step-description">
                    Tu reçois le colis. Confirme sa réception. Note le livreur. Done!
                </p>
            </div>
        </div>
    </section>

    <!-- Lottery Section -->
    <section class="lottery" id="lottery">
        <div class="lottery-container">
            <div class="lottery-wheel">
                <div class="wheel"></div>
            </div>
            <div class="lottery-content">
                <h3>La Magie du KodPwomo 🎰</h3>
                <p>
                    À chaque commande, tu tournes la roue mystérieuse et tu gagnes un rabais surprise! 
                    C'est comme les machines à sous, mais avec des résultats GAGNANTS pour toi!
                </p>
                <p>
                    Pas de rabais fixe ennuyeux. À chaque fois, tu as une chance de gagner gros. 
                    70% de chance d'économiser 10%+. Et vous pourriez être celui qui gagne -50% ou même GRATUIT!
                </p>
                
                <div class="reward-list">
                    <div class="reward-item">
                        <div class="reward-percent">-5%</div>
                        <div class="reward-label">Décent</div>
                    </div>
                    <div class="reward-item">
                        <div class="reward-percent">-10%</div>
                        <div class="reward-label">Bon</div>
                    </div>
                    <div class="reward-item">
                        <div class="reward-percent">-15%</div>
                        <div class="reward-label">Très Bon</div>
                    </div>
                    <div class="reward-item">
                        <div class="reward-percent">-20%</div>
                        <div class="reward-label">Excellent</div>
                    </div>
                    <div class="reward-item">
                        <div class="reward-percent">-50%</div>
                        <div class="reward-label">WOW! 🎉</div>
                    </div>
                    <div class="reward-item">
                        <div class="reward-percent">GRATUIT</div>
                        <div class="reward-label">JACKPOT! 🏆</div>
                    </div>
                </div>

                <a href="register.php?role=client" class="btn btn-primary">Essayer Maintenant</a>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <h2 class="section-title">Plans & Tarifs</h2>
        <p class="section-subtitle">Choisir le plan qui vous convient</p>
        
        <div class="pricing-grid">
            <div class="pricing-card">
                <h3 class="pricing-title">👤 Client</h3>
                <div class="pricing-price">Gratuit</div>
                <p class="pricing-period">Pour tous les étudiants</p>
                <ul class="pricing-features">
                    <li>Inscription gratuite</li>
                    <li>Accès à tous les commerces</li>
                    <li>Système de loterie</li>
                    <li>Suivi GPS en temps réel</li>
                    <li>Support client 24/7</li>
                </ul>
                <a href="register.php?role=client" class="btn btn-primary">S'Inscrire</a>
            </div>

            <div class="pricing-card featured">
                <div class="pricing-badge">Populaire</div>
                <h3 class="pricing-title">📦 Livreur</h3>
                <div class="pricing-price">6-8</div>
                <p class="pricing-period">HTG par livraison</p>
                <ul class="pricing-features">
                    <li>Travail flexible</li>
                    <li>6 HTG base + bonus</li>
                    <li>Pas de cotisations</li>
                    <li>Système de notation</li>
                    <li>Paiement rapide</li>
                </ul>
                <a href="register.php?role=livreur" class="btn btn-primary">Devenir Livreur</a>
            </div>

            <div class="pricing-card">
                <h3 class="pricing-title">🏪 Commerçant</h3>
                <div class="pricing-price">50</div>
                <p class="pricing-period">HTG/mois (Phase pilot gratuit!)</p>
                <ul class="pricing-features">
                    <li>Gestion catalogue</li>
                    <li>Suivi commandes</li>
                    <li>Analytics vendeurs</li>
                    <li>Support prioritaire</li>
                    <li>Paiements automatiques</li>
                </ul>
                <a href="contact.php?role=merchant" class="btn btn-secondary">Nous Contacter</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2 class="cta-title">Prêt à révolutionner ta vie d'étudiant? 🚀</h2>
        <p class="cta-subtitle">
            Rejoins des milliers d'étudiants qui font déjà partie du mouvement KodPwomo
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="register.php?role=client" class="btn btn-primary">Télécharger l'App</a>
            <a href="register.php?role=livreur" class="btn btn-secondary">Devenir Livreur</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>À Propos</h4>
                <ul>
                    <li><a href="#">Notre Mission</a></li>
                    <li><a href="#">Notre Équipe</a></li>
                    <li><a href="#">Carrières</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Report Issue</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Légal</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookies Policy</a></li>
                    <li><a href="#">Disclaimer</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Suivez-Nous</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">TikTok</a></li>
                    <li><a href="#">WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 KodPwomo. Tous droits réservés. Made with ❤️ for Students.</p>
        </div>
    </footer>

    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .step, .pricing-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });

        // Button hover effects
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>