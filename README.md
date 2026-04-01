# Projet Console Laravel — Guide d'installation

Application web de vente de consoles de jeux vidéo, développée avec **Laravel 12**.

---

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP 8.2** ou supérieur
- **Composer**
- **Node.js** et **npm**
- **XAMPP** (ou tout autre serveur Apache/MySQL local)

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/Valaraukar56/projet-console-laravel.git
cd projet-console-laravel
```

> Si vous utilisez XAMPP, placez le projet dans `C:\xampp\htdocs\`.

---

### 2. Installer les dépendances PHP

```bash
composer install
```

---

### 3. Configurer l'environnement

Copiez le fichier d'exemple `.env` :

```bash
cp .env.example .env
```

Puis générez la clé d'application :

```bash
php artisan key:generate
```

> Par défaut, le projet utilise **SQLite**. Aucune configuration de base de données supplémentaire n'est nécessaire.

---

### 4. Créer la base de données et insérer les données

```bash
php artisan migrate --seed
```

Cette commande crée toutes les tables et insère les données de démonstration (catégories, consoles, compte administrateur).

---

### 5. Installer les dépendances front-end et compiler les assets

```bash
npm install
npm run build
```

---

### 6. Lancer le serveur

```bash
php artisan serve
```

L'application est accessible à l'adresse : [http://localhost:8000](http://localhost:8000)

> Avec XAMPP, vous pouvez également accéder au projet via : [http://localhost/projet-console-laravel/public](http://localhost/projet-console-laravel/public)

---

## Compte administrateur

Un compte admin est créé automatiquement lors du seeding :

| Champ        | Valeur           |
| ------------ | ---------------- |
| Email        | `admin@admin.fr` |
| Mot de passe | `password`       |

Le compte admin permet de **créer, modifier et supprimer** des consoles depuis l'interface.

---

## Fonctionnalités

- Parcourir le catalogue de consoles par catégorie
- Consulter la fiche détaillée d'une console
- Créer un compte utilisateur / se connecter
- Ajouter des consoles au panier et gérer les quantités
- Interface d'administration pour gérer le catalogue (réservée au rôle admin)

---

## Raccourci d'installation (optionnel)

Un script `composer setup` est disponible pour automatiser les étapes 2, 3, 5 en une seule commande :

```bash
composer setup
php artisan db:seed
```

> Note : le script ne lance pas les seeders automatiquement, pensez à exécuter `php artisan db:seed` après.
