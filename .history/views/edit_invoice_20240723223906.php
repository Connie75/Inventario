<!-- views/edit_invoice.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$invoice = $conn->query("SELECT * FROM facturas WHERE id = $id")->fetch_assoc();

// Obtener lista de ventas
$ventas = $conn->query("SELECT * FROM ventas");

$conn->close();
?>

<h2>Editar Factura</h2>
<form action="../actions/edit_invoice.php" method="post">
    <input type="hidden" name="id" value="<?php echo $invoice['id']; ?>">
    <select name="venta_id" required>
        <?php while ($venta = $ventas->fetch_assoc()): ?>
            <option value="<?php echo $venta['id']; ?>" <?php echo $venta['id'] == $invoice['venta_id'] ? 'selected' : ''; ?>>Venta ID: <?php echo $venta['id']; ?> - Total: <?php echo $venta['total']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Actualizar</button>
</form>

<?php include '../includes/footer.php'; ?>
