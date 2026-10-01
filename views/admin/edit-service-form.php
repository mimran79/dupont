<?php
$title = "Edit Service";
include 'adminHeader.php';
?>
<h1 class="text-center my-5">Edit Service</h1>

<?php if (isset($_SESSION['error'])) { ?>
    <p class="bg-danger-subtle text-danger text-center p-3 w-50 mx-auto"><?php echo $_SESSION['error'];
                                                                            unset($_SESSION['error']); ?></p>
<?php } ?>
<div class="card shadow-lg w-50 mx-auto mb-5">

    <div class="card-body p-5">
        <form action="process-update-service" method="POST">
            <input type="hidden" name="serviceId" value="<?php echo $service['id']; ?>">
            <div class="mb-3">
                <label for="" class="form-label">Type</label>
                <input type="text" class="form-control" name="serviceType" id="" value="<?php echo htmlspecialchars($service['type']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Name</label>
                <input type="text" class="form-control" name="serviceName" id="" value="<?php echo htmlspecialchars($service['name']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Short Description</label>
                <textarea class="form-control" name="serviceDescription" id="" cols="30" rows="2"><?php echo htmlspecialchars($service['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Details</label>
                <textarea class="form-control" name="details[]" id="" cols="30" rows="3"><?php echo htmlspecialchars($service['details']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Price</label>
                <input type="number" class="form-control" name="servicePrice" id="" value="<?php echo htmlspecialchars($service['price']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Duration</label>
                <input type="number" class="form-control" name="duration" id="" value="<?php echo htmlspecialchars($service['duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Time Buffer</label>
                <input type="number" class="form-control" name="timeBuffer" id="" value="<?php echo htmlspecialchars($service['timeBuffer']); ?>">
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-dark">Edit Service</button>
            </div>
        </form>
    </div>
</div>
<?php

include 'adminFooter.php';
