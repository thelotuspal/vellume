<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../admin/login.php");
    exit;
}

require '../config/db.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Image upload
    $image = $_FILES['image']['name'];
    $target = "../assets/images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare(
            "INSERT INTO projects (title, image, description)
             VALUES (:title, :image, :description)"
        );

        $stmt->execute([
            ':title' => $title,
            ':image' => $image,
            ':description' => $description
        ]);

        $success = "Project added successfully!";
    } else {
        $error = "Failed to upload image.";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2>Add New Project</h2>

    <?php if (isset($success)) { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Project Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Project Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">
            Add Project
        </button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
