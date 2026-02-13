<?php 
$pageTitle = htmlspecialchars($object['name'] ?? 'Détails de l\'objet');
$object = $object ?? null;
$owner = $owner ?? null;
$currentUser = $_SESSION['user'] ?? null;
$relatedObjects = $relatedObjects ?? [];
?>
<?php include __DIR__ . '/../header.php'; ?>

<style>
    .product-gallery {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .thumbnail:hover {
        border-color: #667eea;
    }

    .product-info {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .price-tag {
        font-size: 2.5rem;
        font-weight: 700;
        color: #667eea;
    }

    .owner-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .owner-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-top: 2rem;
    }

    .related-object {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .related-object:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .related-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .breadcrumb-custom {
        background: transparent;
        padding: 1rem 0;
    }

    .action-btn {
        border-radius: 10px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
    }
</style>

<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="<?= $base_path ?>/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="<?= $base_path ?>/object/list">Objets</a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($object['name']) ?></li>
        </ol>
    </nav>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Product Gallery -->
        <div class="col-lg-7">
            <div class="product-gallery">
                <img src="<?= $object['image_url'] ?? 'https://via.placeholder.com/600x500' ?>" 
                     id="mainImage"
                     class="main-image mb-3" 
                     alt="<?= htmlspecialchars($object['name']) ?>">
                <div class="d-flex gap-2">
                    <?php 
                    $images = $object['images'] ?? [$object['image_url']];
                    foreach (array_slice($images, 0, 5) as $img):
                    ?>
                    <img src="<?= $img ?>" 
                         class="thumbnail" 
                         onclick="changeImage(this.src)"
                         alt="Thumbnail">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-5">
            <div class="product-info">
                <div class="mb-3">
                    <span class="badge bg-<?= $object['status'] == 'available' ? 'success' : 'warning' ?> mb-2">
                        <?= ucfirst($object['status']) ?>
                    </span>
                    <span class="badge bg-secondary ms-2"><?= htmlspecialchars($object['category_name'] ?? 'Autre') ?></span>
                </div>

                <h1 class="mb-3"><?= htmlspecialchars($object['name']) ?></h1>
                
                <div class="price-tag mb-4"><?= number_format($object['price'], 0) ?> Ar</div>

                <div class="mb-4">
                    <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Description</h5>
                    <p class="text-muted"><?= nl2br(htmlspecialchars($object['description'])) ?></p>
                </div>

                <?php if ($currentUser && $currentUser['id'] != $object['owner_id']): ?>
                <div class="d-grid gap-2 mb-4">
                    <button class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#proposedModal">
                        <i class="bi bi-arrow-left-right me-2"></i>Proposer un échange
                    </button>
                    <button class="btn btn-outline-danger" onclick="addToWishlist(<?= $object['id'] ?>)">
                        <i class="bi bi-heart me-2"></i>Ajouter aux favoris
                    </button>
                </div>
                <?php elseif ($currentUser && $currentUser['id'] == $object['owner_id']): ?>
                <div class="d-grid gap-2 mb-4">
                    <a href="<?= $base_path ?>/object/edit/<?= $object['id'] ?>" class="btn btn-warning action-btn">
                        <i class="bi bi-pencil me-2"></i>Modifier l'objet
                    </a>
                    <button class="btn btn-outline-danger" onclick="deleteObject(<?= $object['id'] ?>)">
                        <i class="bi bi-trash me-2"></i>Supprimer
                    </button>
                </div>
                <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <a href="<?= $base_path ?>/auth/login">Connectez-vous</a> pour proposer un échange
                </div>
                <?php endif; ?>

                <!-- Object Details -->
                <div class="border-top pt-4">
                    <h6 class="mb-3 fw-bold">Détails</h6>
                    <div class="row g-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Catégorie</small>
                            <strong><?= htmlspecialchars($object['category_name'] ?? 'Non catégorisé') ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">État</small>
                            <strong><?= htmlspecialchars($object['condition'] ?? 'Bon état') ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Publié le</small>
                            <strong><?= date('d/m/Y', strtotime($object['created_at'])) ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Vues</small>
                            <strong><?= $object['views'] ?? 0 ?></strong>
                        </div>
                    </div>
                </div>

                <!-- Owner Info -->
                <div class="owner-card">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($owner['username'] ?? 'User') ?>&size=60&background=667eea&color=fff" 
                             class="owner-avatar me-3" 
                             alt="Owner">
                        <div class="flex-grow-1">
                            <h6 class="mb-1"><?= htmlspecialchars($owner['username'] ?? 'Utilisateur') ?></h6>
                            <small class="text-muted">
                                <i class="bi bi-star-fill text-warning"></i>
                                <?= $owner['rating'] ?? '4.8' ?> (<?= $owner['total_exchanges'] ?? 0 ?> échanges)
                            </small>
                        </div>
                        <a href="<?= $base_path ?>/user/<?= $owner['id'] ?>" class="btn btn-outline-primary btn-sm">
                            Voir profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Objects -->
    <?php if (!empty($relatedObjects)): ?>
    <div class="info-section">
        <h3 class="mb-4">
            <i class="bi bi-grid me-2"></i>Objets similaires
        </h3>
        <div class="row g-4">
            <?php foreach (array_slice($relatedObjects, 0, 4) as $related): ?>
            <div class="col-lg-3 col-md-6">
                <a href="<?= $base_path ?>/object/<?= $related['id'] ?>" class="text-decoration-none">
                    <div class="related-object">
                        <img src="<?= $related['image_url'] ?? 'https://via.placeholder.com/300x200' ?>" 
                             class="related-img" 
                             alt="<?= htmlspecialchars($related['name']) ?>">
                        <div class="p-3">
                            <h6 class="mb-2"><?= htmlspecialchars($related['name']) ?></h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold"><?= number_format($related['price'], 0) ?> Ar</span>
                                <small class="text-muted"><?= htmlspecialchars($related['category_name']) ?></small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Propose Exchange Modal -->
<div class="modal fade" id="proposedModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-arrow-left-right me-2"></i>Proposer un échange
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">Sélectionnez un de vos objets à échanger contre cet objet</p>
                <div class="row g-3">
                    <?php 
                    $myObjects = $currentUserObjects ?? [];
                    if (empty($myObjects)):
                    ?>
                        <div class="col-12 text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-3">Vous n'avez pas encore d'objets</p>
                            <a href="<?= $base_path ?>/object/new" class="btn btn-primary">
                                Publier un objet
                            </a>
                        </div>
                    <?php else:
                        foreach ($myObjects as $myObj):
                    ?>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <img src="<?= $myObj['image_url'] ?? 'https://via.placeholder.com/200' ?>" 
                                 class="card-img-top" 
                                 style="height: 150px; object-fit: cover;"
                                 alt="<?= htmlspecialchars($myObj['name']) ?>">
                            <div class="card-body">
                                <h6><?= htmlspecialchars($myObj['name']) ?></h6>
                                <p class="text-primary fw-bold"><?= number_format($myObj['price'], 0) ?> Ar</p>
                                <button class="btn btn-primary btn-sm w-100" onclick="proposeExchange(<?= $object['id'] ?>, <?= $myObj['id'] ?>)">
                                    Proposer cet objet
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

function proposeExchange(objectId, myObjectId) {
    fetch(`<?= $base_path ?>/exchange/propose`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            object1_id: myObjectId,
            object2_id: objectId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Échange proposé avec succès !');
            window.location.href = '<?= $base_path ?>/my-exchanges';
        } else {
            alert('Erreur: ' + (data.message || 'Impossible de proposer l\'échange'));
        }
    });
}

function addToWishlist(objectId) {
    fetch(`<?= $base_path ?>/wishlist/add/${objectId}`, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Ajouté aux favoris !');
        }
    });
}

function deleteObject(objectId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet objet ?')) {
        fetch(`<?= $base_path ?>/object/delete/${objectId}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '<?= $base_path ?>/my-objects';
            }
        });
    }
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>
