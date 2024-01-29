<?php
    $results
?>
<main>

    <section>
        <a href="register.php">
            <button class="btn btn-success">New listing</button>
        </a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listings as $listing): ?>
                    <tr>
                        <td><?php echo $listing->id; ?></td>
                        <td><?php echo $listing->title; ?></td>
                        <td><?php echo $listing->description; ?></td>
                        <td><?php echo ($listing->active == 'y' ? 'Active' : 'Inactive')?></td>
                        <td><?php echo date('Y-m-d \a\t H:i:s', strtotime($listing->date)); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $listing->id; ?>" class="btn btn-primary">Edit</a>
                            <a href="remove.php?id=<?php echo $listing->id; ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</main>