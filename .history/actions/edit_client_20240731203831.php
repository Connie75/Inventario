<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("UPDATE clientes SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $email, $telefono, $id);

    if ($stmt->execute()) {
        header("Location: ../views/clients.php");
    } else {
        echo "Error al actualizar el cliente: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
