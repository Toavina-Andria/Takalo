<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'objet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }
        .object-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .price {
            color: #16a34a;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <?php $object = Flight::view()->get('object'); ?>

    <div class="card shadow-sm">
        <div class="row g-0">

            <!-- Images -->
            <div class="col-md-5 p-3">
                <?php if (!empty($object['images'])) { ?>
                    <?php foreach ($object['images'] as $img) { ?>
                        <img src="<?= $img ?>" class="object-img mb-2" alt="image objet">
                    <?php } ?>
                <?php } else { ?>
                    <img src="<?= $object['image_url'] ?? '/assets/img/no-image.png' ?>" class="object-img" alt="image objet">
                <?php } ?>
            </div>

            <!-- Infos -->
            <div class="col-md-7 p-4">
                <h3><?= $object['name'] ?></h3>

                <p class="text-muted">
                    Catégorie : <?= $object['category_name'] ?? 'Non définie' ?>
                </p>

                <p><?= nl2br($object['description']) ?></p>

                <h4 class="price">
                    <?= number_format($object['price'], 0, ',', ' ') ?> Ar
                </h4>

                <p class="small text-muted">
                    Propriétaire : <?= $object['owner_username'] ?>
                </p>

                <p class="small text-muted">
                    Ajouté le : <?= date('d/m/Y', strtotime($object['created_at'])) ?>
                </p>

                <a href="/listObjects" class="btn btn-outline-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>
