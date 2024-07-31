<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $telefono);

    if ($stmt->execute()) {
        header("Location: ../views/clients.php");
    } else {
        echo "Error al agregar el cliente: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
