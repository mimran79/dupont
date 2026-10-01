<?php
$title = "Add Service";
include 'adminHeader.php';
?>
<h1 class="text-center my-5">Add Service</h1>

<?php if (isset($_SESSION['error'])) { ?>
    <p class="bg-danger-subtle text-danger text-center p-3 w-50 mx-auto"><?php echo $_SESSION['error'];
                                                                            unset($_SESSION['error']); ?></p>
<?php } ?>
<div class="card shadow-lg w-50 mx-auto mb-5">

    <div class="card-body p-5">
        <form action="process-service" method="POST">
            <div class="mb-3">
                <label for="" class="form-label">Type</label>
                <input type="text" class="form-control" name="serviceType" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Name</label>
                <input type="text" class="form-control" name="serviceName" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Short Description</label>
                <textarea class="form-control" name="serviceDescription" id="" cols="30" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Details</label>
                <textarea class="form-control" name="details" id="" cols="30" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Price</label>
                <input type="number" class="form-control" name="servicePrice" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Service Duration</label>
                <input type="number" class="form-control" name="duration" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Time Buffer</label>
                <input type="number" class="form-control" name="timeBuffer" id="">
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-dark">Add Service</button>
            </div>
        </form>
    </div>
</div>
<?php

include 'adminFooter.php';
