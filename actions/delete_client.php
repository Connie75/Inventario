<?php
session_start();
include("../includes/db.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../views/clients.php");
} else {
    echo "Error al eliminar el cliente: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
