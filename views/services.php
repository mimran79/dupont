<?php
$title = "Services";
include "header.php";
?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h2>Dr. DuPont's Dental Services</h2>
        <p class="text-muted">Choose the procedure that fits your oral health needs</p>
    </div>

    <div class="row g-4">
        <?php foreach ($services as $service): ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0 service-card">
                    <div class="card-header bg-light text-center py-3">
                        <span class="text-uppercase small text-muted fw-bold"><?= htmlspecialchars($service['type']) ?></span>
                        <h4 class="my-1"><?= htmlspecialchars($service['name']) ?></h4>
                        <h3 class="text-success fw-bold">$<?= htmlspecialchars($service['price']) ?></h3>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="text-muted small text-center"><?= htmlspecialchars($service['description']) ?></p>
                        <ul class="list-unstyled mb-4">
                            <?php
                            $detailsArray = json_decode($service['details'], true);
                            $rawDetails = is_array($detailsArray) ? ($detailsArray[0] ?? '') : $service['details'];
                            foreach (explode(',', $rawDetails) as $detail):
                            ?>
                                <li class="mb-2">✓ <?= htmlspecialchars(trim($detail)) ?></li>
                            <?php endforeach; ?>
                            <li class="mb-2">✓ <?= htmlspecialchars($service['duration']) ?>minutes Session Duration</li>
                            <li class="mb-2">✓ <?= htmlspecialchars($service['timeBuffer']) ?>minutes to clean & sanitize</li>
                        </ul>
                        <a href="#" class="btn btn-outline-success mt-auto w-100">Book <?= htmlspecialchars($service['name']) ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .service-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }
</style>

<?php
include "footer.php";
?>