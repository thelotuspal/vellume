<?php 
require 'includes/header.php'; 
require 'config/db.php'; 
?>

<!-- AOS Animation CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
/* ================= GLOBAL ANIMATION ================= */
.card {
    transition: all 0.4s ease;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.card img {
    transition: transform 0.4s ease;
}

.card:hover img {
    transform: scale(1.1);
}

/* HERO ANIMATION */
.hero-text {
    animation: fadeInDown 1s ease-in-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* BUTTON STYLE */
.btn-primary {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* SECTION TITLE */
h2 {
    letter-spacing: 1px;
}
</style>

<!-- ======= HERO SECTION ======= -->
<section class="py-5 text-center hero-text" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
    <div class="container">
        <h1 class="display-5 fw-bold" data-aos="zoom-in">Our Services</h1>
        <p class="lead mb-0" data-aos="fade-up" data-aos-delay="200">
            Premium interior design and furniture solutions tailored for your dream space.
        </p>
    </div>
</section>

<?php
$interiorServices = [
    ['title' => 'Living Room Interior','desc' => 'Modern and elegant living room designs that balance comfort, lighting, and aesthetics.'],
    ['title' => 'Bedroom Interior','desc' => 'Peaceful bedroom interiors with smart storage, lighting, and premium finishes.'],
    ['title' => 'Office Interior','desc' => 'Professional office interiors designed to improve productivity and brand image.'],
    ['title' => 'False Ceiling Design','desc' => 'Stylish false ceiling designs with LED lighting and premium material finishes.'],
    ['title' => 'Wall Panel & TV Unit','desc' => 'Custom TV units and decorative wall panels to enhance your living space.'],
    ['title' => 'Complete Home Interior','desc' => 'End-to-end home interior solutions from planning to final execution.']
];

$kitchenServices = [
    ['title' => 'L-Shaped Kitchen','desc' => 'Efficient L-shaped kitchen designs with maximum storage and easy movement.'],
    ['title' => 'U-Shaped Kitchen','desc' => 'Spacious U-shaped kitchens designed for heavy usage and organized cooking.'],
    ['title' => 'Parallel Kitchen','desc' => 'Smart parallel kitchen layouts ideal for compact and medium-sized homes.'],
    ['title' => 'Island Kitchen','desc' => 'Luxury island kitchens offering style, workspace, and modern appeal.'],
    ['title' => 'Modular Kitchen Renovation','desc' => 'Upgrade your old kitchen with modern modular fittings and accessories.'],
    ['title' => 'Custom Modular Kitchen','desc' => 'Tailor-made modular kitchens designed as per your space and lifestyle.']
];

$furnitureServices = [
    ['title' => 'Sofa Sets','desc' => 'Comfortable and stylish sofa sets designed to match modern interiors.'],
    ['title' => 'Beds & Wardrobes','desc' => 'Premium beds and wardrobes with smart storage and durable materials.'],
    ['title' => 'Dining Furniture','desc' => 'Elegant dining tables and chairs designed for family comfort.'],
    ['title' => 'Office Furniture','desc' => 'Ergonomic office furniture for workspaces and corporate interiors.'],
    ['title' => 'TV Units & Cabinets','desc' => 'Custom-designed TV units and cabinets for organized living spaces.'],
    ['title' => 'Custom Furniture','desc' => 'Made-to-order furniture crafted to suit your design and space needs.']
];
?>

<!-- ======= INTERIOR DESIGN ======= -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold" data-aos="fade-down">Interior Design</h2>
        <div class="row g-4">

            <?php foreach ($interiorServices as $index => $item): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="assets/images/interior_design<?= $index + 1 ?>.jpg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $item['title']; ?></h5>
                            <p class="card-text"><?= $item['desc']; ?></p>

                            <a href="contact.php?service=<?= urlencode($item['title']); ?>" 
                               class="btn btn-primary mt-2 w-100">
                                Enquiry Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- ======= MODULAR KITCHENS ======= -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold" data-aos="fade-down">Modular Kitchens</h2>
        <div class="row g-4">

            <?php foreach ($kitchenServices as $index => $item): ?>
                <div class="col-md-4" data-aos="fade-right" data-aos-delay="<?= $index * 100 ?>">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="assets/images/modular_kitchen<?= $index + 1 ?>.jpg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $item['title']; ?></h5>
                            <p class="card-text"><?= $item['desc']; ?></p>

                            <a href="contact.php?service=<?= urlencode($item['title']); ?>" 
                               class="btn btn-primary mt-2 w-100">
                                Enquiry Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- ======= FURNITURE ======= -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold" data-aos="fade-down">Furniture Solutions</h2>
        <div class="row g-4">

            <?php foreach ($furnitureServices as $index => $item): ?>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="assets/images/furniture<?= $index + 1 ?>.jpg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $item['title']; ?></h5>
                            <p class="card-text"><?= $item['desc']; ?></p>

                            <a href="contact.php?service=<?= urlencode($item['title']); ?>" 
                               class="btn btn-primary mt-2 w-100">
                                Enquiry Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({
    duration: 1000,
    once: true
});
</script>

<?php include 'includes/footer.php'; ?>