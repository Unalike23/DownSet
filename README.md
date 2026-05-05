# DownSetRecord 📀

**DownSetRecord** est une application web e-commerce complète spécialisée dans la vente de supports musicaux (Vinyles, CD, Cassettes).

L'application repose sur une architecture **MVC (Modèle-Vue-Contrôleur) en Programmation Orientée Objet (POO)** stricte, garantissant une séparation claire des responsabilités et une maintenance facilitée.

## 🚀 Fonctionnalités principales

- **Catalogue dynamique** : Navigation par artistes, genres et catégories.
- **Recherche intelligente** : Moteur de recherche asynchrone.
- **Panier AJAX** : Ajout, suppression et mise à jour des produits sans rechargement de page, avec notifications "Toast".
- **Espace Client** : Inscription, authentification, gestion du profil, carnet d'adresses et historique de commandes.
- **Back-Office Admin** : Gestion simplifiée des produits, artistes et stocks.

## 🛠️ Installation et Configuration

### 1. Base de données
Le script SQL nécessaire à l'initialisation de la base de données se trouve à la racine du projet (recherchez le fichier `downsetrecordmvc.sql`).
- Créez une base de données MySQL.
- Importez le fichier SQL dans votre base (via phpMyAdmin).

### 2. Configuration de la connexion
La configuration de la base de données s'effectue dans le fichier `config.php` situé à la racine.
Modifiez les informations de connexion pour correspondre à votre environnement local :

```php
// Exemple de configuration dans config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'DownSetRecord');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Déploiement local
- Copiez le dossier du projet dans votre dossier serveur (ex: `C:\wamp64\www\` pour WampServer).
- Assurez-vous que le nom du dossier est bien `DownSetRecord` (ou mettez à jour la constante `BASE_URL` dans `config.php`).
- Accédez à l'application via `http://localhost/DownSetRecord/`.

## 📂 Organisation du code
- **`modeles/`** : Contient les classes métiers (POO) et les modèles de données (PDO).
- **`vue/`** : Contient les fichiers de présentation (HTML/PHP).
- **`controleurs/`** : Gère la logique de l'application et fait le lien entre modèles et vues.
- **`public/`** : Regroupe les ressources statiques (CSS, JavaScript, Images).
- **`Docs/`** : Contient toute la documentation technique et fonctionnelle pour le BTS SIO (Fiche technique, Questions Jury, etc.).
