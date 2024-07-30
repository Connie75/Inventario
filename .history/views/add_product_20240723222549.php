<!-- views/add_product.php -->
<?php 
session_start();
include '../includes/header.php'; 

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Agregar Producto</h2>
<form action="../actions/add_product.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="cantidad" placeholder="Cantidad" required>
    <button type="submit">Agregar</button>
</form>

<?php include '../includes/footer.php'; ?>
