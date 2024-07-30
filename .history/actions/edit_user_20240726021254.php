<?php
// actions/edit_user.php
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    if (!empty($password)) {
        // Actualizar el usuario con nueva contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ?, rol = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $email, $hashed_password, $rol, $id);
    } else {
        // Actualizar el usuario sin cambiar la contraseña
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $rol, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Usuario actualizado exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../views/users.php");
    exit();
}
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
?>
