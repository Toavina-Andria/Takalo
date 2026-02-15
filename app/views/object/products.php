<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Takalo - Liste des produits</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/animate.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/aos.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/jquery.timepicker.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/flaticon.css">
    <link rel="stylesheet" href="<?= $base_path ?>/assets/css/icomoon.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar-takalo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
        }
        
        .navbar-takalo .navbar-brand {
            font-family: 'Amatic SC', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: white !important;
        }
        
        .navbar-takalo .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .navbar-takalo .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .hero-wrap {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 0 60px;
            color: white;
        }
        
        .breadcrumbs {
            margin-bottom: 15px;
        }
        
        .breadcrumbs a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        
        .product-category {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .product-category li a {
            display: inline-block;
            padding: 10px 25px;
            background: white;
            color: #667eea;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .product-category li a.active,
        .product-category li a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        .product {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        
        .img-prod {
            position: relative;
            display: block;
            overflow: hidden;
            height: 280px;
        }
        
        .img-prod img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .product:hover .img-prod img {
            transform: scale(1.1);
        }
        
        .status {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff6b6b;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            z-index: 2;
        }
        
        .status.disponible {
            background: #51cf66;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(102, 126, 234, 0.2);
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .product:hover .overlay {
            opacity: 1;
        }
        
        .product .text {
            padding: 20px;
        }
        
        .product h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .product h3 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .product h3 a:hover {
            color: #667eea;
        }
        
        .pricing .price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #667eea;
        }
        
        .price-dc {
            text-decoration: line-through;
            color: #999;
            font-size: 1rem;
        }
        
        .price-sale {
            color: #ff6b6b;
        }
        
        .bottom-area {
            padding: 15px 20px;
            border-top: 1px solid #f0f0f0;
        }
        
        .bottom-area a {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            color: #667eea;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .bottom-area a:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }
        
        .user-menu-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .user-menu-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: none;
        }
        
        .search-bar {
            background: rgba(255,255,255,0.9);
            border-radius: 25px;
            padding: 8px 20px;
            border: none;
            width: 300px;
        }
        
        .search-bar:focus {
            outline: none;
            background: white;
        }
    </style>
</head>
<body class="goto-here">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-takalo">
        <div class="container">
            <a class="navbar-brand" href="<?= $base_path ?>/">Takalo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <input type="text" class="form-control search-bar" placeholder="Rechercher un produit...">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>/objects">
                            <i class="bi bi-grid"></i> Produits
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user_connected'])): ?>
                        <li class="nav-item dropdown">
                            <button class="btn user-menu-btn dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <?= htmlspecialchars($_SESSION['user_connected']['username'] ?? 'Utilisateur') ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= $base_path ?>/user/profile">
                                    <i class="bi bi-person"></i> Mon profil
                                </a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/user/my-objects">
                                    <i class="bi bi-box"></i> Mes objets
                                </a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/user/my-exchanges">
                                    <i class="bi bi-arrow-left-right"></i> Mes échanges
                                </a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>/object/insertObject">
                                    <i class="bi bi-plus-circle"></i> Ajouter un objet
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= $base_path ?>/auth/logout">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn user-menu-btn" href="<?= $base_path ?>/auth/login">
                                <i class="bi bi-box-arrow-in-right"></i> Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-wrap">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-9">
                    <p class="breadcrumbs">
                        <span class="me-2"><a href="<?= $base_path ?>/">Accueil</a></span>
                        <span>Produits</span>
                    </p>
                    <h1 class="mb-0" style="font-size: 3rem; font-weight: 700;">Tous les produits</h1>
                    <p class="mt-3" style="font-size: 1.1rem; opacity: 0.9;">
                        Découvrez tous les objets disponibles pour l'échange
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            
            <!-- Category Filter -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-10 text-center">
                    <ul class="product-category">
                        <li><a href="#" class="active" data-category="all">Tous</a></li>
                        <?php if (isset($categories) && !empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <li><a href="#" data-category="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a href="#">Électronique</a></li>
                            <li><a href="#">Livres</a></li>
                            <li><a href="#">Vêtements</a></li>
                            <li><a href="#">Sport</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row">
                <?php 
                $objects = Flight::view()->get('list_object') ?? [];
                
                if (empty($objects)): 
                ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                            <h3 class="mt-3 text-muted">Aucun produit disponible</h3>
                            <p class="text-muted">Revenez plus tard pour découvrir de nouveaux objets</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($objects as $obj): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="product">
                                <a href="<?= $base_path ?>/object/detail/<?= $obj['id'] ?>" class="img-prod">
                                    <img class="img-fluid" 
                                         src="<?= $obj['image_url'] ?? $base_path . '/images/no-image.png' ?>" 
                                         alt="<?= htmlspecialchars($obj['name']) ?>">
                                    <span class="status disponible">Disponible</span>
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="<?= $base_path ?>/object/detail/<?= $obj['id'] ?>"><?= htmlspecialchars($obj['name']) ?></a></h3>
                                    <div class="d-flex justify-content-center">
                                        <div class="pricing">
                                            <?php if (isset($obj['price']) && $obj['price'] > 0): ?>
                                                <p class="price mb-0"><span><?= number_format($obj['price'], 2) ?> Ar</span></p>
                                            <?php else: ?>
                                                <p class="price mb-0"><span>À échanger</span></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <?php 
                                        $desc = $obj['description'] ?? '';
                                        echo htmlspecialchars(strlen($desc) > 60 ? substr($desc, 0, 60) . '...' : $desc); 
                                        ?>
                                    </p>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex gap-2">
                                        <a href="<?= $base_path ?>/object/detail/<?= $obj['id'] ?>" 
                                           class="d-flex justify-content-center align-items-center"
                                           title="Voir les détails">
                                            <span><i class="bi bi-eye"></i></span>
                                        </a>
                                        <a href="<?= $base_path ?>/object/detail/<?= $obj['id'] ?>" 
                                           class="d-flex justify-content-center align-items-center"
                                           title="Proposer un échange">
                                            <span><i class="bi bi-arrow-left-right"></i></span>
                                        </a>
                                        <a href="#" 
                                           class="d-flex justify-content-center align-items-center"
                                           title="Ajouter aux favoris">
                                            <span><i class="bi bi-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if (!empty($objects) && count($objects) > 12): ?>
            <div class="row mt-5">
                <div class="col text-center">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Précédent</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Suivant</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="font-family: 'Amatic SC', cursive; font-size: 1.8rem;">Takalo</h5>
                    <p class="text-muted">Plateforme d'échange d'objets</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">&copy; <?= date('Y') ?> Takalo. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Category filter
        document.querySelectorAll('.product-category a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Update active state
                document.querySelectorAll('.product-category a').forEach(a => a.classList.remove('active'));
                this.classList.add('active');
                
                // Filter products (implement AJAX call here if needed)
                const category = this.dataset.category;
                console.log('Filter by category:', category);
            });
        });

        // Search functionality
        const searchBar = document.querySelector('.search-bar');
        if (searchBar) {
            searchBar.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                console.log('Search for:', searchTerm);
                // Implement search logic here
            });
        }
    </script>
</body>
</html>
