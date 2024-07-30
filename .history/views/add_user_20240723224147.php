<!-- views/add_user.php -->
<?php 
session_start();
include '../includes/header.php'; 

// Verificar si el usuario está logueado y tiene permisos de administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<h2>Agregar Usuario</h2>
<form action="../actions/add_user.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <select name="rol" required>
        <option value="admin">Administrador</option>
        <option value="trabajador">Trabajador</option>
        <option value="cliente">Cliente</option>
    </select>
    <button type="submit">Agregar</button>
</form>

<?php include '../includes/footer.php'; ?>
