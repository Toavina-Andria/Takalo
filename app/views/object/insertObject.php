<?php
  $pageTitle = 'Ajouter un objet';
  $bodyClass = 'bg-light';
?>
<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-box-seam"></i> Nouvel objet
                    </h5>
                </div>

                <div class="card-body">

                    <form action="/object/create" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                <?php
                                $categories = Flight::view()->get('categories') ?? [];
                                foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix (Ar)</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Image
                                <i class="bi bi-image ms-1"></i>
                            </label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/listObjects" class="btn btn-outline-secondary">
                                Annuler
                            </a>
                            <button class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Enregistrer
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
