<?php 
$pageTitle = 'Accueil - Takalo';
?>
<?php include __DIR__ . '/header.php'; ?>

<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 5rem 0;
        color: white;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .search-box {
        background: white;
        border-radius: 50px;
        padding: 0.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .search-box input {
        border: none;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
    }

    .search-box .btn {
        border-radius: 50px;
        padding: 0.8rem 2rem;
    }

    .category-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .category-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .featured-object {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .featured-object:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .object-img-featured {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .stats-section {
        background: #f8f9fa;
        padding: 4rem 0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: #667eea;
    }

    .how-it-works {
        padding: 4rem 0;
    }

    .step-card {
        text-align: center;
        padding: 2rem;
    }

    .step-number {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="hero-title">Échangez vos objets facilement</h1>
                <p class="lead mb-4">Rejoignez la plus grande communauté d'échange à Madagascar. Donnez une nouvelle vie à vos objets !</p>
                <div class="d-flex gap-3">
                    <a href="<?= $base_path ?>/object/list" class="btn btn-light btn-lg">
                        <i class="bi bi-search me-2"></i>Parcourir les objets
                    </a>
                    <a href="<?= $base_path ?>/object/new" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Publier un objet
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="search-box">
                    <form class="d-flex" action="<?= $base_path ?>/search" method="GET">
                        <input type="text" class="form-control" name="q" placeholder="Rechercher un objet...">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-2"></i>Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Catégories populaires</h2>
            <p class="text-muted">Explorez nos catégories les plus recherchées</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="<?= $base_path ?>/category/electronics" class="text-decoration-none">
                    <div class="category-card">
                        <div class="category-icon text-primary">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5>Électronique</h5>
                        <p class="text-muted mb-0">1,234 objets</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= $base_path ?>/category/books" class="text-decoration-none">
                    <div class="category-card">
                        <div class="category-icon text-success">
                            <i class="bi bi-book"></i>
                        </div>
                        <h5>Livres</h5>
                        <p class="text-muted mb-0">856 objets</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= $base_path ?>/category/clothing" class="text-decoration-none">
                    <div class="category-card">
                        <div class="category-icon text-warning">
                            <i class="bi bi-bag"></i>
                        </div>
                        <h5>Vêtements</h5>
                        <p class="text-muted mb-0">642 objets</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= $base_path ?>/category/furniture" class="text-decoration-none">
                    <div class="category-card">
                        <div class="category-icon text-danger">
                            <i class="bi bi-house-door"></i>
                        </div>
                        <h5>Meubles</h5>
                        <p class="text-muted mb-0">423 objets</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Objects -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-2">Objets en vedette</h2>
                <p class="text-muted mb-0">Découvrez les derniers objets publiés</p>
            </div>
            <a href="<?= $base_path ?>/object/list" class="btn btn-outline-primary">
                Voir tout <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php 
            // Exemple - à remplacer par les vraies données
            $featured = $featuredObjects ?? [];
            for ($i = 0; $i < 4; $i++):
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="featured-object">
                    <img src="https://via.placeholder.com/300x250" class="object-img-featured" alt="Object">
                    <div class="p-3">
                        <span class="badge bg-success mb-2">Disponible</span>
                        <h5 class="mb-2">Objet Example <?= $i + 1 ?></h5>
                        <p class="text-muted small mb-3">Description courte de l'objet...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">15,000 Ar</span>
                            <a href="<?= $base_path ?>/object/<?= $i + 1 ?>" class="btn btn-sm btn-outline-primary">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-number">5,234</div>
                    <p class="text-muted mb-0">Objets disponibles</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-number">2,156</div>
                    <p class="text-muted mb-0">Utilisateurs actifs</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-number">3,892</div>
                    <p class="text-muted mb-0">Échanges réalisés</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-number">4.8</div>
                    <p class="text-muted mb-0">Note moyenne</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Comment ça marche ?</h2>
            <p class="text-muted">Suivez ces étapes simples pour échanger vos objets</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5 class="mb-3">Inscrivez-vous</h5>
                    <p class="text-muted">Créez votre compte gratuitement en quelques secondes</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5 class="mb-3">Publiez un objet</h5>
                    <p class="text-muted">Ajoutez des photos et décrivez votre objet</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5 class="mb-3">Proposez un échange</h5>
                    <p class="text-muted">Trouvez un objet qui vous intéresse et proposez un échange</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h5 class="mb-3">Échangez !</h5>
                    <p class="text-muted">Finalisez votre échange et profitez de votre nouvel objet</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="<?= $base_path ?>/register" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-2"></i>Commencer maintenant
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>