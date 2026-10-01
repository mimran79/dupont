<?php
$title = "Dashboard";

include "header.php";
?>
<h1 class="text-center my-5 mx-auto">Welcome <?php echo $_SESSION['name']; ?></h1>
<div class="w-75 mx-auto mb-3">
    <a href="book" class="btn btn-sm btn-success">Book New Appointment</a>
</div>
<?php if (isset($_SESSION['success'])) { ?>
    <p class="bg-success-subtle text-success w-75 mx-auto p-3"><?php echo $_SESSION['success']; ?></p>
<?php }
unset($_SESSION['success']); ?>
<div class="card shadow-lg w-75 mx-auto">
    <div class="card-body m-2">
        <table class="table table-responsive table-hover">
            <thead>
                <th>Date & Hour</th>
                <th>Service</th>
                <th>Duration</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment) { ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($appointment['appointmentDate'])) . ' | ' . date('h:i A', strtotime($appointment['appointmentHour'])); ?></td>
                        <td><?php echo $appointment['service_name']; ?></td>
                        <td><?php echo $appointment['service_duration'] . ' minutes'; ?></td>
                        <td><?php echo $appointment['status']; ?></td>
                        <td class="text-center"><a href="modify-appointment-form?id=<?php echo $appointment['id'] ?>" class="btn btn-secondary btn-sm">Modify</a>
                            |
                            <a href="cancel-appointment?id=<?php echo $appointment['id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include "footer.php";
?>