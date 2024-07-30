<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['id']; // Obtener el ID del usuario logueado

    // Obtener el precio del producto para calcular el total
    $query = "SELECT precio FROM productos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $precio = $producto['precio'];
    $total = $precio * $cantidad;

    // Insertar la venta en la base de datos
    $query = "INSERT INTO ventas (producto_id, usuario_id, cantidad, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiid", $producto_id, $usuario_id, $cantidad, $total);

    if ($stmt->execute()) {
        header("Location: ../views/sales.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
