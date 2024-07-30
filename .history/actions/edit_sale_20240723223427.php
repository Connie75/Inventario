<?php
// actions/edit_sale.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Obtener precio del producto
    $result = $conn->query("SELECT precio FROM productos WHERE id = $producto_id");
    $producto = $result->fetch_assoc();
    $total = $producto['precio'] * $cantidad;

    // Actualizar la venta en la base de datos
    $sql = "UPDATE ventas SET producto_id = ?, cantidad = ?, total = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidi", $producto_id, $cantidad, $total, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Venta actualizada exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../views/sales.php");
    exit();
}
?>
