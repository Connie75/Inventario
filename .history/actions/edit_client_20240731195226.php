<?php
session_start();
include("../includes/db.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id) {
    // Validar y sanitizar los datos recibidos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    if ($nombre && $email && $telefono) {
        // Preparar la consulta de actualización para el cliente
        $query = $conn->prepare("UPDATE clientes SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
        $query->bind_param("sssi", $nombre, $email, $telefono, $id);

        if ($query->execute()) {
            // Redirigir al usuario a la lista de clientes
            header("Location: ../views/clients.php");
            exit();
        } else {
            $error = "Error al actualizar el cliente: " . $query->error;
        }
    } else {
        $error = "Por favor, complete todos los campos obligatorios.";
    }
} else {
    $error = "ID de cliente no válido.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Error</h1>
    <div class="error"><?php echo isset($error) ? $error : 'Error desconocido'; ?></div>
    <a href="../views/clients.php">Volver</a>
</body>
</html>
