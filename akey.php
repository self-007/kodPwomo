<?php
// akey.php - Homepage for student service platform
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusFlow - Livraison intra-campus pour étudiants</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --secondary: #ec4899;
            --dark: #1f2937;
            --light: #f9fafb;
            --accent: #10b981;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* HEADER */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: var(--dark);
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: var(--primary);
        }

        .header-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .btn-login {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
        }

        .btn-signup {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* HERO SECTION */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .hero-content {
            max-width: 700px;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            line-height: 1.2;
            font-weight: 800;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .btn-cta {
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            font-size: 1rem;
            font-weight: 700;
        }

        .btn-cta:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }

        /* SECTIONS */
        .section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
            color: var(--dark);
        }

        /* PROBLEM/SOLUTION */
        .problems {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .problem-card {
            background: var(--light);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .problem-card:nth-child(1) { animation-delay: 0.2s; }
        .problem-card:nth-child(2) { animation-delay: 0.4s; }
        .problem-card:nth-child(3) { animation-delay: 0.6s; }

        .problem-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .problem-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .problem-card p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        /* FEATURES */
        .features {
            background: var(--light);
            border-radius: 12px;
            padding: 3rem 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
        }

        .feature {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary);
            transition: all 0.3s;
        }

        .feature:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .feature h4 {
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* TESTIMONIALS */
        .testimonials {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .testimonial {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-top: 4px solid var(--accent);
        }

        .stars {
            color: #fbbf24;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .testimonial p {
            margin-bottom: 1rem;
            color: #6b7280;
            font-style: italic;
        }

        .author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .author-info h4 {
            margin: 0;
            font-size: 0.95rem;
        }

        .author-info p {
            margin: 0;
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* STATS */
        .stats {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 12px;
            padding: 3rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* FINAL CTA */
        .final-cta {
            background: var(--light);
            text-align: center;
            padding: 4rem 2rem;
            border-radius: 12px;
        }

        .final-cta h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .final-cta p {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        /* FOOTER */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem;
            margin-top: 5rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
        }

        .footer-section a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
            font-size: 0.9rem;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            text-align: center;
            color: #9ca3af;
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header-container {
                padding: 1rem;
            }

            nav {
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            nav.active {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                padding: 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo">🎓 CampusFlow</div>
            <nav id="nav">
                <a href="#accueil">Accueil</a>
                <a href="#comment">Comment ça marche</a>
                <a href="#services">Services</a>
                <a href="#campus">Campus</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="header-buttons">
                <a href="#login" class="btn btn-login">Connexion</a>
                <a href="#signup" class="btn btn-signup">Inscription</a>
            </div>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero" id="accueil">
        <div class="hero-content">
            <h1>On t'apporte ce dont tu as besoin, directement sur ton campus</h1>
            <p>Fini les trajets inutiles. Reçois tes colis, tes repas et tes commandes en moins de 30 min, livrés par tes camarades.</p>
            <button class="btn btn-cta">Commencer maintenant</button>
        </div>
    </section>

    <!-- PROBLEMS/SOLUTIONS -->
    <section class="section" id="comment">
        <h2 class="section-title">Les défis des étudiants, nos solutions</h2>
        <div class="problems">
            <div class="problem-card">
                <div class="icon">⏱️</div>
                <h3>Pas assez de temps</h3>
                <p>Entre cours, projets et vie sociale, qui a le temps de faire les courses ?</p>
            </div>
            <div class="problem-card">
                <div class="icon">🚗</div>
                <h3>Les trajets coûtent cher</h3>
                <p>Transport, essence, parking... ça s'accumule vite et ça grève le budget étudiant.</p>
            </div>
            <div class="problem-card">
                <div class="icon">🤝</div>
                <h3>Envie de créer du lien</h3>
                <p>Travailler avec tes camarades, créer une communauté sur le campus, c'est plus sympa.</p>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="section" id="services">
        <h2 class="section-title">Pourquoi CampusFlow ?</h2>
        <div class="features">
            <div class="features-grid">
                <div class="feature">
                    <h4>⚡ Ultra rapide</h4>
                    <p>Livraison en moins de 30 minutes, 24h/24, 7j/7. Vraiment.</p>
                </div>
                <div class="feature">
                    <h4>📍 Suivi en temps réel</h4>
                    <p>Sais où est ta commande, minute par minute, sur une carte.</p>
                </div>
                <div class="feature">
                    <h4>👥 Agents étudiants</h4>
                    <p>Livreurs = étudiants du campus. Gagne 15-20€ par livraison.</p>
                </div>
                <div class="feature">
                    <h4>🔒 Sécurisé & discrèt</h4>
                    <p>Emballage sécurisé, paiement sécurisé, respect de ta vie privée.</p>
                </div>
                <div class="feature">
                    <h4>💸 Sans frais cachés</h4>
                    <p>Un prix, c'est un prix. Pas de surprise à la livraison.</p>
                </div>
                <div class="feature">
                    <h4>🎁 Avantages étudiant</h4>
                    <p>Codes promo exclusifs, cashback, accès VIP à des offres spéciales.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="section">
        <h2 class="section-title">Ce que disent les étudiants</h2>
        <div class="testimonials">
            <div class="testimonial">
                <div class="stars">★★★★★</div>
                <p>"J'ai changé ma vie. J'ai gagné 2h par semaine et 50€ en la proposant à mes amis !"</p>
                <div class="author">
                    <div class="avatar">MR</div>
                    <div class="author-info">
                        <h4>Marie R.</h4>
                        <p>Licence 2 - Droit</p>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="stars">★★★★★</div>
                <p>"Les livreurs sont trop rapides. Commandé un café à 14h, reçu à 14h07. Incroyable !"</p>
                <div class="author">
                    <div class="avatar">TP</div>
                    <div class="author-info">
                        <h4>Thomas P.</h4>
                        <p>Master 1 - Informatique</p>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="stars">★★★★★</div>
                <p>"Super pour gagner de l'argent de poche. Je fais 10-15 livraisons par semaine facilement."</p>
                <div class="author">
                    <div class="avatar">SL</div>
                    <div class="author-info">
                        <h4>Sophie L.</h4>
                        <p>Licence 3 - AES</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="section" id="campus">
        <div class="stats">
            <div class="stats-grid">
                <div>
                    <div class="stat">45k+</div>
                    <div class="stat-label">Étudiants actifs</div>
                </div>
                <div>
                    <div class="stat">18 min</div>
                    <div class="stat-label">Temps moyen livraison</div>
                </div>
                <div>
                    <div class="stat">23</div>
                    <div class="stat-label">Campus partenaires</div>
                </div>
                <div>
                    <div class="stat">2M+</div>
                    <div class="stat-label">Livraisons réalisées</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="section">
        <div class="final-cta">
            <h2>Commence aujourd'hui. Gagne du temps. Concentre-toi sur l'essentiel.</h2>
            <p>Rejoins 45 000 étudiants qui te font déjà confiance</p>
            <button class="btn btn-signup" style="font-size: 1rem; padding: 1rem 2.5rem;">Créer mon compte</button>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Produit</h4>
                <a href="#">Comment ça marche</a>
                <a href="#">Devenir livreur</a>
                <a href="#">Nos partenaires</a>
                <a href="#">Blog</a>
            </div>
            <div class="footer-section">
                <h4>Légal</h4>
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">CGU</a>
                <a href="#">RGPD</a>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <a href="#">Centre d'aide</a>
                <a href="#">Contact</a>
                <a href="#">Email: support@campusflow.fr</a>
            </div>
            <div class="footer-section">
                <h4>Nous suivre</h4>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">TikTok</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 CampusFlow. Tous droits réservés. | Livraison ultra-rapide sur ton campus</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const nav = document.getElementById('nav');
            nav.classList.toggle('active');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                    document.getElementById('nav').classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>