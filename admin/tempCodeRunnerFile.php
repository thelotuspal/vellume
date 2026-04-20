<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require '../config/db.php';
?>

<?php include '../includes/header.php'; ?>

<style>
/* ---------------- BODY & CONTAINER ---------------- */
body {
    background: linear-gradient(135deg, #e0eafc, #cfdef3);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
}

/* Fix Navbar/Header size */
header, .navbar {
    min-height: 56px !important;
    padding: 6px 0 !important;
}

/* Main Container */
.container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px 15px;
}

/* ---------------- PAGE HEADER ---------------- */
.enquiries-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    padding: 30px 20px; /* slightly smaller to match project style */
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    margin-bottom: 30px;
}

.enquiries-header h2 {
    font-size: 2rem; /* smaller font for consistency with navbar */
    font-weight: 700;
    margin: 0;
}

.enquiries-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin-top: 8px;
}

/* ---------------- ENQUIRY CARD ---------------- */
.enquiry-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    padding: 20px 25px;
    transition: all 0.3s ease;
}

.enquiry-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

/* Card Header */
.enquiry-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.enquiry-card-header .badge {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: #fff;
    padding: 5px 10px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.8rem;
}

/* Card Body Table */
.enquiry-card-body {
    display: grid;
    grid-template-columns: 1fr 1fr;
    row-gap: 8px;
}

.enquiry-card-body span {
    font-weight: 500;
    color: #333;
}

.enquiry-card-body a {
    color: #4a4a4a;
    text-decoration: none;
}

.enquiry-card-body a:hover {
    text-decoration: underline;
}

/* Responsive for Mobile */
@media(max-width: 768px){
    .enquiry-card-body {
        grid-template-columns: 1fr;
        gap: 5px;
    }
    .enquiries-header h2 {
        font-size: 1.8rem;
    }
    .enquiries-header p {
        font-size: 0.95rem;
    }
}
</style>

<div class="container">
    <div class="enquiries-header">
        <h2>Contact Enquiries</h2>
        <p>View and manage all customer messages</p>
    </div>

    <?php
    $stmt = $conn->query("SELECT * FROM enquiries ORDER BY created_at DESC");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
    ?>
    <div class="enquiry-card">
        <div class="enquiry-card-header">
            <h5><?= htmlspecialchars($row['name']) ?></h5>
            <span class="badge">ID: <?= $row['id'] ?></span>
        </div>
        <div class="enquiry-card-body">
            <div><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></div>
            <div><strong>Phone:</strong> <a href="tel:<?= htmlspecialchars($row['phone']) ?>"><?= htmlspecialchars($row['phone']) ?></a></div>
            <div><strong>Message:</strong> <span><?= nl2br(htmlspecialchars($row['message'])) ?></span></div>
            <div><strong>Received:</strong> <span><?= htmlspecialchars($row['created_at']) ?></span></div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php include '../includes/footer.php'; ?>