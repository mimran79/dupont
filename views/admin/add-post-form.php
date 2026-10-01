<?php

$title = "Create New Post";
include 'adminHeader.php';

?>
<div class="container">
    <h1 class="text-center my-5">Create New Post</h1>
    <?php if (isset($_SESSION['error'])) { ?>
        <p class="bg-danger-subtle text-danger p-3 mx-auto"><?php echo $_SESSION['error'];
                                                            unset($_SESSION['error']); ?></p>
    <?php } ?>
    <div class="card shadow-lg mx-auto">
        <div class="card-body">
            <form action="process-post" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Select Feature Image</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Excerpt</label>
                    <input type="text" name="excerpt" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Content</label>
                    <!-- Quill container -->
                    <div id="editor" style="height: 200px;"></div>
                    <!-- Hidden input to pass HTML content to PHP -->
                    <input type="hidden" name="content" id="content">
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-outline-dark">Save Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Sync Quill content to hidden input on form submit
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    });
</script>