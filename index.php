<?php include 'includes/header.php'; ?>
<?php require 'config/db.php'; ?>


<!-- Hero Banner Slider -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        <?php
        // Add as many hero slides as you want
        $heroSlides = [
            ['image'=>'hero.png', 'title'=>'Transform Your Home with Style', 'subtitle'=>'Premium Interior Design & Furniture Solutions'],
            ['image'=>'hero2.png', 'title'=>'Modern Interiors', 'subtitle'=>'Stylish & Functional Designs'],
            ['image'=>'hero3.png', 'title'=>'Luxury Furniture', 'subtitle'=>'Comfort & Elegance Combined']
        ];

        $active = 'active';
        foreach($heroSlides as $slide){
            echo '
            <div class="carousel-item '.$active.'">
                <div class="hero-slide" style="height:80vh; background: url(\'assets/images/'.$slide['image'].'\') center/cover no-repeat; position:relative;">
                    <div style="background: rgba(0,0,0,0.5); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                        <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">'.$slide['title'].'</h1>
                        <p class="lead animate__animated animate__fadeInUp">'.$slide['subtitle'].'</p>
                        <div class="d-flex gap-3 mt-3">
                            <a href="projects.php" class="btn btn-primary btn-lg animate__animated animate__fadeInUp">View Projects</a>
                            <a href="admin/login.php" class="btn btn-outline-light btn-lg animate__animated animate__fadeInUp">Admin Login</a>
                        </div>
                    </div>
                </div>
            </div>';
            $active = '';
        }
        ?>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>

    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <?php
        for($i=0; $i<count($heroSlides); $i++){
            $act = ($i==0) ? 'active' : '';
            echo '<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="'.$i.'" class="'.$act.'" aria-current="true"></button>';
        }
        ?>
    </div>
</div>

<!-- Services Section -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="service-card p-4 shadow-sm border rounded hover-effect">
                <i class="bi bi-house-fill fs-1 mb-3 text-primary"></i>
                <h4>Interior Design</h4>
                <p>Modern & stylish designs for living, kitchen, and bedrooms.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card p-4 shadow-sm border rounded hover-effect">
                <i class="bi bi-table fs-1 mb-3 text-success"></i>
                <h4>Furniture</h4>
                <p>Premium furniture crafted for comfort and style.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card p-4 shadow-sm border rounded hover-effect">
                <i class="bi bi-card-checklist fs-1 mb-3 text-warning"></i>
                <h4>Project Management</h4>
                <p>We manage your interior projects from concept to completion.</p>
            </div>
        </div>
    </div>
</section>


<!-- Services Section -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Our Interior Design Services</h2>
    <div class="row text-center g-4">

        <?php
        // Add service cards here
        $services = [
            ['icon'=>'bi bi-house-fill', 'title'=>'Living Room Design', 'desc'=>'Stylish and modern living room solutions.'],
            ['icon'=>'bi bi-door-closed', 'title'=>'Bedroom Design', 'desc'=>'Comfortable and aesthetic bedrooms.'],
            ['icon'=>'bi bi-cup-straw', 'title'=>'Kitchen Design', 'desc'=>'Functional and luxurious kitchens.'],
            ['icon'=>'bi bi-bounding-box', 'title'=>'Bathroom Design', 'desc'=>'Elegant and modern bathroom interiors.'],
            ['icon'=>'bi bi-building', 'title'=>'Office Interior', 'desc'=>'Professional and efficient workspace designs.'],
            ['icon'=>'bi bi-lightning', 'title'=>'Lighting Design', 'desc'=>'Creative and ambient lighting solutions.']
        ];

        foreach($services as $s){
            echo '
            <div class="col-md-4">
                <div class="service-card p-4 shadow-sm border rounded hover-effect">
                    <i class="'.$s['icon'].' fs-1 mb-3 text-primary"></i>
                    <h4>'.$s['title'].'</h4>
                    <p>'.$s['desc'].'</p>
                    <a href="contact.php" class="btn btn-outline-primary btn-sm mt-2">Enquire Now</a>
                </div>
            </div>';
        }
        ?>
    </div>
</section>


<!-- Projects Carousel -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Our Featured Projects</h2>
    <div id="projectsCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 6");
            $active = 'active';
            while($p = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '
                <div class="carousel-item '.$active.'">
                    <img src="assets/images/'.$p['image'].'" class="d-block w-100" alt="'.$p['title'].'" style="height:500px; object-fit:cover;">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                        <h5>'.$p['title'].'</h5>
                        <p>'.substr($p['description'],0,100).'...</p>
                        <a href="projects.php" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>';
                $active = '';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#projectsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#projectsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>

<!-- Furniture Section -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Our Furniture</h2>
    <div class="row g-4">
        <?php
        $stmt = $conn->query("SELECT * FROM furniture ORDER BY id DESC LIMIT 6");
        while($f = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '
            <div class="col-md-4">
                <div class="card hover-card shadow-sm">
                    <img src="assets/images/'.$f['image'].'" class="card-img-top" alt="'.$f['name'].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$f['name'].'</h5>
                        <p class="card-text">Price: '.$f['price'].'</p>
                        <a href="furniture.php" class="btn btn-outline-success btn-sm">View Furniture</a>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</section>


<!-- Interior Portfolio Section -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Our Interior Portfolio</h2>
    <div class="row g-4">
        <?php
        // Add 6 portfolio cards
        $portfolio = [
            ['image'=>'living room.jpg','title'=>'Modern Living Room','desc'=>'A contemporary living room with minimalist design.'],
            ['image'=>'luxury bedroom.jpg','title'=>'Luxury Bedroom','desc'=>'Elegant bedroom with cozy and stylish interiors.'],
            ['image'=>'luxury kitchen.jpg','title'=>'Designer Kitchen','desc'=>'Functional and premium kitchen design.'],
            ['image'=>'office.jpg','title'=>'Office Interior','desc'=>'Professional and inspiring office space.'],
            ['image'=>'bathrooms.jpg','title'=>'Bathroom Makeover','desc'=>'Modern and luxurious bathroom redesign.'],
            ['image'=>'lounge.jpg','title'=>'Outdoor Lounge','desc'=>'Beautiful outdoor seating and decor.']
        ];

        foreach($portfolio as $p){
            echo '
            <div class="col-md-4">
                <div class="card hover-card shadow-sm">
                    <img src="assets/images/'.$p['image'].'" class="card-img-top" alt="'.$p['title'].'" style="height:250px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">'.$p['title'].'</h5>
                        <p class="card-text">'.substr($p['desc'],0,80).'</p>
                        <a href="projects.php" class="btn btn-outline-primary btn-sm">View Project</a>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</section>



<!-- Testimonials -->
<section class="bg-light py-5 mt-5">
    <div class="container">
        <h2 class="text-center mb-4">What Our Clients Say</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm hover-card">
                    <p>"The interior design team transformed my home beyond my expectations!"</p>
                    <h6 class="mt-2 fw-bold">– Vaibhav Kumar</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm hover-card">
                    <p>"Amazing furniture quality and the project was completed on time."</p>
                    <h6 class="mt-2 fw-bold">– Er. Akash Pal</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow-sm hover-card">
                    <p>"Professional service and beautiful designs. Highly recommended."</p>
                    <h6 class="mt-2 fw-bold">– Mr. Ramesh Chandra</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action -->
<section class="cta-banner text-white text-center py-5 position-relative overflow-hidden"
    style="background: url('assets/images/cta-bg.jpg') center/cover no-repeat;">

    <!-- Gradient Overlay -->
    <div class="cta-overlay"></div>

    <div class="container position-relative">
        <span class="badge bg-warning text-dark px-3 py-2 mb-3">
            Premium Interior Solutions
        </span>

        <h2 class="display-5 fw-bold mt-3">
            Ready to Transform Your Space?
        </h2>

        <p class="lead opacity-90 mt-3 mb-4">
            From concept to completion — we design spaces that inspire comfort, luxury, and style.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="contact.php" class="btn btn-lg btn-primary px-4 shadow">
                Get Free Consultation
            </a>
            <a href="tel:+917454820728" class="btn btn-lg btn-outline-light px-4">
                Call Now
            </a>
        </div>
    </div>
</section>

<!-- CTA STYLES -->
<style>
.cta-banner {
    min-height: 420px;
    display: flex;
    align-items: center;
}

.cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        120deg,
        rgba(17, 24, 39, 0.85),
        rgba(99, 102, 241, 0.75)
    );
    z-index: 1;
}

.cta-banner .container {
    z-index: 2;
}

.cta-banner h2 {
    letter-spacing: -0.5px;
}

.cta-banner .btn {
    border-radius: 50px;
    transition: all 0.3s ease;
}

.cta-banner .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.25);
}
</style>


<!-- Floating WhatsApp Button -->
<a href="https://wa.me/7454820728" target="_blank" class="whatsapp-float">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- Quick Support Panel -->
<div class="support-panel">
    <button class="support-btn"><i class="bi bi-headset"></i> Support</button>
    <div class="support-content">
        <h5>Need Help?</h5>
        <p>Chat with us on WhatsApp for instant support!</p>
        <a href="https://wa.me/9568301671" target="_blank" class="btn btn-success btn-sm">Chat Now</a>
    </div>
</div>

<!-- Floating Social Sidebar -->
<div class="social-sidebar">
    <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
    <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
    <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i></a>
    <a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i></a>
    <a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
</div>

<?php include 'includes/footer.php'; ?>

<style>
/* Floating WhatsApp */
.whatsapp-float {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #25D366;
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    z-index: 999;
}
.whatsapp-float:hover { background-color: #128C7E; }

/* Support Panel */
.support-panel { position: fixed; bottom: 20px; left: 20px; z-index: 999; }
.support-btn { background-color:#007bff;color:white;border:none;border-radius:50px;padding:12px 20px;font-size:16px;cursor:pointer;box-shadow:0 4px 10px rgba(0,0,0,0.3);}
.support-content { display:none;background:white;padding:15px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.3);margin-top:10px;width:220px; }
.support-panel:hover .support-content { display:block; transition:0.3s; }

/* Floating Social Sidebar */
.social-sidebar {
    position: fixed;
    top: 40%;
    left: 0;
    display: flex;
    flex-direction: column;
    z-index: 999;
}
.social-sidebar a {
    background: #333;
    color: white;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 5px 0;
    border-radius: 0 8px 8px 0;
    transition: all 0.3s;
    font-size: 20px;
}
.social-sidebar a:hover { background: #ff8c00; transform: scale(1.1); }

/* Card Hover */
.hover-card:hover { transform: scale(1.05); transition: all 0.3s ease-in-out; }
.service-card:hover { transform: translateY(-10px); transition: all 0.3s ease-in-out; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

/* Hero Slider */
.hero-slide .carousel-caption { top:0; bottom:0; text-align:center; }
.hero-slide h1, .hero-slide p, .hero-slide a { position: relative; z-index: 2; }

/* CTA Overlay */
.cta-banner h2, .cta-banner p, .cta-banner a { position: relative; z-index: 2; }

/* Mobile Adjustment: hide social sidebar */
@media (max-width:768px){ .social-sidebar{ display:none; } }
</style>