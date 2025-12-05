<?php
require_once('config.php');
?>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Montant</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($result_incomes as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['montant'] ?></td>
                <td><?= $row['descreption'] ?></td>
                <td><?= $row['la_date'] ?></td>

                <td>
                    <!-- Edit Button -->
                    <a href="edit_form_ind.php?id=<?php echo $row['id']?>">
                        <button style="background:blue;color:white;padding:4px 8px;border:none;border-radius:4px;">
                            Edit
                        </button>
                    </a>

                    <!-- Delete Button -->
                    <a href="delete_inc.php?id=<?php echo $row['id']?>" onclick="return confirm('Delete this record?');">
                        <button style="background:red;color:white;padding:4px 8px;border:none;border-radius:4px;">
                            Delete
                        </button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>