
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require '../config/db.php';


/* DELETE ENQUIRY */

if(isset($_GET['delete'])){
$id = intval($_GET['delete']);

$conn->prepare("DELETE FROM enquiries WHERE id=?")->execute([$id]);

header("Location: manage_enquiries.php");
exit;
}

?>

<?php include '../includes/header.php'; ?>


<style>

body{
background:#f4f6f9;
font-family:Arial;
}

.enquiry-card{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

</style>


<div class="container mt-4">

<h3 class="mb-4">Customer Enquiries</h3>

<?php

$stmt = $conn->query("SELECT * FROM enquiries ORDER BY id DESC");

while($row = $stmt->fetch(PDO::FETCH_ASSOC)):

?>

<div class="enquiry-card">

<h5><?= htmlspecialchars($row['name']) ?></h5>

<p><strong>Email:</strong>
<a href="mailto:<?= htmlspecialchars($row['email']) ?>">
<?= htmlspecialchars($row['email']) ?>
</a>
</p>

<p><strong>Phone:</strong>
<a href="tel:<?= htmlspecialchars($row['phone']) ?>">
<?= htmlspecialchars($row['phone']) ?>
</a>
</p>

<p><strong>Message:</strong><br>
<?= nl2br(htmlspecialchars($row['message'])) ?>
</p>

<p><strong>Date:</strong>
<?= htmlspecialchars($row['created_at']) ?>
</p>

<a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="btn btn-primary btn-sm">
Reply
</a>

<a href="?delete=<?= $row['id'] ?>"
onclick="return confirm('Delete enquiry?')"
class="btn btn-danger btn-sm">
Delete
</a>

</div>

<?php endwhile; ?>

</div>

<?php include '../includes/footer.php'; ?>

