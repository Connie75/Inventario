<!-- views/update_product.php -->
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT nombre, descripcion, precio, cantidad FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $descripcion, $precio, $cantidad);
$stmt->fetch();
?>

<form action="../actions/update_product.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="nombre" value="<?php echo $nombre; ?>" required>
    <textarea name="descripcion"><?php echo $descripcion; ?></textarea>
    <input type="number" step="0.01" name="precio" value="<?php echo $precio; ?>" required>
    <input type="number" name="cantidad" value="<?php echo $cantidad; ?>" required>
    <button type="submit">Actualizar Producto</button>
</form>

<?php
$stmt->close();
$conn->close();
include '../includes/footer.php';
?>
