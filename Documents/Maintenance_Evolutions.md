# Maintenance et Évolutions - DownSetRecord

## 1. Historique de Maintenance (Refactorisation)

Le projet DownSetRecord a récemment fait l'objet d'une vaste refactorisation pour passer d'un code procédural classique à une architecture **MVC POO (Programmation Orientée Objet) stricte**, indispensable pour répondre aux standards de l'industrie (et du BTS SIO).

### Actions réalisées :
1.  **Encapsulation POO (Modèle "Intelligent")** :
    *   La logique d'affichage complexe (ex: quel type de visuel de disque afficher selon la catégorie) a été retirée des vues.
    *   Création de méthodes dédiées dans les entités : `$produit->getCoverUrl()` et `$produit->getDiscUrl()`.
2.  **Nettoyage du MVC (DRY - Don't Repeat Yourself)** :
    *   Suppression des variables globales (`global $pdo;`) dans les contrôleurs. L'injection de dépendance est désormais automatisée dans les constructeurs des modèles (`new ProduitModele()`).
    *   Factorisation du code JavaScript : Résolution des conflits liés aux multiples écouteurs d'événements pour le panier AJAX, centralisation dans un script robuste (`vueHeader.php`).
3.  **Correction de bugs asynchrones (AJAX)** :
    *   Correction du flux JSON de `panier.php` pour fournir toutes les métadonnées (nom artiste, image) au système de notifications Toast JavaScript.

## 2. Évolutions Envisagées (Roadmap)

Pour transformer cette application d'un projet d'étude complet à une plateforme de production réelle, plusieurs évolutions sont envisageables :

### 2.1. Évolutions Fonctionnelles
*   **Système de Paiement Réel** : Intégration d'une API de paiement tierce comme Stripe ou PayPal lors de la validation du panier.
*   **Gestion des Stocks** : Actuellement, le système gère les produits mais pas leur quantité en entrepôt. Une évolution logique est d'ajouter un champ `stock` en base de données, décrémenté à chaque achat validé.
*   **Envoi d'E-mails Automatisés** : Utilisation de PHPMailer ou d'une API (SendGrid, Mailgun) pour envoyer un e-mail de confirmation après inscription, et après chaque commande passée, incluant une facture en PDF.

### 2.2. Évolutions Techniques
*   **Sécurité Avancée (CSRF)** : Implémenter des tokens CSRF (Cross-Site Request Forgery) sur tous les formulaires critiques (connexion, suppression d'adresse, ajout au panier).
*   **Optimisation SEO** : Rendre les URLs plus "User Friendly" via de la réécriture d'URL (`URL Rewriting` / fichier `.htaccess`) pour avoir `/produit/106-zola-survie` au lieu de `/index.php?page=produit&id=106`.
*   **Architecture Composant (Vues)** : Pousser la logique MVC plus loin en divisant les Vues en petits composants PHP réutilisables (ex: un fichier `carte_produit.php` appelé dynamiquement partout où un produit est listé).
