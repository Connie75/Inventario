<?php
// actions/login.php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que el correo exista
    $sql = "SELECT id, password, rol FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $rol);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['id'] = $id;
            $_SESSION['rol'] = $rol;
            header("Location: ../views/dashboard.php");
        } else {
            echo "Contraseña incorrecta. <a href='../views/login.php'>Intentar de nuevo</a>";
        }
    } else {
        echo "No se encontró una cuenta con ese email. <a href='../views/register.php'>Regístrate aquí</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
