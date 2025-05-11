# NsokoPharma - Système de Gestion de Pharmacie

NsokoPharma est un système de gestion multi-tenant conçu spécifiquement pour les pharmacies en République Démocratique du Congo (RDC), particulièrement à Kolwezi.

## Fonctionnalités Principales

### Architecture Multi-Tenant
- Utilise le package `stancl/tenancy` pour implémenter un système multi-tenant
- Chaque pharmacie opère dans son propre environnement isolé
- Chaque tenant (pharmacie) possède son propre sous-domaine, base de données et utilisateurs
- Le domaine central gère l'enregistrement et l'identification des tenants

### Gestion des Produits
- Gestion des produits pharmaceutiques avec détails comme DCI (Dénomination Commune Internationale), dosage et forme galénique
- Les produits sont catégorisés (via le modèle Category) et peuvent être organisés par rayons pour le stockage physique
- Les produits sont classifiés par type (médicament ou dispositif) et par personne cible (adulte ou enfant)

### Gestion des Stocks
- Chaque tenant possède son propre inventaire (TenantInventory) qui référence les produits du catalogue global
- Les tenants peuvent personnaliser les prix, quantités et emplacements de stockage des produits
- Le système suit les niveaux de stock et fournit des alertes pour les stocks bas ou les produits en voie d'expiration

### Gestion des Utilisateurs
- Utilise le package de permissions Spatie pour un contrôle d'accès basé sur les rôles
- Le premier utilisateur à s'enregistrer pour un tenant devient l'administrateur avec toutes les permissions
- Des utilisateurs supplémentaires peuvent être ajoutés par l'administrateur

### Système d'Authentification
- Flux d'authentification personnalisés pour l'application centrale et les sous-domaines des tenants
- Inclut des fonctionnalités comme la connexion, l'enregistrement, la réinitialisation de mot de passe et la vérification d'email

### Interface Utilisateur Moderne
- Construit avec Tailwind CSS pour une interface responsive et moderne
- Support du mode sombre
- Tableau de bord avec des analyses, graphiques et tableaux pour surveiller les opérations de la pharmacie

## Flux de l'Application

1. **Enregistrement du Tenant**:
   - Les nouvelles pharmacies s'enregistrent via le domaine central
   - Le système crée un nouveau tenant avec un sous-domaine unique

2. **Identification du Tenant**:
   - Les pharmacies existantes peuvent accéder à leur environnement en saisissant leur ID de tenant
   - Le système les redirige vers leur sous-domaine spécifique

3. **Enregistrement de l'Administrateur**:
   - Le premier utilisateur à s'enregistrer sur un nouveau tenant devient l'administrateur
   - Cet utilisateur peut ensuite gérer les opérations de la pharmacie et ajouter des utilisateurs supplémentaires

4. **Opérations Quotidiennes**:
   - Le tableau de bord fournit une vue d'ensemble des ventes, des stocks, des produits en voie d'expiration et des visites clients
   - Les utilisateurs peuvent gérer les produits, suivre les stocks, traiter les ventes et générer des rapports

## Implémentation Technique

### Backend
- Framework Laravel (version 12.x)
- Multi-tenancy via le package stancl/tenancy
- Gestion des rôles et permissions via spatie/laravel-permission

### Frontend
- Livewire pour les composants réactifs
- Tailwind CSS pour le style
- Alpine.js (probablement utilisé pour les interactions côté client)

### Structure de la Base de Données
- Base de données centrale pour la gestion des tenants
- Base de données séparée pour chaque tenant avec des tables pour les produits, l'inventaire, les utilisateurs, etc.
- Structure relationnelle avec des contraintes de clé étrangère appropriées

## Modèles Principaux

### Product
- Représente les produits pharmaceutiques dans le catalogue global
- Attributs: dci, dosage, forme_galenique, type, personne, category_id, aisle_id
- Relations: category, aisle, tenantInventories

### TenantInventory
- Représente l'inventaire spécifique à un tenant
- Attributs: tenant_id, product_id, price, quantity, custom_aisle_id
- Relations: product, customAisle

### Category
- Organise les produits en catégories hiérarchiques
- Attributs: name, parent_id
- Relations: parent, children, products, aisles

### Aisle
- Représente les emplacements physiques de stockage
- Attributs: code, category_id
- Relations: category, products, tenantInventories

### Tenant
- Représente une pharmacie dans le système
- Attributs: name, phone, id, address
- Relations: domains, users

### User
- Représente un utilisateur du système
- Attributs: name, email, password
- Relations: tenant, roles, permissions

Cette application fournit une solution complète pour la gestion de pharmacie, adaptée aux besoins spécifiques des pharmacies en RDC, avec un accent sur la gestion des stocks, le suivi des ventes et l'isolation multi-tenant.
