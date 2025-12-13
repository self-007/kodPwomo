# 📚 Documentation des Endpoints API - KodPwomo

**Base URL:** `https://kodpwomo.com/backend`

---

## 🟢 GET - Récupération de données

### 📦 **Produits**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /products` | Récupérer tous les produits | Aucun | `/backend/products` |
| `GET /products/{university_id}` | Récupérer les produits par université | `university_id` (int) | `/backend/products/1` |
| `GET /products/adm/{university_id}` | Produits par université (admin) | `university_id` (int) | `/backend/products/adm/1` |
| `GET /products/adm/page/{page}/{search}` | Produits avec pagination (admin) | `page` (int), `search` (string) | `/backend/products/adm/page/1/laptop` |

### 🏷️ **Catégories**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /categories` | Récupérer toutes les catégories | Aucun | `/backend/categories` |
| `GET /categories/{id}` | Récupérer une catégorie par ID | `id` (int) | `/backend/categories/5` |
| `GET /category/adm` | Catégories (admin-manager) | Aucun | `/backend/category/adm` |
| `GET /category/super` | Catégories (super admin) | Aucun | `/backend/category/super` |

### 👥 **Utilisateurs**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /users` | Récupérer tous les utilisateurs | Aucun | `/backend/users` |
| `GET /users/{id}` | Récupérer un utilisateur par ID | `id` (int) | `/backend/users/42` |
| `GET /users/adm` | Tous les utilisateurs (admin) | Aucun | `/backend/users/adm` |
| `GET /users/adm/page/{page}/{search}` | Utilisateurs avec pagination (admin) | `page` (int), `search` (string) | `/backend/users/adm/page/1/john` |

### 📦 **Commandes**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /orders` | Récupérer toutes les commandes | Aucun | `/backend/orders` |
| `GET /orders/{id}` | Récupérer une commande par ID | `id` (int) | `/backend/orders/123` |
| `GET /orders/available` | Commandes en attente | Aucun | `/backend/orders/available` |
| `GET /orders/adm/{university_id}` | Commandes par université (admin) | `university_id` (int) | `/backend/orders/adm/1` |
| `GET /orders/adm/page/{page}/{search}` | Commandes avec pagination (admin) | `page` (int), `search` (string) | `/backend/orders/adm/page/1/pending` |

### 🎓 **Universités**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /universities` | Récupérer toutes les universités | Aucun | `/backend/universities` |
| `GET /universities/{id}` | Récupérer une université par ID | `id` (int) | `/backend/universities/3` |
| `GET /university/super` | Universités (super admin) | Aucun | `/backend/university/super` |

### 📍 **Lieux**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /places/{university_id}` | Lieux par université | `university_id` (int) | `/backend/places/1` |
| `GET /places/adm/{university_id}` | Lieux par université (admin) | `university_id` (int) | `/backend/places/adm/1` |

### 🚴 **Agents**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /agents/availability/{agent_id}` | Statut de disponibilité d'un agent | `agent_id` (string) | `/backend/agents/availability/agent123` |
| `GET /agents/adm/{university_id}` | Agents par université (admin) | `university_id` (int) | `/backend/agents/adm/1` |
| `GET /agents/adm/page/{page}/{search}` | Agents avec pagination (admin) | `page` (int), `search` (string) | `/backend/agents/adm/page/1/active` |

### 🚚 **Livraisons**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /deliveries/agent/{agent_id}` | Statistiques de livraison par agent | `agent_id` (string) | `/backend/deliveries/agent/agent123` |
| `GET /deliveries/user/{user_id}` | Livraisons par utilisateur | `user_id` (string/email) | `/backend/deliveries/user/user@email.com` |
| `GET /deliveries/agent/orderProcess/{agent_id}` | Livraisons en cours par agent | `agent_id` (string) | `/backend/deliveries/agent/orderProcess/agent123` |

### 📊 **Tableaux de bord**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /dashboard/adm/{university_id}` | Stats dashboard par université | `university_id` (int) | `/backend/dashboard/adm/1` |
| `GET /dashboard/super` | Stats dashboard super admin | Aucun | `/backend/dashboard/super` |
| `GET /dashboard/super/{date}` | Stats dashboard super admin (date) | `date` (string) | `/backend/dashboard/super/2025-11-22` |

### 📈 **Analytics**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /analytics/adm/{university_id}` | Analytics par université | `university_id` (int) | `/backend/analytics/adm/1` |
| `GET /analytics/adm/page/{page}/{date}` | Analytics avec pagination | `page` (int), `date` (string) | `/backend/analytics/adm/page/1/2025-11-22` |
| `GET /analytics/super` | Analytics super admin | Aucun | `/backend/analytics/super` |
| `GET /analytics/super/{date}` | Analytics super admin (date) | `date` (string) | `/backend/analytics/super/2025-11-22` |

### 🔔 **Notifications**
| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `GET /notifications/{user_id}` | Notifications par utilisateur | `user_id` (string/email) | `/backend/notifications/user@email.com` |

---

## 🟡 POST - Création de données

### 📦 **Produits**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /new/product/adm` | Créer un produit (admin) | JSON: `{name, description, price, category_id, university_id, image}` | `/backend/new/product/adm` |
| `POST /products/image-update/adm/{product_id}` | Mettre à jour l'image produit | `product_id` (int), FormData: `image` | `/backend/products/image-update/adm/5` |

### 🏷️ **Catégories**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /category/adm` | Créer une catégorie (admin) | JSON: `{name, description}` | `/backend/category/adm` |
| `POST /category/super` | Créer une catégorie (super admin) | JSON: `{name, description}` | `/backend/category/super` |

### 👥 **Utilisateurs**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /users` | Créer un utilisateur | JSON: `{name, email, phone, password, university_id}` | `/backend/users` |
| `POST /verify-otp` | Vérifier le code OTP | JSON: `{email, otp}` | `/backend/verify-otp` |
| `POST /resend-otp` | Renvoyer le code OTP | JSON: `{email}` | `/backend/resend-otp` |

### 📦 **Commandes**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /orders` | Créer une commande | JSON: `{user_id, products[], total, delivery_address}` | `/backend/orders` |
| `POST /orders/assign` | Assigner une commande à un agent | JSON: `{order_id, agent_id}` | `/backend/orders/assign` |

### 📍 **Lieux**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /places/adm/{university_id}` | Créer un lieu (admin) | `university_id` (int), JSON: `{name, address, image}` | `/backend/places/adm/1` |
| `POST /places/image-update/adm/{place_id}` | Mettre à jour l'image lieu | `place_id` (int), FormData: `image` | `/backend/places/image-update/adm/3` |

### 🎓 **Universités**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /university/super` | Créer une université (super admin) | JSON: `{name, address, city, country, image}` | `/backend/university/super` |
| `POST /university/image-update/{university_id}` | Mettre à jour l'image université | `university_id` (string), FormData: `image` | `/backend/university/image-update/univ123` |

### 🔔 **Notifications**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `POST /notifications` | Créer une notification | JSON: `{user_id, title, message, type}` | `/backend/notifications` |

---

## 🔵 PUT - Mise à jour de données

### 📦 **Produits**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /product/adm/{product_id}` | Mettre à jour un produit | `product_id` (int), JSON: `{name, description, price, category_id}` | `/backend/product/adm/5` |
| `PUT /products/availability` | Changer la disponibilité produit | JSON: `{product_id, available}` | `/backend/products/availability` |

### 🏷️ **Catégories**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /category/adm` | Mettre à jour une catégorie (admin) | JSON: `{category_id, name, description}` | `/backend/category/adm` |
| `PUT /categories/adm` | Changer disponibilité catégorie | JSON: `{category_id, available}` | `/backend/categories/adm` |
| `PUT /category/super` | Mettre à jour une catégorie (super) | JSON: `{category_id, name, description}` | `/backend/category/super` |

### 👥 **Utilisateurs**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /users/adm` | Mettre à jour un utilisateur (admin) | JSON: `{user_id, name, email, phone}` | `/backend/users/adm` |
| `PUT /user/role` | Définir le rôle agent | JSON: `{user_id, university_id}` | `/backend/user/role` |
| `PUT /users/status` | Changer le statut utilisateur | JSON: `{user_id, status}` | `/backend/users/status` |
| `PUT /users/verify` | Vérifier le compte utilisateur | JSON: `{user_id, verified}` | `/backend/users/verify` |
| `PUT /setAdm/{user_id}` | Définir un admin (super admin) | `user_id` (string), JSON: `{university_id}` | `/backend/setAdm/user123` |
| `PUT /setAgent/{user_id}` | Définir un agent | `user_id` (string), JSON: `{university_id}` | `/backend/setAgent/user123` |
| `PUT /setUser/{user_id}` | Définir un client | `user_id` (string) | `/backend/setUser/user123` |

### 📍 **Lieux**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /places/adm/{place_id}` | Modifier un lieu (admin) | `place_id` (int), JSON: `{name, address}` | `/backend/places/adm/3` |

### 🎓 **Universités**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /university/super/{university_id}` | Mettre à jour une université | `university_id` (int), JSON: `{name, address, city, country}` | `/backend/university/super/1` |

### 🚴 **Agents**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /agents/availability` | Changer disponibilité agent | JSON: `{agent_id, available}` | `/backend/agents/availability` |

### 🚚 **Livraisons**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /delivery/status/{delivery_id}` | Mettre à jour statut livraison | `delivery_id` (int), JSON: `{status}` | `/backend/delivery/status/42` |

### 🔔 **Notifications**
| Endpoint | Description | Body | Exemple |
|----------|-------------|------|---------|
| `PUT /notifications/status` | Marquer notification comme lue | JSON: `{notification_id}` | `/backend/notifications/status` |

---

## 🔴 DELETE - Suppression de données

| Endpoint | Description | Paramètres | Exemple |
|----------|-------------|------------|---------|
| `DELETE /product/adm` | Supprimer un produit (admin) | JSON: `{product_id}` | `/backend/product/adm` |
| `DELETE /places/adm/{place_id}` | Supprimer un lieu (admin) | `place_id` (int) | `/backend/places/adm/3` |
| `DELETE /category/super/{category_id}` | Supprimer une catégorie (super) | `category_id` (int) | `/backend/category/super/5` |
| `DELETE /university/super/{university_id}` | Supprimer une université (super) | `university_id` (int) | `/backend/university/super/1` |

---

## 🔐 Authentification

La plupart des endpoints nécessitent un token JWT dans les headers :

```http
Authorization: Bearer <votre_token_jwt>
```

---

## 📝 Format de réponse

### ✅ Succès (200)
```json
{
  "success": true,
  "data": { ... }
}
```

### ❌ Erreur (4xx/5xx)
```json
{
  "error": "Message d'erreur",
  "code": 404
}
```

---

## 🎯 Rôles utilisateur

- **👤 Client** : Utilisateur normal
- **🚴 Agent** : Livreur
- **👨‍💼 Admin-Manager** : Administrateur d'une université
- **🦸 Super Admin** : Administrateur global

---

## 📌 Notes importantes

1. **Pagination** : Les endpoints avec `/page/{page}/{search}` supportent la pagination
2. **Recherche** : Le paramètre `{search}` accepte des mots-clés ou dates (format: `YYYY-MM-DD`)
3. **IDs** : 
   - `(\d+)` = Entier (ex: `1`, `42`, `123`)
   - `(\w+)` = Alphanumérique (ex: `user123`, `agent_abc`)
   - `([\w\-\.]+)` = Alphanumérique + tirets + points (ex: `user@email.com`, `2025-11-22`)

4. **Upload d'images** : Utilise `multipart/form-data` pour les endpoints avec `image-update`

---

**Dernière mise à jour** : 22 novembre 2025  
**Version** : 1.0.0  
**Contact** : voltairebilljamesky@gmail.com
