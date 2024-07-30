<?php
// actions/delete_product.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['rol'] == 'admin') {
    $id = $_POST['id'];

    $sql = "DELETE
