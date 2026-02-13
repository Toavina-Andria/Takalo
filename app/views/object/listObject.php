<?php $pageTitle = 'Liste des objets'; ?>
<?php include __DIR__ . '/../header.php'; ?>
<style>
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-wrapper {
            min-height: 100vh;
            padding-top: 40px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .object-item {
            transition: background 0.2s, transform 0.15s;
            cursor: pointer;
        }

        .object-item:hover {
            background-color: #f0f4ff;
            transform: translateY(-1px);
        }

        .object-img {
            width: 56px;
            height: 56px;
            border-radius: 10px;
            object-fit: cover;
            background-color: #e5e7eb;
        }

        .price {
            color: #16a34a;
            font-weight: 600;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
</style>

<div class="container page-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">

                    <a href="/object/insertObject" class="btn btn-primary btn-sm" title="Ajouter un objet">
                        <i class="bi bi-plus-lg">Ajouter</i>
                    </a>


                        <div>
                            <h5 class="mb-0">Objets disponibles</h5>
                            <small class="text-muted">
                                Sélectionnez un objet pour proposer un échange
                            </small>
                        </div>
                        <a href="/" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">

                    <?php $objects = Flight::view()->get('list_object'); ?>

                    <?php if (empty($objects)) { ?>
                        <div class="p-4 text-center text-muted">
                            Aucun objet disponible
                        </div>
                    <?php } else { ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($objects as $obj) { ?>
                                <a href="/object/<?= $obj['id'] ?>">
                                    <li class="list-group-item d-flex align-items-center gap-3 object-item">
                                        
                                        <img
                                            src="<?= $obj['image_url'] ?? '/assets/img/no-image.png' ?>"
                                            class="object-img"
                                            alt="objet"
                                        >

                                        <div class="flex-grow-1">
                                            <strong><?= htmlspecialchars($obj['name']) ?></strong>
                                            <div class="text-muted small">
                                                <?= htmlspecialchars($obj['description']) ?>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <div class="price">
                                                <?= number_format($obj['price'], 0, ',', ' ') ?> Ar
                                            </div>
                                            <small class="text-muted">
                                                <?= date('d/m/Y', strtotime($obj['created_at'])) ?>
                                            </small>
                                        </div>

                                    </li>
                                </a>
                            <?php } ?>
                        </ul>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
