<!-- views/users.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado y tiene permisos de administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Obtener lista de usuarios
$result = $conn->query("SELECT * FROM usuarios");
?>

<h2>Gestión de Usuarios</h2>
<a href="add_user.php">Agregar Usuario</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($usuario = $usuarios->fetch_assoc()): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['rol']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    <a href="../actions/delete_user.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php $conn->close(); ?>
<?php include '../includes/footer.php'; ?>
