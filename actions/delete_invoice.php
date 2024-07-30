<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar si el parámetro id está presente en la URL
if (!isset($_GET['id'])) {
    die("ID de factura no especificado.");
}

// Obtener el ID de la factura a eliminar
$invoice_id = $_GET['id'];

// Preparar y ejecutar la consulta para eliminar la factura
$query = "DELETE FROM facturas WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $invoice_id);

if ($stmt->execute()) {
    header("Location: ../views/invoices.php");
} else {
    die("Error al eliminar la factura: " . $conn->error);
}

$stmt->close();
$conn->close();
?>
