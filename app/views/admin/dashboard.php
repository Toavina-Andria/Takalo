<?php $pageTitle = 'Admin Dashboard'; ?>
<?php include __DIR__ . '/../header.php'; ?>

    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome to your Takalo exchange management system</p>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-title">Total Exchanges</div>
                        <i class="bi bi-arrow-left-right stat-card-icon"></i>
                    </div>
                    <div class="stat-card-value"><?= count($exchanges) ?></div>
                    <div class="stat-card-diff">All time exchanges</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-title">Pending Exchanges</div>
                        <i class="bi bi-clock-history stat-card-icon"></i>
                    </div>
                    <div class="stat-card-value">
                        <?php 
                        $pending = array_filter($exchanges, fn($e) => $e['status'] === 'pending');
                        echo count($pending);
                        ?>
                    </div>
                    <div class="stat-card-diff">Awaiting approval</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-title">Accepted Exchanges</div>
                        <i class="bi bi-check-circle stat-card-icon"></i>
                    </div>
                    <div class="stat-card-value">
                        <?php 
                        $accepted = array_filter($exchanges, fn($e) => $e['status'] === 'accepted');
                        echo count($accepted);
                        ?>
                    </div>
                    <div class="stat-card-diff">Successfully completed</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-title">Total Value</div>
                        <i class="bi bi-currency-dollar stat-card-icon"></i>
                    </div>
                    <div class="stat-card-value">
                        $<?php 
                        $totalValue = array_sum(array_map(fn($e) => $e['object1_price'] + $e['object2_price'], $exchanges));
                        echo number_format($totalValue, 0);
                        ?>
                    </div>
                    <div class="stat-card-diff">Combined object values</div>
                </div>
            </div>
        </div>

        <!-- Exchanges Table -->
        <div class="content-card">
            <h2 class="content-card-title">All Exchanges</h2>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>User 1</th>
                            <th>Object 1</th>
                            <th>Price 1</th>
                            <th>User 2</th>
                            <th>Object 2</th>
                            <th>Price 2</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($exchanges)) : ?>
                            <?php foreach ($exchanges as $exchange) : ?>
                                <tr>
                                    <td><strong>#<?= $exchange['exchange_id'] ?></strong></td>
                                    <td>
                                        <span class="badge-modern badge-<?= $exchange['status'] ?>">
                                            <?= ucfirst($exchange['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <strong><?= htmlspecialchars($exchange['user1_username']) ?></strong>
                                            <small><?= htmlspecialchars($exchange['user1_email']) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="object-info">
                                            <strong><?= htmlspecialchars($exchange['object1_name']) ?></strong>
                                            <small title="<?= htmlspecialchars($exchange['object1_description']) ?>">
                                                <?= htmlspecialchars($exchange['object1_description']) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td><strong>$<?= number_format($exchange['object1_price'], 2) ?></strong></td>
                                    <td>
                                        <div class="user-info">
                                            <strong><?= htmlspecialchars($exchange['user2_username']) ?></strong>
                                            <small><?= htmlspecialchars($exchange['user2_email']) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="object-info">
                                            <strong><?= htmlspecialchars($exchange['object2_name']) ?></strong>
                                            <small title="<?= htmlspecialchars($exchange['object2_description']) ?>">
                                                <?= htmlspecialchars($exchange['object2_description']) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td><strong>$<?= number_format($exchange['object2_price'], 2) ?></strong></td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('M d, Y', strtotime($exchange['exchange_created_at'])) ?><br>
                                            <?= date('H:i', strtotime($exchange['exchange_created_at'])) ?>
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0">No exchanges found</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../footer.php'; ?>