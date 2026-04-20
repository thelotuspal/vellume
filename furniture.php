<?php
require 'config/db.php';
?>

<?php include 'includes/header.php'; ?>

<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
/* ===== CARD ANIMATION ===== */
.card {
    transition: all 0.4s ease;
    overflow: hidden;
    border-radius: 12px;
}

.card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* IMAGE ZOOM */
.card img {
    transition: transform 0.4s ease;
}

.card:hover img {
    transform: scale(1.1);
}

/* TITLE ANIMATION */
.page-title {
    animation: fadeDown 1s ease-in-out;
}

@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* BUTTON HOVER */
.btn-success {
    transition: 0.3s;
}

.btn-success:hover {
    background-color: #198754;
    transform: scale(1.05);
}
</style>

<div class="container mt-5">

    <!-- TITLE -->
    <h2 class="text-center mb-4 fw-bold page-title" data-aos="zoom-in">
        Our Furniture Collection
    </h2>

    <div class="row">
        <?php
        $stmt = $conn->query("SELECT * FROM furniture ORDER BY id DESC");
        while ($f = $stmt->fetch(PDO::FETCH_ASSOC)):
            $msg = urlencode(
                "Hello, I am interested in this furniture:\n\n" .
                "Name: {$f['name']}\n" .
                "Price: ₹{$f['price']}\n\n" .
                "Please share more details."
            );
        ?>

            <!-- CARD -->
            <div class="col-md-4 mb-4"
                 data-aos="fade-up"
                 data-aos-delay="<?= $f['id'] * 50 ?>">

                <div class="card h-100 shadow-sm border-0">

                    <img src="assets/images/<?= htmlspecialchars($f['image']); ?>"
                         class="card-img-top"
                         height="220"
                         style="object-fit:cover;">

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($f['name']); ?>
                        </h5>

                        <p class="fw-bold text-success">
                            ₹ <?= htmlspecialchars($f['price']); ?>
                        </p>

                        <p class="text-muted">
                            <?= htmlspecialchars($f['description']); ?>
                        </p>
                    </div>

                    <!-- BUTTON -->
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="https://wa.me/919568301671?text=<?= $msg; ?>"
                           target="_blank"
                           class="btn btn-success w-100">
                            📩 Enquiry Now
                        </a>
                    </div>

                </div>
            </div>

        <?php endwhile; ?>
    </div>

</div>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({
    duration: 1000,
    once: true
});
</script>

<?php include 'includes/footer.php'; ?>