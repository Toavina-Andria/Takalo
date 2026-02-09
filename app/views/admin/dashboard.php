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
            <td><?= $exchange['object1'] ?></td>
            <td><?= $exchange['object2'] ?></td>
            <td><?= $exchange['user1'] ?></td>
            <td><?= $exchange['user2'] ?></td>
            <td><?= $exchange['status'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>
<!-- total echange -->