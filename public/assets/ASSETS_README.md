# Assets Dashboard - Material Design Bootstrap

## Fichiers ajoutés

### CSS (public/assets/)
- **bootstrap.min.css** (228 KB) - Bootstrap 5.3.0 framework CSS
- **bootstrap-icons.css** (96 KB) - Bootstrap Icons 1.11.0

### JavaScript (public/js/)
- **bootstrap.bundle.min.js** (79 KB) - Bootstrap 5.3.0 JS avec Popper.js inclus

### Fonts (public/assets/fonts/)
- **bootstrap-icons.woff** (173 KB) - Police Bootstrap Icons format WOFF
- **bootstrap-icons.woff2** (128 KB) - Police Bootstrap Icons format WOFF2

### CSS Personnalisé (public/assets/css/)
- **dashboard.css** (4.1 KB) - Styles personnalisés pour le dashboard admin

## Utilisation

Les assets sont maintenant hébergés localement et référencés dans le fichier `app/views/admin/dashboard.php` :

```html
<link href="/assets/bootstrap.min.css" rel="stylesheet">
<link href="/assets/bootstrap-icons.css" rel="stylesheet">
<link href="/assets/css/dashboard.css" rel="stylesheet">
<script src="/js/bootstrap.bundle.min.js"></script>
```

## Palette de couleurs

Le dashboard utilise une palette de couleurs Material Design :
- Primary: #42b883 (Vert)
- Secondary: #35495e (Gris foncé)
- Background: #f8fafb (Gris très clair)
- Border: #e9ecef
- Text Muted: #6c757d

## Fonctionnalités

- 4 cartes de statistiques avec icônes Bootstrap
- Tableau responsive avec hover effects
- Badges colorés pour les statuts (pending/accepted/rejected)
- Design moderne et épuré
- Compatible mobile (responsive)
