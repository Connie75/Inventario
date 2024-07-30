<!-- views/add_product.php -->
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>

<form action="../actions/add_product.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="cantidad" placeholder="Cantidad" required>
    <button type="submit">Añadir Producto</button>
</form>

<?php include '../includes/footer.php'; ?>
