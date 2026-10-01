<?php

$title = "Edit Schedule";

include "adminHeader.php";
?>
<h1 class="text-center my-5">Modify Schedule</h1>
<?php if (isset($_SESSION['error'])) {
    echo "<p class='bg-danger-subtle text-danger w-50 mx-auto p-2 text-center'>" . $_SESSION['error'] . "</p>";
} ?>
<?php if (isset($_SESSION['success'])) {
    echo "<p class='bg-success-subtle text-success w-50 mx-auto p-2 text-center'>" . $_SESSION['success'] . "</p>";
} ?>
<div class="card shadow-lg w-50 mx-auto mb-5">

    <div class="card-body p-5">
        <form action="update-schedule" method="POST">
            <input type="hidden" name="scheduleId" value="<?php echo $schedule['id']; ?>">
            <div class="mb-3">
                <label for="" class="form-label">Opening Hour - Monday to Friday</label>
                <input type="time" class="form-control" name="weekdayOpening" id="" min="09:00" value="<?php echo ($schedule['weekOpening']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Closing Hour - Monday to Friday</label>
                <input type="time" class="form-control" name="weekdayClosing" id="" value="<?php echo ($schedule['weekClosing']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Opening Hour - Saturday</label>
                <input type="time" class="form-control" name="saturdayOpening" id="" value="<?php echo ($schedule['saturdayOpening']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Closing Hour - Saturday</label>
                <input type="time" class="form-control" name="saturdayClosing" id="" value="<?php echo ($schedule['saturdayClosing']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Lunch Break Starts</label>
                <input type="time" class="form-control" name="lunchStart" id="" value="<?php echo ($schedule['lunchStart']); ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Lunch Break Ends</label>
                <input type="time" class="form-control" name="lunchEnd" id="" value="<?php echo ($schedule['lunchEnd']); ?>">
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-dark">Update Schedule</button>
            </div>
        </form>
    </div>
</div>
<?php

include 'adminFooter.php'; ?>