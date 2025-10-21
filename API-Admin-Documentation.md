# 📋 Documentation API Admin - KodPwomo

## 🎯 Vue d'ensemble
API pour la gestion administrative du système KodPwomo. Toutes les routes nécessitent une authentification admin.

**Base URL:** `http://localhost/kodpwomo/backend`

---

## 📊 **DASHBOARD**

### GET /dashboard/adm/{universityId}
Récupère les statistiques du tableau de bord pour une université.

**Paramètres:**
- `universityId` (int, required) - ID de l'université

**Réponse:**
```json
{
    "totalUsers": 150,
    "universityProducts": 45,
    "universityOrders": 78,
    "monthRevenue": 12500.50,
    "university": "Université de Paris",
    "orders": {
        "orders": [...],
        "nbrs": 78
    }
}
```

---

## 👥 **GESTION UTILISATEURS**

### GET /users/adm
Récupère tous les utilisateurs avec pagination et recherche.

**Paramètres de requête:**
- `page` (int, optional) - Numéro de page (défaut: 1)
- `search` (string, optional) - Terme de recherche (nom ou email)

**Exemple:**
```
GET /users/adm?page=2&search=jean
```

**Réponse:**
```json
{
    "users": [
        {
            "id_unique": "user123",
            "name": "Jean Dupont",
            "email": "jean@example.com",
            "date": "2024-01-15",
            "status": "active",
            "total_orders": 5,
            "last_date": "2024-10-10",
            "last_university": "Sorbonne",
            "total_spent": 250.00
        }
    ],
    "total": 150,
    "pagination": {
        "current_page": 1,
        "per_page": 20,
        "total_users": 150,
        "total_pages": 8
    }
}
```

### GET /users/adm/page?={page}&&search={search}
Route alternative pour pagination et recherche utilisateurs.

**Exemple:**
```
GET /users/adm/page?=1&&search=jean
```

---

## 📦 **GESTION PRODUITS**

### GET /products/adm/{universityId}
Récupère tous les produits d'une université avec pagination et recherche.

**Paramètres:**
- `universityId` (int, required) - ID de l'université
- `page` (int, optional) - Numéro de page
- `search` (string, optional) - Recherche par nom ou description

**Réponse:**
```json
{
    "products": [
        {
            "id": 1,
            "name": "Cours de Mathématiques",
            "description": "Cours complet de mathématiques niveau L1",
            "price": 50.00,
            "id_category": 1,
            "category_name": "Éducation",
            "total_orders": 25,
            "total_revenue": 1250.00,
            "id_university": 1
        }
    ],
    "total": 45,
    "pagination": {
        "current_page": 1,
        "per_page": 20,
        "total_products": 45,
        "total_pages": 3
    },
    "categories": [
        {"id": 1, "name": "Éducation"},
        {"id": 2, "name": "Services"}
    ]
}
```

### GET /products/adm/page?={page}&&search={search}
Route alternative pour pagination et recherche produits.

**Exemple:**
```
GET /products/adm/page?=1&&search=cours
```

---

## 🛒 **GESTION COMMANDES**

### GET /orders/adm/{universityId}
Récupère toutes les commandes d'une université avec détails.

**Paramètres:**
- `universityId` (int, required) - ID de l'université
- `page` (int, optional) - Numéro de page
- `search` (string, optional) - Recherche par produit, utilisateur, ID commande ou salle

**Réponse:**
```json
{
    "orders": [
        {
            "product_name": "Cours de Physique",
            "user_name": "Marie Martin",
            "order_id": "ORD123456",
            "date": "2024-10-13",
            "status": "completed",
            "qnt": 2,
            "price": 75.00,
            "salle_name": "Amphithéâtre A",
            "id_agent": "agent789",
            "note": 4.5,
            "agent_name": "Pierre Livraison"
        }
    ],
    "total": 78,
    "pagination": {
        "current_page": 1,
        "per_page": 20,
        "total_orders": 78,
        "total_pages": 4
    }
}
```

### GET /orders/adm/page?={page}&&search={search}
Route alternative pour pagination et recherche commandes.

**Exemple:**
```
GET /orders/adm/page?=1&&search=marie
```

---

## 🚚 **GESTION AGENTS**

### GET /agents/adm/{universityId}
Récupère tous les agents d'une université avec leurs statistiques.

**Paramètres:**
- `universityId` (int, required) - ID de l'université
- `page` (int, optional) - Numéro de page
- `search` (string, optional) - Recherche par nom ou ID commande

**Réponse:**
```json
{
    "orders": [
        {
            "id_unique": "agent123",
            "name": "Pierre Livraison",
            "email": "pierre@kodpwomo.com",
            "date": "2024-01-20",
            "status": "active",
            "id_university": 1,
            "role": "agent",
            "total_orders": 45,
            "last_date": "2024-10-12",
            "total_deliveries": 42,
            "total_earnings": 1200.50,
            "average_rating": 4.2
        }
    ],
    "total_agents": 15,
    "pagination": {
        "current_page": 1,
        "per_page": 20,
        "total_orders": 15,
        "total_pages": 1
    }
}
```

### GET /agents/adm/page?={page}&&search={search}
Route alternative pour pagination et recherche agents.

**Exemple:**
```
GET /agents/adm/page?=1&&search=pierre
```

---

## 📈 **ANALYTICS**

### GET /analytics/adm/{universityId}
Récupère les données analytiques complètes d'une université.

**Paramètres:**
- `universityId` (int, required) - ID de l'université
- `search` (string, optional) - Filtre par date (format: YYYY-MM-DD)

**Réponse:**
```json
{
    "overview": {
        "period": "last_30_days",
        "total_revenue": 2850.00,
        "total_orders": 486,
        "avg_order_value": 18.50,
        "growth": {
            "revenue": "+15%",
            "orders": "+8%",
            "customers": "+12%"
        }
    },
    "dailyOrders": {
        "nbrs": 25,
        "deliveries": [...]
    },
    "topCustomers": {
        "nbrs": 5,
        "customers": [
            {
                "id": "user123",
                "name": "Jean Dupont",
                "email": "jean@example.com",
                "total_deliveries": 12,
                "total_spent": 450.00,
                "last_order_date": "2024-10-10"
            }
        ]
    },
    "topAgents": {
        "nbrs": 5,
        "agents": [...]
    }
}
```

### GET /analytics/adm/page?={page}&&search={date}
Analytics avec filtre de date spécifique.

**Exemple avec date:**
```
GET /analytics/adm/page?=1&&search=2024-10-13
```

**Note:** Le regex pour la recherche analytics accepte les dates avec : `[\w\-\/\.]+`

---

## 🔧 **CODES D'ERREUR**

| Code | Description |
|------|-------------|
| 200 | Succès |
| 400 | Paramètres invalides |
| 404 | Ressource non trouvée |
| 500 | Erreur serveur |

**Exemples d'erreurs:**
```json
{
    "error": "Invalid university ID"
}
```

```json
{
    "error": "Endpoint not found: /analytics/adm/abc Method: GET"
}
```

---

## 📝 **NOTES IMPORTANTES**

### Pagination
- **Limite par page:** 20 éléments
- **Page par défaut:** 1
- **Format:** `?page=X&search=terme`

### Recherche
- **Users:** Recherche par nom ou email
- **Products:** Recherche par nom ou description  
- **Orders:** Recherche par produit, utilisateur, ID commande ou salle
- **Agents:** Recherche par nom ou ID commande
- **Analytics:** Filtre par date (YYYY-MM-DD, DD/MM/YYYY, DD.MM.YYYY)

### Sécurité
- Toutes les entrées sont sanitisées avec `sanitizeInput()`
- Validation des IDs d'université (entier > 0)
- Gestion des erreurs SQL et validation des paramètres

### Format des dates
- **Entrée:** Formats multiples acceptés (YYYY-MM-DD, DD/MM/YYYY, etc.)
- **Sortie:** Format standardisé YYYY-MM-DD HH:MM:SS

---

## 🧪 **TESTS RAPIDES**

Utilisez votre page `test-api.php` créée précédemment pour tester toutes ces routes rapidement !

**URLs de test:**
```
http://localhost/kodpwomo/backend/dashboard/adm/1
http://localhost/kodpwomo/backend/users/adm
http://localhost/kodpwomo/backend/users/adm/page?=1&&search=jean
http://localhost/kodpwomo/backend/products/adm/1
http://localhost/kodpwomo/backend/products/adm/page?=1&&search=cours
http://localhost/kodpwomo/backend/orders/adm/1
http://localhost/kodpwomo/backend/orders/adm/page?=1&&search=marie
http://localhost/kodpwomo/backend/agents/adm/1
http://localhost/kodpwomo/backend/agents/adm/page?=1&&search=pierre
http://localhost/kodpwomo/backend/analytics/adm/1
http://localhost/kodpwomo/backend/analytics/adm/page?=1&&search=2024-10-13
```