<!-- views/add_sale.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de productos
$productos = $conn->query("SELECT * FROM productos");
?>

<h2>Agregar Venta</h2>
<form action="../actions/add_sale.php" method="post">
    <select name="producto_id" required>
        <?php while ($producto = $productos->fetch_assoc()): ?>
            <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
        <?php endwhile; ?>
    </select>
    <input type="number" name="cantidad" placeholder="Cantidad" required>
    <button type="submit">Agregar</button>
</form>

<?php $conn->close(); ?>
<?php include '../includes/footer.php'; ?>
