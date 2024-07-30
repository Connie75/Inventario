<!-- views/products.php -->
<?php
session_start();
if (!isset($_SESSION['id']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'trabajador')) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT id, nombre, descripcion, precio, cantidad FROM productos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Cantidad</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td><td>{$row['descripcion']}</td><td>{$row['precio']}</td><td>{$row['cantidad']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron productos.";
}

$conn->close();
include '../includes/footer.php';
?>
