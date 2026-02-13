    <script src="<?= $base_path ?>/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <footer class="footer mt-auto py-4 bg-dark text-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase fw-bold mb-3">
                        <i class="bi bi-arrow-left-right-circle me-2"></i>
                        Takalo
                    </h5>
                    <p class="text-muted small">
                        Plateforme d'échange moderne et sécurisée. Échangez vos objets facilement avec d'autres utilisateurs en toute confiance.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase fw-bold mb-3">Navigation</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/" class="text-muted text-decoration-none small">
                                <i class="bi bi-chevron-right me-1"></i>Accueil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/object/list" class="text-muted text-decoration-none small">
                                <i class="bi bi-chevron-right me-1"></i>Objets
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/exchanges" class="text-muted text-decoration-none small">
                                <i class="bi bi-chevron-right me-1"></i>Échanges
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/about" class="text-muted text-decoration-none small">
                                <i class="bi bi-chevron-right me-1"></i>À propos
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/help" class="text-muted text-decoration-none small">
                                <i class="bi bi-question-circle me-1"></i>Centre d'aide
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/contact" class="text-muted text-decoration-none small">
                                <i class="bi bi-envelope me-1"></i>Contact
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/terms" class="text-muted text-decoration-none small">
                                <i class="bi bi-file-text me-1"></i>Conditions
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/privacy" class="text-muted text-decoration-none small">
                                <i class="bi bi-shield-check me-1"></i>Confidentialité
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Équipe de développement -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-uppercase fw-bold mb-3">
                        <i class="bi bi-people-fill me-1"></i>Équipe
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge text-primary me-2"></i>
                                <div>
                                    <div class="text-light small fw-semibold">Mamy Aiky Rakotomalala</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">ETU 003936</div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge text-success me-2"></i>
                                <div>
                                    <div class="text-light small fw-semibold">Toavina Andriamonta</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">ETU 004235</div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge text-info me-2"></i>
                                <div>
                                    <div class="text-light small fw-semibold">Nekena Manovosoa</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">ETU 004193</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted mb-0 small">
                        <i class="bi bi-c-circle me-1"></i>
                        <?= date('Y') ?> Takalo. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-muted mb-0 small">
                        <i class="bi bi-code-slash me-1"></i>
                        Développé avec <i class="bi bi-heart-fill text-danger"></i> à Madagascar
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Footer Styles */
        footer.footer {
            margin-top: auto;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        footer.footer a:hover {
            color: #ffffff !important;
            transform: translateX(3px);
            transition: all 0.3s ease;
        }

        footer.footer .btn-outline-light:hover {
            transform: scale(1.1);
            transition: all 0.3s ease;
        }

        /* Ensure body takes full height */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</body>
</html>
