<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌟 KodPwomo Super Admin API Tester</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        
        .test-section {
            margin-bottom: 40px;
            border: 2px solid #e1e8ed;
            border-radius: 15px;
            padding: 25px;
            background: #f8f9fa;
        }
        
        .test-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        
        .test-group {
            margin-bottom: 25px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            border-left: 5px solid #667eea;
        }
        
        .test-group h3 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .test-item {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e1e8ed;
        }
        
        .method {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            min-width: 60px;
            text-align: center;
            font-size: 0.8rem;
        }
        
        .method.GET { background: #28a745; }
        .method.POST { background: #007bff; }
        .method.PUT { background: #ffc107; color: #333; }
        .method.DELETE { background: #dc3545; }
        
        .endpoint {
            flex: 1;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: #495057;
        }
        
        .json-input {
            width: 100%;
            min-height: 80px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            margin-top: 8px;
            resize: vertical;
        }

        .form-section {
            margin-top: 10px;
            padding: 12px;
            background: #fff3cd;
            border-radius: 6px;
            border: 1px solid #ffeaa7;
        }

        .form-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #856404;
            font-size: 0.9rem;
        }
        
        .note {
            margin-top: 8px;
            padding: 6px 10px;
            background: #fff3cd;
            border-left: 3px solid #ffc107;
            border-radius: 3px;
            font-size: 0.8rem;
            color: #856404;
        }
        
        .endpoint {
            flex: 1;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: #495057;
        }
        
        .test-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .test-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .response-area {
            margin-top: 30px;
            padding: 20px;
            background: #2d3748;
            color: #e2e8f0;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .loading {
            color: #ffc107;
        }
        
        .success {
            color: #28a745;
        }
        
        .error {
            color: #dc3545;
        }
        
        .clear-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 15px;
        }
        
        .base-url {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2196f3;
        }
        
        .base-url label {
            font-weight: bold;
            color: #1976d2;
        }
        
        .base-url input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌟 KodPwomo Super Admin API Tester</h1>
        
        <div class="base-url">
            <label for="baseUrl">🌐 Base URL:</label>
            <input type="text" id="baseUrl" value="http://localhost/kodpwomo/backend">
        </div>
        
        <button class="clear-btn" onclick="clearResponse()">🗑️ Effacer les réponses</button>
        
        <!-- SUPER ADMIN ENDPOINTS ONLY -->
        <div class="test-section">
            <h2>🌟 Super Admin Endpoints</h2>
            
            <div class="test-group">
                <h3>Dashboard Super Admin</h3>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/dashboard/super</span>
                    <button class="test-btn" onclick="testAPI('GET', '/dashboard/super')">Test</button>
                </div>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/dashboard/super/2024-10</span>
                    <button class="test-btn" onclick="testAPI('GET', '/dashboard/super/2024-10')">Test</button>
                </div>
            </div>
            
            <div class="test-group">
                <h3>Analytics Super Admin</h3>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/analytics/super</span>
                    <button class="test-btn" onclick="testAPI('GET', '/analytics/super')">Test</button>
                </div>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/analytics/super/2024-10-20</span>
                    <button class="test-btn" onclick="testAPI('GET', '/analytics/super/2024-10-20')">Test</button>
                </div>
            </div>
            
            <div class="test-group">
                <h3>Universities Super Admin</h3>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/university/super</span>
                    <button class="test-btn" onclick="testAPI('GET', '/university/super')">Test</button>
                </div>
            </div>
            
            <div class="test-group">
                <h3>Categories Super Admin - GET</h3>
                <div class="test-item">
                    <span class="method GET">GET</span>
                    <span class="endpoint">/category/super</span>
                    <button class="test-btn" onclick="testAPI('GET', '/category/super')">Test</button>
                </div>
            </div>
            
            <div class="test-group">
                <h3>Universities Super Admin - CRUD</h3>
                <div class="test-item">
                    <span class="method POST">POST</span>
                    <span class="endpoint">/university/super</span>
                    <button class="test-btn" onclick="testPOST('/university/super', 'createUniversity')">Test</button>
                </div>
                <div class="form-section" id="createUniversity" style="display:none;">
                    <label>JSON Body:</label>
                    <textarea class="json-input" placeholder='{"name": "Université de Kinshasa", "location": "Kinshasa, RDC"}'></textarea>
                    <button class="test-btn" onclick="executePOST('/university/super', 'createUniversity')" style="margin-top: 8px;">Exécuter</button>
                    <div class="note">⚠️ Backend attend aussi $_FILES['image']</div>
                </div>
                
                <div class="test-item">
                    <span class="method PUT">PUT</span>
                    <span class="endpoint">/university/super</span>
                    <button class="test-btn" onclick="testPOST('/university/super', 'updateUniversity')">Test</button>
                </div>
                <div class="form-section" id="updateUniversity" style="display:none;">
                    <label>JSON Body:</label>
                    <textarea class="json-input" placeholder='{"id": 1, "name": "Université de Kinshasa - Modifiée", "location": "Kinshasa Centre, RDC"}'></textarea>
                    <button class="test-btn" onclick="executePUT('/university/super', 'updateUniversity')" style="margin-top: 8px;">Exécuter</button>
                    <div class="note">⚠️ Image optionnelle via $_FILES['image']</div>
                </div>
            </div>
            
            <div class="test-group">
                <h3>Categories Super Admin - CRUD</h3>
                <div class="test-item">
                    <span class="method POST">POST</span>
                    <span class="endpoint">/category/super</span>
                    <button class="test-btn" onclick="testPOST('/category/super', 'createCategory')">Test</button>
                </div>
                <div class="form-section" id="createCategory" style="display:none;">
                    <label>JSON Body:</label>
                    <textarea class="json-input" placeholder='{"name": "Électronique"}'></textarea>
                    <button class="test-btn" onclick="executePOST('/category/super', 'createCategory')" style="margin-top: 8px;">Exécuter</button>
                    <div class="note">⚠️ Backend attend aussi $_FILES['image']</div>
                </div>
                
                <div class="test-item">
                    <span class="method PUT">PUT</span>
                    <span class="endpoint">/category/super</span>
                    <button class="test-btn" onclick="testPOST('/category/super', 'updateCategorySuper')">Test</button>
                </div>
                <div class="form-section" id="updateCategorySuper" style="display:none;">
                    <label>JSON Body:</label>
                    <textarea class="json-input" placeholder='{"id": 1, "name": "Électronique & Technologie"}'></textarea>
                    <button class="test-btn" onclick="executePUT('/category/super', 'updateCategorySuper')" style="margin-top: 8px;">Exécuter</button>
                    <div class="note">⚠️ Image optionnelle via $_FILES['image']</div>
                </div>
                
                <div class="test-item">
                    <span class="method DELETE">DELETE</span>
                    <span class="endpoint">/category/super</span>
                    <button class="test-btn" onclick="testPOST('/category/super', 'deleteCategorySuper')">Test</button>
                </div>
                <div class="form-section" id="deleteCategorySuper" style="display:none;">
                    <label>JSON Body:</label>
                    <textarea class="json-input" placeholder='{"id": 1}'></textarea>
                    <button class="test-btn" onclick="executeDELETE('/category/super', 'deleteCategorySuper')" style="margin-top: 8px;">Exécuter</button>
                </div>
            </div>
        </div>
        
        <div class="response-area" id="responseArea">
            <div class="loading">🚀 Prêt à tester les endpoints Super Admin KodPwomo!</div>
        </div>
    </div>

    <script>
        async function testAPI(method, endpoint) {
            const baseUrl = document.getElementById('baseUrl').value;
            const responseArea = document.getElementById('responseArea');
            
            responseArea.innerHTML = `<div class="loading">⏳ Testing ${method} ${endpoint}...</div>`;
            
            try {
                const response = await fetch(baseUrl + endpoint, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                const data = await response.text();
                let jsonData;
                
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    jsonData = data;
                }
                
                const timestamp = new Date().toLocaleTimeString();
                const statusClass = response.ok ? 'success' : 'error';
                
                responseArea.innerHTML += `
                    <div class="${statusClass}">
                        <strong>[${timestamp}] ${method} ${endpoint}</strong><br>
                        Status: ${response.status} ${response.statusText}<br>
                        Response: <br>
                        <pre>${JSON.stringify(jsonData, null, 2)}</pre>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                
            } catch (error) {
                const timestamp = new Date().toLocaleTimeString();
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>[${timestamp}] ${method} ${endpoint}</strong><br>
                        Error: ${error.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
            }
            
            responseArea.scrollTop = responseArea.scrollHeight;
        }
        
        function testPOST(endpoint, formId) {
            const formSection = document.getElementById(formId);
            formSection.style.display = formSection.style.display === 'none' ? 'block' : 'none';
        }
        
        async function executePOST(endpoint, formId) {
            const baseUrl = document.getElementById('baseUrl').value;
            const responseArea = document.getElementById('responseArea');
            const formSection = document.getElementById(formId);
            const jsonInput = formSection.querySelector('.json-input');
            
            let body;
            try {
                body = JSON.parse(jsonInput.value || jsonInput.placeholder);
            } catch (e) {
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>JSON Parse Error:</strong> ${e.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                return;
            }
            
            responseArea.innerHTML += `<div class="loading">⏳ Testing POST ${endpoint}...</div>`;
            
            try {
                const response = await fetch(baseUrl + endpoint, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                
                const data = await response.text();
                let jsonData;
                
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    jsonData = data;
                }
                
                const timestamp = new Date().toLocaleTimeString();
                const statusClass = response.ok ? 'success' : 'error';
                
                responseArea.innerHTML += `
                    <div class="${statusClass}">
                        <strong>[${timestamp}] POST ${endpoint}</strong><br>
                        Body: <pre>${JSON.stringify(body, null, 2)}</pre><br>
                        Status: ${response.status} ${response.statusText}<br>
                        Response: <br>
                        <pre>${JSON.stringify(jsonData, null, 2)}</pre>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                
            } catch (error) {
                const timestamp = new Date().toLocaleTimeString();
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>[${timestamp}] POST ${endpoint}</strong><br>
                        Error: ${error.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
            }
            
            responseArea.scrollTop = responseArea.scrollHeight;
        }
        
        async function executePUT(endpoint, formId) {
            const baseUrl = document.getElementById('baseUrl').value;
            const responseArea = document.getElementById('responseArea');
            const formSection = document.getElementById(formId);
            const jsonInput = formSection.querySelector('.json-input');
            
            let body;
            try {
                body = JSON.parse(jsonInput.value || jsonInput.placeholder);
            } catch (e) {
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>JSON Parse Error:</strong> ${e.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                return;
            }
            
            responseArea.innerHTML += `<div class="loading">⏳ Testing PUT ${endpoint}...</div>`;
            
            try {
                const response = await fetch(baseUrl + endpoint, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                
                const data = await response.text();
                let jsonData;
                
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    jsonData = data;
                }
                
                const timestamp = new Date().toLocaleTimeString();
                const statusClass = response.ok ? 'success' : 'error';
                
                responseArea.innerHTML += `
                    <div class="${statusClass}">
                        <strong>[${timestamp}] PUT ${endpoint}</strong><br>
                        Body: <pre>${JSON.stringify(body, null, 2)}</pre><br>
                        Status: ${response.status} ${response.statusText}<br>
                        Response: <br>
                        <pre>${JSON.stringify(jsonData, null, 2)}</pre>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                
            } catch (error) {
                const timestamp = new Date().toLocaleTimeString();
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>[${timestamp}] PUT ${endpoint}</strong><br>
                        Error: ${error.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
            }
            
            responseArea.scrollTop = responseArea.scrollHeight;
        }
        
        async function executeDELETE(endpoint, formId) {
            const baseUrl = document.getElementById('baseUrl').value;
            const responseArea = document.getElementById('responseArea');
            const formSection = document.getElementById(formId);
            const jsonInput = formSection.querySelector('.json-input');
            
            let body;
            try {
                body = JSON.parse(jsonInput.value || jsonInput.placeholder);
            } catch (e) {
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>JSON Parse Error:</strong> ${e.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                return;
            }
            
            responseArea.innerHTML += `<div class="loading">⏳ Testing DELETE ${endpoint}...</div>`;
            
            try {
                const response = await fetch(baseUrl + endpoint, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                
                const data = await response.text();
                let jsonData;
                
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    jsonData = data;
                }
                
                const timestamp = new Date().toLocaleTimeString();
                const statusClass = response.ok ? 'success' : 'error';
                
                responseArea.innerHTML += `
                    <div class="${statusClass}">
                        <strong>[${timestamp}] DELETE ${endpoint}</strong><br>
                        Body: <pre>${JSON.stringify(body, null, 2)}</pre><br>
                        Status: ${response.status} ${response.statusText}<br>
                        Response: <br>
                        <pre>${JSON.stringify(jsonData, null, 2)}</pre>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
                
            } catch (error) {
                const timestamp = new Date().toLocaleTimeString();
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>[${timestamp}] DELETE ${endpoint}</strong><br>
                        Error: ${error.message}<br>
                        <hr style="margin: 15px 0; border-color: #4a5568;">
                    </div>
                `;
            }
            
            responseArea.scrollTop = responseArea.scrollHeight;
        }
        
        function clearResponse() {
            document.getElementById('responseArea').innerHTML = '<div class="loading">🚀 Réponses effacées! Prêt pour de nouveaux tests Super Admin.</div>';
        }
    </script>
</body>
</html>