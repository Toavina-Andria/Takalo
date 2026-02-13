# Structure du Projet Takalo-1

## Vue d'ensemble
Takalo-1 est un framework web PHP basé sur Flight PHP avec support de la ligne de commande via Runway.

---

## 📁 Structure des répertoires et fichiers

### 🔧 Fichiers racine
| Fichier | Description |
|---------|-------------|
| `composer.json` | Configuration des dépendances PHP (Flight, Runway, Tracy, etc.) |
| `docker-compose.yml` | Configuration Docker pour l'environnement de développement |
| `Vagrantfile` | Configuration Vagrant pour VM de développement |
| `index-simple.php` | Point d'entrée simple (alternative) |
| `README.md` | Documentation principale du projet |

---

## 📂 Dossier `/app`
**Rôle** : Cœur métier de l'application

### Structure
```
app/
├── cache/              → Fichiers cache de l'application
├── commands/           → Commandes CLI personnalisées
│   └── SampleDatabaseCommand.php
├── config/             → Configuration de l'application
│   ├── bootstrap.php   → Initialisation au démarrage
│   ├── config.php      → Configuration principale
│   ├── config_sample.php → Exemple de configuration
│   ├── routes.php      → Définition des routes
│   └── services.php    → Enregistrement des services (DI)
├── controllers/        → Contrôleurs (logique métier)
│   └── ApiExampleController.php
├── log/                → Fichiers journaux (logs)
├── middlewares/        → Middlewares (intercepteurs de requête)
│   └── SecurityHeadersMiddleware.php
├── models/             → Modèles de données (entités, ORM)
├── utils/              → Fonctions utilitaires et helpers
└── views/              → Templates/Vues (affichage)
    └── welcome.php
```

### Rôle de chaque sous-dossier

#### `config/`
- **bootstrap.php** : Code exécuté au démarrage de l'application
- **config.php** : Configuration générale (DB, API keys, etc.)
- **routes.php** : Définition des routes HTTP
- **services.php** : Configuration du conteneur d'injection de dépendances

#### `controllers/`
Contient les contrôleurs qui gèrent la logique métier et retournent les réponses.

#### `models/`
Contient les classes modèles pour accéder et manipuler les données.

#### `views/`
Contient les templates/fichiers d'affichage (HTML, JSON, etc.).

#### `middlewares/`
Contient les middlewares pour filtrer/modifier les requêtes et réponses.

#### `commands/`
Contient les commandes CLI personnalisées exécutables via `php runway`.

#### `utils/`
Contient les fonctions utilitaires, helpers et services réutilisables.

---

## 📂 Dossier `/public`
**Rôle** : Point d'entrée public accessible depuis le web

| Fichier | Description |
|---------|-------------|
| `index.php` | Point d'entrée principal de l'application |

---

## 📂 Dossier `/vendor`
**Rôle** : Dépendances externes installées par Composer

### Dépendances principales
- `flightphp/core/` → Framework Flight (routage, contrôleurs)
- `flightphp/runway/` → CLI pour Flight
- `tracy/tracy/` → Debugger et profiler
- `nette/` → Utilitaires Nette (générateur PHP, helpers)
- `adhocore/cli/` → Utilitaires CLI avancés

---

## 🚀 Fichiers de configuration

### `runway`
Script bash pour exécuter les commandes CLI du projet.

```bash
./runway command:name
```

### `composer.json`
Gère toutes les dépendances PHP du projet. Les dépendances incluent :
- **flight/core** - Framework web
- **flight/runway** - Outils CLI
- **tracy** - Débogage
- Autres utilitaires

---

## 📊 Flux de requête typique

```
1. Requête HTTP
   ↓
2. public/index.php (point d'entrée)
   ↓
3. app/config/bootstrap.php (initialisation)
   ↓
4. app/config/routes.php (matching de route)
   ↓
5. app/middlewares/ (sécurité, headers, etc.)
   ↓
6. app/controllers/ (logique métier)
   ↓
7. app/models/ (accès données)
   ↓
8. app/views/ (rendu réponse)
   ↓
9. Réponse HTTP
```

---

## 📝 Notes importantes

- **Cache** : Utilisez `app/cache/` pour les fichiers temporaires
- **Logs** : Les logs de l'application vont dans `app/log/`
- **Routes** : Toutes les routes doivent être définies dans `app/config/routes.php`
- **Services** : Enregistrez tous les services (classes réutilisables) dans `app/config/services.php`
- **Sécurité** : Les middlewares de sécurité sont dans `app/middlewares/`
- **CLI** : Les commandes personnalisées vont dans `app/commands/`

---

## 🔗 Ressources utiles

- Documentation Flight : https://flightphp.com/
- Runway CLI : Voir `vendor/flightphp/runway/README.md`
- Tracy Debugger : Voir `vendor/tracy/tracy/readme.md`
