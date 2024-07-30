<!-- views/edit_user.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado y tiene permisos de administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM usuarios WHERE id = $id")->fetch_assoc();

$conn->close();
?>

<h2>Editar Usuario</h2>
<form action="../actions/edit_user.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <input type="password" name="password" placeholder="Nueva Contraseña">
    <select name="rol" required>
        <option value="admin" <?php echo $user['rol'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
        <option value="trabajador" <?php echo $user['rol'] == 'trabajador' ? 'selected' : ''; ?>>Trabajador</option>
        <option value="cliente" <?php echo $user['rol'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
    </select>
    <button type="submit">Actualizar</button>
</form>

<?php include '../includes/footer.php'; ?>
