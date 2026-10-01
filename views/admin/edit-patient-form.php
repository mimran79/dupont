<?php
$title = "Edit Patient";
require 'adminHeader.php';
?>
<div class="container">
    <h1 class="text-center my-5">Edit Patient</h1>
    <div class="card w-50 mx-auto shadow-lg p-5">
        <div class="card-body">
            <form action="process-update-patient" method="POST">
                <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
                <div class="form-group mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $patient['name']; ?>" required>
                </div>
                <div class="form-group  mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>" required>
                </div>
                <div class="form-group  mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $patient['phone']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Patient</button>
            </form>
        </div>
    </div>
</div>