# Takalo-takalo

> Site d'échange d'objets entre utilisateurs

**REVISION** - Février 2026 - P18/P5DS

## 📋 Description

Takalo-takalo est une plateforme web permettant aux utilisateurs d'échanger des objets (vêtements, livres, DVD, etc.). Les utilisateurs peuvent publier leurs objets, consulter ceux des autres et proposer des échanges.

## 🚀 Technologies

| Catégorie | Technologie |
|-----------|-------------|
| Backend | PHP 8.2 |
| Framework | FlightPHP (FlightMvc) |
| Base de données | MySQL |
| Frontend | HTML, CSS, JavaScript |
| UI Framework | Bootstrap |

## 📦 Prérequis

- PHP >= 8.2
- MySQL
- Composer

## ⚙️ Installation

1. Cloner le repository
```bash
git clone <url-du-repo>
cd Takalo-1
```

2. Installer les dépendances
```bash
composer install
```

3. Configurer la base de données
```bash
cp .env.example .env
# Modifier les variables de connexion dans .env
```

4. Lancer le serveur de développement
```bash
php -S localhost:8000
```

## 📁 Structure du projet

```
Takalo-1/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── public/
├── config/
└── README.md
```

## 👥 Auteurs

| Nom | Numéro ETU |
|-----|------------|
| Aiky | 3936 |
| Nekena | 4193 |
| Toavina | 4235 |

## 📄 Licence

Ce projet est réalisé dans le cadre d'un projet académique.
