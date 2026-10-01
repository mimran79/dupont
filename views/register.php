<?php
$title = "Register";
include "header.php";
?>
<h1 class="text-center mx-auto my-5">Register as a Patient</h1>
<div class="card w-50 mx-auto shadow-lg mb-5">
    <div class="card-body m-5">
        <?php if (isset($_SESSION['error'])) {
            echo "<p class='bg-danger-subtle text-danger mx-auto p-2 text-center'>" . $_SESSION['error'] . "</p>";
        } ?>
        <form action="register-user" method="POST">
            <div class="mb-3">
                <label for="" class="form-label">Full Name</label>
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Mobile</label>
                <input type="phone" name="phone" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <p class="form-text" id="showPassword">&#x1F441;</p>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Register</button>
            <p class="fs-6 mt-3 text-secondary">Already registered. <a href="login">Click here to login</a></p>
    </div>

    </form>
</div>
</div>
<script>
    const eye = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');
    eye.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    })
</script>
<?php
unset($_SESSION['error']);
include "footer.php";
?>