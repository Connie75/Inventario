<?php
// actions/add_invoice.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $venta_id = $_POST['venta_id'];

    // Insertar la nueva factura en la base de datos
    $sql = "INSERT INTO facturas (venta_id) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venta_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Factura agregada exitosamente.";
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
