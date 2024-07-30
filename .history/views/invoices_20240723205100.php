<!-- views/invoices.php -->
<?php
session_start();
if (!isset($_SESSION['id']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'trabajador')) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT f.id, f.fecha, f.total, u.nombre AS cliente
        FROM facturas f
        JOIN ventas v ON f.id_venta = v.id
        JOIN usuarios u ON v.id_cliente = u.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Fecha</th><th>Total</th><th>Cliente</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['fecha']}</td><td>{$row['total']}</td><td>{$row['cliente']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron facturas.";
}

$conn->close();
include '../includes/footer.php';
?>
