# Architecture Login-First - Takalo

## Vue d'ensemble

Le site Takalo a été restructuré avec une approche **login-first** :
- ❌ Pas d'accès public (pas de home page, pas d'inscription publique)
- 🔐 Point d'entrée unique : `/auth/login`
- 👤 Deux types d'utilisateurs : **Admin** et **Utilisateurs réguliers**

## Flow d'authentification

### 1. Point d'entrée
```
URL: / → Redirige automatiquement vers /auth/login
```

### 2. Connexion Admin
```
Email: admin@gmail.com
Mot de passe: admin

→ Redirige vers /admin (Dashboard fermé)
```

### 3. Connexion Utilisateur
```
Email: autre email
Mot de passe: leur mot de passe

→ Redirige vers /objects (Liste des produits)
```

## Routes

### Routes publiques
- `GET /` → Redirige vers `/auth/login`
- `GET /auth/login` → Page de connexion
- `POST /auth/login` → Traitement de connexion
- `GET /auth/logout` → Déconnexion

### Routes protégées (requiert authentification)
- `GET /objects` → Liste des produits (style vegefoods)
- `GET /object/detail/@id` → Détail d'un produit
- `GET /object/insertObject` → Formulaire ajout objet
- `POST /object/create` → Création d'objet

### Routes admin (requiert email = admin@gmail.com)
- `GET /admin` → Dashboard admin (fermé aux utilisateurs réguliers)

## Contrôleurs

### AuthController
```php
showLogin()
- Vérifie si déjà connecté
- Si admin → redirige /admin
- Si user → redirige /objects
- Sinon affiche page login

postLogin()
- Vérifie credentials admin@gmail.com / admin (exact match)
- Si admin → session admin + redirige /admin
- Si autre user → vérifie DB + redirige /objects
- Si échec → affiche erreur

logout()
- Détruit la session
- Redirige vers /auth/login
```

### AdminController
```php
dashboard()
- Vérifie authentification
- Vérifie si email === 'admin@gmail.com'
- Si non admin → redirige /objects
- Si admin → affiche dashboard
```

### ObjectController
```php
listObjects()
- Vérifie authentification
- Charge tous les objets disponibles
- Charge les catégories
- Affiche products.php (style vegefoods)

showDetail($id)
- Vérifie authentification
- Charge l'objet par ID
- Affiche object/detail.php
```

## Middlewares

### AuthMiddleware
```php
before()
- Vérifie si $_SESSION['user_connected'] existe
- Si non → redirige /auth/login

requireAdmin()
- Vérifie authentification
- Vérifie si email === 'admin@gmail.com'
- Si non admin → redirige /objects
```

## Vues

### auth/login.php
- Page de connexion unique
- Champs : email, password
- Submit → POST /auth/login

### object/products.php
- Style inspiré du template **vegefoods**
- Navbar avec recherche et menu utilisateur
- Hero section avec breadcrumbs
- Filtres de catégories
- Grille de produits avec overlay effects
- Cards : image, nom, description, prix
- Actions : voir détails, proposer échange, favoris
- Footer minimaliste

### admin/dashboard.php
- Dashboard admin (fermé)
- Accessible uniquement à admin@gmail.com
- Statistiques et gestion des échanges

## Session

### Structure $_SESSION['user_connected']
```php
[
    'id' => int,
    'email' => string,
    'username' => string,
    'role' => 'admin' | null  // 'admin' seulement pour admin@gmail.com
]
```

## Sécurité

### Vérifications
1. **Toutes les routes protégées** vérifient `$_SESSION['user_connected']`
2. **Route admin** vérifie `$_SESSION['user_connected']['email'] === 'admin@gmail.com'`
3. **Redirection appropriée** selon le rôle après login

### Credentials Admin
```
Email: admin@gmail.com (exact match requis)
Password: admin (exact match requis)
```

⚠️ **Important**: Le mot de passe admin est en clair pour l'instant. En production, utiliser `password_hash()` et `password_verify()`.

## Style Template

### Vegefoods
La liste des produits utilise le style du template **vegefoods** :
- Police : Poppins, Lora, Amatic SC
- Couleurs : Gradient violet (#667eea → #764ba2)
- Cards produits avec hover effects
- Images avec overlay
- Badges de statut
- Actions rapides (œil, échange, cœur)
- Design moderne et responsive

### Ressources
- Bootstrap 5.3.0
- Bootstrap Icons
- Font Awesome (ionicons)
- AOS (Animate On Scroll)
- Owl Carousel

## Workflow Utilisateur

### Premier accès
```
1. Accès à takalo.com (/)
2. Redirection automatique vers /auth/login
3. Saisie email/password
4. Si admin@gmail.com → Dashboard
5. Si autre user → Liste produits
```

### Navigation user
```
/objects → Liste tous les produits
/object/detail/123 → Détail produit #123
/object/insertObject → Ajouter un nouvel objet
Menu utilisateur → Profil, Mes objets, Mes échanges, Déconnexion
```

### Navigation admin
```
/admin → Dashboard admin
- Vue sur tous les échanges
- Statistiques globales
- Gestion des utilisateurs/objets
Menu admin → Dashboard, Déconnexion
```

## Fichiers modifiés

### Configuration
- ✅ `app/config/routes.php` - Routes login-first
- ✅ `app/config/bootstrap.php` - Helpers auth()

### Contrôleurs
- ✅ `app/controllers/AuthController.php` - Login avec vérification admin
- ✅ `app/controllers/AdminController.php` - Vérification admin
- ✅ `app/controllers/ObjectController.php` - Vérification auth + catégories

### Middlewares
- ✅ `app/middlewares/AuthMiddleware.php` - Auth middleware

### Vues
- ✅ `app/views/object/products.php` - Liste produits style vegefoods

## Tests

### Test Admin
```
1. Aller sur /
2. Login: admin@gmail.com / admin
3. Devrait voir /admin dashboard
4. Menu utilisateur affiche "Administrateur"
```

### Test User
```
1. Aller sur /
2. Login: user@example.com / password
3. Devrait voir /objects (liste produits)
4. Menu utilisateur affiche nom de l'utilisateur
5. Essayer d'accéder /admin → redirection vers /objects
```

### Test Non authentifié
```
1. Aller sur /objects (sans login)
2. Devrait rediriger vers /auth/login
3. Aller sur /admin (sans login)
4. Devrait rediriger vers /auth/login
```

## Migration depuis l'ancienne architecture

### Changements majeurs
- ❌ Supprimé : `GET /` → Page d'accueil publique
- ❌ Supprimé : `POST /register` → Inscription publique
- ❌ Supprimé : `POST /api/validate/register` → Validation inscription AJAX
- ✅ Ajouté : Redirection automatique `/` → `/auth/login`
- ✅ Ajouté : Logout route `GET /auth/logout`
- ✅ Modifié : Route `/listObjects` → `/objects`
- ✅ Modifié : Login vérifie credentials admin exact match
- ✅ Ajouté : Vérifications admin dans AdminController
- ✅ Ajouté : Vérifications auth dans ObjectController

### Base de données
Aucune modification de schéma requise. Le compte admin est hardcodé :
```php
if ($email === 'admin@gmail.com' && $password === 'admin') {
    // Admin login
}
```

## TODO Future

- [ ] Hasher le mot de passe admin avec password_hash()
- [ ] Ajouter gestion des favoris
- [ ] Implémenter la recherche de produits
- [ ] Ajouter filtrage par catégorie (AJAX)
- [ ] Pagination pour liste produits
- [ ] Interface d'inscription admin pour créer utilisateurs
- [ ] Log des connexions admin
- [ ] Rate limiting sur /auth/login
- [ ] CSRF tokens sur formulaires
- [ ] Remember me functionality
