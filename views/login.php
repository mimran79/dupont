<?php
$title = "Login";
include "header.php";
?>

<h1 class="text-center mx-auto my-5">Login</h1>
<?php if (isset($_SESSION['error'])) {
    echo "<p class='bg-danger-subtle text-danger w-50 mx-auto p-2 text-center'>" . $_SESSION['error'] . "</p>";
}
if (isset($_SESSION['success'])) {
    echo "<p class='bg-success-subtle text-success w-50 mx-auto p-2 text-center'>" . $_SESSION['success'] . "</p>";
} ?>
<div class="card w-50 mx-auto shadow-lg mb-5">
    <div class="card-body m-5">
        <form action="login-verify" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <p class="form-text" id="showPassword">&#x1F441;</p>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Login</button>
            <p class="fs-6 mt-3 text-secondary">Do not have an account? <a href="register">Click here to register</a></p>
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