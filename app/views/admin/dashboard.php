<h1>Admin Dashboard</h1>

<!-- list of users -->
<!-- list of exchanges -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Exchange ID</th>
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
        <?php foreach ($exchanges as $exchange) : ?>
            <tr>
                <td><?= $exchange['exchange_id'] ?></td>
                <td><span class="badge bg-<?= $exchange['status'] === 'pending' ? 'warning' : ($exchange['status'] === 'accepted' ? 'success' : 'danger') ?>"><?= ucfirst($exchange['status']) ?></span></td>
                <td>
                    <strong><?= htmlspecialchars($exchange['user1_username']) ?></strong><br>
                    <small><?= htmlspecialchars($exchange['user1_email']) ?></small>
                </td>
                <td>
                    <strong><?= htmlspecialchars($exchange['object1_name']) ?></strong><br>
                    <small><?= htmlspecialchars($exchange['object1_description']) ?></small>
                </td>
                <td><?= number_format($exchange['object1_price'], 2) ?></td>
                <td>
                    <strong><?= htmlspecialchars($exchange['user2_username']) ?></strong><br>
                    <small><?= htmlspecialchars($exchange['user2_email']) ?></small>
                </td>
                <td>
                    <strong><?= htmlspecialchars($exchange['object2_name']) ?></strong><br>
                    <small><?= htmlspecialchars($exchange['object2_description']) ?></small>
                </td>
                <td><?= number_format($exchange['object2_price'], 2) ?></td>
                <td><?= date('Y-m-d H:i', strtotime($exchange['exchange_created_at'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- total exchanges -->
<p class="mt-3"><strong>Total Exchanges:</strong> <?= count($exchanges) ?></p>