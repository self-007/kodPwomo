<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KodPwomo Admin Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary: #1e1b4b;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;
            --bg-primary: #0a0a1a;
            --bg-secondary: #1a1625;
            --bg-tertiary: #2d1b69;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-blur: blur(20px);
            --radius-xl: 1.5rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-xl: 0 25px 50px -12px rgb(99 102 241 / 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 50%, var(--bg-tertiary) 100%);
            color: var(--text-primary);
            line-height: 1.5;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .hub-container {
            text-align: center;
            max-width: 1200px;
            width: 100%;
        }

        .hub-header {
            margin-bottom: 4rem;
        }

        .hub-title {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .hub-subtitle {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .hub-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .admin-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: 3rem 2rem;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .admin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .admin-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .admin-card:hover::before {
            opacity: 0.1;
        }

        .card-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .card-description {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-features {
            list-style: none;
            text-align: left;
            margin-bottom: 2rem;
        }

        .card-features li {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .card-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: bold;
        }

        .card-badge {
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .card-badge.manager {
            background: var(--success);
        }

        .card-badge.analytics {
            background: var(--info);
        }

        .card-badge.monitoring {
            background: var(--warning);
        }

        @media (max-width: 768px) {
            .hub-title {
                font-size: 2.5rem;
            }
            
            .admin-grid {
                grid-template-columns: 1fr;
            }
            
            body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="hub-container">
        <div class="hub-header">
            <h1 class="hub-title">🚀 KodPwomo Admin Hub</h1>
            <p class="hub-subtitle">Centre de commande et contrôle de la plateforme</p>
            <p class="hub-description">
                Bienvenue dans le hub administratif de KodPwomo. Accédez à tous les outils 
                de gestion, analytics avancés et monitoring système depuis cette interface centralisée.
            </p>
        </div>

        <div class="admin-grid">
            <!-- Super Admin Interface -->
            <a href="admin-super.php" class="admin-card">
                <span class="card-icon">👑</span>
                <h3 class="card-title">Super Admin Dashboard</h3>
                <p class="card-description">
                    Interface complète de super administration pour la gestion globale de la plateforme
                </p>
                <ul class="card-features">
                    <li>Gestion des universités et managers</li>
                    <li>Monitoring des utilisateurs globaux</li>
                    <li>Supervision des commandes</li>
                    <li>Contrôle des agents de livraison</li>
                    <li>Analytics intégrés</li>
                </ul>
                <span class="card-badge">Super Admin</span>
            </a>

            <!-- Manager Interface -->
            <a href="admin-manager.php" class="admin-card">
                <span class="card-icon">🏫</span>
                <h3 class="card-title">University Manager</h3>
                <p class="card-description">
                    Interface dédiée aux managers universitaires pour la gestion locale
                </p>
                <ul class="card-features">
                    <li>Gestion des étudiants</li>
                    <li>Suivi des commandes campus</li>
                    <li>Analytics universitaires</li>
                    <li>Gestion des produits locaux</li>
                    <li>Support client</li>
                </ul>
                <span class="card-badge manager">Manager</span>
            </a>

            <!-- Advanced Analytics -->
            <a href="analytics.php" class="admin-card">
                <span class="card-icon">📊</span>
                <h3 class="card-title">Advanced Analytics</h3>
                <p class="card-description">
                    Tableaux de bord avancés avec graphiques interactifs et métriques détaillées
                </p>
                <ul class="card-features">
                    <li>Graphiques de revenus</li>
                    <li>Analyse des tendances</li>
                    <li>Performance par université</li>
                    <li>Métriques de livraison</li>
                    <li>Export de données</li>
                </ul>
                <span class="card-badge analytics">Analytics</span>
            </a>

            <!-- System Monitoring -->
            <a href="monitoring.php" class="admin-card">
                <span class="card-icon">🖥️</span>
                <h3 class="card-title">System Monitoring</h3>
                <p class="card-description">
                    Surveillance système en temps réel et logs détaillés
                </p>
                <ul class="card-features">
                    <li>Status des services</li>
                    <li>Logs d'application</li>
                    <li>Alertes système</li>
                    <li>Monitoring performance</li>
                    <li>Diagnostics avancés</li>
                </ul>
                <span class="card-badge monitoring">Monitoring</span>
            </a>
        </div>
    </div>

    <script>
        // Add subtle hover animations
        document.querySelectorAll('.admin-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click feedback
        document.querySelectorAll('.admin-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(99, 102, 241, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS animation for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>