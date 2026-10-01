<?php
$title = "Admin Dashboard";

include "adminHeader.php";
?>
<h1 class="text-center my-5">Welcome <?php echo $_SESSION['name']; ?></h1>
<div class="container">
    <div class="row g-4 justify-content-center">
        <!-- Patients Card -->
        <div class="col-md-5">
            <div class="card shadow border-0 bg-success-subtle h-100">
                <div class="card-body text-center p-4">
                    <h5 class="text-secondary mb-2">Registered Patients</h5>
                    <h2 class="display-5 fw-bold text-dark"><?php echo $totalPatients; ?></h2>
                </div>
            </div>
        </div>

        <!-- Appointments Card -->
        <div class="col-md-5">
            <div class="card shadow border-0 bg-primary-subtle h-100">
                <div class="card-body text-center p-4">
                    <h5 class="text-secondary mb-2">Appointments Today</h5>
                    <h2 class="display-5 fw-bold text-dark"><?php echo $totalAppointments; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "adminFooter.php"; ?>