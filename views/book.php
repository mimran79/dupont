<?php
$title = "Book Appointment";
include "header.php";
?>
<div class="container-fluid">
    <h1 class="my-5 text-center">Book an Appointment</h1>
    <p class="text-center">Please fill the form belows. All fields are required.</p>
    <div class="card my-5 shadow-lg w-50 mx-auto">
        <div class="card-body m-5">
            <form action="process-appointment" method="post">
                <input type="hidden" name="user_id" value='<?php echo $_SESSION['user_id']; ?>'>
                <div class="mb-3">
                    <label for="" class="form-label">Select Service</label>
                    <select class="form-select" name="service_id" aria-label="Default select example">
                        <option selected>Chose one</option>
                        <?php foreach ($services as $service) { ?>
                            <option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?> | <?php echo $service['duration']; ?> minutes</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Choose Appointment Date</label>
                    <input type="date" name="date" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Preferable Time</label>
                    <input type="time" class="form-control" name="appointment-time">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Request Appointment</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>