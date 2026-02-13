<?php 
$pageTitle = 'Mon Profil';
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: ' . $base_path . '/auth/login');
    exit;
}
?>
<?php include __DIR__ . '/../header.php'; ?>

<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .info-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .action-btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
</style>

<!-- Profile Header -->
<div class="profile-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-auto text-center text-md-start mb-3 mb-md-0">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&size=120&background=667eea&color=fff" 
                     alt="Avatar" 
                     class="profile-avatar">
            </div>
            <div class="col-md">
                <div class="text-white">
                    <h2 class="mb-2"><?= htmlspecialchars($user['username']) ?></h2>
                    <p class="mb-2">
                        <i class="bi bi-envelope me-2"></i><?= htmlspecialchars($user['email']) ?>
                    </p>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-calendar-check me-1"></i>
                        Membre depuis <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?>
                    </span>
                </div>
            </div>
            <div class="col-md-auto text-center text-md-end">
                <button class="btn btn-light action-btn me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="bi bi-pencil me-2"></i>Modifier le profil
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container mb-5">
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card text-center">
                <i class="bi bi-box-seam display-4 text-primary mb-3"></i>
                <div class="stat-number"><?= $stats['total_objects'] ?? 0 ?></div>
                <div class="text-muted">Objets publiés</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card text-center">
                <i class="bi bi-arrow-left-right display-4 text-success mb-3"></i>
                <div class="stat-number"><?= $stats['total_exchanges'] ?? 0 ?></div>
                <div class="text-muted">Échanges réalisés</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card text-center">
                <i class="bi bi-clock-history display-4 text-warning mb-3"></i>
                <div class="stat-number"><?= $stats['pending_exchanges'] ?? 0 ?></div>
                <div class="text-muted">En attente</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card text-center">
                <i class="bi bi-star display-4 text-info mb-3"></i>
                <div class="stat-number">4.8</div>
                <div class="text-muted">Note moyenne</div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Information -->
<div class="container mb-5">
    <div class="row g-4">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="info-card">
                <h4 class="mb-4">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    Informations personnelles
                </h4>
                <div class="info-item">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Nom d'utilisateur</span>
                        <strong><?= htmlspecialchars($user['username']) ?></strong>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <strong><?= htmlspecialchars($user['email']) ?></strong>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Téléphone</span>
                        <strong><?= htmlspecialchars($user['phone'] ?? 'Non renseigné') ?></strong>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Adresse</span>
                        <strong><?= htmlspecialchars($user['address'] ?? 'Non renseignée') ?></strong>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Statut du compte</span>
                        <span class="badge-status bg-success text-white">
                            <i class="bi bi-check-circle"></i> Actif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity & Settings -->
        <div class="col-lg-6">
            <div class="info-card mb-4">
                <h4 class="mb-4">
                    <i class="bi bi-activity text-primary me-2"></i>
                    Activité récente
                </h4>
                <div class="info-item">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock text-info me-3"></i>
                        <div>
                            <strong>Dernière connexion</strong>
                            <p class="text-muted mb-0 small">Aujourd'hui à 14:30</p>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-box text-primary me-3"></i>
                        <div>
                            <strong>Dernier objet publié</strong>
                            <p class="text-muted mb-0 small">Il y a 2 jours</p>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-arrow-repeat text-success me-3"></i>
                        <div>
                            <strong>Dernier échange</strong>
                            <p class="text-muted mb-0 small">Il y a 1 semaine</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h4 class="mb-4">
                    <i class="bi bi-shield-check text-primary me-2"></i>
                    Actions rapides
                </h4>
                <div class="d-grid gap-2">
                    <a href="<?= $base_path ?>/object/new" class="btn btn-primary action-btn">
                        <i class="bi bi-plus-circle me-2"></i>Publier un objet
                    </a>
                    <a href="<?= $base_path ?>/my-objects" class="btn btn-outline-primary action-btn">
                        <i class="bi bi-box-seam me-2"></i>Mes objets
                    </a>
                    <a href="<?= $base_path ?>/my-exchanges" class="btn btn-outline-success action-btn">
                        <i class="bi bi-arrow-left-right me-2"></i>Mes échanges
                    </a>
                    <a href="<?= $base_path ?>/settings" class="btn btn-outline-secondary action-btn">
                        <i class="bi bi-gear me-2"></i>Paramètres
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i>Modifier le profil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" method="post" action="<?= $base_path ?>/profile/update">
                    <div class="mb-3">
                        <label class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="editProfileForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
