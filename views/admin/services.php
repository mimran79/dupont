<?php

$title = "Services";

include 'adminHeader.php';
?>
<h1 class="my-5 text-center">Manage Services</h1>
<?php if (isset($_SESSION['success'])) { ?>
    <p class="bg-success-subtle text-success text-center p-3 w-50 mx-auto"><?php echo $_SESSION['success'];
                                                                            unset($_SESSION['success']); ?></p>
<?php } ?>
<?php if (isset($_SESSION['error'])) { ?>
    <p class="bg-danger-subtle text-danger text-center p-3 w-50 mx-auto"><?php echo $_SESSION['error'];
                                                                            unset($_SESSION['error']); ?></p>
<?php } ?>
<div class="mb-3 w-75 mx-auto">
    <a href="add-service-form" class="btn btn-success btn-sm">Add Service</a>
</div>
<div class="card w-75 mx-auto shadow-lg">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Service rows will be populated here -->
                <?php foreach ($services as $service) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['name']); ?></td>
                        <td><?php echo htmlspecialchars($service['description']); ?></td>
                        <td><?php echo htmlspecialchars($service['price']); ?></td>
                        <td>
                            <a href="update-service?id=<?php echo $service['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete-service?id=<?php echo $service['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'adminFooter.php'; ?>