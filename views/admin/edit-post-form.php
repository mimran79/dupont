<?php

$title = "Edit Post";
include 'adminHeader.php';

?>
<div class="container">
    <h1 class="text-center my-5">Edit Post</h1>

    <div class="card shadow-lg mx-auto">
        <div class="card-body">
            <form action="update-post" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" id="" class="form-control" value="<?php echo $post['title'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Select Feature Image</label>
                    <?php if (!empty($post['image'])): ?>
                        <div class="mb-2">
                            <img src="/dupont/views/uploads/<?php echo $post['image']; ?>" alt="Current Image" style="max-width: 150px; height: auto; display: block; margin-bottom: 5px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Excerpt</label>
                    <input type="text" name="excerpt" id="" class="form-control" value="<?php echo $post['excerpt'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Content</label>
                    <!-- Quill container -->
                    <div id="editor" style="height: 200px;"></div>
                    <!-- Hidden input to pass HTML content to PHP -->
                    <input type="hidden" name="content" id="content">
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-outline-dark">Update Post</button>
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

    // Set the initial content from PHP into the Quill editor
    quill.root.innerHTML = `<?php echo $post['content']; ?>`;

    // Sync Quill content to hidden input on form submit
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    });
</script>