<?php
$title = "Manage Schedule";

include "adminHeader.php";
?>
<h1 class="text-center my-5">Manage Schedule</h1>
<div class="w-75 mx-auto mb-3">
    <a href="manage-schedule" class="btn btn-sm btn-success">Change Schedule</a>
</div>
<?php if (isset($_SESSION['error'])) {
    echo "<p class='bg-danger-subtle text-danger w-50 mx-auto p-2 text-center'>" . $_SESSION['error'] . "</p>";
} ?>
<?php if (isset($_SESSION['success'])) {
    echo "<p class='bg-success-subtle text-success w-50 mx-auto p-2 text-center'>" . $_SESSION['success'] . "</p>";
} ?>
<div class="card w-75 mx-auto">
    <div class="card-body">
        <table class="table table-responsive table-hover">
            <thead>
                <th>Days</th>
                <th>Opening</th>
                <th>Closing</th>
                <th class='text-center'>Lunch Break Starts</th>
                <th class='text-center'>Lunch Break Ends</th>
            </thead>
            <tbody>
                <tr>
                    <td>Monday-Friday</td>
                    <td><?php echo date('H:s', strtotime($data['weekOpening'])) ?? 'Not Assigned'; ?></td>
                    <td><?php echo date('H:s', strtotime($data['weekClosing'])) ?? 'Not Assigned'; ?></td>
                    <td class='text-center'><?php echo date('H:s', strtotime($data['lunchStart'])) ?? 'Not Assigned'; ?></td>
                    <td class='text-center'><?php echo date('H:s', strtotime($data['lunchEnd'])) ?? 'Not Assigned'; ?></td>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <td><?php echo date('H:s', strtotime($data['saturdayOpening'])) ?? 'Not Assigned'; ?></td>
                    <td><?php echo date('H:s', strtotime($data['saturdayClosing'])) ?? 'Not Assigned'; ?></td>
                    <td class='text-center'><?php echo date('H:s', strtotime($data['lunchStart'])) ?? 'Not Assigned'; ?></td>
                    <td class='text-center'><?php echo date('H:s', strtotime($data['lunchEnd'])) ?? 'Not Assigned'; ?></td>

                </tr>
                <tr>
                    <td>Sunday</td>
                    <td colspan="3">Closed</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);
include "adminFooter.php"; ?>