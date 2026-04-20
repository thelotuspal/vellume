<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
require '../config/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $description = $_POST['description'];

    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/".$image);

        $q = $conn->prepare("UPDATE projects SET title=?, description=?, image=? WHERE id=?");
        $q->execute([$title,$description,$image,$id]);
    }else{
        $q = $conn->prepare("UPDATE projects SET title=?, description=? WHERE id=?");
        $q->execute([$title,$description,$id]);
    }

    header("Location: projects_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    max-width: 900px;
    width: 100%;
    padding: 40px 20px;
}

.edit-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    border-radius: 28px;
    padding: 50px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.edit-header {
    text-align: center;
    margin-bottom: 40px;
}

.edit-header .icon {
    font-size: 4rem;
    color: #667eea;
    margin-bottom: 20px;
    animation: bounceIn 0.8s ease-out;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.edit-header h3 {
    font-weight: 800;
    color: #333;
    margin: 0;
    font-size: 2.8rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.edit-header p {
    color: #666;
    font-size: 1.1rem;
    margin: 10px 0 0 0;
}

.form-group {
    margin-bottom: 30px;
    animation: slideInLeft 0.6s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: block;
    font-size: 1rem;
}

.form-control {
    border: 2px solid #e1e5e9;
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    background: #fff;
    transform: translateY(-2px);
}

textarea.form-control {
    resize: vertical;
    min-height: 140px;
}

.current-image {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px dashed #dee2e6;
    border-radius: 16px;
    padding: 25px;
    text-align: center;
    margin-bottom: 25px;
    transition: all 0.3s ease;
}

.current-image:hover {
    border-color: #667eea;
    background: linear-gradient(135deg, #f0f4f8, #d1ecf1);
}

.current-image img {
    max-width: 250px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.current-image img:hover {
    transform: scale(1.05) rotate(2deg);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-wrapper input[type="file"] {
    position: absolute;
    left: -9999px;
}

.file-input-label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px 20px;
    border: 2px dashed #cbd5e0;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 249, 250, 0.9));
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    font-size: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.file-input-label:hover {
    border-color: #667eea;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.1);
}

.file-input-label i {
    margin-right: 12px;
    font-size: 20px;
    color: #667eea;
}

.btn-group {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-top: 40px;
}

.btn {
    border-radius: 28px;
    padding: 14px 32px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    border: none;
    flex: 1;
    text-align: center;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(108, 117, 125, 0.4);
    background: linear-gradient(135deg, #5a6268, #343a40);
}

.btn i {
    margin-right: 8px;
}

@media (max-width: 768px) {
    .container {
        padding: 20px;
    }
    .edit-card {
        padding: 30px 25px;
    }
    .edit-header h3 {
        font-size: 2.2rem;
    }
    .edit-header .icon {
        font-size: 3rem;
    }
    .btn-group {
        flex-direction: column;
    }
    .btn {
        margin-bottom: 10px;
    }
}
</style>
</head>
<body>

<div class="container">
    <div class="edit-card">
        <div class="edit-header">
            <div class="icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <h3>Edit Project</h3>
            <p>Update the project details and image to keep your portfolio fresh</p>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Project Title</label>
                <input type="text" name="title" class="form-control" value="<?= $project['title'] ?>" required placeholder="Enter an engaging project title">
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required placeholder="Provide a detailed description of the project"><?= $project['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Current Image</label>
                <div class="current-image">
                    <img src="../assets/images/<?= $project['image'] ?>" alt="Current Project Image">
                    <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">This is the current image. Upload a new one below if needed.</p>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Change Image (Optional)</label>
                <div class="file-input-wrapper">
                    <input type="file" name="image" id="image" accept="image/*">
                    <label for="image" class="file-input-label">
                        <i class="bi bi-cloud-upload-fill"></i> Choose New Image File
                    </label>
                </div>
            </div>

            <div class="btn-group">
                <button name="update" class="btn btn-primary">
                    <i class="bi bi-check-circle-fill"></i>Update Project
                </button>
                <a href="projects_list.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle-fill"></i>Back to Projects
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>