<!-- views/dashboard.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado y tiene permisos de administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Contar productos, ventas, facturas y usuarios
$totalProductos = $conn->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];
$totalVentas = $conn->query("SELECT COUNT(*) AS total FROM ventas")->fetch_assoc()['total'];
$totalFacturas = $conn->query("SELECT COUNT(*) AS total FROM facturas")->fetch_assoc()['total'];
$totalUsuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];

$conn->close();
?>

<h2>Dashboard</h2>
<p>Total Productos: <?php echo $totalProductos; ?></p>
<p>Total Ventas: <?php echo $totalVentas; ?></p>
<p>Total Facturas: <?php echo $totalFacturas; ?></p>
<p>Total Usuarios: <?php echo $totalUsuarios; ?></p>

<?php include '../includes/footer.php'; ?>
