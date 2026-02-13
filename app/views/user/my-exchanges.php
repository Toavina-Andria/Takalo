<?php 
$pageTitle = 'Mes Échanges';
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: ' . $base_path . '/auth/login');
    exit;
}
?>
<?php include __DIR__ . '/../header.php'; ?>

<style>
    .page-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .exchange-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .exchange-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .exchange-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .exchange-objects {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .object-preview {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .object-image-small {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
    }

    .exchange-arrow {
        font-size: 2rem;
        color: #667eea;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-accepted { background: #d1fae5; color: #065f46; }
    .status-rejected { background: #fee2e2; color: #991b1b; }
    .status-cancelled { background: #e5e7eb; color: #374151; }

    .tabs-custom {
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 2rem;
    }

    .tab-item {
        padding: 1rem 1.5rem;
        border-bottom: 3px solid transparent;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .tab-item:hover {
        color: #667eea;
    }

    .tab-item.active {
        color: #667eea;
        border-bottom-color: #667eea;
        font-weight: 600;
    }

    .action-buttons .btn {
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="text-white mb-2">
                    <i class="bi bi-arrow-left-right me-2"></i>Mes Échanges
                </h2>
                <p class="text-white-50 mb-0">Suivez tous vos échanges en cours et passés</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="text-white">
                    <div class="h3 mb-0"><?= count($exchanges ?? []) ?></div>
                    <small>Total d'échanges</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Tabs -->
    <div class="d-flex tabs-custom mb-4">
        <div class="tab-item active" data-filter="all">
            <i class="bi bi-list-ul me-2"></i>Tous (<?= count($exchanges ?? []) ?>)
        </div>
        <div class="tab-item" data-filter="pending">
            <i class="bi bi-clock-history me-2"></i>En attente (<?= count(array_filter($exchanges ?? [], fn($e) => $e['status'] == 'pending')) ?>)
        </div>
        <div class="tab-item" data-filter="accepted">
            <i class="bi bi-check-circle me-2"></i>Acceptés (<?= count(array_filter($exchanges ?? [], fn($e) => $e['status'] == 'accepted')) ?>)
        </div>
        <div class="tab-item" data-filter="rejected">
            <i class="bi bi-x-circle me-2"></i>Rejetés
        </div>
    </div>

    <!-- Exchanges List -->
    <?php 
    $exchanges = $userExchanges ?? [];
    if (empty($exchanges)):
    ?>
        <div class="text-center py-5">
            <i class="bi bi-arrow-left-right display-1 text-muted"></i>
            <h4 class="mt-3 text-muted">Aucun échange</h4>
            <p class="text-muted">Vous n'avez pas encore d'échange en cours</p>
            <a href="<?= $base_path ?>/object/list" class="btn btn-primary mt-3">
                <i class="bi bi-search me-2"></i>Parcourir les objets
            </a>
        </div>
    <?php else:
        foreach ($exchanges as $exchange):
            $statusClass = 'status-' . $exchange['status'];
            $isInitiator = ($exchange['user1_id'] == $user['id']);
    ?>
        <div class="exchange-card" data-status="<?= $exchange['status'] ?>">
            <div class="exchange-header">
                <div>
                    <h5 class="mb-1">Échange #<?= $exchange['id'] ?></h5>
                    <small class="text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        <?= date('d F Y à H:i', strtotime($exchange['created_at'])) ?>
                    </small>
                </div>
                <span class="status-badge <?= $statusClass ?>">
                    <?php
                        $statusLabels = [
                            'pending' => 'En attente',
                            'accepted' => 'Accepté',
                            'rejected' => 'Rejeté',
                            'cancelled' => 'Annulé'
                        ];
                        echo $statusLabels[$exchange['status']] ?? $exchange['status'];
                    ?>
                </span>
            </div>

            <div class="exchange-objects">
                <!-- Your Object -->
                <div class="object-preview">
                    <img src="<?= $exchange['object1_image'] ?? 'https://via.placeholder.com/80' ?>" 
                         class="object-image-small" 
                         alt="Mon objet">
                    <div>
                        <div class="fw-bold text-primary">Votre objet</div>
                        <div class="fw-semibold"><?= htmlspecialchars($exchange['object1_name']) ?></div>
                        <div class="text-success fw-bold"><?= number_format($exchange['object1_price'], 0) ?> Ar</div>
                    </div>
                </div>

                <!-- Arrow -->
                <div class="exchange-arrow">
                    <i class="bi bi-arrow-left-right"></i>
                </div>

                <!-- Other Object -->
                <div class="object-preview">
                    <img src="<?= $exchange['object2_image'] ?? 'https://via.placeholder.com/80' ?>" 
                         class="object-image-small" 
                         alt="Objet proposé">
                    <div>
                        <div class="fw-bold text-info">Objet proposé</div>
                        <div class="fw-semibold"><?= htmlspecialchars($exchange['object2_name']) ?></div>
                        <div class="text-success fw-bold"><?= number_format($exchange['object2_price'], 0) ?> Ar</div>
                    </div>
                </div>
            </div>

            <!-- Exchange Info -->
            <div class="mt-3 pt-3 border-top">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="bi bi-person me-1"></i>
                            <?php if ($isInitiator): ?>
                                Échange avec <strong><?= htmlspecialchars($exchange['user2_name']) ?></strong>
                            <?php else: ?>
                                Proposé par <strong><?= htmlspecialchars($exchange['user1_name']) ?></strong>
                            <?php endif; ?>
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end mt-2 mt-md-0">
                        <div class="action-buttons">
                            <?php if ($exchange['status'] == 'pending'): ?>
                                <?php if (!$isInitiator): ?>
                                    <button class="btn btn-success btn-sm me-2" onclick="acceptExchange(<?= $exchange['id'] ?>)">
                                        <i class="bi bi-check-lg me-1"></i>Accepter
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="rejectExchange(<?= $exchange['id'] ?>)">
                                        <i class="bi bi-x-lg me-1"></i>Refuser
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="cancelExchange(<?= $exchange['id'] ?>)">
                                        <i class="bi bi-x-circle me-1"></i>Annuler
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                            <a href="<?= $base_path ?>/exchange/<?= $exchange['id'] ?>" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        endforeach;
    endif;
    ?>
</div>

<script>
// Tab filtering
document.querySelectorAll('.tab-item').forEach(tab => {
    tab.addEventListener('click', function() {
        // Update active tab
        document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        // Filter exchanges
        const filter = this.dataset.filter;
        document.querySelectorAll('.exchange-card').forEach(card => {
            if (filter === 'all' || card.dataset.status === filter) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

function acceptExchange(id) {
    if (confirm('Accepter cet échange ?')) {
        fetch(`<?= $base_path ?>/exchange/accept/${id}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur: ' + (data.message || 'Impossible d\'accepter l\'échange'));
            }
        });
    }
}

function rejectExchange(id) {
    if (confirm('Refuser cet échange ?')) {
        fetch(`<?= $base_path ?>/exchange/reject/${id}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur: ' + (data.message || 'Impossible de refuser l\'échange'));
            }
        });
    }
}

function cancelExchange(id) {
    if (confirm('Annuler cet échange ?')) {
        fetch(`<?= $base_path ?>/exchange/cancel/${id}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur: ' + (data.message || 'Impossible d\'annuler l\'échange'));
            }
        });
    }
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>
