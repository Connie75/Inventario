<!-- views/edit_sale.php -->
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
$sale = $conn->query("SELECT * FROM ventas WHERE id = $id")->fetch_assoc();

// Obtener lista de productos
$productos = $conn->query("SELECT * FROM productos");

$conn->close();
?>

<h2>Editar Venta</h2>
<form action="../actions/edit_sale.php" method="post">
    <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
    <select name="producto_id" required>
        <?php while ($producto = $productos->fetch_assoc()): ?>
            <option value="<?php echo $producto['id']; ?>" <?php echo $producto['id'] == $sale['producto_id'] ? 'selected' : ''; ?>><?php echo $producto['nombre']; ?></option>
        <?php endwhile; ?>
    </select>
    <input type="number" name="cantidad" value="<?php echo $sale['cantidad']; ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../includes/footer.php'; ?>
