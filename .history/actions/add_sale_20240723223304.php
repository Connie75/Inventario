<?php
// actions/add_sale.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Obtener precio del producto
    $result = $conn->query("SELECT precio FROM productos WHERE id = $producto_id");
    $producto = $result->fetch_assoc();
    $total = $producto['precio'] * $cantidad;

    // Insertar la nueva venta en la base de datos
    $sql = "INSERT INTO ventas (producto_id, cantidad, total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iid", $producto_id, $cantidad, $total);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Venta agregada exitosamente.";
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
