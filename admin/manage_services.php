<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config/db.php';

/* ================= DELETE ================= */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("SELECT image FROM services WHERE id=?");
    $stmt->execute([$id]);
    $img = $stmt->fetchColumn();

    if ($img && file_exists("../assets/images/$img")) {
        unlink("../assets/images/$img");
    }

    $conn->prepare("DELETE FROM services WHERE id=?")->execute([$id]);
    header("Location: manage_services.php");
    exit;
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imgName = uniqid("service_", true) . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$imgName");

        // Delete old image
        $old = $conn->prepare("SELECT image FROM services WHERE id=?");
        $old->execute([$id]);
        $oldImg = $old->fetchColumn();
        if ($oldImg && file_exists("../assets/images/$oldImg")) {
            unlink("../assets/images/$oldImg");
        }

        $conn->prepare(
            "UPDATE services SET title=?, category=?, description=?, image=? WHERE id=?"
        )->execute([$title, $category, $description, $imgName, $id]);
    } else {
        $conn->prepare(
            "UPDATE services SET title=?, category=?, description=? WHERE id=?"
        )->execute([$title, $category, $description, $id]);
    }

    header("Location: manage_services.php");
    exit;
}

/* ================= ADD NEW SERVICE ================= */
if (isset($_POST['add'])) {
    $title = trim($_POST['title']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imgName = uniqid("service_", true) . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$imgName");

        $conn->prepare(
            "INSERT INTO services (title, category, description, image) VALUES (?, ?, ?, ?)"
        )->execute([$title, $category, $description, $imgName]);
    }

    header("Location: manage_services.php");
    exit;
}

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>Manage Services</h2>
        <!-- Add New Service Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle me-1"></i> Add Service
        </button>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th width="120">Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = $conn->query("SELECT * FROM services ORDER BY id DESC");
        while ($service = $data->fetch(PDO::FETCH_ASSOC)):
        ?>
            <tr>
                <td><img src="../assets/images/<?= htmlspecialchars($service['image']) ?>" class="img-thumbnail" width="100"></td>
                <td><?= htmlspecialchars($service['title']) ?></td>
                <td><?= htmlspecialchars($service['category']) ?></td>
                <td><?= htmlspecialchars($service['description']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editService<?= $service['id'] ?>">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a href="?delete=<?= $service['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this service?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- EDIT MODAL -->
            <div class="modal fade" id="editService<?= $service['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <form method="POST" enctype="multipart/form-data" class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $service['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($service['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="Interior Design" <?= $service['category']=='Interior Design'?'selected':'' ?>>Interior Design</option>
                                    <option value="Modular Kitchen" <?= $service['category']=='Modular Kitchen'?'selected':'' ?>>Modular Kitchen</option>
                                    <option value="Furniture" <?= $service['category']=='Furniture'?'selected':'' ?>>Furniture</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($service['description']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Change Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- ADD SERVICE MODAL -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5>Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Choose a Service --</option>
                        <option value="Interior Design">Interior Design</option>
                        <option value="Modular Kitchen">Modular Kitchen</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add" class="btn btn-primary">Add Service</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
