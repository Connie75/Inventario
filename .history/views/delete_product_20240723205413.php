<!-- views/delete_product.php -->
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT nombre FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre);
$stmt->fetch();
?>

<form action="../actions/delete_product.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>¿Estás seguro de que quieres eliminar el producto <?php echo $nombre; ?>?</p>
    <button type="submit">Eliminar Producto</button>
</form>

<?php
$stmt->close();
$conn->close();
include '../includes.footer.php';
?>
