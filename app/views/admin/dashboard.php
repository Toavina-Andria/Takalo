<h1>Admin dashbord</h1>

<!-- list of users -->
<!-- list of echange -->
<table>
    <th>id</th>
    <th>obj-1-id</th>
    <th>obj-1-id</th>
    <th>user-1-id</th>
    <th>user-2-id</th>
    <th>status</th>
    <?php foreach ($exchanges as $exchange) : ?>
        <tr>
            <td><?= $exchange['id'] ?></td>
            <td><?= $exchange['object1_id'] ?></td>
            <td><?= $exchange['object2_id'] ?></td>
            <td><?= $exchange['user1_id'] ?></td>
            <td><?= $exchange['user2_id'] ?></td>
            <td><?= $exchange['status'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>
<!-- total echange -->