<?php include 'includes/header.php'; ?>
<?php require 'config/db.php'; ?>

<!-- AOS + Lightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">

<!-- ===== HEADER ===== -->
<section class="py-5 text-center text-white"
style="background: linear-gradient(120deg,#0f172a,#1e293b);">
    <div class="container">
        <h1 class="fw-bold display-6" data-aos="zoom-in">Our Projects</h1>
        <p data-aos="fade-up">Premium Interior Portfolio</p>
    </div>
</section>

<!-- ===== FILTER BUTTONS ===== -->
<div class="container text-center my-4">
    
</div>

<!-- ===== PROJECT GRID ===== -->
<section class="pb-5">
<div class="container">
<div class="row g-4" id="projectContainer">

<?php
$stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC LIMIT 24");

while($p = $stmt->fetch(PDO::FETCH_ASSOC)){
$category = strtolower($p['category'] ?? 'living'); // fallback
?>

<div class="col-lg-4 col-md-6 project-item"
     data-category="<?= $category ?>"
     data-aos="fade-up">

<div class="portfolio-card">

    <!-- IMAGE -->
    <div class="portfolio-img">
        <img src="assets/images/<?= htmlspecialchars($p['image']); ?>">

        <!-- OVERLAY -->
        <div class="overlay">
            <a href="assets/images/<?= htmlspecialchars($p['image']); ?>"
               class="glightbox btn btn-light btn-sm">
               🔍 View
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="p-3">
        <h5><?= htmlspecialchars($p['title']); ?></h5>
        <p class="text-muted small">
            <?= substr(strip_tags($p['description']),0,80); ?>...
        </p>
    </div>

</div>
</div>

<?php } ?>

</div>
</div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- ===== STYLE ===== -->
<style>

/* CARD */
.portfolio-card{
    border-radius:15px;
    overflow:hidden;
    background:rgba(255,255,255,0.7);
    backdrop-filter:blur(10px);
    transition:0.4s;
}

.portfolio-card:hover{
    transform:translateY(-10px);
    box-shadow:0 25px 50px rgba(0,0,0,0.2);
}

/* IMAGE */
.portfolio-img{
    position:relative;
    height:250px;
    overflow:hidden;
}

.portfolio-img img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.5s;
}

.portfolio-card:hover img{
    transform:scale(1.1);
}

/* OVERLAY */
.overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
    display:flex;
    justify-content:center;
    align-items:center;
    opacity:0;
    transition:0.4s;
}

.portfolio-card:hover .overlay{
    opacity:1;
}

/* FILTER BUTTON */
.filter-btn.active{
    background:#111;
    color:#fff;
}

</style>

<!-- ===== JS ===== -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
AOS.init({duration:1000, once:true});

// LIGHTBOX
const lightbox = GLightbox();

// FILTER
const buttons = document.querySelectorAll(".filter-btn");
const items = document.querySelectorAll(".project-item");

buttons.forEach(btn=>{
    btn.addEventListener("click", ()=>{

        buttons.forEach(b=>b.classList.remove("active"));
        btn.classList.add("active");

        let filter = btn.getAttribute("data-filter");

        items.forEach(item=>{
            if(filter === "all" || item.dataset.category === filter){
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
});
</script>