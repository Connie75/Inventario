<?php
// actions/edit_invoice.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $venta_id = $_POST['venta_id'];

    // Actualizar la factura en la base de datos
    $sql = "UPDATE facturas SET venta_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $venta_id, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Factura actualizada exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../views/invoices.php");
    exit();
}
?>
