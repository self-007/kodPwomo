# 🧪 KodPwomo Backend API - Documentation de Test

## 📋 Base URL
```
http://localhost/kodpwomo/backend
```

## 🔐 Headers requis
```
Content-Type: application/json
Accept: application/json
```

---

## 🏷️ **1. ENDPOINTS PUBLICS (GET)**

### 📦 **Products**
```bash
# Obtenir tous les produits
GET /kodpwomo/backend/products
Response: { "products": [...], "total": int }

# Obtenir produits par université
GET /kodpwomo/backend/products/1
Response: { "products": [...], "total": int, "university": "..." }
```

### 🏛️ **Categories**
```bash
# Obtenir toutes les catégories
GET /kodpwomo/backend/categories
Response: { "categories": [...], "total": int }

# Obtenir catégorie par ID
GET /kodpwomo/backend/categories/1
Response: { "id": 1, "name": "...", "description": "..." }
```

### 👥 **Users**
```bash
# Obtenir tous les utilisateurs
GET /kodpwomo/backend/users
Response: { "users": [...], "total": int }

# Obtenir utilisateur par ID
GET /kodpwomo/backend/users/abc123
Response: { "id_unique": "abc123", "name": "...", "email": "..." }
```

### 📝 **Orders**
```bash
# Obtenir toutes les commandes
GET /kodpwomo/backend/orders
Response: { "orders": [...], "nbrs": int }

# Obtenir commande par ID
GET /kodpwomo/backend/orders/ORD123
Response: { "order_id": "ORD123", "status": "...", "products": [...] }
```

### 🏫 **Universities**
```bash
# Obtenir toutes les universités
GET /kodpwomo/backend/universities
Response: { "universities": [...], "nbrs": int }

# Obtenir université par ID
GET /kodpwomo/backend/universities/1
Response: { "id": 1, "name": "...", "location": "..." }
```

### 📍 **Places**
```bash
# Obtenir lieux par université
GET /kodpwomo/backend/places/1
Response: { "places": [...], "total": int }
```

---

## 🚚 **2. ENDPOINTS AGENTS**

### 👨‍💼 **Agent Availability**
```bash
# Vérifier disponibilité agent
GET /kodpwomo/backend/agents/availability/AGT123
Response: { "agent_id": "AGT123", "available": boolean, "status": "..." }

# Mettre à jour disponibilité
PUT /kodpwomo/backend/agents/availability
Body: { "agent_id": "AGT123", "available": true }
Response: { "message": "Availability updated successfully" }
```

### 📊 **Agent Stats**
```bash
# Statistiques agent
GET /kodpwomo/backend/deliveries/agent/AGT123
Response: {
  "nbrsTotalDeliveries": int,
  "totalAmount": float,
  "lastMonthDeliveries": [...],
  "totalEarnedLastMonth": float
}
```

### 🔄 **Agent Processing Orders**
```bash
# commandes en cours par agent
GET /kodpwomo/backend/deliveries/agent/orderProcess/AGT123
Response: {
  "deliveries": [...],
  "nbrs": int
}
```

---

## 🎯 **3. ENDPOINTS ADMIN (University Level)**

### 📊 **Dashboard Admin**
```bash
# Dashboard stats par université
GET /kodpwomo/backend/dashboard/adm/1
Response: {
  "totalUsers": int,
  "universityProducts": int,
  "universityOrders": int,
  "monthRevenue": float,
  "university": "...",
  "orders": { "orders": [...], "nbrs": int }
}
```

### 👥 **Users Admin**
```bash
# Tous les utilisateurs (admin)
GET /kodpwomo/backend/users/adm
Response: { "users": [...], "total": int }

# Avec pagination et recherche
GET /kodpwomo/backend/users/adm/page/2/john
Response: { "users": [...], "total": int, "pagination": {...} }
```

### 📦 **Products Admin**
```bash
# Produits par université (admin)
GET /kodpwomo/backend/products/adm/1
Response: { "products": [...], "total": int, "pagination": {...}, "categories": [...] }

# Avec pagination et recherche
GET /kodpwomo/backend/products/adm/page/1/pizza
Response: { "products": [...], "total": int, "pagination": {...} }
```

### 📝 **Orders Admin**
```bash
# Commandes par université (admin)
GET /kodpwomo/backend/orders/adm/1
Response: { "orders": [...], "total": int, "pagination": {...} }

# Avec pagination et recherche
GET /kodpwomo/backend/orders/adm/page/1/ORD123
Response: { "orders": [...], "total": int, "pagination": {...} }
```

### 👨‍💼 **Agents Admin**
```bash
# Agents par université (admin)
GET /kodpwomo/backend/agents/adm/1
Response: { "orders": [...], "total_agents": int, "pagination": {...} }

# Avec pagination et recherche
GET /kodpwomo/backend/agents/adm/page/1/john
Response: { "orders": [...], "total_agents": int, "pagination": {...} }
```

### 📈 **Analytics Admin**
```bash
# Analytics par université
GET /kodpwomo/backend/analytics/adm/1
Response: {
  "overview": {...},
  "dailyOrders": {...},
  "topCustomers": {...},
  "topAgents": {...}
}

# Avec filtre de date
GET /kodpwomo/backend/analytics/adm/page/1/2024-10-20
Response: { /* données filtrées par date */ }
```

---

## 🌟 **4. ENDPOINTS SUPER ADMIN**

### 🏆 **Dashboard Super Admin**
```bash
# Dashboard global
GET /kodpwomo/backend/dashboard/super
Response: {
  "totalUsers": int,
  "Products": int,
  "Orders": int,
  "monthRevenue": float,
  "university": int,
  "places": int,
  "notifications": int
}

# Dashboard avec filtre mensuel
GET /kodpwomo/backend/dashboard/super/2024-10
Response: { /* données du mois spécifié */ }
```

### 📊 **Analytics Super Admin**
```bash
# Analytics globales
GET /kodpwomo/backend/analytics/super
Response: {
  "overview": {...},
  "dailyOrders": {...},
  "topCustomers": {...},
  "topAgents": {...}
}

# Analytics avec filtre de date
GET /kodpwomo/backend/analytics/super/2024-10-20
Response: { /* données filtrées */ }
```

---

## 🔧 **5. ENDPOINTS POST (Création)**

### 📦 **Créer Produit**
```bash
POST /kodpwomo/backend/products
Content-Type: application/json

Body:
{
  "name": "Pizza Margherita",
  "description": "Délicieuse pizza italienne",
  "price": 2500,
  "id_category": 1,
  "id_university": 1,
  "image_url": "https://example.com/pizza.jpg",
  "available": true
}

Response: { "message": "Product created successfully", "id": int }
```

### 🏷️ **Créer Catégorie**
```bash
POST /kodpwomo/backend/categories
Content-Type: application/json

Body:
{
  "name": "Plats Principaux",
  "description": "Nos délicieux plats principaux"
}

Response: { "message": "Category created successfully", "id": int }
```

### 👤 **Créer Utilisateur**
```bash
POST /kodpwomo/backend/users
Content-Type: application/json

Body:
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+243123456789",
  "id_university": 1,
  "role": "client"
}

Response: { "message": "User created successfully", "otp_sent": true }
```

### 📱 **Vérifier OTP**
```bash
POST /kodpwomo/backend/verify-otp
Content-Type: application/json

Body:
{
  "email": "john@example.com",
  "otp": "123456"
}

Response: { "message": "OTP verified successfully", "user": {...} }
```

### 🔄 **Renvoyer OTP**
```bash
POST /kodpwomo/backend/resend-otp
Content-Type: application/json

Body:
{
  "email": "john@example.com"
}

Response: { "message": "OTP resent successfully" }
```

### 🛒 **Créer Commande**
```bash
POST /kodpwomo/backend/orders
Content-Type: application/json

Body:
{
  "id_user": "USR123",
  "id_product": 1,
  "qnt": 2,
  "adresse_id": 1,
  "note": "Pas d'oignons s'il vous plaît"
}

Response: { "message": "Order created successfully", "order_id": "ORD123" }
```

### 🔔 **Créer Notification**
```bash
POST /kodpwomo/backend/notifications
Content-Type: application/json

Body:
{
  "user_id": "USR123",
  "title": "Commande confirmée",
  "message": "Votre commande a été confirmée",
  "type": "order_confirmation"
}

Response: { "message": "Notification created successfully" }
```

### 📍 **Créer Lieu**
```bash
POST /kodpwomo/backend/places
Content-Type: application/json

Body:
{
  "salle_name": "Amphithéâtre A",
  "id_university": 1,
  "description": "Grand amphithéâtre principal"
}

Response: { "message": "Place created successfully", "id": int }
```

---

## ✏️ **6. ENDPOINTS PUT (Mise à jour)**

### 📦 **Mettre à jour Produit**
```bash
PUT /kodpwomo/backend/products
Content-Type: application/json

Body:
{
  "id": 1,
  "name": "Pizza Margherita Deluxe",
  "price": 3000,
  "available": true
}

Response: { "message": "Product updated successfully" }
```

### 🔄 **Changer disponibilité produit**
```bash
PUT /kodpwomo/backend/products/availability
Content-Type: application/json

Body:
{
  "product_id": 1,
  "available": false
}

Response: { "message": "Product availability updated" }
```

### 👤 **Mettre à jour Utilisateur**
```bash
PUT /kodpwomo/backend/users
Content-Type: application/json

Body:
{
  "id": "USR123",
  "name": "John Doe Updated",
  "status": "active"
}

Response: { "message": "User updated successfully" }
```

### 🎭 **Changer rôle utilisateur**
```bash
PUT /kodpwomo/backend/user/role
Content-Type: application/json

Body:
{
  "user_id": "USR123",
  "role": "agent"
}

Response: { "message": "User role updated successfully" }
```

### ✅ **Changer statut utilisateur**
```bash
PUT /kodpwomo/backend/users/status
Content-Type: application/json

Body:
{
  "user_id": "USR123",
  "status": "inactive"
}

Response: { "message": "User status updated successfully" }
```

### 🔍 **Vérifier compte utilisateur**
```bash
PUT /kodpwomo/backend/users/verify
Content-Type: application/json

Body:
{
  "user_id": "USR123",
  "verified": true
}

Response: { "message": "User verification status updated" }
```

---

## 🧪 **7. TESTS PRATIQUES**

### Test 1: Flow complet utilisateur
```bash
# 1. Créer un utilisateur
POST /kodpwomo/backend/users
{
  "name": "Test User",
  "email": "test@kodpwomo.com",
  "phone": "+243987654321",
  "id_university": 1,
  "role": "client"
}

# 2. Vérifier l'OTP (utilisez l'OTP reçu)
POST /kodpwomo/backend/verify-otp
{
  "email": "test@kodpwomo.com",
  "otp": "123456"
}

# 3. Créer une commande
POST /kodpwomo/backend/orders
{
  "id_user": "[ID_RETURNED_FROM_STEP_2]",
  "id_product": 1,
  "qnt": 1,
  "adresse_id": 1,
  "note": "Test order"
}
```

### Test 2: Dashboard Admin
```bash
# 1. Obtenir stats dashboard
GET /kodpwomo/backend/dashboard/adm/1

# 2. Obtenir utilisateurs avec pagination
GET /kodpwomo/backend/users/adm/page/1/test

# 3. Obtenir analytics
GET /kodpwomo/backend/analytics/adm/1
```

### Test 3: Super Admin
```bash
# 1. Dashboard global
GET /kodpwomo/backend/dashboard/super

# 2. Analytics globales avec filtre
GET /kodpwomo/backend/analytics/super/2024-10-20
```

---

## ⚠️ **8. CODES D'ERREUR POSSIBLES**

- **200**: Succès
- **201**: Créé avec succès
- **400**: Données invalides
- **404**: Ressource non trouvée
- **500**: Erreur serveur

### Exemples d'erreurs:
```json
{
  "error": "Invalid university ID",
  "code": 400
}

{
  "error": "Endpoint not found: /invalid/path Method: GET",
  "code": 404
}
```

---

## 🔧 **9. OUTILS DE TEST RECOMMANDÉS**

### Postman Collection
```json
{
  "info": {
    "name": "KodPwomo API Tests",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "variable": [
    {
      "key": "base_url",
      "value": "http://localhost/kodpwomo/backend"
    }
  ]
}
```

### cURL Examples
```bash
# Test dashboard super admin
curl -X GET \
  "http://localhost/kodpwomo/backend/dashboard/super" \
  -H "Accept: application/json"

# Test création utilisateur
curl -X POST \
  "http://localhost/kodpwomo/backend/users" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "phone": "+243123456789",
    "id_university": 1,
    "role": "client"
  }'
```

### JavaScript/Fetch Examples
```javascript
// Test dashboard
async function testDashboard() {
  const response = await fetch('/kodpwomo/backend/dashboard/super', {
    method: 'GET',
    headers: {
      'Accept': 'application/json'
    }
  });
  const data = await response.json();
  console.log('Dashboard data:', data);
}

// Test création commande
async function testCreateOrder() {
  const response = await fetch('/kodpwomo/backend/orders', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      id_user: 'USR123',
      id_product: 1,
      qnt: 2,
      adresse_id: 1,
      note: 'Test order'
    })
  });
  const data = await response.json();
  console.log('Order created:', data);
}
```

---

## 📝 **10. CHECKLIST DE TESTS**

### ✅ Tests Basiques
- [ ] GET /products - Liste tous les produits
- [ ] GET /users - Liste tous les utilisateurs  
- [ ] GET /orders - Liste toutes les commandes
- [ ] GET /universities - Liste toutes les universités

### ✅ Tests Admin
- [ ] GET /dashboard/adm/1 - Dashboard université
- [ ] GET /users/adm - Utilisateurs admin
- [ ] GET /analytics/adm/1 - Analytics université

### ✅ Tests Super Admin
- [ ] GET /dashboard/super - Dashboard global
- [ ] GET /analytics/super - Analytics globales

### ✅ Tests CRUD
- [ ] POST /users - Créer utilisateur
- [ ] POST /orders - Créer commande
- [ ] PUT /users - Mettre à jour utilisateur
- [ ] PUT /products/availability - Changer disponibilité

### ✅ Tests Agents
- [ ] GET /agents/availability/AGT123 - Vérifier disponibilité
- [ ] PUT /agents/availability - Mettre à jour disponibilité
- [ ] GET /deliveries/agent/AGT123 - Stats agent

---

## 🎯 **Bonne chance avec vos tests!** 

Ce document couvre tous les endpoints de votre API KodPwomo. Utilisez-le pour tester systematiquement chaque fonctionnalité de votre backend.