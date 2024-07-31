<?php
session_start();
include("../includes/db.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Preparar la consulta de eliminación para el cliente
    $query = $conn->prepare("DELETE FROM clientes WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        // Redirigir al usuario a la lista de clientes
        header("Location: ../views/clients.php");
        exit();
    } else {
        $error = "Error al eliminar el cliente: " . $query->error;
    }
} else {
    $error = "ID de cliente no válido.";
}

if (isset($error)) {
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
        <div class="error"><?php echo $error; ?></div>
        <a href="../views/clients.php">Volver</a>
    </body>
    </html>
    <?php
}
?>
