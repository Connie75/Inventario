<?php
// actions/add_user.php
session_start();
include '../includes/db.php';
include '../includes/header.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $password, $rol);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Usuario agregado exitosamente.";
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