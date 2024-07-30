<!-- views/edit_product.php -->
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
$product = $conn->query("SELECT * FROM productos WHERE id = $id")->fetch_assoc();
$conn->close();
?>

<h2>Editar Producto</h2>
<form action="../actions/edit_product.php" method="post">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <input type="text" name="nombre" value="<?php echo $product['nombre']; ?>" required>
    <textarea name="descripcion"><?php echo $product['descripcion']; ?></textarea>
    <input type="number" step="0.01" name="precio" value="<?php echo $product['precio']; ?>" required>
    <input type="number" name="cantidad" value="<?php echo $product['cantidad']; ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../includes/footer.php'; ?>
