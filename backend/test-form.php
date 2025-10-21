<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎯 KodPwomo Super Admin - Formulaire de Test</title>
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
            max-width: 900px;
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
            font-size: 2.2rem;
        }
        
        .form-section {
            margin-bottom: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 5px solid #667eea;
        }
        
        .form-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.4rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
            font-family: 'Courier New', monospace;
        }
        
        .method-select {
            background: #667eea;
            color: white;
            font-weight: bold;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn-clear {
            background: #dc3545;
            margin-left: 10px;
        }
        
        .response-area {
            margin-top: 30px;
            padding: 20px;
            background: #2d3748;
            color: #e2e8f0;
            border-radius: 10px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
        
        .success {
            background: #48bb78;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .error {
            background: #f56565;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .loading {
            background: #4299e1;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .endpoint-info {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 15px;
            font-family: 'Courier New', monospace;
            color: #234e52;
        }
        
        .quick-fills {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        
        .quick-fill-btn {
            background: #4299e1;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
        }
        
        .quick-fill-btn:hover {
            background: #3182ce;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 KodPwomo Super Admin - Formulaire de Test</h1>
        
        <div class="form-section">
            <h2>🔧 Configuration de Test</h2>
            
            <div class="form-group">
                <label for="baseUrl">🌐 Base URL:</label>
                <input type="text" id="baseUrl" value="http://localhost/kodpwomo/backend">
            </div>
            
            <div class="form-group">
                <label for="method">📡 Méthode HTTP:</label>
                <select id="method" class="method-select" onchange="updateEndpoints()">
                    <option value="GET">GET - Récupérer des données</option>
                    <option value="POST">POST - Créer des données</option>
                    <option value="PUT">PUT - Modifier des données</option>
                    <option value="DELETE">DELETE - Supprimer des données</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="endpoint">🎯 Endpoint:</label>
                <select id="endpoint" onchange="updateJsonTemplate()">
                    <!-- Options will be filled by JavaScript -->
                </select>
            </div>
            
            <div class="endpoint-info" id="endpointInfo">
                Sélectionnez un endpoint pour voir les détails
            </div>
        </div>
        
        <div class="form-section">
            <h2>📝 Corps de la Requête (JSON)</h2>
            
            <div class="quick-fills" id="quickFills">
                <!-- Quick fill buttons will be added by JavaScript -->
            </div>
            
            <div class="form-group">
                <label for="jsonBody">Données JSON:</label>
                <textarea id="jsonBody" placeholder="Entrez vos données JSON ici..."></textarea>
            </div>
            
            <button class="btn" onclick="executeTest()">🚀 Exécuter le Test</button>
            <button class="btn btn-clear" onclick="clearResponse()">🗑️ Effacer</button>
        </div>
        
        <div class="response-area" id="responseArea">
            <div class="loading">🚀 Prêt à tester vos endpoints Super Admin KodPwomo!</div>
        </div>
    </div>

    <script>
        const endpoints = {
            'GET': {
                '/dashboard/super': {
                    desc: 'Statistiques du tableau de bord',
                    example: 'Aucun corps requis'
                },
                '/dashboard/super/2024-10': {
                    desc: 'Statistiques pour octobre 2024',
                    example: 'Aucun corps requis'
                },
                '/analytics/super': {
                    desc: 'Données analytiques globales',
                    example: 'Aucun corps requis'
                },
                '/analytics/super/2024-10-20': {
                    desc: 'Analytics pour le 20 octobre 2024',
                    example: 'Aucun corps requis'
                },
                '/university/super': {
                    desc: 'Liste de toutes les universités',
                    example: 'Aucun corps requis'
                },
                '/category/super': {
                    desc: 'Liste de toutes les catégories',
                    example: 'Aucun corps requis'
                }
            },
            'POST': {
                '/university/super': {
                    desc: 'Créer une nouvelle université',
                    example: '{"name": "Université de Kinshasa", "location": "Kinshasa, RDC"}',
                    note: '⚠️ Backend attend aussi $_FILES[\'image\']'
                },
                '/category/super': {
                    desc: 'Créer une nouvelle catégorie',
                    example: '{"name": "Électronique"}',
                    note: '⚠️ Backend attend aussi $_FILES[\'image\']'
                }
            },
            'PUT': {
                '/university/super': {
                    desc: 'Modifier une université existante',
                    example: '{"id": 1, "name": "Université de Kinshasa - Modifiée", "location": "Kinshasa Centre, RDC"}',
                    note: '⚠️ Image optionnelle via $_FILES[\'image\']'
                },
                '/category/super': {
                    desc: 'Modifier une catégorie existante',
                    example: '{"id": 1, "name": "Électronique & Technologie"}',
                    note: '⚠️ Image optionnelle via $_FILES[\'image\']'
                }
            },
            'DELETE': {
                '/category/super': {
                    desc: 'Supprimer une catégorie',
                    example: '{"id": 1}',
                    note: 'Suppression définitive'
                }
            }
        };

        function updateEndpoints() {
            const method = document.getElementById('method').value;
            const endpointSelect = document.getElementById('endpoint');
            const quickFills = document.getElementById('quickFills');
            
            endpointSelect.innerHTML = '';
            quickFills.innerHTML = '';
            
            Object.keys(endpoints[method] || {}).forEach(endpoint => {
                const option = document.createElement('option');
                option.value = endpoint;
                option.textContent = endpoint;
                endpointSelect.appendChild(option);
            });
            
            updateJsonTemplate();
        }
        
        function updateJsonTemplate() {
            const method = document.getElementById('method').value;
            const endpoint = document.getElementById('endpoint').value;
            const jsonBody = document.getElementById('jsonBody');
            const endpointInfo = document.getElementById('endpointInfo');
            const quickFills = document.getElementById('quickFills');
            
            if (endpoints[method] && endpoints[method][endpoint]) {
                const data = endpoints[method][endpoint];
                jsonBody.value = data.example !== 'Aucun corps requis' ? data.example : '';
                
                let info = `<strong>${method} ${endpoint}</strong><br>`;
                info += `Description: ${data.desc}<br>`;
                if (data.note) {
                    info += `<br><span style="color: #d69e2e;">${data.note}</span>`;
                }
                endpointInfo.innerHTML = info;
                
                // Add quick fill buttons
                quickFills.innerHTML = '';
                if (method === 'POST' || method === 'PUT') {
                    const quickBtn = document.createElement('button');
                    quickBtn.className = 'quick-fill-btn';
                    quickBtn.textContent = 'Exemple rapide';
                    quickBtn.onclick = () => {
                        jsonBody.value = data.example;
                    };
                    quickFills.appendChild(quickBtn);
                    
                    if (method === 'PUT' || method === 'DELETE') {
                        const testBtn = document.createElement('button');
                        testBtn.className = 'quick-fill-btn';
                        testBtn.textContent = 'ID Test (5)';
                        testBtn.onclick = () => {
                            const currentData = JSON.parse(data.example);
                            currentData.id = 5;
                            jsonBody.value = JSON.stringify(currentData, null, 2);
                        };
                        quickFills.appendChild(testBtn);
                    }
                }
            }
        }
        
        async function executeTest() {
            const baseUrl = document.getElementById('baseUrl').value;
            const method = document.getElementById('method').value;
            const endpoint = document.getElementById('endpoint').value;
            const jsonBody = document.getElementById('jsonBody').value;
            const responseArea = document.getElementById('responseArea');
            
            if (!endpoint) {
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>Erreur:</strong> Veuillez sélectionner un endpoint
                    </div>
                `;
                return;
            }
            
            let body = null;
            if (jsonBody.trim() && method !== 'GET') {
                try {
                    body = JSON.parse(jsonBody);
                } catch (e) {
                    responseArea.innerHTML += `
                        <div class="error">
                            <strong>Erreur JSON:</strong> ${e.message}
                        </div>
                    `;
                    return;
                }
            }
            
            const timestamp = new Date().toLocaleTimeString();
            responseArea.innerHTML += `<div class="loading">⏳ [${timestamp}] Testing ${method} ${endpoint}...</div>`;
            
            try {
                const options = {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                };
                
                if (body) {
                    options.body = JSON.stringify(body);
                }
                
                const response = await fetch(baseUrl + endpoint, options);
                const data = await response.text();
                
                let jsonData;
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    jsonData = data;
                }
                
                const statusClass = response.ok ? 'success' : 'error';
                
                let resultHtml = `
                    <div class="${statusClass}">
                        <strong>[${timestamp}] ${method} ${endpoint}</strong><br>
                        Status: ${response.status} ${response.statusText}<br>
                `;
                
                if (body) {
                    resultHtml += `Body: <pre>${JSON.stringify(body, null, 2)}</pre><br>`;
                }
                
                resultHtml += `
                        Response: <br>
                        <pre>${JSON.stringify(jsonData, null, 2)}</pre>
                    </div>
                `;
                
                responseArea.innerHTML += resultHtml;
                
            } catch (error) {
                responseArea.innerHTML += `
                    <div class="error">
                        <strong>[${timestamp}] ${method} ${endpoint}</strong><br>
                        Error: ${error.message}
                    </div>
                `;
            }
            
            responseArea.scrollTop = responseArea.scrollHeight;
        }
        
        function clearResponse() {
            document.getElementById('responseArea').innerHTML = '<div class="loading">🚀 Réponses effacées! Prêt pour de nouveaux tests.</div>';
        }
        
        // Initialize on page load
        window.onload = function() {
            updateEndpoints();
        };
    </script>
</body>
</html>