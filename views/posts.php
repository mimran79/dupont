<?php
$title = "Latest News";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    include "admin/adminHeader.php";
} else {
    include "header.php";
}
?>
<div class="container my-5">
    <h2 class="text-center mb-5">AZ Latest News & Articles</h2>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
        <a href="add-post-form" class="btn btn-sm btn-outline-dark mb-4">Add new post</a>
    <?php }; ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <p class="bg-success-subtle text-success p-3"><?php echo $_SESSION['success']; ?></p>
    <?php }
    unset($_SESSION['success']); ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <p class="bg-danger-subtle text-danger p-3"><?php echo $_SESSION['error']; ?></p>
    <?php }
    unset($_SESSION['error']); ?>
    <div class="card shadow-lg mx-auto">
        <div class="card-body">
            <table class="table table-responsive">
                <thead class="table-success">
                    <th>Title</th>
                    <th>Published Date</th>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                        <th class="text-center">Action</th>
                    <?php } ?>

                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td><a href="post?id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a></td>
                            <td><?php echo date('d/m/Y', strtotime($post['date'])); ?></td>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                                <td class="text-center">
                                    <a href="edit-post?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    | <a href="delete-post?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    include "admin/adminFooter.php";
} else {
    include "footer.php";
}
?>