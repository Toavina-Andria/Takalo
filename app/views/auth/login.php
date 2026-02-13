<?php
  function e($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
  $error = Flight::view()->get('error') ?? null;
  $pageTitle = 'Connexion';
  $bodyClass = 'bg-light';
?>
<?php include __DIR__ . '/../header.php'; ?>
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
            <i class="bi bi-person-circle fs-1"></i>
            <h4 class="mb-0 mt-2">Connexion</h4>
          </div>
          <div class="card-body p-4">
            <?php if($error): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= e($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>
            
            <form action="/auth/login" method="POST">
              <div class="mb-3">
                <label class="form-label fw-semibold">
                  <i class="bi bi-envelope me-1"></i>Email
                </label>
                <input 
                  type="email" 
                  class="form-control form-control-lg" 
                  name="email"
                  placeholder="Entrez votre email"
                  required
                >
              </div>
              
              <div class="mb-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-lock me-1"></i>Mot de passe
                </label>
                <input 
                  type="password" 
                  class="form-control form-control-lg" 
                  name="password"
                  placeholder="Entrez votre mot de passe"
                  required
                >
              </div>
              
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
              </div>
              
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
              </div>
            </form>
          </div>
          <div class="card-footer bg-light text-center py-3 rounded-bottom-4">
            <p class="mb-0 text-muted">
              Pas encore de compte ? 
              <a href="/" class="text-primary text-decoration-none fw-semibold">S'inscrire</a>
            </p>
          </div>
        </div>
      </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
