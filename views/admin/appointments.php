<?php
$title = "Appointments";
include "adminHeader.php";
?>
<div class="container">
    <h1 class="text-center my-5 mx-auto">Appointments</h1>
    <?php if (isset($_SESSION['success'])) { ?>
        <p class="bg-success-subtle text-success mx-auto p-3"><?php echo $_SESSION['success']; ?></p>
    <?php }
    unset($_SESSION['success']); ?>
    <div class="card mx-auto shadow-lg">
        <div class="card-body">
            <table class="table table-responsive table-hover">
                <thead>
                    <th>Date & Hour</th>
                    <th>Patient's Name</th>
                    <th>Patient's Email</th>
                    <th>Service</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    <?php if (!empty($appointments)) { ?>
                        <?php foreach ($appointments as $appointment) { ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($appointment['appointmentDate'])) . ' | ' . date('h:i A', strtotime($appointment['appointmentHour'])); ?></td>
                                <td><?php echo $appointment['patient_name']; ?></td>
                                <td><?php echo $appointment['patient_email']; ?></td>
                                <td><?php echo $appointment['service_name']; ?></td>
                                <td><?php echo $appointment['service_duration'] . ' minutes'; ?></td>
                                <td><?php echo $appointment['status']; ?></td>
                                <td class="text-center">
                                    <?php if ($appointment['status'] === 'Pending') { ?>
                                        <a href="confirm-appointment?id=<?php echo $appointment['id']; ?>" class="btn btn-success btn-sm">Confirm</a>
                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">No appointments found.</td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>