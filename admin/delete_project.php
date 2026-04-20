<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
require '../config/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
$stmt->execute([$id]);

header("Location: projects_list.php");
