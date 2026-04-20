
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';


/* ================= ADD ================= */

if(isset($_POST['add'])){

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$image="";

if($_FILES['image']['name']!=""){

$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$image = time().".".$ext;

move_uploaded_file($_FILES['image']['tmp_name'],"../assets/images/".$image);

}

$sql = $conn->prepare("INSERT INTO furniture(name,price,description,image) VALUES(?,?,?,?)");
$sql->execute([$name,$price,$description,$image]);

header("Location: manage_furniture.php");
exit();

}


/* ================= DELETE ================= */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

$conn->prepare("DELETE FROM furniture WHERE id=?")->execute([$id]);

header("Location: manage_furniture.php");
exit();

}


/* ================= UPDATE ================= */

if(isset($_POST['edit'])){

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

if($_FILES['image']['name']!=""){

$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$image = time().".".$ext;

move_uploaded_file($_FILES['image']['tmp_name'],"../assets/images/".$image);

$conn->prepare("UPDATE furniture SET name=?,price=?,description=?,image=? WHERE id=?")
->execute([$name,$price,$description,$image,$id]);

}
else{

$conn->prepare("UPDATE furniture SET name=?,price=?,description=? WHERE id=?")
->execute([$name,$price,$description,$id]);

}

header("Location: manage_furniture.php");
exit();

}

?>


<?php include '../includes/header.php'; ?>


<style>

body{
background:#f4f6f9;
}

.table img{
height:70px;
width:100px;
object-fit:cover;
border-radius:8px;
border:1px solid #ddd;
}

.card{
border-radius:10px;
}

</style>


<div class="container mt-4">


<div class="d-flex justify-content-between align-items-center mb-3">

<h4>Manage Furniture</h4>

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Add Furniture
</button>

</div>


<div class="card shadow">

<div class="card-body p-0">


<table class="table table-hover align-middle mb-0">

<thead class="table-dark">

<tr>
<th width="120">Image</th>
<th>Name</th>
<th>Price</th>
<th width="180">Action</th>
</tr>

</thead>

<tbody>

<?php

$data = $conn->query("SELECT * FROM furniture ORDER BY id DESC");

foreach($data as $row){

?>

<tr>

<td>
<img src="../assets/images/<?php echo $row['image']; ?>">
</td>

<td>
<strong><?php echo $row['name']; ?></strong>
</td>

<td>
₹ <?php echo $row['price']; ?>
</td>

<td>

<button class="btn btn-sm btn-primary"
data-bs-toggle="modal"
data-bs-target="#edit<?php echo $row['id']; ?>">
Edit
</button>

<a href="?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this furniture?')"
class="btn btn-sm btn-danger">
Delete
</a>

</td>

</tr>



<!-- EDIT MODAL -->

<div class="modal fade" id="edit<?php echo $row['id']; ?>">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form method="POST" enctype="multipart/form-data">

<div class="modal-header">

<h5>Edit Furniture</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>


<div class="modal-body">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name"
value="<?php echo $row['name']; ?>"
class="form-control" required>
</div>

<div class="mb-3">
<label>Price</label>
<input type="text" name="price"
value="<?php echo $row['price']; ?>"
class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description"
class="form-control"><?php echo $row['description']; ?></textarea>
</div>

<div class="mb-3">
<label>Change Image</label>
<input type="file" name="image" class="form-control">
</div>

</div>


<div class="modal-footer">

<button type="submit" name="edit" class="btn btn-success">
Update
</button>

</div>

</form>

</div>

</div>

</div>


<?php } ?>

</tbody>

</table>

</div>

</div>

</div>



<!-- ADD MODAL -->

<div class="modal fade" id="addModal">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form method="POST" enctype="multipart/form-data">

<div class="modal-header">

<h5>Add Furniture</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>


<div class="modal-body">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name"
class="form-control" required>
</div>

<div class="mb-3">
<label>Price</label>
<input type="text" name="price"
class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description"
class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Image</label>
<input type="file" name="image"
class="form-control" required>
</div>

</div>


<div class="modal-footer">

<button type="submit" name="add" class="btn btn-primary">
Add Furniture
</button>

</div>

</form>

</div>

</div>

</div>


<?php include '../includes/footer.php'; ?>

