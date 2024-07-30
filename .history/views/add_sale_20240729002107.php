<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener lista de productos
$productos = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Venta</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Venta</h2>
        <form action="../actions/add_sale.php" method="post">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" required>
                <?php while ($producto = $productos->fetch_assoc()): ?>
                    <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" placeholder="Cantidad" required>
            <br>
            <button type="submit">Agregar Venta</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
<?php include '../includes/footer.php'; ?>
