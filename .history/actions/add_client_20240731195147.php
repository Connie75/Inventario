<?php
session_start();
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos recibidos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    if ($nombre && $email && $telefono) {
        // Preparar la consulta de inserción para el cliente
        $query = $conn->prepare("INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nombre, $email, $telefono);

        if ($query->execute()) {
            // Redirigir al usuario a la lista de clientes
            header("Location: ../views/clients.php");
            exit();
        } else {
            $error = "Error al agregar el cliente: " . $query->error;
        }
    } else {
        $error = "Por favor, complete todos los campos obligatorios.";
    }
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
    <a href="../views/add_client.php">Volver</a>
</body>
</html>
