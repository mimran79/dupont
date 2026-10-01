<?php
$title = "Single Article";
include "header.php";
?>
<div class="container my-5" style="max-width: 800px;">
    <a href="news" class="btn btn-sm btn-outline-secondary mb-4">&larr; Back to News</a>

    <div class="p-5 shadow-sm border rounded bg-white">
        <h1 class="text-success mb-2"><?php echo $post['title'] ?? 'No Title available.'; ?></h1>
        <p class="text-muted small mb-4">Published on <?php echo date('F j, Y', strtotime($post['date'] ?? 'No date available.')); ?></p>
        <?php if (!empty($post['image'])): ?>
            <img src="/dupont/views/uploads/<?php echo $post['image']; ?>" alt="Post-feature-image" class="img-fluid mb-4">
        <?php endif; ?>
        <hr class="mb-4">
        <p class="lead"><?php echo $post['excerpt'] ?? 'No excerpt available.'; ?></p>
        <p><?php echo $post['content'] ?? 'No content available.'; ?></p>
    </div>
</div>
<?php include 'footer.php'; ?>