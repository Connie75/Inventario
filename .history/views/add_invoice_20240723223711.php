<!-- views/add_invoice.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de ventas
$ventas = $conn->query("SELECT * FROM ventas");

$conn->close();
?>

<h2>Agregar Factura</h2>
<form action="../actions/add_invoice.php" method="post">
    <select name="venta_id" required>
        <?php while ($venta = $ventas->fetch_assoc()): ?>
            <option value="<?php echo $venta['id']; ?>">Venta ID: <?php echo $venta['id']; ?> - Total: <?php echo $venta['total']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Agregar</button>
</form>

<?php include '../includes/footer.php'; ?>
