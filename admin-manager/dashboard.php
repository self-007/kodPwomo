<?php
// Dashboard - KodPwomo Admin
// Real-time statistics and key metrics
?>

<style>
    .dashboard {
        display: grid;
        gap: var(--spacing-3);
    }

    /* KPI Cards Grid */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--spacing-3);
        margin-bottom: var(--spacing-4);
    }

    .kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: var(--spacing-3);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .kpi-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
    }

    .kpi-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: var(--spacing-1);
    }

    .kpi-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: var(--spacing-1);
    }

    .kpi-change {
        font-size: 13px;
        font-weight: 600;
    }

    .kpi-change.positive {
        color: var(--brand-success);
    }

    .kpi-change.negative {
        color: var(--brand-danger);
    }

    .kpi-icon {
        position: absolute;
        top: var(--spacing-3);
        right: var(--spacing-3);
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        opacity: 0.8;
    }

    .kpi-icon.primary {
        background: rgba(255, 107, 53, 0.1);
        color: var(--brand-primary);
    }

    .kpi-icon.accent {
        background: rgba(0, 212, 255, 0.1);
        color: var(--brand-accent);
    }

    .kpi-icon.success {
        background: rgba(26, 188, 156, 0.1);
        color: var(--brand-success);
    }

    .kpi-icon.warning {
        background: rgba(243, 156, 18, 0.1);
        color: var(--brand-warning);
    }

    /* Charts Section */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--spacing-3);
        margin-bottom: var(--spacing-4);
    }

    .chart-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: var(--spacing-3);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .chart-title {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: var(--spacing-2);
    }

    .chart-placeholder {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 8px;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 13px;
    }

    /* Activity Table */
    .activity-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: var(--spacing-3);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .activity-title {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: var(--spacing-2);
    }

    .activity-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .activity-table thead {
        background: #f8fafc;
    }

    .activity-table th {
        padding: var(--spacing-2);
        text-align: left;
        font-weight: 600;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
    }

    .activity-table td {
        padding: var(--spacing-2);
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .activity-table tbody tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-badge.completed {
        background: rgba(26, 188, 156, 0.1);
        color: var(--brand-success);
    }

    .status-badge.pending {
        background: rgba(243, 156, 18, 0.1);
        color: var(--brand-warning);
    }

    .status-badge.processing {
        background: rgba(0, 212, 255, 0.1);
        color: var(--brand-accent);
    }

    .status-badge.failed {
        background: rgba(255, 107, 53, 0.1);
        color: var(--brand-danger);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .kpi-grid {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: var(--spacing-2);
        }

        .kpi-card {
            padding: var(--spacing-2);
        }

        .kpi-value {
            font-size: 1.5rem;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="dashboard">
    <!-- Header -->
    <div>
        <h2 style="color: #1a1a2e; margin-bottom: var(--spacing-1);">Dashboard</h2>
        <p style="color: #64748b; margin: 0;">Vue d'ensemble en temps réel des performances</p>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <!-- Total Orders -->
        <div class="kpi-card">
            <div class="kpi-label">Commandes totales</div>
            <div class="kpi-value">1,247</div>
            <div class="kpi-change positive">↑ 12% cette semaine</div>
            <div class="kpi-icon primary">📦</div>
        </div>

        <!-- Active Users -->
        <div class="kpi-card">
            <div class="kpi-label">Utilisateurs actifs</div>
            <div class="kpi-value">542</div>
            <div class="kpi-change positive">↑ 8% aujourd'hui</div>
            <div class="kpi-icon accent">👥</div>
        </div>

        <!-- Revenue -->
        <div class="kpi-card">
            <div class="kpi-label">Chiffre d'affaires</div>
            <div class="kpi-value">45.2K</div>
            <div class="kpi-change positive">↑ 23% ce mois</div>
            <div class="kpi-icon success">💰</div>
        </div>

        <!-- Active Agents -->
        <div class="kpi-card">
            <div class="kpi-label">Agents en ligne</div>
            <div class="kpi-value">28</div>
            <div class="kpi-change negative">↓ 2 hors ligne</div>
            <div class="kpi-icon warning">🚚</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <!-- Orders Chart -->
        <div class="chart-card">
            <div class="chart-title">Commandes - 7 derniers jours</div>
            <div class="chart-placeholder">
                📊 Graphique des commandes (à intégrer avec Chart.js)
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="chart-card">
            <div class="chart-title">Revenu quotidien</div>
            <div class="chart-placeholder">
                📈 Graphique du revenu (à intégrer avec Chart.js)
            </div>
        </div>

        <!-- Users Chart -->
        <div class="chart-card">
            <div class="chart-title">Croissance des utilisateurs</div>
            <div class="chart-placeholder">
                📉 Graphique utilisateurs (à intégrer avec Chart.js)
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-section">
        <div class="activity-title">Activité récente</div>
        <table class="activity-table">
            <thead>
                <tr>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Agent</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#ORD-2025-001247</td>
                    <td>Jean Dupont</td>
                    <td>250 HTG</td>
                    <td>Pierre S.</td>
                    <td><span class="status-badge completed">Complétée</span></td>
                    <td>10/25 14:32</td>
                </tr>
                <tr>
                    <td>#ORD-2025-001246</td>
                    <td>Marie Jean</td>
                    <td>180 HTG</td>
                    <td>Marc L.</td>
                    <td><span class="status-badge processing">En cours</span></td>
                    <td>10/25 13:15</td>
                </tr>
                <tr>
                    <td>#ORD-2025-001245</td>
                    <td>Thomas M.</td>
                    <td>320 HTG</td>
                    <td>Sophie B.</td>
                    <td><span class="status-badge completed">Complétée</span></td>
                    <td>10/25 12:45</td>
                </tr>
                <tr>
                    <td>#ORD-2025-001244</td>
                    <td>Anne C.</td>
                    <td>150 HTG</td>
                    <td>—</td>
                    <td><span class="status-badge pending">En attente</span></td>
                    <td>10/25 11:20</td>
                </tr>
                <tr>
                    <td>#ORD-2025-001243</td>
                    <td>Robert N.</td>
                    <td>420 HTG</td>
                    <td>Pierre S.</td>
                    <td><span class="status-badge completed">Complétée</span></td>
                    <td>10/25 10:05</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<script>
    // Initialize dashboard data fetching
    async function initDashboard() {
        try {
            const response = await fetch('/kodpwomo/backend/dashboard/stats');
            const data = await response.json();
            updateDashboardData(data);
        } catch (error) {
            console.error('Dashboard error:', error);
        }
    }

    function updateDashboardData(data) {
        // Update KPI cards with real data
        // This is a template - replace with actual data binding
        console.log('Dashboard data loaded:', data);
    }

    // Load on page init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDashboard);
    } else {
        initDashboard();
    }
</script>
