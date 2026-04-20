
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f4f6fb;
margin:0;
}

/* ================= SIDEBAR ================= */

.sidebar{
width:260px;
height:100vh;
position:fixed;
background:#1e293b;
padding:25px;
color:white;
}

.sidebar h3{
font-weight:600;
margin-bottom:40px;
display:flex;
align-items:center;
gap:10px;
}

.sidebar a{
display:flex;
align-items:center;
gap:12px;
color:#cbd5e1;
padding:12px 15px;
border-radius:10px;
text-decoration:none;
margin-bottom:8px;
transition:0.3s;
}

.sidebar a:hover{
background:#334155;
color:white;
transform:translateX(5px);
}

.sidebar .logout:hover{
background:#ef4444;
}

/* ================= MAIN ================= */

.main{
margin-left:260px;
padding:30px;
}

/* ================= TOPBAR ================= */

.topbar{
background:white;
padding:20px 25px;
border-radius:12px;
box-shadow:0 4px 15px rgba(0,0,0,0.05);
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

/* ================= CARDS ================= */

.dashboard-card{
background:white;
border-radius:15px;
padding:30px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
transition:0.3s;
height:100%;
}

.dashboard-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 40px rgba(0,0,0,0.1);
}

.card-icon{
width:60px;
height:60px;
display:flex;
align-items:center;
justify-content:center;
border-radius:12px;
font-size:26px;
color:white;
margin-bottom:15px;
}

.icon-blue{background:#3b82f6;}
.icon-green{background:#22c55e;}
.icon-orange{background:#f59e0b;}

.dashboard-card h5{
font-weight:600;
margin-bottom:10px;
}

.dashboard-card p{
font-size:14px;
color:#666;
}

.btn-custom{
border-radius:25px;
padding:6px 18px;
}

</style>
</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h3><i class="bi bi-buildings"></i> Vellume Admin</h3>

<a href="dashboard.php">
<i class="bi bi-speedometer2"></i> Dashboard
</a>

<a href="projects_list.php">
<i class="bi bi-kanban"></i> Projects
</a>

<a href="add_furniture.php">
<i class="bi bi-chair"></i> Furniture
</a>

<a href="enquiries.php">
<i class="bi bi-envelope"></i> Enquiries
</a>

<a href="logout.php" class="logout">
<i class="bi bi-box-arrow-right"></i> Logout
</a>

</div>

<!-- MAIN -->

<div class="main">

<!-- TOPBAR -->

<div class="topbar">

<div>
<h5 class="mb-0">Welcome, <?php echo $_SESSION['admin']; ?> 👋</h5>
<small class="text-muted">Interior business management panel</small>
</div>

<span class="badge bg-success">Admin</span>

</div>

<!-- DASHBOARD CARDS -->

<div class="row g-4">

<div class="col-md-4">

<div class="dashboard-card">

<div class="card-icon icon-blue">
<i class="bi bi-kanban"></i>
</div>

<h5>Projects</h5>

<p>Manage interior design projects and portfolio.</p>

<a href="projects_list.php" class="btn btn-primary btn-sm btn-custom">Manage</a>

</div>

</div>


<div class="col-md-4">

<div class="dashboard-card">

<div class="card-icon icon-green">
<i class="bi bi-chair"></i>
</div>

<h5>Furniture</h5>

<p>Add and manage furniture products.</p>

<a href="add_furniture.php" class="btn btn-success btn-sm btn-custom">Manage</a>

</div>

</div>


<div class="col-md-4">

<div class="dashboard-card">

<div class="card-icon icon-orange">
<i class="bi bi-envelope"></i>
</div>

<h5>Enquiries</h5>

<p>View customer messages and requests.</p>

<a href="enquiries.php" class="btn btn-warning btn-sm btn-custom">View</a>

</div>

</div>

</div>

</div>

</body>
</html>

