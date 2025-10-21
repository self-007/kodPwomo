<?php
// Test API KodPwomo - Version PHP
$currentTime = date('Y-m-d H:i:s');
$serverInfo = [
    'server' => $_SERVER['HTTP_HOST'],
    'php_version' => phpversion(),
    'current_time' => $currentTime
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API KodPwomo - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        button { padding: 10px 15px; margin: 5px; background: #007cba; color: white; border: none; cursor: pointer; }
        button:hover { background: #005a8b; }
        .result { background: #f5f5f5; padding: 15px; margin: 10px 0; border: 1px solid #ddd; }
        .error { background: #ffebee; color: #c62828; }
        .success { background: #e8f5e8; color: #2e7d32; }
        input { padding: 8px; margin: 5px; border: 1px solid #ddd; }
        h2 { color: #333; border-bottom: 2px solid #007cba; padding-bottom: 5px; }
    </style>
</head>
<body>
    <h1>🧪 Test API KodPwomo Backend - PHP</h1>
    
    <div class="server-info" style="background: #e3f2fd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <strong>ℹ️ Infos Serveur:</strong>
        <ul style="margin: 5px 0;">
            <li>Serveur: <?php echo htmlspecialchars($serverInfo['server']); ?></li>
            <li>PHP Version: <?php echo htmlspecialchars($serverInfo['php_version']); ?></li>
            <li>Heure actuelle: <?php echo htmlspecialchars($serverInfo['current_time']); ?></li>
        </ul>
    </div>
    
    <h2>📊 Analytics Routes</h2>
    <div>
        <label>University ID:</label>
        <input type="number" id="universityId" value="1" min="1">
        <button onclick="testAnalytics()">Test Analytics Basic</button>
        <button onclick="testAnalyticsWithSearch()">Test Analytics avec Search</button>
    </div>
    
    <div>
        <label>Page:</label>
        <input type="number" id="pageNum" value="1" min="1">
        <label>Search (date):</label>
        <input type="text" id="searchDate" value="2025-10-13" placeholder="YYYY-MM-DD">
        <label>Search (text):</label>
        <input type="text" id="searchText" value="jean" placeholder="jean, marie, cours...">
    </div>

    <h2>👥 Users Routes</h2>
    <div>
        <button onclick="testUsers()">Test Users</button>
        <button onclick="testUsersAdm()">Test Users Admin</button>
        <button onclick="testUsersAdmWithPagination()">Test Users Admin + Pagination</button>
    </div>

    <h2>📦 Products Routes</h2>
    <div>
        <button onclick="testProducts()">Test Products</button>
        <button onclick="testProductsByUniversity()">Test Products by University</button>
        <button onclick="testProductsAdm()">Test Products Admin</button>
        <button onclick="testProductsAdmWithPagination()">Test Products Admin + Pagination</button>
    </div>

    <h2>🛒 Orders Routes</h2>
    <div>
        <button onclick="testOrders()">Test Orders</button>
        <button onclick="testOrdersByUniversity()">Test Orders by University</button>
        <button onclick="testOrdersAdmWithPagination()">Test Orders Admin + Pagination</button>
    </div>

    <h2>🚚 Agents Routes</h2>
    <div>
        <button onclick="testAgentsAdm()">Test Agents Admin</button>
        <button onclick="testAgentsAdmWithPagination()">Test Agents Admin + Pagination</button>
    </div>

    <h2>🏫 Universities Routes</h2>
    <div>
        <button onclick="testUniversities()">Test Universities</button>
        <button onclick="testUniversityById()">Test University by ID</button>
    </div>

    <h2>🧪 Tests de Base</h2>
    <div>
        <button onclick="testBackendIndex()">Test Backend Index</button>
        <button onclick="testBackendDirectly()">Test Backend Direct</button>
        <button onclick="testKodpwomoBackend()">Test Kodpwomo Backend</button>
        <button onclick="testKodpwomoBackendIndex()">Test Kodpwomo Backend Index</button>
    </div>

    <h2>📈 Dashboard</h2>
    <div>
        <button onclick="testDashboard()">Test Dashboard Stats</button>
    </div>

    <div id="results">
        <h2>🔍 Résultats :</h2>
    </div>

    <script>
        const serverInfo = <?php echo json_encode($serverInfo); ?>;
        
        function addResult(title, data, isError = false) {
            const results = document.getElementById('results');
            const div = document.createElement('div');
            div.className = `result ${isError ? 'error' : 'success'}`;
            div.innerHTML = `
                <h3>${title}</h3>
                <pre>${JSON.stringify(data, null, 2)}</pre>
                <small>Timestamp: ${new Date().toLocaleString()}</small>
            `;
            results.appendChild(div);
            div.scrollIntoView({ behavior: 'smooth' });
        }

        async function makeRequest(url, title) {
            try {
                console.log(`Testing: ${url}`);

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                console.log(`Response status: ${response.status}`);
                console.log(`Response headers:`, response.headers);

                // Read as text first to avoid Unexpected end of JSON input
                const raw = await response.text();

                if (response.ok) {
                    if (!raw || raw.trim() === '') {
                        // No content
                        addResult(`✅ ${title}`, null);
                        return;
                    }

                    try {
                        const data = JSON.parse(raw);
                        addResult(`✅ ${title}`, data);
                    } catch (e) {
                        // Response not valid JSON
                        addResult(`✅ ${title} (non-JSON)`, { raw: raw }, false);
                    }
                } else {
                    addResult(`❌ ${title} - Error ${response.status}`, {
                        status: response.status,
                        error: raw
                    }, true);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                addResult(`❌ ${title} - Network Error`, { error: error.message }, true);
            }
        }

        function testAnalytics() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/analytics/adm/${universityId}`;
            makeRequest(url, 'Analytics Basic');
        }

        function testAnalyticsWithSearch() {
            const pageNum = document.getElementById('pageNum').value;
            const searchDate = document.getElementById('searchDate').value;
            const url = `backend/analytics/adm/page/${pageNum}/${encodeURIComponent(searchDate)}`;
            makeRequest(url, 'Analytics avec Search');
        }

        function testUsers() {
            const url = `backend/users`;
            makeRequest(url, 'All Users');
        }

        function testUsersAdm() {
            const url = `backend/users/adm`;
            makeRequest(url, 'Users Admin');
        }

        function testProducts() {
            const url = `backend/products`;
            makeRequest(url, 'All Products');
        }

        function testProductsByUniversity() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/products/${universityId}`;
            makeRequest(url, 'Products by University');
        }

        function testProductsAdm() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/products/adm/${universityId}`;
            makeRequest(url, 'Products Admin');
        }

        function testOrders() {
            const url = `backend/orders`;
            makeRequest(url, 'All Orders');
        }

        function testOrdersByUniversity() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/orders/adm/${universityId}`;
            makeRequest(url, 'Orders Admin by University');
        }

        function testUniversities() {
            const url = `backend/universities`;
            makeRequest(url, 'All Universities');
        }

        function testUniversityById() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/universities/${universityId}`;
            makeRequest(url, 'University by ID');
        }

        function testDashboard() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/dashboard/adm/${universityId}`;
            makeRequest(url, 'Dashboard Stats');
        }

        // Tests Admin avec pagination
        function testUsersAdmWithPagination() {
            const pageNum = document.getElementById('pageNum').value;
            const searchText = document.getElementById('searchText').value;
            const url = `backend/users/adm/page/${pageNum}/${encodeURIComponent(searchText)}`;
            makeRequest(url, 'Users Admin avec Pagination');
        }

        function testProductsAdmWithPagination() {
            const pageNum = document.getElementById('pageNum').value;
            const searchText = document.getElementById('searchText').value;
            const url = `backend/products/adm/page/${pageNum}/${encodeURIComponent(searchText)}`;
            makeRequest(url, 'Products Admin avec Pagination');
        }

        function testOrdersAdmWithPagination() {
            const pageNum = document.getElementById('pageNum').value;
            const searchText = document.getElementById('searchText').value;
            const url = `backend/orders/adm/page/${pageNum}/${encodeURIComponent(searchText)}`;
            makeRequest(url, 'Orders Admin avec Pagination');
        }

        function testAgentsAdm() {
            const universityId = document.getElementById('universityId').value;
            const url = `backend/agents/adm/${universityId}`;
            makeRequest(url, 'Agents Admin');
        }

        function testAgentsAdmWithPagination() {
            const pageNum = document.getElementById('pageNum').value;
            const searchText = document.getElementById('searchText').value;
            const url = `backend/agents/adm/page/${pageNum}/${encodeURIComponent(searchText)}`;
            makeRequest(url, 'Agents Admin avec Pagination');
        }

        // Tests de debug
        function testBackendIndex() {
            const url = '/backend/';
            makeRequest(url, 'Backend Index');
        }

        function testBackendDirectly() {
            const url = '/backend/index.php';
            makeRequest(url, 'Backend Direct');
        }

        function testKodpwomoBackend() {
            const url = '/kodpwomo/backend/';
            makeRequest(url, 'Kodpwomo Backend');
        }

        function testKodpwomoBackendIndex() {
            const url = '/kodpwomo/backend/index.php';
            makeRequest(url, 'Kodpwomo Backend Index');
        }

        // Clear results button
        function clearResults() {
            const results = document.getElementById('results');
            results.innerHTML = '<h2>🔍 Résultats :</h2>';
        }

        // Add clear button
        document.addEventListener('DOMContentLoaded', function() {
            const clearBtn = document.createElement('button');
            clearBtn.textContent = '🗑️ Clear Results';
            clearBtn.onclick = clearResults;
            clearBtn.style.background = '#d32f2f';
            document.body.insertBefore(clearBtn, document.getElementById('results'));
        });
    </script>
</body>
</html>