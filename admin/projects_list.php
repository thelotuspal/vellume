
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require '../config/db.php';

$totalProjects = $conn->query("SELECT COUNT(*) FROM projects")->fetchColumn();
?>

<?php include '../includes/header.php'; ?>

<style>
:root{
    --primary: linear-gradient(135deg, #667eea, #764ba2);
    --secondary: linear-gradient(135deg, #f093fb, #f5576c);
    --dark: #1a202c;
    --light: #f7fafc;
}

body{
    font-family:'Inter',sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
}

/* Container */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 40px 20px;
}

/* Header */
.header{
    background: var(--primary);
    color: white;
    padding: 40px;
    border-radius: 24px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Stats */
.stat-card{
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* Table Card */
.table-card{
    background: rgba(255,255,255,0.95);
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

/* Image */
.project-img{
    width: 100px;
    height: 70px;
    border-radius: 12px;
    object-fit: cover;
}

/* Buttons */
.btn-action{
    border-radius: 12px;
    padding: 8px 12px;
}

/* Badge */
.badge-soft{
    background: #e0e7ff;
    color: #3730a3;
    border-radius: 20px;
    padding: 6px 12px;
}
</style>


<div class="container py-5">

<!-- Header -->
<div class="header">
    <div>
        <h2>Projects Dashboard</h2>
        <p class="mb-0 opacity-75">Manage all interior & furniture projects</p>
    </div>

    <a href="add_project.php" class="btn btn-light fw-semibold">
        <i class="bi bi-plus-circle"></i> New Project
    </a>
</div>


<!-- Stats -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center gap-3">

            <div>
                <h6 class="mb-0 text-muted">Total Projects</h6>
                <h4 class="fw-bold"><?= $totalProjects ?></h4>
            </div>

        </div>
    </div>
</div>


<!-- Table -->
<div class="table-card">

<div class="table-responsive">

<table class="table align-middle mb-0">

<thead class="table-dark">
<tr>
<th>#</th>
<th>Preview</th>
<th>Title</th>
<th>Description</th>
<th>Status</th>
<th class="text-center">Actions</th>
</tr>
</thead>

<tbody>

<?php
$stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC");
$i=1;

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>

<tr>

<td><?= $i++ ?></td>

<td>
<img src="../assets/images/<?= $row['image'] ?>" class="project-img">
</td>

<td class="fw-semibold"><?= $row['title'] ?></td>

<td class="text-muted"><?= substr($row['description'],0,70) ?>...</td>

<td>
<span class="badge badge-soft">Active</span>
</td>

<td class="text-center">

<a href="edit_project.php?id=<?= $row['id'] ?>" 
class="btn btn-primary btn-action">
<i class="bi bi-pencil"></i>
</a>

<a href="delete_project.php?id=<?= $row['id'] ?>" 
onclick="return confirm('Delete this project permanently?')" 
class="btn btn-danger btn-action">
<i class="bi bi-trash"></i>
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include '../includes/footer.php'; ?>

