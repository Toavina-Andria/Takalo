<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Takalo - Plateforme d'échange moderne et sécurisée">
    <meta name="author" content="Takalo Team">
    <title><?= $pageTitle ?? 'Takalo - Plateforme d\'Échange' ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= $base_path ?>/favicon.ico">
    
    <!-- Stylesheets -->
    <link href="<?= $base_path ?>/assets/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base_path ?>/assets/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $base_path ?>/assets/css/dashboard.css" rel="stylesheet">
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link href="<?= $css ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --header-height: 70px;
        }

        /* Header Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
            min-height: var(--header-height);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            font-size: 2rem;
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff !important;
        }

        .nav-link i {
            margin-right: 0.4rem;
        }

        /* Search Bar */
        .search-bar {
            position: relative;
            max-width: 400px;
        }

        .search-bar input {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
            background: #fff;
        }

        .search-bar i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-badge {
            position: relative;
        }

        .notification-badge .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 0.25em 0.5em;
            border-radius: 50%;
            font-size: 0.65rem;
        }

        .btn-icon {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: scale(1.1);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            padding-left: 1.5rem;
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: #f8f9fa;
            padding: 1rem 0;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 991px) {
            .search-bar {
                max-width: 100%;
                margin: 1rem 0;
            }
        }
    </style>
</head>
<body<?= isset($bodyClass) ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= $base_path ?>/">
                <i class="bi bi-arrow-left-right-circle"></i>
                <span>Takalo</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') == $base_path . '/' ? 'active' : '' ?>" href="<?= $base_path ?>/">
                            <i class="bi bi-house-door"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/object') !== false ? 'active' : '' ?>" href="<?= $base_path ?>/object/list">
                            <i class="bi bi-box-seam"></i>Objets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/exchange') !== false ? 'active' : '' ?>" href="<?= $base_path ?>/exchanges">
                            <i class="bi bi-arrow-left-right"></i>Échanges
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>/categories">
                            <i class="bi bi-grid-3x3"></i>Catégories
                        </a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <div class="search-bar d-none d-lg-block me-3">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Rechercher un objet...">
                </div>

                <!-- User Menu -->
                <div class="user-menu">
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Notifications -->
                        <div class="notification-badge">
                            <button class="btn btn-icon" data-bs-toggle="dropdown">
                                <i class="bi bi-bell fs-5"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle text-success"></i>Échange accepté</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-clock text-warning"></i>Nouvel échange proposé</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle text-info"></i>Nouveau message</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center small" href="#">Voir tout</a></li>
                            </ul>
                        </div>

                        <!-- Messages -->
                        <div class="notification-badge">
                            <button class="btn btn-icon" data-bs-toggle="dropdown">
                                <i class="bi bi-chat-dots fs-5"></i>
                                <span class="badge bg-success">2</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Messages</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i>Message de User123</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i>Réponse à votre offre</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center small" href="#">Voir tout</a></li>
                            </ul>
                        </div>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="dropdown">
                                <img src="<?= $base_path ?>/assets/img/default-avatar.png" 
                                     alt="User" 
                                     class="user-avatar"
                                     onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user']['username'] ?? 'User') ?>&background=667eea&color=fff'">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">
                                    <i class="bi bi-person-circle"></i> 
                                    <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Utilisateur') ?>
                                </h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/profile"><i class="bi bi-person"></i>Mon Profil</a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/my-objects"><i class="bi bi-box"></i>Mes Objets</a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/my-exchanges"><i class="bi bi-arrow-repeat"></i>Mes Échanges</a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/settings"><i class="bi bi-gear"></i>Paramètres</a></li>
                                <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary" href="<?= $base_path ?>/admin/dashboard"><i class="bi bi-speedometer2"></i>Admin Dashboard</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= $base_path ?>/logout"><i class="bi bi-box-arrow-right"></i>Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Login/Register Buttons -->
                        <a href="<?= $base_path ?>/auth/login" class="btn btn-outline-light btn-sm me-2">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                        <a href="<?= $base_path ?>/register" class="btn btn-light btn-sm">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

