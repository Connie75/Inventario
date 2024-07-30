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

// Obtener estadísticas básicas
$productos = $conn->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];
$ventas = $conn->query("SELECT COUNT(*) AS total FROM ventas")->fetch_assoc()['total'];
$facturas = $conn->query("SELECT COUNT(*) AS total FROM facturas")->fetch_assoc()['total'];
$usuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];

$conn->close();
?>

<h2>Dashboard</h2>
<div class="stats">
    <div>Total Productos: <?php echo $productos; ?></div>
    <div>Total Ventas: <?php echo $ventas; ?></div>
    <div>Total Facturas: <?php echo $facturas; ?></div>
    <div>Total Usuarios: <?php echo $usuarios; ?></div>
</div>

<?php include '../includes/footer.php'; ?>
