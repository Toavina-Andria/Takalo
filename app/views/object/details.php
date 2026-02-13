<?php 
$pageTitle = 'Détails de l\'objet';
?>
<?php include __DIR__ . '/../header.php'; ?>

<style>
    .product-section {
        padding: 3rem 0;
    }

    .product-image-main {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .product-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .product-thumbnail:hover,
    .product-thumbnail.active {
        border-color: #667eea;
    }

    .product-info {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .product-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: #667eea;
    }

    .product-category {
        background: #f3f4f6;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
    }

    .owner-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-top: 1.5rem;
    }

    .owner-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .feature-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }

    .exchange-btn {
        border-radius: 10px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .similar-product {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .similar-product:hover {
        transform: translateY(-5px);
    }

    .similar-product img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<?php 
// Exemple de données - à remplacer par les vraies données
$object = $objectDetails ?? [
    'id' => 1,
    'name' => 'iPhone 13 Pro',
    'description' => 'iPhone 13 Pro en excellent état, avec boîte et accessoires d\'origine. Batterie à 95%. Aucune rayure visible.',
    'price' => 3500000,
    'category' => 'Électronique',
    'status' => 'available',
    'image_url' => 'https://via.placeholder.com/600x500',
    'owner_name' => 'Jean Dupont',
    'owner_avatar' => 'https://ui-avatars.com/api/?name=Jean+Dupont',
    'created_at' => '2024-01-15',
    'views' => 245,
];
?>

<div class="product-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $base_path ?>/">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= $base_path ?>/object/list">Objets</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($object['name']) ?></li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Product Images -->
            <div class="col-lg-6">
                <img src="<?= $object['image_url'] ?>" class="product-image-main mb-3" id="mainImage" alt="<?= htmlspecialchars($object['name']) ?>">
                <div class="d-flex gap-2">
                    <img src="<?= $object['image_url'] ?>" class="product-thumbnail active" onclick="changeImage(this)">
                    <img src="https://via.placeholder.com/80" class="product-thumbnail" onclick="changeImage(this)">
                    <img src="https://via.placeholder.com/80" class="product-thumbnail" onclick="changeImage(this)">
                    <img src="https://via.placeholder.com/80" class="product-thumbnail" onclick="changeImage(this)">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info">
                    <span class="product-category mb-3">
                        <i class="bi bi-tag me-1"></i><?= htmlspecialchars($object['category']) ?>
                    </span>
                    
                    <h1 class="mt-3 mb-3"><?= htmlspecialchars($object['name']) ?></h1>
                    
                    <div class="product-price mb-4"><?= number_format($object['price'], 0) ?> Ar</div>
                    
                    <div class="d-flex gap-3 mb-4">
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>Disponible
                        </span>
                        <span class="text-muted">
                            <i class="bi bi-eye me-1"></i><?= $object['views'] ?> vues
                        </span>
                        <span class="text-muted">
                            <i class="bi bi-calendar me-1"></i>Publié le <?= date('d/m/Y', strtotime($object['created_at'])) ?>
                        </span>
                    </div>

                    <h5 class="mb-3">Description</h5>
                    <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($object['description'])) ?></p>

                    <h5 class="mb-3">Caractéristiques</h5>
                    <div class="feature-item">
                        <i class="bi bi-shield-check text-success me-2"></i>
                        <strong>Condition:</strong> Excellent état
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        <strong>Localisation:</strong> Antananarivo, Madagascar
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-arrow-repeat text-info me-2"></i>
                        <strong>Type d'échange:</strong> Échange direct uniquement
                    </div>

                    <div class="mt-4 d-grid gap-2">
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($_SESSION['user']['id'] != ($object['owner_id'] ?? 0)): ?>
                                <button class="btn btn-primary exchange-btn" data-bs-toggle="modal" data-bs-target="#proposeExchangeModal">
                                    <i class="bi bi-arrow-left-right me-2"></i>Proposer un échange
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-heart me-2"></i>Ajouter aux favoris
                                </button>
                            <?php else: ?>
                                <a href="<?= $base_path ?>/object/edit/<?= $object['id'] ?>" class="btn btn-success exchange-btn">
                                    <i class="bi bi-pencil me-2"></i>Modifier l'objet
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= $base_path ?>/auth/login" class="btn btn-primary exchange-btn">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Connectez-vous pour échanger
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Owner Card -->
                <div class="owner-card">
                    <h5 class="mb-3">
                        <i class="bi bi-person-circle text-primary me-2"></i>Propriétaire
                    </h5>
                    <div class="d-flex align-items-center">
                        <img src="<?= $object['owner_avatar'] ?>" class="owner-avatar me-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-1"><?= htmlspecialchars($object['owner_name']) ?></h6>
                            <div class="text-muted small">
                                <i class="bi bi-star-fill text-warning me-1"></i>4.8/5.0 (23 avis)
                            </div>
                            <div class="text-muted small">
                                <i class="bi bi-check-circle text-success me-1"></i>Membre vérifié
                            </div>
                        </div>
                        <a href="<?= $base_path ?>/user/<?= $object['owner_id'] ?? 0 ?>" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Voir profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Products -->
        <div class="mt-5">
            <h3 class="mb-4">
                <i class="bi bi-lightning me-2"></i>Objets similaires
            </h3>
            <div class="row g-4">
                <?php for($i = 0; $i < 4; $i++): ?>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="text-decoration-none">
                        <div class="similar-product">
                            <img src="https://via.placeholder.com/300x200" alt="Produit">
                            <div class="p-3">
                                <h6 class="mb-2">Objet similaire <?= $i + 1 ?></h6>
                                <div class="text-primary fw-bold">2 500 000 Ar</div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<!-- Propose Exchange Modal -->
<div class="modal fade" id="proposeExchangeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-arrow-left-right me-2"></i>Proposer un échange
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Sélectionnez un de vos objets à proposer en échange
                </div>
                <form id="proposeExchangeForm" method="post" action="<?= $base_path ?>/exchange/propose">
                    <input type="hidden" name="target_object_id" value="<?= $object['id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Votre objet à proposer</label>
                        <select name="my_object_id" class="form-select" required>
                            <option value="">Sélectionnez un objet...</option>
                            <!-- À remplir dynamiquement avec les objets de l'utilisateur -->
                            <option value="1">MacBook Pro 2020 - 4 000 000 Ar</option>
                            <option value="2">iPad Air - 2 000 000 Ar</option>
                            <option value="3">AirPods Pro - 800 000 Ar</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Message (optionnel)</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Ajoutez un message pour le propriétaire..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="proposeExchangeForm" class="btn btn-primary">
                    <i class="bi bi-send me-2"></i>Envoyer la proposition
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function changeImage(img) {
    document.getElementById('mainImage').src = img.src;
    document.querySelectorAll('.product-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    img.classList.add('active');
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>
