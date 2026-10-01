<?php
$title = "Modify Appointment";
include "header.php";
?>
<div class="container">
    <h1 class="my-5 text-center">Modify Appointment</h1>
    <div class="card w-50 mx-auto shadow-lg p-3">
        <div class="card-body">
            <form action="process-modify-appointment" method="POST">
                <input type="hidden" name="id" value="<?php echo $appointmentDetails['id']; ?>">
                <div class="form-group mb-3">
                    <label for="service_id">Service:</label>
                    <select class="form-select" name="service_id" aria-label="Default select example">
                        <?php foreach ($services as $service) { ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo ($service['id'] == $appointmentDetails['service_id']) ? 'selected' : ''; ?>>
                                <?php echo $service['name']; ?> | <?php echo $service['duration']; ?> minutes
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $appointmentDetails['appointmentDate']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="time">Time:</label>
                    <input type="time" class="form-control" id="time" name="time" value="<?php echo $appointmentDetails['appointmentHour']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Modify Appointment</button>
            </form>
        </div>
    </div>
</div>