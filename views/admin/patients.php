<?php

$title = "Patients Management";
include "adminHeader.php";
?>
<div class="container">
    <h1 class="text-center my-5">Patients Management</h1>
    <?php if (isset($_SESSION['success'])) { ?>
        <p class="bg-success-subtle text-success p-3"><?php echo $_SESSION['success']; ?></p>
    <?php }
    unset($_SESSION['success']); ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <p class="bg-danger-subtle text-danger p-3"><?php echo $_SESSION['error']; ?></p>
    <?php }
    unset($_SESSION['error']); ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($patients as $patient) : ?>
                        <tr>
                            <td><?php echo $patient['id']; ?></td>
                            <td><?php echo $patient['name']; ?></td>
                            <td><?php echo $patient['email']; ?></td>
                            <td><?php echo $patient['phone']; ?></td>
                            <td>
                                <a href="edit-patient-form?id=<?php echo $patient['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete-patient?id=<?php echo $patient['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>