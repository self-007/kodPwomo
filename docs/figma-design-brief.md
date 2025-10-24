# KodPwomo Delivery Design Brief

## Project Overview
KodPwomo est une plateforme de services de livraison sur campus. Les étudiants passent commande auprès de commerces partenaires externes, et la plateforme coordonne des agents pour récupérer et livrer ces commandes rapidement et en toute sécurité. L'application fournit également aux administrateurs des outils de suivi et de gestion du catalogue de services disponibles.

## Objectifs Business
- Augmenter la fréquence des commandes de livraison passées par les étudiants sur les différents campus.
- Optimiser la logistique du dernier kilomètre en offrant une visibilité temps réel aux agents et aux administrateurs.
- Faciliter l'onboarding des partenaires commerciaux (restaurants, papeteries, etc.) en centralisant l'information et les flux de livraison.
- Renforcer la satisfaction client grâce à une expérience de commande fluide, fiable et personnalisable.

## Utilisateurs Cibles
- **Étudiants** : souhaitent commander des produits et se les faire livrer sur le campus ou à proximité.
- **Agents de livraison** : ont besoin d'un workflow efficace pour accepter, suivre et finaliser des missions de livraison.
- **Administrateurs** : gèrent l'offre de services, suivent les commandes, monitorent les performances et pilotent les notifications.
- **Partenaires commerciaux** : fournissent les produits à livrer et consultent les performances liées à leurs commandes.

## Parcours Clés
1. **Commande étudiante** : sélection d'un commerce partenaire → choix des produits → saisie des informations de livraison → paiement → suivi temps réel.
2. **Suivi de livraison** : transitions d'états (en préparation, en cours, livré) avec notifications push et SMS.
3. **Gestion admin** : création/édition du catalogue de services, suivi des commandes, gestion des agents, déclenchement de notifications promotionnelles.
4. **Flux agent** : acceptation d'une mission, navigation vers le partenaire, confirmation de retrait, livraison au destinataire, collecte éventuelle de feedback.

## Architecture de Contenu
- **Landing** : présentation service de livraison, preuve sociale, CTA "Commander maintenant".
- **Auth** : connexion, création compte, OTP, récupération.
- **Dashboard Étudiant** : catégories de services, historique commandes, suivi en direct, programme fidélité.
- **Fiche Commande** : détails produits, frais de livraison, adresse, créneau horaire.
- **Dashboard Agent** : missions en attente, carte, statut courant, historique.
- **Back-office Admin** : liste commandes, gestion catalogue (services, partenaires), utilisateurs, notifications.

## Pages & Fonctionnalités Cibles
- **Login (login.php)** : double mode connexion/inscription avec email/mot de passe et authentification Google; flux OTP via modal; feedback visuel (alertes, loaders); gestion de session Firebase; design à onglets pour modes de connexion.
- **Boutique (boutique.php)** : sélection d'université partenaire puis catalogue des services disponibles; fiches produit détaillées (image, prix, stock, description, badges de disponibilité); modals pour ajout panier et configuration de livraison; gestion panier sticky (mobile/desktop); timeline de commande et suivi; état vide guidant l'utilisateur.
- **Pages Agents (admin-manager/pages/agents.php)** : tableau administrateur avec recherche, pagination, badges statut actif/inactif, actions rapides (toggle statut, voir détails), métadonnées (livraisons, gains, notes, dernière commande); prévoir vue responsive (scroll horizontal, cartes sur mobile); filtres avancés (période, disponibilité) à imaginer.
- **Admin Produits (admin-manager/pages/products.php)** : liste produits avec table enrichie (catégorie, prix, disponibilité); modal CRUD complet (upload image, switch disponibilité, select catégories); recherche instantanée et pagination; snackbar de confirmation; prévoir graphiques synthétiques (performances, ruptures) en annexe.
- **Autres modules admin** : commandes (suivi statuts, assignation agents), utilisateurs (rôles, état compte), analytics (KPIs, courbes), paramètres (gestion partenaires, frais livraison). Imaginer dashboards cohérents avec même design system.

## Ton & Messaging
- Positionner KodPwomo comme facilitateur de services de livraison rapide et fiable.
- Mettre en avant la sécurité, la transparence des frais et la rapidité d'exécution.
- Valoriser les agents (héros du dernier kilomètre) et la flexibilité pour les partenaires.

## Responsive & Layout
- **Mobile-first** : flux verticale optimisée, CTA persistants, composant suivi en bas d'écran.
- **Desktop** : grille 12 colonnes, cartes services, panneaux latéraux pour suivis.
- **Admin** : tableaux avec filtres, badges de statut, panneaux de détail en slide-over.

## Identité Visuelle (suggestion)
- Palette : primaire #3B82F6, secondaire #22C55E, accent #F97316, fonds neutres #F4F4F5.
- Typo : titres Poppins Bold, textes Inter Regular.
- Boutons : arrondis 8px, iconographie outline homogène.
- Illustrations : scènes campus, agents en mouvement, étudiants satisfaits.

## Composants Clés
- Header/navigation (responsive, menu burger).
- Cartes service/commerce avec badges disponibilité et frais estimés.
- Timeline de livraison (étapes avec icônes).
- Tableau admin (colonnes triables, switch disponibilité, actions rapides).
- Formulaire partenaire (contact, horaires, catégories desservies).
- Toast/snackbar pour feedback immédiat.

## Accessibilité & UX
- Contraste AA minimum, navigation clavier complète.
- Feedback explicite sur états et erreurs (adresse invalide, créneau indisponible).
- États vides utiles et pédagogiques ("Aucune commande en attente" + CTA).
- Possibilités de personnalisation (instructions livraison, points de rencontre).

## Contraintes Techniques
- Frontend doit gérer des requêtes combinant JSON et FormData (upload d'image pour vitrine partenaire ou ticket de livraison).
- Backend en PHP avec endpoints REST. Champs clés : `name`, `description`, `price`, `university_id`, `category_id`, `is_available`. Images reçues via `$_FILES`.
- JWT + refresh token HttpOnly pour authentification.
- Schéma MySQL existant : `products`, `orders`, `deliveries`, `notifications`, `category`, etc.

## KPIs & Analytics
- Taux de conversion commande, temps moyen de livraison, ponctualité agents, satisfaction client (notes, feedback).
- Mesure du taux d'acceptation des missions et délai d'affectation.
- Impact des campagnes promotionnelles sur le volume de commandes.

## Prochaines Étapes
1. Valider le positionnement (service de livraison) avec les parties prenantes.
2. Prioriser les parcours mobile étudiant et tableau de bord agent.
3. Réaliser des wireframes basse fidélité des écrans principaux.
4. Préparer l'import dans Figma pour génération automatique de layouts adaptatifs.
