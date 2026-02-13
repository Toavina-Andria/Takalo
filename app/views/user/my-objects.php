<?php 
$pageTitle = 'Mes Objets';
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: ' . $base_path . '/auth/login');
    exit;
}
?>
<?php include __DIR__ . '/../header.php'; ?>

<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .object-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .object-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .object-image {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }

    .object-body {
        padding: 1.5rem;
    }

    .object-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .object-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #667eea;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .filter-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .action-btn-group .btn {
        border-radius: 8px;
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="text-white mb-2">
                    <i class="bi bi-box-seam me-2"></i>Mes Objets
                </h2>
                <p class="text-white-50 mb-0">Gérez vos objets en ligne</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="<?= $base_path ?>/object/new" class="btn btn-light btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Publier un objet
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Filters -->
    <div class="filter-card">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Rechercher</label>
                <input type="text" class="form-control" placeholder="Nom de l'objet...">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Catégorie</label>
                <select class="form-select">
                    <option value="">Toutes</option>
                    <option>Électronique</option>
                    <option>Livres</option>
                    <option>Vêtements</option>
                    <option>Meubles</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Statut</label>
                <select class="form-select">
                    <option value="">Tous</option>
                    <option>Disponible</option>
                    <option>En échange</option>
                    <option>Échangé</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Trier par</label>
                <select class="form-select">
                    <option>Plus récent</option>
                    <option>Plus ancien</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Objects Grid -->
    <div class="row g-4">
        <?php 
        // Exemple de données - à remplacer par les vraies données
        $objects = $userObjects ?? [];
        if (empty($objects)):
        ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">Aucun objet publié</h4>
                    <p class="text-muted">Commencez par publier votre premier objet !</p>
                    <a href="<?= $base_path ?>/object/new" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Publier un objet
                    </a>
                </div>
            </div>
        <?php else: 
            foreach ($objects as $obj):
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="object-card">
                    <img src="<?= $obj['image_url'] ?? 'https://via.placeholder.com/300x220' ?>" 
                         class="object-image" 
                         alt="<?= htmlspecialchars($obj['name']) ?>">
                    <div class="object-body">
                        <span class="status-badge <?= $obj['status'] == 'available' ? 'bg-success' : 'bg-warning' ?> text-white">
                            <?= ucfirst($obj['status']) ?>
                        </span>
                        <h5 class="object-title mt-2"><?= htmlspecialchars($obj['name']) ?></h5>
                        <p class="text-muted small mb-2"><?= substr(htmlspecialchars($obj['description']), 0, 80) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="object-price"><?= number_format($obj['price'], 0) ?> Ar</span>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                <?= date('d/m/Y', strtotime($obj['created_at'])) ?>
                            </small>
                        </div>
                        <div class="action-btn-group d-flex gap-2">
                            <a href="<?= $base_path ?>/object/<?= $obj['id'] ?>" class="btn btn-outline-primary flex-fill">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= $base_path ?>/object/edit/<?= $obj['id'] ?>" class="btn btn-outline-success flex-fill">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-outline-danger flex-fill" onclick="deleteObject(<?= $obj['id'] ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            endforeach;
        endif;
        ?>
    </div>

    <!-- Pagination -->
    <?php if (!empty($objects)): ?>
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<script>
function deleteObject(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet objet ?')) {
        fetch(`<?= $base_path ?>/object/delete/${id}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression');
            }
        });
    }
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>
