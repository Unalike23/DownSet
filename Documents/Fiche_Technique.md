# Fiche Technique - DownSetRecord

## 1. Présentation du Projet
**DownSetRecord** est une application web e-commerce complète spécialisée dans la vente de supports musicaux (Vinyles, CDs, Cassettes). Ce projet est conçu pour répondre aux exigences professionnelles et académiques de l'épreuve E6 du BTS SIO, en démontrant une maîtrise du développement Backend et Frontend.

## 2. Architecture Logicielle
L'application repose sur une architecture **MVC (Modèle-Vue-Contrôleur) orientée objet stricte**.
- **Routeur Unique** : `index.php` sert de point d'entrée unique (Front Controller) qui intercepte les requêtes et instancie le bon contrôleur.
- **Modèles (POO)** : Encapsulation totale de la logique métier et de l'accès aux données. Les objets métiers (ex: `Produit`, `Panier`) gèrent leur propre logique d'affichage (ex: `getCoverUrl()`, `getDiscUrl()`) pour respecter le principe DRY (Don't Repeat Yourself). Les interactions avec la base de données sont gérées par des classes de type `Modele` (ex: `ProduitModele` via l'interface PDO).
- **Vues** : Fichiers PHP purs (templating) allégés de toute logique métier complexe, se contentant d'afficher les attributs des objets passés par le contrôleur.
- **Contrôleurs** : Servent de chef d'orchestre entre les requêtes HTTP, les Modèles, et la restitution des Vues.

## 3. Technologies Utilisées
*   **Langage Backend** : PHP 8+
*   **Base de données** : MySQL (via l'interface PDO)
*   **Frontend (Structure & Style)** : HTML5, CSS3, Framework Bootstrap 5
*   **Frontend (Logique & Interactivité)** : JavaScript Vanilla (Fetch API pour les appels asynchrones) et jQuery (uniquement pour le composant Select2 de recherche).

## 4. Fonctionnalités Clés
*   **Navigation & Recherche** : Moteur de recherche asynchrone, navigation par genre et artiste.
*   **Catalogue Dynamique** : Affichage conditionnel et dynamique des disques (le visuel d'un vinyle est différent d'un CD ou d'une cassette) géré intelligemment en POO.
*   **Panier Interactif (AJAX)** : Ajout, suppression et mise à jour du panier sans rechargement de page, avec notifications "Toast" en temps réel et panneau latéral (Offcanvas).
*   **Gestion Utilisateur** : Inscription, authentification, gestion du profil, carnet d'adresses multiples et suivi des commandes.
*   **Back-Office (Admin)** : Interface d'administration pour gérer le catalogue produit, ajouter des articles, lier des artistes/genres, et gérer le stock visuel.

## 5. Sécurité
*   **Injections SQL** : Utilisation exclusive de **requêtes préparées PDO** dans l'ensemble des modèles.
*   **Failles XSS** : Sécurisation de l'affichage via `htmlspecialchars()` pour toute donnée provenant de l'utilisateur ou de la base de données.
*   **Authentification** : Hachage des mots de passe en base de données via `password_hash()` (algorithme bcrypt) et vérification avec `password_verify()`.
*   **Gestion des Sessions** : Verrouillage des pages privées (ex: `panier.php`, profil) et redirection des utilisateurs non connectés. Fixation de session évitée par des vérifications strictes de l'état `$_SESSION`.
