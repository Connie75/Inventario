<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener lista de clientes
$clientes = $conn->query("SELECT * FROM clientes");
if (!$clientes) {
    die("Query fallida: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Factura</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Factura</h2>
        <form action="../actions/add_invoice.php" method="post">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <?php while ($cliente = $clientes->fetch_assoc()): ?>
                    <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="total">Total:</label>
            <input type="number" name="total" id="total" step="0.01" required>
            <br>
            <button type="submit">Agregar Factura</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
<?php include '../includes/footer.php'; ?>
