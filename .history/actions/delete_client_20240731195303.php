<?php
session_start();
include("../includes/db.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Preparar la consulta de eliminación para el cliente
    $query = $conn->prepare("DELETE FROM clientes WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        // Redirigir al usuario a la lista de clientes
        header("Location: ../views/clients.php");
        exit();
    } else {
        $error = "Error al eliminar el cliente: " . $query->error;
    }
} else {
    $error = "ID de cliente no válido.";
}

if
